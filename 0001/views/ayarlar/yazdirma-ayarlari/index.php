<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>

<body class="theme-blue">
  <!-- Page Loader -->
  <?php require $this->yolPhp."arayuz/loader.php"; ?>


  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <!-- Top Bar -->
  <?php require $this->yolPhp."arayuz/navbar.php"; ?>


  <!-- Left Sidebar -->
  <?php require $this->yolPhp."arayuz/aside.php"; ?>

  <!-- Chat-launcher -->
  <?php require $this->yolPhp."arayuz/chat.php"; ?>


  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2 id="pageName" >Yazdırma Ayarları</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Ayarlar</a></li>
            <li class="breadcrumb-item active">Yazdırma Ayarları</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Yazdırma</strong> Tercih Bilgileri</h2>
            </div>
            <div class="body">
              <form id="frmYazdirmaAyarlari" method="post" action="">
                <label for="email_address">Adisyon Fişinde Masa Adı Görünsün Mü?</label>
                <div class="input-group">
                  <div class="form-group radioForm"  data-radio="<?php echo $this->yazdirmaAyarlari["yazdirma_ayarlari_masa_adi_gorunsun_mu"]; ?>">
                      <div class="radio inlineblock m-r-20 ">
                          <input type="radio" name="txtMasaAdiGorunsunMu" id="male" class="with-gap" value="1" checked="checked">
                          <label for="male">Evet</label>
                      </div>
                      <div class="radio inlineblock">
                          <input type="radio" name="txtMasaAdiGorunsunMu" id="Female" class="with-gap" value="0">
                          <label for="Female">Hayır</label>
                      </div>
                  </div>
                </div>
                <label for="email_address">Adisyon Fişinde Adisyon Numarası Görünsün Mü?</label>
                <div class="input-group">
                  <div class="form-group radioForm"  data-radio="<?php echo $this->yazdirmaAyarlari["yazdirma_ayarlari_adisyon_no_gorunsun_mu"]; ?>">
                      <div class="radio inlineblock m-r-20 ">
                          <input type="radio" name="txtAdisyonNoGorunsunMu" id="evetA" class="with-gap" value="1" checked="checked">
                          <label for="evetA">Evet</label>
                      </div>
                      <div class="radio inlineblock">
                          <input type="radio" name="txtAdisyonNoGorunsunMu" id="HayirA" class="with-gap" value="0">
                          <label for="HayirA">Hayır</label>
                      </div>
                  </div>
                </div>
                <label for="email_address">Adisyon Fişinde Müşteri Adı Görünsün Mü? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Masaya müşteri atanmışsa adisyon fişinde müşteri adı Sn. ön ekiyle yazar"></span> </label>
                <div class="input-group">
                  <div class="form-group radioForm"  data-radio="<?php echo $this->yazdirmaAyarlari["yazdirma_ayarlari_musteri_adi_gorunsun_mu"]; ?>">
                      <div class="radio inlineblock m-r-20 ">
                          <input type="radio" name="txtMusteriAdiGorunsunMu" id="evet" class="with-gap" value="1">
                          <label for="evet">Evet</label>
                      </div>
                      <div class="radio inlineblock">
                          <input type="radio" name="txtMusteriAdiGorunsunMu" id="Hayir" class="with-gap" value="0" checked="checked">
                          <label for="Hayir">Hayır</label>
                      </div>
                  </div>
                </div>
                <label for="email_address">Adisyon Fişi Alt Yazısı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Adisyon fişinin en altında yazacak olan yazıdır"></span></label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                  <input value="<?php echo $this->yazdirmaAyarlari["yazdirma_ayarlari_adisyon_alt_yazi"]; ?>" type="text" id="txtAdisyonAltYazi" name="txtAdisyonAltYazi" class="form-control" placeholder="Örn: Teşekkür ederiz...">
                </div>
                
                <label for="email_address">Paket Servis Fişi Yazıcısı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Paket servis fişini yazdırmak istediğinizde buradan seçtiğiniz yazıcıdan çıkacaktır"></span></label>
                <div class="input-group">
                  <select class="form-control ms show-tick select2" name="txtPaketServisYazicisiIdsi" data-id="<?php echo $this->yazdirmaAyarlari["yazdirma_ayarlari_paket_servis_yazicisi_idsi"] ?>">
                    <?php
                      for ($i=0; $i < count($this->yazicilar) ; $i++) {
                        echo '<option value="'.$this->yazicilar[$i]["id"].'" >'.$this->yazicilar[$i]["yazici_adi"].'</option>';
                      }
                    ?>
                  </select>
                </div>
                <label for="email_address">Hızlı Satış Fiş Otomatik Yazdırılsın Mı? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Hızlı satışta ödemesi tamamlanınca otomatik olarak fiş yazdırılıp yazdırılmayacağını belirler"></span></label>
                <div class="input-group">
                  <div class="form-group radioForm"  data-radio="<?php echo $this->yazdirmaAyarlari["yazdirma_ayarlari_hizli_satis_oto_yazdir"]; ?>">
                      <div class="radio inlineblock m-r-20 ">
                          <input type="radio" name="txtHizliSatisOtoYazdir" id="hizliEvet" class="with-gap" value="1">
                          <label for="hizliEvet">Evet</label>
                      </div>
                      <div class="radio inlineblock">
                          <input type="radio" name="txtHizliSatisOtoYazdir" id="hizliHayir" class="with-gap" value="0" checked="checked">
                          <label for="hizliHayir">Hayır</label>
                      </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Vertical Layout -->

    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml; ?>views/ayarlar/yazdirma-ayarlari/yazdirma-ayarlari.js"></script>

</body>

</html>
