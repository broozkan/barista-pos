<?php
  /**
   *
   */
  class Kasalar extends Sirket
  {

    public $kasaIdsi;
    public $kasaAdi;
    public $kasaAcilisBakiyesi;
    public $kasaBirincilKasaMi;

    function __construct()
    {
      parent::__construct();
    }

    /*KASA ID GET SET START*/
    public function getKasaIdsi($veriKolonArray)
    {
      $kasaIdsi = $this->selectFilterQuery("tbl_kasalar",array("id"),$veriKolonArray);
      $this->kasaIdsi = $kasaIdsi[0]["id"];
      return $this->kasaIdsi;
    }
    public function setKasaIdsi($yeniDeger)
    {
      $this->kasaIdsi = $yeniDeger;
    }
    /*KASA ID GET SET END*/


    /*KASA ADI GET SET START*/
    public function getKasaAdi($veriKolonArray)
    {
      $kasaAdi = $this->selectFilterQuery("tbl_kasalar",array("kasa_adi"),$veriKolonArray);
      $this->kasaAdi = $kasaAdi[0]["kasa_adi"];
      return $this->kasaAdi;
    }
    public function setKasaAdi($yeniDeger)
    {
      $this->kasaAdi = $yeniDeger;
    }
    /*KASA ADI GET SET END*/


    /*KASA AÇILIŞ BAKİYESİ GET SET START*/
    public function getKasaAcilisBakiyesi($veriKolonArray)
    {
      $kasaAcilisBakiyesi = $this->selectFilterQuery("tbl_kasalar",array("kasa_acilis_bakiyesi"),$veriKolonArray);
      $this->kasaAcilisBakiyesi = $kasaAcilisBakiyesi[0]["kasa_acilis_bakiyesi"];
      return $this->kasaAcilisBakiyesi;
    }
    public function setKasaAcilisBakiyesi($yeniDeger)
    {
      $this->kasaAcilisBakiyesi = $yeniDeger;
    }
    /*KASA AÇILIŞ BAKİYESİ GET SET END*/


    /*KASA BİRİNCİL KASA MI GET SET START*/
    public function getKasaBirincilKasaMi($veriKolonArray)
    {
      $kasaBirincilKasaMi = $this->selectFilterQuery("tbl_kasalar",array("kasa_birincil_kasa_mi"),$veriKolonArray);
      $this->kasaBirincilKasaMi = $kasaBirincilKasaMi[0]["kasa_birincil_kasa_mi"];
      return $this->kasaBirincilKasaMi;
    }
    public function setKasaBirincilKasaMi($yeniDeger)
    {
      $this->kasaBirincilKasaMi = $yeniDeger;
    }
    /*KASA BİRİNCİL KASA MI GET SET END*/


  }





?>
