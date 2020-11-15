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
span.urunAdi{
  position: absolute;
font-weight: bold;
bottom: 0;
width: 100%;
left: 0;
background-color: rgba(252, 118, 0, 0.57);
}
.fullBgImage{
  background-size: 100% 100%!important;
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
<input type="hidden" id="txtQrKod" value="<?php echo $this->qrKodu; ?>">
<div class="container-fluid">
  <div class="row clearfix mx-0">
    <div class="col-lg-2 px-1 col-xs-12 " >
      <div class="card">
        <div class="body">
          <div class="table-responsive tblKomutlarKapsayici">
            <table class="table tblKomutlar">
              <tbody>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnDurumDegistir" name="button">Durum Değiştir</button>
                  </td>
                </tr>
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
                    <button type="button" class="btn l-slategray btn-lg btnNotEkle" name="button">Not Ekle</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnYazdir" name="button">Yazdır</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn l-slategray btn-lg btnIptalFisiYazdir" name="button">İptal Fişi Yazdır</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
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
          <a href="<?php echo $this->yolHtml; ?>restoran/odeme/QR,<?php echo $this->qrKodu; ?>" class="btn btn-lg g-bg-cgreen btnOdemeVeKapat" name="button"><span class="zmdi zmdi-money-box"></span>  ÖDEME İŞLEMLERİ</a>
        </div>
        <div class="col-lg-6">
          <a href="http://<?php echo $this->ipAdresi ?>/<?php echo $this->yolHtml; ?>restoran/masalar/" onclick="" class="btn btn-lg bg-red btnOdemeVeKapat btnKapat" name="button"><span class="zmdi zmdi-close"></span> KAPAT</a>
        </div>
      </div>
    </div>
    <div class="col-lg-2 px-1 col-xs-3" >
      <div class="card">
        <div class="body">
          <div class="table-responsive tblUrunKategorileriKapsayici">
            <table class="table tblUrunKategorileri">
              <tbody>
                <tr>
                  <td>
                    <input type="text" placeholder="Kategorilerde filtreleyin" class="form-control keyboard">
                  </td>
                </tr>
                <?php
                if ($this->menuler) {
                  echo
                  '<tr>
                  <td>
                  <button data-id="menuler" type="button" class="btn g-bg-soundcloud btn-lg btnUrunKategorileri" name="button">MENÜLER</button>
                  </td>
                  </tr>';
                }
                for ($i=0; $i < count($this->kategoriler); $i++) {
                  echo
                  '<tr>
                  <td>
                  <button data-id="'.$this->kategoriler[$i]["id"].'" type="button" class="btn g-bg-soundcloud btn-lg btnUrunKategorileri" name="button">'.$this->kategoriler[$i]["kategori_adi"].'</button>
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
    <div class="col-lg-4 px-1 col-xs-9">
      <div class="card mb-0">
        <div class="body">
          <div class="table-responsive tblUrunlerKapsayici">
            <table class="table ">
              <tbody>
                <tr>
                  <input type="text" placeholder="Ürünlerde filtreleyin" class="form-control keyboard">
                </tr>
                <tr class="trAltUrunGeri d-none" >
                  <td>
                    <button type="button" class="btn bg-red" id="btnAltUrunGeri" data-id="" name="button"><span class="zmdi zmdi-arrow-left"></span> GERİ</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row tblUrunler">
              <div class="col-lg-12">

                <?php
                for ($i=0; $i < count($this->menuler); $i++) {
                  $this->menuler[$i]["menu_gorselleri"] = json_decode($this->menuler[$i]["menu_gorselleri"],true);
                  if (count($this->menuler[$i]["menu_gorselleri"]) > 0) {
                    echo
                    '<div class="col-lg-4">
                    <button id="'.$this->menuler[$i]["id"].'"
                    kategori-id="menuler"
                    bg="/local-assets/menuler/'.$this->menuler[$i]["menu_gorselleri"][0].'"
                    style="position:relative"
                    type="button" class="btn btn-lg btnMenuAdi" name="button">
                    <span class="urunAdi">'.$this->menuler[$i]["menu_adi"].'</span>
                    <span class="zmdi zmdi-plus"></span>
                    </button>
                    </div>';
                  }else {
                    echo
                    '<div class="col-lg-4">
                    <button id="'.$this->menuler[$i]["id"].'" kategori-id="menuler" type="button" class="btn l-slategray btn-lg btnMenuAdi" name="button">'.$this->menuler[$i]["menu_adi"].'</button>
                    </div>';
                  }


                }
                for ($a=0; $a < count($this->urunler); $a++) {
                  $this->urunler[$a]["urun_gorseli"] = json_decode($this->urunler[$a]["urun_gorseli"],true);
                  if ($this->urunler[$a]["urunAltUrunBilgileri"]) {
                    if (count($this->urunler[$a]["urun_gorseli"]) > 0) {
                      echo
                      '<div class="col-lg-4">
                      <button id="'.$this->urunler[$a]["id"].'"
                      kategori-id="'.$this->urunler[$a]["urun_kategori_idsi"].'"
                      bg="/local-assets/urunler/'.$this->urunler[$a]["urun_gorseli"][0].'"
                      style="position:relative"
                      type="button" class="btn btn-lg btnAltUrunleriGoster " name="button">
                      <span class="urunAdi">'.$this->urunler[$a]["urun_adi"].'</span>
                      <span class="zmdi zmdi-plus"></span>
                      </button>
                      </div>';
                      for ($i=0; $i < count($this->urunler[$a]["urunAltUrunBilgileri"]); $i++) {
                        echo
                        '<div class="col-lg-4">
                        <button id="'.$this->urunler[$a]["urunAltUrunBilgileri"][$i]["id"].'" ust-urun-id="'.$this->urunler[$a]["id"].'" type="button" class="d-none btn l-slategray btn-lg btnAltUrunAdi btnUrunAdiClass" name="button">'.$this->urunler[$a]["urunAltUrunBilgileri"][$i]["alt_urun_adi"].'</button>
                        </div>';
                      }
                    }else {
                      echo
                      '<div class="col-lg-4">
                      <button id="'.$this->urunler[$a]["id"].'" kategori-id="'.$this->urunler[$a]["urun_kategori_idsi"].'" type="button" class="btn l-slategray btn-lg btnAltUrunleriGoster btnUrunAdiClass" name="button">
                      '.$this->urunler[$a]["urun_adi"].'
                      <span class="zmdi zmdi-plus"></span>
                      </button>
                      </div>';
                      for ($i=0; $i < count($this->urunler[$a]["urunAltUrunBilgileri"]); $i++) {
                        echo
                        '<div class="col-lg-4">
                        <button id="'.$this->urunler[$a]["urunAltUrunBilgileri"][$i]["id"].'" ust-urun-id="'.$this->urunler[$a]["id"].'" type="button" class="d-none btn l-slategray btn-lg btnAltUrunAdi btnUrunAdiClass" name="button">'.$this->urunler[$a]["urunAltUrunBilgileri"][$i]["alt_urun_adi"].'</button>
                        </div>';
                      }
                    }


                  }else {
                    if (count($this->urunler[$a]["urun_gorseli"]) > 0) {

                      echo
                      '<div class="col-lg-4">
                      <button
                      id="'.$this->urunler[$a]["id"].'"
                      style="position:relative"
                      kategori-id="'.$this->urunler[$a]["urun_kategori_idsi"].'"
                      bg="/local-assets/urunler/'.$this->urunler[$a]["urun_gorseli"][0].'"
                      type="button" class="btn btn-lg btnUrunAdi"
                      name="button"><span class="urunAdi">'.$this->urunler[$a]["urun_adi"].'<span></button>
                      </div>';
                    }else {
                      echo
                      '<div class="col-lg-4">
                      <button id="'.$this->urunler[$a]["id"].'" kategori-id="'.$this->urunler[$a]["urun_kategori_idsi"].'" type="button" class="btn l-slategray btn-lg btnUrunAdi" name="button">'.$this->urunler[$a]["urun_adi"].'</button>
                      </div>';
                    }

                  }



                }
                ?>
              </div>
            </div>



          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-lg-12 d-none">
          <div class="table-responsive">
            <table class="table tblTusTakimi">
              <tbody>
                <tr>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">1</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">2</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">3</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">4</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">5</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">6</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">7</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">8</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">9</button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn btn-default btnTusTakimi" name="button">0</button>
                  </td>
                  <td>
                    <button type="button" class="btn bg-red btnTusTakimi" name="button"><span class="zmdi zmdi-close"></span> </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-lg-12">
          <button type="button" class="btn l-slategray" style="width:100%" name="button"><span class="zmdi zmdi-keyboard"></span>  KLAVYE</button>
          <input type="number" class="form-control txtUrunAdedi" id="txtUrunAdedi" name="txtUrunAdedi" placeholder="Ürün adedi " min="1" >
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
            <input type="hidden" name="txtMasaIdsi" id="txtMasaIdsi" value="QR">
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
<div class="modal fade" id="modalTeslimDurumuDegistir" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmTeslimDurumuDegistir" method="post" action="">
      <input type="hidden" name="txtMasaIdsi" required value="<?php echo $this->masaIdsi; ?>">
      <input type="hidden" name="txtAdisyonIdsi" required value="<?php echo $this->adisyonIdsi; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Ürün Teslim Durumunu Değiştir</h4>
        </div>
        <div class="modal-body">
          <label for="">Teslim Durumları</label>
          <div class="input-group demoMaskedInput">
            <select class="form-control select2 ms show-tick" name="txtTeslimDurumuIdsi" required>
              <option value="">--Seçiniz--</option>
              <?php
                for ($i=0; $i < count($this->teslimDurumlari); $i++) {
                  echo '<option value="'.$this->teslimDurumlari[$i]["id"].'" >'.$this->teslimDurumlari[$i]["teslim_durumu_adi"].'</option>';
                }
              ?>
            </select>
          </div>
          <div class="input-group demoMaskedInput">
            <button type="submit" class="btn bg-red waves-effect">KAYDET</button>
            <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">İPTAL</button>
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
<?php require $this->yolPhp."arayuz/modalYeniMusteriEkle.php"; ?>
<?php require $this->yolPhp."arayuz/modalYeniCalisanEkle.php"; ?>
<?php require $this->yolPhp."arayuz/lock.php"; ?>
<?php require $this->yolPhp."arayuz/modalDovizCevirici.php"; ?>

<!-- Jquery Core Js -->
<?php require $this->yolPhp."arayuz/script.php"; ?>
<script src="<?php echo $this->yolHtml ?>assets/js/pages/jquery.keyboard.js"></script>
<script src="<?php echo $this->yolHtml ?>assets/js/pages/mutfak-websocket.js"></script>

<script src="<?php echo $this->yolHtml ?>assets/js/pages/table.js"></script>
<script src="<?php echo $this->yolHtml ?>views/restoran/qr-adisyon/qr-adisyon.js"></script>
</body>

</html>
