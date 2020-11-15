<?php
  /**
   *
   */
  class Odemeler extends Sirket
  {

    public $odemeIdsi;
    public $odemeKodu;
    public $odemeCariIdsi;
    public $odemeTutari;
    public $odemeKasaIdsi;
    public $odemeAciklamasi;
    public $odemeTarihi;

    function __construct()
    {
      parent::__construct();
    }


    /*ÖDEME IDSİ GET SET START*/
    public function getOdemeIdsi($veriKolonArray)
    {
      $odemeIdsi = $this->selectFilterQuery("tbl_odemeler",array("id"),$veriKolonArray);
      $this->odemeIdsi = $odemeIdsi[0]["id"];
      return $this->odemeIdsi;
    }
    public function setOdemeIdsi($yeniDeger)
    {
      $this->odemeIdsi = $yeniDeger;
    }
    /*ÖDEME IDSİ GET SET END*/


    /*ÖDEME KODU GET SET START*/
    public function getOdemeKodu($veriKolonArray)
    {
      $odemeKodu = $this->selectFilterQuery("tbl_odemeler",array("odeme_kodu"),$veriKolonArray);
      $this->odemeKodu = $odemeKodu[0]["odeme_kodu"];
      return $this->odemeKodu;
    }
    public function setOdemeKodu($yeniDeger)
    {
      $this->odemeKodu = $yeniDeger;
    }
    /*ÖDEME KODU GET SET END*/


    /*ÖDEME CARİ IDSİ GET SET START*/
    public function getOdemeCariIdsi($veriKolonArray)
    {
      $odemeCariIdsi = $this->selectFilterQuery("tbl_odemeler",array("odeme_cari_idsi"),$veriKolonArray);
      $this->odemeCariIdsi = $odemeCariIdsi[0]["odeme_cari_idsi"];
      return $this->odemeCariIdsi;
    }
    public function setOdemeCariIdsi($yeniDeger)
    {
      $this->odemeCariIdsi = $yeniDeger;
    }
    /*ÖDEME CARİ IDSİ GET SET END*/


    /*ÖDEME TUTARI GET SET START*/
    public function getOdemeTutari($veriKolonArray)
    {
      $odemeTutari = $this->selectFilterQuery("tbl_odemeler",array("odeme_tutari"),$veriKolonArray);
      $this->odemeTutari = $odemeTutari[0]["odeme_tutari"];
      return $this->odemeTutari;
    }
    public function setOdemeTutari($yeniDeger)
    {
      $this->odemeTutari = $yeniDeger;
    }
    /*ÖDEME TUTARI GET SET END*/


    /*ÖDEME KASA IDSİ GET SET START*/
    public function getOdemeKasaIdsi($veriKolonArray)
    {
      $odemeKasaIdsi = $this->selectFilterQuery("tbl_odemeler",array("odeme_kasa_idsi"),$veriKolonArray);
      $this->odemeKasaIdsi = $odemeKasaIdsi[0]["odeme_kasa_idsi"];
      return $this->odemeKasaIdsi;
    }
    public function setOdemeKasaIdsi($yeniDeger)
    {
      $this->odemeKasaIdsi = $yeniDeger;
    }
    /*ÖDEME KASA IDSİ GET SET END*/


    /*ÖDEME AÇIKLAMASI GET SET START*/
    public function getOdemeAciklamasi($veriKolonArray)
    {
      $odemeAciklamasi = $this->selectFilterQuery("tbl_odemeler",array("odeme_aciklamasi"),$veriKolonArray);
      $this->odemeAciklamasi = $odemeAciklamasi[0]["odeme_aciklamasi"];
      return $this->odemeAciklamasi;
    }
    public function setOdemeAciklamasi($yeniDeger)
    {
      $this->odemeAciklamasi = $yeniDeger;
    }
    /*ÖDEME AÇIKLAMASI GET SET END*/


    /*ÖDEME TARİHİ GET SET START*/
    public function getOdemeTarihi($veriKolonArray)
    {
      $odemeTarihi = $this->selectFilterQuery("tbl_odemeler",array("odeme_tarihi"),$veriKolonArray);
      $this->odemeTarihi = $odemeTarihi[0]["odeme_tarihi"];
      return $this->odemeTarihi;
    }
    public function setOdemeTarihi($yeniDeger)
    {
      $this->odemeTarihi = $yeniDeger;
    }
    /*ÖDEME TARİHİ GET SET END*/



  }





?>
