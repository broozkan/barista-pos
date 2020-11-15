<?php
  /**
   *  CARİLAR CLASS
   */
  class Cariler extends Sirket
  {

    public $id;
    public $cariAdi;
    public $cariEpostaAdresi;
    public $cariTelefonNumarasi;
    public $cariAdresi;
    public $cariKategorisi;

    function __construct()
    {
      parent::__construct();
    }

    /*CARİ ID GET SET START*/
    public function getCariId($veriKolonArray)
    {
      $cariId = $this->selectFilterQuery("tbl_sirket_carileri",array("id"),$veriKolonArray);
      $this->cariId = $cariId[0]["id"];
      return $this->cariId;
    }
    /*CARİ ID GET SET END*/

    /*CARİ ADI GET SET START*/
    public function getCariAdi($veriKolonArray)
    {
      $cariAdi = $this->selectFilterQuery("tbl_sirket_carileri",array("cari_adi"),$veriKolonArray);
      $this->cariAdi = $cariAdi[0]["cari_adi"];
      return $this->cariAdi;
    }
    public function setCariAdi($yeniDeger)
    {
      $this->cariAdi = $yeniDeger;
    }
    /*CARİ ADI GET SET END*/

    /*CARİ EPOSTA ADRESİ GET SET START*/
    public function getCariEpostaAdresi($veriKolonArray)
    {
      $cariEpostaAdresi = $this->selectFilterQuery("tbl_sirket_carileri",array("cari_eposta_adresi"),$veriKolonArray);
      $this->cariEpostaAdresi = $cariEpostaAdresi[0]["cari_eposta_adresi"];
      return $this->cariEpostaAdresi;
    }
    public function setCariEpostaAdresi($yeniDeger)
    {
      $this->cariEpostaAdresi = $yeniDeger;
    }
    /*CARİ EPOSTA ADRESİ GET SET END*/


    /*CARİ TELEFON NUMARASI GET SET START*/
    public function getCariTelefonNumarasi($veriKolonArray)
    {
      $cariTelefonNumarasi = $this->selectFilterQuery("tbl_sirket_carileri",array("cari_telefon_numarasi"),$veriKolonArray);
      $this->cariTelefonNumarasi = $cariTelefonNumarasi[0]["cari_telefon_numarasi"];
      return $this->cariTelefonNumarasi;
    }
    public function setCariTelefonNumarasi($yeniDeger)
    {
      $this->cariTelefonNumarasi = $yeniDeger;
    }
    /*CARİ TELEFON NUMARASI GET SET END*/


    /*CARİ ADRESİ GET SET START*/
    public function getCariAdresi($veriKolonArray)
    {
      $cariAdresi = $this->selectFilterQuery("tbl_sirket_carileri",array("cari_adresi"),$veriKolonArray);
      $this->cariAdresi = $cariAdresi[0]["cari_adresi"];
      return $this->cariAdresi;
    }
    public function setCariAdresi($yeniDeger)
    {
      $this->cariAdresi = $yeniDeger;
    }
    /*CARİ ADRESİ GET SET END*/


    /*CARİ KATEGORİSİ GET SET START*/
    public function getCariKategorisi($veriKolonArray)
    {
      $cariKategorisi = $this->selectFilterQuery("tbl_sirket_carileri",array("cari_kategorisi"),$veriKolonArray);
      $this->cariKategorisi = $cariKategorisi[0]["cari_kategorisi"];
      return $this->cariKategorisi;
    }
    public function setCariKategorisi($yeniDeger)
    {
      $this->cariKategorisi = $yeniDeger;
    }
    /*CARİ KATEGORİSİ GET SET END*/

  }

?>
