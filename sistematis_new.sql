-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 11:35 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistematis_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `sistms_access`
--

CREATE TABLE `sistms_access` (
  `id` int(11) NOT NULL,
  `access_namespace` varchar(255) NOT NULL,
  `access_c` int(11) NOT NULL DEFAULT '0',
  `access_r` int(11) NOT NULL DEFAULT '0',
  `access_u` int(11) NOT NULL DEFAULT '0',
  `access_d` int(11) NOT NULL DEFAULT '0',
  `access_privilege` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_access`
--

INSERT INTO `sistms_access` (`id`, `access_namespace`, `access_c`, `access_r`, `access_u`, `access_d`, `access_privilege`, `updated_at`, `created_at`) VALUES
(1, 'dashboard', 1, 1, 1, 1, 2, '2023-07-08 14:52:21', '2023-06-28 07:00:24'),
(3, 'dashboard', 0, 1, 0, 0, 3, '2023-06-29 19:49:52', '2023-06-28 07:00:24'),
(4, 'dashboard', 0, 1, 0, 0, 4, '2023-06-29 19:49:53', '2023-06-28 07:00:24'),
(5, 'dashboard', 0, 1, 0, 0, 5, '2023-06-29 19:49:54', '2023-06-28 07:00:24'),
(6, 'company_management', 1, 1, 1, 1, 2, '2023-06-29 19:49:58', '2023-06-28 07:00:24'),
(7, 'device_management', 1, 1, 1, 1, 2, '2023-07-09 00:01:16', '2023-06-28 07:00:24'),
(8, 'incident_management', 1, 1, 1, 1, 2, '2023-07-02 01:02:35', '2023-06-28 07:00:24'),
(9, 'dashboard', 0, 0, 0, 1, 0, '2023-06-30 18:27:20', '2023-06-30 18:27:20'),
(12, 'company_management', 1, 1, 1, 1, 3, '2023-06-30 18:31:41', '2023-06-30 18:31:41'),
(13, 'device_management', 1, 1, 1, 1, 3, '2023-06-30 18:31:50', '2023-06-30 18:31:50'),
(14, 'incident_management', 1, 1, 1, 1, 3, '2023-06-30 18:31:55', '2023-06-30 18:31:55'),
(15, 'incident_management', 1, 1, 1, 0, 4, '2023-06-30 21:08:38', '2023-06-30 21:08:38'),
(16, 'company_management', 0, 0, 0, 0, 4, '2023-07-01 09:19:56', '2023-07-01 08:41:45'),
(17, 'access_management', 1, 1, 1, 1, 2, '2023-07-01 08:55:31', '2023-07-01 08:55:31'),
(18, 'stock_management', 1, 1, 1, 1, 2, '2023-07-01 08:55:41', '2023-07-01 08:55:41'),
(19, 'stockcat_management', 1, 1, 1, 1, 2, '2023-07-01 18:54:08', '2023-07-01 09:09:40'),
(20, 'shift_management', 1, 1, 1, 1, 2, '2023-07-01 09:09:50', '2023-07-01 09:09:50'),
(21, 'shifts_management', 1, 1, 1, 1, 2, '2023-07-01 09:09:56', '2023-07-01 09:09:56'),
(22, 'users_management', 1, 1, 1, 1, 2, '2023-07-01 09:34:11', '2023-07-01 09:11:24'),
(23, 'privilege_management', 1, 1, 1, 1, 2, '2023-07-01 09:16:21', '2023-07-01 09:16:21'),
(24, 'menu_management', 1, 1, 1, 1, 2, '2023-07-01 09:17:19', '2023-07-01 09:17:19'),
(25, 'stock_management', 0, 1, 0, 0, 4, '2023-07-01 09:23:11', '2023-07-01 09:19:38'),
(27, 'checklists_management', 1, 1, 1, 1, 2, '2023-07-01 19:48:59', '2023-07-01 19:48:59'),
(28, 'checklist', 1, 1, 1, 1, 2, '2023-07-11 05:15:14', '2023-07-01 19:49:05'),
(29, 'report', 1, 1, 0, 0, 2, '2023-07-03 00:23:58', '2023-07-03 00:23:58'),
(30, 'account', 1, 1, 1, 0, 2, '2023-07-03 17:24:38', '2023-07-03 17:24:38'),
(31, 'checklist', 1, 1, 1, 0, 5, '2023-07-04 02:02:09', '2023-07-04 02:02:09'),
(32, 'report', 1, 1, 1, 0, 5, '2023-07-04 02:02:18', '2023-07-04 02:02:18'),
(33, 'account', 1, 1, 1, 0, 5, '2023-07-04 02:02:24', '2023-07-04 02:02:24'),
(34, 'incident_management', 1, 1, 1, 0, 5, '2023-07-04 02:04:32', '2023-07-04 02:04:32'),
(35, 'company', 0, 1, 1, 0, 5, '2023-07-04 02:21:44', '2023-07-04 02:21:44'),
(36, 'device_management', 1, 1, 1, 1, 5, '2023-07-04 03:14:51', '2023-07-04 03:14:51'),
(41, 'access_management', 1, 1, 1, 1, 3, '2023-07-01 08:55:31', '2023-07-01 08:55:31'),
(42, 'stock_management', 1, 1, 1, 1, 3, '2023-07-01 08:55:41', '2023-07-01 08:55:41'),
(43, 'stockcat_management', 1, 1, 1, 1, 3, '2023-07-01 18:54:08', '2023-07-01 09:09:40'),
(44, 'shift_management', 1, 1, 1, 1, 3, '2023-07-01 09:09:50', '2023-07-01 09:09:50'),
(45, 'shifts_management', 1, 1, 1, 1, 3, '2023-07-01 09:09:56', '2023-07-01 09:09:56'),
(46, 'users_management', 1, 1, 1, 1, 3, '2023-07-01 09:34:11', '2023-07-01 09:11:24'),
(47, 'privilege_management', 1, 1, 1, 1, 3, '2023-07-01 09:16:21', '2023-07-01 09:16:21'),
(48, 'menu_management', 1, 1, 1, 1, 3, '2023-07-01 09:17:19', '2023-07-01 09:17:19'),
(49, 'checklists_management', 1, 1, 1, 1, 3, '2023-07-01 19:48:59', '2023-07-01 19:48:59'),
(50, 'checklist', 1, 1, 0, 0, 3, '2023-07-02 18:25:08', '2023-07-01 19:49:05'),
(51, 'report', 1, 1, 0, 0, 3, '2023-07-03 00:23:58', '2023-07-03 00:23:58'),
(52, 'account', 1, 1, 1, 0, 3, '2023-07-03 17:24:38', '2023-07-03 17:24:38'),
(53, 'stockcat_management', 1, 1, 1, 0, 4, '2023-07-04 11:44:31', '2023-07-04 11:44:31'),
(54, 'shift_management', 1, 1, 1, 0, 4, '2023-07-04 11:44:50', '2023-07-04 11:44:45'),
(55, 'report', 1, 1, 1, 0, 4, '2023-07-04 11:45:00', '2023-07-04 11:45:00'),
(56, 'checklist', 1, 1, 1, 0, 4, '2023-07-04 11:45:14', '2023-07-04 11:45:14'),
(58, 'change_session', 1, 1, 1, 1, 2, '2023-07-05 05:21:27', '2023-07-05 05:18:35'),
(59, 'division_management', 1, 1, 1, 1, 2, '2023-07-07 05:21:35', '2023-07-07 05:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_account`
--

CREATE TABLE `sistms_account` (
  `id` int(11) NOT NULL,
  `account_username` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `account_telp` varchar(255) NOT NULL,
  `account_company` int(11) NOT NULL,
  `account_division` int(11) NOT NULL,
  `account_level` int(11) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `account_token` varchar(255) NOT NULL,
  `account_status` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_account`
--

INSERT INTO `sistms_account` (`id`, `account_username`, `account_name`, `account_email`, `account_telp`, `account_company`, `account_division`, `account_level`, `account_password`, `account_token`, `account_status`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'Administrator', 'admin@domain.com', '08123456789', 1, 1, 2, '$2y$10$ciNcPOLgd6mpyyXKtcRch.gJ.5ApZhoNCfkGXEQ0a/GahOEqmkFLW', 'sistematis_3d830f532eb9e0d3f1ab6dbeba854137', 1, '2023-07-11 00:22:48', '2023-06-28 06:36:44'),
(2, 'tester', 'tester', 'tester@tester.com', '123', 1, 1, 4, '$2y$10$9p5ftc5iU059MMVV7k5Fk.ylf4MabNe3D7IXvsqt8.PkCMGaM0nGO', '', 1, '2023-07-07 06:22:35', '2023-06-30 05:18:42'),
(6, 'vendor', 'Vendors', 'vendor@a.com', '08123', 3, 2, 5, '$2y$10$isyn2LYGl7mQ44je/XhVmOPn7MPADJ64JMt3TY3FnFQpLBLLPb5Yi', '', 1, '2023-07-08 20:22:49', '2023-07-04 02:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_checklist`
--

CREATE TABLE `sistms_checklist` (
  `id` int(11) NOT NULL,
  `checklist_name` varchar(255) NOT NULL,
  `checklist_desc` text NOT NULL,
  `checklist_device` int(11) NOT NULL,
  `checklist_division` int(11) NOT NULL,
  `checklist_shift` int(11) NOT NULL,
  `checklist_repeat` int(11) NOT NULL COMMENT '0=daily,1=weekly,2=montly,3=3month,4=6month',
  `checklist_repeat_info` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_checklist`
--

INSERT INTO `sistms_checklist` (`id`, `checklist_name`, `checklist_desc`, `checklist_device`, `checklist_division`, `checklist_shift`, `checklist_repeat`, `checklist_repeat_info`, `updated_at`, `created_at`) VALUES
(1, 'test daily 2', 'sdfsdfsdf', 0, 0, 1, 0, 0, '2023-07-02 23:58:53', '2023-07-01 20:22:32'),
(2, 'test daily 1', 'eh', 1, 0, 2, 0, 0, '2023-08-10 09:11:58', '2023-07-02 05:44:44'),
(3, 'test weekly sunday', 'test', 2, 0, 2, 0, 5, '2023-08-10 09:14:36', '2023-07-02 05:53:31'),
(4, 'test montly 2nd date', 'test', 1, 0, 3, 2, 2, '2023-07-11 16:15:21', '2023-07-02 05:56:38'),
(6, 'test vendor device daily', 'test', 3, 0, 2, 0, 0, '2023-08-10 09:12:03', '2023-07-04 03:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_checklist_data`
--

CREATE TABLE `sistms_checklist_data` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `checklist_status` int(11) NOT NULL,
  `checklist_actor` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_checklist_data`
--

INSERT INTO `sistms_checklist_data` (`id`, `checklist_id`, `checklist_status`, `checklist_actor`, `created_at`) VALUES
(6, 2, 0, 1, '2023-07-03 21:30:37'),
(7, 6, 0, 1, '2023-08-10 09:14:56'),
(8, 3, 1, 1, '2023-08-10 09:21:10'),
(9, 2, 0, 1, '2023-08-10 09:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_company`
--

CREATE TABLE `sistms_company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_location` varchar(255) NOT NULL,
  `company_info` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_company`
--

INSERT INTO `sistms_company` (`id`, `company_name`, `company_location`, `company_info`, `company_logo`) VALUES
(1, 'Pelindo Sub Regional 3', 'Jl Jamrud no 123', 'Pelindo Sub Regional 3', 'pelindo.png'),
(3, 'Googulu', 'JL Googulu surabaya', 'hehe', '24cf9ecab97f9afe2781ea23d04b8c55.png');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_device`
--

CREATE TABLE `sistms_device` (
  `id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `device_location` varchar(255) NOT NULL,
  `device_pic` varchar(255) NOT NULL,
  `device_company` int(11) NOT NULL,
  `device_status` int(11) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_device`
--

INSERT INTO `sistms_device` (`id`, `device_name`, `device_location`, `device_pic`, `device_company`, `device_status`, `updated_at`, `created_at`) VALUES
(1, '[vend] CCTV Pelabuhan 1', 'Pelabuhan 1', '', 3, 1, '2023-07-08 23:48:34', '2023-06-28 06:55:07'),
(2, 'CCTV Lambung Kapal 1', 'Kapal 1 Pelabuhan Jamrud', '', 1, 1, '2023-07-04 03:02:22', '2023-07-01 19:45:02'),
(3, '[vend] Kapal1', 'sdfdsfsffd', '', 3, 1, '2023-07-04 04:01:35', '2023-07-01 19:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_division`
--

CREATE TABLE `sistms_division` (
  `id` int(11) NOT NULL,
  `division_name` varchar(255) NOT NULL,
  `division_company` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_division`
--

INSERT INTO `sistms_division` (`id`, `division_name`, `division_company`, `updated_at`, `created_at`) VALUES
(1, 'Divisi Teknologi Informasi', 1, '2023-07-07 04:29:27', '2023-07-07 04:29:27'),
(2, 'Googulu', 3, '2023-07-07 06:04:34', '2023-07-07 06:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_incident`
--

CREATE TABLE `sistms_incident` (
  `id` int(11) NOT NULL,
  `incident_name` varchar(255) NOT NULL,
  `incident_status` int(11) NOT NULL,
  `incident_reporter` int(11) NOT NULL,
  `incident_device` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_incident`
--

INSERT INTO `sistms_incident` (`id`, `incident_name`, `incident_status`, `incident_reporter`, `incident_device`, `updated_at`, `created_at`) VALUES
(1, 'CCTV kotor', 2, 1, 1, '2023-07-03 06:50:47', '2023-06-28 06:55:33'),
(2, 'HP CEO rusak', 1, 1, 0, '2023-07-03 07:06:08', '2023-06-28 06:55:33'),
(10, 'Failure Checklist#4 ', 0, 1, 1, '2023-07-04 04:45:59', '2023-07-03 02:35:42'),
(11, 'Failure Checklist#2 (test daily 1)', 0, 1, 1, '2023-07-04 04:45:54', '2023-07-03 21:28:48'),
(12, 'Monitor display tidak menyala', 0, 1, 0, '2023-08-08 09:39:38', '2023-08-08 09:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_incident_log`
--

CREATE TABLE `sistms_incident_log` (
  `id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `incident_log_desc` text NOT NULL,
  `incident_log_actor` int(11) NOT NULL,
  `incident_log_status` int(11) NOT NULL,
  `incident_log_pic` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_incident_log`
--

INSERT INTO `sistms_incident_log` (`id`, `incident_id`, `incident_log_desc`, `incident_log_actor`, `incident_log_status`, `incident_log_pic`, `created_at`) VALUES
(1, 1, 'CCTV kotor dan perlu dibersihkan', 1, 0, '', '2023-07-01 18:00:21'),
(2, 2, 'bla blabla', 1, 0, '', '2023-07-01 18:00:21'),
(3, 2, 'test', 2, 0, '', '2023-07-01 18:49:10'),
(4, 2, 'sudah saya fix', 1, 1, '', '2023-07-01 19:06:24'),
(5, 7, 'test', 1, 0, '', '2023-07-02 23:56:49'),
(6, 8, 'risak', 1, 0, '', '2023-07-02 23:57:06'),
(7, 9, 'done', 1, 0, '', '2023-07-02 23:57:43'),
(8, 10, 'test', 1, 0, '', '2023-07-03 02:35:42'),
(9, 11, 'error bruh', 1, 0, '', '2023-07-03 21:28:48'),
(10, 12, 'di gedung GSN Lt. 1', 1, 1, '', '2023-08-08 09:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_login_log`
--

CREATE TABLE `sistms_login_log` (
  `id` int(11) NOT NULL,
  `login_account` int(11) NOT NULL,
  `login_status` int(11) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  `login_ua` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_login_log`
--

INSERT INTO `sistms_login_log` (`id`, `login_account`, `login_status`, `login_ip`, `login_ua`, `created_at`) VALUES
(5, 2, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0', '2023-07-03 23:59:53'),
(7, 2, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0', '2023-07-04 01:31:54'),
(8, 2, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0', '2023-07-04 01:54:50'),
(9, 6, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0', '2023-07-04 02:05:14'),
(11, 6, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0', '2023-07-04 02:11:55'),
(14, 6, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/114.0', '2023-07-04 03:15:10'),
(22, 2, 1, '127.128.79.210', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '2023-07-04 15:49:39'),
(31, 1, 1, '127.239.129.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-07 04:09:06'),
(32, 1, 1, '127.239.129.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-07 04:09:33'),
(33, 1, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-07 09:58:24'),
(34, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-07 09:58:28'),
(35, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 14:52:02'),
(36, 1, 1, '127.239.129.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 14:59:32'),
(37, 1, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 19:48:38'),
(38, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 19:48:44'),
(39, 1, 0, '127.239.129.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 20:50:18'),
(40, 1, 1, '127.239.129.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 20:50:22'),
(41, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 21:12:20'),
(42, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 21:12:27'),
(43, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 21:13:22'),
(44, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 21:14:45'),
(45, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 21:16:43'),
(46, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 21:17:59'),
(47, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 21:45:34'),
(48, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 22:39:01'),
(49, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 22:39:49'),
(50, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 22:41:12'),
(51, 1, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 22:41:18'),
(52, 1, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 22:41:21'),
(53, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 22:41:23'),
(54, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 22:42:14'),
(55, 1, 1, '127.6.52.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '2023-07-08 23:40:29'),
(56, 1, 1, '127.239.129.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-08 23:51:00'),
(57, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-09 03:56:18'),
(58, 1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-09 19:28:21'),
(59, 1, 1, '127.239.129.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-10 20:56:11'),
(60, 1, 1, '192.168.100.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-11 01:12:04'),
(61, 1, 1, '127.128.79.210', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '2023-07-11 01:15:20'),
(62, 1, 1, '192.168.100.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', '2023-07-11 05:13:54'),
(63, 1, 1, '192.168.100.47', 'Mozilla/5.0 (Android 12; Mobile; rv:109.0) Gecko/115.0 Firefox/115.0', '2023-08-02 20:43:12'),
(64, 1, 1, '127.92.31.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0', '2023-08-07 20:02:42'),
(65, 1, 1, '127.92.31.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0', '2023-08-07 20:10:50'),
(66, 1, 1, '127.92.31.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0', '2023-08-07 20:11:09'),
(67, 1, 1, '127.176.112.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-07 20:11:11'),
(68, 1, 1, '127.92.31.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0', '2023-08-07 20:13:05'),
(69, 1, 1, '127.176.112.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-07 20:14:46'),
(70, 1, 1, '127.176.112.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-07 20:31:37'),
(71, 1, 1, '127.107.218.28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-07 20:31:42'),
(72, 1, 1, '127.234.192.41', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_7_8 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6.6 Mobile/15E148 Safari/604.1', '2023-08-07 20:32:06'),
(73, 1, 1, '127.137.163.66', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Mobile Safari/537.36', '2023-08-07 20:34:54'),
(74, 1, 1, '127.3.134.53', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Safari/605.1.15', '2023-08-07 21:00:26'),
(75, 1, 1, '127.217.69.186', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Safari/605.1.15', '2023-08-08 07:44:31'),
(76, 1, 1, '127.26.33.166', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '2023-08-08 08:16:19'),
(77, 1, 1, '127.190.147.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Mobile Safari/537.36', '2023-08-08 08:22:51'),
(78, 1, 1, '192.168.100.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0', '2023-08-10 00:08:36'),
(79, 1, 1, '192.168.100.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0', '2023-08-10 03:39:11'),
(80, 1, 1, '192.168.100.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0', '2023-08-10 09:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_menu`
--

CREATE TABLE `sistms_menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_endpoint` varchar(255) NOT NULL,
  `menu_position` int(11) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_privilege` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_menu`
--

INSERT INTO `sistms_menu` (`id`, `menu_name`, `menu_icon`, `menu_endpoint`, `menu_position`, `menu_parent`, `menu_privilege`, `updated_at`, `created_at`) VALUES
(1, 'Dashboard', '<i class=\"far fa-tachometer-alt-fast\"></i>', '/', 1, 0, 2, '2023-06-29 19:49:10', '2023-06-29 18:04:18'),
(2, 'Management', '', '#', 2, 0, 2, '2023-06-29 19:49:12', '2023-06-29 18:04:18'),
(3, 'User Management', '<i class=\"far fa-users\"></i>', '#', 3, 0, 2, '2023-06-29 19:49:13', '2023-06-29 18:04:18'),
(4, 'Users', '', '/users', 1, 3, 2, '2023-06-29 19:49:14', '2023-06-29 18:04:18'),
(5, 'Privileges', '', '/privilege', 2, 3, 2, '2023-06-29 19:49:15', '2023-06-29 18:04:18'),
(6, 'Feature Access', '', '/access', 3, 3, 2, '2023-06-30 21:46:57', '2023-06-29 18:04:18'),
(7, 'Company', '<i class=\"far fa-building\"></i>', '/companys', 7, 0, 2, '2023-07-05 05:24:13', '2023-06-29 18:04:18'),
(8, 'Menu Management', '<i class=\"fad fa-bars\"></i>', '/menus', 4, 0, 2, '2023-06-30 23:14:41', '2023-06-29 18:04:18'),
(9, 'Shift Management', '<i class=\"fal fa-calendar-alt\"></i>', '#', 5, 0, 2, '2023-06-30 23:18:20', '2023-06-30 21:21:56'),
(11, 'Operational', '', '#', 9, 0, 2, '2023-07-01 19:42:47', '2023-06-30 23:15:16'),
(12, 'Shift', '', '/shifts', 1, 9, 2, '2023-06-30 23:16:37', '2023-06-30 23:16:06'),
(13, 'Employee Shift', '', '/shift', 2, 9, 2, '2023-06-30 23:16:33', '2023-06-30 23:16:33'),
(14, 'Stock', '<i class=\"far fa-box-open\"></i>', '/stock', 10, 0, 2, '2023-07-01 19:42:52', '2023-07-01 05:10:08'),
(15, 'Stock Types', '<i class=\"far fa-tags\"></i>', '/stockcat', 8, 0, 2, '2023-07-01 19:42:43', '2023-07-01 05:59:22'),
(16, 'Operational', '', '#', 2, 0, 4, '2023-07-01 08:23:33', '2023-07-01 08:04:58'),
(17, 'Dashboard', '<i class=\"far fa-tachometer-alt-fast\"></i>', '/', 1, 0, 4, '2023-07-01 08:23:32', '2023-07-01 08:05:07'),
(18, 'Company Management', '<i class=\"far fa-building\"></i>', '/companys', 3, 0, 4, '2023-07-04 02:20:47', '2023-07-01 08:05:40'),
(19, 'Stock', '<i class=\"far fa-box-open\"></i>', '/stock', 4, 0, 4, '2023-07-01 09:19:15', '2023-07-01 09:19:15'),
(20, 'Incident', '<i class=\"far fa-flag\"></i>', '/incident', 11, 0, 2, '2023-07-01 19:42:56', '2023-07-01 11:18:21'),
(21, 'Devices', '<i class=\"far fa-phone-laptop\"></i>', '/device', 6, 0, 2, '2023-07-01 19:42:33', '2023-07-01 19:42:33'),
(22, 'Checklist Management', '<i class=\"fas fa-tasks\"></i>', '/checklists', 7, 0, 2, '2023-07-01 20:13:34', '2023-07-01 20:13:34'),
(23, 'Checklist', '<i class=\"fas fa-tasks\"></i>', '/checklist', 12, 0, 2, '2023-07-02 05:30:55', '2023-07-02 05:30:55'),
(24, 'Reports', '<i class=\"far fa-print\"></i>', '/report', 13, 0, 2, '2023-07-02 23:46:27', '2023-07-02 23:46:03'),
(25, 'Dashboard', '<i class=\"far fa-tachometer-alt-fast\"></i>', '/', 1, 0, 1, '2023-06-29 19:49:10', '2023-06-29 18:04:18'),
(26, 'Management', '', '#', 2, 0, 1, '2023-06-29 19:49:12', '2023-06-29 18:04:18'),
(27, 'User Management', '<i class=\"far fa-users\"></i>', '#', 3, 0, 1, '2023-06-29 19:49:13', '2023-06-29 18:04:18'),
(28, 'Users', '', '/users', 1, 27, 1, '2023-07-03 23:59:25', '2023-06-29 18:04:18'),
(29, 'Privileges', '', '/privilege', 2, 27, 1, '2023-07-03 23:59:27', '2023-06-29 18:04:18'),
(30, 'Feature Access', '', '/access', 3, 27, 1, '2023-07-03 23:59:28', '2023-06-29 18:04:18'),
(31, 'Company Management', '<i class=\"far fa-building\"></i>', '/companys', 7, 0, 1, '2023-07-04 02:20:34', '2023-06-29 18:04:18'),
(32, 'Menu Management', '<i class=\"fad fa-bars\"></i>', '/menus', 4, 0, 1, '2023-06-30 23:14:41', '2023-06-29 18:04:18'),
(33, 'Shift Management', '<i class=\"fal fa-calendar-alt\"></i>', '#', 5, 0, 1, '2023-07-03 23:57:57', '2023-06-30 21:21:56'),
(34, 'Operational', '', '#', 9, 0, 1, '2023-07-01 19:42:47', '2023-06-30 23:15:16'),
(35, 'Shift', '', '/shifts', 1, 33, 1, '2023-07-03 23:58:23', '2023-06-30 23:16:06'),
(36, 'Employee Shift', '', '/shift', 2, 33, 1, '2023-07-03 23:58:24', '2023-06-30 23:16:33'),
(37, 'Stock', '<i class=\"far fa-box-open\"></i>', '/stock', 10, 0, 1, '2023-07-01 19:42:52', '2023-07-01 05:10:08'),
(38, 'Stock Types', '<i class=\"far fa-tags\"></i>', '/stockcat', 8, 0, 1, '2023-07-01 19:42:43', '2023-07-01 05:59:22'),
(39, 'Incident', '<i class=\"far fa-flag\"></i>', '/incident', 11, 0, 1, '2023-07-01 19:42:56', '2023-07-01 11:18:21'),
(40, 'Devices', '<i class=\"far fa-phone-laptop\"></i>', '/device', 6, 0, 1, '2023-07-01 19:42:33', '2023-07-01 19:42:33'),
(41, 'Checklist Management', '<i class=\"fas fa-tasks\"></i>', '/checklists', 7, 0, 1, '2023-07-01 20:13:34', '2023-07-01 20:13:34'),
(42, 'Checklist', '<i class=\"fas fa-tasks\"></i>', '/checklist', 12, 0, 1, '2023-07-02 05:30:55', '2023-07-02 05:30:55'),
(43, 'Reports', '<i class=\"far fa-print\"></i>', '/report', 13, 0, 1, '2023-07-02 23:46:27', '2023-07-02 23:46:03'),
(44, 'Incident', '<i class=\"far fa-flag\"></i>', '/incident', 3, 0, 5, '2023-07-04 02:08:42', '2023-07-01 11:18:21'),
(45, 'Checklist', '<i class=\"fas fa-tasks\"></i>', '/checklist', 4, 0, 5, '2023-07-04 02:08:44', '2023-07-02 05:30:55'),
(46, 'Reports', '<i class=\"far fa-print\"></i>', '/report', 5, 0, 5, '2023-07-04 02:08:47', '2023-07-02 23:46:03'),
(47, 'Operational', '', '#', 2, 0, 5, '2023-07-04 02:09:34', '2023-07-04 02:09:34'),
(48, 'Dashboard', '<i class=\"far fa-tachometer-alt-fast\"></i>', '/', 1, 0, 5, '2023-07-04 02:11:45', '2023-07-04 02:11:45'),
(49, 'Company', '<i class=\"far fa-building\"></i>', '/company', 3, 0, 5, '2023-07-04 02:20:47', '2023-07-01 08:05:40'),
(50, 'Devices', '<i class=\"far fa-phone-laptop\"></i>', '/device', 6, 0, 5, '2023-07-04 03:14:31', '2023-07-04 03:14:16'),
(51, 'Dashboard', '<i class=\"far fa-tachometer-alt-fast\"></i>', '/', 1, 0, 3, '2023-06-29 19:49:10', '2023-06-29 18:04:18'),
(52, 'Management', '', '#', 2, 0, 3, '2023-06-29 19:49:12', '2023-06-29 18:04:18'),
(53, 'User Management', '<i class=\"far fa-users\"></i>', '#', 3, 0, 3, '2023-06-29 19:49:13', '2023-06-29 18:04:18'),
(54, 'Users', '', '/users', 1, 53, 3, '2023-07-04 04:17:56', '2023-06-29 18:04:18'),
(55, 'Privileges', '', '/privilege', 2, 53, 3, '2023-07-04 04:17:59', '2023-06-29 18:04:18'),
(56, 'Feature Access', '', '/access', 3, 53, 3, '2023-07-04 04:18:01', '2023-06-29 18:04:18'),
(57, 'Company', '<i class=\"far fa-building\"></i>', '/company', 7, 0, 3, '2023-07-01 19:42:39', '2023-06-29 18:04:18'),
(58, 'Menu Management', '<i class=\"fad fa-bars\"></i>', '/menus', 4, 0, 3, '2023-06-30 23:14:41', '2023-06-29 18:04:18'),
(59, 'Shift Management', '<i class=\"fal fa-calendar-alt\"></i>', '#', 5, 0, 3, '2023-06-30 23:18:20', '2023-06-30 21:21:56'),
(60, 'Operational', '', '#', 9, 0, 3, '2023-07-01 19:42:47', '2023-06-30 23:15:16'),
(61, 'Shift', '', '/shifts', 1, 58, 3, '2023-07-04 04:18:18', '2023-06-30 23:16:06'),
(62, 'Employee Shift', '', '/shift', 2, 58, 3, '2023-07-04 04:18:19', '2023-06-30 23:16:33'),
(63, 'Stock', '<i class=\"far fa-box-open\"></i>', '/stock', 10, 0, 3, '2023-07-01 19:42:52', '2023-07-01 05:10:08'),
(64, 'Stock Types', '<i class=\"far fa-tags\"></i>', '/stockcat', 8, 0, 3, '2023-07-01 19:42:43', '2023-07-01 05:59:22'),
(65, 'Incident', '<i class=\"far fa-flag\"></i>', '/incident', 11, 0, 3, '2023-07-01 19:42:56', '2023-07-01 11:18:21'),
(66, 'Devices', '<i class=\"far fa-phone-laptop\"></i>', '/device', 6, 0, 3, '2023-07-01 19:42:33', '2023-07-01 19:42:33'),
(67, 'Checklist Management', '<i class=\"fas fa-tasks\"></i>', '/checklists', 7, 0, 3, '2023-07-01 20:13:34', '2023-07-01 20:13:34'),
(68, 'Checklist', '<i class=\"fas fa-tasks\"></i>', '/checklist', 12, 0, 3, '2023-07-02 05:30:55', '2023-07-02 05:30:55'),
(69, 'Reports', '<i class=\"far fa-print\"></i>', '/report', 13, 0, 3, '2023-07-02 23:46:27', '2023-07-02 23:46:03'),
(70, 'Division', '', '/division', 4, 3, 2, '2023-07-07 04:55:58', '2023-07-07 04:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_message`
--

CREATE TABLE `sistms_message` (
  `id` int(11) NOT NULL,
  `msg_sender` int(11) NOT NULL,
  `msg_receiver` int(11) NOT NULL,
  `msg_content` text NOT NULL,
  `msg_reply` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sistms_notif`
--

CREATE TABLE `sistms_notif` (
  `id` int(11) NOT NULL,
  `notif_sender` varchar(255) NOT NULL,
  `notif_title` varchar(255) NOT NULL,
  `notif_text` text NOT NULL,
  `notif_read` int(11) NOT NULL DEFAULT '0',
  `notif_target` int(11) NOT NULL,
  `notif_click` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_notif`
--

INSERT INTO `sistms_notif` (`id`, `notif_sender`, `notif_title`, `notif_text`, `notif_read`, `notif_target`, `notif_click`, `created_at`) VALUES
(1, 'system-incident', 'New Incident', 'Incident Create while you away, click this notif to read', 1, 1, '/incident', '2023-07-04 04:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_privilege`
--

CREATE TABLE `sistms_privilege` (
  `id` int(11) NOT NULL,
  `privilege_name` varchar(255) NOT NULL,
  `privilege_extra_ses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_privilege`
--

INSERT INTO `sistms_privilege` (`id`, `privilege_name`, `privilege_extra_ses`) VALUES
(1, 'Developer', 0),
(2, 'Administrator', 0),
(3, 'Kabag', 0),
(4, 'Employee', 0),
(5, 'Vendor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sistms_schedule`
--

CREATE TABLE `sistms_schedule` (
  `id` int(11) NOT NULL,
  `schedule_account` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_shift` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_schedule`
--

INSERT INTO `sistms_schedule` (`id`, `schedule_account`, `schedule_date`, `schedule_shift`) VALUES
(1, 1, '2023-06-29', 2),
(2, 1, '2023-06-28', 1),
(3, 2, '2023-06-28', 2),
(7, 1, '2023-07-02', 3),
(8, 2, '2023-07-02', 1),
(10, 1, '2023-07-03', 1),
(12, 2, '2023-07-04', 1),
(13, 6, '2023-07-04', 1),
(14, 1, '2023-07-04', 4),
(15, 2, '2023-07-05', 2),
(16, 1, '2023-07-05', 4),
(17, 1, '2023-07-07', 2),
(18, 2, '2023-07-07', 4),
(19, 1, '2023-07-11', 3),
(20, 2, '2023-07-11', 3),
(21, 6, '2023-07-11', 3),
(22, 1, '2023-08-10', 2),
(23, 1, '2023-08-10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sistms_shift`
--

CREATE TABLE `sistms_shift` (
  `id` int(11) NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `shift_division` int(11) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL,
  `shift_color` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_shift`
--

INSERT INTO `sistms_shift` (`id`, `shift_name`, `shift_division`, `shift_start`, `shift_end`, `shift_color`) VALUES
(1, 'Shift 1', 0, '00:00:00', '08:00:00', '#ff8000'),
(2, 'Shift 2', 0, '08:00:00', '16:00:00', '#008000'),
(3, 'Shift 3', 0, '16:00:00', '00:00:00', '#8080ff'),
(4, 'Non Shift', 0, '08:00:00', '17:00:00', '#00ffff');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_stock`
--

CREATE TABLE `sistms_stock` (
  `id` int(11) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `stock_desc` text NOT NULL,
  `stock_location` varchar(255) NOT NULL,
  `stock_type` int(11) NOT NULL,
  `stock_division` int(11) NOT NULL,
  `stock_pic` varchar(255) NOT NULL,
  `stock_code` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_stock`
--

INSERT INTO `sistms_stock` (`id`, `stock_name`, `stock_desc`, `stock_location`, `stock_type`, `stock_division`, `stock_pic`, `stock_code`, `updated_at`, `created_at`) VALUES
(1, 'barang 1', 'sfghjsioldfjsd\nfsd\nfsd\nfs\ndfsdlkflksdfsdfsd', 'rak 1', 1, 1, '', 'a1d234', '2023-07-07 04:30:15', '2023-07-01 05:48:07'),
(2, 'Bata 1kg', 'aaa', 'aaaa', 2, 1, '', '', '2023-07-07 10:09:15', '2023-07-01 05:53:52'),
(3, 'HDD merk WDC', '', 'RAK 10', 4, 0, '', '', '2023-08-08 08:54:51', '2023-08-08 08:54:51'),
(4, 'HDD merk WD Blue', '', 'RAK 10', 4, 0, '', '', '2023-08-08 08:56:03', '2023-08-08 08:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_stock_io`
--

CREATE TABLE `sistms_stock_io` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `stock_status` int(11) NOT NULL COMMENT '0 = out ,1 =in',
  `stock_value` int(11) NOT NULL,
  `stock_reason` text NOT NULL,
  `stock_actor` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_stock_io`
--

INSERT INTO `sistms_stock_io` (`id`, `stock_id`, `stock_status`, `stock_value`, `stock_reason`, `stock_actor`, `created_at`) VALUES
(1, 1, 1, 5, 'initial stock data', 1, '2023-06-28 06:37:32'),
(2, 1, 0, 2, 'buat itu', 1, '2023-06-28 06:37:32'),
(3, 2, 1, 2, 'initial stock data', 1, '2023-07-01 05:53:52'),
(4, 2, 1, 5, 'pengadaan', 1, '2023-07-01 06:33:21'),
(5, 2, 0, 4, 'buat pelabuhan', 1, '2023-07-01 06:35:43'),
(6, 2, 1, 2, 'dari si dia', 1, '2023-07-01 06:53:35'),
(7, 1, 0, 3, 'untuk harian', 1, '2023-07-04 17:52:35'),
(8, 1, 1, 1, 'calibrasi', 1, '2023-07-04 17:52:57'),
(9, 1, 0, 1, 'buat kapal ', 1, '2023-07-07 04:12:25'),
(10, 1, 1, 2, 'pengadaan', 1, '2023-07-07 10:09:01'),
(11, 3, 1, 1, 'Initial Stock Data', 1, '2023-08-08 08:54:51'),
(12, 4, 1, 5, 'Initial Stock Data', 1, '2023-08-08 08:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `sistms_stock_type`
--

CREATE TABLE `sistms_stock_type` (
  `id` int(11) NOT NULL,
  `stock_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sistms_stock_type`
--

INSERT INTO `sistms_stock_type` (`id`, `stock_type_name`) VALUES
(1, 'Electric Devices'),
(2, 'Materials'),
(3, 'Medical Devices'),
(4, 'Maintenance');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sistms_access`
--
ALTER TABLE `sistms_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_account`
--
ALTER TABLE `sistms_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_checklist`
--
ALTER TABLE `sistms_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_checklist_data`
--
ALTER TABLE `sistms_checklist_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_company`
--
ALTER TABLE `sistms_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_device`
--
ALTER TABLE `sistms_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_division`
--
ALTER TABLE `sistms_division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_incident`
--
ALTER TABLE `sistms_incident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_incident_log`
--
ALTER TABLE `sistms_incident_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_login_log`
--
ALTER TABLE `sistms_login_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_menu`
--
ALTER TABLE `sistms_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_message`
--
ALTER TABLE `sistms_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_notif`
--
ALTER TABLE `sistms_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_privilege`
--
ALTER TABLE `sistms_privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_schedule`
--
ALTER TABLE `sistms_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_shift`
--
ALTER TABLE `sistms_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_stock`
--
ALTER TABLE `sistms_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_stock_io`
--
ALTER TABLE `sistms_stock_io`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistms_stock_type`
--
ALTER TABLE `sistms_stock_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sistms_access`
--
ALTER TABLE `sistms_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `sistms_account`
--
ALTER TABLE `sistms_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sistms_checklist`
--
ALTER TABLE `sistms_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sistms_checklist_data`
--
ALTER TABLE `sistms_checklist_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sistms_company`
--
ALTER TABLE `sistms_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sistms_device`
--
ALTER TABLE `sistms_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sistms_division`
--
ALTER TABLE `sistms_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sistms_incident`
--
ALTER TABLE `sistms_incident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sistms_incident_log`
--
ALTER TABLE `sistms_incident_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sistms_login_log`
--
ALTER TABLE `sistms_login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `sistms_menu`
--
ALTER TABLE `sistms_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `sistms_message`
--
ALTER TABLE `sistms_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sistms_notif`
--
ALTER TABLE `sistms_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sistms_privilege`
--
ALTER TABLE `sistms_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sistms_schedule`
--
ALTER TABLE `sistms_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sistms_shift`
--
ALTER TABLE `sistms_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sistms_stock`
--
ALTER TABLE `sistms_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sistms_stock_io`
--
ALTER TABLE `sistms_stock_io`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sistms_stock_type`
--
ALTER TABLE `sistms_stock_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
