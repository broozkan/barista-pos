<aside id="leftsidebar" class="sidebar">

  <div class="tab-content">
    <div class="tab-pane stretchRight active" id="dashboard">
      <div class="menu">
        <ul class="list">
          <?php
            if (isset($_SESSION["kullaniciAdiSoyadi"])) {
              echo
              '<li>
                <div class="user-info">
                  <div class="image"><a href="#"><img src="/local-assets/calisanlar/'.$this->kullaniciProfilFotosu.'" alt="User"></a></div>
                  <div class="detail">
                    <h4>'.$this->kullaniciAdiSoyadi.'</h4>
                  </div>
                </div>
              </li>';
            }else {
              echo
              '<li>
                <div class="user-info">
                  <div class="image"><a href="#"><img src="/local-assets/calisanlar/profile.png" alt="User"></a></div>
                  <div class="detail">
                    <h4>Barista Pos</h4>
                  </div>
                </div>
              </li>';
            }
          ?>

          <li class="header">YÖNETİM SEKMESİ</li>
          <li>
            <a href="<?php echo $this->yolHtml; ?>yonetim/" class=""><i class="zmdi zmdi-home"></i><span>Yönetim</span></a>
            <a href="<?php echo $this->yolHtml; ?>restoran/masalar" class=""><i class="zmdi zmdi-tablet"></i><span>Masalar</span></a>
            <a href="<?php echo $this->yolHtml; ?>restoran/hizli-satis" class=""><i class="zmdi zmdi-flash"></i><span>Hızlı Satış</span></a>
            <a href="<?php echo $this->yolHtml; ?>restoran/paket-servis" class=""><i class="zmdi zmdi-traffic"></i><span>Paket Servis</span></a>
            <a href="<?php echo $this->yolHtml; ?>restoran/mutfak-ekranlari" class=""><i class="zmdi zmdi-cutlery"></i><span>Mutfak Ekranları</span></a>
            <a href="<?php echo $this->yolHtml; ?>restoran/musteri-ekrani" class=""><i class="zmdi zmdi-accounts-outline"></i><span>Müşteri Ekranları</span></a>
          </li>
          <li class="header">MERKEZLER</li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-cloud-box"></i>
              <span>Stok Merkezi</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>stok/stok-sayimi-yap">Stok Sayımı Yap</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>stok/stok-mal-girisi-yap">Stok Mal Girişi Yap</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>stok/stok-urunu-ekle">Yeni Stok Ürünü Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>stok/stok-listesi">Stok Ürünü Düzenle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>stok/stok-listesi">Stok Ürünleri Listesi</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-money-box"></i>
              <span>Muhasebe Merkezi</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>muhasebe/genel-bakis">Genel Bakış</a> </li>
              <li>
                <a href="javascript:void(0);" class="menu-toggle">
                  <i class="zmdi zmdi-file"></i>
                  <span>Faturalar </span>
                </a>
                <ul class="sc-menu">
                  <li><a href="<?php echo $this->yolHtml; ?>fatura/alis-faturalari">Alış Faturaları</a> </li>
                  <li><a href="<?php echo $this->yolHtml; ?>fatura/satis-faturalari">Satış Faturaları</a> </li>
                </ul>
              </li>
              <li>
                <a href="javascript:void(0);" class="menu-toggle">
                  <i class="zmdi zmdi-swap"></i>
                  <span>Gelir-Gider </span>
                </a>
                <ul class="sc-menu">
                  <li><a href="<?php echo $this->yolHtml; ?>odeme/odeme-listesi">Ödemeler</a> </li>
                  <li><a href="<?php echo $this->yolHtml; ?>tahsilat/tahsilat-listesi">Tahsilatlar</a> </li>
                </ul>
              </li>
              <li>
                <a href="javascript:void(0);" class="menu-toggle">
                  <i class="zmdi zmdi-swap-vertical"></i>
                  <span>Borç Takibi </span>
                </a>
                <ul class="sc-menu">
                  <li><a href="<?php echo $this->yolHtml; ?>alacak/alacak-listesi">Alacaklar</a> </li>
                  <li><a href="<?php echo $this->yolHtml; ?>verecek/verecek-listesi">Verecekler</a> </li>
                </ul>
              </li>
              <!-- <li><a href="<?php echo $this->yolHtml; ?>odeme/odemeler">Ödemeler</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>odeme/tahsilatlar">Yazıcı Düzenle</a> </li> -->
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-chart"></i>
              <span>Rapor Merkezi</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>muhasebe/genel-bakis">Genel Gelir-Gider</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>rapor/urun-raporu">Ürün Raporu</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>rapor/calisan-raporu">Çalışan Raporu</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>rapor/vergi-grup-raporu">Vergi Grup Raporu</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>rapor/hasilat-raporu">Adisyon Hasılat Raporu</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>rapor/gecmis-adisyonlar">Geçmiş Adisyonlar</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>rapor/satis-tipi-raporu">Satış Tipi Raporu</a> </li>
            </ul>
          </li>
          <li class="header">BİRİMLER</li>

          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-balance"></i>
              <span>Kasalar</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>kasa/kasa-listesi">Kasaların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>kasa/kasa-ekle">Kasa Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>kasa/kasa-listesi">Kasa Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-print"></i>
              <span>Yazıcılar</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>yazici/yazici-listesi">Yazıcıların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>yazici/yazici-ekle">Yazıcı Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>yazici/yazici-listesi">Yazıcı Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-cutlery"></i>
              <span>Mutfaklar</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>mutfak/mutfak-listesi">Mutfakların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>mutfak/mutfak-ekle">Mutfak Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>mutfak/mutfak-listesi">Mutfak Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-globe-alt"></i>
              <span>Masa Lokasyonları</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>lokasyon/lokasyon-listesi">Lokasyonların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>lokasyon/lokasyon-ekle">Lokasyon Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>lokasyon/lokasyon-duzenle">Lokasyon Düzenle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>lokasyon/lokasyon-krokisi-olustur">Lokasyon Krokisi Oluştur</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-tablet"></i>
              <span>Masalar</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>masa/masa-listesi">Masaların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>masa/masa-ekle">Masa Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>masa/masa-listesi">Masa Düzenle</a> </li>
            </ul>
          </li>

          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-check-all"></i>
              <span>Teslim Durumları</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>teslim-durum/teslim-durumu-listesi">Teslim Durumu Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>teslim-durum/teslim-durumu-ekle">Teslim Durumu Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>teslim-durum/teslim-durumu-listesi">Teslim Durumu Düzenle</a> </li>
            </ul>
          </li>

          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-accounts"></i>
              <span>Statüler</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>statu/statu-listesi">Statü Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>statu/statu-ekle">Statü Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>statu/statu-listesi">Statü Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-accounts"></i>
              <span>Çalışanlar</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>calisan/calisan-listesi">Çalışanların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>calisan/calisan-ekle">Çalışan Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>calisan/calisan-listesi">Çalışan Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-cloud-box"></i>
              <span>Stok Depoları</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>depo/depo-listesi">Depoların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>depo/depo-ekle">Depo Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>depo/depo-listesi">Depo Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-dns"></i>
              <span>Vergi Tipleri</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>vergi/vergi-listesi">Vergilerin Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>vergi/vergi-ekle">Vergi Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>vergi/vergi-listesi">Vergi Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-format-list-bulleted"></i>
              <span>Ürün Kategorileri</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>kategori/kategori-listesi">Kategorilerin Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>kategori/kategori-ekle">Kategori Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>kategori/kategori-listesi">Kategori Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-dns"></i>
              <span>Ürün Birimleri</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>birim/birim-listesi">Birimlerin Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>birim/birim-ekle">Birim Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>birim/birim-listesi">Birim Düzenle</a> </li>
            </ul>
          </li>

          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-card-travel"></i>
              <span>Ürünler</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>urun/urun-listesi">Ürünlerin Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>urun/urun-ekle">Ürün Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>urun/urun-listesi">Ürün Düzenle</a> </li>
            </ul>
          </li>

          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-menu"></i>
              <span>Menüler</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>menu/menu-listesi">Menülerin Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>menu/menu-ekle">Menü Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>menu/menu-listesi">Menü Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-accounts-alt"></i>
              <span>Müşteriler</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>musteri/musteri-listesi">Müşterilerin Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>musteri/musteri-ekle">Müşteri Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>musteri/musteri-listesi">Müşteri Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-money"></i>
              <span>Kurlar</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>kur/kur-listesi">Kurların Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>kur/kur-ekle">Kur Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>kur/kur-listesi">Kur Düzenle</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-money"></i>
              <span>Ödeme Metodları</span>
            </a>
            <ul class="ml-menu">
              <li><a href="<?php echo $this->yolHtml; ?>odeme-metod/odeme-metod-listesi">Ödeme Metodları Listesi</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>odeme-metod/odeme-metod-ekle">Ödeme Metodu Ekle</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>odeme-metod/odeme-metod-listesi">Ödeme Metodu Düzenle</a> </li>
            </ul>
          </li>
          <li class="header">ŞİRKET, ÇALIŞAN VS. AYARLARI</li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="zmdi zmdi-settings"></i>
              <span>Ayarlar</span>
            </a>
            <ul class="ml-menu">
              <!-- <li><a href="<?php echo $this->yolHtml; ?>program-ayarlari">Program Ayarları</a> </li> -->
              <li><a href="<?php echo $this->yolHtml; ?>ayarlar/program-ayarlari">Program Ayarları</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>ayarlar/sirket-ayarlari">Şirket Ayarları</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>ayarlar/profil-ayarlari">Profil Ayarları</a> </li>
              <li><a href="<?php echo $this->yolHtml; ?>ayarlar/yazdirma-ayarlari">Yazdırma Ayarları</a> </li>
              <li><a href="javascript:void(0);" class="menu-toggle"><span>ÖKC Ayarları </span></a>
                <ul class="sc-menu">
                  <li><a href="<?php echo $this->yolHtml; ?>ayarlar/okc-bilgileri">ÖKC Bilgileri</a> </li>
                  <li><a href="<?php echo $this->yolHtml; ?>ayarlar/departman-tanimlama">Departman Tanımlama</a> </li>
                </ul>
              </li>
              <!-- <li><a href="advanced-form-elements.html">Çalışan Ayarları</a> </li> -->
            </ul>
          </li>
          <li class="header">BARISTA POS</li>
          <a href="<?php echo $this->yolHtml; ?>baristapos/hakkinda" class=""><i class="zmdi zmdi-info"></i><span>Hakkında</span></a>
          <a href="<?php echo $this->yolHtml; ?>baristapos/geri-bildirim" class=""><i class="zmdi zmdi-border-color"></i><span>Geri Bildirim</span></a>
          <a href="<?php echo $this->yolHtml; ?>baristapos/guncelleme" class=""><i class="zmdi zmdi-download"></i><span>Güncelleme</span></a>




        </ul>
      </div>
    </div>

  </div>
</aside>
