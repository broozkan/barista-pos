<?php

/**
 *
 */
class Mutfak extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_mutfaklar");
    $this->kolonAdlari = array("mutfak_adi","mutfak_yazici_idsi");

    $this->sayfaIzınAdi = "txtMutfakEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function mutfaklistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $mutfak = new Mutfaklar();
    $toplamVeriSayisi = $mutfak->selectQuery($this->tabloAdlari[0],array("id"));
    $mutfakIdleri = $mutfak->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($mutfakIdleri); $i++) {
      $mutfakListesi[] = array(
        "mutfakId"=>$mutfakIdleri[$i]["id"],
        "mutfakAdi"=>$mutfak->getMutfakAdi(array("id"=>$mutfakIdleri[$i]["id"]))
      );
    }
    $model = new Model();
    $cariMutfaklariIdleri = $model->selectFilterQuery("tbl_mutfaklar",array("id"),array("mutfak_tablo_adi"=>"tbl_sirket_carileri"));
    $model = null;
    $cariMutfakBilgileri = array();
    for ($i=0; $i < count($cariMutfaklariIdleri); $i++) {
      $mutfak = new Mutfaklar();
      $cariMutfakBilgileri[] = array(
        "mutfakId"=>$mutfak->getMutfakId(array("id"=>$cariMutfaklariIdleri[$i]["id"])),
        "mutfakAdi"=>$mutfak->getMutfakAdi(array("id"=>$cariMutfaklariIdleri[$i]["id"]))
      );
    }

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->cariMutfakBilgileri = $cariMutfakBilgileri;
    $this->view->mutfakListesi = $mutfakListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/mutfak/mutfak-listesi");
  }

  public function mutfakekle()
  {
    if (isset($_POST["mutfakEkle"])) {
      $veriler = json_decode($_POST["mutfakEkle"],true);
      $mutfak = new Mutfaklar();
      $mutfak->setMutfakAdi($veriler["txtMutfakAdi"]);
      $mutfak->setMutfakYaziciIdsi($veriler["txtMutfakYaziciIdsi"]);
      $this->values = array(
        $mutfak->mutfakAdi,
        $mutfak->mutfakYaziciIdsi
      );
      $yanit = $this->dataInsert();
      $mutfak = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
      $stmt->execute();
      $yazicilar = $stmt->fetchAll();

      $this->view->yazicilar = $yazicilar;
      $this->view->render("birimler/mutfak/mutfak-ekle");
    }
  }

  public function mutfakduzenle($idler = false)
  {
    if (isset($_POST["mutfakDuzenle"])) {
      $veriler = json_decode($_POST["mutfakDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $mutfak = new Mutfaklar();
        $mutfak->setMutfakAdi($veriler[$i]["txtMutfakAdi"]);
        $mutfak->setMutfakId($veriler[$i]["txtMutfakId"]);
        $mutfak->setMutfakYaziciIdsi($veriler[$i]["txtMutfakYaziciIdsi"]);
        $this->values = array(
          "mutfak_adi"=>$mutfak->mutfakAdi,
          "mutfak_yazici_idsi"=>$mutfak->mutfakYaziciIdsi,
          "id"=>$mutfak->mutfakId
        );
        $yanit = $this->dataUpdate();
      }
      $mutfak = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $mutfak = new Mutfaklar();

          $mutfakBilgileri[] = array(
            "mutfakId"=>$idler[$i],
            "mutfakAdi"=>$mutfak->getMutfakAdi(array("id"=>$idler[$i])),
            "mutfakYaziciIdsi"=>$mutfak->getMutfakYaziciIdsi(array("id"=>$idler[$i]))
          );
        }
      }
      $mutfak = null;

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT * FROM tbl_yazicilar");
      $stmt->execute();
      $yazicilar = $stmt->fetchAll();


      $this->view->yazicilar = $yazicilar;
      $this->view->mutfakBilgileri = $mutfakBilgileri;
      $this->view->render("birimler/mutfak/mutfak-duzenle");
    }
  }

  public function mutfakSil()
  {
    if (isset($_POST["mutfakSil"])) {
      $veriler = json_decode($_POST["mutfakSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $mutfak = new Mutfaklar();
        $mutfak->setMutfakId($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$mutfak->mutfakId
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
