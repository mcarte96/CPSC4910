Create Database TruckDriver2;
use TruckDriver2;
CREATE TABLE `Admins` (
  `Username` varchar(45) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Driver` (
  `Username` varchar(45) NOT NULL,
  `Fname` varchar(45) DEFAULT NULL,
  `Mname` varchar(45) DEFAULT NULL,
  `Lname` varchar(45) DEFAULT NULL,
  `Private_Acct` varchar(45) DEFAULT NULL,
  `Birth_Date` varchar(45) DEFAULT NULL,
  `License_Number` varchar(45) DEFAULT NULL,
  `Point_Alert` tinyint(4) NOT NULL DEFAULT '1',
  `Cart_Alert` tinyint(4) NOT NULL DEFAULT '1',
  `Drivercol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Company` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Company_Name` varchar(45) NOT NULL,
  `keyword1` varchar(45) DEFAULT 'Stickers',
  `keyword2` varchar(45) DEFAULT 'Sunglasses',
  `keyword3` varchar(45) DEFAULT 'Phone Case',
  `Point_Ratio` int(11) DEFAULT '100',
  PRIMARY KEY (`ID`,`Company_Name`),
  UNIQUE KEY `Company_Name_UNIQUE` (`Company_Name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Cart` (
  `idCart` int(11) NOT NULL AUTO_INCREMENT,
  `driverUsername` varchar(45) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `dollarPrice` varchar(45) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `SponsorName` varchar(45) DEFAULT NULL,
  `itemName` varchar(500) DEFAULT NULL,
  `itemURL` varchar(500) DEFAULT NULL,
  `Picture` varchar(500) DEFAULT NULL,
  `itemID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCart`),
  KEY `driverUsername_idx` (`driverUsername`),
  KEY `SponsorName_idx` (`SponsorName`),
  CONSTRAINT `SponsorName` FOREIGN KEY (`SponsorName`) REFERENCES `Company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `driverUsername` FOREIGN KEY (`driverUsername`) REFERENCES `Driver` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `DriverApplication` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Driver` varchar(45) NOT NULL,
  `Sponsor` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Driver_idx` (`Driver`),
  KEY `Sponsor_name_idx` (`Sponsor`),
  CONSTRAINT `Driver_name` FOREIGN KEY (`Driver`) REFERENCES `Driver` (`username`),
  CONSTRAINT `Sponsor_name` FOREIGN KEY (`Sponsor`) REFERENCES `Company` (`company_name`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Sponsor_Company_Admin` (
  `Username` varchar(45) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Company_Name` varchar(45) DEFAULT NULL,
  `Num_Drivers` int(11) DEFAULT NULL,
  `Date_Joined` varchar(45) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `Image_text` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`Username`),
  KEY `CompanyID_idx` (`CompanyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) DEFAULT NULL,
  `image_text` longtext,
  `Sponsor_Admin` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Sponsor_Admin_idx` (`Sponsor_Admin`),
  CONSTRAINT `Sponsor_Admin` FOREIGN KEY (`Sponsor_Admin`) REFERENCES `Sponsor_Company_Admin` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Sponsor_Company_Manager` (
  `Username` varchar(45) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Fname` varchar(45) DEFAULT NULL,
  `Mname` varchar(45) DEFAULT NULL,
  `Lname` varchar(45) DEFAULT NULL,
  `Company_Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Username`),
  KEY `Company_idx` (`CompanyID`),
  KEY `CompanyID_idx` (`CompanyID`,`Company_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Information` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(45) DEFAULT NULL,
  `Street_Address` varchar(45) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `State` varchar(45) DEFAULT NULL,
  `Zipcode` varchar(45) DEFAULT NULL,
  `Apt_Num` int(11) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `Date_Joined` datetime DEFAULT CURRENT_TIMESTAMP,
  `Company_Manager` varchar(45) DEFAULT NULL,
  `Admins` varchar(45) DEFAULT NULL,
  `Driver` varchar(45) DEFAULT NULL,
  `Company_Admin` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Comapny_Manager_idx` (`Company_Manager`),
  KEY `Admin_idx` (`Admins`),
  KEY `Driver_idx` (`Driver`),
  KEY `Company_Admin_idx` (`Company_Admin`),
  CONSTRAINT `Admins` FOREIGN KEY (`Admins`) REFERENCES `Admins` (`username`),
  CONSTRAINT `Comapny_Manager` FOREIGN KEY (`Company_Manager`) REFERENCES `Sponsor_Company_Manager` (`username`),
  CONSTRAINT `Company_Admin` FOREIGN KEY (`Company_Admin`) REFERENCES `Sponsor_Company_Admin` (`Username`),
  CONSTRAINT `Driver` FOREIGN KEY (`Driver`) REFERENCES `Driver` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `Ordered` (
  `idOrdered` int(11) NOT NULL AUTO_INCREMENT,
  `driverUsername` varchar(45) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `dollarPrice` varchar(45) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `sponsorName` varchar(45) DEFAULT NULL,
  `itemName` varchar(500) DEFAULT NULL,
  `itemURL` varchar(500) DEFAULT NULL,
  `Picture` varchar(500) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT NULL,
  `itemID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idOrdered`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `Sponsored` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Driver` varchar(45) DEFAULT NULL,
  `Sponsor` varchar(45) DEFAULT NULL,
  `Points` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Driver1_idx` (`Driver`),
  KEY `Sponsor_idx` (`Sponsor`),
  CONSTRAINT `DriverID` FOREIGN KEY (`Driver`) REFERENCES `Driver` (`username`),
  CONSTRAINT `Sponsor` FOREIGN KEY (`Sponsor`) REFERENCES `Company` (`company_name`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

