<?php

/**
 *
 */
class Masa extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_masalar");
    $this->kolonAdlari = array("masa_adi","masa_durumu","masa_lokasyon_idsi","masa_gorselleri");

    $this->sayfaIzınAdi = "txtMasaEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    $this->view->lokasyonTabloAdi = $this->tabloAdlari[0];


    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function masalistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }
    if(isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }
    if (isset($_GET["masaLokasyonIdsi"])) {
      if ($_GET["masaLokasyonIdsi"] == "*") {

      }else {
        $keys[] = "masa_lokasyon_idsi";
        $parameters[] = $_GET["masaLokasyonIdsi"];
      }
      $this->view->filterClass = "";
      $this->view->filtreDegerleri = array($parameters[0]);
    }else {
      $this->view->filterClass = "d-none";
      $this->view->filtreDegerleri = "";
    }





    $masa = new Masalar();
    $lokasyon = new Lokasyonlar();

    $toplamVeriSayisi = $masa->selectQuery("tbl_masalar",array("id"));
    $masaIdleri = $masa->selectLimitQuery("tbl_masalar",array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);

    for ($i=0; $i < count($masaIdleri); $i++) {
      $masaLokasyonIdsi = $masa->getMasaLokasyonIdsi(array("id"=>$masaIdleri[$i]["id"]));
      $masaLokasyonAdi = $lokasyon->getLokasyonAdi(array("id"=>$masaLokasyonIdsi));
      $masaListesi[] = array(
        "masaId"=>$masaIdleri[$i]["id"],
        "masaAdi"=>$masa->getMasaAdi(array("id"=>$masaIdleri[$i]["id"])),
        "masaLokasyonAdi"=>$masaLokasyonAdi
      );

    }
    $masa = null;

    $model = new Model();
    $masaLokasyonIdleri = $model->selectQuery("tbl_lokasyonlar",array("id"));
    $model = null;
    $masaLokasyonBilgileri = array();
    for ($i=0; $i < count($masaLokasyonIdleri); $i++) {
      $lokasyon = new Lokasyonlar();
      $masaLokasyonBilgileri[] = array(
        "lokasyonId"=>$lokasyon->getLokasyonId(array("id"=>$masaLokasyonIdleri[$i]["id"])),
        "lokasyonAdi"=>$lokasyon->getLokasyonAdi(array("id"=>$masaLokasyonIdleri[$i]["id"]))
      );
    }

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->masaLokasyonBilgileri = $masaLokasyonBilgileri;
    $this->view->masaListesi = $masaListesi;
    // $this->view->masaLokasyonListesi = array_values(array_unique($masaLokasyonBilgileri, SORT_REGULAR));
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/masalar/masa-listesi");
    $lokasyon = null;
    $masa = null;
  }

  public function masaekle()
  {
    if (isset($_POST["masaEkle"])) {
      $veriler = json_decode($_POST["masaEkle"],true);

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT COUNT(id) AS masa_adedi FROM tbl_masalar");
      $stmt->execute();
      $masaAdedi = $stmt->fetch()["masa_adedi"];
      $masaAdedi++;

      $izinVerilenMasaAdedi = file_get_contents("/var/barista_pos/masa");
      
      if ($masaAdedi > $izinVerilenMasaAdedi) {
        $yanit = "İzin verilen masa sınırını aştınız. İzin verilen masa adedi: ". $izinVerilenMasaAdedi." Daha fazla masa eklemek istiyorsanız BaristaPOS paketinizi büyütünüz";
        echo json_encode(array(
          "yanit"=>$yanit
        ));
        return false;
      }



      $dosyaAdi = array();
      if (isset($_FILES["dosya"])) {
        for ($i=0; $i < count($_FILES['dosya']['name']); $i++) {
          if(file_exists($_FILES['dosya']['tmp_name'][$i]) || !is_uploaded_file($_FILES['dosya']['tmp_name'][$i])) {
            $dosyaAdi[] = $_FILES["dosya"]["name"][$i];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/masalar/".$dosyaAdi[$i];
            $dosya=$_FILES["dosya"]["tmp_name"][$i];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosyaAdi = "";
          }
        }
      }

      $masa = new Masalar();
      $masa->setMasaAdi($veriler["txtMasaAdi"]);
      $masa->setMasaDurumu(0);
      $masa->setMasaLokasyonIdsi($veriler["txtMasaLokasyonIdsi"]);
      $masa->setMasaGorselleri(json_encode($dosyaAdi));
      $this->values = array(
        $masa->masaAdi,
        $masa->masaDurumu,
        $masa->masaLokasyonIdsi,
        $masa->masaGorselleri
      );
      $yanit = $this->dataInsert();
      $masa = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_lokasyonlar");
      $stmt->execute();
      $lokasyonlar = $stmt->fetchAll();


      $this->view->lokasyonlar = $lokasyonlar;
      $this->view->render("birimler/masalar/masa-ekle");
    }
  }

  public function masaduzenle($idler = false)
  {
    if (isset($_POST["masaDuzenle"])) {
      $veriler = json_decode($_POST["masaDuzenle"],true);

      if (isset($_FILES["dosya"])) {
        for ($i=0; $i < count($_FILES['dosya']['name']); $i++) {
          if(file_exists($_FILES['dosya']['tmp_name'][$i]) || !is_uploaded_file($_FILES['dosya']['tmp_name'][$i])) {
            $dosyaAdi[] = $_FILES["dosya"]["name"][$i];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/masalar/".$dosyaAdi[$i];
            $dosya=$_FILES["dosya"]["tmp_name"][$i];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosya = null;
          }
        }
      }else {
        $dosya = null;
      }

      for ($i=0; $i < count($veriler); $i++) {
        $masa = new Masalar();
        $masa->setMasaAdi($veriler[$i]["txtMasaAdi"]);
        $masa->setMasaId($veriler[$i]["txtMasaId"]);
        $masa->setMasaLokasyonIdsi($veriler[$i]["txtMasaLokasyonIdsi"]);
        if ($dosya != null) {
          $masa->setMasaGorselleri(json_encode($dosyaAdi));
        }else {
          $masaMevcutGorseli=$masa->getMasaGorselleri(array("id"=>$veriler[$i]["txtMasaId"]));
          $masa->setMasaGorselleri($masaMevcutGorseli);
        }
        $this->values = array(
          "masa_adi"=>$masa->masaAdi,
          "masa_lokasyon_idsi"=>$masa->masaLokasyonIdsi,
          "masa_gorselleri"=>$masa->masaGorselleri,
          "id"=>$masa->masaId
        );
        $yanit = $this->dataUpdate();
      }
      $masa = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_lokasyonlar");
      $stmt->execute();
      $lokasyonlar = $stmt->fetchAll();



      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {
          $masa = new Masalar();

          $masaBilgileri[] = array(
            "masaId"=>$idler[$i],
            "masaAdi"=>$masa->getMasaAdi(array("id"=>$idler[$i])),
            "masaLokasyonIdsi"=>$masa->getMasaLokasyonIdsi(array("id"=>$idler[$i]))
          );
        }
      }
      $lokasyon = null;
      $masa = null;

      $this->view->masaBilgileri = $masaBilgileri;
      $this->view->lokasyonlar = $lokasyonlar;

      $this->view->render("birimler/masalar/masa-duzenle");
    }
  }

  public function masaSil()
  {
    if (isset($_POST["masaSil"])) {
      $veriler = json_decode($_POST["masaSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $masa = new Masalar();
        $masa->setMasaId($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$masa->masaId
        );
        $yanit = $this->dataDelete();
      }
      $masa = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
