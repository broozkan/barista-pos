<div class="modal fade" id="modalYeniVergiEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniVergiEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Vergi Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="email_address">Vergi Adı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtVergiAdi" data-tablo-index="17" data-kolon-index="19" autocomplete="off" name="txtVergiAdi" class="form-control dataSearch" required placeholder="Vergi adını giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="email_address">Vergi Yüzdesi</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="number" id="txtVergiYuzdesi" name="txtVergiYuzdesi" class="form-control" required placeholder="Vergi yüzdesini giriniz">
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
