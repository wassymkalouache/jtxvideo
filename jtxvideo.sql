-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 09 Janvier 2015 à 11:09
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient la catégorisation de toutes les vidéos' AUTO_INCREMENT=171 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `video`, `categorie`) VALUES
(92, 1, 'Musical'),
(97, 4, 'Musical'),
(98, 15, 'Campagne Kès'),
(99, 15, 'Musical'),
(102, 13, 'Polytechniman'),
(103, 14, 'Polytechniman'),
(104, 7, 'Archives'),
(105, 9, 'Campagne Kès'),
(107, 10, 'Musical'),
(108, 10, 'Rap'),
(109, 5, 'Humoristique'),
(110, 6, 'Humoristique'),
(113, 12, 'Musical'),
(114, 11, 'Poop'),
(115, 8, 'Campagne Kès'),
(116, 8, 'Clip Kès'),
(127, 16, 'Musical'),
(128, 16, 'Présentation Kès'),
(129, 3, 'Musical'),
(134, 18, 'Musical'),
(135, 19, 'Khômiss'),
(136, 20, 'Artistique'),
(137, 17, 'Musical'),
(142, 23, 'Humoristique'),
(145, 21, 'Série'),
(146, 22, 'Série'),
(150, 24, 'Série'),
(151, 25, 'Série'),
(152, 26, 'Série'),
(153, 27, 'Musical'),
(154, 28, 'Humoristique'),
(155, 28, 'Youtube'),
(156, 29, 'Humoristique'),
(169, 2, 'Campagne Kès'),
(170, 2, 'Musical');

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE IF NOT EXISTS `promotions` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `promotion` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient les promotions concernées par les vidéos' AUTO_INCREMENT=73 ;

--
-- Contenu de la table `promotions`
--

INSERT INTO `promotions` (`id`, `video`, `promotion`) VALUES
(29, 4, 2009),
(30, 4, 2010),
(31, 15, 2010),
(34, 7, 2013),
(35, 9, 2013),
(38, 11, 2013),
(39, 8, 2013),
(50, 16, 2011),
(51, 16, 2012),
(59, 18, 2012),
(60, 18, 2011),
(61, 19, 2011),
(62, 19, 2012),
(63, 28, 2013),
(64, 29, 2012),
(65, 29, 2011),
(72, 2, 2010);

-- --------------------------------------------------------

--
-- Structure de la table `similaires`
--

CREATE TABLE IF NOT EXISTS `similaires` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `similaire` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Associe des vidéos similaires à une vidéos' AUTO_INCREMENT=37 ;

--
-- Contenu de la table `similaires`
--

INSERT INTO `similaires` (`id`, `video`, `similaire`) VALUES
(13, 1, 3),
(14, 13, 14),
(15, 14, 13),
(16, 7, 8),
(17, 5, 6),
(18, 6, 5),
(20, 8, 7),
(25, 21, 22),
(26, 22, 21),
(31, 24, 25),
(32, 24, 26),
(33, 25, 24),
(34, 25, 26),
(35, 26, 24),
(36, 26, 25);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `tag` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient tous les tags des vidéos (table d''association)' AUTO_INCREMENT=2074 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `video`, `tag`) VALUES
(1234, 1, 'fioni'),
(1235, 1, 'picelli'),
(1236, 1, 'resvoy'),
(1237, 1, 'scola'),
(1238, 1, 'spam'),
(1239, 1, 'starkes'),
(1259, 4, 'cycle'),
(1260, 4, 'incorpo'),
(1261, 4, 'mili'),
(1262, 4, 'promotion'),
(1263, 4, 'soiree'),
(1264, 4, 'stage'),
(1265, 15, 'ado'),
(1266, 15, 'artifice'),
(1267, 15, 'artifix'),
(1268, 15, 'backes'),
(1269, 15, 'bataclan'),
(1270, 15, 'campagne'),
(1271, 15, 'fix'),
(1272, 15, 'future'),
(1273, 15, 'grand'),
(1274, 15, 'hall'),
(1275, 15, 'hutch'),
(1276, 15, 'kes'),
(1277, 15, 'legrix'),
(1278, 15, 'manute'),
(1279, 15, 'moquette'),
(1280, 15, 'pipo'),
(1281, 15, 'production'),
(1282, 15, 'rmpd'),
(1283, 15, 'starkes'),
(1284, 15, 'starmania'),
(1309, 13, 'aglae'),
(1310, 13, 'batman'),
(1311, 13, 'combat'),
(1312, 13, 'corde'),
(1313, 13, 'drive'),
(1314, 13, 'gu'),
(1315, 13, 'hadrien'),
(1316, 13, 'kes'),
(1317, 13, 'march'),
(1318, 13, 'martin'),
(1319, 13, 'merdass'),
(1320, 13, 'merdasse'),
(1321, 13, 'mythe'),
(1322, 13, 'neonazix'),
(1323, 13, 'organes'),
(1324, 13, 'pelletier'),
(1325, 13, 'polytechniman'),
(1326, 13, 'shalom'),
(1327, 13, 'starkes'),
(1328, 13, 'starklouvitch'),
(1329, 13, 'strimoule'),
(1330, 13, 'tos'),
(1331, 13, 'vador'),
(1332, 13, 'xy'),
(1333, 14, 'bas'),
(1334, 14, 'capture'),
(1335, 14, 'chat'),
(1336, 14, 'chinois'),
(1337, 14, 'clone'),
(1338, 14, 'combat'),
(1339, 14, 'corde'),
(1340, 14, 'fist'),
(1341, 14, 'foudre'),
(1342, 14, 'gamma'),
(1343, 14, 'gu'),
(1344, 14, 'info'),
(1345, 14, 'local'),
(1346, 14, 'mythe'),
(1347, 14, 'neonazix'),
(1348, 14, 'nord'),
(1349, 14, 'organe'),
(1350, 14, 'patrie'),
(1351, 14, 'peripherique'),
(1352, 14, 'point'),
(1353, 14, 'polytechniman'),
(1354, 14, 'rein'),
(1355, 14, 'sciences'),
(1356, 14, 'streblouze'),
(1357, 14, 'torture'),
(1358, 14, 'transformers'),
(1359, 14, 'vador'),
(1360, 7, 'dalton'),
(1361, 7, 'k7'),
(1362, 7, 'lucky'),
(1363, 7, 'luke'),
(1364, 7, 'lukes'),
(1365, 7, 'momie'),
(1366, 7, 'poursuite'),
(1367, 7, 'pyramide'),
(1368, 7, 'ramkes'),
(1369, 7, 'toutankesmon'),
(1370, 7, 'western'),
(1371, 9, '3d'),
(1372, 9, 'ben'),
(1373, 9, 'kes'),
(1374, 9, 'lukes'),
(1375, 9, 'resultats'),
(1376, 9, 'ukes'),
(1389, 10, 'battle'),
(1390, 10, 'borotra'),
(1391, 10, 'history'),
(1392, 10, 'mythe'),
(1393, 10, 'rap'),
(1394, 10, 'rue'),
(1395, 10, 'vaneau'),
(1396, 5, 'alu'),
(1397, 5, 'aluminium'),
(1398, 5, 'chapeau'),
(1399, 5, 'conf'),
(1400, 5, 'conference'),
(1401, 5, 'dfhm'),
(1402, 5, 'merdass'),
(1403, 5, 'militaire'),
(1404, 5, 'montebourg'),
(1405, 5, 'personnages'),
(1406, 5, 'pin'),
(1407, 5, 'sanselme'),
(1408, 5, 'software'),
(1409, 5, 'thon'),
(1410, 6, 'agressif'),
(1411, 6, 'animaux'),
(1412, 6, 'autorite'),
(1413, 6, 'deconnade'),
(1414, 6, 'dominantes'),
(1415, 6, 'hibou'),
(1416, 6, 'hss311'),
(1417, 6, 'manager'),
(1418, 6, 'merdass'),
(1419, 6, 'mintzberg'),
(1420, 6, 'perturbateurs'),
(1421, 6, 'posture'),
(1422, 6, 'regression'),
(1423, 6, 'sanselme'),
(1424, 6, 'software'),
(1425, 6, 'software'),
(1426, 6, 'veneneux'),
(1446, 12, 'ado'),
(1447, 12, 'fist'),
(1448, 12, 'jacques'),
(1449, 12, 'lundi'),
(1450, 12, 'nassar'),
(1451, 12, 'psc'),
(1452, 12, 'scola'),
(1453, 12, 'souad'),
(1454, 12, 'soutenance'),
(1455, 12, 'subaisse'),
(1456, 12, 'virginie'),
(1457, 11, 'demay'),
(1458, 11, 'devise'),
(1459, 11, 'euh'),
(1460, 11, 'explosion'),
(1461, 11, 'grouze'),
(1462, 11, 'incorpo'),
(1463, 11, 'moule'),
(1464, 11, 'poop'),
(1465, 11, 'pornographique'),
(1466, 11, 'studyrama'),
(1467, 11, 'tatiana'),
(1468, 11, 'tintin'),
(1469, 8, 'baignade'),
(1470, 8, 'banque'),
(1471, 8, 'bob'),
(1472, 8, 'chaboty'),
(1473, 8, 'dalton'),
(1474, 8, 'duel'),
(1475, 8, 'dulac'),
(1476, 8, 'foessel'),
(1477, 8, 'holiner'),
(1478, 8, 'ik'),
(1479, 8, 'indiens'),
(1480, 8, 'jolly'),
(1481, 8, 'jumper'),
(1482, 8, 'lac'),
(1483, 8, 'legrix'),
(1484, 8, 'lucky'),
(1485, 8, 'luke'),
(1486, 8, 'say'),
(1487, 8, 'souad'),
(1608, 16, 'ado'),
(1609, 16, 'big'),
(1610, 16, 'bison'),
(1611, 16, 'brice'),
(1612, 16, 'cactus'),
(1613, 16, 'camionette'),
(1614, 16, 'casse'),
(1615, 16, 'cerisier'),
(1616, 16, 'cocktail'),
(1617, 16, 'gorets'),
(1618, 16, 'kes'),
(1619, 16, 'lemonnier'),
(1620, 16, 'magnum'),
(1621, 16, 'mexikes'),
(1622, 16, 'mina'),
(1623, 16, 'missaire'),
(1624, 16, 'nu'),
(1625, 16, 'one'),
(1626, 16, 'perouse'),
(1627, 16, 'raid'),
(1628, 16, 'rap'),
(1629, 16, 'toits'),
(1630, 16, 'venise'),
(1631, 16, 'zaza'),
(1632, 3, 'ado'),
(1633, 3, 'agro'),
(1634, 3, 'de'),
(1635, 3, 'equitation'),
(1636, 3, 'faerix'),
(1637, 3, 'fist'),
(1638, 3, 'improbinet'),
(1639, 3, 'sddx'),
(1640, 3, 'subaisse'),
(1724, 18, 'ado'),
(1725, 18, 'bob'),
(1726, 18, 'corons'),
(1727, 18, 'deleforge'),
(1728, 18, 'demi'),
(1729, 18, 'drone'),
(1730, 18, 'famille'),
(1731, 18, 'genek'),
(1732, 18, 'hatchuel'),
(1733, 18, 'haut'),
(1734, 18, 'jtx'),
(1735, 18, 'kes'),
(1736, 18, 'kro'),
(1737, 18, 'lobato'),
(1738, 18, 'lozere'),
(1739, 18, 'lune'),
(1740, 18, 'manute'),
(1741, 18, 'marches'),
(1742, 18, 'mengelle'),
(1743, 18, 'pales'),
(1744, 18, 'pipeau'),
(1745, 18, 'platal'),
(1746, 18, 'promo'),
(1747, 18, 'rer'),
(1748, 18, 'styx'),
(1749, 19, 'chaboty'),
(1750, 19, 'cour'),
(1751, 19, 'discours'),
(1752, 19, 'dissolution'),
(1753, 19, 'genek'),
(1754, 19, 'gontier'),
(1755, 19, 'khomiss'),
(1756, 19, 'missaires'),
(1757, 19, 'promotion'),
(1758, 19, 'strass'),
(1759, 19, 'vaneau'),
(1760, 20, 'pacard'),
(1761, 20, 'tableau'),
(1762, 20, 'mat311'),
(1763, 20, 'convergence'),
(1764, 20, 'faible'),
(1765, 20, 'fractale'),
(1766, 20, 'vibes'),
(1767, 20, 'mandelbrot'),
(1768, 20, 'fx'),
(1769, 20, 'effets'),
(1770, 20, 'speciaux'),
(1771, 20, '3d'),
(1772, 20, 'isododecaedre'),
(1773, 20, 'baton'),
(1774, 20, 'laser'),
(1775, 20, 'nombre'),
(1776, 20, 'or'),
(1777, 20, 'fibonacci'),
(1778, 17, 'bar'),
(1779, 17, 'bifluore'),
(1780, 17, 'casserole'),
(1781, 17, 'chanson'),
(1782, 17, 'clavier'),
(1783, 17, 'congelo'),
(1784, 17, 'cuisine'),
(1785, 17, 'etage'),
(1786, 17, 'frigo'),
(1787, 17, 'micro'),
(1788, 17, 'monde'),
(1789, 17, 'nucleaire'),
(1790, 17, 'omelette'),
(1791, 17, 'ondes'),
(1792, 17, 'pates'),
(1793, 17, 'pizza'),
(1794, 17, 'pomme'),
(1795, 17, 'random'),
(1796, 17, 'remix'),
(1797, 17, 'rois'),
(1798, 17, 'terre'),
(1799, 17, 'vaisselle'),
(1847, 23, 'facebook'),
(1848, 23, 'x2012'),
(1849, 23, 'gontier'),
(1850, 23, 'lobato'),
(1851, 23, 'azria'),
(1852, 23, 'commentaires'),
(1853, 23, 'carantino'),
(1854, 23, 'post'),
(1855, 23, 'cours'),
(1876, 21, 'amor'),
(1877, 21, 'amour'),
(1878, 21, 'antonio'),
(1879, 21, 'delaunay'),
(1880, 21, 'dolores'),
(1881, 21, 'ernesto'),
(1882, 21, 'espagol'),
(1883, 21, 'feuilleton'),
(1884, 21, 'fuerza'),
(1885, 21, 'germain'),
(1886, 21, 'hector'),
(1887, 21, 'hispanique'),
(1888, 21, 'intrigue'),
(1889, 21, 'lobato'),
(1890, 21, 'maribel'),
(1891, 21, 'novela'),
(1892, 21, 'poinsard'),
(1893, 21, 'py'),
(1894, 21, 'sonia'),
(1895, 21, 'trahison'),
(1896, 22, 'cliff'),
(1897, 22, 'hanger'),
(1898, 22, 'infidelite'),
(1899, 22, 'intrigue'),
(1900, 22, 'lobato'),
(1901, 22, 'menace'),
(1902, 22, 'rupture'),
(1951, 24, 'casert'),
(1952, 24, 'censier'),
(1953, 24, 'deteck'),
(1954, 24, 'detective'),
(1955, 24, 'enquete'),
(1956, 24, 'gouhier'),
(1957, 24, 'langues'),
(1958, 24, 'nissaire'),
(1959, 24, 'platal'),
(1960, 24, 'sherlocx'),
(1961, 24, 'shotgun'),
(1962, 25, 'bataclan'),
(1963, 25, 'bernache'),
(1964, 25, 'bl'),
(1965, 25, 'borne'),
(1966, 25, 'branta'),
(1967, 25, 'canadensis'),
(1968, 25, 'casert'),
(1969, 25, 'cassee'),
(1970, 25, 'censier'),
(1971, 25, 'corde'),
(1972, 25, 'detective'),
(1973, 25, 'enlevement'),
(1974, 25, 'enquete'),
(1975, 25, 'genek'),
(1976, 25, 'gouhier'),
(1977, 25, 'hache'),
(1978, 25, 'kes'),
(1979, 25, 'missaire'),
(1980, 25, 'previously'),
(1981, 25, 'sherlock'),
(1982, 25, 'vitre'),
(1983, 26, 'bas'),
(1984, 26, 'bataclan'),
(1985, 26, 'ca'),
(1986, 26, 'detective'),
(1987, 26, 'enquete'),
(1988, 26, 'gouellec'),
(1989, 26, 'gouhier'),
(1990, 26, 'lobato'),
(1991, 26, 'local'),
(1992, 26, 'meurtre'),
(1993, 26, 'missaire'),
(1994, 26, 'moriarty'),
(1995, 26, 'mycroft'),
(1996, 26, 'piscine'),
(1997, 26, 'sherlock'),
(1998, 26, 'toit'),
(1999, 26, 'censier'),
(2000, 27, 'gu'),
(2001, 27, 'balavoine'),
(2002, 27, 'defile'),
(2003, 27, '14'),
(2004, 27, 'juillet'),
(2005, 27, 'tangente'),
(2006, 27, 'styx'),
(2007, 27, 'para'),
(2008, 27, 'nabla'),
(2009, 27, 'chanson'),
(2010, 27, 'missaire'),
(2011, 27, 'souterrains'),
(2012, 27, 'khomiss'),
(2013, 27, 'promotion'),
(2014, 28, 'biscuits'),
(2015, 28, 'combat'),
(2016, 28, 'rasket'),
(2017, 28, 'epic'),
(2018, 28, 'whisky'),
(2019, 28, 'rations'),
(2020, 28, 'camembert'),
(2021, 28, 'fondu'),
(2022, 28, 'pain'),
(2023, 28, 'mie'),
(2024, 28, 'fromage'),
(2025, 28, 'sauce'),
(2026, 28, 'salade'),
(2027, 28, 'mexicaine'),
(2028, 28, 'porc'),
(2029, 28, 'creole'),
(2030, 28, 'muesli'),
(2031, 28, 'terrine'),
(2032, 28, 'cerf'),
(2033, 28, 'chocolat'),
(2034, 28, 'parmentier'),
(2035, 28, 'canard'),
(2036, 28, 'rechaud'),
(2037, 28, 'potage'),
(2038, 28, 'sansdiwch'),
(2039, 28, 'degustation'),
(2040, 29, 'treillis'),
(2041, 29, 'rassemblement'),
(2042, 29, 'compagnie'),
(2043, 29, 'casert'),
(2044, 29, 'carre'),
(2045, 29, 'tos'),
(2046, 29, 'merde'),
(2047, 29, 'pompes'),
(2048, 29, 'incorpo'),
(2049, 29, 'chaussettes'),
(2050, 29, 'armee'),
(2051, 29, 'rangers'),
(2052, 29, 'ceinturon'),
(2053, 29, 'veste'),
(2054, 29, 'sied'),
(2055, 29, 'bien'),
(2056, 29, 'geoffroy'),
(2057, 29, 'chevalier'),
(2070, 2, 'bob'),
(2071, 2, 'moule'),
(2072, 2, 'pougne'),
(2073, 2, 'rmpd');

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
('dominique', '9cc140dd813383e134e7e365b203780da9376438', 'Dominique', 'Rossin', 'dominique.rossin@polytechnique.edu', 1994, 0),
('olivier', '663194f2b9123a38cd9e2e2811f8d2fd387b765e', 'Olivier', 'Serre', 'olivier.serre@polytechnique.edu', 2013, 1),
('toto', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'Toto', 'Test', 'test@toto.com', 2013, 0),
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
  `format` varchar(16) NOT NULL DEFAULT 'webm',
  `login` varchar(64) DEFAULT NULL COMMENT 'Login du dernier utilisateur à avoir modifié la description de la vidéo',
  `vues` int(11) NOT NULL DEFAULT '0' COMMENT 'Compteur de vues de la vidéo'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contient les informations sur toutes les vidéos du site' AUTO_INCREMENT=30 ;

--
-- Contenu de la table `videos`
--

INSERT INTO `videos` (`video`, `titre`, `adresse`, `proj`, `poster`, `description`, `jtx`, `annee`, `format`, `login`, `vues`) VALUES
(1, 'Spam me maybe', 'videosjtx/spammemaybe.webm', 'http://binet-jtx.com/blog/?p=1110', 'media/1.png', 'Considéré par certains comme le meilleur clip musical du JTX de tous les temps, Spam me maybe est une reprise de Call me maybe sur le thème du spam intensif qui est le quotidien de tous les polytechniciens. Le charme de l''actrice principale n''est sans doute pas étranger au succès du clip.\r\n                                        ', 2010, NULL, 'webm', 'denis.merigoux', 0),
(2, 'Elle me dit pougne', 'videosjtx/ellemeditpougne.webm', 'http://binet-jtx.com/blog/?p=940', 'media/2.png', 'Reprise de [[https://www.youtube.com/watch?v=NiHWwKC8WjU|Elle me dit]] de Mika, ce clip très rythmé et entraînant est idéal pour tuer toute culpabilité lors d''une séance de moule intensive.                                ', 2010, 0, 'webm', 'denis.merigoux', 1),
(3, 'Nous on subit', 'videosjtx/nousonsubit.webm', 'http://binet-jtx.com/blog/?p=1025', 'media/3.png', 'Ce clip est l''hymne officiel du binet Subaïsse. Pâles, cours, DE, binets, sports ; tout la vie à l''X est résumée dans ce clip à l''humour noir. C''est une des premières reprises des chansons de Stromae qui seront très prisées des JTX 2011 et 2012.                ', 2010, NULL, 'webm', 'denis.merigoux', 0),
(4, 'RAS RAS tea bag', 'videosjtx/rasrasteabag.webm', 'http://binet-jtx.com/blog/?p=940', 'media/4.png', 'Ce clip semble avoir acquis un incontestable renommée, puisqu''il a été passé en pré-proj'' par le JTX 2011 en mars, et de l''avis général, résume assez bien la vie d''une promotion, avec toute la mélancolie convenable, mélancolie qui lui a malheureusement valu un accueil mitigé au sein de la promotion 2009, puisque projeté à quelques semaines de son départ, sonnait pour certains comme un adieu avant l''heure.                                     ', 2010, NULL, 'webm', 'denis.merigoux', 0),
(5, 'S''amuser en conférence DFHM', 'videosjtx/29-s''amuser en conf DFHM.webm', 'http://binet-jtx.com/blog/?p=1496', 'media/5.jpg', '                    Ce clip présente le nouveau CD-ROM de Merdass'' Software intitulé « Comment s''amuser seul en conférence DFHM ». Production phare du JTX 2012, ce clip minimaliste ne contenant que des images fixe commenté par Marc Sanselme est à l''origine de la maxime « N''oublie pas ton papier d''alu en conf'' DFHM ! ».                ', 2012, 0, 'webm', 'denis.merigoux', 0),
(6, 'Devenir un grand manager gratuitement', 'videosjtx/32_Merdass_software_Manager.webm', 'http://binet-jtx.com/blog/?p=1559', 'media/6.jpg', '                    Deuxième production de Merdass'' Software qui nous présente cette fois-ci les dessous de l''ascension sociale. « Repérer les éléments pertubateurs aux postures agresso-dominantes », « Imiter les animaux vénéneux » et « Pas trop de déconnade » seront les maître mots de votre carrière.                ', 2012, 0, 'webm', 'denis.merigoux', 0),
(7, 'Old fruits', 'videosjtx/12_Old fruits.webm', 'http://binet-jtx.com/blog/?p=1624', 'media/7.jpg', 'Remix des clips de campagne de la Lucky LuKès (X1992) et la RamKès II (X1993) pour montrer aux deux listes Kès du second tour de la campagne X2013 (Lucky LuKès et ToutanKèsmon) que leurs idées ne sont pas si originales que ça...                ', 2013, 0, 'webm', 'denis.merigoux', 0),
(8, 'Lucky LuKès : clip de campagne', 'videosjtx/25_Clip_LuckyLukes.webm', 'http://binet-jtx.com/blog/?p=1624', 'media/8.jpg', 'Le film de la Lucky LuKès (X2013) raconte l''histoire des Daltons qui tout juste sortis de prison cherchent à dévaliser une banque. Malheureusement pour eux, des bandits sont déjà passés par là, comme dans toutes les banques de la région. Ils décident donc de suivre Lucky Luke (grandiosement interprété par Paul Michel) qui est déjà sur leurs traces.\r\n\r\nLa vidéo se termine par un duel nocturne au milieu du grand hall, entre Lucky Luke et les deux bandits (Gwendoline Tallec et Mathilde Caron, les aspis Binets). Les bandits prenant la fuite, leur capture se termine en live sur la scène du .K.\r\nC''est aussi la première longue apparition de Michaël Foessel à l''écran, qui assomme les Daltons avec une tirade sur la démocratie, la propriété et le vol.                                 ', NULL, NULL, 'webm', 'denis.merigoux', 0),
(9, 'Résultats second tour campagne Kès X2013', 'videosjtx/14_Resultats.webm', 'http://binet-jtx.com/blog/?p=1624', 'media/9.jpg', '                    Après une semaine de campagne te un premier tour, les résultats de l''élection de la 201e Kès furent annoncés le mercredi 3 décembre 2014. Le Big Ben symbolise la UKès (X2012) et sur son cadran défilent les anciennes Kès ainsi que la nouvelle.                ', 2013, 0, 'webm', 'denis.merigoux', 0),
(10, 'Epic Rap Battle Vaneau vs Borotra', 'videosjtx/25-Epic_Rap_Vaneau_Borotra.webm', 'http://jtx/blog/?p=1290', 'media/10.jpg', '                    Ce clip transpose la série Youtube « Epic Rap Batlle of History » dans le contexte de l''X avec une battle très réussie où on sent le talent du binet de la Rue nouvellement créé. Répliques cultes : « C''est pas les championnats, c''est ta mère qu''est en open ! » ou « Les gueules des gardes suisses je les ai smashées, pas amorties »...                ', 2011, 0, 'webm', 'denis.merigoux', 1),
(11, 'Incorpoop X2013', 'videosjtx/18_Incorpoop.webm', 'http://jtx/blog/?p=1310', 'media/11.jpg', 'Deuxième poop du JTX 2011 après celle de la proj'' juillet, le clip tourne autour de l''intervieuw du général Demay qui a eu le malheur de prononcer le mot « pornographique »...                                ', 2011, NULL, 'webm', 'denis.merigoux', 0),
(12, 'TNT PSC', 'videosjtx/40-TNT_PSC.webm', 'http://jtx/blog/?p=1172', 'media/12.jpg', '                    Bonne reprise musicale de TNT de AC/DC, ce clip décrit assez bien le sentiment de subaïsse extrême qui submerge les 2A le lundi après-midi.                 ', 2011, 0, 'webm', 'denis.merigoux', 0),
(13, 'Polytechniman VS Neonazix (1/2)', 'videosjtx/04-Polytechniman_Croes_premiere_partie.webm', 'http://jtx/blog/?p=1221', 'media/13.jpg', 'Première partie du plus long épisode des aventures de Polytechniman, qui cette fois-ci doit affronter le terrible Prez'' du binet Neonazix qui sème la terreur à travers l''école. Mais avant, il lui faudra terrasser le sinistre sbire de Croes et ses deux couteaux...                ', 2010, 0, 'webm', 'denis.merigoux', 0),
(14, 'Polytechniman VS Neonazix (2/2)', 'videosjtx/08-Polytechniman_Croes_deuxieme_partie.webm', 'http://jtx/blog/?p=1221', 'media/14.jpg', 'Deuxième partie de la plus longue aventure de Polytechniman. Le sinistre sbire de Neonazix reprned du poil de la bête et se trtansforme en Dark Vador. Polytechniman est capturé mais parvient à s''échapper ; le combat final met en scène la victoire complète du Polytechnqiue-MegaZord grâce au combo patrie-fist-sciences...                ', 2010, 0, 'webm', 'denis.merigoux', 0),
(15, 'Je voudrais tant être un kessier', 'videosjtx/A faire/etreunkessier.webm', 'http://binet-jtx.com/blog/?p=879', 'media/15.jpg', '                    Les aspis X2010 de la BacKès to the Future et de la StarKès &amp; Hutch nous livrent ici une émouvante reprise de Starmania – Le blues du businessman.                                                                ', 2010, NULL, 'webm', 'denis.merigoux', 0),
(16, 'MexiKès : clip de présentation', 'videosjtx/A faire/6-kes.webm', 'http://binet-jtx.com/blog/?p=1243', 'media/16.jpg', 'Mythique clip de présentation de la MexiKès diffusés pour la première fois lors de l''amphi binets des X2012. La musique est une reprise du « Casse de Brice », lui même repris de « Give me the night » de George Benson.                                                                                                                ', 2011, 2012, 'webm', 'denis.merigoux', 0),
(17, 'Les micro-ondes', 'videosjtx/A faire/microondes.webm', 'http://binet-jtx.com/blog/?p=940', 'media/17.jpg', 'Les clips parlant de la vie quotidienne des X au bar d''étage sont très rares. Celui-ci le fait d''une manière particulièrement random sur un remix de deux tubes de Chanson Plus Bifuorées : « Les mirco-ondes » et « La vaisselle ». Excellente chorégraphie et scènes cultes impliquant des congélos et des casseroles.', 2010, 0, 'webm', 'denis.merigoux', 0),
(18, 'Les corons', 'videosjtx/Corons Version Finale2 .webm', 'add2011.fr', 'media/18.jpg', 'Cette reprise de l''interprétation des « Corons » par Les Stentors fut réalisée par des X2012 comme une chanson d''adieu à leurs vieux-chouffe. Diffusée lors de l''ADD 2011, la chanson fit couler quelques larmes comme le laisse entendre la fin de la vidéo...', 2012, 2013, 'webm', 'denis.merigoux', 0),
(19, 'Discours de dissolution de la Khômiss', 'videosjtx/30-dissolution khomiss.webm', 'http://binet-jtx.com/blog/?p=1290', 'media/19.jpg', 'Restrospective du discours du colonel Gontier annonçant la dissolution de la Khômiss le 29 juin 2013. La plupart des élèves étaient venus en tenue missaire sans cagoule sur demande du GénéK.', 2011, 2013, 'webm', 'denis.merigoux', 0),
(20, 'Pacard ft. Vibes', 'videosjtx/16a_Pacard_Vibes.webm', 'http://binet-jtx.com/blog/?p=1559', 'media/20.jpg', 'Quoi de mieux pour planer sur la musique de Vibes que le cours de MAT311 ? Pacard est notre guide lors d''un voyage psychédélique vers la mystique des mathématiques illustrée à grand renfort de 3D et d''effets spéciaux...', 2012, 2014, 'webm', 'denis.merigoux', 1),
(21, 'La fuerza del amor S01E01', 'videosjtx/La Fuerza del Amor S01E01.webm', 'http://binet-jtx.com/blog/?p=1610', 'media/21.jpg', 'Superproduction du JTX 2012 à destination des ménagères du plâtal, « La fuerza del amor » est sponsorisé par le département d''espagnol. Ce feuilleton digne des meilleurs novelas sudaméricaines saura vous faire voyager au pays de l''amour et des trahisons.', 2012, 2014, 'webm', 'denis.merigoux', 0),
(22, 'La fuerza del amor S01E02', 'videosjtx/La Fuerza del Amor S01E02.webm', 'http://binet-jtx.com/blog/?p=1610', 'media/22.jpg', 'Le deuxième épisode de « La fuerza del amor » vous livrera son lot de ruptures, de menaces et d''infidélités dans le climat étouffant du plâtal. Ne pas manquer le superbe cliff hanger à la fin de l''épisode...', 2012, 2014, 'webm', 'denis.merigoux', 0),
(23, 'Facebook : groupe X2012', 'videosjtx/14-facebook X2012.webm', 'http://binet-jtx.com/blog/?p=1496', 'media/23.jpg', 'Facebook est devenu un moyen incontournable de communication pour les X, mais aussi une boîte à spam redoutable. Attention, ce clip est très proche de la réalité.', 2012, 2014, 'webm', 'denis.merigoux', 0),
(24, 'SherlocX épisode 1', 'videosjtx/24-sherlocx episode 1.webm', 'http://binet-jtx.com/blog/?p=1496', 'media/24.jpg', 'Premier épisode de la série des SherlocX, adaptation plâtalienne de la série « Sherlock ». Quentin Censier joue le premier rôle et part à la chasse d''un mystérieux missaire...', 2012, 2014, 'webm', 'denis.merigoux', 0),
(25, 'SherlocX épisode 2', 'videosjtx/10_SherlocX_Episode_2.webm', 'http://binet-jtx.com/blog/?p=1559', 'media/25.jpg', 'Pour le deuxième épisode de SherlockX, l''intrigue se complique : un faux missaire a détruit une borne du BL alors qu''un couple de bernaches détournait l''attention des kessiers. Watson est enlevé par une mystérieuse voiture à la fin de l''épisode...', 2012, 2014, 'webm', 'denis.merigoux', 0),
(26, 'SherlocX épisode 3', 'videosjtx/19_SherlocX_Episode3.webm', 'http://binet-jtx.com/blog/?p=1559', 'media/26.jpg', 'Troisième épisode de la série SherlocX starring Quentin Censier as Sherlock and Aurélien Gouhier as Watson. C''est l''heure du combat final contre celui qui se cache derrière tout ça : Lobato-Moriarty. Ne manquez pas le suspense final !', 2012, 2014, 'webm', 'denis.merigoux', 0),
(27, 'Quand on arrive en ville', 'videosjtx/non_projete-Quand_on_arrive_en_ville.webm', 'http://binet-jtx.com/blog/?p=357', 'media/27.jpg', 'Sur l''air de « Quand on arrive en ville » de Daniel Balavoine, montage très à propos avec des images de la vie de la promotion 1998.', 1998, 2000, 'webm', 'denis.merigoux', 0),
(28, 'Epic Bivouac Time', 'videosjtx/Epic Bivouac Time.webm', 'http://binet-jtx.com/blog/?p=1310', 'media/28.jpg', 'Inspiré de la chaîne Youtube « Epic Meal Time », cette vidéo a su capturer la quintessence de ce qu''est un repas sur le terrain à La Courtine.', 2011, 2013, 'webm', 'denis.merigoux', 2),
(29, 'Clip de l''habillement', 'videosjtx/06-habillement.webm', 'http://binet-jtx.com/blog/?p=1094', 'media/29.jpg', 'Le clip de l''habillement est un clip réalisé par des X2011 (alors aspis JTX) pour l''inkhôrpo des X2012. Le clip a été utilisé en boucle pour contenir l''attente des 2012 lors des projections JTX à la Courtine, c''est pourquoi il est resté en mémoire pour les promotions 2011 et 2012. Le brillant acteur du TOS est Geoffroy Chevalier X2011. ', 2011, 2012, 'webm', 'denis.merigoux', 0);

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
 ADD PRIMARY KEY (`video`), ADD KEY `titre` (`titre`), ADD KEY `login_2` (`login`), ADD FULLTEXT KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT pour la table `similaires`
--
ALTER TABLE `similaires`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2074;
--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
MODIFY `video` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
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

--
-- Contraintes pour la table `videos`
--
ALTER TABLE `videos`
ADD CONSTRAINT `LastUser` FOREIGN KEY (`login`) REFERENCES `utilisateurs` (`login`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
