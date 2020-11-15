<?php
  /**
   *  MÜŞTERİLER CLASS
   */
  class Musteriler extends Sirket
  {

    public $musteriIdsi;
    public $musteriAdiSoyadi;
    public $musteriTelefonNumarasi;
    public $musteriEpostaAdresi;
    public $musteriNotlari;
    public $musteriIndirimTuru;
    public $musteriIndirimMiktari;
    public $musteriAdresleri;

    function __construct()
    {
      parent::__construct();
    }

    /*MÜŞTERİ IDSİ GET SET START*/
    public function getMusteriIdsi($veriKolonArray)
    {
      $musteriIdsi = $this->selectFilterQuery("tbl_musteriler",array("id"),$veriKolonArray);
      $this->musteriIdsi = $musteriIdsi[0]["id"];
      return $this->musteriIdsi;
    }
    public function setMusteriIdsi($yeniDeger)
    {
      $this->musteriIdsi = $yeniDeger;
    }
    /*MÜŞTERİ IDSİ GET SET END*/


    /*MÜŞTERİ ADI SOYADI GET SET START*/
    public function getMusteriAdiSoyadi($veriKolonArray)
    {
      $musteriAdiSoyadi = $this->selectFilterQuery("tbl_musteriler",array("musteri_adi_soyadi"),$veriKolonArray);
      $this->musteriAdiSoyadi = $musteriAdiSoyadi[0]["musteri_adi_soyadi"];
      return $this->musteriAdiSoyadi;
    }
    public function setMusteriAdiSoyadi($yeniDeger)
    {
      $this->musteriAdiSoyadi = $yeniDeger;
    }
    /*MÜŞTERİ ADI SOYADI GET SET END*/


    /*MÜŞTERİ TELEFON NUMARASI GET SET START*/
    public function getMusteriTelefonNumarasi($veriKolonArray)
    {
      $musteriTelefonNumarasi = $this->selectFilterQuery("tbl_musteriler",array("musteri_telefon_numarasi"),$veriKolonArray);
      $this->musteriTelefonNumarasi = $musteriTelefonNumarasi[0]["musteri_telefon_numarasi"];
      return $this->musteriTelefonNumarasi;
    }
    public function setMusteriTelefonNumarasi($yeniDeger)
    {
      $this->musteriTelefonNumarasi = $yeniDeger;
    }
    /*MÜŞTERİ TELEFON NUMARASI GET SET END*/


    /*MÜŞTERİ EPOSTA ADRESİ GET SET START*/
    public function getMusteriEpostaAdresi($veriKolonArray)
    {
      $musteriEpostaAdresi = $this->selectFilterQuery("tbl_musteriler",array("musteri_eposta_adresi"),$veriKolonArray);
      $this->musteriEpostaAdresi = $musteriEpostaAdresi[0]["musteri_eposta_adresi"];
      return $this->musteriEpostaAdresi;
    }
    public function setMusteriEpostaAdresi($yeniDeger)
    {
      $this->musteriEpostaAdresi = $yeniDeger;
    }
    /*MÜŞTERİ EPOSTA ADRESİ GET SET END*/


    /*MÜŞTERİ NOTLARI GET SET START*/
    public function getMusteriNotlari($veriKolonArray)
    {
      $musteriNotlari = $this->selectFilterQuery("tbl_musteriler",array("musteri_notlari"),$veriKolonArray);
      $this->musteriNotlari = $musteriNotlari[0]["musteri_notlari"];
      return $this->musteriNotlari;
    }
    public function setMusteriNotlari($yeniDeger)
    {
      $this->musteriNotlari = $yeniDeger;
    }
    /*MÜŞTERİ NOTLARI GET SET END*/


    /*MÜŞTERİ İNDİRİM TURU GET SET START*/
    public function getMusteriIndirimTuru($veriKolonArray)
    {
      $musteriIndirimTuru = $this->selectFilterQuery("tbl_musteriler",array("musteri_indirim_turu"),$veriKolonArray);
      $this->musteriIndirimTuru = $musteriIndirimTuru[0]["musteri_indirim_turu"];
      return $this->musteriIndirimTuru;
    }
    public function setMusteriIndirimTuru($yeniDeger)
    {
      $this->musteriIndirimTuru = $yeniDeger;
    }
    /*MÜŞTERİ İNDİRİM TURU GET SET END*/


    /*MÜŞTERİ İNDİRİM MİKTARI GET SET START*/
    public function getMusteriIndirimMiktari($veriKolonArray)
    {
      $musteriIndirimMiktari = $this->selectFilterQuery("tbl_musteriler",array("musteri_indirim_miktari"),$veriKolonArray);
      $this->musteriIndirimMiktari = $musteriIndirimMiktari[0]["musteri_indirim_miktari"];
      return $this->musteriIndirimMiktari;
    }
    public function setMusteriIndirimMiktari($yeniDeger)
    {
      $this->musteriIndirimMiktari = $yeniDeger;
    }
    /*MÜŞTERİ İNDİRİM MİKTARI GET SET END*/

  }

  /**
   *
   */
  class MusteriAdresleri extends Musteriler
  {

    public $musteriAdresleriIdsi;
    public $musteriAdresleriMusteriIdsi;
    public $musteriAdresleriAdres;
    public $musteriAdresleriAdresVarsayilanMi;

    function __construct()
    {
      parent::__construct();
    }


    /*MÜŞTERİ ADRESLERİ IDSİ GET SET START*/
    public function getMusteriAdresleriIdsi($veriKolonArray)
    {
      $musteriAdresleriIdsi = $this->selectFilterQuery("tbl_musteriler",array("id"),$veriKolonArray);
      $this->musteriAdresleriIdsi = $musteriAdresleriIdsi[0]["id"];
      return $this->musteriAdresleriIdsi;
    }
    public function setMusteriAdresleriIdsi($yeniDeger)
    {
      $this->musteriAdresleriIdsi = $yeniDeger;
    }
    /*MÜŞTERİ ADRESLERİ IDSİ GET SET END*/


    /*MÜŞTERİ ADRESLERİ MÜŞTERİ IDLERİ GET SET START*/
    public function getMusteriAdresleriMusteriIdsi($veriKolonArray)
    {
      $musteriAdresleriMusteriIdsi = $this->selectFilterQuery("tbl_musteri_adresleri",array("musteri_adresleri_musteri_idsi"),$veriKolonArray);
      $this->musteriAdresleriMusteriIdsi = $musteriAdresleriMusteriIdsi[0]["musteri_adresleri_musteri_idsi"];
      return $this->musteriAdresleriMusteriIdsi;
    }
    public function setMusteriAdresleriMusteriIdsi($yeniDeger)
    {
      $this->musteriAdresleriMusteriIdsi = $yeniDeger;
    }
    /*MÜŞTERİ ADRESLERİ MÜŞTERİ IDLERİ GET SET END*/


    /*MÜŞTERİ ADRESLERİ ADRES GET SET START*/
    public function getMusteriAdresleriAdres($veriKolonArray)
    {
      $musteriAdresleriAdres = $this->selectFilterQuery("tbl_musteri_adresleri",array("musteri_adresleri_adres"),$veriKolonArray);
      $this->musteriAdresleriAdres = $musteriAdresleriAdres[0]["musteri_adresleri_adres"];
      return $this->musteriAdresleriAdres;
    }
    public function setMusteriAdresleriAdres($yeniDeger)
    {
      $this->musteriAdresleriAdres = $yeniDeger;
    }
    /*MÜŞTERİ ADRESLERİ ADRES GET SET END*/


    /*MÜŞTERİ ADRESLERİ ADRES VARSAYILAN MI GET SET START*/
    public function getMusteriAdresleriAdresVarsayilanMi($veriKolonArray)
    {
      $musteriAdresleriAdresVarsayilanMi = $this->selectFilterQuery("tbl_musteri_adresleri",array("musteri_adresleri_adres_varsayilan_mi"),$veriKolonArray);
      $this->musteriAdresleriAdresVarsayilanMi = $musteriAdresleriAdresVarsayilanMi[0]["musteri_adresleri_adres_varsayilan_mi"];
      return $this->musteriAdresleriAdresVarsayilanMi;
    }
    public function setMusteriAdresleriAdresVarsayilanMi($yeniDeger)
    {
      $this->musteriAdresleriAdresVarsayilanMi = $yeniDeger;
    }
    /*MÜŞTERİ ADRESLERİ ADRES VARSAYILAN MI GET SET END*/
  }




?>
