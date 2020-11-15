<?php
  /**
   *
   */
  class Login extends Controller
  {

    function __construct()
    {
      parent::__construct();
      if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        //DO NOTHING
      }else {
        session_destroy();
        $_SESSION["login"] = false;
        $_SESSION["lock"] = false;
        $this->view->render("login");
      }
    }


    public function girisYap()
    {
      if ($_POST["girisYap"]) {
        $veriler = json_decode($_POST["girisYap"],true);
        $calisan = new Calisanlar();
        $calisanId = $calisan->getCalisanIdsi(array("calisan_kullanici_adi"=>$veriler["txtKullaniciAdi"]));
        $calisanKullaniciAdi = $calisan->getCalisanKullaniciAdi(array("calisan_kullanici_adi"=>$veriler["txtKullaniciAdi"]));
        $calisanAdiSoyadi = $calisan->getCalisanAdiSoyadi(array("calisan_kullanici_adi"=>$veriler["txtKullaniciAdi"]));
        $calisanProfilFotosu = $calisan->getCalisanProfilFotosu(array("calisan_kullanici_adi"=>$veriler["txtKullaniciAdi"]));
        $calisanParola = $calisan->getCalisanParolasi(array("calisan_parolasi"=>md5($veriler["txtParola"])));
        if ($calisanKullaniciAdi && $calisanParola) {
          $yanit = true;
          $_SESSION["login"] = true;
          
        }else {
          $yanit = "Kullanıcı adı veya parola hatalı!";
        }
        echo json_encode(array(
          "yanit"=>$yanit
        ));
      }
    }
  }

?>
