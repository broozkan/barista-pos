<?php

/**
*
*/
class Fatura extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->sayfaIzınAdi = "txtMuhasebeMerkezineGirebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }


  /* ALIŞ FATURASI FONKSİYONLARI */
  public function alisFaturalari()
  {
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

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $alisFaturasi = new AlisFaturalari();
    $kur = new Kurlar();
    $musteri = new Musteriler();
    $toplamVeriSayisi = $alisFaturasi->selectQuery($this->tabloAdlari[0],array("id"));
    $alisFaturasiIdleri = $alisFaturasi->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($alisFaturasiIdleri); $i++) {
      $alisFaturasiKurIdsi = $alisFaturasi->getAlisFaturasiKurIdsi(array("id"=>$alisFaturasiIdleri[$i]["id"]));
      $alisFaturasiCariIdsi = $alisFaturasi->getAlisFaturasiCariIdsi(array("id"=>$alisFaturasiIdleri[$i]["id"]));




      $alisFaturasiListesi[] = array(
        "alisFaturasiId"=>$alisFaturasiIdleri[$i]["id"],
        "alisFaturasiKodu"=>$alisFaturasi->getAlisFaturasiKodu(array("id"=>$alisFaturasiIdleri[$i]["id"])),
        "alisFaturasiMusteriAdi"=>$musteri->getMusteriAdiSoyadi(array("id"=>$alisFaturasiCariIdsi)),
        "alisFaturasiVadeTarihi"=>$this->fixDate($alisFaturasi->getAlisFaturasiVadeTarihi(array("id"=>$alisFaturasiIdleri[$i]["id"]))),
        "alisFaturasiTutari"=>$alisFaturasi->getAlisFaturasiTutari(array("id"=>$alisFaturasiIdleri[$i]["id"])),
        "alisFaturasiKurIsareti"=>$kur->getKurIsareti(array("id"=>$alisFaturasiKurIdsi)),
        "alisFaturasiAciklamasi"=>$alisFaturasi->getAlisFaturasiAciklamasi(array("id"=>$alisFaturasiIdleri[$i]["id"]))
      );

    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->alisFaturasiListesi = @$alisFaturasiListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("merkezler/fatura/alis-faturalari");
  }

  public function alisFaturasiGoruntule($alisFaturasiIdsi = false)
  {
    $model = new Model();
    $stmt = $model->dbh->prepare(
      "SELECT tbl_alis_faturalari.*,tbl_musteriler.musteri_adi_soyadi,tbl_musteri_adresleri.musteri_adresleri_adres AS musteri_adresi,tbl_musteriler.musteri_telefon_numarasi,
      tbl_kurlar.kur_isareti AS alis_faturasi_kur_isareti,tbl_kurlar.kur_kisaltmasi AS alis_faturasi_kur_kisaltmasi
      FROM tbl_alis_faturalari INNER JOIN tbl_musteriler ON tbl_musteriler.id=tbl_alis_faturalari.alis_faturasi_cari_idsi
      INNER JOIN tbl_kurlar ON tbl_alis_faturalari.alis_faturasi_kur_idsi=tbl_kurlar.id
      LEFT JOIN tbl_musteri_adresleri ON tbl_musteri_adresleri.musteri_adresleri_musteri_idsi=tbl_alis_faturalari.alis_faturasi_cari_idsi
      WHERE tbl_alis_faturalari.id=:id"
    );

    $stmt->execute(['id'=>$alisFaturasiIdsi]);
    $alisFaturasiBilgileri = $stmt->fetch();

    if ($alisFaturasiBilgileri["alis_faturasi_odenmis_miktar"] == $alisFaturasiBilgileri["alis_faturasi_tutari"]) {
      $alisFaturasiBilgileri["alis_faturasi_odeme_durumu"] = "<span class='badge bg-success'>Ödendi</span>";
    }else {
      $alisFaturasiBilgileri["alis_faturasi_odeme_durumu"] = "<span class='badge bg-orange'>Ödenmedi</span>";
    }


    $alisFaturasiBilgileri["alis_faturasi_max_odenebilir_tutar"] = $alisFaturasiBilgileri["alis_faturasi_tutari"] - $alisFaturasiBilgileri["alis_faturasi_odenmis_miktar"];

    $alisFaturasiBilgileri["alis_faturasi_tarihi"] = explode(" ",$alisFaturasiBilgileri["alis_faturasi_tarihi"]);
    $alisFaturasiBilgileri["alis_faturasi_tarihi"] = $this->fixDate($alisFaturasiBilgileri["alis_faturasi_tarihi"][0]);

    $alisFaturasiBilgileri["alis_faturasi_vade_tarihi"] = $this->fixDate($alisFaturasiBilgileri["alis_faturasi_vade_tarihi"]);




    $stmt = $model->dbh->prepare(
      "SELECT tbl_alis_faturasi_urunleri.*,tbl_vergiler.vergi_adi FROM tbl_alis_faturasi_urunleri
      INNER JOIN tbl_vergiler
      ON tbl_vergiler.id=tbl_alis_faturasi_urunleri.alis_faturasi_urun_vergi_idsi
      WHERE tbl_alis_faturasi_urunleri.alis_faturasi_idsi=:alis_faturasi_idsi"
    );

    $stmt->execute(['alis_faturasi_idsi'=>$alisFaturasiIdsi]);
    $alisFaturasiUrunleri = $stmt->fetchAll();

    $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
    $stmt->execute();
    $kasalar = $stmt->fetchAll();

    $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
    $stmt->execute();
    $birincilKasaIdsi = $stmt->fetch();

    $this->view->kasalar = $kasalar;
    $this->view->birincilKasaIdsi = $birincilKasaIdsi["id"];
    $this->view->alisFaturasiUrunleri = $alisFaturasiUrunleri;
    $this->view->alisFaturasiBilgileri = $alisFaturasiBilgileri;
    $this->view->render("merkezler/fatura/alis-faturasi-goruntule");
  }

  public function alisFaturasiEkle()
  {
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

    if (isset($_POST["alisFaturasiEkle"])) {
      $veriler = json_decode($_POST["alisFaturasiEkle"],true);

      $alisFaturasi = new AlisFaturalari();
      $alisFaturasi->setAlisFaturasiKodu($veriler["txtAlisFaturasiKodu"]);
      $alisFaturasi->setAlisFaturasiSeriNumarasi($veriler["txtAlisFaturasiSeriNumarasi"]);
      $alisFaturasi->setAlisFaturasiVadeTarihi($veriler["txtAlisFaturasiVadeTarihi"]);
      $alisFaturasi->setAlisFaturasiCariIdsi($veriler["txtAlisFaturasiCariIdsi"]);
      $alisFaturasi->setAlisFaturasiAraToplami($veriler["txtAlisFaturasiAraToplami"]);
      $alisFaturasi->setAlisFaturasiIskonto($veriler["txtAlisFaturasiIskonto"]);
      $alisFaturasi->setAlisFaturasiVergiMiktari($veriler["txtAlisFaturasiVergiMiktari"]);
      $alisFaturasi->setAlisFaturasiTutari($veriler["txtAlisFaturasiTutari"]);
      $alisFaturasi->setAlisFaturasiKasaIdsi($veriler["txtAlisFaturasiKasaIdsi"]);
      $alisFaturasi->setAlisFaturasiOdenmisMiktar(0);
      $alisFaturasi->setAlisFaturasiAciklamasi($veriler["txtAlisFaturasiAciklamasi"]);
      $alisFaturasi->setAlisFaturasiKesenKullaniciIdsi($_SESSION["uid"]);
      $alisFaturasi->setAlisFaturasiKurIdsi($veriler["txtAlisFaturasiKurIdsi"]);

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
        for ($i=0; $i < count($veriler["txtAlisFaturasiUrunleri"]); $i++) {

          $alisFaturasiUrunleri = new AlisFaturasiUrunleri();

          $alisFaturasiUrunleri->setAlisFaturasiUrunleriFaturaIdsi($alisFaturasiIdsi);
          $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAdi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunAdi"]);
          $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAdedi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunAdedi"]);
          $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunBirimi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunBirimAdi"]);
          $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAlisFiyati($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunBirimTutari"]);
          $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunVergiIdsi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunVergiIdsi"]);
          $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunVergiMiktari($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunVergiMiktari"]);
          $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunTutari($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunTutari"]);
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
      }
      $alisFaturasi = null;
      $alisFaturasiUrunleri = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT * FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi,vergi_yuzdesi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
      $stmt->execute();
      $birincilKasaIdsi = $stmt->fetch();


      $this->view->vergiler = $vergiler;
      $this->view->birimler = $birimler;
      $this->view->kurlar = $kurlar;
      $this->view->kasalar = $kasalar;
      $this->view->birincilKurIdsi = $birincilKurIdsi["id"];
      $this->view->birincilKasaIdsi = $birincilKasaIdsi["id"];
      $this->view->render("merkezler/fatura/alis-faturasi-ekle");
    }
  }



  public function alisFaturasiDuzenle($faturaIdsi = false)
  {
    if (isset($_POST["alisFaturasiDuzenle"])) {
      $veriler = json_decode($_POST["alisFaturasiDuzenle"],true);



      $alisFaturasi = new AlisFaturalari();
      $alisFaturasi->setAlisFaturasiIdsi($veriler["txtAlisFaturasiIdsi"]);
      $alisFaturasi->setAlisFaturasiKodu($veriler["txtAlisFaturasiKodu"]);
      $alisFaturasi->setAlisFaturasiSeriNumarasi($veriler["txtAlisFaturasiSeriNumarasi"]);
      $alisFaturasi->setAlisFaturasiVadeTarihi($veriler["txtAlisFaturasiVadeTarihi"]);
      $alisFaturasi->setAlisFaturasiCariIdsi($veriler["txtAlisFaturasiCariIdsi"]);
      $alisFaturasi->setAlisFaturasiAraToplami($veriler["txtAlisFaturasiAraToplami"]);
      $alisFaturasi->setAlisFaturasiIskonto($veriler["txtAlisFaturasiIskonto"]);
      $alisFaturasi->setAlisFaturasiVergiMiktari($veriler["txtAlisFaturasiVergiMiktari"]);
      $alisFaturasi->setAlisFaturasiTutari($veriler["txtAlisFaturasiTutari"]);
      $alisFaturasi->setAlisFaturasiKasaIdsi($veriler["txtAlisFaturasiKasaIdsi"]);
      // $alisFaturasi->setAlisFaturasiOdenmisMiktar(0);
      $alisFaturasi->setAlisFaturasiAciklamasi($veriler["txtAlisFaturasiAciklamasi"]);
      $alisFaturasi->setAlisFaturasiKesenKullaniciIdsi($_SESSION["uid"]);
      $alisFaturasi->setAlisFaturasiKurIdsi($veriler["txtAlisFaturasiKurIdsi"]);

      $this->values = array(
        "alis_faturasi_kodu"=>$alisFaturasi->alisFaturasiKodu,
        "alis_faturasi_seri_numarasi"=>$alisFaturasi->alisFaturasiSeriNumarasi,
        "alis_faturasi_vade_tarihi"=>$alisFaturasi->alisFaturasiVadeTarihi,
        "alis_faturasi_cari_idsi"=>$alisFaturasi->alisFaturasiCariIdsi,
        "alis_faturasi_ara_toplami"=>$alisFaturasi->alisFaturasiAraToplami,
        "alis_faturasi_iskonto"=>$alisFaturasi->alisFaturasiIskonto,
        "alis_faturasi_vergi_miktari"=>$alisFaturasi->alisFaturasiVergiMiktari,
        "alis_faturasi_tutari"=>$alisFaturasi->alisFaturasiTutari,
        "alis_faturasi_kasa_idsi"=>$alisFaturasi->alisFaturasiKasaIdsi,
        "alis_faturasi_aciklamasi"=>$alisFaturasi->alisFaturasiAciklamasi,
        "alis_faturasi_kesen_kullanici_idsi"=>$alisFaturasi->alisFaturasiKesenKullaniciIdsi,
        "alis_faturasi_kur_idsi"=>$alisFaturasi->alisFaturasiKurIdsi,
        "id"=>$alisFaturasi->alisFaturasiIdsi
      );

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
        "alis_faturasi_aciklamasi",
        "alis_faturasi_kesen_kullanici_idsi",
        "alis_faturasi_kur_idsi"
      );

      $yanit = $this->dataUpdate();

      if ($yanit) {
        $model = new Model();
        $stmt = $model->dbh->prepare("DELETE FROM tbl_alis_faturasi_urunleri WHERE alis_faturasi_idsi=:alis_faturasi_idsi");
        $yanit = $stmt->execute(['alis_faturasi_idsi'=>$veriler["txtAlisFaturasiIdsi"]]);

        if ($yanit) {
          for ($i=0; $i < count($veriler["txtAlisFaturasiUrunleri"]); $i++) {

            $alisFaturasiUrunleri = new AlisFaturasiUrunleri();

            $alisFaturasiUrunleri->setAlisFaturasiUrunleriFaturaIdsi($veriler["txtAlisFaturasiIdsi"]);
            $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAdi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunAdi"]);
            $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAdedi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunAdedi"]);
            $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunBirimi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunBirimAdi"]);
            $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunAlisFiyati($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunBirimTutari"]);
            $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunVergiIdsi($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunVergiIdsi"]);
            $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunVergiMiktari($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunVergiMiktari"]);
            $alisFaturasiUrunleri->setAlisFaturasiUrunleriUrunTutari($veriler["txtAlisFaturasiUrunleri"][$i]["txtUrunTutari"]);
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
        }
      }

      $alisFaturasi = null;
      $model = null;
      $alisFaturasiUrunleri = null;

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_alis_faturalari.*,tbl_musteriler.musteri_adi_soyadi AS alis_faturasi_cari_adi
        FROM tbl_alis_faturalari
        INNER JOIN tbl_musteriler ON tbl_alis_faturalari.alis_faturasi_cari_idsi=tbl_musteriler.id
        WHERE tbl_alis_faturalari.id=:id"
      );
      $stmt->execute(['id'=>$faturaIdsi]);
      $faturaBilgileri = $stmt->fetch();

      $stmt = $model->dbh->prepare(
        "SELECT tbl_alis_faturasi_urunleri.*,tbl_birimler.id AS alis_faturasi_urun_birim_idsi,tbl_urunler.id AS alis_faturasi_urun_idsi,tbl_vergiler.vergi_adi
        FROM tbl_alis_faturasi_urunleri
        INNER JOIN tbl_urunler ON tbl_alis_faturasi_urunleri.alis_faturasi_urun_adi=tbl_urunler.urun_adi
        INNER JOIN tbl_birimler ON tbl_alis_faturasi_urunleri.alis_faturasi_urun_birimi=tbl_birimler.birim_adi
        INNER JOIN tbl_vergiler ON tbl_alis_faturasi_urunleri.alis_faturasi_urun_vergi_idsi=tbl_vergiler.id
        WHERE tbl_alis_faturasi_urunleri.alis_faturasi_idsi=:id"
      );
      $stmt->execute(['id'=>$faturaIdsi]);
      $faturaUrunleriBilgileri = $stmt->fetchAll();


      $stmt = $model->dbh->prepare("SELECT * FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi,vergi_yuzdesi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
      $stmt->execute();
      $birincilKasaIdsi = $stmt->fetch();

      $this->view->vergiler = $vergiler;
      $this->view->birimler = $birimler;
      $this->view->kurlar = $kurlar;
      $this->view->kasalar = $kasalar;
      $this->view->faturaBilgileri = $faturaBilgileri;
      $this->view->faturaUrunleriBilgileri = $faturaUrunleriBilgileri;
      $this->view->render("merkezler/fatura/alis-faturasi-duzenle");
    }
  }

  public function alisFaturasiOdemeYap()
  {
    if (isset($_POST["alisFaturasiOdemeYap"])) {
      $veriler = json_decode($_POST["alisFaturasiOdemeYap"],true);
      $alisFaturasi = new AlisFaturalari();
      $alisFaturasi->setAlisFaturasiIdsi($veriler["txtAlisFaturasiOdemeYapAlisFaturasiIdsi"]);
      $alisFaturasi->setAlisFaturasiOdenmisMiktar($veriler["txtAlisFaturasiOdemeYapOdenecekMiktar"]);
      $alisFaturasi->setAlisFaturasiKasaIdsi($veriler["txtAlisFaturasiOdemeYapKasaIdsi"]);

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_alis_faturalari
        SET alis_faturasi_odenmis_miktar=alis_faturasi_odenmis_miktar+:alis_faturasi_odenmis_miktar,
        alis_faturasi_kasa_idsi=:alis_faturasi_kasa_idsi
        WHERE id=:id"
      );
      $yanit = $stmt->execute(
        [
          'alis_faturasi_odenmis_miktar'=>$alisFaturasi->alisFaturasiOdenmisMiktar,
          'alis_faturasi_kasa_idsi'=>$alisFaturasi->alisFaturasiKasaIdsi,
          'id'=>$alisFaturasi->alisFaturasiIdsi
        ]
      );
      $alisFaturasi = null;
      $model = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }

  public function alisFaturasiSil()
  {
    if (isset($_POST["alisFaturasiSil"])) {
      $veriler = json_decode($_POST["alisFaturasiSil"],true);
      $this->tabloAdlari = array("tbl_alis_faturalari");
      for ($i=0; $i < count($veriler); $i++) {
        $alisFaturasi = new AlisFaturalari();
        $alisFaturasi->setAlisFaturasiIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$alisFaturasi->alisFaturasiIdsi
        );
        $yanit = $this->dataDelete();

        if ($yanit) {
          $model = new Model();
          $stmt = $model->dbh->prepare("DELETE FROM tbl_alis_faturasi_urunleri WHERE alis_faturasi_idsi=:alis_faturasi_idsi");
          $stmt->execute(['alis_faturasi_idsi'=>$alisFaturasi->alisFaturasiIdsi]);
        }
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /* ALIŞ FATURASI FONKSİYONLARI */

  /* SATIŞ FATURASI FONKSİYONLARI */

  public function satisFaturalari()
  {
    $this->tabloAdlari = array("tbl_satis_faturalari");
    $this->kolonAdlari = array(
      "satis_faturasi_kodu",
      "satis_faturasi_seri_numarasi",
      "satis_faturasi_vade_tarihi",
      "satis_faturasi_cari_idsi",
      "satis_faturasi_ara_toplami",
      "satis_faturasi_iskonto",
      "satis_faturasi_vergi_miktari",
      "satis_faturasi_tutari",
      "satis_faturasi_kasa_idsi",
      "satis_faturasi_odenmis_miktar",
      "satis_faturasi_aciklamasi",
      "satis_faturasi_kesen_kullanici_idsi",
      "satis_faturasi_kur_idsi"
    );

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $satisFaturasi = new SatisFaturalari();
    $kur = new Kurlar();
    $musteri = new Musteriler();
    $toplamVeriSayisi = $satisFaturasi->selectQuery($this->tabloAdlari[0],array("id"));
    $satisFaturasiIdleri = $satisFaturasi->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($satisFaturasiIdleri); $i++) {
      $satisFaturasiKurIdsi = $satisFaturasi->getSatisFaturasiKurIdsi(array("id"=>$satisFaturasiIdleri[$i]["id"]));
      $satisFaturasiCariIdsi = $satisFaturasi->getSatisFaturasiCariIdsi(array("id"=>$satisFaturasiIdleri[$i]["id"]));




      $satisFaturasiListesi[] = array(
        "satisFaturasiId"=>$satisFaturasiIdleri[$i]["id"],
        "satisFaturasiKodu"=>$satisFaturasi->getSatisFaturasiKodu(array("id"=>$satisFaturasiIdleri[$i]["id"])),
        "satisFaturasiMusteriAdi"=>$musteri->getMusteriAdiSoyadi(array("id"=>$satisFaturasiCariIdsi)),
        "satisFaturasiVadeTarihi"=>$this->fixDate($satisFaturasi->getSatisFaturasiVadeTarihi(array("id"=>$satisFaturasiIdleri[$i]["id"]))),
        "satisFaturasiTutari"=>$satisFaturasi->getSatisFaturasiTutari(array("id"=>$satisFaturasiIdleri[$i]["id"])),
        "satisFaturasiKurIsareti"=>$kur->getKurIsareti(array("id"=>$satisFaturasiKurIdsi)),
        "satisFaturasiAciklamasi"=>$satisFaturasi->getSatisFaturasiAciklamasi(array("id"=>$satisFaturasiIdleri[$i]["id"]))
      );

    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->satisFaturasiListesi = @$satisFaturasiListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("merkezler/fatura/satis-faturalari");
  }

  public function satisFaturasiGoruntule($satisFaturasiIdsi = false)
  {
    $model = new Model();
    $stmt = $model->dbh->prepare(
      "SELECT tbl_satis_faturalari.*,tbl_musteriler.musteri_adi_soyadi,tbl_musteri_adresleri.musteri_adresleri_adres AS musteri_adresi,tbl_musteriler.musteri_telefon_numarasi,
      tbl_kurlar.kur_isareti AS satis_faturasi_kur_isareti,tbl_kurlar.kur_kisaltmasi AS satis_faturasi_kur_kisaltmasi
      FROM tbl_satis_faturalari INNER JOIN tbl_musteriler ON tbl_musteriler.id=tbl_satis_faturalari.satis_faturasi_cari_idsi
      INNER JOIN tbl_kurlar ON tbl_satis_faturalari.satis_faturasi_kur_idsi=tbl_kurlar.id
      LEFT JOIN tbl_musteri_adresleri ON tbl_musteri_adresleri.musteri_adresleri_musteri_idsi=tbl_satis_faturalari.satis_faturasi_cari_idsi

      WHERE tbl_satis_faturalari.id=:id"
    );

    $stmt->execute(['id'=>$satisFaturasiIdsi]);
    $satisFaturasiBilgileri = $stmt->fetch();

    if ($satisFaturasiBilgileri["satis_faturasi_odenmis_miktar"] == $satisFaturasiBilgileri["satis_faturasi_tutari"]) {
      $satisFaturasiBilgileri["satis_faturasi_odeme_durumu"] = "<span class='badge bg-success'>Ödendi</span>";
    }else {
      $satisFaturasiBilgileri["satis_faturasi_odeme_durumu"] = "<span class='badge bg-orange'>Ödenmedi</span>";
    }


    $satisFaturasiBilgileri["satis_faturasi_max_odenebilir_tutar"] = $satisFaturasiBilgileri["satis_faturasi_tutari"] - $satisFaturasiBilgileri["satis_faturasi_odenmis_miktar"];

    $satisFaturasiBilgileri["satis_faturasi_tarihi"] = explode(" ",$satisFaturasiBilgileri["satis_faturasi_tarihi"]);
    $satisFaturasiBilgileri["satis_faturasi_tarihi"] = $this->fixDate($satisFaturasiBilgileri["satis_faturasi_tarihi"][0]);

    $satisFaturasiBilgileri["satis_faturasi_vade_tarihi"] = $this->fixDate($satisFaturasiBilgileri["satis_faturasi_vade_tarihi"]);




    $stmt = $model->dbh->prepare(
      "SELECT tbl_satis_faturasi_urunleri.*,tbl_vergiler.vergi_adi FROM tbl_satis_faturasi_urunleri
      INNER JOIN tbl_vergiler
      ON tbl_vergiler.id=tbl_satis_faturasi_urunleri.satis_faturasi_urun_vergi_idsi
      WHERE tbl_satis_faturasi_urunleri.satis_faturasi_idsi=:satis_faturasi_idsi"
    );

    $stmt->execute(['satis_faturasi_idsi'=>$satisFaturasiIdsi]);
    $satisFaturasiUrunleri = $stmt->fetchAll();

    $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
    $stmt->execute();
    $kasalar = $stmt->fetchAll();

    $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
    $stmt->execute();
    $birincilKasaIdsi = $stmt->fetch();

    $this->view->kasalar = $kasalar;
    $this->view->birincilKasaIdsi = $birincilKasaIdsi["id"];
    $this->view->satisFaturasiUrunleri = $satisFaturasiUrunleri;
    $this->view->satisFaturasiBilgileri = $satisFaturasiBilgileri;
    $this->view->render("merkezler/fatura/satis-faturasi-goruntule");
  }

  public function satisFaturasiEkle()
  {
    $this->tabloAdlari = array("tbl_satis_faturalari");
    $this->kolonAdlari = array(
      "satis_faturasi_kodu",
      "satis_faturasi_seri_numarasi",
      "satis_faturasi_vade_tarihi",
      "satis_faturasi_cari_idsi",
      "satis_faturasi_ara_toplami",
      "satis_faturasi_iskonto",
      "satis_faturasi_vergi_miktari",
      "satis_faturasi_tutari",
      "satis_faturasi_kasa_idsi",
      "satis_faturasi_odenmis_miktar",
      "satis_faturasi_aciklamasi",
      "satis_faturasi_kesen_kullanici_idsi",
      "satis_faturasi_kur_idsi"
    );

    if (isset($_POST["satisFaturasiEkle"])) {
      $veriler = json_decode($_POST["satisFaturasiEkle"],true);

      $satisFaturasi = new SatisFaturalari();
      $satisFaturasi->setSatisFaturasiKodu($veriler["txtSatisFaturasiKodu"]);
      $satisFaturasi->setSatisFaturasiSeriNumarasi($veriler["txtSatisFaturasiSeriNumarasi"]);
      $satisFaturasi->setSatisFaturasiVadeTarihi($veriler["txtSatisFaturasiVadeTarihi"]);
      $satisFaturasi->setSatisFaturasiCariIdsi($veriler["txtSatisFaturasiCariIdsi"]);
      $satisFaturasi->setSatisFaturasiAraToplami($veriler["txtSatisFaturasiAraToplami"]);
      $satisFaturasi->setSatisFaturasiIskonto($veriler["txtSatisFaturasiIskonto"]);
      $satisFaturasi->setSatisFaturasiVergiMiktari($veriler["txtSatisFaturasiVergiMiktari"]);
      $satisFaturasi->setSatisFaturasiTutari($veriler["txtSatisFaturasiTutari"]);
      $satisFaturasi->setSatisFaturasiKasaIdsi($veriler["txtSatisFaturasiKasaIdsi"]);
      $satisFaturasi->setSatisFaturasiOdenmisMiktar(0);
      $satisFaturasi->setSatisFaturasiAciklamasi($veriler["txtSatisFaturasiAciklamasi"]);
      $satisFaturasi->setSatisFaturasiKesenKullaniciIdsi($_SESSION["uid"]);
      $satisFaturasi->setSatisFaturasiKurIdsi($veriler["txtSatisFaturasiKurIdsi"]);

      $this->values = array(
        $satisFaturasi->satisFaturasiKodu,
        $satisFaturasi->satisFaturasiSeriNumarasi,
        $satisFaturasi->satisFaturasiVadeTarihi,
        $satisFaturasi->satisFaturasiCariIdsi,
        $satisFaturasi->satisFaturasiAraToplami,
        $satisFaturasi->satisFaturasiIskonto,
        $satisFaturasi->satisFaturasiVergiMiktari,
        $satisFaturasi->satisFaturasiTutari,
        $satisFaturasi->satisFaturasiKasaIdsi,
        $satisFaturasi->satisFaturasiOdenmisMiktar,
        $satisFaturasi->satisFaturasiAciklamasi,
        $satisFaturasi->satisFaturasiKesenKullaniciIdsi,
        $satisFaturasi->satisFaturasiKurIdsi
      );
      $yanit = $this->dataInsert();

      if ($yanit["yanit"]) {
        $satisFaturasiIdsi = $yanit["lastId"];
        for ($i=0; $i < count($veriler["txtSatisFaturasiUrunleri"]); $i++) {

          $satisFaturasiUrunleri = new SatisFaturasiUrunleri();

          $satisFaturasiUrunleri->setSatisFaturasiUrunleriFaturaIdsi($satisFaturasiIdsi);
          $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunAdi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunAdi"]);
          $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunAdedi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunAdedi"]);
          $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunBirimi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunBirimAdi"]);
          $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunSatisFiyati($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunBirimTutari"]);
          $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunVergiIdsi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunVergiIdsi"]);
          $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunVergiMiktari($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunVergiMiktari"]);
          $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunTutari($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunTutari"]);
          $this->tabloAdlari = array("tbl_satis_faturasi_urunleri");
          $this->kolonAdlari = array(
            "satis_faturasi_idsi",
            "satis_faturasi_urun_adi",
            "satis_faturasi_urun_adedi",
            "satis_faturasi_urun_birimi",
            "satis_faturasi_urun_satis_fiyati",
            "satis_faturasi_urun_vergi_idsi",
            "satis_faturasi_urun_vergi_miktari",
            "satis_faturasi_urun_tutari"
          );
          $this->values = array(
            $satisFaturasiUrunleri->satisFaturasiUrunleriFaturaIdsi,
            $satisFaturasiUrunleri->satisFaturasiUrunleriUrunAdi,
            $satisFaturasiUrunleri->satisFaturasiUrunleriUrunAdedi,
            $satisFaturasiUrunleri->satisFaturasiUrunleriUrunBirimi,
            $satisFaturasiUrunleri->satisFaturasiUrunleriUrunSatisFiyati,
            $satisFaturasiUrunleri->satisFaturasiUrunleriUrunVergiIdsi,
            $satisFaturasiUrunleri->satisFaturasiUrunleriUrunVergiMiktari,
            $satisFaturasiUrunleri->satisFaturasiUrunleriUrunTutari
          );

          $yanit = $this->dataInsert();

        }
      }
      $satisFaturasi = null;
      $satisFaturasiUrunleri = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT * FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi,vergi_yuzdesi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
      $stmt->execute();
      $birincilKasaIdsi = $stmt->fetch();


      $this->view->vergiler = $vergiler;
      $this->view->birimler = $birimler;
      $this->view->kurlar = $kurlar;
      $this->view->kasalar = $kasalar;
      $this->view->birincilKurIdsi = $birincilKurIdsi["id"];
      $this->view->birincilKasaIdsi = $birincilKasaIdsi["id"];
      $this->view->render("merkezler/fatura/satis-faturasi-ekle");
    }
  }



  public function satisFaturasiDuzenle($faturaIdsi = false)
  {
    if (isset($_POST["satisFaturasiDuzenle"])) {
      $veriler = json_decode($_POST["satisFaturasiDuzenle"],true);



      $satisFaturasi = new SatisFaturalari();
      $satisFaturasi->setSatisFaturasiIdsi($veriler["txtSatisFaturasiIdsi"]);
      $satisFaturasi->setSatisFaturasiKodu($veriler["txtSatisFaturasiKodu"]);
      $satisFaturasi->setSatisFaturasiSeriNumarasi($veriler["txtSatisFaturasiSeriNumarasi"]);
      $satisFaturasi->setSatisFaturasiVadeTarihi($veriler["txtSatisFaturasiVadeTarihi"]);
      $satisFaturasi->setSatisFaturasiCariIdsi($veriler["txtSatisFaturasiCariIdsi"]);
      $satisFaturasi->setSatisFaturasiAraToplami($veriler["txtSatisFaturasiAraToplami"]);
      $satisFaturasi->setSatisFaturasiIskonto($veriler["txtSatisFaturasiIskonto"]);
      $satisFaturasi->setSatisFaturasiVergiMiktari($veriler["txtSatisFaturasiVergiMiktari"]);
      $satisFaturasi->setSatisFaturasiTutari($veriler["txtSatisFaturasiTutari"]);
      $satisFaturasi->setSatisFaturasiKasaIdsi($veriler["txtSatisFaturasiKasaIdsi"]);
      // $satisFaturasi->setSatisFaturasiOdenmisMiktar(0);
      $satisFaturasi->setSatisFaturasiAciklamasi($veriler["txtSatisFaturasiAciklamasi"]);
      $satisFaturasi->setSatisFaturasiKesenKullaniciIdsi($_SESSION["uid"]);
      $satisFaturasi->setSatisFaturasiKurIdsi($veriler["txtSatisFaturasiKurIdsi"]);

      $this->values = array(
        "satis_faturasi_kodu"=>$satisFaturasi->satisFaturasiKodu,
        "satis_faturasi_seri_numarasi"=>$satisFaturasi->satisFaturasiSeriNumarasi,
        "satis_faturasi_vade_tarihi"=>$satisFaturasi->satisFaturasiVadeTarihi,
        "satis_faturasi_cari_idsi"=>$satisFaturasi->satisFaturasiCariIdsi,
        "satis_faturasi_ara_toplami"=>$satisFaturasi->satisFaturasiAraToplami,
        "satis_faturasi_iskonto"=>$satisFaturasi->satisFaturasiIskonto,
        "satis_faturasi_vergi_miktari"=>$satisFaturasi->satisFaturasiVergiMiktari,
        "satis_faturasi_tutari"=>$satisFaturasi->satisFaturasiTutari,
        "satis_faturasi_kasa_idsi"=>$satisFaturasi->satisFaturasiKasaIdsi,
        "satis_faturasi_aciklamasi"=>$satisFaturasi->satisFaturasiAciklamasi,
        "satis_faturasi_kesen_kullanici_idsi"=>$satisFaturasi->satisFaturasiKesenKullaniciIdsi,
        "satis_faturasi_kur_idsi"=>$satisFaturasi->satisFaturasiKurIdsi,
        "id"=>$satisFaturasi->satisFaturasiIdsi
      );

      $this->tabloAdlari = array("tbl_satis_faturalari");
      $this->kolonAdlari = array(
        "satis_faturasi_kodu",
        "satis_faturasi_seri_numarasi",
        "satis_faturasi_vade_tarihi",
        "satis_faturasi_cari_idsi",
        "satis_faturasi_ara_toplami",
        "satis_faturasi_iskonto",
        "satis_faturasi_vergi_miktari",
        "satis_faturasi_tutari",
        "satis_faturasi_kasa_idsi",
        "satis_faturasi_aciklamasi",
        "satis_faturasi_kesen_kullanici_idsi",
        "satis_faturasi_kur_idsi"
      );

      $yanit = $this->dataUpdate();

      if ($yanit) {
        $model = new Model();
        $stmt = $model->dbh->prepare("DELETE FROM tbl_satis_faturasi_urunleri WHERE satis_faturasi_idsi=:satis_faturasi_idsi");
        $yanit = $stmt->execute(['satis_faturasi_idsi'=>$veriler["txtSatisFaturasiIdsi"]]);

        if ($yanit) {
          for ($i=0; $i < count($veriler["txtSatisFaturasiUrunleri"]); $i++) {

            $satisFaturasiUrunleri = new SatisFaturasiUrunleri();

            $satisFaturasiUrunleri->setSatisFaturasiUrunleriFaturaIdsi($veriler["txtSatisFaturasiIdsi"]);
            $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunAdi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunAdi"]);
            $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunAdedi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunAdedi"]);
            $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunBirimi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunBirimAdi"]);
            $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunSatisFiyati($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunBirimTutari"]);
            $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunVergiIdsi($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunVergiIdsi"]);
            $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunVergiMiktari($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunVergiMiktari"]);
            $satisFaturasiUrunleri->setSatisFaturasiUrunleriUrunTutari($veriler["txtSatisFaturasiUrunleri"][$i]["txtUrunTutari"]);
            $this->tabloAdlari = array("tbl_satis_faturasi_urunleri");
            $this->kolonAdlari = array(
              "satis_faturasi_idsi",
              "satis_faturasi_urun_adi",
              "satis_faturasi_urun_adedi",
              "satis_faturasi_urun_birimi",
              "satis_faturasi_urun_satis_fiyati",
              "satis_faturasi_urun_vergi_idsi",
              "satis_faturasi_urun_vergi_miktari",
              "satis_faturasi_urun_tutari"
            );
            $this->values = array(
              $satisFaturasiUrunleri->satisFaturasiUrunleriFaturaIdsi,
              $satisFaturasiUrunleri->satisFaturasiUrunleriUrunAdi,
              $satisFaturasiUrunleri->satisFaturasiUrunleriUrunAdedi,
              $satisFaturasiUrunleri->satisFaturasiUrunleriUrunBirimi,
              $satisFaturasiUrunleri->satisFaturasiUrunleriUrunSatisFiyati,
              $satisFaturasiUrunleri->satisFaturasiUrunleriUrunVergiIdsi,
              $satisFaturasiUrunleri->satisFaturasiUrunleriUrunVergiMiktari,
              $satisFaturasiUrunleri->satisFaturasiUrunleriUrunTutari
            );
            $yanit = $this->dataInsert();

          }
        }
      }

      $satisFaturasi = null;
      $model = null;
      $satisFaturasiUrunleri = null;

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_satis_faturalari.*,tbl_musteriler.musteri_adi_soyadi AS satis_faturasi_cari_adi
        FROM tbl_satis_faturalari
        INNER JOIN tbl_musteriler ON tbl_satis_faturalari.satis_faturasi_cari_idsi=tbl_musteriler.id
        WHERE tbl_satis_faturalari.id=:id"
      );
      $stmt->execute(['id'=>$faturaIdsi]);
      $faturaBilgileri = $stmt->fetch();

      $stmt = $model->dbh->prepare(
        "SELECT tbl_satis_faturasi_urunleri.*,tbl_birimler.id AS satis_faturasi_urun_birim_idsi,tbl_urunler.id AS satis_faturasi_urun_idsi,tbl_vergiler.vergi_adi
        FROM tbl_satis_faturasi_urunleri
        INNER JOIN tbl_urunler ON tbl_satis_faturasi_urunleri.satis_faturasi_urun_adi=tbl_urunler.urun_adi
        INNER JOIN tbl_birimler ON tbl_satis_faturasi_urunleri.satis_faturasi_urun_birimi=tbl_birimler.birim_adi
        INNER JOIN tbl_vergiler ON tbl_satis_faturasi_urunleri.satis_faturasi_urun_vergi_idsi=tbl_vergiler.id
        WHERE tbl_satis_faturasi_urunleri.satis_faturasi_idsi=:id"
      );
      $stmt->execute(['id'=>$faturaIdsi]);
      $faturaUrunleriBilgileri = $stmt->fetchAll();


      $stmt = $model->dbh->prepare("SELECT * FROM tbl_kurlar");
      $stmt->execute();
      $kurlar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,birim_adi FROM tbl_birimler");
      $stmt->execute();
      $birimler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id,vergi_adi,vergi_yuzdesi FROM tbl_vergiler");
      $stmt->execute();
      $vergiler = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $birincilKurIdsi = $stmt->fetch();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
      $stmt->execute();
      $birincilKasaIdsi = $stmt->fetch();

      $this->view->vergiler = $vergiler;
      $this->view->birimler = $birimler;
      $this->view->kurlar = $kurlar;
      $this->view->kasalar = $kasalar;
      $this->view->faturaBilgileri = $faturaBilgileri;
      $this->view->faturaUrunleriBilgileri = $faturaUrunleriBilgileri;
      $this->view->render("merkezler/fatura/satis-faturasi-duzenle");
    }
  }

  public function satisFaturasiOdemeAl()
  {
    if (isset($_POST["satisFaturasiOdemeAl"])) {
      $veriler = json_decode($_POST["satisFaturasiOdemeAl"],true);
      $satisFaturasi = new SatisFaturalari();
      $satisFaturasi->setSatisFaturasiIdsi($veriler["txtSatisFaturasiOdemeYapSatisFaturasiIdsi"]);
      $satisFaturasi->setSatisFaturasiOdenmisMiktar($veriler["txtSatisFaturasiOdemeYapOdenecekMiktar"]);
      $satisFaturasi->setSatisFaturasiKasaIdsi($veriler["txtSatisFaturasiOdemeYapKasaIdsi"]);

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_satis_faturalari
        SET satis_faturasi_odenmis_miktar=satis_faturasi_odenmis_miktar+:satis_faturasi_odenmis_miktar,
        satis_faturasi_kasa_idsi=:satis_faturasi_kasa_idsi
        WHERE id=:id"
      );
      $yanit = $stmt->execute(
        [
          'satis_faturasi_odenmis_miktar'=>$satisFaturasi->satisFaturasiOdenmisMiktar,
          'satis_faturasi_kasa_idsi'=>$satisFaturasi->satisFaturasiKasaIdsi,
          'id'=>$satisFaturasi->satisFaturasiIdsi
        ]
      );
      $satisFaturasi = null;
      $model = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }

  public function satisFaturasiSil()
  {
    if (isset($_POST["satisFaturasiSil"])) {
      $veriler = json_decode($_POST["satisFaturasiSil"],true);
      $this->tabloAdlari = array("tbl_satis_faturalari");
      for ($i=0; $i < count($veriler); $i++) {
        $satisFaturasi = new SatisFaturalari();
        $satisFaturasi->setSatisFaturasiIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$satisFaturasi->satisFaturasiIdsi
        );
        $yanit = $this->dataDelete();

        if ($yanit) {
          $model = new Model();
          $stmt = $model->dbh->prepare("DELETE FROM tbl_satis_faturasi_urunleri WHERE satis_faturasi_idsi=:satis_faturasi_idsi");
          $stmt->execute(['satis_faturasi_idsi'=>$satisFaturasi->satisFaturasiIdsi]);
        }
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }

  /* SATIŞ FATURASI FONKSİYONLARI */


  /* ORTAK FONKSİYONLAR */
  public function faturaUrunBilgileriniAl()
  {
    if (isset($_POST["faturaUrunBilgileriniAl"])) {
      $urunId = $_POST["faturaUrunBilgileriniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT urun_birim_idsi,urun_alis_fiyati,urun_alis_vergi_idsi,urun_satis_fiyati,urun_satis_vergi_idsi FROM tbl_urunler WHERE id=:id");
      $stmt->execute(['id'=>$urunId]);
      $urunBilgileri = $stmt->fetch();

      echo json_encode(array(
        "urunBilgileri"=>$urunBilgileri
      ));
    }
  }
  /* ORTAK FONKSİYONLAR */
}
