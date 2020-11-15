<div class="modal fade" id="modalYeniKasaEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniKasaEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Kasa Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="email_address">Kasa veya Banka Adı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtKasaAdi" data-tablo-index="13" data-kolon-index="15" autocomplete="off" name="txtKasaAdi" class="form-control dataSearch" required placeholder="Kasa adını giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="email_address">Kasa Açılış Bakiyesi</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="number" step=".01" id="txtKasaAcilisBakiyesi" name="txtKasaAcilisBakiyesi" class="form-control" placeholder="Kasa açılış bakiyesini giriniz">
          </div>
          <label for="email_address">Kasa Birincil Kasa Mı? <span class="zmdi zmdi-help" data-toggle="tooltip" title="Herhangi bir ödeme veya satış yapacağınız zaman ilk olarak bu kasa kullanılacaktır"></span> </label>
          <div class="input-group divSuggestion">
            <select class="form-control ms show-tick" name="txtKasaBirincilKasaMi" id="txtKasaBirincilKasaMi" required>
              <option value="" disabled selected>--Seçiniz--</option>
              <option value="1">Evet</option>
              <option value="0">Hayır</option>
            </select>
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
