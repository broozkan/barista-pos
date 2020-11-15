<?php
  /**
   *
   */
  class Vergiler extends Sirket
  {

    public $id;
    public $vergiAdi;
    public $vergiYuzdesi;

    function __construct()
    {
      parent::__construct();
    }

    /*VERGİ ID GET SET START*/
    public function getVergiIdsi($veriKolonArray)
    {
      $vergiIdsi = $this->selectFilterQuery("tbl_vergiler",array("id"),$veriKolonArray);
      $this->vergiIdsi = $vergiIdsi[0]["id"];
      return $this->vergiIdsi;
    }
    public function setVergiIdsi($yeniDeger)
    {
      $this->vergiIdsi = $yeniDeger;
    }
    /*VERGİ ID GET SET END*/


    /*VERGİ ADI GET SET START*/
    public function getVergiAdi($veriKolonArray)
    {
      $vergiAdi = $this->selectFilterQuery("tbl_vergiler",array("vergi_adi"),$veriKolonArray);
      $this->vergiAdi = $vergiAdi[0]["vergi_adi"];
      return $this->vergiAdi;
    }
    public function setVergiAdi($yeniDeger)
    {
      $this->vergiAdi = $yeniDeger;
    }
    /*VERGİ ADI GET SET END*/


    /*VERGİ YÜZDESİ GET SET START*/
    public function getVergiYuzdesi($veriKolonArray)
    {
      $vergiYuzdesi = $this->selectFilterQuery("tbl_vergiler",array("vergi_yuzdesi"),$veriKolonArray);
      $this->vergiYuzdesi = $vergiYuzdesi[0]["vergi_yuzdesi"];
      return $this->vergiYuzdesi;
    }
    public function setVergiYuzdesi($yeniDeger)
    {
      $this->vergiYuzdesi = $yeniDeger;
    }
    /*VERGİ YÜZDESİ GET SET END*/

  }





?>
