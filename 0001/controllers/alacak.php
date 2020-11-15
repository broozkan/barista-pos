<?php

/**
 *
 */
class Alacak extends Controller
{
  public $limit = 50;
  public $offset = 0;
  public $sayfa = 1;

  function __construct()
  {
    parent::__construct();

    $this->tabloAdlari = array("tbl_alacaklar");
    $this->kolonAdlari = array("alacak_kodu","alacak_cari_idsi","alacak_tutari","alacak_kasa_idsi","alacak_aciklamasi");

    $this->sayfaIzınAdi = "txtMuhasebeMerkezineGirebilir";

    require $this->yolPhp."settings/permission-check.php";

    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {


    }else {
      require $this->yolPhp."settings/session-check.php";
    }
  }

  public function alacaklistesi()
  {

    $keys = false;
    $parameters = false;

    if (isset($_GET["lim"])) {
      $this->limit = $_GET["lim"];
    }elseif (isset($_GET["p"])) {
      $this->sayfa = $_GET["p"];
      $this->offset = ($this->sayfa - 1) * $this->limit;
    }



    $alacak = new Alacaklar();
    $musteri = new Musteriler();
    $kasa = new Kasalar();
    $toplamVeriSayisi = $alacak->selectQuery($this->tabloAdlari[0],array("id"));
    $alacakIdleri = $alacak->selectLimitQuery($this->tabloAdlari[0],array("id"),array("limit"=>$this->limit,"offset"=>$this->offset),$keys,$parameters);


    for ($i=0; $i < count($alacakIdleri); $i++) {
      $alacakCariIdsi = $alacak->getAlacakCariIdsi(array("id"=>$alacakIdleri[$i]["id"]));
      $alacakKasaIdsi = $alacak->getAlacakKasaIdsi(array("id"=>$alacakIdleri[$i]["id"]));

      $alacakCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$alacakCariIdsi));
      $alacakKasaAdi = $kasa->getKasaAdi(array("id"=>$alacakKasaIdsi));

      $alacakListesi[] = array(
        "alacakId"=>$alacakIdleri[$i]["id"],
        "alacakKodu"=>$alacak->getAlacakKodu(array("id"=>$alacakIdleri[$i]["id"])),
        "alacakCariAdi"=>$alacakCariAdi,
        "alacakTutari"=>$alacak->getAlacakTutari(array("id"=>$alacakIdleri[$i]["id"])),
        "alacakKasaAdi"=>$alacakKasaAdi,
        "alacakAciklamasi"=>$alacak->getAlacakAciklamasi(array("id"=>$alacakIdleri[$i]["id"]))
      );
    }

    $model = new Model();
    $stmt = $model->dbh->prepare("SELECT * FROM tbl_kasalar");
    $stmt->execute();
    $kasalar = $stmt->fetchAll();
    $model = null;

    $this->view->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    @$this->view->alacakListesi = $alacakListesi;
    $this->view->kasalar = $kasalar;
    $this->view->aktifSayfaNumarasi = $this->sayfa;
    $this->view->sayfaSayisi = ceil(count($toplamVeriSayisi) / $this->limit);
    $this->view->render("merkezler/alacak/alacak-listesi");
  }

  public function alacakekle()
  {
    if (isset($_POST["alacakEkle"])) {
      $veriler = json_decode($_POST["alacakEkle"],true);
      $alacak = new Alacaklar();
      $alacak->setAlacakKodu($veriler["txtAlacakKodu"]);
      $alacak->setAlacakCariIdsi($veriler["txtAlacakCariIdsi"]);
      $alacak->setAlacakTutari($veriler["txtAlacakTutari"]);
      $alacak->setAlacakKasaIdsi($veriler["txtAlacakKasaIdsi"]);
      $alacak->setAlacakAciklamasi($veriler["txtAlacakAciklamasi"]);
      $this->values = array(
        $alacak->alacakKodu,
        $alacak->alacakCariIdsi,
        $alacak->alacakTutari,
        $alacak->alacakKasaIdsi,
        $alacak->alacakAciklamasi
      );
      $yanit = $this->dataInsert();
      $alacak = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $stmt = $model->dbh->prepare("SELECT id FROM tbl_kasalar WHERE kasa_birincil_kasa_mi=1");
      $stmt->execute();
      $birincilKasaIdsi = $stmt->fetch();


      $this->view->kasalar = $kasalar;
      $this->view->birincilKasaIdsi = $birincilKasaIdsi["id"];
      $this->view->render("merkezler/alacak/alacak-ekle");
    }
  }

  public function alacakduzenle($idler = false)
  {
    if (isset($_POST["alacakDuzenle"])) {
      $veriler = json_decode($_POST["alacakDuzenle"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $alacak = new Alacaklar();
        $alacak->setAlacakKodu($veriler[$i]["txtAlacakKodu"]);
        $alacak->setAlacakCariIdsi($veriler[$i]["txtAlacakCariIdsi"]);
        $alacak->setAlacakTutari($veriler[$i]["txtAlacakTutari"]);
        $alacak->setAlacakKasaIdsi($veriler[$i]["txtAlacakKasaIdsi"]);
        $alacak->setAlacakAciklamasi($veriler[$i]["txtAlacakAciklamasi"]);
        $alacak->setAlacakIdsi($veriler[$i]["txtAlacakId"]);
        $this->values = array(
          "alacak_kodu"=>$alacak->alacakKodu,
          "alacak_cari_idsi"=>$alacak->alacakCariIdsi,
          "alacak_tutari"=>$alacak->alacakTutari,
          "alacak_kasa_idsi"=>$alacak->alacakKasaIdsi,
          "alacak_aciklamasi"=>$alacak->alacakAciklamasi,
          "id"=>$alacak->alacakIdsi
        );
        $yanit = $this->dataUpdate();
      }
      $alacak = null;
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }else {
      $idler = explode(",",$idler);
      for ($i=0; $i < count($idler); $i++) {
        if ($idler[$i]) {
          $alacak = new Alacaklar();
          $musteri = new Musteriler();
          $kasa = new Kasalar();

          $alacakCariIdsi = $alacak->getAlacakCariIdsi(array("id"=>$idler[$i]));
          $alacakKasaIdsi = $alacak->getAlacakKasaIdsi(array("id"=>$idler[$i]));

          $alacakCariAdi = $musteri->getMusteriAdiSoyadi(array("id"=>$alacakCariIdsi));
          $alacakKasaAdi = $kasa->getKasaAdi(array("id"=>$alacakKasaIdsi));

          $alacakBilgileri[] = array(
            "alacakId"=>$idler[$i],
            "alacakKodu"=>$alacak->getAlacakKodu(array("id"=>$idler[$i])),
            "alacakCariAdi"=>$alacakCariAdi,
            "alacakCariIdsi"=>$alacakCariIdsi,
            "alacakTutari"=>$alacak->getAlacakTutari(array("id"=>$idler[$i])),
            "alacakKasaIdsi"=>$alacak->getAlacakKasaIdsi(array("id"=>$idler[$i])),
            "alacakAciklamasi"=>$alacak->getAlacakAciklamasi(array("id"=>$idler[$i]))
          );
        }
      }
      $alacak = null;

      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,kasa_adi FROM tbl_kasalar");
      $stmt->execute();
      $kasalar = $stmt->fetchAll();

      $this->view->kasalar = $kasalar;
      $this->view->alacakBilgileri = $alacakBilgileri;
      $this->view->render("merkezler/alacak/alacak-duzenle");
    }
  }

  public function alacakSil()
  {
    if (isset($_POST["alacakSil"])) {
      $veriler = json_decode($_POST["alacakSil"],true);
      for ($i=0; $i < count($veriler); $i++) {
        $alacak = new Alacaklar();
        $alacak->setAlacakIdsi($veriler[$i]["id"]);
        $this->values = array(
          "id"=>$alacak->alacakIdsi
        );
        $yanit = $this->dataDelete();
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }

  public function alacakBilgileriniAl()
  {
    if (isset($_POST["alacakBilgileriniAl"])) {
      $alacakIdsi = $_POST["alacakBilgileriniAl"];

      $model = new Model();
      $stmt = $model->dbh->prepare("SELECT tbl_alacaklar.*,tbl_musteriler.musteri_adi_soyadi,tbl_kasalar.kasa_adi
      FROM tbl_alacaklar INNER JOIN tbl_musteriler ON tbl_alacaklar.alacak_cari_idsi=tbl_musteriler.id
      INNER JOIN tbl_kasalar ON tbl_alacaklar.alacak_kasa_idsi=tbl_kasalar.id
      WHERE tbl_alacaklar.id=:id");
      $stmt->execute(['id'=>$alacakIdsi]);
      $alacakBilgileri = $stmt->fetch();


      echo json_encode(array(
        "alacakBilgileri"=>$alacakBilgileri
      ));
    }
  }

  public function alacakTahsilataCevir()
  {
    if (isset($_POST["alacakTahsilataCevir"])) {
      $veriler = json_decode($_POST["alacakTahsilataCevir"],true);
      $yanit = true;

      $alacak = new Alacaklar();
      $alacakTutari = $alacak->getAlacakTutari(array("id"=>$veriler["txtAlacakIdsi"]));

      if ($veriler["txtTahsilatTutari"] > $alacakTutari) {
        $yanit = "Alacak tutarından fazla tahsilat tutarı giremezsiniz!";
      }


      if ($yanit == "true") {
        $tahsilat = new Tahsilatlar();
        $tahsilat->setTahsilatKodu($veriler["txtTahsilatKodu"]);
        $tahsilat->setTahsilatCariIdsi($veriler["txtTahsilatCariIdsi"]);
        $tahsilat->setTahsilatTutari($veriler["txtTahsilatTutari"]);
        $tahsilat->setTahsilatKasaIdsi($veriler["txtTahsilatKasaIdsi"]);
        $tahsilat->setTahsilatAciklamasi($veriler["txtTahsilatAciklamasi"]);
        $this->tabloAdlari = array("tbl_tahsilatlar");
        $this->kolonAdlari = array("tahsilat_kodu","tahsilat_cari_idsi","tahsilat_tutari","tahsilat_kasa_idsi","tahsilat_aciklamasi");
        $this->values = array(
          $tahsilat->tahsilatKodu,
          $tahsilat->tahsilatCariIdsi,
          $tahsilat->tahsilatTutari,
          $tahsilat->tahsilatKasaIdsi,
          $tahsilat->tahsilatAciklamasi
        );
        $yanit = $this->dataInsert();
        if ($yanit["yanit"] == "true") {

          if ($alacakTutari > $veriler["txtTahsilatTutari"]) {
            $yeniAlacakTutari = $alacakTutari - $veriler["txtTahsilatTutari"];
            $model = new Model();
            $stmt = $model->dbh->prepare(
              "UPDATE tbl_alacaklar SET alacak_tutari=:yeni_alacak_tutari WHERE id=:alacak_idsi"
            );
            $yanit = $stmt->execute([
              'yeni_alacak_tutari'=>$yeniAlacakTutari,
              'alacak_idsi'=>$veriler["txtAlacakIdsi"]
            ]);
            $model = null;
          }else {
            $model = new Model();
            $stmt = $model->dbh->prepare(
              "DELETE FROM tbl_alacaklar WHERE id=:alacak_idsi"
            );
            $yanit = $stmt->execute([
              'alacak_idsi'=>$veriler["txtAlacakIdsi"]
            ]);
            $model = null;
          }
        }else {
          $yanit = "Tahsilat eklenirken bir sorun oluştu!";
        }
      }


      echo json_encode(array(
        "yanit"=>$yanit
      ));

    }
  }
}
