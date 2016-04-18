-- --------------------------------------------------------
-- Host:                         192.168.0.117
-- Server version:               5.5.42 - MySQL Community Server (GPL) by Remi
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.5072
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_snippet
DROP DATABASE IF EXISTS `db_snippet`;
CREATE DATABASE IF NOT EXISTS `db_snippet` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_snippet`;

-- Dumping structure for table db_snippet.TB_DIRECTORY
DROP TABLE IF EXISTS `TB_DIRECTORY`;
CREATE TABLE IF NOT EXISTS `TB_DIRECTORY` (
  `ID_DIRECTORY` int(10) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(10) NOT NULL DEFAULT '0',
  `DIR_NAME` varchar(100) DEFAULT '0',
  `DIR_DESCRIPTION` varchar(500) DEFAULT NULL,
  `DIR_STATUS` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_DIRECTORY`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.TB_DIRECTORY: ~0 rows (approximately)
DELETE FROM `TB_DIRECTORY`;
/*!40000 ALTER TABLE `TB_DIRECTORY` DISABLE KEYS */;
INSERT INTO `TB_DIRECTORY` (`ID_DIRECTORY`, `ID_USER`, `DIR_NAME`, `DIR_DESCRIPTION`, `DIR_STATUS`) VALUES
	(1, 1, 'Javascript', '', 'ACTIVE'),
	(2, 2, 'Others', '', 'ACTIVE');
/*!40000 ALTER TABLE `TB_DIRECTORY` ENABLE KEYS */;

-- Dumping structure for table db_snippet.TB_SHARED_SNIPPETS
DROP TABLE IF EXISTS `TB_SHARED_SNIPPETS`;
CREATE TABLE IF NOT EXISTS `TB_SHARED_SNIPPETS` (
  `ID_SHARED_SNIPPET` int(10) NOT NULL AUTO_INCREMENT,
  `ID_USER_FROM` int(10) NOT NULL DEFAULT '0',
  `ID_USER_TO` int(10) NOT NULL DEFAULT '0',
  `ID_SNIPPET` int(10) NOT NULL DEFAULT '0',
  `SHS_DATE` datetime DEFAULT NULL,
  `SHS_STATUS` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_SHARED_SNIPPET`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.TB_SHARED_SNIPPETS: ~0 rows (approximately)
DELETE FROM `TB_SHARED_SNIPPETS`;
/*!40000 ALTER TABLE `TB_SHARED_SNIPPETS` DISABLE KEYS */;
INSERT INTO `TB_SHARED_SNIPPETS` (`ID_SHARED_SNIPPET`, `ID_USER_FROM`, `ID_USER_TO`, `ID_SNIPPET`, `SHS_DATE`, `SHS_STATUS`) VALUES
	(1, 1, 2, 1, '2016-04-18 19:35:03', 'ACTIVE'),
	(2, 2, 1, 2, '2016-04-18 19:42:58', 'ACTIVE');
/*!40000 ALTER TABLE `TB_SHARED_SNIPPETS` ENABLE KEYS */;

-- Dumping structure for table db_snippet.TB_SNIPPET
DROP TABLE IF EXISTS `TB_SNIPPET`;
CREATE TABLE IF NOT EXISTS `TB_SNIPPET` (
  `ID_SNIPPET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DIRECTORY` int(11) NOT NULL DEFAULT '0',
  `ID_USER` int(11) NOT NULL DEFAULT '0',
  `SNI_DATE` datetime DEFAULT NULL,
  `SNI_TITLE` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `SNI_DESCRIPTION` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `SNI_LANGUAGE` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `SNI_CODE` longtext CHARACTER SET latin1,
  `SNI_STATUS` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_SNIPPET`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.TB_SNIPPET: ~0 rows (approximately)
DELETE FROM `TB_SNIPPET`;
/*!40000 ALTER TABLE `TB_SNIPPET` DISABLE KEYS */;
INSERT INTO `TB_SNIPPET` (`ID_SNIPPET`, `ID_DIRECTORY`, `ID_USER`, `SNI_DATE`, `SNI_TITLE`, `SNI_DESCRIPTION`, `SNI_LANGUAGE`, `SNI_CODE`, `SNI_STATUS`) VALUES
	(1, 1, 1, '2016-04-18 19:34:49', 'Cantidad de dias entre dos fechas', 'FunciÃ³n para obtener cantidad de dias entre dos fechas ', 'javascript', 'function getDays()\n{\n	if(getField("DepartDate").value!="" && getField("ReturnDate").value!="")\n    {\n		var date1 = getField("DepartDate").value;\n		var date2 = getField("ReturnDate").value;\n		\n		if (date1.indexOf("-") != -1) { date1 = date1.split("-"); } else if (date1.indexOf("/") != -1) { date1 = date1.split("/"); } else { return 0; }\n		if (date2.indexOf("-") != -1) { date2 = date2.split("-"); } else if (date2.indexOf("/") != -1) { date2 = date2.split("/"); } else { return 0; }\n		if (parseInt(date1[0], 10) >= 1000) {\n			var sDate = new Date(date1[0]+"/"+date1[1]+"/"+date1[2]);\n			} else if (parseInt(date1[2], 10) >= 1000) {\n			var sDate = new Date(date1[2]+"/"+date1[0]+"/"+date1[1]);\n			} else {\n			return 0;\n		}\n		if (parseInt(date2[0], 10) >= 1000) {\n			var eDate = new Date(date2[0]+"/"+date2[1]+"/"+date2[2]);\n			} else if (parseInt(date2[2], 10) >= 1000) {\n			var eDate = new Date(date2[2]+"/"+date2[0]+"/"+date2[1]);\n			} else {\n			return 0;\n		}\n		var one_day = 1000*60*60*24;\n		var daysApart = Math.abs(Math.ceil((sDate.getTime()-eDate.getTime())/one_day));\n		\n		getField("DurationDays").value = parseInt(daysApart) + 1;\n	}\n}\ngetField("DepartDate").onchange = getDays;\ngetField("ReturnDate").onchange = getDays;\n\n\n\n\n\n\n\n\n\n\n\n//SIN FINES DE SEMANA\nfunction getDays(){\n\n	if(document.getElementById("form[dateFrom]").value!="" && document.getElementById("form[dateTo]").value!="")\n    {\n		var date1 = document.getElementById("form[dateFrom]").value;\n		var date2 = document.getElementById("form[dateTo]").value;\n		\n		if (date1.indexOf("-") != -1) { date1 = date1.split("-"); } else if (date1.indexOf("/") != -1) { date1 = date1.split("/"); } else { return 0; }\n		if (date2.indexOf("-") != -1) { date2 = date2.split("-"); } else if (date2.indexOf("/") != -1) { date2 = date2.split("/"); } else { return 0; }\n		\n		var sDate = new Date(date1[0]+"/"+date1[1]+"/"+date1[2]);\n		var eDate = new Date(date2[0]+"/"+date2[1]+"/"+date2[2]);\n		\n		if(eDate >= sDate){\n			\n			var cnt = 1;\n			var oneDay = 1000*60*60*24;\n			\n			while(eDate > sDate){\n				\n				sDate.setTime(sDate.getTime()+oneDay);\n				sDate = new Date(sDate.getFullYear() + "/" + (sDate.getMonth() + 1) + "/" + sDate.getDate());\n				\n				var sd = sDate.toString().split(" ");\n				if(sd[0] != "Sat" && sd[0] != "Sun" && sd[0] != "Sab" && sd[0] != "Dom"){\n				\n					cnt++;\n				}\n				\n			}\n			\n			document.getElementById("form[absenceDays]").value = cnt;\n		}\n		else{\n		\n			alert(\'The "To Date" must be higher than "From Date"\');	\n		}\n		\n		console.log(cnt);\n\n	}\n};', 'ACTIVE'),
	(2, 2, 2, '2016-04-18 19:49:58', 'Test', 'Test', 'plain', 'test\n\n\nHHola \n3Â  ', 'ACTIVE');
/*!40000 ALTER TABLE `TB_SNIPPET` ENABLE KEYS */;

-- Dumping structure for table db_snippet.USERS
DROP TABLE IF EXISTS `USERS`;
CREATE TABLE IF NOT EXISTS `USERS` (
  `ID_USER` int(10) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(200) CHARACTER SET latin1 DEFAULT '0',
  `PASSWORD` varchar(200) CHARACTER SET latin1 DEFAULT '0',
  `FIRSTNAME` varchar(200) CHARACTER SET latin1 DEFAULT '0',
  `LASTNAME` varchar(200) CHARACTER SET latin1 DEFAULT '0',
  `EMAIL` varchar(200) CHARACTER SET latin1 DEFAULT '0',
  `STATUS` varchar(200) CHARACTER SET latin1 DEFAULT '0',
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.USERS: ~2 rows (approximately)
DELETE FROM `USERS`;
/*!40000 ALTER TABLE `USERS` DISABLE KEYS */;
INSERT INTO `USERS` (`ID_USER`, `USERNAME`, `PASSWORD`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `STATUS`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '', 'luis@processmaker.com', 'ACTIVE'),
	(2, 'administrator', '5e8ff9bf55ba3508199d22e984129be6', 'Administrator', '', 'luis@processmaker.com', 'ACTIVE');
/*!40000 ALTER TABLE `USERS` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
