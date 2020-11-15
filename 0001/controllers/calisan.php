<?php

/**
 *
 */
class Calisan extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_calisanlar");
    $this->kolonAdlari = array(
      "calisan_adi_soyadi",
      "calisan_adresi",
      "calisan_dogum_tarihi",
      "calisan_telefon_numarasi",
      "calisan_eposta_adresi",
      "calisan_profil_fotosu",
      "calisan_statu_idsi",
      "calisan_kullanici_adi",
      "calisan_parolasi",
      "calisan_pini",
      "calisan_hizli_notlari",
      "calisan_indirim_turu",
      "calisan_indirim_miktari",
      "calisan_gunluk_harcama_siniri"
    );
    $this->sayfaIzınAdi = "txtCalisanEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";
    $this->view->kategoriTabloAdi = $this->tabloAdlari[0];


    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function calisanProfil($calisanIdsi = false)
  {
    $model = new Model();

    /*çalışan ana bilgileri*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_calisanlar.*,tbl_statuler.statu_adi AS calisan_statu_adi
      FROM tbl_calisanlar INNER JOIN tbl_statuler ON tbl_statuler.id=tbl_calisanlar.calisan_statu_idsi WHERE tbl_calisanlar.id=:id");
    $stmt->execute(['id'=>$calisanIdsi]);
    $calisan = $stmt->fetch();

    $calisan["calisan_dogum_tarihi"] = $this->fixDate($calisan["calisan_dogum_tarihi"]);
    /*çalışan ana bilgileri*/

    /*çalışan satış bilgileri*/
    $stmt = $model->dbh->prepare(
      "SELECT SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi) AS urun_toplam_adedi,SUM(tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati) AS urun_toplam_fiyati,tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi,tbl_calisanlar.calisan_adi_soyadi
      FROM `tbl_adisyon_urunleri`
      INNER JOIN tbl_calisanlar ON tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi=tbl_calisanlar.id
      WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi=:calisan_idsi
      GROUP BY tbl_adisyon_urunleri.adisyon_urunleri_urun_calisan_idsi"
    );
    $stmt->execute(['calisan_idsi'=>$calisanIdsi]);
    $calisanSatisBilgileri = $stmt->fetch();
    /*çalışan satış bilgileri*/

    /*çalışan tüketim bilgileri*/
    $stmt = $model->dbh->prepare(
      "SELECT SUM(tbl_adisyonlar.adisyon_odenmis_tutar) AS toplam_harcama,tbl_calisanlar.calisan_adi_soyadi
      FROM `tbl_adisyonlar`
      INNER JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_calisan_idsi=tbl_calisanlar.id
      WHERE tbl_adisyonlar.adisyon_calisan_idsi=:calisan_idsi
      GROUP BY tbl_adisyonlar.adisyon_calisan_idsi"
    );
    $stmt->execute(['calisan_idsi'=>$calisanIdsi]);
    $calisanTuketimBilgileri = $stmt->fetch();
    /*çalışan tüketim bilgileri*/

    $this->view->calisanTuketimBilgileri = $calisanTuketimBilgileri;
    $this->view->calisanSatisBilgileri = $calisanSatisBilgileri;
    $this->view->calisan = $calisan;
    $this->view->render("birimler/calisanlar/calisan-profil");
  }

  public function calisanlistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }
    if(isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }
    if (isset($_GET["calisanIdsi"])) {
      if ($_GET["calisanIdsi"] == "*") {

      }else {
        $keys[] = "calisan_calisan_idsi";
        $parameters[] = $_GET["calisanIdsi"];
      }
      $this->view->filterClass = "";
      $this->view->filtreDegerleri = array($parameters[0]);
    }else {
      $this->view->filterClass = "d-none";
      $this->view->filtreDegerleri = "";
    }





    $calisan = new Calisanlar();
    $toplamVeriSayisi = $calisan->selectQuery("tbl_calisanlar",array("id"));
    $calisanIdleri = $calisan->selectLimitQuery("tbl_calisanlar",array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);

    for ($i=0; $i < count($calisanIdleri); $i++) {
      $calisanIdsi = $calisan->getCalisanIdsi(array("id"=>$calisanIdleri[$i]["id"]));
      $calisanStatuIdsi = $calisan->getCalisanStatuIdsi(array("id"=>$calisanIdleri[$i]["id"]));

      $calisan = new Calisanlar();
      $statu = new Statuler();

      $calisanStatuAdi = $statu->getStatuAdi(array("id"=>$calisanStatuIdsi));

      $calisanListesi[] = array(
        "calisanId"=>$calisanIdleri[$i]["id"],
        "calisanAdiSoyadi"=>$calisan->getCalisanAdiSoyadi(array("id"=>$calisanIdleri[$i]["id"])),
        "calisanProfilFotosu"=>$calisan->getCalisanProfilFotosu(array("id"=>$calisanIdleri[$i]["id"])),
        "calisanStatuAdi"=>$calisanStatuAdi,
        "calisanIdsi"=>$calisan->getCalisanIdsi(array("id"=>$calisanIdleri[$i]["id"]))
      );

    }
    $kategori = null;
    $calisan = null;

    $model = new Model();
    $calisanKategorileriIdleri = $model->selectFilterQuery("tbl_kategoriler",array("id"),array("kategori_tablo_adi"=>"tbl_calisanlar"));
    $model = null;
    $calisanKategoriBilgileri = array();
    for ($i=0; $i < count($calisanKategorileriIdleri); $i++) {
      $kategori = new Kategoriler();
      $calisanKategoriBilgileri[] = array(
        "kategoriId"=>$kategori->getKategoriId(array("id"=>$calisanKategorileriIdleri[$i]["id"])),
        "kategoriAdi"=>$kategori->getKategoriAdi(array("id"=>$calisanKategorileriIdleri[$i]["id"]))
      );
    }

    $model = new Model();
    $calisanIdleri = $model->selectQuery("tbl_calisanlar",array("id"));
    $model = null;
    $calisanBilgileri = array();
    for ($i=0; $i < count($calisanIdleri); $i++) {
      $calisan = new Calisanlar();
      $calisanBilgileri[] = array(
        "calisanId"=>$calisan->getCalisanIdsi(array("id"=>$calisanIdleri[$i]["id"])),
        "calisanAdi"=>$calisan->getCalisanAdiSoyadi(array("id"=>$calisanIdleri[$i]["id"]))
      );
    }

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->calisanBilgileri = $calisanBilgileri;
    $this->view->calisanKategoriBilgileri = $calisanKategoriBilgileri;
    $this->view->calisanListesi = $calisanListesi;
    $this->view->calisanKategoriListesi = array_values(array_unique($calisanBilgileri, SORT_REGULAR));
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/calisanlar/calisan-listesi");
    $kategori = null;
    $calisan = null;
  }

  public function calisanekle()
  {

    if (isset($_POST["calisanEkle"])) {
      $veriler = json_decode($_POST["calisanEkle"],true);

      $yanit = $this->parolaKontrol($veriler["txtCalisanParolasi"],$veriler["txtCalisanParolasiTekrar"]);

      if ($yanit == "true") {
        $yanit = $this->pinKontrol($veriler["txtCalisanPini"],$veriler["txtCalisanPiniTekrar"]);
      }
      if ($yanit == "true") {
        $yanit = $this->kullaniciAdiKontrol($veriler["txtCalisanKullaniciAdi"]);
      }

      $dosyaAdi = array();
      if (isset($_FILES["dosya"])) {
          if(file_exists($_FILES['dosya']['tmp_name']) || !is_uploaded_file($_FILES['dosya']['tmp_name'])) {
            $dosyaAdi = $_FILES["dosya"]["name"];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/calisanlar/".$dosyaAdi;
            $dosya=$_FILES["dosya"]["tmp_name"];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = "true";
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosyaAdi = "";
          }

      }else {
        $dosyaAdi = "profile.png";
      }

      if ($yanit == "true") {

        $calisan = new Calisanlar();
        $calisan->setCalisanAdiSoyadi($veriler["txtCalisanAdiSoyadi"]);
        $calisan->setCalisanAdresi($veriler["txtCalisanAdresi"]);
        $calisan->setCalisanDogumTarihi($veriler["txtCalisanDogumTarihi"]);
        $calisan->setCalisanTelefonNumarasi($veriler["txtCalisanTelefonNumarasi"]);
        $calisan->setCalisanEpostaAdresi($veriler["txtCalisanEpostaAdresi"]);
        $calisan->setCalisanProfilFotosu($dosyaAdi);
        $calisan->setCalisanStatuIdsi($veriler["txtCalisanStatuIdsi"]);
        $calisan->setCalisanKullaniciAdi($veriler["txtCalisanKullaniciAdi"]);
        $calisan->setCalisanParolasi(md5($veriler["txtCalisanParolasi"]));
        $calisan->setCalisanPini(md5($veriler["txtCalisanPini"]));
        $calisan->setCalisanHizliNotlari(json_encode($veriler["txtCalisanHizliNotlari"]));
        $calisan->setCalisanIndirimTuru($veriler["txtCalisanIndirimTuru"]);
        $calisan->setCalisanIndirimMiktari($veriler["txtCalisanIndirimMiktari"]);
        if ($veriler["txtCalisanGunlukHarcamaSiniri"] == "") {
          $veriler["txtCalisanGunlukHarcamaSiniri"] = 0;
        }
        $calisan->setCalisanGunlukHarcamaSiniri($veriler["txtCalisanGunlukHarcamaSiniri"]);
        $this->values = array(
          $calisan->calisanAdiSoyadi,
          $calisan->calisanAdresi,
          $calisan->calisanDogumTarihi,
          $calisan->calisanTelefonNumarasi,
          $calisan->calisanEpostaAdresi,
          $calisan->calisanProfilFotosu,
          $calisan->calisanStatuIdsi,
          $calisan->calisanKullaniciAdi,
          $calisan->calisanParolasi,
          $calisan->calisanPini,
          $calisan->calisanHizliNotlari,
          $calisan->calisanIndirimTuru,
          $calisan->calisanIndirimMiktari,
          $calisan->calisanGunlukHarcamaSiniri
        );
        // print_r($this->kolonAdlari);
        // print_r($this->values);
        $yanit = $this->dataInsert();
        $calisan = null;
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_statuler");
      $stmt->execute();
      $statuler = $stmt->fetchAll();
      $model = null;

      $this->view->statuler = $statuler;
      $this->view->render("birimler/calisanlar/calisan-ekle");
    }
  }

  public function calisanduzenle($idler = false)
  {
    if (isset($_POST["calisanDuzenle"])) {

      $veriler = json_decode($_POST["calisanDuzenle"],true);


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
            $dosyaAdi = "profile.png";
          }

      }else {
        $dosyaAdi = "profile.png";
      }

      for ($i=0; $i < count($veriler); $i++) {
        $calisan = new Calisanlar();
        $calisan->setCalisanIdsi($veriler[$i]["txtCalisanIdsi"]);
        $calisan->setCalisanAdiSoyadi($veriler[$i]["txtCalisanAdiSoyadi"]);
        $calisan->setCalisanAdresi($veriler[$i]["txtCalisanAdresi"]);
        $calisan->setCalisanEpostaAdresi($veriler[$i]["txtCalisanEpostaAdresi"]);
        $calisan->setCalisanDogumTarihi($veriler[$i]["txtCalisanDogumTarihi"]);
        $calisan->setCalisanTelefonNumarasi($veriler[$i]["txtCalisanTelefonNumarasi"]);
        $calisan->setCalisanStatuIdsi($veriler[$i]["txtCalisanStatuIdsi"]);
        if ($dosyaAdi != null) {
          $calisan->setCalisanProfilFotosu($dosyaAdi);
        }else {
          $calisanMevcutGorseli=$calisan->getCalisanProfilFotosu(array("id"=>$veriler[$i]["txtCalisanIdsi"]));
          $calisan->setCalisanProfilFotosu($calisanMevcutGorseli);
        }
        $calisan->setCalisanIdsi($veriler[$i]["txtCalisanIdsi"]);
        $calisan->setCalisanIndirimTuru($veriler[$i]["txtCalisanIndirimTuru"]);
        $calisan->setCalisanIndirimMiktari($veriler[$i]["txtCalisanIndirimMiktari"]);
        $calisan->setCalisanGunlukHarcamaSiniri($veriler[$i]["txtCalisanGunlukHarcamaSiniri"]);
        $this->values = array(
          "calisan_adi_soyadi"=>$calisan->calisanAdiSoyadi,
          "calisan_adresi"=>$calisan->calisanAdresi,
          "calisan_dogum_tarihi"=>$calisan->calisanDogumTarihi,
          "calisan_telefon_numarasi"=>$calisan->calisanTelefonNumarasi,
          "calisan_eposta_adresi"=>$calisan->calisanEpostaAdresi,
          "calisan_profil_fotosu"=>$calisan->calisanProfilFotosu,
          "calisan_statu_idsi"=>$calisan->calisanStatuIdsi,
          "calisan_indirim_turu"=>$calisan->calisanIndirimTuru,
          "calisan_indirim_miktari"=>$calisan->calisanIndirimMiktari,
          "calisan_gunluk_harcama_siniri"=>$calisan->calisanGunlukHarcamaSiniri,
          "id"=>$calisan->calisanIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $calisan = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {
          $calisan = new Calisanlar();
          $calisanIdsi = $calisan->getCalisanIdsi(array("id"=>$idler[$i]));

          $calisanBilgileri[] = array(
            "calisanIdsi"=>$idler[$i],
            "calisanAdiSoyadi"=>$calisan->getCalisanAdiSoyadi(array("id"=>$idler[$i])),
            "calisanAdresi"=>$calisan->getCalisanAdresi(array("id"=>$idler[$i])),
            "calisanDogumTarihi"=>$calisan->getCalisanDogumTarihi(array("id"=>$idler[$i])),
            "calisanTelefonNumarasi"=>$calisan->getCalisanTelefonNumarasi(array("id"=>$idler[$i])),
            "calisanEpostaAdresi"=>$calisan->getCalisanEpostaAdresi(array("id"=>$idler[$i])),
            "calisanProfilFotosu"=>$calisan->getCalisanProfilFotosu(array("id"=>$idler[$i])),
            "calisanStatuIdsi"=>$calisan->getCalisanStatuIdsi(array("id"=>$idler[$i])),
            "calisanIndirimTuru"=>$calisan->getCalisanIndirimTuru(array("id"=>$idler[$i])),
            "calisanIndirimMiktari"=>$calisan->getCalisanIndirimMiktari(array("id"=>$idler[$i])),
            "calisanGunlukHarcamaSiniri"=>$calisan->getCalisanGunlukHarcamaSiniri(array("id"=>$idler[$i]))
          );
        }
      }
      $kategori = null;
      $calisan = null;

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_statuler");
      $stmt->execute();
      $statuler = $stmt->fetchAll();
      $model = null;

      $this->view->statuler = $statuler;
      $this->view->calisanBilgileri = $calisanBilgileri;
      $this->view->render("birimler/calisanlar/calisan-duzenle");
    }
  }

  public function calisanSil()
  {
    if (isset($_POST["calisanSil"])) {
      $veriler = json_decode($_POST["calisanSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $calisan = new Calisanlar();
        $calisan->setCalisanIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$calisan->calisanIdsi
        );
        $yanit = $this->dataDelete();
      }
      $calisan = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
