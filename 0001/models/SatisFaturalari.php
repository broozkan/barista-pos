<?php
  /**
   *
   */
  class SatisFaturalari extends Sirket
  {

    public $satisFaturasiIdsi;
    public $satisFaturasiKodu;
    public $satisFaturasiSeriNumarasi;
    public $satisFaturasiVadeTarihi;
    public $satisFaturasiCariIdsi;
    public $satisFaturasiAraToplami;
    public $satisFaturasiIskonto;
    public $satisFaturasiVergiMiktari;
    public $satisFaturasiTutari;
    public $satisFaturasiKasaIdsi;
    public $satisFaturasiOdenmisMiktar;
    public $satisFaturasiAciklamasi;
    public $satisFaturasiKesenKullaniciIdsi;
    public $satisFaturasiKurIdsi;
    public $satisFaturasiTarihi;

    function __construct()
    {
      parent::__construct();
    }

    /*SATIŞ FATURASI ID GET SET START*/
    public function getSatisFaturasiIdsi($veriKolonArray)
    {
      $satisFaturasiIdsi = $this->selectFilterQuery("tbl_satis_faturalari",array("id"),$veriKolonArray);
      $this->satisFaturasiIdsi = $satisFaturasiIdsi[0]["id"];
      return $this->satisFaturasiIdsi;
    }
    public function setSatisFaturasiIdsi($yeniDeger)
    {
      $this->satisFaturasiIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI ID GET SET END*/

    /*SATIŞ FATURASI KODU GET SET START*/
    public function getSatisFaturasiKodu($veriKolonArray)
    {
      $satisFaturasiKodu = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_kodu"),$veriKolonArray);
      $this->satisFaturasiKodu = $satisFaturasiKodu[0]["satis_faturasi_kodu"];
      return $this->satisFaturasiKodu;
    }
    public function setSatisFaturasiKodu($yeniDeger)
    {
      $this->satisFaturasiKodu = $yeniDeger;
    }
    /*SATIŞ FATURASI KODU GET SET END*/

    /*SATIŞ FATURASI SERİ NUMARASI GET SET START*/
    public function getSatisFaturasiSeriNumarasi($veriKolonArray)
    {
      $satisFaturasiSeriNumarasi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_seri_numarasi"),$veriKolonArray);
      $this->satisFaturasiSeriNumarasi = $satisFaturasiSeriNumarasi[0]["satis_faturasi_seri_numarasi"];
      return $this->satisFaturasiSeriNumarasi;
    }
    public function setSatisFaturasiSeriNumarasi($yeniDeger)
    {
      $this->satisFaturasiSeriNumarasi = $yeniDeger;
    }
    /*SATIŞ FATURASI SERİ NUMARASI GET SET END*/

    /*SATIŞ FATURASI VADE TARİHİ GET SET START*/
    public function getSatisFaturasiVadeTarihi($veriKolonArray)
    {
      $satisFaturasiVadeTarihi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_vade_tarihi"),$veriKolonArray);
      $this->satisFaturasiVadeTarihi = $satisFaturasiVadeTarihi[0]["satis_faturasi_vade_tarihi"];
      return $this->satisFaturasiVadeTarihi;
    }
    public function setSatisFaturasiVadeTarihi($yeniDeger)
    {
      $this->satisFaturasiVadeTarihi = $yeniDeger;
    }
    /*SATIŞ FATURASI VADE TARİHİ GET SET END*/

    /*SATIŞ FATURASI CARİ IDSİ GET SET START*/
    public function getSatisFaturasiCariIdsi($veriKolonArray)
    {
      $satisFaturasiCariIdsi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_cari_idsi"),$veriKolonArray);
      $this->satisFaturasiCariIdsi = $satisFaturasiCariIdsi[0]["satis_faturasi_cari_idsi"];
      return $this->satisFaturasiCariIdsi;
    }
    public function setSatisFaturasiCariIdsi($yeniDeger)
    {
      $this->satisFaturasiCariIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI CARİ IDSİ GET SET END*/

    /*SATIŞ FATURASI ARA TOPLAMI GET SET START*/
    public function getSatisFaturasiAraToplami($veriKolonArray)
    {
      $satisFaturasiAraToplami = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_ara_toplami"),$veriKolonArray);
      $this->satisFaturasiAraToplami = $satisFaturasiAraToplami[0]["satis_faturasi_ara_toplami"];
      return $this->satisFaturasiAraToplami;
    }
    public function setSatisFaturasiAraToplami($yeniDeger)
    {
      $this->satisFaturasiAraToplami = $yeniDeger;
    }
    /*SATIŞ FATURASI ARA TOPLAMI GET SET END*/

    /*SATIŞ FATURASI İSKONTO GET SET START*/
    public function getSatisFaturasiIskonto($veriKolonArray)
    {
      $satisFaturasiIskonto = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_iskonto"),$veriKolonArray);
      $this->satisFaturasiIskonto = $satisFaturasiIskonto[0]["satis_faturasi_iskonto"];
      return $this->satisFaturasiIskonto;
    }
    public function setSatisFaturasiIskonto($yeniDeger)
    {
      $this->satisFaturasiIskonto = $yeniDeger;
    }
    /*SATIŞ FATURASI İSKONTO GET SET END*/

    /*SATIŞ FATURASI VERGİ MİKTARI GET SET START*/
    public function getSatisFaturasiVergiMiktari($veriKolonArray)
    {
      $satisFaturasiVergiMiktari = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_vergi_miktari"),$veriKolonArray);
      $this->satisFaturasiVergiMiktari = $satisFaturasiVergiMiktari[0]["satis_faturasi_vergi_miktari"];
      return $this->satisFaturasiVergiMiktari;
    }
    public function setSatisFaturasiVergiMiktari($yeniDeger)
    {
      $this->satisFaturasiVergiMiktari = $yeniDeger;
    }
    /*SATIŞ FATURASI VERGİ MİKTARI GET SET END*/

    /*SATIŞ FATURASI TUTARI GET SET START*/
    public function getSatisFaturasiTutari($veriKolonArray)
    {
      $satisFaturasiTutari = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_tutari"),$veriKolonArray);
      $this->satisFaturasiTutari = $satisFaturasiTutari[0]["satis_faturasi_tutari"];
      return $this->satisFaturasiTutari;
    }
    public function setSatisFaturasiTutari($yeniDeger)
    {
      $this->satisFaturasiTutari = $yeniDeger;
    }
    /*SATIŞ FATURASI TUTARI GET SET END*/

    /*SATIŞ FATURASI KASA IDSİ GET SET START*/
    public function getSatisFaturasiKasaIdsi($veriKolonArray)
    {
      $satisFaturasiKasaIdsi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_kasa_idsi"),$veriKolonArray);
      $this->satisFaturasiKasaIdsi = $satisFaturasiKasaIdsi[0]["satis_faturasi_kasa_idsi"];
      return $this->satisFaturasiKasaIdsi;
    }
    public function setSatisFaturasiKasaIdsi($yeniDeger)
    {
      $this->satisFaturasiKasaIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI KASA IDSİ GET SET END*/

    /*SATIŞ FATURASI ÖDENMİŞ MİKTAR GET SET START*/
    public function getSatisFaturasiOdenmisMiktar($veriKolonArray)
    {
      $satisFaturasiOdenmisMiktar = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_odenmis_miktar"),$veriKolonArray);
      $this->satisFaturasiOdenmisMiktar = $satisFaturasiOdenmisMiktar[0]["satis_faturasi_odenmis_miktar"];
      return $this->satisFaturasiOdenmisMiktar;
    }
    public function setSatisFaturasiOdenmisMiktar($yeniDeger)
    {
      $this->satisFaturasiOdenmisMiktar = $yeniDeger;
    }
    /*SATIŞ FATURASI ÖDENMİŞ MİKTAR GET SET END*/

    /*SATIŞ FATURASI AÇIKLAMASI GET SET START*/
    public function getSatisFaturasiAciklamasi($veriKolonArray)
    {
      $satisFaturasiAciklamasi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_aciklamasi"),$veriKolonArray);
      $this->satisFaturasiAciklamasisi = $satisFaturasiAciklamasi[0]["satis_faturasi_aciklamasi"];
      return $this->satisFaturasiAciklamasi;
    }
    public function setSatisFaturasiAciklamasi($yeniDeger)
    {
      $this->satisFaturasiAciklamasi = $yeniDeger;
    }
    /*SATIŞ FATURASI AÇIKLAMASI GET SET END*/

    /*SATIŞ FATURASI KESEN KULLANICI IDSİ GET SET START*/
    public function getSatisFaturasiKesenKullaniciIdsi($veriKolonArray)
    {
      $satisFaturasiKesenKullaniciIdsi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_kesen_kullanici_idsi"),$veriKolonArray);
      $this->satisFaturasiKesenKullaniciIdsisi = $satisFaturasiKesenKullaniciIdsi[0]["satis_faturasi_kesen_kullanici_idsi"];
      return $this->satisFaturasiKesenKullaniciIdsi;
    }
    public function setSatisFaturasiKesenKullaniciIdsi($yeniDeger)
    {
      $this->satisFaturasiKesenKullaniciIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI KESEN KULLANICI IDSİ GET SET END*/

    /*SATIŞ FATURASI KUR IDSİ GET SET START*/
    public function getSatisFaturasiKurIdsi($veriKolonArray)
    {
      $satisFaturasiKurIdsi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_kur_idsi"),$veriKolonArray);
      $this->satisFaturasiKurIdsi = $satisFaturasiKurIdsi[0]["satis_faturasi_kur_idsi"];
      return $this->satisFaturasiKurIdsi;
    }
    public function setSatisFaturasiKurIdsi($yeniDeger)
    {
      $this->satisFaturasiKurIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI KUR IDSİ GET SET END*/

    /*SATIŞ FATURASI TARİHİ GET SET START*/
    public function getSatisFaturasiTarihi($veriKolonArray)
    {
      $satisFaturasiTarihi = $this->selectFilterQuery("tbl_satis_faturalari",array("satis_faturasi_kesen_tarihi"),$veriKolonArray);
      $this->satisFaturasiTarihisi = $satisFaturasiTarihi[0]["satis_faturasi_tarihi"];
      return $this->satisFaturasiTarihi;
    }
    public function setSatisFaturasiTarihi($yeniDeger)
    {
      $this->satisFaturasiTarihi = $yeniDeger;
    }
    /*SATIŞ FATURASI TARİHİ GET SET END*/

  }

  /**
   *
   */
  class SatisFaturasiUrunleri extends SatisFaturalari
  {

    public $satisFaturasiUrunleriIdsi;
    public $satisFaturasiUrunleriFaturaIdsi;
    public $satisFaturasiUrunleriUrunAdi;
    public $satisFaturasiUrunleriUrunAdedi;
    public $satisFaturasiUrunleriUrunBirimi;
    public $satisFaturasiUrunleriUrunSatisFiyati;
    public $satisFaturasiUrunleriUrunVergiIdsi;
    public $satisFaturasiUrunleriUrunVergiMiktari;
    public $satisFaturasiUrunleriUrunTutari;

    function __construct()
    {
      parent::__construct();
    }


    /*SATIŞ FATURASI ÜRÜNLERİ IDSİ GET SET START*/
    public function getSatisFaturasiUrunleriIdsi($veriKolonArray)
    {
      $satisFaturasiUrunleriIdsi = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("id"),$veriKolonArray);
      $this->satisFaturasiUrunleriIdsi = $satisFaturasiUrunleriIdsi[0]["id"];
      return $this->satisFaturasiUrunleriIdsi;
    }
    public function setSatisFaturasiUrunleriIdsi($yeniDeger)
    {
      $this->satisFaturasiUrunleriIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ IDSİ GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ FATURA IDSİ GET SET START*/
    public function getSatisFaturasiUrunleriFaturaIdsi($veriKolonArray)
    {
      $satisFaturasiUrunleriFaturaIdsi = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_idsi"),$veriKolonArray);
      $this->satisFaturasiUrunleriFaturaIdsi = $satisFaturasiUrunleriFaturaIdsi[0]["satis_faturasi_idsi"];
      return $this->satisFaturasiUrunleriFaturaIdsi;
    }
    public function setSatisFaturasiUrunleriFaturaIdsi($yeniDeger)
    {
      $this->satisFaturasiUrunleriFaturaIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ FATURA IDSİ GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN ADI GET SET START*/
    public function getSatisFaturasiUrunleriUrunAdi($veriKolonArray)
    {
      $satisFaturasiUrunleriUrunAdi = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_urun_adi"),$veriKolonArray);
      $this->satisFaturasiUrunleriUrunAdi = $satisFaturasiUrunleriUrunAdi[0]["satis_faturasi_urun_adi"];
      return $this->satisFaturasiUrunleriUrunAdi;
    }
    public function setSatisFaturasiUrunleriUrunAdi($yeniDeger)
    {
      $this->satisFaturasiUrunleriUrunAdi = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN ADI GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN ADEDİ GET SET START*/
    public function getSatisFaturasiUrunleriUrunAdedi($veriKolonArray)
    {
      $satisFaturasiUrunleriUrunAdedi = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_urun_adedi"),$veriKolonArray);
      $this->satisFaturasiUrunleriUrunAdedi = $satisFaturasiUrunleriUrunAdedi[0]["satis_faturasi_urun_adedi"];
      return $this->satisFaturasiUrunleriUrunAdedi;
    }
    public function setSatisFaturasiUrunleriUrunAdedi($yeniDeger)
    {
      $this->satisFaturasiUrunleriUrunAdedi = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN ADEDİ GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN BİRİMİ GET SET START*/
    public function getSatisFaturasiUrunleriUrunBirimi($veriKolonArray)
    {
      $satisFaturasiUrunleriUrunBirimi = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_urun_birimi"),$veriKolonArray);
      $this->satisFaturasiUrunleriUrunBirimi = $satisFaturasiUrunleriUrunBirimi[0]["satis_faturasi_urun_birimi"];
      return $this->satisFaturasiUrunleriUrunBirimi;
    }
    public function setSatisFaturasiUrunleriUrunBirimi($yeniDeger)
    {
      $this->satisFaturasiUrunleriUrunBirimi = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN BİRİMİ GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN SATIŞ FİYATI GET SET START*/
    public function getSatisFaturasiUrunleriUrunSatisFiyati($veriKolonArray)
    {
      $satisFaturasiUrunleriUrunSatisFiyati = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_urun_satis_fiyati"),$veriKolonArray);
      $this->satisFaturasiUrunleriUrunSatisFiyati = $satisFaturasiUrunleriUrunSatisFiyati[0]["satis_faturasi_urun_satis_fiyati"];
      return $this->satisFaturasiUrunleriUrunSatisFiyati;
    }
    public function setSatisFaturasiUrunleriUrunSatisFiyati($yeniDeger)
    {
      $this->satisFaturasiUrunleriUrunSatisFiyati = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN SATIŞ FİYATI GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ ORANI GET SET START*/
    public function getSatisFaturasiUrunleriUrunVergiIdsi($veriKolonArray)
    {
      $satisFaturasiUrunleriUrunVergiIdsi = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_urun_vergi_idsi"),$veriKolonArray);
      $this->satisFaturasiUrunleriUrunVergiIdsi = $satisFaturasiUrunleriUrunVergiIdsi[0]["satis_faturasi_urun_vergi_idsi"];
      return $this->satisFaturasiUrunleriUrunVergiIdsi;
    }
    public function setSatisFaturasiUrunleriUrunVergiIdsi($yeniDeger)
    {
      $this->satisFaturasiUrunleriUrunVergiIdsi = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ ORANI GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET START*/
    public function getSatisFaturasiUrunleriUrunVergiMiktari($veriKolonArray)
    {
      $satisFaturasiUrunleriUrunVergiMiktari = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_urun_vergi_miktari"),$veriKolonArray);
      $this->satisFaturasiUrunleriUrunVergiMiktari = $satisFaturasiUrunleriUrunVergiMiktari[0]["satis_faturasi_urun_vergi_miktari"];
      return $this->satisFaturasiUrunleriUrunVergiMiktari;
    }
    public function setSatisFaturasiUrunleriUrunVergiMiktari($yeniDeger)
    {
      $this->satisFaturasiUrunleriUrunVergiMiktari = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET END*/


    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN TUTARI GET SET START*/
    public function getSatisFaturasiUrunleriUrunTutari($veriKolonArray)
    {
      $satisFaturasiUrunleriUrunTutari = $this->selectFilterQuery("tbl_satis_faturasi_urunleri",array("satis_faturasi_urun_tutari"),$veriKolonArray);
      $this->satisFaturasiUrunleriUrunTutari = $satisFaturasiUrunleriUrunTutari[0]["satis_faturasi_urun_tutari"];
      return $this->satisFaturasiUrunleriUrunTutari;
    }
    public function setSatisFaturasiUrunleriUrunTutari($yeniDeger)
    {
      $this->satisFaturasiUrunleriUrunTutari = $yeniDeger;
    }
    /*SATIŞ FATURASI ÜRÜNLERİ ÜRÜN TUTARI GET SET END*/
  }




?>
