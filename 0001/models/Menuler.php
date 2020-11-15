<?php
  /**
   *
   */
  class Menuler extends Sirket
  {

    public $menuIdsi;
    public $menuAdi;
    public $menuGorselleri;
    public $menuMutfakIdleri;
    public $menuToplamFiyati;
    public $menuUrunleri;

    function __construct()
    {
      parent::__construct();
    }

    /*MENÜ IDSİ GET SET START*/
    public function getMenuIdsi($veriKolonArray)
    {
      $menuIdsi = $this->selectFilterQuery("tbl_menuler",array("id"),$veriKolonArray);
      $this->menuIdsi = $menuIdsi[0]["id"];
      return $this->menuIdsi;
    }
    public function setMenuIdsi($yeniDeger)
    {
      $this->menuIdsi = $yeniDeger;
    }
    /*MENÜ IDSİ GET SET END*/


    /*MENÜ ADI GET SET START*/
    public function getMenuAdi($veriKolonArray)
    {
      $menuAdi = $this->selectFilterQuery("tbl_menuler",array("menu_adi"),$veriKolonArray);
      $this->menuAdi = $menuAdi[0]["menu_adi"];
      return $this->menuAdi;
    }
    public function setMenuAdi($yeniDeger)
    {
      $this->menuAdi = $yeniDeger;
    }
    /*MENÜ ADI GET SET END*/


    /*MENÜ GÖRSELLERİ GET SET START*/
    public function getMenuGorselleri($veriKolonArray)
    {
      $menuGorselleri = $this->selectFilterQuery("tbl_menuler",array("menu_gorselleri"),$veriKolonArray);
      $this->menuGorselleri = $menuGorselleri[0]["menu_gorselleri"];
      return $this->menuGorselleri;
    }
    public function setMenuGorselleri($yeniDeger)
    {
      $this->menuGorselleri = $yeniDeger;
    }
    /*MENÜ GÖRSELLERİ GET SET END*/


    /*MENÜ MUTFAK IDLERİ GET SET START*/
    public function getMenuMutfakIdleri($veriKolonArray)
    {
      $menuMutfakIdleri = $this->selectFilterQuery("tbl_menuler",array("menu_mutfak_idleri"),$veriKolonArray);
      $this->menuMutfakIdleri = $menuMutfakIdleri[0]["menu_mutfak_idleri"];
      return $this->menuMutfakIdleri;
    }
    public function setMenuMutfakIdleri($yeniDeger)
    {
      $this->menuMutfakIdleri = $yeniDeger;
    }
    /*MENÜ MUTFAK IDLERİ GET SET END*/


    /*MENÜ TOPLAM FİYATI GET SET START*/
    public function getMenuToplamFiyati($veriKolonArray)
    {
      $menuToplamFiyati = $this->selectFilterQuery("tbl_menuler",array("menu_toplam_fiyati"),$veriKolonArray);
      $this->menuToplamFiyati = $menuToplamFiyati[0]["menu_toplam_fiyati"];
      return $this->menuToplamFiyati;
    }
    public function setMenuToplamFiyati($yeniDeger)
    {
      $this->menuToplamFiyati = $yeniDeger;
    }
    /*MENÜ TOPLAM FİYATI GET SET END*/

  }


  /**
   *
   */
  class MenuUrunleri extends Menuler
  {

    public $menuUrunleriIdsi;
    public $menuUrunleriMenuIdsi;
    public $menuUrunleriUrunIdsi;
    public $menuUrunleriUrunAdedi;


    function __construct()
    {
      parent::__construct();
    }


    /*MENÜ ÜRÜNLERİ IDSİ GET SET START*/
    public function getMenuUrunleriIdsi($veriKolonArray)
    {
      $menuUrunleriIdsi = $this->selectFilterQuery("tbl_menuler",array("menu_urunleri_idsi"),$veriKolonArray);
      $this->menuUrunleriIdsi = $menuUrunleriIdsi[0]["menu_urunleri_idsi"];
      return $this->menuUrunleriIdsi;
    }
    public function setMenuUrunleriIdsi($yeniDeger)
    {
      $this->menuUrunleriIdsi = $yeniDeger;
    }
    /*MENÜ ÜRÜNLERİ IDSİ GET SET END*/


    /*MENÜ ÜRÜNLERİ MENÜ IDSİ GET SET START*/
    public function getMenuUrunleriMenuIdsi($veriKolonArray)
    {
      $menuUrunleriMenuIdsi = $this->selectFilterQuery("tbl_menuler",array("menu_urunleri_menu_idsi"),$veriKolonArray);
      $this->menuUrunleriMenuIdsi = $menuUrunleriMenuIdsi[0]["menu_urunleri_menu_idsi"];
      return $this->menuUrunleriMenuIdsi;
    }
    public function setMenuUrunleriMenuIdsi($yeniDeger)
    {
      $this->menuUrunleriMenuIdsi = $yeniDeger;
    }
    /*MENÜ ÜRÜNLERİ MENÜ IDSİ GET SET END*/


    /*MENÜ ÜRÜNLERİ URUN IDSİ GET SET START*/
    public function getMenuUrunleriUrunIdsi($veriKolonArray)
    {
      $menuUrunleriUrunIdsi = $this->selectFilterQuery("tbl_menuler",array("menu_urunleri_urun_idsi"),$veriKolonArray);
      $this->menuUrunleriUrunIdsi = $menuUrunleriUrunIdsi[0]["menu_urunleri_urun_idsi"];
      return $this->menuUrunleriUrunIdsi;
    }
    public function setMenuUrunleriUrunIdsi($yeniDeger)
    {
      $this->menuUrunleriUrunIdsi = $yeniDeger;
    }
    /*MENÜ ÜRÜNLERİ URUN IDSİ GET SET END*/


    /*MENÜ ÜRÜNLERİ URUN ADEDİ GET SET START*/
    public function getMenuUrunleriUrunAdedi($veriKolonArray)
    {
      $menuUrunleriUrunAdedi = $this->selectFilterQuery("tbl_menuler",array("menu_urunleri_urun_adedi"),$veriKolonArray);
      $this->menuUrunleriUrunAdedi = $menuUrunleriUrunAdedi[0]["menu_urunleri_urun_adedi"];
      return $this->menuUrunleriUrunAdedi;
    }
    public function setMenuUrunleriUrunAdedi($yeniDeger)
    {
      $this->menuUrunleriUrunAdedi = $yeniDeger;
    }
    /*MENÜ ÜRÜNLERİ URUN ADEDİ GET SET END*/

  }



?>
