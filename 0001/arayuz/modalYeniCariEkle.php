<div class="modal fade" id="modalYeniCariEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniCariEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Cari Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="">Cari Adı</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <input type="text" id="txtCariAdi" data-tablo-index="2" data-kolon-index="2" autocomplete="off" name="txtCariAdi" class="form-control dataSearch" required placeholder="Kişi adı giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="">Cari E-posta Adresi</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
            <input type="text" id="txtCariEpostaAdresi" autocomplete="off" name="txtCariEpostaAdresi" class="form-control email" placeholder="örnek@örnek.com">
          </div>
          <label for="">Cari Telefon Numarası</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
            <input type="text" id="txtCariTelefonNumarasi" autocomplete="off" name="txtCariTelefonNumarasi" class="form-control phone-number" placeholder="Örn: +00 (000) 000 00 00">
          </div>
          <label for="">Cari Adresi</label>
          <div class="input-group demoMaskedInput">
            <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
            <input type="text" id="txtCariAdresi" autocomplete="off" name="txtCariAdresi" class="form-control" placeholder="Adres giriniz">
          </div>
          <label for="">Cari Kategorisi</label>
          <div class="input-group divSuggestion">
            <select id="slctKategoriler" class="form-control show-tick ms select2" name="txtCariKategorisi">
              <?php
                for ($i=0; $i < count($this->cariKategoriBilgileri); $i++) {
                  echo "<option value=".$this->cariKategoriBilgileri[$i]["kategoriId"].">".$this->cariKategoriBilgileri[$i]["kategoriAdi"]."</option>";
                }
              ?>
            </select>
            <button type="button" class="btn btn-sm btn-default buttonInsideInput btnKategoriEkle" data-toggle="modal" data-target="#modalYeniKategoriEkle" name="button">Kategori Ekle</button>

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
