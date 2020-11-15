<?php

/**
*
*/
class Urun extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_urunler");
    $this->kolonAdlari = array(
      "urun_kodu",
      "urun_barkodu",
      "urun_adi",
      "urun_birim_idsi",
      "urun_adedi",
      "urun_rengi",
      "urun_kategori_idsi",
      "urun_mutfak_idleri",
      "urun_gorseli",
      "urun_alt_uyari_degeri",
      "urun_kur_idsi",
      "urun_kg_fiyati",
      "urun_alis_fiyati",
      "urun_satis_fiyati",
      "urun_alis_vergi_idsi",
      "urun_satis_vergi_idsi",
      "urun_stok_urunu_mu",
      "urun_depo_idsi"
    );

    $this->sayfaIzınAdi = "txtUrunEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    $this->view->kategoriTabloAdi = $this->tabloAdlari[0];


    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function urunlistesi()
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
    if (isset($_GET["urunKategoriIdsi"])) {
      if ($_GET["urunKategoriIdsi"] == "*") {

      }else {
        $keys[] = "urun_kategori_idsi";
        $parameters[] = $_GET["urunKategoriIdsi"];
      }
      $this->view->filterClass = "";
      $this->view->filtreDegerleri = array($parameters[0]);
    }else {
      $this->view->filterClass = "d-none";
      $this->view->filtreDegerleri = "";
    }

    $keys[] = "urun_stok_urunu_mu";
    $parameters[] = 0;



    $urun = new Urunler();
    $toplamVeriSayisi = $urun->selectQuery("tbl_urunler",array("id"));
    $urunIdleri = $urun->selectLimitQuery("tbl_urunler",array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);

    for ($i=0; $i < count($urunIdleri); $i++) {
      $kategori = new Kategoriler();
      $kur = new Kurlar();
      $urunKategoriId = $urun->getUrunKategoriIdsi(array("id"=>$urunIdleri[$i]["id"]));
      $urunKurIdsi = $urun->getUrunKurIdsi(array("id"=>$urunIdleri[$i]["id"]));
      $urunListesi[] = array(
        "urunId"=>$urunIdleri[$i]["id"],
        "urunKodu"=>$urun->getUrunKodu(array("id"=>$urunIdleri[$i]["id"])),
        "urunAdi"=>$urun->getUrunAdi(array("id"=>$urunIdleri[$i]["id"])),
        "urunKategoriIdsi"=>$kategori->getKategoriAdi(array("id"=>$urunKategoriId)),
        "urunKurKisaltmasi"=>$kur->getKurKisaltmasi(array("id"=>$urunKurIdsi))
      );

    }
    $urun = null;
    $kategori = null;

    $model = new Model();
    $urunKategorileriIdleri = $model->selectFilterQuery("tbl_kategoriler",array("id"),array("kategori_tablo_adi"=>$this->tabloAdlari[0]));
    $model = null;
    $kategoriBilgileri = array();
    for ($i=0; $i < count($urunKategorileriIdleri); $i++) {
      $kategori = new Kategoriler();
      $kategoriBilgileri[] = array(
        "kategoriId"=>$kategori->getKategoriId(array("id"=>$urunKategorileriIdleri[$i]["id"])),
        "kategoriAdi"=>$kategori->getKategoriAdi(array("id"=>$urunKategorileriIdleri[$i]["id"]))
      );
    }

    $this->view->urunKategoriListesi = $kategoriBilgileri;
    $this->view->urunListesi = $urunListesi;
    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/urunler/urun-listesi");
    $kategori = null;
    $departman = null;
  }

  public function urunekle()
  {
    if (isset($_POST["urunEkle"])) {
      $veriler = json_decode($_POST["urunEkle"],true);
      $verilerAltUrun = json_decode($_POST["altUrunEkle"],true);
      $altUrunEklenecekMi = $_POST["altUrunEkle"];

      if (isset($_POST["stokTakibiBilgileri"])) {
        $verilerStokTakibi = json_decode($_POST["stokTakibiBilgileri"],true);
      }

      if (isset($_POST["altUrunStokTakibiBilgileri"])) {
        $verilerAltUrunStokTakibiBilgileri = json_decode($_POST["altUrunStokTakibiBilgileri"],true);
      }

      $stokTakibiBilgileri = $_POST["stokTakibiBilgileri"];
      $dosyaAdi = array();
      if (isset($_FILES["dosya"])) {
        for ($i=0; $i < count($_FILES['dosya']['name']); $i++) {
          if(file_exists($_FILES['dosya']['tmp_name'][$i]) || !is_uploaded_file($_FILES['dosya']['tmp_name'][$i])) {
            $dosyaAdi[] = $_FILES["dosya"]["name"][$i];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/urunler/".$dosyaAdi[$i];
            $dosya=$_FILES["dosya"]["tmp_name"][$i];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosyaAdi = "";
          }
        }
      }

      $urun = new Urunler();
      $urun->setUrunKodu($veriler["txtUrunKodu"]);
      $urun->setUrunBarkodu($veriler["txtUrunBarkodu"]);
      $urun->setUrunAdi($veriler["txtUrunAdi"]);
      $urun->setUrunBirimIdsi($veriler["txtUrunBirimIdsi"]);
      $urun->setUrunAdedi($veriler["txtUrunAdedi"]);
      $urun->setUrunRengi($veriler["txtUrunRengi"]);
      $urun->setUrunKategoriIdsi($veriler["txtUrunKategoriIdsi"]);
      if (isset($veriler["txtUrunMutfakIdleri"])) {
        $urun->setUrunMutfakIdleri(json_encode($veriler["txtUrunMutfakIdleri"]));
      }else {
        $urun->setUrunMutfakIdleri(null);
      }
      $urun->setUrunGorseli(json_encode($dosyaAdi));
      $urun->setUrunAltUyariDegeri($veriler["txtUrunAltUyariDegeri"]);
      $urun->setUrunKurIdsi($veriler["txtUrunKurIdsi"]);
      $urun->setUrunKgFiyati($veriler["txtUrunKgFiyati"]);
      $urun->setUrunAlisFiyati($veriler["txtUrunAlisFiyati"]);
      $urun->setUrunSatisFiyati($veriler["txtUrunSatisFiyati"]);
      $urun->setUrunAlisVergiIdsi($veriler["txtUrunAlisVergiIdsi"]);
      $urun->setUrunSatisVergiIdsi($veriler["txtUrunSatisVergiIdsi"]);
      $urun->setUrunStokUrunuMu(0);
      $urun->setUrunDepoIdsi(0);
      $this->values = array(
        $urun->urunKodu,
        $urun->urunBarkodu,
        $urun->urunAdi,
        $urun->urunBirimIdsi,
        $urun->urunAdedi,
        $urun->urunRengi,
        $urun->urunKategoriIdsi,
        $urun->urunMutfakIdleri,
        $urun->urunGorseli,
        $urun->urunAltUyariDegeri,
        $urun->urunKurIdsi,
        $urun->urunKgFiyati,
        $urun->urunAlisFiyati,
        $urun->urunSatisFiyati,
        $urun->urunAlisVergiIdsi,
        $urun->urunSatisVergiIdsi,
        $urun->urunStokUrunuMu,
        $urun->urunDepoIdsi
      );
      $yanit = $this->dataInsert();
      $anaUrunIdsi = $yanit["lastId"];
      if ($altUrunEklenecekMi != "false") {
        for ($i=0; $i < count($verilerAltUrun); $i++) {

          $altUrun = new AltUrunler();
          $altUrun->setUstUrunId($anaUrunIdsi);
          $altUrun->setAltUrunKodu($verilerAltUrun[$i]["txtAltUrunKodu"]);
          $altUrun->setAltUrunBarkodu($verilerAltUrun[$i]["txtAltUrunBarkodu"]);
          $altUrun->setAltUrunAdi($verilerAltUrun[$i]["txtAltUrunAdi"]);
          $altUrun->setAltUrunAdedi($verilerAltUrun[$i]["txtAltUrunAdedi"]);
          $altUrun->setAltUrunRengi($verilerAltUrun[$i]["txtAltUrunRengi"]);
          $altUrun->setAltUrunAltUyariDegeri($verilerAltUrun[$i]["txtAltUrunAltUyariDegeri"]);
          $altUrun->setAltUrunKgFiyati($verilerAltUrun[$i]["txtAltUrunKgFiyati"]);
          $altUrun->setAltUrunAlisFiyati($verilerAltUrun[$i]["txtAltUrunAlisFiyati"]);
          $altUrun->setAltUrunSatisFiyati($verilerAltUrun[$i]["txtAltUrunSatisFiyati"]);
          $altUrun->setAltUrunAlisVergiIdsi($verilerAltUrun[$i]["txtAltUrunAlisVergiIdsi"]);
          $altUrun->setAltUrunSatisVergiIdsi($verilerAltUrun[$i]["txtAltUrunSatisVergiIdsi"]);
          $this->values = array(
            $altUrun->ustUrunId,
            $altUrun->altUrunKodu,
            $altUrun->altUrunBarkodu,
            $altUrun->altUrunAdi,
            $urun->urunBirimIdsi,
            $altUrun->altUrunAdedi,
            $altUrun->altUrunRengi,
            $urun->urunKategoriIdsi,
            $urun->urunGorseli,
            $altUrun->altUrunAltUyariDegeri,
            $urun->urunKurIdsi,
            $altUrun->altUrunKgFiyati,
            $altUrun->altUrunAlisFiyati,
            $altUrun->altUrunSatisFiyati,
            $altUrun->altUrunAlisVergiIdsi,
            $altUrun->altUrunSatisVergiIdsi
          );
          $this->tabloAdlari = array("tbl_alt_urunler");
          $this->kolonAdlari = array(
            "ust_urun_id",
            "alt_urun_kodu",
            "alt_urun_barkodu",
            "alt_urun_adi",
            "alt_urun_birim_idsi",
            "alt_urun_adedi",
            "alt_urun_rengi",
            "alt_urun_kategori_idsi",
            "alt_urun_gorseli",
            "alt_urun_alt_uyari_degeri",
            "alt_urun_kur_idsi",
            "alt_urun_kg_fiyati",
            "alt_urun_alis_fiyati",
            "alt_urun_satis_fiyati",
            "alt_urun_alis_vergi_idsi",
            "alt_urun_satis_vergi_idsi"
          );
          $yanit = $this->dataInsert();
          $altUrunIdsi = $yanit["lastId"];

          for ($a=0; $a < count($verilerAltUrunStokTakibiBilgileri); $a++) {
            if ($verilerAltUrunStokTakibiBilgileri[$a]["txtAltUrunIndexi"] == $i) {
              $stokDusme = new StokDusme();
              $stokDusme->setStokDusmeAitUrunIdsi($altUrunIdsi);
              $stokDusme->setStokDusmeAitUrunIdsi("tbl_alt_urunler");
              $stokDusme->setStokDusmeUrunIdsi($verilerAltUrunStokTakibiBilgileri[$a]["txtDusulecekStokUrunIdsi"]);
              $stokDusme->setStokDusumMiktari($verilerAltUrunStokTakibiBilgileri[$a]["txtDusulecekStokMiktari"]);
              $this->values = array(
                $stokDusme->stokDusmeAitUrunIdsi,
                $stokDusme->stokDusmeAitUrunTabloAdi,
                $stokDusme->stokDusmeUrunIdsi,
                $stokDusme->stokDusumMiktari
              );
              $this->tabloAdlari = array("tbl_stok_dusme_bilgileri");
              $this->kolonAdlari = array(
                "ait_urun_idsi",
                "ait_urun_tablo_adi",
                "stoktan_dusulecek_urun_idsi",
                "stoktan_dusum_miktari"
              );
              $yanit = $this->dataInsert();
            }
          }

        }

      }

      if ($stokTakibiBilgileri != "false") {
        for ($i=0; $i < count($verilerStokTakibi); $i++) {

          $stokDusme = new StokDusme();
          $stokDusme->setStokDusmeAitUrunIdsi($anaUrunIdsi);
          $stokDusme->setStokDusmeAitUrunTabloAdi("tbl_urunler");
          $stokDusme->setStokDusmeUrunIdsi($verilerStokTakibi[$i]["txtDusulecekStokUrunIdsi"]);
          $stokDusme->setStokDusumMiktari($verilerStokTakibi[$i]["txtDusulecekStokMiktari"]);
          $this->values = array(
            $stokDusme->stokDusmeAitUrunIdsi,
            $stokDusme->stokDusmeAitUrunTabloAdi,
            $stokDusme->stokDusmeUrunIdsi,
            $stokDusme->stokDusumMiktari
          );
          $this->tabloAdlari = array("tbl_stok_dusme_bilgileri");
          $this->kolonAdlari = array(
            "ait_urun_idsi",
            "ait_urun_tablo_adi",
            "stoktan_dusulecek_urun_idsi",
            "stoktan_dusum_miktari"
          );
          $yanit = $this->dataInsert();
        }

      }

      $urun = null;
      $altUrun = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();
      $urunKategorileriIdleri = $model->selectQuery("tbl_kategoriler",array("id"));
      $kategoriBilgileri = array();
      for ($i=0; $i < count($urunKategorileriIdleri); $i++) {
        $kategori = new Kategoriler();
        $kategoriBilgileri[] = array(
          "kategoriId"=>$kategori->getKategoriId(array("id"=>$urunKategorileriIdleri[$i]["id"])),
          "kategoriAdi"=>$kategori->getKategoriAdi(array("id"=>$urunKategorileriIdleri[$i]["id"]))
        );
      }

      $stmt = $model->dbh->prepare("SELECT id,mutfak_adi FROM tbl_mutfaklar");
      $stmt->execute();
      $mutfaklar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kur_adi FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
      $stmt->execute();
      $yazicilar = $stmt->fetchAll();

      $this->view->birincilKurIdsi = $birincilKurIdsi["id"];
      $this->view->kurlar = $kurlar;
      $this->view->vergiler = $vergiler;
      $this->view->yazicilar = $yazicilar;
      $this->view->birimler = $birimler;
      $this->view->urunMutfakBilgileri = $mutfaklar;
      $this->view->urunKategoriBilgileri = $kategoriBilgileri;
      $this->view->render("birimler/urunler/urun-ekle");
    }
  }



  public function urunduzenle($idler = false)
  {
    if (isset($_POST["urunDuzenle"])) {

      $veriler = json_decode($_POST["urunDuzenle"],true);
      $verilerAltUrun = json_decode($_POST["altUrunDuzenle"],true);
      $altUrunDuzenlenecekMi = $_POST["altUrunDuzenle"];
      $stokTakibiBilgileri = json_decode($_POST["stokTakibiBilgileri"],true);
      @$altUrunStokTakibiBilgileri = json_decode($_POST["altUrunStokTakibiBilgileri"],true);

      if (isset($_FILES["dosya"])) {
        for ($i=0; $i < count($_FILES['dosya']['name']); $i++) {
          if(file_exists($_FILES['dosya']['tmp_name'][$i]) || !is_uploaded_file($_FILES['dosya']['tmp_name'][$i])) {
            $dosyaAdi[] = $_FILES["dosya"]["name"][$i];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/urunler/".$dosyaAdi[$i];
            $dosya=$_FILES["dosya"]["tmp_name"][$i];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosya = null;
          }
        }
      }else {
        $dosya = null;
      }


        $urun = new Urunler();
        $urun->setUrunId($veriler["txtUrunId"]);
        $urun->setUrunKodu($veriler["txtUrunKodu"]);
        $urun->setUrunBarkodu($veriler["txtUrunBarkodu"]);
        $urun->setUrunAdi($veriler["txtUrunAdi"]);
        $urun->setUrunBirimIdsi($veriler["txtUrunBirimIdsi"]);
        $urun->setUrunAdedi($veriler["txtUrunAdedi"]);
        $urun->setUrunRengi($veriler["txtUrunRengi"]);
        $urun->setUrunKategoriIdsi($veriler["txtUrunKategoriIdsi"]);
        $urun->setUrunMutfakIdleri(json_encode($veriler["txtUrunMutfakIdleri"]));

        if ($dosya != null) {
          $urun->setUrunGorseli(json_encode($dosyaAdi));
        }else {
          $urunMevcutGorseli=$urun->getUrunGorseli(array("id"=>$veriler["txtUrunId"]));
          $urun->setUrunGorseli($urunMevcutGorseli);
        }
        $urun->setUrunAltUyariDegeri($veriler["txtUrunAltUyariDegeri"]);
        $urun->setUrunKurIdsi($veriler["txtUrunKurIdsi"]);
        $urun->setUrunKgFiyati($veriler["txtUrunKgFiyati"]);
        $urun->setUrunAlisFiyati($veriler["txtUrunAlisFiyati"]);
        $urun->setUrunSatisFiyati($veriler["txtUrunSatisFiyati"]);
        $urun->setUrunAlisVergiIdsi($veriler["txtUrunAlisVergiIdsi"]);
        $urun->setUrunSatisVergiIdsi($veriler["txtUrunSatisVergiIdsi"]);
        $urun->setUrunStokUrunuMu(0);
        $urun->setUrunDepoIdsi(0);
        $this->values = array(
          "urun_kodu"=>$urun->urunKodu,
          "urun_barkodu"=>$urun->urunBarkodu,
          "urun_adi"=>$urun->urunAdi,
          "urun_birim_idsi"=>$urun->urunBirimIdsi,
          "urun_adedi"=>$urun->urunAdedi,
          "urun_rengi"=>$urun->urunRengi,
          "urun_kategori_idsi"=>$urun->urunKategoriIdsi,
          "urun_mutfak_idleri"=>$urun->urunMutfakIdleri,
          "urun_gorseli"=>$urun->urunGorseli,
          "urun_alt_uyari_degeri"=>$urun->urunAltUyariDegeri,
          "urun_kur_idsi"=>$urun->urunKurIdsi,
          "urun_kg_fiyati"=>$urun->urunKgFiyati,
          "urun_alis_fiyati"=>$urun->urunAlisFiyati,
          "urun_satis_fiyati"=>$urun->urunSatisFiyati,
          "urun_alis_vergi_idsi"=>$urun->urunAlisVergiIdsi,
          "urun_satis_vergi_idsi"=>$urun->urunSatisVergiIdsi,
          "urun_stok_urunu_mu"=>$urun->urunStokUrunuMu,
          "urun_depo_idsi"=>$urun->urunDepoIdsi,
          "id"=>$urun->urunId
        );

        $yanit = $this->dataUpdate();


      if ($stokTakibiBilgileri != false) {

        $stokDusme = new StokDusme();
        $model = new Model();
        $stokDusme->setStokDusmeAitUrunIdsi($veriler["txtUrunId"]);
        $stokDusme->setStokDusmeAitUrunTabloAdi("tbl_urunler");
        $stmt = $model->dbh->prepare("DELETE FROM tbl_stok_dusme_bilgileri WHERE ait_urun_idsi=:urun_idsi AND ait_urun_tablo_adi=:ait_urun_tablo_adi");
        $stmt->execute(['urun_idsi'=>$stokDusme->stokDusmeAitUrunIdsi,'ait_urun_tablo_adi'=>$stokDusme->stokDusmeAitUrunTabloAdi]);
        $model = null;
        $stokDusme = null;

        for ($i=0; $i < count($stokTakibiBilgileri); $i++) {

          $stokDusme = new StokDusme();
          $stokDusme->setStokDusmeAitUrunIdsi($veriler["txtUrunId"]);
          $stokDusme->setStokDusmeAitUrunTabloAdi("tbl_urunler");
          $stokDusme->setStokDusmeUrunIdsi($stokTakibiBilgileri[$i]["txtDusulecekStokUrunIdsi"]);
          $stokDusme->setStokDusumMiktari($stokTakibiBilgileri[$i]["txtDusulecekStokMiktari"]);
          $this->values = array(
            $stokDusme->stokDusmeAitUrunIdsi,
            $stokDusme->stokDusmeAitUrunTabloAdi,
            $stokDusme->stokDusmeUrunIdsi,
            $stokDusme->stokDusumMiktari
          );

          $this->tabloAdlari = array("tbl_stok_dusme_bilgileri");
          $this->kolonAdlari = array(
            "ait_urun_idsi",
            "ait_urun_tablo_adi",
            "stoktan_dusulecek_urun_idsi",
            "stoktan_dusum_miktari"
          );
          $yanit = $this->dataInsert()["yanit"];
          $stokDusme = null;

        }
      }else {
        $stokDusme = new StokDusme();
        $model = new Model();
        $stokDusme->setStokDusmeAitUrunIdsi($veriler["txtUrunId"]);
        $stokDusme->setStokDusmeAitUrunTabloAdi("tbl_urunler");
        $stmt = $model->dbh->prepare("DELETE FROM tbl_stok_dusme_bilgileri WHERE ait_urun_idsi=:urun_idsi AND ait_urun_tablo_adi=:ait_urun_tablo_adi");
        $stmt->execute(['urun_idsi'=>$stokDusme->stokDusmeAitUrunIdsi,'ait_urun_tablo_adi'=>$stokDusme->stokDusmeAitUrunTabloAdi]);
        $model = null;
        $stokDusme = null;
      }
      if ($altUrunDuzenlenecekMi != "false") {
        $altUrun = new AltUrunler();
        $model = new Model();
        $altUrun->setUstUrunId($veriler["txtUrunId"]);

          for ($i=0; $i < count($verilerAltUrun); $i++) {


            if (isset($verilerAltUrun[$i]["txtAltUrunIdsi"])) {

              $stokDusme = new StokDusme();
              $model = new Model();
              $stokDusme->setStokDusmeAitUrunIdsi($verilerAltUrun[$i]["txtAltUrunIdsi"]);
              $stokDusme->setStokDusmeAitUrunTabloAdi("tbl_alt_urunler");
              $stmt = $model->dbh->prepare("DELETE FROM tbl_stok_dusme_bilgileri WHERE ait_urun_idsi=:urun_idsi AND ait_urun_tablo_adi=:ait_urun_tablo_adi");
              $stmt->execute(['urun_idsi'=>$stokDusme->stokDusmeAitUrunIdsi,'ait_urun_tablo_adi'=>$stokDusme->stokDusmeAitUrunTabloAdi]);
              $model = null;
              $stokDusme = null;

              $altUrun->setUstUrunId($veriler["txtUrunId"]);
              $altUrun->setAltUrunId($verilerAltUrun[$i]["txtAltUrunIdsi"]);
              $altUrun->setAltUrunKodu($verilerAltUrun[$i]["txtAltUrunKodu"]);
              $altUrun->setAltUrunBarkodu($verilerAltUrun[$i]["txtAltUrunBarkodu"]);
              $altUrun->setAltUrunAdi($verilerAltUrun[$i]["txtAltUrunAdi"]);
              $altUrun->setAltUrunAdedi($verilerAltUrun[$i]["txtAltUrunAdedi"]);
              $altUrun->setAltUrunRengi($verilerAltUrun[$i]["txtAltUrunRengi"]);
              $altUrun->setAltUrunAltUyariDegeri($verilerAltUrun[$i]["txtAltUrunAltUyariDegeri"]);
              $altUrun->setAltUrunKgFiyati($verilerAltUrun[$i]["txtAltUrunKgFiyati"]);
              $altUrun->setAltUrunAlisFiyati($verilerAltUrun[$i]["txtAltUrunAlisFiyati"]);
              $altUrun->setAltUrunSatisFiyati($verilerAltUrun[$i]["txtAltUrunSatisFiyati"]);
              $altUrun->setAltUrunAlisVergiIdsi($verilerAltUrun[$i]["txtAltUrunAlisVergiIdsi"]);
              $altUrun->setAltUrunSatisVergiIdsi($verilerAltUrun[$i]["txtAltUrunSatisVergiIdsi"]);
              $this->values = array(
                "ust_urun_id"=>$altUrun->ustUrunId,
                "alt_urun_kodu"=>$altUrun->altUrunKodu,
                "alt_urun_barkodu"=>$altUrun->altUrunBarkodu,
                "alt_urun_adi"=>$altUrun->altUrunAdi,
                "alt_urun_birim_idsi"=>$urun->urunBirimIdsi,
                "alt_urun_adedi"=>$altUrun->altUrunAdedi,
                "alt_urun_rengi"=>$altUrun->altUrunRengi,
                "alt_urun_kategori_idsi"=>$urun->urunKategoriIdsi,
                "alt_urun_gorseli"=>$urun->urunGorseli,
                "alt_urun_alt_uyari_degeri"=>$altUrun->altUrunAltUyariDegeri,
                "alt_urun_kur_idsi"=>$urun->urunKurIdsi,
                "alt_urun_kg_fiyati"=>$altUrun->altUrunKgFiyati,
                "alt_urun_alis_fiyati"=>$altUrun->altUrunAlisFiyati,
                "alt_urun_satis_fiyati"=>$altUrun->altUrunSatisFiyati,
                "alt_urun_alis_vergi_idsi"=>$altUrun->altUrunAlisVergiIdsi,
                "alt_urun_satis_vergi_idsi"=>$altUrun->altUrunSatisVergiIdsi,
                "id"=>$altUrun->altUrunId
              );

              $this->tabloAdlari = array("tbl_alt_urunler");
              $this->kolonAdlari = array(
                "ust_urun_id",
                "alt_urun_kodu",
                "alt_urun_barkodu",
                "alt_urun_adi",
                "alt_urun_birim_idsi",
                "alt_urun_adedi",
                "alt_urun_rengi",
                "alt_urun_kategori_idsi",
                "alt_urun_gorseli",
                "alt_urun_alt_uyari_degeri",
                "alt_urun_kur_idsi",
                "alt_urun_kg_fiyati",
                "alt_urun_alis_fiyati",
                "alt_urun_satis_fiyati",
                "alt_urun_alis_vergi_idsi",
                "alt_urun_satis_vergi_idsi"
              );
              $yanit = $this->dataUpdate();
            }else {

              $altUrun->setUstUrunId($veriler["txtUrunId"]);
              $altUrun->setAltUrunKodu($verilerAltUrun[$i]["txtAltUrunKodu"]);
              $altUrun->setAltUrunBarkodu($verilerAltUrun[$i]["txtAltUrunBarkodu"]);
              $altUrun->setAltUrunAdi($verilerAltUrun[$i]["txtAltUrunAdi"]);
              $altUrun->setAltUrunAdedi($verilerAltUrun[$i]["txtAltUrunAdedi"]);
              $altUrun->setAltUrunRengi($verilerAltUrun[$i]["txtAltUrunRengi"]);
              $altUrun->setAltUrunAltUyariDegeri($verilerAltUrun[$i]["txtAltUrunAltUyariDegeri"]);
              $altUrun->setAltUrunKgFiyati($verilerAltUrun[$i]["txtAltUrunKgFiyati"]);
              $altUrun->setAltUrunAlisFiyati($verilerAltUrun[$i]["txtAltUrunAlisFiyati"]);
              $altUrun->setAltUrunSatisFiyati($verilerAltUrun[$i]["txtAltUrunSatisFiyati"]);
              $altUrun->setAltUrunAlisVergiIdsi($verilerAltUrun[$i]["txtAltUrunAlisVergiIdsi"]);
              $altUrun->setAltUrunSatisVergiIdsi($verilerAltUrun[$i]["txtAltUrunSatisVergiIdsi"]);
              $this->values = array(
                $altUrun->ustUrunId,
                $altUrun->altUrunKodu,
                $altUrun->altUrunBarkodu,
                $altUrun->altUrunAdi,
                $urun->urunBirimIdsi,
                $altUrun->altUrunAdedi,
                $altUrun->altUrunRengi,
                $urun->urunKategoriIdsi,
                $urun->urunGorseli,
                $altUrun->altUrunAltUyariDegeri,
                $urun->urunKurIdsi,
                $altUrun->altUrunKgFiyati,
                $altUrun->altUrunAlisFiyati,
                $altUrun->altUrunSatisFiyati,
                $altUrun->altUrunAlisVergiIdsi,
                $altUrun->altUrunSatisVergiIdsi
              );

              $this->tabloAdlari = array("tbl_alt_urunler");
              $this->kolonAdlari = array(
                "ust_urun_id",
                "alt_urun_kodu",
                "alt_urun_barkodu",
                "alt_urun_adi",
                "alt_urun_birim_idsi",
                "alt_urun_adedi",
                "alt_urun_rengi",
                "alt_urun_kategori_idsi",
                "alt_urun_gorseli",
                "alt_urun_alt_uyari_degeri",
                "alt_urun_kur_idsi",
                "alt_urun_kg_fiyati",
                "alt_urun_alis_fiyati",
                "alt_urun_satis_fiyati",
                "alt_urun_alis_vergi_idsi",
                "alt_urun_satis_vergi_idsi"
              );
              $yanit = $this->dataInsert();
              $veriler[$i]["txtAltUrunIdsi"] = $yanit["lastId"];
            }

          }
          for ($b=0; $b < count($altUrunStokTakibiBilgileri); $b++) {
            $stokDusme = new StokDusme();
            $stokDusme->setStokDusmeAitUrunIdsi($verilerAltUrun[$altUrunStokTakibiBilgileri[$b]["txtAltUrunIndexi"]]["txtAltUrunIdsi"]);
            $stokDusme->setStokDusmeAitUrunTabloAdi("tbl_alt_urunler");
            $stokDusme->setStokDusmeUrunIdsi($altUrunStokTakibiBilgileri[$b]["txtDusulecekStokUrunIdsi"]);
            $stokDusme->setStokDusumMiktari($altUrunStokTakibiBilgileri[$b]["txtDusulecekStokMiktari"]);
            $this->values = array(
              $stokDusme->stokDusmeAitUrunIdsi,
              $stokDusme->stokDusmeAitUrunTabloAdi,
              $stokDusme->stokDusmeUrunIdsi,
              $stokDusme->stokDusumMiktari
            );

            $this->tabloAdlari = array("tbl_stok_dusme_bilgileri");
            $this->kolonAdlari = array(
              "ait_urun_idsi",
              "ait_urun_tablo_adi",
              "stoktan_dusulecek_urun_idsi",
              "stoktan_dusum_miktari"
            );
            $yanit = $this->dataInsert()["yanit"];
            $stokDusme = null;
          }

      }

      $urun = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

        if ($idler) {
          $urun = new Urunler();
          $model = new Model();

          $urunKategoriIdsi = $urun->getUrunKategoriIdsi(array("id"=>$idler));

          $kategori = new Kategoriler();

          $urunKategoriBilgileri[] = array(
            "kategoriId"=>$kategori->getKategoriId(array("id"=>$urunKategoriIdsi)),
            "kategoriAdi"=>$kategori->getKategoriAdi(array("id"=>$urunKategoriIdsi))
          );

          $stmt = $model->dbh->prepare("SELECT
            tbl_stok_dusme_bilgileri.*,tbl_urunler.urun_adi
            FROM tbl_stok_dusme_bilgileri
            INNER JOIN tbl_urunler ON tbl_urunler.id=tbl_stok_dusme_bilgileri.stoktan_dusulecek_urun_idsi
            WHERE tbl_stok_dusme_bilgileri.ait_urun_idsi=:ait_urun_idsi AND ait_urun_tablo_adi=:ait_urun_tablo_adi");

          $stmt->execute(['ait_urun_idsi' => $idler,'ait_urun_tablo_adi'=>"tbl_urunler"]);
          $stokDusmeBilgileri = $stmt->fetchAll();

          /*ürün kategorileri*/
          $stmt = $model->dbh->prepare("SELECT id,kategori_adi FROM tbl_kategoriler");
          $stmt->execute();
          $kategoriler = $stmt->fetchAll();
          /*ürün kategorileri*/


          $yesChecked = "";
          $noChecked = "";
          $stokDusmeCollapseClass = "";
          if (!$stokDusmeBilgileri) {
            $stokDusmeCollapseClass = "d-none";
            $noChecked = "checked";
          }else {
            $noChecked = "";
            $yesChecked = "checked";
          }

          $stmt = $model->dbh->prepare("SELECT * FROM tbl_alt_urunler WHERE ust_urun_id=:ust_urun_id");
          $stmt->execute(['ust_urun_id' => $idler]);
          $altUrunBilgileri = $stmt->fetchAll();


          for ($i=0; $i < count($altUrunBilgileri); $i++) {
            $altUrunStokDusmeBilgileri = array();

            $stmt = $model->dbh->prepare(
              "SELECT tbl_stok_dusme_bilgileri.*,tbl_urunler.urun_adi FROM tbl_stok_dusme_bilgileri
              INNER JOIN tbl_urunler
              ON tbl_stok_dusme_bilgileri.stoktan_dusulecek_urun_idsi=tbl_urunler.id
              WHERE tbl_stok_dusme_bilgileri.ait_urun_idsi=:ait_urun_idsi AND ait_urun_tablo_adi=:ait_urun_tablo_adi"
             );
            $stmt->execute(['ait_urun_idsi' => $altUrunBilgileri[$i]["id"],'ait_urun_tablo_adi'=>"tbl_alt_urunler"]);
            $altUrunStokDusmeBilgileri[] = $stmt->fetchAll();
            $altUrunBilgileri[$i]["altUrunStokDusmeBilgileri"] = $altUrunStokDusmeBilgileri;
          }


          $altUrunCollapseClass = "show";
          if (!$altUrunBilgileri) {
            $altUrunCollapseClass = "";
          }

          $urunBilgileri[] = array(
            "urunId"=>$idler,
            "urunKodu"=>$urun->getUrunKodu(array("id"=>$idler)),
            "urunBarkodu"=>$urun->getUrunBarkodu(array("id"=>$idler)),
            "urunAdi"=>$urun->getUrunAdi(array("id"=>$idler)),
            "urunBirimIdsi"=>$urun->getUrunBirimIdsi(array("id"=>$idler)),
            "urunAdedi"=>$urun->getUrunAdedi(array("id"=>$idler)),
            "urunRengi"=>$urun->getUrunRengi(array("id"=>$idler)),
            "urunKategoriIdsi"=>$urun->getUrunKategoriIdsi(array("id"=>$idler)),
            "urunMutfakIdleri"=>json_decode($urun->getUrunMutfakIdleri(array("id"=>$idler)),true),
            "urunGorseli"=>json_decode($urun->getUrunGorseli(array("id"=>$idler)),true),
            "urunAltUyariDegeri"=>$urun->getUrunAltUyariDegeri(array("id"=>$idler)),
            "urunKurIdsi"=>$urun->getUrunKurIdsi(array("id"=>$idler)),
            "urunKgFiyati"=>$urun->getUrunKgFiyati(array("id"=>$idler)),
            "urunAlisFiyati"=>$urun->getUrunAlisFiyati(array("id"=>$idler)),
            "urunSatisFiyati"=>$urun->getUrunSatisFiyati(array("id"=>$idler)),
            "urunAlisVergiIdsi"=>$urun->getUrunAlisVergiIdsi(array("id"=>$idler)),
            "urunSatisVergiIdsi"=>$urun->getUrunSatisVergiIdsi(array("id"=>$idler)),
            "altUrunCollapseClass"=>$altUrunCollapseClass,
            "stokDusmeCollapseClass"=>$stokDusmeCollapseClass,
            "urunAltUrunBilgileri"=>$altUrunBilgileri,
            "urunStokDusmeBilgileri"=>$stokDusmeBilgileri
          );

        }

      $kategori = null;
      $urun = null;


      $stmt = $model->dbh->prepare("SELECT id,mutfak_adi FROM tbl_mutfaklar");
      $stmt->execute();
      $mutfaklar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kur_adi FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kur_adi FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();



      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
      $stmt->execute();
      $yazicilar = $stmt->fetchAll();
      $model = null;

      $this->view->vergiler = $vergiler;
      $this->view->kurlar = $kurlar;
      $this->view->yazicilar = $yazicilar;
      $this->view->kurlar = $kurlar;
      $this->view->birimler = $birimler;
      $this->view->urunMutfakBilgileri = $mutfaklar;
      $this->view->yesChecked = $yesChecked;
      $this->view->noChecked = $noChecked;
      $this->view->kategoriler = $kategoriler;
      $this->view->urunKategoriBilgileri = $urunKategoriBilgileri;
      $this->view->urunBilgileri = $urunBilgileri;

      $this->view->render("birimler/urunler/urun-duzenle");
    }
  }

  public function urunSil()
  {
    if (isset($_POST["urunSil"])) {
      $model = new Model();
      $veriler = json_decode($_POST["urunSil"],true);

      for ($i=0; $i < count($veriler); $i++) {
        $query = $model->dbh->prepare("DELETE tbl_stok_dusme_bilgileri
          FROM tbl_stok_dusme_bilgileri
          WHERE ait_urun_idsi=:urun_id");
          $delete = $query->execute(array(
           'urun_id' => $veriler[$i]["id"]
        ));
        $query = $model->dbh->prepare("DELETE tbl_alt_urunler
          FROM tbl_alt_urunler
          WHERE ust_urun_id=:urun_id");
          $delete = $query->execute(array(
           'urun_id' => $veriler[$i]["id"]
        ));
        $query = $model->dbh->prepare("DELETE tbl_urunler
          FROM tbl_urunler
          WHERE id=:urun_id");
          $delete = $query->execute(array(
           'urun_id' => $veriler[$i]["id"]
        ));

      }
      if ($delete == 1) {
        $yanit = true;
      }
      $urun = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }

  public function urunOkcBilgileriniAl()
  {
    if (isset($_POST["urunOkcBilgileriniAl"])) {
      $veriler = json_decode($_POST["urunOkcBilgileriniAl"],true);

      $model = new Model();

      switch ($veriler["txtUrunTabloAdi"]) {
        case 'tbl_urunler':
          $stmt = $model->dbh->prepare(
            "SELECT tbl_urunler.id AS urun_idsi,tbl_urunler.urun_plu_nosu,tbl_urunler.urun_adi,tbl_urunler.urun_satis_fiyati,tbl_urunler.urun_barkodu,
            tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi,
            tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati,
            tbl_adisyonlar.adisyon_indirim_turu,tbl_adisyonlar.adisyon_indirim_miktari
            FROM tbl_urunler
            INNER JOIN tbl_adisyon_urunleri
            ON tbl_urunler.id=tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi
            INNER JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
            WHERE tbl_urunler.id=:urun_idsi AND tbl_adisyon_urunleri.id=:adisyon_urun_idsi"
          );
          $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"],'adisyon_urun_idsi'=>$veriler["txtAdisyonUrunuIdsi"]]);
          $urunOkcBilgileri = $stmt->fetch();
          if ($urunOkcBilgileri["urun_plu_nosu"] == null) {
            $urunOkcBilgileri["txtUrunKaydedilecekMi"] = "true";
          }else {
            $urunOkcBilgileri["txtUrunKaydedilecekMi"] = "false";
          }
          break;
        case 'tbl_alt_urunler':
          $stmt = $model->dbh->prepare(
            "SELECT tbl_alt_urunler.alt_urun_plu_nosu AS urun_plu_nosu,
            tbl_alt_urunler.id AS urun_idsi,
            tbl_alt_urunler.alt_urun_adi AS urun_adi,
            tbl_alt_urunler.alt_urun_satis_fiyati AS urun_satis_fiyati,
            tbl_alt_urunler.alt_urun_barkodu AS urun_barkodu,
            tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi,
            tbl_adisyon_urunleri.adisyon_urunleri_urun_toplam_fiyati,
            tbl_adisyonlar.adisyon_indirim_turu,tbl_adisyonlar.adisyon_indirim_miktari
            FROM tbl_alt_urunler
            INNER JOIN tbl_adisyon_urunleri
            ON tbl_alt_urunler.id=tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi
            INNER JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
            WHERE tbl_alt_urunler.id=:urun_idsi AND tbl_adisyon_urunleri.id=:adisyon_urun_idsi"
          );
          $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"],'adisyon_urun_idsi'=>$veriler["txtAdisyonUrunuIdsi"]]);

          $urunOkcBilgileri = $stmt->fetch();
          if ($urunOkcBilgileri["urun_plu_nosu"] == null) {
            $urunOkcBilgileri["txtUrunKaydedilecekMi"] = "true";
          }else {
            $urunOkcBilgileri["txtUrunKaydedilecekMi"] = "false";
          }
          break;
        case 'tbl_menuler':
          // $stmt = $model->dbh->prepare("SELECT alt_urun_plu_nosu,alt_urun_adi,alt_urun_satis_fiyati,alt_urun_barkodu FROM tbl_menuler WHERE id=:urun_idsi");
          // $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"]]);
          // $urunOkcBilgileri = $stmt->fetch();
          // if ($urunOkcBilgileri["urun_plu_nosu"] == null) {
          //   $urunOkcBilgileri["txtUrunKaydedilecekMi"] = "true";
          // }
          break;
      }





      echo json_encode(array(
        "urunOkcBilgileri"=>$urunOkcBilgileri
      ));

    }
  }
}
