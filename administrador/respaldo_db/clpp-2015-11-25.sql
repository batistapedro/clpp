-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: clpp
-- ------------------------------------------------------
-- Server version	5.5.46-0+deb7u1

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
-- Table structure for table `cargo_integrantes_gestion`
--

DROP TABLE IF EXISTS `cargo_integrantes_gestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo_integrantes_gestion` (
  `idcargos_integrantes_gestion` int(100) NOT NULL AUTO_INCREMENT,
  `cargo` char(65) NOT NULL,
  `tipo` char(9) NOT NULL,
  `unidad` char(14) DEFAULT NULL,
  `idintegrantes_gestion` int(100) NOT NULL,
  `idgestion_social` int(100) DEFAULT NULL,
  PRIMARY KEY (`idcargos_integrantes_gestion`),
  KEY `fk_cargo_integrantes_gestion_integrantes_gestion1` (`idintegrantes_gestion`),
  CONSTRAINT `fk_cargo_integrantes_gestion_integrantes_gestion1` FOREIGN KEY (`idintegrantes_gestion`) REFERENCES `integrantes_gestion` (`idintegrantes_gestion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_integrantes_gestion`
--

LOCK TABLES `cargo_integrantes_gestion` WRITE;
/*!40000 ALTER TABLE `cargo_integrantes_gestion` DISABLE KEYS */;
INSERT INTO `cargo_integrantes_gestion` VALUES (16,'Tesorero','suplente',NULL,13,3),(22,'Contraloria','principal','contraloria',14,2),(26,'Salud','principal','ejecutiva',17,4),(44,'Administrador','principal',NULL,22,3),(49,'Administrador','principal',NULL,24,3),(56,'Salud','principal','ejecutiva',25,2),(63,'parlamento','principal',NULL,17,1),(64,'Salud','principal','ejecutiva',13,11),(65,'Agua','principal','ejecutiva',27,11),(66,'Agua','principal','ejecutiva',28,11);
/*!40000 ALTER TABLE `cargo_integrantes_gestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consejos_comunas`
--

DROP TABLE IF EXISTS `consejos_comunas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consejos_comunas` (
  `idconsejoscomunas` int(100) NOT NULL AUTO_INCREMENT,
  `idgestion_social` int(100) NOT NULL,
  `idconsejos` int(100) NOT NULL,
  PRIMARY KEY (`idconsejoscomunas`),
  KEY `fk_consejos_comunas_gestion_social1` (`idgestion_social`),
  CONSTRAINT `fk_consejos_comunas_gestion_social1` FOREIGN KEY (`idgestion_social`) REFERENCES `gestion_social` (`idgestion_social`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consejos_comunas`
--

LOCK TABLES `consejos_comunas` WRITE;
/*!40000 ALTER TABLE `consejos_comunas` DISABLE KEYS */;
INSERT INTO `consejos_comunas` VALUES (9,1,4);
/*!40000 ALTER TABLE `consejos_comunas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gestion_social`
--

DROP TABLE IF EXISTS `gestion_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gestion_social` (
  `idgestion_social` int(100) NOT NULL AUTO_INCREMENT,
  `parroquia` varchar(17) NOT NULL,
  `sector` varchar(60) NOT NULL,
  `sede` varchar(60) NOT NULL,
  `nombre_gestion` varchar(100) NOT NULL,
  `codigo_gestion` varchar(15) NOT NULL,
  `clave_gestion` varchar(100) NOT NULL,
  `tipo_gestion` char(10) NOT NULL,
  `rif` varchar(12) NOT NULL,
  `tipo` char(16) DEFAULT NULL,
  `acta` char(2) NOT NULL,
  `nomina` char(2) NOT NULL,
  `constancia` char(2) NOT NULL,
  `cedulas` char(2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_vecimiento` date NOT NULL,
  `estado` char(7) NOT NULL,
  PRIMARY KEY (`idgestion_social`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestion_social`
--

LOCK TABLES `gestion_social` WRITE;
/*!40000 ALTER TABLE `gestion_social` DISABLE KEYS */;
INSERT INTO `gestion_social` VALUES (1,'Marhuanta','Casanova Sur','Calle Las Mercedes','vencedores de casanova','cm-20150410-1','33d8719ad5da0e88b77027460daf8482c4dadfa6','comuna','J-12345678-0',NULL,'si','si','si','si','2015-04-10','2014-02-02','2016-02-02','activo'),(2,'Marhuanta','casanova sur II','calles las mercedes','Revolucionarios De Marhuanta','cc-20150410-1','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','consejo','J-12345678-1',NULL,'si','si','si','si','2015-04-10','2015-02-07','2017-02-07','activo'),(3,'Marhuanta','13 De Marzo','Calle Comunal','Pescadores De La Patria','ms-20150410-1','33d8719ad5da0e88b77027460daf8482c4dadfa6','movimiento','J-12345678-0','pescadores','si','si','si','si','2015-04-10','2015-02-05','2020-02-05','activo'),(4,'Marhuanta','1 De Mayo','Casa Comunal','1 De Mayo','cc-20150413-1','9d752daa3fb4df29837088e1e5a1acf74932e074','consejo','J-09876543-2',NULL,'si','si','si','si','2015-04-13','2015-02-05','2017-02-05','activo'),(5,'Marhuanta','Casanova Norte','Calle Las Maravillas','Unidos Por La Patria Grande De Bolivar','cm-20150419-2','a168b74eec9f11eca1e48dcb6a3c8a5e1617e7fa','comuna','J-12332112-3',NULL,'no','no','no','no','2015-04-19','2015-03-04','2017-03-04','activo'),(7,'Marhuanta','Casanova Sur II','Calle Las Mercedes','Juventud Revolucionaria De Marhuanta','ms-20150524-4','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','movimiento','J-09867456-4','juventud','no','no','no','no','2015-05-24','2015-02-05','2020-02-05','activo'),(8,'Marhuanta','Maipure I','Calle Victoria','Trabajadores Revolucionarios','ms-20150524-8','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','movimiento','J-54345398-0','trabajadores','si','si','si','si','2015-05-24','2015-02-01','2020-02-01','activo'),(9,'Marhuanta','Villa Lola','Calle La Democrecia','Villa Lola','cc-20150524-1','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','consejo','J-65476598-1',NULL,'si','si','si','si','2015-05-24','2015-02-03','2017-02-03','activo'),(10,'Marhuanta','15 De Mayo','Calle Betania','15 De Mayo','cm-20150524-6','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','comuna','J-73821910-7',NULL,'si','si','si','si','2015-05-24','2014-02-07','2016-02-07','activo'),(11,'Marhuanta','Casanova Sur','Calle 5 Julio','Vencederes De Guayana','cc-20151030-1','a8744b9de94b8a9ed28090fcbfce8b1066e4b49d','consejo','J-90987654-9',NULL,'si','no','no','no','2015-10-30','2015-06-17','2017-06-17','activo');
/*!40000 ALTER TABLE `gestion_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `integrantes_gestion`
--

DROP TABLE IF EXISTS `integrantes_gestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `integrantes_gestion` (
  `idintegrantes_gestion` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` char(15) NOT NULL,
  `apellido` char(20) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `consejo` int(1) NOT NULL,
  `comuna` int(1) NOT NULL,
  `movimiento` int(1) NOT NULL,
  `idconsejo` int(100) DEFAULT NULL,
  `idcomuna` int(100) DEFAULT NULL,
  PRIMARY KEY (`idintegrantes_gestion`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `integrantes_gestion`
--

LOCK TABLES `integrantes_gestion` WRITE;
/*!40000 ALTER TABLE `integrantes_gestion` DISABLE KEYS */;
INSERT INTO `integrantes_gestion` VALUES (13,'Carlos','Dimas','V-19871559','00000000000',1,0,1,11,NULL),(14,'Hector','Villalba','V-19871551','00000000000',1,0,0,2,NULL),(17,'Ariel','Hernandez','V-18871550','00000000000',1,1,0,4,1),(22,'David','Arias','V-17890098','00000000000',0,0,1,NULL,NULL),(24,'Pedro','Batista','V-19871554','04120917497',0,0,1,NULL,NULL),(25,'Javier','Miramal','V-12345543','00000000000',1,0,0,2,NULL),(27,'Manuel','Sifontes','V-12345678','00000000000',1,0,0,11,NULL),(28,'Pedro','Limardo','V-19071550','00000000000',1,0,0,11,NULL);
/*!40000 ALTER TABLE `integrantes_gestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticias` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `noticia` text NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuario` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` char(20) NOT NULL,
  `apellido` char(20) DEFAULT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `clave` varchar(70) NOT NULL,
  `tipo` char(13) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'pedro',NULL,NULL,NULL,'10e5fbf721146074ab413dc1ea5caf93debfb202','administrador'),(7,'Manuel','Sifontes','V-19871556','04120917497','50ec4ef2de85e73b0c838f9a9119b8b591bc2cb8','concejal'),(8,'mariela',NULL,NULL,NULL,'d8913df37b24c97f28f840114d05bd110dbb2e44','operador'),(10,'Yisel','Vaca','V-19871551','00000000000','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','concejal');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voceros_parroquia`
--

DROP TABLE IF EXISTS `voceros_parroquia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voceros_parroquia` (
  `idvoceros` int(100) NOT NULL AUTO_INCREMENT,
  `idintegrantes_gestion` int(100) NOT NULL,
  `consejo` int(1) NOT NULL,
  `movimiento` int(1) NOT NULL,
  PRIMARY KEY (`idvoceros`),
  KEY `fk_voceros_parroquia_integrantes_gestion1` (`idintegrantes_gestion`),
  CONSTRAINT `fk_voceros_parroquia_integrantes_gestion1` FOREIGN KEY (`idintegrantes_gestion`) REFERENCES `integrantes_gestion` (`idintegrantes_gestion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voceros_parroquia`
--

LOCK TABLES `voceros_parroquia` WRITE;
/*!40000 ALTER TABLE `voceros_parroquia` DISABLE KEYS */;
INSERT INTO `voceros_parroquia` VALUES (16,13,0,1),(17,24,0,1);
/*!40000 ALTER TABLE `voceros_parroquia` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-25 14:49:52
