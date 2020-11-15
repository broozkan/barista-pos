<?php

/**
 *
 */
class Yazici extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_yazicilar");
    $this->kolonAdlari = array("yazici_adi","yazici_ip_adresi");

    $this->sayfaIzınAdi = "txtYaziciEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function yazicilistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $yazici = new Yazicilar();
    $toplamVeriSayisi = $yazici->selectQuery($this->tabloAdlari[0],array("id"));
    $yaziciIdleri = $yazici->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($yaziciIdleri); $i++) {
      $yaziciListesi[] = array(
        "yaziciId"=>$yaziciIdleri[$i]["id"],
        "yaziciAdi"=>$yazici->getYaziciAdi(array("id"=>$yaziciIdleri[$i]["id"])),
        "yaziciIpAdresi"=>$yazici->getYaziciIpAdresi(array("id"=>$yaziciIdleri[$i]["id"]))
      );
    }
    $model = new Model();
    $cariYazicilariIdleri = $model->selectFilterQuery("tbl_yazicilar",array("id"),array("yazici_tablo_adi"=>"tbl_sirket_carileri"));
    $model = null;
    $cariYaziciBilgileri = array();
    for ($i=0; $i < count($cariYazicilariIdleri); $i++) {
      $yazici = new Yazicilar();
      $cariYaziciBilgileri[] = array(
        "yaziciId"=>$yazici->getYaziciId(array("id"=>$cariYazicilariIdleri[$i]["id"])),
        "yaziciAdi"=>$yazici->getYaziciAdi(array("id"=>$cariYazicilariIdleri[$i]["id"]))
      );
    }

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->cariYaziciBilgileri = $cariYaziciBilgileri;
    $this->view->yaziciListesi = $yaziciListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/yazici/yazici-listesi");
  }

  public function yaziciekle()
  {
    if (isset($_POST["yaziciEkle"])) {
      $veriler = json_decode($_POST["yaziciEkle"],true);
      if (strlen($veriler["txtYaziciAdi"]) > 25) {
        $yanit = "Yazıcı adı 25 karakterden fazla olamaz";
      }else {
        $yanit = "true";
      }
      if ($yanit == "true") {
        $yazici = new Yazicilar();
        $yazici->setYaziciAdi($veriler["txtYaziciAdi"]);
        $yazici->setYaziciIpAdresi($veriler["txtYaziciIpAdresi"]);
        $this->values = array(
          $yazici->yaziciAdi,
          $yazici->yaziciIpAdresi
        );
        $yanit = $this->dataInsert();
      }

     if (@$yanit["yanit"] == true) {
       shell_exec("/usr/sbin/lpadmin -p ".$yazici->yaziciAdi." -E -v socket://".$yazici->yaziciIpAdresi.":9100 -P /var/barista_pos/bro.ppd");
     }

      $yazici = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/yazici/yazici-ekle");
    }
  }

  public function yaziciduzenle($idler = false)
  {
    if (isset($_POST["yaziciDuzenle"])) {
      $veriler = json_decode($_POST["yaziciDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $yazici = new Yazicilar();
        $yaziciOncekiAdi = $yazici->getYaziciAdi(array("id"=>$veriler[$i]["txtYaziciId"]));

        $yazici->setYaziciAdi($veriler[$i]["txtYaziciAdi"]);
        $yazici->setYaziciIpAdresi($veriler[$i]["txtYaziciIpAdresi"]);
        $yazici->setYaziciId($veriler[$i]["txtYaziciId"]);
        $this->values = array(
          "yazici_adi"=>$yazici->yaziciAdi,
          "yazici_ip_adresi"=>$yazici->yaziciIpAdresi,
          "id"=>$yazici->yaziciId
        );
        $yanit = $this->dataUpdate();

        if ($yanit == true) {
          shell_exec("/usr/sbin/lpadmin -x ".$yaziciOncekiAdi."");
          shell_exec("/usr/sbin/lpadmin -p ".$yazici->yaziciAdi." -E -v socket://".$yazici->yaziciIpAdresi.":9100 -P /var/barista_pos/bro.ppd");
        }
      }
      $yazici = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $yazici = new Yazicilar();

          $yaziciBilgileri[] = array(
            "yaziciId"=>$idler[$i],
            "yaziciAdi"=>$yazici->getYaziciAdi(array("id"=>$idler[$i])),
            "yaziciIpAdresi"=>$yazici->getYaziciIpAdresi(array("id"=>$idler[$i]))
          );
        }
      }
      $yazici = null;
      $this->view->yaziciBilgileri = $yaziciBilgileri;

      $this->view->render("birimler/yazici/yazici-duzenle");
    }
  }

  public function yaziciSil()
  {
    if (isset($_POST["yaziciSil"])) {
      $veriler = json_decode($_POST["yaziciSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $yazici = new Yazicilar();
        $yazici->setYaziciId($veriler[$i]["id"]);
        $yaziciAdi = $yazici->getYaziciAdi(array("id"=>$veriler[$i]["id"]));
        exec("lpadmin -x ".$yaziciAdi."");
        $this->values = array(
          "id"=>$yazici->yaziciId
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
