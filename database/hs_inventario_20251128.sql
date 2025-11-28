-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: hs_inventario
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `arriendo_detalle`
--

DROP TABLE IF EXISTS `arriendo_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arriendo_detalle` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Contrato` int NOT NULL,
  `Equipo_id` int NOT NULL,
  `Equipo_detalle_id` int NOT NULL,
  `Estado` enum('En stock','En arriendo','Finalizado') COLLATE utf8mb4_general_ci NOT NULL,
  `Precio_equipo` decimal(15,2) NOT NULL,
  `Garantia` decimal(15,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_contrato_idx` (`Contrato`),
  KEY `equipo_id_idx` (`Equipo_id`),
  CONSTRAINT `equipo_id` FOREIGN KEY (`Equipo_id`) REFERENCES `equipos` (`ID_Equipos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_contrato` FOREIGN KEY (`Contrato`) REFERENCES `arriendos` (`Contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arriendo_detalle`
--

LOCK TABLES `arriendo_detalle` WRITE;
/*!40000 ALTER TABLE `arriendo_detalle` DISABLE KEYS */;
INSERT INTO `arriendo_detalle` VALUES (47,2628,1,5,'En stock',82500.00,3800000.00,'2025-11-14 15:58:46','2025-11-14 15:58:46'),(48,2628,3,1,'En stock',55555.00,5555555.00,'2025-11-14 15:58:46','2025-11-14 15:58:46');
/*!40000 ALTER TABLE `arriendo_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arriendos`
--

DROP TABLE IF EXISTS `arriendos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arriendos` (
  `Contrato` int NOT NULL AUTO_INCREMENT,
  `ID_Cliente` int NOT NULL,
  `Fecha_inicio` datetime NOT NULL,
  `Fecha_fin` datetime NOT NULL,
  `Guia_Despacho` int NOT NULL,
  `Precio_total` decimal(10,2) NOT NULL,
  `ruta_contrato_pdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Estado` enum('En curso','Finalizado','Cancelado') COLLATE utf8mb4_general_ci NOT NULL,
  `Observaciones` text COLLATE utf8mb4_general_ci,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Contrato`),
  KEY `fk_ID_Cliente_idx` (`ID_Cliente`),
  CONSTRAINT `fk_ID_Cliente` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Clientes`)
) ENGINE=InnoDB AUTO_INCREMENT=2647 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arriendos`
--

LOCK TABLES `arriendos` WRITE;
/*!40000 ALTER TABLE `arriendos` DISABLE KEYS */;
INSERT INTO `arriendos` VALUES (2628,10,'2025-11-14 15:57:25','2025-11-14 12:59:43',3065,138055.00,'contratos/contrato_2628.pdf','Finalizado',NULL,'2025-11-14 15:59:43','2025-11-14 15:58:46');
/*!40000 ALTER TABLE `arriendos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bombas`
--

DROP TABLE IF EXISTS `bombas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bombas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int NOT NULL,
  `Equipo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Marca` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Modelo` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Serie` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Codigo` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Precio` decimal(15,2) NOT NULL,
  `Garantia` decimal(15,2) NOT NULL,
  `Estado` enum('En stock','En arriendo','En reparacion','Fuera de servicio') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En stock',
  PRIMARY KEY (`id`),
  KEY `b_id_equipo_idx` (`Id_Equipo`),
  CONSTRAINT `b_id_equipo` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipos` (`ID_Equipos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bombas`
--

LOCK TABLES `bombas` WRITE;
/*!40000 ALTER TABLE `bombas` DISABLE KEYS */;
INSERT INTO `bombas` VALUES (22,1,'BOMBA PARA CABEZAL','HYTORC','HY-230','27200225','09',82500.00,3800000.00,'En stock'),(23,1,'BOMBA PARA CABEZAL','HYTORC','HYTORC-230','E539131',NULL,82500.00,3800000.00,'En stock'),(24,1,'BOMBA PARA CABEZAL','HYTORC','HY-230',NULL,'30',82500.00,3800000.00,'En stock'),(25,1,'BOMBA ELECTROHIDRAULICA SIMPLE ACCION','ENERPAC','ZU4',NULL,'HS-BE-01',43450.00,3800000.00,'En stock'),(26,1,'BOMBA ELECTROHIDRAULICA SIMPLE ACCION','ENERPAC','ZU4',NULL,'HS-BE-03',43450.00,3800000.00,'En stock'),(27,1,'BOMBA ELECTROHIDRAULICA SIMPLE ACCION','POWER TEAM','A','1409AP65658','06',43450.00,3800000.00,'En stock'),(28,1,'BOMBA ELECTROHIDRAULICA SIMPLE ACCION','POWER TEAM','A','2912AT204485','04',43450.00,3800000.00,'En stock'),(29,1,'BOMBA MANUAL DOBLE ACCION','POWER TEAM','D','0110AS153382','20',40150.00,3400000.00,'En stock'),(30,1,'BOMBA MANUAL DOBLE ACCION','ENERPAC','P-464',NULL,'02',35530.00,2900000.00,'En stock'),(31,1,'BOMBA ELECTROHIDRAULICA DOBLE ACCION','POWER TEAM ','PE17','9500',NULL,52800.00,4800000.00,'En stock'),(32,1,'BOMBA MANUAL','ENERPAC','P-80',NULL,'HS-BM-01',22550.00,1600000.00,'En stock'),(33,1,'BOMBA MANUAL','ENERPAC','P-80',NULL,'HS-BM-02',22550.00,1600000.00,'En stock'),(34,1,'BOMBA MANUAL','ENERPAC','P-80',NULL,'HS-BM-03',22550.00,1600000.00,'En stock'),(35,1,'BOMBA PARA CABEZAL','HYTORC ','HY-230','2128960011',NULL,82500.00,3800000.00,'En stock');
/*!40000 ALTER TABLE `bombas` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `bombas_BEFORE_INSERT` BEFORE INSERT ON `bombas` FOR EACH ROW BEGIN
	SET SQL_SAFE_UPDATES = 0;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `bombas_AFTER_INSERT` AFTER INSERT ON `bombas` FOR EACH ROW BEGIN
	update equipos
    set Cantidad_total = (
		select count(*) from bombas where Equipo = NEW.Equipo
        )
        Where ID_Equipos = NEW.id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `bombas_AFTER_UPDATE` AFTER UPDATE ON `bombas` FOR EACH ROW BEGIN
	UPDATE equipos
	SET cantidad_total = (
		SELECT COUNT(*) FROM bombas WHERE Equipo = NEW.Equipo
	)
	Where ID_Equipos = NEW.id_Equipo;

  -- Actualiza también el antiguo nombre si cambió
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM bombas WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = NEW.id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `bombas_AFTER_DELETE` AFTER DELETE ON `bombas` FOR EACH ROW BEGIN
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM bombas WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = old.id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `cabezal`
--

DROP TABLE IF EXISTS `cabezal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cabezal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int NOT NULL,
  `Equipo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Marca` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Modelo` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Cuadrante` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Serie` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Codigo` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Observacion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Precio` decimal(15,2) NOT NULL,
  `Garantia` decimal(15,2) NOT NULL,
  `Estado` enum('En stock','En arriendo','En reparacion','Fuera de servicio') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En stock',
  PRIMARY KEY (`id`),
  KEY `fk_id_equipo_idx` (`Id_Equipo`),
  CONSTRAINT `fk_id_equipo` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipos` (`ID_Equipos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabezal`
--

LOCK TABLES `cabezal` WRITE;
/*!40000 ALTER TABLE `cabezal` DISABLE KEYS */;
INSERT INTO `cabezal` VALUES (11,3,'CABEZAL HIDRAULICO','HYTORC','3MXT','1\"','M3-EA-1007-087','31','EQUIPO CON SU MALETA DE TRASLADO',74800.00,4200000.00,'En stock'),(12,3,'CABEZAL HIDRAULICO','HYDRAULIC SERVICE','3MXTD','1\"','2009122474','74','EQUIPO EN SU MALETA DE TRASLADO',74800.00,4200000.00,'En stock'),(13,3,'CABEZAL HIDRAULICO','HYTORC','AVANTI 3','1\"','E3207','09',NULL,74800.00,4200000.00,'En stock'),(14,3,'CABEZAL HIDRAULICO','HYTORC','AVANTI 3','1\"',NULL,'11','EQUIPO EN SU MALETA DE TRASLADO',74800.00,4200000.00,'En stock'),(15,3,'CABEZAL HIDRAULICO','HYTORC','AVANTI 1 DUAL','3/4',NULL,'TITH-11',NULL,62700.00,3200000.00,'En stock'),(16,3,'CABEZAL HIDRAULICO','HYTORC','5 MXT','1\" 1/2',NULL,'41','EQUIPO EN SU MALETA DE TRASLADO',82500.00,5500000.00,'En stock'),(17,3,'CABEZAL HIDRAULICO','HYTORC','5MXT','1\" 1/2',NULL,'35','EQUIPO EN SU MALETA DE TRASLADO',82500.00,5500000.00,'En stock'),(18,3,'CABEZAL HIDRAULICO','HYTORC','5 MXT','1\" 1/2','M5TRII34-295','88','EQUIPO EN SU MALETA DE TRASLADO',82500.00,5500000.00,'En stock'),(19,3,'CABEZAL HIDRAULICO','HYTORC','AVANTI 5 DUAL','1\" 1/2','0775','10','EQUIPO EN SU MALETA DE TRASLADO',82500.00,5500000.00,'En stock'),(20,3,'CABEZAL HIDRAULICO','SIMPLEX','WT-5','1\" 1/2','WT-5-X23-17','04',NULL,82500.00,5500000.00,'En stock'),(21,3,'CABEZAL HIDRAULICO','HYTORC','10 MXT','1\" 1/2','M10-EA-1034-072','07',NULL,101200.00,7800000.00,'En stock'),(22,3,'CABEZAL HIDRAULICO','TORC','TTX7','1\" 1/2','TX7-EA-1230-026','13',NULL,91300.00,6200000.00,'En stock'),(23,3,'CABEZAL HIDRAULICO','HYDRATIGHT SWEENEY','RSI20','2\" 1/2','A0022','19',NULL,352000.00,16200000.00,'En stock'),(24,3,'CABEZAL HIDRAULICO','HYDRATIGHT SWEENEY','RSI20','2\" 1/2','A0029','15',NULL,352000.00,16200000.00,'En stock'),(25,3,'CABEZAL HEXAGONAL','HYDRAULIC SERVICE ','8XLCT','80 mm','201809005','X1018008',NULL,80300.00,5470000.00,'En stock'),(26,3,'CABEZAL HEXAGONAL ','HYDRAULIC SERVICE ','8XLCT','80 mm','201809001','X1018006','EQUIPO EN SU MALETA DE TRASLADO',80300.00,5470000.00,'En stock'),(27,3,'CABEZAL HEXAGONAL ','HYDRAULIC SERVICE ','8XLCT','80 mm','201809002','X1018022','EQUIPO EN SU MALETA DE TRASLADO',80300.00,5470000.00,'En stock'),(28,3,'CABEZAL HEXAGONAL ','HYDRAULIC SERVICE ','8XLCT','80mm ','201809002','X1018003','EQUIPO EN SU MALETA DE TRASLADO ',80300.00,5470000.00,'En stock'),(29,3,'CABEZAL HEXAGONAL ','HYDRAULIC SERVICE ','8XLCT','80mm','201809004','X1018021','EQUIPO EN SU MALETA DE TRASLADO',80300.00,5470000.00,'En stock'),(30,3,'CABEZAL HEXAGONAL ','HYTORC','STEALTH 8 ','2\" 3/8','S8F1315-55',NULL,NULL,63800.00,4200000.00,'En stock'),(31,3,'CABEZAL HEXAGONAL ','HYTORC','STEALTH 4','55mm','S4F0849-199',NULL,NULL,59400.00,3800000.00,'En stock'),(32,3,'CABEZAL HEXAGONAL ','HYTORC ','STEALTH 4','55mm','PF11110','CAPF 15',NULL,59400.00,3800000.00,'En stock'),(33,3,'CABEZAL HEXAGONAL ','WREN','XLCT-14','95mm','F2326','16',NULL,101200.00,6200000.00,'En stock'),(34,3,'CABEZAL HEXAGONAL ','HYTORC ','STEALTH 4 ','46',NULL,'39',NULL,53900.00,3600000.00,'En stock'),(35,3,'CABEZAL HIDRÁULICO ','HYDRAULIC SERVICE ','3MXTD','1\"',NULL,'73',NULL,74800.00,4200000.00,'En stock');
/*!40000 ALTER TABLE `cabezal` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cabezal_BEFORE_INSERT` BEFORE INSERT ON `cabezal` FOR EACH ROW BEGIN
	SET SQL_SAFE_UPDATES = 0;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cabezal_AFTER_INSERT` AFTER INSERT ON `cabezal` FOR EACH ROW BEGIN
	update equipos
    set Cantidad_total = (
		select count(*) from cabezal where Equipo = NEW.Equipo
        )
        Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cabezal_AFTER_UPDATE` AFTER UPDATE ON `cabezal` FOR EACH ROW BEGIN
	UPDATE equipos
	SET cantidad_total = (
		SELECT COUNT(*) FROM cabezal WHERE Equipo = NEW.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;

  -- Actualiza también el antiguo nombre si cambió
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM cabezal WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cabezal_AFTER_DELETE` AFTER DELETE ON `cabezal` FOR EACH ROW BEGIN
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM cabezal WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = old.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('hydraulic-service-cache-livewire-rate-limiter:3ab898f7d83a4bfa0c9704a70d783d96996cadad','i:3;',1764186250),('hydraulic-service-cache-livewire-rate-limiter:3ab898f7d83a4bfa0c9704a70d783d96996cadad:timer','i:1764186250;',1764186250),('hydraulic-service-cache-livewire-rate-limiter:e4287cfae89b468e127f71dba4601c2ca596c863','i:1;',1764245313),('hydraulic-service-cache-livewire-rate-limiter:e4287cfae89b468e127f71dba4601c2ca596c863:timer','i:1764245312;',1764245312);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cilindros`
--

DROP TABLE IF EXISTS `cilindros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cilindros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int NOT NULL,
  `Equipo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Marca` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Modelo` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Accion` enum('Simple','Doble') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Toneladas` int DEFAULT NULL,
  `Altura` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Carrera` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Codigo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Precio` decimal(15,2) NOT NULL,
  `Garantia` decimal(15,2) NOT NULL,
  `Estado` enum('En stock','En arriendo','En reparacion','Fuera de servicio') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En stock',
  PRIMARY KEY (`id`),
  KEY `fk_id_equipo_idx` (`Id_Equipo`),
  KEY `llave_id_equipo_idx` (`Id_Equipo`),
  CONSTRAINT `llave_id_equipo` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipos` (`ID_Equipos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cilindros`
--

LOCK TABLES `cilindros` WRITE;
/*!40000 ALTER TABLE `cilindros` DISABLE KEYS */;
INSERT INTO `cilindros` VALUES (2,2,'Cilindro Hidraulico','Enerpac','CYL820','Simple',20,'2,5\"','0,5\"','',522220.00,22522221.00,'En stock');
/*!40000 ALTER TABLE `cilindros` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cilindros_BEFORE_INSERT` BEFORE INSERT ON `cilindros` FOR EACH ROW BEGIN
	SET SQL_SAFE_UPDATES = 0;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cilindros_AFTER_INSERT` AFTER INSERT ON `cilindros` FOR EACH ROW BEGIN
	update equipos
    set Cantidad_total = (
		select count(*) from cilindros where Equipo = NEW.Equipo
        )
        Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cilindros_AFTER_UPDATE` AFTER UPDATE ON `cilindros` FOR EACH ROW BEGIN
	UPDATE equipos
	SET cantidad_total = (
		SELECT COUNT(*) FROM cilindros WHERE Equipo = NEW.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;

  -- Actualiza también el antiguo nombre si cambió
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM cilindros WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cilindros_AFTER_DELETE` AFTER DELETE ON `cilindros` FOR EACH ROW BEGIN
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM cilindros WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = old.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `ID_Clientes` int NOT NULL AUTO_INCREMENT,
  `Empresa` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Rut` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Correo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Direccion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Ciudad` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Clientes`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (2,'Hydraulic Service','76.030.364-K',NULL,NULL,'Av. las parcelas 4020','Iquique'),(3,'Acantha SPA','77.177.635-3',NULL,NULL,NULL,NULL),(4,'ACF Minera S.A.','79.728.000-3',NULL,NULL,NULL,'Iquique'),(5,'Alejandro Castro Olivares Servicios Integrales E.I.R.L','76.898.878-1',NULL,NULL,NULL,NULL),(6,'AMECO','96.862.140-8',NULL,NULL,NULL,'Santiago'),(7,'BESALCO MINERIA S.A.','96.727.830-0',NULL,NULL,'Av. Tajamar 183 OF 401','Santiago'),(8,'BACIAN Y ROCHA','79.863.750-9',NULL,NULL,'Mz D Sitio 7','Alto Hospicio'),(9,'BRUENING INDUSTRIAL','76.035.258-6',NULL,NULL,'Ruta A16 KM 34','Alto Hospicio'),(10,'SKC RED SPA','76.686.138-5',NULL,NULL,'AV. EDUARD FREI MONTALVA 15800','SANTIAGO'),(11,'ARA-CHILE ARRIENDO Y MANTENCION DE EQUIPOS MINEROS','77.871.358-6',NULL,NULL,'PJE. LOS CHUNCHOS 2991','IQUIQUE'),(12,'ASB COMERCIALIZADORA Y SERVICIOS INTEGRALES SPA','76.990.168-K',NULL,NULL,NULL,'IQUIQUE'),(13,'ASM MAQUINARIAS CLAUDIO ARMANDO ARAYA MORALES E.I.R.L.','76.976.768-1',NULL,NULL,'PASAJE TREINTA 3041 LAGUNA VERDE','IQUIQUE'),(14,'AUTORENTAS DEL PACIFICO SPA','83.547.100-4',NULL,NULL,NULL,'SANTIAGO'),(15,'AUTOSCANNER MASTER SPA','77.307.355-4',NULL,NULL,'PJE STA ALEJANDRA 3206 CH STA MAGDALENA','Alto Hospicio'),(16,'AVICOLA SAN ANTONIO LIMITADA','76.184.234-K',NULL,NULL,NULL,'IQUIQUE'),(17,'BERMUDEZ Y CASTILLO SERVICE S.A.','76.146.887-1',NULL,NULL,NULL,'IQUIQUE'),(18,'BLUE EXPRESS S.A.','96.938.840-5',NULL,NULL,NULL,'SANTIAGO'),(19,'BUDGE CHILE SPA','76.869.432-K',NULL,NULL,NULL,'ARICA'),(20,'BUILDTEK SPA','76.105.206-3',NULL,NULL,NULL,'SANTIAGO'),(21,'C Y C MAQUINARIAS','77.625.254-9','+56932617821',NULL,'LOS AROMOS 4060','ALTO HOSPICIO'),(22,'CARCAMO INGENIERIA LIMITADA','77.662.850-6',NULL,NULL,NULL,'SANTIAGO'),(23,'CARLOS ALBERTO TORRES MUÑOZ','11.599.653-3',NULL,NULL,NULL,NULL),(24,'CONFERT MAQUINARIAS LIMITADA','77.144.079-7',NULL,NULL,'AV CIRCUNVALACION 3208 NUEVA ESPERANZA',NULL),(25,'CESAR ANTONIO RIOS GOLDSCHMIDT','15.557.272-8',NULL,NULL,NULL,NULL),(26,'CF CONSTRUCCIONES SPA','77.019.695-7',NULL,NULL,NULL,NULL),(27,'CLF INVERSIONES LIMITADA','76.335.154-8',NULL,NULL,NULL,NULL),(28,'COMERCIAL E INDUSTRIAL V&B LIMITADA','76.150.981-0',NULL,NULL,NULL,NULL),(29,'COMERCIAL EMANUEL LIMITADA','76.875.075-0',NULL,NULL,NULL,NULL),(30,'COMERCIAL PARTEK LIMITADA','76.075.840-K',NULL,NULL,'CACIQUE COLIN 2003 COND 220','SANTIAGO'),(31,'CONSTRUCCIONES Y MONTAJES COM S.A.','96.717.980-9',NULL,NULL,NULL,NULL),(32,'CONSTRUCTORA DE PAVIMENTOS ASFALTICOS BITUMIX S.A.','84.060.600-7',NULL,NULL,NULL,'SANTIAGO'),(33,'VULCO S.A.','91.619.000-K',NULL,NULL,NULL,'SANTIAGO'),(34,'YERKO ALEJANDRO MAYA POCH','18.005.484-7',NULL,NULL,NULL,NULL),(35,'VIZCAYA S.A.','77.589.450-4',NULL,NULL,'RUTA A-16 KM 20MPL I 2 5123 CR LOTE 2','ALTO HOSPICIO'),(36,'VERMEER CHILE SPA','76.890.983-0',NULL,NULL,NULL,'SANTIAGO'),(37,'VENFER SPA','76.875.463-2',NULL,NULL,NULL,NULL),(38,'VCM INGENIERIA CIVIL Y CONSTRUCCION LTDA','76.445.564-9',NULL,NULL,NULL,NULL),(39,'VALTECK CHILE SPA','76.591.503-1',NULL,NULL,NULL,'VALPARAISO'),(40,'VALNICO INGENIERIA ARQUITECTURA PROYECTOS MONTAJES Y CONSTRUCCION LIMITADA','76.450.141-1',NULL,NULL,NULL,NULL),(41,'TRINTY CAPITAL INC. SPA','77.030.069-K',NULL,NULL,NULL,NULL),(42,'TRANSPORTES MONEDA LIMITADA','79.518.000-1',NULL,NULL,NULL,NULL),(43,'TRANSPORTES IMPERIAL LIMITADA','76.785.260-6',NULL,NULL,NULL,NULL),(44,'TRANSPORTES CARLA VALLES INOSTROZA E.I.R.L.','76.228.125-2',NULL,NULL,NULL,NULL),(45,'TRANSPORTE Y ARRIENDO DE MAQUINARIAS SOTO SPA','77.290.051-1',NULL,NULL,NULL,NULL),(46,'TRANSPORTE DE CARGA, ARRIENDO DE MAQUINARIAS, REPARACIONES SPA','76.973.144-K',NULL,NULL,NULL,NULL),(47,'THOR SOCIEDAD DE TRANSPORTE Y LOGISTICA LIMITADA','76.048.534-9',NULL,NULL,NULL,NULL),(48,'SOLUCIONES CIVILES E INDUSTRIALES EYP SPA','77.036.753-0',NULL,NULL,NULL,NULL),(49,'SOLTEX CHILE S.A.','96.507.490-2',NULL,NULL,NULL,NULL),(50,'SOLMETOR INDUSTRIAL SPA','76.804.154-7',NULL,NULL,'AV LOS AROMOS 4521','ALTO HOSPICIO'),(51,'SOCIEDAD TRANSPORTES NORTRANS LIMITADA','76.681.140-K',NULL,NULL,NULL,NULL),(52,'SOCIEDAD SIMEC SERVICIOS INTEGRALES LTDA','76.747.860-7',NULL,NULL,NULL,NULL),(53,'SOCIEDAD MECANICA Y ELECTROMECANICA NAVAL TRESAM NORTE LIMITADA','76.113.368-3',NULL,NULL,NULL,NULL),(54,'SOCIEDAD INDUSTRIAL INNOVA ACEROS LIMITADA','76.650.542-2',NULL,NULL,NULL,NULL),(55,'SOCIEDAD DE TRANSPORTES, ARRENDAMIENTOS Y SERVICIOS PRO MAQUINARIAS SPA','77.314.531-8',NULL,NULL,NULL,NULL),(56,'SOCIEDAD DE TRANSPORTES OXA LIMITADA','76.093.217-5',NULL,NULL,'RUTA A-16 KM 34 SITIO 2','ALTO HOSPICIO'),(57,'SOCIEDAD DE TRANSPORTES H&D LIMITADA','76.629.378-6',NULL,NULL,NULL,NULL),(58,'SOCIEDAD DE SERVICIOS MESUT SPA','76.215.152-9',NULL,NULL,NULL,NULL),(59,'SOCIEDAD DE SERVICIOS ELECTRICOS Y ELECTROMECANICOS ELECTROMINING LIMITADA','76.242.279-4',NULL,NULL,NULL,NULL),(60,'SOCIEDAD DE INVERSIONES SYD SPA','77.675.321-1',NULL,NULL,NULL,NULL),(61,'SOCIEDAD COMERCIAL, INMOBILIARIA. TRANSPORTES, METALURGICA Y SERVICIOS ','76.169.572-K',NULL,NULL,NULL,NULL),(62,'SOCIEDAD COMERCIAL JIP MORALES LIMITADA','76.423.793-5',NULL,NULL,NULL,NULL),(63,'SOCIEDAD COMERCIAL HIDROPEX LIMITADA','76.215.420-K',NULL,NULL,NULL,NULL),(64,'SOCIEDAD COMERCIAL E INDUSTRIAL SIMM LIMITADA','76.078.673-K',NULL,NULL,'ALDUNATE S/N LOTE 2 SITIO 2','POZO ALMONTE'),(65,'SOCIEDAD COMERCIAL E INDUSTRIAL MORTANKS LIMITADA','76.660.573-7',NULL,NULL,NULL,NULL),(66,'SOCIEDAD COMERCIAL E INDUSTRIAL MOR DIVISION SERVICIOS LIMITADA','76.462.584-6',NULL,NULL,NULL,NULL),(67,'SOCIEDAD ACL MAQUINARIAS LIMITADA','76.196.547-6',NULL,NULL,NULL,NULL),(68,'SOC COMERCIAL VILAS MOTOR Y COMPAÑIA LIMITADA','77.421.750-9',NULL,NULL,NULL,NULL),(69,'SOC COMERCIAL EL SALITRE LIMITADA','79.638.870-6',NULL,NULL,'CALLE PATRICIO LYNCH 1059','IQUIQUE'),(70,'SOC COM ABQ LTDA','76.902.930-3',NULL,NULL,'HUANTAJAYA 01107-2771-CR KM 5.7 RUTA A-616','ALTO HOSPICIO'),(71,'SMART LOGIC SPA','77.823.226-K',NULL,NULL,NULL,NULL),(72,'CONSTRUCTORA FRANCISCO CORTES CORTES E.I.R.L.','76.501.062-4',NULL,NULL,NULL,NULL),(73,'CONSTRUCTORA PEREX Y FLORES LIMITADA','77.674.290-2',NULL,NULL,'HERNAN MERINO CORREA 4018 ','ALTO HOSPICIO'),(74,'CORPESCA','96.893.820-7',NULL,NULL,'AVENIDA EL GOLF 150 P-15','SANTIAGO'),(75,'COSSIO DIAZ HRNOS. LIMITADA','77.687.836-7',NULL,NULL,NULL,NULL),(76,'CPT REMOLCADORES S.A.','76.037.572-1',NULL,NULL,NULL,NULL),(77,'CYP INGENIERIA Y CONSTRUCCION SPA','77.805.288-1',NULL,NULL,'PC 121 LT B 1 RDA DE MANANTIALES PLACILLA',NULL),(78,'CTELEC SPA','76.881.733-2',NULL,NULL,NULL,NULL),(79,'SIGES CHILE SPA ','96.992.160-K',NULL,NULL,NULL,NULL),(80,'SIEMENS SOCIEDAD ANONIMA','94.995.000-K',NULL,NULL,NULL,NULL),(81,'SERVICIOS NEFI ALEJANDRO BAEZA FIGUEROA E.I.R.L.','76.329.355-6',NULL,NULL,NULL,NULL),(82,'SERVICIOS NAXOS SPA','76.025.918-7',NULL,NULL,NULL,NULL),(83,'SERVICIOS MECANICOS MARCELA HUANCA E.I.R.L.','77.721.953-7',NULL,NULL,NULL,NULL),(84,'SERVICIOS MAQUINARIAS Y ANDAMIOS SERVIMAQUI LIMITADA','76.183.605-6',NULL,NULL,NULL,NULL),(85,'SERVICIOS INTEGRALES PARA LA MINERIA COMAR LIMITADA','76.493.808-9',NULL,NULL,'LA CONCORDIA 2144','IQUIQUE'),(86,'SERVICIOS INTEGRALES E INDUSTRIALES ANGELICA POBLETE UGARTE E.I.R.L.','76.488.072-2',NULL,NULL,NULL,NULL),(87,'SERVICIOS INTEGRALES DE MAQUINARIA Y EQUIPOS SPA','76.687.528-9',NULL,NULL,NULL,NULL),(88,'SERVICIOS INDUSTRIALES GENERALES LIMITADA','76.483.030-K',NULL,NULL,NULL,NULL),(89,'SERVICIOS GENERALES Y ARRIENDOS DEL NORTE LIMITADA','77.080.941-K',NULL,NULL,NULL,NULL),(90,'SERVICIOS GENERALES VERONICA CORTEZ CORNEJO E.I.R.L.','76.303.062-8',NULL,NULL,NULL,NULL),(91,'SERVICIOS GENERALES EN MANTENCION WALTER FRANCO ROJAS CAMPILLAY','76.001.266-1',NULL,NULL,'SUIZA 4337 LA PAMPA','ALTO HOSPICIO'),(92,'SERVICIOS DE MANTENIMIENTO INTEGRAL SPA','77.585.989-K',NULL,NULL,'PJE RIO LIMARI 3044 ','ALTO HOSPICIO'),(93,'SERVICIOS FULL TORQUE Y CIA LIMITADA','76.466.848-0',NULL,NULL,NULL,NULL),(94,'SERVICIOS A LA MINERIA CESAR EDUARDO MENDOZA ESMERALDAS','77.507.054-4',NULL,NULL,NULL,NULL),(95,'SERVICIOS A LA EMPRESA RIAGUI LIMITADA','77.254.450-2',NULL,NULL,NULL,NULL),(96,'SERVICIO TÉCNICO EQUITEC LIMITADA','76.905.526-6',NULL,NULL,NULL,NULL),(97,'SERVICIO INTEGRAL AUTOMOTOR RODRIGO VERGARA ALLENDES E.I.R.L.','76.982.323-9',NULL,NULL,NULL,NULL),(98,'SERVICIO DE MECANIZADO Y ESTRUCTURAS METALICAS LIMITADA','77.192.302-6',NULL,NULL,NULL,NULL),(99,'SAN RAFAEL INGENIERIA Y SERVICIOS LIMITADA','76.186.894-2',NULL,NULL,NULL,NULL),(100,'SALINAS Y FABRES SOCIEDAD ANONIMA','91.502.000-3',NULL,NULL,NULL,NULL),(101,'ROJAS PINTO LIMITADA','76.191.975-K',NULL,NULL,NULL,NULL),(102,'RIO ELQUI SPA','79.966.350-3',NULL,NULL,NULL,NULL),(103,'REDDE INDUSTRIAL SPA','77.189.036-9',NULL,NULL,NULL,NULL),(104,'RECAUCHAJES BAILAC THOR LIMITADA','89.012.900-5',NULL,NULL,NULL,NULL),(105,'R Y R METAL SPA','77.046.952-K',NULL,NULL,NULL,NULL),(106,'QUINCHERO, VON TSCHIRNHAUS Y COMPAÑIA LIMITADA','76.140.804-6',NULL,NULL,NULL,NULL),(107,'PRONORTH GROUP SPA','77.897.092-9',NULL,NULL,'AV CERRO MORRILLADAS 3940','ALTO HOSPICIO'),(108,'PROJECT & LOGISTICS CHILE SOCIEDAD ANONIMA','76.756.670-0',NULL,NULL,NULL,NULL),(109,'PRO VAPOR 360 LIMITADA','77.003.933-9','+56964953401',NULL,'VIDELA 1200','IQUIQUE'),(110,'PREFABRICADOS ANDINOS S.A.','96.811.070-5',NULL,NULL,NULL,NULL),(111,'PATRICIO ALEJANDRO VASQUEZ GONZALEZ','13.275.704-6',NULL,NULL,NULL,NULL),(112,'PASCUAL JESÚS VERGARA CASTRO REPARACION, MANTENCION Y FABRICACION ','76.313.638-8',NULL,NULL,NULL,NULL),(113,'NORACID S.A.','76.858.530-K',NULL,NULL,'AV TERCERA INDUSTRIAL 850','ANTOFAGASTA'),(114,'NOEL MORA DEVIA','9.354.352-1',NULL,NULL,'THOMSON 116','IQUIQUE'),(115,'NEUMASERVICIO IQUIQUE LIMITADA','78.595.710-5',NULL,NULL,NULL,NULL),(116,'MORYA SERVICES LIMITADA','76.919.055-4',NULL,NULL,NULL,NULL),(117,'MINETEC S.A.','76.009.926-0',NULL,NULL,NULL,NULL),(118,'METSO CHILE SPA','93.077.000-0',NULL,NULL,'CAM INTERNACIONAL 5725','VALPARAISO'),(119,'METALURGICA TARAPACA LIMITADA','76.680.382-2',NULL,NULL,NULL,NULL),(120,'METALMECANICA ARAYA LIMITADA','76.797.166-4',NULL,NULL,NULL,NULL),(121,'METALCUTT SPA','77.934.191-7',NULL,NULL,'HUANTAJAYA KM 1.3 LT 6 ','ALTO HOSPICIO'),(122,'METAL INDUSTRIAL COMPANY LTDA','77.644.318-2',NULL,NULL,'RIQUELME 296','IQUIQUE'),(123,'MECANICA Y ESTRUCTURAS METALICAS BERNARDO ANDRES SANCHEZ URRA SPA','76.764.197-4',NULL,NULL,NULL,NULL),(124,'MECANICA MP SERVICE SPA','77.514.151-4',NULL,NULL,'18 DE SEPTIEMBRE 1909 LTA','IQUIQUE'),(125,'MECANICA E HIDRAULICA DE PRECISION LIMITADA','77.819.710-3','+56956577479',NULL,'CALICHE 2313 EL BORO','ALTO HOSPICIO'),(126,'MECANICA CRUZATT SPA','76.358.254-K',NULL,NULL,'PJE EL BORO 3991','ALTO HOSPICIO'),(127,'MAX7 SPA','77.060.631-4',NULL,NULL,NULL,NULL),(128,'MAURICIO ROJAS Y CIA LTDA','76.199.620-7',NULL,NULL,NULL,NULL),(129,'MAURICIO HOCHSCHILD INGENIERIA Y SERVICIOS S.A.','96.885.630-8',NULL,NULL,NULL,NULL),(130,'MASTER SERVICE SPA','77.063.448-2',NULL,NULL,NULL,NULL),(131,'MAQUINARIAS, EQUIPOS Y TECNOLOGIAS LIMITADA','76.162.259-5',NULL,NULL,'PTOR. GUSTAVO CABELLO OLG 874 PARQUE INDUSTRIAL','RANCAGUA'),(132,'MAQUINARIAS RC SPA','77.976.552-0',NULL,NULL,NULL,NULL),(133,'MANTENCIONES Y SERVICIOS EXINTECH LIMITADA','77.025.292-K',NULL,NULL,'TENIENTE HERNAN MERINO CORREA 4028','ALTO HOSPICIO'),(134,'MAESTRANZA Y FABRICA DE RESORTES REMAC LIMITADA','77.021.343-6',NULL,NULL,'STA ROSA DE MOLLE 4230','ALTO HOSPICIO'),(135,'MAESTRANZA Y CONTRUCCIONES NORTE LIMITADA','77.365.010-1',NULL,NULL,NULL,NULL),(136,'MAESTRANZA MAKIMET LTDA','78.774.260-2',NULL,NULL,NULL,NULL),(137,'LUBRICANTES DEL SALITRE LIMITADA','76.130.178-0',NULL,NULL,NULL,NULL),(138,'LOGISTICA HUALPEN LIMITADA','76.750.560-4',NULL,NULL,NULL,NULL),(139,'LIEBHERR CHILE SPA','77.461.750-7',NULL,NULL,NULL,NULL),(140,'LAS MOLLACAS LIMITADA','76.315.905-1',NULL,NULL,'RAMIREZ 1163','IQUIQUE'),(141,'KOMATSU CHILE S.A.','96.843.130-7',NULL,NULL,'A VESPUCIO 0631','SANTIAGO'),(142,'KAUFMANN SA VEHICULOS MOTORIZADOS','92.475.000-6',NULL,NULL,NULL,NULL),(143,'JUAN CLAUDIO REYES MIRANDA Y COMPAÑIA LIMITADA','76.378.126-7',NULL,NULL,NULL,NULL),(144,'JORGE MANUEL GALARCE PIMIENTA','9.535.710-5',NULL,NULL,NULL,NULL),(145,'JORGE CHARPENTIER HERRERA ','9.344.023-4',NULL,NULL,'AV PLAYA BRAVA 2156','IQUIQUE'),(146,'IQT CHILE INSPECCION Y ENSAYOS LIMITADA','76.770.083-0',NULL,NULL,NULL,NULL),(147,'INNOMOTICS S.A.','77.575.984-4',NULL,NULL,NULL,NULL),(148,'INGSAL MAQUINARIAS SPA','77.842.038-4',NULL,NULL,NULL,NULL),(149,'INGENIERIA Y SERVICIOS JAVIER FRANCISCO ZURITA ARAYA','76.271.876-6',NULL,NULL,NULL,NULL),(150,'INGENIERIA Y SERVICIOS EISESA LIMITADA','76.753.030-7',NULL,NULL,NULL,NULL),(151,'INGENIERIA Y MONTAJE HINTEK SPA','76.178.615-6',NULL,NULL,'ALMIRANTE LATORRE 537','IQUIQUE'),(152,'INGENIERIA Y FABRICACION METALTEK SPA','77.684.601-5',NULL,NULL,NULL,NULL),(153,'INGENIERIA SALINAS SPA','76.460.368-0',NULL,NULL,NULL,NULL),(154,'INGENIERIA ELECTRICIDAD Y CONSTRUCCION LIMITADA','76.356.808-3',NULL,NULL,'AV CERRO DRAGON 33466','IQUIQU'),(155,'INGEN MOTORS COMPANY SPA','77.224.241-7',NULL,NULL,'TERESA WILMS MONTT 2260 BALTIC 1503','IQUIQUE'),(156,'INGEMECS INGENIERIA Y SERVICIOS LIMITADA','76.432.211-8',NULL,NULL,NULL,NULL),(157,'IMPORTADORA Y EXPORTADORA SAKAI MAQUINARIAS LIMITADA','78.846.500-9',NULL,NULL,NULL,NULL),(158,'IGNACIO JAVIER BARAHONA BENEDEK','16.706.594-5',NULL,NULL,NULL,NULL),(159,'HIDRAULICA Y SELLOS LIMITADA','77.555.716-8','+56998726770',NULL,'AV LOS AROMOS MANZANA F SITIO 30','ALTO HOSPICIO'),(160,'HERRAMIENTAS Y MAQUINARIAS LIMITADA','76.189.034-4',NULL,NULL,NULL,NULL),(161,'HERNAN ULISES GARY VILLALOBOS','13.866.254-3',NULL,NULL,NULL,NULL),(162,'EQUANS MANTENIMIENTO Y MONTAJE','96.543.670-7',NULL,NULL,'LAS HORTENCIAS 501','SANTIAGO'),(163,'ELECCON MAQUINARIAS SPA','99.576.460-1',NULL,NULL,'AV PROYECTADA 4700','ALTO HOSPICIO'),(164,'DPL GROUT CONSTRUCCIONES SPA','77.120.088-5',NULL,NULL,'AV LOS PAJARITOS 3195 OF 1208','SANTIAGO'),(165,'HELIGAS SPA','76.101.273-8',NULL,NULL,NULL,NULL),(166,'GLOBALTEC SERVICIOS Y CONSTRUCCION LIMITADA','76.051.155-2',NULL,NULL,NULL,NULL),(167,'G Y G THOMAS SAFETY S.A.','77.646.200-4',NULL,NULL,NULL,NULL),(168,'FLUITEK MARCO SPA','77.860.930-4',NULL,NULL,NULL,NULL),(169,'FINNING CHILE S.A.','91.489.000-4',NULL,NULL,NULL,NULL),(170,'FERMAT CHILE SPA','76.919.295-6',NULL,NULL,NULL,NULL),(171,'EMPRESA RALFER SPA','76.666.261-7',NULL,NULL,NULL,NULL),(172,'EMPRESA NEPTUNO INDUSTRIAL COMERCIAL LTDA','95.440.000-K',NULL,NULL,NULL,NULL),(173,'EMPRESA DE TRANSPORTE Y SERVICIOS LOGISTICA TICUNA LIMITADA','78.057.115-2',NULL,NULL,NULL,NULL),(174,'EMIN INGENIERIA Y CONSTRUCCION S.A.','79.527.230-5',NULL,NULL,NULL,NULL),(175,'ELOISA SPA','76.095.094-7',NULL,NULL,NULL,NULL),(176,'ELIO JASMANI FLORES GOMEZ','16.593.788-0',NULL,NULL,NULL,NULL),(177,'ELECTRIC MOTOR SERVICES SPA','77.163.532-6',NULL,NULL,NULL,NULL),(178,'DISTRIBUCION Y SERVICIOS INDUSTRIALES LIMITADA','76.032.230-K',NULL,NULL,NULL,NULL),(179,'DI BACCO CHILE S.A.','76.162.269-2',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dados`
--

DROP TABLE IF EXISTS `dados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int NOT NULL,
  `Equipo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Medida` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Cuadrante` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Cantidad_disponible` int DEFAULT NULL,
  `Cantidad_arriendo` int NOT NULL,
  `Precio` decimal(15,2) NOT NULL,
  `Garantia` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fllave_id_equipo_idx` (`Id_Equipo`),
  CONSTRAINT `fllave_id_equipo` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipos` (`ID_Equipos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dados`
--

LOCK TABLES `dados` WRITE;
/*!40000 ALTER TABLE `dados` DISABLE KEYS */;
INSERT INTO `dados` VALUES (1,4,'Dado de impacto','1\"','3/4\"',6,0,20000.00,550000.00);
/*!40000 ALTER TABLE `dados` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dados_BEFORE_INSERT` BEFORE INSERT ON `dados` FOR EACH ROW BEGIN
	SET SQL_SAFE_UPDATES = 0;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dados_AFTER_INSERT` AFTER INSERT ON `dados` FOR EACH ROW BEGIN
	update equipos
    set Cantidad_total = (
		select count(*) from dados where Equipo = NEW.Equipo
        )
        Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dados_AFTER_UPDATE` AFTER UPDATE ON `dados` FOR EACH ROW BEGIN
	UPDATE equipos
	SET cantidad_total = (
		SELECT COUNT(*) FROM dados WHERE Equipo = NEW.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;

  -- Actualiza también el antiguo nombre si cambió
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM dados WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dados_AFTER_DELETE` AFTER DELETE ON `dados` FOR EACH ROW BEGIN
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM dados WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = old.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `equipos`
--

DROP TABLE IF EXISTS `equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipos` (
  `ID_Equipos` int NOT NULL AUTO_INCREMENT,
  `Nombre_equipos` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Cantidad_total` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_Equipos`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos`
--

LOCK TABLES `equipos` WRITE;
/*!40000 ALTER TABLE `equipos` DISABLE KEYS */;
INSERT INTO `equipos` VALUES (1,'Bomba','Bombas electrohidraulicas y manuales',4,NULL),(2,'Cilindro','Cilindros hidraulicos distintas toneladas',1,NULL),(3,'Cabezal','Cabezales hexagonales y con cuadrante',16,NULL),(4,'Dado','Dados de distintas medidas',1,NULL),(5,'Pistola','Pistolas de impacto y de torque controlado',1,NULL),(6,'Llave torque','Llaves de torque manual',0,NULL),(7,'Mangueras','Mangueras hidraulicas y neumaticas',1,NULL);
/*!40000 ALTER TABLE `equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `llaves_torques`
--

DROP TABLE IF EXISTS `llaves_torques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `llaves_torques` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int DEFAULT NULL,
  `Equipo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Marca` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Modelo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Serie` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Codigo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Cuadrante` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Torque` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Precio` decimal(15,2) DEFAULT NULL,
  `Garantia` decimal(15,2) DEFAULT NULL,
  `Estado` enum('En stock','En arriendo','En reparacion','Fuera de servicio') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fktorque_Id_Equipo` (`Id_Equipo`) USING BTREE,
  CONSTRAINT `llaves_torques_ibfk_1` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipos` (`ID_Equipos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `llaves_torques`
--

LOCK TABLES `llaves_torques` WRITE;
/*!40000 ALTER TABLE `llaves_torques` DISABLE KEYS */;
/*!40000 ALTER TABLE `llaves_torques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mangueras`
--

DROP TABLE IF EXISTS `mangueras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mangueras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int DEFAULT NULL,
  `Equipo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Observacion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Cantidad_disponible` int NOT NULL,
  `Cantidad_arriendo` int NOT NULL,
  `Precio` decimal(15,2) NOT NULL,
  `Garantia` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkmanguera_Id_Equipo` (`Id_Equipo`) USING BTREE,
  CONSTRAINT `mangueras_ibfk_1` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipos` (`ID_Equipos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mangueras`
--

LOCK TABLES `mangueras` WRITE;
/*!40000 ALTER TABLE `mangueras` DISABLE KEYS */;
INSERT INTO `mangueras` VALUES (1,7,'MANGUERA HIDRAULICA','MANGUERA HIDRAULICA PARA CABEZAL',3,0,20000.00,65000.00);
/*!40000 ALTER TABLE `mangueras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_10_25_014823_add_deleted_at_to_equipos_table',2),(5,'2025_11_13_131332_add_ruta_contrato_pdf_to_arriendos_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pistolas`
--

DROP TABLE IF EXISTS `pistolas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pistolas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_equipo` int NOT NULL,
  `Equipo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Marca` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Modelo` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Serie` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Codigo` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Observacion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Garantia` decimal(10,2) NOT NULL,
  `Estado` enum('En stock','En arriendo','En reparacion','Fuera de servicio') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En stock',
  PRIMARY KEY (`id`),
  KEY `foranea_id_equipo_idx` (`Id_equipo`),
  CONSTRAINT `foranea_id_equipo` FOREIGN KEY (`Id_equipo`) REFERENCES `equipos` (`ID_Equipos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pistolas`
--

LOCK TABLES `pistolas` WRITE;
/*!40000 ALTER TABLE `pistolas` DISABLE KEYS */;
INSERT INTO `pistolas` VALUES (3,5,'Pistola de Torque controlado','Pistola inalambrica 150-1200 lbs.ft','HS','KSBEW-16S',NULL,'HSTC-01','En maleta de traslado, con brazo reactor, cargador y bateria',2222.00,22222220.00,'En stock');
/*!40000 ALTER TABLE `pistolas` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `pistolas_BEFORE_INSERT` BEFORE INSERT ON `pistolas` FOR EACH ROW BEGIN
	SET SQL_SAFE_UPDATES = 0;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `pistolas_AFTER_INSERT` AFTER INSERT ON `pistolas` FOR EACH ROW BEGIN
	update equipos
    set Cantidad_total = (
		select count(*) from pistolas where Equipo = NEW.Equipo
        )
        Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `pistolas_AFTER_UPDATE` AFTER UPDATE ON `pistolas` FOR EACH ROW BEGIN
	UPDATE equipos
	SET cantidad_total = (
		SELECT COUNT(*) FROM pistolas WHERE Equipo = NEW.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;

  -- Actualiza también el antiguo nombre si cambió
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM pistolas WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = NEW.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `pistolas_AFTER_DELETE` AFTER DELETE ON `pistolas` FOR EACH ROW BEGIN
	UPDATE equipos
	SET Cantidad_total = (
		SELECT COUNT(*) FROM pistolas WHERE Equipo = OLD.Equipo
	)
	Where ID_Equipos = old.Id_Equipo;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('liz2YYcnCPWLEi0gaXqqXW1of5WOc6vzOi0LDU0M',1,'192.168.1.81','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiSVhmc09lblV4ZXRDWnN0TU9JN281eG5pVjczVG40cnBQN05KR2szbSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vaHlkcmF1bGljc2VydmljZS5sb2NhbC9hZG1pbiI7czo1OiJyb3V0ZSI7czozMDoiZmlsYW1lbnQuYWRtaW4ucGFnZXMuZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJEZIRnl1b0lTZXRUOTkzellua1BLRGVsUk5GVnFpVjhDWUQ5MlNBcUp5cS5qVjQzWGFXVzhHIjtzOjY6InRhYmxlcyI7YTo1OntzOjQwOiI4MTE5YTI0OTk4ZTUwYjc4MzFjYjA0YzhiYmNmZWVmYl9jb2x1bW5zIjthOjU6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo4OiJDb250cmF0byI7czo1OiJsYWJlbCI7czoxMjoiTsKwIENvbnRyYXRvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNToiY2xpZW50ZS5FbXByZXNhIjtzOjU6ImxhYmVsIjtzOjc6IkNsaWVudGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEyOiJGZWNoYV9pbmljaW8iO3M6NToibGFiZWwiO3M6NjoiSW5pY2lvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo5OiJGZWNoYV9maW4iO3M6NToibGFiZWwiO3M6ODoiVMOpcm1pbm8iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEyOiJQcmVjaW9fdG90YWwiO3M6NToibGFiZWwiO3M6MTE6Ik1vbnRvIFRvdGFsIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiI5NGQxNmExYjMzYmJlYmQxMDQ2ZTU3OGUzYjY1NTQ2Zl9jb2x1bW5zIjthOjc6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNToiY2xpZW50ZS5FbXByZXNhIjtzOjU6ImxhYmVsIjtzOjc6IkNsaWVudGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjg6IkNvbnRyYXRvIjtzOjU6ImxhYmVsIjtzOjg6IkNvbnRyYXRvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMjoiRmVjaGFfaW5pY2lvIjtzOjU6ImxhYmVsIjtzOjEyOiJGZWNoYSBpbmljaW8iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjk6IkZlY2hhX2ZpbiI7czo1OiJsYWJlbCI7czo5OiJGZWNoYSBmaW4iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEzOiJHdWlhX0Rlc3BhY2hvIjtzOjU6ImxhYmVsIjtzOjE0OiJHdWlhICBkZXNwYWNobyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTI6IlByZWNpb190b3RhbCI7czo1OiJsYWJlbCI7czoxMjoiUHJlY2lvIHRvdGFsIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJFc3RhZG8iO3M6NToibGFiZWwiO3M6NjoiRXN0YWRvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiJhMWIwMzY1MDlkODQxYWRlYjU1ZjMzNjYzZTk1MTA1Y19jb2x1bW5zIjthOjY6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo3OiJFbXByZXNhIjtzOjU6ImxhYmVsIjtzOjc6IkVtcHJlc2EiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjM6IlJ1dCI7czo1OiJsYWJlbCI7czozOiJSdXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjg6IlRlbGVmb25vIjtzOjU6ImxhYmVsIjtzOjg6IlRlbGVmb25vIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJDb3JyZW8iO3M6NToibGFiZWwiO3M6NjoiQ29ycmVvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo5OiJEaXJlY2Npb24iO3M6NToibGFiZWwiO3M6OToiRGlyZWNjaW9uIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJDaXVkYWQiO3M6NToibGFiZWwiO3M6NjoiQ2l1ZGFkIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiJlMWU0ODcyZjk2MmU5MWM4MWQzYjEzYWY0NWQ5ZTk1NV9jb2x1bW5zIjthOjI6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNDoiTm9tYnJlX2VxdWlwb3MiO3M6NToibGFiZWwiO3M6NDoiVGlwbyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTE6IkRlc2NyaXBjaW9uIjtzOjU6ImxhYmVsIjtzOjExOiJEZXNjcmlwY2lvbiI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319czo0MDoiZTY0NDgzM2Y0ZTRlMDg3MTIzMTVkYTcxYjMzZmFjZDJfY29sdW1ucyI7YTo1OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoibmFtZSI7czo1OiJsYWJlbCI7czo0OiJOYW1lIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJlbWFpbCI7czo1OiJsYWJlbCI7czoxMzoiRW1haWwgYWRkcmVzcyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtzOjU6ImxhYmVsIjtzOjE3OiJFbWFpbCB2ZXJpZmllZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IkNyZWF0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IlVwZGF0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO319fX0=',1764270345);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Chito','francisco.jara.valdes95@gmail.com',NULL,'$2y$12$FHFyuoISetT993zYnkPKDelRNFVqiV8CYD92SAqJyq.jV43XaWW8G','yn9tdJmqnPirFEhdWLsusA9ca4mtKe8c8TWObySm2dl4nDbnWTYnc1hPNhKU','2025-10-25 04:27:51','2025-10-25 04:27:51'),(2,'Sonia','administracion@hydraulicservice.cl',NULL,'$2y$12$y..cI3mcmDKllwG4Tk3JY.tZARkPicUHixJK.JYsQ5z.xUn8mOE5y','qTDovmvcNpURQWOVVaVU8tCWUSMP1G3meMwE3QWJo5kagS1GDqPbTx85lPsN','2025-11-14 12:09:25','2025-11-14 12:09:25'),(3,'Marcia','Marcia.fuentes@hydraulicservice.cl',NULL,'$2y$12$9L5wxZ2RxHm.QJWPoJA0CuOtfUiEoopzUNbgVp7M5HLRb1NF9KON2',NULL,'2025-11-14 17:59:30','2025-11-14 17:59:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-28  8:53:58
