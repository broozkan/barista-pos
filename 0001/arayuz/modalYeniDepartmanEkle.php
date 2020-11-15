<div class="modal fade" id="modalYeniDepartmanEkle" tabindex="0" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniDepartmanEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Departman Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="">Departman Adı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <input type="text" id="txtDepartmanAdi" data-kolon-index="1" data-tablo-index="1" autocomplete="off" name="txtDepartmanAdi" class="form-control dataSearch" required placeholder="Departman adı giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
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
