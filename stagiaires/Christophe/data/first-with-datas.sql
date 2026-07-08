-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 28 juin 2026 à 18:24
-- Version du serveur : 8.4.7
-- Version de PHP : 8.4.15

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `first`
--
DROP DATABASE IF EXISTS `first`;
CREATE DATABASE IF NOT EXISTS `first` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `first`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Temps du serveur actuel : CURRENT_TIMESTAMP ou NOW()',
  `published` tinyint UNSIGNED DEFAULT '1' COMMENT 'Valeur de 0 à 255\n0 => non publié\n1 => publié\n2 => caché',
  `user_id` int UNSIGNED NOT NULL COMMENT 'Un article ne peut avoir 1 seul user',
  PRIMARY KEY (`id`),
  KEY `fk_article_user_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `date`, `published`, `user_id`) VALUES
(1, 'Devenez développeur d’application full stack', 'Le développeur d’application full-stack PHP et JavaScript est un professionnel du développement web, capable de travailler à la fois sur le backend (la logique métier, les bases de données) et le frontend (l’interface visible par les utilisateurs).\r\n\r\n \r\n\r\nGrâce à sa double compétence, il peut concevoir et réaliser des applications web complètes, dynamiques et interactives. Il intervient sur toutes les étapes de création d’un produit numérique, ce qui lui confère une excellente compréhension des besoins utilisateurs et des enjeux techniques.\r\n\r\n \r\n\r\nLes projets auxquels il participe sont variés : sites internet interactifs, plateformes en ligne, outils de gestion, solutions e-commerce ou encore systèmes d’information personnalisés.\r\n\r\n \r\n\r\nLes missions types que vous pourrez mener \r\nEn tant que développeur d\'application full-stack, vous aurez l\'opportunité de mener des missions passionnantes, par exemple :\r\n\r\nConcevoir des applications web complètes : vous imaginerez l’architecture d’un projet, de la base de données à l’affichage sur le navigateur.\r\nDévelopper des fonctionnalités dynamiques : vous écrirez du code à la fois côté serveur (avec PHP) et côté client (avec JavaScript) pour rendre les applications interactives.\r\nAméliorer et maintenir des projets existants : vous ferez évoluer les fonctionnalités, corrigerez les éventuels bugs et assurerez la stabilité des systèmes.\r\nTester et garantir la qualité des applications : vous vérifierez le bon fonctionnement de vos développements en conditions réelles.\r\nCollaborer avec d’autres professionnels : vous échangerez avec des designers, chefs de projet ou autres développeurs pour proposer des solutions efficaces et adaptées aux utilisateurs finaux.\r\n\r\n<a href=\"https://openclassrooms.com/fr/paths/2631-developpeur-d-application-full-stack\" target=\"_blank\">Source</a>', '2026-06-24 11:28:46', 1, 1),
(3, 'Les 20 meilleures commandes Git avec des exemples : Guide pratique', 'Git est un outil essentiel pour toute personne travaillant avec du code, qu\'il s\'agisse d\'un développeur de logiciels, d\'un scientifique des données, d\'un ingénieur des données ou d\'un praticien de l\'apprentissage automatique. Il permet aux équipes de collaborer simultanément sur le même projet tout en fournissant un historique clair des modifications du code, ce qui facilite le cursus et la gestion des mises à jour.\r\n\r\nDans cet article, je vais vous présenter les commandes Git les plus couramment utilisées, leur syntaxe, et comment les appliquer dans votre travail quotidien !\r\n\r\nCommandes de base de Git\r\nLes étapes de base du travail avec Git comprennent la création d\'un dépôt, la copie d\'un dépôt existant et l\'édition du code. Cette section abordes fonctions fondamentales de git en détail, ainsi que la syntaxe pour les mettre en œuvre .\r\n\r\nBesoin d\'installer Git ? Suivez ce guide pour installer Git sur votre système.\r\n\r\ngit init\r\nLa commande git init crée un nouveau dépôt Git ou réinitialise un dépôt existant.  \r\n\r\nLorsque vous exécutez la commande, votre répertoire actuel devient un dépôt Git, ce qui vous permet de suivre ses modifications. Il ajoute un dossier caché .git dans le répertoire, où Git stocke toutes les métadonnées, l\'historique des versions et les journaux relatifs au projet.\r\n\r\n<a href=\"https://www.datacamp.com/fr/blog/git-commands\" target=\"_blank\">Source</a>', '2026-06-24 11:34:09', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(1, 'PHP', 'PHP (acronyme récursif pour PHP: Hypertext Preprocessor) est un langage de script open source incontournable pour le développement web dynamique. Il s\'exécute côté serveur pour générer du code HTML, qui est ensuite envoyé au navigateur de l\'utilisateur'),
(2, 'JavaScript', 'JavaScript est un langage de programmation interprété qui permet de rendre les pages web interactives et dynamiques. Avec le HTML et le CSS, il est l\'un des piliers du développement web. Il permet de créer des animations, de valider des formulaires et de modifier le contenu sans recharger la page'),
(3, 'SQL', 'SQL signifie Structured Query Language (Langage de Requêtes Structurées). C\'est le langage informatique standard utilisé pour communiquer avec et gérer les bases de données relationnelles.'),
(4, 'GIT', 'Git est un système de contrôle de version distribué, gratuit et open-source. Il permet de suivre l\'historique des modifications apportées à des fichiers et de collaborer efficacement sur des projets. Créé en 2005 par Linus Torvalds, c\'est un outil fondamental pour le développement de logiciels...');

-- --------------------------------------------------------

--
-- Structure de la table `category_has_article`
--

DROP TABLE IF EXISTS `category_has_article`;
CREATE TABLE IF NOT EXISTS `category_has_article` (
  `category_id` int UNSIGNED NOT NULL,
  `article_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`category_id`,`article_id`),
  KEY `fk_category_has_article_article1_idx` (`article_id`),
  KEY `fk_category_has_article_category1_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category_has_article`
--

INSERT INTO `category_has_article` (`category_id`, `article_id`) VALUES
(1, 1),
(2, 1),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id par défaut\nobligatoire mais autoincrément\nunsigned',
  `username` varchar(30) NOT NULL COMMENT 'Pour se connecter',
  `email` varchar(120) NOT NULL COMMENT 'mail de user',
  `realname` varchar(60) DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'Mot de passe haché, sera géré par PHP\nchangement de case, il doit être case sensitive (cs)\nVoir password_hash() et password_verify()\n255 carcatères pour avenir',
  `actif` tinyint DEFAULT '0' COMMENT 'basé sur 1 octet, donc 256 posibilités\n\n0 => inscrit non validé par mail\n1 => actif grâce au mail \n2 => bannie',
  `uniqid` char(59) NOT NULL COMMENT 'uniqid est créé avec la fonction uniquid(true) de PHP et on rajoute des bytes transformés en haxadécimal',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `realname`, `pwd`, `actif`, `uniqid`) VALUES
(1, 'Admin', 'michael.pitz@cf2m.be', 'Pitz Michaël', '$2y$12$pUtDVtm.CCZxdsEJh8dR3uGVe2qbNJA3GcJUsTBPsPuWp5b7vLLT2', 1, 'id_6a3ba21d75ee39.91834410_92ca3bb47aac9e0657edf150c7770e12');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `category_has_article`
--
ALTER TABLE `category_has_article`
  ADD CONSTRAINT `fk_category_has_article_article1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category_has_article_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
