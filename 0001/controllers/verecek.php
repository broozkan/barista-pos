<?php

/**
 *
 */
class Verecek extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_verecekler");
    $this->kolonAdlari = array("verecek_kodu","verecek_cari_idsi","verecek_tutari","verecek_kasa_idsi","verecek_aciklamasi");

    $this->sayfaIzınAdi = "txtMuhasebeMerkezineGirebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function vereceklistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $verecek = new Verecekler();
    $musteri = new Musteriler();
    $kasa = new Kasalar();
    $toplamVeriSayisi = $verecek->selectQuery($this->tabloAdlari[0],array("id"));
    $verecekIdleri = $verecek->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);


    for ($i=0; $i < count($verecekIdleri); $i++) {
      $verecekCariIdsi = $verecek->getVerecekCariIdsi(array("id"=>$verecekIdleri[$i]["id"]));
      $verecekKasaIdsi = $verecek->getVerecekKasaIdsi(array("id"=>$verecekIdleri[$i]["id"]));

      $verecekCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$verecekCariIdsi));
      $verecekKasaAdi = $kasa->getKasaAdi(array("id"=>$verecekKasaIdsi));

      $verecekListesi[] = array(
        "verecekId"=>$verecekIdleri[$i]["id"],
        "verecekKodu"=>$verecek->getVerecekKodu(array("id"=>$verecekIdleri[$i]["id"])),
        "verecekCariAdi"=>$verecekCariAdi,
        "verecekTutari"=>$verecek->getVerecekTutari(array("id"=>$verecekIdleri[$i]["id"])),
        "verecekKasaAdi"=>$verecekKasaAdi,
        "verecekAciklamasi"=>$verecek->getVerecekAciklamasi(array("id"=>$verecekIdleri[$i]["id"]))
      );
    }

    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_kasalar");
    $stmt->execute();
    $kasalar = $stmt->fetchAll();
    $model = null;

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    @$this->view->verecekListesi = $verecekListesi;
    $this->view->kasalar = $kasalar;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("merkezler/verecek/verecek-listesi");
  }

  public function verecekekle()
  {
    if (isset($_POST["verecekEkle"])) {
      $veriler = json_decode($_POST["verecekEkle"],true);
      $verecek = new Verecekler();
      $verecek->setVerecekKodu($veriler["txtVerecekKodu"]);
      $verecek->setVerecekCariIdsi($veriler["txtVerecekCariIdsi"]);
      $verecek->setVerecekTutari($veriler["txtVerecekTutari"]);
      $verecek->setVerecekKasaIdsi($veriler["txtVerecekKasaIdsi"]);
      $verecek->setVerecekAciklamasi($veriler["txtVerecekAciklamasi"]);
      $this->values = array(
        $verecek->verecekKodu,
        $verecek->verecekCariIdsi,
        $verecek->verecekTutari,
        $verecek->verecekKasaIdsi,
        $verecek->verecekAciklamasi
      );
      $yanit = $this->dataInsert();
      $verecek = null;
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
      $this->view->render("merkezler/verecek/verecek-ekle");
    }
  }

  public function verecekduzenle($idler = false)
  {
    if (isset($_POST["verecekDuzenle"])) {
      $veriler = json_decode($_POST["verecekDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $verecek = new Verecekler();
        $verecek->setVerecekKodu($veriler[$i]["txtVerecekKodu"]);
        $verecek->setVerecekCariIdsi($veriler[$i]["txtVerecekCariIdsi"]);
        $verecek->setVerecekTutari($veriler[$i]["txtVerecekTutari"]);
        $verecek->setVerecekKasaIdsi($veriler[$i]["txtVerecekKasaIdsi"]);
        $verecek->setVerecekAciklamasi($veriler[$i]["txtVerecekAciklamasi"]);
        $verecek->setVerecekIdsi($veriler[$i]["txtVerecekId"]);
        $this->values = array(
          "verecek_kodu"=>$verecek->verecekKodu,
          "verecek_cari_idsi"=>$verecek->verecekCariIdsi,
          "verecek_tutari"=>$verecek->verecekTutari,
          "verecek_kasa_idsi"=>$verecek->verecekKasaIdsi,
          "verecek_aciklamasi"=>$verecek->verecekAciklamasi,
          "id"=>$verecek->verecekIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $verecek = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {
          $verecek = new Verecekler();
          $musteri = new Musteriler();
          $kasa = new Kasalar();

          $verecekCariIdsi = $verecek->getVerecekCariIdsi(array("id"=>$idler[$i]));
          $verecekKasaIdsi = $verecek->getVerecekKasaIdsi(array("id"=>$idler[$i]));

          $verecekCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$verecekCariIdsi));
          $verecekKasaAdi = $kasa->getKasaAdi(array("id"=>$verecekKasaIdsi));

          $verecekBilgileri[] = array(
            "verecekId"=>$idler[$i],
            "verecekKodu"=>$verecek->getVerecekKodu(array("id"=>$idler[$i])),
            "verecekCariAdi"=>$verecekCariAdi,
            "verecekCariIdsi"=>$verecekCariIdsi,
            "verecekTutari"=>$verecek->getVerecekTutari(array("id"=>$idler[$i])),
            "verecekKasaIdsi"=>$verecek->getVerecekKasaIdsi(array("id"=>$idler[$i])),
            "verecekAciklamasi"=>$verecek->getVerecekAciklamasi(array("id"=>$idler[$i]))
          );
        }
      }
      $verecek = null;

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $this->view->kasalar = $kasalar;
      $this->view->verecekBilgileri = $verecekBilgileri;
      $this->view->render("merkezler/verecek/verecek-duzenle");
    }
  }

  public function verecekSil()
  {
    if (isset($_POST["verecekSil"])) {
      $veriler = json_decode($_POST["verecekSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $verecek = new Verecekler();
        $verecek->setVerecekIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$verecek->verecekIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }

  public function verecekBilgileriniAl()
  {
    if (isset($_POST["verecekBilgileriniAl"])) {
      $verecekIdsi = $_POST["verecekBilgileriniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT tbl_verecekler.*,tbl_musteriler.musteri_adi_soyadi,tbl_kasalar.kasa_adi
      FROM tbl_verecekler INNER JOIN tbl_musteriler ON tbl_verecekler.verecek_cari_idsi=tbl_musteriler.id
      INNER JOIN tbl_kasalar ON tbl_verecekler.verecek_kasa_idsi=tbl_kasalar.id
      WHERE tbl_verecekler.id=:id");
      $stmt->execute(['id'=>$verecekIdsi]);
      $verecekBilgileri = $stmt->fetch();


      echo json_encode(array(
        "verecekBilgileri"=>$verecekBilgileri
      ));
    }
  }

  public function verecekOdemeyeCevir()
  {
    if (isset($_POST["verecekOdemeyeCevir"])) {
      $veriler = json_decode($_POST["verecekOdemeyeCevir"],true);
      $yanit = true;

      $verecek = new Verecekler();
      $verecekTutari = $verecek->getVerecekTutari(array("id"=>$veriler["txtVerecekIdsi"]));

      if ($veriler["txtOdemeTutari"] > $verecekTutari) {
        $yanit = "Verecek tutarından fazla ödeme tutarı giremezsiniz!";
      }


      if ($yanit == "true") {
        $odeme = new Odemeler();
        $odeme->setOdemeKodu($veriler["txtOdemeKodu"]);
        $odeme->setOdemeCariIdsi($veriler["txtOdemeCariIdsi"]);
        $odeme->setOdemeTutari($veriler["txtOdemeTutari"]);
        $odeme->setOdemeKasaIdsi($veriler["txtOdemeKasaIdsi"]);
        $odeme->setOdemeAciklamasi($veriler["txtOdemeAciklamasi"]);
        $this->tabloAdlari = array("tbl_odemeler");
        $this->kolonAdlari = array("odeme_kodu","odeme_cari_idsi","odeme_tutari","odeme_kasa_idsi","odeme_aciklamasi");
        $this->values = array(
          $odeme->odemeKodu,
          $odeme->odemeCariIdsi,
          $odeme->odemeTutari,
          $odeme->odemeKasaIdsi,
          $odeme->odemeAciklamasi
        );
        $yanit = $this->dataInsert();
        if ($yanit["yanit"] == "true") {

          if ($verecekTutari > $veriler["txtOdemeTutari"]) {
            $yeniVerecekTutari = $verecekTutari - $veriler["txtOdemeTutari"];
            $model = new Model();
            $stmt = $model->dbh->prepare(
              "UPDATE tbl_verecekler SET verecek_tutari=:yeni_verecek_tutari WHERE id=:verecek_idsi"
            );
            $yanit = $stmt->execute([
              'yeni_verecek_tutari'=>$yeniVerecekTutari,
              'verecek_idsi'=>$veriler["txtVerecekIdsi"]
            ]);
            $model = null;
          }else {
            $model = new Model();
            $stmt = $model->dbh->prepare(
              "DELETE FROM tbl_verecekler WHERE id=:verecek_idsi"
            );
            $yanit = $stmt->execute([
              'verecek_idsi'=>$veriler["txtVerecekIdsi"]
            ]);
            $model = null;
          }
        }else {
          $yanit = "Ödeme eklenirken bir sorun oluştu!";
        }
      }


      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
}
