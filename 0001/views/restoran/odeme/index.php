<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>
<link href="<?php echo $this->yolHtml; ?>assets/css/keyboard.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $this->yolHtml; ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" />


<style media="screen">
.table{
  margin-bottom: 0px;
}
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
  font-size: 2vw;
}
.alert-success{
  background: linear-gradient(60deg, #16c99f, #12a682)!important;
}
.btnKalipSayi{
  background: white!important;
  color: black!important;
  border : 1px solid!important;
  border-color: lightgrey!important;
}
.container-fluid{
  padding-left: 0px!important;
  padding-right: 0px!important;
}
.tblKomutlar td{
  padding: 0px!important;
}
.tblKomutlarKapsayici{
  height: 80vh;


  overflow-x: auto!important;
  overflow-y: auto;
}
.tblUrunKategorileri td{
  padding: 0px!important;
}
.tblUrunKategorileriKapsayici{
  height: 80vh;

  overflow-x: auto!important;
  overflow-y: auto;
}
.tblSiparisUrunleriKapsayici{
  height: 42vh;

  overflow-x: hidden!important;
  overflow-y: auto;
}
.tblKomutlar td button{
  width: 96%;
  white-space: normal;
  height: 9vh;
  font-size: 1.2vw;
  padding: 0px!important;
}
.tblUrunKategorileri td button{
  width: 96%;
  height: 13vh;
  font-size: 1.4vw;
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
.tblUrunler div{
  display: contents;

}
.tblTusTakimi{
  margin-bottom: 0px;
}
.tblTusTakimi td button{
  width: 100%;
  font-size: 2.6vw!important;
  padding: 10px;
}
.tblTusTakimi td{
  padding: 3px;
}
.tblMasaBilgileri td{
  padding: 8px;
}

section small{
  font-size: 2vw;
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
    <!-- <div class="block-header">
    <div class="row">
    <div class="col-lg-7 col-md-6 col-xs-12">

  </div>
  <div class="col-lg-5 col-md-6 col-sm-12">

</div>
</div>
</div> -->
<div class="container-fluid">
  <div class="row clearfix mx-0">
    <div class="col-lg-2 px-1 col-sm-3 col-xs-12 " >
      <div class="card">
        <div class="body">
          <div class="table-responsive tblKomutlarKapsayici">
            <table class="table tblKomutlar">
              <tbody>

                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnSil" name="button">Sil</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnIptal" name="button">İptal</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnIkram" name="button">İkram</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg" data-toggle="modal" data-target="#modalMasayaMusteriAta" name="button">Masaya Müşteri Ata</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg" data-toggle="modal" data-target="#modalMasayaCalisanAta" name="button">Masaya Çalışan Ata</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnMasaDegistir" name="button">Masa Değiştir</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnMasaBirlestir" name="button">Masa Birleştir</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnAdisyonBol" name="button">Adisyon Böl</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnIndirimYap" data-toggle="modal" data-target="#modalIndirimYap" name="button">İndirim Yap</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnOdemeGeriAl" name="button">Ödeme Geri Al</button>
                  </td>
                </tr>
                <?php
                if ($this->okcBilgileri) {
                  echo
                  '<tr>
                  <td>
                  <button type="button" class="btn l-slategray btn-lg" data-toggle="modal" data-target="#modalOkcFonksiyonlari" name="button">ÖKC Fonksiyonları</button>
                  </td>
                  </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" id="txtMasaDurumu" value="<?php echo $this->masaDurumu; ?>">
    <input type="hidden" id="txtOkcAktifMi" value="<?php echo $this->okcBilgileri["okc_bilgileri_okc_aktif_mi"]; ?>">
    <input type="hidden" id="txtOkcPortAdi" value="<?php echo $this->okcBilgileri["okc_bilgileri_port_adi"]; ?>">
    <input type="hidden" id="txtOkcBaudRate" value="<?php echo $this->okcBilgileri["okc_bilgileri_baudrate"]; ?>">
    <input type="hidden" id="txtOkcFiscalIdsi" value="<?php echo $this->okcBilgileri["okc_bilgileri_fiscal_idsi"]; ?>">
    <div class="col-lg-4 px-1 col-sm-9 col-xs-9">
      <div class="card">
        <div class="body tblSiparisUrunleriKapsayici">
          <div class="table-responsive">
            <table class="table tblSiparisUrunleri ">
              <thead>
                <th data-toggle="tooltip" title="Şablonı : [İlk Sipariş Adedi] - [Ödenmemiş Adet] ([Seçilen Adet])" >ADET </th>
                <th>İSİM</th>
                <th>NOT</th>
                <th>FİYAT</th>
                <th>DURUM</th>
              </thead>
              <tbody>
                <?php
                // for ($i=0; $i < count($this->adisyonUrunleri); $i++) {
                //   if ($this->adisyonUrunleri[$i]["adisyon_urunleri_urun_tablo_adi"] == "tbl_alt_urunler") {
                //     $urunAdi = $this->adisyonUrunleri[$i]["alt_urun_adi"];
                //   }else {
                //     $urunAdi = $this->adisyonUrunleri[$i]["urun_adi"];
                //   }
                //
                //   echo
                //   '<tr adisyon-urun-idsi="'.$this->adisyonUrunleri[$i]["id"].'" id="'.$this->adisyonUrunleri[$i]["adisyon_urunleri_urun_idsi"].'" tbl="'.$this->adisyonUrunleri[$i]["adisyon_urunleri_urun_tablo_adi"].'">
                //     <td>'.$this->adisyonUrunleri[$i]["adisyon_urunleri_urun_adedi"].'</td>
                //     <td>'.$urunAdi.'</td>
                //     <td>'.$this->adisyonUrunleri[$i]["adisyon_urunleri_urun_notu"].'</td>
                //     <td>'.$this->adisyonUrunleri[$i]["adisyon_urunleri_urun_toplam_fiyati"].' '.$this->varsayilanKurIsareti.'</td>';
                //     switch ($this->adisyonUrunleri[$i]["adisyon_urunleri_urun_teslim_durumu_idsi"]) {
                //       case '0':
                //         echo '<td><span class="badge badge-warning">Hazırlanıyor</span></td>';
                //         break;
                //       case '1':
                //         echo '<td><span class="badge badge-danger">Hazır</span></td>';
                //         break;
                //       case '2':
                //         echo '<td><span class="badge badge-success">Teslim Edildi</span></td>';
                //         break;
                //     }
                //     echo '
                //   </tr>';
                // }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
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
                    <?php
                    // if ($this->masaBilgileri["adisyon_indirim_miktari"] > 0) {
                    //   if ($this->masaBilgileri["adisyon_indirim_turu"] == 0) {
                    //     echo
                    //     '<td id="tdIndirimHucresi">
                    //     <h5 class="m-0"><span id="spanAdisyonIndirimTuru">%</span><span id="spanAdisyonIndirimMiktari">'.$this->masaBilgileri["adisyon_indirim_miktari"].'</span>
                    //     <button class="btn bg-red btn-sm btnIndirimiKaldir float-right" type="button">İndirimi kaldır</button></h5>
                    //
                    //     </td>';
                    //   }else {
                    //     echo
                    //     '<td id="tdIndirimHucresi">
                    //     <h5 class="m-0"><span id="spanAdisyonIndirimMiktari">'.$this->masaBilgileri["adisyon_indirim_miktari"].'</span> <span id="spanAdisyonIndirimTuru">'.$this->varsayilanKurIsareti.'</span>
                    //     <button class="btn bg-red btn-sm btnIndirimiKaldir float-right" type="button">İndirimi kaldır</button></h5>
                    //
                    //     </td>';
                    //   }
                    // }else {
                    //   if ($this->masaBilgileri["adisyon_calisan_idsi"] != null || $this->masaBilgileri["adisyon_musteri_idsi"] != null) {
                    //     if ($this->masaBilgileri["calisan_indirim_miktari"] > 0) {
                    //       echo
                    //       '<td id="tdIndirimHucresi">
                    //       <h5 class="m-0">0 <span class="spanKurIsareti">'.$this->varsayilanKurIsareti.'</span>
                    //       <button class="btn g-bg-cgreen btn-sm btnIndirimiTekrarEkle float-right" type="button">İndirimi Uygula</button></h5>
                    //
                    //       </td>';
                    //     }else {
                    //       echo
                    //       '<td id="tdIndirimHucresi">
                    //       <h5 class="m-0">0 <span class="spanKurIsareti">'.$this->varsayilanKurIsareti.'</span>
                    //       <button disabled class="btn btn-info btn-sm float-right btnIndirimiTekrarEkle" type="button" title="Müşterinin tanımlanan indirim miktarı zaten bulunmamaktadır">Mevcut Değil</button></h5>
                    //       </td>';
                    //     }
                    //
                    //   }else {
                    //     echo
                    //     '<td id="tdIndirimHucresi">
                    //     <h5 class="m-0">0 <span class="spanKurIsareti">'.$this->varsayilanKurIsareti.'</span></h5>
                    //     </td>';
                    //   }
                    //
                    // }
                    ?>
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
                    <p class="m-0 " id="spanMusteriAdiSoyadi">
                      <?php
                      // if ($this->masaBilgileri["adisyon_calisan_idsi"] != null || $this->masaBilgileri["adisyon_musteri_idsi"] != null) {
                      //   echo "<span id=''>".$this->masaBilgileri["musteri_adi_soyadi"]."</span> <button class='btn bg-red btn-sm btnMusteriyiKaldir float-right' type='button'>Müşteriyi kaldır</button>";
                      // }else {
                      //   echo "<span id=''>Masaya müşteri veya çalışan atanmamış</span>";
                      // }
                      ?>
                    </p>

                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-lg-6">
          <b>Yazıcı Seçiniz <span class="zmdi zmdi-help" data-toggle="tooltip" title="Birincil atadığınız yazıcı seçili olarak gelecektir. Fakat başka yazıcıdan da çıktı almak isterseniz yazıcıyı değiştirebilirsiniz."></span> </b>
          <select class="txtYaziciIdsi form-control show-tick" data-id="<?php echo $this->adisyonYazicisiIdsi; ?>">
            <?php
              for ($i=0; $i < count($this->yazicilar); $i++) {
                echo '<option value="'.$this->yazicilar[$i]["id"].'">'.$this->yazicilar[$i]["yazici_adi"].'</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-lg-6 pt-3">
          <button type="button" class="btn btn-lg g-bg-cgreen btnOdemeVeKapat btnAdisyonYazdir" style="font-size:1vw" name="button"><span class="zmdi zmdi-print"></span>  ADİSYON YAZDIR</button>
        </div>
        <div class="col-lg-12">
          <a href="<?php echo $this->yolHtml; ?>restoran/masalar/<?php echo $this->lokasyonIdsi; ?>" onclick="" class="btn btn-lg bg-red btnOdemeVeKapat btnKapat" name="button"><span class="zmdi zmdi-close" style="font-size:1em"></span> KAPAT</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 px-1 col-xs-9">
      <div class="card mb-0">
        <div class="body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive tblUrunlerKapsayici">
                <table class="table tblUrunler">
                  <tbody>
                    <tr>
                      <td><h2><small>Toplam</small></h2> </td>
                      <td><h2><span id="spanToplam"></span> <span class="spanKurIsareti"></span> </h2> </td>
                    </tr>
                    <tr>
                      <td><h2><small>Tahsil Edilen</small></h2> </td>
                      <td><h2><span id="spanTahsilEdilen">0.00</span> <span class="spanKurIsareti"></span> </h2> </td>
                    </tr>
                    <tr class="trParaUstu">
                      <td><h2><small>Para Üstü</small></h2> </td>
                      <td><h2><span id="spanParaUstu" class="text-danger">0.00</span> <span class="spanKurIsareti text-danger"></span> </h2> </td>
                    </tr>
                    <tr class="d-none text-center text-white bg-success trOdendi">
                      <td colspan="2"><h2><small><span class="zmdi zmdi-check-circle zmdi-hc-2x"> Ödendi</small></h2> </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>



          </div>
        </div>
        <div class="row">

          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table tblTusTakimi">
                <tbody>
                  <tr>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnKalipSayi" name="button">10</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">1</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">2</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">3</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnTumu btnKalipSayi" name="button">Tümü</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnKalipSayi" name="button">20</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">4</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">5</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">6</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnKalipSayi" data-toggle="modal" data-target="#modalBirBoluN" name="button">1/n</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnKalipSayi" name="button">50</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">7</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">8</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">9</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnYarisi btnKalipSayi" name="button">1/2</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnKalipSayi" name="button">100</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">.</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default btnNumerik btnTusTakimi" name="button">0</button>
                    </td>
                    <td>
                      <button type="button" class="btn bg-red btnTahsilEdileniTemizle btnTusTakimi" name="button"><span class="zmdi zmdi-close" style="font-size:34px"></span> </button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary btnTusTakimi btnUcteBiri btnKalipSayi" name="button">1/3</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 px-1 col-xs-3">
        <div class="card">
          <div class="body">
            <div class="table-responsive tblUrunKategorileriKapsayici">
              <table class="table tblUrunKategorileri">
                <tbody id="tbodyOdemeMetodlari">
                  <?php
                  if ($this->okcBilgileri) {
                    echo
                    '<tr class="d-none">
                    <td>
                    <button index="-1" data-id="0" type="button" class="btn g-bg-soundcloud btn-lg btnOdemeMetodlari" name="button">NAKİT</button>
                    </td>
                    </tr>
                    <tr class="d-none">
                    <td>
                    <button index="-1" data-id="kart" type="button" class="btn g-bg-soundcloud btn-lg btnOdemeMetodlari" name="button">KREDİ KARTI</button>
                    </td>
                    </tr>';
                  }else {
                    for ($i=0; $i < count($this->odemeMetodlari); $i++) {
                      echo
                      '<tr>
                      <td>
                      <button index="-1" data-id="'.$this->odemeMetodlari[$i]["id"].'" type="button" class="btn g-bg-soundcloud btn-lg btnOdemeMetodlari" name="button">'.$this->odemeMetodlari[$i]["odeme_metod_adi"].'</button>
                      </td>
                      </tr>';
                    }
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
</section>

<div class="modal fade" id="modalUruneNotEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmUruneNotEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Seçili Ürün(ler)e Not Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="">Eklenecek Not:</label>
          <div class="input-group demoMaskedInput">
            <input type="hidden" name="txtAdisyonIdsi" value="<?php echo $this->adisyonIdsi; ?>">
            <input type="hidden" name="txtMasaIdsi" id="txtMasaIdsi" value="<?php echo $this->masaIdsi; ?>">
            <textarea name="txtUrunNotu" required id="txtUrunNotu" class="form-control" rows="8" cols="80" placeholder="Eklemek istediğiniz notu yazınız. Örn: demli olacak"></textarea>
          </div>
          <div class="checkbox">
            <input id="delete_0" name="cboxHizliNotlaraKaydedilsin" type="checkbox">
            <label for="delete_0"> Yazdığım not hızlı notlarıma eklensin</label>
          </div>
        </div>
        <div class="modal-body">
          <p>
            <?php
            for ($i=0; $i < count($this->calisanBilgileri["calisan_hizli_notlari"]); $i++) {
              echo
              '<button type="button" class="btn btn-default btnHizliNotlar">'.$this->calisanBilgileri["calisan_hizli_notlari"][$i].'</button>';
            }
            ?>


          </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
          <button type="button" class="btn bg-red waves-effect " data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalMasayaMusteriAta" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmMasayaMusteriAta" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Masaya Müşteri Ata</h4>
        </div>
        <div class="modal-body">
          <label for="">Müşteri Adı Soyadı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="hidden" name="txtAdisyonIdsi" value="<?php echo $this->adisyonIdsi; ?>" required>
            <input type="text" id="txtMasayaMusteriAtaMusteriAdiSoyadi" data-kolon-index="12" data-tablo-index="10" autocomplete="off" name="txtMasayaMusteriAtaMusteriAdiSoyadi" class="form-control dataSearch" required placeholder="Müşteri adı soyadı giriniz">
            <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

            </ul>
            <button type="button" class="btn btn-sm btn-default buttonInsideInput btnMusteriEkle" data-toggle="modal" data-target="#modalYeniMusteriEkle" name="button">Müşteri Ekle</button>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
          <button type="button" class="btn bg-red waves-effect " data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalMasayaCalisanAta" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmMasayaCalisanAta" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Masaya Çalışan Ata</h4>
        </div>
        <div class="modal-body">
          <label for="">Çalışan Adı Soyadı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="hidden" name="txtAdisyonIdsi" id="txtAdisyonIdsi" value="<?php echo $this->adisyonIdsi; ?>" required>
            <input type="text" id="txtMasayaCalisanAtaCalisanAdiSoyadi" data-kolon-index="3" data-tablo-index="3" autocomplete="off" name="txtMasayaCalisanAtaCalisanAdiSoyadi" class="form-control dataSearch" required placeholder="Çalışan adı soyadı giriniz">
            <ul class="dropdown-menu suggestion-menu inner stokUrunEkle">

            </ul>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
          <button type="button" class="btn bg-red waves-effect " data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalMasaDegistir" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmMasaDegistir" method="post" action="">
      <input type="hidden" name="txtMasaIdsi" required value="<?php echo $this->masaIdsi; ?>">
      <input type="hidden" name="txtAdisyonIdsi" required value="<?php echo $this->adisyonIdsi; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Masa Değiştir</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning">
            Aşağıda kapalı olan masaların listesi verilmiştir. Diğer masalar rezerve veya kilitlidir.
          </div>
          <div class="table-responsive">
            <table class="table tblKapaliMasalar">
              <thead>
                <th>Masa Adı</th>
                <th>Masa Lokasyonu</th>
                <th>İşlem</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalMasaRezerve" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmRezervasyonKaldir" method="post" action="">
      <input type="hidden" name="txtMasaIdsi" required value="<?php echo $this->masaIdsi; ?>">
      <input type="hidden" name="txtAdisyonIdsi" required value="<?php echo $this->adisyonIdsi; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Masa rezervelidir!</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning">
            Bu masa rezerve edilmiştir. Sipariş almaya başlayabilmek için rezervasyonu kaldırmanız gerekmektedir
          </div>
          <label for="">Ne yapmak istersiniz?</label>
          <br>
          <div class="input-group demoMaskedInput">
            <button type="submit" class="btn bg-red waves-effect">Rezervasyonu Kaldır</button>
            <a href="<?php echo $this->yolHtml; ?>restoran/masalar/<?php echo $this->lokasyonIdsi; ?>" class="btn bg-red waves-effect">Geri Dön</a>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalMasaKilitli" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title" id="largeModalLabel">Masa kilitlidir!</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-warning text-center">
          <span class="zmdi zmdi-block zmdi-hc-5x"></span>
        </div>
        <div class="input-group demoMaskedInput">
          <a href="<?php echo $this->yolHtml; ?>restoran/masalar/<?php echo $this->lokasyonIdsi; ?>" class="btn bg-red waves-effect">Geri Dön</a>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="modalMasaBirlestir" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmMasaBirlestir" method="post" action="">
      <input type="hidden" name="txtMasaIdsi" required value="<?php echo $this->masaIdsi; ?>">
      <input type="hidden" name="txtAdisyonIdsi" required value="<?php echo $this->adisyonIdsi; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Masa Birleştir</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning">
            Aşağıda açık olan masaların listesi verilmiştir. Seçtiğiniz masanın ürünleri mevcut masaya aktarılacaktır
          </div>
          <div class="table-responsive">
            <table class="table tblAcikMasalar">
              <thead>
                <th>Masa Adı</th>
                <th>Masa Lokasyonu</th>
                <th>İşlem</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
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
<div class="modal fade" id="modalAdisyonBol" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmAdisyonBol" method="post" action="">
      <input type="hidden" name="txtMasaIdsi" required value="<?php echo $this->masaIdsi; ?>">
      <input type="hidden" name="txtAdisyonIdsi" required value="<?php echo $this->adisyonIdsi; ?>">
      <input type="hidden" name="txtMasaKapansinMi" id="txtMasaKapansinMi" required value="0">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Adisyon Böl</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning">
            Aşağıda açık olan masaların listesi verilmiştir. Seçtiğiniz ürünler aşağıda seçeceğiniz masaya aktarılacaktır
          </div>
          <div class="table-responsive">
            <table class="table tblAcikMasalar">
              <thead>
                <th>Masa Adı</th>
                <th>Masa Lokasyonu</th>
                <th>İşlem</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalBirBoluN" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="frmBirBoluN" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Toplam tutar kaça bölünsün?</h4>
        </div>
        <div class="modal-body">
          <label for="">1/n ?</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="number" id="txtBirBoluN" min="4" value="4" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">BÖL</button>
          <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalIndirimYap" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmIndirimYap" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">İndirim Yap/Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="">Mevcut İndirim Miktarı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="hidden" name="txtAdisyonIdsi" value="<?php echo $this->adisyonIdsi; ?>">
            <input type="number" step=".01" id="txtIndirimMiktari" name="txtIndirimMiktari" min="0" class="form-control" required>
          </div>
          <label for="">Mevcut İndirim Türü</label>
          <div class="input-group demoMaskedInput">
            <select class="form-control select2 ms show-tick" name="txtIndirimTuru" id="txtIndirimTuru" required>
              <option value="0">Yüzde</option>
              <option value="1">Tutar</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">İNDİRİMİ DEĞİŞTİR</button>
          <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalGecmisOdemeler" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmOdemeGeriAl" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Ödeme Geri Al</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table tblGecmisOdemeler">
              <thead>
                <th>Ödeme Tutarı</th>
                <th>Ödeme Metodu</th>
                <th>Ödeme Tarihi Ve Saati</th>
                <th>İşlem</th>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require $this->yolPhp."arayuz/modalYeniMusteriEkle.php"; ?>
<?php require $this->yolPhp."arayuz/modalYeniCalisanEkle.php"; ?>
<?php require $this->yolPhp."arayuz/lock.php"; ?>
<?php require $this->yolPhp."arayuz/modalDovizCevirici.php"; ?>
<?php
if ($this->okcBilgileri) {
  require $this->yolPhp."arayuz/modalOkcFonksiyonlari.php";
}
?>

<!-- Jquery Core Js -->
<?php require $this->yolPhp."arayuz/script.php"; ?>
<script src="<?php echo $this->yolHtml ?>assets/js/pages/forms/advanced-form-elements.js"></script>

<script src="<?php echo $this->yolHtml ?>assets/js/pages/jquery.keyboard.js"></script>
<script src="<?php echo $this->yolHtml ?>assets/js/pages/mutfak-websocket.js"></script>

<script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
<script src="<?php echo $this->yolHtml ?>views/restoran/odeme/odeme.js"></script>
</body>

</html>
