-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 11 Décembre 2014 à 00:12
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient la catégorisation de toutes les vidéos' AUTO_INCREMENT=17 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `video`, `categorie`) VALUES
(1, 1, 'Musical'),
(2, 2, 'Musical'),
(3, 3, 'Musical'),
(4, 4, 'Musical'),
(5, 5, 'Humoristique'),
(6, 6, 'Humoristique'),
(7, 7, 'Archives'),
(8, 8, 'Clip Kès'),
(9, 8, 'Campagne Kès'),
(10, 9, 'Campagne Kès'),
(11, 10, 'Rap'),
(12, 10, 'Musical'),
(13, 11, 'Poop'),
(14, 12, 'Musical'),
(15, 13, 'Polytechniman'),
(16, 14, 'Polytechniman');

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE IF NOT EXISTS `promotions` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `promotion` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient les promotions concernées par les vidéos' AUTO_INCREMENT=7 ;

--
-- Contenu de la table `promotions`
--

INSERT INTO `promotions` (`id`, `video`, `promotion`) VALUES
(1, 4, 2009),
(2, 4, 2010),
(3, 7, 2013),
(4, 8, 2013),
(5, 9, 2013),
(6, 11, 2013);

-- --------------------------------------------------------

--
-- Structure de la table `similaires`
--

CREATE TABLE IF NOT EXISTS `similaires` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `similaire` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Associe des vidéos similaires à une vidéos' AUTO_INCREMENT=12 ;

--
-- Contenu de la table `similaires`
--

INSERT INTO `similaires` (`id`, `video`, `similaire`) VALUES
(1, 1, 3),
(2, 5, 6),
(3, 6, 5),
(8, 7, 8),
(9, 8, 7),
(10, 14, 13),
(11, 13, 14);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `tag` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient tous les tags des vidéos (table d''association)' AUTO_INCREMENT=180 ;

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
(25, 4, 'soiree'),
(26, 5, 'conference'),
(27, 5, 'conf'),
(30, 5, 'dfhm'),
(31, 5, 'aluminium'),
(32, 5, 'alu'),
(33, 5, 'chapeau'),
(34, 5, 'merdass'),
(35, 5, 'software'),
(36, 5, 'personnages'),
(37, 5, 'militaire'),
(38, 5, 'montebourg'),
(39, 5, 'thon'),
(40, 5, 'pin'),
(41, 5, 'sanselme'),
(42, 6, 'merdass'),
(43, 6, 'software'),
(45, 6, 'software'),
(46, 6, 'veneneux'),
(47, 6, 'agressif'),
(48, 6, 'dominantes'),
(49, 6, 'perturbateurs'),
(50, 6, 'manager'),
(51, 6, 'sanselme'),
(52, 6, 'mintzberg'),
(53, 6, 'hss311'),
(54, 6, 'posture'),
(56, 6, 'animaux'),
(57, 6, 'autorite'),
(58, 6, 'hibou'),
(59, 6, 'deconnade'),
(60, 6, 'regression'),
(61, 7, 'lucky'),
(62, 7, 'lukes'),
(63, 7, 'western'),
(64, 7, 'pyramide'),
(65, 7, 'dalton'),
(66, 7, 'luke'),
(67, 7, 'ramkes'),
(68, 7, 'toutankesmon'),
(69, 7, 'momie'),
(70, 7, 'poursuite'),
(71, 7, 'k7'),
(72, 8, 'dalton'),
(73, 8, 'banque'),
(74, 8, 'ik'),
(75, 8, 'foessel'),
(76, 8, 'bob'),
(77, 8, 'chaboty'),
(78, 8, 'say'),
(79, 8, 'holiner'),
(80, 8, 'lucky'),
(81, 8, 'luke'),
(82, 8, 'jolly'),
(83, 8, 'jumper'),
(84, 8, 'dulac'),
(85, 8, 'legrix'),
(86, 8, 'souad'),
(87, 8, 'indiens'),
(88, 8, 'lac'),
(89, 8, 'baignade'),
(90, 8, 'duel'),
(91, 9, '3d'),
(92, 9, 'ukes'),
(93, 9, 'ben'),
(94, 9, 'kes'),
(95, 9, 'resultats'),
(96, 9, 'lukes'),
(97, 10, 'rap'),
(98, 10, 'battle'),
(99, 10, 'history'),
(100, 10, 'vaneau'),
(101, 10, 'borotra'),
(102, 10, 'rue'),
(103, 10, 'mythe'),
(104, 11, 'tintin'),
(105, 11, 'poop'),
(106, 11, 'incorpo'),
(107, 11, 'studyrama'),
(108, 11, 'demay'),
(109, 11, 'moule'),
(110, 11, 'devise'),
(111, 11, 'pornographique'),
(112, 11, 'tatiana'),
(113, 11, 'euh'),
(114, 11, 'explosion'),
(115, 11, 'général'),
(116, 11, 'grouze'),
(117, 12, 'souad'),
(118, 12, 'jacques'),
(119, 12, 'virginie'),
(120, 12, 'ado'),
(121, 12, 'nassar'),
(122, 12, 'fist'),
(123, 12, 'psc'),
(124, 12, 'subaisse'),
(125, 12, 'lundi'),
(126, 12, 'soutenance'),
(127, 12, 'scola'),
(128, 13, 'starkes'),
(129, 13, 'pelletier'),
(130, 13, 'aglae'),
(131, 13, 'neonazix'),
(132, 13, 'merdass'),
(133, 13, 'merdasse'),
(134, 13, 'vador'),
(135, 13, 'polytechniman'),
(136, 13, 'batman'),
(137, 13, 'mythe'),
(138, 13, 'gu'),
(139, 13, 'strimoule'),
(140, 13, 'xy'),
(141, 13, 'march'),
(142, 13, 'hadrien'),
(143, 13, 'drive'),
(144, 13, 'kes'),
(145, 13, 'shalom'),
(146, 13, 'organes'),
(147, 13, 'martin'),
(148, 13, 'combat'),
(149, 13, 'tos'),
(150, 13, 'starklouvitch'),
(151, 13, 'corde'),
(152, 14, 'chinois'),
(153, 14, 'corde'),
(154, 14, 'polytechniman'),
(155, 14, 'neonazix'),
(156, 14, 'streblouze'),
(157, 14, 'local'),
(158, 14, 'bas'),
(159, 14, 'vador'),
(161, 14, 'capture'),
(162, 14, 'torture'),
(163, 14, 'clone'),
(164, 14, 'point'),
(165, 14, 'gamma'),
(166, 14, 'peripherique'),
(167, 14, 'nord'),
(168, 14, 'gu'),
(169, 14, 'mythe'),
(170, 14, 'info'),
(171, 14, 'combat'),
(172, 14, 'foudre'),
(173, 14, 'transformers'),
(174, 14, 'patrie'),
(175, 14, 'fist'),
(176, 14, 'sciences'),
(177, 14, 'chat'),
(178, 14, 'organe'),
(179, 14, 'rein');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient les informations sur toutes les vidéos du site' AUTO_INCREMENT=15 ;

--
-- Contenu de la table `videos`
--

INSERT INTO `videos` (`video`, `titre`, `adresse`, `proj`, `poster`, `description`, `jtx`, `annee`, `format`) VALUES
(1, 'Spam me maybe', 'videosjtx/spammemaybe.webm', 'http://binet-jtx.com/blog/?p=1110', 'videosjtx/spammemaybe.png', 'Considéré par certains comme le meilleur clip musical du JTX de tous les temps, Spam me maybe est une reprise de Call me maybe sur le thème du spam intensif qui est le quotidien de tous les polytechniciens. Le charme de l''actrice principale n''est sans doute pas étranger au succès du clip.\r\n        ', 2010, NULL, 'webm'),
(2, 'Elle me dit pougne', 'videosjtx/ellemeditpougne.webm', 'http://binet-jtx.com/blog/?p=940', 'videosjtx/ellemeditpougne.png', 'Reprise de Elle me dit de Mika, ce clip très rythmé et entraînant est idéal pour tuer toute culpabilité lors d''une séance de moule intensive.', 2010, NULL, 'webm'),
(3, 'Nous on subit', 'videosjtx/nousonsubit.webm', 'http://binet-jtx.com/blog/?p=1025', 'videosjtx/nousonsubit.png', 'Ce clip est l''hymne officiel du binet Subaïsse. Pâles, cours, DE, binets, sports ; tout la vie à l''X est résumée dans ce clip à l''humour noir. C''est une des premières reprises des chansons de Stromae qui seront très prisées des JTX 2011 et 2012.', 2010, NULL, 'webm'),
(4, 'RAS RAS tea bag', 'videosjtx/rasrasteabag.webm', 'http://binet-jtx.com/blog/?p=940', 'videosjtx/rasrasteabag.png', 'Ce clip semble avoir acquis un incontestable renommée, puisqu''il a été passé en pré-proj'' par le JTX 2011 en mars, et de l''avis général, résume assez bien la vie d''une promotion, avec toute la mélancolie convenable, mélancolie qui lui a malheureusement valu un accueil mitigé au sein de la promotion 2009, puisque projeté à quelques semaines de son départ, sonnait pour certains comme un adieu avant l''heure.     ', 2010, NULL, 'webm'),
(5, 'S''amuser en conférence DFHM', 'videosjtx/29-s''amuser en conf DFHM.webm', 'http://binet-jtx.com/blog/?p=1496', 'videosjtx/29-s''amuser en conf DFHM.webm_snapshot_00.29_[2014.12.07_19.27.15].jpg', 'Ce clip présente le nouveau CD-ROM de Merdass'' Software intitulé « Comment s''amuser seul en conférence DFHM ». Production phare du JTX 2012, ce clip minimaliste ne contenant que des images fixe commenté par Marc Sanselme est à l''origine de la maxime « N''oublie pas ton papier d''alu en conf'' DFHM ! ».', 2012, NULL, 'webm'),
(6, 'Devenir un grand manager gratuitement', 'videosjtx/32_Merdass_software_Manager.webm', 'http://binet-jtx.com/blog/?p=1559', 'videosjtx/Merdass_Manager.jpg', 'Deuxième production de Merdass'' Software qui nous présente cette fois-ci les dessous de l''ascension sociale. « Repérer les éléments pertubateurs aux postures agresso-dominantes », « Imiter les animaux vénéneux » et « Pas trop de déconnade » seront les maître mots de votre carrière.', 2012, NULL, 'webm'),
(7, 'Old fruits', 'videosjtx/12_Old fruits.webm', 'http://binet-jtx.com/blog/?p=1624', 'videosjtx/12_Old fruits.webm_snapshot_00.12_[2014.12.08_14.17.08].jpg', 'Remix des clips de campagne de la Lucky LuKès (X1992) et la RamKès II (X1993) pour montrer aux deux listes Kès du second tour de la campagne X2013 (Lucky LuKès et ToutanKèsmon) que leurs idées ne sont pas si originales que ça...', 2013, NULL, 'webm'),
(8, 'Lucky LuKès', 'videosjtx/25_Clip_LuckyLukes.webm', 'http://binet-jtx.com/blog/?p=1624', 'videosjtx/25_Clip_LuckyLukes.webm_snapshot_00.34_[2014.12.08_14.26.32].jpg', 'Le film de la Lucky LuKès (X2013) raconte l''histoire des Daltons qui tout juste sortis de prison cherchent à dévaliser une banque. Malheureusement pour eux, des bandits sont déjà passés par là, comme dans toutes les banques de la région. Ils décident donc de suivre Lucky Luke (grandiosement interprété par Paul Michel) qui est déjà sur leurs traces.\r\n\r\nLa vidéo se termine par un duel nocturne au milieu du grand hall, entre Lucky Luke et les deux bandits (Gwendoline Tallec et Mathilde Caron, les aspis Binets). Les bandits prenant la fuite, leur capture se termine en live sur la scène du .K.\r\nC''est aussi la première longue apparition de Michaël Foessel à l''écran, qui assomme les Daltons avec une tirade sur la démocratie, la propriété et le vol. ', NULL, NULL, 'webm'),
(9, 'Résultats second tour campagne Kès X2013', 'videosjtx/14_Resultats.webm', 'http://binet-jtx.com/blog/?p=1624', 'videosjtx/14_Resultats.webm_snapshot_01.48_[2014.12.08_18.01.36].jpg', 'Après une semaine de campagne te un premier tour, les résultats de l''élection de la 201e Kès furent annoncés le mercredi 3 décembre 2014. Le Big Ben symbolise la UKès (X2012) et sur son cadran défilent les anciennes Kès ainsi que la nouvelle.', 2013, NULL, 'webm'),
(10, 'Epic Rap Battle Vaneau vs Borotra', 'videosjtx/25-Epic_Rap_Vaneau_Borotra.webm', 'http://jtx/blog/?p=1290', 'videosjtx/25-Epic_Rap_Vaneau_Borotra.webm_snapshot_00.16_[2014.12.10_22.48.09].jpg', 'Ce clip transpose la série Youtube « Epic Rap Batlle of History » dans le contexte de l''X avec une battle très réussie où on sent le talent du binet de la Rue nouvellement créé. Répliques cultes : « C''est pas les championnats, c''est ta mère qu''est en open ! » ou « Les gueules des gardes suisses je les ai smashées, pas amorties »...', 2011, NULL, 'webm'),
(11, 'Incorpoop X2013', 'videosjtx/18_Incorpoop.webm', 'http://jtx/blog/?p=1310', 'videosjtx/18_Incorpoop.webm_snapshot_00.29_[2014.12.10_23.17.50].jpg', 'Deuxième poop du JTX 2011 après celle de la proj'' juillet, le clip tourne autour de l''intervieuw du général Demay qui a eu le malheur de prononcer le mot « pornographique »...', 2011, NULL, 'webm'),
(12, 'TNT PSC', 'videosjtx/40-TNT_PSC.webm', 'http://jtx/blog/?p=1172', 'videosjtx/40-TNT_PSC.webm_snapshot_02.23_[2014.12.10_23.43.37].jpg', 'Bonne reprise musicale de TNT de AC/DC, ce clip décrit assez bien le sentiment de subaïsse extrême qui submerge les 2A le lundi après-midi. ', 2011, NULL, 'webm'),
(13, 'Polytechniman VS Neonazix (1/2)', 'videosjtx/04-Polytechniman_Croes_premiere_partie.webm', 'http://jtx/blog/?p=1221', 'videosjtx/04-Polytechniman_Croes_premiere_partie.webm_snapshot_11.25_[2014.12.10_23.51.44].jpg', 'Première partie du plus long épisode des aventures de Polytechniman, qui cette fois-ci doit affronter le terrible Prez'' du binet Neonazix qui sème la terreur à travers l''école. Mais avant, il lui faudra terrasser le sinistre sbire de Croes et ses deux couteaux...', 2010, NULL, 'webm'),
(14, 'Polytechniman VS Neonazix (2/2)', 'videosjtx/08-Polytechniman_Croes_deuxieme_partie.webm', 'http://jtx/blog/?p=1221', 'videosjtx/08-Polytechniman_Croes_deuxieme_partie.webm_snapshot_11.55_[2014.12.11_00.00.00].jpg', 'Deuxième partie de la plus longue aventure de Polytechniman. Le sinistre sbire de Neonazix reprned du poil de la bête et se trtansforme en Dark Vador. Polytechniman est capturé mais parvient à s''échapper ; le combat final met en scène la victoire complète du Polytechnqiue-MegaZord grâce au combo patrie-fist-sciences...', 2010, NULL, 'webm');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `similaires`
--
ALTER TABLE `similaires`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
MODIFY `video` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
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
