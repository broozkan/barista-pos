<?php
  /**
   *
   */
  class Tahsilatlar extends Sirket
  {

    public $tahsilatIdsi;
    public $tahsilatKodu;
    public $tahsilatCariIdsi;
    public $tahsilatTutari;
    public $tahsilatKasaIdsi;
    public $tahsilatAciklamasi;
    public $tahsilatTarihi;

    function __construct()
    {
      parent::__construct();
    }


    /*TAHSİLAT IDSİ GET SET START*/
    public function getTahsilatIdsi($veriKolonArray)
    {
      $tahsilatIdsi = $this->selectFilterQuery("tbl_tahsilatlar",array("id"),$veriKolonArray);
      $this->tahsilatIdsi = $tahsilatIdsi[0]["id"];
      return $this->tahsilatIdsi;
    }
    public function setTahsilatIdsi($yeniDeger)
    {
      $this->tahsilatIdsi = $yeniDeger;
    }
    /*TAHSİLAT IDSİ GET SET END*/


    /*TAHSİLAT KODU GET SET START*/
    public function getTahsilatKodu($veriKolonArray)
    {
      $tahsilatKodu = $this->selectFilterQuery("tbl_tahsilatlar",array("tahsilat_kodu"),$veriKolonArray);
      $this->tahsilatKodu = $tahsilatKodu[0]["tahsilat_kodu"];
      return $this->tahsilatKodu;
    }
    public function setTahsilatKodu($yeniDeger)
    {
      $this->tahsilatKodu = $yeniDeger;
    }
    /*TAHSİLAT KODU GET SET END*/


    /*TAHSİLAT CARİ IDSİ GET SET START*/
    public function getTahsilatCariIdsi($veriKolonArray)
    {
      $tahsilatCariIdsi = $this->selectFilterQuery("tbl_tahsilatlar",array("tahsilat_cari_idsi"),$veriKolonArray);
      $this->tahsilatCariIdsi = $tahsilatCariIdsi[0]["tahsilat_cari_idsi"];
      return $this->tahsilatCariIdsi;
    }
    public function setTahsilatCariIdsi($yeniDeger)
    {
      $this->tahsilatCariIdsi = $yeniDeger;
    }
    /*TAHSİLAT CARİ IDSİ GET SET END*/


    /*TAHSİLAT TUTARI GET SET START*/
    public function getTahsilatTutari($veriKolonArray)
    {
      $tahsilatTutari = $this->selectFilterQuery("tbl_tahsilatlar",array("tahsilat_tutari"),$veriKolonArray);
      $this->tahsilatTutari = $tahsilatTutari[0]["tahsilat_tutari"];
      return $this->tahsilatTutari;
    }
    public function setTahsilatTutari($yeniDeger)
    {
      $this->tahsilatTutari = $yeniDeger;
    }
    /*TAHSİLAT TUTARI GET SET END*/


    /*TAHSİLAT KASA IDSİ GET SET START*/
    public function getTahsilatKasaIdsi($veriKolonArray)
    {
      $tahsilatKasaIdsi = $this->selectFilterQuery("tbl_tahsilatlar",array("tahsilat_kasa_idsi"),$veriKolonArray);
      $this->tahsilatKasaIdsi = $tahsilatKasaIdsi[0]["tahsilat_kasa_idsi"];
      return $this->tahsilatKasaIdsi;
    }
    public function setTahsilatKasaIdsi($yeniDeger)
    {
      $this->tahsilatKasaIdsi = $yeniDeger;
    }
    /*TAHSİLAT KASA IDSİ GET SET END*/


    /*TAHSİLAT AÇIKLAMASI GET SET START*/
    public function getTahsilatAciklamasi($veriKolonArray)
    {
      $tahsilatAciklamasi = $this->selectFilterQuery("tbl_tahsilatlar",array("tahsilat_aciklamasi"),$veriKolonArray);
      $this->tahsilatAciklamasi = $tahsilatAciklamasi[0]["tahsilat_aciklamasi"];
      return $this->tahsilatAciklamasi;
    }
    public function setTahsilatAciklamasi($yeniDeger)
    {
      $this->tahsilatAciklamasi = $yeniDeger;
    }
    /*TAHSİLAT AÇIKLAMASI GET SET END*/


    /*TAHSİLAT TARİHİ GET SET START*/
    public function getTahsilatTarihi($veriKolonArray)
    {
      $tahsilatTarihi = $this->selectFilterQuery("tbl_tahsilatlar",array("tahsilat_tarihi"),$veriKolonArray);
      $this->tahsilatTarihi = $tahsilatTarihi[0]["tahsilat_tarihi"];
      return $this->tahsilatTarihi;
    }
    public function setTahsilatTarihi($yeniDeger)
    {
      $this->tahsilatTarihi = $yeniDeger;
    }
    /*TAHSİLAT TARİHİ GET SET END*/



  }





?>
