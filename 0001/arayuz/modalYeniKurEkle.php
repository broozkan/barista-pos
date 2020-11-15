<div class="modal fade" id="modalYeniKurEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniKurEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Kur Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="email_address">Kur Adı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtKurAdi" data-tablo-index="9" data-kolon-index="11" autocomplete="off" name="txtKurAdi" class="form-control dataSearch" required placeholder="Kur adını giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="email_address">Kur İşareti</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtKurIsareti" autocomplete="off" required name="txtKurIsareti" class="form-control" placeholder="Kur işaretini giriniz. Örn :₺, $">
          </div>
          <label for="email_address">Kur Kısaltması</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtKurKisaltmasi" autocomplete="off" name="txtKurKisaltmasi" class="form-control uppercase" required placeholder="Kur kısaltmasını giriniz. Örn: TL,USD">
          </div>
          <label for="email_address">Kur Aktivitesi <span class="zmdi zmdi-help" data-toggle="tooltip" title="Aktif işaretlemeniz durumunda birincil döviz kurunuz olur ve diğer tüm kurlar pasif moduna düşer."></span> </label>
          <div class="input-group divSuggestion">
            <select class="form-control ms show-tick" name="txtKurAktifMi">
              <option value="0">Pasif</option>
              <option value="1">Aktif</option>
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
