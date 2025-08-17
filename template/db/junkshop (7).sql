-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2025 at 07:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `junkshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '''0=unread, 1=read''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `collector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_notification`
--

INSERT INTO `admin_notification` (`id`, `loan_id`, `admin_id`, `message`, `status`, `created_at`, `collector_id`) VALUES
(242, 63, 3, 'Your loan has been confirmed.', 1, '2025-05-30 02:39:55', 36),
(243, 63, 3, 'Your loan has been released.', 1, '2025-05-30 02:40:02', 36),
(244, 63, 3, 'Your loan has been marked as completed.', 1, '2025-05-30 02:40:04', 36),
(245, 64, 3, 'Your loan has been confirmed.', 0, '2025-05-30 06:00:31', 10),
(246, 64, 3, 'Your loan has been released.', 0, '2025-05-30 06:00:34', 10),
(247, 64, 3, 'Your loan has been marked as completed.', 0, '2025-05-30 06:00:37', 10),
(248, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-02 12:24:06', 43),
(249, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-02 12:24:33', 43),
(250, 79, 3, 'Your loan has been confirmed.', 1, '2025-06-02 16:08:11', 36),
(251, 79, 3, 'Your loan has been released.', 1, '2025-06-02 16:08:14', 36),
(252, 79, 3, 'Your loan has been marked as completed.', 1, '2025-06-02 16:08:16', 36),
(253, 81, 3, 'Your loan has been confirmed.', 1, '2025-06-04 01:10:39', 36),
(254, 81, 3, 'Your loan has been released.', 1, '2025-06-04 01:11:26', 36),
(255, 81, 3, 'Your loan has been marked as completed.', 1, '2025-06-04 01:11:31', 36),
(256, 78, 3, 'Your loan has been confirmed.', 0, '2025-06-05 07:40:33', 32),
(257, 78, 3, 'Your loan has been released.', 0, '2025-06-05 07:40:40', 32),
(258, 82, 3, 'Your loan has been confirmed.', 0, '2025-06-05 07:46:15', 32),
(259, 82, 3, 'Your loan has been released.', 0, '2025-06-05 07:46:58', 32),
(260, 82, 3, 'Your loan has been marked as completed.', 0, '2025-06-05 07:47:11', 32),
(261, 83, 3, 'Your loan has been confirmed.', 1, '2025-06-05 07:48:32', 35),
(262, 83, 3, 'Your loan has been released.', 1, '2025-06-05 07:48:37', 35),
(263, 83, 3, 'Your loan has been marked as completed.', 1, '2025-06-05 07:48:43', 35),
(264, 84, 3, 'Your loan has been confirmed.', 1, '2025-06-05 08:13:40', 36),
(265, 87, 3, 'Your loan has been confirmed.', 0, '2025-06-05 09:30:23', 32),
(266, 87, 3, 'Your loan has been released.', 0, '2025-06-05 13:11:46', 32),
(267, 90, 3, 'Your loan has been confirmed.', 1, '2025-06-05 13:53:26', 35),
(268, 90, 3, 'Your loan has been released.', 1, '2025-06-05 13:53:35', 35),
(269, 90, 3, 'Your loan has been marked as completed.', 1, '2025-06-05 13:53:42', 35),
(270, 93, 3, 'Your loan has been confirmed.', 0, '2025-06-08 11:10:45', 32),
(271, 93, 3, 'Your loan has been released.', 0, '2025-06-08 11:10:48', 32),
(272, 92, 3, 'Your loan has been confirmed.', 0, '2025-06-08 11:12:26', 32),
(273, 92, 3, 'Your loan has been released.', 0, '2025-06-08 11:12:29', 32),
(274, 91, 3, 'Your loan has been confirmed.', 0, '2025-06-08 11:15:45', 32),
(275, 93, 3, 'Your loan has been marked as completed.', 0, '2025-06-08 11:17:08', 32),
(276, 92, 3, 'Your loan has been marked as completed.', 0, '2025-06-08 11:17:49', 32),
(277, 91, 3, 'Your loan has been released.', 0, '2025-06-08 11:18:25', 32),
(278, 91, 3, 'Your loan has been marked as completed.', 0, '2025-06-08 11:18:28', 32);

-- --------------------------------------------------------

--
-- Table structure for table `approved_collectors`
--

CREATE TABLE `approved_collectors` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `approved_at` datetime NOT NULL DEFAULT current_timestamp(),
  `completed_at` datetime NOT NULL DEFAULT current_timestamp(),
  `declined_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `borrower_id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `tax_id` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`borrower_id`, `collector_id`, `tax_id`, `admin_id`) VALUES
(20, 32, '1231313', 0),
(21, 35, '12', 0),
(23, 1, '123123', 0),
(25, 10, '1232313', 0),
(27, 35, '3243424', 0),
(28, 1, '[op', 0),
(29, 35, '123', 0),
(30, 1, '1', 0),
(31, 32, '21323', 0),
(32, 1, '000000000', 0),
(33, 1, 'PPPPP', 0),
(34, 36, '312113', 0),
(35, 0, '12332132', 3),
(36, 43, '1234213', 0);

-- --------------------------------------------------------

--
-- Table structure for table `collector_notification`
--

CREATE TABLE `collector_notification` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '''0=unread, 1=read''',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `pickup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collector_notification`
--

INSERT INTO `collector_notification` (`id`, `loan_id`, `admin_id`, `message`, `status`, `created_at`, `customer_id`, `pickup_id`) VALUES
(166, 0, 0, 'Your pickup request has been approved.', 1, '2025-05-29 21:35:32', 41, 0),
(167, 0, 0, 'Your pickup request has been approved.', 1, '2025-05-29 21:35:36', 41, 0),
(168, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-05-30 07:40:57', 41, 0),
(169, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-05-30 09:29:47', 46, 0),
(170, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-02 21:18:18', 41, 0),
(171, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-02 21:18:38', 41, 0),
(172, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-02 21:19:18', 41, 0),
(173, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-03 21:56:32', 47, 0),
(174, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-03 23:06:44', 47, 0),
(175, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-05 12:09:54', 51, 0),
(176, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-06 11:31:38', 47, 0),
(177, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-08 16:39:34', 47, 0),
(178, 0, 0, 'Your pickup request has been approved.', 0, '2025-06-08 17:25:16', 49, 0),
(179, 0, 0, 'Your pickup request has been marked as completed.', 0, '2025-06-08 17:25:26', 49, 0),
(180, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-08 17:25:34', 47, 0),
(181, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-08 17:25:46', 47, 0),
(182, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-08 17:25:48', 47, 0),
(183, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-08 17:25:54', 47, 0),
(184, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-08 17:27:11', 47, 0),
(185, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-09 13:03:55', 47, 0),
(186, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-10 18:00:49', 47, 0),
(187, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-10 18:06:02', 47, 0),
(188, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-10 18:26:10', 47, 0),
(189, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-10 18:26:25', 47, 0),
(190, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-10 18:32:28', 47, 0),
(191, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-10 18:35:36', 47, 0),
(192, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-12 12:32:42', 46, 0),
(193, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-12 12:33:05', 46, 0),
(194, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-12 12:33:20', 46, 0),
(195, 0, 0, 'Your pickup request has been approved.', 1, '2025-06-12 12:35:31', 46, 0),
(196, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-06-12 12:35:46', 46, 0),
(197, 0, 0, 'Your pickup request has been approved.', 0, '2025-07-06 11:52:40', 57, 0),
(198, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-07-08 21:55:39', 48, 0),
(199, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-08-04 22:19:54', 74, 0),
(200, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-08-04 22:23:46', 74, 0),
(201, 0, 0, 'Your pickup request has been marked as completed.', 1, '2025-08-04 22:45:56', 74, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_notification`
--

CREATE TABLE `customer_notification` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '''0=unread, 1=read''',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `collector_id` int(11) NOT NULL,
  `pickup_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_notification`
--

INSERT INTO `customer_notification` (`id`, `loan_id`, `admin_id`, `message`, `status`, `created_at`, `collector_id`, `pickup_id`, `customer_id`) VALUES
(121, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 20:53:37', 10, 0, 41),
(122, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 20:55:40', 1, 0, 41),
(123, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 20:57:17', 10, 0, 41),
(124, 0, 0, 'Pickup request from customer.', 1, '2025-06-02 20:57:41', 36, 0, 41),
(125, 0, 0, 'Pickup request from customer.', 1, '2025-06-02 21:05:55', 36, 0, 41),
(126, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:06:06', 10, 0, 41),
(127, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:07:50', 10, 0, 41),
(128, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:09:33', 32, 0, 41),
(129, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:09:37', 32, 0, 41),
(130, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:10:17', 1, 0, 41),
(131, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:11:27', 1, 0, 41),
(132, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:11:30', 1, 0, 41),
(133, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:11:51', 1, 0, 41),
(134, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:12:05', 1, 0, 41),
(135, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:12:09', 1, 0, 41),
(136, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:12:21', 1, 0, 41),
(137, 0, 0, 'Pickup request from customer.', 1, '2025-06-02 21:12:31', 36, 0, 41),
(138, 0, 0, 'Pickup request from customer.', 0, '2025-06-02 21:17:09', 10, 0, 41),
(139, 0, 0, 'Pickup request from customer.', 1, '2025-06-02 21:17:36', 36, 0, 41),
(140, 0, 0, 'Pickup request from customer.', 1, '2025-06-02 21:17:41', 36, 0, 41),
(141, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:28:49', 1, 0, 0),
(142, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:29:32', 1, 0, 0),
(143, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:29:54', 1, 0, 0),
(144, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:33:26', 1, 0, 0),
(145, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:33:59', 1, 0, 0),
(146, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:36:40', 1, 0, 0),
(147, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:38:00', 1, 0, 0),
(148, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:38:44', 1, 0, 0),
(149, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:40:20', 1, 0, 0),
(150, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:42:16', 1, 0, 0),
(151, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:42:51', 1, 0, 0),
(152, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:43:33', 1, 0, 0),
(153, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:48:06', 1, 0, 0),
(154, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:48:30', 1, 0, 0),
(155, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:48:43', 1, 0, 0),
(156, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:49:20', 1, 0, 0),
(157, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:54:11', 1, 0, 0),
(158, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:54:50', 1, 0, 0),
(159, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 21:55:49', 1, 0, 0),
(160, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 21:56:19', 36, 0, 47),
(161, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:30:45', 36, 0, 47),
(162, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:33:30', 10, 0, 47),
(163, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:34:15', 10, 0, 47),
(164, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:34:34', 10, 0, 47),
(165, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:34:50', 10, 0, 47),
(166, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:35:33', 10, 0, 47),
(167, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:35:45', 36, 0, 47),
(168, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:36:10', 36, 0, 47),
(169, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:36:46', 36, 0, 47),
(170, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:37:07', 36, 0, 47),
(171, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:38:37', 36, 0, 47),
(172, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:39:06', 36, 0, 47),
(173, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 22:39:12', 36, 0, 47),
(174, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:39:59', 44, 0, 47),
(175, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:40:43', 44, 0, 47),
(176, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:40:56', 44, 0, 47),
(177, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:41:05', 44, 0, 47),
(178, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:41:52', 44, 0, 47),
(179, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:45:32', 44, 0, 47),
(180, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:45:52', 44, 0, 47),
(181, 0, 0, 'Pickup request from customer.', 0, '2025-06-03 22:49:00', 44, 0, 47),
(182, 0, 0, 'Pickup request from customer.', 1, '2025-06-03 23:02:00', 36, 0, 47),
(183, 0, 0, 'Pickup request from customer.', 0, '2025-06-04 06:41:44', 10, 0, 47),
(184, 0, 0, 'Pickup request from customer.', 1, '2025-06-04 07:58:30', 36, 0, 47),
(185, 0, 0, 'Pickup request from customer.', 1, '2025-06-04 18:51:10', 36, 0, 47),
(186, 0, 0, 'Pickup request from customer.', 0, '2025-06-04 20:49:19', 10, 0, 47),
(187, 0, 0, 'Pickup request from customer.', 0, '2025-06-05 10:47:08', 44, 0, 41),
(188, 0, 0, 'Pickup request from customer.', 1, '2025-06-05 10:52:49', 43, 0, 41),
(189, 0, 0, 'Pickup request from customer.', 0, '2025-06-05 10:53:13', 1, 0, 41),
(190, 0, 0, 'Pickup request from customer.', 1, '2025-06-05 10:58:21', 35, 0, 47),
(191, 0, 0, 'Pickup request from customer.', 1, '2025-06-05 11:23:20', 36, 0, 48),
(192, 0, 0, 'Pickup request from customer.', 1, '2025-06-05 11:36:44', 36, 0, 49),
(193, 0, 0, 'Pickup request from customer.', 1, '2025-06-05 11:43:35', 36, 0, 51),
(194, 0, 0, 'Pickup request from customer.', 0, '2025-06-05 22:07:46', 44, 0, 52),
(195, 0, 0, 'Pickup request from customer.', 1, '2025-06-08 16:38:57', 36, 0, 47),
(196, 0, 0, 'Pickup request from customer.', 1, '2025-06-08 16:45:12', 36, 0, 47),
(197, 0, 0, 'Pickup request from customer.', 1, '2025-06-08 16:49:04', 36, 0, 47),
(198, 0, 0, 'Pickup request from customer.', 1, '2025-06-08 17:20:37', 36, 0, 49),
(199, 0, 0, 'Pickup request from customer.', 0, '2025-06-09 13:02:50', 44, 0, 47),
(200, 0, 0, 'Pickup request from customer.', 1, '2025-06-09 13:03:23', 36, 0, 47),
(201, 0, 0, 'Pickup request from customer.', 0, '2025-06-10 07:32:59', 44, 0, 47),
(202, 0, 0, 'Pickup request from customer.', 1, '2025-06-10 07:37:43', 36, 0, 47),
(203, 0, 0, 'Pickup request from customer.', 1, '2025-06-10 17:59:51', 36, 0, 47),
(204, 0, 0, 'Pickup request from customer.', 1, '2025-06-10 18:05:47', 36, 0, 47),
(205, 0, 0, 'Pickup request from customer.', 1, '2025-06-10 18:25:29', 36, 0, 47),
(206, 0, 0, 'Pickup request from customer.', 0, '2025-06-10 18:56:52', 44, 0, 47),
(207, 0, 0, 'Pickup request from customer.', 1, '2025-06-12 11:55:19', 36, 0, 46),
(208, 0, 0, 'Pickup request from customer.', 0, '2025-06-12 12:32:07', 44, 0, 46),
(209, 0, 0, 'Pickup request from customer.', 0, '2025-06-12 12:32:54', 44, 0, 46),
(210, 0, 0, 'Pickup request from customer.', 0, '2025-06-12 12:35:51', 44, 0, 46),
(211, 0, 0, 'Pickup request from customer.', 1, '2025-07-06 11:51:42', 35, 0, 57),
(212, 0, 0, 'Pickup request from customer.', 0, '2025-07-08 21:54:32', 1, 0, 48),
(213, 0, 0, 'Pickup request from customer.', 1, '2025-07-08 21:54:55', 43, 0, 48),
(214, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:04:45', 35, 0, 72),
(215, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:04:45', 43, 0, 72),
(216, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:04:45', 43, 0, 72),
(217, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:09:54', 35, 0, 72),
(218, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:10:52', 35, 0, 72),
(219, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:12:01', 35, 0, 72),
(220, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:12:01', 43, 0, 72),
(221, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:12:43', 35, 0, 72),
(222, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:12:43', 43, 0, 72),
(223, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:23:25', 35, 0, 72),
(224, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:23:25', 43, 0, 72),
(225, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:23:25', 43, 0, 72),
(226, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:24:05', 35, 0, 72),
(227, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:24:05', 43, 0, 72),
(228, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:24:05', 43, 0, 72),
(229, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:25:58', 35, 0, 72),
(230, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:25:58', 43, 0, 72),
(231, 0, 0, 'Pickup request from customer.', 0, '2025-08-04 20:25:58', 43, 0, 72),
(232, 0, 0, 'Pickup request from customer.', 1, '2025-08-04 20:51:00', 76, 0, 74),
(233, 0, 0, 'Pickup request from customer.', 1, '2025-08-04 20:51:00', 76, 0, 74),
(234, 0, 0, 'Pickup request from Gilmar with multiple junk types.', 1, '2025-08-04 20:58:43', 76, 0, 74),
(235, 0, 0, 'Pickup request from Gilmar with multiple junk types.', 1, '2025-08-04 21:05:22', 76, 0, 74),
(236, 0, 0, 'Pickup request from Gilmar with multiple junk types.', 1, '2025-08-04 21:11:24', 76, 0, 74),
(237, 0, 0, 'Pickup request from Gilmar with multiple junk types.', 1, '2025-08-04 22:02:45', 76, 0, 74),
(238, 0, 0, 'Pickup request from Gilmar with multiple junk types.', 1, '2025-08-04 22:05:02', 76, 0, 74),
(239, 0, 0, 'Pickup request from Gilmar with multiple junk types.', 1, '2025-08-04 22:07:25', 76, 0, 74),
(240, 0, 0, 'Pickup request from Gilmar with multiple junk types.', 1, '2025-08-04 22:22:18', 76, 0, 74),
(241, 0, 0, 'Pickup request from customer.', 1, '2025-08-04 22:45:24', 76, 0, 74);

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `collector_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pickup_id` int(11) NOT NULL COMMENT 'completed',
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentation`
--

INSERT INTO `documentation` (`id`, `description`, `review`, `image`, `created_at`, `collector_id`, `customer_id`, `pickup_id`, `admin_id`) VALUES
(89, '', '', '', '2025-06-10 10:06:16', 36, 47, 0, 0),
(90, '', '', '', '2025-07-08 13:55:42', 43, 48, 0, 0),
(91, '', '', '', '2025-08-04 06:20:01', 76, 74, 0, 0),
(92, '', '', '', '2025-08-04 06:24:36', 76, 74, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `junk_price`
--

CREATE TABLE `junk_price` (
  `id` int(11) NOT NULL,
  `junk_type` varchar(255) NOT NULL DEFAULT 'metal',
  `image` varchar(255) NOT NULL,
  `garbage_price` varchar(255) NOT NULL,
  `kl` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `collector_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `junk_price`
--

INSERT INTO `junk_price` (`id`, `junk_type`, `image`, `garbage_price`, `kl`, `created_at`, `collector_id`, `admin_id`) VALUES
(63, 'Plastic', '1.png', '21', '1kg', '2025-08-04 12:50:20', 76, 0),
(64, 'Glass', '1747390199_Screenshot 2025-03-22 003942.png', '123', '1kg', '2025-08-04 12:50:32', 76, 0),
(65, 'Electronics', '1746766920_Coding workshop-bro (1).png', '432', '1kg', '2025-08-04 12:50:43', 76, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `ref_no` varchar(255) NOT NULL,
  `ltype_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `lplan_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=request, 1=confirmed, 2=released, 3=completed, 4=denied',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `collector_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `ref_no`, `ltype_id`, `borrower_id`, `purpose`, `amount`, `lplan_id`, `status`, `date_released`, `date_created`, `collector_id`, `admin_id`, `is_paid`) VALUES
(85, '469345', 0, 20, 'esfdewf', 23421, 1, 0, '2025-06-05 11:13:30', '2025-06-05 11:13:30', 32, 3, 0),
(86, '072027', 0, 20, 'esfdewf', 23421, 1, 0, '2025-06-05 11:13:30', '2025-06-05 11:13:30', 32, 3, 0),
(87, '467731', 0, 20, 'esfdewf', 23421, 1, 2, '2025-06-05 11:13:31', '2025-06-05 11:13:31', 32, 3, 0),
(88, '235506', 0, 20, 'eswfdew', 1112, 1, 0, '2025-06-05 15:28:17', '2025-06-05 15:28:17', 32, 3, 0),
(89, '574745', 20, 20, 'ytf', 10, 1, 0, '2025-06-05 15:30:57', '2025-06-05 15:30:57', 32, 3, 0),
(90, '193246', 21, 21, 'wewqerwq', 10, 1, 3, '2025-06-05 15:38:16', '2025-06-05 15:38:16', 35, 3, 1),
(91, '442785', 20, 20, 'sdfsd', 200, 1, 3, '2025-06-08 12:47:42', '2025-06-08 12:47:42', 32, 3, 1),
(92, '809886', 20, 20, 'yrty', 50, 1, 3, '2025-06-08 12:53:22', '2025-06-08 12:53:22', 32, 3, 1),
(93, '161915', 20, 20, 'dsfgsdf', 50, 1, 3, '2025-06-08 12:57:33', '2025-06-08 12:57:33', 32, 3, 1),
(94, '229860', 20, 20, 'dftyre', 50, 1, 0, '2025-06-08 15:34:57', '2025-06-08 15:34:57', 32, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `lplan_id` int(11) NOT NULL,
  `lplan_month` int(11) NOT NULL,
  `lplan_interest` float NOT NULL,
  `lplan_penalty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`lplan_id`, `lplan_month`, `lplan_interest`, `lplan_penalty`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(3, 1, 1, 1),
(4, 2, 2, 2),
(5, 2, 2, 2),
(7, 33, 33, 33);

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedule`
--

CREATE TABLE `loan_schedule` (
  `loan_sched_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `ltype_id` int(11) NOT NULL,
  `ltype_name` varchar(255) NOT NULL,
  `ltype_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`ltype_id`, `ltype_name`, `ltype_desc`) VALUES
(20, 'wqdsq', 'dwqqd'),
(21, 'asdwqaed', 'qwedwq'),
(24, 'qwerqwr', 'awsfrdewrfew'),
(25, 'ewfewfrw', 'wefrew'),
(26, '7', 'THYTRYRTYR');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `pay_amount` float NOT NULL,
  `penalty` float NOT NULL,
  `overdue` tinyint(4) NOT NULL COMMENT '0=no, 1=yes',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `loan_id`, `payee`, `pay_amount`, `penalty`, `overdue`, `date_created`, `is_paid`) VALUES
(64, 61, '', 20200, 1, 0, '2025-05-29 21:11:55', 1),
(65, 64, '', 3990, 33, 0, '2025-05-30 14:00:43', 1),
(66, 79, '', 202, 1, 0, '2025-06-03 00:08:27', 1),
(67, 81, '', 34.34, 1, 0, '2025-06-04 13:23:57', 1),
(68, 83, '', 21555.4, 1, 0, '2025-06-05 15:48:47', 1),
(69, 90, '', 10.1, 1, 0, '2025-06-05 22:45:15', 1),
(70, 93, '', 50.5, 1, 0, '2025-06-08 19:17:11', 1),
(71, 92, '', 50.5, 1, 0, '2025-06-08 19:18:15', 1),
(72, 91, '', 202, 1, 0, '2025-06-08 19:18:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay_customer`
--

CREATE TABLE `pay_customer` (
  `id` int(11) NOT NULL,
  `money` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_requests`
--

CREATE TABLE `pickup_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `junk_type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `paid_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `kl` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pickup_requests`
--

INSERT INTO `pickup_requests` (`id`, `name`, `address`, `contact_number`, `junk_type`, `description`, `preferred_date`, `status`, `created_at`, `customer_id`, `collector_id`, `paid`, `paid_at`, `kl`, `admin_id`) VALUES
(296, 'Gilmar', 'brgy.sweetland buenavista bohol, 897987', '09463478938', 'Plastic, Glass, Electronics', 'qwee', '2025-08-04', 'Completed', '2025-08-04 14:07:25', 74, 76, '1563', '2025-08-04 14:19:54', 'Plastic:1, Glass:2, Electronics:3', 0),
(297, 'Gilmar', 'brgy.sweetland buenavista bohol, 897987', '09463478938', 'Plastic, Glass', 'fdhgfhfg', '2025-08-04', 'Pending', '2025-08-04 14:22:17', 74, 76, 'Unpaid', '2025-08-04 14:23:46', 'Plastic:2, Glass:5', 0),
(298, 'Gilmar', 'brgy.sweetland buenavista bohol, 897987', '09463478938', 'Glass', 'gfh', '2025-08-04', 'Completed', '2025-08-04 14:45:24', 74, 76, '738', '2025-08-04 14:45:56', 'Glass:6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `request_id`, `customer_id`, `collector_id`, `rating`, `review_text`, `created_at`) VALUES
(1, 297, 74, 76, 2, 'hgj', '2025-08-17 04:47:54'),
(2, 296, 74, 76, 1, 'df', '2025-08-17 05:00:55'),
(3, 296, 74, 76, 4, 'vgbfdc', '2025-08-17 05:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `total_money`
--

CREATE TABLE `total_money` (
  `id` int(11) NOT NULL,
  `capital_money` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `collector_id` int(11) NOT NULL,
  `deduction_of_capital_money` varchar(255) NOT NULL,
  `total_money` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_money`
--

INSERT INTO `total_money` (`id`, `capital_money`, `created_at`, `collector_id`, `deduction_of_capital_money`, `total_money`, `admin_id`) VALUES
(60, '100', '2025-06-08 09:46:17', 36, '90', '', 0),
(69, '100', '2025-06-08 13:34:45', 0, '0', '', 3),
(70, '100', '2025-06-08 13:34:57', 32, '50', '50', 3),
(71, '0', '2025-06-08 13:35:19', 37, '25', '', 3),
(72, '100', '2025-08-04 14:48:20', 76, '0', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `user_type` text NOT NULL DEFAULT 'collector',
  `image` varchar(255) NOT NULL DEFAULT '1.png',
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'deactivate',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification_code` varchar(255) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `address`, `number`, `user_type`, `image`, `password`, `status`, `created_at`, `verification_code`, `is_verified`) VALUES
(73, 'Levin', 'Torregosa', 'torregosalevin347@gmail.com', 'Hunan, Buenavista, Bohol', '09637289367', 'admin', '', 'torregosalevin347@', 'deactivate', '2025-08-04 12:37:54', '910665', 1),
(74, 'Gilmar', 'Aparece', 'aparecegilmar1@gmail.com', 'brgy.sweetland buenavista bohol, 897987', '09463478938', 'customer', '', 'junkshop@134$', 'activate', '2025-08-04 12:39:53', '722285', 1),
(76, 'sdfsdf', 'sdfsdf', 'tiktoksexiest99@gmail.com', 'Sweetland, Buenavista, Bohol', '09463478938', 'collector', '1.png', 'sdfsdf', 'activate', '2025-08-04 12:43:57', '326788', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_collectors`
--
ALTER TABLE `approved_collectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`borrower_id`);

--
-- Indexes for table `collector_notification`
--
ALTER TABLE `collector_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_notification`
--
ALTER TABLE `customer_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentation`
--
ALTER TABLE `documentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `junk_price`
--
ALTER TABLE `junk_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`lplan_id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`ltype_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pay_customer`
--
ALTER TABLE `pay_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `collector_id` (`collector_id`);

--
-- Indexes for table `total_money`
--
ALTER TABLE `total_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notification`
--
ALTER TABLE `admin_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `approved_collectors`
--
ALTER TABLE `approved_collectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `borrower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `collector_notification`
--
ALTER TABLE `collector_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `customer_notification`
--
ALTER TABLE `customer_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `documentation`
--
ALTER TABLE `documentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `junk_price`
--
ALTER TABLE `junk_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `lplan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `ltype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `pay_customer`
--
ALTER TABLE `pay_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `total_money`
--
ALTER TABLE `total_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `pickup_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`collector_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
