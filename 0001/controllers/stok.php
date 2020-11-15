<?php

/**
*
*/
class Stok extends Controller
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

    $this->sayfaIzınAdi = "txtStokMerkezineGirebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {

    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function stokUrunBilgileriniAl()
  {
    if (isset($_POST["stokUrunBilgileriniAl"])) {
      $urunId = $_POST["stokUrunBilgileriniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_urunler.id,tbl_urunler.urun_adi,tbl_urunler.urun_alis_fiyati,tbl_urunler.urun_birim_idsi,tbl_urunler.urun_kodu,tbl_urunler.urun_alis_vergi_idsi,tbl_birimler.birim_adi
        FROM tbl_urunler
        INNER JOIN tbl_birimler ON tbl_urunler.urun_birim_idsi=tbl_birimler.id
        WHERE tbl_urunler.id=:id"
      );
      $stmt->execute(['id'=>$urunId]);
      $urunBilgileri = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      echo json_encode(array(
        "urunBilgileri"=>$urunBilgileri,
        "vergiler"=>$vergiler
      ));
    }
  }

  public function stokMalGirisiYap()
  {
    if (isset($_POST["stokMalGirisiYap"])) {
      $veriler = json_decode($_POST["stokMalGirisiYap"],true);

      $alisFaturasiToplami = 0;
      $alisFaturasiAraToplami = 0;
      $alisFaturasiVergiMiktari = 0;

      $urun = new Urunler();
      $vergi = new Vergiler();
      for ($i=0; $i < count($veriler["stogaEklenecekUrunler"]); $i++) {
        $urunMevcutAdedi = $urun->getUrunAdedi(array("id"=>$veriler["stogaEklenecekUrunler"][$i]["txtUrunId"]));
        $urunSonAdedi = $veriler["stogaEklenecekUrunler"][$i]["txtUrunAdedi"] + $urunMevcutAdedi;
        $urunAraToplami = $veriler["stogaEklenecekUrunler"][$i]["txtUrunAdedi"] * $veriler["stogaEklenecekUrunler"][$i]["txtUrunBirimAlisFiyati"];
        $alisFaturasiAraToplami += $urunAraToplami;
        $alisFaturasiVergiOrani = $vergi->getVergiYuzdesi(array("id"=>$veriler["stogaEklenecekUrunler"][$i]["txtUrunAlisVergiIdsi"]));
        $alisFaturasiVergiMiktari += ($alisFaturasiVergiOrani * $urunAraToplami) / 100;

        $urun->setUrunId($veriler["stogaEklenecekUrunler"][$i]["txtUrunId"]);
        $urun->setUrunAdedi($urunSonAdedi);
        $this->values = array(
          "urun_adedi"=>$urun->urunAdedi,
          "id"=>$urun->urunId
        );
        $yanit = $this->dataUpdate();
      }


      if ($yanit) {
        switch ($veriler["txtOdemeNasilKaydedilsin"]) {
          case '0':
          $iskontoMiktari = ($alisFaturasiAraToplami * $veriler["txtAlisFaturasiIskonto"]) / 100;
          $alisFaturasiToplami = $alisFaturasiAraToplami - $iskontoMiktari;

          $alisFaturasi = new AlisFaturalari();
          $alisFaturasi->setAlisFaturasiKodu($veriler["txtAlisFaturasiFaturaKodu"]);
          $alisFaturasi->setAlisFaturasiSeriNumarasi($veriler["txtAlisFaturasiSeriNumarasi"]);
          $alisFaturasi->setAlisFaturasiVadeTarihi($veriler["txtAlisFaturasiVadeTarihi"]);
          $alisFaturasi->setAlisFaturasiCariIdsi($veriler["txtAlisFaturasiCariHesapIdsi"]);
          $alisFaturasi->setAlisFaturasiAraToplami($alisFaturasiAraToplami);
          $alisFaturasi->setAlisFaturasiIskonto($veriler["txtAlisFaturasiIskonto"]);
          $alisFaturasi->setAlisFaturasiVergiMiktari($alisFaturasiVergiMiktari);
          $alisFaturasi->setAlisFaturasiTutari($alisFaturasiToplami);
          $alisFaturasi->setAlisFaturasiKasaIdsi(0);
          $alisFaturasi->setAlisFaturasiOdenmisMiktar(0);
          $alisFaturasi->setAlisFaturasiAciklamasi($veriler["txtAlisFaturasiAciklamasi"]);
          $alisFaturasi->setAlisFaturasiKesenKullaniciIdsi($_SESSION["uid"]);
          $alisFaturasi->setAlisFaturasiKurIdsi($veriler["txtAlisFaturasiKurIdsi"]);

          $this->tabloAdlari = array("tbl_alis_faturalari");
          $this->kolonAdlari = array(
            "alis_faturasi_kodu",
            "alis_faturasi_seri_numarasi",
            "alis_faturasi_vade_tarihi",
            "alis_faturasi_cari_idsi",
            "alis_faturasi_ara_toplami",
            "alis_faturasi_iskonto",
            "alis_faturasi_vergi_miktari",
            "alis_faturasi_tutari",
            "alis_faturasi_kasa_idsi",
            "alis_faturasi_odenmis_miktar",
            "alis_faturasi_aciklamasi",
            "alis_faturasi_kesen_kullanici_idsi",
            "alis_faturasi_kur_idsi"
          );

          $this->values = array(
            $alisFaturasi->alisFaturasiKodu,
            $alisFaturasi->alisFaturasiSeriNumarasi,
            $alisFaturasi->alisFaturasiVadeTarihi,
            $alisFaturasi->alisFaturasiCariIdsi,
            $alisFaturasi->alisFaturasiAraToplami,
            $alisFaturasi->alisFaturasiIskonto,
            $alisFaturasi->alisFaturasiVergiMiktari,
            $alisFaturasi->alisFaturasiTutari,
            $alisFaturasi->alisFaturasiKasaIdsi,
            $alisFaturasi->alisFaturasiOdenmisMiktar,
            $alisFaturasi->alisFaturasiAciklamasi,
            $alisFaturasi->alisFaturasiKesenKullaniciIdsi,
            $alisFaturasi->alisFaturasiKurIdsi
          );
          $yanit = $this->dataInsert();

          if ($yanit["yanit"]) {
            $alisFaturasiIdsi = $yanit["lastId"];
            for ($i=0; $i < count($veriler["stogaEklenecekUrunler"]); $i++) {
              $urunVergiMiktari = 0;
              $alisFaturasiUrunleri = new AlisFaturasiUrunleri();
              $urun = new Urunler();
              $birim = new Birimler();

              $urunAdi = $urun->getUrunAdi(array("id"=>$veriler["stogaEklenecekUrunler"][$i]["txtUrunId"]));
              $urunBirimIdsi = $urun->getUrunBirimIdsi(array("id"=>$veriler["stogaEklenecekUrunler"][$i]["txtUrunId"]));
              $urunBirimAdi = $birim->getBirimAdi(array("id"=>$urunBirimIdsi));
              $urunTutari = $veriler["stogaEklenecekUrunler"][$i]["txtUrunAdedi"] * $veriler["stogaEklenecekUrunler"][$i]["txtUrunBirimAlisFiyati"];
              $alisFaturasiVergiOrani = $vergi->getVergiYuzdesi(array("id"=>$veriler["stogaEklenecekUrunler"][$i]["txtUrunAlisVergiIdsi"]));
              $urunVergiMiktari = ($alisFaturasiVergiOrani * $urunTutari) / 100;
              $alisFaturasiVergiMiktari += $urunVergiMiktari;

              $alisFaturasiUrunleri->setAlisFaturasiUrunleriFaturaIdsi($alisFaturasiIdsi);
              $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAdi($urunAdi);
              $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAdedi($veriler["stogaEklenecekUrunler"][$i]["txtUrunAdedi"]);
              $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunBirimi($urunBirimAdi);
              $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAlisFiyati($veriler["stogaEklenecekUrunler"][$i]["txtUrunBirimAlisFiyati"]);
              $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunVergiIdsi($veriler["stogaEklenecekUrunler"][$i]["txtUrunAlisVergiIdsi"]);
              $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunVergiMiktari($urunVergiMiktari);
              $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunTutari($urunTutari);
              $this->tabloAdlari = array("tbl_alis_faturasi_urunleri");
              $this->kolonAdlari = array(
                "alis_faturasi_idsi",
                "alis_faturasi_urun_adi",
                "alis_faturasi_urun_adedi",
                "alis_faturasi_urun_birimi",
                "alis_faturasi_urun_alis_fiyati",
                "alis_faturasi_urun_vergi_idsi",
                "alis_faturasi_urun_vergi_miktari",
                "alis_faturasi_urun_tutari"
              );
              $this->values = array(
                $alisFaturasiUrunleri->alisFaturasiUrunleriFaturaIdsi,
                $alisFaturasiUrunleri->alisFaturasiUrunleriUrunAdi,
                $alisFaturasiUrunleri->alisFaturasiUrunleriUrunAdedi,
                $alisFaturasiUrunleri->alisFaturasiUrunleriUrunBirimi,
                $alisFaturasiUrunleri->alisFaturasiUrunleriUrunAlisFiyati,
                $alisFaturasiUrunleri->alisFaturasiUrunleriUrunVergiIdsi,
                $alisFaturasiUrunleri->alisFaturasiUrunleriUrunVergiMiktari,
                $alisFaturasiUrunleri->alisFaturasiUrunleriUrunTutari
              );
              $yanit = $this->dataInsert();

            }

          }else {
            $yanit = "Alış faturası kaydedilirken bir sorun oluştu!";
          }
          break;
          case '1':
          $odeme = new Odemeler();
          $odeme->setOdemeKodu($veriler["txtOdemelereKaydetOdemeKodu"]);
          $odeme->setOdemeCariIdsi($veriler["txtOdemelereKaydetCariHesapIdsi"]);
          $odeme->setOdemeTutari($alisFaturasiAraToplami);
          $odeme->setOdemeKasaIdsi($veriler["txtOdemelereKaydetOdemeKasaIdsi"]);
          $odeme->setOdemeAciklamasi($veriler["txtOdemelereKaydetOdemeAciklamasi"]);
          $this->tabloAdlari = array("tbl_odemeler");
          $this->kolonAdlari = array(
            "odeme_kodu",
            "odeme_cari_idsi",
            "odeme_tutari",
            "odeme_kasa_idsi",
            "odeme_aciklamasi"
          );
          $this->values = array(
            $odeme->odemeKodu,
            $odeme->odemeCariIdsi,
            $odeme->odemeTutari,
            $odeme->odemeKasaIdsi,
            $odeme->odemeAciklamasi
          );
          $yanit = $this->dataInsert();
          break;
          default:
          // code...
          break;
        }
      }else {
        $yanit = "Stok adet artırımı yapılamadı!";
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
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
        if ($_GET["urunDepoIdsi"] == "*") {

        }else {
          $keys[] = "urun_depo_idsi";
          $parameters[] = $_GET["urunDepoIdsi"];
        }
        $this->view->filterClass = "";
        $this->view->filtreDegerleri = $parameters;
      }else {
        $this->view->filterClass = "d-none";
        $this->view->filtreDegerleri = "";
      }




      $urun = new Urunler();
      $toplamVeriSayisi = $urun->selectQuery("tbl_urunler",array("id"));
      $urunIdleri = $urun->selectLimitQuery("tbl_urunler",array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);

      for ($i=0; $i < count($urunIdleri); $i++) {
        $kategori = new Kategoriler();
        $depo = new Depolar();
        $urunKategoriId = $urun->getUrunKategoriIdsi(array("id"=>$urunIdleri[$i]["id"]));
        $urunDepoIdsi = $urun->getUrunDepoIdsi(array("id"=>$urunIdleri[$i]["id"]));
        $urunListesi[] = array(
          "urunId"=>$urunIdleri[$i]["id"],
          "urunKodu"=>$urun->getUrunKodu(array("id"=>$urunIdleri[$i]["id"])),
          "urunAdi"=>$urun->getUrunAdi(array("id"=>$urunIdleri[$i]["id"])),
          "urunKategoriIdsi"=>$kategori->getKategoriAdi(array("id"=>$urunKategoriId)),
          "urunDepoAdi"=>$depo->getDepoAdi(array("id"=>$urunDepoIdsi))
        );

      }
      $urun = null;
      $kategori = null;

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT id,kategori_adi FROM tbl_kategoriler");
      $stmt->execute();
      $kategoriBilgileri = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kur_adi FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
      $stmt->execute();
      $birincilKasaIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id,depo_adi FROM tbl_depolar");
      $stmt->execute();
      $depolar = $stmt->fetchAll();


      $this->view->urunKategoriListesi = $kategoriBilgileri;
      $this->view->depolar = $depolar;
      $this->view->vergiler = $vergiler;
      $this->view->kurlar = $kurlar;
      $this->view->kasalar = $kasalar;
      $this->view->birincilKasaIdsi = $birincilKasaIdsi["id"];
      $this->view->birincilKurIdsi = $birincilKurIdsi["id"];
      @$this->view->urunListesi = $urunListesi;
      $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
      $this->view->aktifSayfaNumarasi = $this->sayfa;
      $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
      $this->view->render("merkezler/stok/stok-mal-girisi-yap");

    }


  }

  public function stokSayimiYap()
  {
    if (isset($_POST["stokSayimiYap"])) {
      $veriler = json_decode($_POST["stokSayimiYap"],true);

      $stokUrun = new Urunler();
      $stokUrun->setUrunId($veriler["txtStokUrunId"]);
      $stokUrun->setUrunAdedi($veriler["txtStokUrunAdedi"]);
      $this->values = array(
        "urun_adedi"=>$stokUrun->urunAdedi,
        "id"=>$stokUrun->urunId
      );
      $yanit = $this->dataUpdate();

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }else {
      $keys = false;
      $parameters = false;
      $this->limit = 100;
      $this->offset = 0;

      if (isset($_GET["lim"])) {
        $this->limit = $_GET["lim"];
      }elseif (isset($_GET["p"])) {
        $this->sayfa = $_GET["p"];
        $this->offset = ($this->sayfa - 1) * $this->limit;
      }

      $keys[] = "urun_stok_urunu_mu";
      $parameters[] = 1;

      $stok = new Urunler();
      $birim = new Birimler();

      $toplamVeriSayisi = $stok->selectQuery($this->tabloAdlari[0],array("id"));
      $stokIdleri = $stok->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
      for ($i=0; $i < count($stokIdleri); $i++) {
        $stokUrunBirimIdsi = $stok->getUrunBirimIdsi(array("id"=>$stokIdleri[$i]["id"]));
        $stokUrunBirimAdi = $birim->getBirimAdi(array("id"=>$stokUrunBirimIdsi));
        $stokListesi[] = array(
          "stokUrunId"=>$stokIdleri[$i]["id"],
          "stokUrunAdi"=>$stok->getUrunAdi(array("id"=>$stokIdleri[$i]["id"])),
          "stokUrunAdedi"=>$stok->getUrunAdedi(array("id"=>$stokIdleri[$i]["id"])),
          "stokUrunBirimi"=>$stokUrunBirimAdi
        );
      }

      $this->view->filterClass = "d-none";
      $this->view->filtreDegerleri = "";
      $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
      $this->view->stokUrunListesi = $stokListesi;
      $this->view->aktifSayfaNumarasi = $this->sayfa;
      $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
      $this->view->render("merkezler/stok/stok-sayimi-yap");

    }
  }

  public function stoklistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }

    $keys[] = "urun_stok_urunu_mu";
    $parameters[] = 1;

    $stok = new Urunler();
    $birim = new Birimler();
    $toplamVeriSayisi = $stok->selectQuery($this->tabloAdlari[0],array("id"));
    $stokIdleri = $stok->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($stokIdleri); $i++) {
      $stokUrunAltUyariDegeri = $stok->getUrunAltUyariDegeri(array("id"=>$stokIdleri[$i]["id"]));
      $stokUrunMevcutAdet = $stok->getUrunAdedi(array("id"=>$stokIdleri[$i]["id"]));
      if ($stokUrunAltUyariDegeri > $stokUrunMevcutAdet) {
        $color = "red";
      }else {
        $color = "black";

      }
      $stokUrunBirimIdsi = $stok->getUrunBirimIdsi(array("id"=>$stokIdleri[$i]["id"]));
      $stokUrunBirimAdi = $birim->getBirimAdi(array("id"=>$stokUrunBirimIdsi));
      $stokListesi[] = array(
        "stokUrunId"=>$stokIdleri[$i]["id"],
        "stokUrunAdi"=>$stok->getUrunAdi(array("id"=>$stokIdleri[$i]["id"])),
        "stokUrunAdedi"=>$stok->getUrunAdedi(array("id"=>$stokIdleri[$i]["id"])),
        "stokUrunBirimi"=>$stokUrunBirimAdi,
        "color"=>$color
      );
    }

    $this->view->filterClass = "d-none";
    $this->view->filtreDegerleri = "";
    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->stokUrunListesi = $stokListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("merkezler/stok/stok-listesi");
  }

  public function stokUrunuEkle()
  {
    if (isset($_POST["stokUrunEkle"])) {
      $veriler = json_decode($_POST["stokUrunEkle"],true);

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

      $stokUrun = new Urunler();
      $stokUrun->setUrunKodu($veriler["txtStokUrunKodu"]);
      $stokUrun->setUrunBarkodu($veriler["txtStokUrunBarkodu"]);
      $stokUrun->setUrunAdi($veriler["txtStokUrunAdi"]);
      $stokUrun->setUrunBirimIdsi($veriler["txtStokUrunBirimIdsi"]);
      $stokUrun->setUrunAdedi($veriler["txtStokUrunAdedi"]);
      $stokUrun->setUrunKategoriIdsi($veriler["txtStokUrunKategoriIdsi"]);
      $stokUrun->setUrunAltUyariDegeri($veriler["txtStokUrunAltUyariDegeri"]);
      $stokUrun->setUrunKurIdsi($veriler["txtStokUrunKurIdsi"]);
      $stokUrun->setUrunAlisFiyati($veriler["txtStokUrunAlisFiyati"]);
      $stokUrun->setUrunAlisVergiIdsi($veriler["txtStokUrunAlisVergiIdsi"]);
      $stokUrun->setUrunGorseli(json_encode($dosyaAdi));
      $stokUrun->setUrunRengi($veriler["txtStokUrunRengi"]);
      $stokUrun->setUrunMutfakIdleri("[]");
      $stokUrun->setUrunKgFiyati(0);
      $stokUrun->setUrunSatisFiyati(0);
      $stokUrun->setUrunSatisVergiIdsi(0);
      $stokUrun->setUrunStokUrunuMu(1);
      $stokUrun->setUrunDepoIdsi($veriler["txtStokUrunDepoIdsi"]);
      $this->values = array(
        $stokUrun->urunKodu,
        $stokUrun->urunBarkodu,
        $stokUrun->urunAdi,
        $stokUrun->urunBirimIdsi,
        $stokUrun->urunAdedi,
        $stokUrun->urunRengi,
        $stokUrun->urunKategoriIdsi,
        $stokUrun->urunMutfakIdleri,
        $stokUrun->urunGorseli,
        $stokUrun->urunAltUyariDegeri,
        $stokUrun->urunKurIdsi,
        $stokUrun->urunKgFiyati,
        $stokUrun->urunAlisFiyati,
        $stokUrun->urunSatisFiyati,
        $stokUrun->urunAlisVergiIdsi,
        $stokUrun->urunSatisVergiIdsi,
        $stokUrun->urunStokUrunuMu,
        $stokUrun->urunDepoIdsi
      );
      $yanit = $this->dataInsert();
      $stokUrun = null;
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

      $stmt = $model->dbh->prepare("SELECT id,depo_adi FROM tbl_depolar");
      $stmt->execute();
      $depolar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kur_adi FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE id=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $this->view->birincilKurIdsi = $birincilKurIdsi["id"];
      $this->view->kurlar = $kurlar;
      $this->view->vergiler = $vergiler;
      $this->view->birimler = $birimler;
      $this->view->depolar = $depolar;
      $this->view->urunKategoriBilgileri = $kategoriBilgileri;
      $this->view->render("merkezler/stok/stok-urunu-ekle");
    }
  }

  public function stokUrunuDuzenle($idler = false)
  {
    if (isset($_POST["stokUrunuDuzenle"])) {
      $veriler = json_decode($_POST["stokUrunuDuzenle"],true);

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
      }else {
        $dosya = null;
      }

      $stokUrun = new Urunler();
      $stokUrun->setUrunId($veriler["txtStokUrunId"]);
      $stokUrun->setUrunKodu($veriler["txtStokUrunKodu"]);
      $stokUrun->setUrunBarkodu($veriler["txtStokUrunBarkodu"]);
      $stokUrun->setUrunAdi($veriler["txtStokUrunAdi"]);
      $stokUrun->setUrunBirimIdsi($veriler["txtStokUrunBirimIdsi"]);
      $stokUrun->setUrunAdedi($veriler["txtStokUrunAdedi"]);
      $stokUrun->setUrunKategoriIdsi($veriler["txtStokUrunKategoriIdsi"]);
      $stokUrun->setUrunAltUyariDegeri($veriler["txtStokUrunAltUyariDegeri"]);
      $stokUrun->setUrunKurIdsi($veriler["txtStokUrunKurIdsi"]);
      $stokUrun->setUrunAlisFiyati($veriler["txtStokUrunAlisFiyati"]);
      $stokUrun->setUrunAlisVergiIdsi($veriler["txtStokUrunAlisVergiIdsi"]);
      if ($dosya != null) {
        $stokUrun->setUrunGorseli(json_encode($dosyaAdi));
      }else {
        $urunMevcutGorseli=$stokUrun->getUrunGorseli(array("id"=>$veriler["txtStokUrunId"]));
        $stokUrun->setUrunGorseli($urunMevcutGorseli);
      }
      $stokUrun->setUrunRengi($veriler["txtStokUrunRengi"]);
      $stokUrun->setUrunMutfakIdleri("[]");
      $stokUrun->setUrunKgFiyati(0);
      $stokUrun->setUrunSatisFiyati(0);
      $stokUrun->setUrunSatisVergiIdsi(0);
      $stokUrun->setUrunStokUrunuMu(1);
      $stokUrun->setUrunDepoIdsi($veriler["txtStokUrunDepoIdsi"]);
      $this->values = array(
        "urun_kodu"=>$stokUrun->urunKodu,
        "urun_barkodu"=>$stokUrun->urunBarkodu,
        "urun_adi"=>$stokUrun->urunAdi,
        "urun_birim_idsi"=>$stokUrun->urunBirimIdsi,
        "urun_adedi"=>$stokUrun->urunAdedi,
        "urun_rengi"=>$stokUrun->urunRengi,
        "urun_kategori_idsi"=>$stokUrun->urunKategoriIdsi,
        "urun_gorseli"=>$stokUrun->urunGorseli,
        "urun_alt_uyari_degeri"=>$stokUrun->urunAltUyariDegeri,
        "urun_kur_idsi"=>$stokUrun->urunKurIdsi,
        "urun_kg_fiyati"=>$stokUrun->urunKgFiyati,
        "urun_alis_fiyati"=>$stokUrun->urunAlisFiyati,
        "urun_satis_fiyati"=>$stokUrun->urunSatisFiyati,
        "urun_alis_vergi_idsi"=>$stokUrun->urunAlisVergiIdsi,
        "urun_satis_vergi_idsi"=>$stokUrun->urunSatisVergiIdsi,
        "urun_stok_urunu_mu"=>$stokUrun->urunStokUrunuMu,
        "urun_depo_idsi"=>$stokUrun->urunDepoIdsi,
        "id"=>$stokUrun->urunId
      );
      $yanit = $this->dataUpdate();

      $stok = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $model = new Model();

          $stmt = $model->dbh->prepare("SELECT * FROM tbl_urunler WHERE id=:id");
          $stmt->execute(['id'=>$idler[$i]]);
          $stokBilgileri = $stmt->fetchAll();
        }
      }
      $stok = null;
      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,depo_adi FROM tbl_depolar");
      $stmt->execute();
      $depolar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kategori_adi FROM tbl_kategoriler");
      $stmt->execute();
      $kategoriler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kur_adi FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE id=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $this->view->birincilKurIdsi = $birincilKurIdsi["id"];
      $this->view->kurlar = $kurlar;
      $this->view->vergiler = $vergiler;
      $this->view->birimler = $birimler;
      $this->view->kategoriler = $kategoriler;
      $this->view->depolar = $depolar;
      $this->view->stokUrunBilgileri = $stokBilgileri;
      $this->view->render("merkezler/stok/stok-urunu-duzenle");
    }
  }

  public function stokSil()
  {
    if (isset($_POST["stokSil"])) {
      $veriler = json_decode($_POST["stokSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $stok = new Urunler();
        $stok->setStokId($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$stok->stokId
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
