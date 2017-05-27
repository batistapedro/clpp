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
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_integrantes_gestion`
--

LOCK TABLES `cargo_integrantes_gestion` WRITE;
/*!40000 ALTER TABLE `cargo_integrantes_gestion` DISABLE KEYS */;
INSERT INTO `cargo_integrantes_gestion` VALUES (26,'Salud','principal','ejecutiva',17,4),(44,'Administrador','principal',NULL,22,3),(49,'Administrador','principal',NULL,24,3),(56,'Salud','principal','ejecutiva',25,2),(64,'Salud','principal','ejecutiva',13,11),(65,'Agua','principal','ejecutiva',27,11),(66,'Agua','principal','ejecutiva',28,11),(67,'Administrativa','principal','administrativa',29,11),(68,'Administrativa','principal','administrativa',30,11),(69,'Administrativa','principal','administrativa',31,11),(70,'Administrativa','suplente','administrativa',32,11),(71,'Contraloria','principal','contraloria',33,11),(72,'Contraloria','principal','contraloria',34,11),(73,'Contraloria','suplente','contraloria',35,11),(74,'Contraloria','suplente','contraloria',36,11),(75,'parlamento','principal',NULL,29,1),(76,'ejecutivo','principal',NULL,31,1),(77,'derechos humanos','principal',NULL,30,1),(78,'comite salud','principal',NULL,32,1),(79,'tierra','principal',NULL,27,1),(80,'bienes','principal',NULL,13,1),(81,'econimia y produccion','principal',NULL,28,1),(82,'mujer','principal',NULL,25,1),(83,'Vivienda Y Habitat','principal','ejecutiva',37,2),(84,'Administrativa','principal','administrativa',38,2),(85,'Administrativa','principal','administrativa',39,2),(87,'Administrativa','principal','administrativa',41,2),(88,'Contraloria','principal','contraloria',42,2),(89,'Contraloria','principal','contraloria',43,2),(90,'Contraloria','principal','contraloria',44,2),(91,'Telecominaciones','principal','ejecutiva',45,2),(92,'defensa y seguridad','principal',NULL,39,1),(93,'familia','principal',NULL,38,1),(95,'aprobacion','principal',NULL,42,1),(96,'planificacion','principal',NULL,44,1),(97,'economia comunal','principal',NULL,43,1),(98,'educacion','principal',NULL,37,1),(99,'administracion','principal',NULL,45,1),(100,'Deportes Y Recreacion','principal','ejecutiva',46,2),(101,'Hugo Chavez','principal','ejecutiva',47,2),(102,'Deportes Y Recreacion','principal','ejecutiva',48,2),(104,'Madres De Barrios','principal','ejecutiva',50,2),(105,'seguimiento y control','principal',NULL,47,1),(106,'organizaciones socio productiva','principal',NULL,46,1),(107,'seguimiento y control del parlamento','principal',NULL,48,1),(108,'contraloria','principal',NULL,50,1),(109,'Obrero','principal',NULL,51,3),(110,'Contador','principal',NULL,52,3),(111,'Obrero','suplente',NULL,53,3),(112,'Administrador','suplente',NULL,54,3),(114,'Contador','suplente',NULL,56,3),(115,'Mecanico','principal',NULL,57,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consejos_comunas`
--

LOCK TABLES `consejos_comunas` WRITE;
/*!40000 ALTER TABLE `consejos_comunas` DISABLE KEYS */;
INSERT INTO `consejos_comunas` VALUES (1,1,11),(2,1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestion_social`
--

LOCK TABLES `gestion_social` WRITE;
/*!40000 ALTER TABLE `gestion_social` DISABLE KEYS */;
INSERT INTO `gestion_social` VALUES (1,'Marhuanta','Casanova Sur','Calle Las Mercedes','vencedores de casanova','cm-20150410-1','33d8719ad5da0e88b77027460daf8482c4dadfa6','comuna','J-12345678-0',NULL,'si','si','si','si','2015-04-10','2014-02-02','2016-02-02','activo'),(2,'Marhuanta','casanova sur II','calles las mercedes','Revolucionarios De Marhuanta','cc-20150410-1','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','consejo','J-12345678-1',NULL,'si','si','si','no','2015-04-10','2015-02-07','2017-02-07','activo'),(3,'Marhuanta','13 De Marzo','Calle Comunal','Pescadores De La Patria','ms-20150410-1','33d8719ad5da0e88b77027460daf8482c4dadfa6','movimiento','J-12345678-4','pescadores','si','si','si','si','2015-04-10','2015-02-05','2020-02-05','activo'),(4,'Marhuanta','1 De Mayo','Casa Comunal','1 De Mayo','cc-20150413-1','9d752daa3fb4df29837088e1e5a1acf74932e074','consejo','J-09876543-2',NULL,'si','si','si','si','2015-04-13','2015-02-05','2017-02-05','activo'),(5,'Marhuanta','Casanova Norte','Calle Las Maravillas','Unidos Por La Patria Grande De Bolivar','cm-20150419-2','a168b74eec9f11eca1e48dcb6a3c8a5e1617e7fa','comuna','J-12332112-3',NULL,'no','no','no','no','2015-04-19','2015-03-04','2017-03-04','activo'),(7,'Marhuanta','Casanova Sur II','Calle Las Mercedes','Juventud Revolucionaria De Marhuanta','ms-20150524-4','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','movimiento','J-09867456-4','juventud','no','no','no','no','2015-05-24','2015-02-05','2020-02-05','activo'),(8,'Marhuanta','Maipure I','Calle Victoria','Trabajadores Revolucionarios','ms-20150524-8','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','movimiento','J-54345398-0','trabajadores','si','si','si','si','2015-05-24','2015-02-01','2020-02-01','activo'),(9,'Marhuanta','Villa Lola','Calle La Democrecia','Villa Lola','cc-20150524-1','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','consejo','J-65476598-1',NULL,'si','si','si','si','2015-05-24','2015-02-03','2017-02-03','activo'),(10,'Marhuanta','15 De Mayo','Calle Betania','15 De Mayo','cm-20150524-6','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','comuna','J-73821910-7',NULL,'si','si','si','si','2015-05-24','2014-02-07','2016-02-07','activo'),(11,'Marhuanta','Casanova Sur','Calle 5 Julio','Vencederes De Guayana','cc-20151030-1','a8744b9de94b8a9ed28090fcbfce8b1066e4b49d','consejo','J-90987654-9',NULL,'si','no','no','no','2015-10-30','2015-06-17','2017-06-17','activo'),(12,'Marhuanta','San Jonote','Casa Comunal','Revolucion Renovadora','cc-20151129-1','26d208c47e201236f214252b5d36f87ca08a13a5','consejo','J-87654876-9',NULL,'si','si','si','si','2015-11-29','2014-03-02','2016-03-02','activo'),(13,'Marhuanta','Maipure 2','Sala De Batalla Marhuanta','Sol Naciente','cm-20151129-11','7fb796aeb4692c5bdad02a9a105406358c086128','comuna','J-78665432-7',NULL,'si','no','si','no','2015-11-29','2013-05-06','2015-05-06','vencido');
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `integrantes_gestion`
--

LOCK TABLES `integrantes_gestion` WRITE;
/*!40000 ALTER TABLE `integrantes_gestion` DISABLE KEYS */;
INSERT INTO `integrantes_gestion` VALUES (13,'Carlos','Dimas','V-19871559','00000000000',1,1,0,11,1),(17,'Ariel','Hernandez','V-18871550','00000000000',1,0,0,4,NULL),(22,'David','Arias','V-17890098','00000000000',0,0,1,NULL,NULL),(24,'Pedro','Batista','V-19871554','04120917497',0,0,1,NULL,NULL),(25,'Javier','Miramal','V-12345543','00000000000',1,1,0,2,1),(27,'Manuel','Sifontes','V-12345678','00000000000',1,1,0,11,1),(28,'Pedro','Limardo','V-19071550','00000000000',1,1,0,11,1),(29,'Jose','Martinez','V-9765222','04121234567',1,1,0,11,1),(30,'Carlos','Benites','V-8888765','02857654123',1,1,0,11,1),(31,'Dennis','Aparicio','V-11000987','00000000000',1,1,0,11,1),(32,'Javier','Lira','V-8555012','04268715542',1,1,0,11,1),(33,'Richard','Castro','V-19555030','04121823443',1,0,0,11,NULL),(34,'Diana','Lima','V-13123098','04269870501',1,0,0,11,NULL),(35,'Daniela','Alvarado','V-13567432','00000000000',1,0,0,11,NULL),(36,'Josefina','Magallanes','V-10909390','00000000000',1,0,0,11,NULL),(37,'Maria','Perez','V-20654456','04120128900',1,1,0,2,1),(38,'Luisa','Rojas','V-18014122','00000000000',1,1,0,2,1),(39,'Noga','Arias','V-16034036','04160917890',1,1,0,2,1),(41,'Lourdes','Sifontes','V-14098123','04264334521',1,0,0,2,NULL),(42,'Marcel','Aponte','V-16034360','00000000000',1,1,0,2,1),(43,'Reinaldo','Soto','V-14098567','04168867676',1,1,0,2,1),(44,'Yudelis','Prieto','V-17876554','00000000000',1,1,0,2,1),(45,'Laura','NuÃ±es','V-15678543','04120987766',1,1,0,2,1),(46,'Milagros','Lizardis','V-22123456','00000000000',1,1,0,2,1),(47,'Wilmer','Gutierrez','V-15151234','04160877780',1,1,0,2,1),(48,'Randy','Guatarasma','V-17000890','00000000000',1,1,0,2,1),(50,'Yusmelis','Mendoza','V-13089000','00000000000',1,1,0,2,1),(51,'Ruben','Limardo','V-19087678','00000000000',0,0,1,NULL,NULL),(52,'Rusbel','Golindano','V-10999678','04267654321',0,0,1,NULL,NULL),(53,'Jose','Blanco','V-11788765','00000000000',0,0,1,NULL,NULL),(54,'Jorge','Moreno','V-13667888','00000000000',0,0,1,NULL,NULL),(56,'Carlos','Colinas','V-18909778','04167889900',0,0,1,NULL,NULL),(57,'Angel','Rojas','V-23543221','00000000000',0,0,1,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES (1,'Nosotros el Consejo Local de PlanificaciÃ³n Publica le damos las Bienvenidas a todos los usuarios que desee saber informaciÃ³n  sobre nuestra instituciÃ³n  y los procesos que llevamos a cabo con el poder popular.','Bienvenidos al Consejo Local de PlanificaciÃ³n Publica del Municipio Heres.','archivosnoticias/consejolocal.jpg','2015-11-29'),(2,'El dÃ­a vienes 28 de Noviembre se le otorgo crÃ©ditos a los Consejos Comunales de la Parroquia Marhuanta el cual contÃ³ con la presencia del Alcalde Sergio Hernandez, el cual  hizo entrega de crÃ©ditos a los siguientes Consejos Comunales de dicha Parroquia :<br />\n<br />\n* Vencedores de Marhuanta.<br />\n* Revolucionario de Casanova Sur II.<br />\n* Sol Naciente.<br />\n* Primeros Combatientes. <br />\n* Bolivarianos Unidos.<br />\n<br />\nEstos crÃ©ditos Fueron aprobados la semana pasada y el dÃ­a 28 de Noviembre fueron entregados a los Voceros Principales de dichos Consejos Comunales ya antes mencionados.','Entregas de CrÃ©ditos.','archivosnoticias/7.png','2015-11-29');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'manuel',NULL,NULL,NULL,'d8913df37b24c97f28f840114d05bd110dbb2e44','administrador'),(7,'Manuel','Sifontes','V-19871556','04120917497','50ec4ef2de85e73b0c838f9a9119b8b591bc2cb8','concejal'),(8,'mariela',NULL,NULL,NULL,'d8913df37b24c97f28f840114d05bd110dbb2e44','operador'),(10,'Yisel','Vaca','V-19871551','00000000000','d3d0379126c1e5e0ba70ad6e5e53ff6aeab9f4fa','concejal'),(11,'Manuel','Conde','V-12000999','00000000000','1d221a1a9cb3faabb58e88a3bdd730082de365e7','concejal'),(12,'Jesus','Cova','V-11000999','00000000000','d0098375debd9f14f2785376c85ec1091563de8b','concejal'),(13,'David','Guetta','V-9654123','04160917497','2fd6622fbb02aac8838c9603917c9cbeb9690c3d','concejal');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voceros_parroquia`
--

LOCK TABLES `voceros_parroquia` WRITE;
/*!40000 ALTER TABLE `voceros_parroquia` DISABLE KEYS */;
INSERT INTO `voceros_parroquia` VALUES (17,24,0,1),(22,13,1,0);
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

-- Dump completed on 2015-12-05 20:34:31
