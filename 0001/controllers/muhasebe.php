<?php

/**
*
*/
class Muhasebe extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;


  function __construct()
  {
    parent::__construct();

    $this->sayfaIzınAdi = "txtMuhasebeMerkezineGirebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT kur_isareti FROM tbl_kurlar WHERE kur_aktif_mi=1");
      $stmt->execute();
      $this->varsayilanKurIsareti = $stmt->fetch()["kur_isareti"];
      $model = null;
    }
  }

  /*MUHASEBE GENEL BAKIŞ SAYFASI KODLARI*/
  public function genelBakis()
  {

    /*KUR İŞARETİ*/
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT kur_isareti FROM tbl_kurlar WHERE kur_aktif_mi=1");
    $stmt->execute();
    $kurIsareti = $stmt->fetch()["kur_isareti"];
    $model = null;
    /*KUR İŞARETİ*/

    /*PROGRAM BAŞLANGIÇ VE BİTİŞ SAATİ*/
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT program_baslangic_saati,program_bitis_saati FROM tbl_program_ayarlari WHERE id=(SELECT MAX(id) FROM tbl_program_ayarlari)");
    $stmt->execute();
    $programSaatBilgileri = $stmt->fetch();
    $model = null;
    /*PROGRAM BAŞLANGIÇ VE BİTİŞ SAATİ*/

    /*YAKLAŞAN ALIŞ FATURALARI*/
    $baslangicTarihi = date("Y-m-d");
    $bitisTarihi =  date('Y-m-d',strtotime("+3 days"));

    $baslangicTarihi = $baslangicTarihi." ".$programSaatBilgileri["program_baslangic_saati"];
    $bitisTarihi = $bitisTarihi." ".$programSaatBilgileri["program_bitis_saati"];


    $model = new Model();
    $stmt = $model->dbh->prepare(
      "SELECT tbl_alis_faturalari.id,tbl_alis_faturalari.alis_faturasi_vade_tarihi,tbl_alis_faturalari.alis_faturasi_tutari,tbl_musteriler.musteri_adi_soyadi
      FROM tbl_alis_faturalari
      INNER JOIN tbl_musteriler ON tbl_alis_faturalari.alis_faturasi_cari_idsi=tbl_musteriler.id
      WHERE tbl_alis_faturalari.alis_faturasi_vade_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
    );
    $stmt->execute([
      'baslangic_tarihi'=>$baslangicTarihi,
      'bitis_tarihi'=>$bitisTarihi
    ]);
    $yaklasanAlisFaturalari = $stmt->fetchAll();
    /*YAKLAŞAN ALIŞ FATURALARI*/



    /*YAKLAŞAN SATIŞ FATURALARI*/
    $model = new Model();
    $stmt = $model->dbh->prepare(
      "SELECT tbl_satis_faturalari.id,tbl_satis_faturalari.satis_faturasi_vade_tarihi,tbl_satis_faturalari.satis_faturasi_tutari,tbl_musteriler.musteri_adi_soyadi
      FROM tbl_satis_faturalari
      INNER JOIN tbl_musteriler ON tbl_satis_faturalari.satis_faturasi_cari_idsi=tbl_musteriler.id
      WHERE tbl_satis_faturalari.satis_faturasi_vade_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
    );
    $stmt->execute([
      'baslangic_tarihi'=>$baslangicTarihi,
      'bitis_tarihi'=>$bitisTarihi
    ]);
    $yaklasanSatisFaturalari = $stmt->fetchAll();
    /*YAKLAŞAN SATIŞ FATURALARI*/


    $this->view->yaklasanSatisFaturalari = $yaklasanSatisFaturalari;
    $this->view->yaklasanAlisFaturalari = $yaklasanAlisFaturalari;
    $this->view->programSaatBilgileri = $programSaatBilgileri;
    $this->view->kurIsareti = $kurIsareti;
    $this->view->bugun = date("Y-m-d");
    $this->view->yarin = date('Y-m-d',strtotime("+1 days"));
    $this->view->render("merkezler/muhasebe/genel-bakis");
  }
  /*MUHASEBE GENEL BAKIŞ SAYFASI KODLARI*/


  /*MUHASEBE RAPORUNU AL KODLARI*/
  public function muhasebeRaporunuAl()
  {
    if (isset($_POST["muhasebeRaporunuAl"])) {
      $veriler = json_decode($_POST["muhasebeRaporunuAl"],true);

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      /*adisyon toplamları*/
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT adisyon_tutari,adisyon_indirim_turu,adisyon_indirim_miktari FROM tbl_adisyonlar WHERE adisyon_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi");
      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $adisyonBilgileri = $stmt->fetchAll();

      $adisyonIndirimTutari = 0;
      $adisyonToplami = 0;
      for ($i=0; $i < count($adisyonBilgileri); $i++) {
        if ($adisyonBilgileri[$i]["adisyon_indirim_turu"] == "0") {
          $adisyonIndirimTutari += ($adisyonBilgileri[$i]["adisyon_indirim_miktari"] * 100) / 100;
          $adisyonToplami += $adisyonBilgileri[$i]["adisyon_tutari"] - $adisyonIndirimTutari;
        }else {
          $adisyonIndirimTutari += $adisyonBilgileri[$i]["adisyon_indirim_miktari"];
          $adisyonToplami += $adisyonBilgileri[$i]["adisyon_tutari"] - $adisyonBilgileri[$i]["adisyon_indirim_miktari"];
        }
      }

      $adisyonToplami = abs($adisyonToplami);
      /*adisyon toplamları*/



      /*satış faturaları toplamları*/
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT SUM(satis_faturasi_tutari) AS toplam_satis_faturalari_tutari FROM tbl_satis_faturalari WHERE satis_faturasi_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi");
      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $satisFaturalariToplami = $stmt->fetch()["toplam_satis_faturalari_tutari"];
      /*satış faturaları toplamları*/

      /*gelir toplamları*/
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT SUM(tahsilat_tutari) AS toplam_tahsilat_tutari FROM tbl_tahsilatlar WHERE tahsilat_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi");
      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $toplamTahsilatTutari = $stmt->fetch()["toplam_tahsilat_tutari"];
      /*gelir toplamları*/

      $toplamGelir = $toplamTahsilatTutari + $satisFaturalariToplami + $adisyonToplami;


      /*gider toplamları*/
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT SUM(odeme_tutari) AS toplam_odeme_tutari FROM tbl_odemeler WHERE odeme_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi");
      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $toplamOdemeTutari = $stmt->fetch()["toplam_odeme_tutari"];
      /*gider toplamları*/

      /*alış faturaları toplamları*/
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT SUM(alis_faturasi_tutari) AS toplam_alis_faturalari_tutari FROM tbl_alis_faturalari WHERE alis_faturasi_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi");
      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $alisFaturalariToplami = $stmt->fetch()["toplam_alis_faturalari_tutari"];
      /*alış faturaları toplamları*/

      $toplamGider = $toplamOdemeTutari + $alisFaturalariToplami;

      $toplamKar = $toplamGelir - $toplamGider;

      /*alacak toplamları*/
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT SUM(alacak_tutari) AS toplam_alacak_tutari FROM tbl_alacaklar WHERE alacak_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi");
      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $alacakToplami = $stmt->fetch()["toplam_alacak_tutari"];
      /*alacak toplamları*/

      /*verecek toplamları*/
      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT SUM(verecek_tutari) AS toplam_verecek_tutari FROM tbl_verecekler WHERE verecek_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi");
      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $verecekToplami = $stmt->fetch()["toplam_verecek_tutari"];
      /*verecek toplamları*/

      $borcBakiyesi = $alacakToplami - $verecekToplami;

      echo json_encode(array(
        "adisyonToplami"=>$adisyonToplami,
        "adisyonIndirimTutari"=>$adisyonIndirimTutari,
        "satisFaturalariToplami"=>$satisFaturalariToplami,
        "toplamTahsilatTutari"=>$toplamTahsilatTutari,
        "toplamGelir"=>$toplamGelir,
        "toplamOdemeTutari"=>$toplamOdemeTutari,
        "alisFaturalariToplami"=>$alisFaturalariToplami,
        "toplamGider"=>$toplamGider,
        "toplamKar"=>$toplamKar,
        "alacakToplami"=>$alacakToplami,
        "verecekToplami"=>$verecekToplami,
        "borcBakiyesi"=>$borcBakiyesi
      ));
    }
  }
  /*MUHASEBE RAPORUNU AL KODLARI*/

  /*MUHASEBE TAHSİLATLARI AL*/
  public function muhasebeTahsilatlariAl()
  {
    if (isset($_POST["muhasebeTahsilatlariAl"])) {
      $veriler = json_decode($_POST["muhasebeTahsilatlariAl"],true);

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_musteriler.musteri_adi_soyadi,tbl_tahsilatlar.tahsilat_tutari,tbl_tahsilatlar.tahsilat_aciklamasi,tbl_tahsilatlar.tahsilat_tarihi
        FROM tbl_tahsilatlar
        INNER JOIN tbl_musteriler ON tbl_tahsilatlar.tahsilat_cari_idsi=tbl_musteriler.id
        WHERE tbl_tahsilatlar.tahsilat_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
      );

      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $tahsilatlar = $stmt->fetchAll();

      echo json_encode(array(
        "tahsilatlar"=>$tahsilatlar
      ));
    }
  }
  /*MUHASEBE TAHSİLATLARI AL*/

  /*MUHASEBE ÖDEMELERİ AL*/
  public function muhasebeOdemeleriAl()
  {
    if (isset($_POST["muhasebeOdemeleriAl"])) {
      $veriler = json_decode($_POST["muhasebeOdemeleriAl"],true);

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_musteriler.musteri_adi_soyadi,tbl_odemeler.odeme_tutari,tbl_odemeler.odeme_aciklamasi,tbl_odemeler.odeme_tarihi
        FROM tbl_odemeler
        INNER JOIN tbl_musteriler ON tbl_odemeler.odeme_cari_idsi=tbl_musteriler.id
        WHERE tbl_odemeler.odeme_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
      );

      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $odemeler = $stmt->fetchAll();

      echo json_encode(array(
        "odemeler"=>$odemeler
      ));
    }
  }
  /*MUHASEBE ÖDEMELERİ AL*/

  /*MUHASEBE SATIŞ FATURALARINI AL*/
  public function muhasebeSatisFaturalariniAl()
  {
    if (isset($_POST["muhasebeSatisFaturalariniAl"])) {
      $veriler = json_decode($_POST["muhasebeSatisFaturalariniAl"],true);

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_musteriler.musteri_adi_soyadi,tbl_satis_faturalari.satis_faturasi_vade_tarihi,tbl_satis_faturalari.satis_faturasi_tarihi,tbl_satis_faturalari.satis_faturasi_tutari,
        tbl_satis_faturalari.satis_faturasi_aciklamasi
        FROM tbl_satis_faturalari
        INNER JOIN tbl_musteriler ON tbl_satis_faturalari.satis_faturasi_cari_idsi=tbl_musteriler.id
        WHERE tbl_satis_faturalari.satis_faturasi_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
      );

      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $satisFaturalari = $stmt->fetchAll();

      echo json_encode(array(
        "satisFaturalari"=>$satisFaturalari
      ));
    }
  }
  /*MUHASEBE SATIŞ FATURALARINI AL*/

  /*MUHASEBE ALIŞ FATURALARINI AL*/
  public function muhasebeAlisFaturalariniAl()
  {
    if (isset($_POST["muhasebeAlisFaturalariniAl"])) {
      $veriler = json_decode($_POST["muhasebeAlisFaturalariniAl"],true);

      $veriler["txtBaslangicTarihi"] = $veriler["txtBaslangicTarihi"]." ".$veriler["txtBaslangicSaati"];
      $veriler["txtBitisTarihi"] = $veriler["txtBitisTarihi"]." ".$veriler["txtBitisSaati"];

      $model = new Model();
      $stmt = $model->dbh->prepare(
        "SELECT tbl_musteriler.musteri_adi_soyadi,tbl_alis_faturalari.alis_faturasi_vade_tarihi,tbl_alis_faturalari.alis_faturasi_tarihi,tbl_alis_faturalari.alis_faturasi_tutari,
        tbl_alis_faturalari.alis_faturasi_aciklamasi
        FROM tbl_alis_faturalari
        INNER JOIN tbl_musteriler ON tbl_alis_faturalari.alis_faturasi_cari_idsi=tbl_musteriler.id
        WHERE tbl_alis_faturalari.alis_faturasi_tarihi BETWEEN :baslangic_tarihi AND :bitis_tarihi"
      );

      $stmt->execute([
        'baslangic_tarihi'=>$veriler["txtBaslangicTarihi"],
        'bitis_tarihi'=>$veriler["txtBitisTarihi"]
      ]);
      $alisFaturalari = $stmt->fetchAll();

      echo json_encode(array(
        "alisFaturalari"=>$alisFaturalari
      ));
    }
  }
  /*MUHASEBE ALIŞ FATURALARINI AL*/

}
