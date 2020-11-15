<?php
  /**
   *
   */
  class Depolar extends Sirket
  {

    public $depoIdsi;
    public $depoAdi;
    public $depoAdresi;
    public $depoTelefonNumarasi;

    function __construct()
    {
      parent::__construct();
    }

    /*DEPO ID GET SET START*/
    public function getDepoIdsi($veriKolonArray)
    {
      $depoIdsi = $this->selectFilterQuery("tbl_depolar",array("id"),$veriKolonArray);
      $this->depoIdsi = $depoIdsi[0]["id"];
      return $this->depoIdsi;
    }
    public function setDepoIdsi($yeniDeger)
    {
      $this->depoIdsi = $yeniDeger;
    }
    /*DEPO ID GET SET END*/


    /*DEPO ADI GET SET START*/
    public function getDepoAdi($veriKolonArray)
    {
      $depoAdi = $this->selectFilterQuery("tbl_depolar",array("depo_adi"),$veriKolonArray);
      $this->depoAdi = $depoAdi[0]["depo_adi"];
      return $this->depoAdi;
    }
    public function setDepoAdi($yeniDeger)
    {
      $this->depoAdi = $yeniDeger;
    }
    /*DEPO ADI GET SET END*/


    /*DEPO ADRESİ GET SET START*/
    public function getDepoAdresi($veriKolonArray)
    {
      $depoAdresi = $this->selectFilterQuery("tbl_depolar",array("depo_adresi"),$veriKolonArray);
      $this->depoAdresi = $depoAdresi[0]["depo_adresi"];
      return $this->depoAdresi;
    }
    public function setDepoAdresi($yeniDeger)
    {
      $this->depoAdresi = $yeniDeger;
    }
    /*DEPO ADRESİ GET SET END*/


    /*DEPO TELEFON NUMARASİ GET SET START*/
    public function getDepoTelefonNumarasi($veriKolonArray)
    {
      $depoTelefonNumarasi = $this->selectFilterQuery("tbl_depolar",array("depo_telefon_numarasi"),$veriKolonArray);
      $this->depoTelefonNumarasi = $depoTelefonNumarasi[0]["depo_telefon_numarasi"];
      return $this->depoTelefonNumarasi;
    }
    public function setDepoTelefonNumarasi($yeniDeger)
    {
      $this->depoTelefonNumarasi = $yeniDeger;
    }
    /*DEPO TELEFON NUMARASİ GET SET END*/


  }





?>
