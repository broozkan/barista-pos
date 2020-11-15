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


  <section class="content contact">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2 id="pageName">Musterilerin Listesi</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Musteriler</a></li>
            <li class="breadcrumb-item active">Musterilerin Listesi</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card action_bar">
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-xs-12">
                  <div class="checkbox inlineblock delete_all">
                    <input id="tumunuSec" type="checkbox">
                    <label for="tumunuSec">
                      Tümünü Seç
                    </label>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-12"></div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                  <div class="input-group search">
                    <input type="text" class="form-control tableRowFilter" autocomplete="off" placeholder="Satırları süz...">
                    <span class="input-group-addon">
                      <i class="zmdi zmdi-search"></i>
                    </span>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5 col-xs-12 text-right">


                  <button type="button" class="btn btn-neutral hidden-sm-down" data-toggle="modal" data-target="#modalPaylas" title="Paylaş">
                    <i class="zmdi zmdi-share zmdi-hc-2x"></i>
                  </button>

                  <a href="<?php echo $this->yolHtml; ?>musteri/musteri-ekle/" class="btn btn-neutral hidden-sm-down" data-toggle="tooltip" title="Yeni Ekle">
                    <i class="zmdi zmdi-plus-circle zmdi-hc-2x"></i>
                  </a>

                  <button type="button" class="btn btn-neutral hidden-sm-down btnTopluDuzenle" data-toggle="tooltip" title="Çoklu düzenle">
                    <i class="zmdi zmdi-edit zmdi-hc-2x"></i>
                  </button>

                  <button type="button" class="btn btn-neutral btnTopluSil" data-toggle="tooltip" title="Çoklu sil">
                    <i class="zmdi zmdi-delete zmdi-hc-2x"></i>
                  </button>
                </div>
              </div>
              <hr>

            </div>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="body table-responsive">
              <table class="table table-hover m-b-0 c_list">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Müşteri Adı Soyadı</th>
                    <th>Musteri Telefon Numarası</th>
                    <th>Musteri Eposta Adresi</th>
                    <th class="thLast">İşlem</th>
                  </tr>
                </thead>
                <tbody >
                  <?php
                  for ($i=0; $i < count($this->musteriListesi); $i++) {
                    echo
                    "<tr id='".$this->musteriListesi[$i]["musteriId"]."'>
                    <td>
                    <div class='checkbox'>
                    <input id='delete_".$i."' type='checkbox'>
                    <label for='delete_".$i."'>&nbsp;</label>
                    </div>
                    </td>
                    <td>
                      <p class='c_name'>".$this->musteriListesi[$i]["musteriAdiSoyadi"]."</p>
                    </td>
                    <td>
                      <p class='c_name'>".$this->musteriListesi[$i]["musteriTelefonNumarasi"]."</p>
                    </td>
                    <td>
                      <p class='c_name'>".$this->musteriListesi[$i]["musteriEpostaAdresi"]."</p>
                    </td>
                    <td>
                    <div class='btn-group hidden-sm-down' role='group'>
                    <div class='btn-group'>
                    <button type='button' class='btn btn-neutral dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='zmdi zmdi-label'></i>
                    <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu pullDown'>
                    <li>
                    <a href='".$this->yolHtml."/musteri/musteri-profil/".$this->musteriListesi[$i]["musteriId"]."' >Profile Git</a>
                    </li>
                    <li>
                    <a href='".$this->yolHtml."/musteri/musteri-duzenle/".$this->musteriListesi[$i]["musteriId"]."' >Düzenle</a>
                    </li>
                    <li class='btnSil'>
                    <a>Sil</a>
                    </li>
                    </ul>
                    </div>
                    </div>
                    </td>
                    </tr>";
                  }
                  ?>

                </tbody>
              </table>
              <div id="tableOverlay">
                <img class="table-spinner mx-auto d-block" src='"+yolHtml+"assets/images/table-loader.gif'/>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="body">
              <ul class="pagination pagination-primary m-b-0">
                <li class="page-item arrows" style="pointer-events:none"><a class="page-link" href=""><i class="zmdi zmdi-arrow-left"></i></a></li>
                <?php
                for ($i=1; $i < ($this->sayfaSayisi)+1; $i++) {
                  if ($this->aktifSayfaNumarasi == $i) {
                    $active = "active";
                  }else {
                    $active = "";
                  }
                  echo "<li class='page-item ".$active."'><a class='page-link' id=".$i.">".$i."</a></li>";
                }
                ?>
                <li class="page-item arrows" style="pointer-events:none"><a class="page-link" href=""><i class="zmdi zmdi-arrow-right"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
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
  <?php require $this->yolPhp."arayuz/modalYeniCariEkle.php"; ?>
  <div class="modal fade" id="modalYeniMusteriEkle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmYeniMusteriEkle" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Yeni Musteri Ekle</h4>
          </div>
          <div class="modal-body">
            <label for="">Musteri Adı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="hidden" name="txtMusteriTabloAdi" value="<?php echo $this->searchTabloAdlari[2]; ?>">
              <input type="text" id="txtMusteriAdi" data-kolon-index="0" data-tablo-index="0" autocomplete="off" name="txtMusteriAdi" class="form-control dataSearch" required placeholder="Musteri adı giriniz">
              <ul class="dropdown-menu suggestion-menu inner">

              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
            <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php require $this->yolPhp."arayuz/lock.php"; ?>
  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/musteri/musteri-listesi/musteri-listesi.js"></script>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
</body>

</html>
