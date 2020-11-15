<?php
/**
 *
 */
class SirketAyarlari extends Controller
{

  function __construct()
  {
    parent::__construct();
    if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
      //DO NOTHING
    }else {
      require $this->yolPhp."settings/session-check.php";
      $sirket = new Sirket();
      $this->view->sirketAdi = $sirket->getSirketAdi();
      $this->view->sirketAdresi = $sirket->getSirketAdresi();
      $this->view->sirketEpostaAdresi = $sirket->getSirketEpostaAdresi();
      $this->view->sirketTelefonNumarasi = $sirket->getSirketTelefonu();
      $this->view->sirketVergiNumarasi = $sirket->getSirketVergiNumarasi();
      $this->view->sirketVarsayilanParaBirimi = $sirket->getSirketVarsayilanParaBirimi();
      $this->view->render("ayarlar/sirket-ayarlari");
      $sirket = null;
    }
  }

  public function sirketBilgileriKaydet()
  {
    if ($_POST["sirketBilgileriKaydet"]) {
      $veriler = json_decode($_POST["sirketBilgileriKaydet"],true);
      $sirket = new Sirket();
      $sirket->setSirketAdi($veriler["txtSirketAdi"]);
      $sirket->setSirketAdresi($veriler["txtSirketAdresi"]);
      $sirket->setSirketEpostaAdresi($veriler["txtSirketEpostaAdresi"]);
      $sirket->setSirketTelefonu($veriler["txtSirketTelefonNumarasi"]);
      $sirket->setSirketVergiNumarasi($veriler["txtSirketVergiNumarasi"]);
      $sirket->setSirketVarsayilanParaBirimi($veriler["txtSirketVarsayilanParaBirimi"]);

      $yanit = $sirket->updateQuery("sirket_bilgileri",array(
        "sirket_adi"=>$sirket->sirketAdi,
        "sirket_adresi"=>$sirket->sirketAdresi,
        "sirket_eposta_adresi"=>$sirket->sirketEpostaAdresi,
        "sirket_telefonu"=>$sirket->sirketTelefonu,
        "sirket_vergi_numarasi"=>$sirket->sirketVergiNumarasi,
        "sirket_varsayilan_para_birimi"=>$sirket->sirketVarsayilanParaBirimi,
        "id"=>$sirket->getId()
      ));

      echo json_encode(array(
        "yanit"=>$yanit
      ));
    }
  }
}
