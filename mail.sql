-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Ağu 2021, 10:32:21
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `neraaaa`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `belediye_profil`
--

CREATE TABLE `belediye_profil` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `il` varchar(255) NOT NULL,
  `ilce` varchar(255) NOT NULL,
  `adres` text NOT NULL,
  `telefon` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `web_site` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `logo` varchar(512) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `belediye_profil`
--

INSERT INTO `belediye_profil` (`id`, `name`, `il`, `ilce`, `adres`, `telefon`, `email`, `web_site`, `status`, `logo`) VALUES
(96, 'Demo Belediyesi', 'İzmir', 'Konak', 'Güzelyalı Konak İzmir', '05555522784', 'Demo@demo.com.tr', '-', 1, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesagges`
--

CREATE TABLE `mesagges` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `aciklama` varchar(2048) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mesagges`
--

INSERT INTO `mesagges` (`id`, `name`, `aciklama`, `user_id`, `email`) VALUES
(145, 'Ss', 'Yarın gelmeniz rica olunur iyi çalışmalar', 6, 'ggokbudak8@gmail.com'),
(146, 'Gökhan GÖKBUDAK', 'Geldiğimde görüşürüz', 6, 'ggokbudak8@gmail.com'),
(147, 'Gökhan GÖKBUDAK', 'Geldiğimde görüşürüz', 6, 'ggokbudak8@gmail.com'),
(148, 'Gökhan GÖKBUDAK', 'Geldiğimde görüşürüz', 6, 'ggokbudak8@gmail.com'),
(149, 'Gökhan GÖKBUDAK', 'Geldiğimde görüşürüz', 6, 'ggokbudak8@gmail.com'),
(150, 'Gökhan GÖKBUDAK', 'Geldiğimde görüşürüz', 6, 'ggokbudak8@gmail.com'),
(151, 'Gökhan GÖKBUDAK', 'Geldiğimde görüşürüzzz', 6, 'ggokbudak8@gmail.com'),
(152, 'Gökhan GÖKBUDAK', 'Geldiğimde görüşürüzzz', 6, 'ggokbudak8@gmail.com'),
(153, 'Gökhan GÖKBUDAK', 'Bu bir test mesajıdır', 6, 'ggokbudak8@gmail.com'),
(154, 'Gökhan GÖKBUDAK', 'Bu bir test mesajıdır', 6, 'galatasarayli_gg@hotmail.com'),
(155, 'Gökhan GÖKBUDAK', 'Bu bir test mesajıdır', 6, 'galatasarayli_gg@hotmail.com'),
(156, 'Gökhan GÖKBUDAK', 'Bu bir test mesajıdır', 6, 'ggokbudak8@gmail.com'),
(157, 'Gökhan GÖKBUDAK', 'Bu bir test mesajıdır', 6, 'ggokbudak8@gmail.com'),
(158, 'Gökhan GÖKBUDAK', 'Bu bir test mesajıdır', 6, 'ggokbudak8@gmail.com'),
(159, 'Gökhan GÖKBUDAK', 'Bu bir test mesajıdır', 6, 'ggokbudak8@gmail.com'),
(160, 'Gökhan GÖKBUDAK', 'Bu bir test mesajı değildir', 6, 'ggokbudak8@gmail.com'),
(161, 'Gökhan GÖKBUDAK', 'Bu bir test mesajı değildir', 6, 'ggokbudak8@gmail.com'),
(162, 'Ahmet Mehmet', 'nottur', 6, 'ggokbudak8@gmail.com'),
(163, 'Ahmet Mehmet', 'nottur', 6, 'ggokbudak8@gmail.com'),
(164, 'Ahmet Mehmet', 'notturss', 6, 'ggokbudak8@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_06_092349_create_managers_table', 1),
(4, '2017_03_06_092350_create_manager_password_resets_table', 1),
(5, '2017_04_14_131044_create_admins_table', 1),
(6, '2017_04_14_131045_create_admin_password_resets_table', 1),
(7, '2017_04_14_131105_create_ykgiris_table', 1),
(8, '2017_04_14_131106_create_ykgiri_password_resets_table', 1),
(9, '2017_04_14_131140_create_belediyes_table', 1),
(10, '2017_04_14_131141_create_belediye_password_resets_table', 1),
(11, '2017_04_14_131148_create_firmas_table', 1),
(12, '2017_04_14_131149_create_firma_password_resets_table', 1),
(13, '2017_04_14_131157_create_ureticis_table', 1),
(14, '2017_04_14_131158_create_uretici_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL DEFAULT '',
  `level` tinyint(1) NOT NULL DEFAULT 0,
  `parentId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `level`, `parentId`) VALUES
(11, 'Kullanıcılar', 1, NULL),
(12, 'Kullanıcı Ekleyebilir', 0, 11),
(14, 'Kullanıcı Silebilir', 0, 11),
(41, 'Kullanıcı Düzenleyebilir', 0, 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL DEFAULT '',
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `title`, `permissions`) VALUES
(1, 'Admin', '[46,45,44,47,43,42,40,41,30,29,68,31,71,70,75,32,38,37,39,34,33,27,26,67,28,79,80,19,74,2,3,4,1,57,13,12,14,11,36,35,20,62,63,60,59,65,61,64,56,9,8,10,7,54,53,55,52,73,72,24,23,66,25,69,58,21,48,50,49,51,22]'),
(2, 'Sistem Yetkilisi', '[46,45,44,47,43,42,78,40,41,30,29,68,31,71,70,75,32,38,37,39,34,33,27,26,67,28,79,80,19,74,57,13,12,14,11,76,36,35,77,20,62,63,60,59,65,61,64,56,54,53,55,52,73,72,24,23,66,25,69,58,21,48,50,49,51,22]');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `pic`, `roles`, `active`, `created_at`, `updated_at`) VALUES
(6, 'Gökhan GÖKBUDAK', 'ggokbudak8@gmail.com', '$2y$10$QxGIxCK/Pc0EZ3PfdKltSefP939B63p6DaXtAnDUwRh81zARGsuX2', NULL, NULL, 2, 1, '2020-08-25 03:14:37', '2020-09-04 06:42:05');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `belediye_profil`
--
ALTER TABLE `belediye_profil`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesagges`
--
ALTER TABLE `mesagges`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Tablo için indeksler `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `belediye_profil`
--
ALTER TABLE `belediye_profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- Tablo için AUTO_INCREMENT değeri `mesagges`
--
ALTER TABLE `mesagges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=990;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
