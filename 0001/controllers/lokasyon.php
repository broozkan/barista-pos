<?php

/**
 *
 */
class Lokasyon extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_lokasyonlar");
    $this->kolonAdlari = array("lokasyon_adi","lokasyon_kati","lokasyon_krokisi");

    $this->sayfaIzınAdi = "txtLokasyonEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  /*LOKASYON KROKİSİ OLUŞTURMA KODLARI*/
  public function lokasyonKrokisiOlustur()
  {
    if (isset($_POST["lokasyonKrokisiOlustur"])) {
      // code...
    }else {
      $this->view->render("birimler/lokasyon/lokasyon-krokisi-olustur");

    }
  }
  /*LOKASYON KROKİSİ OLUŞTURMA KODLARI*/


  public function lokasyonlistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }

    if (isset($_GET["lokasyonKati"])) {
      if ($_GET["lokasyonKati"] == "*") {

      }else {
        $keys[] = "lokasyon_kati";
        $parameters[] = $_GET["lokasyonKati"];
      }
      $this->view->filterClass = "";
      $this->view->filtreDegerleri = array($parameters[0]);
    }else {
      $this->view->filterClass = "d-none";
      $this->view->filtreDegerleri = "";
    }

    $lokasyon = new Lokasyonlar();
    $toplamVeriSayisi = $lokasyon->selectQuery($this->tabloAdlari[0],array("id"));
    $lokasyonIdleri = $lokasyon->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($lokasyonIdleri); $i++) {
      $lokasyonListesi[] = array(
        "lokasyonId"=>$lokasyonIdleri[$i]["id"],
        "lokasyonAdi"=>$lokasyon->getLokasyonAdi(array("id"=>$lokasyonIdleri[$i]["id"])),
        "lokasyonKati"=>$lokasyon->getLokasyonKati(array("id"=>$lokasyonIdleri[$i]["id"]))
      );
    }
    $model = new Model();
    $cariLokasyonlariIdleri = $model->selectFilterQuery("tbl_lokasyonlar",array("id"),array("lokasyon_kati"=>"tbl_sirket_carileri"));
    $model = null;
    $cariLokasyonBilgileri = array();
    for ($i=0; $i < count($cariLokasyonlariIdleri); $i++) {
      $lokasyon = new Lokasyonlar();
      $cariLokasyonBilgileri[] = array(
        "lokasyonId"=>$lokasyon->getLokasyonId(array("id"=>$cariLokasyonlariIdleri[$i]["id"])),
        "lokasyonAdi"=>$lokasyon->getLokasyonAdi(array("id"=>$cariLokasyonlariIdleri[$i]["id"]))
      );
    }

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->lokasyonTabloAdlari = array_values(array_unique($lokasyonListesi, SORT_REGULAR));
    $this->view->cariLokasyonBilgileri = $cariLokasyonBilgileri;
    $this->view->lokasyonListesi = $lokasyonListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/lokasyon/lokasyon-listesi");
  }

  public function lokasyonekle()
  {
    if (isset($_POST["lokasyonEkle"])) {
      $veriler = json_decode($_POST["lokasyonEkle"],true);

      $dosyaAdi = array();
      if (isset($_FILES["dosya"])) {
          if(file_exists($_FILES['dosya']['tmp_name']) || !is_uploaded_file($_FILES['dosya']['tmp_name'])) {
            $dosyaAdi = $_FILES["dosya"]["name"];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/lokasyonlar/".$dosyaAdi;
            $dosya=$_FILES["dosya"]["tmp_name"];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
              $dosyaAdi = "";
            }
          }else {
            $dosyaAdi = "";
          }

      }else {
        $dosyaAdi = "";
      }

      $lokasyon = new Lokasyonlar();
      $lokasyon->setLokasyonAdi($veriler["txtLokasyonAdi"]);
      $lokasyon->setLokasyonKati($veriler["txtLokasyonKati"]);
      $lokasyon->setLokasyonKrokisi(json_encode($dosyaAdi));
      $this->values = array(
        $lokasyon->lokasyonAdi,
        $lokasyon->lokasyonKati,
        $lokasyon->lokasyonKrokisi
      );
      $yanit = $this->dataInsert();
      $lokasyon = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/lokasyon/lokasyon-ekle");
    }
  }

  public function lokasyonduzenle($idler = false)
  {
    if (isset($_POST["lokasyonDuzenle"])) {
      $veriler = json_decode($_POST["lokasyonDuzenle"],true);

      if (isset($_FILES["dosya"])) {
          if(file_exists($_FILES['dosya']['tmp_name']) || !is_uploaded_file($_FILES['dosya']['tmp_name'])) {
            $dosyaAdi = $_FILES["dosya"]["name"];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/lokasyonlar/".$dosyaAdi;
            $dosya=$_FILES["dosya"]["tmp_name"];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosya = null;
          }

      }else {
        $dosya = null;
      }

      for ($i=0; $i < count($veriler); $i++) {
        $lokasyon = new Lokasyonlar();
        $lokasyon->setLokasyonAdi($veriler[$i]["txtLokasyonAdi"]);
        $lokasyon->setLokasyonKati($veriler[$i]["txtLokasyonKati"]);
        if ($dosya != null) {
          $lokasyon->setLokasyonKrokisi($dosyaAdi);
        }else {
          $lokasyonMevcutGorseli=$lokasyon->getLokasyonKrokisi(array("id"=>$veriler[$i]["txtLokasyonId"]));
          $lokasyon->setLokasyonKrokisi($lokasyonMevcutGorseli);
        }
        $lokasyon->setLokasyonId($veriler[$i]["txtLokasyonId"]);
        $this->values = array(
          "lokasyon_adi"=>$lokasyon->lokasyonAdi,
          "lokasyon_kati"=>$lokasyon->lokasyonKati,
          "lokasyon_krokisi"=>$lokasyon->lokasyonKrokisi,
          "id"=>$lokasyon->lokasyonId
        );
        $yanit = $this->dataUpdate();
      }
      $lokasyon = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $lokasyon = new Lokasyonlar();

          $lokasyonBilgileri[] = array(
            "lokasyonId"=>$idler[$i],
            "lokasyonAdi"=>$lokasyon->getLokasyonAdi(array("id"=>$idler[$i])),
            "lokasyonKati"=>$lokasyon->getLokasyonKati(array("id"=>$idler[$i]))
          );
        }
      }
      $lokasyon = null;
      // $model = new Model();
      // $lokasyonTabloIdleri = $model->selectFilterQuery("tbl_lokasyonlar",array("id"),array("lokasyon_kati"=>$this->tabloAdlari[0]));
      // $model = null;
      // $lokasyonBilgileri = array();
      // for ($i=0; $i < count($lokasyonTabloIdleri); $i++) {
      //   $lokasyon = new Lokasyonlar();
      //   $lokasyonBilgileri[] = array(
      //     "lokasyonId"=>$lokasyon->getLokasyonId(array("id"=>$lokasyonTabloIdleri[$i]["id"])),
      //     "lokasyonAdi"=>$lokasyon->getLokasyonAdi(array("id"=>$lokasyonTabloIdleri[$i]["id"]))
      //   );
      // }
      // print_r($lokasyonBilgileri);
      $this->view->lokasyonBilgileri = $lokasyonBilgileri;

      $this->view->render("birimler/lokasyon/lokasyon-duzenle");
    }
  }

  public function lokasyonSil()
  {
    if (isset($_POST["lokasyonSil"])) {
      $veriler = json_decode($_POST["lokasyonSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $lokasyon = new Lokasyonlar();
        $lokasyon->setLokasyonId($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$lokasyon->lokasyonId
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
