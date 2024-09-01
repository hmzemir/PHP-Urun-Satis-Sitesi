-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Haz 2024, 22:20:07
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `phpfinal`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oyunlar`
--

CREATE TABLE `oyunlar` (
  `oyun_id` int(11) NOT NULL,
  `oyun_adi` varchar(200) NOT NULL,
  `oyun_aciklama` varchar(1000) NOT NULL,
  `oyun_resim_url` varchar(1000) NOT NULL,
  `oyun_fiyat` decimal(10,2) NOT NULL,
  `oyun_yayinci` varchar(200) NOT NULL,
  `oyun_yayin_tarihi` date NOT NULL,
  `oyun_platform` varchar(200) NOT NULL,
  `oyun_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `oyunlar`
--

INSERT INTO `oyunlar` (`oyun_id`, `oyun_adi`, `oyun_aciklama`, `oyun_resim_url`, `oyun_fiyat`, `oyun_yayinci`, `oyun_yayin_tarihi`, `oyun_platform`, `oyun_stok`) VALUES
(2, 'Valo', 'Çok güzel oyun.', 'images/game.jpg', 25.95, 'epic', '2021-01-13', 'pc', 0),
(3, 'cs2', 'csgo bitti cs2 geldi', 'images/game1.jpg', 29.99, 'N/A', '2015-08-11', 'N/A', 0),
(4, 'test', 'N/A', 'images/indir.jpg', 39.00, 'N/A', '2024-05-08', 'N/A', 0),
(5, 'RDR2', 'rdr2', 'images/rdr.jpg', 100.00, 'rockstar', '2024-04-18', 'pc', 1),
(6, 'Grand Theft Auto V', 'Grand Theft Auto V, Rockstar North tarafından geliştirilen ve Rockstar Games tarafından yayımlanan 2013 tarihli açık uçlu aksiyon-macera tarzı bir video oyunudur.', 'images/gta5.jpg', 249.00, 'Rockstar', '2013-06-14', 'EPİC', 3),
(7, 'ETS2', 'ETS2 tır oyunu çok güzel oyun tır sürüyon dorse taşıyon', 'images/gta5.jpg', 186.00, 'hmzemir', '2022-06-10', 'PC', 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `uye_id` int(11) NOT NULL,
  `uye_adsoyad` varchar(300) NOT NULL,
  `uye_kadi` varchar(300) NOT NULL,
  `uye_sifre` varchar(300) NOT NULL,
  `uye_eposta` varchar(300) NOT NULL,
  `uye_onay` int(11) NOT NULL,
  `uye_tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`uye_id`, `uye_adsoyad`, `uye_kadi`, `uye_sifre`, `uye_eposta`, `uye_onay`, `uye_tarih`) VALUES
(1, 'emir', 'hmzemir', '6116afedcb0bc31083935c1c262ff4c9', 'hamzaemir614@gmail.com', 1, '2024-05-28 12:58:24');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `oyunlar`
--
ALTER TABLE `oyunlar`
  ADD PRIMARY KEY (`oyun_id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`uye_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `oyunlar`
--
ALTER TABLE `oyunlar`
  MODIFY `oyun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `uye_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
