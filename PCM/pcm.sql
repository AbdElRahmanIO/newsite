-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 03:03 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcm`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_name` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `slides` int(11) NOT NULL,
  `static` int(11) NOT NULL,
  `basic` int(11) NOT NULL,
  `animation` int(11) NOT NULL,
  `app` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_bg`
--

CREATE TABLE `project_bg` (
  `project_id` int(11) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_manager`
--

CREATE TABLE `project_manager` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_resources`
--

CREATE TABLE `project_resources` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_slides` int(11) NOT NULL,
  `user_hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_thumbs`
--

CREATE TABLE `project_thumbs` (
  `project_id` int(11) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `users_group_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `code` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users_group_id`, `name`, `email`, `image`, `gender`, `password`, `created`, `status`, `ip`, `code`) VALUES
(1, 1, 'Abdelrahman', 'abdelrahman.ui@gmail.com', '', 'male', '$2y$10$hwGI1fUvo68xrJlwwVNRpO6aFApGnYL5ami2x4RjJxGUqIgz6NAJ6', 1494888883, 'enabled', '', '5b58f1e437b915c9d56ef6d3ab0580038d16d091');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`) VALUES
(1, 'Super Adminstrator'),
(2, 'fotest');

-- --------------------------------------------------------

--
-- Table structure for table `users_group_permissions`
--

CREATE TABLE `users_group_permissions` (
  `id` int(11) NOT NULL,
  `users_group_id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_group_permissions`
--

INSERT INTO `users_group_permissions` (`id`, `users_group_id`, `page`) VALUES
(1, 1, '/admin/login'),
(2, 1, '/admin/login/submit'),
(3, 1, '/admin'),
(4, 1, '/admin/dashboard'),
(5, 1, '/admin/submit'),
(6, 1, '/admin/users'),
(7, 1, '/admin/users/add'),
(8, 1, '/admin/users/submit'),
(9, 1, '/admin/users/edit/:id'),
(10, 1, '/admin/users/save/:id'),
(11, 1, '/admin/users/delete/:id'),
(12, 1, '/admin/users-groups'),
(13, 1, '/admin/users-groups/add'),
(14, 1, '/admin/users-groups/submit'),
(15, 1, '/admin/users-groups/edit/:id'),
(16, 1, '/admin/users-groups/save/:id'),
(17, 1, '/admin/users-groups/delete/:id'),
(18, 1, '/admin/projects'),
(19, 1, '/admin/projects/add'),
(20, 1, '/admin/projects/submit'),
(21, 1, '/admin/projects/edit/:id'),
(22, 1, '/admin/projects/save/:id'),
(23, 1, '/admin/projects/delete/:id'),
(24, 1, '/admin/projects/:id/comments'),
(25, 1, '/admin/projects/comments/edit/:id'),
(26, 1, '/admin/projects/comments/save/:id'),
(27, 1, '/admin/projects/comments/delete/:id'),
(28, 1, '/admin/categories'),
(29, 1, '/admin/categories/add'),
(30, 1, '/admin/categories/submit'),
(31, 1, '/admin/categories/edit/:id'),
(32, 1, '/admin/categories/save/:id'),
(33, 1, '/admin/categories/delete/:id'),
(34, 1, '/admin/settings'),
(35, 1, '/admin/settings/save'),
(36, 1, '/admin/contacts'),
(37, 1, '/admin/contacts/reply/:id'),
(38, 1, '/admin/contacts/send/:id'),
(39, 1, '/admin/logout'),
(40, 2, '/admin/login'),
(41, 2, '/admin/login/submit');

-- --------------------------------------------------------

--
-- Table structure for table `waves`
--

CREATE TABLE `waves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `wave` int(11) NOT NULL,
  `created` text NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waves`
--
ALTER TABLE `waves`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `waves`
--
ALTER TABLE `waves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
