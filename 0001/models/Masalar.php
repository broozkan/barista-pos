<?php
  /**
   * MASALAR CLASS
   */
  class Masalar extends Sirket
  {
    public $masaId;
    public $masaAdi;
    public $masaDurumu;
    public $masaLokasyonIdsi;
    public $masaGorselleri;


    function __construct()
    {
      parent::__construct();
    }


    /*MASA ID GET SET START*/
    public function getMasaId($veriKolonArray)
    {
      $masaId = $this->selectFilterQuery("tbl_masalar",array("id"),$veriKolonArray);
      $this->masaId = $masaId[0]["id"];
      return $this->masaId;
    }
    public function setMasaId($yeniDeger)
    {
      $this->masaId = $yeniDeger;
    }
    /*MASA ID GET SET END*/


    /*MASA ADI GET SET START*/
    public function getMasaAdi($veriKolonArray)
    {
      $masaAdi = $this->selectFilterQuery("tbl_masalar",array("masa_adi"),$veriKolonArray);
      $this->masaAdi = $masaAdi[0]["masa_adi"];
      return $this->masaAdi;
    }
    public function setMasaAdi($yeniDeger)
    {
      $this->masaAdi = $yeniDeger;
    }
    /*MASA ADI GET SET END*/


    /*MASA DURUMU GET SET START*/
    public function getMasaDurumu($veriKolonArray)
    {
      $masaDurumu = $this->selectFilterQuery("tbl_masalar",array("masa_durumu"),$veriKolonArray);
      $this->masaDurumu = $masaDurumu[0]["masa_durumu"];
      return $this->masaDurumu;
    }
    public function setMasaDurumu($yeniDeger)
    {
      $this->masaDurumu = $yeniDeger;
    }
    /*MASA DURUMU GET SET END*/


    /*MASA LOKASYON IDSİ GET SET START*/
    public function getMasaLokasyonIdsi($veriKolonArray)
    {
      $masaLokasyonIdsi = $this->selectFilterQuery("tbl_masalar",array("masa_lokasyon_idsi"),$veriKolonArray);
      $this->masaLokasyonIdsi = $masaLokasyonIdsi[0]["masa_lokasyon_idsi"];
      return $this->masaLokasyonIdsi;
    }
    public function setMasaLokasyonIdsi($yeniDeger)
    {
      $this->masaLokasyonIdsi = $yeniDeger;
    }
    /*MASA LOKASYON IDSİ GET SET END*/


    /*MASA GÖRSELLERİ GET SET START*/
    public function getMasaGorselleri($veriKolonArray)
    {
      $masaGorselleri = $this->selectFilterQuery("tbl_masalar",array("masa_gorselleri"),$veriKolonArray);
      $this->masaGorselleri = $masaGorselleri[0]["masa_gorselleri"];
      return $this->masaGorselleri;
    }
    public function setMasaGorselleri($yeniDeger)
    {
      $this->masaGorselleri = $yeniDeger;
    }
    /*MASA GÖRSELLERİ GET SET END*/




  }

?>
