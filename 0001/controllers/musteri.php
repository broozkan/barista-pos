<?php

/**
 *
 */
class Musteri extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_musteriler");
    $this->kolonAdlari = array("musteri_adi_soyadi","musteri_telefon_numarasi","musteri_eposta_adresi","musteri_notlari","musteri_indirim_turu","musteri_indirim_miktari");

    $this->sayfaIzınAdi = "txtMusteriEkleyebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function musteriProfil($musteriIdsi = false)
  {
    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_musteriler WHERE id=:id");
    $stmt->execute(['id'=>$musteriIdsi]);
    $musteri = $stmt->fetch();

    $this->view->musteri = $musteri;
    $this->view->render("birimler/musteri/musteri-profil");
  }

  public function musterilistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $musteri = new Musteriler();
    $toplamVeriSayisi = $musteri->selectQuery($this->tabloAdlari[0],array("id"));
    $musteriIdleri = $musteri->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);
    for ($i=0; $i < count($musteriIdleri); $i++) {
      $musteriListesi[] = array(
        "musteriId"=>$musteriIdleri[$i]["id"],
        "musteriAdiSoyadi"=>$musteri->getMusteriAdiSoyadi(array("id"=>$musteriIdleri[$i]["id"])),
        "musteriTelefonNumarasi"=>$musteri->getMusteriTelefonNumarasi(array("id"=>$musteriIdleri[$i]["id"])),
        "musteriEpostaAdresi"=>$musteri->getMusteriEpostaAdresi(array("id"=>$musteriIdleri[$i]["id"]))
      );
    }


    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $this->view->musteriListesi = @$musteriListesi;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("birimler/musteri/musteri-listesi");
  }

  public function musteriekle()
  {
    if (isset($_POST["musteriEkle"])) {
      $veriler = json_decode($_POST["musteriEkle"],true);


      $model = new Model();

      $musteri = new Musteriler();
      $musteri->setMusteriAdiSoyadi($veriler["txtMusteriAdiSoyadi"]);
      $musteri->setMusteriTelefonNumarasi($veriler["txtMusteriTelefonNumarasi"]);
      $musteri->setMusteriEpostaAdresi($veriler["txtMusteriEpostaAdresi"]);
      $musteri->setMusteriNotlari($veriler["txtMusteriNotlari"]);
      $musteri->setMusteriIndirimTuru($veriler["txtMusteriIndirimTuru"]);
      $musteri->setMusteriIndirimMiktari($veriler["txtMusteriIndirimMiktari"]);

      $musteri->MusteriAdresleri = new MusteriAdresleri();


      $this->values = array(
        $musteri->musteriAdiSoyadi,
        $musteri->musteriTelefonNumarasi,
        $musteri->musteriEpostaAdresi,
        $musteri->musteriNotlari,
        $musteri->musteriIndirimTuru,
        $musteri->musteriIndirimMiktari
      );
      $yanit = $this->dataInsert();
      $musteriIdsi = $yanit["lastId"];

      if ($yanit["yanit"]) {
        for ($i=0; $i < count($veriler["txtMusteriAdresleri"]); $i++) {
          $musteri->MusteriAdresleri->setMusteriAdresleriMusteriIdsi($musteriIdsi);
          $musteri->MusteriAdresleri->setMusteriAdresleriAdres($veriler["txtMusteriAdresleri"][$i]);
          if ($i == 0) {
            $musteri->MusteriAdresleri->setMusteriAdresleriAdresVarsayilanMi(1);
          }else {
            $musteri->MusteriAdresleri->setMusteriAdresleriAdresVarsayilanMi(0);
          }

          $stmt = $model->dbh->prepare(
            "INSERT INTO tbl_musteri_adresleri SET
            musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi,
            musteri_adresleri_adres=:musteri_adresleri_adres,
            musteri_adresleri_adres_varsayilan_mi=:musteri_adresleri_adres_varsayilan_mi"
          );
          $yanit = $stmt->execute([
            "musteri_adresleri_musteri_idsi"=>$musteri->MusteriAdresleri->musteriAdresleriMusteriIdsi,
            "musteri_adresleri_adres"=>$musteri->MusteriAdresleri->musteriAdresleriAdres,
            "musteri_adresleri_adres_varsayilan_mi"=>$musteri->MusteriAdresleri->musteriAdresleriAdresVarsayilanMi
          ]);

        }
      }

      $musteri = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {

      $this->view->render("birimler/musteri/musteri-ekle");
    }
  }

  public function musteriduzenle($idler = false)
  {
    if (isset($_POST["musteriDuzenle"])) {
      $veriler = json_decode($_POST["musteriDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $model = new Model();
        $musteri = new Musteriler();
        $musteri->musteriAdresleri = new MusteriAdresleri();

        $musteri->setMusteriIdsi($veriler[$i]["txtMusteriId"]);
        $musteri->setMusteriAdiSoyadi($veriler[$i]["txtMusteriAdiSoyadi"]);
        $musteri->setMusteriTelefonNumarasi($veriler[$i]["txtMusteriTelefonNumarasi"]);
        $musteri->setMusteriEpostaAdresi($veriler[$i]["txtMusteriEpostaAdresi"]);
        $musteri->setMusteriNotlari($veriler[$i]["txtMusteriNotlari"]);
        $musteri->setMusteriIndirimTuru($veriler[$i]["txtMusteriIndirimTuru"]);
        $musteri->setMusteriIndirimMiktari($veriler[$i]["txtMusteriIndirimMiktari"]);
        $this->values = array(
          "musteri_adi_soyadi"=>$musteri->musteriAdiSoyadi,
          "musteri_telefon_numarasi"=>$musteri->musteriTelefonNumarasi,
          "musteri_eposta_adresi"=>$musteri->musteriEpostaAdresi,
          "musteri_notlari"=>$musteri->musteriNotlari,
          "musteri_indirim_turu"=>$musteri->musteriIndirimTuru,
          "musteri_indirim_miktari"=>$musteri->musteriIndirimMiktari,
          "id"=>$musteri->musteriIdsi
        );
        $yanit = $this->dataUpdate();

        if ($yanit) {
          $stmt = $model->dbh->prepare("DELETE FROM tbl_musteri_adresleri WHERE musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi");
          $yanit = $stmt->execute(["musteri_adresleri_musteri_idsi"=>$musteri->musteriIdsi]);
          if ($yanit) {
            for ($a=0; $a < count($veriler[$i]["txtMusteriAdresleri"]); $a++) {
              $musteri->musteriAdresleri->setMusteriAdresleriMusteriIdsi($musteri->musteriIdsi);
              $musteri->musteriAdresleri->setMusteriAdresleriAdres($veriler[$i]["txtMusteriAdresleri"][$a]);
              if ($a == 0) {
                $musteri->musteriAdresleri->setMusteriAdresleriAdresVarsayilanMi(1);
              }else {
                $musteri->musteriAdresleri->setMusteriAdresleriAdresVarsayilanMi(0);
              }

              $stmt = $model->dbh->prepare(
                "INSERT INTO tbl_musteri_adresleri SET
                musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi,
                musteri_adresleri_adres=:musteri_adresleri_adres,
                musteri_adresleri_adres_varsayilan_mi=:musteri_adresleri_adres_varsayilan_mi"
              );
              $yanit = $stmt->execute([
                "musteri_adresleri_musteri_idsi"=>$musteri->musteriAdresleri->musteriAdresleriMusteriIdsi,
                "musteri_adresleri_adres"=>$musteri->musteriAdresleri->musteriAdresleriAdres,
                "musteri_adresleri_adres_varsayilan_mi"=>$musteri->musteriAdresleri->musteriAdresleriAdresVarsayilanMi
              ]);

            }
          }
        }
      }
      $musteri = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {

          $model = new Model();
          $musteri = new Musteriler();
          $musteri->musteriAdresleri = new MusteriAdresleri();
          $musteri->musteriAdresleri->setMusteriAdresleriMusteriIdsi($idler[$i]);

          $stmt = $model->dbh->prepare(
            "SELECT musteri_adresleri_adres FROM tbl_musteri_adresleri WHERE musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi"
          );
          $stmt->execute([
            "musteri_adresleri_musteri_idsi"=>$musteri->musteriAdresleri->musteriAdresleriMusteriIdsi
          ]);

          $musteriAdresleri = $stmt->fetchAll();

          $musteriBilgileri[] = array(
            "musteriIdsi"=>$idler[$i],
            "musteriAdiSoyadi"=>$musteri->getMusteriAdiSoyadi(array("id"=>$idler[$i])),
            "musteriAdresleri"=>$musteriAdresleri,
            "musteriTelefonNumarasi"=>$musteri->getMusteriTelefonNumarasi(array("id"=>$idler[$i])),
            "musteriEpostaAdresi"=>$musteri->getMusteriEpostaAdresi(array("id"=>$idler[$i])),
            "musteriNotlari"=>$musteri->getMusteriNotlari(array("id"=>$idler[$i])),
            "musteriIndirimTuru"=>$musteri->getMusteriIndirimTuru(array("id"=>$idler[$i])),
            "musteriIndirimMiktari"=>$musteri->getMusteriIndirimMiktari(array("id"=>$idler[$i]))
          );
        }
      }

      $musteri = null;
      $model = null;
      $this->view->musteriBilgileri = $musteriBilgileri;

      $this->view->render("birimler/musteri/musteri-duzenle");
    }
  }

  public function musteriSil()
  {
    if (isset($_POST["musteriSil"])) {
      $veriler = json_decode($_POST["musteriSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $musteri = new Musteriler();
        $model = new Model();
        $musteri->setMusteriIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$musteri->musteriIdsi
        );
        $yanit = $this->dataDelete();

        if ($yanit) {
          $musteri->MusteriAdresleri = new MusteriAdresleri();
          $musteri->MusteriAdresleri->setMusteriAdresleriMusteriIdsi($veriler[$i]["id"]);
          $stmt = $model->dbh->prepare(
            "DELETE FROM tbl_musteri_adresleri WHERE musteri_adresleri_musteri_idsi=:musteri_adresleri_musteri_idsi"
          );
          $yanit = $stmt->execute([
            "musteri_adresleri_musteri_idsi"=>$musteri->MusteriAdresleri->musteriAdresleriMusteriIdsi
          ]);

        }
      }

      $musteri = null;
      $model = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
