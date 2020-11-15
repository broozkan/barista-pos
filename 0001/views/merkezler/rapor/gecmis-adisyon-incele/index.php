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
.ikram{
  text-decoration-line: line-through;
}
.iptal{
  text-decoration-line: line-through;
}
.clicked{
  background-color: rgba(0, 0, 0, 0.28);
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
.tblKomutlar td{
  padding: 0px!important;
}
.tblKomutlarKapsayici{
  overflow-x: auto!important;
  overflow-y: auto;
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
.tblKomutlar td button{
  width: 100%;
  white-space: normal;
}
.tblUrunKategorileri td button{
  width: 95%;
  background: white;
  padding: 15px 20px;
  color: black!important;
  border: 1px solid;
  border-color: lightgray;
}
.tblUrunlerKapsayici{
  overflow-x: auto;
}

.tblUrunler button{
  white-space: normal;
  font-size: 17px;
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

  <!-- Main Content -->
  <section class="content">

<div class="block-header">
  <div class="row">
    <div class="col-lg-7 col-md-6 col-sm-12">
      <h2>Geçmiş Adisyon İncele
        <small>Geçmişteki adisyonun içeriğine göz atın</small>
      </h2>
    </div>
    <div class="col-lg-5 col-md-6 col-sm-12">
      <ul class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Rapor Merkezi</a></li>
        <li class="breadcrumb-item active">Geçmiş Adisyon İncele</li>
      </ul>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row clearfix mx-0">
    <div class="col-lg-2 px-1 col-xs-12 " >
      <input type="hidden" id="txtAdisyonIdsi" value="<?php echo $this->adisyonIdsi; ?>">
    </div>
    <input type="hidden" id="txtMasaDurumu" value="<?php echo $this->masaDurumu; ?>">
    <div class="col-lg-4 px-1 col-xs-9">
      <div class="card">
        <div class="body tblSiparisUrunleriKapsayici">
          <div class="table-responsive">
            <table class="table tblSiparisUrunleri ">
              <thead>
                <th>ADET</th>
                <th>İSİM</th>
                <th>NOT</th>
                <th>FİYAT</th>
                <th>DURUM</th>
              </thead>
              <tbody>


              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <a href="javascript:history.back()" class="btn btn-lg g-bg-cgreen btnOdemeVeKapat" name="button"><span class="zmdi zmdi-arrow-left"></span> GERİ </a>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="body">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table tblMasaBilgileri">
                <tbody>
                  <tr rowspan="2">
                    <tr>
                      <td><strong>Adisyon Tutarı</strong></td>
                      <td><strong>Adisyon İndirim Miktarı</strong></td>
                      <td><strong>Adisyon Ödenmiş Miktar</strong></td>
                    </tr>
                    <tr>
                      <td><h5 class="m-0"><span id="spanAdisyonTutari">0.00<?php //echo $this->masaBilgileri["adisyon_tutari"]; ?></span> <span class="spanKurIsareti"></span> </h5></td>

                      <td id="tdIndirimHucresi"><h5 class="m-0">0.00</span></h5></td>

                      <td><h5 class="m-0"><span id="spanAdisyonOdenmisMiktar">0.00</span> <span class="spanKurIsareti"></span></h5></td>
                    </tr>
                  </tr>

                  <tr>
                    <td>
                      <strong>ADİSYON KALAN TUTAR: </strong>
                    </td>
                    <td colspan="3">
                      <h5 class="m-0 text-danger"><span id="spanAdisyonKalanMiktar">0.00</span> <span class="spanKurIsareti"></span></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>MASA NUMARASI: </strong>
                    </td>
                    <td colspan="3">
                      <h5 class="m-0"><span id="spanMasaAdi"></span></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>MASA MÜŞTERİSİ: </strong>
                    </td>
                    <td colspan="3">
                      <p class="m-0 " id="spanMusteriAdiSoyadi"></p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>MASA GARSONU: </strong>
                    </td>
                    <td colspan="3">
                      <p class="m-0 " id="spanMasaGarsonu"></p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</section>



<div class="modal fade" id="modalMenuIceriginiGoster" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title" id="largeModalLabel">Menü İçeriği</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table tblMenuIcerigi">
            <thead>
              <th>Ürün Adı</th>
              <th>Ürün Adedi</th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">KAPAT</button>
      </div>
    </div>
  </div>
</div>

<?php require $this->yolPhp."arayuz/modalYeniMusteriEkle.php"; ?>
<?php require $this->yolPhp."arayuz/modalYeniCalisanEkle.php"; ?>
<?php require $this->yolPhp."arayuz/lock.php"; ?>

<!-- Jquery Core Js -->
<?php require $this->yolPhp."arayuz/script.php"; ?>
<script src="<?php echo $this->yolHtml ?>assets/js/pages/jquery.keyboard.js"></script>

<script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
<script src="<?php echo $this->yolHtml ?>views/merkezler/rapor/gecmis-adisyon-incele/gecmis-adisyon-incele.js"></script>
</body>

</html>
