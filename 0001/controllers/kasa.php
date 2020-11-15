<?php

/**
 *
 */
class Kasa extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_kasalar");
    $this->kolonAdlari = array("kasa_adi","kasa_acilis_bakiyesi","kasa_birincil_kasa_mi");

    $this->sayfaIzınAdi = "txtKasaEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function kasaProfil($kasaIdsi = false)
  {
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_kasaler WHERE id=:id");
    $stmt->execute(['id'=>$kasaIdsi]);
    $kasa = $stmt->fetch();

    $this->view->kasa = $kasa;
    $this->view->render("birimler/kasa/kasa-profil");
  }

  public function kasalistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $kasa = new Kasalar();
    $toplamVeriSayisi = $kasa->selectQuery($this->tabloAdlari[0],array("id"));
    $kasaIdleri = $kasa->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($kasaIdleri); $i++) {
      $kasaBirincilKasaMi = $kasa->getKasaBirincilKasaMi(array("id"=>$kasaIdleri[$i]["id"]));
      if ($kasaBirincilKasaMi == "1") {
        $kasaBirincilKasaMi = "<span class='badge badge-success'>Birincil</span>";
      }else {
        $kasaBirincilKasaMi = "<span class='badge badge-danger'>İkincil</span>";
      }
      $kasaListesi[] = array(
        "kasaId"=>$kasaIdleri[$i]["id"],
        "kasaAdi"=>$kasa->getKasaAdi(array("id"=>$kasaIdleri[$i]["id"])),
        "kasaAcilisBakiyesi"=>$kasa->getKasaAcilisBakiyesi(array("id"=>$kasaIdleri[$i]["id"])),
        "kasaBirincilKasaMi"=>$kasaBirincilKasaMi
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->kasaListesi = $kasaListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/kasa/kasa-listesi");
  }

  public function kasaekle()
  {
    if (isset($_POST["kasaEkle"])) {
      $veriler = json_decode($_POST["kasaEkle"],true);

      if ($veriler["txtKasaBirincilKasaMi"] == "1") {
        $model = new Model();
        $stmt = $model->dbh->prepare("UPDATE tbl_kasalar SET kasa_birincil_kasa_mi=0");
        $stmt->execute();
        $model = null;
      }

      $kasa = new Kasalar();
      $kasa->setKasaAdi($veriler["txtKasaAdi"]);
      $kasa->setKasaAcilisBakiyesi($veriler["txtKasaAcilisBakiyesi"]);
      $kasa->setKasaBirincilKasaMi($veriler["txtKasaBirincilKasaMi"]);
      $this->values = array(
        $kasa->kasaAdi,
        $kasa->kasaAcilisBakiyesi,
        $kasa->kasaBirincilKasaMi
      );
      $yanit = $this->dataInsert();
      $kasa = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/kasa/kasa-ekle");
    }
  }

  public function kasaduzenle($idler = false)
  {
    if (isset($_POST["kasaDuzenle"])) {
      $veriler = json_decode($_POST["kasaDuzenle"],true);



      for ($i=0; $i < count($veriler); $i++) {

        if ($veriler[$i]["txtKasaBirincilKasaMi"] == "1") {
          $model = new Model();
          $stmt = $model->dbh->prepare("UPDATE tbl_kasalar SET kasa_birincil_kasa_mi=0");
          $stmt->execute();
          $model = null;
        }

        $kasa = new Kasalar();
        $kasa->setKasaIdsi($veriler[$i]["txtKasaIdsi"]);
        $kasa->setKasaAdi($veriler[$i]["txtKasaAdi"]);
        $kasa->setKasaAcilisBakiyesi($veriler[$i]["txtKasaAcilisBakiyesi"]);
        $kasa->setKasaBirincilKasaMi($veriler[$i]["txtKasaBirincilKasaMi"]);

        $this->values = array(
          "kasa_adi"=>$kasa->kasaAdi,
          "kasa_acilis_bakiyesi"=>$kasa->kasaAcilisBakiyesi,
          "kasa_birincil_kasa_mi"=>$kasa->kasaBirincilKasaMi,
          "id"=>$kasa->kasaIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $kasa = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $kasa = new Kasalar();

          $kasaBilgileri[] = array(
            "kasaIdsi"=>$idler[$i],
            "kasaAdi"=>$kasa->getKasaAdi(array("id"=>$idler[$i])),
            "kasaAcilisBakiyesi"=>$kasa->getKasaAcilisBakiyesi(array("id"=>$idler[$i])),
            "kasaBirincilKasaMi"=>$kasa->getKasaBirincilKasaMi(array("id"=>$idler[$i]))
          );
        }
      }
      $kasa = null;
      $this->view->kasaBilgileri = $kasaBilgileri;

      $this->view->render("birimler/kasa/kasa-duzenle");
    }
  }

  public function kasaSil()
  {
    if (isset($_POST["kasaSil"])) {
      $veriler = json_decode($_POST["kasaSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $kasa = new Kasalar();
        $kasa->setKasaIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$kasa->kasaIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
