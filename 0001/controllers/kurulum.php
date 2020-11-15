<?php
/**
*
*/
class Kurulum extends Controller
{

  function __construct()
  {
    parent::__construct();
    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
      //DO NOTHING
    }else {
      $this->view->render("kurulum");
    }
  }

  public function kurulumYap()
  {
    if ($_POST["kurulumBilgileri"]) {
      $yanit = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json",$_POST["kurulumBilgileri"]);
      $veriler = json_decode($_POST["kurulumBilgileri"],true);
      if ($yanit != false) {
        try {
          $dbh = new PDO("mysql:host=".$veriler["txtVeritabaniYolu"]."", $veriler["txtVeritabaniKullaniciAdi"], $veriler["txtVeritabaniParola"]);
          $yanit = $dbh->exec("CREATE DATABASE ".$veriler["txtVeritabaniAdi"]." DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;")
          or die(print_r($dbh->errorInfo(), true));
          if ($yanit == true) {
            $dbh = null;
            $query = '';

            $dbh = new PDO("mysql:host=".$veriler["txtVeritabaniYolu"].";dbname=".$veriler["txtVeritabaniAdi"]."", $veriler["txtVeritabaniKullaniciAdi"], $veriler["txtVeritabaniParola"]);
            $sqlScript = file($_SERVER["DOCUMENT_ROOT"].'/Kurulum.sql');
            foreach ($sqlScript as $line)	{

              $startWith = substr(trim($line), 0 ,2);
              $endWith = substr(trim($line), -1 ,1);

              if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
              }
              $query = $query . $line;
              if ($endWith == ';') {
                $dbh->exec($query);
                $query= '';
              }
            }
            if ($yanit == true) {
              $stmt = $dbh->prepare(
                "INSERT INTO tbl_sirket SET
                sirket_adi=:sirket_adi,
                sirket_adresi=:sirket_adresi,
                sirket_eposta_adresi=:sirket_eposta_adresi,
                sirket_telefonu=:sirket_telefonu,
                sirket_vergi_numarasi=:sirket_vergi_numarasi"
              );
              $yanit = $stmt->execute([
                'sirket_adi'=>$veriler["txtSirketAdi"],
                'sirket_adresi'=>$veriler["txtSirketAdresi"],
                'sirket_eposta_adresi'=>$veriler["txtSirketEpostaAdresi"],
                'sirket_telefonu'=>$veriler["txtSirketTelefonNumarasi"],
                'sirket_vergi_numarasi'=>$veriler["txtSirketVergiNumarasi"]
              ]);
              $stmt = $dbh->prepare(
                "INSERT INTO tbl_calisanlar SET
                calisan_adi_soyadi=:calisan_adi_soyadi,
                calisan_kullanici_adi=:calisan_kullanici_adi,
                calisan_parolasi=:calisan_parolasi"
              );
              $yanit = $stmt->execute([
                'calisan_adi_soyadi'=>"Burhan Özkan",
                'calisan_kullanici_adi'=>"broozkan__",
                'calisan_parolasi'=>md5("LPVNU737uxrf.")
              ]);

            }
          }

        } catch (PDOException $e) {
          $yanit = $e->getMessage();
        }
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}

?>
