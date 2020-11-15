<?php
  /**
   * PROGRAM BİLGİLERİ CLASS
   */
  class Program extends Model
  {
    public $programAyarlari;

    function __construct()
    {
      parent::__construct();
    }

    /*PROGRAM AYARLARI GET SET START*/
    public function getProgramAyarlari()
    {
      return $this->programAyarlari;
    }
    public function setProgramAyarlari($yeniDeger)
    {
      $this->programAyarlari = $yeniDeger;
    }
    /*PROGRAM AYARLARI GET SET END*/

  }

  /**
   *
   */
  class ProgramAyarlari extends Program
  {

    public $programAyarIdsi;
    public $programCallerIdAktifMi;
    public $programYazarkasaPosAktifMi;
    public $programYemeksepetiAktifMi;
    public $programBaslangicSaati;
    public $programBitisSaati;

    function __construct()
    {
      parent::__construct();
    }


    /*PROGRAM AYARLARI PROGRAM AYAR IDSİ GET SET START*/
    public function getProgramAyarIdsi($veriKolonArray)
    {
      $programAyarIdsi = $this->selectFilterQuery("tbl_program_ayarlari",array("id"),$veriKolonArray);
      $this->programAyarIdsi = $programAyarIdsi[0]["id"];
      return $this->programAyarIdsi;
    }
    public function setProgramAyarIdsi($yeniDeger)
    {
      $this->programAyarIdsi = $yeniDeger;
    }
    /*PROGRAM AYARLARI PROGRAM AYAR IDSİ GET SET END*/

    /*PROGRAM AYARLARI CALLER ID AKTİF Mİ GET SET START*/
    public function getProgramCallerIdAktifMi($veriKolonArray)
    {
      $programCallerIdAktifMi = $this->selectFilterQuery("tbl_program_ayarlari",array("caller_id_aktif_mi"),$veriKolonArray);
      $this->programCallerIdAktifMi = $programCallerIdAktifMi[0]["caller_id_aktif_mi"];
      return $this->programCallerIdAktifMi;
    }
    public function setProgramCallerIdAktifMi($yeniDeger)
    {
      $this->programCallerIdAktifMi = $yeniDeger;
    }
    /*PROGRAM AYARLARI CALLER ID AKTİF Mİ GET SET END*/

    /*PROGRAM AYARLARI YAZARKASA AKTİF Mİ GET SET START*/
    public function getProgramYazarkasaAktifMi($veriKolonArray)
    {
      $programYazarkasaAktifMi = $this->selectFilterQuery("tbl_program_ayarlari",array("yazarkasa_aktif_mi"),$veriKolonArray);
      $this->programYazarkasaAktifMi = $programYazarkasaAktifMi[0]["yazarkasa_aktif_mi"];
      return $this->programYazarkasaAktifMi;
    }
    public function setProgramYazarkasaAktifMi($yeniDeger)
    {
      $this->programYazarkasaAktifMi = $yeniDeger;
    }
    /*PROGRAM AYARLARI YAZARKASA AKTİF Mİ GET SET END*/

    /*PROGRAM AYARLARI YEMEKSEPETİ AKTİF Mİ GET SET START*/
    public function getProgramYemeksepetiAktifMi($veriKolonArray)
    {
      $programYemeksepetiAktifMi = $this->selectFilterQuery("tbl_program_ayarlari",array("yemeksepeti_aktif_mi"),$veriKolonArray);
      $this->programYemeksepetiAktifMi = $programYemeksepetiAktifMi[0]["yemeksepeti_aktif_mi"];
      return $this->programYemeksepetiAktifMi;
    }
    public function setProgramYemeksepetiAktifMi($yeniDeger)
    {
      $this->programYemeksepetiAktifMi = $yeniDeger;
    }
    /*PROGRAM AYARLARI YEMEKSEPETİ AKTİF Mİ GET SET END*/

    /*PROGRAM AYARLARI PROGRAM BAŞLANGIÇ SAATİ GET SET START*/
    public function getProgramBaslangicSaati($veriKolonArray)
    {
      $programBaslangicSaati = $this->selectFilterQuery("tbl_program_ayarlari",array("program_baslangic_saati"),$veriKolonArray);
      $this->programBaslangicSaati = $programBaslangicSaati[0]["program_baslangic_saati"];
      return $this->programBaslangicSaati;
    }
    public function setProgramBaslangicSaati($yeniDeger)
    {
      $this->programBaslangicSaati = $yeniDeger;
    }
    /*PROGRAM AYARLARI PROGRAM BAŞLANGIÇ SAATİ GET SET END*/

    /*PROGRAM AYARLARI PROGRAM BİTİŞ SAATİ GET SET START*/
    public function getProgramBitisSaati($veriKolonArray)
    {
      $programBitisSaati = $this->selectFilterQuery("tbl_program_ayarlari",array("program_bitis_saati"),$veriKolonArray);
      $this->programBitisSaati = $programBitisSaati[0]["program_bitis_saati"];
      return $this->programBitisSaati;
    }
    public function setProgramBitisSaati($yeniDeger)
    {
      $this->programBitisSaati = $yeniDeger;
    }
    /*PROGRAM AYARLARI PROGRAM BİTİŞ SAATİ GET SET END*/
  }


?>
