<?php

/**
 *
 */
class OdemeMetod extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_odeme_metodlari");
    $this->kolonAdlari = array("odeme_metod_okc_idsi","odeme_metod_adi","odeme_metod_siralamasi","odeme_metod_aktif_mi");

    $this->sayfaIzınAdi = "txtOdemeMetoduEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function odemeMetodlistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $odemeMetod = new OdemeMetodlari();
    $toplamVeriSayisi = $odemeMetod->selectQuery($this->tabloAdlari[0],array("id"));
    $odemeMetodIdleri = $odemeMetod->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($odemeMetodIdleri); $i++) {

      $odemeMetodAktifMi = $odemeMetod->getOdemeMetodAktifMi(array("id"=>$odemeMetodIdleri[$i]["id"]));
      if ($odemeMetodAktifMi) {
        $odemeMetodAktifMi = "<span class='badge badge-success'>Aktif</span>";
      }else {
        $odemeMetodAktifMi = "<span class='badge badge-danger'>Pasif</span>";
      }

      $odemeMetodListesi[] = array(
        "odemeMetodId"=>$odemeMetodIdleri[$i]["id"],
        "odemeMetodAdi"=>$odemeMetod->getOdemeMetodAdi(array("id"=>$odemeMetodIdleri[$i]["id"])),
        "odemeMetodSiralamasi"=>$odemeMetod->getOdemeMetodSiralamasi(array("id"=>$odemeMetodIdleri[$i]["id"])),
        "odemeMetodAktifMi"=>$odemeMetodAktifMi
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->odemeMetodListesi = $odemeMetodListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/odemeMetod/odeme-metod-listesi");
  }

  public function odemeMetodekle()
  {
    if (isset($_POST["odemeMetodEkle"])) {
      $veriler = json_decode($_POST["odemeMetodEkle"],true);

      $odemeMetod = new OdemeMetodlari();
      if ($veriler["txtOdemeMetodOkcIdsi"]) {
        $odemeMetod->setOdemeMetodOkcIdsi($veriler["txtOdemeMetodOkcIdsi"]);
      }else {
        $odemeMetod->setOdemeMetodOkcIdsi(null);
      }
      $odemeMetod->setOdemeMetodAdi($veriler["txtOdemeMetodAdi"]);
      $odemeMetod->setOdemeMetodSiralamasi($veriler["txtOdemeMetodSiralamasi"]);
      $odemeMetod->setOdemeMetodAktifMi($veriler["txtOdemeMetodAktifMi"]);
      $this->values = array(
        $odemeMetod->odemeMetodOkcIdsi,
        $odemeMetod->odemeMetodAdi,
        $odemeMetod->odemeMetodSiralamasi,
        $odemeMetod->odemeMetodAktifMi
      );
      $yanit = $this->dataInsert();
      $odemeMetod = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $this->view->render("birimler/odemeMetod/odeme-metod-ekle");
    }
  }

  public function odemeMetodduzenle($idler = false)
  {
    if (isset($_POST["odemeMetodDuzenle"])) {
      $veriler = json_decode($_POST["odemeMetodDuzenle"],true);



      for ($i=0; $i < count($veriler); $i++) {


        $odemeMetod = new OdemeMetodlari();
        if ($veriler[$i]["txtOdemeMetodOkcIdsi"]) {
          $odemeMetod->setOdemeMetodOkcIdsi($veriler[$i]["txtOdemeMetodOkcIdsi"]);
        }else {
          $odemeMetod->setOdemeMetodOkcIdsi(null);
        }
        $odemeMetod->setOdemeMetodIdsi($veriler[$i]["txtOdemeMetodIdsi"]);
        $odemeMetod->setOdemeMetodAdi($veriler[$i]["txtOdemeMetodAdi"]);
        $odemeMetod->setOdemeMetodSiralamasi($veriler[$i]["txtOdemeMetodSiralamasi"]);
        $odemeMetod->setOdemeMetodAktifMi($veriler[$i]["txtOdemeMetodAktifMi"]);
        $this->values = array(
          "odeme_metod_okc_idsi"=>$odemeMetod->odemeMetodOkcIdsi,
          "odeme_metod_adi"=>$odemeMetod->odemeMetodAdi,
          "odeme_metod_siralamasi"=>$odemeMetod->odemeMetodSiralamasi,
          "odeme_metod_aktif_mi"=>$odemeMetod->odemeMetodAktifMi,
          "id"=>$odemeMetod->odemeMetodIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $odemeMetod = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $odemeMetod = new OdemeMetodlari();

          $odemeMetodBilgileri[] = array(
            "odemeMetodId"=>$idler[$i],
            "odemeMetodOkcIdsi"=>$odemeMetod->getOdemeMetodOkcIdsi(array("id"=>$idler[$i])),
            "odemeMetodAdi"=>$odemeMetod->getOdemeMetodAdi(array("id"=>$idler[$i])),
            "odemeMetodSiralamasi"=>$odemeMetod->getOdemeMetodSiralamasi(array("id"=>$idler[$i])),
            "odemeMetodAktifMi"=>$odemeMetod->getOdemeMetodAktifMi(array("id"=>$idler[$i]))
          );
        }
      }
      $odemeMetod = null;
      $this->view->odemeMetodBilgileri = $odemeMetodBilgileri;

      $this->view->render("birimler/odemeMetod/odeme-metod-duzenle");
    }
  }

  public function odemeMetodSil()
  {
    if (isset($_POST["odemeMetodSil"])) {
      $veriler = json_decode($_POST["odemeMetodSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $odemeMetod = new OdemeMetodlari();
        $odemeMetod->setOdemeMetodIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$odemeMetod->odemeMetodIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
