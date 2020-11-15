<?php

/**
*
*/
class Ayarlar extends Controller
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

  /*YAZDIRMA AYARLARI SAYFASI*/
  public function yazdirmaAyarlari()
  {
    if (isset($_POST["yazdirmaAyarlariniKaydet"])) {
      $veriler = json_decode($_POST["yazdirmaAyarlariniKaydet"],true);
      $model = new Model();
      $stmt = $model->dbh->prepare("DELETE FROM tbl_yazdirma_ayarlari");
      $yanit = $stmt->execute();
      if ($yanit) {
        $stmt = $model->dbh->prepare(
          "INSERT INTO tbl_yazdirma_ayarlari SET
          yazdirma_ayarlari_masa_adi_gorunsun_mu=:yazdirma_ayarlari_masa_adi_gorunsun_mu,
          yazdirma_ayarlari_adisyon_no_gorunsun_mu=:yazdirma_ayarlari_adisyon_no_gorunsun_mu,
          yazdirma_ayarlari_musteri_adi_gorunsun_mu=:yazdirma_ayarlari_musteri_adi_gorunsun_mu,
          yazdirma_ayarlari_adisyon_alt_yazi=:yazdirma_ayarlari_adisyon_alt_yazi,
          yazdirma_ayarlari_paket_servis_yazicisi_idsi=:yazdirma_ayarlari_paket_servis_yazicisi_idsi,
          yazdirma_ayarlari_hizli_satis_oto_yazdir=:yazdirma_ayarlari_hizli_satis_oto_yazdir"
        );
        $yanit = $stmt->execute([
          "yazdirma_ayarlari_masa_adi_gorunsun_mu"=>$veriler["txtMasaAdiGorunsunMu"],
          "yazdirma_ayarlari_adisyon_no_gorunsun_mu"=>$veriler["txtAdisyonNoGorunsunMu"],
          "yazdirma_ayarlari_musteri_adi_gorunsun_mu"=>$veriler["txtMusteriAdiGorunsunMu"],
          "yazdirma_ayarlari_adisyon_alt_yazi"=>$veriler["txtAdisyonAltYazi"],
          "yazdirma_ayarlari_paket_servis_yazicisi_idsi"=>$veriler["txtPaketServisYazicisiIdsi"],
          "yazdirma_ayarlari_hizli_satis_oto_yazdir"=>$veriler["txtHizliSatisOtoYazdir"]
        ]);

        echo json_encode(array(
          "yanit"=>$yanit
        ));

      }

    }else {

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazdirma_ayarlari WHERE (SELECT MAX(id) FROM tbl_yazdirma_ayarlari)");
      $stmt->execute();
      $yazdirmaAyarlari = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
      $stmt->execute();
      $yazicilar = $stmt->fetchAll();

      $this->view->yazicilar = $yazicilar;
      $this->view->yazdirmaAyarlari = $yazdirmaAyarlari;
      $this->view->render("ayarlar/yazdirma-ayarlari");
    }
  }
  /*YAZDIRMA AYARLARI SAYFASI*/

  /*OKC AYARLARI SAYFASI*/
  public function departmanTanimlama()
  {
    $this->view->render("ayarlar/departman-tanimlama");
  }
  /*OKC AYARLARI SAYFASI*/

  /*ÖKC BİLGİLERİNİ ALMA KODLARI*/
  public function okcBilgileriniAl()
  {
    if (isset($_POST["okcBilgileriniAl"])) {

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_okc_bilgileri WHERE (SELECT MAX(id) FROM tbl_okc_bilgileri)");
      $stmt->execute();
      $okcBilgileri = $stmt->fetch();

      echo json_encode(array(
        "okcBilgileri"=>$okcBilgileri
      ));

    }
  }
  /*ÖKC BİLGİLERİNİ ALMA KODLARI*/

  /*OKC BİLGİLERİ SAYFASI*/
  public function okcBilgileri()
  {
    if (isset($_POST["okcBilgileriniKaydet"])) {
      $veriler = json_decode($_POST["okcBilgileriniKaydet"],true);
      $okcBilgileri = new OkcBilgileri();
      $okcBilgileri->setOkcBilgileriOkcAktifMi($veriler["txtOkcAktifMi"]);
      $okcBilgileri->setOkcBilgileriPortAdi($veriler["txtOkcPortAdi"]);
      $okcBilgileri->setOkcBilgileriBaudRate($veriler["txtOkcBaudrate"]);
      $okcBilgileri->setOkcBilgileriFiscalIdsi($veriler["txtOkcFiscalIdsi"]);



      $model = new Model();
      $stmt = $model->dbh->prepare("DELETE FROM tbl_okc_bilgileri");
      $stmt->execute();

      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_okc_bilgileri SET
        okc_bilgileri_okc_aktif_mi=:okc_bilgileri_okc_aktif_mi,
        okc_bilgileri_port_adi=:okc_bilgileri_port_adi,
        okc_bilgileri_baudrate=:okc_bilgileri_baudrate,
        okc_bilgileri_fiscal_idsi=:okc_bilgileri_fiscal_idsi"
      );

      $yanit = $stmt->execute([
        "okc_bilgileri_okc_aktif_mi"=>$okcBilgileri->okcBilgileriOkcAktifMi,
        "okc_bilgileri_port_adi"=>$okcBilgileri->okcBilgileriPortAdi,
        "okc_bilgileri_baudrate"=>$okcBilgileri->okcBilgileriBaudRate,
        "okc_bilgileri_fiscal_idsi"=>$okcBilgileri->okcBilgileriFiscalIdsi
      ]);
      $model = null;

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }else {
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_okc_bilgileri WHERE (SELECT MAX(id) FROM tbl_okc_bilgileri)");
      $stmt->execute();
      $okcBilgileri = $stmt->fetch();

      $this->view->okcBilgileri = $okcBilgileri;
      $this->view->render("ayarlar/okc-bilgileri");
    }

  }
  /*OKC BİLGİLERİ SAYFASI*/


  /*PROGRAM AYARLARI SAYFASI*/
  public function programAyarlari()
  {
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_program_ayarlari");
    $stmt->execute();
    $programAyarlari = $stmt->fetch();
    if (!$programAyarlari) {
      $programAyarlari = array(
        "caller_id_aktif_mi"=>0,
        "yazarkasa_aktif_mi"=>0,
        "yemeksepeti_aktif_mi"=>0,
        "program_baslangic_saati"=>"",
        "program_bitis_saati"=>""
      );
    }

    $this->view->programAyarlari = $programAyarlari;
    $this->view->render("ayarlar/program-ayarlari");
  }
  /*PROGRAM AYARLARI SAYFASI*/

  /*PROGRAM AYARLARINI KAYDET KODLARI*/
  public function programAyarlariniKaydet()
  {
    if (isset($_POST["programAyarlariniKaydet"])) {
      $veriler = json_decode($_POST["programAyarlariniKaydet"],true);

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT MAX(id) AS id FROM tbl_program_ayarlari");
      $stmt->execute();
      $id = $stmt->fetch()["id"];

      $program = new Program();
      $program->programAyarlari = new ProgramAyarlari();

      $program->programAyarlari->setProgramCallerIdAktifMi($veriler["txtCallerId"]);
      $program->programAyarlari->setProgramYazarkasaAktifMi($veriler["txtYazarKasaPos"]);
      $program->programAyarlari->setProgramYemeksepetiAktifMi($veriler["txtYemekSepeti"]);
      $program->programAyarlari->setProgramBaslangicSaati($veriler["txtProgramBaslangicSaati"]);
      $program->programAyarlari->setProgramBitisSaati($veriler["txtProgramBitisSaati"]);

      if ($id) {
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_program_ayarlari SET
          caller_id_aktif_mi=:caller_id_aktif_mi,
          yazarkasa_aktif_mi=:yazarkasa_aktif_mi,
          yemeksepeti_aktif_mi=:yemeksepeti_aktif_mi,
          program_baslangic_saati=:program_baslangic_saati,
          program_bitis_saati=:program_bitis_saati
          WHERE id=:id"
        );
        $yanit = $stmt->execute([
          'caller_id_aktif_mi'=>$program->programAyarlari->programCallerIdAktifMi,
          'yazarkasa_aktif_mi'=>$program->programAyarlari->programYazarkasaAktifMi,
          'yemeksepeti_aktif_mi'=>$program->programAyarlari->programYemeksepetiAktifMi,
          'program_baslangic_saati'=>$program->programAyarlari->programBaslangicSaati,
          'program_bitis_saati'=>$program->programAyarlari->programBitisSaati,
          'id'=>$id
        ]);
      }else {
        $stmt = $model->dbh->prepare(
          "INSERT INTO tbl_program_ayarlari SET
          caller_id_aktif_mi=:caller_id_aktif_mi,
          yazarkasa_aktif_mi=:yazarkasa_aktif_mi,
          yemeksepeti_aktif_mi=:yemeksepeti_aktif_mi,
          program_baslangic_saati=:program_baslangic_saati,
          program_bitis_saati=:program_bitis_saati"
        );
        $yanit = $stmt->execute([
          'caller_id_aktif_mi'=>$program->programAyarlari->programCallerIdAktifMi,
          'yazarkasa_aktif_mi'=>$program->programAyarlari->programYazarkasaAktifMi,
          'yemeksepeti_aktif_mi'=>$program->programAyarlari->programYemeksepetiAktifMi,
          'program_baslangic_saati'=>$program->programAyarlari->programBaslangicSaati,
          'program_bitis_saati'=>$program->programAyarlari->programBitisSaati
        ]);
      }
      $model = null;
      $program = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*PROGRAM AYARLARINI KAYDET KODLARI*/

  /*PROFİL AYARLARI SAYFASI*/
  public function profilAyarlari()
  {
    $model = new Model();
    /*çalışan bilgileri alma*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_calisanlar WHERE id=:calisan_idsi");
    $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
    $calisanBilgileri = $stmt->fetch();
    /*çalışan bilgileri alma*/

    /*yazıcıları alma*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
    $stmt->execute();
    $yazicilar = $stmt->fetchAll();
    /*yazıcıları alma*/


    $this->view->yazicilar = $yazicilar;
    $this->view->calisanBilgileri = $calisanBilgileri;
    $this->view->render("ayarlar/profil-ayarlari");
  }
  /*PROFİL AYARLARI SAYFASI*/


  /*VARSAYILANLARI DEĞİŞTİME KODLARI*/
  public function varsayilanlariDegistir()
  {
    if (isset($_POST["varsayilanlariDegistir"])) {
      $veriler = json_decode($_POST["varsayilanlariDegistir"],true);

      $model = new Model();
      $calisan = new Calisanlar();
      $calisan->setCalisanAdisyonYaziciIdsi($veriler["txtCalisanAdisyonYaziciIdsi"]);
      $calisan->setCalisanPaketServisYaziciIdsi($veriler["txtCalisanPaketServisYaziciIdsi"]);
      $calisan->setCalisanHizliSatisYaziciIdsi($veriler["txtCalisanHizliSatisYaziciIdsi"]);

      $stmt = $model->dbh->prepare("UPDATE tbl_calisanlar SET
        calisan_adisyon_yazici_idsi=:calisan_adisyon_yazici_idsi,
        calisan_paket_servis_yazici_idsi=:calisan_paket_servis_yazici_idsi,
        calisan_hizli_satis_yazici_idsi=:calisan_hizli_satis_yazici_idsi
        WHERE id=:calisan_idsi");
      $yanit = $stmt->execute([
        'calisan_adisyon_yazici_idsi'=>$calisan->calisanAdisyonYaziciIdsi,
        'calisan_paket_servis_yazici_idsi'=>$calisan->calisanPaketServisYaziciIdsi,
        'calisan_hizli_satis_yazici_idsi'=>$calisan->calisanHizliSatisYaziciIdsi,
        'calisan_idsi'=>$_SESSION["uid"]
      ]);

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*VARSAYILANLARI DEĞİŞTİME KODLARI*/

  /*PAROLA DEĞİŞTİRME KODLARI*/
  public function parolaDegistir()
  {
    if (isset($_POST["parolaDegistir"])) {
      $veriler = json_decode($_POST["parolaDegistir"],true);

      $model = new Model();
      $calisan = new Calisanlar();
      $stmt = $model->dbh->prepare("SELECT calisan_parolasi FROM tbl_calisanlar WHERE id=:calisan_idsi");
      $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
      $calisanParolasi = $stmt->fetch()["calisan_parolasi"];

      if (md5($veriler["txtEskiParola"]) == $calisanParolasi) {
        $parolaKontrol = $this->parolaKontrol($veriler["txtYeniParola"],$veriler["txtYeniParolaTekrar"]);
        if ($parolaKontrol === true) {

          $calisan->setCalisanParolasi(md5($veriler["txtYeniParola"]));
          $stmt = $model->dbh->prepare("UPDATE tbl_calisanlar SET calisan_parolasi=:calisan_parolasi WHERE id=:calisan_idsi");
          $yanit = $stmt->execute([
            'calisan_parolasi'=>$calisan->calisanParolasi,
            'calisan_idsi'=>$_SESSION["uid"]
          ]);

        }else {
          $yanit = $parolaKontrol;
        }
      }else {
        $yanit = "Eski parolanız hatalı lütfen tekrar deneyiniz!";
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*PAROLA DEĞİŞTİRME KODLARI*/

  /*PİN DEĞİŞTİRME KODLARI*/
  public function pinDegistir()
  {
    if (isset($_POST["pinDegistir"])) {
      $veriler = json_decode($_POST["pinDegistir"],true);

      $model = new Model();
      $calisan = new Calisanlar();
      $stmt = $model->dbh->prepare("SELECT calisan_pini FROM tbl_calisanlar WHERE id=:calisan_idsi");
      $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
      $calisanPini = $stmt->fetch()["calisan_pini"];

      if (md5($veriler["txtEskiPin"]) == $calisanPini) {
        $pinKontrol = $this->pinKontrol($veriler["txtYeniPin"],$veriler["txtYeniPinTekrar"]);
        if ($pinKontrol === true) {

          $calisan->setCalisanPini(md5($veriler["txtYeniPin"]));
          $stmt = $model->dbh->prepare("UPDATE tbl_calisanlar SET calisan_pini=:calisan_pini WHERE id=:calisan_idsi");
          $yanit = $stmt->execute([
            'calisan_pini'=>$calisan->calisanPini,
            'calisan_idsi'=>$_SESSION["uid"]
          ]);

        }else {
          $yanit = $pinKontrol;
        }
      }else {
        $yanit = "Eski pininiz hatalı lütfen tekrar deneyiniz!";
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*PİN DEĞİŞTİRME KODLARI*/

  /*PROFİLİ GÜNCELLE KODLARI*/
  public function profiliGuncelle()
  {
    if (isset($_POST["profiliGuncelle"])) {
      $veriler = json_decode($_POST["profiliGuncelle"],true);

      $izin = $this->kullaniciAdiKontrol($veriler["txtCalisanKullaniciAdi"]);
      if ($izin) {
        $model = new Model();
        $calisan = new Calisanlar();


        $calisan->setCalisanIdsi($_SESSION["uid"]);

        $dosyaAdi = array();
        if (isset($_FILES["dosya"])) {
          if(file_exists($_FILES['dosya']['tmp_name']) || !is_uploaded_file($_FILES['dosya']['tmp_name'])) {
            $dosyaAdi = $_FILES["dosya"]["name"];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/calisanlar/".$dosyaAdi;
            $dosya=$_FILES["dosya"]["tmp_name"];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosyaAdi = $calisan->getCalisanProfilFotosu(array("id"=>$calisan->calisanIdsi));
          }
        }else {
          $dosyaAdi = $calisan->getCalisanProfilFotosu(array("id"=>$calisan->calisanIdsi));
        }

        $calisan->setCalisanAdiSoyadi($veriler["txtCalisanAdiSoyadi"]);
        $calisan->setCalisanAdresi($veriler["txtCalisanAdresi"]);
        $calisan->setCalisanDogumTarihi($veriler["txtCalisanDogumTarihi"]);
        $calisan->setCalisanTelefonNumarasi($veriler["txtCalisanTelefonu"]);
        $calisan->setCalisanEpostaAdresi($veriler["txtCalisanEpostaAdresi"]);
        $calisan->setCalisanProfilFotosu($dosyaAdi);
        $calisan->setCalisanKullaniciAdi($veriler["txtCalisanKullaniciAdi"]);
        $calisan->setCalisanHizliNotlari(json_encode($veriler["txtCalisanHizliNotlari"]));


        $stmt = $model->dbh->prepare(
          "UPDATE tbl_calisanlar SET
          calisan_adi_soyadi=:calisan_adi_soyadi,
          calisan_adresi=:calisan_adresi,
          calisan_dogum_tarihi=:calisan_dogum_tarihi,
          calisan_telefon_numarasi=:calisan_telefon_numarasi,
          calisan_eposta_adresi=:calisan_eposta_adresi,
          calisan_profil_fotosu=:calisan_profil_fotosu,
          calisan_kullanici_adi=:calisan_kullanici_adi,
          calisan_hizli_notlari=:calisan_hizli_notlari
          WHERE id=:id"
        );
        $yanit = $stmt->execute([
          'calisan_adi_soyadi'=>$calisan->calisanAdiSoyadi,
          'calisan_adresi'=>$calisan->calisanAdresi,
          'calisan_dogum_tarihi'=>$calisan->calisanDogumTarihi,
          'calisan_telefon_numarasi'=>$calisan->calisanTelefonNumarasi,
          'calisan_eposta_adresi'=>$calisan->calisanEpostaAdresi,
          'calisan_profil_fotosu'=>$calisan->calisanProfilFotosu,
          'calisan_kullanici_adi'=>$calisan->calisanKullaniciAdi,
          'calisan_hizli_notlari'=>$calisan->calisanHizliNotlari,
          'id'=>$calisan->calisanIdsi
        ]);
      }else {
        $yanit = "Kullanıcı adı başkası tarafından kullanılmaktadır!";
      }


      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }


  }
  /*PROFİLİ GÜNCELLE KODLARI*/

  /*ŞİRKET AYARLARI SAYFASI*/
  public function sirketAyarlari()
  {
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_sirket");
    $stmt->execute();
    $sirketBilgileri = $stmt->fetch();

    $this->view->sirketBilgileri = $sirketBilgileri;
    $this->view->render("ayarlar/sirket-ayarlari");
  }
  /*ŞİRKET AYARLARI SAYFASI*/

  /*ŞİRKET AYARLARINI KAYDET KODLARI*/
  public function sirketBilgileriniKaydet()
  {
    if (isset($_POST["sirketBilgileriniKaydet"])) {
      $veriler = json_decode($_POST["sirketBilgileriniKaydet"],true);
      $model = new Model();
      $sirket = new Sirket();

      $stmt = $model->dbh->prepare("SELECT MAX(id) AS id FROM tbl_sirket");
      $stmt->execute();
      $id = $stmt->fetch()["id"];

      $sirket->setSirketIdsi($id);

      $dosyaAdi = array();
      if (isset($_FILES["dosya"])) {
        if(file_exists($_FILES['dosya']['tmp_name']) || !is_uploaded_file($_FILES['dosya']['tmp_name'])) {
          $dosyaAdi = $_FILES["dosya"]["name"];
          $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/logolar/".$dosyaAdi;
          $dosya=$_FILES["dosya"]["tmp_name"];
          if(move_uploaded_file($dosya,$hedefDizin)){
            $yanit = true;
          }else{
            $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
          }
        }else {
          $dosyaAdi = $sirket->getSirketLogosu(array("id"=>$sirket->sirketIdsi));
        }
      }else {
        $dosyaAdi = $sirket->getSirketLogosu(array("id"=>$sirket->sirketIdsi));
      }

      $sirket->setSirketAdi($veriler["txtSirketAdi"]);
      $sirket->setSirketAdresi($veriler["txtSirketAdresi"]);
      $sirket->setSirketEpostaAdresi($veriler["txtSirketEpostaAdresi"]);
      $sirket->setSirketTelefonu($veriler["txtSirketTelefonu"]);
      $sirket->setSirketVergiNumarasi($veriler["txtSirketVergiNumarasi"]);
      $sirket->setSirketLogosu($dosyaAdi);

      $stmt = $model->dbh->prepare(
        "UPDATE tbl_sirket SET
        sirket_adi=:sirket_adi,
        sirket_adresi=:sirket_adresi,
        sirket_eposta_adresi=:sirket_eposta_adresi,
        sirket_telefonu=:sirket_telefonu,
        sirket_vergi_numarasi=:sirket_vergi_numarasi,
        sirket_logosu=:sirket_logosu
        WHERE id=:id"
      );
      $yanit = $stmt->execute([
        'sirket_adi'=>$sirket->sirketAdi,
        'sirket_adresi'=>$sirket->sirketAdresi,
        'sirket_eposta_adresi'=>$sirket->sirketEpostaAdresi,
        'sirket_telefonu'=>$sirket->sirketTelefonu,
        'sirket_vergi_numarasi'=>$sirket->sirketVergiNumarasi,
        'sirket_logosu'=>$sirket->sirketLogosu,
        'id'=>$sirket->sirketIdsi
      ]);

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }


  }
  /*ŞİRKET AYARLARINI KAYDET KODLARI*/
}
