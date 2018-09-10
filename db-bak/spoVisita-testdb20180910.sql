-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: sipemo_visita
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.35-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cat_edoCivil`
--

DROP TABLE IF EXISTS `cat_edoCivil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_edoCivil` (
  `rowid_edoCivil` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_edoCivil` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clave_edoCivil` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`rowid_edoCivil`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_edoCivil`
--

LOCK TABLES `cat_edoCivil` WRITE;
/*!40000 ALTER TABLE `cat_edoCivil` DISABLE KEYS */;
INSERT INTO `cat_edoCivil` VALUES (1,'SIN DATO','0'),(2,'SOLTERO','1'),(3,'CASADO','2'),(4,'UNION LIBRE','3'),(5,'DIVORCIADO(A)','4'),(6,'VIUDO(A)','5'),(7,'OTRO','6');
/*!40000 ALTER TABLE `cat_edoCivil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_estados`
--

DROP TABLE IF EXISTS `cat_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_estados` (
  `rowid_estados` int(11) NOT NULL AUTO_INCREMENT,
  `clave` tinyint(2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `abrev` varchar(16) NOT NULL,
  PRIMARY KEY (`rowid_estados`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='Tabla de Estados de la Repï¿½blica Mexicana';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_estados`
--

LOCK TABLES `cat_estados` WRITE;
/*!40000 ALTER TABLE `cat_estados` DISABLE KEYS */;
INSERT INTO `cat_estados` VALUES (1,1,'Aguascalientes','Ags.'),(2,2,'Baja California','BC'),(3,3,'Baja California Sur','BCS'),(4,4,'Campeche','Camp.'),(5,5,'Coahuila','Coah.'),(6,6,'Colima','Col.'),(7,7,'Chiapas','Chis.'),(8,8,'Chihuahua','Chih.'),(9,9,'Distrito Federal','DF'),(10,10,'Durango','Dgo.'),(11,11,'Guanajuato','Gto.'),(12,12,'Guerrero','Gro.'),(13,13,'Hidalgo','Hgo.'),(14,14,'Jalisco','Jal.'),(15,15,'México','Mex.'),(16,16,'Michoacán','Mich.'),(17,17,'Morelos','Mor.'),(18,18,'Nayarit','Nay.'),(19,19,'Nuevo León','NL'),(20,20,'Oaxaca','Oax.'),(21,21,'Puebla','Pue.'),(22,22,'Querétaro','Qro.'),(23,23,'Quintana Roo','Q. Roo'),(24,24,'San Luis Potosí','SLP'),(25,25,'Sinaloa','Sin.'),(26,26,'Sonora','Son.'),(27,27,'Tabasco','Tab.'),(28,28,'Tamaulipas','Tamps.'),(29,29,'Tlaxcala','Tlax.'),(30,30,'Veracruz','Ver.'),(31,31,'Yucatán','Yuc.'),(32,32,'Zacatecas','Zac.'),(33,0,'Sin Dato','');
/*!40000 ALTER TABLE `cat_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_parentesco`
--

DROP TABLE IF EXISTS `cat_parentesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_parentesco` (
  `rowid_parentesco` int(11) NOT NULL AUTO_INCREMENT,
  `clave_parentesco` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion_parentesco` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rowid_parentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_parentesco`
--

LOCK TABLES `cat_parentesco` WRITE;
/*!40000 ALTER TABLE `cat_parentesco` DISABLE KEYS */;
INSERT INTO `cat_parentesco` VALUES (1,'99','SIN DATO'),(2,'1','ESPOSO(A)'),(3,'2','CONYUGUE'),(4,'3','PADRE'),(5,'4','MADRE'),(6,'5','HIJO(A)'),(7,'6','SUEGRO(A)'),(8,'7','YERNO'),(9,'8','NUERA'),(10,'9','TIO(A)'),(11,'10','ABUELO(A)'),(12,'11','OTRO');
/*!40000 ALTER TABLE `cat_parentesco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_ingresoVisita`
--

DROP TABLE IF EXISTS `spo_ingresoVisita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_ingresoVisita` (
  `rowid_ingresoVisita` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  `menoresH` tinyint(4) DEFAULT NULL,
  `menoresM` tinyint(4) DEFAULT NULL,
  `fk_persona` int(4) NOT NULL,
  PRIMARY KEY (`rowid_ingresoVisita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_ingresoVisita`
--

LOCK TABLES `spo_ingresoVisita` WRITE;
/*!40000 ALTER TABLE `spo_ingresoVisita` DISABLE KEYS */;
/*!40000 ALTER TABLE `spo_ingresoVisita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_persona`
--

DROP TABLE IF EXISTS `spo_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_persona` (
  `rowid_persona` int(4) NOT NULL AUTO_INCREMENT,
  `nombre_persona` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aPaterno_persona` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aMaterno_persona` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fNacimiento_persona` date DEFAULT '0001-01-01',
  `edad_persona` tinyint(2) DEFAULT '0',
  `lNacimiento_persona` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'S/D',
  `ocupacion_persona` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'S/D',
  `edoCivil_persona` tinyint(1) DEFAULT '0',
  `nHijos_persona` tinyint(4) DEFAULT NULL,
  `codigo_persona` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_persona` tinyint(1) DEFAULT '1',
  `foto_persona` blob,
  `sexo_persona` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcreacion_persona` date DEFAULT NULL,
  `escolaridad_persona` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'SIN DATO',
  PRIMARY KEY (`rowid_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_persona`
--

LOCK TABLES `spo_persona` WRITE;
/*!40000 ALTER TABLE `spo_persona` DISABLE KEYS */;
INSERT INTO `spo_persona` VALUES (1,'MARIA ELENA','GONZALEZ','CONTRERAS','1994-06-08',24,'MORELIA','AMA DE CASA',2,0,NULL,0,'views/images/personas/MARIA ELENA-958.png','F','2018-09-08','SIN DATO'),(2,'CARLOS','ORTIZ','MELLIN','1955-07-22',63,'APATZINGAN','OBRERO',4,3,NULL,0,'views/images/personas/CARLOS-808.png','M','2018-09-08','SIN DATO'),(3,'ERIK','GARCIA','VALLEJO','1994-06-22',24,'PREPA','EMPLEADO',3,2,NULL,1,'views/images/personas/ERIK-971.png','M','2018-09-09',NULL),(6,'ROGELIO','GONZALEZ','NUÑEZ','1995-07-21',23,'EDO MEXICO','TAXISTA',2,0,NULL,1,'views/images/personas/ROGELIO-111.png','M','2018-09-10','UNIVERSIDAD');
/*!40000 ALTER TABLE `spo_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_personaDetalles`
--

DROP TABLE IF EXISTS `spo_personaDetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_personaDetalles` (
  `rowid_pDetalles` int(4) NOT NULL AUTO_INCREMENT,
  `sSocial_persona` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enfermedades_persona` tinyint(1) DEFAULT '0',
  `eDetalle_persona` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discapacidad_persona` tinyint(1) DEFAULT '0',
  `dDetalle_persona` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_persona` int(4) NOT NULL,
  `observaciones_persona` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`rowid_pDetalles`,`fk_persona`),
  KEY `fk_spo_personaDetalles_spo_personaVisita1_idx` (`fk_persona`),
  CONSTRAINT `fk_spo_personaDetalles_spo_personaVisita1` FOREIGN KEY (`fk_persona`) REFERENCES `spo_persona` (`rowid_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_personaDetalles`
--

LOCK TABLES `spo_personaDetalles` WRITE;
/*!40000 ALTER TABLE `spo_personaDetalles` DISABLE KEYS */;
INSERT INTO `spo_personaDetalles` VALUES (1,'7777',1,'ASMA',1,'BRAZO',1,'LA ESTAN OBSERVANDO OTRA VEZ'),(2,'',0,'',0,'',6,''),(3,NULL,0,NULL,0,NULL,2,NULL),(4,NULL,0,NULL,0,NULL,3,NULL);
/*!40000 ALTER TABLE `spo_personaDetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_personaUbicacion`
--

DROP TABLE IF EXISTS `spo_personaUbicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_personaUbicacion` (
  `rowid_ubicacion` int(4) NOT NULL AUTO_INCREMENT,
  `calle` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colonia` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cPostal` int(5) DEFAULT '0',
  `ciudad` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(2) NOT NULL,
  `telefono` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_persona` int(4) NOT NULL,
  PRIMARY KEY (`rowid_ubicacion`,`fk_persona`),
  KEY `fk_spo_personaUbicacion_spo_personaVisita1_idx` (`fk_persona`),
  CONSTRAINT `fk_spo_personaUbicacion_spo_personaVisita1` FOREIGN KEY (`fk_persona`) REFERENCES `spo_persona` (`rowid_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_personaUbicacion`
--

LOCK TABLES `spo_personaUbicacion` WRITE;
/*!40000 ALTER TABLE `spo_personaUbicacion` DISABLE KEYS */;
INSERT INTO `spo_personaUbicacion` VALUES (2,'LA MISMA','57','LA OTRA',0,'TOLUCA',15,'5555555','6666666',6),(3,'LA OTRA CALLE','99','LA OTRA COLONIA',0,'APATZINGAN',16,'333333','44444',1),(4,NULL,NULL,NULL,0,'',0,NULL,NULL,2),(5,NULL,NULL,NULL,0,'',0,NULL,NULL,3);
/*!40000 ALTER TABLE `spo_personaUbicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_ppl`
--

DROP TABLE IF EXISTS `spo_ppl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_ppl` (
  `rowid_ppl` int(4) NOT NULL AUTO_INCREMENT,
  `nombre_ppl` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aPaterno_ppl` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aMaterno_ppl` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fNacimiento_ppl` date NOT NULL,
  `sexo_ppl` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_ppl` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `edad_ppl` int(2) DEFAULT '0',
  `fcreacion` datetime DEFAULT NULL,
  `foto_ppl` blob,
  `fIngreso_ppl` date DEFAULT '0000-00-00',
  PRIMARY KEY (`rowid_ppl`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_ppl`
--

LOCK TABLES `spo_ppl` WRITE;
/*!40000 ALTER TABLE `spo_ppl` DISABLE KEYS */;
INSERT INTO `spo_ppl` VALUES (1,'ALEJANDRO','SAUCEDO','GOMEZ','0000-00-00','M','0',34,NULL,NULL,'0000-00-00'),(2,'ALEJANDRO','SAUCEDO','GOMEZ','0000-00-00','M','0',35,NULL,NULL,'0000-00-00'),(3,'ALEJA','SAUC','NAJERA','1942-07-16','M','0',76,NULL,'views/images/personas/-382.jpg','2018-09-07'),(4,'ALEJANDRO','SAUCEDO','GOMEZ','0000-00-00','M','0',35,NULL,NULL,'0000-00-00'),(23,'ALEJANDRO','SAUCEDO','GOMEZ','0000-00-00','M','1',12,'2018-09-06 17:29:15',NULL,'0000-00-00'),(24,'ALEJANDRO','SAUCEDO','GOMEZ','0000-00-00','M','1',12,'2018-09-06 17:30:01',NULL,'2018-09-04'),(25,'ALEJANDRO','SAUCEDO','GOMEZ','1980-01-11','M','1',38,'2018-09-07 03:17:30',NULL,'0000-00-00'),(31,'MARIO','CARRILLO','MENDOZA','1960-10-27','M','1',57,'2018-09-07 22:23:07','views/images/ppls/MARIO-264.jpg','2018-09-07'),(32,'RICARDO','MARTINEZ','MARTINEZ','1981-08-13','M','1',37,'2018-09-08 13:28:10','views/images/ppls/RICARDO-611.jpg','2018-09-02');
/*!40000 ALTER TABLE `spo_ppl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_ppl_proceso`
--

DROP TABLE IF EXISTS `spo_ppl_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_ppl_proceso` (
  `rowid_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `fuero` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `situacion` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delito` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_proceso` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_ppl` int(6) DEFAULT NULL,
  PRIMARY KEY (`rowid_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_ppl_proceso`
--

LOCK TABLES `spo_ppl_proceso` WRITE;
/*!40000 ALTER TABLE `spo_ppl_proceso` DISABLE KEYS */;
INSERT INTO `spo_ppl_proceso` VALUES (1,'C','P','ROBO','123/2017',24),(2,'C','P','ROBO','23/18',25),(3,'C','P','HOMICIDIO','246/17',30),(4,'C','P','HOMICIDIO','23345/2017',31),(5,'F','S',NULL,'999/18',32);
/*!40000 ALTER TABLE `spo_ppl_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_requisitosVisita`
--

DROP TABLE IF EXISTS `spo_requisitosVisita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_requisitosVisita` (
  `rowid_requisitos` int(11) NOT NULL AUTO_INCREMENT,
  `cParentesco` tinyint(1) DEFAULT '0',
  `identificacion` tinyint(1) DEFAULT '0',
  `curp` tinyint(1) DEFAULT '0',
  `fotos` tinyint(1) DEFAULT '0',
  `actaNacimiento` tinyint(1) DEFAULT '0',
  `cDomicilio` tinyint(1) DEFAULT '0',
  `eMedico` tinyint(1) DEFAULT '0',
  `fMedico` date DEFAULT NULL,
  `ePapa` tinyint(1) DEFAULT '0',
  `fPapa` date DEFAULT NULL,
  `eVih` tinyint(1) DEFAULT '0',
  `fVih` date DEFAULT NULL,
  `requisitoTemporal` text,
  `fk_visita` int(4) NOT NULL,
  PRIMARY KEY (`rowid_requisitos`),
  KEY `fk_spo_requisitosVisita_spo_visita1_idx` (`fk_visita`),
  CONSTRAINT `fk_spo_requisitosVisita_spo_visita1` FOREIGN KEY (`fk_visita`) REFERENCES `spo_visita` (`rowid_visita`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_requisitosVisita`
--

LOCK TABLES `spo_requisitosVisita` WRITE;
/*!40000 ALTER TABLE `spo_requisitosVisita` DISABLE KEYS */;
/*!40000 ALTER TABLE `spo_requisitosVisita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_users`
--

DROP TABLE IF EXISTS `spo_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_users` (
  `rowid_users` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aPaterno_user` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aMaterno_user` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_user` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoUsuario` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status_user` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `foto_user` blob,
  `fcreacion_user` datetime DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `departamento` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rowid_users`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_users`
--

LOCK TABLES `spo_users` WRITE;
/*!40000 ALTER TABLE `spo_users` DISABLE KEYS */;
INSERT INTO `spo_users` VALUES (1,'admin','$2y$10$TWa564i.fKdPfOVYEj5kauSapi6pHcFoCkoEQEhYpheRHwrSyAXYS','GALLO','CONTRERAS','VICTOR HUGO','admin','1','views/images/users/admin-270.jpg',NULL,NULL,'SOPORTE'),(2,'Ale','$2y$10$P4xYDDM7J/Xsb3PG2TpmWOLl0SDgKWs2TUwnFAVSGzNC2cWb9uBfW','MEDINA','ARREOLA','ALEJANDRA','Admin','0','views/images/users/Ale-404.jpg',NULL,NULL,'DIRECCION'),(3,'jose','$2y$10$Zvf494zNLJOEJSVpQt1DhuprOi5P8QICGf4yg6B9WtH8jl.3yzYB6','CORONEL','GARCIA','CAÑAS','Usuario','0','views/images/users/jose-965.jpg',NULL,NULL,'AREA MEDICA'),(6,'hugo','$2y$10$R93YaZpqXMHjUhPpYXXdNeU4OvqjW2apLzHYKsk51YAy.NuLa5ne.','GALLO','CONTRERAS','HUGO','user','1','views/images/users//hugo-853.jpg','2018-09-02 23:40:15',NULL,'SOPORTE'),(8,'fridis','$2y$10$nDhPnda/lqByPaOTIDLucO7nO8aHucPNAxnKH5SNu76lNfeNOuXoO','GALLO','BARRON','FRIDA','admin','0','views/images/users/fridis-737.jpg','2018-09-03 01:25:52',NULL,'TRABAJO SOCIAL'),(9,'fridris2','$2y$10$sfqPxP89qD3HxXB4OgLnquBY9VIq7Zotn955NESwGhnGRqh7KQlhu','GALLO','BARRON','FRIDA','admin','1','views/images/users//fridris2-344png','2018-09-03 01:27:04',NULL,'TRABAJO SOCIAL'),(10,'emi','$2y$10$NzziYpwegedjEciGazFgEert6aha472bAY.1IfBDRLtiHmPjOx2hu','GALLO','BARRON','EMILIANO','user','1','views/images/users/emi-187.jpg','2018-09-03 18:43:59',NULL,'MEDICA'),(11,'gabo','$2y$10$yVffcZtvsRsiZhskmZSuB.hPraRTtVs.hSim0kA9vOlIOxvLqlRCK','DELGADO','RANGEL','GABRIEL','admin','1','views/images/users/gabo-898.jpg','2018-09-04 23:49:04',NULL,'SOPORTE'),(12,'alex','$2y$10$4eR2KehbEGOkrpgErFTnPeeSMcM8cLAtgKhw/sV8hDSCADVfghgwW','DA PAZ','NUÑEZ','ALEX','user','1','views/images/users/alex-647.jpg','2018-09-05 00:00:05',NULL,'TRABAJO SOCIAL');
/*!40000 ALTER TABLE `spo_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_visita`
--

DROP TABLE IF EXISTS `spo_visita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_visita` (
  `parentesco` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoVisita` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dFamiliar` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dConyugal` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rowid_visita` int(4) NOT NULL AUTO_INCREMENT,
  `fk_persona` int(4) NOT NULL,
  `fk_ppl` int(4) NOT NULL,
  PRIMARY KEY (`rowid_visita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_visita`
--

LOCK TABLES `spo_visita` WRITE;
/*!40000 ALTER TABLE `spo_visita` DISABLE KEYS */;
/*!40000 ALTER TABLE `spo_visita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spo_visitaPpl`
--

DROP TABLE IF EXISTS `spo_visitaPpl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spo_visitaPpl` (
  `rowid_visitaPpl` int(11) NOT NULL AUTO_INCREMENT,
  `fk_persona` int(11) DEFAULT NULL,
  `fk_ppl` int(11) DEFAULT NULL,
  `tipo_visita` varchar(10) DEFAULT NULL,
  `fk_ingresoVisita` int(5) DEFAULT NULL,
  PRIMARY KEY (`rowid_visitaPpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spo_visitaPpl`
--

LOCK TABLES `spo_visitaPpl` WRITE;
/*!40000 ALTER TABLE `spo_visitaPpl` DISABLE KEYS */;
/*!40000 ALTER TABLE `spo_visitaPpl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-10 12:24:44
