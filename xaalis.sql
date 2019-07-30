-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2019 at 09:10 AM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.2.20-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xaalis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_partenaire`
--

CREATE TABLE `admin_partenaire` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_partenaire_user_partenaire`
--

CREATE TABLE `admin_partenaire_user_partenaire` (
  `admin_partenaire_id` int(11) NOT NULL,
  `user_partenaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL,
  `numero_compte` int(11) NOT NULL,
  `nom_proprietaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id`, `partenaire_id`, `numero_compte`, `nom_proprietaire`, `date_creation`, `montant`) VALUES
(1, 3, 123, 'Alal', '2019-07-29', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190728021440', '2019-07-28 02:15:42'),
('20190728041029', '2019-07-28 04:10:59'),
('20190729012304', '2019-07-29 01:23:33'),
('20190729083035', '2019-07-29 08:31:03'),
('20190729105902', '2019-07-29 10:59:24'),
('20190729110418', '2019-07-29 11:04:34'),
('20190729112330', '2019-07-29 11:23:40'),
('20190729144157', '2019-07-29 14:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `partenaire`
--

CREATE TABLE `partenaire` (
  `id` int(11) NOT NULL,
  `telephone` int(11) NOT NULL,
  `ninea` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raison_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partenaire`
--

INSERT INTO `partenaire` (`id`, `telephone`, `ninea`, `adresse`, `raison_social`, `password`, `email`) VALUES
(3, 784562135, 471258, 'Mbeubeuss', 'Alal', 'Testrole', 'Testrole@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `type` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_transaction` date NOT NULL,
  `montant` int(11) NOT NULL,
  `numero_expediteur` int(11) NOT NULL,
  `cniexpediteur` int(11) NOT NULL,
  `numero_destinataire` int(11) NOT NULL,
  `cnidestinataire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `profile`, `statut`) VALUES
(11, 'Testrole@gmail.com', '["ROLE_ADMIN"]', '$argon2id$v=19$m=65536,t=6,p=1$7iAF3km8+KcyzhzNHGXLzg$qj5dxJCm/1tChsWqY5gddTHNBX6inb+qmemP7OrXaA0', 'admin', ''),
(12, 'malick@gmail.com', '["ROLE_USER"]', '$argon2id$v=19$m=65536,t=6,p=1$boNKp088eKVmsSAMzU88RA$FFGnzNNILWNzfbfqTbOHRnwXIfmQ6tz64qjVelRZjK8', 'user', ''),
(13, 'lokho@gmail.com', '["ROLE_SUPER_ADMIN"]', '$argon2id$v=19$m=65536,t=6,p=1$SS1x971sOSLJ1W+kA+D2ug$zoMacHAWTwkukY5XJ94GCK3YjuhbfIEcR09jpopbApg', 'superAdmin', ''),
(14, 'nafi@gmail.com', '["ROLE_BLOQUE"]', '$argon2id$v=19$m=65536,t=6,p=1$IjZ3Chx6tgrkI8xXTHfTnw$ntZmsI63MK9kResXsl7NJxevTvrdinBJejHwmUnOkPQ', 'user', 'DEBLOQUER');

-- --------------------------------------------------------

--
-- Table structure for table `user_partenaire`
--

CREATE TABLE `user_partenaire` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `cni` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partenaire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_partenaire`
--

INSERT INTO `user_partenaire` (`id`, `login`, `prenom`, `nom`, `telephone`, `cni`, `password`, `email`, `partenaire_id`) VALUES
(5, 'test', 'Test', 'Test', 77895462, 1478523, 'userPartenaire', 'userPartenaire@gmail.com', 3),
(6, 'test', 'Testrole', 'Testrole', 77895463, 1478524, 'Testrole', 'Testrole@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_partenaire`
--
ALTER TABLE `admin_partenaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FAC105F698DE13AC` (`partenaire_id`);

--
-- Indexes for table `admin_partenaire_user_partenaire`
--
ALTER TABLE `admin_partenaire_user_partenaire`
  ADD PRIMARY KEY (`admin_partenaire_id`,`user_partenaire_id`),
  ADD KEY `IDX_74CACD21461CCCCB` (`admin_partenaire_id`),
  ADD KEY `IDX_74CACD217650BEFC` (`user_partenaire_id`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CFF6526098DE13AC` (`partenaire_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Indexes for table `user_partenaire`
--
ALTER TABLE `user_partenaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9598659F98DE13AC` (`partenaire_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_partenaire`
--
ALTER TABLE `admin_partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_partenaire`
--
ALTER TABLE `user_partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_partenaire`
--
ALTER TABLE `admin_partenaire`
  ADD CONSTRAINT `FK_FAC105F698DE13AC` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaire` (`id`);

--
-- Constraints for table `admin_partenaire_user_partenaire`
--
ALTER TABLE `admin_partenaire_user_partenaire`
  ADD CONSTRAINT `FK_74CACD21461CCCCB` FOREIGN KEY (`admin_partenaire_id`) REFERENCES `admin_partenaire` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_74CACD217650BEFC` FOREIGN KEY (`user_partenaire_id`) REFERENCES `user_partenaire` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `FK_CFF6526098DE13AC` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaire` (`id`);

--
-- Constraints for table `user_partenaire`
--
ALTER TABLE `user_partenaire`
  ADD CONSTRAINT `FK_9598659F98DE13AC` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaire` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
