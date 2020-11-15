<?php
/**
*
*/
class Epostalar extends Sirket
{

  public $epostaAlicisi;
  public $epostaKonusu;
  public $epostaTemplate;
  public $epostaIcerik;

  function __construct()
  {
    parent::__construct();
    $this->epostaTemplate = file_get_contents($this->yolPhp."documents/sablonlar/email-sablonu.php");
  }

  /*EPOSTA ALICISI GET VE SET METODLARI*/
  public function getEpostaAlicisi()
  {
    return $this->epostaAlicisi;
  }
  public function setEpostaAlicisi($yeniDeger)
  {
    $this->epostaAlicisi = $yeniDeger;
  }
  /*EPOSTA ALICISI GET VE SET METODLARI*/


  /*EPOSTA KONUSU GET VE SET METODLARI*/
  public function getEpostaKonusu()
  {
    return $this->epostaKonusu;
  }
  public function setEpostaKonusu($yeniDeger)
  {
    $this->epostaKonusu = $yeniDeger;
  }
  /*EPOSTA KONUSU GET VE SET METODLARI*/


  /*EPOSTA TEMPLATE GET VE SET METODLARI*/
  public function getEpostaTemplate()
  {
    return $this->epostaTemplate;
  }
  public function setEpostaTemplate($yeniDeger)
  {
    $this->epostaTemplate = $yeniDeger;
  }
  /*EPOSTA TEMPLATE GET VE SET METODLARI*/


  /*EPOSTA İÇERİK GET VE SET METODLARI*/
  public function getEpostaIcerik()
  {
    return $this->epostaIcerik;
  }
  public function setEpostaIcerik($yeniDeger)
  {
    $this->epostaIcerik = $yeniDeger;
  }
  /*EPOSTA İÇERİK GET VE SET METODLARI*/


  public function epostaGonder()
  {

    require($this->yolPhp."mail/class.phpmailer.php");


    $this->epostaTemplate = str_replace("[icerik]",$this->epostaIcerik,$this->epostaTemplate);

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->AddAddress("$this->epostaAlicisi","TEST");
    $mail->Subject  =  $this->epostaKonusu;
    $mail->Body     = $this->epostaTemplate;


    if(!$mail->Send())
    {
      $yanit = false;
    }else {
      $yanit = true;
    }
    return $yanit;
  }


  public function epostaDosyaGonder($dosyaAdi,$dosyaYolu)
  {
    require($this->yolPhp."mail/class.phpmailer.php");

    $this->epostaTemplate = str_replace("[icerik]",$this->epostaIcerik,$this->epostaTemplate);
    

    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->IsHTML(true);
    $mail->AddAddress("$this->epostaAlicisi","TEST"); // Maili gonderecegimiz kisi yani alici
    $mail->Subject = $this->epostaKonusu; // Konu basligi
    $mail->AddAttachment(
      $dosyaYolu,
      ''.$dosyaAdi.'',
      'base64',
      'mime/type'
    );
    $mail->Body =  $this->epostaTemplate;

    if(!$mail->Send())
    {
      $yanit = false;
    }else {
      $yanit = true;
    }
    return $yanit;
  }


}





?>
