<?php
  /**
   *
   */
  class Verecekler extends Sirket
  {

    public $verecekIdsi;
    public $verecekKodu;
    public $verecekCariIdsi;
    public $verecekTutari;
    public $verecekKasaIdsi;
    public $verecekAciklamasi;
    public $verecekTarihi;

    function __construct()
    {
      parent::__construct();
    }


    /*VERECEK IDSİ GET SET START*/
    public function getVerecekIdsi($veriKolonArray)
    {
      $verecekIdsi = $this->selectFilterQuery("tbl_verecekler",array("id"),$veriKolonArray);
      $this->verecekIdsi = $verecekIdsi[0]["id"];
      return $this->verecekIdsi;
    }
    public function setVerecekIdsi($yeniDeger)
    {
      $this->verecekIdsi = $yeniDeger;
    }
    /*VERECEK IDSİ GET SET END*/


    /*VERECEK KODU GET SET START*/
    public function getVerecekKodu($veriKolonArray)
    {
      $verecekKodu = $this->selectFilterQuery("tbl_verecekler",array("verecek_kodu"),$veriKolonArray);
      $this->verecekKodu = $verecekKodu[0]["verecek_kodu"];
      return $this->verecekKodu;
    }
    public function setVerecekKodu($yeniDeger)
    {
      $this->verecekKodu = $yeniDeger;
    }
    /*VERECEK KODU GET SET END*/


    /*VERECEK CARİ IDSİ GET SET START*/
    public function getVerecekCariIdsi($veriKolonArray)
    {
      $verecekCariIdsi = $this->selectFilterQuery("tbl_verecekler",array("verecek_cari_idsi"),$veriKolonArray);
      $this->verecekCariIdsi = $verecekCariIdsi[0]["verecek_cari_idsi"];
      return $this->verecekCariIdsi;
    }
    public function setVerecekCariIdsi($yeniDeger)
    {
      $this->verecekCariIdsi = $yeniDeger;
    }
    /*VERECEK CARİ IDSİ GET SET END*/


    /*VERECEK TUTARI GET SET START*/
    public function getVerecekTutari($veriKolonArray)
    {
      $verecekTutari = $this->selectFilterQuery("tbl_verecekler",array("verecek_tutari"),$veriKolonArray);
      $this->verecekTutari = $verecekTutari[0]["verecek_tutari"];
      return $this->verecekTutari;
    }
    public function setVerecekTutari($yeniDeger)
    {
      $this->verecekTutari = $yeniDeger;
    }
    /*VERECEK TUTARI GET SET END*/


    /*VERECEK KASA IDSİ GET SET START*/
    public function getVerecekKasaIdsi($veriKolonArray)
    {
      $verecekKasaIdsi = $this->selectFilterQuery("tbl_verecekler",array("verecek_kasa_idsi"),$veriKolonArray);
      $this->verecekKasaIdsi = $verecekKasaIdsi[0]["verecek_kasa_idsi"];
      return $this->verecekKasaIdsi;
    }
    public function setVerecekKasaIdsi($yeniDeger)
    {
      $this->verecekKasaIdsi = $yeniDeger;
    }
    /*VERECEK KASA IDSİ GET SET END*/


    /*VERECEK AÇIKLAMASI GET SET START*/
    public function getVerecekAciklamasi($veriKolonArray)
    {
      $verecekAciklamasi = $this->selectFilterQuery("tbl_verecekler",array("verecek_aciklamasi"),$veriKolonArray);
      $this->verecekAciklamasi = $verecekAciklamasi[0]["verecek_aciklamasi"];
      return $this->verecekAciklamasi;
    }
    public function setVerecekAciklamasi($yeniDeger)
    {
      $this->verecekAciklamasi = $yeniDeger;
    }
    /*VERECEK AÇIKLAMASI GET SET END*/


    /*VERECEK TARİHİ GET SET START*/
    public function getVerecekTarihi($veriKolonArray)
    {
      $verecekTarihi = $this->selectFilterQuery("tbl_verecekler",array("verecek_tarihi"),$veriKolonArray);
      $this->verecekTarihi = $verecekTarihi[0]["verecek_tarihi"];
      return $this->verecekTarihi;
    }
    public function setVerecekTarihi($yeniDeger)
    {
      $this->verecekTarihi = $yeniDeger;
    }
    /*VERECEK TARİHİ GET SET END*/



  }





?>
