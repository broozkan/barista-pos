<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>
<style media="screen">
  .select2-container .select2-selection--single{
    height: 27px!important;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 28px!important;
  }
</style>
<link rel="stylesheet" href="<?php echo $this->yolHtml ?>assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">

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


  <section class="content contact">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2 id="pageName">Stok Mal Girişi Yap</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Stok Merkezi</a></li>
            <li class="breadcrumb-item active">Stok Mal Girişi Yap</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong> Stok Ürün </strong> Bilgileri</h2>
              <ul class="header-dropdown">
                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else</a></li>
                  </ul>
                </li>
                <li class="remove">
                  <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                </li>
              </ul>


            </div>
            <div class="body">
              <form id="frmStokMalGirisiYap" method="post" action="">

                <div class="row divStokTakibiBilgileri">
                  <div class="col-md-3">
                    <label for="email_address">Stoktan Girişi Yapılacak Ürün </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStokGirisiYapilacakUrunAra" autocomplete="off" name="txtStokGirisiYapilacakUrunAra" data-tablo-index="4" data-kolon-index="5" class="form-control dataSearch"  placeholder="Ürün adı yazınız">
                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="email_address">Eklenecek Miktar</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtStokEklenecekUrunMiktari" autocomplete="off" name="txtStokEklenecekUrunMiktari" class="form-control"  placeholder="Miktar yazınız">
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="input-group" style="display:grid">
                      <label for="email_address">Ekle</label>
                      <button type="button" class="btn-sm btn g-bg-cgreen btnStokUrunBilgileriEkle"><span class="zmdi zmdi-plus"></span> </button>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="table">
                      <table class="table table-responsive" id="tblStogaEklenecekUrunler">
                        <thead>
                          <th>Ürün Adı</th>
                          <th>Stok Giriş Miktarı</th>
                          <th>Ürün Birim Alış Fiyatı</th>
                          <th>Ürün Alış KDV Miktarı</th>
                          <th>İşlem</th>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label for="email_address">Ödeme Nasıl Kaydedilsin? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Mal alımının tutarının hangi şekilde tutulacağını seçmelisiniz"></span> </label>
                    <div class="input-group">
                      <select class="form-control show-tick ms select2" required name="txtOdemeNasilKaydedilsin" id="txtOdemeNasilKaydedilsin">
                        <option value="" disabled selected>--Seçiniz--</option>
                        <option value="0">Alış Faturası Kesilsin</option>
                        <option value="1">Ödemelere Kaydedilsin</option>
                        <option value="2">Kayıt Yapılmasın</option>
                      </select>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row divAlisFaturasiBilgileri kayitSekilleri d-none">
                  <div class="col-md-12">
                    <label for="email_address">Cari Hesap </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtAlisFaturasiCariHesapIdsi" autocomplete="off" name="txtAlisFaturasiCariHesapIdsi" data-tablo-index="10" data-kolon-index="12" class="form-control dataSearch"  placeholder="Cari hesap adı yazınız">
                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Alış Faturası Fatura Kodu </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtAlisFaturasiFaturaKodu" name="txtAlisFaturasiFaturaKodu" class="form-control uppercase dataSearch" placeholder="Fatura kodu giriniz" autocomplete="off" data-tablo-index="16" data-kolon-index="18">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Alış Faturası Fatura Seri Numarası </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtAlisFaturasiSeriNumarasi" name="txtAlisFaturasiSeriNumarasi" class="form-control uppercase" placeholder="Fatura seri numarası giriniz">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Alış Faturası Vade Tarihi </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="date" id="txtAlisFaturasiVadeTarihi" name="txtAlisFaturasiVadeTarihi" class="form-control">

                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Alış Faturası İskonto </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="number" id="txtAlisFaturasiIskonto" name="txtAlisFaturasiIskonto" class="form-control" value="0">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Alış Faturası Kuru </label>
                    <div class="input-group">
                      <select class="form-control ms show-tick select2" data-id="<?php echo $this->birincilKurIdsi; ?>" name="txtAlisFaturasiKurIdsi" id="txtAlisFaturasiKurIdsi">
                        <option value="0" disabled selected>--Kur Seçiniz--</option>
                        <?php
                          for ($i=0; $i < count($this->kurlar); $i++) {
                            echo
                            '<option value="'.$this->kurlar[$i]["id"].'">'.$this->kurlar[$i]["kur_adi"].'</option>';
                          }

                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKurEkle" data-toggle="modal" data-target="#modalYeniKurEkle" name="button">Kur Ekle</button>

                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Alış Faturası Açıklaması </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtAlisFaturasiAciklamasi" name="txtAlisFaturasiAciklamasi" class="form-control" placeholder="Fatura açıklaması giriniz">

                    </div>
                  </div>
                </div>
                <div class="row divOdemelereKaydet kayitSekilleri d-none">
                  <div class="col-md-12">
                    <label for="email_address">Cari Hesap </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtOdemelereKaydetCariHesapIdsi" autocomplete="off" name="txtOdemelereKaydetCariHesapIdsi" data-tablo-index="10" data-kolon-index="12" class="form-control dataSearch"  placeholder="Cari hesap adı yazınız">
                      <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Ödeme Kodu </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtOdemelereKaydetOdemeKodu" data-tablo-index="15" data-kolon-index="17" name="txtOdemelereKaydetOdemeKodu" class="form-control uppercase dataSearch" placeholder="Ödeme kodunu giriniz" autocomplete="off">
                      <ul class="dropdown-menu suggestion-menu inner">

                      </ul>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Ödemenin Yapılacağı Kasa <span class="zmdi zmdi-help" data-toggle="tooltip" title="Birden fazla kasa ile çalışabilir, farklı hesaplarınızı bu şekilde yönetebilirsiniz"></span> </label>
                    <div class="input-group">
                      <select class="form-control ms show-tick select2" data-id="<?php echo $this->birincilKasaIdsi; ?>" name="txtOdemelereKaydetOdemeKasaIdsi" id="txtOdemelereKaydetOdemeKasaIdsi">
                        <option value="0" disabled selected>--Kasa Seçiniz--</option>
                        <?php
                          for ($i=0; $i < count($this->kasalar); $i++) {
                            echo
                            '<option value="'.$this->kasalar[$i]["id"].'">'.$this->kasalar[$i]["kasa_adi"].'</option>';
                          }

                        ?>
                      </select>
                      <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKasaEkle" data-toggle="modal" data-target="#modalYeniKasaEkle" name="button">Kasa Ekle</button>

                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="email_address">Ödeme Açıklaması </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                      <input type="text" id="txtOdemelereKaydetOdemeAciklamasi" name="txtOdemelereKaydetOdemeAciklamasi" class="form-control" placeholder="Ödeme açıklaması giriniz">

                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect btnLoading">KAYDET</button>
              </form>
            </div>
          </div>
        </div>
        <!-- #END# Vertical Layout -->
      </div>



    </div>
  </section>


  <div class="modal fade" id="modalPaylas" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmPaylas" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Verileri Paylaşın</h4>
          </div>
          <div class="modal-body">
            <label for="">Verilerin şu kadarını paylaş</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
              <input type="text" id="txtPaylasilacakVeriMiktari"  autocomplete="off" name="txtPaylasilacakVeriMiktari" class="form-control veri-araligi" required placeholder="Örn: 50-100">
              <button type="button" class="btn btn-sm btn-default buttonInsideInput btnVerilerinTumunuSec" name="button">Tümünü Seç</button>
            </div>
            <label for="">Şuna dönüştür</label>
            <div class="input-group">
              <select class="form-control" id="txtSunaDonustur" name="txtSunaDonustur">
                <option value="PDF">Pdf</option>
                <option value="EXCEL">Excel</option>
              </select>
            </div>
            <label for="">Dönüşmüş halini</label>
            <div class="checkbox">
              <input id="cboxIndir" name="cboxIndir" type="checkbox" checked>
              <label for="cboxIndir">
                İndir
              </label>
              <a href="#" id="aIndir"></a>
            </div>
            <div class="checkbox">
              <input id="cboxEpostaGonder" name="cboxEpostaGonder" type="checkbox">
              <label for="cboxEpostaGonder">
                E-posta olarak gönder
              </label>
            </div>
            <div class="divEpostaGonderilecekKisi" style="display:none">
              <label for="">E-postayı şu kişi(lere) gönder</label>
              <ul id="epostaGonderilecekKisiler" style="list-style:none">
              </ul>
              <div class="input-group demoMaskedInput">
                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                <input type="hidden" name="dataIndex" value="0">
                <input type="text" id="txtPaylasilacakEpostaAdresi" autocomplete="off" class="form-control dataSearch" data-tablo-index="2" data-kolon-index="2" placeholder="Kişi adı girin">
                <button type="button" class="btn btn-sm btn-default buttonInsideInput" data-toggle="modal" data-target="#modalYeniCariEkle" name="button"><span class="zmdi zmdi-account-add"></span></button>
                <ul class="dropdown-menu ePostaKisiEkle suggestion-menu inner">

                </ul>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-round waves-effect btnLoading">PAYLAŞ</button>
            <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php require $this->yolPhp."arayuz/modalYeniMusteriEkle.php"; ?>
  <?php require $this->yolPhp."arayuz/modalYeniKasaEkle.php"; ?>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/bundles/datatablescripts.bundle.js"></script>

  <script src="<?php echo $this->yolHtml ?>views/merkezler/stok/stok-mal-girisi-yap/stok-mal-girisi-yap.js"></script>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/tables/jquery-datatable.js"></script>

</body>

</html>
