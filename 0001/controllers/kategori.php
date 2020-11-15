<?php

/**
 *
 */
class Kategori extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_kategoriler");
    $this->kolonAdlari = array("kategori_adi","kategori_sira_numarasi");

    $this->sayfaIzınAdi = "txtKategoriEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function kategorilistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $kategori = new Kategoriler();
    $toplamVeriSayisi = $kategori->selectQuery($this->tabloAdlari[0],array("id"));
    $kategoriIdleri = $kategori->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($kategoriIdleri); $i++) {
      $kategoriListesi[] = array(
        "kategoriId"=>$kategoriIdleri[$i]["id"],
        "kategoriAdi"=>$kategori->getKategoriAdi(array("id"=>$kategoriIdleri[$i]["id"])),
        "kategoriSiraNumarasi"=>$kategori->getKategoriSiraNumarasi(array("id"=>$kategoriIdleri[$i]["id"]))
      );
    }
    $model = new Model();
    $cariKategorileriIdleri = $model->selectFilterQuery("tbl_kategoriler",array("id"),array("kategori_tablo_adi"=>"tbl_sirket_carileri"));
    $model = null;
    $cariKategoriBilgileri = array();
    for ($i=0; $i < count($cariKategorileriIdleri); $i++) {
      $kategori = new Kategoriler();
      $cariKategoriBilgileri[] = array(
        "kategoriId"=>$kategori->getKategoriId(array("id"=>$cariKategorileriIdleri[$i]["id"])),
        "kategoriAdi"=>$kategori->getKategoriAdi(array("id"=>$cariKategorileriIdleri[$i]["id"]))
      );
    }

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->cariKategoriBilgileri = $cariKategoriBilgileri;
    $this->view->kategoriListesi = $kategoriListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/kategori/kategori-listesi");
  }

  public function kategoriekle()
  {
    if (isset($_POST["kategoriEkle"])) {
      $veriler = json_decode($_POST["kategoriEkle"],true);
      $kategori = new Kategoriler();
      $kategori->setKategoriAdi($veriler["txtKategoriAdi"]);
      $kategori->setKategoriSiraNumarasi($veriler["txtKategoriSiraNumarasi"]);
      $this->values = array(
        $kategori->kategoriAdi,
        $kategori->kategoriSiraNumarasi
      );
      $yanit = $this->dataInsert();
      $kategori = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/kategori/kategori-ekle");
    }
  }

  public function kategoriduzenle($idler = false)
  {
    if (isset($_POST["kategoriDuzenle"])) {
      $veriler = json_decode($_POST["kategoriDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $kategori = new Kategoriler();
        $kategori->setKategoriSiraNumarasi($veriler[$i]["txtKategoriSiraNumarasi"]);
        $kategori->setKategoriAdi($veriler[$i]["txtKategoriAdi"]);
        $kategori->setKategoriId($veriler[$i]["txtKategoriId"]);
        $this->values = array(
          "kategori_sira_numarasi"=>$kategori->kategoriSiraNumarasi,
          "kategori_adi"=>$kategori->kategoriAdi,
          "id"=>$kategori->kategoriId
        );
        $yanit = $this->dataUpdate();
      }
      $kategori = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $kategori = new Kategoriler();

          $kategoriBilgileri[] = array(
            "kategoriId"=>$idler[$i],
            "kategoriAdi"=>$kategori->getKategoriAdi(array("id"=>$idler[$i])),
            "kategoriSiraNumarasi"=>$kategori->getKategoriSiraNumarasi(array("id"=>$idler[$i]))
          );
        }
      }
      $kategori = null;
      $this->view->kategoriBilgileri = $kategoriBilgileri;

      $this->view->render("birimler/kategori/kategori-duzenle");
    }
  }

  public function kategoriSil()
  {
    if (isset($_POST["kategoriSil"])) {
      $veriler = json_decode($_POST["kategoriSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $kategori = new Kategoriler();
        $kategori->setKategoriId($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$kategori->kategoriId
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
