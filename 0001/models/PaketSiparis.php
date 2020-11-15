<?php
  /**
   *
   */
  class PaketSiparisler extends Sirket
  {

    public $paketSiparisIdsi;
    public $paketSiparisAcilisSaati;
    public $paketSiparisNotu;
    public $paketSiparisTutari;
    public $paketSiparisMusteriIdsi;
    public $paketSiparisIndirimTuru;
    public $paketSiparisIndirimMiktari;

    function __construct()
    {
      parent::__construct();
    }

    /*PAKET SİPARİŞ IDSİ GET SET START*/
    public function getPaketSiparisIdsi($veriKolonArray)
    {
      $paketSiparisIdsi = $this->selectFilterQuery("tbl_paket_siparisler",array("id"),$veriKolonArray);
      $this->paketSiparisIdsi = $paketSiparisIdsi[0]["id"];
      return $this->paketSiparisIdsi;
    }
    public function setPaketSiparisIdsi($yeniDeger)
    {
      $this->paketSiparisIdsi = $yeniDeger;
    }
    /*PAKET SİPARİŞ IDSİ GET SET END*/

    /*PAKET SİPARİŞ AÇILIŞ SAATİ GET SET START*/
      public function getPaketSiparisAcilisSaati($veriKolonArray)
    {
      $paketSiparisAcilisSaati = $this->selectFilterQuery("tbl_paket_siparisler",array("paket_siparis_acilis_saati"),$veriKolonArray);
      $this->paketSiparisAcilisSaati = $paketSiparisAcilisSaati[0]["paket_siparis_acilis_saati"];
      return $this->paketSiparisAcilisSaati;
    }
    public function setPaketSiparisAcilisSaati($yeniDeger)
    {
      $this->paketSiparisAcilisSaati = $yeniDeger;
    }
    /*PAKET SİPARİŞ AÇILIŞ SAATİ GET SET END*/

    /*PAKET SİPARİŞ NOTU GET SET START*/
      public function getPaketSiparisNotu($veriKolonArray)
    {
      $paketSiparisNotu = $this->selectFilterQuery("tbl_paket_siparisler",array("paket_siparis_notu"),$veriKolonArray);
      $this->paketSiparisNotu = $paketSiparisNotu[0]["paket_siparis_notu"];
      return $this->paketSiparisNotu;
    }
    public function setPaketSiparisNotu($yeniDeger)
    {
      $this->paketSiparisNotu = $yeniDeger;
    }
    /*PAKET SİPARİŞ NOTU GET SET END*/

    /*PAKET SİPARİŞ TUTARI GET SET START*/
      public function getPaketSiparisTutari($veriKolonArray)
    {
      $paketSiparisTutari = $this->selectFilterQuery("tbl_paket_siparisler",array("paket_siparis_tutari"),$veriKolonArray);
      $this->paketSiparisTutari = $paketSiparisTutari[0]["paket_siparis_tutari"];
      return $this->paketSiparisTutari;
    }
    public function setPaketSiparisTutari($yeniDeger)
    {
      $this->paketSiparisTutari = $yeniDeger;
    }
    /*PAKET SİPARİŞ TUTARI GET SET END*/

    /*PAKET SİPARİŞ MÜŞTERİ IDSİ GET SET START*/
      public function getPaketSiparisMusteriIdsi($veriKolonArray)
    {
      $paketSiparisMusteriIdsi = $this->selectFilterQuery("tbl_paket_siparisler",array("paket_siparis_musteri_idsi"),$veriKolonArray);
      $this->paketSiparisMusteriIdsi = $paketSiparisMusteriIdsi[0]["paket_siparis_musteri_idsi"];
      return $this->paketSiparisMusteriIdsi;
    }
    public function setPaketSiparisMusteriIdsi($yeniDeger)
    {
      $this->paketSiparisMusteriIdsi = $yeniDeger;
    }
    /*PAKET SİPARİŞ MÜŞTERİ IDSİ GET SET END*/

    /*PAKET SİPARİŞ İNDİRİM TÜRÜ GET SET START*/
      public function getPaketSiparisIndirimTuru($veriKolonArray)
    {
      $paketSiparisIndirimTuru = $this->selectFilterQuery("tbl_paket_siparisler",array("paket_siparis_indirim_turu"),$veriKolonArray);
      $this->paketSiparisIndirimTuru = $paketSiparisIndirimTuru[0]["paket_siparis_indirim_turu"];
      return $this->paketSiparisIndirimTuru;
    }
    public function setPaketSiparisIndirimTuru($yeniDeger)
    {
      $this->paketSiparisIndirimTuru = $yeniDeger;
    }
    /*PAKET SİPARİŞ İNDİRİM TÜRÜ GET SET END*/

    /*PAKET SİPARİŞ İNDİRİM MİKTARI GET SET START*/
      public function getPaketSiparisIndirimMiktari($veriKolonArray)
    {
      $paketSiparisIndirimMiktari = $this->selectFilterQuery("tbl_paket_siparisler",array("paket_siparis_indirim_miktari"),$veriKolonArray);
      $this->paketSiparisIndirimMiktari = $paketSiparisIndirimMiktari[0]["paket_siparis_indirim_miktari"];
      return $this->paketSiparisIndirimMiktari;
    }
    public function setPaketSiparisIndirimMiktari($yeniDeger)
    {
      $this->paketSiparisIndirimMiktari = $yeniDeger;
    }
    /*PAKET SİPARİŞ İNDİRİM MİKTARI GET SET END*/


  }


  /**
   *
   */
  class PaketSiparisUrunleri extends PaketSiparisler
  {
    public $paketSiparisUrunleriIdsi;
    public $paketSiparisUrunleriPaketSiparisIdsi;
    public $paketSiparisUrunleriUrunIdsi;
    public $paketSiparisUrunleriUrunTabloAdi;
    public $paketSiparisUrunleriUrunAdedi;
    public $paketSiparisUrunleriUrunBirimFiyati;
    public $paketSiparisUrunleriUrunToplamFiyati;
    public $paketSiparisUrunleriUrunVergiMiktari;
    public $paketSiparisUrunleriUrunOzelDurumuIdsi;
    public $paketSiparisUrunleriUrunNotu;
    public $paketSiparisUrunleriUrunSiparisSaati;


    function __construct()
    {
      parent::__construct();
    }

    /*PAKET SİPARİŞ ÜRÜNLERİ IDSİ GET SET START*/
      public function getPaketSiparisUrunleriIdsi($veriKolonArray)
    {
      $paketSiparisUrunleriIdsi = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("id"),$veriKolonArray);
      $this->paketSiparisUrunleriIdsi = $paketSiparisUrunleriIdsi[0]["id"];
      return $this->paketSiparisUrunleriIdsi;
    }
    public function setPaketSiparisUrunleriIdsi($yeniDeger)
    {
      $this->paketSiparisUrunleriIdsi = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ IDSİ GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ PAKET SİPARİŞ İDSİ GET SET START*/
      public function getPaketSiparisUrunleriPaketSiparisIdsi($veriKolonArray)
    {
      $paketSiparisUrunleriPaketSiparisIdsi = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_paket_siparis_idsi"),$veriKolonArray);
      $this->paketSiparisUrunleriPaketSiparisIdsi = $paketSiparisUrunleriPaketSiparisIdsi[0]["paket_siparis_urunleri_paket_siparis_idsi"];
      return $this->paketSiparisUrunleriPaketSiparisIdsi;
    }
    public function setPaketSiparisUrunleriPaketSiparisIdsi($yeniDeger)
    {
      $this->paketSiparisUrunleriPaketSiparisIdsi = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ PAKET SİPARİŞ İDSİ GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN İDSİ GET SET START*/
      public function getPaketSiparisUrunleriUrunIdsi($veriKolonArray)
    {
      $paketSiparisUrunleriUrunIdsi = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_idsi"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunIdsi = $paketSiparisUrunleriUrunIdsi[0]["paket_siparis_urunleri_urun_idsi"];
      return $this->paketSiparisUrunleriUrunIdsi;
    }
    public function setPaketSiparisUrunleriUrunIdsi($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunIdsi = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN İDSİ GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN TABLO ADI GET SET START*/
      public function getPaketSiparisUrunleriUrunTabloAdi($veriKolonArray)
    {
      $paketSiparisUrunleriUrunTabloAdi = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_tablo_adi"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunTabloAdi = $paketSiparisUrunleriUrunTabloAdi[0]["paket_siparis_urunleri_urun_tablo_adi"];
      return $this->paketSiparisUrunleriUrunTabloAdi;
    }
    public function setPaketSiparisUrunleriUrunTabloAdi($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunTabloAdi = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN TABLO ADI GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN ADEDİ GET SET START*/
      public function getPaketSiparisUrunleriUrunAdedi($veriKolonArray)
    {
      $paketSiparisUrunleriUrunAdedi = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_adedi"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunAdedi = $paketSiparisUrunleriUrunAdedi[0]["paket_siparis_urunleri_urun_adedi"];
      return $this->paketSiparisUrunleriUrunAdedi;
    }
    public function setPaketSiparisUrunleriUrunAdedi($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunAdedi = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN ADEDİ GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN BİRİM FİYATI GET SET START*/
      public function getPaketSiparisUrunleriUrunBirimFiyati($veriKolonArray)
    {
      $paketSiparisUrunleriUrunBirimFiyati = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_birim_fiyati"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunBirimFiyati = $paketSiparisUrunleriUrunBirimFiyati[0]["paket_siparis_urunleri_urun_birim_fiyati"];
      return $this->paketSiparisUrunleriUrunBirimFiyati;
    }
    public function setPaketSiparisUrunleriUrunBirimFiyati($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunBirimFiyati = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN BİRİM FİYATI GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN TOPLAM FİYATI GET SET START*/
      public function getPaketSiparisUrunleriUrunToplamFiyati($veriKolonArray)
    {
      $paketSiparisUrunleriUrunToplamFiyati = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_toplam_fiyati"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunToplamFiyati = $paketSiparisUrunleriUrunToplamFiyati[0]["paket_siparis_urunleri_urun_toplam_fiyati"];
      return $this->paketSiparisUrunleriUrunToplamFiyati;
    }
    public function setPaketSiparisUrunleriUrunToplamFiyati($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunToplamFiyati = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN TOPLAM FİYATI GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET START*/
      public function getPaketSiparisUrunleriUrunVergiMiktari($veriKolonArray)
    {
      $paketSiparisUrunleriUrunVergiMiktari = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_vergi_miktari"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunVergiMiktari = $paketSiparisUrunleriUrunVergiMiktari[0]["paket_siparis_urunleri_urun_vergi_miktari"];
      return $this->paketSiparisUrunleriUrunVergiMiktari;
    }
    public function setPaketSiparisUrunleriUrunVergiMiktari($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunVergiMiktari = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN ÖZEL DURUMU IDSİ GET SET START*/
      public function getPaketSiparisUrunleriUrunOzelDurumuIdsi($veriKolonArray)
    {
      $paketSiparisUrunleriUrunOzelDurumuIdsi = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_ozel_durumu_idsi"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunOzelDurumuIdsi = $paketSiparisUrunleriUrunOzelDurumuIdsi[0]["paket_siparis_urunleri_urun_ozel_durumu_idsi"];
      return $this->paketSiparisUrunleriUrunOzelDurumuIdsi;
    }
    public function setPaketSiparisUrunleriUrunOzelDurumuIdsi($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunOzelDurumuIdsi = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN ÖZEL DURUMU IDSİ GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN NOTU GET SET START*/
      public function getPaketSiparisUrunleriUrunNotu($veriKolonArray)
    {
      $paketSiparisUrunleriUrunNotu = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_notu"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunNotu = $paketSiparisUrunleriUrunNotu[0]["paket_siparis_urunleri_urun_notu"];
      return $this->paketSiparisUrunleriUrunNotu;
    }
    public function setPaketSiparisUrunleriUrunNotu($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunNotu = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN NOTU GET SET END*/

    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN SİPARİŞ SAATİ GET SET START*/
      public function getPaketSiparisUrunleriUrunSiparisSaati($veriKolonArray)
    {
      $paketSiparisUrunleriUrunSiparisSaati = $this->selectFilterQuery("tbl_paket_siparis_urunleri",array("paket_siparis_urunleri_urun_siparis_saati"),$veriKolonArray);
      $this->paketSiparisUrunleriUrunSiparisSaati = $paketSiparisUrunleriUrunSiparisSaati[0]["paket_siparis_urunleri_urun_siparis_saati"];
      return $this->paketSiparisUrunleriUrunSiparisSaati;
    }
    public function setPaketSiparisUrunleriUrunSiparisSaati($yeniDeger)
    {
      $this->paketSiparisUrunleriUrunSiparisSaati = $yeniDeger;
    }
    /*PAKET SİPARİŞ ÜRÜNLERİ ÜRÜN SİPARİŞ SAATİ GET SET END*/



  }



?>
