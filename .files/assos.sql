-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 juin 2021 à 14:50
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `assos`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `picture_url` text NOT NULL,
  `corps` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `created_at`, `picture_url`, `corps`) VALUES
(1, 'Le nouvel espoir de la NBA a un nom et il s\'appelle Clausius', '2021-06-06', 'https://upload.wikimedia.org/wikipedia/commons/2/27/Stephen_Curry_Shooting_%28cropped%29.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu ultrices ex. In nec erat id neque accumsan finibus. Nullam malesuada, massa id pellentesque suscipit, nunc metus auctor augue, eu pretium nisl ante non ex. Phasellus nibh odio, molestie ac enim id, dictum suscipit tortor. Sed auctor est vitae arcu ornare, ut maximus tortor sodales. Integer at varius nunc. Nam eget nunc dignissim, volutpat sapien id, volutpat elit. Nulla metus ante, feugiat vitae lacinia sit amet, fermentum eu mi. Aenean feugiat vitae velit a sollicitudin.\r\n\r\nProin sed orci sed leo molestie efficitur. Donec bibendum et nulla ut feugiat. Cras vehicula eget mauris eget tincidunt. Proin vel vehicula neque. Mauris tempus mi et mauris accumsan laoreet. Nunc imperdiet justo lacus, ac vestibulum nisi suscipit id. Cras tristique tempor ex vel dignissim. Aenean in mi non nunc tincidunt suscipit. Vivamus tincidunt non libero ut venenatis. Maecenas tellus mi, mollis at mi eget, malesuada ultricies magna. Vestibulum et mi sit amet magna ultricies ornare in ac ex. Nullam sit amet scelerisque enim. Nullam quis tincidunt lorem. Vestibulum semper leo in ipsum sagittis, sit amet fringilla urna facilisis.'),
(2, 'Jean-Luc Mélanchon frère de Micheal Jordan ?', '2021-06-26', 'https://upload.wikimedia.org/wikipedia/commons/b/b1/Jean_Luc_MELENCHON_in_the_European_Parliament_in_Strasbourg%2C_2016_%28cropped%29.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu ultrices ex. In nec erat id neque accumsan finibus. Nullam malesuada, massa id pellentesque suscipit, nunc metus auctor augue, eu pretium nisl ante non ex. Phasellus nibh odio, molestie ac enim id, dictum suscipit tortor. Sed auctor est vitae arcu ornare, ut maximus tortor sodales. Integer at varius nunc. Nam eget nunc dignissim, volutpat sapien id, volutpat elit. Nulla metus ante, feugiat vitae lacinia sit amet, fermentum eu mi. Aenean feugiat vitae velit a sollicitudin.\r\n\r\nProin sed orci sed leo molestie efficitur. Donec bibendum et nulla ut feugiat. Cras vehicula eget mauris eget tincidunt. Proin vel vehicula neque. Mauris tempus mi et mauris accumsan laoreet. Nunc imperdiet justo lacus, ac vestibulum nisi suscipit id. Cras tristique tempor ex vel dignissim. Aenean in mi non nunc tincidunt suscipit. Vivamus tincidunt non libero ut venenatis. Maecenas tellus mi, mollis at mi eget, malesuada ultricies magna. Vestibulum et mi sit amet magna ultricies ornare in ac ex. Nullam sit amet scelerisque enim. Nullam quis tincidunt lorem. Vestibulum semper leo in ipsum sagittis, sit amet fringilla urna facilisis.\r\n\r\nAenean luctus velit nec sem maximus, id varius augue cursus. Pellentesque euismod commodo odio, sit amet iaculis leo finibus sed. Maecenas diam ante, mollis at nisl et, elementum consectetur ligula. Sed quis cursus libero. Aenean ornare diam dui, a maximus ligula mattis a. Integer vel ante vel leo dapibus gravida. Vestibulum vel feugiat magna. Mauris in tortor nisi. Fusce a venenatis leo, at imperdiet est. Nulla auctor nisi a ultrices convallis. Cras fermentum varius leo ut pretium. Nunc nec molestie nunc, id dapibus massa. Nunc ligula urna, efficitur aliquet lacus ultricies, sodales congue risus. Pellentesque bibendum commodo ligula at venenatis.'),
(3, 'Corey Brewer raconte sa première année dans le coaching', '2021-06-16', 'https://www.basketusa.com/wp-content/uploads/2021/06/corey-brewer.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu ultrices ex. In nec erat id neque accumsan finibus. Nullam malesuada, massa id pellentesque suscipit, nunc metus auctor augue, eu pretium nisl ante non ex. Phasellus nibh odio, molestie ac enim id, dictum suscipit tortor. Sed auctor est vitae arcu ornare, ut maximus tortor sodales. Integer at varius nunc. Nam eget nunc dignissim, volutpat sapien id, volutpat elit. Nulla metus ante, feugiat vitae lacinia sit amet, fermentum eu mi. Aenean feugiat vitae velit a sollicitudin.'),
(4, 'Rudy Gobert : « Après tout ce qu’on a traversé, gagner le titre rendra l’histoire encore plus belle ', '2021-06-25', 'https://www.basketusa.com/wp-content/uploads/2021/06/brooks-gobert.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu ultrices ex. In nec erat id neque accumsan finibus. Nullam malesuada, massa id pellentesque suscipit, nunc metus auctor augue, eu pretium nisl ante non ex. Phasellus nibh odio, molestie ac enim id, dictum suscipit tortor. Sed auctor est vitae arcu ornare, ut maximus tortor sodales. Integer at varius nunc. Nam eget nunc dignissim, volutpat sapien id, volutpat elit. Nulla metus ante, feugiat vitae lacinia sit amet, fermentum eu mi. Aenean feugiat vitae velit a sollicitudin.\r\n\r\nProin sed orci sed leo molestie efficitur. Donec bibendum et nulla ut feugiat. Cras vehicula eget mauris eget tincidunt. Proin vel vehicula neque. Mauris tempus mi et mauris accumsan laoreet. Nunc imperdiet justo lacus, ac vestibulum nisi suscipit id. Cras tristique tempor ex vel dignissim. Aenean in mi non nunc tincidunt suscipit. Vivamus tincidunt non libero ut venenatis. Maecenas tellus mi, mollis at mi eget, malesuada ultricies magna. Vestibulum et mi sit amet magna ultricies ornare in ac ex. Nullam sit amet scelerisque enim. Nullam quis tincidunt lorem. Vestibulum semper leo in ipsum sagittis, sit amet fringilla urna facilisis.\r\n\r\nAenean luctus velit nec sem maximus, id varius augue cursus. Pellentesque euismod commodo odio, sit amet iaculis leo finibus sed. Maecenas diam ante, mollis at nisl et, elementum consectetur ligula. Sed quis cursus libero. Aenean ornare diam dui, a maximus ligula mattis a. Integer vel ante vel leo dapibus gravida. Vestibulum vel feugiat magna. Mauris in tortor nisi. Fusce a venenatis leo, at imperdiet est. Nulla auctor nisi a ultrices convallis. Cras fermentum varius leo ut pretium. Nunc nec molestie nunc, id dapibus massa. Nunc ligula urna, efficitur aliquet lacus ultricies, sodales congue risus. Pellentesque bibendum commodo ligula at venenatis.\r\n\r\nIn vitae nibh ac tellus hendrerit ultrices non in nisi. Cras nec scelerisque felis. Curabitur fringilla massa et nisi malesuada sodales. Proin pellentesque consectetur orci, eu sagittis tellus consequat eu. Donec nulla eros, sodales in dictum a, semper eu turpis. Suspendisse id tortor a turpis pulvinar fringilla sit amet sed turpis. Ut tempor auctor semper. Nam in ipsum augue. In euismod odio eu ligula faucibus eleifend. Morbi porta erat turpis, sit amet ultricies ligula ullamcorper sit amet. Nam elementum nunc est, ut consectetur neque feugiat nec.\r\n\r\nVivamus cursus vehicula diam vitae ultrices. Maecenas placerat sem nec vehicula egestas. Proin facilisis dolor elit, nec varius ante eleifend luctus. Nullam ac euismod diam. Ut tristique mi ipsum, sed viverra lorem gravida eu. Sed nec pharetra libero, at condimentum sapien. Sed maximus mi maximus arcu laoreet, in venenatis nisl eleifend. Donec efficitur blandit ullamcorper. Proin vulputate sit amet est a rhoncus.'),
(5, 'Du renfort pour les Nuggets ?', '2021-06-30', 'https://www.basketusa.com/wp-content/uploads/2021/06/will-barton.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu ultrices ex. In nec erat id neque accumsan finibus. Nullam malesuada, massa id pellentesque suscipit, nunc metus auctor augue, eu pretium nisl ante non ex. Phasellus nibh odio, molestie ac enim id, dictum suscipit tortor. Sed auctor est vitae arcu ornare, ut maximus tortor sodales. Integer at varius nunc. Nam eget nunc dignissim, volutpat sapien id, volutpat elit. Nulla metus ante, feugiat vitae lacinia sit amet, fermentum eu mi. Aenean feugiat vitae velit a sollicitudin.\r\n\r\nProin sed orci sed leo molestie efficitur. Donec bibendum et nulla ut feugiat. Cras vehicula eget mauris eget tincidunt. Proin vel vehicula neque. Mauris tempus mi et mauris accumsan laoreet. Nunc imperdiet justo lacus, ac vestibulum nisi suscipit id. Cras tristique tempor ex vel dignissim. Aenean in mi non nunc tincidunt suscipit. Vivamus tincidunt non libero ut venenatis. Maecenas tellus mi, mollis at mi eget, malesuada ultricies magna. Vestibulum et mi sit amet magna ultricies ornare in ac ex. Nullam sit amet scelerisque enim. Nullam quis tincidunt lorem. Vestibulum semper leo in ipsum sagittis, sit amet fringilla urna facilisis.\r\n\r\nAenean luctus velit nec sem maximus, id varius augue cursus. Pellentesque euismod commodo odio, sit amet iaculis leo finibus sed. Maecenas diam ante, mollis at nisl et, elementum consectetur ligula. Sed quis cursus libero. Aenean ornare diam dui, a maximus ligula mattis a. Integer vel ante vel leo dapibus gravida. Vestibulum vel feugiat magna. Mauris in tortor nisi. Fusce a venenatis leo, at imperdiet est. Nulla auctor nisi a ultrices convallis. Cras fermentum varius leo ut pretium. Nunc nec molestie nunc, id dapibus massa. Nunc ligula urna, efficitur aliquet lacus ultricies, sodales congue risus. Pellentesque bibendum commodo ligula at venenatis.\r\n\r\nIn vitae nibh ac tellus hendrerit ultrices non in nisi. Cras nec scelerisque felis. Curabitur fringilla massa et nisi malesuada sodales. Proin pellentesque consectetur orci, eu sagittis tellus consequat eu. Donec nulla eros, sodales in dictum a, semper eu turpis. Suspendisse id tortor a turpis pulvinar fringilla sit amet sed turpis. Ut tempor auctor semper. Nam in ipsum augue. In euismod odio eu ligula faucibus eleifend. Morbi porta erat turpis, sit amet ultricies ligula ullamcorper sit amet. Nam elementum nunc est, ut consectetur neque feugiat nec.\r\n\r\nVivamus cursus vehicula diam vitae ultrices. Maecenas placerat sem nec vehicula egestas. Proin facilisis dolor elit, nec varius ante eleifend luctus. Nullam ac euismod diam. Ut tristique mi ipsum, sed viverra lorem gravida eu. Sed nec pharetra libero, at condimentum sapien. Sed maximus mi maximus arcu laoreet, in venenatis nisl eleifend. Donec efficitur blandit ullamcorper. Proin vulputate sit amet est a rhoncus.\r\n\r\nVivamus id libero hendrerit, viverra dolor ac, gravida felis. Vestibulum pellentesque, neque sed mattis pretium, justo elit cursus sem, eu ultricies massa neque id velit. Phasellus urna est, consectetur quis suscipit sollicitudin, congue vitae felis. Duis et augue eu elit euismod dignissim ut hendrerit eros. Ut euismod sapien leo, non ornare lacus lobortis at. Mauris a urna faucibus, pharetra diam at, congue sapien. Mauris sagittis vulputate justo, vitae venenatis lectus rutrum sed. Cras ut eros a tortor tempus placerat at quis massa. Curabitur scelerisque nunc ultrices turpis laoreet tincidunt.');

-- --------------------------------------------------------

--
-- Structure de la table `commands`
--

DROP TABLE IF EXISTS `commands`;
CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) DEFAULT NULL,
  `at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `place_number` int(11) DEFAULT NULL,
  `event_cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `name`, `start_at`, `end_at`, `description`, `place`, `price`, `place_number`, `event_cost`) VALUES
(1, 'MATCH AMICAL', '2021-06-08', '0000-00-00', 'match amical contre l\'équipe X', 'maradas', 5, 1, 100),
(2, 'RECOLTE DE FOND', '2021-06-02', '2021-06-11', 'Récolte de fond afin de financer l\'équipement de l\'équipe Vous pouvez venir nous voir sur place ou nous tiper via paypal !', 'accueil CYTECH', 0, 0, 150),
(3, 'SOIREE ', '2021-06-30', '0000-00-00', 'GROSSE SOIREE TAH LA NIGHTafin de célébrée l\'arrivée des nouveaux', 'partout ', 15, 0, 400);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `eventsearch`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `eventsearch`;
CREATE TABLE IF NOT EXISTS `eventsearch` (
`event_id` int(11)
,`search_fields` text
,`start_date` date
,`end_date` date
);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stocks` int(11) DEFAULT NULL,
  `initial_stock` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stocks`, `initial_stock`, `description`) VALUES
(1, 'Balle réalisée par SUPRAW', 50, 25, 35, 'Design unique et coloré, produit en quantité limitée <br>\r\nNombres de couches : 3 <br>\r\nVessie : Butyle parfaite tenue au gonflage <br>\r\nCarcasse : Nylon renforcé, montage pro dynamique <br>'),
(2, 'Balle Spalding NBA', 50, 80, 85, 'Cuir naturel haut de gamme <br>\r\nNombre de couches : 5 <br>\r\nVessie : Butyle parfaite tenue au gonflage <br>\r\nCarcasse : Nylon renforcé, montage pro dynamique <br>'),
(3, 'Panier Chinatown Market', 70, 15, 18, 'Résiste aux intempéries <br>\r\nDesign unique, produit en quantité limitée <br>\r\nAttache filet : Tube ou Queue de cochon <br>\r\nArceau : Spécial Dunk');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `productsearch`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `productsearch`;
CREATE TABLE IF NOT EXISTS `productsearch` (
`product_id` int(11)
,`search_fields` mediumtext
);

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `registered_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `registration_index_1` (`user_id`,`event_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `power` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role`, `price`, `power`) VALUES
(1, 'membre', 5, 1),
(2, 'staff', 15, 2),
(3, 'staff2', 20, 3);

-- --------------------------------------------------------

--
-- Structure de la table `subcommands`
--

DROP TABLE IF EXISTS `subcommands`;
CREATE TABLE IF NOT EXISTS `subcommands` (
  `command_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  KEY `command_id` (`command_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `birth_day` date NOT NULL,
  `jobs` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `cp` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `street` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `street_number` int(11) NOT NULL,
  `role_id` int(11) DEFAULT '1',
  `mail` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_index_1` (`username`),
  UNIQUE KEY `users_index_0` (`mail`),
  KEY `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `gender`, `birth_day`, `jobs`, `city`, `country`, `cp`, `street`, `street_number`, `role_id`, `mail`, `password`, `create_at`) VALUES
(19, 'staff', 'Admin', 'Admin', 'Femme', '2021-01-01', 'Debuger', 'Cergy', 'France', '95000', 'Bdv du Port', 15, 2, 'staff', '$2y$10$RPcblMfsEbEiH7gu9U9l6em3IiIsHLuclBXT2QAR9n3SI4rx/9T9W', '2021-06-09 14:05:59'),
(20, 'op', 'Operateur', 'Operateur', 'Homme', '2021-06-09', 'Debugger', 'Cergy', 'France', '95000', 'Bvd du port', 15, 3, 'op', '$2y$10$GQPKZbR1nsM0WvIoeNiFGOOXCLD2ZtmsWXRYKFItzLVvtx5nW.65q', '2021-06-09 14:39:25'),
(21, 'membre', 'Membre', 'Membre', 'Homme', '2021-06-09', 'Debugger', 'Cergy', 'France', '95000', 'Bvd du port', 15, 1, 'membre', '$2y$10$rxl7Z1j.eMo5crU2QwaTUufTKVFMGIzdhG0eykgHqe0yEshJCNM4.', '2021-06-09 14:42:16');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `usersearch`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `usersearch`;
CREATE TABLE IF NOT EXISTS `usersearch` (
`user_id` int(11)
,`search_fields` text
);

-- --------------------------------------------------------

--
-- Structure de la vue `eventsearch`
--
DROP TABLE IF EXISTS `eventsearch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eventsearch` (`event_id`, `search_fields`, `start_date`, `end_date`) AS   select `events`.`id` AS `id`,concat(`events`.`name`,`events`.`description`,`events`.`place`) AS `CONCAT(events.name,events.description, events.place)`,`events`.`start_at` AS `start_at`,`events`.`end_at` AS `end_at` from `events`  ;

-- --------------------------------------------------------

--
-- Structure de la vue `productsearch`
--
DROP TABLE IF EXISTS `productsearch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productsearch` (`product_id`, `search_fields`) AS   select `products`.`id` AS `id`,concat(`products`.`name`,`products`.`description`) AS `CONCAT(products.name, products.description)` from `products`  ;

-- --------------------------------------------------------

--
-- Structure de la vue `usersearch`
--
DROP TABLE IF EXISTS `usersearch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usersearch` (`user_id`, `search_fields`) AS   select `users`.`id` AS `id`,concat(`users`.`username`,`users`.`gender`,`users`.`birth_day`,`users`.`jobs`,`users`.`mail`,`roles`.`role`) AS `Name_exp_2` from (`users` join `roles`) where (`users`.`role_id` = `roles`.`id`)  ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commands`
--
ALTER TABLE `commands`
  ADD CONSTRAINT `commands_ibfk_1` FOREIGN KEY (`client`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Contraintes pour la table `subcommands`
--
ALTER TABLE `subcommands`
  ADD CONSTRAINT `subcommands_ibfk_1` FOREIGN KEY (`command_id`) REFERENCES `commands` (`id`),
  ADD CONSTRAINT `subcommands_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
