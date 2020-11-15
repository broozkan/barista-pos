<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>
<style media="screen">
.card .header .header-dropdown{
  top: 0px;
  right: 0px;
}
a.active{
  color: white!important;
}
.card .body{
  padding: 0px!important;
}
.card .header{
  padding: 15px!important;
}
.card{
  margin-bottom: 10px!important;
}
.card .body h3{
  margin-bottom: 10px!important;
}
.cardKapali{
  border: 2px solid;
  border-color: #888897!important;
}
.cardKapali .body{
  color: #888897!important;
}
.cardAcik{
  border: 2px solid;
  border-color: #18ce0f;
}
.cardAcik .body{
  color: #18ce0f!important;
}

.cardKilitli{
  border: 2px solid;
  border-color: #f96332;
}
.cardRezerve{
  border: 2px solid;
  border-color: #f96332;
}
.txtMasaAra{
  width: 100px;
  font-size: 1em;
  border-radius: .25rem;
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
  <?php require $this->yolPhp."arayuz/chat.php"; ?>

  <!-- Main Content -->
  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">


          <?php
          if (count($this->lokasyonlar) < 1) {
            echo
            "<div class='col-lg-4'>
            <div class='alert alert-warning'>
            Lokasyon eklenmemiş <a href='".$this->yolHtml."lokasyon/lokasyon-ekle'>Lokasyon Ekle</a>
            </div>
            </div>";
          }else {
            for ($i=0; $i < count($this->lokasyonlar); $i++) {
              echo
              '<a href="'.$this->yolHtml.'restoran/masalar/'.$this->lokasyonlar[$i]["id"].'" class="btn btn-white hidden-sm-down float-left m-l-10 btn-lg">
              '.$this->lokasyonlar[$i]["lokasyon_adi"].'
              </a>';
            }
          }
          ?>

          <a id="btnMasaYerlesimi" data-toggle="modal" data-target="#modalMasaYerlesimi" data-id="<?php echo $this->lokasyonIdsi; ?>" data-name="<?php echo $this->lokasyonAdi; ?>" class="btn btn-white hidden-sm-down float-left m-l-10 btn-lg" >
            <?php echo $this->lokasyonAdi; ?> YERLEŞİM PLANI
          </a>
          <input type="hidden" id="txtLokasyonIdsi" value="<?php echo $this->lokasyonIdsi; ?>">
          <a href="<?php echo $this->yolHtml; ?>restoran/paket-servis" class="btn btn-white hidden-sm-down float-left m-l-10 btn-lg" >
            PAKET SERVİS
          </a>
          <a href="<?php echo $this->yolHtml; ?>restoran/hizli-satis" class="btn btn-white hidden-sm-down float-left m-l-10 btn-lg" >
            HIZLI SATIŞ
          </a>
          <button data-toggle="modal" data-target="#modalMusteriAra" class="btn btn-white hidden-sm-down float-left m-l-10 btn-lg" type="button">
            MÜŞTERİ ARA
          </button>
          <button class="btn btn-white btnMasaAra hidden-sm-down float-left m-l-10 btn-lg" type="button">
            MASA ARA
          </button>
          <a href="https://<?php echo $this->ipAdresi; ?>/<?php echo $this->yolHtml; ?>restoran/qr-adisyon-sorgula" class="btn btn-white hidden-sm-down float-left m-l-10 btn-lg">
            <img src="<?php echo $this->yolHtml; ?>assets/images/qr.png" class="ikon" alt=""> QR ADİSYON
          </a>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">

        <?php
        if (is_array($this->masalar)) {
          if (count($this->masalar) < 1) {
            echo
            "<div class='col-lg-4'>
            <div class='alert alert-warning'>
            Masa eklenmemiş <a href='".$this->yolHtml."masa/masa-ekle'>Masa Ekle</a>
            </div>
            </div>";
          }else {
            for ($i=0; $i < count($this->masalar); $i++) {
              if (!$this->masalar[$i]["adisyonBilgileri"]) {
                $this->masalar[$i]["adisyonBilgileri"][0]["adisyon_urunleri_urun_siparis_saati"] = "-";
              }

              if (@!$this->masalar[$i]["adisyonBilgileri"][0]["adisyon_tutari"]) {
                $this->masalar[$i]["adisyonBilgileri"][0]["adisyon_tutari"] = 0;
              }

              echo
              '<div class="col-lg-2 col-sm-4 divMasa" id="'.$this->masalar[$i]["id"].'">
              <a href="'.$this->yolHtml.'restoran/masa-detay/'.$this->masalar[$i]["masa_idsi"].','.$this->lokasyonIdsi.'">';
              switch ($this->masalar[$i]["masa_durumu"]) {
                case '0':
                echo '<div class="card cardKapali">';
                break;
                case '1':
                echo '<div class="card cardAcik">';
                break;
                case '2':
                echo '<div class="card cardKilitli">';
                break;
                case '3':
                echo '<div class="card cardRezerve">';
                break;


              }
              echo '

              <div class="header">
              <ul class="header-dropdown">
              <li class="dropdown">
              <button class="dropdown-toggle btn btn-sm btn-default bg-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </button>
              <ul class="dropdown-menu slideUp p-3" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
              <li class="btnRezervasyonYap" >Rezervasyon Yap</li>
              </ul>
              </li>
              <li class="dropdown">
              <button class="btn btn-sm btn-default bg-white btnMasaUrunlerineBak"> <i class="zmdi zmdi-eye"></i> </button>
              </li>
              </ul>

              </div>
              <div class="body">
              <div class="col-lg-12">
              <div class="card top-report">
              <div class="body">
              <h3 class="m-t-0">
              <span class="spanMasaAdi">'.$this->masalar[$i]["masa_adi"].'</span> <span class="d-none spanMasaBildirimi zmdi zmdi-alert-circle text-danger"></span>

              </h3>
              <div class="row">
              <div class="col-lg-6">
              <p class="text-muted d-none "><span class="spanMasaAdisyonTutari">'.$this->masalar[$i]["adisyonBilgileri"][0]["adisyon_tutari"].'</span> <span class="spanKurIsareti">₺</span> </p>
              </div>
              <div class="col-lg-6 divMasaDurumu">';
              switch ($this->masalar[$i]["masa_durumu"]) {
                case '0':
                echo '<p class="text-muted"><span class="spanMasaDurumu badge badge-default float-right" >Kapalı</span> </p>';
                break;
                case '1':
                echo '<h2 class="text-muted"><span class="spanMasaDurumu badge badge-success float-right" >Açık</span> </h2>';
                break;
                case '2':
                echo '<h2 class="text-muted"><span class="spanMasaDurumu badge badge-danger float-right" >Kilitli</span> </h2>';
                break;
                case '3':
                echo '<h2 class="text-muted"><span class="spanMasaDurumu badge badge-danger float-right" >Rezerve</span> </h2>';
                break;


              }

              echo '
              </div>
              </div>';

              if (@$this->masalar[$i]["adisyonBilgileri"][0]["musteri_adi_soyadi"]) {
                echo '<div class="row"><small>Masa Müşterisi : '.$this->masalar[$i]["adisyonBilgileri"][0]["musteri_adi_soyadi"].'</small></div>';
              }elseif (@$this->masalar[$i]["adisyonBilgileri"][0]["calisan_adi_soyadi"]) {
                echo '<div class="row"><small>Masa Müşterisi : '.$this->masalar[$i]["adisyonBilgileri"][0]["calisan_adi_soyadi"].'</small></div>';
              }
              echo '
              <div class="row"><small>Son Sipariş Saati : <span class="spanSonSiparisSaati">'.$this->masalar[$i]["adisyonBilgileri"][0]["adisyon_urunleri_urun_siparis_saati"].'</span></small></div>
              </div>
              </div>

              </div>
              </div>
              </div>
              </a>
              </div>';
            }
          }

        }else {
          echo
          "<div class='col-lg-12'>
          <h4 class='text-center' >".$this->masalar."</h4>
          </div>";
        }
        ?>

      </div>
    </div>
  </section>

  <div class="modal fade" id="modalMasaYerlesimi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel"> <span id="modalMasaYerlesimiLokasyonAdi"></span> Lokasyonu Masa Yerleşimi</h4>
        </div>
        <div class="modal-body">
          <img src="" id="imgLokasyonKrokisi" class="img img-responsive" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">KAPAT</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalMasaUrunleri" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel"> <span id="modalMasaUrunleriMasaAdi"></span>  Masasının Ürünleri</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table tblMasaUrunleri">
              <thead>
                <th>Ürün Adı</th>
                <th>Ürün Adedi</th>
                <th>Ürün Tutarı</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">KAPAT</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalMusteriAra" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmMusteriAra" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Müşteri Ara</h4>
          </div>
          <div class="modal-body">
            <label for="">Müşteri Adı Soyadı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
              <input type="text" id="txtMusteriAdiSoyadi" data-kolon-index="12" data-tablo-index="10" autocomplete="off" name="txtMusteriAdiSoyadi" class="form-control dataSearch" required placeholder="Müşteri adı soyadı giriniz">
              <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

              </ul>
              <button type="button" class="btn btn-sm btn-default buttonInsideInput btnLoading btnMusteriAdisyonlariniGetir" name="button">Geçmiş Adisyonlarını Getir</button>
            </div>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table tblMusteriAdisyonlari">
                <thead>
                  <th>Adisyon No</th>
                  <th>Adisyon Tutarı</th>
                  <th>İşlem</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <?php require $this->yolPhp."arayuz/modalDovizCevirici.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/mutfak-websocket.js"></script>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  <script src="<?php echo $this->yolHtml ?>views/restoran/masalar/masalar.js"></script>

</body>

</html>
