-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 12:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lms_terakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `keterangan`, `name`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Hadir', 'Umi Distrian', 'WhatsApp Image 2022-06-23 at 12.03.13 PM.jpeg', '2022-06-25 04:15:39', '2022-06-25 04:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diskusis`
--

CREATE TABLE `diskusis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `materi_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluasis`
--

CREATE TABLE `evaluasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `penilaian_id` bigint(20) UNSIGNED NOT NULL,
  `kualitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `total_question` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_exam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `time`, `total_question`, `status`, `start`, `end`, `created_by`, `created_at`, `updated_at`, `type_exam`) VALUES
(24, 'Penilaian Bulan Mei', 20, 1, 'Ready', '2022-05-26 22:02:00', '2022-05-31 22:02:00', '2', '2022-05-26 15:02:48', '2022-05-27 02:31:20', ''),
(26, 'Reguler', 10, 1, 'Ready', '2022-06-06 18:25:00', '2022-06-07 18:00:00', '2', '2022-06-06 11:24:17', '2022-06-06 11:24:17', 'essay'),
(27, 'Ips', 90, 2, 'Ready', '2022-08-12 10:20:00', '2022-09-12 12:00:00', '2', '2022-06-12 03:20:43', '2022-06-12 03:20:43', 'essay'),
(29, 'ujian3', 30, 2, 'Ready', '2022-06-17 06:45:00', '2022-06-18 06:45:00', '7', '2022-06-16 23:45:51', '2022-06-17 01:26:00', 'essay'),
(30, 'Ujian akhir', 23, 2, 'Ready', '2022-06-17 12:16:00', '2022-06-18 12:16:00', '2', '2022-06-17 05:17:01', '2022-06-17 05:19:28', 'essay'),
(31, 'ujian esai', 20, 1, 'Ready', '2022-06-18 03:07:00', '2022-06-19 03:07:00', '7', '2022-06-17 20:08:10', '2022-06-18 02:27:35', 'ganda'),
(32, 'Exam bisa', 30, 2, 'Ready', '2022-06-20 08:29:00', '2022-06-21 08:29:00', '2', '2022-06-20 01:29:34', '2022-06-20 01:29:34', 'essay'),
(33, 'tess', 30, 2, 'Ready', '2022-06-20 19:34:00', '2022-06-22 19:34:00', '7', '2022-06-20 12:35:21', '2022-06-20 12:35:21', 'essay'),
(35, 'Ujian Fisika', 60, 3, 'Ready', '2022-06-22 22:07:00', '2022-06-30 22:07:00', '11', '2022-06-23 15:07:13', '2022-06-23 22:51:18', 'ganda'),
(36, 'Ujian Esai Fisika', 30, 2, 'Ready', '2022-06-22 05:40:00', '2022-06-30 05:40:00', '11', '2022-06-23 22:41:32', '2022-06-23 22:53:25', 'essay'),
(38, 'Penilaian Coba', 50, 1, 'Ready', '2022-06-24 21:03:00', '2022-06-27 21:03:00', '31', '2022-06-25 14:04:05', '2022-06-26 08:20:51', 'essay'),
(39, 'penilaian 1', 20, 1, 'Ready', '2022-06-25 15:02:00', '2022-06-27 15:02:00', '31', '2022-06-26 08:03:07', '2022-06-26 08:13:42', 'ganda');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

CREATE TABLE `exam_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_question`
--

INSERT INTO `exam_question` (`id`, `exam_id`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 39, 2, '2022-06-26 08:03:07', '2022-06-26 08:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question_essay`
--

CREATE TABLE `exam_question_essay` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `question_essay_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_question_essay`
--

INSERT INTO `exam_question_essay` (`id`, `exam_id`, `question_essay_id`, `created_at`, `updated_at`) VALUES
(1, 38, 2, '2022-06-26 08:20:51', '2022-06-26 08:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `exam_user`
--

CREATE TABLE `exam_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `history_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasis`
--

CREATE TABLE `informasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi_informasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informasis`
--

INSERT INTO `informasis` (`id`, `isi_informasi`, `image_id`, `document_id`, `created_at`, `updated_at`) VALUES
(2, 'Bimbingan Belajar Privat Juara mengadakan event untuk bulan ini', '1', NULL, '2022-06-23 05:07:45', '2022-06-26 06:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(5, 'UMUM', '2022-06-23 02:56:58', '2022-06-23 02:56:58'),
(6, 'PAUD', '2022-06-23 02:57:08', '2022-06-23 02:57:08'),
(7, 'TK-A', '2022-06-23 02:57:20', '2022-06-23 02:57:20'),
(8, 'TK-B', '2022-06-23 02:57:30', '2022-06-23 02:57:30'),
(10, '1 SD', '2022-06-23 03:03:23', '2022-06-23 03:03:23'),
(11, '2 SD', '2022-06-23 03:03:32', '2022-06-23 03:03:32'),
(12, '3 SD', '2022-06-23 05:43:10', '2022-06-23 05:43:10'),
(13, '4 SD', '2022-06-23 05:43:18', '2022-06-23 05:43:18'),
(14, '5 SD', '2022-06-23 05:43:27', '2022-06-23 05:43:27'),
(15, '6 SD', '2022-06-23 05:43:38', '2022-06-23 05:43:38'),
(16, '1 SMP', '2022-06-23 05:43:48', '2022-06-23 05:43:48'),
(17, '2 SMP', '2022-06-23 05:43:56', '2022-06-23 05:43:56'),
(18, '3 SMP', '2022-06-23 05:44:05', '2022-06-23 05:44:05'),
(19, '1 SMA', '2022-06-23 05:44:13', '2022-06-23 05:44:13'),
(20, '2 SMA', '2022-06-23 05:44:22', '2022-06-23 05:44:22'),
(21, '3 SMA', '2022-06-23 05:44:31', '2022-06-23 05:44:31'),
(22, 'UMUM', '2022-06-23 05:44:51', '2022-06-23 05:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mata_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `mata_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'Matematika', '2022-04-17 04:36:50', '2022-04-17 04:36:50'),
(4, 'IPA', '2022-05-06 12:12:49', '2022-05-06 12:12:49'),
(7, 'IPA-FISIKA', '2022-06-23 03:53:15', '2022-06-23 03:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_24_095022_create_permission_tables', 1),
(5, '2021_04_24_105557_create_exams_table', 1),
(6, '2021_04_24_105611_create_questions_table', 1),
(7, '2021_04_24_105627_create_subjects_table', 1),
(8, '2021_04_24_165632_create_photos_table', 1),
(9, '2021_04_24_165646_create_videos_table', 1),
(10, '2021_04_27_223437_create_documents_table', 1),
(11, '2021_04_27_223454_create_images_table', 1),
(12, '2021_04_27_224752_create_exam_user_table', 1),
(13, '2021_04_27_225109_create_exam_question_table', 1),
(14, '2021_04_28_224455_create_audio_table', 2),
(15, '2022_04_15_103353_create_kelas_table', 3),
(16, '2022_04_15_104239_create_mata_pelajaran_table', 3),
(17, '2022_04_16_141539_create_mata_pelajaran_table', 4),
(18, '2022_04_16_142231_create_mata_pelajarans_table', 5),
(19, '2022_04_17_115437_create_materi_table', 6),
(20, '2022_04_18_081708_create_users_table', 7),
(21, '2022_04_26_093558_create_absens_table', 8),
(22, '2022_04_27_220503_create_absensis_table', 9),
(23, '2022_04_27_221538_create_absensis_table', 10),
(24, '2022_04_28_071733_create_informasis_table', 11),
(25, '2022_04_28_080632_create_informasi_table', 12),
(26, '2022_05_02_131734_create_absensi_table', 13),
(27, '2022_05_02_141714_create_absensis_table', 13),
(28, '2022_05_05_124030_create_absensis_table', 14),
(29, '2022_05_09_182025_create_materi_table', 15),
(30, '2022_05_12_182321_create_diskusi_table', 16),
(31, '2022_05_12_190430_create_diskusis_table', 17),
(32, '2022_05_13_071427_create_respons_table', 18),
(33, '2022_05_14_112804_create_soals_table', 19),
(34, '2022_05_14_141259_create_ujians_table', 19),
(35, '2022_05_17_112512_create_users_table', 20),
(36, '2022_05_17_120002_create_users_table', 21),
(37, '2022_05_18_132307_create_absensis_table', 22),
(38, '2022_05_18_200110_create_penilaians_table', 23),
(39, '2022_05_18_202845_create_soal_penilaians_table', 23),
(40, '2022_05_18_213841_create_penilaian_tentors_table', 23),
(41, '2022_05_19_110156_create_penilaian_tentors_table', 24),
(42, '2022_05_20_152622_create_soal_penilaians_table', 25),
(43, '2022_05_21_154639_create_penilaian_soal_penilaian_table', 26),
(44, '2022_05_21_155204_create_penilaian_user_table', 27),
(45, '2022_05_22_153650_create_soal_penilaians_table', 28),
(46, '2022_05_22_160632_create_evaluasis_table', 29),
(47, '2022_05_23_075101_create_evaluasis_table', 30),
(48, '2022_05_23_135851_create_penilaian_user_table', 31),
(49, '2022_05_24_071429_create_questions_table', 32),
(50, '2022_05_24_071655_create_questions_table', 33),
(51, '2022_05_24_204649_create_filesoals_table', 34),
(52, '2022_05_24_220529_create_questions_table', 35),
(53, '2022_05_25_155741_create_questions_table', 36),
(54, '2022_05_25_172050_create_questions_table', 37),
(55, '2022_05_25_172546_create_questions_table', 38),
(56, '2022_05_27_085502_create_penilaian_user_table', 39),
(57, '2022_05_27_165434_create_users_table', 40),
(58, '2022_05_27_171948_create_users_table', 41),
(59, '2022_05_28_170123_create_users_table', 42),
(60, '2022_05_28_171754_create_siswas_table', 43),
(61, '2022_05_29_135508_create_siswas_table', 44),
(62, '2022_05_29_154808_create_tentors_table', 45),
(63, '2022_05_29_161550_create_users_table', 46),
(64, '2022_05_29_161723_create_siswas_table', 46),
(65, '2022_05_29_161751_create_tentors_table', 46),
(66, '2022_05_30_232851_create_materi_table', 47),
(67, '2022_05_30_234206_create_materi_table', 48),
(68, '2022_05_30_234523_create_materi_table', 49),
(69, '2022_05_31_073446_create_materi_table', 50),
(70, '2022_06_01_084948_create_materi_table', 51),
(71, '2022_06_02_185404_create_evaluasis_table', 52),
(72, '2022_06_17_100107_create_question_essays_table', 53),
(73, '2022_06_17_113519_create_questions_table', 54),
(74, '2022_06_09_170947_create_absensis_table', 55),
(75, '2022_06_10_193225_create_evaluasis_table', 56),
(76, '2022_06_19_105616_create_documents_table', 57),
(77, '2022_06_19_111838_create_images_table', 58),
(78, '2022_06_19_112735_create_videos_table', 59),
(79, '2022_06_19_113805_create_audio_table', 60),
(80, '2022_06_19_155413_create_subjects_table', 61),
(81, '2022_06_21_213324_create_diskusis_table', 62),
(82, '2022_06_21_230126_create_informasi_table', 63),
(83, '2022_06_21_231504_create_informasis_table', 64),
(84, '2022_06_22_165217_create_siswas_table', 65),
(85, '2022_06_22_180220_create_siswas_table', 66),
(86, '2022_06_22_181615_create_tentors_table', 67),
(87, '2022_06_23_102151_create_siswas_table', 68),
(88, '2022_06_25_110005_create_absensis_table', 69),
(89, '2022_06_26_000344_create_diskusis_table', 70),
(90, '2022_06_26_001509_create_diskusis_table', 71),
(91, '2022_06_26_002706_create_diskusis_table', 72),
(92, '2022_06_26_010210_create_evaluasis_table', 73),
(93, '2022_06_26_073514_create_materi_table', 74),
(94, '2022_06_26_082108_create_respons_table', 75),
(95, '2022_06_26_083328_create_evaluasis_table', 76),
(96, '2022_06_26_090026_create_subjects_table', 77),
(97, '2022_06_26_090206_create_subjects_table', 78),
(98, '2022_06_26_090503_create_audio_table', 79),
(99, '2022_06_26_090737_create_videos_table', 80),
(100, '2022_06_26_090947_create_images_table', 81),
(101, '2022_06_26_091225_create_documents_table', 82),
(102, '2022_06_26_135543_create_questions_table', 83),
(103, '2022_06_26_140001_create_question_essays_table', 84),
(104, '2022_06_26_140221_create_question_essays_table', 85),
(105, '2022_06_26_145531_create_exam_question_table', 86),
(106, '2022_06_26_150555_create_exam_user_table', 87),
(107, '2022_06_26_151602_create_exam_question_essay_table', 88),
(108, '2022_06_26_155534_create_diskusis_table', 89),
(109, '2022_06_26_155829_create_respons_table', 90);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 32);

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `total_pertanyaan` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaians`
--

INSERT INTO `penilaians` (`id`, `name`, `time`, `total_pertanyaan`, `status`, `start`, `end`, `created_at`, `updated_at`) VALUES
(26, 'Evaluasi Tentor Juni 2022', 30, 3, 'Ready', '2022-06-01 00:00:00', '2022-06-30 23:00:00', '2022-06-23 04:02:34', '2022-06-23 04:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'exams.index', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(2, 'exams.create', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(3, 'exams.edit', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(4, 'exams.delete', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(5, 'subjects.index', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(6, 'subjects.create', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(7, 'subjects.edit', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(8, 'subjects.delete', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(9, 'questions.index', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(10, 'questions.create', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(11, 'questions.edit', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(12, 'questions.delete', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(13, 'images.index', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(14, 'images.create', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(15, 'images.delete', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(16, 'videos.index', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(17, 'videos.create', 'web', '2021-04-27 10:15:26', '2022-02-27 10:15:26'),
(18, 'videos.edit', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(19, 'videos.delete', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(20, 'audios.index', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(21, 'audios.create', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(22, 'audios.edit', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(23, 'audios.delete', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(24, 'documents.index', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(25, 'documents.create', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(26, 'documents.edit', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(27, 'documents.delete', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(28, 'roles.index', 'web', '2021-04-27 10:15:26', '2021-04-27 10:15:26'),
(29, 'roles.create', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(30, 'roles.edit', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(31, 'roles.delete', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(32, 'permissions.index', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(33, 'users.index', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(35, 'users.edit', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(36, 'users.delete', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(37, 'kelas.index', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(38, 'kelas.edit', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(39, 'kelas.create', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(40, 'kelas.delete', 'web', '2021-04-27 10:15:27', '2021-04-27 10:15:27'),
(41, 'mapels.index', 'web', NULL, NULL),
(42, 'mapels.edit', 'web', NULL, NULL),
(43, 'mapels.create', 'web', NULL, NULL),
(44, 'mapels.delete', 'web', NULL, NULL),
(45, 'materi.index', 'web', NULL, NULL),
(46, 'materi.create', 'web', NULL, NULL),
(47, 'materi.edit', 'web', NULL, NULL),
(48, 'materi.delete', 'web', NULL, NULL),
(49, 'absensi.index', 'web', NULL, NULL),
(50, 'absensi.create', 'web', NULL, NULL),
(52, 'absensi.delete', 'web', NULL, NULL),
(53, 'informasi.index', 'web', NULL, NULL),
(54, 'informasi.create', 'web', NULL, NULL),
(55, 'informasi.delete', 'web', NULL, NULL),
(56, 'informasi.edit', 'web', NULL, NULL),
(57, 'informasi.update', 'web', NULL, NULL),
(58, 'absensi.riwayat', 'web', NULL, NULL),
(59, 'absensi.tentor', 'web', NULL, NULL),
(60, 'materi.tentor', 'web', NULL, NULL),
(61, 'users.tentor', 'web', NULL, NULL),
(62, 'quiz.edit', 'web', NULL, NULL),
(63, 'quiz.delete', 'web', NULL, NULL),
(65, 'profile.index', 'web', NULL, NULL),
(66, 'profile.edit', 'web', NULL, NULL),
(67, 'materi.showlist', 'web', NULL, NULL),
(72, 'materi.showMateri', 'web', NULL, NULL),
(73, 'diskusi.index', 'web', NULL, NULL),
(74, 'diskusi.create', 'web', NULL, NULL),
(75, 'diskusi.edit', 'web', NULL, NULL),
(76, 'diskusi.delete', 'web', NULL, NULL),
(77, 'diskusi.respon', 'web', NULL, NULL),
(78, 'diskusi.showDiskusi', 'web', NULL, NULL),
(79, 'diskusi.siswa', 'web', NULL, NULL),
(80, 'diskusi.tentor', 'web', NULL, NULL),
(81, 'ujian.index', 'web', NULL, NULL),
(82, 'ujian.tentor', 'web', NULL, NULL),
(83, 'ujian.delete', 'web', NULL, NULL),
(84, 'ujian.show', 'web', NULL, NULL),
(85, 'ujian.create', 'web', NULL, NULL),
(86, 'ujian.edit', 'web', NULL, NULL),
(87, 'users.siswa', 'web', NULL, NULL),
(88, 'penilaian.index', 'web', NULL, NULL),
(89, 'penilaian.edit', 'web', NULL, NULL),
(90, 'penilaian.create', 'web', NULL, NULL),
(91, 'penilaian.delete', 'web', NULL, NULL),
(92, 'soalPenilaian.index', 'web', NULL, NULL),
(93, 'soalPenilaian.edit', 'web', NULL, NULL),
(94, 'soalPenilaian.delete', 'web', NULL, NULL),
(95, 'soalPenilaian.create', 'web', NULL, NULL),
(96, 'penilaian.riwayat', 'web', NULL, NULL),
(97, 'absensi.export_excel', 'web', NULL, NULL),
(98, 'users.showSiswa', 'web', NULL, NULL),
(99, 'users.dataSiswa', 'web', NULL, NULL),
(100, 'users.showTentor', 'web', NULL, NULL),
(101, 'users.dataTentor', 'web', NULL, NULL),
(102, 'penilaian.siswa', 'web', NULL, NULL),
(103, 'users.tentor', 'web', NULL, NULL),
(104, 'absensi.exportPDF', 'web', NULL, NULL),
(105, 'siswa.edit', 'web', NULL, NULL),
(106, 'tentor.edit', 'web', NULL, NULL),
(107, 'users.editSiswa', 'web', NULL, NULL),
(108, 'exam_essays.create', 'web', NULL, NULL),
(109, 'exam_essays.index', 'web', NULL, NULL),
(110, 'exam_essays.index', 'web', NULL, NULL),
(111, 'exam_essays.edit', 'web', NULL, NULL),
(112, 'exam_essays.edit', 'web', NULL, NULL),
(113, 'exam_essays.delete', 'web', NULL, NULL),
(114, 'exam_essays.delete', 'web', NULL, NULL),
(115, 'question_essays.index', 'web', NULL, NULL),
(116, 'question_essays.create', 'web', NULL, NULL),
(117, 'question_essays.edit', 'web', NULL, NULL),
(118, 'question_essays.delete', 'web', NULL, NULL),
(119, 'question_essays.show', 'web', NULL, NULL),
(120, 'profile.editTentor', 'web', NULL, NULL),
(121, 'penilaian.lihat', 'web', NULL, NULL),
(122, 'images.edit', 'web', NULL, NULL),
(123, 'users.createSiswa', 'web', NULL, NULL),
(124, 'users.createTentor', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_A` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_B` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_C` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_D` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_E` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `subject_id`, `pertanyaan`, `video_id`, `audio_id`, `image_id`, `document_id`, `option_A`, `option_B`, `option_C`, `option_D`, `option_E`, `answer`, `penjelasan`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 3, 'coba gimana', NULL, NULL, NULL, NULL, '1', '2', NULL, NULL, NULL, '1', NULL, '31', '2022-06-26 08:02:11', '2022-06-26 08:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `question_essays`
--

CREATE TABLE `question_essays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_essays`
--

INSERT INTO `question_essays` (`id`, `subject_id`, `detail`, `video_id`, `audio_id`, `image_id`, `document_id`, `answer`, `explanation`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 3, 'gimana', NULL, NULL, NULL, NULL, 'cobaaa', NULL, '31', '2022-06-26 08:19:41', '2022-06-26 08:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `respons`
--

CREATE TABLE `respons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `diskusi_id` bigint(20) UNSIGNED NOT NULL,
  `respon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-04-27 17:15:26', '2021-04-27 17:15:26'),
(2, 'teacher', 'web', '2021-04-27 17:15:26', '2021-04-27 17:15:26'),
(3, 'student', 'web', '2021-04-27 17:15:26', '2021-04-27 17:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 3),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(33, 2),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 2),
(45, 3),
(46, 2),
(47, 2),
(48, 2),
(49, 1),
(49, 2),
(50, 2),
(52, 1),
(53, 1),
(53, 2),
(53, 3),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 2),
(60, 2),
(61, 1),
(61, 2),
(65, 1),
(65, 2),
(65, 3),
(66, 3),
(67, 3),
(72, 3),
(73, 2),
(73, 3),
(74, 3),
(75, 2),
(75, 3),
(76, 2),
(77, 2),
(77, 3),
(78, 2),
(78, 3),
(79, 3),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 1),
(88, 1),
(88, 3),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(99, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(102, 3),
(104, 1),
(105, 3),
(106, 2),
(107, 1),
(107, 2),
(108, 2),
(109, 2),
(109, 3),
(111, 2),
(113, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 3),
(122, 1),
(123, 1),
(124, 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tentor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `user_id`, `name`, `jenjang`, `no_wa`, `alamat`, `asal_sekolah`, `nama_tentor`, `created_at`, `updated_at`) VALUES
(2, 19, 'Cynta Cahya Ningtias', 'SMA/SMK/MA', '08533077990', 'Malang', 'SMAN 1 Malang', 'Miladia Nur Iasha', '2022-06-23 03:43:41', '2022-06-23 03:43:41'),
(3, 18, 'Favian Dzaki A.I', 'SMP/MTS', '081234567860', 'Malang', 'SMP BSS Malang', 'Widya Virgiana', '2022-06-23 03:45:55', '2022-06-23 03:45:55'),
(4, 17, 'Anggie Almira Putri', 'SMA/SMK/MA', '085233844409', 'Malang', 'SMAN 4 Malang', 'Iffanna Fitrotul Aaidati', '2022-06-23 03:47:28', '2022-06-24 14:59:50'),
(5, 24, 'Nabila Nosa Amelia Putri', 'SMA/SMK/MA', '08123456789', 'Malang', 'SMAPARA', 'Umi Distrian', '2022-06-25 01:08:00', '2022-06-25 01:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(3, 31, 'juni', '2022-06-26 08:01:39', '2022-06-26 08:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `tentors`
--

CREATE TABLE `tentors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tentors`
--

INSERT INTO `tentors` (`id`, `user_id`, `name`, `no_wa`, `alamat`, `created_at`, `updated_at`) VALUES
(3, 10, 'Triska Ferdiana Permatasari', '08123456789', 'Malang', '2022-06-23 02:30:23', '2022-06-23 02:30:23'),
(4, 11, 'Umi Distrian', '081234567891', 'Malang', '2022-06-23 02:37:59', '2022-06-25 02:22:31'),
(5, 12, 'Miladia Nur Iasha', '08123456786', 'Malang', '2022-06-23 02:38:36', '2022-06-23 02:38:36'),
(6, 13, 'Widya Virgiana', '081341230777', 'Malang', '2022-06-23 02:39:31', '2022-06-23 02:39:31'),
(7, 14, 'Iffanna Fitrotul Aaidati', '085330773101', 'Malang', '2022-06-23 02:40:26', '2022-06-23 02:40:26'),
(8, 15, 'Reza Dewi Utami', '085233099012', 'Batu', '2022-06-23 02:41:39', '2022-06-23 02:41:39'),
(12, 31, 'cobaaa', '08123456786', 'Malang', '2022-06-25 12:32:40', '2022-06-25 12:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'adminjuara', '$2y$10$pLV0/u4V27Be0P74EO17Ou.sR.dbzWwHDoNLBsabCTjcctCuR.G8a', 'TdvZmlTbG7oWe4OXh3TafKZIMZNzs6bckWS982ODGmespmeHVzfduhctNyOZ', '2022-05-29 09:18:37', '2022-05-29 09:18:37'),
(10, 'TriskaFerdiana', '$2y$10$6PlyjwNAKCR02oWaQiuFQeB0u/G5VDUqwDJhUq4/IvE2bF3jND/Zu', NULL, '2022-06-23 02:29:12', '2022-06-23 02:29:12'),
(11, 'UmiDistrian', '$2y$10$Eb/5QasUWIBJGQofUAlgy.3JNvTIa0GtLNoz3OImpDMlh/CowOqky', NULL, '2022-06-23 02:31:55', '2022-06-25 02:22:08'),
(12, 'MiladiaNurIasha', '$2y$10$rmhIxii0CNs73ZQvEKmPR.48KuVRrK1GFMAhECGEeVB30GfE0o9om', NULL, '2022-06-23 02:34:45', '2022-06-23 02:34:45'),
(13, 'WidyaVirgiana', '$2y$10$28NQ75FyeG3jefizTz4uGu7PO2xQZi/uMUtoaSG75CdVrWLfltImq', NULL, '2022-06-23 02:35:13', '2022-06-23 02:35:13'),
(14, 'IffannaFitrotulAaidati', '$2y$10$T5KvXP0JierDsJsGmp2Ik.Su4r99h2E61lc4ZBiDIbdUeVkAiGHhy', NULL, '2022-06-23 02:36:06', '2022-06-23 02:36:06'),
(15, 'RezaDewiUtami', '$2y$10$SM/a5l8ILHvMB6V3Vd94Gup/8OMbGmLvLOuFmnMsmwIzl6Vwt79D6', NULL, '2022-06-23 02:36:44', '2022-06-24 23:37:47'),
(17, 'AnggieAlmiraPutri', '$2y$10$RdtRcjiC2NsC72A0j4v2h.1d7SG9bp9JNkMccDwAPjoY48yo.cIyO', NULL, '2022-06-23 02:45:43', '2022-06-24 15:09:10'),
(18, 'FavianDzaki', '$2y$10$1Ney3NsMi8jzxh7oqkxkwudcHb3BSrznu79WYLQjfPSHIOevsWcZa', NULL, '2022-06-23 02:46:23', '2022-06-23 02:46:23'),
(19, 'CyntaCahyaNingtias', '$2y$10$KDdho1DDnhHyGAfLs8ZnU.ZwdckI82jzz6N4L/u90hg16/B.l98JO', NULL, '2022-06-23 02:47:19', '2022-06-23 02:47:19'),
(24, 'NabilaNosa', '$2y$10$G8LCSz1XTLjWEvciDywVRO6liYeO5ClVYJT4CHfhbkoTexafidwX6', NULL, '2022-06-25 01:08:00', '2022-06-25 02:24:02'),
(31, 'coba3', '$2y$10$oZ84jueSote4M8DkbmozquIY2Ih/yPluKcEqVaXPytKXyFhFspxfq', NULL, '2022-06-25 12:32:40', '2022-06-25 12:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_user_id_foreign` (`user_id`);

--
-- Indexes for table `diskusis`
--
ALTER TABLE `diskusis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diskusis_materi_id_foreign` (`materi_id`),
  ADD KEY `diskusis_user_id_foreign` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `evaluasis`
--
ALTER TABLE `evaluasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluasis_user_id_foreign` (`user_id`),
  ADD KEY `evaluasis_penilaian_id_foreign` (`penilaian_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_question_id_foreign` (`question_id`);

--
-- Indexes for table `exam_question_essay`
--
ALTER TABLE `exam_question_essay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_question_essay_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_question_essay_question_essay_id_foreign` (`question_essay_id`);

--
-- Indexes for table `exam_user`
--
ALTER TABLE `exam_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_user_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_user_id_foreign` (`user_id`);

--
-- Indexes for table `informasis`
--
ALTER TABLE `informasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materi_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `question_essays`
--
ALTER TABLE `question_essays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_essays_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `respons`
--
ALTER TABLE `respons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respons_user_id_foreign` (`user_id`),
  ADD KEY `respons_diskusi_id_foreign` (`diskusi_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswas_user_id_foreign` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_user_id_foreign` (`user_id`);

--
-- Indexes for table `tentors`
--
ALTER TABLE `tentors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tentors_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diskusis`
--
ALTER TABLE `diskusis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluasis`
--
ALTER TABLE `evaluasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_question_essay`
--
ALTER TABLE `exam_question_essay`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_user`
--
ALTER TABLE `exam_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `informasis`
--
ALTER TABLE `informasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_essays`
--
ALTER TABLE `question_essays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `respons`
--
ALTER TABLE `respons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tentors`
--
ALTER TABLE `tentors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `audio_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diskusis`
--
ALTER TABLE `diskusis`
  ADD CONSTRAINT `diskusis_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diskusis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluasis`
--
ALTER TABLE `evaluasis`
  ADD CONSTRAINT `evaluasis_penilaian_id_foreign` FOREIGN KEY (`penilaian_id`) REFERENCES `penilaians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD CONSTRAINT `exam_question_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_question_essay`
--
ALTER TABLE `exam_question_essay`
  ADD CONSTRAINT `exam_question_essay_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_question_essay_question_essay_id_foreign` FOREIGN KEY (`question_essay_id`) REFERENCES `question_essays` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_user`
--
ALTER TABLE `exam_user`
  ADD CONSTRAINT `exam_user_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_essays`
--
ALTER TABLE `question_essays`
  ADD CONSTRAINT `question_essays_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `respons`
--
ALTER TABLE `respons`
  ADD CONSTRAINT `respons_diskusi_id_foreign` FOREIGN KEY (`diskusi_id`) REFERENCES `diskusis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tentors`
--
ALTER TABLE `tentors`
  ADD CONSTRAINT `tentors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
