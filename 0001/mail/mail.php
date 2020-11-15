<?php

  if($_POST["verilerIletisim"]){
    $verilerIletisim = json_decode($_POST["verilerIletisim"],true);
    $isim = $verilerIletisim["isim"];
    $email = $verilerIletisim["eposta"];
    $mesaj = $verilerIletisim["mesaj"];
    require("class.phpmailer.php");

    $mail = new PHPMailer();

    $mail->IsSMTP();                                   // send via SMTP
    $mail->Host     = "mail.otohan.com.tr"; // SMTP servers
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->Username = "info@otohan.com.tr";  // SMTP username
    $mail->Password = "sfrSFR135"; // SMTP password
    $mail->Port     = 587;
    $mail->From     = "info@otohan.com.tr"; // smtp kullan�c� ad�n�z ile ayn� olmal�
    $mail->Fromname = "E-mail";
    $mail->AddAddress("info@otohan.com.tr","TEST");
    $mail->Subject  =  "Web Sitesi İletişim";
    $mail->Body     =  "
    İsim : ".$isim."
    E-mail : ".$email."
    Mesaj : ".$mesaj."
    otohan.com.tr sitesi üzerinden gönderildi.";

    if(!$mail->Send())
    {
       echo "0";
       exit;
    }

    echo true;


  }
?>
