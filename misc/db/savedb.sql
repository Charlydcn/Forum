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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Technology'),
	(2, 'News'),
	(3, 'Sports'),
	(4, 'Movies & TV'),
	(5, 'Cooking'),
	(11, 'test'),
	(15, 'qdfsqgfsfqsgsqggssqg');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `topic_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `id_topic` (`topic_id`),
  KEY `id_membre` (`user_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~39 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `topic_id`, `user_id`, `creationDate`, `modificationDate`) VALUES
	(23, '&lt;p&gt;Appreciating the unique mockumentary format of The Office&lt;/p&gt;', 14, 31, '2023-07-25 14:48:15', '2023-07-28 16:20:27'),
	(26, 'Mine is definitely Jim! His pranks on Dwight are legendary.', 14, 14, '2023-07-25 14:48:15', NULL),
	(27, 'I\'m in tears! Such an amazing show with great humor and heartwarming moments.', 14, 14, '2023-07-25 14:48:15', NULL),
	(28, 'I\'ve tried a few, but it\'s never quite as good as my grandma\'s.', 15, 14, '2023-07-25 14:48:15', NULL),
	(29, 'Should I go with a cast-iron pan or grill it?', 15, 14, '2023-07-25 14:48:15', NULL),
	(30, 'Any other classic French dishes I should explore?', 16, 14, '2023-07-25 14:48:15', NULL),
	(31, 'I can\'t resist a well-made Crème Brûlée!', 16, 14, '2023-07-25 14:48:15', NULL),
	(32, 'Who else enjoys a big bowl of cheesy nachos while watching a movie?', 17, 14, '2023-07-25 14:48:15', NULL),
	(33, 'Mine\'s definitely deep-fried Oreos at the fair!', 17, 14, '2023-07-25 14:48:15', NULL),
	(34, 'He goes from a mild-mannered teacher to a ruthless drug lord.', 13, 14, '2023-07-25 14:48:15', NULL),
	(35, 'It\'s so intense and well-written! I can\'t get enough of it.', 13, 14, '2023-07-25 14:48:15', NULL),
	(36, '&lt;p&gt;The future of Artificial Intelligence is both exciting and uncertain. How do you think A.I. will impact our daily lives??&lt;/p&gt;', 3, 14, '2023-07-25 14:48:15', '2023-07-28 13:27:20'),
	(37, 'Just read a fascinating article about deep learning algorithms. It\'s incredible how machines can learn from data patterns.', 3, 14, '2023-07-25 14:48:15', NULL),
	(38, 'I\'m building a new gaming PC. Any recommendations for the best graphics card on the market?', 4, 14, '2023-07-25 14:48:15', NULL),
	(39, 'Having some trouble with my laptop\'s battery life. Any tips to improve battery performance?', 4, 14, '2023-07-25 14:48:15', NULL),
	(40, 'Started learning web development recently. It\'s both challenging and rewarding. Any advice for a beginner?', 5, 14, '2023-07-25 14:48:15', NULL),
	(41, 'Just launched my first website! Feels amazing to see my code come to life. Check it out and let me know what you think!', 5, 14, '2023-07-25 14:48:15', NULL),
	(42, 'Planning a trip to France next summer. Any recommendations on must-visit places and hidden gems?', 6, 14, '2023-07-25 14:48:15', NULL),
	(43, 'French cuisine is a delight! Just tried escargot for the first time, and it was surprisingly delicious.', 6, 14, '2023-07-25 14:48:15', NULL),
	(44, 'The world is becoming more interconnected every day. Let\'s discuss global issues and cultural diversity.', 7, 14, '2023-07-25 14:48:15', NULL),
	(45, 'Any travelers out there? Share your favorite travel experiences from around the world!', 7, 14, '2023-07-25 14:48:15', NULL),
	(46, 'Europe has such rich history and diverse cultures. Which European countries have you visited, and what did you love about them?', 8, 14, '2023-07-25 14:48:15', NULL),
	(47, 'Let\'s talk about European football! Who\'s your favorite team in the Champions League?', 8, 14, '2023-07-25 14:48:15', NULL),
	(48, 'NBA fans, who\'s your all-time favorite basketball player? And which team do you support?', 9, 14, '2023-07-25 14:48:15', NULL),
	(49, 'Excited for the upcoming NBA playoffs! Predictions for this year\'s champions?', 9, 14, '2023-07-25 14:48:15', NULL),
	(50, 'Let\'s talk American football! Which NFL team is your favorite, and why?', 10, 14, '2023-07-25 14:48:15', NULL),
	(51, 'The Super Bowl halftime show was incredible this year! Who was your favorite performer?', 10, 14, '2023-07-25 14:48:15', NULL),
	(52, 'Champion\'s League matches never disappoint! Who do you think will win the trophy this year?', 11, 14, '2023-07-25 14:48:15', NULL),
	(53, 'Messi or Ronaldo - who\'s the greater football legend in Champion\'s League history?', 11, 14, '2023-07-25 14:48:15', NULL),
	(54, 'Just finished binge-watching Mr. Robot. What a mind-bending series! Any fan theories to discuss?', 12, 14, '2023-07-25 14:48:15', NULL),
	(55, 'Rami Malek\'s portrayal of Elliot Alderson is phenomenal! The show wouldn\'t be the same without him.', 12, 14, '2023-07-25 14:48:15', NULL),
	(56, 'Breaking Bad is a masterpiece! Who\'s your favorite character, and what\'s your favorite moment from the show?', 13, 14, '2023-07-25 14:48:15', NULL),
	(57, 'Gus Fring is one of the most memorable villains in TV history. His calm demeanor is chilling!', 13, 14, '2023-07-25 14:48:15', NULL),
	(58, 'The Office is the best mockumentary series ever! Which character\'s antics always make you laugh?', 14, 14, '2023-07-25 14:48:15', NULL),
	(59, 'Jim and Pam\'s relationship is #CoupleGoals. Can\'t get enough of their adorable moments.', 14, 14, '2023-07-25 14:48:15', NULL),
	(84, '&lt;p&gt;&lt;strong&gt;deep fried oreos&lt;/strong&gt; ? wtf&lt;/p&gt;', 17, 14, '2023-07-25 16:15:01', NULL),
	(85, '&lt;p&gt;yes, im from &lt;span style=&quot;background-color: #e03e2d;&quot;&gt;&lt;strong&gt;usa&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;', 17, 14, '2023-07-25 16:15:25', NULL),
	(86, '&lt;p&gt;test&lt;/p&gt;', 14, 14, '2023-07-28 13:57:49', NULL),
	(87, '&lt;p&gt;test&lt;/p&gt;', 7, 14, '2023-07-28 15:11:12', NULL),
	(89, '&lt;p&gt;test test&lt;/p&gt;', 7, 36, '2023-07-28 16:35:20', NULL);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `closed` tinyint NOT NULL DEFAULT '0',
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_topic`),
  KEY `id_category` (`category_id`),
  KEY `id_membre` (`user_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~15 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `closed`, `category_id`, `user_id`, `creationDate`) VALUES
	(3, 'A.I', 0, 1, 14, '2023-07-25 16:17:10'),
	(4, 'Hardware', 0, 1, 14, '2023-07-25 16:17:10'),
	(5, 'Web development', 0, 1, 14, '2023-07-25 16:17:10'),
	(6, 'France', 0, 2, 14, '2023-07-25 16:17:10'),
	(7, 'Internatonnal', 0, 2, 14, '2023-07-25 16:17:10'),
	(8, 'Europe', 0, 2, 14, '2023-07-25 16:17:10'),
	(9, 'NBA', 0, 3, 14, '2023-07-25 16:17:10'),
	(10, 'NFL', 0, 3, 14, '2023-07-25 16:17:10'),
	(11, 'Champion\'s league', 0, 3, 14, '2023-07-25 16:17:10'),
	(12, 'Mr. Robot', 0, 4, 14, '2023-07-25 16:17:10'),
	(13, 'Breaking Bad', 0, 4, 14, '2023-07-25 16:17:10'),
	(14, 'The Office', 0, 4, 14, '2023-07-25 16:17:10'),
	(15, 'How to cook...', 0, 5, 14, '2023-07-25 16:17:10'),
	(16, 'French cuisine', 0, 5, 14, '2023-07-25 16:17:10'),
	(17, 'Junk food', 0, 5, 14, '2023-07-25 16:17:10');

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `registrationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `ban` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~4 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `role`, `registrationDate`, `ban`) VALUES
	(14, 'Charly', '$2y$10$IJgZGk/yHPD6Wdzrx6OJc.THKoqKdPkWP62pWX/tRJf3gSrZol9Oa', 'Charly@test.fr', 'admin', '2023-07-21 11:20:36', 0),
	(31, 'compteUser', '$2y$10$ziOV6RbepZipdV/FQpt9MuNvIMosdLHmWuiLYnbNxHIUc2k4mOwB6', 'user@gmail.com', 'user', '2023-07-24 09:25:42', 0),
	(35, 'user', '$2y$10$7/gA5yIStSMZfo3jfoORe.GzD1PB9KozKEgWFqYVME7U1frJ5b0Vm', 'user@email.fr', 'user', '2023-07-25 15:20:48', 0),
	(36, 'carlos', '$2y$10$Hb.DpUz2OTDtZR5nA51S.eVO47eXfxpkinMjOwMT1xAu87Pk3BH9C', 'carlos@yahoo.net', 'user', '2023-07-28 16:23:25', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
