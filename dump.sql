/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.5.29-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: proyutu
-- ------------------------------------------------------
-- Server version	10.5.29-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Admin` (
  `rutAdmin` varchar(8) NOT NULL,
  PRIMARY KEY (`rutAdmin`),
  CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`rutAdmin`) REFERENCES `Personas` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admin`
--

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;
INSERT INTO `Admin` VALUES ('10000000'),('22222222'),('88888888');
/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categorias`
--

DROP TABLE IF EXISTS `Categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categorias` (
  `IdCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`IdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorias`
--

LOCK TABLES `Categorias` WRITE;
/*!40000 ALTER TABLE `Categorias` DISABLE KEYS */;
INSERT INTO `Categorias` VALUES (1,'Terapias alternativas',''),(2,'Programacion',''),(3,'Diseno grafico',''),(4,'Contadores',''),(5,'Soporte remoto',''),(6,'Electricidad',''),(7,'Jardineria',''),(8,'Plomeria',''),(9,'Carpinteria',''),(10,'Pintura',''),(11,'Herrería',''),(12,'Impermeabilizacion',''),(13,'Celulares',''),(14,'Reparacion de PC',''),(15,'Redes',''),(16,'Masajes',''),(17,'Estetica',''),(18,'Apoyo escolar',''),(19,'Idiomas',''),(20,'Fletes',''),(21,'Motoenvios',''),(22,'Barberia',''),(23,'Peluqueria',''),(24,'Veterinario',''),(25,'Redes sociales','');
/*!40000 ALTER TABLE `Categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contraseñas`
--

DROP TABLE IF EXISTS `Contraseñas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Contraseñas` (
  `hash_contraseña` varchar(191) NOT NULL,
  `rutPersona` varchar(8) NOT NULL,
  `fecha_contraseña` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`hash_contraseña`),
  KEY `rutPersona` (`rutPersona`),
  CONSTRAINT `Contraseñas_ibfk_1` FOREIGN KEY (`rutPersona`) REFERENCES `Personas` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contraseñas`
--

LOCK TABLES `Contraseñas` WRITE;
/*!40000 ALTER TABLE `Contraseñas` DISABLE KEYS */;
INSERT INTO `Contraseñas` VALUES ('$2y$10$.xWyMf90vhjCAymlbmpx1OSWX9mhKuaPtP7GhmHxf8gEj.Rh4vjJm','55777899','2025-11-02 00:41:03','activo'),('$2y$10$/6iU1P3Gnh/KiRdpxu27cOP.pWCS4dwbcWOWjNGxbinOP.LSMeDVm','33333333','2025-10-28 12:47:53','activo'),('$2y$10$2Wqh17KZ0o/v6raF6pFoYedY10GBrcAmjVpxW9K15DuxDGkyHjJle','12345727','2025-11-01 19:59:19','activo'),('$2y$10$4HXn0wWhPttTdch.197L2ucDzmueXahkP4lAeXKBJ57vzkTRU94nW','57282920','2025-11-01 21:39:49','activo'),('$2y$10$AjVifjvv3Iq3p2L4QKqp0e209bMpl8oypznarAN8SsMDrMlW6zzuC','56636281','2025-11-01 21:25:55','activo'),('$2y$10$CUwabb9iRJn1HXXZiX9Bie05z3TEqLR3oY33EqTr88091u3rLTPYO','83938494','2025-11-01 22:05:49','activo'),('$2y$10$DCo/i0rRobTbez.bBXlK6unjYPdwQ9wws5ch0Mh3MzyqkSw8AtS6i','72919293','2025-11-01 22:01:22','activo'),('$2y$10$e7Lin9nF0dus3elBAoGLhO/chrqNJuMrNc5Rm4b0XoWkxlbJoNQii','57377648','2025-10-31 14:54:30','activo'),('$2y$10$f9LaTy2Vn75IXWAVRs7J1eRD4DhaqGUFo07X7v8/GM3VS3T5VbqeS','18383829','2025-11-01 20:44:03','activo'),('$2y$10$faTUnEbKCG8hJcw3QE/xqeiWBGYDrpOHEkaotPf0pJswYgWMoxcKy','11111111','2025-10-06 15:17:28','activo'),('$2y$10$gHH4K5m/J21J9GVh.SYuU.rQN1/w27bmFeYBcaaParPSUuX5UF5Ne','22222222','2025-10-28 12:37:01','activo'),('$2y$10$HnHUrgeISC5R.i4gJHDvN.H8Z54dXvL5A4qdjX.1sfFKzKzJe1206','83919292','2025-11-01 20:07:04','activo'),('$2y$10$j/Ebg8oaiWAj8ddrPiTPWOfASr0tfIDYS7UL0uuv8Q7ujR/aTOFB2','12334567','2025-11-01 19:55:23','activo'),('$2y$10$jY.kK7CkwL49Jyg6TOZwHebHnYDMGazIQsTSFBrb.zQU5uZIrBI7C','57172838','2025-11-01 21:33:37','activo'),('$2y$10$jzEXJHw.vAQvS2E5wyksjueZsCtEWoPhGtRy6AW99y7r8i4B4Arlm','45644847','2025-10-31 15:45:43','activo'),('$2y$10$KL/K2nodvUiOKl4LoDBEBuWyIVdxt8JROKcdiCxvsdLxHmMu/Og9y','33893949','2025-11-01 21:53:48','activo'),('$2y$10$lbrZbQPasa7ooccIyKccO.b.ncOKvdfxi3kl9F57FEpa6toEFX7yC','28281919','2025-11-01 20:57:38','activo'),('$2y$10$lh9XJ4.ExIykuokPCDrSweEJm20ZX.FfsdJ2MuLp43xtANIZQtbS2','91838392','2025-11-01 20:51:15','activo'),('$2y$10$Od7kAfD1G7SX8h9sRN/bJuelpoHI8H85ZB.RKG3k/oR9pOnayZ/8.','88888888','2025-10-31 14:51:24','activo'),('$2y$10$pVf2JW0HS2sJCRCaGv1wxugArgsXRVitvGI69MMfsW5I6Zdy.lrvu','61727382','2025-11-01 21:21:11','activo'),('$2y$10$qd9yyJtygr.3rNkAcqoerO.4QjFCtrxA/Cm3cHczMhrFmi50z1AUW','93939393','2025-11-01 21:04:52','activo'),('$2y$10$ST6Q0Jxcf9LyGr6aLNvYqe0awGActJyOsSXJ1aMBibX7SL/cLSf4G','63637373','2025-10-31 14:28:33','activo'),('$2y$10$tbAppin4eOnFa67L.A9QLeqGSbbwNlQxjWwL9KjrEpDfI8MpZ4PZG','91383849','2025-11-01 20:18:21','activo'),('$2y$10$Vejh/9V9hGmh6PWpMLkMNOD85CqZg.Y4DyRUV6X39ujhtNgI7GFyu','57394005','2025-10-06 15:46:21','activo'),('$2y$10$W5Isv4OyIK8jA1EBNbSIEOwNulOgM.jSzRpqr1kYtu1e9jU.rMXby','10000000','2025-10-06 15:11:22','activo'),('$2y$10$WDY/9lHwELG1F3RuwVbXQOzZXYooUuC3kuEK8m//8xLRQ3PuQOJ5W','12345678','2025-11-01 19:42:39','activo'),('$2y$10$WQt28wAnNDM8/yINQMorGerIrGrfdidle7ku/bIH24jjGK0y3yj7K','84959505','2025-11-01 22:08:48','activo'),('$2y$10$xa8sSQjpNLuveGcYUGsmLOu5L5YUKkUJypW99CmGpeO.V87GyjVLO','72874838','2025-11-01 20:22:54','activo'),('$2y$10$xjcAROPOeXLtmCgdSyD9Z.yj17sPYA4B/JRxZEr5uPji3bVBRsrJa','10283939','2025-11-01 20:02:14','activo'),('$2y$10$z0Uqxs63VP5sA48uZLot3uFFOg0RYc.bxBlOgnEsgXFavXC7FfDrm','10293039','2025-11-01 21:14:56','activo'),('$2y$10$zb7AJRm1fQcnPMrGb4yVTu7QcyPaC2xzaht0i/rGVESzdfipg/wm6','57283483','2025-10-06 15:25:00','activo');
/*!40000 ALTER TABLE `Contraseñas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Conversaciones`
--

DROP TABLE IF EXISTS `Conversaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Conversaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rutComprador` varchar(8) NOT NULL,
  `rutVendedor` varchar(8) NOT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_rutComprador` (`rutComprador`),
  KEY `idx_rutVendedor` (`rutVendedor`),
  KEY `idServicio` (`idServicio`),
  CONSTRAINT `Conversaciones_ibfk_1` FOREIGN KEY (`rutComprador`) REFERENCES `Usuarios` (`rutUsuario`) ON DELETE CASCADE,
  CONSTRAINT `Conversaciones_ibfk_2` FOREIGN KEY (`rutVendedor`) REFERENCES `Usuarios` (`rutUsuario`) ON DELETE CASCADE,
  CONSTRAINT `Conversaciones_ibfk_3` FOREIGN KEY (`idServicio`) REFERENCES `Servicios` (`IdServicio`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Conversaciones`
--

LOCK TABLES `Conversaciones` WRITE;
/*!40000 ALTER TABLE `Conversaciones` DISABLE KEYS */;
INSERT INTO `Conversaciones` VALUES (1,'57377648','63637373',7,'2025-10-31 14:56:54','2025-10-31 14:56:54'),(2,'57283483','57377648',7,'2025-10-31 14:57:48','2025-10-31 14:57:48'),(3,'22222222','57377648',7,'2025-10-31 14:58:00','2025-10-31 14:58:00'),(4,'45644847','57377648',7,'2025-10-31 15:46:19','2025-10-31 15:46:19'),(5,'45644847','57283483',1,'2025-10-31 15:48:42','2025-10-31 15:48:42'),(6,'12345727','57283483',10,'2025-11-01 21:10:45','2025-11-01 21:10:45'),(7,'28281919','57283483',17,'2025-11-01 21:12:08','2025-11-01 21:12:08');
/*!40000 ALTER TABLE `Conversaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Mensajes`
--

DROP TABLE IF EXISTS `Mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Mensajes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idConversacion` int(11) NOT NULL,
  `rutRemitente` varchar(8) NOT NULL,
  `contenido` text NOT NULL,
  `leido` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_conversacion` (`idConversacion`),
  KEY `idx_remitente` (`rutRemitente`),
  CONSTRAINT `Mensajes_ibfk_1` FOREIGN KEY (`idConversacion`) REFERENCES `Conversaciones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Mensajes_ibfk_2` FOREIGN KEY (`rutRemitente`) REFERENCES `Usuarios` (`rutUsuario`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Mensajes`
--

LOCK TABLES `Mensajes` WRITE;
/*!40000 ALTER TABLE `Mensajes` DISABLE KEYS */;
INSERT INTO `Mensajes` VALUES (1,1,'63637373','hola toteo',0,'2025-10-31 14:57:08'),(2,2,'57283483','skibidy',0,'2025-10-31 14:57:57'),(3,3,'22222222','Toteame',0,'2025-10-31 14:58:05'),(4,2,'57377648','Uffff',0,'2025-10-31 14:58:09'),(5,2,'57377648','Laura',0,'2025-10-31 14:58:12'),(6,3,'57377648','Vaa',0,'2025-10-31 14:58:21'),(7,1,'57377648','Hola santatoeado',0,'2025-10-31 14:58:50'),(8,2,'57283483','god',0,'2025-10-31 14:59:08'),(9,2,'57283483','epw',0,'2025-10-31 14:59:35'),(10,2,'57283483','que chat',0,'2025-10-31 14:59:39'),(11,2,'57377648','Holahola',0,'2025-10-31 14:59:45'),(12,2,'57283483','todos giles menos yo',0,'2025-10-31 14:59:45'),(13,2,'57377648','Holaaaaa',0,'2025-10-31 15:00:08'),(14,2,'57377648','Buenas tardes profe',0,'2025-10-31 15:00:15'),(15,2,'57283483','jola',0,'2025-10-31 15:00:19'),(16,4,'45644847','Hola',0,'2025-10-31 15:46:34'),(17,4,'57377648','Holaa',0,'2025-10-31 15:50:04'),(18,3,'22222222','hola',0,'2025-10-31 16:00:58'),(19,3,'57377648','Callate ariel',0,'2025-10-31 16:05:37'),(20,3,'57377648','Viva Quadstack',0,'2025-10-31 16:07:04'),(21,3,'57377648','Jdjdjd',0,'2025-10-31 16:07:40'),(22,3,'22222222','hola',0,'2025-10-31 16:07:56'),(23,1,'63637373','hola toteo',0,'2025-11-01 18:33:02'),(24,6,'57283483','plomero',0,'2025-11-01 21:10:50');
/*!40000 ALTER TABLE `Mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notificaciones`
--

DROP TABLE IF EXISTS `Notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rutUsuario` varchar(8) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `leida` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_usuario` (`rutUsuario`),
  KEY `idx_leida` (`leida`),
  CONSTRAINT `Notificaciones_ibfk_1` FOREIGN KEY (`rutUsuario`) REFERENCES `Usuarios` (`rutUsuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notificaciones`
--

LOCK TABLES `Notificaciones` WRITE;
/*!40000 ALTER TABLE `Notificaciones` DISABLE KEYS */;
INSERT INTO `Notificaciones` VALUES (1,'57377648','¡Nuevo chat iniciado por santota!','/mensajes/chat/1',0,'2025-10-31 14:56:54'),(2,'57377648','Nuevo mensaje: \"hola toteo...\"','/mensajes/chat/1',1,'2025-10-31 14:57:08'),(3,'57377648','¡Nuevo chat iniciado por Alex!','/mensajes/chat/2',0,'2025-10-31 14:57:48'),(4,'57377648','Nuevo mensaje: \"skibidy...\"','/mensajes/chat/2',1,'2025-10-31 14:57:57'),(5,'57377648','¡Nuevo chat iniciado por ariel!','/mensajes/chat/3',0,'2025-10-31 14:58:00'),(6,'57377648','Nuevo mensaje: \"Toteame...\"','/mensajes/chat/3',1,'2025-10-31 14:58:05'),(7,'57283483','Nuevo mensaje: \"Uffff...\"','/mensajes/chat/2',1,'2025-10-31 14:58:10'),(8,'57283483','Nuevo mensaje: \"Laura...\"','/mensajes/chat/2',1,'2025-10-31 14:58:12'),(9,'22222222','Nuevo mensaje: \"Vaa...\"','/mensajes/chat/3',1,'2025-10-31 14:58:21'),(10,'63637373','Nuevo mensaje: \"Hola santatoeado...\"','/mensajes/chat/1',1,'2025-10-31 14:58:50'),(11,'57377648','Nuevo mensaje: \"god...\"','/mensajes/chat/2',0,'2025-10-31 14:59:08'),(12,'57377648','Nuevo mensaje: \"epw...\"','/mensajes/chat/2',0,'2025-10-31 14:59:35'),(13,'57377648','Nuevo mensaje: \"que chat...\"','/mensajes/chat/2',0,'2025-10-31 14:59:39'),(14,'57283483','Nuevo mensaje: \"Holahola...\"','/mensajes/chat/2',0,'2025-10-31 14:59:45'),(15,'57377648','Nuevo mensaje: \"todos giles menos yo...\"','/mensajes/chat/2',0,'2025-10-31 14:59:45'),(16,'57283483','Nuevo mensaje: \"Holaaaaa...\"','/mensajes/chat/2',0,'2025-10-31 15:00:08'),(17,'57283483','Nuevo mensaje: \"Buenas tardes profe...\"','/mensajes/chat/2',1,'2025-10-31 15:00:15'),(18,'57377648','Nuevo mensaje: \"jola...\"','/mensajes/chat/2',0,'2025-10-31 15:00:19'),(19,'57377648','¡Nuevo chat iniciado por Shey!','/mensajes/chat/4',0,'2025-10-31 15:46:19'),(20,'57377648','Nuevo mensaje: \"Hola...\"','/mensajes/chat/4',1,'2025-10-31 15:46:34'),(21,'57283483','¡Nuevo chat iniciado por Shey!','/mensajes/chat/5',0,'2025-10-31 15:48:42'),(22,'45644847','Nuevo mensaje: \"Holaa...\"','/mensajes/chat/4',0,'2025-10-31 15:50:04'),(23,'57377648','Nuevo mensaje: \"hola...\"','/mensajes/chat/3',1,'2025-10-31 16:00:58'),(24,'22222222','Nuevo mensaje: \"Callate ariel...\"','/mensajes/chat/3',0,'2025-10-31 16:05:37'),(25,'22222222','Nuevo mensaje: \"Viva Quadstack...\"','/mensajes/chat/3',0,'2025-10-31 16:07:04'),(26,'22222222','Nuevo mensaje: \"Jdjdjd...\"','/mensajes/chat/3',1,'2025-10-31 16:07:40'),(27,'57377648','Nuevo mensaje: \"hola...\"','/mensajes/chat/3',0,'2025-10-31 16:07:56'),(28,'57377648','Nuevo mensaje: \"hola toteo...\"','/mensajes/chat/1',0,'2025-11-01 18:33:02'),(29,'12345727','¡Nuevo chat iniciado por Alex!','/mensajes/chat/6',0,'2025-11-01 21:10:45'),(30,'12345727','Nuevo mensaje: \"plomero...\"','/mensajes/chat/6',0,'2025-11-01 21:10:50'),(31,'28281919','¡Nuevo chat iniciado por Alex!','/mensajes/chat/7',0,'2025-11-01 21:12:08');
/*!40000 ALTER TABLE `Notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Personas`
--

DROP TABLE IF EXISTS `Personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Personas` (
  `rut` varchar(8) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `nro` varchar(50) DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Personas`
--

LOCK TABLES `Personas` WRITE;
/*!40000 ALTER TABLE `Personas` DISABLE KEYS */;
INSERT INTO `Personas` VALUES ('10000000','Victor','De oliveira','barreras','vdou@gmail.com','12','Artigas'),('10283939','Jack','Black','las piedras','carpinteria.elaleman@gmail.com','1220','Drum Brum'),('10293039','Cab','Allo','barrio laures','vitalia.estetica@gmail.com','1203','Lurdes'),('11111111','Usuario','Normal','el santo','usuarionormal@gmail.com','511','lima'),('12334567','Luis','Miguel','barrio herten','eltiodelcesped@gmail.com','1235','av artigas'),('12345678','José','Lopez ','san francisco','electricista.laspiedras@gmail.com','1234','Gral Flores'),('12345727','John','Travolta','progreso','multiservice.lp@gmail.com','1390','av lol'),('18383829','Jos','eju','barrio lenzi','fulltech.lpshopping@gmail.com','1222','jose artigas'),('22222222','ariel','anza','san francisco','ariel@gmail.com','105','av uruguay'),('28281919','Will ','Yrex','hipodromo','cablevision.soporte.lp@gmail.com','1501','japon'),('33333333','Victor','De Oliveira','san francisco','victor@gmail.com','1000','peru'),('33893949','Tito','Tota','razetti','barberia.dontito@gmail.com','4210','Itacumbú'),('45644847','Shey','Chavez','canelon chico','sheilagisellechavez@gmail.com','12','lima'),('55777899','Juan','Hernandez','pueblo nuevo','jhernandez@gmail.com','14','Av. Artigas'),('56636281','Santiago','Piñeiro','barrio 19 de abril','englishhouse.lp@gmail.com','1236','Yacuí'),('57172838','Alex','Duahrtt','el santo','fletes.elrapido@gmail.com','1423','Florencio Sanchez'),('57282920','Ariel','Anza','barrio gallo','motoenvios.pedrense@gmail.com','892','Lima'),('57283483','Alex','Duahrtt','el santo','noalex67@gmail.com','26','Lima'),('57377648','Mateo','Camejo ','barreras','mateocamejo2007@gmail.com','55','Itacumbu'),('57394005','santiago','anza','santa isabel','nono@gmail.com','67','lima'),('61727382','Mateo','Camejo','barrio herten','academia.estudia.plus@gmail.com','3012','Gral Flores'),('63637373','santota','perez','barreras','totamail@gmail.com','1234','lol proncipal'),('72874838','Mac','Lovin','barrio obelisco','imperme.galpones@gmail.com','1203','atanasio sierra'),('72919293','Sandra','Mujica','barrio centro','sandra.style.pelu@gmail.com','5010','Canada '),('83919292','Iam','Steve','canelon chico','pintureria.colonial@gmail.com','3738','dr pouey'),('83938494','Milo','Jota','el colorado','veterinaria.elaguila@gmail.com','8392','Capitán mateo tula'),('84959505','Cristiano','Ronaldo','hipodromo','creative.lp.marketing@gmail.com','6182','José Pedro Varela '),('88888888','aaaa','aaaa','barreras','ocho@gmail.com','131','asdsds'),('91383849','Ricardo','Emece','la pilarica','ferreteria.eltala@gmail.com','4115','Batlle y Ordoñez '),('91838392','Samuel ','Deluque','el dorado','fixpoint.laspiedras@gmail.com','1500','san isidro'),('93939393','Gilip','Ollas','barrio campistegui','espacio.zen.masajes@gmail.com','1284','Alemania');
/*!40000 ALTER TABLE `Personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Personas_Telefonos`
--

DROP TABLE IF EXISTS `Personas_Telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Personas_Telefonos` (
  `rutPersona` varchar(8) NOT NULL,
  `numerotelefonico` varchar(20) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rutPersona`,`numerotelefonico`),
  CONSTRAINT `Personas_Telefonos_ibfk_1` FOREIGN KEY (`rutPersona`) REFERENCES `Personas` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Personas_Telefonos`
--

LOCK TABLES `Personas_Telefonos` WRITE;
/*!40000 ALTER TABLE `Personas_Telefonos` DISABLE KEYS */;
INSERT INTO `Personas_Telefonos` VALUES ('10000000','095912854','movil'),('10283939','099464646','movil'),('10293039','098808080','movil'),('11111111','092093322','movil'),('12334567','099313131','movil'),('12345678','099121212','movil'),('12345727','094349499','movil'),('18383829','099646464','movil'),('22222222','091111111','movil'),('28281919','097282828','movil'),('33333333','23532313','fijo'),('33893949','096434343','movil'),('45644847','095091935','movil'),('55777899','095678456','movil'),('56636281','093646464','movil'),('57172838','092467364','movil'),('57282920','094585858','movil'),('57283483','094039113','movil'),('57377648','095912855','movil'),('57394005','094839113','movil'),('61727382','095966363','movil'),('63637373','091979764','movil'),('72874838','099969696','movil'),('72919293','091643764','movil'),('83919292','099696969','movil'),('83938494','098085236','movil'),('84959505','097343164','movil'),('88888888','091132132','movil'),('91383849','096242424','movil'),('91838392','099373737','movil'),('93939393','096364316','movil');
/*!40000 ALTER TABLE `Personas_Telefonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Servicios`
--

DROP TABLE IF EXISTS `Servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Servicios` (
  `IdServicio` int(11) NOT NULL AUTO_INCREMENT,
  `precio_estimado` decimal(10,2) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `duracion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Servicios`
--

LOCK TABLES `Servicios` WRITE;
/*!40000 ALTER TABLE `Servicios` DISABLE KEYS */;
INSERT INTO `Servicios` VALUES (1,67.00,'Servicio del papu',':v','12 dias'),(3,3000.00,'Profesor de informatica','A lo peñarol','5 horas'),(4,1.99,'servicio','una descripción xdddddd','5 horas'),(6,2000.00,'Contador Público','Asesoramiento integral administrativo contable, liquidaciones de impuestos, gestión de recursos humanos','1 hora'),(7,200.00,'Coaching de Videojuegos','Te explico cómo pasarte jueguitos ','2 horas'),(8,1500.00,'Electricista UTE ','Instalaciones y reparaciones eléctricas en hogares.','1 hora '),(9,2500.00,'El Tío del Cesped ','Corte de pasto y mantenimiento de jardines.','2 horas'),(10,1200.00,'Multiservice','Reparaciones de plomería en viviendas.','1 hora'),(11,3500.00,'Carpintería “El Alemán”','Reparación y fabricación de muebles de madera.','3 horas'),(12,1200.00,'Pinturería Colonial ','Pintura de interiores con materiales de calidad.','1 hora'),(13,5000.00,'Ferretería “El Tala”','Reparación de rejas y estructuras metálicas.','3 horas'),(14,800.00,'Impermeabilizaciones Galpón','Aplicación de membranas y selladores.','1 hora'),(15,1500.00,'FullTech','Reparación de celulares: cambio de pantalla y batería.','30 minutos'),(16,3000.00,'Fix Point ','Limpieza interna y reparación de PCs y laptops.','1 hora'),(17,3000.00,'Cablevisión Soporte','Instalación y reparación de redes y WiFi.','3 horas'),(18,1500.00,'Masajes “Espacio Zen”','Masajes descontracturantes con aceites naturales.','1 hora'),(19,2000.00,'Estética “Vitalia”','Limpieza facial y tratamientos corporales.','1 hora'),(20,450.00,'Academia Estudia+','Apoyo escolar primaria y secundaria.','1 hora'),(21,850.00,'English House Institute ','Clases de inglés para todas las edades.','90 minutos '),(22,3500.00,'Fletes “El Rápido”','Transporte de muebles dentro de Las Piedras.','3 horas'),(23,300.00,'Motoenvíos Pedrense','Reparto rápido de paquetes y compras.','20 minutos '),(24,350.00,'Barbería Don Tito','Corte de cabello y barba con máquinas y tijera.','30 minutos '),(25,400.00,'Peluquería Sandra Style','Corte, mechas, planchita y brushing.','30 minutos '),(26,1200.00,'Veterinaria El Águila','Vacunación y consultas para mascotas.','1 hora'),(27,12000.00,'Estudio Creative LP','Gestión de redes sociales y diseño para emprendedores.','Servicio Mensual');
/*!40000 ALTER TABLE `Servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuarios` (
  `rutUsuario` varchar(8) NOT NULL,
  `descripcion_del_perfil` text DEFAULT NULL,
  `especialidad` varchar(200) DEFAULT NULL,
  `experiencia` varchar(200) DEFAULT NULL,
  `disponibilidad` varchar(200) DEFAULT NULL,
  `razon_social` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`rutUsuario`),
  CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`rutUsuario`) REFERENCES `Personas` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES ('10000000','','','','',NULL),('10283939','','','','',NULL),('10293039','','','','',NULL),('11111111','','','','',NULL),('12334567','','','','',NULL),('12345678','','','','',NULL),('12345727','','','','',NULL),('18383829','','','','',NULL),('22222222','','','','',NULL),('28281919','','','','',NULL),('33333333','','','','',NULL),('33893949','','','','',NULL),('45644847','','','','',NULL),('55777899','','','','',NULL),('56636281','','','','',NULL),('57172838','','','','',NULL),('57282920','','','','',NULL),('57283483','','','','',NULL),('57377648','','','','',NULL),('57394005','lo que sea','fontaneria','0','24/7',NULL),('61727382','','','','',NULL),('63637373','','','','',NULL),('72874838','','','','',NULL),('72919293','','','','',NULL),('83919292','','','','',NULL),('83938494','','','','',NULL),('84959505','','','','',NULL),('88888888','','','','',NULL),('91383849','','','','',NULL),('91838392','','','','',NULL),('93939393','','','','',NULL);
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Valoraciones`
--

DROP TABLE IF EXISTS `Valoraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Valoraciones` (
  `IdValoracion` int(11) NOT NULL AUTO_INCREMENT,
  `rutUsuario` varchar(8) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `puntaje` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  PRIMARY KEY (`IdValoracion`),
  KEY `rutUsuario` (`rutUsuario`),
  CONSTRAINT `Valoraciones_ibfk_1` FOREIGN KEY (`rutUsuario`) REFERENCES `Usuarios` (`rutUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Valoraciones`
--

LOCK TABLES `Valoraciones` WRITE;
/*!40000 ALTER TABLE `Valoraciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `Valoraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofrecen`
--

DROP TABLE IF EXISTS `ofrecen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ofrecen` (
  `rutUComprador` varchar(8) DEFAULT NULL,
  `rutUVendedor` varchar(8) NOT NULL,
  `IdServicio` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rutUVendedor`,`IdServicio`,`fecha`),
  KEY `rutUComprador` (`rutUComprador`),
  KEY `IdServicio` (`IdServicio`),
  CONSTRAINT `ofrecen_ibfk_1` FOREIGN KEY (`rutUComprador`) REFERENCES `Usuarios` (`rutUsuario`),
  CONSTRAINT `ofrecen_ibfk_2` FOREIGN KEY (`rutUVendedor`) REFERENCES `Usuarios` (`rutUsuario`),
  CONSTRAINT `ofrecen_ibfk_3` FOREIGN KEY (`IdServicio`) REFERENCES `Servicios` (`IdServicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofrecen`
--

LOCK TABLES `ofrecen` WRITE;
/*!40000 ALTER TABLE `ofrecen` DISABLE KEYS */;
INSERT INTO `ofrecen` VALUES (NULL,'10000000',3,'2025-10-06 15:29:02','Disponible'),(NULL,'10283939',11,'2025-11-01 20:03:33','Disponible'),(NULL,'10293039',19,'2025-11-01 21:15:49','Disponible'),(NULL,'12334567',9,'2025-11-01 19:56:47','Disponible'),(NULL,'12345678',8,'2025-11-01 19:46:49','Disponible'),(NULL,'12345727',10,'2025-11-01 20:00:43','Disponible'),(NULL,'18383829',15,'2025-11-01 20:45:10','Disponible'),(NULL,'28281919',17,'2025-11-01 21:00:08','Disponible'),(NULL,'33333333',6,'2025-10-28 12:59:28','Disponible'),(NULL,'33893949',24,'2025-11-01 21:57:41','Disponible'),(NULL,'56636281',21,'2025-11-01 21:28:43','Disponible'),(NULL,'57172838',22,'2025-11-01 21:36:53','Disponible'),(NULL,'57282920',23,'2025-11-01 21:41:27','Disponible'),(NULL,'57283483',1,'2025-10-06 15:26:09','Disponible'),(NULL,'57377648',7,'2025-10-31 14:56:40','Disponible'),(NULL,'57394005',4,'2025-10-06 15:48:30','Disponible'),(NULL,'61727382',20,'2025-11-01 21:22:32','Disponible'),(NULL,'72874838',14,'2025-11-01 20:24:02','Disponible'),(NULL,'72919293',25,'2025-11-01 22:02:25','Disponible'),(NULL,'83919292',12,'2025-11-01 20:09:21','Disponible'),(NULL,'83938494',26,'2025-11-01 22:06:57','Disponible'),(NULL,'84959505',27,'2025-11-01 22:10:24','Disponible'),(NULL,'91383849',13,'2025-11-01 20:20:19','Disponible'),(NULL,'91838392',16,'2025-11-01 20:52:23','Disponible'),(NULL,'93939393',18,'2025-11-01 21:06:51','Disponible');
/*!40000 ALTER TABLE `ofrecen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertenecen`
--

DROP TABLE IF EXISTS `pertenecen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pertenecen` (
  `IdServicio` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  PRIMARY KEY (`IdServicio`,`IdCategoria`),
  KEY `IdCategoria` (`IdCategoria`),
  CONSTRAINT `pertenecen_ibfk_1` FOREIGN KEY (`IdServicio`) REFERENCES `Servicios` (`IdServicio`),
  CONSTRAINT `pertenecen_ibfk_2` FOREIGN KEY (`IdCategoria`) REFERENCES `Categorias` (`IdCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertenecen`
--

LOCK TABLES `pertenecen` WRITE;
/*!40000 ALTER TABLE `pertenecen` DISABLE KEYS */;
INSERT INTO `pertenecen` VALUES (1,1),(3,2),(4,1),(6,4),(7,5),(8,6),(9,7),(10,8),(11,9),(12,10),(13,11),(14,12),(15,13),(16,14),(17,15),(18,16),(19,17),(20,18),(21,19),(22,20),(23,21),(24,22),(25,23),(26,24),(27,25);
/*!40000 ALTER TABLE `pertenecen` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-03 17:33:43
