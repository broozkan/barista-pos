<?php

/**
 *
 */
class Depo extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_depolar");
    $this->kolonAdlari = array("depo_adi","depo_adresi","depo_telefon_numarasi");

    $this->sayfaIzınAdi = "txtDepoEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function depolistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $depo = new Depolar();
    $toplamVeriSayisi = $depo->selectQuery($this->tabloAdlari[0],array("id"));
    $depoIdleri = $depo->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($depoIdleri); $i++) {


      $depoListesi[] = array(
        "depoId"=>$depoIdleri[$i]["id"],
        "depoAdi"=>$depo->getDepoAdi(array("id"=>$depoIdleri[$i]["id"])),
        "depoAdresi"=>$depo->getDepoAdresi(array("id"=>$depoIdleri[$i]["id"])),
        "depoTelefonNumarasi"=>$depo->getDepoTelefonNumarasi(array("id"=>$depoIdleri[$i]["id"])),
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->depoListesi = $depoListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/depo/depo-listesi");
  }

  public function depoekle()
  {
    if (isset($_POST["depoEkle"])) {
      $veriler = json_decode($_POST["depoEkle"],true);


      $depo = new Depolar();
      $depo->setDepoAdi($veriler["txtDepoAdi"]);
      $depo->setDepoAdresi($veriler["txtDepoAdresi"]);
      $depo->setDepoTelefonNumarasi($veriler["txtDepoTelefonNumarasi"]);
      $this->values = array(
        $depo->depoAdi,
        $depo->depoAdresi,
        $depo->depoTelefonNumarasi
      );
      $yanit = $this->dataInsert();
      $depo = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/depo/depo-ekle");
    }
  }

  public function depoduzenle($idler = false)
  {
    if (isset($_POST["depoDuzenle"])) {
      $veriler = json_decode($_POST["depoDuzenle"],true);



      for ($i=0; $i < count($veriler); $i++) {

        $depo = new Depolar();
        $depo->setDepoIdsi($veriler[$i]["txtDepoIdsi"]);
        $depo->setDepoAdi($veriler[$i]["txtDepoAdi"]);
        $depo->setDepoAdresi($veriler[$i]["txtDepoAdresi"]);
        $depo->setDepoTelefonNumarasi($veriler[$i]["txtDepoTelefonNumarasi"]);
        $this->values = array(
          "depo_adi"=>$depo->depoAdi,
          "depo_adresi"=>$depo->depoAdresi,
          "depo_telefon_numarasi"=>$depo->depoTelefonNumarasi,
          "id"=>$depo->depoIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $depo = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $depo = new Depolar();

          $depoBilgileri[] = array(
            "depoId"=>$idler[$i],
            "depoAdi"=>$depo->getDepoAdi(array("id"=>$idler[$i])),
            "depoAdresi"=>$depo->getDepoAdresi(array("id"=>$idler[$i])),
            "depoTelefonNumarasi"=>$depo->getDepoTelefonNumarasi(array("id"=>$idler[$i]))
          );
        }
      }
      $depo = null;

      $this->view->depoBilgileri = $depoBilgileri;
      $this->view->render("birimler/depo/depo-duzenle");
    }
  }

  public function depoSil()
  {
    if (isset($_POST["depoSil"])) {
      $veriler = json_decode($_POST["depoSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $depo = new Depolar();
        $depo->setDepoIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$depo->depoIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
