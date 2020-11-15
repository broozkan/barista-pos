<?php
  /**
   *
   */
  class Lokasyonlar extends Sirket
  {

    public $id;
    public $lokasyonAdi;
    public $lokasyonKati;
    public $lokasyonKrokisi;

    function __construct()
    {
      parent::__construct();
    }

    /*LOKASYON ID GET SET START*/
    public function getLokasyonId($veriKolonArray)
    {
      $lokasyonId = $this->selectFilterQuery("tbl_lokasyonlar",array("id"),$veriKolonArray);
      $this->lokasyonId = $lokasyonId[0]["id"];
      return $this->lokasyonId;
    }
    public function setLokasyonId($yeniDeger)
    {
      $this->lokasyonId = $yeniDeger;
    }
    /*LOKASYON ID GET SET END*/


    /*LOKASYON ADI GET SET START*/
    public function getLokasyonAdi($veriKolonArray)
    {
      $lokasyonAdi = $this->selectFilterQuery("tbl_lokasyonlar",array("lokasyon_adi"),$veriKolonArray);
      $this->lokasyonAdi = $lokasyonAdi[0]["lokasyon_adi"];
      return $this->lokasyonAdi;
    }
    public function setLokasyonAdi($yeniDeger)
    {
      $this->lokasyonAdi = $yeniDeger;
    }
    /*LOKASYON ADI GET SET END*/

    /*LOKASYON KATI GET SET START*/
    public function getLokasyonKati($veriKolonArray)
    {
      $lokasyonKati = $this->selectFilterQuery("tbl_lokasyonlar",array("lokasyon_kati"),$veriKolonArray);
      $this->lokasyonKati = $lokasyonKati[0]["lokasyon_kati"];
      return $this->lokasyonKati;
    }
    public function setLokasyonKati($yeniDeger)
    {
      $this->lokasyonKati = $yeniDeger;
    }
    /*LOKASYON KATI GET SET END*/

    /*LOKASYON KATI GET SET START*/
    public function getLokasyonKrokisi($veriKolonArray)
    {
      $lokasyonKrokisi = $this->selectFilterQuery("tbl_lokasyonlar",array("lokasyon_krokisi"),$veriKolonArray);
      $this->lokasyonKrokisi = $lokasyonKrokisi[0]["lokasyon_krokisi"];
      return $this->lokasyonKrokisi;
    }
    public function setLokasyonKrokisi($yeniDeger)
    {
      $this->lokasyonKrokisi = $yeniDeger;
    }
    /*LOKASYON KATI GET SET END*/
  }





?>
