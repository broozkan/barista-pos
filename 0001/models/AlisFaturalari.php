<?php
  /**
   *
   */
  class AlisFaturalari extends Sirket
  {

    public $alisFaturasiIdsi;
    public $alisFaturasiKodu;
    public $alisFaturasiSeriNumarasi;
    public $alisFaturasiVadeTarihi;
    public $alisFaturasiCariIdsi;
    public $alisFaturasiAraToplami;
    public $alisFaturasiIskonto;
    public $alisFaturasiVergiMiktari;
    public $alisFaturasiTutari;
    public $alisFaturasiKasaIdsi;
    public $alisFaturasiOdenmisMiktar;
    public $alisFaturasiAciklamasi;
    public $alisFaturasiKesenKullaniciIdsi;
    public $alisFaturasiKurIdsi;
    public $alisFaturasiTarihi;

    function __construct()
    {
      parent::__construct();
    }

    /*ALIŞ FATURASI ID GET SET START*/
    public function getAlisFaturasiIdsi($veriKolonArray)
    {
      $alisFaturasiIdsi = $this->selectFilterQuery("tbl_alis_faturalari",array("id"),$veriKolonArray);
      $this->alisFaturasiIdsi = $alisFaturasiIdsi[0]["id"];
      return $this->alisFaturasiIdsi;
    }
    public function setAlisFaturasiIdsi($yeniDeger)
    {
      $this->alisFaturasiIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI ID GET SET END*/

    /*ALIŞ FATURASI KODU GET SET START*/
    public function getAlisFaturasiKodu($veriKolonArray)
    {
      $alisFaturasiKodu = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_kodu"),$veriKolonArray);
      $this->alisFaturasiKodu = $alisFaturasiKodu[0]["alis_faturasi_kodu"];
      return $this->alisFaturasiKodu;
    }
    public function setAlisFaturasiKodu($yeniDeger)
    {
      $this->alisFaturasiKodu = $yeniDeger;
    }
    /*ALIŞ FATURASI KODU GET SET END*/

    /*ALIŞ FATURASI SERİ NUMARASI GET SET START*/
    public function getAlisFaturasiSeriNumarasi($veriKolonArray)
    {
      $alisFaturasiSeriNumarasi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_seri_numarasi"),$veriKolonArray);
      $this->alisFaturasiSeriNumarasi = $alisFaturasiSeriNumarasi[0]["alis_faturasi_seri_numarasi"];
      return $this->alisFaturasiSeriNumarasi;
    }
    public function setAlisFaturasiSeriNumarasi($yeniDeger)
    {
      $this->alisFaturasiSeriNumarasi = $yeniDeger;
    }
    /*ALIŞ FATURASI SERİ NUMARASI GET SET END*/

    /*ALIŞ FATURASI VADE TARİHİ GET SET START*/
    public function getAlisFaturasiVadeTarihi($veriKolonArray)
    {
      $alisFaturasiVadeTarihi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_vade_tarihi"),$veriKolonArray);
      $this->alisFaturasiVadeTarihi = $alisFaturasiVadeTarihi[0]["alis_faturasi_vade_tarihi"];
      return $this->alisFaturasiVadeTarihi;
    }
    public function setAlisFaturasiVadeTarihi($yeniDeger)
    {
      $this->alisFaturasiVadeTarihi = $yeniDeger;
    }
    /*ALIŞ FATURASI VADE TARİHİ GET SET END*/

    /*ALIŞ FATURASI CARİ IDSİ GET SET START*/
    public function getAlisFaturasiCariIdsi($veriKolonArray)
    {
      $alisFaturasiCariIdsi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_cari_idsi"),$veriKolonArray);
      $this->alisFaturasiCariIdsi = $alisFaturasiCariIdsi[0]["alis_faturasi_cari_idsi"];
      return $this->alisFaturasiCariIdsi;
    }
    public function setAlisFaturasiCariIdsi($yeniDeger)
    {
      $this->alisFaturasiCariIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI CARİ IDSİ GET SET END*/

    /*ALIŞ FATURASI ARA TOPLAMI GET SET START*/
    public function getAlisFaturasiAraToplami($veriKolonArray)
    {
      $alisFaturasiAraToplami = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_ara_toplami"),$veriKolonArray);
      $this->alisFaturasiAraToplami = $alisFaturasiAraToplami[0]["alis_faturasi_ara_toplami"];
      return $this->alisFaturasiAraToplami;
    }
    public function setAlisFaturasiAraToplami($yeniDeger)
    {
      $this->alisFaturasiAraToplami = $yeniDeger;
    }
    /*ALIŞ FATURASI ARA TOPLAMI GET SET END*/

    /*ALIŞ FATURASI İSKONTO GET SET START*/
    public function getAlisFaturasiIskonto($veriKolonArray)
    {
      $alisFaturasiIskonto = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_iskonto"),$veriKolonArray);
      $this->alisFaturasiIskonto = $alisFaturasiIskonto[0]["alis_faturasi_iskonto"];
      return $this->alisFaturasiIskonto;
    }
    public function setAlisFaturasiIskonto($yeniDeger)
    {
      $this->alisFaturasiIskonto = $yeniDeger;
    }
    /*ALIŞ FATURASI İSKONTO GET SET END*/

    /*ALIŞ FATURASI VERGİ MİKTARI GET SET START*/
    public function getAlisFaturasiVergiMiktari($veriKolonArray)
    {
      $alisFaturasiVergiMiktari = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_vergi_miktari"),$veriKolonArray);
      $this->alisFaturasiVergiMiktari = $alisFaturasiVergiMiktari[0]["alis_faturasi_vergi_miktari"];
      return $this->alisFaturasiVergiMiktari;
    }
    public function setAlisFaturasiVergiMiktari($yeniDeger)
    {
      $this->alisFaturasiVergiMiktari = $yeniDeger;
    }
    /*ALIŞ FATURASI VERGİ MİKTARI GET SET END*/

    /*ALIŞ FATURASI TUTARI GET SET START*/
    public function getAlisFaturasiTutari($veriKolonArray)
    {
      $alisFaturasiTutari = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_tutari"),$veriKolonArray);
      $this->alisFaturasiTutari = $alisFaturasiTutari[0]["alis_faturasi_tutari"];
      return $this->alisFaturasiTutari;
    }
    public function setAlisFaturasiTutari($yeniDeger)
    {
      $this->alisFaturasiTutari = $yeniDeger;
    }
    /*ALIŞ FATURASI TUTARI GET SET END*/

    /*ALIŞ FATURASI KASA IDSİ GET SET START*/
    public function getAlisFaturasiKasaIdsi($veriKolonArray)
    {
      $alisFaturasiKasaIdsi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_kasa_idsi"),$veriKolonArray);
      $this->alisFaturasiKasaIdsi = $alisFaturasiKasaIdsi[0]["alis_faturasi_kasa_idsi"];
      return $this->alisFaturasiKasaIdsi;
    }
    public function setAlisFaturasiKasaIdsi($yeniDeger)
    {
      $this->alisFaturasiKasaIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI KASA IDSİ GET SET END*/

    /*ALIŞ FATURASI ÖDENMİŞ MİKTAR GET SET START*/
    public function getAlisFaturasiOdenmisMiktar($veriKolonArray)
    {
      $alisFaturasiOdenmisMiktar = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_odenmis_miktar"),$veriKolonArray);
      $this->alisFaturasiOdenmisMiktar = $alisFaturasiOdenmisMiktar[0]["alis_faturasi_odenmis_miktar"];
      return $this->alisFaturasiOdenmisMiktar;
    }
    public function setAlisFaturasiOdenmisMiktar($yeniDeger)
    {
      $this->alisFaturasiOdenmisMiktar = $yeniDeger;
    }
    /*ALIŞ FATURASI ÖDENMİŞ MİKTAR GET SET END*/

    /*ALIŞ FATURASI AÇIKLAMASI GET SET START*/
    public function getAlisFaturasiAciklamasi($veriKolonArray)
    {
      $alisFaturasiAciklamasi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_aciklamasi"),$veriKolonArray);
      $this->alisFaturasiAciklamasi = $alisFaturasiAciklamasi[0]["alis_faturasi_aciklamasi"];
      return $this->alisFaturasiAciklamasi;
    }
    public function setAlisFaturasiAciklamasi($yeniDeger)
    {
      $this->alisFaturasiAciklamasi = $yeniDeger;
    }
    /*ALIŞ FATURASI AÇIKLAMASI GET SET END*/

    /*ALIŞ FATURASI KESEN KULLANICI IDSİ GET SET START*/
    public function getAlisFaturasiKesenKullaniciIdsi($veriKolonArray)
    {
      $alisFaturasiKesenKullaniciIdsi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_kesen_kullanici_idsi"),$veriKolonArray);
      $this->alisFaturasiKesenKullaniciIdsisi = $alisFaturasiKesenKullaniciIdsi[0]["alis_faturasi_kesen_kullanici_idsi"];
      return $this->alisFaturasiKesenKullaniciIdsi;
    }
    public function setAlisFaturasiKesenKullaniciIdsi($yeniDeger)
    {
      $this->alisFaturasiKesenKullaniciIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI KESEN KULLANICI IDSİ GET SET END*/

    /*ALIŞ FATURASI KUR IDSİ GET SET START*/
    public function getAlisFaturasiKurIdsi($veriKolonArray)
    {
      $alisFaturasiKurIdsi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_kur_idsi"),$veriKolonArray);
      $this->alisFaturasiKurIdsi = $alisFaturasiKurIdsi[0]["alis_faturasi_kur_idsi"];
      return $this->alisFaturasiKurIdsi;
    }
    public function setAlisFaturasiKurIdsi($yeniDeger)
    {
      $this->alisFaturasiKurIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI KUR IDSİ GET SET END*/

    /*ALIŞ FATURASI TARİHİ GET SET START*/
    public function getAlisFaturasiTarihi($veriKolonArray)
    {
      $alisFaturasiTarihi = $this->selectFilterQuery("tbl_alis_faturalari",array("alis_faturasi_kesen_tarihi"),$veriKolonArray);
      $this->alisFaturasiTarihisi = $alisFaturasiTarihi[0]["alis_faturasi_tarihi"];
      return $this->alisFaturasiTarihi;
    }
    public function setAlisFaturasiTarihi($yeniDeger)
    {
      $this->alisFaturasiTarihi = $yeniDeger;
    }
    /*ALIŞ FATURASI TARİHİ GET SET END*/

  }

  /**
   *
   */
  class AlisFaturasiUrunleri extends AlisFaturalari
  {

    public $alisFaturasiUrunleriIdsi;
    public $alisFaturasiUrunleriFaturaIdsi;
    public $alisFaturasiUrunleriUrunAdi;
    public $alisFaturasiUrunleriUrunAdedi;
    public $alisFaturasiUrunleriUrunBirimi;
    public $alisFaturasiUrunleriUrunAlisFiyati;
    public $alisFaturasiUrunleriUrunVergiIdsi;
    public $alisFaturasiUrunleriUrunVergiMiktari;
    public $alisFaturasiUrunleriUrunTutari;

    function __construct()
    {
      parent::__construct();
    }


    /*ALIŞ FATURASI ÜRÜNLERİ IDSİ GET SET START*/
    public function getAlisFaturasiUrunleriIdsi($veriKolonArray)
    {
      $alisFaturasiUrunleriIdsi = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("id"),$veriKolonArray);
      $this->alisFaturasiUrunleriIdsi = $alisFaturasiUrunleriIdsi[0]["id"];
      return $this->alisFaturasiUrunleriIdsi;
    }
    public function setAlisFaturasiUrunleriIdsi($yeniDeger)
    {
      $this->alisFaturasiUrunleriIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ IDSİ GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ FATURA IDSİ GET SET START*/
    public function getAlisFaturasiUrunleriFaturaIdsi($veriKolonArray)
    {
      $alisFaturasiUrunleriFaturaIdsi = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_idsi"),$veriKolonArray);
      $this->alisFaturasiUrunleriFaturaIdsi = $alisFaturasiUrunleriFaturaIdsi[0]["alis_faturasi_idsi"];
      return $this->alisFaturasiUrunleriFaturaIdsi;
    }
    public function setAlisFaturasiUrunleriFaturaIdsi($yeniDeger)
    {
      $this->alisFaturasiUrunleriFaturaIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ FATURA IDSİ GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN ADI GET SET START*/
    public function getAlisFaturasiUrunleriUrunAdi($veriKolonArray)
    {
      $alisFaturasiUrunleriUrunAdi = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_urun_adi"),$veriKolonArray);
      $this->alisFaturasiUrunleriUrunAdi = $alisFaturasiUrunleriUrunAdi[0]["alis_faturasi_urun_adi"];
      return $this->alisFaturasiUrunleriUrunAdi;
    }
    public function setAlisFaturasiUrunleriUrunAdi($yeniDeger)
    {
      $this->alisFaturasiUrunleriUrunAdi = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN ADI GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN ADEDİ GET SET START*/
    public function getAlisFaturasiUrunleriUrunAdedi($veriKolonArray)
    {
      $alisFaturasiUrunleriUrunAdedi = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_urun_adedi"),$veriKolonArray);
      $this->alisFaturasiUrunleriUrunAdedi = $alisFaturasiUrunleriUrunAdedi[0]["alis_faturasi_urun_adedi"];
      return $this->alisFaturasiUrunleriUrunAdedi;
    }
    public function setAlisFaturasiUrunleriUrunAdedi($yeniDeger)
    {
      $this->alisFaturasiUrunleriUrunAdedi = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN ADEDİ GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN BİRİMİ GET SET START*/
    public function getAlisFaturasiUrunleriUrunBirimi($veriKolonArray)
    {
      $alisFaturasiUrunleriUrunBirimi = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_urun_birimi"),$veriKolonArray);
      $this->alisFaturasiUrunleriUrunBirimi = $alisFaturasiUrunleriUrunBirimi[0]["alis_faturasi_urun_birimi"];
      return $this->alisFaturasiUrunleriUrunBirimi;
    }
    public function setAlisFaturasiUrunleriUrunBirimi($yeniDeger)
    {
      $this->alisFaturasiUrunleriUrunBirimi = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN BİRİMİ GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN ALIŞ FİYATI GET SET START*/
    public function getAlisFaturasiUrunleriUrunAlisFiyati($veriKolonArray)
    {
      $alisFaturasiUrunleriUrunAlisFiyati = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_urun_alis_fiyati"),$veriKolonArray);
      $this->alisFaturasiUrunleriUrunAlisFiyati = $alisFaturasiUrunleriUrunAlisFiyati[0]["alis_faturasi_urun_alis_fiyati"];
      return $this->alisFaturasiUrunleriUrunAlisFiyati;
    }
    public function setAlisFaturasiUrunleriUrunAlisFiyati($yeniDeger)
    {
      $this->alisFaturasiUrunleriUrunAlisFiyati = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN ALIŞ FİYATI GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ ORANI GET SET START*/
    public function getAlisFaturasiUrunleriUrunVergiIdsi($veriKolonArray)
    {
      $alisFaturasiUrunleriUrunVergiIdsi = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_urun_vergi_idsi"),$veriKolonArray);
      $this->alisFaturasiUrunleriUrunVergiIdsi = $alisFaturasiUrunleriUrunVergiIdsi[0]["alis_faturasi_urun_vergi_idsi"];
      return $this->alisFaturasiUrunleriUrunVergiIdsi;
    }
    public function setAlisFaturasiUrunleriUrunVergiIdsi($yeniDeger)
    {
      $this->alisFaturasiUrunleriUrunVergiIdsi = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ ORANI GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET START*/
    public function getAlisFaturasiUrunleriUrunVergiMiktari($veriKolonArray)
    {
      $alisFaturasiUrunleriUrunVergiMiktari = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_urun_vergi_miktari"),$veriKolonArray);
      $this->alisFaturasiUrunleriUrunVergiMiktari = $alisFaturasiUrunleriUrunVergiMiktari[0]["alis_faturasi_urun_vergi_miktari"];
      return $this->alisFaturasiUrunleriUrunVergiMiktari;
    }
    public function setAlisFaturasiUrunleriUrunVergiMiktari($yeniDeger)
    {
      $this->alisFaturasiUrunleriUrunVergiMiktari = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET END*/


    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN TUTARI GET SET START*/
    public function getAlisFaturasiUrunleriUrunTutari($veriKolonArray)
    {
      $alisFaturasiUrunleriUrunTutari = $this->selectFilterQuery("tbl_alis_faturasi_urunleri",array("alis_faturasi_urun_tutari"),$veriKolonArray);
      $this->alisFaturasiUrunleriUrunTutari = $alisFaturasiUrunleriUrunTutari[0]["alis_faturasi_urun_tutari"];
      return $this->alisFaturasiUrunleriUrunTutari;
    }
    public function setAlisFaturasiUrunleriUrunTutari($yeniDeger)
    {
      $this->alisFaturasiUrunleriUrunTutari = $yeniDeger;
    }
    /*ALIŞ FATURASI ÜRÜNLERİ ÜRÜN TUTARI GET SET END*/
  }




?>
