<div class="modal fade" id="modalYeniCalisanEkle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalYeniCalisanEkle" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Yeni Çalışan Ekle</h4>
        </div>
        <div class="modal-body">
          <label for="email_address">Çalışan Adı Soyadı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtCalisanAdiSoyadi" data-tablo-index="3" data-kolon-index="3" autocomplete="off" name="txtCalisanAdiSoyadi" class="form-control dataSearch" required placeholder="Çalışan adı soyadı giriniz">
            <ul class="dropdown-menu suggestion-menu inner">

            </ul>
          </div>
          <label for="email_address">Çalışan Adresi</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtCalisanAdresi" name="txtCalisanAdresi" class="form-control" placeholder="Çalışan adresi giriniz">
          </div>
          <label for="email_address">Çalışan Doğum Tarihi</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="date" id="txtCalisanDogumTarihi" name="txtCalisanDogumTarihi" class="form-control">
          </div>
          <label for="email_address">Çalışan Telefon Numarası</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtCalisanTelefonNumarasi" name="txtCalisanTelefonNumarasi" class="form-control mobile-phone-number" placeholder="+90 (000) 000 00 00">
          </div>
          <label for="email_address">Çalışan E-posta Adresi</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtCalisanEpostaAdresi" name="txtCalisanEpostaAdresi" class="form-control email" placeholder="ornek@ornek.com">
          </div>

          <label for="email_address">Çalışan Profil Fotoğrafı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="file" id="txtCalisanProfilFotosu" name="txtCalisanProfilFotosu" class="form-control">
          </div>

          <label for="email_address">Çalışan Statüsü</label>
          <div class="input-group divSuggestion">
            <select class="form-control select2 ms show-tick" name="txtCalisanStatuIdsi" id="txtCalisanStatuIdsi">
              <?php
                for ($i=0; $i < count($this->statuler); $i++) {
                  echo
                  '<option value="'.$this->statuler[$i]["id"].'">'.$this->statuler[$i]["statu_adi"].'</option>';
                }
              ?>
            </select>
            <button type="button" class="btn btn-sm btn-default buttonInsideInput btnStatuEkle" data-toggle="modal" data-target="#modalYeniStatuEkle" name="button">Statü Ekle</button>

          </div>

          <label for="email_address">Çalışan Kullanıcı Adı</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="text" id="txtCalisanKullaniciAdi" data-tablo-index="3" data-kolon-index="4" autocomplete="off" name="txtCalisanKullaniciAdi" class="form-control dataSearch" placeholder="Kullanıcı adı giriniz">
            <ul class="dropdown-menu suggestion-menu inner ulKullaniciAdlari">

            </ul>
          </div>
          <label for="email_address">Çalışan Parolası</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="password" id="txtCalisanParolasi" required autocomplete="off" name="txtCalisanParolasi" class="form-control" placeholder="Parola giriniz">
          </div>
          <label for="email_address">Çalışan Parola Tekrar</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="password" id="txtCalisanParolasiTekrar" required autocomplete="off" name="txtCalisanParolasiTekrar" class="form-control" placeholder="Parola giriniz (Tekrar)">
          </div>
          <label for="email_address">Çalışan Pini </label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="password" id="txtCalisanPini" required autocomplete="off" name="txtCalisanPini" class="form-control" placeholder="Sisteme giriş pini giriniz">
          </div>
          <label for="email_address">Çalışan Pini (Tekrar)</label>
          <div class="input-group divSuggestion">
            <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
            <input type="password" id="txtCalisanPiniTekrar" required autocomplete="off" name="txtCalisanPiniTekrar" class="form-control" placeholder="Sisteme giriş pini giriniz (Tekrar)">
          </div>
          <label for="email_address">Çalışan Hızlı Notları</label>
          <div class="input-group divSuggestion">
            <input type="text" class="form-control" data-role="tagsinput" placeholder="Çalışan hızlı notları giriniz" items="">
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
