<?php

/**
*
*/
class Restoran extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_kurlar");
    $this->kolonAdlari = array("kur_adi","kur_isareti","kur_kisaltmasi","kur_aktif_mi");

    $this->sayfaIzınAdi = "txtSiparisAlabilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }



  /*DÖVİZ ÇEVİRİCİ KODLARI*/
  function dovizCevir()
  {
    if (isset($_POST["dovizCevir"])) {
      $veriler = json_decode($_POST["dovizCevir"],true);
      $veriler["txtGirisMiktari"] = number_format($veriler["txtGirisMiktari"],2);

      $connect_web = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');

      $usd_buying = $connect_web->Currency[0]->BanknoteBuying;
      $usd_selling = $connect_web->Currency[0]->BanknoteSelling;
      $euro_buying = $connect_web->Currency[3]->BanknoteBuying;
      $euro_selling = $connect_web->Currency[3]->BanknoteSelling;

      switch ($veriler["txtGirisKuru"]) {
        case 'TRY':
        $dolarKarsilikAlis = $veriler["txtGirisMiktari"] * floatval($usd_buying);
        $dolarKarsilikSatis = $veriler["txtGirisMiktari"] * floatval($usd_selling);
        $euroKarsilikAlis = $veriler["txtGirisMiktari"] * floatval($euro_buying);
        $euroKarsilikSatis = $veriler["txtGirisMiktari"] * floatval($euro_selling);
        $tlKarsilikAlis = $veriler["txtGirisMiktari"];
        $tlKarsilikSatis = $veriler["txtGirisMiktari"];
          break;
        default:
          // code...
          break;
      }


      echo json_encode(array(
        "dolarKarsilikAlis"=>$dolarKarsilikAlis,
        "dolarKarsilikSatis"=>$dolarKarsilikSatis,
        "euroKarsilikAlis"=>$euroKarsilikAlis,
        "euroKarsilikSatis"=>$euroKarsilikSatis,
        "tlKarsilikAlis"=>$tlKarsilikAlis,
        "tlKarsilikSatis"=>$tlKarsilikSatis
      ));

    }
  }
  /*DÖVİZ ÇEVİRİCİ KODLARI*/

  /*MÜŞTERİ EKRANI SAYFASI*/
  public function musteriEkrani()
  {
    $limit = 40;
    $offset = 0;

    $model = new Model();


    $stmt = $model->dbh->prepare(
      "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyon_urunleri.id AS adisyon_urunleri_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi
      FROM `tbl_adisyon_urunleri`
      LEFT JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
      WHERE tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi=0 OR tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi=1 ORDER BY tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi DESC LIMIT :limit_degeri OFFSET :offset_degeri"
    );
    $stmt->bindValue(':limit_degeri', (int) $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset_degeri', (int) $offset, PDO::PARAM_INT);
    $stmt->execute();

    $bekleyenUrunler = $stmt->fetchAll();


    $musteriSiparisleri = array();

    for ($i=0; $i < count($bekleyenUrunler); $i++) {
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyon_urunleri.*,tbl_urunler.urun_adi,tbl_masalar.masa_adi
        FROM `tbl_adisyon_urunleri`
        LEFT JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
        LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
        LEFT JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
        WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_idsi"
      );
      $stmt->execute(['adisyon_urunleri_idsi'=>$bekleyenUrunler[$i]["adisyon_urunleri_idsi"]]);
      $musteriSiparisleri[] = $stmt->fetch();

    }

    for ($i=0; $i < count($musteriSiparisleri); $i++) {
      $musteriSiparisleri[$i]["adisyon_urunleri_urun_siparis_saati"] = $this->fixDateTime($musteriSiparisleri[$i]["adisyon_urunleri_urun_siparis_saati"]);
      $musteriSiparisleri[$i]["adisyon_urunleri_urun_siparis_saati"] = explode(" ",$musteriSiparisleri[$i]["adisyon_urunleri_urun_siparis_saati"]);
      $musteriSiparisleri[$i]["adisyon_urunleri_urun_siparis_saati"] = $musteriSiparisleri[$i]["adisyon_urunleri_urun_siparis_saati"][1];
    }

    // print_r($musteriSiparisleri);
    $this->view->musteriSiparisleri = $musteriSiparisleri;
    $this->view->render("restoran/musteri-ekrani/");
  }
  /*MÜŞTERİ EKRANI SAYFASI*/

  /*MUTFAK SİPARİŞ DURUM DEĞİŞTİR KODLARI*/
  public function siparisDurumDegistir()
  {
    $veriler = json_decode($_POST["siparisDurumDegistir"],true);

    $adisyon = new Adisyonlar();
    $adisyon->adisyonUrunleri = new AdisyonUrunleri();
    $adisyon->adisyonUrunleri->setAdisyonUrunleriIdsi($veriler["txtAdisyonUrunuIdsi"]);
    $adisyon->adisyonUrunleri->setAdisyonUrunleriUrunTeslimDurumuIdsi($veriler["txtTeslimDurumuIdsi"]);

    $model = new Model();
    $stmt = $model->dbh->prepare("UPDATE tbl_adisyon_urunleri SET adisyon_urunleri_urun_teslim_durumu_idsi=:adisyon_urunleri_urun_teslim_durumu_idsi WHERE id=:adisyon_urunleri_idsi");
    $yanit = $stmt->execute([
      'adisyon_urunleri_urun_teslim_durumu_idsi'=>$adisyon->adisyonUrunleri->adisyonUrunleriUrunTeslimDurumuIdsi,
      'adisyon_urunleri_idsi'=>$adisyon->adisyonUrunleri->adisyonUrunleriIdsi
    ]);

    echo json_encode(array(
      "yanit"=>$yanit
    ));
  }
  /*MUTFAK SİPARİŞ DURUM DEĞİŞTİR KODLARI*/

  /*MUTFAK SİPARİŞLERİNİ GÜNCELLEME KODLARI*/
  public function mutfakSiparisleriniGuncelle()
  {
    if (isset($_POST["mutfakSiparisleriniGuncelle"])) {
      $mutfakIdsi = $_POST["mutfakSiparisleriniGuncelle"];
      $limit = 10;
      $offset = 0;

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT mutfak_adi FROM tbl_mutfaklar WHERE id=:mutfak_idsi");
      $stmt->execute(['mutfak_idsi'=>$mutfakIdsi]);
      $mutfakAdi = $stmt->fetch()["mutfak_adi"];

      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyon_urunleri.id AS adisyon_urunleri_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi,tbl_urunler.urun_mutfak_idleri
        FROM `tbl_adisyon_urunleri`
        LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
        LEFT JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
        ORDER BY tbl_adisyon_urunleri.id DESC LIMIT :limit_degeri OFFSET :offset_degeri"
      );
      $stmt->bindValue(':limit_degeri', (int) $limit, PDO::PARAM_INT);
      $stmt->bindValue(':offset_degeri', (int) $offset, PDO::PARAM_INT);
      $stmt->execute();

      $bekleyenUrunler = $stmt->fetchAll();

      $mutfakUrunleri = array();

      for ($i=0; $i < count($bekleyenUrunler); $i++) {
        if ($bekleyenUrunler[$i]["urun_mutfak_idleri"]) {

          $urununMutfakIdleri = json_decode($bekleyenUrunler[$i]["urun_mutfak_idleri"],true);

          if (in_array($mutfakIdsi,$urununMutfakIdleri)) {
            $stmt = $model->dbh->prepare(
              "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyon_urunleri.*,tbl_urunler.urun_adi,tbl_masalar.masa_adi,tbl_teslim_durumlari.teslim_durumu_adi,tbl_teslim_durumlari.teslim_durumu_rengi
              FROM `tbl_adisyon_urunleri`
              LEFT JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
              LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
              LEFT JOIN tbl_teslim_durumlari ON tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi=tbl_teslim_durumlari.id
              LEFT JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
              WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_idsi"
            );
            $stmt->execute(['adisyon_urunleri_idsi'=>$bekleyenUrunler[$i]["adisyon_urunleri_idsi"]]);
            $mutfakUrunleri[] = $stmt->fetch();
          }
        }
      }

      $adisyonUrunleriIdleri = array();
      for ($i=0; $i < count($mutfakUrunleri); $i++) {
        $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"] = $this->fixDateTime($mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"]);
        $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"] = explode(" ",$mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"]);
        $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"] = $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"][1];
        array_push($adisyonUrunleriIdleri,$mutfakUrunleri[$i]["id"]);
      }

      echo json_encode(array(
        "mutfakUrunleri"=>$mutfakUrunleri,
        "adisyonUrunleriIdleri"=>$adisyonUrunleriIdleri
      ));

    }
  }
  /*MUTFAK SİPARİŞLERİNİ GÜNCELLEME KODLARI*/

  /*BİR MUTFAĞIN SAYFASI*/
  public function mutfaklar($mutfakIdsi = false)
  {
    $limit = 40;
    $offset = 0;

    $model = new Model();


    /*TESLİM DURUMLARI*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_teslim_durumlari");
    $stmt->execute();
    $teslimDurumlari = $stmt->fetchAll();
    /*TESLİM DURUMLARI*/

    $stmt = $model->dbh->prepare("SELECT mutfak_adi FROM tbl_mutfaklar WHERE id=:mutfak_idsi");
    $stmt->execute(['mutfak_idsi'=>$mutfakIdsi]);
    $mutfakAdi = $stmt->fetch()["mutfak_adi"];

    $stmt = $model->dbh->prepare(
      "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyon_urunleri.id AS adisyon_urunleri_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi,tbl_urunler.urun_mutfak_idleri
      FROM `tbl_adisyon_urunleri`
      LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
      LEFT JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
      ORDER BY tbl_adisyon_urunleri.id DESC LIMIT :limit_degeri OFFSET :offset_degeri"
    );
    $stmt->bindValue(':limit_degeri', (int) $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset_degeri', (int) $offset, PDO::PARAM_INT);
    $stmt->execute();

    $bekleyenUrunler = $stmt->fetchAll();

    $mutfakUrunleri = array();

    for ($i=0; $i < count($bekleyenUrunler); $i++) {
      if ($bekleyenUrunler[$i]["urun_mutfak_idleri"]) {

        $urununMutfakIdleri = json_decode($bekleyenUrunler[$i]["urun_mutfak_idleri"],true);

        if (in_array($mutfakIdsi,$urununMutfakIdleri)) {
          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyon_urunleri.*,tbl_urunler.urun_adi,tbl_masalar.masa_adi,tbl_teslim_durumlari.teslim_durumu_adi,tbl_teslim_durumlari.teslim_durumu_rengi
            FROM `tbl_adisyon_urunleri`
            LEFT JOIN tbl_adisyonlar ON tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi=tbl_adisyonlar.id
            LEFT JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
            LEFT JOIN tbl_teslim_durumlari ON tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi=tbl_teslim_durumlari.id
            LEFT JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_idsi"
          );
          $stmt->execute(['adisyon_urunleri_idsi'=>$bekleyenUrunler[$i]["adisyon_urunleri_idsi"]]);
          $mutfakUrunleri[] = $stmt->fetch();
        }
      }
    }

    for ($i=0; $i < count($mutfakUrunleri); $i++) {
      $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"] = $this->fixDateTime($mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"]);
      $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"] = explode(" ",$mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"]);
      $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"] = $mutfakUrunleri[$i]["adisyon_urunleri_urun_siparis_saati"][1];
    }

    // print_r($mutfakUrunleri);
    $this->view->teslimDurumlari = $teslimDurumlari;
    $this->view->mutfakAdi = $mutfakAdi;
    $this->view->mutfakIdsi = $mutfakIdsi;
    $this->view->mutfakUrunleri = $mutfakUrunleri;
    $this->view->render("restoran/mutfaklar/");
  }
  /*BİR MUTFAĞIN SAYFASI*/

  /*MUTFAK EKRANLARI LİSTESİ SAYFASI*/
  public function mutfakEkranlari()
  {
    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT tbl_mutfaklar.*,tbl_yazicilar.yazici_adi FROM tbl_mutfaklar INNER JOIN tbl_yazicilar ON tbl_mutfaklar.mutfak_yazici_idsi=tbl_yazicilar.id");
    $stmt->execute();
    $mutfaklar = $stmt->fetchAll();

    $this->view->mutfaklar = $mutfaklar;
    $this->view->render("restoran/mutfak-ekranlari/");

  }
  /*MUTFAK EKRANLARI LİSTESİ SAYFASI*/

  /*STOK AZALAN BİTEN ÜRÜNLERİ ALMA KODLARI*/
  public function stokBitenUrunleriAl()
  {
    if (isset($_POST["stokBitenUrunleriAl"])) {
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT id,urun_adi,urun_adedi FROM tbl_urunler WHERE urun_stok_urunu_mu=1 AND urun_alt_uyari_degeri>urun_adedi");
      $stmt->execute();
      $stokAzalanUrunler = $stmt->fetchAll();

      echo json_encode(array(
        "stokAzalanUrunler"=>$stokAzalanUrunler
      ));
    }
  }
  /*STOK AZALAN BİTEN ÜRÜNLERİ ALMA KODLARI*/

  /*MÜŞTERİ ADRESLERİNİ ALMA KODLARI*/
  public function musteriAdresleriniAl()
  {
    if (isset($_POST["musteriAdresleriniAl"])) {
      $musteriIdsi = $_POST["musteriAdresleriniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT id,musteri_adresleri_adres,musteri_adresleri_adres_varsayilan_mi FROM tbl_musteri_adresleri WHERE musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi");
      $stmt->execute(["musteri_adresleri_musteri_idsi"=>$musteriIdsi]);
      $musteriAdresleri = $stmt->fetchAll();

      echo json_encode(array(
        "musteriAdresleri"=>$musteriAdresleri
      ));
    }
  }

  public function musteriAdresiniDegistir()
  {
    if (isset($_POST["musteriAdresiniDegistir"])) {
      $veriler = json_decode($_POST["musteriAdresiniDegistir"],true);

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "UPDATE tbl_musteri_adresleri SET
        musteri_adresleri_adres_varsayilan_mi=0
        WHERE musteri_adresleri_musteri_idsi=:musteri_idsi"
      );
      $yanit = $stmt->execute(["musteri_idsi"=>$veriler["txtMusteriIdsi"]]);

      if ($yanit) {
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_musteri_adresleri SET
          musteri_adresleri_adres_varsayilan_mi=1
          WHERE musteri_adresleri_musteri_idsi=:musteri_idsi
          AND id=:adres_idsi"
        );
        $yanit = $stmt->execute([
          "musteri_idsi"=>$veriler["txtMusteriIdsi"],
          "adres_idsi"=>$veriler["txtAdresIdsi"]
        ]);
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*MÜŞTERİ ADRESLERİNİ ALMA KODLARI*/


  /*MÜŞTERİ YENİ ADRES EKLE DEFAULT YAP KODLARI*/
  public function musteriYeniAdresEkle()
  {
    if (isset($_POST["musteriYeniAdresEkle"])) {
      $veriler = json_decode($_POST["musteriYeniAdresEkle"],true);

      $model = new Model();

      $stmt = $model->dbh->prepare(
        "INSERT INTO tbl_musteri_adresleri
        SET musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi,
        musteri_adresleri_adres=:musteri_adresleri_adres,
        musteri_adresleri_adres_varsayilan_mi=1
        "
      );
      $yanit = $stmt->execute([
        "musteri_adresleri_musteri_idsi"=>$veriler["txtMusteriIdsi"],
        "musteri_adresleri_adres"=>$veriler["txtMusteriAdresi"]
      ]);
      $lastId = $model->dbh->lastInsertId();

      if ($yanit) {
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_musteri_adresleri SET musteri_adresleri_adres_varsayilan_mi=0
           WHERE musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi AND id<>:last_id"
        );
        $yanit = $stmt->execute([
          "musteri_adresleri_musteri_idsi"=>$veriler["txtMusteriIdsi"],
          "last_id"=>$lastId
        ]);
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*MÜŞTERİ YENİ ADRES EKLE DEFAULT YAP KODLARI*/

  /*PAKET SERVİS SİPARİŞ ADİSYON YAZDIR KODLARI*/
  public function paketSiparisSiparisYazdir()
  {
    if (isset($_POST["paketSiparisSiparisYazdir"])) {
      $veriler = json_decode($_POST["paketSiparisSiparisYazdir"],true);

      for ($a=0; $a < count($veriler); $a++) {
        $model = new Model();
        $stmt = $model->dbh->prepare(
          "SELECT tbl_yazdirma_ayarlari.yazdirma_ayarlari_adisyon_alt_yazi FROM tbl_yazdirma_ayarlari
          WHERE tbl_yazdirma_ayarlari.id=(SELECT MAX(id) FROM tbl_yazdirma_ayarlari)"
        );
        $stmt->execute();
        $yazdirmaAyarlari = $stmt->fetch();

        /*ADİSYON YAZICISI BİLGİLERİ*/
        $stmt = $model->dbh->prepare(
          "SELECT tbl_yazicilar.yazici_adi FROM tbl_yazicilar
            INNER JOIN tbl_calisanlar ON tbl_calisanlar.calisan_paket_servis_yazici_idsi=tbl_yazicilar.id
           WHERE tbl_calisanlar.id=:calisan_idsi"
         );
        $stmt->execute(["calisan_idsi"=>$_SESSION["uid"]]);
        $yazdirmaAyarlari["yazici_adi"] = $stmt->fetch()["yazici_adi"];
        /*ADİSYON YAZICISI BİLGİLERİ*/

        $stmt = $model->dbh->prepare(
          "SELECT sirket_logosu FROM tbl_sirket WHERE id=(SELECT MAX(id) FROM tbl_sirket)"
        );
        $stmt->execute();
        $sirketLogosu = $stmt->fetch();

        $kurIsareti = $this->kurIsaretiniAl();



        $bilgiler = $this->bilgileriGuncelle($veriler[$a]["txtAdisyonIdsi"],true);

        /*müşteri varsayılan adres bilgisini alma*/
        $stmt = $model->dbh->prepare(
          "SELECT musteri_adresleri_adres FROM tbl_musteri_adresleri WHERE musteri_adresleri_musteri_idsi=:musteri_idsi AND musteri_adresleri_adres_varsayilan_mi=1"
         );
        $stmt->execute(["musteri_idsi"=>$bilgiler["adisyonBilgileri"][0]["adisyon_musteri_idsi"]]);
        $bilgiler["adisyonBilgileri"][0]["musteri_adresi"] = $stmt->fetch()["musteri_adresleri_adres"];
        /*müşteri varsayılan adres bilgisini alma*/

        $adisyonSablonu = file_get_contents($this->yolPhp."documents/sablonlar/paket-servis-sablonu.html");

        /*tarih saat*/
        $tarihSaat = Date("d-m-Y H:i");
        $adisyonSablonu = str_replace("[tarih_saat]",$tarihSaat,$adisyonSablonu);
        /*tarih saat*/

        /*müşteri atanmış mı sorgula ve değiştir*/
        if ($bilgiler["adisyonBilgileri"][0]["musteri_adi_soyadi"] != null) {
          $adisyonSablonu = str_replace("[musteri_adi]","<strong>Müşteri Adı: </strong>".$bilgiler["adisyonBilgileri"][0]["musteri_adi_soyadi"]."",$adisyonSablonu);
        }else {
          $adisyonSablonu = str_replace("[musteri_adi]","",$adisyonSablonu);
        }
        /*müşteri atanmış mı sorgula ve değiştir*/



        /*şirket logosu var mı sorgula ve değiştir*/
        if ($sirketLogosu) {
          $adisyonSablonu = str_replace("[sirket_logosu]","<img src='/var/www/html/local-assets/logolar/".$sirketLogosu["sirket_logosu"]."' style='width:50px;margin:auto;height:50px'>",$adisyonSablonu);
        }else {
          $adisyonSablonu = str_replace("[sirket_logosu]","<img src='/var/www/html/0001/assets/images/logo.png' style='width:50px;margin:auto;height:50px'>",$adisyonSablonu);
        }
        /*şirket logosu var mı sorgula ve değiştir*/

        /*adisyon no değiştir*/
        $adisyonSablonu = str_replace("[adisyon_no]","<strong>Adisyon No : </strong>".$bilgiler["adisyonBilgileri"][0][0]."",$adisyonSablonu);
        /*adisyon no değiştir*/

        /*kurye adı değiştir*/
        if ($bilgiler["adisyonBilgileri"][0]["adisyon_kurye_idsi"] != null) {
          $stmt = $model->dbh->prepare(
            "SELECT calisan_adi_soyadi FROM tbl_calisanlar WHERE id=:kurye_idsi"
          );
          $stmt->execute(["kurye_idsi"=>$bilgiler["adisyonBilgileri"][0]["adisyon_kurye_idsi"]]);
          $kuryeAdi = $stmt->fetch()["calisan_adi_soyadi"];
          $adisyonSablonu = str_replace("[kurye_adi]","<strong>Kurye : </strong>".$kuryeAdi."",$adisyonSablonu);
        }else {
          $adisyonSablonu = str_replace("[kurye_adi]","Kurye Atanmamış",$adisyonSablonu);
        }
        /*kurye adı değiştir*/

        /*müşteri bilgileri değiştir (adres,isim vs.)*/
        $adisyonSablonu = str_replace("[musteri_adresi]","<strong>Adres : </strong>".$bilgiler["adisyonBilgileri"][0]["musteri_adresi"],$adisyonSablonu);
        $adisyonSablonu = str_replace("[musteri_telefon_numarasi]","<strong>Telefon : </strong>".$bilgiler["adisyonBilgileri"][0]["musteri_telefon_numarasi"],$adisyonSablonu);
        /*müşteri bilgileri değiştir (adres,isim vs.)*/

        /*altyazi değiştir*/
        $adisyonSablonu = str_replace("[alt_yazi]",$yazdirmaAyarlari["yazdirma_ayarlari_adisyon_alt_yazi"],$adisyonSablonu);
        /*altyazi değiştir*/

        /*ürünler değiştir*/
        $urunlerString = "";
        for ($i=0; $i < count($bilgiler["adisyonUrunleri"]); $i++) {
          $urunlerString .= "<tr>";
          $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["urun_adi"]."</strong></td>";
          if ($bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_grami"] != null) {
            $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_grami"]." kg</strong></td>";
          }else {
            $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_adedi"]." adet</strong></td>";
          }
          $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_notu"]."</strong></td>";
          $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_birim_fiyati"]." ".$kurIsareti."</strong></td>";
          $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_toplam_fiyati"]." ".$kurIsareti."</strong></td>";
          $urunlerString .= "</tr>";
          $urunlerString .= "<hr style='margin:0px;padding:0px'>";
        }
        $adisyonSablonu = str_replace("[urunler]",$urunlerString,$adisyonSablonu);
        /*ürünler değiştir*/

        /*aratoplam değiştir*/
        $adisyonSablonu = str_replace("[ara_toplam]",$bilgiler["adisyonBilgileri"][0]["adisyon_tutari"],$adisyonSablonu);
        /*aratoplam değiştir*/

        /*toplamı hesapla ve değiştir*/
        $toplam = $bilgiler["adisyonBilgileri"][0]["adisyon_tutari"] - ($bilgiler["adisyonBilgileri"][0]["adisyon_tutari"] * $bilgiler["adisyonBilgileri"][0]["adisyon_indirim_miktari"]) / 100;
        $adisyonSablonu = str_replace("[toplam]",$toplam,$adisyonSablonu);
        /*toplamı hesapla ve değiştir*/

        /*indirim türüne göre indirim değiştir*/
        if ($bilgiler["adisyonBilgileri"][0]["adisyon_indirim_turu"] == 0) {
          $adisyonSablonu = str_replace("[indirim]","%".$bilgiler["adisyonBilgileri"][0]["adisyon_indirim_miktari"],$adisyonSablonu);
        }else {
          $adisyonSablonu = str_replace("[indirim]",$bilgiler["adisyonBilgileri"][0]["adisyon_indirim_miktari"]." ".$kurIsareti,$adisyonSablonu);
        }
        /*indirim türüne göre indirim değiştir*/

        /*kur işareti değiştir*/
        $adisyonSablonu = str_replace("[kur_isareti]",$kurIsareti,$adisyonSablonu);
        /*kur işareti değiştir*/


        file_put_contents($this->yolPhp."documents/fisler/adisyon-".$bilgiler["adisyonBilgileri"][0][0].".html",$adisyonSablonu);
        //
        exec("wkhtmltopdf -L 0mm -R 0mm -T 0mm -B 0mm --page-width 78mm --page-height 200mm ".$this->yolPhp."documents/fisler/adisyon-".$bilgiler["adisyonBilgileri"][0][0].".html  ".$this->yolPhp."documents/pdfler/adisyon-".$veriler[$a]["txtAdisyonIdsi"].".pdf", $output, $return_var);
        if ($return_var == 0) {
          exec("lpr -P ".$yazdirmaAyarlari["yazici_adi"]." ".$this->yolPhp."documents/pdfler/adisyon-".$veriler[$a]["txtAdisyonIdsi"].".pdf",$output,$return_var);
          // var_dump($return_var);
        }
      }



    }
  }
  /*PAKET SERVİS SİPARİŞ ADİSYON YAZDIR KODLARI*/

  /*PAKET SİPARİŞ ADİSYON, MÜŞTERİYE SİPARİŞ GİRME SAYFASI KODLARI*/
  public function paketSiparisAdisyon($musteriIdsi = false)
  {
    $model = new Model();


    /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_kategoriler  ORDER BY kategori_sira_numarasi ASC");
    $stmt->execute();
    $kategoriler = $stmt->fetchAll();
    /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/

    /*MASA MÜŞTERİ BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT id,musteri_adi_soyadi FROM tbl_musteriler WHERE id=:musteri_idsi");
    $stmt->execute(["musteri_idsi"=>$musteriIdsi]);
    $musteriBilgileri = $stmt->fetch();
    /*MASA MÜŞTERİ BİLGİLERİ*/

    /*MENÜ BİLGİLERİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_menuler.*,tbl_menuler.id FROM tbl_menuler"
    );
    $stmt->execute();
    $menuler = $stmt->fetchAll();
    /*MENÜ BİLGİLERİ*/

    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_urunler WHERE urun_stok_urunu_mu=0");
    $stmt->execute();
    $urunler = $stmt->fetchAll();
    for ($i=0; $i < count($urunler); $i++) {
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_alt_urunler WHERE ust_urun_id=:ust_urun_id");
      $stmt->execute(["ust_urun_id"=>$urunler[$i]["id"]]);
      $urunler[$i]["urunAltUrunBilgileri"] = $stmt->fetchAll();
    }
    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/

    /*ÇALIŞAN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT id,calisan_hizli_notlari FROM tbl_calisanlar WHERE id=:calisan_idsi");
    $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
    $calisanBilgileri = $stmt->fetch();
    $calisanBilgileri["calisan_hizli_notlari"] = json_decode($calisanBilgileri["calisan_hizli_notlari"],true);
    /*ÇALIŞAN BİLGİLERİ*/

    /*ADİSYON IDSİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_adisyonlar.id AS adisyon_idsi
      FROM tbl_adisyonlar
      WHERE tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0 AND tbl_adisyonlar.adisyon_musteri_idsi=:musteri_idsi ORDER BY tbl_adisyonlar.id DESC LIMIT 1"
    );
    $stmt->execute(['masa_idsi'=>'PS','musteri_idsi'=>$musteriIdsi]);
    $adisyonIdsi = $stmt->fetch()["adisyon_idsi"];
    /*ADİSYON IDSİ*/


    $this->view->urunler = $urunler;
    $this->view->kategoriler = $kategoriler;
    $this->view->menuler = $menuler;
    $this->view->musteriIdsi = $musteriIdsi;
    $this->view->adisyonIdsi = $adisyonIdsi;
    $this->view->musteriBilgileri = $musteriBilgileri;
    $this->view->calisanBilgileri = $calisanBilgileri;
    $this->view->render("restoran/paket-siparis-adisyon/");
  }
  /*PAKET SİPARİŞ ADİSYON, MÜŞTERİYE SİPARİŞ GİRME SAYFASI KODLARI*/

  /*CALLER ID KİŞİ BİLGİLERİNİ ALMA KODLARI*/
  public function callerIdNoSorgula()
  {
    if (isset($_POST["callerIdNoSorgula"])) {
      $telefonNo = $_POST["callerIdNoSorgula"];

      $musteri = new Musteriler();
      $musteri->setMusteriTelefonNumarasi($telefonNo);
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT id,musteri_adi_soyadi,musteri_adresi FROM tbl_musteriler WHERE musteri_telefon_numarasi=:musteri_telefon_numarasi");
      $stmt->execute(['musteri_telefon_numarasi'=>$musteri->musteriTelefonNumarasi]);
      $musteriBilgileri = $stmt->fetch();
      if ($musteriBilgileri) {
        $musteriBilgileri["saat"] = date("H:i");
      }

      echo json_encode(array(
        "musteriBilgileri"=>$musteriBilgileri
      ));
    }
  }
  /*CALLER ID KİŞİ BİLGİLERİNİ ALMA KODLARI*/


  /*PAKET SERVİS SAYFASI KODLARI*/
  public function paketServis()
  {
    $model = new Model();


    /*ÇALIŞAN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT id,calisan_adi_soyadi FROM tbl_calisanlar");
    $stmt->execute();
    $calisanlar = $stmt->fetchAll();
    /*ÇALIŞAN BİLGİLERİ*/

    /*CALLER ID BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT caller_id_aktif_mi FROM tbl_program_ayarlari WHERE id=(SELECT MAX(id) FROM tbl_program_ayarlari)");
    $stmt->execute();
    $callerIdAktifMi = $stmt->fetch()["caller_id_aktif_mi"];
    /*CALLER ID BİLGİLERİ*/

    /*ÖDEME METODLARI BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT id,odeme_metod_adi FROM tbl_odeme_metodlari");
    $stmt->execute();
    $odemeMetodlari = $stmt->fetchAll();
    /*ÖDEME METODLARI BİLGİLERİ*/

    /*BEKLEYEN SİPARİŞ BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT tbl_adisyonlar.adisyon_tutari,tbl_adisyonlar.id AS adisyon_idsi,
      tbl_musteriler.id AS musteri_idsi,tbl_adisyonlar.adisyon_acilis_saati,tbl_musteriler.musteri_adi_soyadi,tbl_musteriler.musteri_telefon_numarasi,
      tbl_musteri_adresleri.musteri_adresleri_adres AS musteri_adresi
      FROM tbl_adisyonlar
      INNER JOIN tbl_musteriler ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteriler.id
      LEFT JOIN tbl_musteri_adresleri ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteri_adresleri.musteri_adresleri_musteri_idsi
      WHERE tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0 AND tbl_adisyonlar.adisyon_yola_cikti_mi=0 AND tbl_musteri_adresleri.musteri_adresleri_adres_varsayilan_mi=1"
    );
    $stmt->execute(['masa_idsi'=>'PS']);
    $bekleyenSiparisBilgileri = $stmt->fetchAll();
    /*BEKLEYEN SİPARİŞ BİLGİLERİ*/

    /*YOLA ÇIKAN SİPARİŞ BİLGİLERİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_adisyonlar.adisyon_tutari,tbl_adisyonlar.adisyon_acilis_saati,tbl_adisyonlar.id AS adisyon_idsi,
      tbl_musteriler.id AS musteri_idsi,tbl_musteriler.musteri_adi_soyadi,tbl_musteriler.musteri_telefon_numarasi,
      tbl_musteri_adresleri.musteri_adresleri_adres AS musteri_adresi,
      tbl_calisanlar.calisan_adi_soyadi AS kurye_adi
      FROM tbl_adisyonlar
      INNER JOIN tbl_musteriler ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteriler.id
      LEFT JOIN tbl_musteri_adresleri ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteri_adresleri.musteri_adresleri_musteri_idsi
      INNER JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_kurye_idsi=tbl_calisanlar.id
      WHERE tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0 AND tbl_adisyonlar.adisyon_yola_cikti_mi=1 AND tbl_musteri_adresleri.musteri_adresleri_adres_varsayilan_mi=1"
    );
    $stmt->execute(['masa_idsi'=>'PS']);
    $yolaCikanSiparisBilgileri = $stmt->fetchAll();
    /*YOLA ÇIKAN SİPARİŞ BİLGİLERİ*/




    $this->view->callerIdAktifMi = $callerIdAktifMi;
    $this->view->yolaCikanSiparisBilgileri = $yolaCikanSiparisBilgileri;
    $this->view->bekleyenSiparisBilgileri = $bekleyenSiparisBilgileri;
    $this->view->odemeMetodlari = $odemeMetodlari;
    $this->view->calisanlar = $calisanlar;
    $this->view->render("restoran/paket-servis");
  }
  /*PAKET SERVİS SAYFASI KODLARI*/

  /*PAKET SERVİS CALLER ID AKTİF ET*/
  public function callerIdAktifEt()
  {
    if (isset($_POST["callerIdAktifEt"])) {
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT MAX(id) AS id FROM tbl_program_ayarlari");
      $stmt->execute();
      $id = $stmt->fetch()["id"];

      $program = new Program();
      $program->programAyarlari = new ProgramAyarlari();
      $program->programAyarlari->setProgramAyarIdsi($id);
      $program->programAyarlari->setProgramCallerIdAktifMi(1);

      $stmt = $model->dbh->prepare(
        "UPDATE tbl_program_ayarlari SET
        caller_id_aktif_mi=:caller_id_aktif_mi
        WHERE id=:id"
      );
      $yanit = $stmt->execute([
        'caller_id_aktif_mi'=>$program->programAyarlari->programCallerIdAktifMi,
        'id'=>$program->programAyarlari->programAyarIdsi
      ]);

      $model = null;
      $program = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*PAKET SERVİS CALLER ID AKTİF ET*/

  /*PAKET SİPARİŞ ÖDEMEYE ÇEVİRME, ÖDEMESİNİ ALMA KODLARI*/
  public function paketSiparisOdemeAl()
  {
    if (isset($_POST["paketSiparisOdemeAl"])) {
      $veriler = json_decode($_POST["paketSiparisOdemeAl"],true);

      for ($i=0; $i < count($veriler); $i++) {
        $model = new Model();
        $adisyon = new Adisyonlar();
        $adisyon->setAdisyonIdsi($veriler[$i]["txtAdisyonIdsi"]);
        $adisyon->setAdisyonOdemeDurumu(1);

        $stmt = $model->dbh->prepare(
          "SELECT adisyon_tutari FROM tbl_adisyonlar WHERE id=:adisyon_idsi"
        );
        $stmt->execute(['adisyon_idsi'=>$adisyon->adisyonIdsi]);
        $adisyonTutari = $stmt->fetch()["adisyon_tutari"];

        $adisyon->setAdisyonTutari($adisyonTutari);

        $stmt = $model->dbh->prepare(
          "UPDATE tbl_adisyonlar SET adisyon_odeme_durumu=1,adisyon_odenmis_tutar=:adisyon_tutari
          WHERE id=:adisyon_idsi"
        );
        $yanit = $stmt->execute([
          'adisyon_tutari'=>$adisyon->adisyonTutari,
          'adisyon_idsi'=>$adisyon->adisyonIdsi
        ]);

        if ($yanit == true) {
          $adisyon->adisyonOdemeleri = new AdisyonOdemeleri();
          $adisyon->adisyonOdemeleri->setAdisyonOdemeleriAdisyonIdsi($adisyon->adisyonIdsi);
          $adisyon->adisyonOdemeleri->setAdisyonOdemeleriOdemeMetoduIdsi($veriler[$i]["txtOdemeMetodIdsi"]);
          $adisyon->adisyonOdemeleri->setAdisyonOdemeleriOdemeMiktari($adisyon->adisyonTutari);
          $adisyon->adisyonOdemeleri->setAdisyonOdemeleriOdemeyiAlanKisiIdsi($_SESSION["uid"]);

          $stmt = $model->dbh->prepare(
            "INSERT INTO tbl_adisyon_odemeleri SET
            adisyon_odemesi_adisyon_idsi=:adisyon_odemesi_adisyon_idsi,
            adisyon_odemesi_odeme_metodu_idsi=:adisyon_odemesi_odeme_metodu_idsi,
            adisyon_odemesi_odeme_miktari=:adisyon_odemesi_odeme_miktari,
            adisyon_odemesi_odemeyi_alan_kisi_idsi=:adisyon_odemesi_odemeyi_alan_kisi_idsi
            "
          );
          $yanit = $stmt->execute([
            'adisyon_odemesi_adisyon_idsi'=>$adisyon->adisyonOdemeleri->adisyonOdemeleriAdisyonIdsi,
            'adisyon_odemesi_odeme_metodu_idsi'=>$adisyon->adisyonOdemeleri->adisyonOdemeleriOdemeMetoduIdsi,
            'adisyon_odemesi_odeme_miktari'=>$adisyon->adisyonOdemeleri->adisyonOdemeleriOdemeMiktari,
            'adisyon_odemesi_odemeyi_alan_kisi_idsi'=>$adisyon->adisyonOdemeleri->adisyonOdemeleriOdemeyiAlanKisiIdsi
          ]);

        }
      }
      $adisyon = null;
      $model = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*PAKET SİPARİŞ ÖDEMEYE ÇEVİRME, ÖDEMESİNİ ALMA KODLARI*/

  /*PAKET SERVİS GÜNCELLEME BİLGİLERİNİ ALMA KODLARI*/
  public function paketServisGuncelle()
  {
    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT tbl_adisyonlar.adisyon_tutari,tbl_adisyonlar.adisyon_acilis_saati,tbl_adisyonlar.id AS adisyon_idsi,tbl_adisyonlar.adisyon_yola_cikti_mi,
      tbl_musteriler.id AS musteri_idsi,tbl_musteriler.musteri_adi_soyadi,tbl_musteriler.musteri_telefon_numarasi,tbl_calisanlar.calisan_adi_soyadi AS kurye_adi,tbl_musteri_adresleri.musteri_adresleri_adres
      FROM tbl_adisyonlar
      INNER JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_kurye_idsi=tbl_calisanlar.id
      INNER JOIN tbl_musteriler ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteriler.id
      INNER JOIN tbl_musteri_adresleri ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteri_adresleri.musteri_adresleri_musteri_idsi
      WHERE tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0 AND tbl_musteri_adresleri.musteri_adresleri_adres_varsayilan_mi=1"
    );
    $stmt->execute(['masa_idsi'=>'PS']);
    $bilgiler = $stmt->fetchAll();
    $kurIsareti = $this->kurIsaretiniAl();


    echo json_encode(array(
      "bilgiler"=>$bilgiler,
      "kurIsareti"=>$kurIsareti
    ));

  }
  /*PAKET SERVİS GÜNCELLEME BİLGİLERİNİ ALMA KODLARI*/

  /*ADİSYONA KURYE ATAMA KODLARI*/
  public function adisyonaKuryeAta()
  {
    if (isset($_POST["adisyonaKuryeAta"])) {
      $veriler = json_decode($_POST["adisyonaKuryeAta"],true);

      for ($i=0; $i < count($veriler); $i++) {
        $model = new Model();
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_adisyonlar SET adisyon_yola_cikti_mi=1,adisyon_kurye_idsi=:kurye_idsi
          WHERE id=:adisyon_idsi"
        );
        $yanit = $stmt->execute([
          "kurye_idsi"=>$veriler[$i]["txtKuryeIdsi"],
          "adisyon_idsi"=>$veriler[$i]["txtAdisyonIdsi"]
        ]);
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ADİSYONA KURYE ATAMA KODLARI*/

  /*ADİSYONDAN KURYEYİ ALMA KODLARI*/
  public function adisyondanKuryeyiAl()
  {
    if (isset($_POST["adisyondanKuryeyiAl"])) {
      $veriler = json_decode($_POST["adisyondanKuryeyiAl"],true);

      for ($i=0; $i < count($veriler); $i++) {
        $model = new Model();
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_adisyonlar SET adisyon_yola_cikti_mi=0,adisyon_kurye_idsi=0
          WHERE id=:adisyon_idsi"
        );
        $yanit = $stmt->execute([
          "adisyon_idsi"=>$veriler[$i]["txtAdisyonIdsi"]
        ]);
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ADİSYONDAN KURYEYİ ALMA KODLARI*/

  /*HIZLI SATIŞ SAYFASI KODLARI*/
  public function hizliSatis()
  {

    $model = new Model();



    /*ÖKC AKTİF Mİ BİLGİLERİ*/
    $stmt = $model->dbh->prepare(
      "SELECT * FROM tbl_okc_bilgileri WHERE id=(SELECT MAX(id) FROM tbl_okc_bilgileri) AND okc_bilgileri_okc_aktif_mi=1"
    );
    $stmt->execute();
    $okcBilgileri = $stmt->fetch();
    /*ÖKC AKTİF Mİ BİLGİLERİ*/

    /*ÖDEME METODLARI BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_odeme_metodlari");
    $stmt->execute();
    $odemeMetodlari = $stmt->fetchAll();
    /*ÖDEME METODLARI BİLGİLERİ*/

    /*ÇALIŞAN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT id,calisan_hizli_notlari FROM tbl_calisanlar WHERE id=:calisan_idsi");
    $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
    $calisanBilgileri = $stmt->fetch();
    $calisanBilgileri["calisan_hizli_notlari"] = json_decode($calisanBilgileri["calisan_hizli_notlari"],true);
    /*ÇALIŞAN BİLGİLERİ*/


    /*MENÜ BİLGİLERİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_menuler.*,tbl_menuler.id FROM tbl_menuler"
    );
    $stmt->execute();
    $menuler = $stmt->fetchAll();
    /*MENÜ BİLGİLERİ*/


    /*YAZICILAR BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
    $stmt->execute();
    $yazicilar = $stmt->fetchAll();
    /*YAZICILAR BİLGİLERİ*/


    /*ADİSYON YAZICISI BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT calisan_hizli_satis_yazici_idsi FROM tbl_calisanlar WHERE id=:calisan_idsi");
    $stmt->execute(["calisan_idsi"=>$_SESSION["uid"]]);
    $adisyonYazicisiIdsi = $stmt->fetch();
    /*ADİSYON YAZICISI BİLGİLERİ*/


    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_urunler WHERE urun_stok_urunu_mu=0");
    $stmt->execute();
    $urunler = $stmt->fetchAll();
    for ($i=0; $i < count($urunler); $i++) {
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_alt_urunler WHERE ust_urun_id=:ust_urun_id");
      $stmt->execute(["ust_urun_id"=>$urunler[$i]["id"]]);
      $urunler[$i]["urunAltUrunBilgileri"] = $stmt->fetchAll();
    }
    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/

    /*ADİSYON IDSİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_adisyonlar.id AS adisyon_idsi
      FROM tbl_adisyonlar
      WHERE tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0 AND tbl_adisyonlar.adisyon_garson_idsi=:calisan_idsi ORDER BY tbl_adisyonlar.id DESC LIMIT 1"
    );
    $stmt->execute([
      'masa_idsi'=>'HS',
      'calisan_idsi'=>$_SESSION["uid"]
    ]);
    $adisyonIdsi = $stmt->fetch()["adisyon_idsi"];
    /*ADİSYON IDSİ*/


    /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_kategoriler ORDER BY kategori_sira_numarasi ASC");
    $stmt->execute();
    $kategoriler = $stmt->fetchAll();
    /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/


    $this->view->yazicilar = $yazicilar;
    $this->view->adisyonYazicisiIdsi = $adisyonYazicisiIdsi["calisan_hizli_satis_yazici_idsi"];
    $this->view->okcBilgileri = $okcBilgileri;
    $this->view->kategoriler = $kategoriler;
    $this->view->menuler = $menuler;
    $this->view->urunler = $urunler;
    $this->view->adisyonIdsi = $adisyonIdsi;
    $this->view->odemeMetodlari = $odemeMetodlari;
    $this->view->calisanBilgileri = $calisanBilgileri;
    $this->view->render("restoran/hizli-satis/");
  }
  /*HIZLI SATIŞ SAYFASI KODLARI*/

  /*ÖDEME SAYFASI KODLARI*/
  public function odeme($masaIdsi)
  {


    $url = explode(",",$masaIdsi);
    $masaIdsi = $url[0];
    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT tbl_statuler.statu_yetkileri AS statu_yetkileri
    FROM tbl_statuler
    INNER JOIN tbl_calisanlar ON tbl_calisanlar.calisan_statu_idsi=tbl_statuler.id
    WHERE tbl_calisanlar.id=:calisan_idsi");
    $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
    $calisanYetkileri = $stmt->fetch()["statu_yetkileri"];
    $calisanYetkileri = json_decode($calisanYetkileri,true);

    for ($i=0; $i < count($calisanYetkileri); $i++) {

      if (isset($calisanYetkileri[$i]["txtOdemeAlabilir"])) {
        if ($calisanYetkileri[$i]["txtOdemeAlabilir"] == false) {
          $this->view->izin = false;
          $_POST = array();
          header("location:javascript://history.go(-1)");
          return false;
        }
      }

    }

    /*masayi kilitleme kodları*/
    $stmt = $model->dbh->prepare(
      "UPDATE tbl_masalar SET masa_durumu=2 WHERE id=:masa_idsi"
    );
    $stmt->execute(["masa_idsi"=>$masaIdsi]);
    /*masayi kilitleme kodları*/

    /*ökc aktif mi bilgileri*/

    $stmt = $model->dbh->prepare(
      "SELECT * FROM tbl_okc_bilgileri WHERE id=(SELECT MAX(id) FROM tbl_okc_bilgileri) AND okc_bilgileri_okc_aktif_mi=1"
    );
    $stmt->execute();
    $okcBilgileri = $stmt->fetch();
    /*ökc aktif mi bilgileri*/

    if ($masaIdsi == "QR") {

      $qrKodu = $url[1];
      $lokasyonIdsi = "";
      /*ADİSYON IDSİ*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.id AS adisyon_idsi
        FROM tbl_adisyonlar
        WHERE tbl_adisyonlar.adisyon_qr_kodu=:adisyon_qr_kodu AND tbl_adisyonlar.adisyon_odeme_durumu=0"
      );
      $stmt->execute(['adisyon_qr_kodu'=>$qrKodu]);
      $adisyonIdsi = $stmt->fetch()["adisyon_idsi"];
      /*ADİSYON IDSİ*/

    }else {
      if (isset($url[1])) {
        $lokasyonIdsi = $url[1];
      }else {
        $lokasyonIdsi = "";
      }

      /*ADİSYON IDSİ*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.id AS adisyon_idsi
        FROM tbl_masalar
        INNER JOIN tbl_adisyonlar ON tbl_masalar.id=tbl_adisyonlar.adisyon_masa_idsi
        WHERE tbl_masalar.id=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0"
      );
      $stmt->execute(['masa_idsi'=>$masaIdsi]);
      $adisyonIdsi = $stmt->fetch()["adisyon_idsi"];
      /*ADİSYON IDSİ*/
    }


    /*ÖDEME METODLARI BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_odeme_metodlari");
    $stmt->execute();
    $odemeMetodlari = $stmt->fetchAll();
    /*ÖDEME METODLARI BİLGİLERİ*/


    /*YAZICILAR BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
    $stmt->execute();
    $yazicilar = $stmt->fetchAll();
    /*YAZICILAR BİLGİLERİ*/


    /*ADİSYON YAZICISI BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT calisan_adisyon_yazici_idsi FROM tbl_calisanlar WHERE id=:calisan_idsi");
    $stmt->execute(["calisan_idsi"=>$_SESSION["uid"]]);
    $adisyonYazicisiIdsi = $stmt->fetch();
    /*ADİSYON YAZICISI BİLGİLERİ*/

    /*MENÜ BİLGİLERİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_menuler.*,tbl_menuler.id FROM tbl_menuler"
    );
    $stmt->execute();
    $menuler = $stmt->fetchAll();
    /*MENÜ BİLGİLERİ*/

    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_urunler WHERE urun_stok_urunu_mu=0");
    $stmt->execute();
    $urunler = $stmt->fetchAll();
    for ($i=0; $i < count($urunler); $i++) {
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_alt_urunler WHERE ust_urun_id=:ust_urun_id");
      $stmt->execute(["ust_urun_id"=>$urunler[$i]["id"]]);
      $urunler[$i]["urunAltUrunBilgileri"] = $stmt->fetchAll();
    }
    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/

    /*MASA DURUMU BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT masa_durumu FROM tbl_masalar WHERE id=:masa_idsi");
    $stmt->execute(['masa_idsi'=>$masaIdsi]);
    $masaDurumu = $stmt->fetch();
    /*MASA DURUMU BİLGİLERİ*/


    /*ÇALIŞAN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT id,calisan_hizli_notlari FROM tbl_calisanlar WHERE id=:calisan_idsi");
    $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
    $calisanBilgileri = $stmt->fetch();
    $calisanBilgileri["calisan_hizli_notlari"] = json_decode($calisanBilgileri["calisan_hizli_notlari"],true);
    /*ÇALIŞAN BİLGİLERİ*/




    $this->view->yazicilar = $yazicilar;
    $this->view->adisyonYazicisiIdsi = $adisyonYazicisiIdsi["calisan_adisyon_yazici_idsi"];
    $this->view->okcBilgileri = $okcBilgileri;
    $this->view->adisyonIdsi = $adisyonIdsi;
    $this->view->odemeMetodlari = $odemeMetodlari;
    $this->view->masaIdsi = $masaIdsi;
    $this->view->masaDurumu = $masaDurumu["masa_durumu"];
    $this->view->lokasyonIdsi = $lokasyonIdsi;
    $this->view->calisanBilgileri = $calisanBilgileri;
    $this->view->render("restoran/odeme/");
  }

  /*ÖDEME SAYFASI KODLARI*/

  /*ÖDEME ADİSYON YAZDIR*/
  public function odemeAdisyonYazdir($adisyonIdsi,$yazdirilacakYaziciIdsi=false)
  {

      if (isset($_POST["odemeAdisyonYazdir"])) {
        $yaziciIdsi = $_POST["odemeAdisyonYazdir"];
      }

      if ($yazdirilacakYaziciIdsi != false) {
        $yaziciIdsi = $yazdirilacakYaziciIdsi;
      }

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_yazdirma_ayarlari.*
        FROM tbl_yazdirma_ayarlari

        WHERE tbl_yazdirma_ayarlari.id=(SELECT MAX(id) FROM tbl_yazdirma_ayarlari)"
      );
      $stmt->execute();
      $yazdirmaAyarlari = $stmt->fetch();

      if (isset($_POST["odemeAdisyonYazdir"]) || $yazdirilacakYaziciIdsi != false) {
        $stmt = $model->dbh->prepare("SELECT yazici_adi FROM tbl_yazicilar WHERE id=:yazici_idsi");
        $stmt->execute(["yazici_idsi"=>$yaziciIdsi]);
        $yaziciAdi = $stmt->fetch()["yazici_adi"];
        $yazdirmaAyarlari["yazici_adi"] = $yaziciAdi;
      }



      $stmt = $model->dbh->prepare(
        "SELECT sirket_logosu FROM tbl_sirket WHERE id=(SELECT MAX(id) FROM tbl_sirket)"
      );
      $stmt->execute();
      $sirketLogosu = $stmt->fetch();

      $kurIsareti = $this->kurIsaretiniAl();



      $bilgiler = $this->bilgileriGuncelle($adisyonIdsi,true);
      $adisyonSablonu = file_get_contents($this->yolPhp."documents/sablonlar/adisyon-sablonu.html");

      /*tarih saat*/
      $tarihSaat = Date("d-m-Y H:i");
      $adisyonSablonu = str_replace("[tarih_saat]",$tarihSaat,$adisyonSablonu);
      /*tarih saat*/

      /*müşteri atanmış mı sorgula ve değiştir*/
      if ($yazdirmaAyarlari["yazdirma_ayarlari_musteri_adi_gorunsun_mu"] == 1) {
        if ($bilgiler["adisyonBilgileri"][0]["musteri_adi_soyadi"] != null) {
          $adisyonSablonu = str_replace("[musteri_adi]","Sn.".$bilgiler["adisyonBilgileri"][0]["musteri_adi_soyadi"]."",$adisyonSablonu);
        }else {
          $adisyonSablonu = str_replace("[musteri_adi]","",$adisyonSablonu);
        }
      }else {
        $adisyonSablonu = str_replace("[musteri_adi]","",$adisyonSablonu);
      }

      /*müşteri atanmış mı sorgula ve değiştir*/

      /*şirket logosu var mı sorgula ve değiştir*/
      if ($sirketLogosu) {
        $adisyonSablonu = str_replace("[sirket_logosu]","<img src='/var/www/html/local-assets/logolar/".$sirketLogosu["sirket_logosu"]."' style='width:50px;margin:auto;height:50px'>",$adisyonSablonu);
      }else {
        $adisyonSablonu = str_replace("[sirket_logosu]","<img src='/var/www/html/0001/assets/images/logo.png' style='width:50px;margin:auto;height:50px'>",$adisyonSablonu);
      }
      /*şirket logosu var mı sorgula ve değiştir*/

      /*masa adi değişecek mi sorgula ve değiştir*/
      if ($yazdirmaAyarlari["yazdirma_ayarlari_masa_adi_gorunsun_mu"] == "1") {
        $adisyonSablonu = str_replace("[masa_adi]","Masa Adı : ".$bilgiler["adisyonBilgileri"][0]["masa_adi"]."",$adisyonSablonu);
      }else {
        $adisyonSablonu = str_replace("[masa_adi]","",$adisyonSablonu);
      }
      /*masa adi değişecek mi sorgula ve değiştir*/

      /*adisyon no değişecek mi sorgula ve değiştir*/
      if ($yazdirmaAyarlari["yazdirma_ayarlari_adisyon_no_gorunsun_mu"] == "1") {
        $adisyonSablonu = str_replace("[adisyon_no]","Adisyon No : ".$bilgiler["adisyonBilgileri"][0][0]."",$adisyonSablonu);
      }else {
        $adisyonSablonu = str_replace("[adisyon_no]","",$adisyonSablonu);
      }
      /*adisyon no değişecek mi sorgula ve değiştir*/

      /*altyazi değiştir*/
      $adisyonSablonu = str_replace("[alt_yazi]",$yazdirmaAyarlari["yazdirma_ayarlari_adisyon_alt_yazi"],$adisyonSablonu);
      /*altyazi değiştir*/

      /*ürünler değiştir*/
      $urunlerString = "";
      for ($i=0; $i < count($bilgiler["adisyonUrunleri"]); $i++) {
        $urunlerString .= "<tr>";
        $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["urun_adi"]."</strong></td>";
        if ($bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_grami"] != null) {
          $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_grami"]." kg</strong></td>";
        }else {
          $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_adedi"]." adet</strong></td>";
        }

        $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_birim_fiyati"]." ".$kurIsareti."</strong></td>";
        $urunlerString .= "<td><strong>".$bilgiler["adisyonUrunleri"][$i]["adisyon_urunleri_urun_toplam_fiyati"]." ".$kurIsareti."</strong></td>";
        $urunlerString .= "</tr>";
      }
      $adisyonSablonu = str_replace("[urunler]",$urunlerString,$adisyonSablonu);
      /*ürünler değiştir*/

      /*aratoplam değiştir*/
      $adisyonSablonu = str_replace("[ara_toplam]",$bilgiler["adisyonBilgileri"][0]["adisyon_tutari"],$adisyonSablonu);
      /*aratoplam değiştir*/

      /*toplamı hesapla ve değiştir*/
      if ($bilgiler["adisyonBilgileri"][0]["adisyon_indirim_turu"] == "0") {
        $toplam = $bilgiler["adisyonBilgileri"][0]["adisyon_tutari"] - ($bilgiler["adisyonBilgileri"][0]["adisyon_tutari"] * $bilgiler["adisyonBilgileri"][0]["adisyon_indirim_miktari"]) / 100;
      }else {
        $toplam = $bilgiler["adisyonBilgileri"][0]["adisyon_tutari"] - $bilgiler["adisyonBilgileri"][0]["adisyon_indirim_miktari"];
      }

      $adisyonSablonu = str_replace("[toplam]",$toplam,$adisyonSablonu);
      /*toplamı hesapla ve değiştir*/

      /*indirim türüne göre indirim değiştir*/
      if ($bilgiler["adisyonBilgileri"][0]["adisyon_indirim_turu"] == 0) {
        $adisyonSablonu = str_replace("[indirim]","%".$bilgiler["adisyonBilgileri"][0]["adisyon_indirim_miktari"],$adisyonSablonu);
      }else {
        $adisyonSablonu = str_replace("[indirim]",$bilgiler["adisyonBilgileri"][0]["adisyon_indirim_miktari"]." ".$kurIsareti,$adisyonSablonu);
      }
      /*indirim türüne göre indirim değiştir*/

      /*kur işareti değiştir*/
      $adisyonSablonu = str_replace("[kur_isareti]",$kurIsareti,$adisyonSablonu);
      /*kur işareti değiştir*/

      echo $bilgiler["adisyonBilgileri"][0][0];

      file_put_contents($this->yolPhp."documents/fisler/adisyon-".$bilgiler["adisyonBilgileri"][0][0].".html",$adisyonSablonu);


      exec("wkhtmltopdf -L 0mm -R 0mm -T 0mm -B 0mm --page-width 78mm --page-height 200mm ".$this->yolPhp."documents/fisler/adisyon-".$bilgiler["adisyonBilgileri"][0][0].".html  ".$this->yolPhp."documents/pdfler/adisyon-".$adisyonIdsi.".pdf", $output, $return_var);

      // if ($return_var == 0) {
        exec("lpr -P ".$yazdirmaAyarlari["yazici_adi"]." ".$this->yolPhp."documents/pdfler/adisyon-".$adisyonIdsi.".pdf",$output,$return_var);
        // var_dump($return_var);
      // }

  }
  /*ÖDEME ADİSYON YAZDIR*/

  /*MASALAR SAYFASI KODLARI*/
  public function masalar($lokasyonIdsi = false)
  {
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_lokasyonlar");
    $stmt->execute();
    $lokasyonlar = $stmt->fetchAll();

    if ($lokasyonIdsi == false) {
      $masalar = "Görüntülemek istediğiniz lokasyonu seçiniz";
    }else {
      $stmt = $model->dbh->prepare(
        "SELECT tbl_masalar.id AS masa_idsi,tbl_masalar.*
        FROM tbl_masalar
        WHERE tbl_masalar.masa_lokasyon_idsi=:lokasyon_idsi
        ORDER BY tbl_masalar.masa_adi"
      );
      $stmt->execute(['lokasyon_idsi'=>$lokasyonIdsi]);
      $masalar = $stmt->fetchAll();


      for ($i=0; $i < count($masalar); $i++) {
        $stmt = $model->dbh->prepare(
          "SELECT tbl_adisyonlar.adisyon_tutari,tbl_adisyonlar.id AS adisyon_idsi,tbl_musteriler.musteri_adi_soyadi,tbl_calisanlar.calisan_adi_soyadi
          FROM tbl_adisyonlar
          LEFT JOIN tbl_musteriler ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteriler.id
          LEFT JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_calisan_idsi=tbl_calisanlar.id
          WHERE tbl_adisyonlar.adisyon_odeme_durumu=0 AND tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi
          "
        );
        $stmt->execute(["masa_idsi"=>$masalar[$i]["masa_idsi"]]);
        $adisyonBilgileri = $stmt->fetchAll();

        $masalar[$i]["adisyonBilgileri"] = $adisyonBilgileri;

        if (@$masalar[$i]["adisyonBilgileri"][0]["adisyon_tutari"]) {
          $stmt = $model->dbh->prepare(
            "SELECT adisyon_urunleri_urun_siparis_saati FROM tbl_adisyon_urunleri WHERE adisyon_urunleri_adisyon_idsi=:adisyon_idsi ORDER BY id DESC LIMIT 1"
          );
          $stmt->execute(['adisyon_idsi'=>$masalar[$i]["adisyonBilgileri"][0]["adisyon_idsi"]]);
          $saat = $stmt->fetch();
          @$masalar[$i]["adisyonBilgileri"][0]["adisyon_urunleri_urun_siparis_saati"] = explode(" ",$saat["adisyon_urunleri_urun_siparis_saati"])[1];
        }
      }

      $stmt = $model->dbh->prepare("SELECT lokasyon_adi FROM tbl_lokasyonlar WHERE id=:lokasyon_idsi");
      $stmt->execute(['lokasyon_idsi'=>$lokasyonIdsi]);
      $lokasyonAdi = $stmt->fetch();


    }


    $this->view->ipAdresi = $_SERVER['SERVER_ADDR'];
    $this->view->masalar = $masalar;
    $this->view->lokasyonlar = $lokasyonlar;
    $this->view->lokasyonIdsi = $lokasyonIdsi;
    @$this->view->lokasyonAdi = $lokasyonAdi["lokasyon_adi"];
    $this->view->render("restoran/masalar");
  }
  /*MASALAR SAYFASI KODLARI*/

  /*MASALAR BİLGİLERİ GÜNCELLEME KODLARI*/
  public function masalarBilgileriGuncelle()
  {
    if (isset($_POST["masalarBilgileriGuncelle"])) {
      $lokasyonIdsi = $_POST["masalarBilgileriGuncelle"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_masalar.id AS masa_idsi,tbl_masalar.*
        FROM tbl_masalar
        WHERE tbl_masalar.masa_lokasyon_idsi=:lokasyon_idsi
        ORDER BY tbl_masalar.masa_adi"
      );
      $stmt->execute(['lokasyon_idsi'=>$lokasyonIdsi]);
      $masalar = $stmt->fetchAll();



      for ($i=0; $i < count($masalar); $i++) {
        $stmt = $model->dbh->prepare(
          "SELECT tbl_adisyonlar.adisyon_tutari,tbl_adisyonlar.id AS adisyon_idsi,tbl_musteriler.musteri_adi_soyadi,tbl_calisanlar.calisan_adi_soyadi
          FROM tbl_adisyonlar
          LEFT JOIN tbl_musteriler ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteriler.id
          LEFT JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_calisan_idsi=tbl_calisanlar.id
          WHERE tbl_adisyonlar.adisyon_odeme_durumu=0 AND tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi
          "
        );
        $stmt->execute(["masa_idsi"=>$masalar[$i]["masa_idsi"]]);
        $adisyonBilgileri = $stmt->fetchAll();

        $masalar[$i]["adisyonBilgileri"] = $adisyonBilgileri;

        if (@$masalar[$i]["adisyonBilgileri"][0]["adisyon_tutari"]) {
          $stmt = $model->dbh->prepare(
            "SELECT adisyon_urunleri_urun_siparis_saati FROM tbl_adisyon_urunleri WHERE adisyon_urunleri_adisyon_idsi=:adisyon_idsi ORDER BY id DESC LIMIT 1"
          );
          $stmt->execute(['adisyon_idsi'=>$masalar[$i]["adisyonBilgileri"][0]["adisyon_idsi"]]);
          $saat = $stmt->fetch();
          @$masalar[$i]["adisyonBilgileri"][0]["adisyon_urunleri_urun_siparis_saati"] = explode(" ",$saat["adisyon_urunleri_urun_siparis_saati"])[1];
        }
      }
      echo json_encode(array(
        "masaBilgileri"=>$masalar
      ));
    }
  }
  /*MASALAR BİLGİLERİ GÜNCELLEME KODLARI*/

  /*TESLİM DURUMU ADINI AL KODLARI*/
  public function teslimDurumuAdiniAl()
  {
    if (isset($_POST["teslimDurumuAdiniAl"])) {
      $teslimDurumlari = new TeslimDurumlari();
      $teslimDurumuAdi = $teslimDurumlari->getTeslimDurumuAdi(array("id"=>$_POST["teslimDurumuAdiniAl"]));
      $saat = date("h:i:s");
      echo json_encode(array(
        "teslimDurumuAdi"=>$teslimDurumuAdi,
        "saat"=>$saat
      ));
    }
  }
  /*TESLİM DURUMU ADINI AL KODLARI*/


  /*MASA DETAYI KODLARI*/
  public function masaDetay($masaIdsi)
  {
    $url = explode(",",$masaIdsi);
    $masaIdsi = $url[0];
    if (isset($url[1])) {
      $lokasyonIdsi = $url[1];
    }else {
      $lokasyonIdsi = "";
    }
    $model = new Model();


    /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_kategoriler ORDER BY kategori_sira_numarasi ASC");
    $stmt->execute();
    $kategoriler = $stmt->fetchAll();
    /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/

    /*TESLİM DURUMLARI BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_teslim_durumlari");
    $stmt->execute();
    $teslimDurumlari = $stmt->fetchAll();
    /*TESLİM DURUMLARI BİLGİLERİ*/

    /*MASA DURUMU BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT masa_durumu FROM tbl_masalar WHERE id=:masa_idsi");
    $stmt->execute(['masa_idsi'=>$masaIdsi]);
    $masaDurumu = $stmt->fetch();
    /*MASA DURUMU BİLGİLERİ*/

    /*MENÜ BİLGİLERİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_menuler.*,tbl_menuler.id FROM tbl_menuler"
    );
    $stmt->execute();
    $menuler = $stmt->fetchAll();
    /*MENÜ BİLGİLERİ*/

    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_urunler WHERE urun_stok_urunu_mu=0");
    $stmt->execute();
    $urunler = $stmt->fetchAll();
    for ($i=0; $i < count($urunler); $i++) {
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_alt_urunler WHERE ust_urun_id=:ust_urun_id");
      $stmt->execute(["ust_urun_id"=>$urunler[$i]["id"]]);
      $urunler[$i]["urunAltUrunBilgileri"] = $stmt->fetchAll();
    }
    /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/

    /*ÇALIŞAN BİLGİLERİ*/
    $stmt = $model->dbh->prepare("SELECT id,calisan_hizli_notlari FROM tbl_calisanlar WHERE id=:calisan_idsi");
    $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
    $calisanBilgileri = $stmt->fetch();
    $calisanBilgileri["calisan_hizli_notlari"] = json_decode($calisanBilgileri["calisan_hizli_notlari"],true);
    /*ÇALIŞAN BİLGİLERİ*/


    /*AİSYON IDSİ*/
    $stmt = $model->dbh->prepare(
      "SELECT tbl_adisyonlar.id AS adisyon_idsi
      FROM tbl_masalar
      INNER JOIN tbl_adisyonlar ON tbl_masalar.id=tbl_adisyonlar.adisyon_masa_idsi
      WHERE tbl_masalar.id=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0"
    );
    $stmt->execute(['masa_idsi'=>$masaIdsi]);
    $adisyonIdsi = $stmt->fetch()["adisyon_idsi"];
    /*AİSYON IDSİ*/

    if ($adisyonIdsi == null) {
      $disabled = "disabled";
    }else {
      $disabled = "";
    }

    $this->view->disabled = $disabled;
    $this->view->adisyonIdsi = $adisyonIdsi;
    $this->view->urunler = $urunler;
    $this->view->kategoriler = $kategoriler;
    $this->view->menuler = $menuler;
    $this->view->masaIdsi = $masaIdsi;
    $this->view->teslimDurumlari = $teslimDurumlari;
    $this->view->masaDurumu = $masaDurumu["masa_durumu"];
    $this->view->lokasyonIdsi = $lokasyonIdsi;
    $this->view->calisanBilgileri = $calisanBilgileri;
    $this->view->render("restoran/masa-detay/");
  }
  /*MASA DETAYI KODLARI*/

  /*QR ADİSYON SORGULAMA SAYFASI*/
  public function qrAdisyonSorgula()
  {

    $this->view->ipAdresi = $_SERVER['SERVER_ADDR'];
    $this->view->render("restoran/qr-adisyon-sorgula");
  }
  /*QR ADİSYON SORGULAMA SAYFASI*/

  /*QR ADİSYON KODLARI*/
  public function qrAdisyon()
  {
    if (isset($_POST["txtQrKod"])) {
      $qrKodu = $_POST["txtQrKod"];
      $model = new Model();

      /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_kategoriler");
      $stmt->execute();
      $kategoriler = $stmt->fetchAll();
      /*ÜRÜN KATEGORİLERİ BİLGİLERİ*/

      /*TESLİM DURUMLARI BİLGİLERİ*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_teslim_durumlari");
      $stmt->execute();
      $teslimDurumlari = $stmt->fetchAll();
      /*TESLİM DURUMLARI BİLGİLERİ*/

      /*MENÜ BİLGİLERİ*/
      $stmt = $model->dbh->prepare(
        "SELECT tbl_menuler.*,tbl_menuler.id FROM tbl_menuler"
      );
      $stmt->execute();
      $menuler = $stmt->fetchAll();
      /*MENÜ BİLGİLERİ*/

      /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_urunler WHERE urun_stok_urunu_mu=0");
      $stmt->execute();
      $urunler = $stmt->fetchAll();
      for ($i=0; $i < count($urunler); $i++) {
        $stmt = $model->dbh->prepare("SELECT * FROM tbl_alt_urunler WHERE ust_urun_id=:ust_urun_id");
        $stmt->execute(["ust_urun_id"=>$urunler[$i]["id"]]);
        $urunler[$i]["urunAltUrunBilgileri"] = $stmt->fetchAll();
      }
      /*ÜRÜN VE ALT ÜRÜN BİLGİLERİ*/

      /*ÇALIŞAN BİLGİLERİ*/
      $stmt = $model->dbh->prepare("SELECT id,calisan_hizli_notlari FROM tbl_calisanlar WHERE id=:calisan_idsi");
      $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
      $calisanBilgileri = $stmt->fetch();
      $calisanBilgileri["calisan_hizli_notlari"] = json_decode($calisanBilgileri["calisan_hizli_notlari"],true);
      /*ÇALIŞAN BİLGİLERİ*/


      /*AİSYON IDSİ*/
      $stmt = $model->dbh->prepare(
        "SELECT id AS adisyon_idsi
        FROM tbl_adisyonlar
        WHERE tbl_adisyonlar.adisyon_qr_kodu=:adisyon_qr_kodu AND tbl_adisyonlar.adisyon_odeme_durumu=0"
      );
      $stmt->execute(['adisyon_qr_kodu'=>$qrKodu]);
      $adisyonIdsi = $stmt->fetch()["adisyon_idsi"];
      /*AİSYON IDSİ*/


      $this->view->ipAdresi = $_SERVER['SERVER_ADDR'];
      $this->view->adisyonIdsi = $adisyonIdsi;
      $this->view->urunler = $urunler;
      $this->view->kategoriler = $kategoriler;
      $this->view->qrKodu = $qrKodu;
      $this->view->menuler = $menuler;
      $this->view->teslimDurumlari = $teslimDurumlari;
      $this->view->calisanBilgileri = $calisanBilgileri;
      $this->view->render("restoran/qr-adisyon/");
    }

  }
  /*QR ADİSYON KODLARI*/


  /*LOKASYON ARKA PLANI AL KODLARI*/
  public function lokasyonKrokisiAl()
  {
    if (isset($_POST["lokasyonKrokisiAl"])) {
      $lokasyon = new Lokasyonlar();
      $lokasyonKrokisi = $lokasyon->getLokasyonKrokisi(array("id"=>$_POST["lokasyonKrokisiAl"]));
      $lokasyon = null;
      echo json_encode(array(
        "lokasyonKrokisi"=>$lokasyonKrokisi
      ));
    }
  }
  /*LOKASYON ARKA PLANI AL KODLARI*/



  /*ADİSYON GEÇMİŞ ÖDEMELERİ AL*/
  public function gecmisOdemeleriAl()
  {
    if (isset($_POST["gecmisOdemeleriAl"])) {

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyon_odemeleri.*,tbl_odeme_metodlari.odeme_metod_adi FROM tbl_adisyon_odemeleri
        LEFT JOIN tbl_odeme_metodlari ON tbl_adisyon_odemeleri.adisyon_odemesi_odeme_metodu_idsi=tbl_odeme_metodlari.id
        WHERE tbl_adisyon_odemeleri.adisyon_odemesi_adisyon_idsi=:adisyon_idsi ORDER BY tbl_adisyon_odemeleri.id DESC"
      );
      $stmt->execute(['adisyon_idsi'=>$_POST["gecmisOdemeleriAl"]]);
      $gecmisOdemeler = $stmt->fetchAll();
      for ($i=0; $i < count($gecmisOdemeler); $i++) {
        $gecmisOdemeler[$i]["adisyon_odemesi_odeme_tarihi"] = $this->fixDateTime($gecmisOdemeler[$i]["adisyon_odemesi_odeme_tarihi"]);
      }

      echo json_encode(array(
        "gecmisOdemeler"=>$gecmisOdemeler
      ));
    }
  }
  /*ADİSYON GEÇMİŞ ÖDEMELERİ AL*/



  /*ADİSYON GEÇMİŞ ÖDEMEYİ SİL*/
  public function odemeyiSil()
  {
    if (isset($_POST["odemeyiSil"])) {

      $veriler = json_decode($_POST["odemeyiSil"],true);

      $model = new Model();

      $stmt = $model->dbh->prepare(
        "SELECT adisyon_odemesi_adisyon_urun_idleri FROM tbl_adisyon_odemeleri WHERE id=:odeme_idsi"
      );
      $stmt->execute(['odeme_idsi'=>$veriler["txtOdemeIdsi"]]);
      $adisyonUrunIdleri = $stmt->fetch()["adisyon_odemesi_adisyon_urun_idleri"];


      $stmt = $model->dbh->prepare(
        "DELETE FROM tbl_adisyon_odemeleri WHERE id=:odeme_idsi"
      );
      $yanit = $stmt->execute(['odeme_idsi'=>$veriler["txtOdemeIdsi"]]);


      if ($yanit) {
        $adisyonUrunIdleri = json_decode($adisyonUrunIdleri,true);
        for ($i=0; $i < count($adisyonUrunIdleri); $i++) {
          $stmt = $model->dbh->prepare(
            "UPDATE tbl_adisyon_urunleri SET adisyon_urunleri_urun_odenmis_urun_adedi=adisyon_urunleri_urun_odenmis_urun_adedi-:odenmis_urun_adedi WHERE id=:adisyon_urun_idsi"
          );
          $yanit = $stmt->execute([
            'adisyon_urun_idsi'=>$adisyonUrunIdleri[$i]["txtAdisyonUrunuIdsi"],
            'odenmis_urun_adedi'=>$adisyonUrunIdleri[$i]["txtOdenecekUrunAdedi"]
          ]);
        }
      }

      $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);


      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ADİSYON GEÇMİŞ ÖDEMEYİ SİL*/


  /*MÜŞTERİNİN GEÇMİŞ ADİSYONLARINI AL KODLARI*/
  public function musteriGecmisAdisyonlariniAl()
  {
    if (isset($_POST["musteriGecmisAdisyonlariniAl"])) {
      $musteriIdsi = $_POST["musteriGecmisAdisyonlariniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT id,adisyon_tutari,adisyon_tarihi FROM tbl_adisyonlar WHERE adisyon_musteri_idsi=:musteri_idsi"
      );
      $stmt->execute(['musteri_idsi'=>$musteriIdsi]);
      $musteriAdisyonlari = $stmt->fetchAll();

      for ($i=0; $i < count($musteriAdisyonlari); $i++) {
        $musteriAdisyonlari[$i]["adisyon_tarihi"] = $this->fixDateTime($musteriAdisyonlari[$i]["adisyon_tarihi"]);
      }

      echo json_encode(array(
        "musteriAdisyonlari"=>$musteriAdisyonlari
      ));
    }
  }
  /*MÜŞTERİNİN GEÇMİŞ ADİSYONLARINI AL KODLARI*/

  /*ÇALIŞANIN GEÇMİŞ ADİSYONLARINI AL KODLARI*/
  public function calisanGecmisAdisyonlariniAl()
  {
    if (isset($_POST["calisanGecmisAdisyonlariniAl"])) {
      $calisanIdsi = $_POST["calisanGecmisAdisyonlariniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT id,adisyon_tutari,adisyon_tarihi FROM tbl_adisyonlar WHERE adisyon_calisan_idsi=:calisan_idsi"
      );
      $stmt->execute(['calisan_idsi'=>$calisanIdsi]);
      $calisanAdisyonlari = $stmt->fetchAll();

      for ($i=0; $i < count($calisanAdisyonlari); $i++) {
        $calisanAdisyonlari[$i]["adisyon_tarihi"] = $this->fixDateTime($calisanAdisyonlari[$i]["adisyon_tarihi"]);
      }

      echo json_encode(array(
        "calisanAdisyonlari"=>$calisanAdisyonlari
      ));
    }
  }
  /*ÇALIŞANIN GEÇMİŞ ADİSYONLARINI AL KODLARI*/

  /*MASA REZERVE ET KODLARI*/
  public function masaRezerveEt()
  {
    if (isset($_POST["masaRezerveEt"])) {
      $rezerveEdilecekMasaIdsi = $_POST["masaRezerveEt"];
      $masa = new Masalar();
      $masaDurumu = $masa->getMasaDurumu(array("id"=>$rezerveEdilecekMasaIdsi));
      if ($masaDurumu == 0) {
        $masa->setMasaId($rezerveEdilecekMasaIdsi);
        $masa->setMasaDurumu(3);
        $this->tabloAdlari = array("tbl_masalar");
        $this->values = array(
          "masa_durumu"=>$masa->masaDurumu,
          "id"=>$masa->masaId
        );
        $yanit = $this->dataUpdate();
      }else {
        $yanit = "Kilitli veya açık masayı rezerve edemezsiniz!";
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*MASA REZERVE ET KODLARI*/

  /*MASANIN ÜRÜNLERİNİ AL KODLARI*/
  public function masaninUrunleriniAl()
  {
    if (isset($_POST["masaninUrunleriniAl"])) {
      $masaIdsi = $_POST["masaninUrunleriniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyon_urunleri.id AS adisyon_urunleri_idsi,tbl_masalar.masa_adi,tbl_adisyon_urunleri.adisyon_urunleri_urun_tablo_adi
        FROM `tbl_adisyonlar`
        INNER JOIN tbl_adisyon_urunleri ON tbl_adisyonlar.id=tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi
        INNER JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
        WHERE tbl_adisyonlar.adisyon_masa_idsi=:masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0"
      );
      $stmt->execute(['masa_idsi'=>$masaIdsi]);
      $adisyonBilgileri = $stmt->fetchAll();


      $adisyonUrunleri = array();
      for ($i=0; $i < count($adisyonBilgileri); $i++) {

        if ($adisyonBilgileri[$i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_urunler") {
          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_urunler.urun_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }elseif ($adisyonBilgileri[$i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_menuler") {
          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_menuler.menu_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_menuler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_menuler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }else {

          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_alt_urunler.alt_urun_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_alt_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_alt_urunler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }

      }


      echo json_encode(array(
        "adisyonBilgileri"=>$adisyonBilgileri,
        "masaninUrunleri"=>$adisyonUrunleri
      ));
    }
  }
  /*MASANIN ÜRÜNLERİNİ AL KODLARI*/


  /*MASA REZERVASYON KALDIRMA KODLARI*/
  public function rezervasyonKaldir()
  {
    if (isset($_POST["rezervasyonKaldir"])) {
      $veriler = json_decode($_POST["rezervasyonKaldir"],true);
      $masa = new Masalar();
      $masa->setMasaId($veriler["txtMasaIdsi"]);
      $masa->setMasaDurumu(0);
      $this->tabloAdlari = array("tbl_masalar");
      $this->values = array(
        "masa_durumu"=>$masa->masaDurumu,
        "id"=>$masa->masaId
      );
      $yanit = $this->dataUpdate();

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*MASA REZERVASYON KALDIRMA KODLARI*/

  /*ADİSYON İNDİRİM YAP, DEĞİŞTİR KODLARI*/
  public function adisyonIndirimDegistir()
  {
    if (isset($_POST["adisyonIndirimDegistir"])) {
      $veriler = json_decode($_POST["adisyonIndirimDegistir"],true);

      $model = new Model();
      $stmt = $model->dbh->prepare("UPDATE tbl_adisyonlar SET adisyon_indirim_turu=:adisyon_indirim_turu,adisyon_indirim_miktari=:adisyon_indirim_miktari WHERE id=:adisyon_idsi");
      $yanit = $stmt->execute([
        'adisyon_indirim_turu'=>$veriler["txtIndirimTuru"],
        'adisyon_indirim_miktari'=>$veriler["txtIndirimMiktari"],
        'adisyon_idsi'=>$veriler["txtAdisyonIdsi"]
      ]);

      $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ADİSYON İNDİRİM YAP, DEĞİŞTİR KODLARI*/

  /*ADİSYON ÖDEME AL*/
  public function adisyonOdemeAl()
  {
    if (isset($_POST["adisyonOdemeAl"])) {
      $veriler = json_decode($_POST["adisyonOdemeAl"],true);

      $adisyon = new Adisyonlar();
      $adisyon->adisyonOdemeleri = new AdisyonOdemeleri();

      $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);

      $adisyon->adisyonOdemeleri->setAdisyonOdemeleriAdisyonIdsi($veriler["txtAdisyonIdsi"]);
      $adisyon->adisyonOdemeleri->setAdisyonOdemeleriOdemeMetoduIdsi($veriler["txtOdemeMetodIdsi"]);
      $adisyon->adisyonOdemeleri->setAdisyonOdemeleriOdemeMiktari($veriler["txtOdenecekTutar"]);
      $adisyon->adisyonOdemeleri->setAdisyonOdemeleriOdemeyiAlanKisiIdsi($_SESSION["uid"]);
      $adisyon->adisyonOdemeleri->setAdisyonOdemeleriAdisyonUrunIdleri(json_encode($veriler["txtTiklananAdisyonUrunleriIdleri"]));

      for ($i=0; $i < count(@$veriler["txtTiklananAdisyonUrunleriIdleri"]); $i++) {
        $adisyon->adisyonUrunleri = new AdisyonUrunleri();
        $adisyonUrunuToplamFiyati = $adisyon->adisyonUrunleri->getAdisyonUrunleriUrunToplamFiyati(array("id"=>$veriler["txtTiklananAdisyonUrunleriIdleri"][$i]["txtAdisyonUrunuIdsi"]));

        $adisyonUrunuToplamAdedi = $adisyon->adisyonUrunleri->getAdisyonUrunleriUrunAdedi(array("id"=>$veriler["txtTiklananAdisyonUrunleriIdleri"][$i]["txtAdisyonUrunuIdsi"]));

        $adisyon->adisyonUrunleri->setAdisyonUrunleriUrunOdenmisUrunAdedi($veriler["txtTiklananAdisyonUrunleriIdleri"][$i]["txtOdenecekUrunAdedi"]);


        $model = new Model();
        $stmt = $model->dbh->prepare("UPDATE tbl_adisyon_urunleri SET adisyon_urunleri_urun_odenmis_urun_adedi=adisyon_urunleri_urun_odenmis_urun_adedi+:odenmis_urun_adedi WHERE id=:adisyon_urun_idsi");
        $stmt->execute([
          'odenmis_urun_adedi'=>$adisyon->adisyonUrunleri->adisyonUrunleriUrunOdenmisUrunAdedi,
          'adisyon_urun_idsi'=>$veriler["txtTiklananAdisyonUrunleriIdleri"][$i]["txtAdisyonUrunuIdsi"]
        ]);
        $model = null;
        $adisyon->adisyonUrunleri = null;
      }

      $this->values = array(
        $adisyon->adisyonOdemeleri->adisyonOdemeleriAdisyonIdsi,
        $adisyon->adisyonOdemeleri->adisyonOdemeleriOdemeMetoduIdsi,
        $adisyon->adisyonOdemeleri->adisyonOdemeleriOdemeMiktari,
        $adisyon->adisyonOdemeleri->adisyonOdemeleriOdemeyiAlanKisiIdsi,
        $adisyon->adisyonOdemeleri->adisyonOdemeleriAdisyonUrunIdleri
      );
      $this->tabloAdlari = array("tbl_adisyon_odemeleri");
      $this->kolonAdlari = array("adisyon_odemesi_adisyon_idsi","adisyon_odemesi_odeme_metodu_idsi","adisyon_odemesi_odeme_miktari","adisyon_odemesi_odemeyi_alan_kisi_idsi","adisyon_odemesi_adisyon_urun_idleri");
      $yanit = $this->dataInsert();

      $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ADİSYON ÖDEME AL*/

  /*MASA KAPANSIN MI KODLARI*/
  public function masaKapansinMi()
  {
    if (isset($_POST["masaKapansinMi"])) {
      $adisyon = new Adisyonlar();
      $adisyonOdemeDurumu = $adisyon->getAdisyonOdemeDurumu(array("id"=>$_POST["masaKapansinMi"]));
      if ($adisyonOdemeDurumu == 1) {
        $adisyonMasaIdsi = $adisyon->getAdisyonMasaIdsi(array("id"=>$_POST["masaKapansinMi"]));
        $model = new Model();
        $stmt = $model->dbh->prepare("UPDATE tbl_masalar SET masa_durumu=0 WHERE id=:masa_idsi");
        $stmt->execute(['masa_idsi'=>$adisyonMasaIdsi]);
      }else {
        $yanit = false;
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*MASA KAPANSIN MI KODLARI*/

  /*ÜRÜNLERİ YAZDIR KODLARI*/
  public function urunleriYazdir()
  {
    if (isset($_POST["urunleriYazdir"])) {
      $veriler = json_decode($_POST["urunleriYazdir"],true);
      $rand = rand(1000,999999);
      $this->yazdirmaBilgileri = array();
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
      $stmt->execute();
      $yazicilar = $stmt->fetchAll();

      $urunYaziciBilgileri = array();
      for ($i=0; $i < count($veriler); $i++) {


        if ($veriler[$i]["txtUrunTabloAdi"] == "tbl_alt_urunler") {
          $stmt = $model->dbh->prepare("SELECT ust_urun_id FROM tbl_alt_urunler WHERE id=:adisyon_urunleri_urun_idsi");
          $stmt->execute([
            'adisyon_urunleri_urun_idsi'=>$veriler[$i]["txtUrunIdsi"]]
          );
          $veriler[$i]["txtUrunIdsi"] = $stmt->fetch()["ust_urun_id"];
        }


        if ($veriler[$i]["txtUrunTabloAdi"] == "tbl_menuler") {
          $stmt = $model->dbh->prepare("SELECT menu_mutfak_idleri FROM tbl_menuler WHERE id=:adisyon_urunleri_urun_idsi");
          $stmt->execute([
            'adisyon_urunleri_urun_idsi'=>$veriler[$i]["txtUrunIdsi"]]
          );
          $urununMutfakIdleri = json_decode($stmt->fetch()["menu_mutfak_idleri"],true);
        }else {
          $stmt = $model->dbh->prepare("SELECT urun_mutfak_idleri FROM tbl_urunler WHERE id=:adisyon_urunleri_urun_idsi");
          $stmt->execute([
            'adisyon_urunleri_urun_idsi'=>$veriler[$i]["txtUrunIdsi"]]
          );
          $urununMutfakIdleri = json_decode($stmt->fetch()["urun_mutfak_idleri"],true);
        }





        $urununYaziciIdleri = array();

        for ($a=0; $a < count($urununMutfakIdleri); $a++) {

          $stmt = $model->dbh->prepare("SELECT tbl_yazicilar.* FROM tbl_yazicilar INNER JOIN tbl_mutfaklar ON tbl_yazicilar.id=tbl_mutfaklar.mutfak_yazici_idsi WHERE tbl_mutfaklar.id=:urunun_mutfak_idsi");
          $stmt->execute(['urunun_mutfak_idsi'=>$urununMutfakIdleri[$a]]);
          $urununYaziciIdleri[] = array(
            "urun_idsi"=>$veriler[$i]["txtUrunIdsi"],
            "urun_adisyon_idsi"=>$veriler[$i]["txtAdisyonUrunuIdsi"],
            "urun_yazici_idsi"=>$stmt->fetch()["id"]
          );
        }

        $urunYaziciBilgileri[] = $urununYaziciIdleri;
      }


      $yazdirmaBilgileri = array();
      for ($i=0; $i < count($yazicilar); $i++) {
        for ($a=0; $a < count($urunYaziciBilgileri); $a++) {
          $yaziciGrubuBilgileri = array();
          for ($b=0; $b < count($urunYaziciBilgileri[$a]); $b++) {
            if ($yazicilar[$i]["id"] == $urunYaziciBilgileri[$a][$b]["urun_yazici_idsi"]) {
              $yaziciGrubuBilgileri[] = array(
                "yazici_idsi"=>$yazicilar[$i]["id"],
                "urun_idsi"=>$urunYaziciBilgileri[$a][$b]["urun_idsi"],
                "urun_adisyon_idsi"=>$urunYaziciBilgileri[$a][$b]["urun_adisyon_idsi"]
              );
              $yazdirmaBilgileri[] = $yaziciGrubuBilgileri;
            }
          }
        }
      }


      for ($i=0; $i < count($yazicilar); $i++) {
        $yazicidanCikacakUrunIdleri = array();
        for ($a=0; $a < count($yazdirmaBilgileri); $a++) {
          if ($yazdirmaBilgileri[$a][0]["yazici_idsi"] == $yazicilar[$i]["id"]) {
            $yazicidanCikacakUrunIdleri[] = array(
              "urun_idsi"=>$yazdirmaBilgileri[$a][0]["urun_idsi"],
              "urun_adisyon_idsi"=>$yazdirmaBilgileri[$a][0]["urun_adisyon_idsi"]
            );
          }
        }
        if (count($yazicidanCikacakUrunIdleri) > 0) {
          $yazdirilacakDosyaAdi = $this->siparisFisiDosyasiOlustur($veriler[0]["txtAdisyonIdsi"],$yazicidanCikacakUrunIdleri);
          exec("lpr -P ".$yazicilar[$i]["yazici_adi"]." ".$this->yolPhp."documents/fisler/".$yazdirilacakDosyaAdi."");
        }
      }


    }
  }

  public function iptalFisiYazdir()
  {
    if (isset($_POST["iptalFisiYazdir"])) {
      $veriler = json_decode($_POST["iptalFisiYazdir"],true);
      $rand = rand(1000,999999);
      $this->yazdirmaBilgileri = array();
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
      $stmt->execute();
      $yazicilar = $stmt->fetchAll();

      $urunYaziciBilgileri = array();
      for ($i=0; $i < count($veriler); $i++) {


        if ($veriler[$i]["txtUrunTabloAdi"] == "tbl_alt_urunler") {
          $stmt = $model->dbh->prepare("SELECT ust_urun_id FROM tbl_alt_urunler WHERE id=:adisyon_urunleri_urun_idsi");
          $stmt->execute([
            'adisyon_urunleri_urun_idsi'=>$veriler[$i]["txtUrunIdsi"]]
          );
          $veriler[$i]["txtUrunIdsi"] = $stmt->fetch()["ust_urun_id"];
        }

        $stmt = $model->dbh->prepare("SELECT urun_mutfak_idleri FROM tbl_urunler WHERE id=:adisyon_urunleri_urun_idsi");
        $stmt->execute([
          'adisyon_urunleri_urun_idsi'=>$veriler[$i]["txtUrunIdsi"]]
        );
        $urununMutfakIdleri = json_decode($stmt->fetch()["urun_mutfak_idleri"],true);

        $urununYaziciIdleri = array();

        for ($a=0; $a < count($urununMutfakIdleri); $a++) {
          $stmt = $model->dbh->prepare("SELECT tbl_yazicilar.* FROM tbl_yazicilar INNER JOIN tbl_mutfaklar ON tbl_yazicilar.id=tbl_mutfaklar.mutfak_yazici_idsi WHERE tbl_mutfaklar.id=:urunun_mutfak_idsi");
          $stmt->execute(['urunun_mutfak_idsi'=>$urununMutfakIdleri[$a]]);
          $urununYaziciIdleri[] = array(
            "urun_idsi"=>$veriler[$i]["txtUrunIdsi"],
            "urun_adisyon_idsi"=>$veriler[$i]["txtAdisyonUrunuIdsi"],
            "urun_yazici_idsi"=>$stmt->fetch()["id"]
          );
        }

        $urunYaziciBilgileri[] = $urununYaziciIdleri;
      }


      $yazdirmaBilgileri = array();
      for ($i=0; $i < count($yazicilar); $i++) {
        for ($a=0; $a < count($urunYaziciBilgileri); $a++) {
          $yaziciGrubuBilgileri = array();
          for ($b=0; $b < count($urunYaziciBilgileri[$a]); $b++) {
            if ($yazicilar[$i]["id"] == $urunYaziciBilgileri[$a][$b]["urun_yazici_idsi"]) {
              $yaziciGrubuBilgileri[] = array(
                "yazici_idsi"=>$yazicilar[$i]["id"],
                "urun_idsi"=>$urunYaziciBilgileri[$a][$b]["urun_idsi"],
                "urun_adisyon_idsi"=>$urunYaziciBilgileri[$a][$b]["urun_adisyon_idsi"]
              );
              $yazdirmaBilgileri[] = $yaziciGrubuBilgileri;
            }
          }
        }
      }

      for ($i=0; $i < count($yazicilar); $i++) {
        $yazicidanCikacakUrunIdleri = array();
        for ($a=0; $a < count($yazdirmaBilgileri); $a++) {
          if ($yazdirmaBilgileri[$a][0]["yazici_idsi"] == $yazicilar[$i]["id"]) {
            $yazicidanCikacakUrunIdleri[] = array(
              "urun_idsi"=>$yazdirmaBilgileri[$a][0]["urun_idsi"],
              "urun_adisyon_idsi"=>$yazdirmaBilgileri[$a][0]["urun_adisyon_idsi"]
            );
          }
        }
        if (count($yazicidanCikacakUrunIdleri) > 0) {
          $yazdirilacakDosyaAdi = $this->iptalFisiDosyasiOlustur($veriler[0]["txtAdisyonIdsi"],$yazicidanCikacakUrunIdleri);
          exec("lpr -P ".$yazicilar[$i]["yazici_adi"]." ".$this->yolPhp."documents/fisler/IPT-".$yazdirilacakDosyaAdi."");

        }
      }


    }
  }
  /*ÜRÜNLERİ YAZDIR KODLARI*/

  /*BİLGİLERİ GÜNCELLEME KODLARI*/
  public function bilgileriGuncelle($adisyonIdsi = false,$returnEt=false)
  {
    // if (isset($_POST["bilgileriGuncelle"])) {
      if ($adisyonIdsi == false) {
        $model = new Model();
        $stmt = $model->dbh->prepare("SELECT id FROM tbl_adisyonlar WHERE adisyon_masa_idsi=:masa_idsi AND adisyon_odeme_durumu=0");
        $stmt->execute(['masa_idsi'=>$_POST["bilgileriGuncelle"]]);
        $adisyonIdsi = $stmt->fetch()["id"];
      }

      $this->adisyonTutariniDuzenle($adisyonIdsi);

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.*,tbl_adisyon_urunleri.id,tbl_masalar.masa_adi,tbl_adisyon_urunleri.id AS adisyon_urunleri_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_tablo_adi,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,
        tbl_adisyon_urunleri.adisyon_urunleri_urun_grami,tbl_musteriler.musteri_adi_soyadi,tbl_musteriler.musteri_telefon_numarasi,tbl_musteriler.musteri_indirim_miktari,tbl_calisanlar.calisan_adi_soyadi,tbl_calisanlar.calisan_indirim_miktari,
        tbl_teslim_durumlari.id AS teslim_durumu_idsi,tbl_teslim_durumlari.*
        FROM `tbl_adisyonlar`
        INNER JOIN tbl_adisyon_urunleri ON tbl_adisyonlar.id=tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi
        LEFT JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_calisan_idsi=tbl_calisanlar.id
        LEFT JOIN tbl_teslim_durumlari ON tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi=tbl_teslim_durumlari.id
        LEFT JOIN tbl_musteriler ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteriler.id
        LEFT JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
        WHERE tbl_adisyonlar.id=:adisyon_idsi"
      );
      $stmt->execute(['adisyon_idsi'=>$adisyonIdsi]);
      $adisyonBilgileri = $stmt->fetchAll();

      $calisan = new Calisanlar();
      $adisyonBilgileri[0]["adisyon_garson_adi"] = $calisan->getCalisanAdiSoyadi(array("id"=>$adisyonBilgileri[0]["adisyon_garson_idsi"]));
      $calisan = null;

      $adisyonMevcutIndirimTuru = $adisyonBilgileri[0]["adisyon_indirim_turu"];
      $adisyonMevcutIndirimMiktari = $adisyonBilgileri[0]["adisyon_indirim_miktari"];

      if ($adisyonMevcutIndirimTuru == 0) {
        $adisyonTutari = $adisyonBilgileri[0]["adisyon_tutari"] - ($adisyonBilgileri[0]["adisyon_tutari"] * $adisyonMevcutIndirimMiktari) / 100;
      }else {
        $adisyonTutari = $adisyonBilgileri[0]["adisyon_tutari"] -  $adisyonMevcutIndirimMiktari;
      }
      $adisyonBilgileri[0]["adisyon_kalan_tutar"] = $adisyonTutari - $adisyonBilgileri[0]["adisyon_odenmis_tutar"];


      $stmt = $model->dbh->prepare("SELECT kur_isareti FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $adisyonBilgileri[0]["varsayilan_kur_isareti"] = $stmt->fetch()["kur_isareti"];

      $adisyonUrunleri = array();
      for ($i=0; $i < count($adisyonBilgileri); $i++) {

        if ($adisyonBilgileri[$i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_urunler") {
          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_urunler.urun_adi AS urun_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }elseif ($adisyonBilgileri[$i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_menuler") {
          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_menuler.menu_adi AS urun_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_menuler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_menuler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }else {

          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_alt_urunler.alt_urun_adi AS urun_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_alt_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_alt_urunler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }



      }

      if ($returnEt != false) {
        return array(
          "adisyonBilgileri"=>$adisyonBilgileri,
          "adisyonUrunleri"=>$adisyonUrunleri
        );
      }else {
        echo json_encode(array(
          "adisyonBilgileri"=>$adisyonBilgileri,
          "adisyonUrunleri"=>$adisyonUrunleri
        ));
      }

    // }
  }
  /*BİLGİLERİ GÜNCELLEME KODLARI*/

  /*
   SATIŞ BİLGİLERİ GÜNCELLEME KODLARI*/
  public function bilgileriGuncelleHizliSatis($adisyonIdsi = false)
  {
    if (isset($_POST["bilgileriGuncelleHizliSatis"])) {
      $veriler = json_decode($_POST["bilgileriGuncelleHizliSatis"],true);

      if ($adisyonIdsi == false) {
        $model = new Model();
        $stmt = $model->dbh->prepare("SELECT MAX(id) AS id FROM tbl_adisyonlar WHERE adisyon_masa_idsi=:masa_idsi AND adisyon_garson_idsi=:calisan_idsi");
        $stmt->execute([
          'masa_idsi'=>$veriler["txtMasaIdsi"],
          'calisan_idsi'=>$_SESSION["uid"]
        ]);
        $adisyonIdsi = $stmt->fetch()["id"];
      }

      // echo $adisyonIdsi;
      $this->adisyonTutariniDuzenle($adisyonIdsi);

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT yazdirma_ayarlari_hizli_satis_oto_yazdir FROM tbl_yazdirma_ayarlari WHERE id=(SELECT MAX(id) FROM tbl_yazdirma_ayarlari)");
      $stmt->execute();
      $yazdirmaAyarlari = $stmt->fetch();







      $stmt = $model->dbh->prepare(
        "SELECT tbl_adisyonlar.*,tbl_adisyon_urunleri.id,tbl_masalar.masa_adi,tbl_adisyon_urunleri.id AS adisyon_urunleri_idsi,tbl_adisyon_urunleri.adisyon_urunleri_urun_tablo_adi,tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi,
        tbl_musteriler.musteri_adi_soyadi,tbl_musteriler.musteri_indirim_miktari,tbl_calisanlar.calisan_adi_soyadi,tbl_calisanlar.calisan_indirim_miktari,
        tbl_teslim_durumlari.id AS teslim_durumu_idsi,tbl_teslim_durumlari.*
        FROM `tbl_adisyonlar`
        INNER JOIN tbl_adisyon_urunleri ON tbl_adisyonlar.id=tbl_adisyon_urunleri.adisyon_urunleri_adisyon_idsi
        LEFT JOIN tbl_calisanlar ON tbl_adisyonlar.adisyon_calisan_idsi=tbl_calisanlar.id
        LEFT JOIN tbl_teslim_durumlari ON tbl_adisyon_urunleri.adisyon_urunleri_urun_teslim_durumu_idsi=tbl_teslim_durumlari.id
        LEFT JOIN tbl_musteriler ON tbl_adisyonlar.adisyon_musteri_idsi=tbl_musteriler.id
        LEFT JOIN tbl_masalar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
        WHERE tbl_adisyonlar.id=:adisyon_idsi AND tbl_adisyonlar.adisyon_garson_idsi=:calisan_idsi"
      );
      $stmt->execute([
        'adisyon_idsi'=>$adisyonIdsi,
        'calisan_idsi'=>$_SESSION["uid"]
      ]);
      $adisyonBilgileri = $stmt->fetchAll();
      // print_r($adisyonBilgileri);

      if ($adisyonBilgileri[0]["adisyon_odeme_durumu"] == 1) {
        if ($yazdirmaAyarlari["yazdirma_ayarlari_hizli_satis_oto_yazdir"] == 1) {
          $this->odemeAdisyonYazdir($adisyonIdsi,$veriler["txtYaziciIdsi"]);
        }
      }


      $calisan = new Calisanlar();
      $adisyonBilgileri[0]["adisyon_garson_adi"] = $calisan->getCalisanAdiSoyadi(array("id"=>$adisyonBilgileri[0]["adisyon_garson_idsi"]));
      $calisan = null;

      $adisyonMevcutIndirimTuru = $adisyonBilgileri[0]["adisyon_indirim_turu"];
      $adisyonMevcutIndirimMiktari = $adisyonBilgileri[0]["adisyon_indirim_miktari"];

      if ($adisyonMevcutIndirimTuru == 0) {
        $adisyonTutari = $adisyonBilgileri[0]["adisyon_tutari"] - ($adisyonBilgileri[0]["adisyon_tutari"] * $adisyonMevcutIndirimMiktari) / 100;
      }else {
        $adisyonTutari = $adisyonBilgileri[0]["adisyon_tutari"] -  $adisyonMevcutIndirimMiktari;
      }
      $adisyonBilgileri[0]["adisyon_kalan_tutar"] = $adisyonTutari - $adisyonBilgileri[0]["adisyon_odenmis_tutar"];


      $stmt = $model->dbh->prepare("SELECT kur_isareti FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $adisyonBilgileri[0]["varsayilan_kur_isareti"] = $stmt->fetch()["kur_isareti"];

      $adisyonUrunleri = array();
      for ($i=0; $i < count($adisyonBilgileri); $i++) {

        if ($adisyonBilgileri[$i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_urunler") {
          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_urunler.urun_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_urunler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }elseif ($adisyonBilgileri[$i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_menuler") {
          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_menuler.menu_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_menuler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_menuler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }else {

          $stmt = $model->dbh->prepare(
            "SELECT tbl_adisyon_urunleri.*,tbl_alt_urunler.alt_urun_adi FROM tbl_adisyon_urunleri
            INNER JOIN tbl_alt_urunler ON tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_alt_urunler.id
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_adisyon_idsi"
          );
          $stmt->execute(['adisyon_urunleri_adisyon_idsi'=>$adisyonBilgileri[$i]["adisyon_urunleri_idsi"]]);
          $adisyonUrunleri[] = $stmt->fetch();
        }



      }


      echo json_encode(array(
        "adisyonBilgileri"=>$adisyonBilgileri,
        "adisyonUrunleri"=>$adisyonUrunleri
      ));

    }
  }
  /*HIZLI SATIŞ BİLGİLERİ GÜNCELLEME KODLARI*/


  /*ÜRÜN DURUM DEĞİŞTİR KODLARI*/
  public function urunTeslimDurumunuDegistir()
  {
    if (isset($_POST["urunTeslimDurumunuDegistir"])) {
      $veriler = json_decode($_POST["urunTeslimDurumunuDegistir"],true);

      for ($i=0; $i < count($veriler["txtDurumuDegistirilecekAdisyonUrunuIdsi"]); $i++) {
        $adisyon = new Adisyonlar();
        $adisyonUrunleri = new AdisyonUrunleri();

        $adisyonUrunleri->setAdisyonUrunleriIdsi($veriler["txtDurumuDegistirilecekAdisyonUrunuIdsi"][$i]);
        $adisyonUrunleri->setAdisyonUrunleriUrunTeslimDurumuIdsi($veriler["txtTeslimDurumuIdsi"]);
        $this->values = array(
          "adisyon_urunleri_urun_teslim_durumu_idsi"=>$adisyonUrunleri->adisyonUrunleriUrunTeslimDurumuIdsi,
          "id"=>$adisyonUrunleri->adisyonUrunleriIdsi
        );
        $this->tabloAdlari = array("tbl_adisyon_urunleri");
        $yanit = $this->dataUpdate();
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*ÜRÜN DURUM DEĞİŞTİR KODLARI*/

  /*ÜRÜN ÖZEL DURUM KODLARI*/
  public function urunIkramEt()
  {
    if (isset($_POST["urunIkramEt"])) {
      $veriler = json_decode($_POST["urunIkramEt"],true);

      for ($i=0; $i < count($veriler); $i++) {
        $adisyon = new Adisyonlar();
        $adisyonUrunleri = new AdisyonUrunleri();
        $urununOncekiOzelDurumu = $adisyonUrunleri->getAdisyonUrunleriUrunOzelDurumuIdsi(array("id"=>$veriler[$i]["txtAdisyonUrunuIdsi"]));
        if ($urununOncekiOzelDurumu == "1") {
          $adisyonUrunleri->setAdisyonUrunleriIdsi($veriler[$i]["txtAdisyonUrunuIdsi"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunOzelDurumuIdsi(0);
          $this->values = array(
            "adisyon_urunleri_urun_ozel_durumu_idsi"=>$adisyonUrunleri->adisyonUrunleriUrunOzelDurumuIdsi,
            "id"=>$adisyonUrunleri->adisyonUrunleriIdsi
          );
          $this->tabloAdlari = array("tbl_adisyon_urunleri");
          $yanit = $this->dataUpdate();
        }else {
          $adisyonUrunleri->setAdisyonUrunleriIdsi($veriler[$i]["txtAdisyonUrunuIdsi"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunOzelDurumuIdsi(1);
          $this->values = array(
            "adisyon_urunleri_urun_ozel_durumu_idsi"=>$adisyonUrunleri->adisyonUrunleriUrunOzelDurumuIdsi,
            "id"=>$adisyonUrunleri->adisyonUrunleriIdsi
          );
          $this->tabloAdlari = array("tbl_adisyon_urunleri");
          $yanit = $this->dataUpdate();
        }

      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }

  public function urunIptalEt()
  {
    if (isset($_POST["urunIptalEt"])) {
      $veriler = json_decode($_POST["urunIptalEt"],true);

      for ($i=0; $i < count($veriler); $i++) {
        $adisyon = new Adisyonlar();
        $adisyonUrunleri = new AdisyonUrunleri();
        $urununOncekiOzelDurumu = $adisyonUrunleri->getAdisyonUrunleriUrunOzelDurumuIdsi(array("id"=>$veriler[$i]["txtAdisyonUrunuIdsi"]));
        if ($urununOncekiOzelDurumu == "2") {
          $adisyonUrunleri->setAdisyonUrunleriIdsi($veriler[$i]["txtAdisyonUrunuIdsi"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunOzelDurumuIdsi(0);
          $this->values = array(
            "adisyon_urunleri_urun_ozel_durumu_idsi"=>$adisyonUrunleri->adisyonUrunleriUrunOzelDurumuIdsi,
            "id"=>$adisyonUrunleri->adisyonUrunleriIdsi
          );
          $this->tabloAdlari = array("tbl_adisyon_urunleri");
          $yanit = $this->dataUpdate();
        }else {
          $adisyonUrunleri->setAdisyonUrunleriIdsi($veriler[$i]["txtAdisyonUrunuIdsi"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunOzelDurumuIdsi(2);
          $this->values = array(
            "adisyon_urunleri_urun_ozel_durumu_idsi"=>$adisyonUrunleri->adisyonUrunleriUrunOzelDurumuIdsi,
            "id"=>$adisyonUrunleri->adisyonUrunleriIdsi
          );
          $this->tabloAdlari = array("tbl_adisyon_urunleri");
          $yanit = $this->dataUpdate();
        }


      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*ÜRÜN ÖZEL DURUM KODLARI*/

  /*MASAYA MÜŞTERİ ATA KODLARI*/
  public function masayaMusteriAta()
  {
    if ($_POST["masayaMusteriAta"]) {
      $veriler = json_decode($_POST["masayaMusteriAta"],true);

      $adisyon = new Adisyonlar();
      $adisyon->setAdisyonIdsi($veriler["txtAdisyonIdsi"]);
      $this->tabloAdlari = array("tbl_adisyonlar");

      $adisyonCalisanIdsi = $adisyon->getAdisyonCalisanIdsi(array("id"=>$veriler["txtAdisyonIdsi"]));
      if ($adisyonCalisanIdsi) {
        $adisyon->setAdisyonCalisanIdsi(null);
        $this->values = array(
          "adisyon_calisan_idsi"=>$adisyon->adisyonCalisanIdsi,
          "id"=>$adisyon->adisyonIdsi
        );
        $this->dataUpdate();
      }
      $musteri = new Musteriler();
      $musteriIndirimTuru = $musteri->getMusteriIndirimTuru(array("id"=>$veriler["txtMusteriIdsi"]));
      $musteriIndirimMiktari = $musteri->getMusteriIndirimMiktari(array("id"=>$veriler["txtMusteriIdsi"]));
      $adisyon->setAdisyonMusteriIdsi($veriler["txtMusteriIdsi"]);
      $adisyon->setAdisyonIndirimTuru($musteriIndirimTuru);
      $adisyon->setAdisyonIndirimMiktari($musteriIndirimMiktari);
      $this->values = array(
        "adisyon_musteri_idsi"=>$adisyon->adisyonMusteriIdsi,
        "adisyon_indirim_turu"=>$adisyon->adisyonIndirimTuru,
        "adisyon_indirim_miktari"=>$adisyon->adisyonIndirimMiktari,
        "id"=>$adisyon->adisyonIdsi
      );
      $this->tabloAdlari = array("tbl_adisyonlar");
      $yanit = $this->dataUpdate();

    }

    echo json_encode(array(
      "yanit"=>$yanit
    ));
  }
  /*MASAYA MÜŞTERİ ATA KODLARI*/

  /*MASAYA ÇALIŞAN ATA KODLARI*/
  public function masayaCalisanAta()
  {
    if ($_POST["masayaCalisanAta"]) {

      $veriler = json_decode($_POST["masayaCalisanAta"],true);
      $calisan = new Calisanlar();
      $calisanGunlukHarcamaSiniri = $calisan->getCalisanGunlukHarcamaSiniri(array("id"=>$veriler["txtCalisanIdsi"]));

      $adisyon = new Adisyonlar();
      $adisyonToplamTutari = $adisyon->getAdisyonTutari(array("id"=>$veriler["txtAdisyonIdsi"]));

      if ($calisanGunlukHarcamaSiniri != null) {
        if ($calisanGunlukHarcamaSiniri < $adisyonToplamTutari) {
          $yanit = "Adisyon tutarı, masaya atamak istediğiniz çalışanın günlük harcama limitinden daha fazla olduğundan dolayı işleminizi gerçekleştiremezsiniz!";
          $izin = false;
        }else {
          $izin = true;
        }
      }else {
        $izin = true;
      }

      if ($izin == true) {
        $this->tabloAdlari = array("tbl_adisyonlar");
        $adisyon->setAdisyonIdsi($veriler["txtAdisyonIdsi"]);

        $adisyonMusteriIdsi = $adisyon->getAdisyonMusteriIdsi(array("id"=>$veriler["txtAdisyonIdsi"]));
        if ($adisyonMusteriIdsi) {
          $adisyon->setAdisyonMusteriIdsi(null);
          $this->values = array(
            "adisyon_musteri_idsi"=>$adisyon->adisyonMusteriIdsi,
            "id"=>$adisyon->adisyonIdsi
          );
          $this->dataUpdate();
        }
        $calisanIndirimTuru = $calisan->getCalisanIndirimTuru(array("id"=>$veriler["txtCalisanIdsi"]));
        $calisanIndirimMiktari = $calisan->getCalisanIndirimMiktari(array("id"=>$veriler["txtCalisanIdsi"]));
        $adisyon->setAdisyonCalisanIdsi($veriler["txtCalisanIdsi"]);
        $adisyon->setAdisyonIndirimTuru($calisanIndirimTuru);
        $adisyon->setAdisyonIndirimMiktari($calisanIndirimMiktari);
        $this->values = array(
          "adisyon_calisan_idsi"=>$adisyon->adisyonCalisanIdsi,
          "adisyon_indirim_turu"=>$adisyon->adisyonIndirimTuru,
          "adisyon_indirim_miktari"=>$adisyon->adisyonIndirimMiktari,
          "id"=>$adisyon->adisyonIdsi
        );
        $yanit = $this->dataUpdate();
      }


    }

    echo json_encode(array(
      "yanit"=>$yanit
    ));
  }
  /*MASAYA ÇALIŞAN ATA KODLARI*/

  /*ADİSYON İNDİRİMİNİ TEKRAR EKLEME KODLARI*/
  public function adisyonIndiriminiTekrarEkle()
  {
    if (isset($_POST["adisyonIndiriminiTekrarEkle"])) {
      $adisyonIdsi = $_POST["adisyonIndiriminiTekrarEkle"];

      $adisyon = new Adisyonlar();
      $musteri = new Musteriler();
      $calisan = new Calisanlar();
      $model = new Model();

      $adisyonMusteriIdsi = $adisyon->getAdisyonMusteriIdsi(array("id"=>$adisyonIdsi));
      if ($adisyonMusteriIdsi) {
        $musteriIndirimTuru = $musteri->getMusteriIndirimTuru(array("id"=>$adisyonMusteriIdsi));
        $musteriIndirimMiktari = $musteri->getMusteriIndirimMiktari(array("id"=>$adisyonMusteriIdsi));

        $stmt = $model->dbh->prepare(
          "UPDATE tbl_adisyonlar SET adisyon_indirim_turu=:adisyon_indirim_turu,adisyon_indirim_miktari=:adisyon_indirim_miktari WHERE id=:adisyon_idsi"
        );
        $yanit = $stmt->execute([
          'adisyon_indirim_turu'=>$musteriIndirimTuru,
          'adisyon_indirim_miktari'=>$musteriIndirimMiktari,
          'adisyon_idsi'=>$adisyonIdsi
        ]);
      }else {
        $adisyonCalisanIdsi = $adisyon->getAdisyonCalisanIdsi(array("id"=>$adisyonIdsi));

        $calisanIndirimTuru = $calisan->getCalisanIndirimTuru(array("id"=>$adisyonCalisanIdsi));
        $calisanIndirimMiktari = $calisan->getCalisanIndirimMiktari(array("id"=>$adisyonCalisanIdsi));

        $stmt = $model->dbh->prepare(
          "UPDATE tbl_adisyonlar SET adisyon_indirim_turu=:adisyon_indirim_turu,adisyon_indirim_miktari=:adisyon_indirim_miktari WHERE id=:adisyon_idsi"
        );
        $yanit = $stmt->execute([
          'adisyon_indirim_turu'=>$calisanIndirimTuru,
          'adisyon_indirim_miktari'=>$calisanIndirimMiktari,
          'adisyon_idsi'=>$adisyonIdsi
        ]);
      }



      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }

  }
  /*ADİSYON İNDİRİMİNİ TEKRAR EKLEME KODLARI*/


  /*ADİSYON İNDİRİMİNİ KALDIRMA KODLARI*/
  public function adisyonIndiriminiKaldir()
  {
    if (isset($_POST["adisyonIndiriminiKaldir"])) {
      $adisyonIdsi = $_POST["adisyonIndiriminiKaldir"];

      $adisyon = new Adisyonlar();
      $this->tabloAdlari = array("tbl_adisyonlar");
      $adisyon->setAdisyonIdsi($adisyonIdsi);
      $adisyon->setAdisyonIndirimTuru(0);
      $adisyon->setAdisyonIndirimMiktari(0);
      $this->values = array(
        "adisyon_indirim_turu"=>$adisyon->adisyonIndirimTuru,
        "adisyon_indirim_miktari"=>$adisyon->adisyonIndirimMiktari,
        "id"=>$adisyon->adisyonIdsi
      );
      $yanit = $this->dataUpdate();

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ADİSYON İNDİRİMİNİ KALDIRMA KODLARI*/

  /*MASA BİRLEŞTİRME KODLARI*/
  public function acikMasalarinBilgileriniAl()
  {
    if (isset($_POST["acikMasalarinBilgileriniAl"])) {
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_masalar.id,tbl_masalar.masa_adi,tbl_lokasyonlar.lokasyon_adi,tbl_adisyonlar.id AS adisyon_idsi
        FROM tbl_masalar INNER JOIN tbl_lokasyonlar ON tbl_masalar.masa_lokasyon_idsi=tbl_lokasyonlar.id
        INNER JOIN tbl_adisyonlar ON tbl_adisyonlar.adisyon_masa_idsi=tbl_masalar.id
        WHERE tbl_masalar.masa_durumu=1 AND tbl_masalar.id<>:mevcut_masa_idsi AND tbl_adisyonlar.adisyon_odeme_durumu=0"
      );
      $stmt->execute(['mevcut_masa_idsi'=>$_POST["acikMasalarinBilgileriniAl"]]);
      $acikMasalar = $stmt->fetchAll();
      echo json_encode(array(
        "acikMasalar"=>$acikMasalar
      ));
    }
  }

  public function masaBirlestir()
  {
    if (isset($_POST["masaBirlestir"])) {
      $veriler = json_decode($_POST["masaBirlestir"],true);
      $model = new Model();


      $stmt = $model->dbh->prepare(
        "UPDATE tbl_adisyon_urunleri SET adisyon_urunleri_adisyon_idsi=:mevcut_masanin_adisyon_idsi WHERE adisyon_urunleri_adisyon_idsi=:birlestirilmek_istenen_masanin_adisyon_idsi"
      );
      $yanit = $stmt->execute([
        'mevcut_masanin_adisyon_idsi'=>$veriler["txtAdisyonIdsi"],
        'birlestirilmek_istenen_masanin_adisyon_idsi'=>$veriler["txtBirlestirilmekIstenenMasaninAdisyonIdsi"]
      ]);

      if ($yanit == true) {
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_masalar SET masa_durumu=0 WHERE id=:birlestirilmek_istenen_masa_idsi"
        );
        $yanit = $stmt->execute([
          'birlestirilmek_istenen_masa_idsi'=>$veriler["txtBirlestirilmekIstenenMasaIdsi"]
        ]);

        if ($yanit == true) {
          $stmt = $model->dbh->prepare(
            "DELETE FROM tbl_adisyonlar WHERE id=:birlestirilmek_istenen_masanin_adisyon_idsi"
          );
          $yanit = $stmt->execute([
            'birlestirilmek_istenen_masanin_adisyon_idsi'=>$veriler["txtBirlestirilmekIstenenMasaninAdisyonIdsi"]
          ]);
          if ($yanit == true) {
            $yanit = $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);
          }
        }
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*MASA BİRLEŞTİRME KODLARI*/



  /*MASA DEĞİŞTİRME KODLARI*/
  public function kapaliMasalarinBilgileriniAl()
  {
    if (isset($_POST["kapaliMasalarinBilgileriniAl"])) {
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_masalar.id,tbl_masalar.masa_adi,tbl_lokasyonlar.lokasyon_adi
        FROM tbl_masalar INNER JOIN tbl_lokasyonlar ON tbl_masalar.masa_lokasyon_idsi=tbl_lokasyonlar.id
        WHERE tbl_masalar.masa_durumu=0"
      );
      $stmt->execute();
      $kapaliMasalar = $stmt->fetchAll();
      echo json_encode(array(
        "kapaliMasalar"=>$kapaliMasalar
      ));
    }
  }

  public function masaDegistir()
  {
    if (isset($_POST["masaDegistir"])) {
      $veriler = json_decode($_POST["masaDegistir"],true);

      $model = new Model();
      $stmt = $model->dbh->prepare("UPDATE tbl_adisyonlar SET adisyon_qr_kodu=:adisyon_qr_kodu,adisyon_masa_idsi=:degistirilmek_istenen_masa_idsi WHERE id=:adisyon_idsi");
      $yanit = $stmt->execute([
        'degistirilmek_istenen_masa_idsi'=>$veriler["txtDegistirilmekIstenenMasaIdsi"],
        'adisyon_qr_kodu'=>null,
        'adisyon_idsi'=>$veriler["txtAdisyonIdsi"]
      ]);

      if ($yanit == true) {
        $stmt = $model->dbh->prepare("UPDATE tbl_masalar SET masa_durumu=0 WHERE id=:mevcut_masa_idsi");
        $yanit = $stmt->execute([
          'mevcut_masa_idsi'=>$veriler["txtMasaIdsi"]
        ]);
        $stmt = $model->dbh->prepare("UPDATE tbl_masalar SET masa_durumu=1 WHERE id=:degistirilmek_istenen_masa_idsi");
        $yanit = $stmt->execute([
          'degistirilmek_istenen_masa_idsi'=>$veriler["txtDegistirilmekIstenenMasaIdsi"]
        ]);
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*MASA DEĞİŞTİRME KODLARI*/

  /*ADiSYON BÖLME KODLARI*/
  public function adisyonBol()
  {
    if (isset($_POST["adisyonBol"])) {
      $veriler = json_decode($_POST["adisyonBol"],true);

      for ($i=0; $i < count($veriler["txtBolunecekAdisyonUrunuIdsi"]); $i++) {
        $model = new Model();
        $stmt = $model->dbh->prepare(
          "UPDATE tbl_adisyon_urunleri SET adisyon_urunleri_adisyon_idsi=:aktarilmak_istenen_adisyon_idsi WHERE id=:aktarilmak_istenen_adiyon_urun_idsi"
        );
        $yanit = $stmt->execute([
          'aktarilmak_istenen_adisyon_idsi'=>$veriler["txtBirlestirilmekIstenenMasaninAdisyonIdsi"],
          'aktarilmak_istenen_adiyon_urun_idsi'=>$veriler["txtBolunecekAdisyonUrunuIdsi"][$i]
        ]);

      }
      if ($yanit == true) {
        $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);
        $this->adisyonTutariniDuzenle($veriler["txtBirlestirilmekIstenenMasaninAdisyonIdsi"]);
        if ($veriler["txtMasaKapansinMi"] == 1) {
          $stmt = $model->dbh->prepare(
            "UPDATE tbl_masalar SET masa_durumu=0 WHERE id=:mevcut_masa_idsi"
          );
          $yanit = $stmt->execute([
            'mevcut_masa_idsi'=>$veriler["txtMasaIdsi"]
          ]);

          if ($yanit) {
            $stmt = $model->dbh->prepare(
              "DELETE FROM tbl_adisyonlar WHERE id=:mevcut_masanin_adisyon_idsi"
            );
            $yanit = $stmt->execute([
              'mevcut_masanin_adisyon_idsi'=>$veriler["txtAdisyonIdsi"]
            ]);
          }
        }


      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*ADiSYON BÖLME KODLARI*/

  /*ADİSYON MÜŞTERİSİNİ/ÇALIŞANINI KALDIRMA KODLARI*/
  public function adisyonMusterisiniKaldir()
  {
    if (isset($_POST["adisyonMusterisiniKaldir"])) {
      $adisyonIdsi = $_POST["adisyonMusterisiniKaldir"];

      $adisyon = new Adisyonlar();
      $this->tabloAdlari = array("tbl_adisyonlar");
      $adisyon->setAdisyonIdsi($adisyonIdsi);
      $adisyon->setAdisyonCalisanIdsi(null);
      $adisyon->setAdisyonMusteriIdsi(null);
      $this->values = array(
        "adisyon_calisan_idsi"=>$adisyon->adisyonCalisanIdsi,
        "adisyon_musteri_idsi"=>$adisyon->adisyonMusteriIdsi,
        "id"=>$adisyon->adisyonIdsi
      );
      $yanit = $this->dataUpdate();

      if ($yanit == true) {
        $model = new Model();
        $stmt = $model->dbh->prepare("UPDATE tbl_adisyonlar SET adisyon_indirim_turu=0,adisyon_indirim_miktari=0 WHERE id=:adisyon_idsi");
        $yanit = $stmt->execute([
          'adisyon_idsi'=>$adisyonIdsi
        ]);
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ADİSYON MÜŞTERİSİNİ/ÇALIŞANINI KALDIRMA KODLARI*/


  /*ADİSYON ÜRÜNÜ SİLME KODLARI*/
  public function urunSil($masaIdsi = false)
  {
    if (isset($_POST["urunSil"])) {
      $izin = $this->yetkiSorgula();
      if ($izin) {
        $veriler = json_decode($_POST["urunSil"],true);

        if ($masaIdsi != false) {
          $model = new Model();
          $stmt = $model->dbh->prepare("SELECT id FROM tbl_adisyonlar WHERE adisyon_masa_idsi=:masa_idsi AND adisyon_odeme_durumu=0 AND adisyon_garson_idsi=:calisan_idsi");
          $stmt->execute([
            'masa_idsi'=>$veriler[0]["txtMasaIdsi"],
            'calisan_idsi'=>$_SESSION["uid"]
          ]);
          $veriler[0]["txtAdisyonIdsi"] = $stmt->fetch()["id"];
        }


        $model = new Model();

        for ($i=0; $i < count($veriler); $i++) {

          $stmt = $model->dbh->prepare("SELECT tbl_stok_dusme_bilgileri.*,tbl_adisyon_urunleri.adisyon_urunleri_urun_adedi FROM tbl_stok_dusme_bilgileri
            INNER JOIN tbl_adisyon_urunleri ON (tbl_adisyon_urunleri.adisyon_urunleri_urun_idsi=tbl_stok_dusme_bilgileri.ait_urun_idsi AND tbl_adisyon_urunleri.adisyon_urunleri_urun_tablo_adi=tbl_stok_dusme_bilgileri.ait_urun_tablo_adi)
            WHERE tbl_adisyon_urunleri.id=:adisyon_urunleri_idsi");
          $stmt->execute(['adisyon_urunleri_idsi'=>$veriler[$i]["txtAdisyonUrunuIdsi"]]);
          $stokDusmeBilgileri = $stmt->fetchAll();

          for ($a=0; $a < count($stokDusmeBilgileri); $a++) {
            $stmt = $model->dbh->prepare("UPDATE tbl_urunler SET urun_adedi=urun_adedi+:stoktan_dusum_miktari WHERE id=:stoktan_dusulecek_urun_idsi");
            $stmt->execute([
              'stoktan_dusum_miktari'=>($stokDusmeBilgileri[$a]["stoktan_dusum_miktari"] * $stokDusmeBilgileri[$a]["adisyon_urunleri_urun_adedi"]),
              'stoktan_dusulecek_urun_idsi'=>$stokDusmeBilgileri[$a]["stoktan_dusulecek_urun_idsi"]
            ]);
          }

        }

        if ($veriler[0]["txtMasaKapansinMi"] == 1) {
          $stmt = $model->dbh->prepare("DELETE FROM tbl_adisyon_urunleri WHERE adisyon_urunleri_adisyon_idsi=:adisyon_idsi");
          $yanit = $stmt->execute(['adisyon_idsi'=>$veriler[0]["txtAdisyonIdsi"]]);
          $stmt = $model->dbh->prepare("DELETE FROM tbl_adisyon_odemeleri WHERE adisyon_odemesi_adisyon_idsi=:adisyon_idsi");
          $yanit = $stmt->execute(['adisyon_idsi'=>$veriler[0]["txtAdisyonIdsi"]]);
          if ($yanit) {
            $stmt = $model->dbh->prepare("DELETE FROM tbl_adisyonlar WHERE id=:adisyon_idsi");
            $yanit = $stmt->execute(['adisyon_idsi'=>$veriler[0]["txtAdisyonIdsi"]]);
            if ($yanit) {
              $stmt = $model->dbh->prepare("UPDATE tbl_masalar SET masa_durumu=0 WHERE id=:masa_idsi");
              $yanit = $stmt->execute(['masa_idsi'=>$veriler[0]["txtMasaIdsi"]]);
            }
          }

        }else {
          for ($i=0; $i < count($veriler); $i++) {
            $adisyon = new Adisyonlar();
            $adisyon->adisyonUrunleri = new AdisyonUrunleri();
            $adisyonUrunuOdenmisMiktar = $adisyon->adisyonUrunleri->getAdisyonUrunleriUrunOdenmisUrunAdedi(array("id"=>$veriler[$i]["txtAdisyonUrunuIdsi"]));
            if ($adisyonUrunuOdenmisMiktar > 0) {
              $yanit = "Ödemesi yapılmış ürünü silemezsiniz!";
              break;
            }
            $model = new Model();
            $stmt = $model->dbh->prepare("DELETE FROM tbl_adisyon_urunleri WHERE id=:adisyon_urun_idsi");
            $yanit = $stmt->execute(['adisyon_urun_idsi'=>$veriler[$i]["txtAdisyonUrunuIdsi"]]);

            $this->adisyonTutariniDuzenle($veriler[$i]["txtAdisyonIdsi"]);
          }
        }

      }else {
        $yanit = "Bu işlem için yetkiniz yoktur!";
      }


      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
  /*ADİSYON ÜRÜNÜ SİLME KODLARI*/

  /*YENİ ADİSYON AÇMA KODLARI*/
  public function yeniAdisyonAc($masaIdsi,$musteriIdsi = null,$qrKodu = null)
  {
    $adisyon = new Adisyonlar();
    $adisyon->setAdisyonMasaIdsi($masaIdsi);
    if ($qrKodu != null) {
      $adisyon->setAdisyonQrKodu($qrKodu);
    }else {
      $adisyon->setAdisyonQrKodu(null);
    }
    $adisyon->setAdisyonMasaIdsi($masaIdsi);
    $adisyon->setAdisyonAcilisSaati(date('H:i:s'));
    $adisyon->setAdisyonOdemeDurumu(0);
    $adisyon->setAdisyonNotu("");
    $adisyon->setAdisyonTutari(0);
    if ($musteriIdsi != null) {
      $adisyon->setAdisyonMusteriIdsi($musteriIdsi);
    }else {
      $adisyon->setAdisyonMusteriIdsi(null);
    }
    $adisyon->setAdisyonOdenmisTutar(0);
    $adisyon->setAdisyonIndirimTuru(0);
    $adisyon->setAdisyonIndirimMiktari(0);
    $adisyon->setAdisyonGarsonIdsi($_SESSION["uid"]);
    $adisyon->setAdisyonIndirimYapanKisiIdsi(0);

    $this->values = array(
      $adisyon->adisyonMasaIdsi,
      $adisyon->adisyonQrKodu,
      $adisyon->adisyonAcilisSaati,
      $adisyon->adisyonOdemeDurumu,
      $adisyon->adisyonNotu,
      $adisyon->adisyonTutari,
      $adisyon->adisyonMusteriIdsi,
      $adisyon->adisyonOdenmisTutar,
      $adisyon->adisyonIndirimTuru,
      $adisyon->adisyonIndirimMiktari,
      $adisyon->adisyonGarsonIdsi,
      $adisyon->adisyonIndirimYapanKisiIdsi
    );

    $this->tabloAdlari = array("tbl_adisyonlar");
    $this->kolonAdlari = array(
      "adisyon_masa_idsi",
      "adisyon_qr_kodu",
      "adisyon_acilis_saati",
      "adisyon_odeme_durumu",
      "adisyon_notu",
      "adisyon_tutari",
      "adisyon_musteri_idsi",
      "adisyon_odenmis_tutar",
      "adisyon_indirim_turu",
      "adisyon_indirim_miktari",
      "adisyon_garson_idsi",
      "adisyon_indirim_yapan_kisi_idsi"
    );

    $yanit = $this->dataInsert();
    $cevap = $yanit;
    if ($yanit["yanit"] == "true") {
      $model = new Model();
      $stmt = $model->dbh->prepare("UPDATE tbl_masalar SET masa_durumu=1 WHERE id=:masa_idsi");
      $stmt->execute(['masa_idsi'=>$masaIdsi]);
    }
    return $cevap;

  }
  /*YENİ ADİSYON AÇMA KODLARI*/

  /*ADİSYONA ÜRÜN EKLEME KODLARI*/
  public function masayaUrunEkle($adisyonId = 0)
  {

    if ($adisyonId != 0) {
      /*masaya çalışan atanmışsa günlük bakiyesi kaldı mı kontrol etme kodları*/
      $adisyon = new Adisyonlar();
      $adisyonTutari = $adisyon->getAdisyonTutari(array("id"=>$adisyonId));
      $adisyonCalisanIdsi = $adisyon->getAdisyonCalisanIdsi(array("id"=>$adisyonId));

      if ($adisyonCalisanIdsi != null) {
        $calisan = new Calisanlar();
        $calisanGunlukHarcamaSiniri = $calisan->getCalisanGunlukHarcamaSiniri(array("id"=>$adisyonCalisanIdsi));
        $model = new Model();
        $stmt = $model->dbh->prepare("SELECT SUM(adisyon_tutari) AS calisan_toplam_harcama FROM tbl_adisyonlar WHERE adisyon_calisan_idsi=:calisan_idsi");
        $stmt->execute(['calisan_idsi'=>$adisyonCalisanIdsi]);
        $calisanToplamHarcama = $stmt->fetch()["calisan_toplam_harcama"];
        $calisanKalanHarcamaMiktari = $calisanGunlukHarcamaSiniri - $calisanToplamHarcama;
      }
      /*masaya çalışan atanmışsa günlük bakiyesi kaldı mı kontrol etme kodları*/

    }

    if (isset($_POST["masayaUrunEkle"])) {
      $izin = false;
      $veriler = json_decode($_POST["masayaUrunEkle"],true);
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT tbl_urunler.urun_adi,tbl_urunler.urun_satis_fiyati,tbl_vergiler.vergi_yuzdesi,tbl_urunler.urun_kg_fiyati
        FROM tbl_urunler
        INNER JOIN tbl_vergiler ON tbl_urunler.urun_satis_vergi_idsi=tbl_vergiler.id WHERE tbl_urunler.id=:urun_idsi");
      $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"]]);
      $urunBilgileri = $stmt->fetch();

      if (@$adisyonCalisanIdsi != null) {
        if ($urunBilgileri["urun_satis_fiyati"] > $calisanKalanHarcamaMiktari) {
          $yanit = "Masaya atadığınız çalışanın günlük harcama sınırı dolduğundan dolayı ürün giremezsiniz!";
          $izin = false;
        }else {
          $izin = true;
        }
      }else {
        $izin = true;
      }

      if ($izin == true) {

        $stmt = $model->dbh->prepare("SELECT masa_durumu FROM tbl_masalar WHERE id=:masa_idsi");
        $stmt->execute(['masa_idsi'=>$veriler["txtMasaIdsi"]]);
        $masaDurumu = $stmt->fetch();

        if ($masaDurumu == 2) {
          $yanit = "Masa kilitli olduğu için sipariş giremezsiniz!";
          return false;
        }

        $adisyon = new Adisyonlar();
        $urun = new Urunler();
        $adisyonUrunleri = new AdisyonUrunleri();

        if ($veriler["txtAdisyonIdsi"] == "") {
          if ($veriler["txtMasaIdsi"] == "QR") {
            $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"],null,$veriler["txtQrKod"]);
          }else {
            if (@$veriler["txtMusteriIdsi"]) {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"],$veriler["txtMusteriIdsi"]);
            }else {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"]);
            }
          }
          $veriler["txtAdisyonIdsi"] = $adisyonIdsi["lastId"];
        }else {
          $adisyonIdsi["lastId"] = $veriler["txtAdisyonIdsi"];
          if (@$veriler["txtHizliSatis"] == 1) {
            $adisyonGarsonIdsi = $adisyon->getAdisyonGarsonIdsi(array("id"=>$veriler["txtAdisyonIdsi"]));
            if ($adisyonGarsonIdsi != $_SESSION["uid"]) {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"]);
            }
          }
        }

        $adisyon->setAdisyonIdsi($veriler["txtAdisyonIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriAdisyonIdsi($veriler["txtAdisyonIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunIdsi($veriler["txtUrunIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunTabloAdi("tbl_urunler");
        $adisyonUrunleri->setAdisyonUrunleriUrunAdedi($veriler["txtUrunAdedi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunOdenmisUrunAdedi(0);
        if (@$veriler["txtUrunGrami"] != null) {
          $adisyonUrunleri->setAdisyonUrunleriUrunGrami($veriler["txtUrunGrami"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunBirimFiyati($urunBilgileri["urun_kg_fiyati"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunToplamFiyati(($urunBilgileri["urun_kg_fiyati"] * $veriler["txtUrunGrami"]) * $veriler["txtUrunAdedi"]);
          $urunVergiMiktari = ($adisyonUrunleri->adisyonUrunleriUrunToplamFiyati * $urunBilgileri["vergi_yuzdesi"]) / 100;
          $adisyonUrunleri->setAdisyonUrunleriUrunVergiMiktari($urunVergiMiktari);
        }else {
          $adisyonUrunleri->setAdisyonUrunleriUrunBirimFiyati($urunBilgileri["urun_satis_fiyati"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunToplamFiyati(($urunBilgileri["urun_satis_fiyati"] * $veriler["txtUrunAdedi"]));
          $urunVergiMiktari = ($adisyonUrunleri->adisyonUrunleriUrunToplamFiyati * $urunBilgileri["vergi_yuzdesi"]) / 100;
          $adisyonUrunleri->setAdisyonUrunleriUrunVergiMiktari($urunVergiMiktari);
        }

        $adisyonUrunleri->setAdisyonUrunleriUrunTeslimDurumuIdsi(0);
        $adisyonUrunleri->setAdisyonUrunleriUrunOzelDurumuIdsi(0);
        $adisyonUrunleri->setAdisyonUrunleriUrunNotu("");
        $adisyonUrunleri->setAdisyonUrunleriUrunCalisanIdsi($_SESSION["uid"]);

        $this->values = array(
          $adisyonUrunleri->adisyonUrunleriAdisyonIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunTabloAdi,
          $adisyonUrunleri->adisyonUrunleriUrunAdedi,
          $adisyonUrunleri->adisyonUrunleriUrunGrami,
          $adisyonUrunleri->adisyonUrunleriUrunOdenmisUrunAdedi,
          $adisyonUrunleri->adisyonUrunleriUrunBirimFiyati,
          $adisyonUrunleri->adisyonUrunleriUrunToplamFiyati,
          $adisyonUrunleri->adisyonUrunleriUrunVergiMiktari,
          $adisyonUrunleri->adisyonUrunleriUrunTeslimDurumuIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunOzelDurumuIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunNotu,
          $adisyonUrunleri->adisyonUrunleriUrunCalisanIdsi
          );

          $this->tabloAdlari = array("tbl_adisyon_urunleri");
          $this->kolonAdlari = array(
          "adisyon_urunleri_adisyon_idsi",
          "adisyon_urunleri_urun_idsi",
          "adisyon_urunleri_urun_tablo_adi",
          "adisyon_urunleri_urun_adedi",
          "adisyon_urunleri_urun_grami",
          "adisyon_urunleri_urun_odenmis_urun_adedi",
          "adisyon_urunleri_urun_birim_fiyati",
          "adisyon_urunleri_urun_toplam_fiyati",
          "adisyon_urunleri_urun_vergi_miktari",
          "adisyon_urunleri_urun_teslim_durumu_idsi",
          "adisyon_urunleri_urun_ozel_durumu_idsi",
          "adisyon_urunleri_urun_notu",
          "adisyon_urunleri_urun_calisan_idsi"
          );
          $yanit = $this->dataInsert();
          if ($yanit["yanit"] == "true") {
            $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);
          }

          if ($yanit["yanit"] == true) {
            $stmt = $model->dbh->prepare("SELECT * FROM tbl_stok_dusme_bilgileri WHERE ait_urun_idsi=:urun_idsi AND ait_urun_tablo_adi=:ait_urun_tablo_adi");
            $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"],'ait_urun_tablo_adi'=>"tbl_urunler"]);
            $stokDusmeBilgileri = $stmt->fetchAll();

            for ($i=0; $i < count($stokDusmeBilgileri); $i++) {
              $stmt = $model->dbh->prepare("UPDATE tbl_urunler SET urun_adedi=urun_adedi-:stoktan_dusum_miktari WHERE id=:stoktan_dusulecek_urun_idsi");
              $stmt->execute([
              'stoktan_dusum_miktari'=>($stokDusmeBilgileri[$i]["stoktan_dusum_miktari"] * $veriler["txtUrunAdedi"]),
              'stoktan_dusulecek_urun_idsi'=>$stokDusmeBilgileri[$i]["stoktan_dusulecek_urun_idsi"]
              ]);
            }

          }
      }

      echo json_encode(array(
        "yanit"=>$yanit,
        "adisyonIdsi"=>$adisyonIdsi["lastId"]
      ));
    }
    if (isset($_POST["masayaAltUrunEkle"])) {
      $izin = false;

      $veriler = json_decode($_POST["masayaAltUrunEkle"],true);
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT tbl_alt_urunler.alt_urun_adi,tbl_alt_urunler.alt_urun_satis_fiyati,tbl_vergiler.vergi_yuzdesi,tbl_alt_urunler.alt_urun_kg_fiyati
        FROM tbl_alt_urunler
        INNER JOIN tbl_vergiler ON tbl_alt_urunler.alt_urun_satis_vergi_idsi=tbl_vergiler.id WHERE tbl_alt_urunler.id=:urun_idsi");
      $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"]]);
      $urunBilgileri = $stmt->fetch();

      if (@$adisyonCalisanIdsi != null) {
        if ($urunBilgileri["alt_urun_satis_fiyati"] > $calisanKalanHarcamaMiktari) {
          $yanit = "Masaya atadığınız çalışanın günlük harcama sınırı dolduğundan dolayı ürün giremezsiniz!";
          $izin = false;
        }else {
          $izin = true;
        }
      }else {
        $izin = true;
      }

      if ($izin == true) {

        $adisyon = new Adisyonlar();
        $urun = new Urunler();
        $adisyonUrunleri = new AdisyonUrunleri();
        if (!$veriler["txtAdisyonIdsi"]) {
          if ($veriler["txtMasaIdsi"] == "QR") {
            $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"],null,$veriler["txtQrKod"]);
          }else {
            if (@$veriler["txtMusteriIdsi"]) {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"],$veriler["txtMusteriIdsi"]);
            }else {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"]);
            }
          }
          $veriler["txtAdisyonIdsi"] = $adisyonIdsi["lastId"];
        }else {
          $adisyonIdsi["lastId"] = $veriler["txtAdisyonIdsi"];
          if (@$veriler["txtHizliSatis"] == 1) {
            $adisyonGarsonIdsi = $adisyon->getAdisyonGarsonIdsi(array("id"=>$veriler["txtAdisyonIdsi"]));
            if ($adisyonGarsonIdsi != $_SESSION["uid"]) {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"]);
            }
          }
        }
        $adisyon->setAdisyonIdsi($veriler["txtAdisyonIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriAdisyonIdsi($veriler["txtAdisyonIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunIdsi($veriler["txtUrunIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunTabloAdi("tbl_alt_urunler");
        $adisyonUrunleri->setAdisyonUrunleriUrunAdedi($veriler["txtUrunAdedi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunOdenmisUrunAdedi(0);
        if (@$veriler["txtUrunGrami"] != null) {
          $adisyonUrunleri->setAdisyonUrunleriUrunGrami($veriler["txtUrunGrami"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunBirimFiyati($urunBilgileri["alt_urun_kg_fiyati"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunToplamFiyati(($urunBilgileri["alt_urun_kg_fiyati"] * $veriler["txtUrunGrami"]) * $veriler["txtUrunAdedi"]);
          $urunVergiMiktari = ($adisyonUrunleri->adisyonUrunleriUrunToplamFiyati * $urunBilgileri["vergi_yuzdesi"]) / 100;
          $adisyonUrunleri->setAdisyonUrunleriUrunVergiMiktari($urunVergiMiktari);
        }else {
          $adisyonUrunleri->setAdisyonUrunleriUrunBirimFiyati($urunBilgileri["alt_urun_satis_fiyati"]);
          $adisyonUrunleri->setAdisyonUrunleriUrunToplamFiyati(($urunBilgileri["alt_urun_satis_fiyati"] * $veriler["txtUrunAdedi"]));
          $urunVergiMiktari = ($adisyonUrunleri->adisyonUrunleriUrunToplamFiyati * $urunBilgileri["vergi_yuzdesi"]) / 100;
          $adisyonUrunleri->setAdisyonUrunleriUrunVergiMiktari($urunVergiMiktari);
        }
        $adisyonUrunleri->setAdisyonUrunleriUrunTeslimDurumuIdsi(0);
        $adisyonUrunleri->setAdisyonUrunleriUrunOzelDurumuIdsi(0);
        $adisyonUrunleri->setAdisyonUrunleriUrunNotu("");
        $adisyonUrunleri->setAdisyonUrunleriUrunCalisanIdsi($_SESSION["uid"]);

        $this->values = array(
          $adisyonUrunleri->adisyonUrunleriAdisyonIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunTabloAdi,
          $adisyonUrunleri->adisyonUrunleriUrunAdedi,
          $adisyonUrunleri->adisyonUrunleriUrunGrami,
          $adisyonUrunleri->adisyonUrunleriUrunOdenmisUrunAdedi,
          $adisyonUrunleri->adisyonUrunleriUrunBirimFiyati,
          $adisyonUrunleri->adisyonUrunleriUrunToplamFiyati,
          $adisyonUrunleri->adisyonUrunleriUrunVergiMiktari,
          $adisyonUrunleri->adisyonUrunleriUrunTeslimDurumuIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunOzelDurumuIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunNotu,
          $adisyonUrunleri->adisyonUrunleriUrunCalisanIdsi
        );

        $this->tabloAdlari = array("tbl_adisyon_urunleri");
        $this->kolonAdlari = array(
        "adisyon_urunleri_adisyon_idsi",
        "adisyon_urunleri_urun_idsi",
        "adisyon_urunleri_urun_tablo_adi",
        "adisyon_urunleri_urun_adedi",
        "adisyon_urunleri_urun_grami",
        "adisyon_urunleri_urun_odenmis_urun_adedi",
        "adisyon_urunleri_urun_birim_fiyati",
        "adisyon_urunleri_urun_toplam_fiyati",
        "adisyon_urunleri_urun_vergi_miktari",
        "adisyon_urunleri_urun_teslim_durumu_idsi",
        "adisyon_urunleri_urun_ozel_durumu_idsi",
        "adisyon_urunleri_urun_notu",
        "adisyon_urunleri_urun_calisan_idsi"

        );
        $yanit = $this->dataInsert();
        if ($yanit["yanit"] == "true") {
          $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);
        }

        if ($yanit["yanit"] == true) {
          $stmt = $model->dbh->prepare("SELECT * FROM tbl_stok_dusme_bilgileri WHERE ait_urun_idsi=:urun_idsi AND ait_urun_tablo_adi=:ait_urun_tablo_adi");
          $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"],'ait_urun_tablo_adi'=>"tbl_alt_urunler"]);
          $stokDusmeBilgileri = $stmt->fetchAll();

          for ($i=0; $i < count($stokDusmeBilgileri); $i++) {
            $stmt = $model->dbh->prepare("UPDATE tbl_urunler SET urun_adedi=urun_adedi-:stoktan_dusum_miktari WHERE id=:stoktan_dusulecek_urun_idsi");
            $stmt->execute([
            'stoktan_dusum_miktari'=>($stokDusmeBilgileri[$i]["stoktan_dusum_miktari"] * $veriler["txtUrunAdedi"]),
            'stoktan_dusulecek_urun_idsi'=>$stokDusmeBilgileri[$i]["stoktan_dusulecek_urun_idsi"]
            ]);
          }

        }
      }

      echo json_encode(array(
        "yanit"=>$yanit,
        "adisyonIdsi"=>$adisyonIdsi["lastId"]
      ));
    }
    if (isset($_POST["masayaMenuEkle"])) {
      $izin = false;

      $veriler = json_decode($_POST["masayaMenuEkle"],true);
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_menuler.*,tbl_menu_urunleri.*,tbl_urunler.urun_satis_vergi_idsi,tbl_urunler.urun_satis_fiyati,tbl_vergiler.vergi_yuzdesi FROM tbl_menuler
        INNER JOIN tbl_menu_urunleri ON tbl_menuler.id=tbl_menu_urunleri.menu_urunleri_menu_idsi
        INNER JOIN tbl_urunler ON tbl_urunler.id=tbl_menu_urunleri.menu_urunleri_urun_idsi
        INNER JOIN tbl_vergiler ON tbl_urunler.urun_satis_vergi_idsi=tbl_vergiler.id
        WHERE tbl_menuler.id=:urun_idsi"
      );
      $stmt->execute(['urun_idsi'=>$veriler["txtUrunIdsi"]]);
      $urunBilgileri = $stmt->fetchAll();

      if (@$adisyonCalisanIdsi != null) {
        if ($urunBilgileri["menu_toplam_fiyati"] > $calisanKalanHarcamaMiktari) {
          $yanit = "Masaya atadığınız çalışanın günlük harcama sınırı dolduğundan dolayı ürün giremezsiniz!";
          $izin = false;
        }else {
          $izin = true;
        }
      }else {
        $izin = true;
      }

      if ($izin == true) {

        $toplamVergi = 0;
        for ($i=0; $i < count($urunBilgileri); $i++) {
          $urunTutari = $urunBilgileri[$i]["urun_satis_fiyati"] * $urunBilgileri[$i]["menu_urunleri_urun_adedi"];
          $toplamVergi += ($urunTutari * $urunBilgileri[$i]["vergi_yuzdesi"]) / 100;
        }

        $adisyon = new Adisyonlar();
        $urun = new Urunler();
        $adisyonUrunleri = new AdisyonUrunleri();
        if (!$veriler["txtAdisyonIdsi"]) {
          if ($veriler["txtMasaIdsi"] == "QR") {
            $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"],null,$veriler["txtQrKod"]);
          }else {
            if (@$veriler["txtMusteriIdsi"]) {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"],$veriler["txtMusteriIdsi"]);
            }else {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"]);
            }
          }
          $veriler["txtAdisyonIdsi"] = $adisyonIdsi["lastId"];
        }else {
          $adisyonIdsi["lastId"] = $veriler["txtAdisyonIdsi"];
          if (@$veriler["txtHizliSatis"] == 1) {
            $adisyonGarsonIdsi = $adisyon->getAdisyonGarsonIdsi(array("id"=>$veriler["txtAdisyonIdsi"]));
            if ($adisyonGarsonIdsi != $_SESSION["uid"]) {
              $adisyonIdsi = $this->yeniAdisyonAc($veriler["txtMasaIdsi"]);
            }
          }
        }
        $adisyon->setAdisyonIdsi($veriler["txtAdisyonIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriAdisyonIdsi($veriler["txtAdisyonIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunIdsi($veriler["txtUrunIdsi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunTabloAdi("tbl_menuler");
        $adisyonUrunleri->setAdisyonUrunleriUrunAdedi($veriler["txtUrunAdedi"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunOdenmisUrunAdedi(0);
        $adisyonUrunleri->setAdisyonUrunleriUrunBirimFiyati($urunBilgileri[0]["menu_toplam_fiyati"]);
        $adisyonUrunleri->setAdisyonUrunleriUrunToplamFiyati(($urunBilgileri[0]["menu_toplam_fiyati"] * $veriler["txtUrunAdedi"]));
        $adisyonUrunleri->setAdisyonUrunleriUrunVergiMiktari($toplamVergi);
        $adisyonUrunleri->setAdisyonUrunleriUrunTeslimDurumuIdsi(0);
        $adisyonUrunleri->setAdisyonUrunleriUrunOzelDurumuIdsi(0);
        $adisyonUrunleri->setAdisyonUrunleriUrunNotu("");
        $adisyonUrunleri->setAdisyonUrunleriUrunCalisanIdsi($_SESSION["uid"]);

        $this->values = array(
          $adisyonUrunleri->adisyonUrunleriAdisyonIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunTabloAdi,
          $adisyonUrunleri->adisyonUrunleriUrunAdedi,
          $adisyonUrunleri->adisyonUrunleriUrunOdenmisUrunAdedi,
          $adisyonUrunleri->adisyonUrunleriUrunBirimFiyati,
          $adisyonUrunleri->adisyonUrunleriUrunToplamFiyati,
          $adisyonUrunleri->adisyonUrunleriUrunVergiMiktari,
          $adisyonUrunleri->adisyonUrunleriUrunTeslimDurumuIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunOzelDurumuIdsi,
          $adisyonUrunleri->adisyonUrunleriUrunNotu,
          $adisyonUrunleri->adisyonUrunleriUrunCalisanIdsi
        );

        $this->tabloAdlari = array("tbl_adisyon_urunleri");
        $this->kolonAdlari = array(
          "adisyon_urunleri_adisyon_idsi",
          "adisyon_urunleri_urun_idsi",
          "adisyon_urunleri_urun_tablo_adi",
          "adisyon_urunleri_urun_adedi",
          "adisyon_urunleri_urun_odenmis_urun_adedi",
          "adisyon_urunleri_urun_birim_fiyati",
          "adisyon_urunleri_urun_toplam_fiyati",
          "adisyon_urunleri_urun_vergi_miktari",
          "adisyon_urunleri_urun_teslim_durumu_idsi",
          "adisyon_urunleri_urun_ozel_durumu_idsi",
          "adisyon_urunleri_urun_notu",
          "adisyon_urunleri_urun_calisan_idsi"

          );
          $yanit = $this->dataInsert();
          if ($yanit["yanit"] == "true") {
            $this->adisyonTutariniDuzenle($veriler["txtAdisyonIdsi"]);
          }
          $modal = null;
      }

      echo json_encode(array(
        "yanit"=>$yanit,
        "adisyonIdsi"=>$adisyonIdsi["lastId"]
      ));
    }
  }
  /*ADİSYONA ÜRÜN EKLEME KODLARI*/

  /*ÜRÜN NOTU EKLEME KODLARI*/
  public function urunNotuEkle()
  {
    if (isset($_POST["urunNotuEkle"])) {
      $veriler = json_decode($_POST["urunNotuEkle"],true);
      for ($i=0; $i < count($veriler["txtNotuGirilecekAdisyonUrunuIdsi"]); $i++) {
        $adisyon = new Adisyonlar();
        $adisyonUrunleri = new AdisyonUrunleri();
        $adisyonUrunleri->setAdisyonUrunleriIdsi($veriler["txtNotuGirilecekAdisyonUrunuIdsi"][$i]);
        $adisyonUrunleri->setAdisyonUrunleriUrunNotu($veriler["txtUrunNotu"]);
        $this->values = array(
          "adisyon_urunleri_urun_notu"=>$adisyonUrunleri->adisyonUrunleriUrunNotu,
          "id"=>$adisyonUrunleri->adisyonUrunleriIdsi
        );
        $this->tabloAdlari = array("tbl_adisyon_urunleri");
        $yanit = $this->dataUpdate();
        if(@$veriler["cboxHizliNotlaraKaydedilsin"]){
          $calisan = new Calisanlar();
          $calisanMevcutHizliNotlari = json_decode($calisan->getCalisanHizliNotlari(array("id"=>$_SESSION["uid"])),true);
          array_push($calisanMevcutHizliNotlari,$veriler["txtUrunNotu"]);
          $calisanNotlari = json_encode($calisanMevcutHizliNotlari);
          $calisan->setCalisanHizliNotlari($calisanNotlari);
          $this->values = array(
            "calisan_hizli_notlari"=>$calisan->calisanHizliNotlari,
            "id"=>$_SESSION["uid"]
          );
          $this->tabloAdlari = array("tbl_calisanlar");
          $yanit = $this->dataUpdate();
        }
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*ÜRÜN NOTU EKLEME KODLARI*/


  /*MENÜ İÇERİĞİNİ GÖSTERME KODLARI*/
  public function menuIceriginiAl()
  {
    if (isset($_POST["menuIceriginiAl"])) {
      $menuIdsi = $_POST["menuIceriginiAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_menuler.id AS menu_idsi,tbl_menu_urunleri.*,tbl_urunler.urun_adi FROM tbl_menu_urunleri
        INNER JOIN tbl_urunler ON tbl_urunler.id=tbl_menu_urunleri.menu_urunleri_urun_idsi
        INNER JOIN tbl_menuler ON tbl_menuler.id=tbl_menu_urunleri.menu_urunleri_menu_idsi
        WHERE tbl_menuler.id=:menu_idsi"
      );
      $stmt->execute(['menu_idsi'=>$menuIdsi]);
      $menuBilgileri = $stmt->fetchAll();

      echo json_encode(array(
        "menuIcerigi"=>$menuBilgileri
      ));
    }
  }
  /*MENÜ İÇERİĞİNİ GÖSTERME KODLARI*/

}
