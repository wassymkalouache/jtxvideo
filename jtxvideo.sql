-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 07 Décembre 2014 à 19:22
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `jtxvideo`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `categorie` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient la catégorisation de toutes les vidéos' AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `video`, `categorie`) VALUES
(1, 1, 'Musical'),
(2, 2, 'Musical'),
(3, 3, 'Musical'),
(4, 4, 'Musical');

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE IF NOT EXISTS `promotions` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `promotion` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient les promotions concernées par les vidéos' AUTO_INCREMENT=3 ;

--
-- Contenu de la table `promotions`
--

INSERT INTO `promotions` (`id`, `video`, `promotion`) VALUES
(1, 4, 2009),
(2, 4, 2010);

-- --------------------------------------------------------

--
-- Structure de la table `similaires`
--

CREATE TABLE IF NOT EXISTS `similaires` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `similaire` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Associe des vidéos similaires à une vidéos' AUTO_INCREMENT=2 ;

--
-- Contenu de la table `similaires`
--

INSERT INTO `similaires` (`id`, `video`, `similaire`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `tag` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient tous les tags des vidéos (table d''association)' AUTO_INCREMENT=26 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `video`, `tag`) VALUES
(1, 1, 'spam'),
(2, 1, 'fioni'),
(3, 1, 'picelli'),
(4, 1, 'resvoy'),
(5, 1, 'starkes'),
(6, 1, 'scola'),
(7, 2, 'pougne'),
(8, 2, 'rmpd'),
(9, 2, 'bob'),
(10, 2, 'moule'),
(11, 3, 'subaisse'),
(12, 3, 'de'),
(13, 3, 'fist'),
(14, 3, 'ado'),
(15, 3, 'improbinet'),
(16, 3, 'faerix'),
(17, 3, 'equitation'),
(18, 3, 'sddx'),
(19, 3, 'agro'),
(20, 4, 'incorpo'),
(21, 4, 'cycle'),
(22, 4, 'promotion'),
(23, 4, 'stage'),
(24, 4, 'mili'),
(25, 4, 'soiree');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `login` varchar(64) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `promo` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contient les utilisateurs du site';

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `email`, `promo`, `admin`) VALUES
('camille.masset', '6ba64cace4fc2b9ddef62cab8ee095ab4863c6c6', 'Masset', 'Camille', 'camille.masset@polytechnique.edu', 2013, 0),
('denis.merigoux', '33dda71348a6b91d9c19504a1c473da27a640f8f', 'Merigoux', 'Denis', 'denis.merigoux@polytechnique.edu', 2013, 1),
('wassym.kalouache', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'Kalouache', 'Wassym', 'wassym.kalouache@polytechnique.edu', 2013, 1);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
`video` int(11) NOT NULL,
  `titre` varchar(128) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `proj` varchar(256) NOT NULL,
  `poster` varchar(256) NOT NULL,
  `description` longtext NOT NULL,
  `jtx` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `format` varchar(16) NOT NULL DEFAULT 'webm'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient les informations sur toutes les vidéos du site' AUTO_INCREMENT=5 ;

--
-- Contenu de la table `videos`
--

INSERT INTO `videos` (`video`, `titre`, `adresse`, `proj`, `poster`, `description`, `jtx`, `annee`, `format`) VALUES
(1, 'Spam me maybe', 'videosjtx/spammemaybe.webm', 'http://binet-jtx.com/blog/?p=1110', 'videosjtx/spammemaybe.png', 'Considéré par certains comme le meilleur clip musical du JTX de tous les temps, Spam me maybe est une reprise de Call me maybe sur le thème du spam intensif qui est le quotidien de tous les polytechniciens. Le charme de l''actrice principale n''est sans doute pas étranger au succès du clip.\r\n        ', 2010, NULL, 'webm'),
(2, 'Elle me dit pougne', 'videosjtx/ellemeditpougne.webm', 'http://binet-jtx.com/blog/?p=940', 'videosjtx/ellemeditpougne.png', 'Reprise de Elle me dit de Mika, ce clip très rythmé et entraînant est idéal pour tuer toute culpabilité lors d''une séance de moule intensive.', 2010, NULL, 'webm'),
(3, 'Nous on subit', 'videosjtx/nousonsubit.webm', 'http://binet-jtx.com/blog/?p=1025', 'videosjtx/nousonsubit.png', 'Ce clip est l''hymne officiel du binet Subaïsse. Pâles, cours, DE, binets, sports ; tout la vie à l''X est résumée dans ce clip à l''humour noir. C''est une des premières reprises des chansons de Stromae qui seront très prisées des JTX 2011 et 2012.', 2010, NULL, 'webm'),
(4, 'RAS RAS tea bag', 'videosjtx/rasrasteabag.webm', 'http://binet-jtx.com/blog/?p=940', 'videosjtx/rasrasteabag.png', 'Ce clip semble avoir acquis un incontestable renommée, puisqu''il a été passé en pré-proj'' par le JTX 2011 en mars, et de l''avis général, résume assez bien la vie d''une promotion, avec toute la mélancolie convenable, mélancolie qui lui a malheureusement valu un accueil mitigé au sein de la promotion 2009, puisque projeté à quelques semaines de son départ, sonnait pour certains comme un adieu avant l''heure.     ', 2010, NULL, 'webm');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD KEY `video` (`video`,`categorie`(255));

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
 ADD PRIMARY KEY (`id`), ADD KEY `video` (`video`);

--
-- Index pour la table `similaires`
--
ALTER TABLE `similaires`
 ADD PRIMARY KEY (`id`), ADD KEY `video` (`video`), ADD KEY `similaire` (`similaire`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`), ADD KEY `video` (`video`,`tag`(255)), ADD KEY `tag` (`tag`(255));

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
 ADD PRIMARY KEY (`login`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
 ADD PRIMARY KEY (`video`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `similaires`
--
ALTER TABLE `similaires`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
MODIFY `video` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`video`) REFERENCES `videos` (`video`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `promotions`
--
ALTER TABLE `promotions`
ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`video`) REFERENCES `videos` (`video`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `similaires`
--
ALTER TABLE `similaires`
ADD CONSTRAINT `similaires_ibfk_1` FOREIGN KEY (`video`) REFERENCES `videos` (`video`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `similaires_ibfk_2` FOREIGN KEY (`similaire`) REFERENCES `videos` (`video`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tags`
--
ALTER TABLE `tags`
ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`video`) REFERENCES `videos` (`video`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
