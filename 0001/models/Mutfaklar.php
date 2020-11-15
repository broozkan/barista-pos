<?php
  /**
   *
   */
  class Mutfaklar extends Sirket
  {

    public $id;
    public $mutfakAdi;
    public $mutfakYaziciIdsi;

    function __construct()
    {
      parent::__construct();
    }

    /*MUTFAK ID GET SET START*/
    public function getMutfakId($veriKolonArray)
    {
      $mutfakId = $this->selectFilterQuery("tbl_mutfaklar",array("id"),$veriKolonArray);
      $this->mutfakId = $mutfakId[0]["id"];
      return $this->mutfakId;
    }
    public function setMutfakId($yeniDeger)
    {
      $this->mutfakId = $yeniDeger;
    }
    /*MUTFAK ID GET SET END*/


    /*MUTFAK ADI GET SET START*/
    public function getMutfakAdi($veriKolonArray)
    {
      $mutfakAdi = $this->selectFilterQuery("tbl_mutfaklar",array("mutfak_adi"),$veriKolonArray);
      $this->mutfakAdi = $mutfakAdi[0]["mutfak_adi"];
      return $this->mutfakAdi;
    }
    public function setMutfakAdi($yeniDeger)
    {
      $this->mutfakAdi = $yeniDeger;
    }
    /*MUTFAK ADI GET SET END*/


    /*MUTFAK YAZICI IDSİ GET SET START*/
    public function getMutfakYaziciIdsi($veriKolonArray)
    {
      $mutfakYaziciIdsi = $this->selectFilterQuery("tbl_mutfaklar",array("mutfak_yazici_idsi"),$veriKolonArray);
      $this->mutfakYaziciIdsi = $mutfakYaziciIdsi[0]["mutfak_yazici_idsi"];
      return $this->mutfakYaziciIdsi;
    }
    public function setMutfakYaziciIdsi($yeniDeger)
    {
      $this->mutfakYaziciIdsi = $yeniDeger;
    }
    /*MUTFAK YAZICI IDSİ GET SET END*/

  }





?>
