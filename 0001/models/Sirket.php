<?php
  /**
   * ŞİRKET BİLGİLERİ CLASS
   */
  class Sirket extends Model
  {
    public $sirketIdsi;
    public $sirketAdi;
    public $sirketAdresi;
    public $sirketEpostaAdresi;
    public $sirketTelefonu;
    public $sirketVergiNumarasi;

    function __construct()
    {
      parent::__construct();
    }


    /*ŞİRKET IDSİ GET SET START*/
    public function getSirketIdsi($veriKolonArray)
    {
      $sirketIdsi = $this->selectFilterQuery("tbl_sirket",array("id"),$veriKolonArray);
      $this->sirketIdsi = $sirketIdsi[0]["id"];
      return $this->sirketIdsi;
    }
    public function setSirketIdsi($yeniDeger)
    {
      $this->sirketIdsi = $yeniDeger;
    }
    /*ŞİRKET IDSİ GET SET END*/


    /*ŞİRKET ADI GET SET START*/
    public function getSirketAdi($veriKolonArray)
    {
      $sirketAdi = $this->selectFilterQuery("tbl_sirket",array("sirket_adi"),$veriKolonArray);
      $this->sirketAdi = $sirketAdi[0]["sirket_adi"];
      return $this->sirketAdi;
    }
    public function setSirketAdi($yeniDeger)
    {
      $this->sirketAdi = $yeniDeger;
    }
    /*ŞİRKET ADI GET SET END*/


    /*ŞİRKET ADRESİ GET SET START*/
    public function getSirketAdresi($veriKolonArray)
    {
      $sirketAdresi = $this->selectFilterQuery("tbl_sirket",array("sirket_adresi"),$veriKolonArray);
      $this->sirketAdresi = $sirketAdresi[0]["sirket_adresi"];
      return $this->sirketAdresi;
    }
    public function setSirketAdresi($yeniDeger)
    {
      $this->sirketAdresi = $yeniDeger;
    }
    /*ŞİRKET ADRESİ GET SET END*/


    /*ŞİRKET E-POSTA ADRESİ GET SET START*/
    public function getSirketEpostaAdresi($veriKolonArray)
    {
      $sirketEpostaAdresi = $this->selectFilterQuery("tbl_sirket",array("sirket_eposta_adresi"),$veriKolonArray);
      $this->sirketEpostaAdresi = $sirketEpostaAdresi[0]["sirket_eposta_adresi"];
      return $this->sirketEpostaAdresi;
    }
    public function setSirketEpostaAdresi($yeniDeger)
    {
      $this->sirketEpostaAdresi = $yeniDeger;
    }
    /*ŞİRKET E-POSTA ADRESİ GET SET END*/


    /*ŞİRKET TELEFONU GET SET START*/
    public function getSirketTelefonu($veriKolonArray)
    {
      $sirketTelefonu = $this->selectFilterQuery("tbl_sirket",array("sirket_telefonu"),$veriKolonArray);
      $this->sirketTelefonu = $sirketTelefonu[0]["sirket_telefonu"];
      return $this->sirketTelefonu;
    }
    public function setSirketTelefonu($yeniDeger)
    {
      $this->sirketTelefonu = $yeniDeger;
    }
    /*ŞİRKET TELEFONU GET SET END*/


    /*ŞİRKET VERGİ NUMARASI GET SET START*/
    public function getSirketVergiNumarasi($veriKolonArray)
    {
      $sirketVergiNumarasi = $this->selectFilterQuery("tbl_sirket",array("sirket_vergi_numarasi"),$veriKolonArray);
      $this->sirketVergiNumarasi = $sirketVergiNumarasi[0]["sirket_vergi_numarasi"];
      return $this->sirketVergiNumarasi;
    }
    public function setSirketVergiNumarasi($yeniDeger)
    {
      $this->sirketVergiNumarasi = $yeniDeger;
    }
    /*ŞİRKET VERGİ NUMARASI GET SET END*/


    /*ŞİRKET LOGOSU GET SET START*/
    public function getSirketLogosu($veriKolonArray)
    {
      $sirketLogosu = $this->selectFilterQuery("tbl_sirket",array("sirket_logosu"),$veriKolonArray);
      $this->sirketLogosu = $sirketLogosu[0]["sirket_logosu"];
      return $this->sirketLogosu;
    }
    public function setSirketLogosu($yeniDeger)
    {
      $this->sirketLogosu = $yeniDeger;
    }
    /*ŞİRKET LOGOSU GET SET END*/






  }

?>
