-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 27, 2021 at 07:56 AM
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
-- Database: `sipsewanaedu`
--

-- --------------------------------------------------------

--
-- Table structure for table `al_student`
--

DROP TABLE IF EXISTS `al_student`;
CREATE TABLE IF NOT EXISTS `al_student` (
  `ALstudent_id` int(11) NOT NULL AUTO_INCREMENT,
  `idno` char(12) NOT NULL,
  `email` char(255) NOT NULL,
  `contactno` char(10) NOT NULL,
  PRIMARY KEY (`ALstudent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

DROP TABLE IF EXISTS `cashier`;
CREATE TABLE IF NOT EXISTS `cashier` (
  `cashier_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` char(20) NOT NULL,
  `lname` char(30) NOT NULL,
  `usrname` varchar(30) DEFAULT NULL,
  `passwordhash` char(128) DEFAULT NULL,
  `dob` date NOT NULL,
  `adrsl1` varchar(30) NOT NULL,
  `adrsl2` varchar(40) NOT NULL,
  `adrsl3` varchar(40) DEFAULT NULL,
  `city` char(30) NOT NULL,
  `district` char(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `email` char(255) NOT NULL,
  `contactno` char(10) NOT NULL,
  `frt_cas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cashier_id`),
  KEY `fk_cas_fo` (`frt_cas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `duration` time NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `lec_cls_id` int(11) NOT NULL,
  `sub_cls_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`),
  KEY `fk_cls_lec` (`lec_cls_id`),
  KEY `fk_cls_sub` (`sub_cls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class_dates`
--

DROP TABLE IF EXISTS `class_dates`;
CREATE TABLE IF NOT EXISTS `class_dates` (
  `cls_dt_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`cls_dt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

DROP TABLE IF EXISTS `director`;
CREATE TABLE IF NOT EXISTS `director` (
  `dir_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` char(20) NOT NULL,
  `lname` char(30) NOT NULL,
  `usrname` varchar(30) DEFAULT NULL,
  `passwordhash` char(128) DEFAULT NULL,
  `dob` date NOT NULL,
  `email` char(255) NOT NULL,
  `contactno` char(10) NOT NULL,
  `frt_dir_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dir_id`),
  KEY `fk_dir_fo` (`frt_dir_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_officer`
--

DROP TABLE IF EXISTS `front_officer`;
CREATE TABLE IF NOT EXISTS `front_officer` (
  `fo_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` char(20) NOT NULL,
  `lname` char(30) NOT NULL,
  `usrname` varchar(30) NOT NULL,
  `passwordhash` char(128) NOT NULL,
  `dob` date NOT NULL,
  `adrsl1` varchar(30) NOT NULL,
  `adrsl2` varchar(40) NOT NULL,
  `adrsl3` varchar(40) DEFAULT NULL,
  `city` char(30) NOT NULL,
  `district` char(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `email` char(255) NOT NULL,
  `contactno` char(10) NOT NULL,
  PRIMARY KEY (`fo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

DROP TABLE IF EXISTS `homework`;
CREATE TABLE IF NOT EXISTS `homework` (
  `hw_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `type` char(30) NOT NULL,
  `description` text,
  `file` text NOT NULL,
  `hw_sub_id` int(11) NOT NULL,
  PRIMARY KEY (`hw_id`),
  KEY `fk_hw_sub` (`hw_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hw_creation`
--

DROP TABLE IF EXISTS `hw_creation`;
CREATE TABLE IF NOT EXISTS `hw_creation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cre_hw_id` int(11) NOT NULL,
  `cre_lec_id` int(11) NOT NULL,
  `createddate` date NOT NULL,
  `deadlinedate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cre_hw` (`cre_hw_id`),
  KEY `fk_cre_lec` (`cre_lec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hw_submission`
--

DROP TABLE IF EXISTS `hw_submission`;
CREATE TABLE IF NOT EXISTS `hw_submission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_hw_id` int(11) NOT NULL,
  `sub_st_id` int(11) NOT NULL,
  `submitdate` date NOT NULL,
  `submitfile` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_hw` (`sub_hw_id`),
  KEY `fk_sub_st` (`sub_st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `learning_module`
--

DROP TABLE IF EXISTS `learning_module`;
CREATE TABLE IF NOT EXISTS `learning_module` (
  `lm_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `type` char(30) NOT NULL,
  `file` text NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `lm_lec_id` int(11) NOT NULL,
  `lm_sub_id` int(11) NOT NULL,
  PRIMARY KEY (`lm_id`),
  KEY `fk_lm_lec` (`lm_lec_id`),
  KEY `fk_lm_sub` (`lm_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `lecturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` char(20) NOT NULL,
  `lname` char(30) NOT NULL,
  `usrname` varchar(30) DEFAULT NULL,
  `passwordhash` char(128) DEFAULT NULL,
  `dob` date NOT NULL,
  `email` char(255) NOT NULL,
  `contactno` char(10) NOT NULL,
  `certification` char(50) NOT NULL,
  `adrsl1` varchar(30) NOT NULL,
  `adrsl2` varchar(40) NOT NULL,
  `adrsl3` varchar(40) DEFAULT NULL,
  `city` char(30) NOT NULL,
  `district` char(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `accountno` char(20) NOT NULL,
  `bankname` char(30) NOT NULL,
  `branchcode` int(11) NOT NULL,
  `branchname` char(50) NOT NULL,
  `accountname` char(50) NOT NULL,
  `frt_lec_id` int(11) DEFAULT NULL,
  `submissiondate` date NOT NULL,
  PRIMARY KEY (`lecturer_id`),
  KEY `fk_lec_fo` (`frt_lec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_reg`
--

DROP TABLE IF EXISTS `lecturer_reg`;
CREATE TABLE IF NOT EXISTS `lecturer_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lec_reg_id` int(11) NOT NULL,
  `lec_sub_id` int(11) NOT NULL,
  `registrationdate` date NOT NULL,
  `regfee` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lecreg_lec` (`lec_reg_id`),
  KEY `fk_lecreg_sub` (`lec_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lec_attendance`
--

DROP TABLE IF EXISTS `lec_attendance`;
CREATE TABLE IF NOT EXISTS `lec_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lec_att_id` int(11) NOT NULL,
  `cls_attlec_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `intime` datetime NOT NULL,
  `outtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lecatt_lec` (`lec_att_id`),
  KEY `fk_lecatt_cls` (`cls_attlec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offline_class`
--

DROP TABLE IF EXISTS `offline_class`;
CREATE TABLE IF NOT EXISTS `offline_class` (
  `of_cls_id` int(11) NOT NULL AUTO_INCREMENT,
  `hallno` varchar(10) NOT NULL,
  PRIMARY KEY (`of_cls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ol_student`
--

DROP TABLE IF EXISTS `ol_student`;
CREATE TABLE IF NOT EXISTS `ol_student` (
  `OLstudent_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttresults` int(2) NOT NULL,
  PRIMARY KEY (`OLstudent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online_class`
--

DROP TABLE IF EXISTS `online_class`;
CREATE TABLE IF NOT EXISTS `online_class` (
  `ol_cls_id` int(11) NOT NULL AUTO_INCREMENT,
  `classurl` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ol_cls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `method` char(20) NOT NULL,
  `status` char(20) NOT NULL,
  `type` char(30) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `pay_sub_id` int(11) NOT NULL,
  `pay_st_id` int(11) DEFAULT NULL,
  `pay_lec_id` int(11) DEFAULT NULL,
  `pay_cas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `fk_pay_sub` (`pay_sub_id`),
  KEY `fk_pay_st` (`pay_st_id`),
  KEY `fk_pay_lec` (`pay_lec_id`),
  KEY `fk_pay_cas` (`pay_cas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` char(20) NOT NULL,
  `lname` char(30) NOT NULL,
  `usrname` varchar(30) DEFAULT NULL,
  `passwordhash` char(128) DEFAULT NULL,
  `dob` date NOT NULL,
  `school` char(30) DEFAULT NULL,
  `adrsl1` varchar(30) NOT NULL,
  `adrsl2` varchar(40) NOT NULL,
  `adrsl3` varchar(40) DEFAULT NULL,
  `city` char(30) NOT NULL,
  `district` char(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `gfname` char(20) NOT NULL,
  `glname` char(30) NOT NULL,
  `gemail` char(255) NOT NULL,
  `gcontactno` char(10) NOT NULL,
  `relationship` char(20) NOT NULL,
  `frt_st_id` int(11) DEFAULT NULL,
  `submissiondate` date NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `fk_st_fo` (`frt_st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_reg`
--

DROP TABLE IF EXISTS `student_reg`;
CREATE TABLE IF NOT EXISTS `student_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `st_reg_id` int(11) NOT NULL,
  `st_sub_id` int(11) NOT NULL,
  `registrationdate` date NOT NULL,
  `regfee` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_streg_st` (`st_reg_id`),
  KEY `fk_streg_sub` (`st_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stu_attendance`
--

DROP TABLE IF EXISTS `stu_attendance`;
CREATE TABLE IF NOT EXISTS `stu_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `st_att_id` int(11) NOT NULL,
  `cls_attst_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `intime` datetime NOT NULL,
  `outtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_statt_st` (`st_att_id`),
  KEY `fk_statt_cls` (`cls_attst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subjectname` char(20) NOT NULL,
  `description` text,
  `fee` double NOT NULL,
  `medium` char(10) NOT NULL,
  `frt_sub_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `fk_sub_fo` (`frt_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `al_student`
--
ALTER TABLE `al_student`
  ADD CONSTRAINT `fk_alst_st` FOREIGN KEY (`ALstudent_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cashier`
--
ALTER TABLE `cashier`
  ADD CONSTRAINT `fk_cas_fo` FOREIGN KEY (`frt_cas_id`) REFERENCES `front_officer` (`fo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `fk_cls_lec` FOREIGN KEY (`lec_cls_id`) REFERENCES `lecturer` (`lecturer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cls_sub` FOREIGN KEY (`sub_cls_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_dates`
--
ALTER TABLE `class_dates`
  ADD CONSTRAINT `fk_cls_dt` FOREIGN KEY (`cls_dt_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `director`
--
ALTER TABLE `director`
  ADD CONSTRAINT `fk_dir_fo` FOREIGN KEY (`frt_dir_id`) REFERENCES `front_officer` (`fo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `fk_hw_sub` FOREIGN KEY (`hw_sub_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hw_creation`
--
ALTER TABLE `hw_creation`
  ADD CONSTRAINT `fk_cre_hw` FOREIGN KEY (`cre_hw_id`) REFERENCES `homework` (`hw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cre_lec` FOREIGN KEY (`cre_lec_id`) REFERENCES `lecturer` (`lecturer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hw_submission`
--
ALTER TABLE `hw_submission`
  ADD CONSTRAINT `fk_sub_hw` FOREIGN KEY (`sub_hw_id`) REFERENCES `homework` (`hw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sub_st` FOREIGN KEY (`sub_st_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learning_module`
--
ALTER TABLE `learning_module`
  ADD CONSTRAINT `fk_lm_lec` FOREIGN KEY (`lm_lec_id`) REFERENCES `lecturer` (`lecturer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lm_sub` FOREIGN KEY (`lm_sub_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `fk_lec_fo` FOREIGN KEY (`frt_lec_id`) REFERENCES `front_officer` (`fo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_reg`
--
ALTER TABLE `lecturer_reg`
  ADD CONSTRAINT `fk_lecreg_lec` FOREIGN KEY (`lec_reg_id`) REFERENCES `lecturer` (`lecturer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lecreg_sub` FOREIGN KEY (`lec_sub_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lec_attendance`
--
ALTER TABLE `lec_attendance`
  ADD CONSTRAINT `fk_lecatt_cls` FOREIGN KEY (`cls_attlec_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lecatt_lec` FOREIGN KEY (`lec_att_id`) REFERENCES `lecturer` (`lecturer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offline_class`
--
ALTER TABLE `offline_class`
  ADD CONSTRAINT `fk_ofcls_cls` FOREIGN KEY (`of_cls_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ol_student`
--
ALTER TABLE `ol_student`
  ADD CONSTRAINT `fk_olst_st` FOREIGN KEY (`OLstudent_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `online_class`
--
ALTER TABLE `online_class`
  ADD CONSTRAINT `fk_olcls_cls` FOREIGN KEY (`ol_cls_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_pay_cas` FOREIGN KEY (`pay_cas_id`) REFERENCES `cashier` (`cashier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pay_lec` FOREIGN KEY (`pay_lec_id`) REFERENCES `lecturer` (`lecturer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pay_st` FOREIGN KEY (`pay_st_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pay_sub` FOREIGN KEY (`pay_sub_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_st_fo` FOREIGN KEY (`frt_st_id`) REFERENCES `front_officer` (`fo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_reg`
--
ALTER TABLE `student_reg`
  ADD CONSTRAINT `fk_streg_st` FOREIGN KEY (`st_reg_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_streg_sub` FOREIGN KEY (`st_sub_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stu_attendance`
--
ALTER TABLE `stu_attendance`
  ADD CONSTRAINT `fk_statt_cls` FOREIGN KEY (`cls_attst_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_statt_st` FOREIGN KEY (`st_att_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_sub_fo` FOREIGN KEY (`frt_sub_id`) REFERENCES `front_officer` (`fo_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
