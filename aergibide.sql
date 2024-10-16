-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para aergibide
CREATE DATABASE IF NOT EXISTS `aergibide` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `aergibide`;

-- Volcando estructura para tabla aergibide.preguntas
CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  `categoria` varchar(50) NOT NULL DEFAULT '0',
  `id_usuario` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_preguntas_usuarios` (`id_usuario`),
  CONSTRAINT `FK_preguntas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aergibide.preguntas: ~3 rows (aproximadamente)
INSERT INTO `preguntas` (`id`, `titulo`, `descripcion`, `categoria`, `id_usuario`) VALUES
	(1, 'A', 'A', 'A', 1),
	(2, 'B', 'B', 'B', 2),
	(3, 'C', 'C', 'C', 3);

-- Volcando estructura para tabla aergibide.respuestas
CREATE TABLE IF NOT EXISTS `respuestas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenido` varchar(50) NOT NULL DEFAULT '0',
  `id_usuario` int NOT NULL DEFAULT '0',
  `id_pregunta` int NOT NULL DEFAULT '0',
  `like` int NOT NULL DEFAULT '0',
  `dislike` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_respuestas_usuarios` (`id_usuario`),
  KEY `FK_respuestas_preguntas` (`id_pregunta`),
  CONSTRAINT `FK_respuestas_preguntas` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id`),
  CONSTRAINT `FK_respuestas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aergibide.respuestas: ~3 rows (aproximadamente)
INSERT INTO `respuestas` (`id`, `contenido`, `id_usuario`, `id_pregunta`, `like`, `dislike`) VALUES
	(1, 'A', 3, 1, 1, 0),
	(2, 'B', 1, 2, 0, 0),
	(6, 'C', 2, 3, 0, 0);

-- Volcando estructura para tabla aergibide.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `contrasenna` varchar(50) NOT NULL DEFAULT '0',
  `correo` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla aergibide.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `contrasenna`, `correo`) VALUES
	(1, 'Jon', '12345', 'jon.garay@ikasle.egibide.org'),
	(2, 'Jordi', '12345', 'jordi.fernandez@ikasle.egibide.org'),
	(3, 'Ibai', '12345', 'ibai.lopezdelapuente@ikasle.egibide.org');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
