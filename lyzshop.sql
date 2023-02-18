-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 12:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lyzshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tips', '2022-02-14 12:35:17', '2022-02-14 12:44:41'),
(2, 'Gaming', '2022-02-14 14:18:51', '2022-02-14 14:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Streaming', '0', NULL, '2022-02-14 12:45:20'),
(2, 'VPN', '0', NULL, NULL),
(4, 'Gaming', '0', '2022-02-11 07:47:24', '2022-02-11 07:47:24'),
(5, 'Graphics', '0', '2022-02-11 07:47:51', '2022-02-11 07:47:51'),
(6, 'Storage', '0', '2022-02-11 07:48:06', '2022-02-11 07:48:06'),
(7, 'Social Media', '0', '2022-02-11 07:48:19', '2022-02-11 07:48:19'),
(8, 'Other', '0', '2022-02-11 07:48:40', '2022-02-11 07:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `midtrans_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_booking_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `order_modal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_increased` tinyint(1) NOT NULL DEFAULT 0,
  `is_reviewed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(26, '2014_10_12_000000_create_users_table', 1),
(27, '2014_10_12_100000_create_password_resets_table', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(30, '2022_02_08_081756_create_products_table', 1),
(31, '2022_02_08_082014_create_categories_table', 1),
(32, '2022_02_08_082222_create_checkouts_table', 1),
(33, '2022_02_14_162209_create_posts_table', 2),
(34, '2022_02_14_162316_create_blog_categories_table', 3),
(35, '2022_02_15_183037_create_reviews_table', 4),
(36, '2022_02_24_221809_create_promo_code_table', 5),
(37, '2022_02_24_221903_create_promo_code_log_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `views` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `slug`, `content`, `image`, `status`, `views`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', 'test', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eu nisl in nisi tincidunt feugiat. Nulla congue, tellus vel mattis condimentum, enim leo volutpat massa, sed accumsan elit risus et erat. Sed lacinia, tellus et molestie bibendum, ligula enim malesuada lorem, ut egestas enim urna in lectus. Integer ac porta justo, eget molestie felis. Nunc pulvinar nulla et magna dignissim, non sollicitudin est faucibus. Etiam interdum urna neque. Nulla id placerat nulla. Duis malesuada libero lacus. Morbi vitae leo accumsan, viverra neque non, facilisis arcu.</p>\r\n\r\n<p>Nunc pulvinar interdum commodo. Integer rutrum ultrices risus a vulputate. Sed arcu tortor, dictum eget pellentesque ac, condimentum eget urna. Curabitur dapibus nisi urna, ut pulvinar tortor dignissim iaculis. Donec accumsan vel risus sit amet convallis. Morbi id dapibus nulla. Etiam suscipit mi ante, non suscipit ipsum viverra vitae. Vivamus eleifend est sit amet arcu finibus, non imperdiet nulla cursus. Maecenas volutpat risus eu consectetur tincidunt. In feugiat, dolor at accumsan efficitur, mi lectus sagittis magna, vitae condimentum orci nisi vel lacus. Etiam nec felis eget eros dignissim ultrices id eget tellus. Maecenas libero nibh, congue a fringilla sed, lobortis ut dolor.</p>', 'file/blog/tfO2Kb7fzn84BmK2VYqX-1041-wut.png', 1, 8, '2022-02-14 12:47:47', '2023-02-13 04:21:14'),
(2, 2, 'Awikwok', 'awikwok', '<p>Awikwok banget</p>', 'file/blog/zH55QOLYLpQJ8xkV8rJ6-Log In.png', 1, 11, '2022-02-14 14:19:39', '2023-02-15 21:59:56'),
(3, 2, 'Test3', 'test3', '<p>Test</p>', 'file/blog/6DPOYI3abhOmCWH5umTR-applemusic.jpg', 1, 15, '2022-02-14 14:28:09', '2023-02-15 21:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Keterangan produk',
  `field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_listed` int(11) NOT NULL DEFAULT 1,
  `sold` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `price`, `details`, `field`, `is_listed`, `sold`, `image`, `views`, `stock`, `created_at`, `updated_at`) VALUES
(5, 'Nord VPN', 'nord-vpn', 2, 5499, '<p>Dengan membeli produk ini, kamu akan mendapatkan 1 akun dengan format:<br />\r\nemail:password</p>\r\n\r\n<p><b>Note:</b></p>\r\n\r\n<p>- Kami hanya mengirimkan satu akun ke satu pembeli<br />\r\n-&nbsp;Akun yang kamu dapatkan memiliki durasi&nbsp;<strong>MINIMAL&nbsp;</strong>satu bulan<br />\r\n- Garansi 30 hari</p>', NULL, 1, 5, 'file/product/aFadSH19SdyYASQtrau7-nordvpn.webp', 116, 4, '2022-02-11 07:44:53', '2023-02-18 22:16:04'),
(6, 'Netflix UHD 1 Profile', 'netflix-uhd-1-profile', 1, 31000, '<p>Region:&nbsp;<strong>RANDOM</strong>&nbsp;(tergantung ketersediaan)</p>\r\n\r\n<p>Kamu akan mendapatkan akun tetapi hanya dibatasi untuk 1 profile dan hanya diperbolehkan mengganti pin profilenya.</p>\r\n\r\n<p>Untuk masalah&nbsp;<strong>screen limit</strong>, kami tidak memiliki kontrol karena bisa saja salah satu pembeli usil atau membagikan profilenya kepada orang banyak.</p>\r\n\r\n<p><b>GARANSI 30 HARI</b></p>', NULL, 1, 14, 'file/product/CKRmRAV0TtzPezn0mUOW-netflix.webp', 41, 4, '2022-02-11 07:45:24', '2023-02-18 22:09:51'),
(7, 'YouTube Premium 1 Bulan', 'youtube-premium-1-bulan', 1, 4999, '<p>YouTube Premium memiliki fitur-fitur yang tidak dapat dinikmati pengguna biasa, seperti:</p>\r\n\r\n<p><strong>YouTube</strong></p>\r\n\r\n<p>- Bebas iklan<br />\r\n- Bisa download video dan diputar saat offline<br />\r\n- Bisa putar video di background</p>\r\n\r\n<p><strong>YouTube Music</strong></p>\r\n\r\n<p>- Bebas iklan<br />\r\n- bisa download lagu dan diputar saat offline<br />\r\n- Bisa putar lagu di background</p>\r\n\r\n<p><strong>YouTube Kids</strong></p>\r\n\r\n<p>- Bebas iklan<br />\r\n- Bisa download video</p>\r\n\r\n<p>Untuk proses cukup menggunakan email saja, namun kamu harus menghubungi kami melalui WA (WA kami bisa dilihat di halaman Tentang Kami) untuk proses selanjutnya.</p>\r\n\r\n<p><strong>Note:</strong></p>\r\n\r\n<p>- Garansi 30 hari<br />\r\n- Maksimal pernah premium satu kali, kalau sudah dua kali maka harus ganti akun lainnya</p>', 'Email', 1, 3, 'file/product/qBhaHmIdpeDCjindsITR-ytpremium.webp', 35, 2, '2022-02-11 07:50:27', '2023-02-18 22:31:48'),
(8, 'Spotify Premium Upgrade 1 Bulan', 'spotify-premium-upgrade-1-bulan', 1, 9998, '<p>Spotify premium memiliki fitur-fitur seperti:</p>\r\n\r\n<p>- High-quality streaming<br />\r\n- Putar lagu secara offline<br />\r\n- Bebas iklan<br />\r\n- Bebas skip lagu</p>\r\n\r\n<p><strong>Note:</strong></p>\r\n\r\n<p>- Garansi 30 hari<br />\r\n- Kami akan kirimkan invite link untuk join family, akun kamu tidak bisa join family&nbsp;karena sebelumnya pernah join family lain berarti bukan tanggung jawab kami</p>', NULL, 1, 0, 'file/product/pnee4shydoKBFOGoFpcd-spotify.webp', 1, 5, '2022-02-11 07:51:30', '2022-09-19 09:20:56'),
(9, 'Apple Music 1 Bulan', 'apple-music-1-bulan', 1, 13000, '<p>Menggunakan sistem invite, dan kami memberikan&nbsp;<strong>GARANSI 30 HARI&nbsp;</strong>dengan catatan tidak boleh keluar dari family saat durasi belum habis</p>', NULL, 1, 0, 'file/product/XyPaKYyhywsIzUExJ57C-applemusic.webp', 1, 5, '2022-02-11 07:52:31', '2022-07-13 06:33:43'),
(10, 'Prime Gaming 1 Bulan', 'prime-gaming-1-bulan', 4, 10000, '<p>Dapatkan in-game loot menarik bahkan game gratis yang bisa kamu dapatkan dengan harga sangat murah. Untuk melihat penawarannya, bisa lihat di&nbsp;<a href=\"https://gaming.amazon.com/home\" target=\"_blank\">sini</a>.</p>\r\n\r\n<p><strong>Note:</strong></p>\r\n\r\n<p>- Akun baru (fresh, belum ada yang di klaim)<br />\r\n- Akun bersifat private (satu akun untuk satu pembeli)<br />\r\n- Akun legal<br />\r\n- Kami tidak bisa memberikan garansi karena kami tidak memiliki kontrol atas akun yang sudah dikirim ke pembeli</p>', NULL, 1, 1, 'file/product/WqB321UBsv60V92Novld-primegaming.webp', 10, 4, '2022-02-11 07:53:24', '2023-02-15 22:13:42'),
(11, 'Steam Random Keys Global', 'steam-random-keys-global', 4, 3500, '<p>Kepingin coba gacha buat dapetin game? Dengan membeli produk ini, kamu akan mendapatkan kunci aktivasi game yang bisa diaktivasi di Steam.</p>\r\n\r\n<p><strong>Note:</strong></p>\r\n\r\n<p>- Kamu akan mendapatkan 4 kunci<br />\r\n- Tidak ada garansi (termasuk mendapatkan kunci aktivasi untuk game yang sama)</p>', NULL, 0, 0, 'file/product/wM6R2Z2BdKtl5ZIDo8io-steam.webp', 0, 5, '2022-02-11 07:54:26', '2022-02-17 11:50:46'),
(12, 'Akun Steam 2007', 'akun-steam-2007', 4, 71499, '<p>Akun Steam tua, cocok untuk:</p>\r\n\r\n<p>- Akun utama<br />\r\n- Akun kedua/ketiga/etc<br />\r\n- Akun untuk flexing</p>\r\n\r\n<p><strong>Spesifikasi:</strong></p>\r\n\r\n<p>- Akun dibuat tahun 2007<br />\r\n- Full access (kamu bisa mengganti semua informasi akun)<br />\r\n- Akun bersih (bebas dari VAC, game ban, community ban)<br />\r\n- Akun masih limit (perlu spend $5)<br />\r\n- CS:GO auto punya koin veteran 5 dan 10 tahun&nbsp;</p>', NULL, 1, 0, 'file/product/GRKPpxTdefYms3o89gfx-steam.webp', 1, 5, '2022-02-11 07:55:10', '2022-07-13 06:38:58'),
(13, 'Akun Steam 2008', 'akun-steam-2008', 4, 57000, '<p>Akun Steam tua, cocok untuk:</p>\r\n\r\n<p>- Akun utama<br />\r\n- Akun kedua/ketiga/etc<br />\r\n- Akun untuk flexing</p>\r\n\r\n<p><strong>Spesifikasi:</strong></p>\r\n\r\n<p>- Akun dibuat tahun 2008<br />\r\n- Full access (kamu bisa mengganti semua informasi akun)<br />\r\n- Akun bersih (bebas dari VAC, game ban, community ban)<br />\r\n- Akun masih limit (perlu spend $5)<br />\r\n- CS:GO auto punya koin veteran 5 dan 10 tahun&nbsp;</p>', NULL, 1, 2, 'file/product/1drlgv75Lr7DsLZMHXEM-steam.webp', 2, 4, '2022-02-11 07:55:48', '2023-01-08 23:09:15'),
(14, 'Akun Steam 2009', 'akun-steam-2009', 4, 42999, '<p>Akun Steam tua, cocok untuk:</p>\r\n\r\n<p>- Akun utama<br />\r\n- Akun kedua/ketiga/etc<br />\r\n- Akun untuk flexing</p>\r\n\r\n<p><strong>Spesifikasi:</strong></p>\r\n\r\n<p>- Akun dibuat tahun 2009<br />\r\n- Full access (kamu bisa mengganti semua informasi akun)<br />\r\n- Akun bersih (bebas dari VAC, game ban, community ban)<br />\r\n- Akun masih limit (perlu spend $5)<br />\r\n- CS:GO auto punya koin veteran 5 dan 10 tahun&nbsp;</p>', NULL, 1, 0, 'file/product/Pkv4BRR8ghz5tnOxT96U-steam.webp', 1, 5, '2022-02-11 07:56:22', '2022-09-19 09:18:53'),
(15, 'HideMyAss VPN 1 Bulan', 'hidemyass-vpn-1-bulan', 2, 29999, '<p>Kamu akan mendapatkan satu kode aktivasi untuk satu perangkat.</p>\r\n\r\n<p><b>TIDAK ADA GARANSI</b> (karena berbentuk kode dan kami tidak memiliki kontrol setelah kode dikirim)</p>', NULL, 1, 0, 'file/product/VenAa8ux5GQMCiJGl5dr-hma.webp', 0, 5, '2022-02-11 07:57:12', '2022-02-17 11:52:10'),
(16, 'Canva Pro 1 Bulan', 'canva-pro-1-bulan', 5, 9999, '<p>Kamu akan mendapatkan invite link untuk join team dan kami memberikan <b>GARANSI 30 HARI.</b></p>', NULL, 1, 2, 'file/product/4bQuuUrXOUz0stIKQ6xN-canva.webp', 2, 0, '2022-02-11 07:57:57', '2022-07-23 14:21:56'),
(17, 'Google Drive Unlimited', 'google-drive-unlimited', 6, 14500, '<p><strong>Fitur:</strong></p>\r\n\r\n<p>- Unlimited storage<br />\r\n- Satu pembeli satu folder</p>\r\n\r\n<p><strong>Note:</strong><br />\r\n- Tidak disarankan untuk menyimpan file penting atau sensitif<br />\r\n- Garansi 30 hari<br />\r\n- Silakan hubungi kami melalui WA (WA kami bisa dilihat di halaman Tentang Kami) dengan mengirimkan ID Order, Email, dan Nama Folder yang diinginkan</p>', NULL, 1, 1, 'file/product/gq8VwMb0Obwi7V7Ozp2z-gdrive.webp', 0, 0, '2022-02-11 07:58:38', '2022-02-14 21:52:08'),
(18, 'TikTok Bot Automation', 'tiktok-bot-automation', 7, 71998, '<p>Bosen akun TikTok kamu gitu-gitu aja atau sepi? Kami memiliki script automasi mendapatkan TikTok interactions seperti followers, likes, share.</p>\r\n\r\n<p><strong>Fitur:</strong></p>\r\n\r\n<p>- Views bot<br />\r\n- Hearts bot<br />\r\n- Followers bot<br />\r\n- Shares bot<br />\r\n- Informasi log yang detail<br />\r\n- Bukan berbentuk&nbsp;<em>compiled program</em>&nbsp;melainkan hanya script dan tidak di&nbsp;<em>encrypt&nbsp;</em>atau <i>obfuscate</i>.&nbsp;</p>\r\n\r\n<p><strong>Apa yang kamu dapatkan:</strong></p>\r\n\r\n<p>- File scriptnya<br />\r\n- Instruksi cara penggunaan<br />\r\n- Bantuan jika kesulitan dalam penggunaan (tidak termasuk permintaan fitur)</p>\r\n\r\n<p><strong>Note:</strong></p>\r\n\r\n<p>- Kami hanya membuat automasi saja, fiturnya bisa atau tidak semua bergantung dengan website penyedia layanannya dan kami tidak memiliki kontrol untuk itu<br />\r\n- Hanya di tes di Windows 10 dan berjalan dengan lancar<br />\r\n- Bukan public script, murni buatan kami</p>', NULL, 1, 0, 'file/product/H1V20DydvYLftdgBqb3u-ttb.webp', 0, 0, '2022-02-11 07:59:37', '2022-02-14 21:59:05'),
(19, '1000 TikTok Followers Mixed', '1000-tiktok-followers-mixed', 7, 14999, '<p>Kepingin akun TikTok kamu banyak followersnya atau kepingin live tapi followers masih sedikit? Beli produk ini, kamu bisa langsung live loh.</p>\r\n\r\n<p><b>Note:</b></p>\r\n\r\n<p>- Proses bisa memakan waktu hingga 7 hari<br />\r\n- Mixed, berarti campuran dari akun aktif dan pasif (bisa drop)<br />\r\n- Kamu tidak boleh mengganti username atau set akun ke private pada saat proses<br />\r\n- Garansi untuk followers drop 250 pertama (silakan hubungi kami melalui WA)</p>', NULL, 1, 0, 'file/product/yUvzMznvyfOqZgIwU6og-tiktok.webp', 2, 0, '2022-02-11 08:00:37', '2022-07-23 19:55:08'),
(24, 'HBO GO Sharing 1 Bulan', 'hbo-go-sharing-1-bulan', 1, 25000, '<p><strong>Fitur:</strong></p>\r\n\r\n<p>- Kualitas FHD<br />\r\n- Legal<br />\r\n- Anti on-hold</p>\r\n\r\n<p><strong>Note:</strong></p>\r\n\r\n<p>Kami memberikan&nbsp;<strong>GARANSI 30 HARI&nbsp;</strong>dengan syarat tidak merubah data maupun informasi akun</p>', NULL, 1, 0, 'file/product/E4kojJt4b6PodWzv3dW7-hbogo.webp', 0, 0, '2022-02-14 22:11:49', '2022-02-17 11:55:32'),
(25, 'HBO Max 1 Bulan', 'hbo-max-1-bulan', 1, 14998, '<p>Dengan membeli produk ini, kamu akan mendapatkan akun untuk streaming HBO Max dengan durasi satu bulan.</p>\r\n\r\n<p><b>Note:</b></p>\r\n\r\n<p>- Private<br />\r\n- Untuk mengakses HBO Max ini, kamu membutuhkan VPN US. Kalau gak punya, kami juga sedia Nord VPN dengan harga murah</p>', NULL, 1, 0, 'file/product/BuxVxMt9e2wmPHaLBFGw-hbomax.webp', 0, 0, '2022-02-14 22:19:29', '2022-02-14 22:19:29'),
(26, 'IQIYI Premium 1 Bulan', 'iqiyi-premium-1-bulan', 1, 11999, '<p><strong>Fitur:</strong></p>\r\n\r\n<p>- 4 perangkat<br />\r\n- Bisa download dan ditonton secara offline<br />\r\n- Streaming dengan kualitas 1080p<br />\r\n- Tersedia subtitle Indonesia<br />\r\n- Legal</p>\r\n\r\n<p><strong>Note:</strong></p>\r\n\r\n<p>Kami memberikan&nbsp;<strong>GARANSI&nbsp;</strong><strong>30 HARI</strong></p>', NULL, 1, 0, 'file/product/ihNPTDSiT9A5FwaKtoCX-iqiyi.webp', 0, 0, '2022-02-14 22:59:42', '2022-02-14 22:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `max_use` int(11) NOT NULL,
  `used` int(11) NOT NULL DEFAULT 0,
  `expired_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`id`, `code`, `discount`, `max_use`, `used`, `expired_at`, `created_at`, `updated_at`) VALUES
(3, 'LYZ-BUV8Y', 10, 1, 2, '2022-02-26 01:39:00', '2022-02-24 18:59:02', '2022-02-25 03:34:15'),
(4, 'LYZ-BXKY1', 15, 1, 0, '2022-02-24 17:53:00', '2022-02-25 03:53:55', '2022-02-25 03:53:55'),
(5, 'LYZ-BRGV8', 5, 1, 0, '2022-02-26 10:57:00', '2022-02-25 20:06:45', '2022-02-25 20:55:37'),
(6, 'LYZ-PQOBH', 50, 1, 1, '2022-02-26 14:47:00', '2022-02-26 00:45:44', '2022-02-26 00:49:24'),
(7, 'LYZ-FVEXS', 1, 1, 0, '2022-02-26 16:56:00', '2022-02-26 00:56:19', '2022-02-26 00:56:19'),
(8, 'LYZ-SNRG1', 10, 1, 0, '2022-02-28 06:46:00', '2022-02-26 16:47:19', '2022-02-26 22:23:07'),
(9, 'LYZ-Z7Z83', 50, 0, 11, '2023-06-25 04:08:00', '2022-06-24 21:09:05', '2022-07-13 07:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `promo_code_log`
--

CREATE TABLE `promo_code_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 0,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkouts_user_id_foreign` (`user_id`),
  ADD KEY `checkouts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_code_log`
--
ALTER TABLE `promo_code_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `promo_code_log`
--
ALTER TABLE `promo_code_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
