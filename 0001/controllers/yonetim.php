<?php
/**
 *
 */
class Yonetim extends Controller
{

  function __construct()
  {
    parent::__construct();
    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
      //DO NOTHING
    }else {
      require $this->yolPhp."settings/session-check.php";

      $model = new Model();

      /*masa durumlarını alma*/
      $stmt = $model->dbh->prepare("SELECT id,masa_durumu FROM tbl_masalar");
      $stmt->execute();
      $masalar = $stmt->fetchAll();
      /*masa durumlarını alma*/

      /*masa doluluk oranı çıkarma*/
      $acikMasaSayisi = 0;
      for ($i=0; $i < count($masalar); $i++) {
        if ($masalar[$i]["masa_durumu"] == 1) {
          $acikMasaSayisi++;
        }
      }
      $masaDolulukOrani = ($acikMasaSayisi / count($masalar)) * 100;
      /*masa doluluk oranı çıkarma*/

      /*aktif çalışan sayısını bulma*/
      $stmt = $model->dbh->prepare("SELECT id,calisan_aktif_mi,calisan_dogum_tarihi,calisan_adi_soyadi FROM tbl_calisanlar");
      $stmt->execute();
      $calisanlar = $stmt->fetchAll();

      $aktifCalisanSayisi = 0;

      for ($i=0; $i < count($calisanlar); $i++) {

        if ($calisanlar[$i]["calisan_aktif_mi"] == 1) {
          $aktifCalisanSayisi++;
        }
      }
      /*aktif çalışan sayısını bulma*/


      /*calisan doğum günü sorguları*/
      $stmt = $model->dbh->prepare("SELECT MONTH(calisan_dogum_tarihi) AS calisan_dogum_ayi,DAY(calisan_dogum_tarihi) AS calisan_dogum_gunu FROM tbl_calisanlar");
      $stmt->execute();
      $calisanDogumTarihleri = $stmt->fetchAll();

      $tarih = date("m-d");
      $dogumGunuOlanCalisanlar = array();

      for ($i=0; $i < count($calisanDogumTarihleri); $i++) {
        $calisanDogumTarihleri[$i]["calisan_dogum_ayi"] = str_pad($calisanDogumTarihleri[$i]["calisan_dogum_ayi"], 2, '0', STR_PAD_LEFT);
        $calisanDogumTarihleri[$i]["calisan_dogum_gunu"] = str_pad($calisanDogumTarihleri[$i]["calisan_dogum_gunu"], 2, '0', STR_PAD_LEFT);
        $calisanDogumTarihi = $calisanDogumTarihleri[$i]["calisan_dogum_ayi"]."-".$calisanDogumTarihleri[$i]["calisan_dogum_gunu"];

        if ($calisanDogumTarihi == $tarih) {
          array_push($dogumGunuOlanCalisanlar,$calisanlar[$i]["calisan_adi_soyadi"]);
        }

      }
      /*calisan doğum günü sorguları*/

      /*adisyon toplamını hesaplama*/
      $stmt = $model->dbh->prepare("SELECT SUM(adisyon_tutari) AS toplam_adisyon_tutari FROM tbl_adisyonlar WHERE adisyon_odeme_durumu=0");
      $stmt->execute();
      $toplamAdisyonTutari = $stmt->fetch()["toplam_adisyon_tutari"];
      /*adisyon toplamını hesaplama*/


      $json = file_get_contents($this->yolPhp."documents/sabit-veriler/onemli-tarihler.json");
      $json = json_decode($json,true);
      $gununOnemliTarihleri = array();
      for ($i=0; $i < count($json["onemliTarihler"]); $i++) {
        $json["onemliTarihler"][$i]["ay"] = str_pad($json["onemliTarihler"][$i]["ay"], 2, '0', STR_PAD_LEFT);
        $json["onemliTarihler"][$i]["gun"] = str_pad($json["onemliTarihler"][$i]["gun"], 2, '0', STR_PAD_LEFT);
        $onemliTarih = $json["onemliTarihler"][$i]["ay"]."-".$json["onemliTarihler"][$i]["gun"];
        if ($tarih == $onemliTarih) {
          array_push($gununOnemliTarihleri,$json["onemliTarihler"][$i]["aciklama"]);
        }
      }

      $this->view->varsayilanKurIsareti = $this->kurIsaretiniAl();
      $this->view->gununOnemliTarihleri = $gununOnemliTarihleri;
      $this->view->dogumGunuOlanCalisanlar = $dogumGunuOlanCalisanlar;
      $this->view->toplamAdisyonTutari = $toplamAdisyonTutari;
      $this->view->toplamCalisanSayisi = count($calisanlar);
      $this->view->aktifCalisanSayisi = $aktifCalisanSayisi;
      $this->view->acikMasaSayisi = $acikMasaSayisi;
      $this->view->masaDolulukOrani = round($masaDolulukOrani);
      $this->view->render("yonetim");
    }
  }



}
