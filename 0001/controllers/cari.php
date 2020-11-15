<?php

/**
 *
 */
class Cari extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_sirket_carileri");
    $this->kolonAdlari = array("cari_adi","cari_eposta_adresi","cari_telefon_numarasi","cari_adresi","cari_kategorisi");

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      // parent::$tabloAdi = "tbl_sirket_carileri";
      // parent::$kolonAdi = "cari_adi";
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function carilistesi()
  {
    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }

    $cari = new Cariler();
    $toplamVeriSayisi = $cari->selectQuery("tbl_sirket_carileri",array("id"));
    $cariIdleri = $cari->selectLimitQuery("tbl_sirket_carileri",array("id"),array("limit"=>$this->limit,"offset"=>$this->offset));
    for ($i=0; $i < count($cariIdleri); $i++) {
      $cariListesi[] = array(
        "cariId"=>$cariIdleri[$i]["id"],
        "cariAdi"=>$cari->getCariAdi(array("id"=>$cariIdleri[$i]["id"]))
      );
    }
    $this->view->cariListesi = $cariListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/cariler/cari-listesi");
  }

  public function cariekle()
  {
    if (isset($_POST["cariEkle"])) {
      $veriler = json_decode($_POST["cariEkle"],true);
      $cari = new Cariler();
      $cari->setCariAdi($veriler["txtCariAdi"]);
      $cari->setCariEpostaAdresi($veriler["txtCariEpostaAdresi"]);
      $cari->setCariTelefonNumarasi($veriler["txtCariTelefonNumarasi"]);
      $cari->setCariAdresi($veriler["txtCariAdresi"]);
      $cari->setCariKategorisi($veriler["txtCariKategorisi"]);
      $this->values = array(
        $cari->cariAdi,
        $cari->cariEpostaAdresi,
        $cari->cariTelefonNumarasi,
        $cari->cariAdresi,
        $cari->cariKategorisi
      );
      $yanit = $this->dataInsert();
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $this->view->render("birimler/cariler/cari-ekle");
    }
    //If ajax datas comes, run this codes (For less function).
    // if (isset($_POST["cariEkle"])) {
    //   $veriler = json_decode($_POST["cariEkle"],true);
    //   $cari = new Cariler();
    //   $cari->setCariAdi($veriler["txtCariAdi"]);
    //   $yanit = $cari->insertQuery("tbl_sirket_carileri",array("cari_adi"),array($cari->cariAdi));
    //   $cari = null;
    //   echo json_encode(array(
    //     "yanit"=>$yanit
    //   ));
    // }else {
      // $this->view->render("birimler/cariler/cari-ekle");
    // }
  }

  public function cariduzenle($idler = false)
  {


    if (isset($_POST["cariDuzenle"])) {
      $veriler = json_decode($_POST["cariDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $cari = new Cariler();
        $cari->setCariAdi($veriler[$i]["txtCariAdi"]);
        $cari->setCariId($veriler[$i]["txtCariId"]);
        $this->values = array(
          "cari_adi"=>$cari->cariAdi,
          "id"=>$cari->cariId
        );
        $yanit = $this->dataUpdate();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {
          $cari = new Cariler();
          $cariBilgileri[] = array(
            "cariId"=>$idler[$i],
            "cariAdi"=>$cari->getCariAdi(array("id"=>$idler[$i]))
          );
        }
      }
      $this->view->cariBilgileri = $cariBilgileri;

      $this->view->render("birimler/cariler/cari-duzenle");
    }
  }

  public function cariSil()
  {
    if (isset($_POST["cariSil"])) {
      $veriler = json_decode($_POST["cariSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $cari = new Cariler();
        $cari->setCariId($veriler[$i]["cariId"]);
        $this->values = array(
          "id"=>$cari->cariId
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
