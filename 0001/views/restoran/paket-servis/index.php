<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>
<link href="<?php echo $this->yolHtml; ?>assets/css/keyboard.css" rel="stylesheet">

<style media="screen">
section.content{
  padding-left: 0px!important;
  padding-right: 0px!important;
  margin-bottom: 0px;
}

.tblBekleyenSiparisler .clicked{
  background-color: #03A9F4;
  color: white;
}

.tblYolaCikanSiparisler .clicked{
  background-color: #8BC34A;
  color: white;
}
.btnUrunAdiClass{
  position: relative;
}
.btnMusteriyiKaldir{
  font-size: 10px;
  padding: 5px;
  margin: 0px;
}
.btnIndirimiTekrarEkle{
  font-size: 10px;
  padding: 5px;
  margin: 0px;
}
.btnIndirimiKaldir{
  font-size: 10px;
  padding: 5px;
  margin: 0px;
}
.btnUrunAdiClass span{
  position: absolute;
  top: 10px;
  right: 10px;
}
.txtUrunAdedi{
  font-size: 20px;
  font-weight: bold;
}
.btnOdemeVeKapat{
  width: 100%;
}
.container-fluid{
  padding-left: 0px!important;
  padding-right: 0px!important;
}
.tblBekleyenSiparisler td{
  padding: 10px!important;
}
.tblBekleyenSiparislerKapsayici{
  height: 35vh;
  overflow-x: auto!important;
  overflow-y: auto;
}
.tblBekleyenSiparisler td button{
  width: 100%;
  white-space: normal;
}
.tblYolaCikanSiparisler td{
  padding: 10px!important;
}
.tblYolaCikanSiparislerKapsayici{
  height: 35vh;
  overflow-x: auto!important;
  overflow-y: auto;
}
.tblYolaCikanSiparisler td button{
  width: 100%;
  white-space: normal;
}
.tblMusteriler td{
  padding: 0px!important;
}
table thead th h3{
  margin-bottom: 20px;
}
.tblMusterilerKapsayici{

  overflow-x: auto!important;
  overflow-y: auto;
}
.tblMusteriler td button{
  width: 100%;
  white-space: normal;
}
.tblYemekSepeti td{
  padding: 0px!important;
}
.tblYemekSepetiKapsayici{
  height: 70vh;
  overflow-x: auto!important;
  overflow-y: auto;
}
.tblYemekSepeti td button{
  width: 100%;
  white-space: normal;
}
.tblKuryeler td{
  padding: 5px!important;
}
.tblKuryelerKapsayici{
  height: 13vh;
  overflow-x: auto!important;
  overflow-y: auto;
}
.tblKuryeler td button{
  width: 100%;
  white-space: normal;
}
.tblOdemeMetodlari td{
  padding: 5px!important;
}
.tblOdemeMetodlariKapsayici{
  height: 13vh;
  overflow-x: auto!important;
  overflow-y: auto;
}
.tblOdemeMetodlari td button{
  width: 100%;
  white-space: normal;
}
.tblIslemler td{
  padding: 5px!important;
}
.tblIslemlerKapsayici{
  overflow-x: auto!important;
  overflow-y: auto;
}
.tblIslemler td button{
  width: 100%;
  white-space: normal;
}
.tblUrunKategorileri td{
  padding: 0px!important;
}
.tblUrunKategorileriKapsayici{
  overflow-x: auto!important;
  overflow-y: auto;
}
.tblSiparisUrunleriKapsayici{

  overflow-x: hidden!important;
  overflow-y: auto;
}

.tblUrunKategorileri td button{
  width: 100%;
  padding: 15px 20px;
}
.tblUrunlerKapsayici{
  overflow-x: auto;
}

.tblUrunler button{
  white-space: normal;
  font-size: 17px;
  padding: 5px;
}
.card .header{
  padding: 5px;
}
.tblUrunler div{
  display: contents;

}
.tblTusTakimi{
  margin-bottom: 0px;
}
.tblTusTakimi td button{
  width: 100%;
  font-size: 18px;
}
.tblTusTakimi td{
  padding: 3px;
}
.tblMasaBilgileri td{
  padding: 8px;
}
</style>
<body class="theme-blue ls-toggle-menu">
  <!-- Page Loader -->
  <?php require $this->yolPhp."arayuz/loader.php"; ?>


  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <!-- Top Bar -->
  <?php require $this->yolPhp."arayuz/navbar.php"; ?>


  <!-- Left Sidebar -->
  <?php require $this->yolPhp."arayuz/aside.php"; ?>

  <!-- Chat-launcher -->
  <?php require $this->yolPhp."arayuz/caller-id.php"; ?>

  <!-- Main Content -->
  <section class="content">
    <!-- <div class="block-header">
    <div class="row">
    <div class="col-lg-7 col-md-6 col-xs-12">

  </div>
  <div class="col-lg-5 col-md-6 col-sm-12">

</div>
</div>
</div> -->
<input type="hidden" id="txtCallerIdAktifMi" value="<?php echo $this->callerIdAktifMi; ?>">
<div class="container-fluid">
  <div class="row clearfix mx-0">
    <div class="col-lg-3 col-xs-12" >
      <div class="card">
        <div class="header">
          <h3>YEMEK SEPETİ</h3>
        </div>
        <div class="body">
          <div class="table-responsive tblYemekSepetiKapsayici">
            <table class="table tblYemekSepeti">
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-12" >
      <div class="card">
        <div class="header">
          <h3>BEKLEYEN SİPARİŞLER</h3>
        </div>
        <div class="body">
          <div class="table-responsive tblBekleyenSiparislerKapsayici">
            <table class="table  tblBekleyenSiparisler">

              <tbody>
                <?php
                  for ($i=0; $i < count($this->bekleyenSiparisBilgileri); $i++) {
                    echo
                    '<tr adisyon-idsi="'.$this->bekleyenSiparisBilgileri[$i]["adisyon_idsi"].'" musteri-idsi="'.$this->bekleyenSiparisBilgileri[$i]["musteri_idsi"].'">
                      <td>
                        <span class="spanBekleyenMusteriAdi" ></span>
                        <strong>'.$this->bekleyenSiparisBilgileri[$i]["musteri_adi_soyadi"].'</strong>
                        <br>
                        <span class="spanBekleyenMusteriAdresi">
                          '.$this->bekleyenSiparisBilgileri[$i]["musteri_adresi"].'
                        </span>
                        <br>
                        <span class="spanBekleyenSiparisSaati">
                          <strong>'.$this->bekleyenSiparisBilgileri[$i]["adisyon_acilis_saati"].'</strong> / '.$this->bekleyenSiparisBilgileri[$i]["musteri_telefon_numarasi"].'
                        </span>

                      </td>
                      <td class="align-middle">
                        <h5><span class="spanBekleyenSiparisTutari">'.$this->bekleyenSiparisBilgileri[$i]["adisyon_tutari"].'</span> <span class="spanKurIsareti">₺</span> </h5>
                      </td>
                    </tr>';
                  }
                ?>
                <!-- <tr>
                  <td>
                    <span class="spanBekleyenMusteriAdi" ></span>
                    Burhan Özkan
                    <br>
                    <span class="spanBekleyenMusteriAdresi">
                      Aydoğan Mah. Şehit Metin Cad. Kat:2 No:4
                    </span>
                    <br>
                    <span class="spanBekleyenSiparisSaati">
                      11:07
                    </span>

                  </td>
                  <td class="align-middle">
                    <h5><span class="spanBekleyenSiparisTutari">102.57</span> <span class="spanKurIsareti">₺</span> </h5>
                  </td>
                </tr> -->



              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="header">
          <h5>ÇALIŞANLAR</h5>
        </div>
        <div class="body">
          <div class="table-responsive tblKuryelerKapsayici">
            <table class="table tblKuryeler">
              <tbody>
                <?php
                  for ($i=0; $i < count($this->calisanlar); $i++) {
                    echo
                    '<tr>
                      <td><button type="button" class="btn btn-default btn-lg" id="'.$this->calisanlar[$i]["id"].'">'.$this->calisanlar[$i]["calisan_adi_soyadi"].'</button> </td>
                    </tr>';
                  }
                ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-12" >
    <div class="card">
      <div class="header">
        <h3>YOLA ÇIKAN SİPARİŞLER</h3>
      </div>
      <div class="body">
        <div class="table-responsive tblYolaCikanSiparislerKapsayici">
          <table class="table  tblYolaCikanSiparisler">

            <tbody>
              <?php
                for ($i=0; $i < count($this->yolaCikanSiparisBilgileri); $i++) {
                  echo
                  '<tr adisyon-idsi="'.$this->yolaCikanSiparisBilgileri[$i]["adisyon_idsi"].'" musteri-idsi="'.$this->yolaCikanSiparisBilgileri[$i]["musteri_idsi"].'">
                    <td>
                      <span class="spanYolaCikanMusteriAdi" ></span>
                      <strong>'.$this->yolaCikanSiparisBilgileri[$i]["musteri_adi_soyadi"].'</strong>
                      <br>

                      <span class="spanYolaCikanKuryeAdi">
                        Kurye : '.$this->yolaCikanSiparisBilgileri[$i]["kurye_adi"].'
                      </span>
                      </br>
                      <span class="spanYolaCikanMusteriAdresi">
                        '.$this->yolaCikanSiparisBilgileri[$i]["musteri_adresi"].'
                      </span>
                      <br>
                      <span class="spanYolaCikanSiparisSaati">
                        <strong>'.$this->yolaCikanSiparisBilgileri[$i]["adisyon_acilis_saati"].'</strong> / '.$this->yolaCikanSiparisBilgileri[$i]["musteri_telefon_numarasi"].'
                      </span>

                    </td>
                    <td class="align-middle">
                      <h5><span class="spanYolaCikanSiparisTutari">'.$this->yolaCikanSiparisBilgileri[$i]["adisyon_tutari"].'</span> <span class="spanKurIsareti">₺</span> </h5>
                    </td>
                  </tr>';
                }
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="header">
        <h5>ÖDEME METODLARI</h5>
      </div>
      <div class="body">
        <div class="table-responsive tblOdemeMetodlariKapsayici">
          <table class="table tblOdemeMetodlari">
            <tbody>
              <?php
                for ($i=0; $i < count($this->odemeMetodlari); $i++) {
                  echo
                  '<tr>
                    <td><button type="button" class="btn btn-default btn-lg" id="'.$this->odemeMetodlari[$i]["id"].'">'.$this->odemeMetodlari[$i]["odeme_metod_adi"].'</button> </td>
                  </tr>';
                }
              ?>


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-12" >
    <div class="card">
      <div class="header">
        <h3>MÜŞTERİLER</h3>
      </div>
      <div class="body">
        <form id="frmMusteriyeUrunGir" method="post">
          <label for="">Müşteri Adı Soyadı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="hidden" name="txtAdisyonIdsi" value="" required>
            <input type="text" id="txtMusteriAdi" data-kolon-index="12" data-tablo-index="10" autocomplete="off" name="txtMusteriAdi" class="form-control dataSearch" required placeholder="Müşteri adı soyadı giriniz">
            <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

            </ul>
            <!-- <button type="button" class="btn btn-sm btn-default buttonInsideInput btnMusteriEkle" data-toggle="modal" data-target="#modalYeniMusteriEkle" name="button">Yeni Müşteri Ekle</button> -->
          </div>
          <button type="submit" class="btn btn-raised g-bg-soundcloud btn-round waves-effect">MÜŞTERİYE ÜRÜN GİR</button>
        </form>

      </div>
    </div>
    <div class="card">
      <div class="header">
        <h5>İŞLEMLER</h5>
      </div>
      <div class="body">
        <div class="table-responsive tblIslemlerKapsayici">
          <table class="table tblIslemler">
            <tbody>
              <tr>
                <td><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modalYeniMusteriEkle" name="button">Yeni Müşteri Ekle</button> </td>
              </tr>
              <tr>
                <td><button type="button" class="btn btn-default btn-lg btnAdisyonuGoster" name="button">Adisyonu Göster/Düzenle</button> </td>
              </tr>
              <tr>
                <td><button type="button" class="btn btn-default btn-lg btnBekleyeneCevir" name="button">Bekleyen Sipariş Konumuna Al</button> </td>
              </tr>
              <tr>
                <td><button type="button" class="btn btn-default btn-lg btnHaritadaGoster" name="button">Haritada Göster</button> </td>
              </tr>
              <tr>
                <td><button type="button" class="btn btn-default btn-lg btnSiparisiYazdir" name="button">Siparişi Yazdır</button> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
</section>
<div class="modal fade" id="modalHaritadaGoster" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel"> <span></span> Haritalar</h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">KAPAT</button>
        </div>
      </div>
  </div>
</div>


<?php require $this->yolPhp."arayuz/modalYeniMusteriEkle.php"; ?>
<?php require $this->yolPhp."arayuz/modalYeniCalisanEkle.php"; ?>
<?php require $this->yolPhp."arayuz/lock.php"; ?>
<?php require $this->yolPhp."arayuz/modalDovizCevirici.php"; ?>

<!-- Jquery Core Js -->
<?php require $this->yolPhp."arayuz/script.php"; ?>
<script src="<?php echo $this->yolHtml ?>assets/js/pages/jquery.keyboard.js"></script>

<script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>

<script src="<?php echo $this->yolHtml ?>views/restoran/paket-servis/paket-servis.js"></script>
<script src="<?php echo $this->yolHtml ?>assets/js/pages/caller-id-websocket.js"></script>


</body>

</html>
