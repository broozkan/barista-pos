<div class="modal fade z1051" id="modalYeniStatuEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmStatuEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Statü Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="">Statü Adı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <input type="text" id="txtStatuAdi" data-kolon-index="10" data-tablo-index="8" autocomplete="off" name="txtStatuAdi" class="form-control dataSearch" required placeholder="Statü adı giriniz. Örn: Barista">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="">Statü Yetkileri</label>
          <div class="row">
            <div class="col-md-4">
              <div class="checkbox p-3">
                <input id="cboxTumYetkiler" type="checkbox">
                <label for="cboxTumYetkiler"> Tüm Yetkileri Ver</label>
              </div>
            </div>
          </div>
          <hr>
          <div class="input-group demoMaskedInput">
            <div class="row" style="width:100%">
              <div class="col-md-4 divYonetimYetkileri">
                <label for=""><strong>Yönetim Yetkileri</strong></label>
                <div class="checkbox p-3">
                  <input id="cboxYonetimTumYetkiler" type="checkbox">
                  <label for="cboxYonetimTumYetkiler"> Tüm Yönetim Yetkilerini Ver</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtSiparisAlabilir" name="txtSiparisAlabilir" type="checkbox">
                  <label for="txtSiparisAlabilir"> Sipariş alabilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtOdemeAlabilir" name="txtOdemeAlabilir" type="checkbox">
                  <label for="txtOdemeAlabilir"> Ödeme alabilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtHizliSatisYapabilir" name="txtHizliSatisYapabilir" type="checkbox">
                  <label for="txtHizliSatisYapabilir"> Hızlı satış yapabilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtPaketServisYonetebilir" name="txtPaketServisYonetebilir" type="checkbox">
                  <label for="txtPaketServisYonetebilir"> Paket Servis Yönetebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtMutfakEkranlarinaGirebilir" name="txtMutfakEkranlarinaGirebilir" type="checkbox">
                  <label for="txtMutfakEkranlarinaGirebilir"> Mutfak Ekranlarına Girebilir</label>
                </div>
              </div>
              <div class="col-md-4 divMerkezYetkileri">
                <label for=""><strong>Merkez Yetkileri</strong></label>
                <div class="checkbox p-3">
                  <input id="cboxMerkezTumYetkiler" type="checkbox">
                  <label for="cboxMerkezTumYetkiler"> Tüm Merkez Yetkilerini Ver</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtStokMerkezineGirebilir" name="txtStokMerkezineGirebilir" type="checkbox">
                  <label for="txtStokMerkezineGirebilir"> Stok Merkezine Girebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtMuhasebeMerkezineGirebilir" name="txtMuhasebeMerkezineGirebilir" type="checkbox">
                  <label for="txtMuhasebeMerkezineGirebilir"> Muhasebe Merkezine Girebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtRaporMerkezineGirebilir" name="txtRaporMerkezineGirebilir" type="checkbox">
                  <label for="txtRaporMerkezineGirebilir"> Rapor Merkezine Girebilir</label>
                </div>
              </div>
              <div class="col-md-4 divBirimYetkileri">
                <label for=""><strong>Birim Yetkileri</strong></label>
                <div class="checkbox p-3">
                  <input id="cboxBirimTumYetkiler" type="checkbox">
                  <label for="cboxBirimTumYetkiler"> Tüm Birim Yetkilerini Ver</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtKasaEkleyebilir" name="txtKasaEkleyebilir" type="checkbox">
                  <label for="txtKasaEkleyebilir"> Kasa ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtYaziciEkleyebilir" name="txtYaziciEkleyebilir" type="checkbox">
                  <label for="txtYaziciEkleyebilir"> Yazici ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtMutfakEkleyebilir" name="txtMutfakEkleyebilir" type="checkbox">
                  <label for="txtMutfakEkleyebilir"> Mutfak ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtLokasyonEkleyebilir" name="txtLokasyonEkleyebilir" type="checkbox">
                  <label for="txtLokasyonEkleyebilir"> Lokasyon ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtMasaEkleyebilir" name="txtMasaEkleyebilir" type="checkbox">
                  <label for="txtMasaEkleyebilir"> Masa ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtTeslimDurumuEkleyebilir" name="txtTeslimDurumuEkleyebilir" type="checkbox">
                  <label for="txtTeslimDurumuEkleyebilir"> Teslim Durumu ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtStatuEkleyebilir" name="txtStatuEkleyebilir" type="checkbox">
                  <label for="txtStatuEkleyebilir"> Statü ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtCalisanEkleyebilir" name="txtCalisanEkleyebilir" type="checkbox">
                  <label for="txtCalisanEkleyebilir"> Çalışan ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtDepoEkleyebilir" name="txtDepoEkleyebilir" type="checkbox">
                  <label for="txtDepoEkleyebilir"> Depo ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtVergiEkleyebilir" name="txtVergiEkleyebilir" type="checkbox">
                  <label for="txtVergiEkleyebilir"> Vergi ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtKategoriEkleyebilir" name="txtKategoriEkleyebilir" type="checkbox">
                  <label for="txtKategoriEkleyebilir"> Kategori ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtBirimEkleyebilir" name="txtBirimEkleyebilir" type="checkbox">
                  <label for="txtBirimEkleyebilir"> Birim ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtUrunEkleyebilir" name="txtUrunEkleyebilir" type="checkbox">
                  <label for="txtUrunEkleyebilir"> Ürün ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtMenuEkleyebilir" name="txtMenuEkleyebilir" type="checkbox">
                  <label for="txtMenuEkleyebilir"> Menü ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtMusteriEkleyebilir" name="txtMusteriEkleyebilir" type="checkbox">
                  <label for="txtMusteriEkleyebilir"> Müşteri ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtKurEkleyebilir" name="txtKurEkleyebilir" type="checkbox">
                  <label for="txtKurEkleyebilir"> Kur ekleyebilir</label>
                </div>
                <div class="checkbox p-3">
                  <input id="txtOdemeMetoduEkleyebilir" name="txtOdemeMetoduEkleyebilir" type="checkbox">
                  <label for="txtOdemeMetoduEkleyebilir"> Ödeme Metodu ekleyebilir</label>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
          <button type="button" class="btn btn-danger waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
