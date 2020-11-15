<?php
/**
*
*/
class Yazicilar extends Sirket
{

  public $yaziciId;
  public $yaziciAdi;
  public $yaziciIpAdresi;

  function __construct()
  {
    parent::__construct();
  }

  /*YAZICI ID GET SET START*/
  public function getYaziciId($veriKolonArray)
  {
    $yaziciId = $this->selectFilterQuery("tbl_yazicilar",array("id"),$veriKolonArray);
    $this->yaziciId = $yaziciId[0]["id"];
    return $this->yaziciId;
  }
  public function setYaziciId($yeniDeger)
  {
    $this->yaziciId = $yeniDeger;
  }
  /*YAZICI ID GET SET END*/


  /*YAZICI ADI GET SET START*/
  public function getYaziciAdi($veriKolonArray)
  {
    $yaziciAdi = $this->selectFilterQuery("tbl_yazicilar",array("yazici_adi"),$veriKolonArray);
    $this->yaziciAdi = $yaziciAdi[0]["yazici_adi"];
    return $this->yaziciAdi;
  }
  public function setYaziciAdi($yeniDeger)
  {
    $this->yaziciAdi = $yeniDeger;
  }
  /*YAZICI ADI GET SET END*/


  /*YAZICI IP ADRESİ GET SET START*/
  public function getYaziciIpAdresi($veriKolonArray)
  {
    $yaziciIpAdresi = $this->selectFilterQuery("tbl_yazicilar",array("yazici_ip_adresi"),$veriKolonArray);
    $this->yaziciIpAdresi = $yaziciIpAdresi[0]["yazici_ip_adresi"];
    return $this->yaziciIpAdresi;
  }
  public function setYaziciIpAdresi($yeniDeger)
  {
    $this->yaziciIpAdresi = $yeniDeger;
  }
  /*YAZICI IP ADRESİ GET SET END*/

}

/**
*
*/
class YazdirmaAyarlari extends Yazicilar
{

  public $yazdirmaAyarlariIdsi;
  public $yazdirmaAyarlariMasaAdiGorunsunMu;
  public $yazdirmaAyarlariAdisyonNoGorunsunMu;
  public $yazdirmaAyarlariMusteriAdiGorunsunMu;
  public $yazdirmaAyarlariAdisyonAltYazi;
  public $yazdirmaAyarlariHizliSatisOtoYazdir;

  function __construct()
  {
    parent::__construct();
  }


  /*YAZDIRMA AYARLARI IDSİ GET SET START*/
  public function getYazdirmaAyarlariIdsi($veriKolonArray)
  {
    $yazdirmaAyarlariIdsi = $this->selectFilterQuery("tbl_yazdirma_ayarlari",array("id"),$veriKolonArray);
    $this->yazdirmaAyarlariIdsi = $yazdirmaAyarlariIdsi[0]["id"];
    return $this->yazdirmaAyarlariIdsi;
  }
  public function setYazdirmaAyarlariIdsi($yeniDeger)
  {
    $this->yazdirmaAyarlariIdsi = $yeniDeger;
  }
  /*YAZDIRMA AYARLARI IDSİ GET SET END*/


  /*YAZDIRMA AYARLARI MASA ADI GÖRÜNSÜN MÜ GET SET START*/
  public function getYazdirmaAyarlariMasaAdiGorunsunMu($veriKolonArray)
  {
    $yazdirmaAyarlariMasaAdiGorunsunMu = $this->selectFilterQuery("tbl_yazdirma_ayarlari",array("yazdirma_ayarlari_masa_adi_gorunsun_mu"),$veriKolonArray);
    $this->yazdirmaAyarlariMasaAdiGorunsunMu = $yazdirmaAyarlariMasaAdiGorunsunMu[0]["yazdirma_ayarlari_masa_adi_gorunsun_mu"];
    return $this->yazdirmaAyarlariMasaAdiGorunsunMu;
  }
  public function setYazdirmaAyarlariMasaAdiGorunsunMu($yeniDeger)
  {
    $this->yazdirmaAyarlariMasaAdiGorunsunMu = $yeniDeger;
  }
  /*YAZDIRMA AYARLARI MASA ADI GÖRÜNSÜN MÜ GET SET END*/


  /*YAZDIRMA AYARLARI ADİSYON NO GÖRÜNSÜN MÜ GET SET START*/
  public function getYazdirmaAyarlariAdisyonNoGorunsunMu($veriKolonArray)
  {
    $yazdirmaAyarlariAdisyonNoGorunsunMu = $this->selectFilterQuery("tbl_yazdirma_ayarlari",array("yazdirma_ayarlari_adisyon_no_gorunsun_mu"),$veriKolonArray);
    $this->yazdirmaAyarlariAdisyonNoGorunsunMu = $yazdirmaAyarlariAdisyonNoGorunsunMu[0]["yazdirma_ayarlari_adisyon_no_gorunsun_mu"];
    return $this->yazdirmaAyarlariAdisyonNoGorunsunMu;
  }
  public function setYazdirmaAyarlariAdisyonNoGorunsunMu($yeniDeger)
  {
    $this->yazdirmaAyarlariAdisyonNoGorunsunMu = $yeniDeger;
  }
  /*YAZDIRMA AYARLARI ADİSYON NO GÖRÜNSÜN MÜ GET SET END*/


  /*YAZDIRMA AYARLARI MÜŞTERİ ADI GÖRÜNSÜN MÜ GET SET START*/
  public function getYazdirmaAyarlariMusteriAdiGorunsunMu($veriKolonArray)
  {
    $yazdirmaAyarlariMusteriAdiGorunsunMu = $this->selectFilterQuery("tbl_yazdirma_ayarlari",array("yazdirma_ayarlari_musteri_adi_gorunsun_mu"),$veriKolonArray);
    $this->yazdirmaAyarlariMusteriAdiGorunsunMu = $yazdirmaAyarlariMusteriAdiGorunsunMu[0]["yazdirma_ayarlari_musteri_adi_gorunsun_mu"];
    return $this->yazdirmaAyarlariMusteriAdiGorunsunMu;
  }
  public function setYazdirmaAyarlariMusteriAdiGorunsunMu($yeniDeger)
  {
    $this->yazdirmaAyarlariMusteriAdiGorunsunMu = $yeniDeger;
  }
  /*YAZDIRMA AYARLARI MÜŞTERİ ADI GÖRÜNSÜN MÜ GET SET END*/


  /*YAZDIRMA AYARLARI ADİSYON ALT YAZI GÖRÜNSÜN MÜ GET SET START*/
  public function getYazdirmaAyarlariAdisyonAltYazi($veriKolonArray)
  {
    $yazdirmaAyarlariAdisyonAltYazi = $this->selectFilterQuery("tbl_yazdirma_ayarlari",array("yazdirma_ayarlari_adisyon_alt_yazi"),$veriKolonArray);
    $this->yazdirmaAyarlariAdisyonAltYazi = $yazdirmaAyarlariAdisyonAltYazi[0]["yazdirma_ayarlari_adisyon_alt_yazi"];
    return $this->yazdirmaAyarlariAdisyonAltYazi;
  }
  public function setYazdirmaAyarlariAdisyonAltYazi($yeniDeger)
  {
    $this->yazdirmaAyarlariAdisyonAltYazi = $yeniDeger;
  }
  /*YAZDIRMA AYARLARI ADİSYON ALT YAZI GÖRÜNSÜN MÜ GET SET END*/


  /*YAZDIRMA AYARLARI HIZLI SATIS OTO YAZDIR GET SET START*/
  public function getYazdirmaAyarlariHizliSatisOtoYazdir($veriKolonArray)
  {
    $yazdirmaAyarlariHizliSatisOtoYazdir = $this->selectFilterQuery("tbl_yazdirma_ayarlari",array("yazdirma_ayarlari_hizli_satis_oto_yazdir"),$veriKolonArray);
    $this->yazdirmaAyarlariHizliSatisOtoYazdir = $yazdirmaAyarlariHizliSatisOtoYazdir[0]["yazdirma_ayarlari_hizli_satis_oto_yazdir"];
    return $this->yazdirmaAyarlariHizliSatisOtoYazdir;
  }
  public function setYazdirmaAyarlariHizliSatisOtoYazdir($yeniDeger)
  {
    $this->yazdirmaAyarlariHizliSatisOtoYazdir = $yeniDeger;
  }
  /*YAZDIRMA AYARLARI HIZLI SATIS OTO YAZDIR GET SET END*/

}





?>
