<?php
require $_SERVER["DOCUMENT_ROOT"]."/settings/config.php";
if ($_POST["girisYap"]) {
  $veriler = json_decode($_POST["girisYap"],true);
  $calisan = new Calisanlar();
  $calisanId = $calisan->getCalisanId(array("calisan_kullanici_adi"=>$veriler["txtKullaniciAdi"]));
  $calisanKullaniciAdi = $calisan->getCalisanKullaniciAdi(array("calisan_kullanici_adi"=>$veriler["txtKullaniciAdi"]));
  $calisanParola = $calisan->getCalisanParola(array("calisan_parola"=>md5($veriler["txtParola"])));
  if ($calisanKullaniciAdi && $calisanParola) {
    $yanit = true;
    session_start();
    $_SESSION["login"] = true;
    $_SESSION["lock"] = true;
    $_SESSION["uid"] = $calisanId;
  }else {
    $yanit = "Kullanıcı adı veya parola hatalı!";
  }
  echo json_encode(array(
    "yanit"=>$yanit
  ));
}
