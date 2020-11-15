<?php
/**
 *
 */
class Lock extends Controller
{

  function __construct()
  {
    parent::__construct();
    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
      //DO NOTHING
    }else {

      $_SESSION["lock"] = false;
      if (!isset($_SESSION["uid"])) {
        $this->view->render("login");
      }else {
        $this->view->render("lock");
      }
    }
  }


  /*LOCK DESTROY SESSION KODLARI*/
  public function destroyLockSession()
  {
    if (isset($_POST["destroyLockSession"])) {
      $model = new Model();
      $stmt = $model->dbh->prepare("UPDATE tbl_calisanlar SET calisan_aktif_mi=0 WHERE id=:calisan_idsi");
      $yanit = $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
      if ($yanit == true) {
        $_SESSION["lock"] = false;
      }
      $model = null;
      echo json_encode(array(
        "yanit"=>true
      ));
    }
  }
  /*LOCK DESTROY SESSION KODLARI*/

  /*LOCK SESSION SORGULAMA KODLARI*/
  public function lockSessionSorgula()
  {
    if (isset($_POST["lockSessionSorgula"])) {
      if(@$_SESSION["lock"] == true){
        $yanit = true;
      }else {
        $yanit = false;
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*LOCK SESSION SORGULAMA KODLARI*/

  /*LOCK GİRİŞ YAPMA KODLARI*/
  public function girisYap()
  {
    if ($_POST["girisYap"]) {
      $veriler = json_decode($_POST["girisYap"],true);
      $model = new Model();

      $stmt = $model->dbh->prepare("SELECT id,calisan_pini,calisan_adi_soyadi,calisan_profil_fotosu FROM tbl_calisanlar WHERE calisan_pini=:calisan_pini");
      $stmt->execute(['calisan_pini'=>md5($veriler["txtPin"])]);
      $calisanBilgileri = $stmt->fetch();

      if ($calisanBilgileri["calisan_pini"] == md5($veriler["txtPin"])) {
        $stmt = $model->dbh->prepare("UPDATE tbl_calisanlar SET calisan_aktif_mi=1 WHERE id=:calisan_idsi");
        $yanit = $stmt->execute(['calisan_idsi'=>$calisanBilgileri["id"]]);
        if ($yanit == true) {
          $_SESSION["lock"] = true;
          $_SESSION["uid"] = $calisanBilgileri["id"];
          $_SESSION["kullaniciAdiSoyadi"] = $calisanBilgileri["calisan_adi_soyadi"];
          $_SESSION["kullaniciProfilFotosu"] = $calisanBilgileri["calisan_profil_fotosu"];
          $model = null;
        }

      }else {
        $yanit = "Hatalı pin girdiniz!";
      }
      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
  /*LOCK GİRİŞ YAPMA KODLARI*/

}
