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
          <h2 id="pageName">Alacaklarin Listesi</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Alacaklar</a></li>
            <li class="breadcrumb-item active">Alacakların Listesi</li>
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

                  <a href="<?php echo $this->yolHtml; ?>alacak/alacak-ekle/" class="btn btn-neutral hidden-sm-down" data-toggle="tooltip" title="Yeni Ekle">
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
                    <th>Alacak Kodu</th>
                    <th>Alacak Cari Hesap</th>
                    <th>Alacak Tutarı</th>
                    <th>Alacak Kasası</th>
                    <th>Alacak Açıklaması</th>
                    <th class="thLast">İşlem</th>
                  </tr>
                </thead>
                <tbody >
                  <?php
                  for ($i=0; $i < count($this->alacakListesi); $i++) {
                    echo
                    "<tr id='".$this->alacakListesi[$i]["alacakId"]."'>
                    <td>
                    <div class='checkbox'>
                    <input id='delete_".$i."' type='checkbox'>
                    <label for='delete_".$i."'>&nbsp;</label>
                    </div>
                    </td>
                    <td>
                      <p class='c_name'>".$this->alacakListesi[$i]["alacakKodu"]."</p>
                    </td>
                    <td>
                      <p class='c_name'>".$this->alacakListesi[$i]["alacakCariAdi"]."</p>
                    </td>
                    <td>
                      <p class='c_name'>".$this->alacakListesi[$i]["alacakTutari"]."</p>
                    </td>
                    <td>
                      <p class='c_name'>".$this->alacakListesi[$i]["alacakKasaAdi"]."</p>
                    </td>
                    <td>
                      <p class='c_name'>".$this->alacakListesi[$i]["alacakAciklamasi"]."</p>
                    </td>
                    <td>
                    <div class='btn-group hidden-sm-down' role='group'>
                    <div class='btn-group'>
                    <button type='button' class='btn btn-neutral dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='zmdi zmdi-label'></i>
                    <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu pullDown'>
                    <li class='btnTahsilataCevir'>
                    <a>Tahsilata Çevir</a>
                    </li>
                    <li>
                    <a href='/alacak/alacak-duzenle/".$this->alacakListesi[$i]["alacakId"]."' >Düzenle</a>
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
  <div class="modal fade" id="modalTahsilataCevir" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmAlacakTahsilataCevir" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Alacağı Tahsilata Çevir</h4>
          </div>
          <div class="modal-body">
            <label for="email_address">Tahsilat Kodu</label>
            <div class="input-group divSuggestion">
              <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
              <input type="hidden" name="txtAlacakIdsi" required id="txtAlacakIdsi">
              <input type="text" id="txtTahsilatKodu" data-tablo-index="18" data-kolon-index="20" autocomplete="off" name="txtTahsilatKodu" class="form-control dataSearch" required placeholder="Tahsilat kodunu giriniz">
              <ul class="dropdown-menu suggestion-menu inner">

              </ul>
            </div>
            <label for="email_address">Tahsilatın Yapılacağı Cari Hesap</label>
            <div class="input-group divSuggestion">
              <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
              <input type="text" readonly id="txtTahsilatCariIdsi" data-tablo-index="10" data-kolon-index="12" autocomplete="off" name="txtTahsilatCariIdsi" class="form-control dataSearch" required placeholder="Cari adı giriniz">
              <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

              </ul>
            </div>
            <label for="email_address">Tahsilatın Yapılacağı Kasa</label>
            <div class="input-group divSuggestion">
              <select data-id="<?php echo $this->birincilKasaIdsi; ?>" class="form-control select2 ms show-tick" name="txtTahsilatKasaIdsi" id="txtTahsilatKasaIdsi">
                <option value="">--Kasa Seçiniz--</option>
                <?php
                  for ($i=0; $i < count($this->kasalar); $i++) {
                    echo
                    '<option value="'.$this->kasalar[$i]["id"].'">'.$this->kasalar[$i]["kasa_adi"].'</option>';
                  }

                ?>
              </select>
              <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKasaEkle" data-toggle="modal" data-target="#modalYeniKasaEkle" name="button">Kasa Ekle</button>

            </div>
            <label for="email_address">Tahsilat Tutarı <span class="zmdi zmdi-help" data-toggle="tooltip" title="Alacak miktarının tamamı direkt olarak buraya yazılır. Fakat isterseniz tutarı kendiniz belirleyerek de kısmi tahsilat yapabilirsiniz."></span> </label>
            <div class="input-group divSuggestion">
              <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
              <input type="number" step=".01" id="txtTahsilatTutari" name="txtTahsilatTutari" class="form-control" required placeholder="Tahsilat tutarını giriniz">
            </div>
            <label for="email_address">Tahsilat Açıklaması</label>
            <div class="input-group divSuggestion">
              <textarea name="txtTahsilatAciklamasi" id="txtTahsilatAciklamasi" rows="4" class="form-control" cols="80" placeholder="Tahsilat açıklaması girebilirsiniz"></textarea>
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
  <div class="modal fade" id="modalYeniAlacakEkle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <form id="frmYeniAlacakEkle" method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="largeModalLabel">Yeni Alacak Ekle</h4>
          </div>
          <div class="modal-body">
            <label for="">Alacak Adı</label>
            <div class="input-group demoMaskedInput">
              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
              <input type="hidden" name="txtAlacakTabloAdi" value="<?php echo $this->searchTabloAdlari[2]; ?>">
              <input type="text" id="txtAlacakAdi" data-kolon-index="0" data-tablo-index="0" autocomplete="off" name="txtAlacakAdi" class="form-control dataSearch" required placeholder="Alacak adı giriniz">
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
  <?php require $this->yolPhp."arayuz/modalYeniKasaEkle.php"; ?>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
  <script src="<?php echo $this->yolHtml ?>views/merkezler/alacak/alacak-listesi/alacak-listesi.js"></script>
</body>

</html>
