<?php
  /**
   *
   */
  class Statuler extends Sirket
  {

    public $statuIdsi;
    public $statuAdi;
    public $statuYetkileri;

    function __construct()
    {
      parent::__construct();
    }

    /*STATÜ ID GET SET START*/
    public function getStatuIdsi($veriKolonArray)
    {
      $statuIdsi = $this->selectFilterQuery("tbl_statuler",array("id"),$veriKolonArray);
      $this->statuIdsi = $statuIdsi[0]["id"];
      return $this->statuIdsi;
    }
    public function setStatuIdsi($yeniDeger)
    {
      $this->statuIdsi = $yeniDeger;
    }
    /*STATÜ ID GET SET END*/


    /*STATÜ ADI GET SET START*/
    public function getStatuAdi($veriKolonArray)
    {
      $statuAdi = $this->selectFilterQuery("tbl_statuler",array("statu_adi"),$veriKolonArray);
      $this->statuAdi = $statuAdi[0]["statu_adi"];
      return $this->statuAdi;
    }
    public function setStatuAdi($yeniDeger)
    {
      $this->statuAdi = $yeniDeger;
    }
    /*STATÜ ADI GET SET END*/


    /*STATÜ YETKİLERİ GET SET START*/
    public function getStatuYetkileri($veriKolonArray)
    {
      $statuYetkileri = $this->selectFilterQuery("tbl_statuler",array("statu_yetkileri"),$veriKolonArray);
      $this->statuYetkileri = $statuYetkileri[0]["statu_yetkileri"];
      return $this->statuYetkileri;
    }
    public function setStatuYetkileri($yeniDeger)
    {
      $this->statuYetkileri = $yeniDeger;
    }
    /*STATÜ YETKİLERİ GET SET END*/

  }





?>
