-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2016 at 11:28 AM
-- Server version: 5.1.73
-- PHP Version: 5.3.2-1ubuntu4.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dscarpar-PR`
--

-- --------------------------------------------------------

--
-- Table structure for table `aereo`
--

DROP TABLE IF EXISTS `aereo`;
CREATE TABLE IF NOT EXISTS `aereo` (
  `idAereo` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `modello` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `numeroPosti` int(3) NOT NULL,
  PRIMARY KEY (`idAereo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `aereo`
--

INSERT INTO `aereo` (`idAereo`, `modello`, `numeroPosti`) VALUES
('A001', 'Airbus A320-200', 168),
('A002', 'Airbus A380-800', 488),
('A003', 'Boeing 737-500', 120),
('A004', 'Boeing 747-8I', 364),
('A005', 'Airbus A321-200', 200),
('A006', 'Boeing 737-300', 140);

-- --------------------------------------------------------

--
-- Table structure for table `aeroporto`
--

DROP TABLE IF EXISTS `aeroporto`;
CREATE TABLE IF NOT EXISTS `aeroporto` (
  `codiceAeroporto` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `nomeAeroporto` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `citta` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nazione` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `numeroPiste` int(3) NOT NULL,
  PRIMARY KEY (`codiceAeroporto`),
  UNIQUE KEY `nomeAeroporto` (`nomeAeroporto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `aeroporto`
--

INSERT INTO `aeroporto` (`codiceAeroporto`, `nomeAeroporto`, `citta`, `nazione`, `numeroPiste`) VALUES
('ALC', 'Elche', 'Alicante', 'Spagna', 1),
('AMS', 'Schiphol', 'Amsterdam', 'Paesi Bassi', 6),
('ATH', 'Eleftherios Venizelos', 'Atene', 'Grecia', 2),
('BCN', 'El Prat', 'Barcellona', 'Spagna', 3),
('BLQ', 'Borgo Panigale', 'Bologna', 'Italia', 1),
('BRU', 'National', 'Bruxelles', 'Belgio', 3),
('BVA', 'Beauvais Tille', 'Parigi', 'Francia', 2),
('CDG', 'Charles de Gaulle', 'Parigi', 'Francia', 4),
('FCO', 'Fiumicino', 'Roma', 'Italia', 4),
('FRA', 'Francoforte sul Meno', 'Francoforte', 'Germania', 4),
('HEL', 'Vantaa', 'Helsinki', 'Finlandia', 3),
('HND', 'Haneda', 'Tokyo', 'Giappone', 4),
('IAH', 'George Bush', 'Houston', 'Stati Uniti', 5),
('IBZ', 'Sant Josep', 'Ibiza', 'Spagna', 1),
('JFK', 'John F. Kennedy', 'New York', 'Stati Uniti', 4),
('LAX', 'Los Angeles', 'Los Angeles', 'Stati Uniti', 4),
('LED', 'Pulkovo', 'San Pietroburgo', 'Russia', 2),
('LGW', 'Gatwick', 'Londra', 'Regno Unito', 2),
('LHR', 'Heathrow', 'Londra', 'Regno Unito', 2),
('LIN', 'Linate', 'Milano', 'Italia', 2),
('MAD', 'Barajas', 'Madrid', 'Spagna', 4),
('MUC', 'Franz Josef Strauss', 'Monaco di Baviera', 'Germania', 2),
('MXP', 'Malpensa', 'Milano', 'Italia', 2),
('OPO', 'Francisco Sa Carneiro', 'Porto', 'Portogallo', 1),
('PMI', 'Son Sant Joan', 'Palma di Maiorca', 'Spagna', 2),
('PVG', 'Pudong', 'Shangai', 'Cina', 3),
('SIN', 'Changi', 'Singapore', 'Singapore', 3),
('STN', 'Stansted', 'Londra', 'Regno Unito', 1),
('TXL', 'Tegel', 'Berlino', 'Germania', 2),
('VCE', 'Marco Polo', 'Venezia', 'Italia', 2),
('VIE', 'Schwechat', 'Vienna', 'Austria', 2);

-- --------------------------------------------------------

--
-- Table structure for table `carta`
--

DROP TABLE IF EXISTS `carta`;
CREATE TABLE IF NOT EXISTS `carta` (
  `codiceCarta` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `mailUtente` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `punti` int(5) DEFAULT NULL,
  PRIMARY KEY (`codiceCarta`),
  KEY `mailUtente` (`mailUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `carta`
--

INSERT INTO `carta` (`codiceCarta`, `mailUtente`, `punti`) VALUES
('1234567890', 'cliente@gmail.com', 70),
('1234567891', 'maria@gmail.com', 170),
('1234567892', 'marco@gmail.com', 180),
('1234567893', 'lucy@gmail.com', 160),
('1234567894', 'antonio@gmail.com', 100),
('1234567895', 'marta@gmail.com', 140),
('1234567896', 'niknik@gmail.com', 180),
('1234567897', 'pimpinea@gmail.com', 140),
('1234567898', 'liukdof@gmail.com', 200),
('1234567899', 'bareoto@gmail.com', 90),
('1234567900', 'alfred@gmail.com', 210);

-- --------------------------------------------------------

--
-- Table structure for table `prenotazione`
--

DROP TABLE IF EXISTS `prenotazione`;
CREATE TABLE IF NOT EXISTS `prenotazione` (
  `idPrenotazione` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `mailUtente` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `idVoloPren` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `dataPrenotazione` datetime NOT NULL,
  `numeroBiglietti` int(2) NOT NULL,
  `costoBiglietto` double NOT NULL,
  `classe` enum('prima','business','economy') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`idPrenotazione`),
  KEY `mailUtente` (`mailUtente`),
  KEY `idVoloPren` (`idVoloPren`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `prenotazione`
--

INSERT INTO `prenotazione` (`idPrenotazione`, `mailUtente`, `idVoloPren`, `dataPrenotazione`, `numeroBiglietti`, `costoBiglietto`, `classe`) VALUES
('P001', 'cliente@gmail.com', 'V044', '2016-01-27 11:30:00', 6, 149.5, 'business'),
('P002', 'cliente@gmail.com', 'V001', '2016-01-27 17:00:00', 7, 95, 'economy'),
('P003', 'cliente@gmail.com', 'V013', '2016-01-27 09:48:20', 2, 172, 'prima'),
('P004', 'cliente@gmail.com', 'V044', '2016-01-27 21:22:00', 1, 179.5, 'prima'),
('P005', 'cliente@gmail.com', 'V017', '2016-01-27 16:25:07', 3, 111, 'business'),
('P006', 'cliente@gmail.com', 'V009', '2016-01-27 17:48:00', 1, 145.5, 'prima'),
('P007', 'cliente@gmail.com', 'V032', '2016-01-28 08:29:52', 3, 132.5, 'prima'),
('P008', 'niknik@gmail.com', 'V006', '2016-01-28 09:03:04', 1, 134, 'prima'),
('P009', 'niknik@gmail.com', 'V002', '2016-01-28 09:16:56', 4, 82.5, 'economy'),
('P010', 'niknik@gmail.com', 'V015', '2016-01-28 09:18:08', 5, 98, 'prima'),
('P011', 'niknik@gmail.com', 'V016', '2016-01-28 09:18:36', 3, 106.5, 'business'),
('P012', 'niknik@gmail.com', 'V047', '2016-01-28 09:19:03', 1, 91.5, 'economy'),
('P013', 'niknik@gmail.com', 'V055', '2016-01-28 09:19:31', 2, 84, 'business'),
('P014', 'niknik@gmail.com', 'V029', '2016-01-28 09:20:24', 2, 784, 'prima'),
('P015', 'alfred@gmail.com', 'V007', '2016-01-28 09:22:35', 5, 90.5, 'economy'),
('P016', 'alfred@gmail.com', 'V010', '2016-01-28 09:23:09', 3, 120.5, 'business'),
('P017', 'alfred@gmail.com', 'V004', '2016-01-28 09:23:37', 4, 60.5, 'economy'),
('P018', 'alfred@gmail.com', 'V019', '2016-01-28 09:23:58', 4, 78.5, 'business'),
('P019', 'alfred@gmail.com', 'V016', '2016-01-28 09:25:14', 4, 136.5, 'prima'),
('P020', 'alfred@gmail.com', 'V024', '2016-01-28 09:25:35', 1, 99.5, 'economy'),
('P021', 'marco@gmail.com', 'V014', '2016-01-28 09:26:39', 3, 149.5, 'business'),
('P022', 'marco@gmail.com', 'V012', '2016-01-28 09:26:58', 3, 130, 'business'),
('P023', 'marco@gmail.com', 'V030', '2016-01-28 09:27:27', 3, 185.5, 'economy'),
('P024', 'marco@gmail.com', 'V013', '2016-01-28 09:27:49', 4, 150, 'business'),
('P025', 'marco@gmail.com', 'V004', '2016-01-28 09:28:15', 1, 80.5, 'business'),
('P026', 'marco@gmail.com', 'V044', '2016-01-28 09:28:36', 4, 129.5, 'economy'),
('P027', 'liukdof@gmail.com', 'V044', '2016-01-28 09:29:10', 5, 149.5, 'business'),
('P028', 'liukdof@gmail.com', 'V031', '2016-01-28 09:29:33', 2, 145, 'prima'),
('P029', 'liukdof@gmail.com', 'V004', '2016-01-28 09:29:49', 2, 60.5, 'economy'),
('P030', 'liukdof@gmail.com', 'V033', '2016-01-28 09:30:09', 4, 150, 'economy'),
('P031', 'liukdof@gmail.com', 'V051', '2016-01-28 09:30:27', 4, 123, 'business'),
('P032', 'liukdof@gmail.com', 'V054', '2016-01-28 09:30:47', 4, 119.5, 'business'),
('P033', 'marta@gmail.com', 'V004', '2016-01-28 09:31:20', 5, 60.5, 'economy'),
('P034', 'marta@gmail.com', 'V037', '2016-01-28 09:31:43', 3, 110.5, 'business'),
('P035', 'marta@gmail.com', 'V027', '2016-01-28 09:32:03', 4, 220.5, 'business'),
('P036', 'marta@gmail.com', 'V020', '2016-01-28 09:32:24', 2, 114, 'economy'),
('P037', 'marta@gmail.com', 'V032', '2016-01-28 09:32:41', 5, 82.5, 'economy'),
('P038', 'lucy@gmail.com', 'V032', '2016-01-28 09:33:15', 4, 102.5, 'business'),
('P039', 'lucy@gmail.com', 'V004', '2016-01-28 09:33:34', 4, 80.5, 'business'),
('P040', 'lucy@gmail.com', 'V027', '2016-01-28 09:34:04', 4, 220.5, 'business'),
('P041', 'lucy@gmail.com', 'V007', '2016-01-28 09:34:17', 1, 140.5, 'prima'),
('P042', 'lucy@gmail.com', 'V014', '2016-01-28 09:34:35', 4, 149.5, 'business'),
('P043', 'pimpinea@gmail.com', 'V019', '2016-01-28 09:35:10', 4, 78.5, 'business'),
('P044', 'pimpinea@gmail.com', 'V032', '2016-01-28 09:35:24', 4, 132.5, 'prima'),
('P045', 'pimpinea@gmail.com', 'V024', '2016-01-28 09:35:37', 1, 149.5, 'prima'),
('P046', 'pimpinea@gmail.com', 'V021', '2016-01-28 09:35:56', 2, 123, 'business'),
('P047', 'pimpinea@gmail.com', 'V012', '2016-01-28 09:36:18', 1, 110, 'economy'),
('P048', 'pimpinea@gmail.com', 'V001', '2016-01-28 09:36:36', 2, 145, 'prima'),
('P049', 'maria@gmail.com', 'V005', '2016-01-28 09:37:21', 4, 93, 'business'),
('P050', 'maria@gmail.com', 'V007', '2016-01-28 09:37:53', 4, 110.5, 'business'),
('P051', 'maria@gmail.com', 'V003', '2016-01-28 09:38:20', 4, 170, 'business'),
('P052', 'maria@gmail.com', 'V032', '2016-01-28 09:38:36', 1, 82.5, 'economy'),
('P053', 'maria@gmail.com', 'V021', '2016-01-28 09:38:50', 1, 153, 'prima'),
('P054', 'maria@gmail.com', 'V004', '2016-01-28 09:39:05', 1, 80.5, 'business'),
('P055', 'maria@gmail.com', 'V015', '2016-01-28 09:39:29', 2, 68, 'business'),
('P056', 'bareoto@gmail.com', 'V012', '2016-01-28 09:40:08', 3, 160, 'prima'),
('P057', 'bareoto@gmail.com', 'V008', '2016-01-28 09:41:00', 1, 775.5, 'business'),
('P058', 'bareoto@gmail.com', 'V029', '2016-01-28 09:41:25', 2, 754, 'business'),
('P059', 'bareoto@gmail.com', 'V002', '2016-01-28 09:41:45', 3, 82.5, 'economy'),
('P060', 'antonio@gmail.com', 'V021', '2016-01-28 09:42:43', 4, 123, 'business'),
('P061', 'antonio@gmail.com', 'V032', '2016-01-28 09:42:57', 2, 132.5, 'prima'),
('P062', 'antonio@gmail.com', 'V004', '2016-01-28 09:43:14', 5, 60.5, 'economy'),
('P063', 'antonio@gmail.com', 'V007', '2016-01-28 09:43:38', 5, 110.5, 'business'),
('P064', 'antonio@gmail.com', 'V003', '2016-01-28 09:44:08', 3, 170, 'business'),
('P065', 'antonio@gmail.com', 'V005', '2016-01-28 09:44:27', 1, 73, 'economy'),
('P066', 'cliente@gmail.com', 'V092', '2016-01-28 10:06:46', 3, 110.5, 'business'),
('P067', 'cliente@gmail.com', 'V104', '2016-01-28 10:07:16', 5, 113.5, 'economy'),
('P068', 'cliente@gmail.com', 'V120', '2016-01-28 10:07:44', 2, 192.5, 'business'),
('P069', 'antonio@gmail.com', 'V110', '2016-01-28 10:08:43', 3, 110, 'economy'),
('P070', 'antonio@gmail.com', 'V101', '2016-01-28 10:09:06', 1, 128, 'business'),
('P071', 'antonio@gmail.com', 'V101', '2016-01-28 10:15:51', 1, 157, 'prima'),
('P072', 'marta@gmail.com', 'V087', '2016-01-28 10:16:24', 4, 201.5, 'economy'),
('P073', 'lucy@gmail.com', 'V085', '2016-01-28 10:17:08', 3, 56, 'economy'),
('P074', 'liukdof@gmail.com', 'V081', '2016-01-28 10:18:04', 4, 105, 'economy');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
CREATE TABLE IF NOT EXISTS `utente` (
  `mail` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cognome` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nome` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `dataNascita` date NOT NULL,
  `telefono` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`mail`),
  UNIQUE KEY `telefono` (`telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`mail`, `password`, `cognome`, `nome`, `dataNascita`, `telefono`, `admin`) VALUES
('admin@gmail.com', 'admin', 'Rossi', 'Paolo', '1980-03-11', '3339786534', 1),
('alfred@gmail.com', '123456', 'Algelo', 'Alfredo', '1974-06-19', '3345675564', 0),
('antonio@gmail.com', '123456', 'Lesso', 'Antonio', '1974-11-27', '3495673485', 0),
('bareoto@gmail.com', '123456', 'Barea', 'Gianni', '1966-05-14', '3314556784', 0),
('cliente@gmail.com', '123456', 'Prova', 'Francesco', '1990-06-10', '3339394253', 0),
('liukdof@gmail.com', '123456', 'Doffi', 'Luca', '1979-10-22', '3475644531', 0),
('lucy@gmail.com', '123456', 'Borgia', 'Lucrezia', '1976-07-12', '3465123875', 0),
('marco@gmail.com', '123456', 'Freddo', 'Marco', '1988-10-16', '3478945614', 0),
('maria@gmail.com', '123456', 'Lupetto', 'Maria', '1992-02-28', '3485673485', 0),
('marta@gmail.com', '123456', 'Draghi', 'Marta', '1995-06-10', '3475672338', 0),
('niknik@gmail.com', '123456', 'Dilernia', 'Nicola', '1994-03-18', '3465683475', 0),
('pimpinea@gmail.com', '123456', 'Maroni', 'Mario', '1986-12-11', '3335674553', 0);

-- --------------------------------------------------------

--
-- Table structure for table `viaggia`
--

DROP TABLE IF EXISTS `viaggia`;
CREATE TABLE IF NOT EXISTS `viaggia` (
  `codAereo` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `codAeroporto` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`codAereo`,`codAeroporto`),
  KEY `codAeroporto` (`codAeroporto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `viaggia`
--

INSERT INTO `viaggia` (`codAereo`, `codAeroporto`) VALUES
('A005', 'ALC'),
('A003', 'AMS'),
('A004', 'AMS'),
('A005', 'AMS'),
('A001', 'ATH'),
('A002', 'BCN'),
('A002', 'BLQ'),
('A005', 'BLQ'),
('A006', 'BLQ'),
('A001', 'BRU'),
('A005', 'BRU'),
('A006', 'BRU'),
('A003', 'BVA'),
('A001', 'CDG'),
('A002', 'CDG'),
('A004', 'CDG'),
('A003', 'FCO'),
('A005', 'FCO'),
('A001', 'FRA'),
('A002', 'FRA'),
('A006', 'FRA'),
('A001', 'HEL'),
('A002', 'HND'),
('A002', 'IAH'),
('A006', 'IAH'),
('A004', 'IBZ'),
('A005', 'IBZ'),
('A001', 'JFK'),
('A003', 'JFK'),
('A006', 'JFK'),
('A002', 'LAX'),
('A001', 'LED'),
('A003', 'LED'),
('A006', 'LGW'),
('A004', 'LHR'),
('A005', 'LHR'),
('A002', 'LIN'),
('A003', 'LIN'),
('A003', 'MAD'),
('A003', 'MUC'),
('A004', 'MUC'),
('A001', 'MXP'),
('A004', 'MXP'),
('A004', 'PMI'),
('A006', 'PVG'),
('A006', 'SIN'),
('A001', 'STN'),
('A005', 'STN'),
('A006', 'TXL'),
('A001', 'VCE'),
('A004', 'VCE'),
('A005', 'VCE');

-- --------------------------------------------------------

--
-- Table structure for table `volo`
--

DROP TABLE IF EXISTS `volo`;
CREATE TABLE IF NOT EXISTS `volo` (
  `idVolo` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `aeroportoPartenza` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `aeroportoArrivo` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `idAereoVolo` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `dataPartenza` datetime NOT NULL,
  `costo` double NOT NULL,
  `durataTratta` time NOT NULL,
  PRIMARY KEY (`idVolo`),
  KEY `aeroportoPartenza` (`aeroportoPartenza`),
  KEY `aeroportoArrivo` (`aeroportoArrivo`),
  KEY `idAereoVolo` (`idAereoVolo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `volo`
--

INSERT INTO `volo` (`idVolo`, `aeroportoPartenza`, `aeroportoArrivo`, `idAereoVolo`, `dataPartenza`, `costo`, `durataTratta`) VALUES
('V001', 'MXP', 'CDG', 'A001', '2016-02-02 11:30:00', 95, '02:00:00'),
('V002', 'STN', 'VCE', 'A001', '2016-02-03 08:15:00', 82.5, '01:20:00'),
('V003', 'BRU', 'ATH', 'A001', '2016-02-04 10:00:00', 150, '02:50:00'),
('V004', 'BLQ', 'BCN', 'A002', '2016-02-05 18:30:00', 60.5, '01:50:00'),
('V005', 'LIN', 'FRA', 'A002', '2016-02-06 14:45:00', 73, '02:30:00'),
('V006', 'LAX', 'HND', 'A002', '2016-02-07 09:30:00', 84, '09:40:00'),
('V007', 'MAD', 'MUC', 'A003', '2016-02-08 12:00:00', 90.5, '03:10:00'),
('V008', 'LED', 'JFK', 'A003', '2016-02-09 20:15:00', 755.5, '10:20:00'),
('V009', 'FCO', 'BVA', 'A003', '2016-02-10 19:00:00', 97, '02:55:00'),
('V010', 'AMS', 'CDG', 'A004', '2016-02-11 16:45:00', 100.5, '01:00:00'),
('V011', 'VCE', 'PMI', 'A004', '2016-02-12 22:30:00', 121, '01:30:00'),
('V012', 'MXP', 'LHR', 'A004', '2016-02-02 06:00:00', 110, '03:30:00'),
('V013', 'BLQ', 'AMS', 'A005', '2016-02-03 07:45:00', 130, '02:10:00'),
('V014', 'IBZ', 'VCE', 'A005', '2016-02-04 22:15:00', 129.5, '02:20:00'),
('V015', 'BRU', 'ALC', 'A005', '2016-02-05 21:30:00', 48, '01:45:00'),
('V016', 'FRA', 'PVG', 'A006', '2016-02-06 18:45:00', 86.5, '01:50:00'),
('V017', 'TXL', 'LGW', 'A006', '2016-02-07 15:30:00', 91.5, '02:15:00'),
('V018', 'IAH', 'JFK', 'A006', '2016-02-08 15:45:00', 866, '08:40:00'),
('V019', 'HEL', 'FRA', 'A001', '2016-02-09 11:00:00', 58.5, '02:30:00'),
('V020', 'CDG', 'BCN', 'A002', '2016-02-10 13:15:00', 114, '01:50:00'),
('V021', 'LIN', 'MAD', 'A003', '2016-02-11 09:00:00', 103, '03:00:00'),
('V022', 'VCE', 'MUC', 'A004', '2016-02-12 16:30:00', 77, '01:55:00'),
('V023', 'BLQ', 'LHR', 'A005', '2016-02-02 20:15:00', 88.5, '02:10:00'),
('V024', 'BLQ', 'BRU', 'A006', '2016-02-03 19:00:00', 99.5, '02:35:00'),
('V025', 'FCO', 'STN', 'A005', '2016-02-04 17:15:00', 64, '02:20:00'),
('V026', 'MXP', 'IBZ', 'A004', '2016-02-05 12:30:00', 152, '02:00:00'),
('V027', 'FCO', 'AMS', 'A003', '2016-02-06 10:15:00', 200.5, '02:55:00'),
('V028', 'HND', 'IAH', 'A002', '2016-02-07 21:45:00', 180, '03:20:00'),
('V029', 'JFK', 'LED', 'A001', '2016-02-08 23:00:00', 734, '09:25:00'),
('V030', 'SIN', 'FRA', 'A006', '2016-02-09 14:30:00', 185.5, '05:05:00'),
('V031', 'CDG', 'MXP', 'A001', '2016-02-05 11:30:00', 95, '02:00:00'),
('V032', 'VCE', 'STN', 'A001', '2016-02-07 08:15:00', 82.5, '01:20:00'),
('V033', 'ATH', 'BRU', 'A001', '2016-02-08 10:00:00', 150, '02:50:00'),
('V034', 'BCN', 'BLQ', 'A002', '2016-02-11 18:30:00', 60.5, '01:50:00'),
('V035', 'FRA', 'LIN', 'A002', '2016-02-10 14:45:00', 73, '02:30:00'),
('V036', 'HND', 'LAX', 'A002', '2016-02-15 09:30:00', 84, '09:40:00'),
('V037', 'MUC', 'MAD', 'A003', '2016-02-14 12:00:00', 90.5, '03:10:00'),
('V038', 'JFK', 'LAX', 'A003', '2016-02-16 20:15:00', 755.5, '10:20:00'),
('V039', 'BVA', 'FCO', 'A003', '2016-02-17 19:00:00', 97, '02:55:00'),
('V040', 'CDG', 'AMS', 'A004', '2016-02-15 16:45:00', 100.5, '01:00:00'),
('V041', 'PMI', 'VCE', 'A004', '2016-02-20 22:30:00', 121, '01:30:00'),
('V042', 'LHR', 'MXP', 'A004', '2016-02-10 06:00:00', 110, '03:30:00'),
('V043', 'AMS', 'BLQ', 'A005', '2016-02-10 07:45:00', 130, '02:10:00'),
('V044', 'VCE', 'IBZ', 'A005', '2016-02-08 22:15:00', 129.5, '02:20:00'),
('V045', 'ALC', 'BRU', 'A005', '2016-02-11 21:30:00', 48, '01:45:00'),
('V046', 'PVG', 'FRA', 'A006', '2016-02-14 18:45:00', 86.5, '01:50:00'),
('V047', 'LGW', 'TXL', 'A006', '2016-02-14 15:30:00', 91.5, '02:15:00'),
('V048', 'JFK', 'IAH', 'A006', '2016-02-11 15:45:00', 866, '08:40:00'),
('V049', 'FRA', 'HEL', 'A001', '2016-02-20 11:00:00', 58.5, '02:30:00'),
('V050', 'BCN', 'CDG', 'A002', '2016-02-17 13:15:00', 114, '01:50:00'),
('V051', 'MAD', 'LIN', 'A003', '2016-02-18 09:00:00', 103, '03:00:00'),
('V052', 'MUC', 'VCE', 'A004', '2016-02-20 16:30:00', 77, '01:55:00'),
('V053', 'LHR', 'BLQ', 'A005', '2016-02-09 20:15:00', 88.5, '02:10:00'),
('V054', 'BRU', 'BLQ', 'A006', '2016-02-10 19:00:00', 99.5, '02:35:00'),
('V055', 'STN', 'FCO', 'A001', '2016-02-10 17:15:00', 64, '02:20:00'),
('V056', 'IBZ', 'MXP', 'A002', '2016-02-12 12:30:00', 152, '02:00:00'),
('V057', 'AMS', 'FCO', 'A003', '2016-02-13 10:15:00', 200.5, '02:55:00'),
('V058', 'IAH', 'HND', 'A004', '2016-02-14 21:45:00', 180, '03:20:00'),
('V059', 'LED', 'JFK', 'A005', '2016-02-15 23:00:00', 734, '09:25:00'),
('V060', 'FRA', 'SIN', 'A006', '2016-02-16 14:30:00', 185.5, '05:05:00'),
('V061', 'MXP', 'CDG', 'A001', '2016-02-13 08:30:00', 82, '02:00:00'),
('V062', 'STN', 'VCE', 'A001', '2016-02-14 11:15:00', 95.5, '01:20:00'),
('V063', 'BRU', 'ATH', 'A001', '2016-02-15 18:00:00', 124, '02:50:00'),
('V064', 'BLQ', 'BCN', 'A002', '2016-02-16 10:30:00', 71.5, '01:50:00'),
('V065', 'LIN', 'FRA', 'A002', '2016-02-17 09:45:00', 65, '02:30:00'),
('V066', 'LAX', 'HND', 'A002', '2016-02-18 14:30:00', 97, '09:40:00'),
('V067', 'MAD', 'MUC', 'A003', '2016-02-19 20:00:00', 80.5, '03:10:00'),
('V068', 'LED', 'JFK', 'A003', '2016-02-20 12:15:00', 800.5, '10:20:00'),
('V069', 'FCO', 'BVA', 'A003', '2016-02-21 16:00:00', 90, '02:55:00'),
('V070', 'AMS', 'CDG', 'A004', '2016-02-22 19:45:00', 92.5, '01:00:00'),
('V071', 'VCE', 'PMI', 'A004', '2016-02-23 06:30:00', 110, '01:30:00'),
('V072', 'MXP', 'LHR', 'A004', '2016-02-13 22:00:00', 134, '03:30:00'),
('V073', 'BLQ', 'AMS', 'A005', '2016-02-14 22:45:00', 157, '02:10:00'),
('V074', 'IBZ', 'VCE', 'A005', '2016-02-15 07:15:00', 114.5, '02:20:00'),
('V075', 'BRU', 'ALC', 'A005', '2016-02-16 18:30:00', 60, '01:45:00'),
('V076', 'FRA', 'PVG', 'A006', '2016-02-17 21:45:00', 98.5, '01:50:00'),
('V077', 'TXL', 'LGW', 'A006', '2016-02-18 18:30:00', 93.5, '02:15:00'),
('V078', 'IAH', 'JFK', 'A006', '2016-02-19 09:45:00', 822, '08:40:00'),
('V079', 'HEL', 'FRA', 'A001', '2016-02-20 13:00:00', 71.5, '02:30:00'),
('V080', 'CDG', 'BCN', 'A002', '2016-02-21 11:15:00', 120, '01:50:00'),
('V081', 'LIN', 'MAD', 'A003', '2016-02-22 16:00:00', 110, '03:00:00'),
('V082', 'VCE', 'MUC', 'A004', '2016-02-23 09:30:00', 81, '01:55:00'),
('V083', 'BLQ', 'LHR', 'A005', '2016-02-13 19:15:00', 101.5, '02:10:00'),
('V084', 'BLQ', 'BRU', 'A006', '2016-02-14 20:00:00', 116.5, '02:35:00'),
('V085', 'FCO', 'STN', 'A005', '2016-02-15 12:15:00', 60, '02:20:00'),
('V086', 'MXP', 'IBZ', 'A004', '2016-02-16 17:30:00', 129, '02:00:00'),
('V087', 'FCO', 'AMS', 'A003', '2016-02-17 21:15:00', 210.5, '02:55:00'),
('V088', 'HND', 'IAH', 'A002', '2016-02-18 10:45:00', 194, '03:20:00'),
('V089', 'JFK', 'LED', 'A001', '2016-02-19 14:00:00', 750, '09:25:00'),
('V090', 'SIN', 'FRA', 'A006', '2016-02-20 23:30:00', 175.5, '05:05:00'),
('V091', 'CDG', 'MXP', 'A001', '2016-02-13 08:30:00', 82, '02:00:00'),
('V092', 'VCE', 'STN', 'A001', '2016-02-14 11:15:00', 95.5, '01:20:00'),
('V093', 'ATH', 'BRU', 'A001', '2016-02-15 18:00:00', 124, '02:50:00'),
('V094', 'BCN', 'BLQ', 'A002', '2016-02-16 10:30:00', 71.5, '01:50:00'),
('V095', 'FRA', 'LIN', 'A002', '2016-02-17 09:45:00', 65, '02:30:00'),
('V096', 'HND', 'LAX', 'A002', '2016-02-18 14:30:00', 97, '09:40:00'),
('V097', 'MUC', 'MAD', 'A003', '2016-02-19 20:00:00', 80.5, '03:10:00'),
('V098', 'JFK', 'LED', 'A003', '2016-02-20 12:15:00', 800.5, '10:20:00'),
('V099', 'BVA', 'FCO', 'A003', '2016-02-21 16:00:00', 90, '02:55:00'),
('V100', 'CDG', 'AMS', 'A004', '2016-02-22 19:45:00', 92.5, '01:00:00'),
('V101', 'PMI', 'VCE', 'A004', '2016-02-23 06:30:00', 110, '01:30:00'),
('V102', 'LHR', 'MXP', 'A004', '2016-02-13 22:00:00', 134, '03:30:00'),
('V103', 'AMS', 'BLQ', 'A005', '2016-02-14 22:45:00', 157, '02:10:00'),
('V104', 'VCE', 'IBZ', 'A005', '2016-02-15 07:15:00', 114.5, '02:20:00'),
('V105', 'ALC', 'BRU', 'A005', '2016-02-16 18:30:00', 60, '01:45:00'),
('V106', 'PVG', 'FRA', 'A006', '2016-02-17 21:45:00', 98.5, '01:50:00'),
('V107', 'LGW', 'TXL', 'A006', '2016-02-18 18:30:00', 93.5, '02:15:00'),
('V108', 'JFK', 'IAH', 'A006', '2016-02-19 09:45:00', 822, '08:40:00'),
('V109', 'FRA', 'HEL', 'A001', '2016-02-20 13:00:00', 71.5, '02:30:00'),
('V110', 'BCN', 'CDG', 'A002', '2016-02-21 11:15:00', 120, '01:50:00'),
('V111', 'MAD', 'LIN', 'A003', '2016-02-22 16:00:00', 110, '03:00:00'),
('V112', 'MUC', 'VCE', 'A004', '2016-02-23 09:30:00', 81, '01:55:00'),
('V113', 'LHR', 'BLQ', 'A005', '2016-02-13 19:15:00', 101.5, '02:10:00'),
('V114', 'BRU', 'BLQ', 'A006', '2016-02-14 20:00:00', 116.5, '02:35:00'),
('V115', 'STN', 'FCO', 'A005', '2016-02-15 12:15:00', 60, '02:20:00'),
('V116', 'IBZ', 'MXP', 'A004', '2016-02-16 17:30:00', 129, '02:00:00'),
('V117', 'AMS', 'FCO', 'A003', '2016-02-17 21:15:00', 210.5, '02:55:00'),
('V118', 'IAH', 'HND', 'A002', '2016-02-18 10:45:00', 194, '03:20:00'),
('V119', 'LED', 'JFK', 'A001', '2016-02-19 14:00:00', 750, '09:25:00'),
('V120', 'FRA', 'SIN', 'A006', '2016-02-20 23:30:00', 175.5, '05:05:00'),
('V121', 'BLQ', 'CDG', 'A003', '2016-02-02 08:30:00', 72, '01:15:00'),
('V122', 'BLQ', 'ATH', 'A003', '2016-02-03 11:15:00', 80.5, '01:25:00'),
('V123', 'VCE', 'AMS', 'A003', '2016-02-04 18:00:00', 55, '02:00:00'),
('V124', 'VCE', 'PMI', 'A004', '2016-02-05 10:30:00', 65.5, '01:50:00'),
('V125', 'VCE', 'LHR', 'A004', '2016-02-06 09:45:00', 74, '02:30:00'),
('V126', 'VCE', 'FRA', 'A004', '2016-02-07 14:30:00', 162, '01:40:00'),
('V127', 'FCO', 'BCN', 'A005', '2016-02-08 20:00:00', 72.5, '03:10:00'),
('V128', 'FCO', 'MAD', 'A005', '2016-02-09 12:15:00', 101.5, '02:20:00'),
('V129', 'VCE', 'FCO', 'A005', '2016-02-10 16:00:00', 84, '02:55:00'),
('V130', 'SIN', 'OPO', 'A006', '2016-02-11 19:45:00', 200.5, '01:00:00'),
('V131', 'TXL', 'AMS', 'A006', '2016-02-12 06:30:00', 142, '01:30:00'),
('V132', 'LIN', 'FRA', 'A006', '2016-02-13 22:00:00', 121, '03:30:00'),
('V133', 'LIN', 'BVA', 'A001', '2016-02-14 22:45:00', 157, '02:10:00'),
('V134', 'LIN', 'BRU', 'A001', '2016-02-15 07:15:00', 104.5, '02:20:00'),
('V135', 'MXP', 'PMI', 'A001', '2016-02-16 18:30:00', 74, '01:45:00'),
('V136', 'MXP', 'SIN', 'A002', '2016-02-17 21:45:00', 247.5, '01:50:00'),
('V137', 'MXP', 'BVA', 'A002', '2016-02-18 18:30:00', 100.5, '02:15:00'),
('V138', 'MXP', 'MUC', 'A002', '2016-02-19 09:45:00', 822, '02:40:00'),
('V139', 'BLQ', 'IBZ', 'A003', '2016-02-20 13:00:00', 157.5, '02:15:00'),
('V140', 'STN', 'FRA', 'A004', '2016-02-21 11:15:00', 132, '01:50:00'),
('V141', 'STN', 'BCN', 'A005', '2016-02-22 16:00:00', 164, '02:40:00'),
('V142', 'LGW', 'HEL', 'A006', '2016-02-23 09:30:00', 97, '01:20:00'),
('V143', 'LGW', 'FRA', 'A001', '2016-02-24 19:15:00', 90.5, '02:10:00'),
('V144', 'LHR', 'MUC', 'A002', '2016-02-25 20:00:00', 128.5, '02:35:00'),
('V145', 'LHR', 'FCO', 'A003', '2016-02-26 12:15:00', 62, '02:20:00'),
('V146', 'LHR', 'VCE', 'A004', '2016-02-27 17:30:00', 110, '02:00:00'),
('V147', 'MAD', 'JFK', 'A005', '2016-02-28 21:15:00', 689.5, '10:55:00'),
('V148', 'PVG', 'SIN', 'A006', '2016-02-29 10:45:00', 263, '06:20:00'),
('V149', 'LAX', 'IAH', 'A003', '2016-02-18 09:30:00', 818, '08:25:00'),
('V150', 'IAH', 'HND', 'A001', '2016-02-06 12:55:00', 777.5, '07:05:00'),
('V151', 'CDG', 'BLQ', 'A003', '2016-02-10 08:30:00', 72.5, '01:15:00'),
('V152', 'ATH', 'BLQ', 'A003', '2016-02-11 11:15:00', 80, '01:25:00'),
('V153', 'AMS', 'VCE', 'A003', '2016-02-12 18:00:00', 55.5, '02:00:00'),
('V154', 'PMI', 'VCE', 'A004', '2016-02-13 10:30:00', 65, '01:50:00'),
('V155', 'LHR', 'VCE', 'A004', '2016-02-14 09:45:00', 74.5, '02:30:00'),
('V156', 'FRA', 'VCE', 'A004', '2016-02-15 14:30:00', 162.5, '01:40:00'),
('V157', 'BCN', 'FCO', 'A005', '2016-02-16 20:00:00', 72, '03:10:00'),
('V158', 'MAD', 'FCO', 'A005', '2016-02-17 12:15:00', 101, '02:20:00'),
('V159', 'FCO', 'VCE', 'A005', '2016-02-18 16:00:00', 84.5, '02:55:00'),
('V160', 'OPO', 'SIN', 'A006', '2016-02-19 19:45:00', 200, '01:00:00'),
('V161', 'AMS', 'TXL', 'A006', '2016-02-20 06:30:00', 142.5, '01:30:00'),
('V162', 'FRA', 'LIN', 'A006', '2016-02-21 22:00:00', 121.5, '03:30:00'),
('V163', 'BVA', 'LIN', 'A001', '2016-02-22 22:45:00', 157.5, '02:10:00'),
('V164', 'BRU', 'LIN', 'A001', '2016-02-23 07:15:00', 104, '02:20:00'),
('V165', 'PMI', 'MXP', 'A001', '2016-02-24 18:30:00', 74.5, '01:45:00'),
('V166', 'SIN', 'MXP', 'A002', '2016-02-25 21:45:00', 247, '01:50:00'),
('V167', 'BVA', 'BVA', 'A002', '2016-02-26 18:30:00', 100, '02:15:00'),
('V168', 'MXP', 'MXP', 'A002', '2016-02-27 09:45:00', 822.5, '02:40:00'),
('V169', 'IBZ', 'BLQ', 'A003', '2016-02-28 13:00:00', 157, '02:15:00'),
('V170', 'FRA', 'STN', 'A004', '2016-02-02 11:15:00', 132.5, '01:50:00'),
('V171', 'BCN', 'STN', 'A005', '2016-02-03 16:00:00', 164.5, '02:40:00'),
('V172', 'HEL', 'LGW', 'A006', '2016-02-04 09:30:00', 97.5, '01:20:00'),
('V173', 'FRA', 'LGW', 'A001', '2016-02-05 19:15:00', 90, '02:10:00'),
('V174', 'MUC', 'LHR', 'A002', '2016-02-06 20:00:00', 128, '02:35:00'),
('V175', 'FCO', 'LHR', 'A003', '2016-02-07 12:15:00', 62.5, '02:20:00'),
('V176', 'VCE', 'LHR', 'A004', '2016-02-08 17:30:00', 110.5, '02:00:00'),
('V177', 'JFK', 'MAD', 'A005', '2016-02-09 21:15:00', 689, '10:55:00'),
('V178', 'SIN', 'PVG', 'A006', '2016-02-29 10:45:00', 263.5, '06:20:00'),
('V179', 'IAH', 'LAX', 'A003', '2016-02-07 14:00:00', 818.5, '08:25:00'),
('V180', 'HND', 'IAH', 'A001', '2016-02-14 23:30:00', 777, '07:05:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carta`
--
ALTER TABLE `carta`
  ADD CONSTRAINT `carta_ibfk_1` FOREIGN KEY (`mailUtente`) REFERENCES `utente` (`mail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`mailUtente`) REFERENCES `utente` (`mail`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`idVoloPren`) REFERENCES `volo` (`idVolo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `viaggia`
--
ALTER TABLE `viaggia`
  ADD CONSTRAINT `viaggia_ibfk_1` FOREIGN KEY (`codAereo`) REFERENCES `aereo` (`idAereo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viaggia_ibfk_2` FOREIGN KEY (`codAeroporto`) REFERENCES `aeroporto` (`codiceAeroporto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volo`
--
ALTER TABLE `volo`
  ADD CONSTRAINT `volo_ibfk_1` FOREIGN KEY (`aeroportoPartenza`) REFERENCES `aeroporto` (`codiceAeroporto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volo_ibfk_2` FOREIGN KEY (`aeroportoArrivo`) REFERENCES `aeroporto` (`codiceAeroporto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volo_ibfk_3` FOREIGN KEY (`idAereoVolo`) REFERENCES `aereo` (`idAereo`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `aggiungiCarta`$$
CREATE DEFINER=`dscarpar`@`localhost` PROCEDURE `aggiungiCarta`(IN cod varchar(10), IN utente varchar(20))
BEGIN
INSERT INTO carta VALUES(cod,utente,0);
END$$

DROP PROCEDURE IF EXISTS `aggiungiViaggia`$$
CREATE DEFINER=`dscarpar`@`localhost` PROCEDURE `aggiungiViaggia`(IN codAereo varchar(10), IN codAeroporto
varchar(10))
BEGIN
INSERT INTO viaggia VALUES(codAereo,codAeroporto);
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `booked`$$
CREATE DEFINER=`dscarpar`@`localhost` FUNCTION `booked`(x varchar(40)) RETURNS tinyint(1)
BEGIN
DECLARE pren BOOLEAN;
SET pren=false;
IF(x IN (SELECT mailUtente FROM prenotazione))
THEN SET pren=true;
END IF;
RETURN pren;
END$$

DROP FUNCTION IF EXISTS `fasciaVoli`$$
CREATE DEFINER=`dscarpar`@`localhost` FUNCTION `fasciaVoli`(x double) RETURNS int(11)
BEGIN
DECLARE numVoli int;
SELECT COUNT(*) INTO numVoli
FROM volo
WHERE costo<x;
RETURN numVoli;
END$$

DROP FUNCTION IF EXISTS `importoTotaleCliente`$$
CREATE DEFINER=`dscarpar`@`localhost` FUNCTION `importoTotaleCliente`(cliente varchar(40)) RETURNS int(11)
BEGIN
DECLARE tot int;
SELECT SUM(costoBiglietto*numeroBiglietti) INTO tot
FROM prenotazione
WHERE mailUtente=cliente;
RETURN tot;
END$$

DROP FUNCTION IF EXISTS `numClienti`$$
CREATE DEFINER=`dscarpar`@`localhost` FUNCTION `numClienti`() RETURNS int(11)
BEGIN
DECLARE numClienti int;
SELECT COUNT(*) INTO numClienti
FROM utente
WHERE admin='0';
RETURN numClienti;
END$$

DELIMITER ;
