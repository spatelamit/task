-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 01:02 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasks_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `sub_tasks`
--

CREATE TABLE `sub_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','Completed') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_tasks`
--

INSERT INTO `sub_tasks` (`id`, `task_id`, `title`, `status`, `description`, `created_at`, `updated_at`, `due_date`, `deleted_at`) VALUES
(1, 1, 'first task', 'Pending', 'dfj df test sasd', '2022-11-01 05:14:14', '2022-11-01 05:45:23', '2022-11-01', '2022-11-01 05:45:23'),
(2, 1, 'first task', 'Pending', 'dfj df test sasd', '2022-11-01 05:41:58', '2022-11-01 05:41:58', '2022-11-01', '2022-11-01 05:21:27'),
(3, 1, 'first task', 'Pending', 'dfj df test sasd', '2022-11-01 05:41:59', '2022-11-01 05:41:59', '2022-11-01', '2022-11-01 05:21:27'),
(4, 13, 'first task', 'Pending', 'dfj df test sasd', '2022-11-01 05:42:00', '2022-11-01 05:42:00', '2022-11-01', '2022-11-01 05:21:27'),
(5, 2, 'first task', 'Completed', 'dfj df test sasd', '2022-11-01 05:42:01', '2022-11-01 05:43:22', '2022-11-01', '2022-11-01 05:43:22'),
(7, 2, 'first task', 'Completed', 'dfj df test sasd', '2022-11-01 05:42:02', '2022-11-01 05:42:02', '2022-11-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','Completed') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `status`, `description`, `created_at`, `updated_at`, `due_date`, `deleted_at`) VALUES
(2, 'first task', 'Completed', 'dfj df test sasd', '2022-11-01 05:13:53', '2022-11-01 05:57:37', '2022-11-01', '2022-11-01 05:19:57'),
(3, 'first task', 'Pending', 'dfj df test sasd', '2022-11-01 05:32:19', '2022-11-01 05:32:55', '2022-11-01', '2022-11-01 05:32:55'),
(4, 'first task', 'Pending', 'dfj df test sasd', '2022-11-01 05:32:21', '2022-11-01 05:32:21', '2022-11-01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_tasks`
--
ALTER TABLE `sub_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_tasks`
--
ALTER TABLE `sub_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
