-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Technology'),
	(2, 'News'),
	(3, 'Sports'),
	(4, 'Movies & TV'),
	(5, 'Cooking');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationDate` datetime DEFAULT NULL,
  `topic_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `id_topic` (`topic_id`),
  KEY `id_membre` (`user_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~1 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationDate`, `topic_id`, `user_id`) VALUES
	(1, 'aaa', '2023-07-17 14:17:20', 1, NULL);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `creationDate` datetime DEFAULT NULL,
  `closed` tinyint NOT NULL DEFAULT '0',
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `id_category` (`category_id`),
  KEY `id_membre` (`user_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~2 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `closed`, `category_id`, `user_id`) VALUES
	(1, 'Web Development', '2023-07-17 00:00:00', 0, 1, NULL),
	(2, 'test', '2023-07-17 14:33:44', 0, 5, NULL);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `registrationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~16 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `role`, `registrationDate`) VALUES
	(14, 'Charly', '$2y$10$VLneRmBy9zbHP/NH6BAz.Oq8DD4hdY4Qwd7todrBbPccg7Bwp7su.', 'Charly@test.fr', 'admin', '2023-07-21 11:20:36'),
	(17, 'john', '$2y$10$Nj78rxfZs5UiweXNWm1Zo.h19CVqOMhQNuugJ34XVynjlZJ.x.k5a', 'john.doe@test.fr', 'user', '2023-07-21 14:09:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
