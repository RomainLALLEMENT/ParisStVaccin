-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 16 nov. 2021 à 14:55
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parisstvaccin`
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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `psv_user`
--
ALTER TABLE `psv_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `psv_vaccin`
--
ALTER TABLE `psv_vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
