<?php
  /**
   *
   */
  class Alacaklar extends Sirket
  {

    public $alacakIdsi;
    public $alacakKodu;
    public $alacakCariIdsi;
    public $alacakTutari;
    public $alacakKasaIdsi;
    public $alacakAciklamasi;
    public $alacakTarihi;

    function __construct()
    {
      parent::__construct();
    }


    /*ALACAK IDSİ GET SET START*/
    public function getAlacakIdsi($veriKolonArray)
    {
      $alacakIdsi = $this->selectFilterQuery("tbl_alacaklar",array("id"),$veriKolonArray);
      $this->alacakIdsi = $alacakIdsi[0]["id"];
      return $this->alacakIdsi;
    }
    public function setAlacakIdsi($yeniDeger)
    {
      $this->alacakIdsi = $yeniDeger;
    }
    /*ALACAK IDSİ GET SET END*/


    /*ALACAK KODU GET SET START*/
    public function getAlacakKodu($veriKolonArray)
    {
      $alacakKodu = $this->selectFilterQuery("tbl_alacaklar",array("alacak_kodu"),$veriKolonArray);
      $this->alacakKodu = $alacakKodu[0]["alacak_kodu"];
      return $this->alacakKodu;
    }
    public function setAlacakKodu($yeniDeger)
    {
      $this->alacakKodu = $yeniDeger;
    }
    /*ALACAK KODU GET SET END*/


    /*ALACAK CARİ IDSİ GET SET START*/
    public function getAlacakCariIdsi($veriKolonArray)
    {
      $alacakCariIdsi = $this->selectFilterQuery("tbl_alacaklar",array("alacak_cari_idsi"),$veriKolonArray);
      $this->alacakCariIdsi = $alacakCariIdsi[0]["alacak_cari_idsi"];
      return $this->alacakCariIdsi;
    }
    public function setAlacakCariIdsi($yeniDeger)
    {
      $this->alacakCariIdsi = $yeniDeger;
    }
    /*ALACAK CARİ IDSİ GET SET END*/


    /*ALACAK TUTARI GET SET START*/
    public function getAlacakTutari($veriKolonArray)
    {
      $alacakTutari = $this->selectFilterQuery("tbl_alacaklar",array("alacak_tutari"),$veriKolonArray);
      $this->alacakTutari = $alacakTutari[0]["alacak_tutari"];
      return $this->alacakTutari;
    }
    public function setAlacakTutari($yeniDeger)
    {
      $this->alacakTutari = $yeniDeger;
    }
    /*ALACAK TUTARI GET SET END*/


    /*ALACAK KASA IDSİ GET SET START*/
    public function getAlacakKasaIdsi($veriKolonArray)
    {
      $alacakKasaIdsi = $this->selectFilterQuery("tbl_alacaklar",array("alacak_kasa_idsi"),$veriKolonArray);
      $this->alacakKasaIdsi = $alacakKasaIdsi[0]["alacak_kasa_idsi"];
      return $this->alacakKasaIdsi;
    }
    public function setAlacakKasaIdsi($yeniDeger)
    {
      $this->alacakKasaIdsi = $yeniDeger;
    }
    /*ALACAK KASA IDSİ GET SET END*/


    /*ALACAK AÇIKLAMASI GET SET START*/
    public function getAlacakAciklamasi($veriKolonArray)
    {
      $alacakAciklamasi = $this->selectFilterQuery("tbl_alacaklar",array("alacak_aciklamasi"),$veriKolonArray);
      $this->alacakAciklamasi = $alacakAciklamasi[0]["alacak_aciklamasi"];
      return $this->alacakAciklamasi;
    }
    public function setAlacakAciklamasi($yeniDeger)
    {
      $this->alacakAciklamasi = $yeniDeger;
    }
    /*ALACAK AÇIKLAMASI GET SET END*/


    /*ALACAK TARİHİ GET SET START*/
    public function getAlacakTarihi($veriKolonArray)
    {
      $alacakTarihi = $this->selectFilterQuery("tbl_alacaklar",array("alacak_tarihi"),$veriKolonArray);
      $this->alacakTarihi = $alacakTarihi[0]["alacak_tarihi"];
      return $this->alacakTarihi;
    }
    public function setAlacakTarihi($yeniDeger)
    {
      $this->alacakTarihi = $yeniDeger;
    }
    /*ALACAK TARİHİ GET SET END*/



  }





?>
