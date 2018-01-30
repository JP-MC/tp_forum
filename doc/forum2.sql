-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 30 Janvier 2018 à 14:57
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum2`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `label` varchar(60) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id_category`, `label`) VALUES
(1, 'Carte mère'),
(2, 'Mémoire'),
(3, 'Processeur'),
(4, 'Carte graphique'),
(5, 'Boitier'),
(6, 'Alimentation'),
(7, 'Disque dur'),
(8, 'Disque SSD'),
(9, 'CD/DVD/BD'),
(10, 'Mini PC'),
(11, 'Matériels & problèmes divers'),
(12, 'Conseil d\'achat');

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `id_permission` int(11) NOT NULL,
  `label` varchar(60) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `permission`
--

INSERT INTO `permission` (`id_permission`, `label`) VALUES
(1, 'CAN_CREATE_TOPIC'),
(2, 'CAN_CREATE_POST'),
(3, 'CAN_EDIT_POST'),
(4, 'CAN_EDIT_OWN_POST'),
(5, 'CAN_DELETE_POST'),
(6, 'CAN_DELETE_OWN_POST'),
(7, 'CAN_DELETE_TOPIC');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `date_creation` timestamp NULL DEFAULT NULL,
  `id_topic` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id_post`, `content`, `date_creation`, `id_topic`, `id_user`) VALUES
(1, 'Règles de la section Hardware du forum[br]\r\n[br]\r\nPréambule[br]\r\n[br]\r\nCet espace de discussion a pour but de discuter, comme son nom l\'indique, du matériel informatique, que ce soit au niveau des nouveautés, de choix pour un achat ou encore de problème technique. Vous trouverez ici des règles qui se sont petit à petit imposées et améliorées en voyant grandir le forum.[br]\r\nElles résultent des lois en vigueur et du bon sens nécessaire au fonctionnement de cet espace.[br]\r\n[br]\r\nEn toute logique, la section est consacrée au matériel uniquement, les topics sur les autres sujets ont leur propre section, beaucoup plus adaptée au sujet. Merci d\'en tenir compte, dans le cas contraire votre sujet sera déplacé sans préavis et vous recevrez un mail vous avertissant de ce déplacement.[br]\r\n[br]\r\nPrincipes de base[br]\r\n[br]\r\nMerci de ne pas poster de X, Warez, racisme et plus généralement de choses répréhensibles par la loi sur cet espace public fréquenté également par des mineurs.[br]\r\nMerci de respecter vos interlocuteurs et de ne pas vous montrer discourtois. Les insultes n\'apportent rien et nuisent à l\'ambiance générale. Les trolls sont également à proscrire.[br]\r\nLes annonces à caractère publicitaire non sollicités (SPAM) sont proscrites, c\'est un forum de discussion et d\'entre-aide et non une zone commerciale.[br]\r\nNous ne sommes pas sur un téléphone portable, évitez le langage SMS.\r\n', '2018-01-26 18:17:25', 1, 1),
(2, 'Asus Prime B350-plus.\r\n\r\nL\'Asus Prime B350-plus est une carte en socket AM4 milieu de gamme, pour les processeurs AMD Ryzen. La carte supporte officiellement le Crossfire même si ce n\'est pas à conseiller, le second port étant PCIe 2.0 16x limité à 4x en double carte.\r\n \r\nSpécifications officielles : \r\n\r\n4 x DIMM, 64GB, DDR4 3200(O.C.)/2933(O.C.)/2666/2400/2133 MHz, ECC ou non ECC. (Officiellement, seul les fréquences 2133, 2400 et 2666 sont supportées)\r\n \r\n1 x PCIe 3.0/2.0 x16 (Slot n°1, fonctionnant en x16 en mono / double carte)\r\n1 x PCIe 2.0 x16 (fonctionnant en x8 en mono-carte et en x4 en double carte, bande passante partagée avec les ports PCIe 2.0 x1)\r\n2 x PCIe 2.0 x1 (bande passante partagée avec le PCIe 2.0 16x)\r\n2 x PCI  \r\n \r\n6 x SATA 6Gb (4 natifs, 2 sur des lignes PCIe). Support raid 0, 1 et 10.\r\n1 x M.2 (Sur ligne PCIe. Quand utilisé, la bande passante disponible est partagée avec les Sata 5 et 6)\r\n \r\n2 x USB 3.1 (back)\r\n4 x USB 3.0 (4x back, 2x front)\r\n6 x USB 2.0 (2x back, 4x front)\r\n \r\n1 x connecteur ventilo CPU\r\n2 x ventilo boitier\r\n1x Rj45 10/100/1000\r\n\r\nMise à jour bios : \r\n\r\n/!\\ N\'utilisez pas EZ update pour mettre à jour votre bios! /!\\\r\n \r\nLes risques de brick sont importants lors des maj bios depuis windows. Reportez vous à la partie chapitre 2.1.3 du manuel, et faites une mise à jour avec le fichier sur une clé USB, depuis votre bios.\r\n \r\nPour récupérer un bios à la suite d\'un flash loupé, reportez vous à la partie 2-1-3 du manuel.', '2018-01-26 18:26:37', 2, 3),
(3, 'faudrait carrement faire un topic mobo@ryzen vu les merdouilles que les betatesteurs se mangent.', '2018-01-26 20:37:53', 2, 4),
(4, 'hjgbdgjdk djehlsbgsoih sh ohis é"\'', '2018-01-26 20:38:16', 2, 4),
(6, 'T\'a la polio?', '2018-01-26 23:22:23', 2, 3),
(7, 'Du calme les enfant, sinon il va y avoir du TT!', '2018-01-26 23:24:47', 2, 2),
(8, 'gtrezer yte lorem ipsum', '2018-01-27 12:39:50', 2, 4),
(10, 'Ceci est le message le plus récent', '2018-01-27 15:15:07', 2, 3),
(11, 'test3', '2018-01-29 11:01:12', 5, 1),
(12, 'test4', '2018-01-29 11:07:21', 6, 1),
(13, 'Salut tlm,\r\n \r\nPossedant depuis peu de temps un boitier dans lequel G disposé un dd de 120Go Seagate 7200/8\r\nPour l\'instant je vous l\'accorde ce n\'est pas le meilleur choix que G pu faire car le disque a l\'air de chauffé bcp    \r\ndonc je n\'ai pas refermer le boitier    \r\nQuand j\'y repense, j\'ai été tres tres con de ne pas demander si il leur rester des dd en 5400t...    \r\n \r\nSinon, j\'aimerais connaitre les marques de boitiers 3-1/2 que vous utilisez pour y mettre vos dd, vos marques de dd que vous conseillez, les logiciels pour profiter de son dd externe (DriveImage2003, Ghost.....) et l\'utilisation que vous en faite(Back-up, CaptureTV....) , les pb rencontrés lors de son installation....\r\n \r\nVoilà, j\'espere que ce topic interressera du monde et que bcp y participeront    \r\n \r\nAinsi, pour montrer le bonne exemple je details ma config\r\n \r\nBoitier aluminium ConStar ST2312C Combo USB2+FireWire\r\nhttp://www.sunnytek.com/exter.htm\r\nLivré avec alim, cable USB2, cable Firewire, D7 de driver (non necessaire pour XP)\r\nDisque-dur Seagate 120Go IDE 7200t 8Mo\r\n \r\nA vous les cop1', '2018-01-29 11:25:14', 7, 1),
(14, 'Salut à tous!\r\n \r\nJ\'ai besoin d\'aide à propos du choix d\'un upgrade processeur : pour l\'instant j\'avais une 1070 et un i5 6600K; mais ma 1070 à lâchée et j\'ai réussi à avoir une 1080 Ti en solde  :) .\r\nJe joue principalement à PUBG; Battlefield 1 et d\'autres AAA en 1440P sur un écran 144 Hz. Le problème est que sur PUBG; BF1 et GTA V (jeux auxquels je joue le plus) j\'ai des drops de FPS (qui sont d\'ailleurs assez bas) dû à une utilisation CPU à 100% très souvent. J\'ai pourtant baissé toutes les options qui tirent sur le processeur au minimum ou presque.\r\nJ\'aimerais upgrade mon CPU pour pouvoir ne pas avoir de drops. Je ne sais pas si je devrais partir sur un i7 7700K Kaby Lake car j\'ai déjà une Z170 (il me suffirait de mettre le bios à jour) et puis d\'upgrade un bon coup avec Cannon Lake ou plus tard; ou alors de partir maintenant sur un Coffee Lake (ce qui entrainerait des coûts bien plus importants mais qui sera plus durable) et dans ce cas là j\'hésite entre le i5 8600K et i7 8700K même si j\'ai vu sur des benchmarks que le i5 pouvait lui même aussi être limitant pour une CG puissante. ', '2018-01-29 11:27:47', 8, 4),
(19, 'test test', '2018-01-29 15:08:08', 10, 1),
(20, 'Bonjour tout le monde :hello:  \r\n \r\nJ\'ai acheté un pc portable Asus modèle FX53VD-GC040T début 2017 et j\'aimerai installer un SSD en plus de l\' HDD présent.  \r\nL\'emplacement prévu est pour un SSD type M2 mais dans la notice, je n\'ai pas plus d\'indication.\r\nEn cherchant un peu les différents types qui existent, je me rends compte que pas mal de format sont sorties depuis le classique 2.5 pouces, et j\'ai besoin d\'un peu d\'aide!!!\r\nJe fais donc appel a votre sagacité  :D  \r\n \r\nEst ce que le format M2 est un standard en taille, longueur et epaisseur, et je peux acheter les yeux fermés sans me tromper, ou je dois faire gaffe ?\r\nEst ce que le format M2 peut être NVME, PCI Express,...\r\nSur Grobill, pour ne citer que lui, je peux filtrer sur :\r\n \r\nM.2\r\nNVMe\r\nPCI Express 2.0 x4\r\nPCI Express 3.0 x4 (NVMe)\r\nSATA M.2\r\nmSATA III\r\n \r\nJe suis un peut pomé ! ', '2018-01-29 15:10:10', 11, 4),
(21, 'Est ce que l\'on peut désactiver le smt sur cette carte ? ', '2018-01-29 15:12:59', 2, 4),
(22, 'Pas pour l\'instant (ou je n\'ai pas trouvé). Nous sommes en attente du nouveau bios, le dernier date du 24 février... et on espère récupérer une meilleure gestion des timings de ram & la possibilité de désactiver le SMT. Bon, désactiver le SMT n\'est pas vraiment utile, mais les timings de rams pourraient (peut-être) permettre de gagner en fréquence.', '2018-01-29 15:13:14', 2, 4),
(23, 'Je suis intéressé par cette carte. Est ce qu\'avec le (petit) recul que vous avez, vous la conseillerez?', '2018-01-29 15:13:25', 2, 4),
(24, 'A première vue, oui... mais attention à la mémoire. Il n\'y aura pas de mise à jour bios avant un bout de temps probablement (amd parle d\'avril), regarde bien la liste de compatibilité mémoire avant d\'acheter. Pour l\'instant, les cartes mères à base de B350 et 370 (donc, toutes pour ryzen) ne permettent pas de changer les timings avancés de mémoire, donc si on veux dépasser 2166 / 2400 / 2666, il faut des barrettes spécifiques.', '2018-01-29 15:13:35', 2, 4),
(25, 'Merci de ta réponse.\r\n \r\nJe sais effectivement qu\'il faut faire attention au choix de la mémoire, j\'ai  jeté un oeil sur leur QVL (compatiblité mémoire).  \r\n \r\nqu\'est ce que vous avez pris personnellement comme ram?', '2018-01-29 15:13:46', 2, 4),
(26, 'J\'ai de la Corsair LPX (cmk16gx4m2b3200c16)... dans une version qui est loin d\'être parfaite pour un ryzen (ouai, j\'ai fait le topic après avoir acheté :D)\r\n \r\nYa pire, mais c\'est de la mémoire dual bank et je suis bloqué à 2400 au maximum. C\'est pas la mort non plus, la différence de perfs est minime (même si j\'espère pouvoir la passer en 2900 ou 3200 avec un nouveau bios)\r\n \r\nMémoire à conseiller spécifiquement je ne sais pas, mais à choisir autant prendre de la single bank (marqué SS dans le QVL) avec 2 barrettes maximum. Moins de problèmes de compatibilité, plus de chances de dépasser 2400mhz. Il faut aussi voir que le seul kit en 2x8 capable de fonctionner \'officiellement\' à 3200 sur cette carte mère coute 50€ de plus que les kits à 2400 ou 2666... 50€ pour un poil de performances dans certaines situations et une compatibilité qui va évoluer, bof.', '2018-01-29 15:13:57', 2, 4),
(27, 'Très très chère effectivement la ram en ce moment...\r\n \r\nPour compléter ma commande sur le shop hardware et ainsi profiter de 13€ de réduc en prenant la cm + la ram, et en utilisant la liste de compatibilité pour cette cm, j\'hésite entre 2 modèles:\r\n \r\n[url=https://shop.hardware.fr/fiche/AR201606250003.html]  \r\nCorsair Vengeance LED Series 16 Go (2x 8 Go) DDR4 3000 MHz CL15[/url]\r\n \r\nou\r\n \r\n[url=https://shop.hardware.fr/fiche/AR201507200030.html]  \r\nCorsair Vengeance LPX Series Low Profile 16 Go (2x 8 Go) DDR4 2666 MHz CL16[/url]\r\n \r\nJe n\'y connais pas grand chose en mémoire vive, quel modèle vaut il mieux choisir?', '2018-01-29 15:14:10', 2, 4),
(28, 'é-è<', '2018-01-30 08:44:37', 2, 1),
(29, '"\'\\n 0\r\n\r\n\\r', '2018-01-30 08:54:10', 2, 1),
(31, '&&&', '2018-01-30 12:37:17', 8, 6),
(34, 'test', '2018-01-30 13:01:22', 2, 6),
(36, 'fdhndfjd', '2018-01-30 14:05:29', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `label` varchar(60) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id_role`, `label`) VALUES
(1, 'ADMINISTRATOR'),
(2, 'MODERATOR'),
(3, 'SUBSCRIBER');

-- --------------------------------------------------------

--
-- Structure de la table `role_permission`
--

CREATE TABLE `role_permission` (
  `id_role` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `role_permission`
--

INSERT INTO `role_permission` (`id_role`, `id_permission`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 2),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 2),
(3, 4),
(3, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(11) NOT NULL,
  `title` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `date_creation` timestamp NULL DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `title`, `date_creation`, `id_user`, `id_category`) VALUES
(1, '/!\\ Règles du forum Hardware => A lire par tous et toutes', '2018-01-26 18:17:58', 1, 1),
(2, '[Topic unique] Asus Prime B350-plus', '2018-01-26 18:22:13', 3, 1),
(7, '[TOPiC] Disque-Dur Externe', '2018-01-29 11:25:14', 1, 7),
(8, 'Choix du processeur', '2018-01-29 11:27:47', 4, 3),
(10, 'test', '2018-01-29 15:08:08', 1, 10),
(11, 'ssd M2 sur Asus FX753VD', '2018-01-29 15:10:10', 4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `login` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `login`, `password`, `id_role`) VALUES
(1, 'jpmc', '00000000', 1),
(2, 'modo', 'modomodo', 2),
(3, 'theboss', 'thebosstheboss', 3),
(4, 'kevin', 'kevinkevin', 3),
(5, 'test', '12345678', 3),
(6, 'trez', '13131313', 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id_permission`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `id_permission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
