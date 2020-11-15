<?php

/**
 *
 */
class Menu extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_menuler");
    $this->kolonAdlari = array("menu_adi","menu_gorselleri","menu_mutfak_idleri","menu_toplam_fiyati");

    $this->sayfaIzınAdi = "txtMenuEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function menulistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $menu = new Menuler();
    $toplamVeriSayisi = $menu->selectQuery($this->tabloAdlari[0],array("id"));
    $menuIdleri = $menu->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($menuIdleri); $i++) {
      $menuListesi[] = array(
        "menuId"=>$menuIdleri[$i]["id"],
        "menuAdi"=>$menu->getMenuAdi(array("id"=>$menuIdleri[$i]["id"])),
        "menuToplamFiyati"=>$menu->getMenuToplamFiyati(array("id"=>$menuIdleri[$i]["id"]))
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->menuListesi = @$menuListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/menu/menu-listesi");
  }

  public function menuekle()
  {
    if (isset($_POST["menuEkle"])) {
      $veriler = json_decode($_POST["menuEkle"],true);

      if (isset($_FILES["dosya"])) {
        for ($i=0; $i < count($_FILES['dosya']['name']); $i++) {
          if(file_exists($_FILES['dosya']['tmp_name'][$i]) || !is_uploaded_file($_FILES['dosya']['tmp_name'][$i])) {
            $dosyaAdi[] = $_FILES["dosya"]["name"][$i];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/menuler/".$dosyaAdi[$i];
            $dosya=$_FILES["dosya"]["tmp_name"][$i];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosyaAdi = null;
          }
        }
      }else {
        $dosyaAdi = null;
      }


      $menu = new Menuler();
      $menu->setMenuAdi($veriler["txtMenuAdi"]);
      if ($dosyaAdi != null) {
        $menu->setMenuGorselleri(json_encode($dosyaAdi));
      }

      if (isset($veriler["txtMenuMutfakIdleri"])) {
        $menu->setMenuMutfakIdleri(json_encode($veriler["txtMenuMutfakIdleri"]));
      }else {
        $menu->setMenuMutfakIdleri(null);
      }

      $menu->setMenuToplamFiyati($veriler["txtMenuToplamFiyati"]);

      $this->values = array(
        $menu->menuAdi,
        $menu->menuGorselleri,
        $menu->menuMutfakIdleri,
        $menu->menuToplamFiyati
      );
      $yanit = $this->dataInsert();
      $menu->setMenuIdsi($yanit["lastId"]);

      if ($yanit["yanit"] == "true") {
        for ($i=0; $i < count($veriler["txtMenuUrunleriUrunAdi"]); $i++) {


          $menu->menuUrunleri = new MenuUrunleri();
          $menu->menuUrunleri->setMenuUrunleriMenuIdsi($menu->menuIdsi);
          $menu->menuUrunleri->setMenuUrunleriUrunIdsi($veriler["txtMenuUrunleriUrunIdsi"][$i]);
          $menu->menuUrunleri->setMenuUrunleriUrunAdedi($veriler["txtMenuUrunleriUrunAdedi"][$i]);

          $this->values = array(
            $menu->menuUrunleri->menuUrunleriMenuIdsi,
            $menu->menuUrunleri->menuUrunleriUrunIdsi,
            $menu->menuUrunleri->menuUrunleriUrunAdedi
          );

          $this->tabloAdlari = array("tbl_menu_urunleri");
          $this->kolonAdlari = array("menu_urunleri_menu_idsi","menu_urunleri_urun_idsi","menu_urunleri_urun_adedi");
          $yanit = $this->dataInsert();
        }
      }
      $menu = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,mutfak_adi FROM tbl_mutfaklar");
      $stmt->execute();
      $mutfaklar = $stmt->fetchAll();

      $model = null;

      $this->view->mutfaklar = $mutfaklar;
      $this->view->render("birimler/menu/menu-ekle");
    }
  }

  public function menuduzenle($menuIdsi = false)
  {
    if (isset($_POST["menuDuzenle"])) {
      $veriler = json_decode($_POST["menuDuzenle"],true);
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "DELETE FROM tbl_menu_urunleri WHERE menu_urunleri_menu_idsi=:menu_idsi"
      );
      $stmt->execute(['menu_idsi'=>$veriler["txtMenuIdsi"]]);


      if (isset($_FILES["dosya"])) {
        for ($i=0; $i < count($_FILES['dosya']['name']); $i++) {
          if(file_exists($_FILES['dosya']['tmp_name'][$i]) || !is_uploaded_file($_FILES['dosya']['tmp_name'][$i])) {
            $dosyaAdi[] = $_FILES["dosya"]["name"][$i];
            $hedefDizin=$_SERVER["DOCUMENT_ROOT"]."/local-assets/menuler/".$dosyaAdi[$i];
            $dosya=$_FILES["dosya"]["tmp_name"][$i];
            if(move_uploaded_file($dosya,$hedefDizin)){
              $yanit = true;
            }else{
              $yanit = "Dosya yüklenemediği için hata alındı. (Dizin izinlerini kontrol ediniz)";
            }
          }else {
            $dosyaAdi = null;
          }
        }
      }else {
        $dosyaAdi = null;
      }

      $menu = new Menuler();
      $menu->setMenuIdsi($veriler["txtMenuIdsi"]);
      $menu->setMenuAdi($veriler["txtMenuAdi"]);
      if ($dosyaAdi != null) {
        $menu->setMenuGorselleri(json_encode($dosyaAdi));
      }else {
        $dosyaAdi = $menu->getMenuGorselleri(array("id"=>$veriler["txtMenuIdsi"]));
        $menu->setMenuGorselleri($dosyaAdi);
      }

      if (isset($veriler["txtMenuMutfakIdleri"])) {
        $menu->setMenuMutfakIdleri(json_encode($veriler["txtMenuMutfakIdleri"]));
      }else {
        $menu->setMenuMutfakIdleri(null);
      }

      $menu->setMenuToplamFiyati($veriler["txtMenuToplamFiyati"]);

      $this->values = array(
        "menu_adi"=>$menu->menuAdi,
        "menu_gorselleri"=>$menu->menuGorselleri,
        "menu_mutfak_idleri"=>$menu->menuMutfakIdleri,
        "menu_toplam_fiyati"=>$menu->menuToplamFiyati,
        "id"=>$menu->menuIdsi
      );
      $yanit = $this->dataUpdate();

      if ($yanit == "true") {
        for ($i=0; $i < count($veriler["txtMenuUrunleriUrunAdi"]); $i++) {


          $menu->menuUrunleri = new MenuUrunleri();
          $menu->menuUrunleri->setMenuUrunleriMenuIdsi($menu->menuIdsi);
          $menu->menuUrunleri->setMenuUrunleriUrunIdsi($veriler["txtMenuUrunleriUrunIdsi"][$i]);
          $menu->menuUrunleri->setMenuUrunleriUrunAdedi($veriler["txtMenuUrunleriUrunAdedi"][$i]);

          $this->values = array(
            $menu->menuUrunleri->menuUrunleriMenuIdsi,
            $menu->menuUrunleri->menuUrunleriUrunIdsi,
            $menu->menuUrunleri->menuUrunleriUrunAdedi
          );

          $this->tabloAdlari = array("tbl_menu_urunleri");
          $this->kolonAdlari = array("menu_urunleri_menu_idsi","menu_urunleri_urun_idsi","menu_urunleri_urun_adedi");
          $yanit = $this->dataInsert();
        }
      }

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      /*menü bilgileri*/
      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_menuler.*,tbl_menuler.id AS menu_idsi,tbl_menu_urunleri.*,tbl_menu_urunleri.id AS menu_urunleri_idsi,tbl_urunler.urun_adi,tbl_urunler.urun_satis_fiyati FROM tbl_menuler
        INNER JOIN tbl_menu_urunleri ON tbl_menuler.id=tbl_menu_urunleri.menu_urunleri_menu_idsi
        INNER JOIN tbl_urunler ON tbl_menu_urunleri.menu_urunleri_urun_idsi=tbl_urunler.id
        WHERE tbl_menuler.id=:menu_idsi"
      );
      $stmt->execute(['menu_idsi'=>$menuIdsi]);
      $menuBilgileri = $stmt->fetchAll();
      /*menü bilgileri*/

      /*mutfak bilgileri*/
      $stmt = $model->dbh->prepare("SELECT id,mutfak_adi FROM tbl_mutfaklar");
      $stmt->execute();
      $mutfaklar = $stmt->fetchAll();
      /*mutfak bilgileri*/

      $model = null;

      $this->view->mutfaklar = $mutfaklar;
      $this->view->menuBilgileri = $menuBilgileri;
      $this->view->render("birimler/menu/menu-duzenle");
    }
  }

  public function menuSil()
  {
    if (isset($_POST["menuSil"])) {
      $veriler = json_decode($_POST["menuSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $model = new Model();
        $stmt = $model->dbh->prepare(
          "DELETE FROM tbl_menuler WHERE id=:menu_idsi"
        );
        $yanit = $stmt->execute(['menu_idsi'=>$veriler[$i]["id"]]);
        if ($yanit == true) {
          $stmt = $model->dbh->prepare(
            "DELETE FROM tbl_menu_urunleri WHERE menu_urunleri_menu_idsi=:menu_idsi"
          );
          $yanit = $stmt->execute(['menu_idsi'=>$veriler[$i]["id"]]);
        }
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }

  public function urunFiyatiniAl()
  {
    if (isset($_POST["urunFiyatiniAl"])) {
      $urunIdsi = $_POST["urunFiyatiniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT urun_satis_fiyati FROM tbl_urunler WHERE id=:urun_idsi");
      $stmt->execute(['urun_idsi'=>$urunIdsi]);
      $urunSatisFiyati = $stmt->fetch();
      $model = null;

      echo json_encode(array(
        "urunFiyati"=>$urunSatisFiyati["urun_satis_fiyati"]
      ));
    }
  }
}
