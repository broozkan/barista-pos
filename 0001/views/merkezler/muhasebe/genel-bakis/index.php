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


  <!-- Main Content -->
  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Genel Bakış
            <small>Muhasebe kayıtlarının genel bakışı</small>
          </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
            <i class="zmdi zmdi-plus"></i>
          </button>
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Muhasebe Merkezi</a></li>
            <li class="breadcrumb-item active">Genel Bakış</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
          <input type="hidden" id="txtKurIsareti" value="<?php echo $this->kurIsareti; ?>">
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="header">
              <h2> Veri Aralığı Giriniz</h2>
            </div>
            <div class="body">
              <form action="" id="frmMuhasebeRaporu" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Başlangıç Tarihi :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="date" value="<?php echo $this->bugun; ?>" id="txtBaslangicTarihi" name="txtBaslangicTarihi" class="form-control" required placeholder="00-00-0000">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Bitiş Tarihi :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="date" value="<?php echo $this->yarin; ?>" id="txtBitisTarihi" name="txtBitisTarihi" class="form-control" required placeholder="00-00-0000">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Başlangıç Saati :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtBaslangicSaati" name="txtBaslangicSaati" value="<?php echo $this->programSaatBilgileri["program_baslangic_saati"]; ?>" class="form-control saat" required placeholder="sa-dk">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Bitiş Saati :</label>
                    <div class="input-group demoMaskedInput">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtBitisSaati" name="txtBitisSaati" value="<?php echo $this->programSaatBilgileri["program_bitis_saati"]; ?>" class="form-control saat" required placeholder="sa-dk">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="input-group demoMaskedInput">
                      <button type="button" class="btn btn-default btnDun" name="button">Dün</button>
                      <button type="button" class="btn btn-default btnBugun" name="button">Bugün</button>
                      <button type="button" class="btn btn-default btnSonHafta" name="button">Son Hafta</button>
                      <button type="button" class="btn btn-default btnSonAy" name="button">Son Ay</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <button class="btn btn-primary btn-round btnLoading" type="submit">ARA</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-4">
          <div class="card top-report">
            <div class="header">
              <h2><strong>Toplam </strong> Gelir</h2>
            </div>
            <div class="body">
              <h3 class="m-t-0"><span id="spanToplamGelir">0.00</span> <span class="spanKurIsareti"></span> <i class="zmdi zmdi-trending-up float-right text-success"></i></h3>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><strong>Adisyonlar <small>(Yapılan indirim toplamı : <span id="spanIndirimToplami">0.00</span> <small class="spanKurIsareti"></small>)<small></strong> </td>
                      <td> <span id="spanAdisyonlarToplami">0.00</span> <span class="spanKurIsareti"></span> </td>
                    </tr>
                    <tr>
                      <td><a href="" data-toggle="modal" data-target="#modalSatisFaturalari" id="btnSatisFaturalari"><strong>Satış Faturaları</strong> </a></td>
                      <td><span id="spanSatisFaturalariToplami">0.00</span> <span class="spanKurIsareti"></span> </td>
                    </tr>
                    <tr>
                      <td><a href="" data-toggle="modal" data-target="#modalTahsilatlar" id="btnTahsilatlar"><strong>Tahsilatlar</strong></a> </td>
                      <td><span id="spanTahsilatlarToplami">0.00</span> <span class="spanKurIsareti"></span> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card top-report">
            <div class="header">
              <h2><strong>Toplam </strong> Gider</h2>
            </div>
            <div class="body">
              <h3 class="m-t-0"><span id="spanToplamGider">0.00</span> <span class="spanKurIsareti"></span> <i class="zmdi zmdi-trending-down float-right text-danger"></i></h3>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><a href="" data-toggle="modal" data-target="#modalAlisFaturalari" id="btnAlisFaturalari"><strong>Alış Faturaları</strong></a> </td>
                      <td><span id="spanAlisFaturalariToplami">0.00</span> <span class="spanKurIsareti"></span> </td>
                    </tr>
                    <tr>
                      <td><a href="" data-toggle="modal" data-target="#modalOdemeler" id="btnOdemeler"><strong>Ödemeler</strong></a> </td>
                      <td><span id="spanOdemelerToplami">0.00</span> <span class="spanKurIsareti"></span> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card top-report">
            <div class="header">
              <h2><strong>Toplam </strong> Kâr</h2>
            </div>
            <div class="body">
              <h3 class="m-t-0"><span id="spanToplamKar">0.00</span> <span class="spanKurIsareti"></span> <i class="zmdi zmdi-long-arrow-up float-right text-success"></i></h3>

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="card top-report">
            <div class="header">
              <h2><strong>Borç </strong> Bakiyesi</h2>
            </div>
            <div class="body">
              <h3 class="m-t-0"><span id="spanBorcBakiyesi">0.00</span> <span class="spanKurIsareti"></span> <i class="zmdi zmdi-swap float-right text-success"></i></h3>
              <div class="">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td><strong>Toplam Alacak</strong> </td>
                        <td><strong><span id="spanAlacakToplami">0.00</span> <span class="spanKurIsareti"></span></strong> </td>
                      </tr>
                      <tr>
                        <td><strong>Toplam Verecek</strong> </td>
                        <td><strong><span id="spanVerecekToplami">0.00</span> <span class="spanKurIsareti"></span></strong> </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card top-report">
            <div class="header">
              <h2><strong>Vadesi Yaklaşan </strong> Faturalar</h2>
            </div>
            <div class="body">
              <!-- <h3 class="m-t-0">0.00 <span class="spanKurIsareti"></span> <i class="zmdi zmdi-swap float-right text-success"></i></h3> -->
              <div class="">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <th>Fatura Türü</th>
                      <th>Cari Adı</th>
                      <th>Vade Tarihi</th>
                      <th>Fatura Tutarı</th>
                    </thead>
                    <tbody>
                      <?php
                      for ($i=0; $i < count($this->yaklasanAlisFaturalari); $i++) {
                        echo
                        '<tr>
                        <td>Alış Faturası </td>
                        <td>'.$this->yaklasanAlisFaturalari[$i]["musteri_adi_soyadi"].' </td>
                        <td>'.$this->yaklasanAlisFaturalari[$i]["alis_faturasi_vade_tarihi"].'</td>
                        <td>'.$this->yaklasanAlisFaturalari[$i]["alis_faturasi_tutari"].' <span class="spanKurIsareti"></span> </td>
                        </tr>';
                      }
                      for ($i=0; $i < count($this->yaklasanSatisFaturalari); $i++) {
                        echo
                        '<tr>
                        <td>Satış Faturası </td>
                        <td>'.$this->yaklasanSatisFaturalari[$i]["musteri_adi_soyadi"].' </td>
                        <td>'.$this->yaklasanSatisFaturalari[$i]["satis_faturasi_vade_tarihi"].'</td>
                        <td>'.$this->yaklasanSatisFaturalari[$i]["satis_faturasi_tutari"].' <span class="spanKurIsareti"></span> </td>
                        </tr>';
                      }
                      ?>

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

  <div class="modal fade" id="modalTahsilatlar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Tahsilatlar Detayı</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table" id="tblTahsilatlar">
              <thead>
                <th>Tahsilat Cari Adı</th>
                <th>Tahsilat Miktarı</th>
                <th>Tahsilat Açıklaması</th>
                <th>Tahsilat Tarihi</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KAPAT</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalOdemeler" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Ödemeler Detayı</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table" id="tblOdemeler">
              <thead>
                <th>Ödeme Cari Adı</th>
                <th>Ödeme Miktarı</th>
                <th>Ödeme Açıklaması</th>
                <th>Ödeme Tarihi</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KAPAT</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalSatisFaturalari" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Satış Faturaları Detayı</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table" id="tblSatisFaturalari">
              <thead>
                <th>Fatura Cari Adı</th>
                <th>Fatura Miktarı</th>
                <th>Fatura Açıklaması</th>
                <th>Fatura Vade Tarihi</th>
                <th>Fatura İşlem Tarihi</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KAPAT</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalAlisFaturalari" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Alış Faturaları Detayı</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table" id="tblAlisFaturalari">
              <thead>
                <th>Fatura Cari Adı</th>
                <th>Fatura Miktarı</th>
                <th>Fatura Açıklaması</th>
                <th>Fatura Vade Tarihi</th>
                <th>Fatura İşlem Tarihi</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">KAPAT</button>
          </div>
        </div>
      </div>
    </div>
  </div>


    <?php require $this->yolPhp."arayuz/lock.php"; ?>

    <!-- Jquery Core Js -->
    <?php require $this->yolPhp."arayuz/script.php"; ?>
    <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
    <script src="<?php echo $this->yolHtml ?>views/merkezler/muhasebe/genel-bakis/genel-bakis.js"></script>
  </body>

  </html>
