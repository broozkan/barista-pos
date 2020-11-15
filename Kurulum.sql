-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 10 Tem 2019, 18:37:27
-- Sunucu sürümü: 8.0.16
-- PHP Sürümü: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `baristapos_brosoft`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_adisyonlar`
--

CREATE TABLE `tbl_adisyonlar` (
  `id` int(11) NOT NULL,
  `adisyon_qr_kodu` varchar(120) DEFAULT NULL,
  `adisyon_masa_idsi` varchar(50) NOT NULL,
  `adisyon_acilis_saati` time NOT NULL,
  `adisyon_odeme_durumu` tinyint(4) NOT NULL,
  `adisyon_notu` varchar(500) NOT NULL,
  `adisyon_tutari` float(10,2) NOT NULL,
  `adisyon_musteri_idsi` int(11) DEFAULT NULL,
  `adisyon_calisan_idsi` int(11) DEFAULT NULL,
  `adisyon_odenmis_tutar` float(10,2) NOT NULL,
  `adisyon_indirim_turu` tinyint(4) NOT NULL,
  `adisyon_indirim_miktari` tinyint(4) NOT NULL,
  `adisyon_indirim_yapan_kisi_idsi` int(11) NOT NULL,
  `adisyon_garson_idsi` int(11) NOT NULL,
  `adisyon_yola_cikti_mi` tinyint(4) NOT NULL DEFAULT '0',
  `adisyon_kurye_idsi` int(11) NOT NULL DEFAULT '0',
  `adisyon_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_adisyon_odemeleri`
--

CREATE TABLE `tbl_adisyon_odemeleri` (
  `id` int(11) NOT NULL,
  `adisyon_odemesi_adisyon_idsi` int(11) NOT NULL,
  `adisyon_odemesi_odeme_metodu_idsi` int(11) NOT NULL,
  `adisyon_odemesi_odeme_miktari` float(10,2) NOT NULL,
  `adisyon_odemesi_odemeyi_alan_kisi_idsi` int(11) NOT NULL,
  `adisyon_odemesi_odeme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adisyon_odemesi_adisyon_urun_idleri` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_adisyon_urunleri`
--

CREATE TABLE `tbl_adisyon_urunleri` (
  `id` int(11) NOT NULL,
  `adisyon_urunleri_adisyon_idsi` int(11) NOT NULL,
  `adisyon_urunleri_urun_idsi` int(11) NOT NULL,
  `adisyon_urunleri_urun_tablo_adi` varchar(75) NOT NULL,
  `adisyon_urunleri_urun_adedi` int(11) NOT NULL,
  `adisyon_urunleri_urun_grami` float DEFAULT NULL,
  `adisyon_urunleri_urun_odenmis_urun_adedi` int(11) NOT NULL,
  `adisyon_urunleri_urun_birim_fiyati` float(10,2) NOT NULL,
  `adisyon_urunleri_urun_toplam_fiyati` float(10,2) NOT NULL,
  `adisyon_urunleri_urun_vergi_miktari` float(10,2) NOT NULL,
  `adisyon_urunleri_urun_teslim_durumu_idsi` int(11) DEFAULT NULL,
  `adisyon_urunleri_urun_ozel_durumu_idsi` int(11) DEFAULT NULL,
  `adisyon_urunleri_urun_notu` varchar(255) NOT NULL,
  `adisyon_urunleri_urun_calisan_idsi` int(11) NOT NULL,
  `adisyon_urunleri_urun_siparis_saati` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_alacaklar`
--

CREATE TABLE `tbl_alacaklar` (
  `id` int(11) NOT NULL,
  `alacak_kodu` varchar(120) NOT NULL,
  `alacak_cari_idsi` int(11) NOT NULL,
  `alacak_tutari` float(10,2) NOT NULL,
  `alacak_kasa_idsi` int(11) NOT NULL,
  `alacak_aciklamasi` varchar(500) DEFAULT NULL,
  `alacak_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_alis_faturalari`
--

CREATE TABLE `tbl_alis_faturalari` (
  `id` int(11) NOT NULL,
  `alis_faturasi_kodu` varchar(120) NOT NULL,
  `alis_faturasi_seri_numarasi` varchar(255) DEFAULT NULL,
  `alis_faturasi_vade_tarihi` varchar(255) NOT NULL,
  `alis_faturasi_cari_idsi` int(11) NOT NULL,
  `alis_faturasi_ara_toplami` float(10,2) NOT NULL,
  `alis_faturasi_iskonto` float(10,2) NOT NULL,
  `alis_faturasi_vergi_miktari` float(10,2) NOT NULL,
  `alis_faturasi_tutari` float(10,2) NOT NULL,
  `alis_faturasi_kasa_idsi` int(11) NOT NULL DEFAULT '0',
  `alis_faturasi_odenmis_miktar` float(10,2) NOT NULL,
  `alis_faturasi_aciklamasi` varchar(500) NOT NULL,
  `alis_faturasi_kesen_kullanici_idsi` int(11) NOT NULL,
  `alis_faturasi_kur_idsi` int(11) NOT NULL,
  `alis_faturasi_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_alis_faturasi_urunleri`
--

CREATE TABLE `tbl_alis_faturasi_urunleri` (
  `id` int(11) NOT NULL,
  `alis_faturasi_idsi` int(11) NOT NULL,
  `alis_faturasi_urun_adi` varchar(255) NOT NULL,
  `alis_faturasi_urun_adedi` int(11) NOT NULL,
  `alis_faturasi_urun_birimi` varchar(120) NOT NULL,
  `alis_faturasi_urun_alis_fiyati` float(10,2) NOT NULL,
  `alis_faturasi_urun_vergi_idsi` int(11) NOT NULL,
  `alis_faturasi_urun_vergi_miktari` float(10,2) NOT NULL,
  `alis_faturasi_urun_tutari` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_alt_urunler`
--

CREATE TABLE `tbl_alt_urunler` (
  `id` int(11) NOT NULL,
  `ust_urun_id` int(11) NOT NULL,
  `alt_urun_kodu` varchar(255) DEFAULT NULL,
  `alt_urun_plu_nosu` int(11) DEFAULT NULL,
  `alt_urun_barkodu` varchar(255) DEFAULT NULL,
  `alt_urun_adi` varchar(255) NOT NULL,
  `alt_urun_birim_idsi` int(11) NOT NULL,
  `alt_urun_adedi` int(100) NOT NULL,
  `alt_urun_rengi` varchar(255) DEFAULT NULL,
  `alt_urun_kategori_idsi` int(11) NOT NULL,
  `alt_urun_gorseli` varchar(255) DEFAULT NULL,
  `alt_urun_alt_uyari_degeri` varchar(255) NOT NULL,
  `alt_urun_kur_idsi` int(11) NOT NULL,
  `alt_urun_kg_fiyati` float(10,2) NOT NULL,
  `alt_urun_alis_fiyati` float(10,2) NOT NULL,
  `alt_urun_satis_fiyati` float(10,2) NOT NULL,
  `alt_urun_alis_vergi_idsi` int(11) NOT NULL,
  `alt_urun_satis_vergi_idsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_alt_urunler`
--

INSERT INTO `tbl_alt_urunler` (`id`, `ust_urun_id`, `alt_urun_kodu`, `alt_urun_plu_nosu`, `alt_urun_barkodu`, `alt_urun_adi`, `alt_urun_birim_idsi`, `alt_urun_adedi`, `alt_urun_rengi`, `alt_urun_kategori_idsi`, `alt_urun_gorseli`, `alt_urun_alt_uyari_degeri`, `alt_urun_kur_idsi`, `alt_urun_kg_fiyati`, `alt_urun_alis_fiyati`, `alt_urun_satis_fiyati`, `alt_urun_alis_vergi_idsi`, `alt_urun_satis_vergi_idsi`) VALUES
(35, 57, 'URUN-112-1', NULL, '', 'Cevizli Baklava', 2, 1000, '', 47, '[\"baklava.jpg\"]', '10', 1, 50.00, 5.00, 15.00, 2, 2),
(36, 57, 'URUN-112-2', NULL, '', 'Fıstıklı Baklava', 2, 100000, '', 47, '[\"baklava.jpg\"]', '10', 1, 80.00, 8.00, 16.00, 2, 2),
(37, 85, 'URUN-119-1', NULL, '', 'PEYNİRLİ GÖZLEME', 1, 100000, '', 53, '[]', '10', 1, 50.00, 4.00, 11.00, 2, 2),
(38, 85, 'URUN-119-2', NULL, '', 'KIYMALI GÖZLEME', 1, 1000000, '', 53, '[]', '10', 1, 60.00, 5.00, 12.00, 2, 2),
(39, 85, 'URUN-119-3', NULL, '', 'KIYMALI KAŞARLI GÖZLEME', 1, 100000, '', 53, '[]', '10', 1, 65.00, 6.00, 13.00, 2, 2),
(40, 85, 'URUN-119-4', NULL, '', 'KAŞARLI GÖZLEME', 1, 100000, '', 53, '[]', '10', 1, 50.00, 5.00, 12.00, 2, 2),
(41, 85, 'URUN-119-5', NULL, '', 'PATATESLİ GÖZLEME', 1, 210000, '', 53, '[]', '100', 1, 50.00, 5.00, 10.00, 2, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_birimler`
--

CREATE TABLE `tbl_birimler` (
  `id` int(11) NOT NULL,
  `birim_adi` varchar(120) NOT NULL,
  `birim_kisaltmasi` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_birimler`
--

INSERT INTO `tbl_birimler` (`id`, `birim_adi`, `birim_kisaltmasi`) VALUES
(1, 'Adet', 'Adet'),
(2, 'Kilogram', 'Kg'),
(3, 'Gram', 'G'),
(4, 'Palet', 'Pl\r\n'),
(5, 'Torba', 'Trba');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_calisanlar`
--

CREATE TABLE `tbl_calisanlar` (
  `id` int(11) NOT NULL,
  `calisan_adi_soyadi` varchar(255) NOT NULL,
  `calisan_adresi` varchar(500) DEFAULT NULL,
  `calisan_dogum_tarihi` varchar(255) DEFAULT NULL,
  `calisan_telefon_numarasi` varchar(255) DEFAULT NULL,
  `calisan_eposta_adresi` varchar(255) DEFAULT NULL,
  `calisan_profil_fotosu` varchar(255) DEFAULT NULL,
  `calisan_statu_idsi` int(11) NOT NULL DEFAULT '0',
  `calisan_kullanici_adi` varchar(255) NOT NULL,
  `calisan_parolasi` varchar(255) NOT NULL,
  `calisan_pini` varchar(255) NOT NULL,
  `calisan_adisyon_yazici_idsi` int(11) DEFAULT NULL,
  `calisan_paket_servis_yazici_idsi` int(11) DEFAULT NULL,
  `calisan_hizli_satis_yazici_idsi` int(11) DEFAULT NULL,
  `calisan_hizli_notlari` varchar(255) NOT NULL,
  `calisan_indirim_turu` tinyint(4) NOT NULL DEFAULT '0',
  `calisan_indirim_miktari` float(10,2) NOT NULL DEFAULT '0.00',
  `calisan_gunluk_harcama_siniri` float(10,2) DEFAULT NULL,
  `calisan_aktif_mi` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_calisanlar`
--

INSERT INTO `tbl_calisanlar` (`id`, `calisan_adi_soyadi`, `calisan_adresi`, `calisan_dogum_tarihi`, `calisan_telefon_numarasi`, `calisan_eposta_adresi`, `calisan_profil_fotosu`, `calisan_statu_idsi`, `calisan_kullanici_adi`, `calisan_parolasi`, `calisan_pini`, `calisan_adisyon_yazici_idsi`, `calisan_paket_servis_yazici_idsi`, `calisan_hizli_satis_yazici_idsi`, `calisan_hizli_notlari`, `calisan_indirim_turu`, `calisan_indirim_miktari`, `calisan_gunluk_harcama_siniri`, `calisan_aktif_mi`) VALUES
(8, 'Burhan Özkan', 'Aydoğan Mah.', '2019-05-01', '90532695596', 'burhan.ozkan@live.com', 'anim.jpg', 5, 'broozkan__', '1c19469d688bac4a495f35dce03d3782', '81dc9bdb52d04dc20036dbd8313ed055', 18, 18, 18, '[\"bro\",\"deneme\",\"tur\\u015fusuz\"]', 0, 10.00, 0.00, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_depolar`
--

CREATE TABLE `tbl_depolar` (
  `id` int(11) NOT NULL,
  `depo_adi` varchar(255) NOT NULL,
  `depo_adresi` varchar(255) NOT NULL,
  `depo_telefon_numarasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_depolar`
--

INSERT INTO `tbl_depolar` (`id`, `depo_adi`, `depo_adresi`, `depo_telefon_numarasi`) VALUES
(1, 'Yerel Depo', 'Yerel', '00000000000');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_kasalar`
--

CREATE TABLE `tbl_kasalar` (
  `id` int(11) NOT NULL,
  `kasa_adi` varchar(255) NOT NULL,
  `kasa_acilis_bakiyesi` float(10,2) NOT NULL,
  `kasa_birincil_kasa_mi` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_kasalar`
--

INSERT INTO `tbl_kasalar` (`id`, `kasa_adi`, `kasa_acilis_bakiyesi`, `kasa_birincil_kasa_mi`) VALUES
(1, 'Varsayılan Kasa', 0.00, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_kategoriler`
--

CREATE TABLE `tbl_kategoriler` (
  `id` int(11) NOT NULL,
  `kategori_adi` varchar(255) NOT NULL,
  `kategori_sira_numarasi` smallint(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_kategoriler`
--

INSERT INTO `tbl_kategoriler` (`id`, `kategori_adi`, `kategori_sira_numarasi`) VALUES
(47, 'Tatlılar', 0),
(51, 'Soğuk İçecekler', 0),
(52, 'Sıcak İçecekler', 0),
(53, 'Yemekler', -5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_kurlar`
--

CREATE TABLE `tbl_kurlar` (
  `id` int(11) NOT NULL,
  `kur_adi` varchar(255) NOT NULL,
  `kur_isareti` varchar(10) DEFAULT NULL,
  `kur_kisaltmasi` varchar(50) NOT NULL,
  `kur_aktif_mi` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_kurlar`
--

INSERT INTO `tbl_kurlar` (`id`, `kur_adi`, `kur_isareti`, `kur_kisaltmasi`, `kur_aktif_mi`) VALUES
(1, 'Türk Lirası', '₺', 'TRY', 1),
(3, 'Euro', '€', 'EURO', 0),
(4, 'Arap Riyali', 'R', 'RYL', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_lokasyonlar`
--

CREATE TABLE `tbl_lokasyonlar` (
  `id` int(11) NOT NULL,
  `lokasyon_adi` varchar(255) NOT NULL,
  `lokasyon_kati` int(11) NOT NULL,
  `lokasyon_krokisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_lokasyonlar`
--

INSERT INTO `tbl_lokasyonlar` (`id`, `lokasyon_adi`, `lokasyon_kati`, `lokasyon_krokisi`) VALUES
(6, 'GİRİŞ', 1, 'img (1).png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_masalar`
--

CREATE TABLE `tbl_masalar` (
  `id` int(11) NOT NULL,
  `masa_adi` varchar(255) NOT NULL,
  `masa_durumu` tinyint(4) NOT NULL,
  `masa_lokasyon_idsi` int(11) NOT NULL,
  `masa_gorselleri` varchar(255) NOT NULL,
  `masa_rezerve_eden_kisi_idsi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_masalar`
--

INSERT INTO `tbl_masalar` (`id`, `masa_adi`, `masa_durumu`, `masa_lokasyon_idsi`, `masa_gorselleri`, `masa_rezerve_eden_kisi_idsi`) VALUES
(107, 'G01', 0, 6, '[]', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_menuler`
--

CREATE TABLE `tbl_menuler` (
  `id` int(11) NOT NULL,
  `menu_adi` varchar(255) NOT NULL,
  `menu_gorselleri` varchar(255) DEFAULT NULL,
  `menu_mutfak_idleri` varchar(255) DEFAULT NULL,
  `menu_toplam_fiyati` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_menuler`
--

INSERT INTO `tbl_menuler` (`id`, `menu_adi`, `menu_gorselleri`, `menu_mutfak_idleri`, `menu_toplam_fiyati`) VALUES
(10, 'İftar Menüsü', '[\"sofra.jpg\"]', '[\"2\"]', 10.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_menu_urunleri`
--

CREATE TABLE `tbl_menu_urunleri` (
  `id` int(11) NOT NULL,
  `menu_urunleri_menu_idsi` int(11) NOT NULL,
  `menu_urunleri_urun_idsi` int(11) NOT NULL,
  `menu_urunleri_urun_adedi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_menu_urunleri`
--

INSERT INTO `tbl_menu_urunleri` (`id`, `menu_urunleri_menu_idsi`, `menu_urunleri_urun_idsi`, `menu_urunleri_urun_adedi`) VALUES
(32, 10, 58, 1),
(33, 10, 31, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_musteriler`
--

CREATE TABLE `tbl_musteriler` (
  `id` int(11) NOT NULL,
  `musteri_adi_soyadi` varchar(255) NOT NULL,
  `musteri_telefon_numarasi` varchar(255) DEFAULT NULL,
  `musteri_eposta_adresi` varchar(255) DEFAULT NULL,
  `musteri_notlari` varchar(500) DEFAULT NULL,
  `musteri_indirim_turu` tinyint(4) NOT NULL,
  `musteri_indirim_miktari` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_musteriler`
--

INSERT INTO `tbl_musteriler` (`id`, `musteri_adi_soyadi`, `musteri_telefon_numarasi`, `musteri_eposta_adresi`, `musteri_notlari`, `musteri_indirim_turu`, `musteri_indirim_miktari`) VALUES
(30, 'Burak Özkan', '00000000000', 'ornek@ornek.com', '', 0, 0.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_musteri_adresleri`
--

CREATE TABLE `tbl_musteri_adresleri` (
  `id` int(11) NOT NULL,
  `musteri_adresleri_musteri_idsi` int(11) NOT NULL,
  `musteri_adresleri_adres` varchar(255) NOT NULL,
  `musteri_adresleri_adres_varsayilan_mi` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_musteri_adresleri`
--

INSERT INTO `tbl_musteri_adresleri` (`id`, `musteri_adresleri_musteri_idsi`, `musteri_adresleri_adres`, `musteri_adresleri_adres_varsayilan_mi`) VALUES
(24, 30, 'Sivas', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_mutfaklar`
--

CREATE TABLE `tbl_mutfaklar` (
  `id` int(11) NOT NULL,
  `mutfak_adi` varchar(255) NOT NULL,
  `mutfak_yazici_idsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_mutfaklar`
--

INSERT INTO `tbl_mutfaklar` (`id`, `mutfak_adi`, `mutfak_yazici_idsi`) VALUES
(2, 'İçecek Mutfağı', 20);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_odemeler`
--

CREATE TABLE `tbl_odemeler` (
  `id` int(11) NOT NULL,
  `odeme_kodu` varchar(120) NOT NULL,
  `odeme_cari_idsi` int(11) NOT NULL,
  `odeme_tutari` float(10,2) NOT NULL,
  `odeme_kasa_idsi` int(11) NOT NULL,
  `odeme_aciklamasi` varchar(500) DEFAULT NULL,
  `odeme_tarihi` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_odeme_metodlari`
--

CREATE TABLE `tbl_odeme_metodlari` (
  `id` int(11) NOT NULL,
  `odeme_metod_okc_idsi` tinyint(4) DEFAULT NULL,
  `odeme_metod_adi` varchar(255) NOT NULL,
  `odeme_metod_siralamasi` int(11) NOT NULL,
  `odeme_metod_aktif_mi` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_odeme_metodlari`
--

INSERT INTO `tbl_odeme_metodlari` (`id`, `odeme_metod_okc_idsi`, `odeme_metod_adi`, `odeme_metod_siralamasi`, `odeme_metod_aktif_mi`) VALUES
(1, 0, 'Nakit', 0, 1),
(2, 0, 'Kredi Kartı', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_okc_bilgileri`
--

CREATE TABLE `tbl_okc_bilgileri` (
  `id` int(11) NOT NULL,
  `okc_bilgileri_okc_aktif_mi` tinyint(4) NOT NULL,
  `okc_bilgileri_port_adi` varchar(50) NOT NULL,
  `okc_bilgileri_baudrate` varchar(50) NOT NULL DEFAULT '115200',
  `okc_bilgileri_fiscal_idsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_okc_bilgileri`
--

INSERT INTO `tbl_okc_bilgileri` (`id`, `okc_bilgileri_okc_aktif_mi`, `okc_bilgileri_port_adi`, `okc_bilgileri_baudrate`, `okc_bilgileri_fiscal_idsi`) VALUES
(8, 0, 'COM9', '115200', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_paket_siparisler`
--

CREATE TABLE `tbl_paket_siparisler` (
  `id` int(11) NOT NULL,
  `paket_siparis_acilis_saati` time NOT NULL,
  `paket_siparis_notu` varchar(500) NOT NULL,
  `paket_siparis_tutari` float(10,2) NOT NULL,
  `paket_siparis_musteri_idsi` int(11) DEFAULT NULL,
  `paket_siparis_indirim_turu` tinyint(4) NOT NULL,
  `paket_siparis_indirim_miktari` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_paket_siparis_urunleri`
--

CREATE TABLE `tbl_paket_siparis_urunleri` (
  `id` int(11) NOT NULL,
  `paket_siparis_urunleri_paket_siparis_idsi` int(11) NOT NULL,
  `paket_siparis_urunleri_urun_idsi` int(11) NOT NULL,
  `paket_siparis_urunleri_urun_tablo_adi` varchar(75) NOT NULL,
  `paket_siparis_urunleri_urun_adedi` int(11) NOT NULL,
  `paket_siparis_urunleri_urun_birim_fiyati` float(10,2) NOT NULL,
  `paket_siparis_urunleri_urun_toplam_fiyati` float(10,2) NOT NULL,
  `paket_siparis_urunleri_urun_vergi_miktari` float(10,2) NOT NULL,
  `paket_siparis_urunleri_urun_ozel_durumu_idsi` int(11) DEFAULT NULL,
  `paket_siparis_urunleri_urun_notu` varchar(255) NOT NULL,
  `paket_siparis_urunleri_urun_siparis_saati` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_program_ayarlari`
--

CREATE TABLE `tbl_program_ayarlari` (
  `id` int(11) NOT NULL,
  `caller_id_aktif_mi` tinyint(4) NOT NULL,
  `yazarkasa_aktif_mi` tinyint(4) NOT NULL,
  `yemeksepeti_aktif_mi` tinyint(4) NOT NULL,
  `program_baslangic_saati` varchar(50) NOT NULL,
  `program_bitis_saati` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_program_ayarlari`
--

INSERT INTO `tbl_program_ayarlari` (`id`, `caller_id_aktif_mi`, `yazarkasa_aktif_mi`, `yemeksepeti_aktif_mi`, `program_baslangic_saati`, `program_bitis_saati`) VALUES
(4, 0, 0, 0, '08:00', '23:45');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_satis_faturalari`
--

CREATE TABLE `tbl_satis_faturalari` (
  `id` int(11) NOT NULL,
  `satis_faturasi_kodu` varchar(120) NOT NULL,
  `satis_faturasi_seri_numarasi` varchar(255) DEFAULT NULL,
  `satis_faturasi_vade_tarihi` varchar(255) NOT NULL,
  `satis_faturasi_cari_idsi` int(11) NOT NULL,
  `satis_faturasi_ara_toplami` float(10,2) NOT NULL,
  `satis_faturasi_iskonto` float(10,2) NOT NULL,
  `satis_faturasi_vergi_miktari` float(10,2) NOT NULL,
  `satis_faturasi_tutari` float(10,2) NOT NULL,
  `satis_faturasi_kasa_idsi` int(11) NOT NULL DEFAULT '0',
  `satis_faturasi_odenmis_miktar` float(10,2) NOT NULL,
  `satis_faturasi_aciklamasi` varchar(500) NOT NULL,
  `satis_faturasi_kesen_kullanici_idsi` int(11) NOT NULL,
  `satis_faturasi_kur_idsi` int(11) NOT NULL,
  `satis_faturasi_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_satis_faturasi_urunleri`
--

CREATE TABLE `tbl_satis_faturasi_urunleri` (
  `id` int(11) NOT NULL,
  `satis_faturasi_idsi` int(11) NOT NULL,
  `satis_faturasi_urun_adi` varchar(255) NOT NULL,
  `satis_faturasi_urun_adedi` int(11) NOT NULL,
  `satis_faturasi_urun_birimi` varchar(120) NOT NULL,
  `satis_faturasi_urun_satis_fiyati` float(10,2) NOT NULL,
  `satis_faturasi_urun_vergi_idsi` int(11) NOT NULL,
  `satis_faturasi_urun_vergi_miktari` float(10,2) NOT NULL,
  `satis_faturasi_urun_tutari` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_sirket`
--

CREATE TABLE `tbl_sirket` (
  `id` int(11) NOT NULL,
  `sirket_adi` varchar(255) NOT NULL,
  `sirket_adresi` varchar(255) NOT NULL,
  `sirket_eposta_adresi` varchar(255) NOT NULL,
  `sirket_telefonu` varchar(255) NOT NULL,
  `sirket_vergi_numarasi` varchar(255) NOT NULL,
  `sirket_logosu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_sirket`
--

INSERT INTO `tbl_sirket` (`id`, `sirket_adi`, `sirket_adresi`, `sirket_eposta_adresi`, `sirket_telefonu`, `sirket_vergi_numarasi`, `sirket_logosu`) VALUES
(3, 'Brosoft Yazılım', 'Sivas', 'iletisim@brosoft.com.tr', '05326955968', '28381849766', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_sirket_carileri`
--

CREATE TABLE `tbl_sirket_carileri` (
  `id` int(11) NOT NULL,
  `cari_adi` varchar(255) NOT NULL,
  `cari_eposta_adresi` varchar(255) NOT NULL,
  `cari_telefon_numarasi` varchar(255) NOT NULL,
  `cari_adresi` varchar(255) NOT NULL,
  `cari_kategorisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_statuler`
--

CREATE TABLE `tbl_statuler` (
  `id` int(11) NOT NULL,
  `statu_adi` varchar(255) NOT NULL,
  `statu_yetkileri` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_statuler`
--

INSERT INTO `tbl_statuler` (`id`, `statu_adi`, `statu_yetkileri`) VALUES
(1, 'Barista', '[{\"cboxTumYetkiler\":false},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":false},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":false},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":false},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":false},{\"txtPaketServisKullanabilir\":false}]'),
(2, 'Yönetici', '[{\"cboxTumYetkiler\":true},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":true},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":true},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":true},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":true},{\"txtPaketServisKullanabilir\":true}]'),
(3, 'Garson', '[{\"cboxTumYetkiler\":false},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":false},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":false},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":false},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":false},{\"txtPaketServisKullanabilir\":false}]'),
(4, 'Aşçı', '[{\"cboxTumYetkiler\":false},{\"txtSiparisAlabilir\":false},{\"txtOdemeAlabilir\":false},{\"txtUrunEkleyebilir\":true},{\"txtCalisanEkleyebilir\":false},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtAyarlaraGirebilir\":false},{\"txtMutfakGoruntuleyebilir\":true},{\"txtRaporGoruntuleyebilir\":false},{\"txtStokDuzenleyebilir\":true},{\"txtMuhasebeKullanabilir\":false},{\"txtPaketServisKullanabilir\":true}]'),
(5, 'Müdür', '[{\"cboxTumYetkiler\":true},{\"cboxYonetimTumYetkiler\":true},{\"txtSiparisAlabilir\":true},{\"txtOdemeAlabilir\":true},{\"txtHizliSatisYapabilir\":true},{\"txtPaketServisYonetebilir\":true},{\"txtMutfakEkranlarinaGirebilir\":true},{\"cboxMerkezTumYetkiler\":true},{\"txtStokMerkezineGirebilir\":true},{\"txtMuhasebeMerkezineGirebilir\":true},{\"txtRaporMerkezineGirebilir\":true},{\"cboxBirimTumYetkiler\":true},{\"txtKasaEkleyebilir\":true},{\"txtYaziciEkleyebilir\":true},{\"txtMutfakEkleyebilir\":true},{\"txtLokasyonEkleyebilir\":true},{\"txtMasaEkleyebilir\":true},{\"txtTeslimDurumuEkleyebilir\":true},{\"txtStatuEkleyebilir\":true},{\"txtCalisanEkleyebilir\":true},{\"txtDepoEkleyebilir\":true},{\"txtVergiEkleyebilir\":true},{\"txtKategoriEkleyebilir\":true},{\"txtBirimEkleyebilir\":true},{\"txtUrunEkleyebilir\":true},{\"txtMenuEkleyebilir\":true},{\"txtMusteriEkleyebilir\":true},{\"txtKurEkleyebilir\":true},{\"txtOdemeMetoduEkleyebilir\":true}]');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_stok_dusme_bilgileri`
--

CREATE TABLE `tbl_stok_dusme_bilgileri` (
  `id` int(11) NOT NULL,
  `ait_urun_idsi` int(11) NOT NULL,
  `ait_urun_tablo_adi` varchar(75) NOT NULL,
  `stoktan_dusulecek_urun_idsi` int(11) NOT NULL,
  `stoktan_dusum_miktari` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_stok_dusme_bilgileri`
--

INSERT INTO `tbl_stok_dusme_bilgileri` (`id`, `ait_urun_idsi`, `ait_urun_tablo_adi`, `stoktan_dusulecek_urun_idsi`, `stoktan_dusum_miktari`) VALUES
(1, 36, '', 39, '0.100'),
(2, 36, '', 37, '0.50'),
(5, 59, '', 39, '10'),
(6, 59, '', 38, '12'),
(7, 26, '', 37, '222'),
(13, 60, '', 10, '111'),
(57, 58, '', 39, '10'),
(58, 58, '', 37, '11'),
(101, 30, 'tbl_alt_urunler', 39, '100'),
(102, 31, 'tbl_alt_urunler', 38, '125'),
(103, 31, 'tbl_alt_urunler', 39, '360'),
(108, 31, 'tbl_urunler', 38, '0.100'),
(114, 77, 'tbl_urunler', 37, '0'),
(117, 80, 'tbl_urunler', 37, '0.100'),
(118, 80, 'tbl_urunler', 38, '0.10'),
(121, 81, 'tbl_urunler', 39, '0.200'),
(122, 81, 'tbl_urunler', 37, '0.200'),
(123, 34, 'tbl_alt_urunler', 37, '0.999'),
(124, 36, 'tbl_urunler', 39, '0.50'),
(131, 85, 'tbl_urunler', 86, '0.50'),
(132, 37, 'tbl_alt_urunler', 86, '0.50'),
(133, 38, 'tbl_alt_urunler', 86, '0.50'),
(134, 38, 'tbl_alt_urunler', 39, '0.40'),
(135, 39, 'tbl_alt_urunler', 86, '0.50'),
(136, 39, 'tbl_alt_urunler', 39, '0.30'),
(137, 40, 'tbl_alt_urunler', 86, '0.50'),
(138, 41, 'tbl_alt_urunler', 86, '0.50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_tahsilatlar`
--

CREATE TABLE `tbl_tahsilatlar` (
  `id` int(11) NOT NULL,
  `tahsilat_kodu` varchar(120) NOT NULL,
  `tahsilat_cari_idsi` int(11) NOT NULL,
  `tahsilat_tutari` float(10,2) NOT NULL,
  `tahsilat_kasa_idsi` int(11) NOT NULL,
  `tahsilat_aciklamasi` varchar(500) DEFAULT NULL,
  `tahsilat_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_teslim_durumlari`
--

CREATE TABLE `tbl_teslim_durumlari` (
  `id` int(11) NOT NULL,
  `teslim_durumu_adi` varchar(255) NOT NULL,
  `teslim_durumu_rengi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_teslim_durumlari`
--

INSERT INTO `tbl_teslim_durumlari` (`id`, `teslim_durumu_adi`, `teslim_durumu_rengi`) VALUES
(1, 'Hazırlanıyor', '#d7d700'),
(2, 'Hazır', '#00ff00'),
(4, 'Teslim Edildi', '#408080');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_urunler`
--

CREATE TABLE `tbl_urunler` (
  `id` int(11) NOT NULL,
  `urun_kodu` varchar(255) DEFAULT NULL,
  `urun_plu_nosu` int(11) DEFAULT NULL,
  `urun_barkodu` varchar(255) DEFAULT NULL,
  `urun_adi` varchar(255) NOT NULL,
  `urun_birim_idsi` int(11) NOT NULL,
  `urun_adedi` float(10,2) NOT NULL,
  `urun_rengi` varchar(255) DEFAULT NULL,
  `urun_kategori_idsi` int(11) NOT NULL,
  `urun_mutfak_idleri` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `urun_gorseli` varchar(255) DEFAULT NULL,
  `urun_alt_uyari_degeri` varchar(255) NOT NULL,
  `urun_kur_idsi` int(11) NOT NULL,
  `urun_kg_fiyati` float(10,2) NOT NULL,
  `urun_alis_fiyati` float(10,2) NOT NULL,
  `urun_satis_fiyati` float(10,2) NOT NULL,
  `urun_alis_vergi_idsi` int(11) NOT NULL,
  `urun_satis_vergi_idsi` int(11) NOT NULL,
  `urun_stok_urunu_mu` tinyint(4) NOT NULL DEFAULT '0',
  `urun_depo_idsi` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_urunler`
--

INSERT INTO `tbl_urunler` (`id`, `urun_kodu`, `urun_plu_nosu`, `urun_barkodu`, `urun_adi`, `urun_birim_idsi`, `urun_adedi`, `urun_rengi`, `urun_kategori_idsi`, `urun_mutfak_idleri`, `urun_gorseli`, `urun_alt_uyari_degeri`, `urun_kur_idsi`, `urun_kg_fiyati`, `urun_alis_fiyati`, `urun_satis_fiyati`, `urun_alis_vergi_idsi`, `urun_satis_vergi_idsi`, `urun_stok_urunu_mu`, `urun_depo_idsi`) VALUES
(31, 'urun-109', 31, '381765', 'Çay', 1, 1000000.00, '', 52, '[\"1\",\"2\"]', '[\"cay.jpg\"]', '9', 1, 0.00, 0.00, 3.00, 1, 2, 0, 0),
(35, 'urun-110', NULL, '8325982', 'Latte', 1, 100090.00, '', 52, '[\"2\"]', '[\"latte.jpg\"]', '100', 1, 10.00, 2.00, 10.00, 1, 1, 0, 0),
(36, 'urun-111', NULL, '', 'Döner', 1, 9999.00, '', 53, '[\"2\"]', '[]', '9', 1, 9.00, 9.00, 99.00, 1, 1, 0, 0),
(37, 'STOK-100', NULL, '0000000000000', 'Tereyağ', 2, 349.09, '', 46, '[]', '[]', '10', 0, 0.00, 25.00, 0.00, 2, 0, 1, 5),
(38, 'STOK-101', NULL, '', 'Toz Çay', 2, 749.60, '9', 41, '[]', '[]', '9', 1, 0.00, 9.00, 0.00, 1, 0, 1, 1),
(39, 'STOK-102', NULL, '', 'Kırmızı Et', 2, 99.80, '', 46, '[]', '[]', '10', 1, 0.00, 10.00, 0.00, 1, 0, 1, 1),
(57, 'URUN-112', NULL, '352875982359823', 'Baklava', 2, 20.00, '', 47, '[\"2\"]', '[\"baklava.jpg\"]', '5', 1, 60.00, 20.00, 60.00, 1, 1, 0, 0),
(58, 'URUN-113', NULL, '873958273985789', 'Tost', 1, 10000.00, '', 53, '[\"2\"]', '[\"tost.jpg\"]', '50', 1, 20.00, 3.00, 10.00, 1, 1, 0, 0),
(77, 'koddd', NULL, '', 'Makarna', 1, 100.00, '', 53, '[\"1\"]', '[\"makarna.jpg\"]', '50', 1, 0.00, 2.00, 10.00, 1, 1, 0, 0),
(78, 'URUN-115', NULL, '', 'Patates Kızartması', 1, 1000000.00, '', 53, '[\"1\",\"6\"]', '[\"patates-kizartmasi-tarifi.jpg\"]', '10', 1, 20.00, 4.00, 10.00, 1, 1, 0, 0),
(80, 'URUN-116', NULL, '', 'Tereyağlı Katmer', 1, 1000000.00, '', 53, '[\"1\",\"2\",\"6\"]', '[]', '10', 1, 0.00, 1.00, 5.00, 1, 1, 0, 0),
(81, 'URUN-117', NULL, '', 'Hamburger', 1, 100000.00, '', 53, '[\"1\",\"2\",\"6\"]', '[\"hamburger.jpg\"]', '100', 1, 0.00, 8.00, 25.00, 1, 1, 0, 0),
(84, 'URUN-118', NULL, '', 'Mantı', 1, 1000000.00, '', 53, '[\"1\",\"2\",\"6\"]', '[]', '100', 1, 0.00, 10.00, 25.00, 1, 1, 0, 0),
(85, 'URUN-119', NULL, '', 'GÖZLEME', 1, 100000.00, '', 53, '[\"2\"]', '[]', '100', 1, 50.00, 3.00, 10.00, 2, 2, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_verecekler`
--

CREATE TABLE `tbl_verecekler` (
  `id` int(11) NOT NULL,
  `verecek_kodu` varchar(120) NOT NULL,
  `verecek_cari_idsi` int(11) NOT NULL,
  `verecek_tutari` float(10,2) NOT NULL,
  `verecek_kasa_idsi` int(11) NOT NULL,
  `verecek_aciklamasi` varchar(500) DEFAULT NULL,
  `verecek_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_vergiler`
--

CREATE TABLE `tbl_vergiler` (
  `id` int(11) NOT NULL,
  `vergi_adi` varchar(255) NOT NULL,
  `vergi_yuzdesi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_vergiler`
--

INSERT INTO `tbl_vergiler` (`id`, `vergi_adi`, `vergi_yuzdesi`) VALUES
(1, 'KDV18', 18),
(2, 'KDV8', 8),
(3, 'KDV15', 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_yazdirma_ayarlari`
--

CREATE TABLE `tbl_yazdirma_ayarlari` (
  `id` int(11) NOT NULL,
  `yazdirma_ayarlari_masa_adi_gorunsun_mu` tinyint(4) NOT NULL,
  `yazdirma_ayarlari_adisyon_no_gorunsun_mu` tinyint(4) NOT NULL,
  `yazdirma_ayarlari_musteri_adi_gorunsun_mu` tinyint(4) NOT NULL,
  `yazdirma_ayarlari_adisyon_alt_yazi` varchar(255) DEFAULT NULL,
  `yazdirma_ayarlari_paket_servis_yazicisi_idsi` smallint(6) NOT NULL,
  `yazdirma_ayarlari_hizli_satis_oto_yazdir` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_yazdirma_ayarlari`
--

INSERT INTO `tbl_yazdirma_ayarlari` (`id`, `yazdirma_ayarlari_masa_adi_gorunsun_mu`, `yazdirma_ayarlari_adisyon_no_gorunsun_mu`, `yazdirma_ayarlari_musteri_adi_gorunsun_mu`, `yazdirma_ayarlari_adisyon_alt_yazi`, `yazdirma_ayarlari_paket_servis_yazicisi_idsi`, `yazdirma_ayarlari_hizli_satis_oto_yazdir`) VALUES
(5, 1, 1, 1, 'Bizleri tercih ettiğiniz için teşekkür ederiz...', 18, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_yazicilar`
--

CREATE TABLE `tbl_yazicilar` (
  `id` int(11) NOT NULL,
  `yazici_adi` varchar(255) NOT NULL,
  `yazici_ip_adresi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_yazicilar`
--

INSERT INTO `tbl_yazicilar` (`id`, `yazici_adi`, `yazici_ip_adresi`) VALUES
(18, 'icecekYazicisi', '192.168.1.123');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `tbl_adisyonlar`
--
ALTER TABLE `tbl_adisyonlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_adisyon_odemeleri`
--
ALTER TABLE `tbl_adisyon_odemeleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_adisyon_urunleri`
--
ALTER TABLE `tbl_adisyon_urunleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_alacaklar`
--
ALTER TABLE `tbl_alacaklar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_alis_faturalari`
--
ALTER TABLE `tbl_alis_faturalari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_alis_faturasi_urunleri`
--
ALTER TABLE `tbl_alis_faturasi_urunleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_alt_urunler`
--
ALTER TABLE `tbl_alt_urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_birimler`
--
ALTER TABLE `tbl_birimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_calisanlar`
--
ALTER TABLE `tbl_calisanlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_depolar`
--
ALTER TABLE `tbl_depolar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_kasalar`
--
ALTER TABLE `tbl_kasalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_kategoriler`
--
ALTER TABLE `tbl_kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_kurlar`
--
ALTER TABLE `tbl_kurlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_lokasyonlar`
--
ALTER TABLE `tbl_lokasyonlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_masalar`
--
ALTER TABLE `tbl_masalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_menuler`
--
ALTER TABLE `tbl_menuler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_menu_urunleri`
--
ALTER TABLE `tbl_menu_urunleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_musteriler`
--
ALTER TABLE `tbl_musteriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_musteri_adresleri`
--
ALTER TABLE `tbl_musteri_adresleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_mutfaklar`
--
ALTER TABLE `tbl_mutfaklar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_odemeler`
--
ALTER TABLE `tbl_odemeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_odeme_metodlari`
--
ALTER TABLE `tbl_odeme_metodlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_okc_bilgileri`
--
ALTER TABLE `tbl_okc_bilgileri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_paket_siparisler`
--
ALTER TABLE `tbl_paket_siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_paket_siparis_urunleri`
--
ALTER TABLE `tbl_paket_siparis_urunleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_program_ayarlari`
--
ALTER TABLE `tbl_program_ayarlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_satis_faturalari`
--
ALTER TABLE `tbl_satis_faturalari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_satis_faturasi_urunleri`
--
ALTER TABLE `tbl_satis_faturasi_urunleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_sirket`
--
ALTER TABLE `tbl_sirket`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_sirket_carileri`
--
ALTER TABLE `tbl_sirket_carileri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_statuler`
--
ALTER TABLE `tbl_statuler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_stok_dusme_bilgileri`
--
ALTER TABLE `tbl_stok_dusme_bilgileri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_tahsilatlar`
--
ALTER TABLE `tbl_tahsilatlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_teslim_durumlari`
--
ALTER TABLE `tbl_teslim_durumlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_urunler`
--
ALTER TABLE `tbl_urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_verecekler`
--
ALTER TABLE `tbl_verecekler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_vergiler`
--
ALTER TABLE `tbl_vergiler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_yazdirma_ayarlari`
--
ALTER TABLE `tbl_yazdirma_ayarlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_yazicilar`
--
ALTER TABLE `tbl_yazicilar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `tbl_adisyonlar`
--
ALTER TABLE `tbl_adisyonlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_adisyon_odemeleri`
--
ALTER TABLE `tbl_adisyon_odemeleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_adisyon_urunleri`
--
ALTER TABLE `tbl_adisyon_urunleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=801;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_alacaklar`
--
ALTER TABLE `tbl_alacaklar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_alis_faturalari`
--
ALTER TABLE `tbl_alis_faturalari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_alis_faturasi_urunleri`
--
ALTER TABLE `tbl_alis_faturasi_urunleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_alt_urunler`
--
ALTER TABLE `tbl_alt_urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_birimler`
--
ALTER TABLE `tbl_birimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_calisanlar`
--
ALTER TABLE `tbl_calisanlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_depolar`
--
ALTER TABLE `tbl_depolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_kasalar`
--
ALTER TABLE `tbl_kasalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_kategoriler`
--
ALTER TABLE `tbl_kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_kurlar`
--
ALTER TABLE `tbl_kurlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_lokasyonlar`
--
ALTER TABLE `tbl_lokasyonlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_masalar`
--
ALTER TABLE `tbl_masalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_menuler`
--
ALTER TABLE `tbl_menuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_menu_urunleri`
--
ALTER TABLE `tbl_menu_urunleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_musteriler`
--
ALTER TABLE `tbl_musteriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_musteri_adresleri`
--
ALTER TABLE `tbl_musteri_adresleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_mutfaklar`
--
ALTER TABLE `tbl_mutfaklar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_odemeler`
--
ALTER TABLE `tbl_odemeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_odeme_metodlari`
--
ALTER TABLE `tbl_odeme_metodlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_okc_bilgileri`
--
ALTER TABLE `tbl_okc_bilgileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_paket_siparisler`
--
ALTER TABLE `tbl_paket_siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_paket_siparis_urunleri`
--
ALTER TABLE `tbl_paket_siparis_urunleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_program_ayarlari`
--
ALTER TABLE `tbl_program_ayarlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_satis_faturalari`
--
ALTER TABLE `tbl_satis_faturalari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_satis_faturasi_urunleri`
--
ALTER TABLE `tbl_satis_faturasi_urunleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_sirket`
--
ALTER TABLE `tbl_sirket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_sirket_carileri`
--
ALTER TABLE `tbl_sirket_carileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_statuler`
--
ALTER TABLE `tbl_statuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_stok_dusme_bilgileri`
--
ALTER TABLE `tbl_stok_dusme_bilgileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_tahsilatlar`
--
ALTER TABLE `tbl_tahsilatlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_teslim_durumlari`
--
ALTER TABLE `tbl_teslim_durumlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_urunler`
--
ALTER TABLE `tbl_urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_verecekler`
--
ALTER TABLE `tbl_verecekler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_vergiler`
--
ALTER TABLE `tbl_vergiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_yazdirma_ayarlari`
--
ALTER TABLE `tbl_yazdirma_ayarlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `tbl_yazicilar`
--
ALTER TABLE `tbl_yazicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
