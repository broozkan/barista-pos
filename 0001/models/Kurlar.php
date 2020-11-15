<?php
  /**
   *
   */
  class Kurlar extends Sirket
  {

    public $kurIdsi;
    public $kurAdi;
    public $kurKisaltmasi;
    public $kurIsareti;
    public $kurAktifMi;

    function __construct()
    {
      parent::__construct();
    }

    /*KUR ID GET SET START*/
    public function getKurIdsi($veriKolonArray)
    {
      $kurIdsi = $this->selectFilterQuery("tbl_kurlar",array("id"),$veriKolonArray);
      $this->kurIdsi = $kurIdsi[0]["id"];
      return $this->kurIdsi;
    }
    public function setKurIdsi($yeniDeger)
    {
      $this->kurIdsi = $yeniDeger;
    }
    /*KUR ID GET SET END*/


    /*KUR ADI GET SET START*/
    public function getKurAdi($veriKolonArray)
    {
      $kurAdi = $this->selectFilterQuery("tbl_kurlar",array("kur_adi"),$veriKolonArray);
      $this->kurAdi = $kurAdi[0]["kur_adi"];
      return $this->kurAdi;
    }
    public function setKurAdi($yeniDeger)
    {
      $this->kurAdi = $yeniDeger;
    }
    /*KUR ADI GET SET END*/


    /*KUR KISALTMASI GET SET START*/
    public function getKurKisaltmasi($veriKolonArray)
    {
      $kurKisaltmasi = $this->selectFilterQuery("tbl_kurlar",array("kur_kisaltmasi"),$veriKolonArray);
      $this->kurKisaltmasi = $kurKisaltmasi[0]["kur_kisaltmasi"];
      return $this->kurKisaltmasi;
    }
    public function setKurKisaltmasi($yeniDeger)
    {
      $this->kurKisaltmasi = $yeniDeger;
    }
    /*KUR KISALTMASI GET SET END*/


    /*KUR İŞARETİ GET SET START*/
    public function getKurIsareti($veriKolonArray)
    {
      $kurIsareti = $this->selectFilterQuery("tbl_kurlar",array("kur_isareti"),$veriKolonArray);
      $this->kurIsareti = $kurIsareti[0]["kur_isareti"];
      return $this->kurIsareti;
    }
    public function setKurIsareti($yeniDeger)
    {
      $this->kurIsareti = $yeniDeger;
    }
    /*KUR İŞARETİ GET SET END*/


    /*KUR AKTİF Mİ GET SET START*/
    public function getKurAktifMi($veriKolonArray)
    {
      $kurAktifMi = $this->selectFilterQuery("tbl_kurlar",array("kur_aktif_mi"),$veriKolonArray);
      $this->kurAktifMi = $kurAktifMi[0]["kur_aktif_mi"];
      return $this->kurAktifMi;
    }
    public function setKurAktifMi($yeniDeger)
    {
      $this->kurAktifMi = $yeniDeger;
    }
    /*KUR AKTİF Mİ GET SET END*/

  }





?>
