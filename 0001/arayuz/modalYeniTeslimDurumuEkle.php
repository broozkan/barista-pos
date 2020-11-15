<div class="modal fade" id="modalYeniTeslimDurumuEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniTeslimDurumuEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Teslim Durumu Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="email_address">Teslim Durumu Adı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtTeslimDurumuAdi" data-tablo-index="22" data-kolon-index="24" autocomplete="off" name="txtTeslimDurumuAdi" class="form-control dataSearch" required placeholder="Teslim durumu adını giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="email_address">Teslim Durumu Rengi</label>
          <div class="input-group divSuggestion">
            <input type="color" id="txtTeslimDurumuRengi" name="txtTeslimDurumuRengi" class="form-control" required>
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
