-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 21 avr. 2020 à 13:34
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mysweater`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `telephone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `date` date NOT NULL,
  `prixTotal` int(11) NOT NULL,
  `adresse` text NOT NULL,
  `ville` varchar(120) NOT NULL,
  `codePostal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `idProduit` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `details_commandes`
--

CREATE TABLE `details_commandes` (
  `id` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `quantite` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `libelle` varchar(300) NOT NULL,
  `prix` int(11) NOT NULL,
  `quantite` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `libelle`, `prix`, `quantite`, `image`, `description`) VALUES
(1, 'CHEMISE STRUCTURÉE 1', 190, 120, 'product-1', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm'),
(2, 'CHEMISE STRUCTURÉE 2', 289, 12, 'product-2', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm'),
(3, 'CHEMISE STRUCTURÉE 3', 99, 34, 'product-3', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm'),
(4, 'CHEMISE STRUCTURÉE 4', 199, 85, 'product-4', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm'),
(5, 'CHEMISE STRUCTURÉE 5', 299, 78, 'product-5', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm'),
(6, 'CHEMISE STRUCTURÉE 6', 389, 90, 'product-6', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm'),
(7, 'CHEMISE STRUCTURÉE 7', 149, 32, 'product-7', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm'),
(8, 'CHEMISE STRUCTURÉE 8', 189, 11, 'product-8', 'MARRON CLAIR<br><br>Surchemise coupe décontractée avec col à revers, manches longues et poignets boutonnés. Poches poitrine plaquées à rabat. Effet délavé. Fermeture sur le devant par boutons.\r\n<br><br>\r\nLE MANNEQUIN MESURE : 189 cm');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
