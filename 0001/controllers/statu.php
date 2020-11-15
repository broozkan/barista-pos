<?php

/**
 *
 */
class Statu extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_statuler");
    $this->kolonAdlari = array("statu_adi","statu_yetkileri");
    $this->sayfaIzınAdi = "txtStatuEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function statulistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $statu = new Statuler();
    $toplamVeriSayisi = $statu->selectQuery($this->tabloAdlari[0],array("id"));
    $statuIdleri = $statu->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($statuIdleri); $i++) {
      $statuListesi[] = array(
        "statuId"=>$statuIdleri[$i]["id"],
        "statuAdi"=>$statu->getStatuAdi(array("id"=>$statuIdleri[$i]["id"]))
      );
    }
    $model = new Model();
    $cariStatuleriIdleri = $model->selectFilterQuery("tbl_statuler",array("id"),array("statu_tablo_adi"=>"tbl_sirket_carileri"));
    $model = null;
    $cariStatuBilgileri = array();
    for ($i=0; $i < count($cariStatuleriIdleri); $i++) {
      $statu = new Statuler();
      $cariStatuBilgileri[] = array(
        "statuId"=>$statu->getStatuId(array("id"=>$cariStatuleriIdleri[$i]["id"])),
        "statuAdi"=>$statu->getStatuAdi(array("id"=>$cariStatuleriIdleri[$i]["id"]))
      );
    }

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->cariStatuBilgileri = $cariStatuBilgileri;
    $this->view->statuListesi = $statuListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/statu/statu-listesi");
  }

  public function statuekle()
  {
    if (isset($_POST["statuEkle"])) {
      $veriler = json_decode($_POST["statuEkle"],true);

      $statuYetkileri = array();

      for ($i=0; $i < count($veriler["txtStatuYetkiAdlari"]); $i++) {
        $statuYetkileri[] = array(
          $veriler["txtStatuYetkiAdlari"][$i]=>$veriler["txtStatuYetkiDegerleri"][$i]
        );
      }

      $statu = new Statuler();
      $statu->setStatuAdi($veriler["txtStatuAdi"]);
      $statu->setStatuYetkileri(json_encode($statuYetkileri));
      $this->values = array(
        $statu->statuAdi,
        $statu->statuYetkileri
      );
      $yanit = $this->dataInsert();
      $statu = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/statu/statu-ekle");
    }
  }

  public function statuduzenle($idler = false)
  {
    if (isset($_POST["statuDuzenle"])) {
      $veriler = json_decode($_POST["statuDuzenle"],true);


      for ($i=0; $i < count($veriler); $i++) {

        $statuYetkileri = array();

        for ($a=0; $a < count($veriler[$i]["txtStatuYetkiAdlari"]); $a++) {

          // if (!$veriler[$i]["txtStatuYetkiDegerleri"][$a]) {
          //   $veriler[$i]["txtStatuYetkiDegerleri"][$a] = 0;
          // }
          $statuYetkileri[] = array(
            $veriler[$i]["txtStatuYetkiAdlari"][$a]=>$veriler[$i]["txtStatuYetkiDegerleri"][$a]
          );
        }

        $statu = new Statuler();
        $statu->setStatuIdsi($veriler[$i]["txtStatuIdsi"]);
        $statu->setStatuAdi($veriler[$i]["txtStatuAdi"]);
        $statu->setStatuYetkileri(json_encode($statuYetkileri));
        $this->values = array(
          "statu_adi"=>$statu->statuAdi,
          "statu_yetkileri"=>$statu->statuYetkileri,
          "id"=>$statu->statuIdsi
        );

        $yanit = $this->dataUpdate();
      }
      $statu = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $statu = new Statuler();

          $statuBilgileri[] = array(
            "statuId"=>$idler[$i],
            "statuAdi"=>$statu->getStatuAdi(array("id"=>$idler[$i])),
            "statuYetkileri"=>json_decode($statu->getStatuYetkileri(array("id"=>$idler[$i])),true)
          );
        }
      }
      $statu = null;

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT * FROM tbl_statuler");
      $stmt->execute();
      $statuler = $stmt->fetchAll();
      $model = null;

      $this->view->statuler = $statuler;
      $this->view->statuBilgileri = $statuBilgileri;

      $this->view->render("birimler/statu/statu-duzenle");

    }
  }

  public function statuSil()
  {
    if (isset($_POST["statuSil"])) {
      $veriler = json_decode($_POST["statuSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $statu = new Statuler();
        $statu->setStatuIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$statu->statuId
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
