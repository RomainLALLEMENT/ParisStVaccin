-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 nov. 2021 à 11:12
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `psv`
--

-- --------------------------------------------------------

--
-- Structure de la table `psv_carnet`
--

CREATE TABLE `psv_carnet` (
  `id` int(11) NOT NULL,
  `id_vaccin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `premiere_date` date NOT NULL,
  `date_prochain` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `psv_carnet`
--

INSERT INTO `psv_carnet` (`id`, `id_vaccin`, `id_user`, `premiere_date`, `date_prochain`) VALUES
(1, 1, 1, '2021-11-11', NULL),
(2, 1, 2, '2021-11-11', NULL),
(3, 3, 2, '2021-11-11', NULL),
(4, 4, 2, '2021-11-11', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `psv_user`
--

CREATE TABLE `psv_user` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `age` date NOT NULL,
  `created_at` datetime NOT NULL,
  `email` varchar(200) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `psv_user`
--

INSERT INTO `psv_user` (`id`, `nom`, `prenom`, `age`, `created_at`, `email`, `token`, `password`, `role`) VALUES
(1, 'BOSSIN', 'Maxence', '2000-11-09', '2021-11-16 23:12:08', 'maxencebossin@gmail.com', 'token', '$2y$10$9mRCVFoj.smshouKWdmHXu53/0mk/Iv/6RjcbNDKlxkFUAxJhW.h6', 'user'),
(2, 'Lalement ', 'Romain', '2002-04-12', '2021-11-16 23:12:08', 'Romain76@gmail.com', 'token', '$2y$10$9mRCVFoj.smshouKWdmHXu53/0mk/Iv/6RjcbNDKlxkFUAxJhW.h6', 'user'),
(3, 'Durand', 'Emma', '1987-01-21', '2021-11-16 23:25:08', 'EmmaDu@gmail.com', 'token', '$2y$10$9mRCVFoj.smshouKWdmHXu53/0mk/Iv/6RjcbNDKlxkFUAxJhW.h6', 'user'),
(4, 'Bernard', 'Camille', '2003-06-06', '2021-11-16 23:25:08', 'camile@hotmail.com', 'token', '$2y$10$9mRCVFoj.smshouKWdmHXu53/0mk/Iv/6RjcbNDKlxkFUAxJhW.h6', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `psv_vaccin`
--

CREATE TABLE `psv_vaccin` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `temps_rappel` int(3) NOT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `obligatoire` tinyint(1) NOT NULL,
  `description` text DEFAULT NULL,
  `Laboratoire` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `psv_vaccin`
--

INSERT INTO `psv_vaccin` (`id`, `libelle`, `temps_rappel`, `pays`, `obligatoire`, `description`, `Laboratoire`) VALUES
(1, 'ACT-HIB ', 6, 'France', 1, 'Vaccin conjugué contre Haemophilus influenzae type b - Act-HIB 10 microgrammes/0,5 mL, poudre et solvant pour solution injectable en seringue préremplie.', 'Sanofi Pasteur'),
(2, 'AVAXIM 160 U', 10, NULL, 0, 'Vaccin contre l\'hépatite A (inactivé, adsorbé).', 'Sanofi Pasteur'),
(3, 'AVAXIM 80 U', 0, '', 0, 'Vaccin contre l\'hépatite A (inactivé, adsorbé).', 'Sanofi Pasteur '),
(4, 'BEXSERO', 25, NULL, 0, 'Vaccin méningococcique groupe B (ADNr, composant, adsorbé).\r\n\r\nVaccin disponible. La primovaccination des nourrissons âgés de 2 à 5 mois peut être réalisée avec deux doses espacées de deux mois au lieu de trois doses espacées d\'un mois. Le schéma à deux doses peut être utilisé dès l\'âge de 2 mois depuis mai 2020. Juin 2021 : la Haute Autorité de santé recommande la vaccination de tous les nourrissons contre la méningite B avec le vaccin Bexsero.\r\n', 'GSK Vaccines ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `psv_carnet`
--
ALTER TABLE `psv_carnet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `psv_user`
--
ALTER TABLE `psv_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `psv_vaccin`
--
ALTER TABLE `psv_vaccin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `psv_carnet`
--
ALTER TABLE `psv_carnet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `psv_user`
--
ALTER TABLE `psv_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `psv_vaccin`
--
ALTER TABLE `psv_vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
