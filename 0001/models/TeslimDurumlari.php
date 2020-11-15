<?php
  /**
   *
   */
  class TeslimDurumlari extends Sirket
  {

    public $teslimDurumuIdsi;
    public $teslimDurumuAdi;
    public $teslimDurumuRengi;

    function __construct()
    {
      parent::__construct();
    }


    /*TESLİM DURUMU ID GET SET START*/
    public function getTeslimDurumuIdsi($veriKolonArray)
    {
      $teslimDurumuIdsi = $this->selectFilterQuery("tbl_teslim_durumlari",array("id"),$veriKolonArray);
      $this->teslimDurumuIdsi = $teslimDurumuIdsi[0]["id"];
      return $this->teslimDurumuIdsi;
    }
    public function setTeslimDurumuIdsi($yeniDeger)
    {
      $this->teslimDurumuIdsi = $yeniDeger;
    }
    /*TESLİM DURUMU ID GET SET END*/


    /*TESLİM DURUMU ADI GET SET START*/
    public function getTeslimDurumuAdi($veriKolonArray)
    {
      $teslimDurumuAdi = $this->selectFilterQuery("tbl_teslim_durumlari",array("teslim_durumu_adi"),$veriKolonArray);
      $this->teslimDurumuAdi = $teslimDurumuAdi[0]["teslim_durumu_adi"];
      return $this->teslimDurumuAdi;
    }
    public function setTeslimDurumuAdi($yeniDeger)
    {
      $this->teslimDurumuAdi = $yeniDeger;
    }
    /*TESLİM DURUMU ADI GET SET END*/


    /*TESLİM DURUMU RENGİ GET SET START*/
    public function getTeslimDurumuRengi($veriKolonArray)
    {
      $teslimDurumuRengi = $this->selectFilterQuery("tbl_teslim_durumlari",array("teslim_durumu_rengi"),$veriKolonArray);
      $this->teslimDurumuRengi = $teslimDurumuRengi[0]["teslim_durumu_rengi"];
      return $this->teslimDurumuRengi;
    }
    public function setTeslimDurumuRengi($yeniDeger)
    {
      $this->teslimDurumuRengi = $yeniDeger;
    }
    /*TESLİM DURUMU RENGİ GET SET END*/




  }





?>
