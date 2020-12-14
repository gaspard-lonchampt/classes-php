-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 14 déc. 2020 à 09:58
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `classes`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `firstname`, `lastname`) VALUES
(85, 'TestConstruct', 'Constructpass', 'Constructmail', ' Constructfirst', 'Constructlast'),
(86, 'TestConstruct2', 'Constructpass', 'Constructmail', ' Constructfirst', 'Constructlast'),
(87, 'TestConstruct3', 'password12345', 'Constructmail', ' Constructfirst', 'Constructlast'),
(88, 'TestConstruct4', 'password12345', 'Constructmail', ' Constructfirst', 'Constructlast'),
(90, 'TestConstruct6', '$2y$10$je6XOnx2QBz9LMPJVaZ9SOJ18Jk7bo8wE0oSn0IqQWTEc/4UUOOnq', 'Constructmail', ' Constructfirst', 'Constructlast'),
(92, 'Update', '$2y$10$vGkHdVPCjfXse1BcQXZbQ.sDLt3dO6oGKXhSckv3rWCnQIrLLS/4O', 'update_email', 'update_firstname', 'update_lastname'),
(93, '', '$2y$10$7Fpfr/JyBLKwX4.CqSW04e/vJmrCqhuoXTTcVPebRqK6Uv0gRjQQq', 'Constructmail', ' Constructfirst', 'Constructlast'),
(94, 'Update', '$2y$10$vlBTI.eSXQgZDE6NH2/UdeEdSBUEwgF2vPBNKLIUUY97YYgqQAIhK', 'update_email', 'update_firstname', 'update_lastname'),
(95, 'Update', '$2y$10$qMaI0heBSYwixcO8F7ebdOwb0XUuO2IWp/JEzUmI8yiphn12lSKsW', 'update_email', 'update_firstname', 'update_lastname'),
(96, 'Update', '$2y$10$En4OfQ9BcwqNMVme/SckSeo/794EwD59kOHzUk2H5EyAQ0fzXIp3W', 'update_email', 'update_firstname', 'update_lastname'),
(97, 'TestConstruct10', '$2y$10$bFYfhGhYPkhGU6A8JzSuD.Z/bq1KqBX7GHrN.rxspDcjezvb6bS1u', 'Constructmail', 'Constructfirst', 'Constructlast'),
(98, 'TestConstruct11', '$2y$10$C20qXr/Bj6ynrxiTQ6cM5.0b4waJqvzsMwlI8EAjOBy0r2zR898Li', 'Constructmail', 'Constructfirst', 'Constructlast'),
(99, 'TestConstruct12', '$2y$10$sM0PLsW6XNmTsu5u9Mxks.EfCVFDvm4WzKn4J1A8jQJRGeWd2jjy6', 'Constructmail', 'Constructfirst', 'Constructlast'),
(100, 'TestConstruct14', '$2y$10$LJQM7oxIW5VKPws/rD9jgOFvpUs9Pin3iMVpQPrgeDiy0DdqnblBu', 'Constructmail', 'Constructfirst', 'Constructlast'),
(101, 'TestConstruct15', '$2y$10$HpwdI2Dq23u39VXAO0yjeuAjBqZgO8mbcnShK5yKqc366HlrZgNje', 'Constructmail', 'Constructfirst', 'Constructlast'),
(102, 'TestPost@pouet.fr', '$2y$10$kADQaKZYKCSEHGAh3pABF.DjRPNXYhB2jurBhwCkyGoDLq1EmoDyO', 'TestPost@pouet.fr', 'testfirstname', 'testlastname'),
(103, '$login', '$2y$10$qC0NezlMzr8oCQmQVnuaIO2KoAe9kME6aZHZFYIiLrKLeHzRcdHCO', '$email', '$firstname', '$lastname'),
(104, 'Tets2', '$2y$10$RE4zgS/sP1bvvOfpa1iDq.YRV9qOQQtfoA7gET5riaclncbMm8Pky', 'Test2@pouet.fr', 'Test2', 'Test2'),
(105, 'Test3', '$2y$10$eKpS5kQF6eBrn5tyAnQ4pOvAIh1P3W29eXlTeRib8RFwZ2L8XWTda', 'Test3@ma.Fr', 'First', 'Last');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
