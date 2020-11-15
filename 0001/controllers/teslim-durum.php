<?php

/**
 *
 */
class TeslimDurum extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_teslim_durumlari");
    $this->kolonAdlari = array("teslim_durumu_adi","teslim_durumu_rengi");

    $this->sayfaIzınAdi = "txtTeslimDurumuEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function teslimDurumulistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $teslimDurum = new TeslimDurumlari();
    $toplamVeriSayisi = $teslimDurum->selectQuery($this->tabloAdlari[0],array("id"));
    $teslimDurumIdleri = $teslimDurum->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($teslimDurumIdleri); $i++) {



      $teslimDurumuListesi[] = array(
        "teslimDurumuId"=>$teslimDurumIdleri[$i]["id"],
        "teslimDurumuAdi"=>$teslimDurum->getTeslimDurumuAdi(array("id"=>$teslimDurumIdleri[$i]["id"])),
        "teslimDurumuRengi"=>$teslimDurum->getTeslimDurumuRengi(array("id"=>$teslimDurumIdleri[$i]["id"]))
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->teslimDurumuListesi = $teslimDurumuListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/teslimDurum/teslim-durumu-listesi");
  }

  public function teslimDurumuekle()
  {
    if (isset($_POST["teslimDurumuEkle"])) {
      $veriler = json_decode($_POST["teslimDurumuEkle"],true);

      $teslimDurum = new TeslimDurumlari();
      $teslimDurum->setTeslimDurumuAdi($veriler["txtTeslimDurumuAdi"]);
      $teslimDurum->setTeslimDurumuRengi($veriler["txtTeslimDurumuRengi"]);
      $this->values = array(
        $teslimDurum->teslimDurumuAdi,
        $teslimDurum->teslimDurumuRengi
      );
      $yanit = $this->dataInsert();
      $teslimDurum = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/teslimDurum/teslim-durumu-ekle");
    }
  }

  public function teslimDurumuDuzenle($idler = false)
  {
    if (isset($_POST["teslimDurumuDuzenle"])) {
      $veriler = json_decode($_POST["teslimDurumuDuzenle"],true);



      for ($i=0; $i < count($veriler); $i++) {


        $teslimDurum = new TeslimDurumlari();
        $teslimDurum->setTeslimDurumuIdsi($veriler[$i]["txtTeslimDurumuIdsi"]);
        $teslimDurum->setTeslimDurumuAdi($veriler[$i]["txtTeslimDurumuAdi"]);
        $teslimDurum->setTeslimDurumuRengi($veriler[$i]["txtTeslimDurumuRengi"]);
        $this->values = array(
          "teslim_durumu_adi"=>$teslimDurum->teslimDurumuAdi,
          "teslim_durumu_rengi"=>$teslimDurum->teslimDurumuRengi,
          "id"=>$teslimDurum->teslimDurumuIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $teslimDurum = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $teslimDurum = new TeslimDurumlari();

          $teslimDurumuBilgileri[] = array(
            "teslimDurumuId"=>$idler[$i],
            "teslimDurumuAdi"=>$teslimDurum->getTeslimDurumuAdi(array("id"=>$idler[$i])),
            "teslimDurumuRengi"=>$teslimDurum->getTeslimDurumuRengi(array("id"=>$idler[$i]))
          );
        }
      }
      $teslimDurum = null;
      $this->view->teslimDurumuBilgileri = $teslimDurumuBilgileri;

      $this->view->render("birimler/teslimDurum/teslim-durumu-duzenle");
    }
  }

  public function teslimDurumuSil()
  {
    if (isset($_POST["teslimDurumuSil"])) {
      $veriler = json_decode($_POST["teslimDurumuSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $teslimDurum = new TeslimDurumlari();
        $teslimDurum->setTeslimDurumuIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$teslimDurum->teslimDurumuIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
