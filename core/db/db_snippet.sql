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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.TB_DIRECTORY: ~5 rows (approximately)
DELETE FROM `TB_DIRECTORY`;
/*!40000 ALTER TABLE `TB_DIRECTORY` DISABLE KEYS */;
INSERT INTO `TB_DIRECTORY` (`ID_DIRECTORY`, `ID_USER`, `DIR_NAME`, `DIR_DESCRIPTION`, `DIR_STATUS`) VALUES
	(1, 1, 'PHP', '', 'ACTIVE'),
	(2, 1, 'Javascript', 'asd', 'ACTIVE'),
	(3, 1, 'Others', '', 'ACTIVE'),
	(4, 2, 'PAULDIR', '', 'ACTIVE'),
	(5, 1, 'great', '', 'ACTIVE');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.TB_SHARED_SNIPPETS: ~4 rows (approximately)
DELETE FROM `TB_SHARED_SNIPPETS`;
/*!40000 ALTER TABLE `TB_SHARED_SNIPPETS` DISABLE KEYS */;
INSERT INTO `TB_SHARED_SNIPPETS` (`ID_SHARED_SNIPPET`, `ID_USER_FROM`, `ID_USER_TO`, `ID_SNIPPET`, `SHS_DATE`, `SHS_STATUS`) VALUES
	(1, 2, 1, 4, '2016-03-31 00:00:00', 'ACTIVE'),
	(2, 1, 2, 1, '2016-03-21 00:00:00', 'ACTIVE'),
	(3, 2, 1, 5, '2016-03-11 00:00:00', 'ACTIVE'),
	(4, 2, 1, 4, '2016-03-01 00:00:00', 'ACTIVE');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.TB_SNIPPET: ~19 rows (approximately)
DELETE FROM `TB_SNIPPET`;
/*!40000 ALTER TABLE `TB_SNIPPET` DISABLE KEYS */;
INSERT INTO `TB_SNIPPET` (`ID_SNIPPET`, `ID_DIRECTORY`, `ID_USER`, `SNI_DATE`, `SNI_TITLE`, `SNI_DESCRIPTION`, `SNI_LANGUAGE`, `SNI_CODE`, `SNI_STATUS`) VALUES
	(1, 1, 1, '2016-03-31 19:13:00', 'Add variables on web entry', 'asd', 'php', '<?\n$a = new pmDynaform(array("CURRENT_DYNAFORM" => "84180149456ddd2194664d6061317361", "APP_DATA" => array("Email" => $_REQUEST[\'email\'])));\n', 'ACTIVE'),
	(2, 1, 1, '2016-03-22 18:40:12', 'Crear usuarios con trigger PM', 'Script para crear usuarios desde un trigger en proceso', 'php', '<?\n	\n	//***********************************\n	//******* CREATE GROUPS ********\n	//***********************************\n	\n	require_once \'classes/model/Groupwf.php\';\n	\n	$groups = array(\n	\n	"1" => array(\n	"groupName" => "test1"\n	),\n	"2" => array(\n	"groupName" => "test2"\n	),\n	"3" => array(\n	"groupName" => "test3"\n	)\n	);\n	\n	$i = 0;\n	foreach($groups as $row)\n	{\n		$sqlSgroup = "SELECT *\n		FROM CONTENT C\n		WHERE C.CON_VALUE = \'".$row[\'groupName\']."\'\n		AND C.CON_CATEGORY = \'GRP_TITLE\'";\n		$resSgroup = executeQuery($sqlSgroup);\n		$conSgroup = count($resSgroup);\n		\n		if ($conSgroup == 0)\n		{\n			$newGroup[\'GRP_TITLE\'] = $row[\'groupName\'];\n			\n			$oGroup = new Groupwf();\n			$oGroup -> create( $newGroup );\n			$i++;\n		}\n		\n	}\n	\n	g::pr($i." groups have been created");\n	\n	\n	\n	\n	//***********************************\n	//******* CREATE DEPARTMENTS ********\n	//***********************************\n	\n	require_once \'classes/model/Department.php\';\n	\n	$departments = array(\n	\n	"1" => array(\n	"departmentName" => "test1"\n	),\n	"2" => array(\n	"departmentName" => "test2"\n	),\n	"3" => array(\n	"departmentName" => "test3"\n	)\n	);\n	\n	$i = 0;\n	foreach($departments as $row)\n	{\n		$sqlSdepartment = "SELECT *\n		FROM CONTENT C\n		WHERE C.CON_VALUE = \'".$row[\'departmentName\']."\'\n		AND C.CON_CATEGORY = \'DEPO_TITLE\'";\n		$resSdepartment = executeQuery($sqlSdepartment);\n		$conSdepartment = count($resSdepartment);\n		\n		if ($conSdepartment == 0)\n		{\n			$newDepartment[\'DEP_TITLE\'] = $row[\'departmentName\'];\n			\n			$oDept = new Department();\n			$oDept->create( $newDepartment );\n			$i++;\n		}\n		\n	}\n	\n	g::pr($i." departments have been created");\n	\n	\n	\n	//***********************************\n	//********* CREATE USERS ************\n	//***********************************\n	\n	$users = array(\n	\n	"1" => array(\n	"userName" => "ana",\n	"pass" => "sample",\n	"firstName" => "Ana",\n	"lastName" => "Colin",\n	"email" => "luis@colosa.com",\n	"userType" => "PROCESSMAKER_OPERATOR"\n	),\n	"2" => array(\n	"userName" => "paul",\n	"pass" => "sample",\n	"firstName" => "Paul",\n	"lastName" => "Fenix",\n	"email" => "luis@colosa.com",\n	"userType" => "PROCESSMAKER_OPERATOR"\n	),\n	"3" => array(\n	"userName" => "charlotte",\n	"pass" => "sample",\n	"firstName" => "Charlotte",\n	"lastName" => "Leo",\n	"email" => "luis@colosa.com",\n	"userType" => "PROCESSMAKER_OPERATOR"\n	)/*,\n		"4" => array(\n		"userName" => "ian",\n		"pass" => "sample",\n		"firstName" => "Ian",\n		"lastName" => "Barrett",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_ADMIN"\n		),\n		"5" => array(\n		"userName" => "adam",\n		"pass" => "sample",\n		"firstName" => "Adam",\n		"lastName" => "Williams",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"6" => array(\n		"userName" => "jeremiah",\n		"pass" => "sample",\n		"firstName" => "Jeremiah",\n		"lastName" => "Corey",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"7" => array(\n		"userName" => "juan",\n		"pass" => "sample",\n		"firstName" => "Juan",\n		"lastName" => "Talley",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"8" => array(\n		"userName" => "carter",\n		"pass" => "sample",\n		"firstName" => "Carter",\n		"lastName" => "Yourdon",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"9" => array(\n		"userName" => "julian",\n		"pass" => "sample",\n		"firstName" => "Julian",\n		"lastName" => "Dribin",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"10" => array(\n		"userName" => "jason",\n		"pass" => "sample",\n		"firstName" => "Jason",\n		"lastName" => "Hessmiller",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"11" => array(\n		"userName" => "owen",\n		"pass" => "sample",\n		"firstName" => "owen",\n		"lastName" => "Bechtel",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"12" => array(\n		"userName" => "hunter",\n		"pass" => "sample",\n		"firstName" => "Hunter",\n		"lastName" => "Brule",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"13" => array(\n		"userName" => "aaron",\n		"pass" => "sample",\n		"firstName" => "Aaron",\n		"lastName" => "Parks",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"14" => array(\n		"userName" => "arthur",\n		"pass" => "sample",\n		"firstName" => "Arthur",\n		"lastName" => "Fabel",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"15" => array(\n		"userName" => "isaiah",\n		"pass" => "sample",\n		"firstName" => "Isaiah",\n		"lastName" => "Murphy",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"16" => array(\n		"userName" => "jose",\n		"pass" => "sample",\n		"firstName" => "Jose",\n		"lastName" => "Mahoney",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"17" => array(\n		"userName" => "kevin",\n		"pass" => "sample",\n		"firstName" => "Kevin",\n		"lastName" => "Salvaggio",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"18" => array(\n		"userName" => "dylan",\n		"pass" => "sample",\n		"firstName" => "Dylan",\n		"lastName" => "Kelly",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"19" => array(\n		"userName" => "gavin",\n		"pass" => "sample",\n		"firstName" => "Gavin",\n		"lastName" => "Crowley",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		),\n		"20" => array(\n		"userName" => "brianna",\n		"pass" => "sample",\n		"firstName" => "Brianna",\n		"lastName" => "Creelman",\n		"email" => "luis@colosa.com",\n		"userType" => "PROCESSMAKER_OPERATOR"\n		)\n	*/\n	);\n	\n	\n	$i = 0;\n	foreach($users as $row)\n	{\n		$sqlSuser = "SELECT *\n		FROM USERS\n		WHERE USR_USERNAME = \'".$row[\'userName\']."\'";\n		$resSuser = executeQuery($sqlSuser);\n		$conSuser = count($resSuser);\n		\n		if ($conSuser == 0)\n		{\n			PMFCreateUser($row[\'userName\'], $row[\'pass\'], $row[\'firstName\'], $row[\'lastName\'], $row[\'email\'], $row[\'userType\']);\n			$i++;\n		}\n		\n	}\n	g::pr($i." Users have been created");\n	die;\n	\n	\n	\n	', 'ACTIVE'),
	(3, 3, 1, '2016-03-28 20:52:53', 'Dinamic URL Server ', 'URL on ProcessMaker', 'php', '<?\n\n$httpServer = (isset($_SERVER[\'HTTPS\'])) ? \'https://\' : \'http://\';\n$pathServeDocument = $httpServer.$_SERVER[\'HTTP_HOST\']."/sys".SYS_SYS."/".SYS_LANG."/".SYS_SKIN."/flashviewer/serveDocument?pathDocument=".$pathDocument;', 'ACTIVE'),
	(4, 4, 2, '2016-03-31 20:58:03', 'paul snippet', 'PAUL SNIPPETSwwwwwwwww', 'javascript', 'rtg', 'ACTIVE'),
	(5, 4, 2, '2016-03-31 18:31:54', 'TEST pm', 'sssssssss', 'php', '<?\n//Update information\n$sqlUdata = "UPDATE PMT_EMPLOYEE_ONBOARDING SET\nEMPLOYEE_STATUS = \'DISMISSED\'\nWHERE ID_ONBOARD = \'".@@selectEmployee."\'";\nexecuteQuery($sqlUdata);\n\n$from = "processmaker@processmaker.com";\n$to = @@employeeEmail;\n$subject = "Thank you for your services.";\nPMFSendMessage(@@APPLICATION, $from, $to, \'\', \'\', $subject, \'dismissedEmail.html\');', 'ACTIVE'),
	(6, 2, 1, '2016-03-31 20:25:31', 'otherwww', 'asdwww', 'javascript', 'qqqwwww', 'ACTIVE'),
	(9, 3, 1, '2016-03-31 20:50:05', 'paul snippet', 'PAUL SNIPPETS', 'javascript', 'ññññññññññ', 'ACTIVE'),
	(10, 1, 1, '2016-03-31 20:50:37', 'paul snippet', 'PAUL SNIPPETS', 'javascript', 'gggggggggg', 'ACTIVE'),
	(11, 3, 1, '2016-03-31 20:52:35', 'TEST pm', 'sssssssss', 'php', '<?\n//Update information\n$sqlUdata = "UPDATE PMT_EMPLOYEE_ONBOARDING SET\nEMPLOYEE_STATUS = \'DISMISSED\'\nWHERE ID_ONBOARD = \'".@@selectEmployee."\'";\nexecuteQuery($sqlUdata);\n\n$from = "processmaker@processmaker.com";\n$to = @@employeeEmail;\n$subject = "Thank you for your services.";\nPMFSendMessage(@@APPLICATION, $from, $to, \'\', \'\', $subject, \'dismissedEmail.html\');', 'ACTIVE'),
	(12, 2, 1, '2016-03-31 20:54:35', 'eee', 'e', 'plain', 'e', 'ACTIVE'),
	(13, 3, 1, '2016-03-31 20:54:43', 'r', 'r', 'plain', 'r', 'ACTIVE'),
	(14, 3, 1, '2016-03-31 20:54:49', 'y', 'y', 'plain', 'y', 'ACTIVE'),
	(15, 3, 1, '2016-03-31 20:54:55', 'u', 'u', 'plain', 'u', 'ACTIVE'),
	(16, 3, 1, '2016-03-31 20:55:06', 'j', 'j', 'plain', 'j', 'ACTIVE'),
	(17, 2, 1, '2016-03-31 20:55:14', 'paul snippet', 'PAUL SNIPPETS', 'javascript', 'gggggggggg', 'ACTIVE'),
	(18, 1, 1, '2016-03-31 20:59:37', 'TEST pm', 'ññññññññ', 'php', '<?\n//Update information\n$sqlUdata = "UPDATE PMT_EMPLOYEE_ONBOARDING SET\nEMPLOYEE_STATUS = \'DISMISSED\'\nWHERE ID_ONBOARD = \'".@@selectEmployee."\'";\nexecuteQuery($sqlUdata);\n\n$from = "processmaker@processmaker.com";\n$to = @@employeeEmail;\n$subject = "Thank you for your services.";\nPMFSendMessage(@@APPLICATION, $from, $to, \'\', \'\', $subject, \'dismissedEmail.html\');', 'ACTIVE'),
	(19, 1, 1, '2016-03-31 20:55:22', 'paul snippet', 'PAUL SNIPPETS', 'javascript', 'gggggggggg', 'ACTIVE'),
	(20, 3, 1, '2016-03-31 20:56:38', 'TEST pm', 'sssssssss', 'php', '<?\n//Update information\n$sqlUdata = "UPDATE PMT_EMPLOYEE_ONBOARDING SET\nEMPLOYEE_STATUS = \'DISMISSED\'\nWHERE ID_ONBOARD = \'".@@selectEmployee."\'";\nexecuteQuery($sqlUdata);\n\n$from = "processmaker@processmaker.com";\n$to = @@employeeEmail;\n$subject = "Thank you for your services.";\nPMFSendMessage(@@APPLICATION, $from, $to, \'\', \'\', $subject, \'dismissedEmail.html\');', 'ACTIVE'),
	(21, 2, 1, '2016-04-18 15:27:44', 'nuevo', 'nuevo', 'php', '<?\necho "nuevo";', 'ACTIVE');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table db_snippet.USERS: ~6 rows (approximately)
DELETE FROM `USERS`;
/*!40000 ALTER TABLE `USERS` DISABLE KEYS */;
INSERT INTO `USERS` (`ID_USER`, `USERNAME`, `PASSWORD`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `STATUS`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '', 'luis@processmaker.com', 'ACTIVE'),
	(2, 'paul', '5e8ff9bf55ba3508199d22e984129be6', 'Paul', 'Fenix', 'luis@processmaker.com', 'ACTIVE'),
	(18, 'ana', '202cb962ac59075b964b07152d234b70', 'Ana', 'Colin', 'luis@processmaker.com ', 'ACTIVE'),
	(19, 'brian', '5e8ff9bf55ba3508199d22e984129be6', 'Brian', 'Fury', 'luis@processmaker.com', 'ACTIVE'),
	(20, 'bruce', '5e8ff9bf55ba3508199d22e984129be6', 'Bruce', 'Irvin', 'luis@procecessmaker.com', 'ACTIVE'),
	(21, 'nina', '5e8ff9bf55ba3508199d22e984129be6', 'Nina', 'Williams', 'luis@processmaker.com', 'ACTIVE');
/*!40000 ALTER TABLE `USERS` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
