<div class="modal fade" id="modalYeniMusteriEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniMusteriEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Müşteri Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="email_address">Müşteri Adı Soyadı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtMusteriAdiSoyadi" data-tablo-index="10" data-kolon-index="12" autocomplete="off" name="txtMusteriAdiSoyadi" class="form-control dataSearch" required placeholder="Müşteri adını giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="email_address">Müşteri Adresleri</label>
          <div class="input-group divMusteriAdresi">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtMusteriAdresleri" required name="txtMusteriAdresleri[]" class="form-control" placeholder="Müşteri birincil adresini giriniz">
            <button type="button" class="btn btn-sm g-bg-cgreen buttonInsideInput btnAdresEkle" name="button">
              <span class="zmdi zmdi-plus"></span>
            </button>
          </div>
          <label for="email_address">Müşteri Telefon Numarası</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtMusteriTelefonNumarasi" required name="txtMusteriTelefonNumarasi" class="form-control mobile-phone-number" placeholder="+90 (000) 000 00 00">
          </div>
          <label for="email_address">Müşteri E-posta Adresi</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtMusteriEpostaAdresi" name="txtMusteriEpostaAdresi" class="form-control email" placeholder="ornek@ornek.com">
          </div>
          <label for="email_address">Müşteri Notları <span class="zmdi zmdi-help" data-toggle="tooltip" title="Müşteriye ait özel bir detay varsa girebilirsiniz. Örn: Çayı açık içer vs."></span> </label>
          <div class="input-group divSuggestion">
            <textarea name="txtMusteriNotlari" class="form-control" style="resize:none" rows="4" cols="80" placeholder="Müşteri notlarını giriniz"></textarea>
          </div>
          <label for="email_address">Müşteri Adisyon İndirim Türü</label>
          <div class="input-group divSuggestion">
            <select class="form-control show-tick ms select2" name="txtMusteriIndirimTuru" id="txtMusteriIndirimTuru" required>
              <option value="0">Yüzde</option>
              <option value="1">Miktar</option>
            </select>
          </div>
          <label for="email_address">Müşteri Adisyon İndirim Miktarı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="number" step=".01" id="txtMusteriIndirimMiktari" required autocomplete="off" name="txtMusteriIndirimMiktari" class="form-control" placeholder="Belirlediğiniz indirim türünün miktarını giriniz">
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
