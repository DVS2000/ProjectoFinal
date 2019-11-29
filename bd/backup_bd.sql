CREATE DATABASE  IF NOT EXISTS `bdjelu` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bdjelu`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bdjelu
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.6-MariaDB

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
-- Table structure for table `tbcandidato`
--

DROP TABLE IF EXISTS `tbcandidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcandidato` (
  `idCandidato` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `bi` varchar(14) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `dtNasc` date NOT NULL,
  `idnacionalidade` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `dtCriacao` date NOT NULL,
  `dtEdicao` date NOT NULL,
  `nomemae` varchar(100) NOT NULL,
  `nomepai` varchar(100) NOT NULL,
  `morada` varchar(45) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `idSexo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCandidato`),
  KEY `candidato_estado_idx` (`idEstado`),
  KEY `candidato_nacional_idx` (`idnacionalidade`),
  KEY `idSexo` (`idSexo`),
  CONSTRAINT `candidato_estado` FOREIGN KEY (`idEstado`) REFERENCES `tbestado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `candidato_nacional` FOREIGN KEY (`idnacionalidade`) REFERENCES `tbnacionalidade` (`idnacionalidade`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbcandidato_ibfk_1` FOREIGN KEY (`idSexo`) REFERENCES `tbsexo` (`idsexo`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcandidato`
--

LOCK TABLES `tbcandidato` WRITE;
/*!40000 ALTER TABLE `tbcandidato` DISABLE KEYS */;
INSERT INTO `tbcandidato` VALUES (8,'Mr nobody','2345678','elizandro279@gmail.com','94563834272','2001-08-20',15,1,'2019-09-27','2019-09-27','Lucia Afonso','Sungo Afonso','Cidade Alta','81dc9bdb52d04dc20036dbd8313ed055',2),(9,'Dorivaldo DVS','LA04567988','dorivaldodossantos2000@gmail.com','944557610','1994-02-09',20,1,'2019-09-30','2019-10-09','Luzia Vicente','Jerry Santos','Samba - Camuxiba','9732aa7d24a1bc42b7bd1c2a4ca45732',2),(10,'Jerry Santos','2345678B','admin@gmail.com','923218124','1995-03-08',19,1,'2019-10-04','2019-10-04','Luzia Vicente','Sungo Afonso','Samba Camuxiba','e10adc3949ba59abbe56e057f20f883e',2),(14,'Adérito Peres Muniunga','LAO12345890','muniunga2000@gmail.com','942367219','2000-02-06',15,1,'2019-10-04','2019-08-01','María Peres','Viegas Muniunga','Luanda','d41d8cd98f00b204e9800998ecf8427e',2),(15,'Armindo silva','1234567890','ArmindoSilva@gmail.com','999999999','1996-10-04',15,1,'2019-10-04','2019-10-04','Ana Silva','Jose Silva','Luanda','81dc9bdb52d04dc20036dbd8313ed055',2),(16,'Dianaba Diop','0987654321','dianabadiop@gmail.com','912345678','2000-12-05',15,1,'2019-10-04','2019-10-04','Elsa Monteiro','Amadou Diop','Samba','81dc9bdb52d04dc20036dbd8313ed055',1),(17,'Eugénio Félix Silili','1324356789','eugenio@gmail.com','988888888','2001-12-04',15,1,'2019-10-04','2019-10-04','Teresa Silili','Joaquim Silili','Benfica','81dc9bdb52d04dc20036dbd8313ed055',2),(18,'Andreia José','535355227','andreia@gmail.com','991234567','1989-02-07',15,1,'2019-10-04','2019-10-04','Ana José','André José','Viana','81dc9bdb52d04dc20036dbd8313ed055',1),(20,'Dorivaldo dos Santos','LA04567981','dorivaldo.santos@digitalfactory.co.ao.com','944557618','2001-06-05',15,1,'2019-10-06','2019-10-06','Luzia Vicente','Jerry Santos','Samba Camuxiba','81dc9bdb52d04dc20036dbd8313ed055',2),(21,'DVS 2000','LA04567988A','dorivaldo.txeste@gmail.com','944557621','1989-12-06',15,1,'2019-10-06','2019-10-06','Luzia Vicente','Jerry Santos','Samba Camuxiba','d41d8cd98f00b204e9800998ecf8427e',2),(22,'Dorivaldo dos Santos','LA04567985','dorivaldo.santos@digitalfactory.co','944557615','1999-06-15',15,1,'2019-08-01','2019-08-01','Luzia Vicente','Jerry Santos','Samba Camuxiba','81dc9bdb52d04dc20036dbd8313ed055',2),(24,'José Miguel Baião Monteiro','LA04567911','josemiguel@gmail.com','940263868','2000-02-09',15,1,'2019-10-09','2019-10-09','Ana Baião','Paulo Monteiro','Prenda','81dc9bdb52d04dc20036dbd8313ed055',2),(25,'Keno Bravo','LAO123456789','kenobravo13@gmail.com','936203189','1999-10-08',15,1,'2019-08-01','2019-08-01','Lúisa da Cruz Bravo','Malembela Pedro','Prenda','81dc9bdb52d04dc20036dbd8313ed055',2),(26,'Marcelina Mateque Caxicula','LAO3310832','marcia@gmail.com','940411508','1999-03-13',15,1,'2019-08-01','2019-08-01','Ana Caxicula','José Caxicula','GAMEK ','d41d8cd98f00b204e9800998ecf8427e',1),(27,'Márcio Miliano Gange Daniel','LAO0978543','marcio123@gmail.com','924772299','1998-03-24',15,1,'2019-08-01','2019-08-01','Andressa Daniel','Miliano Daniel','HOJI-YA-HENDA','81dc9bdb52d04dc20036dbd8313ed055',2),(28,'Odeth Jamba Cassoma','LAO2001774','odeth@gmail.com','932850105','1998-05-19',15,1,'2019-08-01','2019-08-01','Odeth Jamba','Joaquim Cassoma','ESTALAGEM','81dc9bdb52d04dc20036dbd8313ed055',2),(29,'Sandra Luciano Massocolo','LAO66744128','sandra144@gmail.com','928596849','1997-06-06',15,1,'2019-08-01','2019-08-01','Edna Luciano','Daniel Massocolo','BELAS  ','81dc9bdb52d04dc20036dbd8313ed055',1);
/*!40000 ALTER TABLE `tbcandidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcurso`
--

DROP TABLE IF EXISTS `tbcurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcurso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `requisitos` varchar(4000) CHARACTER SET utf8 NOT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `dtCriacao` date DEFAULT NULL,
  `dtEdicao` date DEFAULT NULL,
  `planoAula` varchar(4000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `curso_estado_idx` (`idEstado`),
  CONSTRAINT `curso_estado` FOREIGN KEY (`idEstado`) REFERENCES `tbestado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcurso`
--

LOCK TABLES `tbcurso` WRITE;
/*!40000 ALTER TABLE `tbcurso` DISABLE KEYS */;
INSERT INTO `tbcurso` VALUES (10,'Ligeiro Amador',35000,'<ul><li>Para maiores de 18 anos de idade e com mínimo, de 9° classe;</li><li>Cópia do bilhete de identidade;</li><li>2 Fotografias;</li><li>Declaração da 9ª classe;</li><li>Mais qualquer coisa;</li><li><strong>Outra </strong><i>coisa</i>;</li></ul>',1,'2019-09-15','2019-08-01','<p><strong>Princípios gerais de trânsito e de segurança rodoviária</strong><br><br>Sistema de Circulação Rodoviário;<br>Hierarquia da Sinalização;&nbsp;<br>Sinais do Agente Regulador de Trânsito;&nbsp;<br>Sinais Sonoros e Outros.&nbsp;<br>Sinais de Perigo;&nbsp;<br>Sinais de Cedência de Passagem.<br>Sinais de Obrigação; Sinais de Prescrição Específica.<br>Sinais de Proibição.<br>Sinais de Indicação.<br>Sinais Luminosos;<br>Triângulo de Pré-sinalização e Colete.<br>Marcas Rodoviárias.<br>Ultrapassagem;<br>Cruzamento de Veículos.<br>Mudança de Direcção;&nbsp;<br>Inversão do Sentido da Marcha e Marcha Atrás.<br>Paragem e Estacionamento.<br>Regra da Cedência de Passagem e Veículos Prioritários.<br>Regras em Auto-Estradas, Vias Reservadas e Ponte 25 de Abril. Velocidades.<br><br><strong>O condutor e o seu estado físico e psicológico</strong><br><br>Estado Físico e Psicológico do Condutor; Álcool, Drogas e Medicamentos.<br><br><strong>O condutor e o veículo</strong><br><br>Classificação de Veículos.<br>Órgão de Segurança; Inspecções Técnicas; Pesos e Dimensões. Manutenção e Economia.<br><br><strong>O condutor e os outros utentes da via</strong><br><br>Iluminação de Veículos.<br>Transporte de Carga e Passageiros; Condução Defensiva.<br><br><strong>O condutor, a via e outros factores externos</strong><br><br>Classificação das Vias e Factores de Risco; Condições Ambientais.<br><br>Habilitação legal para conduzir&nbsp;<br>Habilitação Legal para Conduzir.<br>Habilitação Legal para Conduzir (Responsabilidades).­­ Responsabilidades; Contra-ordenações.<br><br><strong>Outros</strong></p><p><br>Revisões.<br>Aula Livre.</p>'),(18,'Ligeiro Profissional',55000,'<ul><li>Para maiores de 21 anos de idade e com mínimo, de 8° classe: Cópia do B.I.</li><li>3 Fotografias tipo passe(iguais).</li><li>Modelo de atestado médico para condutores automóveis.</li><li>Cartão de identificação de estudante (adquirido na secretaria).</li><li>Livro de códigos(adquirido na secretaria).</li></ul><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>',1,'2019-09-27','2019-10-01','<p><strong>Princípios gerais de trânsito e de segurança rodoviária</strong><br><br>Sistema de Circulação Rodoviário;<br>Hierarquia da Sinalização;&nbsp;<br>Sinais do Agente Regulador de Trânsito;&nbsp;<br>Sinais Sonoros e Outros.&nbsp;<br>Sinais de Perigo;&nbsp;<br>Sinais de Cedência de Passagem.<br>Sinais de Obrigação; Sinais de Prescrição Específica.<br>Sinais de Proibição.<br>Sinais de Indicação.<br>Sinais Luminosos;<br>Triângulo de Pré-sinalização e Colete.<br>Marcas Rodoviárias.<br>Ultrapassagem;<br>Cruzamento de Veículos.<br>Mudança de Direcção;&nbsp;<br>Inversão do Sentido da Marcha e Marcha Atrás.<br>Paragem e Estacionamento.<br>Regra da Cedência de Passagem e Veículos Prioritários.<br>Regras em Auto-Estradas, Vias Reservadas e Ponte 25 de Abril. Velocidades.<br><br><strong>O condutor e o seu estado físico e psicológico</strong><br><br>Estado Físico e Psicológico do Condutor; Álcool, Drogas e Medicamentos.<br><br><strong>O condutor e o veículo</strong><br><br>Classificação de Veículos.<br>Órgão de Segurança; Inspecções Técnicas; Pesos e Dimensões. Manutenção e Economia.<br><br><strong>O condutor e os outros utentes da via</strong><br><br>Iluminação de Veículos.<br>Transporte de Carga e Passageiros; Condução Defensiva.<br><br><strong>O condutor, a via e outros factores externos</strong><br><br>Classificação das Vias e Factores de Risco; Condições Ambientais.<br><br>Habilitação legal para conduzir&nbsp;<br>Habilitação Legal para Conduzir.<br>Habilitação Legal para Conduzir (Responsabilidades).­­ Responsabilidades; Contra-ordenações.<br><br><strong>Outros</strong></p><p><br>Revisões.<br>Aula Livre.</p>'),(19,'Pesado profissional',70000,'<ul><li>Para maiores de 21 anos de idade e com mínimo, de 9ª classe.</li><li>Cartão de identificação de estudante(adquirido na secretaria).&nbsp;</li><li>1 Cópia do B.I</li><li>3 Fotografias tipo passe(iguais).</li><li>Modelo de atestado médico para condutores de automóveis( adquirido na secretaria).&nbsp;</li></ul>',1,'2019-09-27','2019-10-01','<p><strong>Princípios gerais de trânsito e de segurança rodoviária</strong><br><br><br><br>Sistema de Circulação Rodoviário;<br>Hierarquia da Sinalização;&nbsp;<br>Sinais do Agente Regulador de Trânsito;&nbsp;<br>Sinais Sonoros e Outros.&nbsp;<br>Sinais de Perigo;&nbsp;<br>Sinais de Cedência de Passagem.<br>Sinais de Obrigação; Sinais de Prescrição Específica.<br>Sinais de Proibição.<br>Sinais de Indicação.<br>Sinais Luminosos;<br>Triângulo de Pré-sinalização e Colete.<br>Marcas Rodoviárias.<br>Ultrapassagem;<br>Cruzamento de Veículos.<br>Mudança de Direcção;&nbsp;<br>Inversão do Sentido da Marcha e Marcha Atrás.<br>Paragem e Estacionamento.<br>Regra da Cedência de Passagem e Veículos Prioritários.<br>Regras em Auto-Estradas, Vias Reservadas e Ponte 25 de Abril. Velocidades.<br><br><strong>O condutor e o seu estado físico e psicológico</strong><br><br>Estado Físico e Psicológico do Condutor; Álcool, Drogas e Medicamentos.<br><br><strong>O condutor e o veículo</strong><br><br>Classificação de Veículos.<br>Orgão de Segurança; Inspeções Técnicas; Pesos e Dimensões. Manutenção e Economia.<br><br><strong>O condutor e os outros utentes da via</strong><br><br>Iluminação de Veículos.<br>Transporte de Carga e Passageiros; Condução Defensiva.<br><br><strong>O condutor, a via e outros factores externos</strong><br><br>Classificação das Vias e Factores de Risco; Condições Ambientais.<br><br>Habilitação legal para conduzir&nbsp;<br>Habilitação Legal para Conduzir.<br>Habilitação Legal para Conduzir (Responsabilidades).­­ Responsabilidades; Contra-ordenações.<br><br><strong>Outros</strong><br><br>Revisões.<br>Aula Livre.</p>');
/*!40000 ALTER TABLE `tbcurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbestado`
--

DROP TABLE IF EXISTS `tbestado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbestado` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbestado`
--

LOCK TABLES `tbestado` WRITE;
/*!40000 ALTER TABLE `tbestado` DISABLE KEYS */;
INSERT INTO `tbestado` VALUES (1,'Activado'),(2,'Desactivado');
/*!40000 ALTER TABLE `tbestado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbformpag`
--

DROP TABLE IF EXISTS `tbformpag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbformpag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbformpag`
--

LOCK TABLES `tbformpag` WRITE;
/*!40000 ALTER TABLE `tbformpag` DISABLE KEYS */;
INSERT INTO `tbformpag` VALUES (1,'Referência'),(2,'Visa'),(3,'Muticaixa'),(4,'Cash');
/*!40000 ALTER TABLE `tbformpag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbinscricao`
--

DROP TABLE IF EXISTS `tbinscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbinscricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) DEFAULT NULL,
  `idCandidato` int(11) DEFAULT NULL,
  `dtCriacao` date DEFAULT NULL,
  `dtEdicao` date DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCurso` (`idCurso`),
  KEY `idCandidato` (`idCandidato`),
  KEY `idEstado` (`idEstado`),
  CONSTRAINT `tbinscricao_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `tbcurso` (`idCurso`),
  CONSTRAINT `tbinscricao_ibfk_2` FOREIGN KEY (`idCandidato`) REFERENCES `tbcandidato` (`idCandidato`),
  CONSTRAINT `tbinscricao_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `tbestado` (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbinscricao`
--

LOCK TABLES `tbinscricao` WRITE;
/*!40000 ALTER TABLE `tbinscricao` DISABLE KEYS */;
INSERT INTO `tbinscricao` VALUES (37,18,8,'2019-10-07','2019-10-07',1),(38,19,8,'2019-10-07','2019-10-07',1),(45,19,9,'2019-10-10','2019-10-10',1);
/*!40000 ALTER TABLE `tbinscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnacionalidade`
--

DROP TABLE IF EXISTS `tbnacionalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnacionalidade` (
  `idnacionalidade` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(80) DEFAULT NULL,
  `idestado` int(11) DEFAULT NULL,
  `dtCriacao` date DEFAULT NULL,
  `dtEdicao` date DEFAULT NULL,
  PRIMARY KEY (`idnacionalidade`),
  KEY `tbnacionalidade_ibfk_1` (`idestado`),
  CONSTRAINT `tbnacionalidade_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `tbestado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnacionalidade`
--

LOCK TABLES `tbnacionalidade` WRITE;
/*!40000 ALTER TABLE `tbnacionalidade` DISABLE KEYS */;
INSERT INTO `tbnacionalidade` VALUES (15,'Angolano(a)',1,'0000-00-00','2019-10-06'),(16,'Brasileiro(a)',1,'2019-09-27','2019-09-27'),(17,'Espanhol(a)',1,'2019-09-27','2019-09-27'),(18,'Argelino(a)',1,'2019-09-27','2019-09-27'),(19,'Moçambicano(a)',1,'2019-09-27','2019-09-27'),(20,'Cabo-verdiano(a)',1,'2019-09-27','2019-09-27'),(21,'Inglês(a)',1,'2019-09-27','2019-09-27'),(22,'Senegalês(a)',1,'2019-09-27','2019-09-27'),(23,'Nigeriano(a)',1,'2019-09-27','2019-09-27'),(24,'Português(a)',1,'0000-00-00','2019-09-27'),(25,'Chinês(a)',1,'2019-09-27','2019-09-27'),(26,'Indiano(a)',1,'2019-09-27','2019-09-27'),(29,'Dorivaldo',NULL,NULL,NULL),(31,'Argentino',1,'2019-10-05','2019-10-05');
/*!40000 ALTER TABLE `tbnacionalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpagamento`
--

DROP TABLE IF EXISTS `tbpagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idformpag` int(11) NOT NULL,
  `tempo` date DEFAULT NULL,
  `idInscricao` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `dtPagamento` date DEFAULT NULL,
  `dtEdicao` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagForm_idx` (`idformpag`),
  KEY `tbpagamento_ibfk_1` (`idInscricao`),
  CONSTRAINT `pagForm` FOREIGN KEY (`idformpag`) REFERENCES `tbformpag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbpagamento_ibfk_1` FOREIGN KEY (`idInscricao`) REFERENCES `tbinscricao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpagamento`
--

LOCK TABLES `tbpagamento` WRITE;
/*!40000 ALTER TABLE `tbpagamento` DISABLE KEYS */;
INSERT INTO `tbpagamento` VALUES (29,2,'2019-10-13',37,1,'2019-10-07','2019-10-07'),(30,3,'2019-10-13',38,1,'2019-10-07','2019-10-07'),(37,4,'2019-10-16',45,1,'2019-10-10','2019-10-10');
/*!40000 ALTER TABLE `tbpagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbrelatoriocandidato`
--

DROP TABLE IF EXISTS `tbrelatoriocandidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbrelatoriocandidato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numCandidatos` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbrelatoriocandidato`
--

LOCK TABLES `tbrelatoriocandidato` WRITE;
/*!40000 ALTER TABLE `tbrelatoriocandidato` DISABLE KEYS */;
INSERT INTO `tbrelatoriocandidato` VALUES (19,2,9),(20,9,10),(21,6,8);
/*!40000 ALTER TABLE `tbrelatoriocandidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbsexo`
--

DROP TABLE IF EXISTS `tbsexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbsexo` (
  `idsexo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`idsexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbsexo`
--

LOCK TABLES `tbsexo` WRITE;
/*!40000 ALTER TABLE `tbsexo` DISABLE KEYS */;
INSERT INTO `tbsexo` VALUES (1,'Femenino'),(2,'Masculino');
/*!40000 ALTER TABLE `tbsexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbtipoutilizador`
--

DROP TABLE IF EXISTS `tbtipoutilizador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtipoutilizador` (
  `idtbTipoUtilizador` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idtbTipoUtilizador`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtipoutilizador`
--

LOCK TABLES `tbtipoutilizador` WRITE;
/*!40000 ALTER TABLE `tbtipoutilizador` DISABLE KEYS */;
INSERT INTO `tbtipoutilizador` VALUES (11,'Administrador(a)'),(12,'Secretário(a)');
/*!40000 ALTER TABLE `tbtipoutilizador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbutilizador`
--

DROP TABLE IF EXISTS `tbutilizador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbutilizador` (
  `idUtilizador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(14) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dtcriacao` date DEFAULT NULL,
  `dtEdicao` date DEFAULT NULL,
  `idtbTipoUtilizador` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idSexo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUtilizador`),
  KEY `fk_tipoutil_utilizador` (`idtbTipoUtilizador`),
  KEY `fk_estado_utilizador` (`idEstado`),
  KEY `sexo_util_idx` (`idSexo`),
  CONSTRAINT `fk_estado_utilizador` FOREIGN KEY (`idEstado`) REFERENCES `tbestado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tipoutil_utilizador` FOREIGN KEY (`idtbTipoUtilizador`) REFERENCES `tbtipoutilizador` (`idtbTipoUtilizador`),
  CONSTRAINT `sexo_util` FOREIGN KEY (`idSexo`) REFERENCES `tbsexo` (`idsexo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbutilizador`
--

LOCK TABLES `tbutilizador` WRITE;
/*!40000 ALTER TABLE `tbutilizador` DISABLE KEYS */;
INSERT INTO `tbutilizador` VALUES (32,'Dorivaldo Vicente','dorivaldodossantos2000@gmail.com','944557610','d85b63ef0ccb114d0a3bb7b7d808028f','2019-09-27','2019-10-06',11,1,2),(34,'Edna Assucena Bastos','ednaassucena@gmail.com','992228230','81dc9bdb52d04dc20036dbd8313ed055','2019-10-02','2019-10-08',12,1,1),(35,'Elizandro Lucas','elizandro279@gmail.com','930554698','81dc9bdb52d04dc20036dbd8313ed055','2019-10-02','2019-10-08',11,1,2),(36,'Félix Pereira','felixpereira538@gmail.com','913230135','81dc9bdb52d04dc20036dbd8313ed055','2019-10-02','2019-10-08',11,1,2),(37,'Rui Anderson','randerson01@gmail.com','926865238','f41aa34ccc994a3802b9a3444a765dd7','2019-10-03','2019-10-03',12,1,2),(38,'Adérito Peres Muniunga','muniunga2000@gmail.com','942367219','81dc9bdb52d04dc20036dbd8313ed055','2019-10-04','2019-10-08',11,1,2);
/*!40000 ALTER TABLE `tbutilizador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vercandidato`
--

DROP TABLE IF EXISTS `vercandidato`;
/*!50001 DROP VIEW IF EXISTS `vercandidato`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vercandidato` AS SELECT 
 1 AS `idCandidato`,
 1 AS `nome`,
 1 AS `bi`,
 1 AS `email`,
 1 AS `telefone`,
 1 AS `dtNasc`,
 1 AS `idestado`,
 1 AS `nacionalidade`,
 1 AS `idnacionalidade`,
 1 AS `dtCriacao`,
 1 AS `dtEdicao`,
 1 AS `nomemae`,
 1 AS `nomepai`,
 1 AS `morada`,
 1 AS `senha`,
 1 AS `idsexo`,
 1 AS `sexo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vercursos`
--

DROP TABLE IF EXISTS `vercursos`;
/*!50001 DROP VIEW IF EXISTS `vercursos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vercursos` AS SELECT 
 1 AS `idcurso`,
 1 AS `descricao`,
 1 AS `preco`,
 1 AS `idestado`,
 1 AS `requisitos`,
 1 AS `planoAula`,
 1 AS `dtCriacao`,
 1 AS `dtEdicao`,
 1 AS `estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `verinscricao`
--

DROP TABLE IF EXISTS `verinscricao`;
/*!50001 DROP VIEW IF EXISTS `verinscricao`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `verinscricao` AS SELECT 
 1 AS `idCandidato`,
 1 AS `nome`,
 1 AS `idCurso`,
 1 AS `curso`,
 1 AS `id`,
 1 AS `dtCriacao`,
 1 AS `dtEdicao`,
 1 AS `idEstado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `verpagamento`
--

DROP TABLE IF EXISTS `verpagamento`;
/*!50001 DROP VIEW IF EXISTS `verpagamento`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `verpagamento` AS SELECT 
 1 AS `id`,
 1 AS `tempo`,
 1 AS `nome`,
 1 AS `curso`,
 1 AS `preco`,
 1 AS `formPag`,
 1 AS `estado`,
 1 AS `dtPagamento`,
 1 AS `dtEdicao`,
 1 AS `idinscricao`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `verutilizador`
--

DROP TABLE IF EXISTS `verutilizador`;
/*!50001 DROP VIEW IF EXISTS `verutilizador`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `verutilizador` AS SELECT 
 1 AS `idutilizador`,
 1 AS `nome`,
 1 AS `telefone`,
 1 AS `email`,
 1 AS `sexo`,
 1 AS `TipoUtil`,
 1 AS `dtcriacao`,
 1 AS `dtedicao`,
 1 AS `idsexo`,
 1 AS `idtbTipoUtilizador`,
 1 AS `idestado`,
 1 AS `senha`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vercandidato`
--

/*!50001 DROP VIEW IF EXISTS `vercandidato`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vercandidato` AS select `tbcandidato`.`idCandidato` AS `idCandidato`,`tbcandidato`.`nome` AS `nome`,`tbcandidato`.`bi` AS `bi`,`tbcandidato`.`email` AS `email`,`tbcandidato`.`telefone` AS `telefone`,`tbcandidato`.`dtNasc` AS `dtNasc`,`tbcandidato`.`idEstado` AS `idestado`,`tbnacionalidade`.`descricao` AS `nacionalidade`,`tbcandidato`.`idnacionalidade` AS `idnacionalidade`,`tbcandidato`.`dtCriacao` AS `dtCriacao`,`tbcandidato`.`dtEdicao` AS `dtEdicao`,`tbcandidato`.`nomemae` AS `nomemae`,`tbcandidato`.`nomepai` AS `nomepai`,`tbcandidato`.`morada` AS `morada`,`tbcandidato`.`senha` AS `senha`,`tbsexo`.`idsexo` AS `idsexo`,`tbsexo`.`descricao` AS `sexo` from ((`tbcandidato` join `tbnacionalidade` on(`tbcandidato`.`idnacionalidade` = `tbnacionalidade`.`idnacionalidade`)) join `tbsexo` on(`tbcandidato`.`idSexo` = `tbsexo`.`idsexo`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vercursos`
--

/*!50001 DROP VIEW IF EXISTS `vercursos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vercursos` AS select `tbcurso`.`idCurso` AS `idcurso`,`tbcurso`.`descricao` AS `descricao`,`tbcurso`.`preco` AS `preco`,`tbcurso`.`idEstado` AS `idestado`,`tbcurso`.`requisitos` AS `requisitos`,`tbcurso`.`planoAula` AS `planoAula`,`tbcurso`.`dtCriacao` AS `dtCriacao`,`tbcurso`.`dtEdicao` AS `dtEdicao`,`tbestado`.`descricao` AS `estado` from (`tbcurso` join `tbestado` on(`tbcurso`.`idEstado` = `tbestado`.`idEstado`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `verinscricao`
--

/*!50001 DROP VIEW IF EXISTS `verinscricao`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `verinscricao` AS select `tbcandidato`.`idCandidato` AS `idCandidato`,`tbcandidato`.`nome` AS `nome`,`tbcurso`.`idCurso` AS `idCurso`,`tbcurso`.`descricao` AS `curso`,`tbinscricao`.`id` AS `id`,`tbinscricao`.`dtCriacao` AS `dtCriacao`,`tbinscricao`.`dtEdicao` AS `dtEdicao`,`tbinscricao`.`idEstado` AS `idEstado` from ((`tbinscricao` join `tbcandidato` on(`tbcandidato`.`idCandidato` = `tbinscricao`.`idCandidato`)) join `tbcurso` on(`tbcurso`.`idCurso` = `tbinscricao`.`idCurso`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `verpagamento`
--

/*!50001 DROP VIEW IF EXISTS `verpagamento`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `verpagamento` AS select `tbpagamento`.`id` AS `id`,`tbpagamento`.`tempo` AS `tempo`,`tbcandidato`.`nome` AS `nome`,`tbcurso`.`descricao` AS `curso`,`tbcurso`.`preco` AS `preco`,`tbformpag`.`descricao` AS `formPag`,`tbpagamento`.`estado` AS `estado`,`tbpagamento`.`dtPagamento` AS `dtPagamento`,`tbpagamento`.`dtEdicao` AS `dtEdicao`,`tbinscricao`.`id` AS `idinscricao` from ((((`tbpagamento` join `tbformpag` on(`tbformpag`.`id` = `tbpagamento`.`idformpag`)) join `tbinscricao` on(`tbinscricao`.`id` = `tbpagamento`.`idInscricao`)) join `tbcandidato` on(`tbcandidato`.`idCandidato` = `tbinscricao`.`idCandidato`)) join `tbcurso` on(`tbcurso`.`idCurso` = `tbinscricao`.`idCurso`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `verutilizador`
--

/*!50001 DROP VIEW IF EXISTS `verutilizador`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `verutilizador` AS select `tbutilizador`.`idUtilizador` AS `idutilizador`,`tbutilizador`.`nome` AS `nome`,`tbutilizador`.`telefone` AS `telefone`,`tbutilizador`.`email` AS `email`,`tbsexo`.`descricao` AS `sexo`,`tbtipoutilizador`.`descricao` AS `TipoUtil`,`tbutilizador`.`dtcriacao` AS `dtcriacao`,`tbutilizador`.`dtEdicao` AS `dtedicao`,`tbsexo`.`idsexo` AS `idsexo`,`tbtipoutilizador`.`idtbTipoUtilizador` AS `idtbTipoUtilizador`,`tbestado`.`idEstado` AS `idestado`,`tbutilizador`.`senha` AS `senha` from (((`tbutilizador` join `tbsexo` on(`tbutilizador`.`idSexo` = `tbsexo`.`idsexo`)) join `tbtipoutilizador` on(`tbutilizador`.`idtbTipoUtilizador` = `tbtipoutilizador`.`idtbTipoUtilizador`)) join `tbestado` on(`tbutilizador`.`idEstado` = `tbestado`.`idEstado`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-29 15:45:00
