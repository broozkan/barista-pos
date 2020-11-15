<?php
  /**
   *
   */
  class Kategoriler extends Sirket
  {

    public $id;
    public $kategoriAdi;
    public $kategoriSiraNumarasi;

    function __construct()
    {
      parent::__construct();
    }

    /*KATEGORİ ID GET SET START*/
    public function getKategoriId($veriKolonArray)
    {
      $kategoriId = $this->selectFilterQuery("tbl_kategoriler",array("id"),$veriKolonArray);
      $this->kategoriId = $kategoriId[0]["id"];
      return $this->kategoriId;
    }
    public function setKategoriId($yeniDeger)
    {
      $this->kategoriId = $yeniDeger;
    }
    /*KATEGORİ ID GET SET END*/


    /*KATEGORİ ADI GET SET START*/
    public function getKategoriAdi($veriKolonArray)
    {
      $kategoriAdi = $this->selectFilterQuery("tbl_kategoriler",array("kategori_adi"),$veriKolonArray);
      $this->kategoriAdi = $kategoriAdi[0]["kategori_adi"];
      return $this->kategoriAdi;
    }
    public function setKategoriAdi($yeniDeger)
    {
      $this->kategoriAdi = $yeniDeger;
    }
    /*KATEGORİ ADI GET SET END*/


    /*KATEGORİ SIRA NUMARASI GET SET START*/
    public function getKategoriSiraNumarasi($veriKolonArray)
    {
      $kategoriSiraNumarasi = $this->selectFilterQuery("tbl_kategoriler",array("kategori_sira_numarasi"),$veriKolonArray);
      $this->kategoriSiraNumarasi = $kategoriSiraNumarasi[0]["kategori_sira_numarasi"];
      return $this->kategoriSiraNumarasi;
    }
    public function setKategoriSiraNumarasi($yeniDeger)
    {
      $this->kategoriSiraNumarasi = $yeniDeger;
    }
    /*KATEGORİ SIRA NUMARASI GET SET END*/

  }





?>
