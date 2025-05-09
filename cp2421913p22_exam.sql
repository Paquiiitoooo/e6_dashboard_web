-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 09 mai 2025 à 10:12
-- Version du serveur : 10.6.20-MariaDB-cll-lve
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cp2421913p22_exam`
--

-- --------------------------------------------------------

--
-- Structure de la table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key_code` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` date NOT NULL,
  `is_used` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_premium` tinyint(1) DEFAULT 0,
  `key_generated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_premium`, `key_generated`) VALUES
(1, 'Exam', '$2y$10$54XAaK9WLCPelMsIFbVj1eYMMn8btTxM86Bm.eqLFLJ...', 'exam@exam.fr', 1, 1),
(2, 'Alice', '$2y$10$A1b2C3D4e5F6g7H8I9J0uKlMnOpQrStUvWxYzABcDeF...', 'alice@example.com', 1, 0),
(3, 'Bob', '$2y$10$B1c2D3e4F5G6h7I8J9K0vLmNoPqRsTuVwXyZaBcDeF...', 'bob@example.com', 0, 0),
(4, 'Charlie', '$2y$10$C1d2E3f4G5H6i7J8K9L0wMnOpQrStUvWxYzAbCdEfG...', 'charlie@example.com', 1, 0),
(5, 'Diana', '$2y$10$D1e2F3g4H5I6j7K8L9M0xNoPqRsTuVwXyZaBcDeFgH...', 'diana@example.com', 0, 0),
(6, 'Edward', '$2y$10$E1f2G3h4I5J6k7L8M9N0yOpQrStUvWxYzAbCdEfGhI...', 'edward@example.com', 1, 0),
(7, 'Fiona', '$2y$10$F1g2H3i4J5K6l7M8N9O0zPqRsTuVwXyZaBcDeFgHiJ...', 'fiona@example.com', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `keys`
--
ALTER TABLE `keys`
  ADD CONSTRAINT `keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
