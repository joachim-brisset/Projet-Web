CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `firstname` varchar(255),
  `lastname` varchar(255),
  `gender` varchar(255),
  `birth_day` date,
  `jobs` varchar(255),
  `city` varchar(255),
  `country` varchar(255),
  `cp` varchar(255),
  `street` varchar(255),
  `street_number` int,
  `additionnal_address` varchar(255),
  `role` int,
  `mail` varchar(255),
  `password` varchar(255),
  `create_at` timestamp
) ENGINE = INNODB;

CREATE TABLE `articles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `created_at` date
) ENGINE = INNODB;

CREATE TABLE `events` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `start_at` date,
  `end_at` date,
  `description` varchar(255),
  `place` varchar(255),
  `price` int,
  `place_number` int
) ENGINE = INNODB;

CREATE TABLE `products` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `price` int,
  `stocks` int
) ENGINE = INNODB;

CREATE TABLE `roles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `role` varchar(255),
  `price` int
) ENGINE = INNODB;

CREATE TABLE `registration` (
  `user_id` int,
  `event_id` int
) ENGINE = INNODB;

CREATE TABLE `commands` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `client` int,
  `at` timestamp
) ENGINE = INNODB;

CREATE TABLE `subcommands` (
  `command_id` int,
  `product_id` int
) ENGINE = INNODB;

ALTER TABLE `users` ADD FOREIGN KEY (`role`) REFERENCES `roles` (`id`);

ALTER TABLE `registration` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `registration` ADD FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

ALTER TABLE `commands` ADD FOREIGN KEY (`client`) REFERENCES `users` (`id`);

ALTER TABLE `subcommands` ADD FOREIGN KEY (`command_id`) REFERENCES `commands` (`id`);

ALTER TABLE `subcommands` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

CREATE UNIQUE INDEX `users_index_0` ON `users` (`mail`);

CREATE UNIQUE INDEX `users_index_1` ON `users` (`username`);

CREATE UNIQUE INDEX `registration_index_1` ON `registration` (`user_id`, `event_id`);
