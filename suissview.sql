-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 09:31 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suissview`
--

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `playlist_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `xpos` int(11) DEFAULT NULL,
  `ypos` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delflag` tinyint(4) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` varchar(255) NOT NULL,
  `effect` varchar(255) NOT NULL,
  `speed` int(11) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  `xpos` int(11) NOT NULL,
  `ypos` int(11) NOT NULL,
  `fonttype` varchar(255) NOT NULL,
  `fontsize` int(11) NOT NULL,
  `fontcolor` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `text`, `effect`, `speed`, `duration`, `xpos`, `ypos`, `fonttype`, `fontsize`, `fontcolor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'Test Message2', 'left', 14, 0, 60, 60, 'opensans', 60, '#000000', '2018-04-23 14:57:38', '2018-04-23 14:57:38', NULL),
(3, 1, 'Test Message', 'left', 14, 0, 60, 60, 'opensans', 60, '#000000', '2018-04-23 15:02:35', '2018-04-23 15:02:35', NULL),
(4, 1, 'aaaaaaaaaaaa', 'left', 7, 0, 43, 3, 'opensans', 333, '#000000', '2018-04-23 15:08:44', '2018-04-23 15:08:44', NULL),
(5, 1, '11111111111111', 'left', 10, 0, 4444, 11, 'opensans', 11, '#000000', '2018-04-24 18:10:14', '2018-04-24 18:10:14', NULL),
(6, 1, 'aaaaaa', 'left', 14, 0, 0, 11, 'opensans', 11, '#000000', '2018-04-24 18:15:35', '2018-04-24 18:15:35', NULL),
(7, 1, '22222222222', 'down', 11, 0, 22, 22, 'opensans', 33, '#000000', '2018-04-24 19:51:08', '2018-04-24 19:51:08', NULL),
(8, 1, 'mdmdmmdmdmd', 'left', 12, 0, 60, 50, 'arial', 60, '#000000', '2018-04-26 16:11:43', '2018-04-26 16:11:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1514487185),
('m130524_201442_init', 1514487187),
('m170614_192520_room', 1514487187),
('m170614_193021_schedule', 1514487187),
('m170619_204304_create_table_reservation', 1514487187),
('m170620_211732_addposte', 1514487187),
('m170622_114537_rename_yable', 1514487187),
('m170622_120501_reservators_to_schedule', 1514487187),
('m170622_122329_add_column_reserve_on_date', 1514487187),
('m170622_143109_add_column_dat', 1514487187),
('m170622_204909_rename_column', 1514487187),
('m170623_071610_add_column_approved', 1514487187),
('m170623_162532_add_total_price', 1514487187),
('m170623_220519_add_color_column', 1514487187),
('m170624_155108_add_background_table', 1514487187),
('m170625_094538_fill_settings', 1514487187),
('m170625_172249__fill_cfg', 1514487187),
('m170710_195307_add_email_to_room_config', 1514487187),
('m170722_141634_add_sub_status', 1514487187),
('m170722_211246_colukn_room_id', 1514487187),
('m170722_212016_column_reserve_on_date', 1514487187),
('m170722_214743_column_approved', 1514487187),
('m170724_164627_add_new_item_to_settings', 1514487187),
('m170903_085212_added_male_and_female_manes', 1514487187),
('m170929_175843_create_exception_table', 1514487187),
('m171001_142156_add_title_to_exceptions', 1514487187),
('m171228_193150_add_day_of_week', 1514499839),
('m171229_174402_f', 1514573085);

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `message_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `created_at`, `updated_at`, `message_id`, `user_id`, `deleted_at`) VALUES
(16, 'ffffffffffffffffffffff', '2018-04-26 03:20:57', '2018-04-26 03:20:57', 4, 1, NULL),
(18, 'ffffffffffffffffffffff', '2018-04-26 03:22:06', '2018-04-26 03:22:06', 4, 1, NULL),
(22, 'xxxxxxxxxx', '2018-04-26 03:36:01', '2018-04-26 06:21:14', 5, 1, NULL),
(23, 'This is test playlist title', '2018-04-26 16:13:25', '2018-04-26 16:13:25', 4, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_videoclip`
--

CREATE TABLE `playlist_videoclip` (
  `id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `videoclip_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlist_videoclip`
--

INSERT INTO `playlist_videoclip` (`id`, `playlist_id`, `videoclip_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(86, 16, 70, NULL, NULL, NULL),
(87, 16, 71, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `actived` tinyint(4) NOT NULL DEFAULT '0',
  `logo_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `url`, `created_at`, `updated_at`, `user_id`, `actived`, `logo_id`, `schedule_id`, `deleted_at`) VALUES
(1, 'Bus Station TV', 'http://localhost:8000/project/qoijoaodjofi', '2018-04-14 00:56:11', '2018-04-14 00:56:18', 1, 0, 1, 1, NULL),
(2, 'Railway Station', 'http://localhost:8000/project/xaldkfjqoji', '2018-04-14 00:57:45', '2018-04-14 00:57:48', 1, 0, 1, 1, NULL),
(3, 'Grand TV', 'http://localhost:8000/project/adfafdqefqfe', '2018-04-14 00:58:29', '2018-04-14 00:58:31', 1, 0, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_playlist`
--

CREATE TABLE `project_playlist` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `playlist_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `actived` tinyint(4) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_playlist`
--

INSERT INTO `project_playlist` (`id`, `project_id`, `playlist_id`, `created_at`, `updated_at`, activated, `deleted_at`) VALUES
(1, 1, 16, '2018-05-02 10:34:36', '2018-05-02 10:34:39', 0, NULL),
(2, 1, 18, '2018-05-02 15:35:39', '2018-05-02 15:35:42', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `endless` tinyint(1) NOT NULL,
  `days` varchar(255) NOT NULL,
  `months` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `playlist_id`, `start_time`, `end_time`, `endless`, `days`, `months`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 22, '05:22:00', '06:33:00', 0, '0,3,5,', '0,2,4,8,9,', '2018-04-26 06:18:38', '2018-04-26 06:21:14', NULL),
(8, 23, '05:44:00', '23:20:00', 1, '1,3,5,', '3,7,8,', '2018-04-26 16:13:25', '2018-04-26 16:13:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `remember_token`, `deleted_at`) VALUES
(1, 'tester', 'tester@gmail.com', '$2y$10$qHdjxmvA64F8F7kqCzODkO83i2cHt6TuK/Ba7cFUbCVVAmqIVEq0C', 0, '2018-03-23 16:24:44', '2018-03-23 16:24:44', 'gz5Xo0zDthZQJrHWAREMsrXxboYpnwYHL5ZNFotJOY40RPG4uF6hBbJLwqBz', NULL),
(2, 'glow', 'glow@glow.com', '$2y$10$guznYML4PGpEdFh1GVx/UuzHM2Xf6HMFrrvaM8Dlw/QqJH8FqV1ni', 0, '2018-04-03 00:10:24', '2018-04-03 00:10:24', 'RsA7nAGn5muKo7SB2OFR3o08vaDp1cbbmGYgW2lrGM6uqPqgM03jsrQjmnIr', NULL),
(3, 'k.sj', 'k@sj.com', '$2y$10$drv/z4kcLvhP7/.hA6SYk.CacL0uD5Z1CrJSuDEw.cZIkOZ0vqrAO', 0, '2018-04-03 00:22:59', '2018-04-03 00:22:59', 'vttk0pXyoVrq316S4pto8kSijGQkXAN1kqH5Q7doFFZ4YY77vXjU3RFTlAKh', NULL),
(4, 'test@tester.com', 'test@tester.com', '$2y$10$zdafA6kupQHnq1Pcp1O0iO0QCmKgfDsZDq4q3hmT5bj3lvER5.T6m', 0, '2018-04-07 18:17:03', '2018-04-07 18:17:03', 'vSdTybyJLXQemb8Szq86GsZWjeZqlZqK8JPfaR8wUgxd5zdGx47iiGESYVJy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videoclips`
--

CREATE TABLE `videoclips` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `delflag` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `message_id` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videoclips`
--

INSERT INTO `videoclips` (`id`, `title`, `url`, `created_at`, `updated_at`, `delflag`, `user_id`, `message_id`, `deleted_at`) VALUES
(69, 'ffffffffffffffffff', 'ffffffffffffffff', '2018-04-26 06:36:33', '2018-04-26 06:36:33', 0, 1, NULL, NULL),
(70, 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxx', '2018-04-26 06:36:42', '2018-04-26 06:36:42', 0, 1, NULL, NULL),
(71, 'jjjjjjjjjjjjjjjjj', 'http://youtube.com/zklsjofj0q2jr', '2018-04-26 16:11:25', '2018-04-26 16:11:43', 0, 1, 8, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logos_id_uindex` (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist_videoclip`
--
ALTER TABLE `playlist_videoclip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_playlist`
--
ALTER TABLE `project_playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_uindex` (`email`);

--
-- Indexes for table `videoclips`
--
ALTER TABLE `videoclips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `playlist_videoclip`
--
ALTER TABLE `playlist_videoclip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project_playlist`
--
ALTER TABLE `project_playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `videoclips`
--
ALTER TABLE `videoclips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
