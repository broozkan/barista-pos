<?php

/**
*
*/
class Rapor extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;


  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_kurlar");
    $this->kolonAdlari = array("kur_adi","kur_isareti","kur_kisaltmasi","kur_aktif_mi");

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT kur_isareti FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $this->varsayilanKurIsareti = $stmt->fetch()["kur_isareti"];
      $model = null;
    }
  }


  /*GEÇMİŞ ADİSYON İNCELE SAYFASI KODLARI*/
  public function gecmisAdisyonIncele($adisyonIdsi)
  {

    $this->view->adisyonIdsi = $adisyonIdsi;
    $this->view->varsayilanKurIsareti = $this->varsayilanKurIsareti;
    $this->view->render("/merkezler/rapor/gecmis-adisyon-incele");
  }
  /*GEÇMİŞ ADİSYON İNCELE SAYFASI KODLARI*/

  /*GEÇMİŞ ADİSYONLAR SAYFASI KODLARI*/
  public function gecmisAdisyonlar()
  {
    $this->view->varsayilanKurIsareti = $this->varsayilanKurIsareti;
    $this->view->render("/merkezler/rapor/gecmis-adisyonlar");
  }
  /*GEÇMİŞ ADİSYONLAR SAYFASI KODLARI*/

  /*VERGİ GRUP RAPORU SAYFASI KODLARI*/
  public function vergiGrupRaporu()
  {
    $this->view->varsayilanKurIsareti = $this->varsayilanKurIsareti;
    $this->view->render("/merkezler/rapor/vergi-grup-raporu");
  }
  /*VERGİ GRUP RAPORU SAYFASI KODLARI*/

  /*SATIŞ TİPİ RAPORU SAYFASI KODLARI*/
  public function satisTipiRaporu()
  {
    $this->view->varsayilanKurIsareti = $this->varsayilanKurIsareti;
    $this->view->render("/merkezler/rapor/satis-tipi-raporu");
  }
  /*SATIŞ TİPİ RAPORU SAYFASI KODLARI*/

  /*ÜRÜN RAPORU SAYFASI KODLARI*/
  public function urunRaporu()
  {
    $this->view->varsayilanKurIsareti = $this->varsayilanKurIsareti;
    $this->view->render("/merkezler/rapor/urun-raporu");
  }
  /*ÜRÜN RAPORU SAYFASI KODLARI*/

  /*ÇALIŞAN RAPORU SAYFASI KODLARI*/
  public function calisanRaporu()
  {
    $this->view->varsayilanKurIsareti = $this->varsayilanKurIsareti;
    $this->view->render("/merkezler/rapor/calisan-raporu");
  }
  /*ÇALIŞAN RAPORU SAYFASI KODLARI*/

  /*HASILAT RAPORU SAYFASI KODLARI*/
  public function hasilatRaporu()
  {
    $this->view->varsayilanKurIsareti = $this->varsayilanKurIsareti;
    $this->view->render("/merkezler/rapor/hasilat-raporu");
  }
  /*HASILAT RAPORU SAYFASI KODLARI*/

  /*TARİH BİLGİLERİNİ AL KODLARI*/
  public function tarihBilgileriniAl()
  {
    if (isset($_POST["tarihBilgileriniAl"])) {
      switch ($_POST["tarihBilgileriniAl"]) {
        case '0':
        $baslangicTarihi = date('Y-m-d',strtotime("-1 days"));
        $bitisTarihi =  date('Y-m-d');
        break;
        case '1':
        $baslangicTarihi = date('Y-m-d');
        $bitisTarihi =  date('Y-m-d',strtotime("+1 days"));

        break;
        case '2':
        $baslangicTarihi = date('Y-m-d',strtotime("-7 days"));
        $bitisTarihi =  date('Y-m-d',strtotime("+1 days"));

        break;
        case '3':
        $baslangicTarihi = date('Y-m-d',strtotime("-1 month"));
        $bitisTarihi =  date('Y-m-d',strtotime("+1 days"));

        break;

        default:
        // code...
        break;
      }

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT program_baslangic_saati,program_bitis_saati FROM tbl_program_ayarlari WHERE id=(SELECT MAX(id) FROM tbl_program_ayarlari)");
      $stmt->execute();
      $saatler = $stmt->fetch();
      $baslangicSaati = $saatler["program_baslangic_saati"];
      $bitisSaati = $saatler["program_bitis_saati"];
      echo json_encode(array(
        "baslangicTarihi"=>$baslangicTarihi,
        "bitisTarihi"=>$bitisTarihi,
        "baslangicSaati"=>$baslangicSaati,
        "bitisSaati"=>$bitisSaati
      ));

    }
  }
  /*TARİH BİLGİLERİNİ AL KODLARI*/


  /*GEÇMİŞ ADiSYONLARI AL KODLARI*/
  public function gecmisAdisyonlariAl()
  {
    if (isset($_POST["gecmisAdisyonlariAl"])) {
      $veriler = json_decode($_POST["gecmisAdisyonlariAl"],true);

      $model = new Model();

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      if (@$veriler["txtCalisanIdsi"]) {
        $model = new Model();
        $stmt = $model->dbh->prepare(
          "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyonlar.adisyon_tutari,tbl_adisyonlar.adisyon_tarihi,tbl_calisanlar.calisan_adi_soyadi
          FROM tbl_adisyonlar
          INNER JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_garson_idsi=tbl_calisanlar.id
          WHERE adisyon_garson_idsi=:calisan_idsi AND adisyon_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
        );
        $stmt->execute([
          'calisan_idsi'=>$veriler["txtCalisanIdsi"],
          'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
          'bitis_tarihi'=>$veriler["txtBitisTarihi"]
        ]);
        $gecmisAdisyonlar = $stmt->fetchAll();
      }else {
        $model = new Model();
        $stmt = $model->dbh->prepare(
          "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyonlar.adisyon_tutari,tbl_adisyonlar.adisyon_tarihi,tbl_calisanlar.calisan_adi_soyadi
          FROM tbl_adisyonlar
          INNER JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_garson_idsi=tbl_calisanlar.id
          WHERE adisyon_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
        );
        $stmt->execute([
          'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
          'bitis_tarihi'=>$veriler["txtBitisTarihi"]
        ]);
        $gecmisAdisyonlar = $stmt->fetchAll();

      }

      for ($i=0; $i < count($gecmisAdisyonlar); $i++) {
        $gecmisAdisyonlar[$i]["adisyon_tarihi"] = $this->fixDateTime($gecmisAdisyonlar[$i]["adisyon_tarihi"]);
      }

      echo json_encode(array(
        "gecmisAdisyonlar"=>$gecmisAdisyonlar
      ));
    }
  }
  /*GEÇMİŞ ADiSYONLARI AL KODLARI*/

  /*ÜRÜN RAPORU BİLGİLERİNİ AL KODLARI*/
  public function urunRaporunuAl()
  {
    if (isset($_POST["urunRaporunuAl"])) {
      $veriler = json_decode($_POST["urunRaporunuAl"],true);

      $model = new Model();

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      if (@$veriler["txtUrunIdsi"]) {
        $stmt = $model->dbh->prepare(
          "SELECT SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi) AS urun_toplam_adedi,SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati) AS urun_toplam_fiyati,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,
          tbl_urunler.urun_adi,tbl_alt_urunler.alt_urun_adi,tbl_menuler.menu_adi
          FROM `tbl_adisyon_urunleri`
          LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
          LEFT JOIN tbl_alt_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_alt_urunler.id
          LEFT JOIN tbl_menuler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_menuler.id
          WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati BETWEEN :baslangic_tarihi AND :bitis_tarihi AND tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=:urun_idsi AND tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durum_idsi=0
          GROUP BY adisyon_urunleri_urun_idsi"
        );
        $stmt->execute([
          "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
          "bitis_tarihi"=>$veriler["txtBitisTarihi"],
          "urun_idsi"=>$veriler["txtUrunIdsi"]
        ]);
        $urunAdetVeFiyatBilgileri = $stmt->fetchAll();
      }else {
        $stmt = $model->dbh->prepare(
          "SELECT SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi) AS urun_toplam_adedi,SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati) AS urun_toplam_fiyati,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,
          tbl_urunler.urun_adi,tbl_alt_urunler.alt_urun_adi,tbl_menuler.menu_adi
          FROM `tbl_adisyon_urunleri`
          LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
          LEFT JOIN tbl_alt_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_alt_urunler.id
          LEFT JOIN tbl_menuler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_menuler.id
          WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durumu_idsi=0 AND tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati BETWEEN :baslangic_tarihi AND :bitis_tarihi
          GROUP BY adisyon_urunleri_urun_idsi"
        );
        $stmt->execute([
          "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
          "bitis_tarihi"=>$veriler["txtBitisTarihi"]
        ]);
        $urunAdetVeFiyatBilgileri = $stmt->fetchAll();

      }

      $stmt = $model->dbh->prepare(
        "SELECT SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi) AS urun_toplam_adedi,SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati) AS urun_toplam_fiyati,tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durumu_idsi
        FROM `tbl_adisyon_urunleri`
        WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durumu_idsi<>0 AND tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati BETWEEN :baslangic_tarihi AND :bitis_tarihi
        GROUP BY tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durumu_idsi"
      );
      $stmt->execute([
        "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
        "bitis_tarihi"=>$veriler["txtBitisTarihi"]
      ]);
      $iptalVeIkramAdetleri = $stmt->fetchAll();



      echo json_encode(array(
        "urunAdetVeFiyatBilgileri"=>$urunAdetVeFiyatBilgileri,
        "iptalVeIkramAdetleri"=>$iptalVeIkramAdetleri
      ));
    }
  }
  /*ÜRÜN RAPORU BİLGİLERİNİ AL KODLARI*/


  /*ÇALIŞAN RAPORU BİLGİLERİNİ AL KODLARI*/
  public function calisanRaporunuAl()
  {
    if (isset($_POST["calisanRaporunuAl"])) {
      $veriler = json_decode($_POST["calisanRaporunuAl"],true);

      $model = new Model();
      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      if (@$veriler["txtCalisanIdsi"]) {
        $stmt = $model->dbh->prepare(
          "SELECT SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi) AS urun_toplam_adedi,SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati) AS urun_toplam_fiyati,tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi,tbl_calisanlar.calisan_adi_soyadi
          FROM `tbl_adisyon_urunleri`
          INNER JOIN tbl_calisanlar ON tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi=tbl_calisanlar.id
          WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati BETWEEN :baslangic_tarihi AND :bitis_tarihi
          AND tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi=:calisan_idsi
          AND tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durumu_idsi=0
          GROUP BY tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi"
        );
        $stmt->execute([
          "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
          "bitis_tarihi"=>$veriler["txtBitisTarihi"],
          "calisan_idsi"=>$veriler["txtCalisanIdsi"]
        ]);
        $calisanAdetVeFiyatBilgileri = $stmt->fetchAll();
      }else {
        $stmt = $model->dbh->prepare(
          "SELECT SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi) AS urun_toplam_adedi,SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati) AS urun_toplam_fiyati,tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi,tbl_calisanlar.calisan_adi_soyadi
          FROM `tbl_adisyon_urunleri`
          INNER JOIN tbl_calisanlar ON tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi=tbl_calisanlar.id
          WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati BETWEEN :baslangic_tarihi AND :bitis_tarihi
          AND tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durumu_idsi=0
          GROUP BY tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi"
        );
        $stmt->execute([
          "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
          "bitis_tarihi"=>$veriler["txtBitisTarihi"]
        ]);
        $calisanAdetVeFiyatBilgileri = $stmt->fetchAll();

      }


      echo json_encode(array(
        "calisanAdetVeFiyatBilgileri"=>$calisanAdetVeFiyatBilgileri
      ));


    }
  }
  /*ÇALIŞAN RAPORU BİLGİLERİNİ AL KODLARI*/


  /*HASILAT RAPORU BİLGİLERİNİ AL KODLARI*/
  public function hasilatRaporunuAl()
  {
    if (isset($_POST["hasilatRaporunuAl"])) {
      $veriler = json_decode($_POST["hasilatRaporunuAl"],true);

      $model = new Model();

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];


      $stmt = $model->dbh->prepare(
        "SELECT SUM(tbl_adisyon_odemeleri.adisyon_odemesi_odeme_miktari) AS toplam_miktar,tbl_odeme_metodlari.odeme_metod_adi
        FROM tbl_adisyon_odemeleri
        INNER JOIN tbl_odeme_metodlari ON tbl_adisyon_odemeleri.adisyon_odemesi_odeme_metodu_idsi=tbl_odeme_metodlari.id
        WHERE tbl_adisyon_odemeleri.adisyon_odemesi_odeme_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi
        GROUP BY tbl_adisyon_odemeleri.adisyon_odemesi_odeme_metodu_idsi"
      );
      $stmt->execute([
        "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
        "bitis_tarihi"=>$veriler["txtBitisTarihi"]
      ]);
      $hasilatBilgileri = $stmt->fetchAll();



      echo json_encode(array(
        "hasilatBilgileri"=>$hasilatBilgileri
      ));


    }
  }
  /*HASILAT RAPORU BİLGİLERİNİ AL KODLARI*/


  /*VERGİ GRUP RAPORU BİLGİLERİNİ AL KODLARI*/
  public function vergiGrupRaporunuAl()
  {
    if (isset($_POST["vergiGrupRaporunuAl"])) {
      $veriler = json_decode($_POST["vergiGrupRaporunuAl"],true);

      $model = new Model();

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];


      $stmt = $model->dbh->prepare(
        "SELECT SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati) AS vergi_toplam_fiyati,tbl_vergiler.vergi_adi FROM tbl_adisyon_urunleri INNER JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
        INNER JOIN tbl_vergiler ON tbl_urunler.urun_satis_vergi_idsi=tbl_vergiler.id
        WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_siparis_saati BETWEEN :baslangic_tarihi AND :bitis_tarihi
        AND tbl_adisyon_urunleri.adisyon_urunleri_urun_ozel_durumu_idsi=0
        GROUP BY tbl_vergiler.vergi_adi"
      );
      $stmt->execute([
        "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
        "bitis_tarihi"=>$veriler["txtBitisTarihi"]
      ]);
      $kdvGrupBilgileri = $stmt->fetchAll();



      echo json_encode(array(
        "kdvGrupBilgileri"=>$kdvGrupBilgileri
      ));


    }
  }
  /*VERGİ GRUP RAPORU BİLGİLERİNİ AL KODLARI*/


  /*SATIŞ TİPİ RAPORU BİLGİLERİNİ AL KODLARI*/
  public function satisTipiRaporunuAl()
  {
    if (isset($_POST["satisTipiRaporunuAl"])) {
      $veriler = json_decode($_POST["satisTipiRaporunuAl"],true);

      $model = new Model();

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];


      $stmt = $model->dbh->prepare(
        "SELECT SUM(tbl_adisyonlar.adisyon_tutari) AS toplam_miktar,tbl_adisyonlar.adisyon_masa_idsi
        FROM tbl_adisyonlar
        WHERE tbl_adisyonlar.adisyon_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi
        GROUP BY tbl_adisyonlar.adisyon_masa_idsi"
      );
      $stmt->execute([
        "baslangic_tarihi"=>$veriler["txtBaslangicTarihi"],
        "bitis_tarihi"=>$veriler["txtBitisTarihi"]
      ]);
      $satisTipiBilgileri = $stmt->fetchAll();



      echo json_encode(array(
        "satisTipiBilgileri"=>$satisTipiBilgileri
      ));


    }
  }
  /*SATIŞ TİPİ RAPORU BİLGİLERİNİ AL KODLARI*/

}
