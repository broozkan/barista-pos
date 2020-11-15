<?php
  /**
   *
   */
  class OkcBilgileri extends Sirket
  {

    public $okcBilgileriIdsi;
    public $okcBilgileriOkcAktifMi;
    public $okcBilgileriPortAdi;
    public $okcBilgileriBaudRate;
    public $okcBilgileriFiscalIdsi;

    function __construct()
    {
      parent::__construct();
    }


    /*ÖKC BİLGİLERİ IDSİ GET SET START*/
    public function getOkcBilgileriIdsi($veriKolonArray)
    {
      $okcBilgileriIdsi = $this->selectFilterQuery("tbl_okc_bilgileri",array("id"),$veriKolonArray);
      $this->okcBilgileriIdsi = $okcBilgileriIdsi[0]["id"];
      return $this->okcBilgileriIdsi;
    }
    public function setOkcBilgileriIdsi($yeniDeger)
    {
      $this->okcBilgileriIdsi = $yeniDeger;
    }
    /*ÖKC BİLGİLERİ IDSİ GET SET END*/


    /*ÖKC BİLGİLERİ ÖKC AKTİF Mİ GET SET START*/
    public function getOkcBilgileriOkcAktifMi($veriKolonArray)
    {
      $okcBilgileriOkcAktifMi = $this->selectFilterQuery("tbl_okc_bilgileri",array("okc_bilgileri_okc_aktif_mi"),$veriKolonArray);
      $this->okcBilgileriOkcAktifMi = $okcBilgileriOkcAktifMi[0]["okc_bilgileri_okc_aktif_mi"];
      return $this->okcBilgileriOkcAktifMi;
    }
    public function setOkcBilgileriOkcAktifMi($yeniDeger)
    {
      $this->okcBilgileriOkcAktifMi = $yeniDeger;
    }
    /*ÖKC BİLGİLERİ ÖKC AKTİF Mİ GET SET END*/


    /*ÖKC BİLGİLERİ PORT ADI GET SET START*/
    public function getOkcBilgileriPortAdi($veriKolonArray)
    {
      $okcBilgileriPortAdi = $this->selectFilterQuery("tbl_okc_bilgileri",array("okc_bilgileri_port_adi"),$veriKolonArray);
      $this->okcBilgileriPortAdi = $okcBilgileriPortAdi[0]["okc_bilgileri_port_adi"];
      return $this->okcBilgileriPortAdi;
    }
    public function setOkcBilgileriPortAdi($yeniDeger)
    {
      $this->okcBilgileriPortAdi = $yeniDeger;
    }
    /*ÖKC BİLGİLERİ PORT ADI GET SET END*/


    /*ÖKC BİLGİLERİ BAUDRATE GET SET START*/
    public function getOkcBilgileriBaudRate($veriKolonArray)
    {
      $okcBilgileriBaudRate = $this->selectFilterQuery("tbl_okc_bilgileri",array("okc_bilgileri_baudrate"),$veriKolonArray);
      $this->okcBilgileriBaudRate = $okcBilgileriBaudRate[0]["okc_bilgileri_baudrate"];
      return $this->okcBilgileriBaudRate;
    }
    public function setOkcBilgileriBaudRate($yeniDeger)
    {
      $this->okcBilgileriBaudRate = $yeniDeger;
    }
    /*ÖKC BİLGİLERİ BAUDRATE GET SET END*/


    /*ÖKC BİLGİLERİ FISCAL IDSİ GET SET START*/
    public function getOkcBilgileriFiscalIdsi($veriKolonArray)
    {
      $okcBilgileriFiscalIdsi = $this->selectFilterQuery("tbl_okc_bilgileri",array("okc_bilgileri_fiscal_idsi"),$veriKolonArray);
      $this->okcBilgileriFiscalIdsi = $okcBilgileriFiscalIdsi[0]["okc_bilgileri_fiscal_idsi"];
      return $this->okcBilgileriFiscalIdsi;
    }
    public function setOkcBilgileriFiscalIdsi($yeniDeger)
    {
      $this->okcBilgileriFiscalIdsi = $yeniDeger;
    }
    /*ÖKC BİLGİLERİ FISCAL IDSİ GET SET END*/




  }





?>
