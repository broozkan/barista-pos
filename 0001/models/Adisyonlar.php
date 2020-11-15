<?php
  /**
   *
   */
  class Adisyonlar extends Sirket
  {

    public $adisyonIdsi;
    public $adisyonQrKodu;
    public $adisyonMasaIdsi;
    public $adisyonAcilisSaati;
    public $adisyonOdemeDurumu;
    public $adisyonNotu;
    public $adisyonTutari;
    public $adisyonMusteriIdsi;
    public $adisyonCalisanIdsi;
    public $adisyonOdenmisTutar;
    public $adisyonIndirimTuru;
    public $adisyonIndirimMiktari;
    public $adisyonGarsonIdsi;
    public $adisyonUrunleri;
    public $adisyonOdemeleri;

    function __construct()
    {
      parent::__construct();
    }

    /*ADİSYON IDSİ GET SET START*/
    public function getAdisyonIdsi($veriKolonArray)
    {
      $adisyonIdsi = $this->selectFilterQuery("tbl_adisyonlar",array("id"),$veriKolonArray);
      $this->adisyonIdsi = $adisyonIdsi[0]["id"];
      return $this->adisyonIdsi;
    }
    public function setAdisyonIdsi($yeniDeger)
    {
      $this->adisyonIdsi = $yeniDeger;
    }
    /*ADİSYON IDSİ GET SET END*/

    /*ADİSYON QR KODU GET SET START*/
    public function getAdisyonQrKodu($veriKolonArray)
    {
      $adisyonQrKodu = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_qr_kodu"),$veriKolonArray);
      $this->adisyonQrKodu = $adisyonQrKodu[0]["adisyon_qr_kodu"];
      return $this->adisyonQrKodu;
    }
    public function setAdisyonQrKodu($yeniDeger)
    {
      $this->adisyonQrKodu = $yeniDeger;
    }
    /*ADİSYON QR KODU GET SET END*/


    /*ADİSYON MASA IDSİ GET SET START*/
    public function getAdisyonMasaIdsi($veriKolonArray)
    {
      $adisyonMasaIdsi = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_masa_idsi"),$veriKolonArray);
      $this->adisyonMasaIdsi = $adisyonMasaIdsi[0]["adisyon_masa_idsi"];
      return $this->adisyonMasaIdsi;
    }
    public function setAdisyonMasaIdsi($yeniDeger)
    {
      $this->adisyonMasaIdsi = $yeniDeger;
    }
    /*ADİSYON MASA IDSİ GET SET END*/


    /*ADİSYON AÇILIŞ SAATİ GET SET START*/
    public function getAdisyonAcilisSaati($veriKolonArray)
    {
      $adisyonAcilisSaati = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_acilis_saati"),$veriKolonArray);
      $this->adisyonAcilisSaati = $adisyonAcilisSaati[0]["adisyon_acilis_saati"];
      return $this->adisyonAcilisSaati;
    }
    public function setAdisyonAcilisSaati($yeniDeger)
    {
      $this->adisyonAcilisSaati = $yeniDeger;
    }
    /*ADİSYON AÇILIŞ SAATİ GET SET END*/


    /*ADİSYON ÖDEME DURUMU GET SET START*/
    public function getAdisyonOdemeDurumu($veriKolonArray)
    {
      $adisyonOdemeDurumu = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_odeme_durumu"),$veriKolonArray);
      $this->adisyonOdemeDurumu = $adisyonOdemeDurumu[0]["adisyon_odeme_durumu"];
      return $this->adisyonOdemeDurumu;
    }
    public function setAdisyonOdemeDurumu($yeniDeger)
    {
      $this->adisyonOdemeDurumu = $yeniDeger;
    }
    /*ADİSYON ÖDEME DURUMU GET SET END*/


    /*ADİSYON NOTU GET SET START*/
    public function getAdisyonNotu($veriKolonArray)
    {
      $adisyonNotu = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_notu"),$veriKolonArray);
      $this->adisyonNotu = $adisyonNotu[0]["adisyon_notu"];
      return $this->adisyonNotu;
    }
    public function setAdisyonNotu($yeniDeger)
    {
      $this->adisyonNotu = $yeniDeger;
    }
    /*ADİSYON NOTU GET SET END*/


    /*ADİSYON TUTARI GET SET START*/
    public function getAdisyonTutari($veriKolonArray)
    {
      $adisyonTutari = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_tutari"),$veriKolonArray);
      $this->adisyonTutari = $adisyonTutari[0]["adisyon_tutari"];
      return $this->adisyonTutari;
    }
    public function setAdisyonTutari($yeniDeger)
    {
      $this->adisyonTutari = $yeniDeger;
    }
    /*ADİSYON TUTARI GET SET END*/


    /*ADİSYON MÜŞTERİ IDSİ GET SET START*/
    public function getAdisyonMusteriIdsi($veriKolonArray)
    {
      $adisyonMusteriIdsi = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_musteri_idsi"),$veriKolonArray);
      $this->adisyonMusteriIdsi = $adisyonMusteriIdsi[0]["adisyon_musteri_idsi"];
      return $this->adisyonMusteriIdsi;
    }
    public function setAdisyonMusteriIdsi($yeniDeger)
    {
      $this->adisyonMusteriIdsi = $yeniDeger;
    }
    /*ADİSYON MÜŞTERİ IDSİ GET SET END*/


    /*ADİSYON ÇALIŞAN IDSİ GET SET START*/
    public function getAdisyonCalisanIdsi($veriKolonArray)
    {
      $adisyonCalisanIdsi = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_calisan_idsi"),$veriKolonArray);
      $this->adisyonCalisanIdsi = $adisyonCalisanIdsi[0]["adisyon_calisan_idsi"];
      return $this->adisyonCalisanIdsi;
    }
    public function setAdisyonCalisanIdsi($yeniDeger)
    {
      $this->adisyonCalisanIdsi = $yeniDeger;
    }
    /*ADİSYON ÇALIŞAN IDSİ GET SET END*/


    /*ADİSYON ÖDENMİŞ TUTAR GET SET START*/
    public function getAdisyonOdenmisTutar($veriKolonArray)
    {
      $adisyonOdenmisTutar = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_odenmis_tutar"),$veriKolonArray);
      $this->adisyonOdenmisTutar = $adisyonOdenmisTutar[0]["adisyon_odenmis_tutar"];
      return $this->adisyonOdenmisTutar;
    }
    public function setAdisyonOdenmisTutar($yeniDeger)
    {
      $this->adisyonOdenmisTutar = $yeniDeger;
    }
    /*ADİSYON ÖDENMİŞ TUTAR GET SET END*/


    /*ADİSYON İNDİRİM TÜRÜ GET SET START*/
    public function getAdisyonIndirimTuru($veriKolonArray)
    {
      $adisyonIndirimTuru = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_indirim_turu"),$veriKolonArray);
      $this->adisyonIndirimTuru = $adisyonIndirimTuru[0]["adisyon_indirim_turu"];
      return $this->adisyonIndirimTuru;
    }
    public function setAdisyonIndirimTuru($yeniDeger)
    {
      $this->adisyonIndirimTuru = $yeniDeger;
    }
    /*ADİSYON İNDİRİM TÜRÜ GET SET END*/


    /*ADİSYON İNDİRİM MİKTARI GET SET START*/
    public function getAdisyonIndirimMiktari($veriKolonArray)
    {
      $adisyonIndirimMiktari = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_indirim_miktari"),$veriKolonArray);
      $this->adisyonIndirimMiktari = $adisyonIndirimMiktari[0]["adisyon_indirim_miktari"];
      return $this->adisyonIndirimMiktari;
    }
    public function setAdisyonIndirimMiktari($yeniDeger)
    {
      $this->adisyonIndirimMiktari = $yeniDeger;
    }
    /*ADİSYON İNDİRİM MİKTARI GET SET END*/


    /*ADİSYON GARSON IDSİ GET SET START*/
    public function getAdisyonGarsonIdsi($veriKolonArray)
    {
      $adisyonGarsonIdsi = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_garson_idsi"),$veriKolonArray);
      $this->adisyonGarsonIdsi = $adisyonGarsonIdsi[0]["adisyon_garson_idsi"];
      return $this->adisyonGarsonIdsi;
    }
    public function setAdisyonGarsonIdsi($yeniDeger)
    {
      $this->adisyonGarsonIdsi = $yeniDeger;
    }
    /*ADİSYON GARSON IDSİ GET SET END*/


    /*ADİSYON İNDİRİM YAPAN KİŞİ IDSİ GET SET START*/
    public function getAdisyonIndirimYapanKisiIdsi($veriKolonArray)
    {
      $adisyonIndirimYapanKisiIdsi = $this->selectFilterQuery("tbl_adisyonlar",array("adisyon_indirim_yapan_kisi_idsi"),$veriKolonArray);
      $this->adisyonIndirimYapanKisiIdsi = $adisyonIndirimYapanKisiIdsi[0]["adisyon_indirim_yapan_kisi_idsi"];
      return $this->adisyonIndirimYapanKisiIdsi;
    }
    public function setAdisyonIndirimYapanKisiIdsi($yeniDeger)
    {
      $this->adisyonIndirimYapanKisiIdsi = $yeniDeger;
    }
    /*ADİSYON İNDİRİM YAPAN KİŞİ IDSİ GET SET END*/

  }

  /**
   *
   */
  class AdisyonUrunleri extends Adisyonlar
  {

    public $adisyonUrunleriIdsi;
    public $adisyonUrunleriAdisyonIdsi;
    public $adisyonUrunleriUrunIdsi;
    public $adisyonUrunleriUrunTabloAdi;
    public $adisyonUrunleriUrunAdedi;
    public $adisyonUrunleriUrunGrami;
    public $adisyonUrunleriUrunOdenmisUrunAdedi;
    public $adisyonUrunleriUrunBirimFiyati;
    public $adisyonUrunleriUrunToplamFiyati;
    public $adisyonUrunleriUrunVergiMiktari;
    public $adisyonUrunleriUrunTeslimDurumuIdsi;
    public $adisyonUrunleriUrunOzelDurumuIdsi;
    public $adisyonUrunleriUrunNotu;
    public $adisyonUrunleriUrunCalisanIdsi;
    public $adisyonUrunleriUrunSiparisSaati;

    function __construct()
    {
      parent::__construct();
    }


    /*ADİSYON ÜRÜNLERİ IDSİ GET SET START*/
    public function getAdisyonUrunleriIdsi($veriKolonArray)
    {
      $adisyonUrunleriIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("id"),$veriKolonArray);
      $this->adisyonUrunleriIdsi = $adisyonUrunleriIdsi[0]["id"];
      return $this->adisyonUrunleriIdsi;
    }
    public function setAdisyonUrunleriIdsi($yeniDeger)
    {
      $this->adisyonUrunleriIdsi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ IDSİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ADİSYON IDSİ GET SET START*/
    public function getAdisyonUrunleriAdisyonIdsi($veriKolonArray)
    {
      $adisyonUrunleriAdisyonIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_adisyon_idsi"),$veriKolonArray);
      $this->adisyonUrunleriAdisyonIdsi = $adisyonUrunleriAdisyonIdsi[0]["adisyon_urunleri_adisyon_idsi"];
      return $this->adisyonUrunleriAdisyonIdsi;
    }
    public function setAdisyonUrunleriAdisyonIdsi($yeniDeger)
    {
      $this->adisyonUrunleriAdisyonIdsi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ADİSYON IDSİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN IDSİ GET SET START*/
    public function getAdisyonUrunleriUrunIdsi($veriKolonArray)
    {
      $adisyonUrunleriUrunIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_idsi"),$veriKolonArray);
      $this->adisyonUrunleriUrunIdsi = $adisyonUrunleriUrunIdsi[0]["adisyon_urunleri_urun_idsi"];
      return $this->adisyonUrunleriUrunIdsi;
    }
    public function setAdisyonUrunleriUrunIdsi($yeniDeger)
    {
      $this->adisyonUrunleriUrunIdsi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN IDSİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN TABLO ADI GET SET START*/
    public function getAdisyonUrunleriUrunTabloAdi($veriKolonArray)
    {
      $adisyonUrunleriUrunTabloAdi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_tablo_adi"),$veriKolonArray);
      $this->adisyonUrunleriUrunTabloAdi = $adisyonUrunleriUrunTabloAdi[0]["adisyon_urunleri_urun_tablo_adi"];
      return $this->adisyonUrunleriUrunTabloAdi;
    }
    public function setAdisyonUrunleriUrunTabloAdi($yeniDeger)
    {
      $this->adisyonUrunleriUrunTabloAdi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN TABLO ADI GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN ADEDİ GET SET START*/
    public function getAdisyonUrunleriUrunAdedi($veriKolonArray)
    {
      $adisyonUrunleriUrunAdedi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_adedi"),$veriKolonArray);
      $this->adisyonUrunleriUrunAdedi = $adisyonUrunleriUrunAdedi[0]["adisyon_urunleri_urun_adedi"];
      return $this->adisyonUrunleriUrunAdedi;
    }
    public function setAdisyonUrunleriUrunAdedi($yeniDeger)
    {
      $this->adisyonUrunleriUrunAdedi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN ADEDİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN GRAMI GET SET START*/
    public function getAdisyonUrunleriUrunGrami($veriKolonArray)
    {
      $adisyonUrunleriUrunGrami = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_grami"),$veriKolonArray);
      $this->adisyonUrunleriUrunGrami = $adisyonUrunleriUrunGrami[0]["adisyon_urunleri_urun_grami"];
      return $this->adisyonUrunleriUrunGrami;
    }
    public function setAdisyonUrunleriUrunGrami($yeniDeger)
    {
      $this->adisyonUrunleriUrunGrami = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN GRAMI GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÖDENMİŞ ÜRÜN ADEDİ GET SET START*/
    public function getAdisyonUrunleriUrunOdenmisUrunAdedi($veriKolonArray)
    {
      $adisyonUrunleriUrunOdenmisUrunAdedi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_odenmis_urun_adedi"),$veriKolonArray);
      $this->adisyonUrunleriUrunOdenmisUrunAdedi = $adisyonUrunleriUrunOdenmisUrunAdedi[0]["adisyon_urunleri_urun_odenmis_urun_adedi"];
      return $this->adisyonUrunleriUrunOdenmisUrunAdedi;
    }
    public function setAdisyonUrunleriUrunOdenmisUrunAdedi($yeniDeger)
    {
      $this->adisyonUrunleriUrunOdenmisUrunAdedi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÖDENMİŞ ÜRÜN ADEDİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN BİRİM FİYATI GET SET START*/
    public function getAdisyonUrunleriUrunBirimFiyati($veriKolonArray)
    {
      $adisyonUrunleriUrunBirimFiyati = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_birim_fiyati"),$veriKolonArray);
      $this->adisyonUrunleriUrunBirimFiyati = $adisyonUrunleriUrunBirimFiyati[0]["adisyon_urunleri_urun_birim_fiyati"];
      return $this->adisyonUrunleriUrunBirimFiyati;
    }
    public function setAdisyonUrunleriUrunBirimFiyati($yeniDeger)
    {
      $this->adisyonUrunleriUrunBirimFiyati = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN BİRİM FİYATI GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN TOPLAM FİYATI GET SET START*/
    public function getAdisyonUrunleriUrunToplamFiyati($veriKolonArray)
    {
      $adisyonUrunleriUrunToplamFiyati = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_toplam_fiyati"),$veriKolonArray);
      $this->adisyonUrunleriUrunToplamFiyati = $adisyonUrunleriUrunToplamFiyati[0]["adisyon_urunleri_urun_toplam_fiyati"];
      return $this->adisyonUrunleriUrunToplamFiyati;
    }
    public function setAdisyonUrunleriUrunToplamFiyati($yeniDeger)
    {
      $this->adisyonUrunleriUrunToplamFiyati = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN TOPLAM FİYATI GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET START*/
    public function getAdisyonUrunleriUrunVergiMiktari($veriKolonArray)
    {
      $adisyonUrunleriUrunVergiMiktari = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_vergi_miktari"),$veriKolonArray);
      $this->adisyonUrunleriUrunVergiMiktari = $adisyonUrunleriUrunVergiMiktari[0]["adisyon_urunleri_urun_vergi_miktari"];
      return $this->adisyonUrunleriUrunVergiMiktari;
    }
    public function setAdisyonUrunleriUrunVergiMiktari($yeniDeger)
    {
      $this->adisyonUrunleriUrunVergiMiktari = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN VERGİ MİKTARI GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN TESLİM DURUMU IDSİ GET SET START*/
    public function getAdisyonUrunleriUrunTeslimDurumuIdsi($veriKolonArray)
    {
      $adisyonUrunleriUrunTeslimDurumuIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_teslim_durumu_idsi"),$veriKolonArray);
      $this->adisyonUrunleriUrunTeslimDurumuIdsi = $adisyonUrunleriUrunTeslimDurumuIdsi[0]["adisyon_urunleri_urun_teslim_durumu_idsi"];
      return $this->adisyonUrunleriUrunTeslimDurumuIdsi;
    }
    public function setAdisyonUrunleriUrunTeslimDurumuIdsi($yeniDeger)
    {
      $this->adisyonUrunleriUrunTeslimDurumuIdsi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN TESLİM DURUMU IDSİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN ÖZEL DURUMU IDSİ GET SET START*/
    public function getAdisyonUrunleriUrunOzelDurumuIdsi($veriKolonArray)
    {
      $adisyonUrunleriUrunOzelDurumuIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_ozel_durumu_idsi"),$veriKolonArray);
      $this->adisyonUrunleriUrunOzelDurumuIdsi = $adisyonUrunleriUrunOzelDurumuIdsi[0]["adisyon_urunleri_urun_ozel_durumu_idsi"];
      return $this->adisyonUrunleriUrunOzelDurumuIdsi;
    }
    public function setAdisyonUrunleriUrunOzelDurumuIdsi($yeniDeger)
    {
      $this->adisyonUrunleriUrunOzelDurumuIdsi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN ÖZEL DURUMU IDSİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN NOTU GET SET START*/
    public function getAdisyonUrunleriUrunNotu($veriKolonArray)
    {
      $adisyonUrunleriUrunNotu = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_notu"),$veriKolonArray);
      $this->adisyonUrunleriUrunNotu = $adisyonUrunleriUrunNotu[0]["adisyon_urunleri_urun_notu"];
      return $this->adisyonUrunleriUrunNotu;
    }
    public function setAdisyonUrunleriUrunNotu($yeniDeger)
    {
      $this->adisyonUrunleriUrunNotu = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN NOTU GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN ÇALIŞAN IDSİ GET SET START*/
    public function getAdisyonUrunleriUrunCalisanIdsi($veriKolonArray)
    {
      $adisyonUrunleriUrunCalisanIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_calisan_idsi"),$veriKolonArray);
      $this->adisyonUrunleriUrunCalisanIdsi = $adisyonUrunleriUrunCalisanIdsi[0]["adisyon_urunleri_urun_calisan_idsi"];
      return $this->adisyonUrunleriUrunCalisanIdsi;
    }
    public function setAdisyonUrunleriUrunCalisanIdsi($yeniDeger)
    {
      $this->adisyonUrunleriUrunCalisanIdsi = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN ÇALIŞAN IDSİ GET SET END*/


    /*ADİSYON ÜRÜNLERİ ÜRÜN SİPARİŞ SAATİ GET SET START*/
    public function getAdisyonUrunleriUrunSiparisSaati($veriKolonArray)
    {
      $adisyonUrunleriUrunSiparisSaati = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_urunleri_urun_siparis_saati"),$veriKolonArray);
      $this->adisyonUrunleriUrunSiparisSaati = $adisyonUrunleriUrunSiparisSaati[0]["adisyon_urunleri_urun_siparis_saati"];
      return $this->adisyonUrunleriUrunSiparisSaati;
    }
    public function setAdisyonUrunleriUrunSiparisSaati($yeniDeger)
    {
      $this->adisyonUrunleriUrunSiparisSaati = $yeniDeger;
    }
    /*ADİSYON ÜRÜNLERİ ÜRÜN SİPARİŞ SAATİ GET SET END*/

  }

  /**
   *
   */
  class AdisyonOdemeleri extends Adisyonlar
  {

    public $adisyonOdemesiIdsi;
    public $adisyonOdemesiOdemeMetoduIdsi;
    public $adisyonOdemesiOdemeMiktari;
    public $adisyonOdemesiOdemeyiAlanKisiIdsi;
    public $adisyonOdemesiOdemeTarihi;
    public $adisyonOdemesiAdisyonUrunIdleri;

    function __construct()
    {
      parent::__construct();
    }


    /*ADİSYON ÖDEMELERİ ÖDEME IDSİ GET SET START*/
    public function getAdisyonOdemeleriOdemeIdsi($veriKolonArray)
    {
      $adisyonOdemeleriOdemeIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("id"),$veriKolonArray);
      $this->adisyonOdemeleriOdemeIdsi = $adisyonOdemeleriOdemeIdsi[0]["id"];
      return $this->adisyonOdemeleriOdemeIdsi;
    }
    public function setAdisyonOdemeleriOdemeIdsi($yeniDeger)
    {
      $this->adisyonOdemeleriOdemeIdsi = $yeniDeger;
    }
    /*ADİSYON ÖDEMELERİ ÖDEME IDSİ GET SET END*/


    /*ADİSYON ÖDEMELERİ ADİSYON IDSİ GET SET START*/
    public function getAdisyonOdemeleriAdisyonIdsi($veriKolonArray)
    {
      $adisyonOdemeleriAdisyonIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_odemesi_adisyon_idsi"),$veriKolonArray);
      $this->adisyonOdemeleriAdisyonIdsi = $adisyonOdemeleriAdisyonIdsi[0]["adisyon_odemesi_adisyon_idsi"];
      return $this->adisyonOdemeleriAdisyonIdsi;
    }
    public function setAdisyonOdemeleriAdisyonIdsi($yeniDeger)
    {
      $this->adisyonOdemeleriAdisyonIdsi = $yeniDeger;
    }
    /*ADİSYON ÖDEMELERİ ADİSYON IDSİ GET SET END*/


    /*ADİSYON ÖDEMELERİ ÖDEME METODU IDSİ GET SET START*/
    public function getAdisyonOdemeleriOdemeMetoduIdsi($veriKolonArray)
    {
      $adisyonOdemeleriOdemeMetoduIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_odemesi_odeme_metodu_idsi"),$veriKolonArray);
      $this->adisyonOdemeleriOdemeMetoduIdsi = $adisyonOdemeleriOdemeMetoduIdsi[0]["adisyon_odemesi_odeme_metodu_idsi"];
      return $this->adisyonOdemeleriOdemeMetoduIdsi;
    }
    public function setAdisyonOdemeleriOdemeMetoduIdsi($yeniDeger)
    {
      $this->adisyonOdemeleriOdemeMetoduIdsi = $yeniDeger;
    }
    /*ADİSYON ÖDEMELERİ ÖDEME METODU IDSİ GET SET END*/


    /*ADİSYON ÖDEMELERİ ÖDEME MİKTARI GET SET START*/
    public function getAdisyonOdemeleriOdemeMiktari($veriKolonArray)
    {
      $adisyonOdemeleriOdemeMiktari = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_odemesi_odeme_miktari"),$veriKolonArray);
      $this->adisyonOdemeleriOdemeMiktari = $adisyonOdemeleriOdemeMiktari[0]["adisyon_odemesi_odeme_miktari"];
      return $this->adisyonOdemeleriOdemeMiktari;
    }
    public function setAdisyonOdemeleriOdemeMiktari($yeniDeger)
    {
      $this->adisyonOdemeleriOdemeMiktari = $yeniDeger;
    }
    /*ADİSYON ÖDEMELERİ ÖDEME MİKTARI GET SET END*/


    /*ADİSYON ÖDEMELERİ ÖDEMEYİ ALAN KİŞİ IDSİ GET SET START*/
    public function getAdisyonOdemeleriOdemeyiAlanKisiIdsi($veriKolonArray)
    {
      $adisyonOdemeleriOdemeyiAlanKisiIdsi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_odemesi_odemeyi_alan_kisi_idsi"),$veriKolonArray);
      $this->adisyonOdemeleriOdemeyiAlanKisiIdsi = $adisyonOdemeleriOdemeyiAlanKisiIdsi[0]["adisyon_odemesi_odemeyi_alan_kisi_idsi"];
      return $this->adisyonOdemeleriOdemeyiAlanKisiIdsi;
    }
    public function setAdisyonOdemeleriOdemeyiAlanKisiIdsi($yeniDeger)
    {
      $this->adisyonOdemeleriOdemeyiAlanKisiIdsi = $yeniDeger;
    }
    /*ADİSYON ÖDEMELERİ ÖDEMEYİ ALAN KİŞİ IDSİ GET SET END*/


    /*ADİSYON ÖDEMELERİ ÖDEME TARİHİ GET SET START*/
    public function getAdisyonOdemeleriOdemeTarihi($veriKolonArray)
    {
      $adisyonOdemeleriOdemeTarihi = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_odemesi_odeme_tarihi"),$veriKolonArray);
      $this->adisyonOdemeleriOdemeTarihi = $adisyonOdemeleriOdemeTarihi[0]["adisyon_odemesi_odeme_tarihi"];
      return $this->adisyonOdemeleriOdemeTarihi;
    }
    public function setAdisyonOdemeleriOdemeTarihi($yeniDeger)
    {
      $this->adisyonOdemeleriOdemeTarihi = $yeniDeger;
    }
    /*ADİSYON ÖDEMELERİ ÖDEME TARİHİ GET SET END*/


    /*ADİSYON ÖDEMELERİ ADİSYON ÜRÜN IDLERİ GET SET START*/
    public function getAdisyonOdemeleriAdisyonUrunIdleri($veriKolonArray)
    {
      $adisyonOdemeleriAdisyonUrunIdleri = $this->selectFilterQuery("tbl_adisyon_urunleri",array("adisyon_odemesi_adisyon_urun_idleri"),$veriKolonArray);
      $this->adisyonOdemeleriAdisyonUrunIdleri = $adisyonOdemeleriAdisyonUrunIdleri[0]["adisyon_odemesi_adisyon_urun_idleri"];
      return $this->adisyonOdemeleriAdisyonUrunIdleri;
    }
    public function setAdisyonOdemeleriAdisyonUrunIdleri($yeniDeger)
    {
      $this->adisyonOdemeleriAdisyonUrunIdleri = $yeniDeger;
    }
    /*ADİSYON ÖDEMELERİ ADİSYON ÜRÜN IDLERİ GET SET END*/


  }



?>
