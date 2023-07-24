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
  `title` varchar(200) DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationDate` datetime DEFAULT NULL,
  `topic_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `id_topic` (`topic_id`),
  KEY `id_membre` (`user_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~0 rows (environ)
INSERT INTO `post` (`id_post`, `title`, `content`, `creationDate`, `topic_id`, `user_id`) VALUES
	(4, 'Understanding Neural Networks: A Beginner\'s Guide', 'An introduction to neural networks, the building blocks of artificial intelligence, and how they mimic the human brain.', '2023-07-24 00:00:00', 3, 14),
	(5, 'AI in Everyday Life: How It\'s Changing Our World', 'Exploring the various ways artificial intelligence is integrated into our daily lives, from virtual assistants to recommendation systems.', '2023-07-24 00:00:00', 3, 14),
	(6, 'Choosing the Right Graphics Card for Your Gaming Rig', 'A comprehensive guide to help gamers select the perfect graphics card that suits their gaming needs and budget.', '2023-07-24 00:00:00', 4, 14),
	(7, 'Upgrading Your PC: Tips for a Smooth Hardware Transition', 'Useful tips and precautions to consider when upgrading your PC\'s hardware components to ensure a seamless experience.', '2023-07-24 00:00:00', 4, 14),
	(8, 'Mastering JavaScript: Advanced Techniques for Developers', 'Advanced JavaScript concepts and techniques that empower web developers to create more dynamic and interactive websites.', '2023-07-24 00:00:00', 5, 14),
	(9, 'Building Responsive Websites with CSS Flexbox and Grid', 'A step-by-step tutorial on using CSS Flexbox and Grid to create responsive and visually appealing web layouts.', '2023-07-24 00:00:00', 5, 14),
	(10, 'Recent Political Developments in France', 'An overview of the latest political events and changes in France, shaping the country\'s current landscape.', '2023-07-24 00:00:00', 6, 14),
	(11, 'Exploring France\'s Rich Cultural Heritage: From Art to Cuisine', 'A journey through France\'s cultural treasures, including its art, gastronomy, and historical landmarks.', '2023-07-24 00:00:00', 6, 14),
	(12, 'Climate Change and Global Efforts for Sustainability', 'An in-depth analysis of international efforts and initiatives to combat climate change and promote sustainability worldwide.', '2023-07-24 00:00:00', 7, 14),
	(13, 'Challenges and Opportunities in Global Trade', 'Examining the challenges and opportunities faced by countries in the ever-changing landscape of global trade.', '2023-07-24 00:00:00', 7, 14),
	(14, 'Europes Tech Startup Ecosystem: A Rising Powerhouse', 'Insights into the flourishing tech startup scene in Europe and its role in driving innovation across the continent.', '2023-07-24 00:00:00', 8, 14),
	(15, 'European Travel Destinations Off the Beaten Path', 'Discovering lesser-known travel destinations in Europe that offer unique experiences away from the tourist crowds.', '2023-07-24 00:00:00', 8, 14),
	(16, 'Top NBA Rookies to Watch in the 2023 Season', 'Highlighting the most promising rookies in the NBA who are expected to make a significant impact on the court.', '2023-07-24 00:00:00', 9, 14),
	(17, 'Memorable NBA Finals: Legendary Clashes and Game-Changing Plays', 'Recalling iconic moments from past NBA Finals that have etched their mark in basketball history.', '2023-07-24 00:00:00', 9, 14),
	(18, 'Breaking Down NFL Quarterbacks: Stats and Performances', 'Analyzing the performance and statistics of prominent NFL quarterbacks in the current season.', '2023-07-24 00:00:00', 10, 14),
	(19, 'The Impact of Technology in NFL Training and Game Analysis', 'Examining how technology, including data analytics and virtual reality, is enhancing NFL training and game strategies.', '2023-07-24 00:00:00', 10, 14),
	(20, 'Champion\'s League Upsets: Underdogs vs. Giants', 'A review of remarkable Champion\'s League matches where underdog teams defied the odds and defeated football giants.', '2023-07-24 00:00:00', 11, 14),
	(21, 'The Evolution of Champion\'s League: From Humble Beginnings to Global Phenomenon', 'Tracing the history and growth of the Champion\'s League into one of the most prestigious football competitions in the world.', '2023-07-24 00:00:00', 11, 14),
	(22, 'Analyzing the Mind of Mr. Robots Protagonist, Elliot Alderson', 'Delving into the complex character of Elliot Alderson and his journey in the tech-thriller TV series Mr. Robot.', '2023-07-24 00:00:00', 12, 14),
	(23, 'The Offices Mockumentary Style: Redefining Sitcom Humor', 'Appreciating the unique mockumentary format of The Office', '2023-07-24 00:00:00', 13, 14);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~2 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `closed`, `category_id`, `user_id`) VALUES
	(3, 'A.I', '2023-07-24 11:27:52', 0, 1, 14),
	(4, 'Hardware', '2023-07-24 11:28:10', 0, 1, 14),
	(5, 'Web development', '2023-07-24 11:28:31', 0, 1, 14),
	(6, 'France', '2023-07-24 11:29:00', 0, 2, 14),
	(7, 'Internatonnal', '2023-07-24 11:53:03', 0, 2, 14),
	(8, 'Europe', '2023-07-24 11:53:04', 0, 2, 14),
	(9, 'NBA', '2023-07-24 11:53:04', 0, 3, 14),
	(10, 'NFL', '2023-07-24 11:53:05', 0, 3, 14),
	(11, 'Champion\'s league', '2023-07-24 11:53:05', 0, 3, 14),
	(12, 'Mr. Robot', '2023-07-24 11:53:06', 0, 4, 14),
	(13, 'Breaking Bad', '2023-07-24 11:53:06', 0, 4, 14),
	(14, 'The Office', '2023-07-24 11:53:07', 0, 4, 14),
	(15, 'How to cook...', '2023-07-24 11:53:07', 0, 5, 14),
	(16, 'French cuisine', '2023-07-24 11:53:08', 0, 5, 14),
	(17, 'Junk food', '2023-07-24 11:53:08', 0, 5, 14);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `registrationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~2 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `role`, `registrationDate`) VALUES
	(14, 'Charly', '$2y$10$VLneRmBy9zbHP/NH6BAz.Oq8DD4hdY4Qwd7todrBbPccg7Bwp7su.', 'Charly@test.fr', 'admin', '2023-07-21 11:20:36'),
	(31, 'compteuser', '$2y$10$EUPzZ6.5PMnZ8Q7OLfOk0uTD5uXd.ba7Uzmo.osQ64jvNcaMNYxHa', 'user@gmail.com', 'user', '2023-07-24 09:25:42');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
