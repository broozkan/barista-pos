<div class="modal fade" id="modalYeniLokasyonEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniLokasyonEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Lokasyon Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="">Lokasyon Adı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <input type="text" id="txtLokasyonAdi" data-kolon-index="7" data-tablo-index="5" autocomplete="off" name="txtLokasyonAdi" class="form-control dataSearch" required placeholder="Lokasyon adı giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="">Lokasyon Katı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <input type="number" id="txtLokasyonKati" autocomplete="off" name="txtLokasyonKati" class="form-control" required placeholder="Lokasyon katı giriniz">
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
