<?php

/**
 *
 */
class Vergi extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_vergiler");
    $this->kolonAdlari = array("vergi_adi","vergi_yuzdesi");

    $this->sayfaIzınAdi = "txtVergiEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function vergilistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $vergi = new Vergiler();
    $toplamVeriSayisi = $vergi->selectQuery($this->tabloAdlari[0],array("id"));
    $vergiIdleri = $vergi->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($vergiIdleri); $i++) {
      $vergiListesi[] = array(
        "vergiId"=>$vergiIdleri[$i]["id"],
        "vergiAdi"=>$vergi->getVergiAdi(array("id"=>$vergiIdleri[$i]["id"])),
        "vergiYuzdesi"=>$vergi->getVergiYuzdesi(array("id"=>$vergiIdleri[$i]["id"]))
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->vergiListesi = $vergiListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/vergi/vergi-listesi");
  }

  public function vergiekle()
  {
    if (isset($_POST["vergiEkle"])) {
      $veriler = json_decode($_POST["vergiEkle"],true);
      $vergi = new Vergiler();
      $vergi->setVergiAdi($veriler["txtVergiAdi"]);
      $vergi->setVergiYuzdesi($veriler["txtVergiYuzdesi"]);
      $this->values = array(
        $vergi->vergiAdi,
        $vergi->vergiYuzdesi
      );
      $yanit = $this->dataInsert();
      $vergi = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/vergi/vergi-ekle");
    }
  }

  public function vergiduzenle($idler = false)
  {
    if (isset($_POST["vergiDuzenle"])) {
      $veriler = json_decode($_POST["vergiDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $vergi = new Vergiler();
        $vergi->setVergiAdi($veriler[$i]["txtVergiAdi"]);
        $vergi->setVergiYuzdesi($veriler[$i]["txtVergiYuzdesi"]);
        $vergi->setVergiIdsi($veriler[$i]["txtVergiId"]);
        $this->values = array(
          "vergi_adi"=>$vergi->vergiAdi,
          "vergi_yuzdesi"=>$vergi->vergiYuzdesi,
          "id"=>$vergi->vergiIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $vergi = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $vergi = new Vergiler();

          $vergiBilgileri[] = array(
            "vergiId"=>$idler[$i],
            "vergiAdi"=>$vergi->getVergiAdi(array("id"=>$idler[$i])),
            "vergiYuzdesi"=>$vergi->getVergiYuzdesi(array("id"=>$idler[$i]))
          );
        }
      }
      $vergi = null;
      $this->view->vergiBilgileri = $vergiBilgileri;

      $this->view->render("birimler/vergi/vergi-duzenle");
    }
  }

  public function vergiSil()
  {
    if (isset($_POST["vergiSil"])) {
      $veriler = json_decode($_POST["vergiSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $vergi = new Vergiler();
        $vergi->setVergiIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$vergi->vergiIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
