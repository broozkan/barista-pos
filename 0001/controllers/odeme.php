<?php

/**
 *
 */
class Odeme extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_odemeler");
    $this->kolonAdlari = array("odeme_kodu","odeme_cari_idsi","odeme_tarihi","odeme_tutari","odeme_kasa_idsi","odeme_aciklamasi");

    $this->sayfaIzınAdi = "txtMuhasebeMerkezineGirebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";


    }
  }

  public function odemelistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }

    $model = new Model();

    $stmt = $model->dbh->prepare("SELECT kur_isareti FROM tbl_kurlar WHERE kur_aktif_mi=1");
    $stmt->execute();
    $kurIsareti = $stmt->fetch()["kur_isareti"];
    $model = null;

    $odeme = new Odemeler();
    $musteri = new Musteriler();
    $kasa = new Kasalar();
    $toplamVeriSayisi = $odeme->selectQuery($this->tabloAdlari[0],array("id"));
    $odemeIdleri = $odeme->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);


    for ($i=0; $i < count($odemeIdleri); $i++) {
      $odemeCariIdsi = $odeme->getOdemeCariIdsi(array("id"=>$odemeIdleri[$i]["id"]));
      $odemeKasaIdsi = $odeme->getOdemeKasaIdsi(array("id"=>$odemeIdleri[$i]["id"]));

      $odemeCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$odemeCariIdsi));
      $odemeKasaAdi = $kasa->getKasaAdi(array("id"=>$odemeKasaIdsi));

      $odemeTarihi = explode(" ",$odeme->getOdemeTarihi(array("id"=>$odemeIdleri[$i]["id"])));
      $odemeTarihi = $this->fixDate($odemeTarihi[0]);

      $odemeListesi[] = array(
        "odemeId"=>$odemeIdleri[$i]["id"],
        "odemeKodu"=>$odeme->getOdemeKodu(array("id"=>$odemeIdleri[$i]["id"])),
        "odemeTarihi"=>$odemeTarihi,
        "odemeCariAdi"=>$odemeCariAdi,
        "odemeTutari"=>$odeme->getOdemeTutari(array("id"=>$odemeIdleri[$i]["id"])),
        "odemeKasaAdi"=>$odemeKasaAdi,
        "odemeAciklamasi"=>$odeme->getOdemeAciklamasi(array("id"=>$odemeIdleri[$i]["id"]))
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->kurIsareti = $kurIsareti;
    $this->view->odemeListesi = @$odemeListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("merkezler/odeme/odeme-listesi");
  }

  public function odemeekle()
  {
    if (isset($_POST["odemeEkle"])) {
      date_default_timezone_set('Europe/Istanbul');
      $veriler = json_decode($_POST["odemeEkle"],true);
      $odeme = new Odemeler();
      $odeme->setOdemeKodu($veriler["txtOdemeKodu"]);
      $odeme->setOdemeCariIdsi($veriler["txtOdemeCariIdsi"]);
      $odeme->setOdemeTarihi($veriler["txtOdemeTarihi"]." ".date("H:i:s"));
      $odeme->setOdemeTutari($veriler["txtOdemeTutari"]);
      $odeme->setOdemeKasaIdsi($veriler["txtOdemeKasaIdsi"]);
      $odeme->setOdemeAciklamasi($veriler["txtOdemeAciklamasi"]);
      $this->values = array(
        $odeme->odemeKodu,
        $odeme->odemeCariIdsi,
        $odeme->odemeTarihi,
        $odeme->odemeTutari,
        $odeme->odemeKasaIdsi,
        $odeme->odemeAciklamasi
      );
      $yanit = $this->dataInsert();
      $odeme = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
      $stmt->execute();
      $birincilKasaIdsi = $stmt->fetch();


      $this->view->kasalar = $kasalar;
      $this->view->birincilKasaIdsi = $birincilKasaIdsi["id"];
      $this->view->render("merkezler/odeme/odeme-ekle");
    }
  }

  public function odemeduzenle($idler = false)
  {
    if (isset($_POST["odemeDuzenle"])) {
      $veriler = json_decode($_POST["odemeDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $odeme = new Odemeler();
        $odeme->setOdemeKodu($veriler[$i]["txtOdemeKodu"]);
        $odeme->setOdemeCariIdsi($veriler[$i]["txtOdemeCariIdsi"]);
        $odeme->setOdemeTarihi($veriler[$i]["txtOdemeTarihi"]);
        $odeme->setOdemeTutari($veriler[$i]["txtOdemeTutari"]);
        $odeme->setOdemeKasaIdsi($veriler[$i]["txtOdemeKasaIdsi"]);
        $odeme->setOdemeAciklamasi($veriler[$i]["txtOdemeAciklamasi"]);
        $odeme->setOdemeIdsi($veriler[$i]["txtOdemeId"]);
        $this->values = array(
          "odeme_kodu"=>$odeme->odemeKodu,
          "odeme_cari_idsi"=>$odeme->odemeCariIdsi,
          "odeme_tarihi"=>$odeme->odemeTarihi,
          "odeme_tutari"=>$odeme->odemeTutari,
          "odeme_kasa_idsi"=>$odeme->odemeKasaIdsi,
          "odeme_aciklamasi"=>$odeme->odemeAciklamasi,
          "id"=>$odeme->odemeIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $odeme = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {
          $odeme = new Odemeler();
          $musteri = new Musteriler();
          $kasa = new Kasalar();

          $odemeCariIdsi = $odeme->getOdemeCariIdsi(array("id"=>$idler[$i]));
          $odemeKasaIdsi = $odeme->getOdemeKasaIdsi(array("id"=>$idler[$i]));

          $odemeCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$odemeCariIdsi));
          $odemeKasaAdi = $kasa->getKasaAdi(array("id"=>$odemeKasaIdsi));

          $odemeTarihi = $odeme->getOdemeTarihi(array("id"=>$idler[$i]));

          $odemeTarihi = explode(" ",$odemeTarihi);
          // $odemeTarihi = $this->fixDate($odemeTarihi[0]);

          $odemeBilgileri[] = array(
            "odemeId"=>$idler[$i],
            "odemeKodu"=>$odeme->getOdemeKodu(array("id"=>$idler[$i])),
            "odemeCariAdi"=>$odemeCariAdi,
            "odemeCariIdsi"=>$odemeCariIdsi,
            "odemeTarihi"=>$odemeTarihi[0],
            "odemeTutari"=>$odeme->getOdemeTutari(array("id"=>$idler[$i])),
            "odemeKasaIdsi"=>$odeme->getOdemeKasaIdsi(array("id"=>$idler[$i])),
            "odemeAciklamasi"=>$odeme->getOdemeAciklamasi(array("id"=>$idler[$i]))
          );
        }
      }
      $odeme = null;

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $this->view->kasalar = $kasalar;
      $this->view->odemeBilgileri = $odemeBilgileri;
      $this->view->render("merkezler/odeme/odeme-duzenle");
    }
  }

  public function odemeSil()
  {
    if (isset($_POST["odemeSil"])) {
      $veriler = json_decode($_POST["odemeSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $odeme = new Odemeler();
        $odeme->setOdemeIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$odeme->odemeIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
