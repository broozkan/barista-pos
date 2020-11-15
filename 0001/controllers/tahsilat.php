<?php

/**
 *
 */
class Tahsilat extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_tahsilatlar");
    $this->kolonAdlari = array("tahsilat_kodu","tahsilat_cari_idsi","tahsilat_tutari","tahsilat_kasa_idsi","tahsilat_aciklamasi");

    $this->sayfaIzınAdi = "txtMuhasebeMerkezineGirebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function tahsilatlistesi()
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

    $tahsilat = new Tahsilatlar();
    $musteri = new Musteriler();
    $kasa = new Kasalar();
    $toplamVeriSayisi = $tahsilat->selectQuery($this->tabloAdlari[0],array("id"));
    $tahsilatIdleri = $tahsilat->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);


    for ($i=0; $i < count($tahsilatIdleri); $i++) {
      $tahsilatCariIdsi = $tahsilat->getTahsilatCariIdsi(array("id"=>$tahsilatIdleri[$i]["id"]));
      $tahsilatKasaIdsi = $tahsilat->getTahsilatKasaIdsi(array("id"=>$tahsilatIdleri[$i]["id"]));

      $tahsilatCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$tahsilatCariIdsi));
      $tahsilatKasaAdi = $kasa->getKasaAdi(array("id"=>$tahsilatKasaIdsi));

      $tahsilatTarihi = explode(" ",$tahsilat->getTahsilatTarihi(array("id"=>$tahsilatIdleri[$i]["id"])));
      $tahsilatTarihi = $this->fixDate($tahsilatTarihi[0]);

      $tahsilatListesi[] = array(
        "tahsilatId"=>$tahsilatIdleri[$i]["id"],
        "tahsilatKodu"=>$tahsilat->getTahsilatKodu(array("id"=>$tahsilatIdleri[$i]["id"])),
        "tahsilatTarihi"=>$tahsilatTarihi,
        "tahsilatCariAdi"=>$tahsilatCariAdi,
        "tahsilatTutari"=>$tahsilat->getTahsilatTutari(array("id"=>$tahsilatIdleri[$i]["id"])),
        "tahsilatKasaAdi"=>$tahsilatKasaAdi,
        "tahsilatAciklamasi"=>$tahsilat->getTahsilatAciklamasi(array("id"=>$tahsilatIdleri[$i]["id"]))
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->tahsilatListesi = @$tahsilatListesi;
    $this->view->kurIsareti = $kurIsareti;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("merkezler/tahsilat/tahsilat-listesi");
  }

  public function tahsilatekle()
  {
    if (isset($_POST["tahsilatEkle"])) {
      $veriler = json_decode($_POST["tahsilatEkle"],true);
      $tahsilat = new Tahsilatlar();
      $tahsilat->setTahsilatKodu($veriler["txtTahsilatKodu"]);
      $tahsilat->setTahsilatCariIdsi($veriler["txtTahsilatCariIdsi"]);
      $tahsilat->setTahsilatTutari($veriler["txtTahsilatTutari"]);
      $tahsilat->setTahsilatKasaIdsi($veriler["txtTahsilatKasaIdsi"]);
      $tahsilat->setTahsilatAciklamasi($veriler["txtTahsilatAciklamasi"]);
      $this->values = array(
        $tahsilat->tahsilatKodu,
        $tahsilat->tahsilatCariIdsi,
        $tahsilat->tahsilatTutari,
        $tahsilat->tahsilatKasaIdsi,
        $tahsilat->tahsilatAciklamasi
      );
      $yanit = $this->dataInsert();
      $tahsilat = null;
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
      $this->view->render("merkezler/tahsilat/tahsilat-ekle");
    }
  }

  public function tahsilatduzenle($idler = false)
  {
    if (isset($_POST["tahsilatDuzenle"])) {
      $veriler = json_decode($_POST["tahsilatDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $tahsilat = new Tahsilatlar();
        $tahsilat->setTahsilatKodu($veriler[$i]["txtTahsilatKodu"]);
        $tahsilat->setTahsilatCariIdsi($veriler[$i]["txtTahsilatCariIdsi"]);
        $tahsilat->setTahsilatTutari($veriler[$i]["txtTahsilatTutari"]);
        $tahsilat->setTahsilatKasaIdsi($veriler[$i]["txtTahsilatKasaIdsi"]);
        $tahsilat->setTahsilatAciklamasi($veriler[$i]["txtTahsilatAciklamasi"]);
        $tahsilat->setTahsilatIdsi($veriler[$i]["txtTahsilatId"]);
        $this->values = array(
          "tahsilat_kodu"=>$tahsilat->tahsilatKodu,
          "tahsilat_cari_idsi"=>$tahsilat->tahsilatCariIdsi,
          "tahsilat_tutari"=>$tahsilat->tahsilatTutari,
          "tahsilat_kasa_idsi"=>$tahsilat->tahsilatKasaIdsi,
          "tahsilat_aciklamasi"=>$tahsilat->tahsilatAciklamasi,
          "id"=>$tahsilat->tahsilatIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $tahsilat = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {
          $tahsilat = new Tahsilatlar();
          $musteri = new Musteriler();
          $kasa = new Kasalar();

          $tahsilatCariIdsi = $tahsilat->getTahsilatCariIdsi(array("id"=>$idler[$i]));
          $tahsilatKasaIdsi = $tahsilat->getTahsilatKasaIdsi(array("id"=>$idler[$i]));

          $tahsilatCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$tahsilatCariIdsi));
          $tahsilatKasaAdi = $kasa->getKasaAdi(array("id"=>$tahsilatKasaIdsi));

          $tahsilatBilgileri[] = array(
            "tahsilatId"=>$idler[$i],
            "tahsilatKodu"=>$tahsilat->getTahsilatKodu(array("id"=>$idler[$i])),
            "tahsilatCariAdi"=>$tahsilatCariAdi,
            "tahsilatCariIdsi"=>$tahsilatCariIdsi,
            "tahsilatTutari"=>$tahsilat->getTahsilatTutari(array("id"=>$idler[$i])),
            "tahsilatKasaIdsi"=>$tahsilat->getTahsilatKasaIdsi(array("id"=>$idler[$i])),
            "tahsilatAciklamasi"=>$tahsilat->getTahsilatAciklamasi(array("id"=>$idler[$i]))
          );
        }
      }
      $tahsilat = null;

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $this->view->kasalar = $kasalar;
      $this->view->tahsilatBilgileri = $tahsilatBilgileri;
      $this->view->render("merkezler/tahsilat/tahsilat-duzenle");
    }
  }

  public function tahsilatSil()
  {
    if (isset($_POST["tahsilatSil"])) {
      $veriler = json_decode($_POST["tahsilatSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $tahsilat = new Tahsilatlar();
        $tahsilat->setTahsilatIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$tahsilat->tahsilatIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
