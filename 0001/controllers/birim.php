<?php

/**
 *
 */
class Birim extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_birimler");
    $this->kolonAdlari = array("birim_adi","birim_kisaltmasi");

    $this->sayfaIzınAdi = "txtBirimEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function birimlistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $birim = new Birimler();
    $toplamVeriSayisi = $birim->selectQuery($this->tabloAdlari[0],array("id"));
    $birimIdleri = $birim->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($birimIdleri); $i++) {
      $birimListesi[] = array(
        "birimId"=>$birimIdleri[$i]["id"],
        "birimAdi"=>$birim->getBirimAdi(array("id"=>$birimIdleri[$i]["id"])),
        "birimKisaltmasi"=>$birim->getBirimKisaltmasi(array("id"=>$birimIdleri[$i]["id"]))
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->birimListesi = $birimListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/birim/birim-listesi");
  }

  public function birimekle()
  {
    if (isset($_POST["birimEkle"])) {
      $veriler = json_decode($_POST["birimEkle"],true);
      $birim = new Birimler();
      $birim->setBirimAdi($veriler["txtBirimAdi"]);
      $birim->setBirimKisaltmasi($veriler["txtBirimKisaltmasi"]);
      $this->values = array(
        $birim->birimAdi,
        $birim->birimKisaltmasi
      );
      $yanit = $this->dataInsert();
      $birim = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/birim/birim-ekle");
    }
  }

  public function birimduzenle($idler = false)
  {
    if (isset($_POST["birimDuzenle"])) {
      $veriler = json_decode($_POST["birimDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $birim = new Birimler();
        $birim->setBirimAdi($veriler[$i]["txtBirimAdi"]);
        $birim->setBirimKisaltmasi($veriler[$i]["txtBirimKisaltmasi"]);
        $birim->setBirimIdsi($veriler[$i]["txtBirimIdsi"]);
        $this->values = array(
          "birim_adi"=>$birim->birimAdi,
          "birim_kisaltmasi"=>$birim->birimKisaltmasi,
          "id"=>$birim->birimIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $birim = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $birim = new Birimler();

          $birimBilgileri[] = array(
            "birimIdsi"=>$idler[$i],
            "birimAdi"=>$birim->getBirimAdi(array("id"=>$idler[$i])),
            "birimKisaltmasi"=>$birim->getBirimKisaltmasi(array("id"=>$idler[$i]))
          );
        }
      }
      $birim = null;
      $this->view->birimBilgileri = $birimBilgileri;

      $this->view->render("birimler/birim/birim-duzenle");
    }
  }

  public function birimSil()
  {
    if (isset($_POST["birimSil"])) {
      $veriler = json_decode($_POST["birimSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $birim = new Birimler();
        $birim->setBirimIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$birim->birimIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
