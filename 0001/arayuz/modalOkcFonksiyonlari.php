<div class="modal fade" id="modalOkcFonksiyonlari" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title" id="largeModalLabel">ÖKC Fonksiyonları</h4>
      </div>
      <form class="" id="frmOkcFonksiyonlari" action="" method="post">
        <div class="modal-body">
          <div class="col-lg-6">
            <label for="">Fonksiyon Seçimi</label>
            <div class="input-group demoMaskedInput">
              <select class="form-control show-tick ms" name="txtOkcFonksiyonAdi" id="txtOkcFonksiyonAdi">
                <option value="durumSorgula">Cihaz Durumunu Sorgula</option>
                <option value="baglan">Bağlan</option>
                <option value="baglantiyiKapat">Bağlantıyı Kapat</option>
                <option value="belgeyiKapat">Belgeyi Kapat</option>
                <option value="belgeyiIptalEt">Belgeyi İptal Et</option>
                <option value="duzeltme">Düzeltme</option>
                <option value="odemeTipleriniAl">Ödeme Metodlarını Al</option>
              </select>
            </div>
          </div>
          <hr>
          <input type="hidden" name="txtOkcPortAdi" value="<?php echo $this->okcBilgileri["okc_bilgileri_port_adi"]; ?>">
          <input type="hidden" name="txtOkcBaudRate" value="<?php echo $this->okcBilgileri["okc_bilgileri_baudrate"]; ?>">
          <input type="hidden" name="txtOkcFiscalIdsi" value="<?php echo $this->okcBilgileri["okc_bilgileri_fiscal_idsi"]; ?>">
          <div class="divBelgeyiKapat d-none">
            <label for="email_address">Slip Kopyası Basılsın Mı?</label>
            <div class="input-group">
              <div class="form-group">
                <div class="radio inlineblock m-r-20 ">
                  <input type="radio" name="txtSlipKopya" id="male" class="with-gap" value="true">
                  <label for="male">Evet</label>
                </div>
                <div class="radio inlineblock">
                  <input type="radio" name="txtSlipKopya" id="Female" class="with-gap" value="false" checked="checked">
                  <label for="Female">Hayır</label>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-round waves-effect btnLoading">KAYDET</button>
          <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">İPTAL</button>
        </div>
      </form>
    </div>
  </div>
</div>
