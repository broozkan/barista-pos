<?php

/**
 *
 */
class Kur extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_kurlar");
    $this->kolonAdlari = array("kur_adi","kur_isareti","kur_kisaltmasi","kur_aktif_mi");

    $this->sayfaIzınAdi = "txtKurEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function kurlistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $kur = new Kurlar();
    $toplamVeriSayisi = $kur->selectQuery($this->tabloAdlari[0],array("id"));
    $kurIdleri = $kur->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($kurIdleri); $i++) {

      $kurAktifMi = $kur->getKurAktifMi(array("id"=>$kurIdleri[$i]["id"]));
      if ($kurAktifMi) {
        $kurAktifMi = "<span class='badge badge-success'>Aktif</span>";
      }else {
        $kurAktifMi = "<span class='badge badge-danger'>Pasif</span>";
      }

      $kurListesi[] = array(
        "kurId"=>$kurIdleri[$i]["id"],
        "kurAdi"=>$kur->getKurAdi(array("id"=>$kurIdleri[$i]["id"])),
        "kurKisaltmasi"=>$kur->getKurKisaltmasi(array("id"=>$kurIdleri[$i]["id"])),
        "kurIsareti"=>$kur->getKurIsareti(array("id"=>$kurIdleri[$i]["id"])),
        "kurAktifMi"=>$kurAktifMi
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->kurListesi = $kurListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/kur/kur-listesi");
  }

  public function kurekle()
  {
    if (isset($_POST["kurEkle"])) {
      $veriler = json_decode($_POST["kurEkle"],true);

      if ($veriler["txtKurAktifMi"] == 1) {
        $model = new Model();
        $stmt = $model->dbh->prepare("UPDATE tbl_kurlar SET kur_aktif_mi=:kur_aktif_mi");
        $stmt->execute(['kur_aktif_mi'=>0]);
      }


      $kur = new Kurlar();
      $kur->setKurAdi($veriler["txtKurAdi"]);
      $kur->setKurIsareti($veriler["txtKurIsareti"]);
      $kur->setKurKisaltmasi($veriler["txtKurKisaltmasi"]);
      $kur->setKurAktifMi($veriler["txtKurAktifMi"]);
      $this->values = array(
        $kur->kurAdi,
        $kur->kurIsareti,
        $kur->kurKisaltmasi,
        $kur->kurAktifMi
      );
      $yanit = $this->dataInsert();
      $kur = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/kur/kur-ekle");
    }
  }

  public function kurduzenle($idler = false)
  {
    if (isset($_POST["kurDuzenle"])) {
      $veriler = json_decode($_POST["kurDuzenle"],true);



      for ($i=0; $i < count($veriler); $i++) {
        if ($veriler[$i]["txtKurAktifMi"] == 1) {
          $model = new Model();
          $stmt = $model->dbh->prepare("UPDATE tbl_kurlar SET kur_aktif_mi=:kur_aktif_mi");
          $stmt->execute(['kur_aktif_mi'=>0]);
        }

        $kur = new Kurlar();
        $kur->setKurIdsi($veriler[$i]["txtKurIdsi"]);
        $kur->setKurAdi($veriler[$i]["txtKurAdi"]);
        $kur->setKurIsareti($veriler[$i]["txtKurIsareti"]);
        $kur->setKurKisaltmasi($veriler[$i]["txtKurKisaltmasi"]);
        $kur->setKurAktifMi($veriler[$i]["txtKurAktifMi"]);
        $this->values = array(
          "kur_adi"=>$kur->kurAdi,
          "kur_isareti"=>$kur->kurIsareti,
          "kur_kisaltmasi"=>$kur->kurKisaltmasi,
          "kur_aktif_mi"=>$kur->kurAktifMi,
          "id"=>$kur->kurIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $kur = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $kur = new Kurlar();

          $kurBilgileri[] = array(
            "kurId"=>$idler[$i],
            "kurAdi"=>$kur->getKurAdi(array("id"=>$idler[$i])),
            "kurIsareti"=>$kur->getKurIsareti(array("id"=>$idler[$i])),
            "kurKisaltmasi"=>$kur->getKurKisaltmasi(array("id"=>$idler[$i])),
            "kurAktifMi"=>$kur->getKurAktifMi(array("id"=>$idler[$i]))
          );
        }
      }
      $kur = null;
      $this->view->kurBilgileri = $kurBilgileri;

      $this->view->render("birimler/kur/kur-duzenle");
    }
  }

  public function kurSil()
  {
    if (isset($_POST["kurSil"])) {
      $veriler = json_decode($_POST["kurSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $kur = new Kurlar();
        $kur->setKurIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$kur->kurIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
