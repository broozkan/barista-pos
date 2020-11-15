<?php
  /**
   *
   */
  class Birimler extends Sirket
  {

    public $birimIdsi;
    public $birimAdi;
    public $birimKisaltmasi;

    function __construct()
    {
      parent::__construct();
    }

    /*BİRİM ID GET SET START*/
    public function getBirimIdsi($veriKolonArray)
    {
      $birimIdsi = $this->selectFilterQuery("tbl_birimler",array("id"),$veriKolonArray);
      $this->birimIdsi = $birimIdsi[0]["id"];
      return $this->birimIdsi;
    }
    public function setBirimIdsi($yeniDeger)
    {
      $this->birimIdsi = $yeniDeger;
    }
    /*BİRİM ID GET SET END*/


    /*BİRİM ADI GET SET START*/
    public function getBirimAdi($veriKolonArray)
    {
      $birimAdi = $this->selectFilterQuery("tbl_birimler",array("birim_adi"),$veriKolonArray);
      $this->birimAdi = $birimAdi[0]["birim_adi"];
      return $this->birimAdi;
    }
    public function setBirimAdi($yeniDeger)
    {
      $this->birimAdi = $yeniDeger;
    }
    /*BİRİM ADI GET SET END*/


    /*BİRİM KISALTMASI GET SET START*/
    public function getBirimKisaltmasi($veriKolonArray)
    {
      $birimKisaltmasi = $this->selectFilterQuery("tbl_birimler",array("birim_kisaltmasi"),$veriKolonArray);
      $this->birimKisaltmasi = $birimKisaltmasi[0]["birim_kisaltmasi"];
      return $this->birimKisaltmasi;
    }
    public function setBirimKisaltmasi($yeniDeger)
    {
      $this->birimKisaltmasi = $yeniDeger;
    }
    /*BİRİM KISALTMASI GET SET END*/

  }





?>
