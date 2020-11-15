<div class="modal fade z1051" id="modalYeniKategoriEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniKategoriEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Kategori Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="">Kategori Adı</label>
          <input type="hidden" name="txtKategoriTabloAdi" value="tbl_urunler" required>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <input type="text" id="txtKategoriAdi" data-kolon-index="0" data-tablo-index="0" autocomplete="off" name="txtKategoriAdi" class="form-control dataSearch"  placeholder="Kategori adı giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">AKTAR</button>
          <button type="button" class="btn bg-red waves-effect btnIptal" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
