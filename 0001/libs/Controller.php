<?php
/**
*
*/

/*PHP DİZİNİNİ BELİRLEME*/
$kurulumBilgileri = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json");
$kurulumBilgileri = json_decode($kurulumBilgileri,true);
/*PHP DİZİNİNİ BELİRLEME*/

// require_once $_SERVER["DOCUMENT_ROOT"].'/'.$kurulumBilgileri["txtVersiyonNo"].'/dompdf/autoload.inc.php';
//
// use Dompdf\Dompdf;


class Controller
{
  public $yolPhp;
  public $yolHtml;
  public $tabloAdlari;
  public $kolonAdlari;
  public $kurIsareti;
  public $values;
  public $permissions;
  public $sayfaIzınAdi;

  public $searchTabloAdlari =  array(
    "tbl_kategoriler",
    "tbl_masalar",
    "tbl_sirket_carileri",
    "tbl_calisanlar",
    "tbl_urunler",
    "tbl_lokasyonlar",
    "tbl_mutfaklar",
    "tbl_yazicilar",
    "tbl_statuler",
    "tbl_kurlar",
    "tbl_musteriler",
    "tbl_odeme_metodlari",
    "tbl_depolar",
    "tbl_kasalar",
    "tbl_birimler",
    "tbl_odemeler",
    "tbl_alis_faturalari",
    "tbl_vergiler",
    "tbl_tahsilatlar",
    "tbl_alacaklar",
    "tbl_verecekler",
    "tbl_satis_faturalari",
    "tbl_teslim_durumlari"
  );
  public $searchKolonAdlari =  array(
    "kategori_adi",
    "masa_adi",
    "cari_adi",
    "calisan_adi_soyadi",
    "calisan_kullanici_adi",
    "urun_adi",
    "urun_kodu",
    "lokasyon_adi",
    "mutfak_adi",
    "yazici_adi",
    "statu_adi",
    "kur_adi",
    "musteri_adi_soyadi",
    "odeme_metod_adi",
    "depo_adi",
    "kasa_adi",
    "birim_adi",
    "odeme_kodu",
    "alis_faturasi_kodu",
    "vergi_adi",
    "tahsilat_kodu",
    "alacak_kodu",
    "verecek_kodu",
    "satis_faturasi_kodu",
    "teslim_durumu_adi"
  );

  function __construct()
  {
    $this->view = new View();
    @session_start();
    $kurulumBilgileri = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json");
    if ($kurulumBilgileri) {
      $kurulumBilgileri = json_decode($kurulumBilgileri,true);
      $this->view->yolPhp = $_SERVER["DOCUMENT_ROOT"]."/".$kurulumBilgileri["txtVersiyonNo"]."/";

      /*HTML DİZİNİNİ BELİRLEME*/
      $this->view->yolHtml = $kurulumBilgileri["txtKokDizin"]."".$kurulumBilgileri["txtVersiyonNo"]."/";
      /*HTML DİZİNİNİ BELİRLEME*/

      if (isset($_SESSION["kullaniciAdiSoyadi"])) {

        $this->view->kullaniciAdiSoyadi = $_SESSION["kullaniciAdiSoyadi"];
        $this->view->kullaniciProfilFotosu = $_SESSION["kullaniciProfilFotosu"];

      }
      spl_autoload_register(function ($class_name) {
        if (file_exists($this->yolPhp."models/".$class_name . '.php')) {
          include $this->yolPhp."models/".$class_name . '.php';
        }
      });

    }


  }


  public function dataInsert()
  {
    $model = new Model();
    $yanit = $model->insertQuery($this->tabloAdlari[0],$this->kolonAdlari,$this->values);
    return $yanit;
    $model = null;
  }
  public function dataUpdate()
  {
    $model = new Model();
    $yanit = $model->updateQuery($this->tabloAdlari[0],$this->values);
    return $yanit;
    $model = null;
  }
  public function dataload()
  {
    if ($_POST["dataLoad"]) {
      $veriler = json_decode($_POST["dataLoad"],true);
      $model = new Model();
      $toplamVeriSayisi = $model->selectQuery($this->tabloAdlari[0],array("id"));
      $result = $model->selectLimitQuery($this->tabloAdlari[0],array("*"),array("limit"=>$veriler["limit"],"offset"=>$veriler["offset"]));
      echo json_encode(array(
        "toplamVeriSayisi"=>count($toplamVeriSayisi),
        "sonuclar"=>$result
      ));
      $model = null;

    }
  }
  public function kurIsaretiniAl()
  {
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT kur_isareti FROM tbl_kurlar WHERE kur_aktif_mi=1");
    $stmt->execute();
    return $stmt->fetch()["kur_isareti"];
    $model = null;
  }
  public function fixDate($tarih)
  {
    $tarih = explode("-",$tarih);
    $tarih = $tarih[2]."-".$tarih[1]."-".$tarih[0];
    return $tarih;
  }

  public function fixDateTime($dateTime)
  {
    $dateTime = explode(" ",$dateTime);
    $tarih = explode("-",$dateTime[0]);
    $tarih = $tarih[2]."-".$tarih[1]."-".$tarih[0];
    $dateTime = $tarih." ".$dateTime[1];

    return $dateTime;
  }

  public function yetkiSorgula()
  {
    return true;
  }

  public function adisyonTutariniDuzenle($adisyonIdsi)
  {
    $model = new Model();
    $stmt = $model->dbh->prepare(
      "SELECT SUM(adisyon_urunleri_urun_toplam_fiyati) AS adisyon_urunleri_toplam_tutari FROM tbl_adisyon_urunleri WHERE adisyon_urunleri_adisyon_idsi=:adisyon_idsi AND adisyon_urunleri_urun_ozel_durumu_idsi=0"
    );
    $stmt->execute([
      'adisyon_idsi'=>$adisyonIdsi
    ]);
    $adisyonUrunleriToplamTutari = $stmt->fetch()["adisyon_urunleri_toplam_tutari"];


    $stmt = $model->dbh->prepare(
      "SELECT adisyon_indirim_turu,adisyon_indirim_miktari FROM tbl_adisyonlar WHERE id=:adisyon_idsi"
    );
    $stmt->execute(['adisyon_idsi'=>$adisyonIdsi]);
    $adisyonIndirimBilgileri = $stmt->fetch();
    $adisyonMevcutIndirimTuru = $adisyonIndirimBilgileri["adisyon_indirim_turu"];
    $adisyonMevcutIndirimMiktari = $adisyonIndirimBilgileri["adisyon_indirim_miktari"];


    if ($adisyonMevcutIndirimTuru == 0) {
      $adisyonTutari = $adisyonUrunleriToplamTutari - ($adisyonUrunleriToplamTutari * $adisyonMevcutIndirimMiktari) / 100;
      $adisyonTutari = number_format((float)$adisyonTutari, 2, '.', '');
    }else {
      $adisyonTutari = $adisyonUrunleriToplamTutari -  $adisyonMevcutIndirimMiktari;
    }


    $stmt = $model->dbh->prepare(
      "SELECT SUM(adisyon_odemesi_odeme_miktari) AS adisyon_odemesi_odeme_miktari FROM tbl_adisyon_odemeleri WHERE adisyon_odemesi_adisyon_idsi=:adisyon_idsi"
    );
    $stmt->execute([
      'adisyon_idsi'=>$adisyonIdsi
    ]);
    $odenmisTutar = $stmt->fetch()["adisyon_odemesi_odeme_miktari"];
    if (!$odenmisTutar) {
      $odenmisTutar = 0;
    }

    if ($odenmisTutar == $adisyonTutari) {
      $adisyonOdemeDurumu = 1;
      $masaDurumu = 0;
    }else {
      $adisyonOdemeDurumu = 0;
      $masaDurumu = 1;
    }

    $stmt = $model->dbh->prepare(
      "SELECT tbl_masalar.id AS masa_idsi FROM tbl_masalar INNER JOIN tbl_adisyonlar ON tbl_masalar.id=tbl_adisyonlar.adisyon_masa_idsi WHERE tbl_adisyonlar.id=:adisyon_idsi"
    );
    $stmt->execute([
      'adisyon_idsi'=>$adisyonIdsi
    ]);
    $masaIdsi = $stmt->fetch()["masa_idsi"];

    $stmt = $model->dbh->prepare(
      "UPDATE tbl_masalar SET masa_durumu=:masa_durumu WHERE id=:masa_idsi"
    );
    $stmt->execute([
      'masa_durumu'=>$masaDurumu,
      'masa_idsi'=>$masaIdsi
    ]);

    $stmt = $model->dbh->prepare(
      "UPDATE tbl_adisyonlar SET adisyon_tutari=:adisyon_tutari,adisyon_odenmis_tutar=:odenmis_tutar,adisyon_odeme_durumu=:adisyon_odeme_durumu WHERE id=:adisyon_idsi"
    );
    return $stmt->execute([
      'adisyon_tutari'=>$adisyonUrunleriToplamTutari,
      'odenmis_tutar'=>$odenmisTutar,
      'adisyon_odeme_durumu'=>$adisyonOdemeDurumu,
      'adisyon_idsi'=>$adisyonIdsi
    ]);



  }

  public function dataShare()
  {

    if ($_POST["dataShare"]) {
      $veriler = json_decode($_POST["dataShare"],true);
      $paylasilacakVeriMiktari = explode("-",$veriler["txtPaylasilacakVeriMiktari"]);
      $offset = intval($paylasilacakVeriMiktari[0]);
      $limit = intval($paylasilacakVeriMiktari[1]);
      $cboxIndir = false;
      $epostaAdresleri = array();
      $epostaAdresiOlmayanlar = array();
      $uzanti = "";
      if ($veriler["txtSunaDonustur"] == "PDF") {
        $uzanti = "pdf";
      }elseif ($veriler["txtSunaDonustur"] == "EXCEL") {
        $uzanti = "xls";
      }
      $model = new Model();
      $tabloIcerigi = $model->selectLimitQuery($this->tabloAdlari[$veriler["dataIndex"]],array("*"),array("limit"=>$limit,"offset"=>$offset));
      $model = null;
      $yanit = $this->sunaDonustur($veriler,$veriler["txtSunaDonustur"],$tabloIcerigi,$this->tabloAdlari[$veriler["dataIndex"]]);
      if ($yanit != false) {
        if (isset($veriler["cboxIndir"])) {
          $cboxIndir = $this->tabloAdlari[$veriler["dataIndex"]].".".$uzanti;
        }


        if (isset($veriler["cboxEpostaGonder"])) {
          for ($i=0; $i < count($veriler["epostaGonderilecekKisiIdleri"]); $i++) {
            $cari = new Cariler();
            $cariEpostaAdresi = $cari->getCariEpostaAdresi(array("id"=>$veriler["epostaGonderilecekKisiIdleri"][$i]));
            if ($cariEpostaAdresi == null || $cariEpostaAdresi == "") {
              $epostaAdresiOlmayanlar[] = $cari->getCariAdi(array("id"=>$veriler["epostaGonderilecekKisiIdleri"][$i]));
              $yanit = "E-posta adresi sistemde bulunamadı!";
            }else {
              $epostaAdresleri[] = $cariEpostaAdresi;
            }
            $calisan = null;
          }
          require $this->yolPhp.'mail/class.phpmailer.php';
          for ($i=0; $i < count($epostaAdresleri); $i++) {
            $mail = new PHPMailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl'; // SSL sertifikanız var ise Güvenli baglanti icin ssl satırını kullanmalısınız. SSL sertifikanız yok ise bu satırı kaldırmalısınız. Gmail , hotmail gibi mail adreslerini kullanmanız durumunda SSL kısmını TLS olarak ayarlamalısınız
            $mail->Host = "smtp.gmail.com"; // Mail host adresiniz
            $mail->Port = 465; // Standart olarak kullanmanılması gereken port. Eğer ssl sertifikası kullanıyorsanız port olarak 465 girmelisiniz.
            $mail->IsHTML(true);
            $mail->SetLanguage("tr", "phpmailer/language");
            $mail->CharSet  ="utf-8";
            $mail->Username = "burhanozkan99@gmail.com"; // Mail adresimizin kullanicı adi
            $mail->Password = "broozkan58."; // Mail adresinizin şifresi
            $mail->SetFrom("burhanozkan99@gmail.com", "Burhan Özkan"); // Mail attigimizda gorulecek ismimiz
            $mail->AddAddress($epostaAdresleri[$i]); // Maili gonderecegimiz kisi yani alici
            $mail->Subject = "Veriler"; // Konu basligi
            $mail->AddAttachment(
              $this->yolPhp.'documents/'.$this->tabloAdlari[$veriler["dataIndex"]].'.'.$uzanti.'',
              ''.$this->tabloAdlari[$veriler["dataIndex"]].'.'.$uzanti.'',
              'base64',
              'mime/type'
            );
            $mail->Body =  "
            </br>
            </br>
            </br>
            </br>
            Bu e-posta <a href='https://brosoft.com.tr/'>Brosoft Barista Pos</a> ile hazırlanıp gönderilmiştir.";

            if(!$mail->Send())
            {
              $yanit = false;
            }else {
              $yanit = true;
            }
          }

        }
      }

      echo json_encode(array(
        "yanit"=>$yanit,
        "cboxIndir"=>$cboxIndir,
        "epostaAdresiOlmayanlar"=>$epostaAdresiOlmayanlar
      ));
    }
  }

  public function dataDelete()
  {
    $model = new Model();
    $result = $model->deleteQuery($this->tabloAdlari[0],$this->values);
    return $result;
    $model = null;
  }

  public function datasearch()
  {
    if ($_POST["dataSearch"]) {
      $veriler = json_decode($_POST["dataSearch"],true);
      $model = new Model();
      $tablo = $this->searchTabloAdlari[$veriler["dataTabloIndex"]];
      $kolonArray = array("id",$this->searchKolonAdlari[$veriler["dataKolonIndex"]]);
      $veriKolonArray = array($this->searchKolonAdlari[$veriler["dataKolonIndex"]]=>$veriler["girilenDeger"]);
      $result = $model->selectLikeQuery($tablo,$kolonArray,$veriKolonArray);
      echo json_encode(array(
        "sonuclar"=>$result,
        "kolonAdi"=>$this->searchKolonAdlari[$veriler["dataKolonIndex"]]
      ));
    }
  }



  public function parolaKontrol($parola,$parolaTekrar)
  {

    if ($parola == $parolaTekrar) {
      if (strlen($parola) > 6) {
        if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $parola))
        {
          return "true";
        }else {
          return "Parola nümerik (sayısal) karakter içermelidir!";
        }
      }else {
        return "Parola 6 karakterden uzun olmalıdır!";
      }
    }else {
      return "Parolalar uyuşmuyor!";
    }

  }

  public function pinKontrol($pin,$pinTekrar)
  {

    if ($pin == $pinTekrar) {
      if (strlen($pin) > 3) {
        if (is_numeric($pin))
        {
          return "true";
        }else {
          return "Pin sadece nümerik (sayısal) olmalıdır!";
        }
      }else {
        return "Pin en az 4 karakterden oluşmalıdır!";
      }
    }else {
      return "Pinler uyuşmuyor!";
    }

  }

  public function kullaniciAdiKontrol($kullaniciAdi)
  {
    $calisan = new Calisanlar();
    $calisanMevcutKullaniciAdi = $calisan->getCalisanKullaniciAdi(array("id"=>$_SESSION["uid"]));

    if ($calisanMevcutKullaniciAdi == $kullaniciAdi) {
      return "true";
    }else {
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT id FROM tbl_calisanlar WHERE calisan_kullanici_adi=:calisan_kullanici_adi");
      $stmt->execute(['calisan_kullanici_adi'=>$kullaniciAdi]);
      $eslesenKullaniciAdi = $stmt->fetch();
      if ($eslesenKullaniciAdi) {
        return "false";
      }else {
        return "true";
      }
    }
    $calisan = null;
  }

  public function siparisFisiDosyasiOlustur($adisyonIdsi,$yazdirilacakUrunBilgileri)
  {
    $yazdirmaBilgileri = array();
    for ($i=0; $i < count($yazdirilacakUrunBilgileri); $i++) {
      if (!$yazdirilacakUrunBilgileri) {
        return false;
      }
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.id,tbl_masalar.masa_adi,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_tablo_adi,tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi,tbl_menuler.menu_adi,
        tbl_adisyon_urunleri.adisyon_urunleri_urun_notu,tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati,tbl_urunler.urun_adi,tbl_alt_urunler.alt_urun_adi  FROM tbl_adisyonlar LEFT JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
        INNER JOIN tbl_adisyon_urunleri ON tbl_adisyonlar.id=tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi
        LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
        LEFT JOIN tbl_alt_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_alt_urunler.id
        LEFT JOIN tbl_menuler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_menuler.id
        WHERE tbl_adisyonlar.id=:adisyon_idsi AND tbl_adisyon_urunleri.id=:adisyon_urunu_idsi"
      );


      $stmt->execute([
        'adisyon_idsi'=>$adisyonIdsi,
        'adisyon_urunu_idsi'=>$yazdirilacakUrunBilgileri[$i]["urun_adisyon_idsi"]
      ]);
      $yazdirmaBilgileri[] = $stmt->fetch();
    }

    $header = "Personel:      ".$_SESSION["kullaniciAdiSoyadi"]."";
    $header .= "\nMasa Adi:   ".$yazdirmaBilgileri[0]["masa_adi"];
    $header .= "\n----------------------------";
    $body = "";
    for ($i=0; $i < count($yazdirmaBilgileri); $i++) {
      $yazdirmaBilgileri[$i]["adisyon_urunleri_urun_siparis_saati"] = $this->fixDateTime($yazdirmaBilgileri[$i]["adisyon_urunleri_urun_siparis_saati"]);

      if ($yazdirmaBilgileri[$i]["urun_adi"]) {
        $body .= "\nUrun adi : ".$yazdirmaBilgileri[$i]["urun_adi"];
      }elseif ($yazdirmaBilgileri[$i]["menu_adi"]) {
        $body .= "\nUrun adi : ".$yazdirmaBilgileri[$i]["menu_adi"];
      }else {
        $body .= "\nUrun adi : ".$yazdirmaBilgileri[$i]["alt_urun_adi"];
      }
      $body .= "\nUrun adedi : ".$yazdirmaBilgileri[$i]["adisyon_urunleri_urun_adedi"];
      $body .= "\nUrun notu : ".$yazdirmaBilgileri[$i]["adisyon_urunleri_urun_notu"];
      $body .= "\nUrun siparis saati : ".$yazdirmaBilgileri[$i]["adisyon_urunleri_urun_siparis_saati"]."\n\n";
    }

    $rand = rand(10000,999999);
    $myfile = fopen($this->yolPhp."documents/fisler/".$adisyonIdsi."-".$rand.".txt", "w") or die("Unable to open file!");
    $txt = $header."\n".$body;
    fwrite($myfile, "\n". $txt);
    fclose($myfile);
    return $yazdirmaBilgileri[0]["id"]."-".$rand.".txt";

  }

  public function iptalFisiDosyasiOlustur($adisyonIdsi,$yazdirilacakUrunBilgileri)
  {
    $yazdirmaBilgileri = array();
    for ($i=0; $i < count($yazdirilacakUrunBilgileri); $i++) {
      if (!$yazdirilacakUrunBilgileri) {
        return false;
      }
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.id,tbl_masalar.masa_adi,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_tablo_adi,tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi,
        tbl_adisyon_urunleri.adisyon_urunleri_urun_notu,tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati,tbl_urunler.urun_adi,tbl_alt_urunler.alt_urun_adi FROM tbl_adisyonlar INNER JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
        INNER JOIN tbl_adisyon_urunleri ON tbl_adisyonlar.id=tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
        LEFT JOIN tbl_alt_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_alt_urunler.id
        WHERE tbl_adisyonlar.id=:adisyon_idsi AND tbl_adisyon_urunleri.id=:adisyon_urunu_idsi"
      );
      $stmt->execute([
        'adisyon_idsi'=>$adisyonIdsi,
        'adisyon_urunu_idsi'=>$yazdirilacakUrunBilgileri[$i]["urun_adisyon_idsi"]
      ]);
      $yazdirmaBilgileri[] = $stmt->fetch();
    }
    // print_r($yazdirmaBilgileri);
    // echo "-------------------------------------";

    $header = "********** IPTAL **********";
    $header .= "\nPersonel:      Eklenecek";
    $header .= "\nMasa Adi:   ".$yazdirmaBilgileri[0]["masa_adi"];
    $header .= "\n----------------------------";
    $body = "";
    for ($i=0; $i < count($yazdirmaBilgileri); $i++) {
      $yazdirmaBilgileri[$i]["adisyon_urunleri_urun_siparis_saati"] = $this->fixDateTime($yazdirmaBilgileri[$i]["adisyon_urunleri_urun_siparis_saati"]);

      if ($yazdirmaBilgileri[$i]["urun_adi"]) {
        $body .= "\nUrun adi : ".$yazdirmaBilgileri[$i]["urun_adi"];
      }else {
        $body .= "\nUrun adi : ".$yazdirmaBilgileri[$i]["alt_urun_adi"];
      }
      $body .= "\nUrun adedi : ".$yazdirmaBilgileri[$i]["adisyon_urunleri_urun_adedi"];
      $body .= "\nUrun notu : ".$yazdirmaBilgileri[$i]["adisyon_urunleri_urun_notu"];
      $body .= "\nUrun siparis saati : ".$yazdirmaBilgileri[$i]["adisyon_urunleri_urun_siparis_saati"]."\n\n";
    }
    $footer = "********** IPTAL **********";

    $rand = rand(10000,999999);
    $myfile = fopen($this->yolPhp."documents/fisler/IPT-".$adisyonIdsi."-".$rand.".txt", "w") or die("Unable to open file!");
    $txt = $header."\n".$body."\n".$footer;
    fwrite($myfile, "\n". $txt);
    fclose($myfile);
    return $yazdirmaBilgileri[0]["id"]."-".$rand.".txt";

  }
  public function sunaDonustur($veriler,$donusturulecekPlatform,$tabloIcerigi,$dosyaAdi)
  {

    $tbody = "";
    $thead = "";

    for ($i=0; $i < count($tabloIcerigi); $i++) {
      $tabloIcerigi[$i] = array_unique($tabloIcerigi[$i]);
      $values = array_values($tabloIcerigi[$i]);
      $tbody .= "<tr>";
      for ($a=0; $a <count($values) ; $a++) {
        $tbody .= "<td>".$values[$a]."</td>";
      }
      $tbody .= "</tr>";
    }
    for ($i=0; $i < count($veriler["thead"]); $i++) {
      $thead .= "<th>".$veriler["thead"][$i]."</th>";
    }

    $html =
    "<html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <style>
    body { font-family: DejaVu Sans, sans-serif; }
    table{ width:100%; }
    table td { padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6; }
    </style>
    </head>
    <body>
    <table>
    <thead>
    <tr>".$thead."</tr>
    </thead>
    <tbody>".$tbody."</tbody>
    </table>
    </body>
    </html>";


    switch ($donusturulecekPlatform) {
      // PDF'e dönüştürülecek ise
      case 'PDF':
      $dompdf = new Dompdf();

      $dompdf->loadHtml($html);

      // (Optional) Setup the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');

      // Render the HTML as PDF
      $dompdf->render();

      // Output the generated PDF to Browser
      $yanit = file_put_contents($this->yolPhp."documents/".$dosyaAdi.".pdf", $dompdf->output());
      if ($yanit != false) {
        $yanit = true;
      }

      break;

      // Excel'e dönüştürülecek ise
      case 'EXCEL':
      require $_SERVER["DOCUMENT_ROOT"]."/PHPExcel-1.8/Classes/PHPExcel.php";

      $filename = $_SERVER["DOCUMENT_ROOT"]."/documents/".$dosyaAdi.".xls";
      $table    = $html;

      // save $table inside temporary file that will be deleted later
      $tmpfile = tempnam(sys_get_temp_dir(), 'html');
      file_put_contents($tmpfile, $table);

      // insert $table into $objPHPExcel's Active Sheet through $excelHTMLReader
      $objPHPExcel     = new PHPExcel();
      $excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
      $excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
      $objPHPExcel->getActiveSheet()->setTitle('Tablo'); // Change sheet's title if you want

      unlink($tmpfile); // delete temporary file because it isn't needed anymore

      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");;
      header("Content-Disposition: attachment;filename=$filename");
      header("Content-Transfer-Encoding: binary ");

      // Creates a writer to output the $objPHPExcel's content
      $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $yanit = $writer->save($filename);
      if ($yanit !== false) {
        $yanit = true;
      }
      break;

      default:
      // code...
      break;
    }
    return $yanit;
  }
}
