<div class="modal fade" id="modalYeniBirimEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniBirimEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Birim Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="email_address">Birim Adı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtBirimAdi" data-tablo-index="14" data-kolon-index="16" autocomplete="off" name="txtBirimAdi" class="form-control dataSearch" required placeholder="Birim adını giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="email_address">Birim Kısaltması</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtBirimKisaltmasi" name="txtBirimKisaltmasi" class="form-control" required placeholder="Birim kısaltmasını giriniz">
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
