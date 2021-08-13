-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.34-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para ingenieriavotos
DROP DATABASE IF EXISTS `ingenieriavotos`;
CREATE DATABASE IF NOT EXISTS `ingenieriavotos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ingenieriavotos`;

-- Volcando estructura para tabla ingenieriavotos.acceso
DROP TABLE IF EXISTS `acceso`;
CREATE TABLE IF NOT EXISTS `acceso` (
  `Id_Acceso` int(11) NOT NULL,
  `Clave` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`Id_Acceso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ingenieriavotos.acceso: ~2 rows (aproximadamente)
DELETE FROM `acceso`;
/*!40000 ALTER TABLE `acceso` DISABLE KEYS */;
INSERT INTO `acceso` (`Id_Acceso`, `Clave`) VALUES
	(201503728, 'Ý¼	~å0$QV9ŒšóÎ'),
	(201504691, 'ÎŸA:M\rx±†‡ó>·dº');
/*!40000 ALTER TABLE `acceso` ENABLE KEYS */;

-- Volcando estructura para tabla ingenieriavotos.historial
DROP TABLE IF EXISTS `historial`;
CREATE TABLE IF NOT EXISTS `historial` (
  `Id_Historial` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Registrado` int(11) NOT NULL,
  `Fecha_Hora` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Historial`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ingenieriavotos.historial: ~11 rows (aproximadamente)
DELETE FROM `historial`;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`Id_Historial`, `Id_Registrado`, `Fecha_Hora`) VALUES
	(1, 201504691, '2020-02-26 22:20:30'),
	(2, 201503728, '2020-02-26 22:21:10'),
	(3, 201504691, '2020-02-26 22:21:19'),
	(4, 100041000, '2020-02-26 22:22:19'),
	(5, 201503728, '2020-02-26 22:24:00'),
	(6, 201504691, '2020-02-26 22:24:09'),
	(7, 100041000, '2020-02-26 22:24:18'),
	(8, 201230403, '2020-02-27 01:24:49'),
	(9, 201504691, '2020-02-27 01:59:42'),
	(10, 100041000, '2020-02-27 02:00:15'),
	(11, 201503728, '2020-02-27 02:05:19'),
	(12, 201504691, '2020-02-27 02:06:24'),
	(13, 201503728, '2020-02-27 02:06:33'),
	(14, 201561414, '2020-10-31 00:45:30'),
	(15, 201502524, '2021-08-12 23:52:44');
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;

-- Volcando estructura para tabla ingenieriavotos.persona
DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `Id_Persona` int(11) NOT NULL,
  `Nombre` varchar(80) DEFAULT NULL,
  `Ap_Paterno` varchar(80) DEFAULT NULL,
  `Ap_Materno` varchar(80) DEFAULT NULL,
  `Dentro` bit(1) DEFAULT b'0',
  PRIMARY KEY (`Id_Persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ingenieriavotos.persona: ~27 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`Id_Persona`, `Nombre`, `Ap_Paterno`, `Ap_Materno`, `Dentro`) VALUES
	(100041000, 'Cecilio', 'Perez', 'Cortes', b'1'),
	(201110493, 'Erliss J.', 'Espejel', 'Calzada', b'0'),
	(201230403, 'Jose L.', 'Sanchez', 'Zeferino', b'1'),
	(201304006, 'Esteban', 'Castro', 'Pola', b'0'),
	(201426788, 'Edgar Y.', 'Ruiz', 'Quechol', b'1'),
	(201431764, 'Irving O.', 'Hernandez', 'Palma', b'0'),
	(201433242, 'Jose A.', 'Morales', 'Tlalolin', b'0'),
	(201441304, 'Christopher A.', 'De la Cruz', 'Sanchez', b'0'),
	(201447402, 'Noe', 'Puebla', 'Cruz', b'0'),
	(201502524, 'Wesley', 'Perez', 'Daniel', b'1'),
	(201503728, 'Luis', 'Hernandez', 'Pintor', b'1'),
	(201504691, 'Juan Daniel', 'Garcia', 'Lopez', b'1'),
	(201507326, 'Elisa', 'Lopez', 'Gamas', b'0'),
	(201512921, 'Guillermo', 'Paredes', 'Barrientos', b'0'),
	(201514450, 'Celso', 'Martinez', 'Gonzalez', b'0'),
	(201518098, 'Marisol', 'Lopez', 'Cortes', b'0'),
	(201521328, 'Diana L.', 'Hernandez', 'Mendoza', b'0'),
	(201522701, 'Andrea', 'Rojas', 'Hernandez', b'0'),
	(201523578, 'Israel', 'Zago', 'Martinez', b'0'),
	(201536247, 'Diego', 'Chagolla', 'Aparicio', b'0'),
	(201536518, 'Yair', 'Cortes', 'Vasquez', b'0'),
	(201536598, 'Cinthia', 'Cruz', 'Delgado', b'0'),
	(201540034, 'Israel', 'Guzman', 'Vasquez', b'0'),
	(201544569, 'Guadalupe', 'Ojeda', 'Posadas', b'0'),
	(201549508, 'Estefani D.', 'Valerdi', 'Islas', b'0'),
	(201559691, 'Miguel', 'Martinez', 'Garcia', b'0'),
	(201561414, 'Carlos V.', 'Serrano', 'Benitez', b'1');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
