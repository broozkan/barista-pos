<?php
  /**
   * ÜRÜNLER CLASS
   */
  class Urunler extends Sirket
  {
    public $urunId;
    public $urunKodu;
    public $urunPluNosu;
    public $urunBarkodu;
    public $urunAdi;
    public $urunBirimIdsi;
    public $urunAdedi;
    public $urunRengi;
    public $urunKategoriIdsi;
    public $urunMutfakIdleri;
    public $urunGorseli;
    public $urunAltUyariDegeri;
    public $urunKurIdsi;
    public $urunKgFiyati;
    public $urunAlisFiyati;
    public $urunSatisFiyati;
    public $urunAlisVergiIdsi;
    public $urunSatisVergiIdsi;
    public $urunStokUrunuMu;


    function __construct()
    {
      parent::__construct();
    }

    /*ÜRÜN ID GET SET START*/
    public function getUrunId($veriKolonArray)
    {
      $urunId = $this->selectFilterQuery("tbl_urunler",array("id"),$veriKolonArray);
      $this->urunId = $urunId[0]["id"];
      return $this->urunId;
    }
    public function setUrunId($yeniDeger)
    {
      $this->urunId = $yeniDeger;
    }
    /*ÜRÜN ID GET SET END*/

    /*ÜRÜN KODU GET SET START*/
    public function getUrunKodu($veriKolonArray)
    {
      $urunKodu = $this->selectFilterQuery("tbl_urunler",array("urun_kodu"),$veriKolonArray);
      $this->urunKodu = $urunKodu[0]["urun_kodu"];
      return $this->urunKodu;
    }
    public function setUrunKodu($yeniDeger)
    {
      $this->urunKodu = $yeniDeger;
    }
    /*ÜRÜN KODU GET SET END*/

    /*ÜRÜN PLU NOSU GET SET START*/
    public function getUrunPluNosu($veriKolonArray)
    {
      $urunPluNosu = $this->selectFilterQuery("tbl_urunler",array("urun_plu_nosu"),$veriKolonArray);
      $this->urunPluNosu = $urunPluNosu[0]["urun_plu_nosu"];
      return $this->urunPluNosu;
    }
    public function setUrunPluNosu($yeniDeger)
    {
      $this->urunPluNosu = $yeniDeger;
    }
    /*ÜRÜN PLU NOSU GET SET END*/


    /*ÜRÜN BARKODU GET SET START*/
    public function getUrunBarkodu($veriKolonArray)
    {
      $urunBarkodu = $this->selectFilterQuery("tbl_urunler",array("urun_barkodu"),$veriKolonArray);
      $this->urunBarkodu = $urunBarkodu[0]["urun_barkodu"];
      return $this->urunBarkodu;
    }
    public function setUrunBarkodu($yeniDeger)
    {
      $this->urunBarkodu = $yeniDeger;
    }
    /*ÜRÜN BARKODU GET SET END*/


    /*ÜRÜN ADI GET SET START*/
    public function getUrunAdi($veriKolonArray)
    {
      $urunAdi = $this->selectFilterQuery("tbl_urunler",array("urun_adi"),$veriKolonArray);
      $this->urunAdi = $urunAdi[0]["urun_adi"];
      return $this->urunAdi;
    }
    public function setUrunAdi($yeniDeger)
    {
      $this->urunAdi = $yeniDeger;
    }
    /*ÜRÜN ADI GET SET END*/


    /*ÜRÜN BİRİM IDSİ GET SET START*/
    public function getUrunBirimIdsi($veriKolonArray)
    {
      $urunBirimIdsi = $this->selectFilterQuery("tbl_urunler",array("urun_birim_idsi"),$veriKolonArray);
      $this->urunBirimIdsi = $urunBirimIdsi[0]["urun_birim_idsi"];
      return $this->urunBirimIdsi;
    }
    public function setUrunBirimIdsi($yeniDeger)
    {
      $this->urunBirimIdsi = $yeniDeger;
    }
    /*ÜRÜN BİRİM IDSİ GET SET END*/


    /*ÜRÜN ADEDİ GET SET START*/
    public function getUrunAdedi($veriKolonArray)
    {
      $urunAdedi = $this->selectFilterQuery("tbl_urunler",array("urun_adedi"),$veriKolonArray);
      $this->urunAdedi = $urunAdedi[0]["urun_adedi"];
      return $this->urunAdedi;
    }
    public function setUrunAdedi($yeniDeger)
    {
      $this->urunAdedi = $yeniDeger;
    }
    /*ÜRÜN ADEDİ GET SET END*/


    /*ÜRÜN RENGİ GET SET START*/
    public function getUrunRengi($veriKolonArray)
    {
      $urunRengi = $this->selectFilterQuery("tbl_urunler",array("urun_rengi"),$veriKolonArray);
      $this->urunRengi = $urunRengi[0]["urun_rengi"];
      return $this->urunRengi;
    }
    public function setUrunRengi($yeniDeger)
    {
      $this->urunRengi = $yeniDeger;
    }
    /*ÜRÜN RENGİ GET SET END*/


    /*ÜRÜN KATEGORİ ID GET SET START*/
    public function getUrunKategoriIdsi($veriKolonArray)
    {
      $urunKategoriIdsi = $this->selectFilterQuery("tbl_urunler",array("urun_kategori_idsi"),$veriKolonArray);
      $this->urunKategoriIdsi = $urunKategoriIdsi[0]["urun_kategori_idsi"];
      return $this->urunKategoriIdsi;
    }
    public function setUrunKategoriIdsi($yeniDeger)
    {
      $this->urunKategoriIdsi = $yeniDeger;
    }
    /*ÜRÜN KATEGORİ ID GET SET END*/


    /*ÜRÜN MUTFAK IDLERİ GET SET START*/
    public function getUrunMutfakIdleri($veriKolonArray)
    {
      $urunMutfakIdleri = $this->selectFilterQuery("tbl_urunler",array("urun_mutfak_idleri"),$veriKolonArray);
      $this->urunMutfakIdleri = $urunMutfakIdleri[0]["urun_mutfak_idleri"];
      return $this->urunMutfakIdleri;
    }
    public function setUrunMutfakIdleri($yeniDeger)
    {
      $this->urunMutfakIdleri = $yeniDeger;
    }
    /*ÜRÜN MUTFAK IDLERİ GET SET END*/


    /*ÜRÜN GÖRSELİ GET SET START*/
    public function getUrunGorseli($veriKolonArray)
    {
      $urunGorseli = $this->selectFilterQuery("tbl_urunler",array("urun_gorseli"),$veriKolonArray);
      $this->urunGorseli = $urunGorseli[0]["urun_gorseli"];
      return $this->urunGorseli;
    }
    public function setUrunGorseli($yeniDeger)
    {
      $this->urunGorseli = $yeniDeger;
    }
    /*ÜRÜN GÖRSELİ GET SET END*/


    /*ÜRÜN ALT UYARI DEĞERİ GET SET START*/
    public function getUrunAltUyariDegeri($veriKolonArray)
    {
      $urunAltUyariDegeri = $this->selectFilterQuery("tbl_urunler",array("urun_alt_uyari_degeri"),$veriKolonArray);
      $this->urunAltUyariDegeri = $urunAltUyariDegeri[0]["urun_alt_uyari_degeri"];
      return $this->urunAltUyariDegeri;
    }
    public function setUrunAltUyariDegeri($yeniDeger)
    {
      $this->urunAltUyariDegeri = $yeniDeger;
    }
    /*ÜRÜN ALT UYARI DEĞERİ GET SET END*/


    /*ÜRÜN KUR IDSİ GET SET START*/
    public function getUrunKurIdsi($veriKolonArray)
    {
      $urunKurIdsi = $this->selectFilterQuery("tbl_urunler",array("urun_kur_idsi"),$veriKolonArray);
      $this->urunKurIdsi = $urunKurIdsi[0]["urun_kur_idsi"];
      return $this->urunKurIdsi;
    }
    public function setUrunKurIdsi($yeniDeger)
    {
      $this->urunKurIdsi = $yeniDeger;
    }
    /*ÜRÜN KUR IDSİ GET SET END*/


    /*ÜRÜN KG FİYATI GET SET START*/
    public function getUrunKgFiyati($veriKolonArray)
    {
      $urunKgFiyati = $this->selectFilterQuery("tbl_urunler",array("urun_kg_fiyati"),$veriKolonArray);
      $this->urunKgFiyati = $urunKgFiyati[0]["urun_kg_fiyati"];
      return $this->urunKgFiyati;
    }
    public function setUrunKgFiyati($yeniDeger)
    {
      $this->urunKgFiyati = $yeniDeger;
    }
    /*ÜRÜN KG FİYATI GET SET END*/


    /*ÜRÜN ALIŞ FİYATI GET SET START*/
    public function getUrunAlisFiyati($veriKolonArray)
    {
      $urunAlisFiyati = $this->selectFilterQuery("tbl_urunler",array("urun_alis_fiyati"),$veriKolonArray);
      $this->urunAlisFiyati = $urunAlisFiyati[0]["urun_alis_fiyati"];
      return $this->urunAlisFiyati;
    }
    public function setUrunAlisFiyati($yeniDeger)
    {
      $this->urunAlisFiyati = $yeniDeger;
    }
    /*ÜRÜN ALIŞ FİYATI GET SET END*/


    /*ÜRÜN SATIŞ FİYATI GET SET START*/
    public function getUrunSatisFiyati($veriKolonArray)
    {
      $urunSatisFiyati = $this->selectFilterQuery("tbl_urunler",array("urun_satis_fiyati"),$veriKolonArray);
      $this->urunSatisFiyati = $urunSatisFiyati[0]["urun_satis_fiyati"];
      return $this->urunSatisFiyati;
    }
    public function setUrunSatisFiyati($yeniDeger)
    {
      $this->urunSatisFiyati = $yeniDeger;
    }
    /*ÜRÜN SATIŞ FİYATI GET SET END*/


    /*ÜRÜN ALIŞ KDV MİKTARI GET SET START*/
    public function getUrunAlisVergiIdsi($veriKolonArray)
    {
      $urunAlisVergiIdsi = $this->selectFilterQuery("tbl_urunler",array("urun_alis_vergi_idsi"),$veriKolonArray);
      $this->urunAlisVergiIdsi = $urunAlisVergiIdsi[0]["urun_alis_vergi_idsi"];
      return $this->urunAlisVergiIdsi;
    }
    public function setUrunAlisVergiIdsi($yeniDeger)
    {
      $this->urunAlisVergiIdsi = $yeniDeger;
    }
    /*ÜRÜN ALIŞ KDV MİKTARI GET SET END*/


    /*ÜRÜN SATIŞ KDV MİKTARI GET SET START*/
    public function getUrunSatisVergiIdsi($veriKolonArray)
    {
      $urunSatisVergiIdsi = $this->selectFilterQuery("tbl_urunler",array("urun_satis_vergi_idsi"),$veriKolonArray);
      $this->urunSatisVergiIdsi = $urunSatisVergiIdsi[0]["urun_satis_vergi_idsi"];
      return $this->urunSatisVergiIdsi;
    }
    public function setUrunSatisVergiIdsi($yeniDeger)
    {
      $this->urunSatisVergiIdsi = $yeniDeger;
    }
    /*ÜRÜN SATIŞ KDV MİKTARI GET SET END*/


    /*ÜRÜN STOK ÜRÜNÜ MÜ GET SET START*/
    public function getUrunStokUrunuMu($veriKolonArray)
    {
      $urunStokUrunuMu = $this->selectFilterQuery("tbl_urunler",array("urun_stok_urunu_mu"),$veriKolonArray);
      $this->urunStokUrunuMu = $urunStokUrunuMu[0]["urun_stok_urunu_mu"];
      return $this->urunStokUrunuMu;
    }
    public function setUrunStokUrunuMu($yeniDeger)
    {
      $this->urunStokUrunuMu = $yeniDeger;
    }
    /*ÜRÜN STOK ÜRÜNÜ MÜ GET SET END*/


    /*ÜRÜN DEPO IDSİ GET SET START*/
    public function getUrunDepoIdsi($veriKolonArray)
    {
      $urunDepoIdsi = $this->selectFilterQuery("tbl_urunler",array("urun_depo_idsi"),$veriKolonArray);
      $this->urunDepoIdsi = $urunDepoIdsi[0]["urun_depo_idsi"];
      return $this->urunDepoIdsi;
    }
    public function setUrunDepoIdsi($yeniDeger)
    {
      $this->urunDepoIdsi = $yeniDeger;
    }
    /*ÜRÜN DEPO IDSİ GET SET END*/

  }

  /**
   *
   */
  class AltUrunler extends Urunler
  {

    public $altUrunId;
    public $ustUrunId;
    public $altUrunKodu;
    public $altUrunPluNosu;
    public $altUrunBarkodu;
    public $altUrunAdi;
    public $altUrunAdedi;
    public $altUrunRengi;
    public $altUrunAltUyariDegeri;
    public $altUrunKurIdsi;
    public $altUrunKgFiyati;
    public $altUrunAlisFiyati;
    public $altUrunSatisFiyati;
    public $altUrunAlisVergiIdsi;
    public $altUrunSatisVergiIdsi;

    function __construct()
    {
      parent::__construct();
    }


    /*ALT ÜRÜN ID GET SET START*/
    public function getAltUrunId($veriKolonArray)
    {
      $altUrunId = $this->selectFilterQuery("tbl_alt_urunler",array("id"),$veriKolonArray);
      $this->altUrunId = $altUrunId[0]["id"];
      return $this->altUrunId;
    }
    public function setAltUrunId($yeniDeger)
    {
      $this->altUrunId = $yeniDeger;
    }
    /*ALT ÜRÜN ID GET SET END*/


    /*ÜST ÜRÜN ID GET SET START*/
    public function getUstUrunId($veriKolonArray)
    {
      $ustUrunId = $this->selectFilterQuery("tbl_alt_urunler",array("ust_urun_id"),$veriKolonArray);
      $this->ustUrunId = $ustUrunId[0]["ust_urun_id"];
      return $this->ustUrunId;
    }
    public function setUstUrunId($yeniDeger)
    {
      $this->ustUrunId = $yeniDeger;
    }
    /*ÜST ÜRÜN ID GET SET END*/


    /*ALT ÜRÜN KODU GET SET START*/
    public function getAltUrunKodu($veriKolonArray)
    {
      $altUrunKodu = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_kodu"),$veriKolonArray);
      $this->altUrunKodu = $altUrunKodu[0]["alt_urun_kodu"];
      return $this->altUrunKodu;
    }
    public function setAltUrunKodu($yeniDeger)
    {
      $this->altUrunKodu = $yeniDeger;
    }
    /*ALT ÜRÜN KODU GET SET END*/


    /*ALT ÜRÜN PLU NOSU GET SET START*/
    public function getAltUrunPluNosu($veriKolonArray)
    {
      $altUrunPluNosu = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_plu_nosu"),$veriKolonArray);
      $this->altUrunPluNosu = $altUrunPluNosu[0]["alt_urun_plu_nosu"];
      return $this->altUrunPluNosu;
    }
    public function setAltUrunPluNosu($yeniDeger)
    {
      $this->altUrunPluNosu = $yeniDeger;
    }
    /*ALT ÜRÜN PLU NOSU GET SET END*/


    /*ALT ÜRÜN BARKODU GET SET START*/
    public function getAltUrunBarkodu($veriKolonArray)
    {
      $altUrunBarkodu = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_barkodu"),$veriKolonArray);
      $this->altUrunBarkodu = $altUrunBarkodu[0]["alt_urun_barkodu"];
      return $this->altUrunBarkodu;
    }
    public function setAltUrunBarkodu($yeniDeger)
    {
      $this->altUrunBarkodu = $yeniDeger;
    }
    /*ALT ÜRÜN BARKODU GET SET END*/


    /*ALT ÜRÜN ADI GET SET START*/
    public function getAltUrunAdi($veriKolonArray)
    {
      $altUrunAdi = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_adi"),$veriKolonArray);
      $this->altUrunAdi = $altUrunAdi[0]["alt_urun_adi"];
      return $this->altUrunAdi;
    }
    public function setAltUrunAdi($yeniDeger)
    {
      $this->altUrunAdi = $yeniDeger;
    }
    /*ALT ÜRÜN ADI GET SET END*/


    /*ALT ÜRÜN ADEDİ GET SET START*/
    public function getAltUrunAdedi($veriKolonArray)
    {
      $altUrunAdedi = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_adedi"),$veriKolonArray);
      $this->altUrunAdedi = $altUrunAdedi[0]["alt_urun_adedi"];
      return $this->altUrunAdedi;
    }
    public function setAltUrunAdedi($yeniDeger)
    {
      $this->altUrunAdedi = $yeniDeger;
    }
    /*ALT ÜRÜN ADEDİ GET SET END*/


    /*ALT ÜRÜN RENGİ GET SET START*/
    public function getAltUrunRengi($veriKolonArray)
    {
      $altUrunRengi = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_rengi"),$veriKolonArray);
      $this->altUrunRengi = $altUrunRengi[0]["alt_urun_rengi"];
      return $this->altUrunRengi;
    }
    public function setAltUrunRengi($yeniDeger)
    {
      $this->altUrunRengi = $yeniDeger;
    }
    /*ALT ÜRÜN RENGİ GET SET END*/


    /*ALT ÜRÜN ALT UYARI DEĞERİ GET SET START*/
    public function getAltUrunAltUyariDegeri($veriKolonArray)
    {
      $altUrunAltUyariDegeri = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_alt_uyari_degeri"),$veriKolonArray);
      $this->altUrunAltUyariDegeri = $altUrunAltUyariDegeri[0]["alt_urun_alt_uyari_degeri"];
      return $this->altUrunAltUyariDegeri;
    }
    public function setAltUrunAltUyariDegeri($yeniDeger)
    {
      $this->altUrunAltUyariDegeri = $yeniDeger;
    }
    /*ALT ÜRÜN ALT UYARI DEĞERİ GET SET END*/


    /*ALT ÜRÜN KUR IDSİ GET SET START*/
    public function getAltUrunKurIdsi($veriKolonArray)
    {
      $altUrunKurIdsi = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_kur_idsi"),$veriKolonArray);
      $this->altUrunKurIdsi = $altUrunKurIdsi[0]["alt_urun_kur_idsi"];
      return $this->altUrunKurIdsi;
    }
    public function setAltUrunKurIdsi($yeniDeger)
    {
      $this->altUrunKurIdsi = $yeniDeger;
    }
    /*ALT ÜRÜN KUR IDSİ GET SET END*/


    /*ALT KG FİYATI GET SET START*/
    public function getAltUrunKgFiyati($veriKolonArray)
    {
      $altUrunKgFiyati = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_kg_fiyati"),$veriKolonArray);
      $this->altUrunKgFiyati = $altUrunKgFiyati[0]["alt_urun_kg_fiyati"];
      return $this->altUrunKgFiyati;
    }
    public function setAltUrunKgFiyati($yeniDeger)
    {
      $this->altUrunKgFiyati = $yeniDeger;
    }
    /*ALT KG FİYATI GET SET END*/


    /*ALT ÜRÜN ALIŞ FİYATI GET SET START*/
    public function getAltUrunAlisFiyati($veriKolonArray)
    {
      $altUrunAlisFiyati = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_alis_fiyati"),$veriKolonArray);
      $this->altUrunAlisFiyati = $altUrunAlisFiyati[0]["alt_urun_alis_fiyati"];
      return $this->altUrunAlisFiyati;
    }
    public function setAltUrunAlisFiyati($yeniDeger)
    {
      $this->altUrunAlisFiyati = $yeniDeger;
    }
    /*ALT ÜRÜN ALIŞ FİYATI GET SET END*/


    /*ALT ÜRÜN SATIŞ FİYATI GET SET START*/
    public function getAltUrunSatisFiyati($veriKolonArray)
    {
      $altUrunSatisFiyati = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_satis_fiyati"),$veriKolonArray);
      $this->altUrunSatisFiyati = $altUrunSatisFiyati[0]["alt_urun_satis_fiyati"];
      return $this->altUrunSatisFiyati;
    }
    public function setAltUrunSatisFiyati($yeniDeger)
    {
      $this->altUrunSatisFiyati = $yeniDeger;
    }
    /*ALT ÜRÜN SATIŞ FİYATI GET SET END*/


    /*ALT ÜRÜN SATIŞ FİYATI GET SET START*/
    public function getAltUrunAlisVergiIdsi($veriKolonArray)
    {
      $altUrunAlisVergiIdsi = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_alis_vergi_idsi"),$veriKolonArray);
      $this->altUrunAlisVergiIdsi = $altUrunAlisVergiIdsi[0]["alt_urun_alis_vergi_idsi"];
      return $this->altUrunAlisVergiIdsi;
    }
    public function setAltUrunAlisVergiIdsi($yeniDeger)
    {
      $this->altUrunAlisVergiIdsi = $yeniDeger;
    }
    /*ALT ÜRÜN SATIŞ FİYATI GET SET END*/


    /*ALT ÜRÜN SATIŞ FİYATI GET SET START*/
    public function getAltUrunSatisVergiIdsi($veriKolonArray)
    {
      $altUrunSatisVergiIdsi = $this->selectFilterQuery("tbl_alt_urunler",array("alt_urun_satis_vergi_idsi"),$veriKolonArray);
      $this->altUrunSatisVergiIdsi = $altUrunSatisVergiIdsi[0]["alt_urun_satis_vergi_idsi"];
      return $this->altUrunSatisVergiIdsi;
    }
    public function setAltUrunSatisVergiIdsi($yeniDeger)
    {
      $this->altUrunSatisVergiIdsi = $yeniDeger;
    }
    /*ALT ÜRÜN SATIŞ FİYATI GET SET END*/


  }

  /**
   *
   */
  class StokDusme extends Urunler
  {

    public $stokDusmeIdsi;
    public $stokDusmeAitUrunIdsi;
    public $stokDusmeAitUrunTabloAdi;
    public $stokDusmeUrunIdsi;
    public $stokDusumMiktari;

    function __construct()
    {
      parent::__construct();
    }



    /*STOK DÜŞME IDSİ GET SET START*/
    public function getStokDusmeIdsi($veriKolonArray)
    {
      $stokDusmeIdsi = $this->selectFilterQuery("tbl_stok_dusme_bilgileri",array("id"),$veriKolonArray);
      $this->stokDusmeIdsi = $stokDusmeIdsi[0]["id"];
      return $this->stokDusmeIdsi;
    }
    public function setStokDusmeIdsi($yeniDeger)
    {
      $this->stokDusmeIdsi = $yeniDeger;
    }
    /*STOK DÜŞME IDSİ GET SET END*/


    /*STOK DÜŞME AİT ÜRÜN IDSİ GET SET START*/
    public function getStokDusmeAitUrunIdsi($veriKolonArray)
    {
      $stokDusmeAitUrunIdsi = $this->selectFilterQuery("tbl_stok_dusme_bilgileri",array("ait_urun_idsi"),$veriKolonArray);
      $this->stokDusmeAitUrunIdsi = $stokDusmeAitUrunIdsi[0]["ait_urun_idsi"];
      return $this->stokDusmeAitUrunIdsi;
    }
    public function setStokDusmeAitUrunIdsi($yeniDeger)
    {
      $this->stokDusmeAitUrunIdsi = $yeniDeger;
    }
    /*STOK DÜŞME AİT ÜRÜN IDSİ GET SET END*/


    /*STOK DÜŞME AİT ÜRÜN TABLO ADI GET SET START*/
    public function getStokDusmeAitUrunTabloAdi($veriKolonArray)
    {
      $stokDusmeAitUrunTabloAdi = $this->selectFilterQuery("tbl_stok_dusme_bilgileri",array("ait_urun_tablo_adi"),$veriKolonArray);
      $this->stokDusmeAitUrunTabloAdi = $stokDusmeAitUrunTabloAdi[0]["ait_urun_tablo_adi"];
      return $this->stokDusmeAitUrunTabloAdi;
    }
    public function setStokDusmeAitUrunTabloAdi($yeniDeger)
    {
      $this->stokDusmeAitUrunTabloAdi = $yeniDeger;
    }
    /*STOK DÜŞME AİT ÜRÜN TABLO ADI GET SET END*/


    /*STOK DÜŞME ÜRÜN IDSİ GET SET START*/
    public function getStokDusmeUrunIdsi($veriKolonArray)
    {
      $stokDusmeUrunIdsi = $this->selectFilterQuery("tbl_stok_dusme_bilgileri",array("stoktan_dusulecek_urun_idsi"),$veriKolonArray);
      $this->stokDusmeUrunIdsi = $stokDusmeUrunIdsi[0]["stoktan_dusulecek_urun_idsi"];
      return $this->stokDusmeUrunIdsi;
    }
    public function setStokDusmeUrunIdsi($yeniDeger)
    {
      $this->stokDusmeUrunIdsi = $yeniDeger;
    }
    /*STOK DÜŞME ÜRÜN IDSİ GET SET END*/


    /*STOK DÜŞME DÜŞÜM MİKTARI GET SET START*/
    public function getStokDusumMiktari($veriKolonArray)
    {
      $stokDusumMiktari = $this->selectFilterQuery("tbl_stok_dusme_bilgileri",array("stoktan_dusum_miktari"),$veriKolonArray);
      $this->stokDusumMiktari = $stokDusumMiktari[0]["stoktan_dusum_miktari"];
      return $this->stokDusumMiktari;
    }
    public function setStokDusumMiktari($yeniDeger)
    {
      $this->stokDusumMiktari = $yeniDeger;
    }
    /*STOK DÜŞME DÜŞÜM MİKTARI GET SET END*/

  }


?>
