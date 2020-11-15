# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.20)
# Database: project_bills
# Generation Time: 2020-11-13 17:47:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bill_rows
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bill_rows`;

CREATE TABLE `bill_rows` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `amount_iva_free` double NOT NULL,
  `amount_iva_included` double NOT NULL,
  `total_iva_included` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bill_rows` WRITE;
/*!40000 ALTER TABLE `bill_rows` DISABLE KEYS */;

INSERT INTO `bill_rows` (`id`, `description`, `quantity`, `amount_iva_free`, `amount_iva_included`, `total_iva_included`)
VALUES
	(1,'description',123,12,12,123),
	(2,'description 2',12,34,34,34);

/*!40000 ALTER TABLE `bill_rows` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bills
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bills`;

CREATE TABLE `bills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_user_id` int DEFAULT NULL,
  `fk_bill_rows_id` int DEFAULT NULL,
  `date` date NOT NULL,
  `number` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_22775DD0615FBA7A` (`fk_bill_rows_id`),
  KEY `IDX_22775DD05741EEB9` (`fk_user_id`),
  CONSTRAINT `FK_22775DD05741EEB9` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_22775DD0615FBA7A` FOREIGN KEY (`fk_bill_rows_id`) REFERENCES `bill_rows` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;

INSERT INTO `bills` (`id`, `fk_user_id`, `fk_bill_rows_id`, `date`, `number`)
VALUES
	(1,1,1,'2020-11-25',12),
	(2,2,2,'2020-11-25',1);

/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `surname`)
VALUES
	(1,'user_1','surname_1'),
	(2,'user_2','surname_2'),
	(3,'user_3','surname_3');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
