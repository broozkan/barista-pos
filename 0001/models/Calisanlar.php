<?php
  /**
   *  ÇALIŞANLAR CLASS
   */
  class Calisanlar extends Sirket
  {

    public $calisanIdsi;
    public $calisanAdiSoyadi;
    public $calisanAdresi;
    public $calisanDogumTarihi;
    public $calisanTelefonNumarasi;
    public $calisanEpostaAdresi;
    public $calisanProfilFotosu;
    public $calisanStatuIdsi;
    public $calisanKullaniciAdi;
    public $calisanParolasi;
    public $calisanPini;
    public $calisanAdisyonYaziciIdsi;
    public $calisanPaketServisYaziciIdsi;
    public $calisanHizliSatisYaziciIdsi;
    public $calisanIndirimTuru;
    public $calisanIndirimMiktari;
    public $calisanGunlukHarcamaSiniri;
    public $calisanHizliNotlari;
    public $calisanAktifMi;

    function __construct()
    {
      parent::__construct();
    }

    /*ÇALIŞAN ID GET SET START*/
    public function getCalisanIdsi($veriKolonArray)
    {
      $calisanIdsi = $this->selectFilterQuery("tbl_calisanlar",array("id"),$veriKolonArray);
      $this->calisanIdsi = $calisanIdsi[0]["id"];
      return $this->calisanIdsi;
    }
    public function setCalisanIdsi($yeniDeger)
    {
      $this->calisanIdsi = $yeniDeger;
    }
    /*ÇALIŞAN ID GET SET END*/

    /*ÇALIŞAN ADI SOYADI GET SET START*/
    public function getCalisanAdiSoyadi($veriKolonArray)
    {
      $calisanAdiSoyadi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_adi_soyadi"),$veriKolonArray);
      $this->calisanAdiSoyadi = $calisanAdiSoyadi[0]["calisan_adi_soyadi"];
      return $this->calisanAdiSoyadi;
    }
    public function setCalisanAdiSoyadi($yeniDeger)
    {
      $this->calisanAdiSoyadi = $yeniDeger;
    }
    /*ÇALIŞAN ADI SOYADI GET SET END*/

    /*ÇALIŞAN ADRESİ GET SET START*/
    public function getCalisanAdresi($veriKolonArray)
    {
      $calisanAdresi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_adresi"),$veriKolonArray);
      $this->calisanAdresi = $calisanAdresi[0]["calisan_adresi"];
      return $this->calisanAdresi;
    }
    public function setCalisanAdresi($yeniDeger)
    {
      $this->calisanAdresi = $yeniDeger;
    }
    /*ÇALIŞAN ADRESİ GET SET END*/

    /*ÇALIŞAN DOĞUM TARİHİ GET SET START*/
    public function getCalisanDogumTarihi($veriKolonArray)
    {
      $calisanDogumTarihi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_dogum_tarihi"),$veriKolonArray);
      $this->calisanDogumTarihi = $calisanDogumTarihi[0]["calisan_dogum_tarihi"];
      return $this->calisanDogumTarihi;
    }
    public function setCalisanDogumTarihi($yeniDeger)
    {
      $this->calisanDogumTarihi = $yeniDeger;
    }
    /*ÇALIŞAN DOĞUM TARİHİ GET SET END*/

    /*ÇALIŞAN TELEFON NUMARASI GET SET START*/
    public function getCalisanTelefonNumarasi($veriKolonArray)
    {
      $calisanTelefonNumarasi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_telefon_numarasi"),$veriKolonArray);
      $this->calisanTelefonNumarasi = $calisanTelefonNumarasi[0]["calisan_telefon_numarasi"];
      return $this->calisanTelefonNumarasi;
    }
    public function setCalisanTelefonNumarasi($yeniDeger)
    {
      $this->calisanTelefonNumarasi = $yeniDeger;
    }
    /*ÇALIŞAN TELEFON NUMARASI GET SET END*/

    /*ÇALIŞAN E-POSTA ADRESİ GET SET START*/
    public function getCalisanEpostaAdresi($veriKolonArray)
    {
      $calisanEpostaAdresi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_eposta_adresi"),$veriKolonArray);
      $this->calisanEpostaAdresi = $calisanEpostaAdresi[0]["calisan_eposta_adresi"];
      return $this->calisanEpostaAdresi;
    }
    public function setCalisanEpostaAdresi($yeniDeger)
    {
      $this->calisanEpostaAdresi = $yeniDeger;
    }
    /*ÇALIŞAN E-POSTA ADRESİ GET SET END*/

    /*ÇALIŞAN PROFİL FOTOSU GET SET START*/
    public function getCalisanProfilFotosu($veriKolonArray)
    {
      $calisanProfilFotosu = $this->selectFilterQuery("tbl_calisanlar",array("calisan_profil_fotosu"),$veriKolonArray);
      $this->calisanProfilFotosu = $calisanProfilFotosu[0]["calisan_profil_fotosu"];
      return $this->calisanProfilFotosu;
    }
    public function setCalisanProfilFotosu($yeniDeger)
    {
      $this->calisanProfilFotosu = $yeniDeger;
    }
    /*ÇALIŞAN PROFİL FOTOSU GET SET END*/

    /*ÇALIŞAN STATÜ IDSİ GET SET START*/
    public function getCalisanStatuIdsi($veriKolonArray)
    {
      $calisanStatuIdsi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_statu_idsi"),$veriKolonArray);
      $this->calisanStatuIdsi = $calisanStatuIdsi[0]["calisan_statu_idsi"];
      return $this->calisanStatuIdsi;
    }
    public function setCalisanStatuIdsi($yeniDeger)
    {
      $this->calisanStatuIdsi = $yeniDeger;
    }
    /*ÇALIŞAN STATÜ IDSİ GET SET END*/

    /*ÇALIŞAN KULLANICI ADI GET SET START*/
    public function getCalisanKullaniciAdi($veriKolonArray)
    {
      $calisanKullaniciAdi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_kullanici_adi"),$veriKolonArray);
      $this->calisanKullaniciAdi = $calisanKullaniciAdi[0]["calisan_kullanici_adi"];
      return $this->calisanKullaniciAdi;
    }
    public function setCalisanKullaniciAdi($yeniDeger)
    {
      $this->calisanKullaniciAdi = $yeniDeger;
    }
    /*ÇALIŞAN KULLANICI ADI GET SET END*/

    /*ÇALIŞAN PAROLASI GET SET START*/
    public function getCalisanParolasi($veriKolonArray)
    {
      $calisanParolasi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_parolasi"),$veriKolonArray);
      $this->calisanParolasi = $calisanParolasi[0]["calisan_parolasi"];
      return $this->calisanParolasi;
    }
    public function setCalisanParolasi($yeniDeger)
    {
      $this->calisanParolasi = $yeniDeger;
    }
    /*ÇALIŞAN PAROLASI GET SET END*/

    /*ÇALIŞAN PINI GET SET START*/
    public function getCalisanPini($veriKolonArray)
    {
      $calisanPini = $this->selectFilterQuery("tbl_calisanlar",array("calisan_pini"),$veriKolonArray);
      $this->calisanPini = $calisanPini[0]["calisan_pini"];
      return $this->calisanPini;
    }
    public function setCalisanPini($yeniDeger)
    {
      $this->calisanPini = $yeniDeger;
    }
    /*ÇALIŞAN PINI GET SET END*/

    /*ÇALIŞAN ADİSYON YAZICI IDSİ GET SET START*/
    public function getCalisanAdisyonYaziciIdsi($veriKolonArray)
    {
      $calisanAdisyonYaziciIdsi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_adisyon_yazici_idsi"),$veriKolonArray);
      $this->calisanAdisyonYaziciIdsi = $calisanAdisyonYaziciIdsi[0]["calisan_adisyon_yazici_idsi"];
      return $this->calisanAdisyonYaziciIdsi;
    }
    public function setCalisanAdisyonYaziciIdsi($yeniDeger)
    {
      $this->calisanAdisyonYaziciIdsi = $yeniDeger;
    }
    /*ÇALIŞAN ADİSYON YAZICI IDSİ GET SET END*/

    /*ÇALIŞAN PAKET SERVİS YAZICISI IDSİ GET SET START*/
    public function getCalisanPaketServisYaziciIdsi($veriKolonArray)
    {
      $calisanPaketServisYaziciIdsi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_paket_servis_yazici_idsi"),$veriKolonArray);
      $this->calisanPaketServisYaziciIdsi = $calisanPaketServisYaziciIdsi[0]["calisan_paket_servis_yazici_idsi"];
      return $this->calisanPaketServisYaziciIdsi;
    }
    public function setCalisanPaketServisYaziciIdsi($yeniDeger)
    {
      $this->calisanPaketServisYaziciIdsi = $yeniDeger;
    }
    /*ÇALIŞAN PAKET SERVİS YAZICISI IDSİ GET SET END*/

    /*ÇALIŞAN HIZLI SATIŞ YAZICISI IDSİ GET SET START*/
    public function getCalisanHizliSatisYaziciIdsi($veriKolonArray)
    {
      $calisanHizliSatisYaziciIdsi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_hizli_satis_yazici_idsi"),$veriKolonArray);
      $this->calisanHizliSatisYaziciIdsi = $calisanHizliSatisYaziciIdsi[0]["calisan_hizli_satis_yazici_idsi"];
      return $this->calisanHizliSatisYaziciIdsi;
    }
    public function setCalisanHizliSatisYaziciIdsi($yeniDeger)
    {
      $this->calisanHizliSatisYaziciIdsi = $yeniDeger;
    }
    /*ÇALIŞAN HIZLI SATIŞ YAZICISI IDSİ GET SET END*/

    /*ÇALIŞAN İNDİRİM TÜRÜ GET SET START*/
    public function getCalisanIndirimTuru($veriKolonArray)
    {
      $calisanIndirimTuru = $this->selectFilterQuery("tbl_calisanlar",array("calisan_indirim_turu"),$veriKolonArray);
      $this->calisanIndirimTuru = $calisanIndirimTuru[0]["calisan_indirim_turu"];
      return $this->calisanIndirimTuru;
    }
    public function setCalisanIndirimTuru($yeniDeger)
    {
      $this->calisanIndirimTuru = $yeniDeger;
    }
    /*ÇALIŞAN İNDİRİM TÜRÜ GET SET END*/

    /*ÇALIŞAN İNDİRİM MİKTARI GET SET START*/
    public function getCalisanIndirimMiktari($veriKolonArray)
    {
      $calisanIndirimMiktari = $this->selectFilterQuery("tbl_calisanlar",array("calisan_indirim_miktari"),$veriKolonArray);
      $this->calisanIndirimMiktari = $calisanIndirimMiktari[0]["calisan_indirim_miktari"];
      return $this->calisanIndirimMiktari;
    }
    public function setCalisanIndirimMiktari($yeniDeger)
    {
      $this->calisanIndirimMiktari = $yeniDeger;
    }
    /*ÇALIŞAN İNDİRİM MİKTARI GET SET END*/

    /*ÇALIŞAN GÜNLÜK HARCAMA SINIRI GET SET START*/
    public function getCalisanGunlukHarcamaSiniri($veriKolonArray)
    {
      $calisanGunlukHarcamaSiniri = $this->selectFilterQuery("tbl_calisanlar",array("calisan_gunluk_harcama_siniri"),$veriKolonArray);
      $this->calisanGunlukHarcamaSiniri = $calisanGunlukHarcamaSiniri[0]["calisan_gunluk_harcama_siniri"];
      return $this->calisanGunlukHarcamaSiniri;
    }
    public function setCalisanGunlukHarcamaSiniri($yeniDeger)
    {
      $this->calisanGunlukHarcamaSiniri = $yeniDeger;
    }
    /*ÇALIŞAN GÜNLÜK HARCAMA SINIRI GET SET END*/

    /*ÇALIŞAN HIZLI NOTLARI GET SET START*/
    public function getCalisanHizliNotlari($veriKolonArray)
    {
      $calisanHizliNotlari = $this->selectFilterQuery("tbl_calisanlar",array("calisan_hizli_notlari"),$veriKolonArray);
      $this->calisanHizliNotlari = $calisanHizliNotlari[0]["calisan_hizli_notlari"];
      return $this->calisanHizliNotlari;
    }
    public function setCalisanHizliNotlari($yeniDeger)
    {
      $this->calisanHizliNotlari = $yeniDeger;
    }
    /*ÇALIŞAN HIZLI NOTLARI GET SET END*/

    /*ÇALIŞAN AKTİF Mİ GET SET START*/
    public function getCalisanAktifMi($veriKolonArray)
    {
      $calisanAktifMi = $this->selectFilterQuery("tbl_calisanlar",array("calisan_aktif_mi"),$veriKolonArray);
      $this->calisanAktifMi = $calisanAktifMi[0]["calisan_aktif_mi"];
      return $this->calisanAktifMi;
    }
    public function setCalisanAktifMi($yeniDeger)
    {
      $this->calisanAktifMi = $yeniDeger;
    }
    /*ÇALIŞAN AKTİF Mİ GET SET END*/




  }

?>
