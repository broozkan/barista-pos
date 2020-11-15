<?php

/**
*
*/
class Baristapos extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  /*HAKKINDA SAYFASI*/
  public function hakkinda()
  {
    $this->view->render("baristapos/hakkinda");
  }
  /*HAKKINDA SAYFASI*/

  /*GÜNCELLEME SAYFASI*/
  public function guncelleme()
  {
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT sirket_eposta_adresi FROM tbl_sirket WHERE id=(SELECT MAX(id) FROM tbl_sirket)");
    $stmt->execute();
    $sirketEpostaAdresi = $stmt->fetch()["sirket_eposta_adresi"];

    $this->view->sirketEpostaAdresi = $sirketEpostaAdresi;
    $this->view->render("baristapos/guncelleme");
  }
  /*GÜNCELLEME SAYFASI*/

  /*GÜNCELLEME KONTROL ET KODLARI*/
  public function guncellemeKontrolEt()
  {
    if (isset($_POST["guncellemeKontrolEt"])) {

      $guncellenecekVersiyonSurumu = null;

      $conn = ftp_connect('ftp.brosoft.com.tr');
      if (!$conn) die('ftp.example.com ile bağlantı kurulamadı');

      // kullanıcı adı ve parola ile oturum açalım
      $login_result = ftp_login($conn, "barista_pos@brosoft.com.tr", "sfrSFR135");

      // çalıştığımız dizinin içeriğini alalım
      $icerik = ftp_nlist($conn, ".");
      $guncellemeDosyalari = array();
      foreach ($icerik as $key => $value) {
        $ilkHarf = substr($value,0,1);
        if ($ilkHarf == ".") {

        }else {
          array_push($guncellemeDosyalari,$icerik[$key]);
        }
      }
      $mevcutProgramVersiyonu = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json");
      $mevcutProgramVersiyonu = json_decode($mevcutProgramVersiyonu,true);

      for ($i=0; $i < count($guncellemeDosyalari); $i++) {
        if ($guncellemeDosyalari[$i] > $mevcutProgramVersiyonu["txtVersiyonNo"]) {
          $guncellenecekVersiyonSurumu = $guncellemeDosyalari[$i];
          break;
        }
      }

      echo json_encode(array(
        "guncellenecekVersiyonSurumu"=>$guncellenecekVersiyonSurumu
      ));

    }
  }
  /*GÜNCELLEME KONTROL ET KODLARI*/

  /*VERİTABANI YEDEK ALMA KODLARI*/
  public function veritabaniYedegiAl()
  {
    if (isset($_POST["veritabaniYedegiAl"])) {
      $epostaAdresi = $_POST["veritabaniYedegiAl"];

      $filename='backup_'.date('Y-m-d').'.sql';

      $result=exec('mysqldump barista_pos_brosoft --password=broozkan58. --user=root --single-transaction > /var/www/html/0001/documents/backups/'.$filename.'');


      $dosya = $this->yolPhp."documents/backups/".$filename."";
      $dosyaBoyutu = filesize($dosya);

      if ($dosyaBoyutu > 10) {
        $yanit = true;
      }else {
        unlink($dosya);
        $yanit = "Veritabanı yedeği alınamadı!";
      }

      if ($yanit == true) {
        if ($epostaAdresi != null || $epostaAdresi != "") {
          $eposta = new Epostalar();
          $eposta->setEpostaKonusu("Veritabanı Yedek");
          $eposta->setEpostaAlicisi($epostaAdresi);
          $eposta->setEpostaIcerik("Barista Pos Veritabanı Yedeği");
          $yanit = $eposta->epostaDosyaGonder($filename,$dosya);
        }
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*VERİTABANI YEDEK ALMA KODLARI*/



  /*GÜNCELLEMEYİ GERÇEKLEŞTİR KODLARI*/
  public function guncellemeyiGerceklestir()
  {
    if (isset($_POST["guncellemeyiGerceklestir"])) {

      $guncellenecekVersiyonSurumu = explode(".",$_POST["guncellemeyiGerceklestir"]);
      $guncellenecekVersiyonSurumu = $guncellenecekVersiyonSurumu[0];

      $izin = false;

      // FTP server details
      $ftpHost   = 'ftp.brosoft.com.tr';
      $ftpUsername = 'barista_pos@brosoft.com.tr';
      $ftpPassword = 'sfrSFR135';

      // open an FTP connection
      $connId = ftp_connect($ftpHost) or die("Couldn't connect to $ftpHost");

      // login to FTP server
      $ftpLogin = ftp_login($connId, $ftpUsername, $ftpPassword);

      // local & server file path
      $localFilePath  = $_SERVER["DOCUMENT_ROOT"].'/'.$guncellenecekVersiyonSurumu.'.zip';
      $remoteFilePath = $guncellenecekVersiyonSurumu.'.zip';

      // try to download a file from server
      if(ftp_get($connId, $localFilePath, $remoteFilePath, FTP_BINARY)){
        $izin = true;
      }else{
        $izin = false;
        $yanit = "Güncelleme dosyası indirilirken bir sorun oluştu!";
      }
      ftp_close($connId);
      // close the connection
      if ($izin == true) {

        $zip = new ZipArchive;
        if ($zip->open($_SERVER["DOCUMENT_ROOT"].'/'.$guncellenecekVersiyonSurumu.'.zip') === TRUE) {
          $zip->extractTo($_SERVER["DOCUMENT_ROOT"]);
          $zip->close();
          $izin = true;
        } else {
          $izin = false;
          $yanit = "Güncelleme dosyası arşivden çıkarılamadı!";
        }

        if ($izin == true) {

          $dir    = $_SERVER["DOCUMENT_ROOT"].'/'.$guncellenecekVersiyonSurumu.'/';
          $files1 = scandir($dir);
          for ($i=0; $i < count($files1); $i++) {

            $ext = pathinfo($files1[$i], PATHINFO_EXTENSION);

            if ($ext == "sql") {
              $sqlScript = file($_SERVER["DOCUMENT_ROOT"]."/".$guncellenecekVersiyonSurumu."/".$files1[$i]);

              foreach ($sqlScript as $line)	{
                if ($izin == false) {
                  break;
                }

                $startWith = substr(trim($line), 0 ,2);
                $endWith = substr(trim($line), -1 ,1);

                if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                  continue;
                }
                @$query = $query . $line;
                if ($endWith == ';') {
                  try {
                    $model = new Model();
                    $stmt = @$model->dbh->prepare($query);
                    $yanit = $stmt->execute();
                    // echo $query."----".$yanit;
                    // echo "<br>";
                    if ($yanit == false) {
                      throw new Exception("Sql dosyasında hata var",0);
                    }
                    $query= '';

                  } catch (\Exception $e) {
                    if ($e->getCode() == 0) {
                      $filename=$this->yolPhp.'documents/backups/backup_'.date('Y-m-d').'.sql';
                      $cmd = "mysql -u root -pbroozkan58. barista_pos_brosoft < ".$this->yolPhp."documents/backups/".$filename."";
                      exec($cmd);
                      $yanit = $e->getMessage();
                      $izin = false;
                    }
                  }
                }
              }
            }
          }

          if ($izin == true) {
            $kurulumBilgileri = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json");
            $kurulumBilgileri = json_decode($kurulumBilgileri,true);
            $kurulumBilgileri["txtVersiyonNo"] = $guncellenecekVersiyonSurumu;
            $kurulumBilgileri = json_encode($kurulumBilgileri);
            $yanit = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json",$kurulumBilgileri);
            if ($yanit == false) {
              $yanit = "Güncelleme versiyon numarası yazılamadı!";
            }else {
              $yanit = true;
            }

          }

        }

      }


      echo json_encode(array(
        "yanit"=>$yanit
      ));



    }
  }
  /*GÜNCELLEMEYİ GERÇEKLEŞTİR KODLARI*/

  /*GERİ BİLDİRİM SAYFASI*/
  public function geriBildirim()
  {

    $this->view->render("baristapos/geri-bildirim");
  }
  /*GERi BİLDİRİM SAYFASI*/

  /*GERİ BİLDİRİM GÖNDER KODLARI*/
  public function geriBildirimGonder()
  {
    if (isset($_POST["geriBildirimGonder"])) {
      $veriler = json_decode($_POST["geriBildirimGonder"],true);

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_sirket");
      $stmt->execute();
      $sirketBilgileri = $stmt->fetch();

      $eposta = new Epostalar();
      $eposta->setEpostaKonusu($veriler["txtKonu"]);
      $eposta->setEpostaAlicisi("burhan.ozkan@live.com");
      $eposta->setEpostaIcerik($veriler["txtMesaj"]);

      $yanit = $eposta->epostaGonder();

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }


  }
  /*GERİ BİLDİRİM GÖNDER KODLARI*/
}
