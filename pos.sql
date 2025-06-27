-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2025 at 03:50 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundlings`
--

CREATE TABLE `bundlings` (
  `bd_id` int NOT NULL,
  `bd_name` varchar(255) NOT NULL COMMENT 'Name of the bundling package',
  `bd_img` text COMMENT 'Image of the bundling package',
  `bd_price` int NOT NULL COMMENT 'Price of the bundling package',
  `bd_desc` text COMMENT 'Description of the bundling package',
  `bd_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'JSON format of products included in the bundling package',
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bundlings`
--

INSERT INTO `bundlings` (`bd_id`, `bd_name`, `bd_img`, `bd_price`, `bd_desc`, `bd_products`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test2', NULL, 25000, 'test', '[4]', 0, '2025-06-20 23:55:02', '2025-06-21 00:00:49'),
(2, 'test2', 'upload/bundling/6856587d7d337.jpg', 250000, 'test 2231', '[4]', 1, '2025-06-21 00:00:13', '2025-06-21 00:22:17'),
(3, 'Buy 1 get 4', 'upload/bundling/6858e4e50511b.jpg', 250000, 'test', '[1,2,4,3]', 0, '2025-06-22 22:23:49', '2025-06-22 22:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int UNSIGNED NOT NULL,
  `category_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_img`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kopi & Minuman', 'coffee', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(2, 'Kemasan & Paket', 'package', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(3, 'Belanja Harian', 'shopping-bag', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(4, 'Peralatan Dapur', 'box', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(5, 'Diskon & Promo', 'tag', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(6, 'Minyak & Cairan', 'droplet', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(7, 'Produk Alami', 'feather', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(8, 'Hadiah & Paket', 'gift', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(9, 'Sayur & Organik', 'leaf', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48'),
(10, 'Kesehatan & Perawatan', 'heart', 1, '2025-06-21 12:00:48', '2025-06-21 12:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `category_staff`
--

CREATE TABLE `category_staff` (
  `cs_id` int NOT NULL,
  `cs_name` varchar(250) NOT NULL,
  `cs_hak_akses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_staff`
--

INSERT INTO `category_staff` (`cs_id`, `cs_name`, `cs_hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cashier2', NULL, 0, '2025-06-22 23:26:37', '2025-06-22 23:26:46'),
(2, 'test2', NULL, 1, '2025-06-22 23:27:03', '2025-06-22 23:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `state_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`, `status`) VALUES
(72720, 'MOROWALI UTARA', 72, 1),
(76760, 'MAMUJU TENGAH', 76, 1),
(92920, 'PEGUNUNGAN ARFAK', 92, 1),
(1111010, 'ACEH SELATAN', 11, 1),
(1111020, 'ACEH TENGGARA', 11, 1),
(1111030, 'ACEH TIMUR', 11, 1),
(1111040, 'ACEH TENGAH', 11, 1),
(1111050, 'ACEH BARAT', 11, 1),
(1111060, 'ACEH BESAR', 11, 1),
(1111070, 'PIDIE', 11, 1),
(1111080, 'ACEH UTARA', 11, 1),
(1111090, 'SIMEULUE', 11, 1),
(1111100, 'ACEH SINGKIL', 11, 1),
(1111110, 'BIREUEN', 11, 1),
(1111120, 'ACEH BARAT DAYA', 11, 1),
(1111130, 'GAYO LUES', 11, 1),
(1111140, 'ACEH JAYA', 11, 1),
(1111150, 'NAGAN RAYA', 11, 1),
(1111160, 'ACEH TAMIANG', 11, 1),
(1111170, 'BENER MERIAH', 11, 1),
(1111180, 'PIDIE JAYA', 11, 1),
(1111710, 'KOTA BANDA ACEH', 11, 1),
(1111720, 'KOTA SABANG', 11, 1),
(1111730, 'KOTA LHOKSEUMAWE', 11, 1),
(1111740, 'KOTA LANGSA', 11, 1),
(1111750, 'KOTA SUBULUSSALAM', 11, 1),
(1212010, 'TAPANULI TENGAH', 12, 1),
(1212020, 'TAPANULI UTARA', 12, 1),
(1212030, 'TAPANULI SELATAN', 12, 1),
(1212040, 'NIAS', 12, 1),
(1212050, 'LANGKAT', 12, 1),
(1212060, 'KARO', 12, 1),
(1212070, 'DELI SERDANG', 12, 1),
(1212080, 'SIMALUNGUN', 12, 1),
(1212090, 'ASAHAN', 12, 1),
(1212100, 'LABUHAN BATU', 12, 1),
(1212110, 'DAIRI', 12, 1),
(1212120, 'TOBA SAMOSIR', 12, 1),
(1212130, 'MANDAILING NATAL', 12, 1),
(1212140, 'NIAS SELATAN', 12, 1),
(1212150, 'PAKPAK BHARAT', 12, 1),
(1212160, 'HUMBANG HASUNDUTAN', 12, 1),
(1212170, 'SAMOSIR', 12, 1),
(1212180, 'SERDANG BADAGAI', 12, 1),
(1212190, 'BATUBARA', 12, 1),
(1212200, 'PADANG LAWAS UTARA', 12, 1),
(1212210, 'PADANG LAWAS', 12, 1),
(1212220, 'LABUHANBATU SELATAN', 12, 1),
(1212230, 'LABUHANBATU UTARA', 12, 1),
(1212240, 'NIAS UTARA', 12, 1),
(1212250, 'NIAS BARAT', 12, 1),
(1212710, 'KOTA MEDAN', 12, 1),
(1212720, 'KOTA PEMATANG SIANTAR', 12, 1),
(1212730, 'KOTA SIBOLGA', 12, 1),
(1212740, 'KOTA TANJUNG BALAI', 12, 1),
(1212750, 'KOTA BINJAI', 12, 1),
(1212760, 'KOTA TEBING TINGGI', 12, 1),
(1212770, 'KOTA PADANG SIDEMPUAN', 12, 1),
(1212780, 'KOTA GUNUNG SITOLI', 12, 1),
(1313010, 'PESISIR SELATAN', 13, 1),
(1313020, 'SOLOK', 13, 1),
(1313030, 'SIJUNJUNG', 13, 1),
(1313040, 'TANAH DATAR', 13, 1),
(1313050, 'PADANG PARIAMAN', 13, 1),
(1313060, 'AGAM', 13, 1),
(1313070, 'LIMA PULUH KOTA', 13, 1),
(1313080, 'PASAMAN', 13, 1),
(1313090, 'KEPULAUAN MENTAWAI', 13, 1),
(1313100, 'DHARMASRAYA', 13, 1),
(1313110, 'SOLOK SELATAN', 13, 1),
(1313120, 'PASAMAN BARAT', 13, 1),
(1313710, 'KOTA PADANG', 13, 1),
(1313720, 'KOTA SOLOK', 13, 1),
(1313730, 'KOTA SAWAH LUNTO', 13, 1),
(1313740, 'KOTA PADANG PANJANG', 13, 1),
(1313750, 'KOTA BUKIT TINGGI', 13, 1),
(1313760, 'KOTA PAYAHKUMBUH', 13, 1),
(1313770, 'KOTA PARIAMAN', 13, 1),
(1414010, 'KAMPAR', 14, 1),
(1414020, 'INDRAGIRI HULU', 14, 1),
(1414030, 'BENGKALIS', 14, 1),
(1414040, 'INDRAGIRI HILIR', 14, 1),
(1414050, 'PELALAWAN', 14, 1),
(1414060, 'ROKAN HULU', 14, 1),
(1414070, 'ROKAN HILIR', 14, 1),
(1414080, 'SIAK', 14, 1),
(1414090, 'KUANTAN SENGINGI', 14, 1),
(1414100, 'KEPULAUAN MERANTI', 14, 1),
(1414710, 'KOTA PEKAN BARU', 14, 1),
(1414720, 'KOTA DUMAI', 14, 1),
(1515010, 'KERINCI', 15, 1),
(1515020, 'MERANGIN', 15, 1),
(1515030, 'SOROLANGUN', 15, 1),
(1515040, 'BATANG HARI', 15, 1),
(1515050, 'MUARO JAMBI', 15, 1),
(1515060, 'TANJUNG JABUNG BARAT', 15, 1),
(1515070, 'TANJUNG JABUNG TIMUR', 15, 1),
(1515080, 'BUNGO', 15, 1),
(1515090, 'TEBO', 15, 1),
(1515710, 'KOTA JAMBI', 15, 1),
(1515720, 'KOTA SUNGAI PENUH', 15, 1),
(1616000, 'Penukal Abab Lematang Ilir', 16, 1),
(1616010, 'OGAN KOMERING ULU', 16, 1),
(1616020, 'OGAN KOMERING ILIR', 16, 1),
(1616030, 'MUARA ENIM', 16, 1),
(1616040, 'LAHAT', 16, 1),
(1616050, 'MUSI RAWAS', 16, 1),
(1616060, 'MUSI BANYUASIN', 16, 1),
(1616070, 'BANYUASIN', 16, 1),
(1616080, 'OGAN KOMERING ULU TIMUR', 16, 1),
(1616090, 'OGAN KOMERING ULU SELATAN', 16, 1),
(1616100, 'OGAN ILIR', 16, 1),
(1616110, 'EMPAT LAWANG', 16, 1),
(1616710, 'KOTA PALEMBANG', 16, 1),
(1616740, 'KOTA PAGAR ALAM', 16, 1),
(1616770, 'KOTA LUBUK LINGGAU', 16, 1),
(1616800, 'KOTA PRABUMULIH', 16, 1),
(1717010, 'BENGKULU SELATAN', 17, 1),
(1717020, 'REJANG LEBONG', 17, 1),
(1717030, 'BENGKULU UTARA', 17, 1),
(1717040, 'KAUR', 17, 1),
(1717050, 'SELUMA', 17, 1),
(1717060, 'MUKO-MUKO', 17, 1),
(1717070, 'LEBONG', 17, 1),
(1717080, 'KEPAHIANG', 17, 1),
(1717090, 'BENGKULU TENGAH', 17, 1),
(1717710, 'KOTA BENGKULU', 17, 1),
(1818000, 'PESISIR BARAT', 18, 1),
(1818010, 'LAMPUNG SELATAN', 18, 1),
(1818020, 'LAMPUNG TENGAH', 18, 1),
(1818030, 'LAMPUNG UTARA', 18, 1),
(1818040, 'LAMPUNG BARAT', 18, 1),
(1818050, 'TULANG BAWANG', 18, 1),
(1818060, 'TENGGAMUS', 18, 1),
(1818070, 'LAMPUNG TIMUR', 18, 1),
(1818080, 'WAY KANAN', 18, 1),
(1818090, 'PESAWARAN', 18, 1),
(1818100, 'PRINGSEWU', 18, 1),
(1818110, 'MESUJI', 18, 1),
(1818120, 'TULANG BAWANG BARAT', 18, 1),
(1818710, 'KOTA BANDAR LAMPUNG', 18, 1),
(1818720, 'KOTA METRO', 18, 1),
(1919010, 'BANGKA', 19, 1),
(1919020, 'BELITUNG', 19, 1),
(1919030, 'BANGKA SELATAN', 19, 1),
(1919040, 'BANGKA TENGAH', 19, 1),
(1919050, 'BANGKA BARAT', 19, 1),
(1919060, 'BELITUNG TIMUR', 19, 1),
(1919710, 'KOTA PANGKAL PINANG', 19, 1),
(2121010, 'BINTAN', 21, 1),
(2121020, 'KARIMUN', 21, 1),
(2121030, 'NATUNA', 21, 1),
(2121040, 'LINGGA', 21, 1),
(2121050, 'KEPULAUAN ANAMBAS', 21, 1),
(2121710, 'KOTA BATAM', 21, 1),
(2121720, 'KOTA TANJUNG PINANG', 21, 1),
(3131010, 'KAB.ADM. KEPULAUAN SERIBU', 31, 1),
(3131710, 'KOTA ADM. JAKARTA PUSAT', 31, 1),
(3131720, 'KOTA ADM. JAKARTA UTARA', 31, 1),
(3131730, 'KOTA ADM. JAKARTA BARAT', 31, 1),
(3131740, 'KOTA ADM. JAKARTA SELATAN', 31, 1),
(3131750, 'KOTA ADM. JAKARTA TIMUR', 31, 1),
(3232000, 'PANGANDARAN', 32, 1),
(3232010, 'BOGOR', 32, 1),
(3232020, 'SUKABUMI', 32, 1),
(3232030, 'CIANJUR', 32, 1),
(3232040, 'BANDUNG', 32, 1),
(3232050, 'GARUT', 32, 1),
(3232060, 'TASIKMALAYA', 32, 1),
(3232070, 'CIAMIS', 32, 1),
(3232080, 'KUNINGAN', 32, 1),
(3232090, 'CIREBON', 32, 1),
(3232100, 'MAJALENGKA', 32, 1),
(3232110, 'SUMEDANG', 32, 1),
(3232120, 'INDRAMAYU', 32, 1),
(3232130, 'SUBANG', 32, 1),
(3232140, 'PURWAKARTA', 32, 1),
(3232150, 'KARAWANG', 32, 1),
(3232160, 'BEKASI', 32, 1),
(3232170, 'BANDUNG BARAT', 32, 1),
(3232710, 'KOTA BOGOR', 32, 1),
(3232720, 'KOTA SUKABUMI', 32, 1),
(3232730, 'KOTA BANDUNG', 32, 1),
(3232740, 'KOTA CIREBON', 32, 1),
(3232750, 'KOTA BEKASI', 32, 1),
(3232760, 'KOTA DEPOK', 32, 1),
(3232770, 'KOTA CIMAHI', 32, 1),
(3232780, 'KOTA TASIKMALAYA', 32, 1),
(3232790, 'KOTA BANJAR', 32, 1),
(3333010, 'CILACAP', 33, 1),
(3333020, 'BANYUMAS', 33, 1),
(3333030, 'PURBALINGGA', 33, 1),
(3333040, 'BANJARNEGARA', 33, 1),
(3333050, 'KEBUMEN', 33, 1),
(3333060, 'PURWOREJO', 33, 1),
(3333070, 'WONOSOBO', 33, 1),
(3333080, 'MAGELANG', 33, 1),
(3333090, 'BOYOLALI', 33, 1),
(3333100, 'KLATEN', 33, 1),
(3333110, 'SUKOHARJO', 33, 1),
(3333120, 'WONOGIRI', 33, 1),
(3333130, 'KARANGANYAR', 33, 1),
(3333140, 'SRAGEN', 33, 1),
(3333150, 'GROBOGAN', 33, 1),
(3333160, 'BLORA', 33, 1),
(3333170, 'REMBANG', 33, 1),
(3333180, 'PATI', 33, 1),
(3333190, 'KUDUS', 33, 1),
(3333200, 'JEPARA', 33, 1),
(3333210, 'DEMAK', 33, 1),
(3333220, 'SEMARANG', 33, 1),
(3333230, 'TEMANGGUNG', 33, 1),
(3333240, 'KENDAL', 33, 1),
(3333250, 'BATANG', 33, 1),
(3333260, 'PEKALONGAN', 33, 1),
(3333270, 'PEMALANG', 33, 1),
(3333280, 'TEGAL', 33, 1),
(3333290, 'BREBES', 33, 1),
(3333710, 'KOTA MAGELANG', 33, 1),
(3333720, 'KOTA SURAKARTA', 33, 1),
(3333730, 'KOTA SALATIGA', 33, 1),
(3333740, 'KOTA SEMARANG', 33, 1),
(3333750, 'KOTA PEKALONGAN', 33, 1),
(3333760, 'KOTA TEGAL', 33, 1),
(3434010, 'KULON PROGO', 34, 1),
(3434020, 'BANTUL', 34, 1),
(3434030, 'GUNUNG KIDUL', 34, 1),
(3434040, 'SLEMAN', 34, 1),
(3434710, 'KOTA YOGYAKARTA', 34, 1),
(3535010, 'PACITAN', 35, 1),
(3535020, 'PONOROGO', 35, 1),
(3535030, 'TRENGGALEK', 35, 1),
(3535040, 'TULUNGAGUNG', 35, 1),
(3535050, 'BLITAR', 35, 1),
(3535060, 'KEDIRI', 35, 1),
(3535070, 'MALANG', 35, 1),
(3535080, 'LUMAJANG', 35, 1),
(3535090, 'JEMBER', 35, 1),
(3535100, 'BANYUWANGI', 35, 1),
(3535110, 'BONDOWOSO', 35, 1),
(3535120, 'SITUBONDO', 35, 1),
(3535130, 'PROBOLINGGO', 35, 1),
(3535140, 'PASURUAN', 35, 1),
(3535150, 'SIDOARJO', 35, 1),
(3535160, 'MOJOKERTO', 35, 1),
(3535170, 'JOMBANG', 35, 1),
(3535180, 'NGANJUK', 35, 1),
(3535190, 'MADIUN', 35, 1),
(3535200, 'MAGETAN', 35, 1),
(3535210, 'NGAWI', 35, 1),
(3535220, 'BOJONEGORO', 35, 1),
(3535230, 'TUBAN', 35, 1),
(3535240, 'LAMONGAN', 35, 1),
(3535250, 'GRESIK', 35, 1),
(3535260, 'BANGKALAN', 35, 1),
(3535270, 'SAMPANG', 35, 1),
(3535280, 'PAMEKASAN', 35, 1),
(3535290, 'SUMENEP', 35, 1),
(3535710, 'KOTA KEDIRI', 35, 1),
(3535720, 'KOTA BLITAR', 35, 1),
(3535730, 'KOTA MALANG', 35, 1),
(3535740, 'KOTA PROBOLINGGO', 35, 1),
(3535750, 'KOTA PASURUAN', 35, 1),
(3535760, 'KOTA MOJOKERTO', 35, 1),
(3535770, 'KOTA MADIUN', 35, 1),
(3535780, 'KOTA SURABAYA', 35, 1),
(3535790, 'KOTA BATU', 35, 1),
(3636010, 'PANDEGLANG', 36, 1),
(3636020, 'LEBAK', 36, 1),
(3636030, 'TANGERANG', 36, 1),
(3636040, 'SERANG', 36, 1),
(3636710, 'KOTA TANGERANG', 36, 1),
(3636720, 'KOTA CILEGON', 36, 1),
(3636730, 'KOTA SERANG', 36, 1),
(3636740, 'KOTA TANGERANG SELATAN', 36, 1),
(5151010, 'JEMBRANA', 51, 1),
(5151020, 'TABANAN', 51, 1),
(5151030, 'BADUNG', 51, 1),
(5151040, 'GIANYAR', 51, 1),
(5151050, 'KLUNGKUNG', 51, 1),
(5151060, 'BANGLI', 51, 1),
(5151070, 'KARANGASEM', 51, 1),
(5151080, 'BULELENG', 51, 1),
(5151710, 'KOTA DENPASAR', 51, 1),
(5252010, 'LOMBOK BARAT', 52, 1),
(5252020, 'LOMBOK TENGAH', 52, 1),
(5252030, 'LOMBOK TIMUR', 52, 1),
(5252040, 'SUMBAWA', 52, 1),
(5252050, 'DOMPU', 52, 1),
(5252060, 'BIMA', 52, 1),
(5252070, 'SUMBAWA BARAT', 52, 1),
(5252080, 'LOMBOK UTARA', 52, 1),
(5252710, 'KOTA MATARAM', 52, 1),
(5252720, 'KOTA BIMA', 52, 1),
(5353000, 'MALAKA', 53, 1),
(5353010, 'KUPANG', 53, 1),
(5353020, 'TIMOR TENGAH SELATAN', 53, 1),
(5353030, 'TIMUR TENGAH UTARA', 53, 1),
(5353040, 'BELU', 53, 1),
(5353050, 'ALOR', 53, 1),
(5353060, 'FLORES TIMUR', 53, 1),
(5353070, 'SIKKA', 53, 1),
(5353080, 'ENDE', 53, 1),
(5353090, 'NGADA', 53, 1),
(5353100, 'MANGARAI', 53, 1),
(5353110, 'SUMBA TIMUR', 53, 1),
(5353120, 'SUMBA BARAT', 53, 1),
(5353130, 'LEMBATA', 53, 1),
(5353140, 'ROTE NDAO', 53, 1),
(5353150, 'MANGGARAI BARAT', 53, 1),
(5353160, 'NAGEKEO', 53, 1),
(5353170, 'SUMBA TENGAH', 53, 1),
(5353180, 'SUMBA BARAT DAYA', 53, 1),
(5353190, 'MANGGARAI TIMUR', 53, 1),
(5353200, 'SABU RAIJUA', 53, 1),
(5353710, 'KOTA KUPANG', 53, 1),
(6161010, 'SAMBAS', 61, 1),
(6161020, 'PONTIANAK', 61, 1),
(6161030, 'SANGAU', 61, 1),
(6161040, 'KETAPANG', 61, 1),
(6161050, 'SINTANG', 61, 1),
(6161060, 'KAPUAS HULU', 61, 1),
(6161070, 'BENGKAYANG', 61, 1),
(6161080, 'LANDAK', 61, 1),
(6161090, 'SEKADAU', 61, 1),
(6161100, 'MELAWI', 61, 1),
(6161110, 'KAYONG UTARA', 61, 1),
(6161120, 'KUBU RAYA', 61, 1),
(6161710, 'KOTA PONTIANAK', 61, 1),
(6161720, 'KOTA SINGKAWANG', 61, 1),
(6262010, 'KOTAWARINGIN BARAT', 62, 1),
(6262020, 'KOTAWARINGIN TIMUR', 62, 1),
(6262030, 'KAPUAS', 62, 1),
(6262040, 'BARITO SELATAN', 62, 1),
(6262050, 'BARITO UTARA', 62, 1),
(6262060, 'KATINGAN', 62, 1),
(6262070, 'SERUYAN', 62, 1),
(6262080, 'SUKAMARA', 62, 1),
(6262090, 'LAMANDAU', 62, 1),
(6262100, 'GUNUNG MAS', 62, 1),
(6262110, 'PULANG PISAU', 62, 1),
(6262120, 'MURUNG RAYA', 62, 1),
(6262130, 'BARITO TIMUR', 62, 1),
(6262710, 'KOTA PALANGKA RAYA', 62, 1),
(6363010, 'TANAH LAUT', 63, 1),
(6363020, 'KOTABARU', 63, 1),
(6363030, 'BANJAR', 63, 1),
(6363040, 'BARITO KUALA', 63, 1),
(6363050, 'TAPIN', 63, 1),
(6363060, 'HULU SUNGAI SELATAN', 63, 1),
(6363070, 'HULU SUNGAI TENGAH', 63, 1),
(6363080, 'HULU SUNGAI UTARA', 63, 1),
(6363090, 'TABALONG', 63, 1),
(6363100, 'TANAH BUMBU', 63, 1),
(6363110, 'BALANGAN', 63, 1),
(6363710, 'KOTA BANJARMASIN', 63, 1),
(6363720, 'KOTA BANJARBARU', 63, 1),
(6464000, 'MAHAKAM ULU', 64, 1),
(6464010, 'PASER', 64, 1),
(6464020, 'KUTAI KARTANEGARA', 64, 1),
(6464030, 'BERAU', 64, 1),
(6464040, 'BULUNGAN', 64, 1),
(6464050, 'NUNUKAN', 64, 1),
(6464060, 'MALINAU', 64, 1),
(6464070, 'KUTAI BARAT', 64, 1),
(6464080, 'KUTAI TIMUR', 64, 1),
(6464090, 'PENAJAM PASER UTAMA', 64, 1),
(6464100, 'TANA TIDUNG', 64, 1),
(6464710, 'KOTA BALIKPAPAN', 64, 1),
(6464720, 'KOTA SAMARINDA', 64, 1),
(6464730, 'KOTA TARAKAN', 64, 1),
(6464740, 'KOTA BONTANG', 64, 1),
(7171010, 'BOLAANG MONGONDOW', 71, 1),
(7171020, 'MINAHASA', 71, 1),
(7171030, 'KEPULAUAN SANGIHE', 71, 1),
(7171040, 'KEPULAUAN TALAUD', 71, 1),
(7171050, 'MINAHASA SELATAN', 71, 1),
(7171060, 'MINAHASA UTARA', 71, 1),
(7171070, 'MINAHASA TENGGARA', 71, 1),
(7171080, 'BOLAANG MONGONDOW UTARA', 71, 1),
(7171090, 'KEPULAUAN SIAU TAGULANDANG BIA', 71, 1),
(7171100, 'BOLAANG MONGONDOW TIMUR', 71, 1),
(7171110, 'BOLAANG MONGONDOW SELATAN', 71, 1),
(7171710, 'KOTA MANADO', 71, 1),
(7171720, 'KOTA BITUNG', 71, 1),
(7171730, 'KOTA TOMOHON', 71, 1),
(7171740, 'KOTA KOTAMOBAGU', 71, 1),
(7272000, 'BANGGAI LAUT', 72, 1),
(7272010, 'BANGGAI', 72, 1),
(7272020, 'POSO', 72, 1),
(7272030, 'DONGGALA', 72, 1),
(7272040, 'TOLI-TOLI', 72, 1),
(7272050, 'BUOL', 72, 1),
(7272060, 'MOROWALI', 72, 1),
(7272070, 'BANGGAI KEPULAUAN', 72, 1),
(7272080, 'PARIGI MOUTONG', 72, 1),
(7272090, 'TOJO UNA-UNA', 72, 1),
(7272100, 'SIGI', 72, 1),
(7272710, 'KOTA PALU', 72, 1),
(7373010, 'SELAYAR', 73, 1),
(7373020, 'BULUKUMBA', 73, 1),
(7373030, 'BANTAENG', 73, 1),
(7373040, 'JENEPONTO', 73, 1),
(7373050, 'TAKALAR', 73, 1),
(7373060, 'GOWA', 73, 1),
(7373070, 'SINJAI', 73, 1),
(7373080, 'BONE', 73, 1),
(7373090, 'MAROS', 73, 1),
(7373100, 'PANGKAJENE KEPULAUAN', 73, 1),
(7373110, 'BARRU', 73, 1),
(7373120, 'SOPPENG', 73, 1),
(7373130, 'WAJO', 73, 1),
(7373140, 'SIDENRENG RAPANG', 73, 1),
(7373150, 'PINRANG', 73, 1),
(7373160, 'ENREKANG', 73, 1),
(7373170, 'LUWU', 73, 1),
(7373180, 'TANA TORAJAH', 73, 1),
(7373220, 'LUWU UTARA', 73, 1),
(7373240, 'LUWU TIMUR', 73, 1),
(7373260, 'TORAJA UTARA', 73, 1),
(7373710, 'KOTA MAKASSAR', 73, 1),
(7373720, 'KOTA PARE-PARE', 73, 1),
(7373730, 'KOTA PALOPO', 73, 1),
(7474000, 'KOLAKA TIMUR', 74, 1),
(7474010, 'KOLAKA', 74, 1),
(7474020, 'KONAWE', 74, 1),
(7474030, 'MUNA', 74, 1),
(7474040, 'BUTON', 74, 1),
(7474050, 'KONAWE SELATAN', 74, 1),
(7474060, 'BOMBANA', 74, 1),
(7474070, 'WAKATOBI', 74, 1),
(7474080, 'KOLAKA UTARA', 74, 1),
(7474090, 'KONAWE UTARA', 74, 1),
(7474100, 'BUTON UTARA', 74, 1),
(7474710, 'KOTA KENDARI', 74, 1),
(7474720, 'KOTA BAU-BAU', 74, 1),
(7575010, 'GORONTALO', 75, 1),
(7575020, 'BOALEMO', 75, 1),
(7575030, 'BONE BOLANGO', 75, 1),
(7575040, 'POHUWATO', 75, 1),
(7575050, 'GORONTALO UTARA', 75, 1),
(7575710, 'KOTA GORONTALO', 75, 1),
(7676010, 'MAMUJU UTARA', 76, 1),
(7676020, 'MAMUJU', 76, 1),
(7676030, 'MAMASA', 76, 1),
(7676040, 'POLEWARI MANDAR', 76, 1),
(7676050, 'MAJENE', 76, 1),
(8181010, 'MALUKU TENGAH', 81, 1),
(8181020, 'MALUKU TENGGARA', 81, 1),
(8181030, 'MALUKU TENGGARA BARAT', 81, 1),
(8181040, 'BURU', 81, 1),
(8181050, 'SERAM BAGIAN TIMUR', 81, 1),
(8181060, 'SERAM BAGIAN BARAT', 81, 1),
(8181070, 'KEPULAUAN ARU', 81, 1),
(8181080, 'MALUKU BARAT DAYA', 81, 1),
(8181090, 'BURU SELATAN', 81, 1),
(8181710, 'KOTA AMBON', 81, 1),
(8181720, 'KOTA TUAL', 81, 1),
(8282000, 'TALIABU', 82, 1),
(8282010, 'HALMAHERA BARAT', 82, 1),
(8282020, 'HALMAHERA TENGAH', 82, 1),
(8282030, 'HALMAHERA UTARA', 82, 1),
(8282040, 'HALMAHERA SELATAN', 82, 1),
(8282050, 'KEPULAUAN SULA', 82, 1),
(8282060, 'HALMAHERA TIMUR', 82, 1),
(8282070, 'PULAU MOROTAI', 82, 1),
(8282710, 'KOTA TERNATE', 82, 1),
(8282720, 'KOTA TIDORE KEPULAUAN', 82, 1),
(9191010, 'MERAUKE', 91, 1),
(9191020, 'JAYAWIJAYA', 91, 1),
(9191030, 'JAYAPURA', 91, 1),
(9191040, 'NABIRE', 91, 1),
(9191050, 'YAPEN WAROPEN', 91, 1),
(9191060, 'BIAK NUMFOR', 91, 1),
(9191070, 'PUNCAK JAYA', 91, 1),
(9191080, 'PANIAI', 91, 1),
(9191090, 'MIMIKA', 91, 1),
(9191100, 'SARMI', 91, 1),
(9191110, 'KEEROM', 91, 1),
(9191120, 'PEGUNUNGAN BINTANG', 91, 1),
(9191130, 'YAHUKIMO', 91, 1),
(9191140, 'TOLIKARA', 91, 1),
(9191150, 'WAROPEN', 91, 1),
(9191160, 'BOVEN DIGOEL', 91, 1),
(9191170, 'MAPPI', 91, 1),
(9191180, 'ASMAT', 91, 1),
(9191190, 'SUPIORI', 91, 1),
(9191200, 'MAMBERAMO RAYA', 91, 1),
(9191210, 'MAMBERAMO TENGAH', 91, 1),
(9191220, 'YALIMO', 91, 1),
(9191230, 'LANNY JAYA', 91, 1),
(9191240, 'NDUGA', 91, 1),
(9191250, 'PUNCAK', 91, 1),
(9191260, 'DOGIYAI', 91, 1),
(9191270, 'INTAN JAYA', 91, 1),
(9191280, 'DEIYAI', 91, 1),
(9191710, 'KOTA JAYAPURA', 91, 1),
(9292000, 'MANOKWARI SELATAN', 92, 1),
(9292010, 'SORONG', 92, 1),
(9292020, 'MANOKWARI', 92, 1),
(9292030, 'FAK-FAK', 92, 1),
(9292040, 'SORONG SELATAN', 92, 1),
(9292050, 'RAJA AMPAT', 92, 1),
(9292060, 'TELUK BENTUNI', 92, 1),
(9292070, 'TELUK WONDAMA', 92, 1),
(9292080, 'KAIMANA', 92, 1),
(9292090, 'TAMBRAUW', 92, 1),
(9292100, 'MAYBRAT', 92, 1),
(9292710, 'KOTA SORONG', 92, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int NOT NULL,
  `cus_code` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cus_name` varchar(250) DEFAULT NULL,
  `cus_nomer` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cus_address` varchar(250) DEFAULT NULL,
  `cus_gender` varchar(250) DEFAULT NULL,
  `cus_dob` date DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `cus_total_spent` int DEFAULT '0',
  `cus_total_piutang` int DEFAULT '0',
  `cus_notes` text,
  `cus_img` text,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_code`, `cus_name`, `cus_nomer`, `cus_address`, `cus_gender`, `cus_dob`, `city_id`, `cus_total_spent`, `cus_total_piutang`, `cus_notes`, `cus_img`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CSO0001', 'test', '312312321', 'jl wonorejo', 'Female', '2025-06-26', 3535780, 0, 0, 'test', 'upload/customer/68505c48c478f.png', 1, '2025-06-16 11:02:48', '2025-06-16 11:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_stocks`
--

CREATE TABLE `manage_stocks` (
  `ms_id` int NOT NULL,
  `ms_type` int NOT NULL,
  `pr_id` int DEFAULT NULL COMMENT 'Product ID',
  `sup_id` int DEFAULT NULL COMMENT 'Supplies ID',
  `ms_stock` int DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manage_stocks`
--

INSERT INTO `manage_stocks` (`ms_id`, `ms_type`, `pr_id`, `sup_id`, `ms_stock`, `status`, `created_at`, `updated_at`) VALUES
(11, 1, NULL, 2, 128, 1, '2025-06-20 09:22:54', '2025-06-20 09:50:18'),
(12, 2, NULL, 2, 16, 1, '2025-06-20 09:46:47', '2025-06-20 09:49:27'),
(13, 1, NULL, 1, 82, 1, '2025-06-22 22:25:11', '2025-06-22 22:29:06'),
(14, 2, NULL, 1, 36, 1, '2025-06-22 22:25:53', '2025-06-22 22:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_13_155950_create_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturans`
--

CREATE TABLE `pengaturans` (
  `pengaturan_id` int UNSIGNED NOT NULL,
  `pengaturan_nama` varchar(255) NOT NULL,
  `pengaturan_value` longtext NOT NULL,
  `pegaturan_link` varchar(255) DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaturans`
--

INSERT INTO `pengaturans` (`pengaturan_id`, `pengaturan_nama`, `pengaturan_value`, `pegaturan_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'PT. Tabukan Panara', NULL, 1, NULL, NULL),
(2, 'company_nomor', '+2162135443', NULL, 1, NULL, NULL),
(3, 'company_address', 'Jl. Megabooth Permai No 35A', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pr_id` int NOT NULL,
  `pr_name` varchar(250) DEFAULT NULL,
  `pr_sku` text,
  `pr_barcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pr_deskripsi` text,
  `pr_stock` int DEFAULT '0',
  `pr_price` int DEFAULT '0',
  `pr_berat` int DEFAULT NULL,
  `pr_exp` date DEFAULT NULL,
  `pr_alert_stok` int DEFAULT NULL,
  `c_id` int DEFAULT NULL,
  `pu_id` int NOT NULL,
  `pr_img` text,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pr_id`, `pr_name`, `pr_sku`, `pr_barcode`, `pr_deskripsi`, `pr_stock`, `pr_price`, `pr_berat`, `pr_exp`, `pr_alert_stok`, `c_id`, `pu_id`, `pr_img`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kopi Arabika Gayo', 'SKU-001', '8886008101091', 'Kopi spesialti dari Aceh Gayo, 100% arabika.', 100, 60000, 250, '2025-12-31', 10, 1, 1, 'upload/product/6856a9758c011.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:45:41'),
(2, 'Teh Hijau Jepang', 'SKU-002', 'PR002', 'Matcha teh hijau bubuk khas Jepang, kaya antioksidan.', 80, 75000, 100, NULL, 5, 1, 2, 'upload/product/6856a98080371.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:45:52'),
(3, 'Gula Aren Cair', 'SKU-003', 'PR003', 'Gula aren murni dari petani lokal.', 150, 35000, 500, NULL, 10, 1, 1, 'upload/product/6856a98bc0731.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:46:03'),
(4, 'Minyak Kelapa Murni', 'SKU-004', 'PR004', 'Virgin coconut oil organik, multifungsi.', 60, 90000, 1000, NULL, 3, 2, 2, 'upload/product/6856a996b543e.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:46:14'),
(5, 'Madu Hutan Asli', 'SKU-005', 'PR005', 'Madu hutan liar tanpa campuran, kaya manfaat.', 70, 85000, 250, NULL, 5, 1, 2, 'upload/product/6856a9c7e53a2.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:47:03'),
(6, 'Sabun Herbal Daun Sirih', 'SKU-006', 'PR006', 'Sabun alami antiseptik dari daun sirih segar.', 120, 15000, 100, NULL, 15, 2, 3, 'upload/product/6856a9dadb181.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:47:22'),
(7, 'Minuman Serbuk Jahe', 'SKU-007', 'PR007', 'Minuman instan jahe merah untuk daya tahan tubuh.', 90, 22000, 120, NULL, 7, 1, 2, 'https://source.unsplash.com/400x300/?ginger-tea', 1, '2025-06-21 11:55:41', '2025-06-21 11:55:41'),
(8, 'Keripik Tempe', 'SKU-008', 'PR008', 'Camilan renyah, gurih, dan tinggi protein.', 200, 18000, 80, NULL, 20, 1, 3, 'upload/product/6856aa0297545.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:48:02'),
(9, 'Sambal Bawang Pedas', 'SKU-009', 'PR009', 'Sambal homemade pedas, cocok untuk semua makanan.', 130, 25000, 150, NULL, 12, 2, 2, 'upload/product/6856aa0c7fb91.jpg', 1, '2025-06-21 11:55:41', '2025-06-21 05:48:12'),
(10, 'Minyak Kayu Putih', 'SKU-010', 'PR010', 'Minyak kayu putih alami untuk pijat dan aroma terapi.', 110, 30000, 100, NULL, 8, 2, 3, 'https://source.unsplash.com/400x300/?eucalyptus-oil', 1, '2025-06-21 11:55:41', '2025-06-21 11:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `pp_id` int NOT NULL,
  `pr_id` int NOT NULL,
  `pp_from` int NOT NULL,
  `pp_to` int NOT NULL,
  `pp_price` int NOT NULL,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`pp_id`, `pr_id`, `pp_from`, `pp_to`, `pp_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, 51000, 0, '2025-06-21 11:56:04', '2025-06-22 00:54:42'),
(2, 1, 11, 100, 49000, 0, '2025-06-21 11:56:04', '2025-06-22 00:54:42'),
(3, 2, 1, 10, 52000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(4, 2, 11, 100, 50000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(5, 3, 1, 10, 53000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(6, 3, 11, 100, 51000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(7, 4, 1, 10, 54000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(8, 4, 11, 100, 52000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(9, 5, 1, 10, 55000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(10, 5, 11, 100, 53000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(11, 6, 1, 10, 56000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(12, 6, 11, 100, 54000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(13, 7, 1, 10, 57000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(14, 7, 11, 100, 55000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(15, 8, 1, 10, 58000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(16, 8, 11, 100, 56000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(17, 9, 1, 10, 59000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(18, 9, 11, 100, 57000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(19, 10, 1, 10, 60000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(20, 10, 11, 100, 58000, 1, '2025-06-21 11:56:04', '2025-06-21 05:48:18'),
(21, 1, 1, 10, 51000, 0, '2025-06-21 05:45:41', '2025-06-22 00:54:42'),
(22, 1, 11, 100, 49000, 0, '2025-06-21 05:45:41', '2025-06-22 00:54:42'),
(23, 1, 1, 10, 51000, 0, '2025-06-22 00:35:58', '2025-06-22 00:54:42'),
(24, 1, 11, 100, 49000, 0, '2025-06-22 00:35:58', '2025-06-22 00:54:42'),
(25, 1, 1, 10, 51000, 0, '2025-06-22 00:35:58', '2025-06-22 00:54:42'),
(26, 1, 11, 100, 49000, 0, '2025-06-22 00:35:58', '2025-06-22 00:54:42'),
(27, 1, 1, 10, 51000, 1, '2025-06-22 00:54:42', '2025-06-22 00:54:42'),
(28, 1, 11, 100, 49000, 1, '2025-06-22 00:54:42', '2025-06-22 00:54:42'),
(29, 1, 1, 10, 51000, 1, '2025-06-22 00:54:42', '2025-06-22 00:54:42'),
(30, 1, 11, 100, 49000, 1, '2025-06-22 00:54:42', '2025-06-22 00:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_units`
--

CREATE TABLE `product_units` (
  `pu_id` int UNSIGNED NOT NULL,
  `pu_full_name` varchar(250) NOT NULL,
  `pu_short_name` varchar(250) NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_units`
--

INSERT INTO `product_units` (`pu_id`, `pu_full_name`, `pu_short_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gram', 'gr', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(2, 'Kilogram', 'kg', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(3, 'Mililiter', 'ml', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(4, 'Liter', 'L', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(5, 'Pcs', 'pcs', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(6, 'Pack', 'pack', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(7, 'Botol', 'bt', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(8, 'Sachet', 'sc', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(9, 'Box', 'box', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26'),
(10, 'Kaleng', 'klg', 1, '2025-06-21 11:58:26', '2025-06-21 11:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `pv_id` int UNSIGNED NOT NULL,
  `pv_name` varchar(250) NOT NULL,
  `pv_attribute` varchar(250) NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`pv_id`, `pv_name`, `pv_attribute`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ukuran', '[\"250 ml\",\"450 ml\"]', 1, '2025-06-21 11:56:14', '2025-06-21 11:56:14'),
(2, 'Rasa', '[\"Original\",\"Mint\",\"Jasmine\"]', 1, '2025-06-21 11:56:14', '2025-06-21 11:56:14'),
(3, 'Jenis', '[\"Cair\",\"Kental\",\"Semi kental\"]', 1, '2025-06-21 11:56:14', '2025-06-21 11:56:14'),
(4, 'Kemasan', '[\"Botol\",\"Kaleng\",\"Box\",\"Mika\"]', 1, '2025-06-21 11:56:14', '2025-06-21 11:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_variasis`
--

CREATE TABLE `product_variasis` (
  `pvs_id` int NOT NULL,
  `pr_id` int NOT NULL,
  `pv_id` int NOT NULL,
  `pvs_name` varchar(255) NOT NULL,
  `pvs_sku` varchar(250) NOT NULL,
  `pvs_stok` int NOT NULL,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_variasis`
--

INSERT INTO `product_variasis` (`pvs_id`, `pr_id`, `pv_id`, `pvs_name`, `pvs_sku`, `pvs_stok`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '250 ml', 'VAR-001', 55, 1, '2025-06-21 11:56:29', '2025-06-22 00:35:58'),
(2, 1, 1, '450 ml', 'VAR-002', 60, 1, '2025-06-21 11:56:29', '2025-06-22 00:35:58'),
(11, 1, 2, 'Original', '0', 0, 1, '2025-06-22 00:54:42', '2025-06-22 00:54:42'),
(12, 1, 2, 'Mint', '0', 0, 1, '2025-06-22 00:54:42', '2025-06-22 00:54:42'),
(13, 1, 2, 'Jasmine', '0', 0, 1, '2025-06-22 00:54:42', '2025-06-22 00:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fhI2rlWKAm6yqXLT2H11MUbtwp31LXXZC91bZvz2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHdYa2M2Q1paejJYb3Z3U1h2cm9takx1elVJOU91bWswQXZMWVY1SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jcmVhdFB1cmNoYXNlT3JkZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750660648);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sp_id` int UNSIGNED NOT NULL,
  `sp_name` varchar(255) NOT NULL,
  `sp_cp_name` varchar(255) DEFAULT NULL,
  `sp_cp_nomer` varchar(255) DEFAULT NULL,
  `sp_nomer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sp_email` varchar(100) DEFAULT NULL,
  `sp_address` text,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `sp_bank_name` varchar(100) DEFAULT NULL,
  `sp_bank_account` varchar(100) DEFAULT NULL,
  `sp_img` text NOT NULL,
  `sp_notes` text,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sp_id`, `sp_name`, `sp_cp_name`, `sp_cp_nomer`, `sp_nomer`, `sp_email`, `sp_address`, `city_id`, `sp_bank_name`, `sp_bank_account`, `sp_img`, `sp_notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CV Kopi Sejahtera', 'Budi', '081234567890', '0212345678', 'kopi@sejahtera.co.id', 'Jl. Raya Gayo No.1', 7575010, 'BCA', '1234567890', '', 'Khusus supplier kopi arabika.', 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(2, 'PT Teh Hijau Nusantara', 'Yuki', '082233445566', '021889977', 'contact@tehnusantara.com', 'Jl. Sakura Jepang No.99', 7474720, 'Mandiri', '9876543210', '', NULL, 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(3, 'UD Gula Aren Makmur', 'Samsul', '081245679012', '0213334445', 'gula@makmur.id', 'Desa Aren 2, Kalimantan', 1212710, 'BNI', '1122334455', '', 'Pengiriman langsung dari petani.', 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(4, 'CV Minyak Kelapa Asli', 'Rina', '081234003344', '0214433221', 'vco@asli.co.id', 'Jl. Kelapa No.12', 3535780, 'BRI', '9988776655', '', NULL, 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(5, 'PT Madu Alam Raya', 'Dian', '081987654321', '0211112223', 'madu@alamraya.com', 'Jl. Madu No.5', 7575010, 'BCA', '3344556677', '', 'Spesialis madu hutan liar.', 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(6, 'CV Herbal Nusantara', 'Fitri', '081122334455', '0217654321', 'herbal@nusantara.com', 'Jl. Daun Sirih No.8', 7474720, 'Mandiri', '5566778899', '', NULL, 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(7, 'UD Jahe Sehat', 'Udin', '089876543210', '0215678910', 'jahe@sehat.id', 'Jl. Jahe Merah No.17', 1212710, 'BNI', '6677889900', '', 'Pengeringan alami, tanpa pengawet.', 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(8, 'CV Tempe Renyah', 'Andi', '081266778899', '0214455667', 'tempe@renyah.co.id', 'Jl. Tempe No.88', 3535780, 'BRI', '7788990011', '', NULL, 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(9, 'PT Sambal Nusantara', 'Rosa', '082134567890', '0212233445', 'sambal@nusantara.id', 'Jl. Cabe Rawit No.6', 7575010, 'BCA', '9900112233', '', 'Sambal homemade non-masin.', 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40'),
(10, 'UD Minyak Tradisional', 'Yanto', '081355577799', '0219988776', 'minyak@tradisional.id', 'Jl. Kayu Putih No.2', 7474720, 'Mandiri', '8811223344', '', NULL, 1, '2025-06-21 15:28:40', '2025-06-21 15:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_prices`
--

CREATE TABLE `supplier_prices` (
  `spod_id` int NOT NULL,
  `pr_id` int NOT NULL,
  `sp_id` int NOT NULL,
  `spr_price` int NOT NULL,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_purchase_orders`
--

CREATE TABLE `supplier_purchase_orders` (
  `spo_id` int NOT NULL,
  `spo_nomer` varchar(255) NOT NULL,
  `sp_id` int NOT NULL,
  `spo_tanggal` date NOT NULL,
  `spo_from_company` varchar(100) NOT NULL,
  `spo_from_address` varchar(100) NOT NULL,
  `spo_from_nomer` varchar(100) NOT NULL,
  `spo_to_company` varchar(100) NOT NULL,
  `spo_to_address` varchar(100) NOT NULL,
  `spo_to_nomer` varchar(100) NOT NULL,
  `spo_sign_by` varchar(100) NOT NULL,
  `spo_status` varchar(255) NOT NULL DEFAULT 'Submitted',
  `spo_total` int NOT NULL DEFAULT '0',
  `spo_total_ppn` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier_purchase_orders`
--

INSERT INTO `supplier_purchase_orders` (`spo_id`, `spo_nomer`, `sp_id`, `spo_tanggal`, `spo_from_company`, `spo_from_address`, `spo_from_nomer`, `spo_to_company`, `spo_to_address`, `spo_to_nomer`, `spo_sign_by`, `spo_status`, `spo_total`, `spo_total_ppn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PO00001', 7, '2025-06-22', 'PT. Tabukan Panara', '+2162135443', 'Jl. Megabooth Permai No 35A', 'UD Jahe Sehat', 'Jl. Jahe Merah No.17', '0215678910', 'Denny', 'Submitted', 255300, 25300, 1, '2025-06-22 05:42:33', '2025-06-22 05:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_purchase_order_details`
--

CREATE TABLE `supplier_purchase_order_details` (
  `spod_id` int NOT NULL,
  `spo_id` int NOT NULL,
  `spod_type` int NOT NULL COMMENT '1 = Bahan Baku, 2 = Product',
  `spod_value_id` int NOT NULL,
  `spod_nama` varchar(200) NOT NULL,
  `spod_harga` int NOT NULL,
  `spod_qty` int NOT NULL,
  `spod_subtotal` int NOT NULL,
  `spod_variant` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier_purchase_order_details`
--

INSERT INTO `supplier_purchase_order_details` (`spod_id`, `spo_id`, `spod_type`, `spod_value_id`, `spod_nama`, `spod_harga`, `spod_qty`, `spod_subtotal`, `spod_variant`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Kopi Arabika Gayo<br> <small class=\"muted\"> - 250 ml </small><br> <small class=\"muted\"> - Original </small><br>', 60000, 1, 60000, '[\"1\",\"11\"]', 1, '2025-06-22 05:42:33', '2025-06-22 05:42:33'),
(2, 1, 1, 2, 'Teh Hijau Jepang', 75000, 1, 75000, NULL, 1, '2025-06-22 05:42:33', '2025-06-22 05:42:33'),
(3, 1, 1, 3, 'Gula Aren Cair', 35000, 1, 35000, NULL, 1, '2025-06-22 05:42:33', '2025-06-22 05:42:33'),
(4, 1, 1, 1, 'Kopi Arabika Gayo<br> <small class=\"muted\"> - 250 ml </small><br> <small class=\"muted\"> - Jasmine </small><br>', 60000, 1, 60000, '[\"1\",\"13\"]', 1, '2025-06-22 05:42:33', '2025-06-22 05:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `sup_id` int UNSIGNED NOT NULL,
  `sup_sku` varchar(250) NOT NULL,
  `sup_barcode` varchar(250) NOT NULL,
  `sup_name` varchar(250) NOT NULL,
  `sup_unit` varchar(250) NOT NULL,
  `sup_stock` int NOT NULL,
  `sup_buy_price` int NOT NULL,
  `sup_min_stok` int NOT NULL,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`sup_id`, `sup_sku`, `sup_barcode`, `sup_name`, `sup_unit`, `sup_stock`, `sup_buy_price`, `sup_min_stok`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SUP-001', '6941055161466', 'Kopi Arabika Gayo 250gr', 'Pcs', 100, 45000, 10, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(2, 'SUP-002', 'BC002', 'Teh Hijau Matcha 100gr', 'Pcs', 75, 55000, 5, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(3, 'SUP-003', 'BC003', 'Gula Aren Cair 500ml', 'Botol', 150, 25000, 20, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(4, 'SUP-004', 'BC004', 'Minyak Kelapa Murni 1L', 'Botol', 60, 60000, 5, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(5, 'SUP-005', 'BC005', 'Madu Hutan Asli 250gr', 'Botol', 80, 50000, 10, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(6, 'SUP-006', 'BC006', 'Sabun Herbal Daun Sirih', 'Pcs', 120, 9000, 15, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(7, 'SUP-007', 'BC007', 'Minuman Serbuk Jahe 10s', 'Box', 90, 18000, 7, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(8, 'SUP-008', 'BC008', 'Keripik Tempe 200gr', 'Pcs', 200, 12000, 25, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(9, 'SUP-009', 'BC009', 'Sambal Bawang Pedas 150ml', 'Botol', 130, 15000, 10, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26'),
(10, 'SUP-010', 'BC010', 'Minyak Kayu Putih 100ml', 'Botol', 110, 20000, 8, 1, '2025-06-21 15:49:26', '2025-06-21 15:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `vc_id` int NOT NULL,
  `vc_name` varchar(100) NOT NULL,
  `vc_deskripsi` text NOT NULL,
  `vc_nominal` int DEFAULT NULL,
  `vc_persen` int DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT '1 = active, 0 = dead',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`vc_id`, `vc_name`, `vc_deskripsi`, `vc_nominal`, `vc_persen`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test2', 'test', 0, 20, 0, '2025-06-17 08:14:32', '2025-06-17 08:30:06'),
(2, 'BIg Mo', 'test', 0, 20, 0, '2025-06-22 22:22:43', '2025-06-22 22:23:11'),
(3, 'Big L', 'test', 20000, 0, 0, '2025-06-22 22:22:58', '2025-06-22 22:23:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundlings`
--
ALTER TABLE `bundlings`
  ADD PRIMARY KEY (`bd_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_staff`
--
ALTER TABLE `category_staff`
  ADD PRIMARY KEY (`cs_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_stocks`
--
ALTER TABLE `manage_stocks`
  ADD PRIMARY KEY (`ms_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaturans`
--
ALTER TABLE `pengaturans`
  ADD PRIMARY KEY (`pengaturan_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`pp_id`);

--
-- Indexes for table `product_units`
--
ALTER TABLE `product_units`
  ADD PRIMARY KEY (`pu_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`pv_id`);

--
-- Indexes for table `product_variasis`
--
ALTER TABLE `product_variasis`
  ADD PRIMARY KEY (`pvs_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `supplier_prices`
--
ALTER TABLE `supplier_prices`
  ADD PRIMARY KEY (`spod_id`);

--
-- Indexes for table `supplier_purchase_orders`
--
ALTER TABLE `supplier_purchase_orders`
  ADD PRIMARY KEY (`spo_id`);

--
-- Indexes for table `supplier_purchase_order_details`
--
ALTER TABLE `supplier_purchase_order_details`
  ADD PRIMARY KEY (`spod_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`vc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bundlings`
--
ALTER TABLE `bundlings`
  MODIFY `bd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category_staff`
--
ALTER TABLE `category_staff`
  MODIFY `cs_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9292711;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_stocks`
--
ALTER TABLE `manage_stocks`
  MODIFY `ms_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengaturans`
--
ALTER TABLE `pengaturans`
  MODIFY `pengaturan_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pr_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `pp_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_units`
--
ALTER TABLE `product_units`
  MODIFY `pu_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `pv_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_variasis`
--
ALTER TABLE `product_variasis`
  MODIFY `pvs_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sp_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier_prices`
--
ALTER TABLE `supplier_prices`
  MODIFY `spod_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_purchase_orders`
--
ALTER TABLE `supplier_purchase_orders`
  MODIFY `spo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_purchase_order_details`
--
ALTER TABLE `supplier_purchase_order_details`
  MODIFY `spod_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `sup_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `vc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                                                                  