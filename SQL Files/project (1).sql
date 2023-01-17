-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 17, 2023 at 06:05 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `leaderboard`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `leaderboard` ()  NO SQL select q.quizname,s.score,s.totalscore,st.name,s.mail from score s,student st,quiz q where s.mail=st.mail and q.quizid=s.quizid order by score DESC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

DROP TABLE IF EXISTS `dept`;
CREATE TABLE IF NOT EXISTS `dept` (
  `dept_id` int NOT NULL,
  `dept_name` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`dept_id`, `dept_name`) VALUES
(1, 'CSE'),
(2, 'ISE'),
(3, 'ECE'),
(4, 'EEE');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `qs` varchar(200) NOT NULL,
  `op1` varchar(30) NOT NULL,
  `op2` varchar(30) NOT NULL,
  `op3` varchar(30) NOT NULL,
  `answer` varchar(30) NOT NULL,
  `quizid` int NOT NULL,
  UNIQUE KEY `qs` (`qs`),
  KEY `quizid` (`quizid`),
  KEY `quizid_2` (`quizid`),
  KEY `quizid_3` (`quizid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qs`, `op1`, `op2`, `op3`, `answer`, `quizid`) VALUES
('/ Assume that integers take 4 bytes.<br>  #include<iostream> <br>    using namespace std; <br>       class Test  { <br>   static int i;<br>    int j;<br>  }; <br>    int Test::i; <br>    int main() { ', '1', '2', '3', '4', 5),
('C primiarily developed as..', 'General purpose language', 'Data processing language D.', 'None of the above.', 'System programming language  ', 4),
('C programs converted into machine language with the help of..', 'An Editor  ', 'An operating system', ' None of these.', 'A compiler  ', 4),
('No. of consonant in english language is..', '20', '22', '28', '21', 6),
('No. of vowels in english language is..', '3', '4', '7', '5', 6),
('Total no of letters in english language is..', '23', '24', '25', '26', 6),
('When a copy constructor may be called?', 'When an object of the class is', 'When an object of the class is', 'When an object is constructed ', 'All of the above', 5),
('Which of the following functions must use reference.', 'Assignment operator function', 'Destructor', 'Parameterized constructor', 'Copy Constructor', 5),
('Which of the following is FALSE about references in C++', 'References cannot be NULL', 'A reference must be initialize', 'Once a reference is created, i', 'References cannot refer to con', 5),
('Which of the following operators cannot be overloaded', '. (Member Access or Dot operat', '?: (Ternary or Conditional Ope', ':: (Scope Resolution Operator)', 'All of the above', 5),
('Which of the followings is/are automatically added to every class, if we do not write our own.', 'Copy Constructor', 'Assignment Operator', 'A constructor without any para', 'All of the above', 5),
('Who is the father of C language?', 'Bjarne Stroustrup', 'James A. Gosling  ', 'Dr. E.F. Codd', 'Dennis Ritchie  ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quizid` int NOT NULL AUTO_INCREMENT,
  `quizname` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`quizid`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizid`, `quizname`, `date_created`, `mail`) VALUES
(4, 'c quiz', '2019-11-18 16:13:50', 'BHATVINAYAK94@GMAIL.COM'),
(5, 'c++ quiz', '2019-11-18 16:17:13', 'rakeshmr723@gmail.com'),
(6, 'english', '2019-11-18 17:04:12', 'BHATVINAYAK94@GMAIL.COM');

--
-- Triggers `quiz`
--
DROP TRIGGER IF EXISTS `ondeleteqs`;
DELIMITER $$
CREATE TRIGGER `ondeleteqs` AFTER DELETE ON `quiz` FOR EACH ROW delete from questions where questions.quizid=old.quizid
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `slno` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `quizid` int NOT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `totalscore` int DEFAULT NULL,
  `remark` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`slno`),
  KEY `quizid` (`quizid`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`slno`, `score`, `quizid`, `mail`, `totalscore`, `remark`) VALUES
(13, 6, 5, 'rakeshmariyaplar1@gmail.com', 6, 'good'),
(14, 2, 4, 'rakeshmariyaplar1@gmail.com', 3, 'good'),
(15, 3, 4, 'rmanjunath7692@gmail.com', 3, 'good');

--
-- Triggers `score`
--
DROP TRIGGER IF EXISTS `remarks`;
DELIMITER $$
CREATE TRIGGER `remarks` BEFORE INSERT ON `score` FOR EACH ROW set NEW.remark = if(NEW.score = 0, 'bad', 'good')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staffid` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `pw` varchar(200) NOT NULL,
  `dept` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`mail`),
  UNIQUE KEY `mail` (`mail`,`phno`),
  UNIQUE KEY `staffid` (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `name`, `mail`, `phno`, `gender`, `DOB`, `pw`, `dept`) VALUES
('101', 'Anushree', 'anushree9019@gmail.com', '9019247975', 'F', '2002-03-19', 'raNVgEH7z4B6.', 'CSE'),
('svit1', 'B G VINAYAK', 'BHATVINAYAK94@GMAIL.COM', '9740834260', 'M', '1999-09-23', 'ral7gku4rfhLk', 'CSE'),
('123', 'Rakesh M R', 'rakeshmr723@gmail.com', '9901735897', 'M', '1999-10-07', 'rajJYeVNCiGD2', 'ISE');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `usn` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `pw` varchar(200) NOT NULL,
  `dept` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`mail`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `phno` (`phno`),
  UNIQUE KEY `usn` (`usn`),
  KEY `dept` (`dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`usn`, `name`, `mail`, `phno`, `gender`, `DOB`, `pw`, `dept`) VALUES
('1va17cs010', 'B G VINAYAK', 'BHATVINAYAK94@GMAIL.COM', '9740834260', 'M', '1999-09-23', 'ral7gku4rfhLk', 'CSE'),
('1va17cs140', 'Rakesh Mariyaplar', 'rakeshmariyaplar1@gmail.com', '6360300095', 'M', '1999-10-07', 'rajJYeVNCiGD2', 'CSE'),
('1va17cs040', 'Rakesh M R', 'rakeshmr723@gmail.com', '9901735897', 'M', '2000-10-07', 'rajJYeVNCiGD2', 'CSE'),
('1KS20CS054', 'Manjunath R', 'rmanjunath7692@gmail.com', '6363358647', 'M', '2002-07-18', 'rayD.ut57ldEo', 'CSE'),
('1va17cs051', 'Siddhanth Sipoliya', 'siddhanthsipoliya@saividya.ac.', '7619360459', 'M', '1999-11-15', 'ray.whoA8HjCQ', 'CSE');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `staff` (`mail`) ON DELETE CASCADE;

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`quizid`) REFERENCES `quiz` (`quizid`) ON DELETE CASCADE,
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`mail`) REFERENCES `student` (`mail`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
