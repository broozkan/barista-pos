<?php
  /**
   *
   */
  class OdemeMetodlari extends Sirket
  {

    public $odemeMetodIdsi;
    public $odemeMetodOkcIdsi;
    public $odemeMetodAdi;
    public $odemeMetodSiralamasi;
    public $odemeMetodAktifMi;

    function __construct()
    {
      parent::__construct();
    }


    /*ÖDEME METODU ID GET SET START*/
    public function getOdemeMetodIdsi($veriKolonArray)
    {
      $odemeMetodIdsi = $this->selectFilterQuery("tbl_odeme_metodlari",array("id"),$veriKolonArray);
      $this->odemeMetodIdsi = $odemeMetodIdsi[0]["id"];
      return $this->odemeMetodIdsi;
    }
    public function setOdemeMetodIdsi($yeniDeger)
    {
      $this->odemeMetodIdsi = $yeniDeger;
    }
    /*ÖDEME METODU ID GET SET END*/


    /*ÖDEME METODU ÖKC IDSİ GET SET START*/
    public function getOdemeMetodOkcIdsi($veriKolonArray)
    {
      $odemeMetodOkcIdsi = $this->selectFilterQuery("tbl_odeme_metodlari",array("odeme_metod_okc_idsi"),$veriKolonArray);
      $this->odemeMetodOkcIdsi = $odemeMetodOkcIdsi[0]["odeme_metod_okc_idsi"];
      return $this->odemeMetodOkcIdsi;
    }
    public function setOdemeMetodOkcIdsi($yeniDeger)
    {
      $this->odemeMetodOkcIdsi = $yeniDeger;
    }
    /*ÖDEME METODU ÖKC IDSİ GET SET END*/


    /*ÖDEME METODU ADI GET SET START*/
    public function getOdemeMetodAdi($veriKolonArray)
    {
      $odemeMetodAdi = $this->selectFilterQuery("tbl_odeme_metodlari",array("odeme_metod_adi"),$veriKolonArray);
      $this->odemeMetodAdi = $odemeMetodAdi[0]["odeme_metod_adi"];
      return $this->odemeMetodAdi;
    }
    public function setOdemeMetodAdi($yeniDeger)
    {
      $this->odemeMetodAdi = $yeniDeger;
    }
    /*ÖDEME METODU ADI GET SET END*/


    /*ÖDEME METODU SIRALAMASI GET SET START*/
    public function getOdemeMetodSiralamasi($veriKolonArray)
    {
      $odemeMetodSiralamasi = $this->selectFilterQuery("tbl_odeme_metodlari",array("odeme_metod_siralamasi"),$veriKolonArray);
      $this->odemeMetodSiralamasi = $odemeMetodSiralamasi[0]["odeme_metod_siralamasi"];
      return $this->odemeMetodSiralamasi;
    }
    public function setOdemeMetodSiralamasi($yeniDeger)
    {
      $this->odemeMetodSiralamasi = $yeniDeger;
    }
    /*ÖDEME METODU SIRALAMASI GET SET END*/


    /*ÖDEME METODU AKTİF Mİ GET SET START*/
    public function getOdemeMetodAktifMi($veriKolonArray)
    {
      $odemeMetodAktifMi = $this->selectFilterQuery("tbl_odeme_metodlari",array("odeme_metod_aktif_mi"),$veriKolonArray);
      $this->odemeMetodAktifMi = $odemeMetodAktifMi[0]["odeme_metod_aktif_mi"];
      return $this->odemeMetodAktifMi;
    }
    public function setOdemeMetodAktifMi($yeniDeger)
    {
      $this->odemeMetodAktifMi = $yeniDeger;
    }
    /*ÖDEME METODU AKTİF Mİ GET SET END*/



  }





?>
