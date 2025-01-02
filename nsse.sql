-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 28, 2021 at 05:18 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetails`
--

DROP TABLE IF EXISTS `admindetails`;
CREATE TABLE IF NOT EXISTS `admindetails` (
  `adminid` bigint(20) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindetails`
--

INSERT INTO `admindetails` (`adminid`, `fullname`, `address`) VALUES
(1, 'AishwaryaRameshan', 'kavil, Nidumbrum\r\nPO. Chokli\r\nPin: 670672		   		   ');

-- --------------------------------------------------------

--
-- Table structure for table `camp`
--

DROP TABLE IF EXISTS `camp`;
CREATE TABLE IF NOT EXISTS `camp` (
  `campid` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `location` varchar(50) NOT NULL,
  `fromcampdate` date NOT NULL,
  `tocampdate` date NOT NULL,
  `cost` varchar(14) NOT NULL,
  `status` bit(2) NOT NULL,
  PRIMARY KEY (`campid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camp`
--

INSERT INTO `camp` (`campid`, `title`, `description`, `location`, `fromcampdate`, `tocampdate`, `cost`, `status`) VALUES
(1, 'Mini Camp', 'Camp conducted for organizing Kalolsavam', 'Govt.Brennen HSS, Thalassery', '2019-10-22', '2019-10-23', '5000', b'01'),
(2, 'Adventurous Camp', 'Camp for adventure', 'Idukki', '2020-01-10', '2019-01-13', '25000', b'01'),
(3, 'Leadership Camp', 'Camp for Leadership', 'Secret Hearts School, Thalassery', '2020-01-20', '2020-01-22', '4000', b'01'),
(4, 'Seven Day Camp', 'Camp for evaluate Volunteers', 'School', '2020-02-01', '2020-02-08', '45000', b'01');

-- --------------------------------------------------------

--
-- Table structure for table `campduty`
--

DROP TABLE IF EXISTS `campduty`;
CREATE TABLE IF NOT EXISTS `campduty` (
  `dutyid` bigint(20) NOT NULL AUTO_INCREMENT,
  `campid` bigint(20) DEFAULT NULL,
  `duty` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `dutydate` date DEFAULT NULL,
  `marks` varchar(4) DEFAULT NULL,
  `groupid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`dutyid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campduty`
--

INSERT INTO `campduty` (`dutyid`, `campid`, `duty`, `description`, `dutydate`, `marks`, `groupid`) VALUES
(1, 4, 'Clean the school', 'Duty for clean the school', '2020-02-02', '5', 1),
(2, 4, 'Cooking', 'Duty for making Lunch', '2020-02-03', '5', 3),
(3, 1, 'Arrange Stage', 'Prepare the venue for the award ceremony', '2019-10-25', '10', 2),
(4, 2, 'Cleaning', 'Clean the room', '2020-01-11', '10', 5),
(5, 1, 'Fund Collection', 'Raise funds for Kalotsava Sadya', '2019-10-25', '5', 4),
(6, 1, 'pavement cleaning', 'cleaning streets cleaning s', '2019-01-08', '20', 3);

-- --------------------------------------------------------

--
-- Table structure for table `campmarks`
--

DROP TABLE IF EXISTS `campmarks`;
CREATE TABLE IF NOT EXISTS `campmarks` (
  `markid` bigint(20) NOT NULL AUTO_INCREMENT,
  `volunteer` varchar(50) DEFAULT NULL,
  `marks` varchar(14) DEFAULT NULL,
  `markdate` date NOT NULL,
  `groupid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`markid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campmarks`
--

INSERT INTO `campmarks` (`markid`, `volunteer`, `marks`, `markdate`, `groupid`) VALUES
(1, 'AkshayKrishnan', '18', '2020-02-23', 2),
(2, 'MeghnaSurendran', '21', '2020-02-23', 5),
(3, 'SwathiSatheesh', '22.5', '2020-02-24', 2),
(4, 'SivakamiRaman', '13', '2020-02-24', 4);

-- --------------------------------------------------------

--
-- Table structure for table `charity`
--

DROP TABLE IF EXISTS `charity`;
CREATE TABLE IF NOT EXISTS `charity` (
  `charityid` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `recipientname` varchar(50) DEFAULT NULL,
  `mobile` varchar(14) DEFAULT NULL,
  `items` varchar(100) DEFAULT NULL,
  `charitydate` date DEFAULT NULL,
  `teachername` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`charityid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charity`
--

INSERT INTO `charity` (`charityid`, `title`, `description`, `recipientname`, `mobile`, `items`, `charitydate`, `teachername`, `place`, `address`) VALUES
(1, 'School-Kit Distribution', 'NSS unit have distributed 10 school kits to children belongs to economically weak family.\r\n', 'Kunjaparamba LP School', '9846899064', 'Book, School bag, Umbrella, Pencil, Water bottle', '2019-09-13', 'Chandana.P', 'Thalassery', 'Chirakkara (PO) Thiruvangad\r\nThalassery'),
(2, 'Donation-Charity', ' NSS unit has donated Rs. 25,000/- for cancer patients in MCC, Thalassery. The\r\namount was collected from the villagers and businessmen in the locality. NSS\r\nVolunteers have also donated Rs. 10,000/- to the patients. ', 'Malabar Cancer Center', '9947501518', 'Cash', '2019-10-16', 'Nivya RameshBabu', 'Kodiyeri', 'Thalassery'),
(3, 'Blood Donation', 'We organized 3 special blood donation camps during the year 2019-20\r\nstudents donated their Blood and we published a blood group directory which\r\nincludes the details of blood donors in our college. ', 'Mission Hospital', '8609380840', 'Blood', '2020-01-17', 'Nivya RameshBabu', 'Kuyyali', 'Koduvally(PO)\r\nThalassery\r\nKannur'),
(4, 'Helping hand for MCC', ' Our volunteers took part in the collection of money and saved their pocket money\r\nto make a fund for the cancer patients and the students donated hair as well . \r\n', 'Malabar Cancer Center', '9947501518', 'Cash and Hair', '2020-01-19', 'Chandana.P', 'Kodiyeri', 'Thalassery'),
(5, 'Tution for Poor', ' Separate tuitions programmes were conducted by NSS volunteers in Poolabazar. Students of upper primary, higher schools and higher secondary\r\nstudents got this opportunity and their huge participation made it all a big success. ', 'Eruvatti West UP School', '9539935689', 'Tution Programme', '2019-10-12', 'Nivya RameshBabu', '5th Mile', 'Kadirur Thalassery');

-- --------------------------------------------------------

--
-- Table structure for table `commonfeedback`
--

DROP TABLE IF EXISTS `commonfeedback`;
CREATE TABLE IF NOT EXISTS `commonfeedback` (
  `feedbackid` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(20) NOT NULL,
  `place` varchar(14) NOT NULL,
  `address` varchar(250) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `addeddate` date NOT NULL,
  `feedback` varchar(500) NOT NULL,
  PRIMARY KEY (`feedbackid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commonfeedback`
--

INSERT INTO `commonfeedback` (`feedbackid`, `fullname`, `place`, `address`, `mobile`, `addeddate`, `feedback`) VALUES
(1, 'DhanyaDhanaraj', 'Kakkara', 'Parag house\r\nChundangapoil, PO. Ponniam\r\nKadirur', '9876451234', '2019-11-24', 'Such technologies are the success of volunteers. The abilities of the volunteers are pointed out here.'),
(2, 'AthulyaGopalan', 'Chonadam', 'Nivedhya House\r\nThalassery, PO. Eranholi', '8054186239', '2019-12-01', 'It promote the skills of volunteers to interact with differenet social lives'),
(3, 'SravanThilak', 'Palloor', 'Valiyaparambath House\r\nNidumbrum, PO. Chokli', '9744549258', '2020-07-24', 'It was a little better to give the charity amount through online transaction.'),
(4, 'KiranKumar ', 'Koothuparamb', 'Pravya House\r\nNirmalagiri, PO. Koothuparamb', '9056123256', '2020-07-24', 'NSSE is very helpful.');

-- --------------------------------------------------------

--
-- Table structure for table `dutyallotment`
--

DROP TABLE IF EXISTS `dutyallotment`;
CREATE TABLE IF NOT EXISTS `dutyallotment` (
  `allotmentid` bigint(20) NOT NULL AUTO_INCREMENT,
  `dutydate` date DEFAULT NULL,
  `dutytime` varchar(14) DEFAULT NULL,
  `dutytype` varchar(50) DEFAULT NULL,
  `groupid` bigint(14) DEFAULT NULL,
  PRIMARY KEY (`allotmentid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dutyallotment`
--

INSERT INTO `dutyallotment` (`allotmentid`, `dutydate`, `dutytime`, `dutytype`, `groupid`) VALUES
(1, '2019-06-10', '8:00', 'School Cleaning', 1),
(2, '2019-06-11', '4:30', 'Tree Plantation', 2),
(3, '2019-06-12', '10:00', 'Pavement cleaning', 3),
(4, '2019-06-13', '9:00', 'Guide the Exhibition', 4),
(5, '2019-06-14', '14:00', 'Distribute NSS Badge and Dairy to all Volunteers. ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `eventid` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `news` varchar(500) NOT NULL,
  `addeddate` date NOT NULL,
  `image` varchar(25) NOT NULL,
  `status` bit(1) NOT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `title`, `news`, `addeddate`, `image`, `status`) VALUES
(1, 'Cleanliness Drive', ' On the occasion of golden jubilee of NSS, Our school decided to have the cleanliness drive. They took their campaign in different zones of the surround.The motive of activity was door to door awareness campaign about health and hygiene, sanitation and hazardous impact of polythene on the environment. They were motivated to take path for Clean. ', '2019-06-03', 'cleanliness.jpeg', b'1'),
(2, 'Environment Day', 'The volunteers of the NSS unit enthusiastically celebrated the World Environment Day (WED) of this year by organising several programmes. Principal of our College, inagurated the program by planting a sapling of the custard apple tree. About 50 saplings had been donated to the NSS units by EAZY Books team as part of this celebration.', '2019-06-05', 'environmental.jpeg', b'1'),
(3, 'Independance Day', 'A great day and a proud moment for every Indian.NSS volunteers, teachers and non teaching staff of the college saluted the national flag and honored the memories of the martyrs who achieved us the freedom.Then some of the student sung National Anthem with salute from everyone was given to the flag.', '2019-08-15', 'independance.jpg', b'1'),
(4, 'Blood Donation Camp', 'The NSS unit organized a blood donation camp in collaboration with blood bank of Pariyaram Medical College, Kannur, on 21th January 2019. The camp began at 10.00 a.m. with a short inaugural function where in Dr. Sanjay Kumar and his five member team was given a floral welcome.The Camp was started exactly at 10.00 am and was continued until the 2.00 pm. All the students as well as outsiders gave a excellent response for the Blood Donation Camp and Thalassemia Testing. It was pleasure to work for ', '2019-10-20', 'blood-2.jpg', b'1'),
(5, 'Career Guidance', 'Additionally, technology is the application of math, science, and the arts for the benefit of life as it is known.All the volunteers of NSS who are interested in the campus will move to the  school to guide the students about the variations in past to present technology by presenting them some of the videos and paper presentations.As a result the students can know about the advancement in technology along with manufacturing to some extent.', '2019-11-27', 'c_guidance.jpg', b'1'),
(6, 'Plastic Free Campaign', 'The NSS volunteers have taken an initiative to organize a program of plastic free zone on Friday\r\n03/12/2019.The event commenced at 10 AM and went on till 3 PM. The main motto of the program was to eradicate the use of plastic. Totally 20 staff members and 100 students of the college were actively involved in the program.The NSS volunteers have taken an initiative to organize a program of plastic free around the campus. The volunteers will work in the span of 6 hours.  ', '2019-12-03', 'plastic_free.jpg', b'1'),
(7, 'One Day Orientation', 'NSS Orientation Programme provide knowledge on NSS programmes, activities, organizing NSS camps and special camps. On October 2nd, Gandhi Jayanti, NSS Programme Officer along with volunteers organized a one day orientation programme for the new NSS members. The event began with the flag hoisting ceremony. The ceremony was started by former NSS volunteer secretary Kumari Sangeetha T. 				', '2020-01-26', 'one_day_orientation.jpg', b'1'),
(8, 'Republic Day Parade', 'NSS Unit take lead role in Observing Republic Day as sharing of rich experiences and examples of people and societies. The participation in Republic Day Parade on 26th January is considered as a matter of great pride for the student youth. The NSS Republic Day Parade Camp has become famous, and of most attraction among the NSS volunteers and the youth community in the country. ', '2020-01-26', 'republic-day.jpg', b'1'),
(9, 'Health Awareness', 'To help improve health awareness among students in general and also spread the word about symptoms and remedies that led to physical weakness. we the members of Team NSS have organized a Health Awareness camp.Prior to beginning a health awareness campaign, it is important to have reliable data that can be analyzed to determine the needs of a community.Health education teaches about physical, mental, emotional and social health.', '2020-02-03', 'health.jpg', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `allotmentid` bigint(14) NOT NULL AUTO_INCREMENT,
  `groupid` bigint(14) DEFAULT NULL,
  `volunteerid` bigint(14) DEFAULT NULL,
  PRIMARY KEY (`allotmentid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`allotmentid`, `groupid`, `volunteerid`) VALUES
(1, 1, 11),
(2, 1, 13),
(3, 2, 14),
(4, 3, 12),
(5, 2, 5),
(6, 2, 7),
(7, 4, 15),
(8, 5, 16),
(9, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `loginid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(14) NOT NULL,
  `usertype` varchar(14) NOT NULL,
  `doj` date NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `status` bit(1) NOT NULL,
  PRIMARY KEY (`loginid`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginid`, `username`, `password`, `usertype`, `doj`, `emailid`, `mobile`, `status`) VALUES
(1, 'aishwarya', 'aishwarya', 'admin', '2019-06-01', 'aishwaryakavil@gmail.com', '7025419128', b'1'),
(2, 'midhuna', 'midhuna', 'officer', '2019-06-01', 'midhunasaji@yahoo.in', '9744549258', b'0'),
(3, 'jayesh', 'jayesh', 'teacher', '2019-06-01', 'jayeshrg@gmail.com', '8547471243', b'0'),
(4, 'nivya', 'nivya', 'teacher', '2019-06-01', 'nivyarameshbabu@gmail.com', '9846376837', b'1'),
(5, 'swathi', 'swathi', 'volunteer', '2019-06-02', 'swathisatheesh@yahoo.in', '9447373321', b'1'),
(6, 'ajay', 'ajay', 'volunteer', '2019-06-02', 'ajaykumar@gmail.com', '7089346724', b'1'),
(7, 'krishnendhu', 'krishnendhu', 'volunteer', '2019-06-02', 'krishnendhu@gmail.com', '7045783421', b'1'),
(8, 'swaralaya', 'swaralaya', 'officer', '2019-06-02', 'swaralayavk@yahoo.in', '9072590965', b'1'),
(9, 'chandana', 'chandana', 'teacher', '2019-06-02', 'chanadana@gmail.com', '8967345621', b'1'),
(10, 'nihala', 'nihala', 'volunteer', '2019-06-02', 'nihalamujeeb@gmail.com', '9035376837', b'1'),
(11, 'mruthul', 'mruthul', 'volunteer', '2019-06-02', 'mruthulmanoj@gmail.com', '9656008950', b'1'),
(12, 'navaneeth', 'navaneeth', 'volunteer', '2019-06-02', 'navaneeth@yahoo.in', '7068548771', b'1'),
(13, 'amal', 'amal', 'volunteer', '2019-06-02', 'amalmanoj@gmail.com', '8062495163', b'1'),
(14, 'akshay', 'akshay', 'volunteer', '2019-06-02', 'akshayvk@gmail.com', '7051296531', b'1'),
(15, 'vismaya', 'vismaya', 'volunteer', '2019-06-02', 'vismayarinoop@gmail.com', '8541384271', b'1'),
(16, 'meghna', 'meghna', 'volunteer', '2019-06-02', 'meghnasurendran@yahoo.in', '9034186245', b'1'),
(17, 'shesna', 'shesna', 'volunteer', '2019-06-02', 'shesnasaseendran@gmail.com', '7045317841', b'1'),
(18, 'niveditha', 'niveditha', 'volunteer', '2019-06-02', 'nivu123@gmail.com', '9764001127', b'1'),
(19, 'sivakami', 'sivakami', 'volunteer', '2019-06-02', 'sivaram@gmail.com', '8056432345', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
CREATE TABLE IF NOT EXISTS `meetings` (
  `meetingid` bigint(20) NOT NULL AUTO_INCREMENT,
  `meetingdate` datetime NOT NULL,
  `matter` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `volunteers` varchar(3) NOT NULL,
  `teachers` varchar(3) NOT NULL,
  `status` bit(1) NOT NULL,
  PRIMARY KEY (`meetingid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meetingid`, `meetingdate`, `matter`, `description`, `volunteers`, `teachers`, `status`) VALUES
(1, '2019-09-05 04:00:00', 'School Kit Distribution', 'Meeting to decide school kit distribution		   ', '50', '2', b'1'),
(2, '2019-10-03 01:30:00', 'Donation', 'Meeting to decide on fund raising for cancer patients', '20', '1', b'0'),
(3, '2020-12-30 08:00:00', 'Blood Donation', 'Campaign for Blood Donation', '50', '2', b'1'),
(4, '2019-10-10 08:30:00', 'Tuition for Poor', 'Campaign forseperate tuition programs', '10', '1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `officerdetails`
--

DROP TABLE IF EXISTS `officerdetails`;
CREATE TABLE IF NOT EXISTS `officerdetails` (
  `officerid` bigint(20) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`officerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officerdetails`
--

INSERT INTO `officerdetails` (`officerid`, `fullname`, `place`, `address`) VALUES
(2, 'MidhunaSajeevan', 'Kadirur', 'Anaswara		'),
(8, 'SwaralayaVinodKumar', 'Manekkara', 'Nandhanam, Manekkara\r\nPO. Panoor\r\nPin: 670671		');

-- --------------------------------------------------------

--
-- Table structure for table `teacherdetails`
--

DROP TABLE IF EXISTS `teacherdetails`;
CREATE TABLE IF NOT EXISTS `teacherdetails` (
  `teacherid` bigint(20) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`teacherid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacherdetails`
--

INSERT INTO `teacherdetails` (`teacherid`, `fullname`, `designation`, `address`) VALUES
(3, 'JayeshRajeevan', 'Asst.Teacher', 'Radhalayam, Chalakkara\r\nMahe'),
(4, 'NivyaRameshBabu', 'Asst.Teacher', 'Nirmalyam, Eruvatti\r\nPO.Kadirur\r\nPin: 670674'),
(9, 'ChandanaSunilkumar', 'Asst.Teacher', '		   		   Sangeetham,Chonadam\r\nPO. Eranholi\r\nPin: 670673		  		  ');

-- --------------------------------------------------------

--
-- Table structure for table `volunteerdetails`
--

DROP TABLE IF EXISTS `volunteerdetails`;
CREATE TABLE IF NOT EXISTS `volunteerdetails` (
  `volunteerid` bigint(20) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `dob` varchar(14) DEFAULT NULL,
  `gender` varchar(14) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `bloodgroup` varchar(10) NOT NULL,
  `place` varchar(50) DEFAULT NULL,
  `address` text,
  `department` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`volunteerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteerdetails`
--

INSERT INTO `volunteerdetails` (`volunteerid`, `fullname`, `dob`, `gender`, `height`, `weight`, `bloodgroup`, `place`, `address`, `department`) VALUES
(5, 'SwathiSatheesh', '16-04-2003', 'Female', '150', '45', 'O+ve', 'Nidumbrum', 'Nivedhyam, Nidumbrum\r\nPO. Chokli\r\nPin: 670672', 'Computer-Commerce'),
(6, 'AjayKumar', '20-08-2003', 'Male', '160', '50', 'AB+ve', 'Kadavathur', 'Ragendhu, Kadavathur\r\nPO. Pringathur\r\nPin: 670676', 'Computer-Science'),
(7, 'Krishnendhu', '03-09-2003', 'Female', '155', '50', 'A-ve', 'Iringannur', 'Parag,\r\nPO. Iringannur\r\nPin: 670678', 'Maths-Commerce'),
(10, 'NihalaMujeeb', '16-10-2003', 'Female', '145', '45', 'AB+ve', 'Koothuparamb', 'Baithul Arsh, \r\nNirmalagiri\r\nPO.Koothuparamb\r\nPin: 670675					    ', 'Science'),
(11, 'MruthulManoj', '07-01-2004', 'Male', '150', '50', 'B-ve', 'Paral', 'Love Shore,\r\nPO. Koothuparamb\r\nPin: 670675', 'Humanities'),
(12, 'NavaneethPrabhakaran', '05-08-2003', 'Male', '150', '50', 'A-ve', 'Palloor', 'Valiyaparambath House,\r\nPalloor, Mahe', 'Computer-Science'),
(13, 'AmalMaoj', '15-10-2003', 'Male', '150', '45', 'AB-ve', 'Madapeedika', 'Ponnambath House,\r\nKallilthazhe\r\nPin: 670671', 'Computer-Commerce'),
(14, 'AkshayKrishnan', '04-05-2004', 'Male', '160', '45', 'O-ve', 'Mokeri', 'Indheevaram,\r\nPO. Panoor\r\nPin: 670674', 'Science'),
(15, 'VismayaRinoop', '24-07-2003', 'Female', '145', '50', 'A-ve', 'Chalakkara', 'Vismaya House,\r\nChalakkara, Mahe', 'Humanities'),
(16, 'MeghnaSurendran', '29-09-2003', 'Female', '150', '50', 'B+ve', 'Perunthattil', 'Anamika House,\r\nIlayadathmukku,\r\nPO. Eranholi\r\nPin : 670674', 'Maths-Commerce'),
(17, 'ShesnaSaseendran', '17-05-2003', 'Female', '150', '45', 'O+ve', 'Chirakkara', 'Abhayam House,\r\nChirakkara, Thalassery\r\nPin: 670674', 'Science'),
(18, 'NivedithaSunil', '08-01-2003', 'Female', '154', '50', 'B+ve', 'chonadam', 'Niveditham,(po)eranjoli\r\nchonadam', 'Computer-Commerce'),
(19, 'SivakamiRaman', '24-07-2003', 'Female', '148', '45', 'A+ve', 'Perunthattil', 'Krishnapuram House\r\nPO. Eranholi \r\nPin: 670107', 'Science');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
