-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 12 avr. 2021 à 19:36
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `Acteur`
--

CREATE TABLE `Acteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `dateNaissance` date NOT NULL,
  `imgPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Acteur`
--

INSERT INTO `Acteur` (`id`, `nom`, `prenom`, `sexe`, `dateNaissance`, `imgPath`) VALUES
(1, 'Mortensen', 'Viggo', 'masculin', '1958-10-20', 'img/viggomortensen.jpg'),
(2, 'McKellen', 'Ian', 'masculin', '1939-05-25', 'img/ianmckellen.jpg'),
(3, 'Fassbender', 'Michael', 'masculin', '1977-04-02', 'img/michaelfassbender.jpg'),
(4, 'Tyler', 'Liv', 'feminin', '1977-07-01', 'img/livtyler.jpg'),
(5, 'Johansson', 'Scarlett', 'feminin', '1984-11-22', 'img/scarlettjohansson.jpg'),
(6, 'Murray', 'Bill', 'masculin', '1950-09-21', 'img/billmurray.jpg'),
(7, 'Malek', 'Rami', 'masculin', '1981-05-12', 'img/ramimalek.jpg'),
(8, 'Dunst', 'Kirsten', 'feminin', '1982-04-30', 'img/kirstendunst.jpg'),
(9, 'maguire', 'Tobey', 'masculin', '1975-06-27', 'img/tobeymaguire.jpg'),
(10, 'Holland', 'Tom', 'masculin', '1996-06-01', 'img/tomholland.jpg'),
(11, 'Wilson', 'Owen', 'masculin', '1968-11-18', 'img/owenwilson.jpg'),
(13, 'Dafoe', 'Willem', 'masculin', '1955-07-22', 'img/willemdafoe.jpg'),
(16, 'Allen', 'Woody', 'masculin', '1935-12-01', 'img/woodyallen.jpg'),
(17, 'Jackman', 'Hugh', 'masculin', '1968-10-12', 'img/hughjackman.jpg'),
(26, 'Blanchett', 'Cate ', 'feminin', '1969-05-14', 'img/cateblanchett.jpg'),
(27, 'Stewart', 'Kristen', 'feminin', '1990-04-09', 'img/kristenstewart.jpg');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `ageacteurs`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `ageacteurs` (
`prenom` varchar(255)
,`nom` varchar(255)
,`diff` int(7)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `agefilms`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `agefilms` (
`titre` varchar(255)
,`sortie` date
,`DATEDIFF(``sortie``, CURRENT_DATE)` int(7)
);

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

CREATE TABLE `casting` (
  `fk_film_id` int(11) NOT NULL,
  `fk_acteur_id` int(11) NOT NULL,
  `fk_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `casting`
--

INSERT INTO `casting` (`fk_film_id`, `fk_acteur_id`, `fk_role_id`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 4, 4),
(1, 26, 50),
(2, 2, 2),
(3, 2, 3),
(3, 17, 43),
(4, 3, 3),
(4, 17, 43),
(5, 7, 8),
(6, 4, 5),
(7, 5, 7),
(7, 6, 6),
(8, 8, 9),
(9, 8, 10),
(9, 9, 11),
(9, 13, 14),
(10, 10, 11),
(11, 8, 12),
(14, 6, 13),
(14, 11, 39),
(14, 13, 25),
(17, 27, 55),
(18, 11, 42),
(19, 5, 46),
(19, 16, 45),
(19, 17, 44),
(20, 5, 49),
(27, 26, 52),
(28, 27, 54);

-- --------------------------------------------------------

--
-- Structure de la table `est_classifié`
--

CREATE TABLE `est_classifié` (
  `fk_film_id` int(11) NOT NULL,
  `fk_genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `est_classifié`
--

INSERT INTO `est_classifié` (`fk_film_id`, `fk_genre_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 2),
(6, 5),
(7, 4),
(8, 5),
(9, 2),
(10, 2),
(11, 5),
(13, 11),
(14, 5),
(14, 9),
(14, 13),
(16, 4),
(16, 5),
(16, 14),
(17, 5),
(18, 9),
(19, 9),
(19, 13),
(19, 15),
(20, 5),
(20, 15),
(27, 5),
(28, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Film`
--

CREATE TABLE `Film` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `sortie` date NOT NULL,
  `duree` int(11) DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `note` tinyint(4) NOT NULL,
  `imgPath` varchar(255) NOT NULL,
  `fk_realisateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Film`
--

INSERT INTO `Film` (`id`, `titre`, `sortie`, `duree`, `resume`, `note`, `imgPath`, `fk_realisateur_id`) VALUES
(1, 'Le Seigneur des anneaux - La communauté de l\'anneau', '2001-12-19', 178, ' Dans ce chapitre de la trilogie, le jeune et timide Hobbit, Frodon Sacquet, hérite d\'un anneau. Bien loin d\'être une simple babiole, il s\'agit de l\'Anneau Unique, un instrument de pouvoir absolu qui permettrait à Sauron, le Seigneur des ténèbres, de régner sur la Terre du Milieu et de réduire en esclavage ses peuples. À moins que Frodon, aidé d\'une Compagnie constituée de Hobbits, d\'Hommes, d\'un Magicien, d\'un Nain, et d\'un Elfe, ne parvienne à emporter l\'Anneau à travers la Terre du Milieu jusqu\'à la Crevasse du Destin, lieu où il a été forgé, et à le détruire pour toujours. Un tel périple signifie s\'aventurer très loin en Mordor, les terres du Seigneur des ténèbres, où est rassemblée son armée d\'Orques maléfiques... La Compagnie doit non seulement combattre les forces extérieures du mal mais aussi les dissensions internes et l\'influence corruptrice qu\'exerce l\'Anneau lui-même.\r\nL\'issue de l\'histoire à venir est intimement liée au sort de la Compagnie. ', 4, 'img/leseigneurdesanneaux.jpg', 1),
(2, 'Le Hobbit : un voyage inattendu\r\n', '2012-12-12', 169, ' Dans UN VOYAGE INATTENDU, Bilbon Sacquet cherche à reprendre le Royaume perdu des Nains d\'Erebor, conquis par le redoutable dragon Smaug. Alors qu\'il croise par hasard la route du magicien Gandalf le Gris, Bilbon rejoint une bande de 13 nains dont le chef n\'est autre que le légendaire guerrier Thorin Écu-de-Chêne. Leur périple les conduit au cœur du Pays Sauvage, où ils devront affronter des Gobelins, des Orques, des Ouargues meurtriers, des Araignées géantes, des Métamorphes et des Sorciers…\r\nBien qu\'ils se destinent à mettre le cap sur l\'Est et les terres désertiques du Mont Solitaire, ils doivent d\'abord échapper aux tunnels des Gobelins, où Bilbon rencontre la créature qui changera à jamais le cours de sa vie : Gollum.\r\nC\'est là qu\'avec Gollum, sur les rives d\'un lac souterrain, le modeste Bilbon Sacquet non seulement se surprend à faire preuve d\'un courage et d\'une intelligence inattendus, mais parvient à mettre la main sur le \"précieux\" anneau de Gollum qui recèle des pouvoirs cachés… Ce simple anneau d\'or est lié au sort de la Terre du Milieu, sans que Bilbon s\'en doute encore… ', 3, 'img/lehobbit.jpg', 1),
(3, 'Xmen', '2000-08-16', 105, ' 1944, dans un camp de concentration. Séparé par la force de ses parents, le jeune Erik Magnus Lehnsherr se découvre d\'étranges pouvoirs sous le coup de la colère : il peut contrôler les métaux. C\'est un mutant. Soixante ans plus tard, l\'existence des mutants est reconnue mais provoque toujours un vif émoi au sein de la population. Puissant télépathe, le professeur Charles Xavier dirige une école destinée à recueillir ces êtres différents, souvent rejetés par les humains, et accueille un nouveau venu solitaire au passé mystérieux : Logan, alias Wolverine. En compagnie de Cyclope, Tornade et Jean Grey, les deux hommes forment les X-Men et vont affronter les sombres mutants ralliés à la cause de Erik Lehnsherr / Magnéto, en guerre contre l\'humanité. ', 4, 'img/xmen.jpg', 2),
(4, 'X-Men: Days of Future Past\r\n', '2014-05-21', 132, 'Les X-Men envoient Wolverine dans le passé pour changer un événement historique majeur, qui pourrait impacter mondialement humains et mutants. ', 4, 'img/xmendaysoffuturepast.jpg', 2),
(5, 'Bohemian Rhapsody', '2018-10-31', 135, 'Bohemian Rhapsody retrace le destin extraordinaire du groupe Queen et de leur chanteur emblématique Freddie Mercury, qui a défié les stéréotypes, brisé les conventions et révolutionné la musique. Du succès fulgurant de Freddie Mercury à ses excès, risquant la quasi-implosion du groupe, jusqu’à son retour triomphal sur scène lors du concert Live Aid, alors qu’il était frappé par la maladie, découvrez la vie exceptionnelle d’un homme qui continue d’inspirer les outsiders, les rêveurs et tous ceux qui aiment la musique. ', 3, 'img/bohemianrhapsody.jpg', 2),
(6, 'Super', '2011-07-13', 96, 'Un homme décide de devenir un super-héros après avoir vu sa femme succomber aux charmes d\'un dealer. Mais il n\'a pas de super-pouvoirs...', 4, 'img/super.jpg', 4),
(7, 'Lost in translation', '2004-01-07', 102, ' Bob Harris, acteur sur le déclin, se rend à Tokyo pour tourner un spot publicitaire. Il a conscience qu\'il se trompe - il devrait être chez lui avec sa famille, jouer au théâtre ou encore chercher un rôle dans un film -, mais il a besoin d\'argent. Du haut de son hôtel de luxe, il contemple la ville, mais ne voit rien. Il est ailleurs, détaché de tout, incapable de s\'intégrer à la réalité qui l\'entoure, incapable également de dormir à cause du décalage horaire. Dans ce même établissement, Charlotte, une jeune Américaine fraîchement diplômée, accompagne son mari, photographe de mode. Ce dernier semble s\'intéresser davantage à son travail qu\'à sa femme. Se sentant délaissée, Charlotte cherche un peu d\'attention. Elle va en trouver auprès de Bob... ', 4, 'img/lostintranslation.jpg', 5),
(8, 'Virgin Suicides', '2000-09-27', 96, ' Dans une ville américaine tranquille et puritaine des années soixante-dix, Cecilia Lisbon, treize ans, tente de se suicider. Elle a quatre soeurs, de jolies adolescentes. Cet incident éclaire d\'un jour nouveau le mode de vie de toute la famille. L\'histoire, relatée par l\'intermédiare de la vision des garçons du voisinage, obsédés par ces soeurs mystérieuses, dépeint avec cynisme la vie adolescente. Petit a petit, la famille se referme et les filles reçoivent rapidement l\'interdiction de sortir. Alors que la situation s\'enlise, les garçons envisagent de secourir les filles. ', 4, 'img/virginsuicides.jpg', 5),
(9, 'Spiderman', '2002-07-12', 121, 'Orphelin, Peter Parker est élevé par sa tante May et son oncle Ben dans le quartier Queens de New York. Tout en poursuivant ses études à l&#39;université, il trouve un emploi de photographe au journal Daily Bugle. Il partage son appartement avec Harry Osborn, son meilleur ami, et rêve de séduire la belle Mary Jane.Cependant, après avoir été mordu par une araignée génétiquement modifiée, Peter voit son agilité et sa force s&#39;accroître et se découvre des pouvoirs surnaturels. Devenu Spider-Man, il décide d&#39;utiliser ses nouvelles capacités au service du bien.Au même moment, le père de Harry, le richissime industriel Norman Osborn, est victime d&#39;un accident chimique qui a démesurément augmenté ses facultés intellectuelles et sa force, mais l&#39;a rendu fou. Il est devenu le Bouffon Vert, une créature démoniaque qui menace la ville. Entre lui et Spider-Man, une lutte sans merci s&#39;engage. ', 4, 'img/spiderman.jpg', 6),
(10, 'Spiderman : Homecoming', '2017-07-12', 133, ' Après ses spectaculaires débuts dans Captain America : Civil War, le jeune Peter Parker découvre peu à peu sa nouvelle identité, celle de Spider-Man, le super-héros lanceur de toile. Galvanisé par son expérience avec les Avengers, Peter rentre chez lui auprès de sa tante May, sous l’œil attentif de son nouveau mentor, Tony Stark. Il s’efforce de reprendre sa vie d’avant, mais au fond de lui, Peter rêve de se prouver qu’il est plus que le sympathique super héros du quartier. L’apparition d’un nouvel ennemi, le Vautour, va mettre en danger tout ce qui compte pour lui... ', 3, 'img/spidermanhomecoming.jpg', 7),
(11, 'Melancholia', '2011-08-10', 130, 'À l\'occasion de leur mariage, Justine et Michael donnent une somptueuse réception dans la maison de la soeur de Justine et de son beau-frère. Pendant ce temps, la planète Melancholia se dirige vers la Terre... ', 4, 'img/melancholia.jpg', 8),
(13, 'Horribilis', '2006-04-19', 95, ' L&#39;homme d&#39;affaires Grant Grant est un des citoyens les plus fortunés de la paisible bourgade de Wheelsy, mais son luxueux train de vie et son opulente résidence ne suffisent pas à compenser l&#39;indifférence croissante de sa jeune et belle épouse, Starla, qu&#39;il aime d&#39;un amour sans retour. A part cela, tout baigne pour lui, ou plutôt tout baignait avant une certaine balade nocturne... Au cours d&#39;une virée dans les bois, Grant et sa consolatrice d&#39;un soir, Brenda, découvrent une masse gélatineuse d&#39;origine extraterrestre à proximité d&#39;un cratère creusé de fraîche date. Soudain, un puissant tentacule jaillit de la masse informe, enserrant Grant avant de lui inoculer un germe mortel... Starla constate bientôt chez son mari les symptômes d&#39;une insidieuse et troublante métamorphose... ', 3, 'img/horribilis.jpg', 1),
(14, 'La vie aquatique', '2005-04-09', 118, ' Steve Z., le chef de l&#39;équipe océanographique ', 4, 'img/lavieaquatique.jpg', 11),
(16, 'Bright Star', '2010-01-06', 120, ' Londres, 1818. Un jeune poète anglais de 23 ans, John Keats, et sa voisine Fanny Brawne entament une liaison amoureuse secrète. Pourtant, les premiers contacts entre les deux jeunes gens sont assez froids. John trouve que Fanny est une jeune fille élégante mais trop effrontée, et elle-même n&#39;est pas du tout impressionnée par la littérature. C&#39;est la maladie du jeune frère de John qui va les rapprocher. Keats est touché par les efforts que déploie Fanny pour les aider, et il accepte de lui enseigner la poésie. Lorsque la mère de Fanny et le meilleur ami de Keats, Brown, réalisent l&#39;attachement que se portent les deux jeunes gens, il est trop tard pour les arrêter. Emportés par l&#39;intensité de leurs sentiments, les deux amoureux sont irrémédiablement liés et découvrent sensations et sentiments inconnus. &#34; J&#39;ai l&#39;impression de me dissoudre &#34;, écrira Keats. Ensemble, ils partagent chaque jour davantage une obsédante passion romantique qui résiste aux obstacles de plus en plus nombreux. La maladie de Keats va pourtant tout remettre en cause... ', 5, 'img/brightstar.jpg', 16),
(17, 'Certaines femmes', '2017-04-22', 107, ' Quatre femmes font face aux circonstances et aux challenges de leurs vies respectives dans une petite ville du Montana, chacune s’efforçant à sa façon de s’accomplir. ', 4, 'img/certainesfemmes.jpg', 17),
(18, 'Minuit à Paris', '2011-05-11', 94, ' Un jeune couple d’américains dont le mariage est prévu à l’automne se rend pour quelques jours à Paris. La magie de la capitale ne tarde pas à opérer, tout particulièrement sur le jeune homme amoureux de la Ville-lumière et qui aspire à une autre vie que la sienne. ', 4, 'img/minuitaparis.jpg', 9),
(19, 'Scoop', '2006-11-01', 96, ' L&#39;enquête du célèbre journaliste d&#39;investigation Joe Strombel, consacrée au &#34;Tueur au Tarot&#34; de Londres, tourne court quand il meurt de façon aussi soudaine qu&#39;inexplicable. Mais rien, pas même la mort, ne peut arrêter Joe. A peine arrivé au purgatoire, il décide de transmettre ses toutes dernières informations à la plus charmante des étudiantes en journalisme : Sondra Pransky. De passage à Londres, Sondra entend le fantôme de Joe s&#39;adresser à elle durant un numéro de magie de l&#39;Américain Splendini, alias Sid Waterman. Bouleversée et folle de joie à l&#39;idée d&#39;avoir déniché le scoop du siècle, l&#39;effervescente créature se lance avec Sid dans une enquête échevelée, qui les mène droit au fringant aristocrate et politicien Peter Lyman. Une idylle se noue en dépit de troublants indices semblant désigner le beau Peter comme le &#34;Tueur au Tarot&#34;. Le scoop de Sondra lui sera-t-il fatal ? ', 3, 'img/scoop.jpg', 9),
(20, 'Match Point', '2005-10-26', 123, ' Jeune prof de tennis issu d&#39;un milieu modeste, Chris Wilton se fait embaucher dans un club huppé des beaux quartiers de Londres. Il ne tarde pas à sympathiser avec Tom Hewett, un jeune homme de la haute société avec qui il partage sa passion pour l&#39;opéra. Très vite, Chris fréquente régulièrement les Hewett et séduit Chloe, la sœur de Tom. Alors qu&#39;il s&#39;apprête à l&#39;épouser et qu&#39;il voit sa situation sociale se métamorphoser, il fait la connaissance de la ravissante fiancée de Tom, Nola Rice, une jeune Américaine venue tenter sa chance comme comédienne en Angleterre... ', 4, 'img/matchpoint.jpg', 9),
(27, 'Blue Jasmine', '2013-09-25', 98, '  Alors qu’elle voit sa vie voler en éclat et son mariage avec Hal, un homme d’affaire fortuné, battre sérieusement de l’aile, Jasmine quitte son New York raffiné et mondain pour San Francisco et s’installe dans le modeste appartement de sa soeur Ginger afin de remettre de l’ordre dans sa vie.', 4, 'img/bluejasmine.jpg', 9),
(28, 'Café Society', '2016-05-11', 96, ' New York, dans les années 30. Coincé entre des parents conflictuels, un frère gangster et la bijouterie familiale, Bobby Dorfman a le sentiment d&#39;étouffer ! Il décide donc de tenter sa chance à Hollywood où son oncle Phil, puissant agent de stars, accepte de l&#39;engager comme coursier. À Hollywood, Bobby ne tarde pas à tomber amoureux. Malheureusement, la belle n&#39;est pas libre et il doit se contenter de son amitié.  Jusqu&#39;au jour où elle débarque chez lui pour lui annoncer que son petit ami vient de rompre. Soudain, l&#39;horizon s&#39;éclaire pour Bobby et l&#39;amour semble à portée de main… ', 4, 'img/cafesociety.jpg', 9);

-- --------------------------------------------------------

--
-- Structure de la table `Genre`
--

CREATE TABLE `Genre` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Genre`
--

INSERT INTO `Genre` (`id`, `libelle`) VALUES
(1, 'fantasy'),
(2, 'superheros'),
(3, 'Biopic'),
(4, 'romance'),
(5, 'drame'),
(6, 'comédie romantique'),
(7, 'comédie musicale'),
(9, 'comédie'),
(11, 'horreur'),
(13, 'action'),
(14, 'historique'),
(15, 'policier');

-- --------------------------------------------------------

--
-- Structure de la table `Realisateur`
--

CREATE TABLE `Realisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `dateNaissance` date NOT NULL,
  `imgPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Realisateur`
--

INSERT INTO `Realisateur` (`id`, `nom`, `prenom`, `sexe`, `dateNaissance`, `imgPath`) VALUES
(1, 'Jackson', 'Peter', 'masculin', '1961-10-31', 'img/peterjackson.jpg'),
(2, 'Singer', 'Bryan', 'masculin', '1965-09-17', 'img/bryansinger.jpg'),
(4, 'Gunn', 'James', 'masculin', '1970-08-05', 'img/jamesgunn.jpg'),
(5, 'Coppola', 'Sofia', 'feminin', '1971-05-14', 'img/sofiacoppola.jpg'),
(6, 'Raimi', 'Sam', 'masculin', '1959-10-23', 'img/samraimi.jpg'),
(7, 'Watts', 'Jon', 'masculin', '1981-06-28', 'img/jonwatts.jpg'),
(8, 'Von Trier', 'Lars', 'masculin', '1956-04-30', 'img/larsvontrier.jpg'),
(9, 'Allen', 'Woody', 'masculin', '1935-12-01', 'img/woodyallen.jpg'),
(11, 'Anderson', 'Wes', 'masculin', '1969-05-01', 'img/wesanderson.jpg'),
(16, 'Campion', 'Jane', 'feminin', '1954-04-30', 'img/janecampion.jpg'),
(17, 'Reichardt', 'Kelly', 'feminin', '1964-03-03', 'img/kellyreichardt.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Role`
--

CREATE TABLE `Role` (
  `id` int(11) NOT NULL,
  `personnage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Role`
--

INSERT INTO `Role` (`id`, `personnage`) VALUES
(1, 'Aragorn'),
(2, 'Gandalf'),
(3, 'Magneto'),
(4, 'Arwen'),
(5, 'Sarah'),
(6, 'Bob Harris'),
(7, 'Charlotte'),
(8, 'Freddie Mercury'),
(9, 'Lux Lisbon'),
(10, 'Mary Jane Watson'),
(11, 'Peter Parker'),
(12, 'Justine'),
(13, 'Steve Zessou'),
(14, 'Bouffon Vert'),
(25, 'Klaus Daimler'),
(39, 'Ned Plimpton'),
(42, 'Gil'),
(43, 'Wolverine'),
(44, 'Peter Lyman'),
(45, 'Strombini'),
(46, 'Sondra Pransky'),
(47, 'Strombini'),
(48, 'Strombini'),
(49, 'Nola Rice'),
(50, 'Galadriel'),
(51, 'Galadriel'),
(52, 'Jasmine'),
(53, 'Jasmine'),
(54, 'Vonnie'),
(55, 'Beth Travis');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`email`, `pseudo`, `password`, `id`) VALUES
('bouboulou@hotmail.fr', 'bouboulou', '$2y$10$YJBDNQyjLBDNCpBdUXYBReoRV7UXB8GcZQSaiCiFUQJmEKrmPcV6K', 1),
('gandalf@gmail.com', 'gandalf', '$2y$10$lRPObiojsCiV33iymy3QaeTpxFobxwCtqdIqofYApx1NSUjjt5tXO', 4);

-- --------------------------------------------------------

--
-- Structure de la vue `ageacteurs`
--
DROP TABLE IF EXISTS `ageacteurs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ageacteurs`  AS SELECT `acteur`.`prenom` AS `prenom`, `acteur`.`nom` AS `nom`, to_days(`acteur`.`dateNaissance`) - to_days(curdate()) AS `diff` FROM `acteur` ;

-- --------------------------------------------------------

--
-- Structure de la vue `agefilms`
--
DROP TABLE IF EXISTS `agefilms`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `agefilms`  AS SELECT `film`.`titre` AS `titre`, `film`.`sortie` AS `sortie`, to_days(`film`.`sortie`) - to_days(curdate()) AS `DATEDIFF(``sortie``, CURRENT_DATE)` FROM `film` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Acteur`
--
ALTER TABLE `Acteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`fk_film_id`,`fk_acteur_id`,`fk_role_id`),
  ADD KEY `fk_acteur_id` (`fk_acteur_id`),
  ADD KEY `fk_role_id` (`fk_role_id`);

--
-- Index pour la table `est_classifié`
--
ALTER TABLE `est_classifié`
  ADD PRIMARY KEY (`fk_film_id`,`fk_genre_id`),
  ADD KEY `fk_genre_id` (`fk_genre_id`);

--
-- Index pour la table `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_realisateur_id` (`fk_realisateur_id`);

--
-- Index pour la table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Realisateur`
--
ALTER TABLE `Realisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Acteur`
--
ALTER TABLE `Acteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `Film`
--
ALTER TABLE `Film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `Genre`
--
ALTER TABLE `Genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `Realisateur`
--
ALTER TABLE `Realisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Role`
--
ALTER TABLE `Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`fk_film_id`) REFERENCES `Film` (`id`),
  ADD CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`fk_acteur_id`) REFERENCES `Acteur` (`id`),
  ADD CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`fk_role_id`) REFERENCES `Role` (`id`);

--
-- Contraintes pour la table `est_classifié`
--
ALTER TABLE `est_classifié`
  ADD CONSTRAINT `est_classifié_ibfk_1` FOREIGN KEY (`fk_film_id`) REFERENCES `Film` (`id`),
  ADD CONSTRAINT `est_classifié_ibfk_2` FOREIGN KEY (`fk_genre_id`) REFERENCES `Genre` (`id`);

--
-- Contraintes pour la table `Film`
--
ALTER TABLE `Film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`fk_realisateur_id`) REFERENCES `Realisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
