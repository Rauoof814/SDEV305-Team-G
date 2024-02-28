-- Team Gnocchi gnocchiATT backup / restore
-- version 1.0
-- https://github.com/brandonviorato/SDEV305-Team-G
--
-- Last updated: 2/9/24
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `gnocchiATT`
--
-- Drop existing tables
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS applications;
-- --------------------------------------------------------
--
-- Table Structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(6) NOT NULL AUTO_INCREMENT,
    `user_first` varchar(30) DEFAULT NULL,
    `user_last` varchar(30) DEFAULT NULL,
    `user_email` varchar(30) DEFAULT NULL,
    `user_cohort` int(2) DEFAULT 0,
    `user_job_status` varchar(30) DEFAULT NULL,
    `user_seeking` varchar(150) DEFAULT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `users`
--
INSERT INTO `users` (`user_first`, `user_last`, `user_email`, `user_cohort`, `user_job_status`, `user_seeking`)
VALUES
    ('Peter', 'Griffin', 'peter@greenriver.edu', 19, 'Not Actively Searching', 'Ernie'),
    ('Ernie', 'The Giant Chicken', 'ernie@greenriver.edu', 19, 'Seeking Job', 'Peter Griffin'),
    ('John', 'Doe', 'john@greenriver.edu', 19, 'Seeking internship', 'Web Developer'),
    ('Jane', 'Doe', 'jane@greenriver.edu', 19, 'Seeking internship', 'Data Analyst');
-- --------------------------------------------------------
--
-- Table Structure for table `applications`
--
CREATE TABLE IF NOT EXISTS `applications` (
    `application_id` int(6) NOT NULL AUTO_INCREMENT,
    `application_name` varchar(150) DEFAULT NULL,
    `application_url` varchar(150) DEFAULT NULL,
    `application_date` varchar(30) DEFAULT NULL,
    `application_status` varchar(30) DEFAULT NULL,
    `application_updates` varchar(150) DEFAULT NULL,
    `application_followUp` varchar(30) DEFAULT NULL,
    PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `applications`
--
INSERT INTO `applications` (`application_name`, `application_url`, `application_date`, `application_status`, `application_updates`, `application_followUp`)
VALUES
    ('Web Developer @Amazon', 'https://amazon.com', '2024-01-11', 'Applied', 'None yet', '2024-01-25'),
    ('Data Analyst @Microsoft', 'https://microsoft.com', '2024-01-12', 'Applied', 'None yet', '2024-01-26'),
    ('Product Manager @Google', 'https://google.com', '2024-01-14', 'Interviewing', 'Completed first round of Interviews', '2024-01-28'),
    ('Systems Engineer @Dassault Systèmes', 'https://3ds.com', '2024-01-17', 'Rejected', 'Ghosted', '2024-01-31');
-- --------------------------------------------------------
--
-- Table Structure for table `announcements`
--
CREATE TABLE IF NOT EXISTS `announcements` (
    `announcement_id` int(6) NOT NULL AUTO_INCREMENT,
    `announcement_date` varchar(30) DEFAULT NULL,
    `announcement_title` varchar(300) DEFAULT NULL,
    `announcement_job_type` varchar(30) DEFAULT NULL,
    `announcement_location` varchar(50) DEFAULT NULL,
    `announcement_employer` varchar(50) DEFAULT NULL,
    `announcement_additional_info` varchar(150) DEFAULT NULL,
    `announcement_url` varchar(150) DEFAULT NULL,
    PRIMARY KEY (`announcement_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `announcements`
--
INSERT INTO `announcements` (`announcement_date`, `announcement_title`, `announcement_job_type`, `announcement_location`, `announcement_employer`, `announcement_additional_info`, `announcement_url`)
VALUES
    ('2024-01-11', 'UX UI Designer', 'Internship', 'Seattle', 'Meta', '20-40 hours/week', 'https://meta.com'),
    ('2024-01-12', 'Database Administrator', 'Job', 'Seattle', 'Boeing', 'Hybrid', 'https://boeing.com'),
    ('2024-01-13', 'Front End web developer', 'Internship', 'Seattle', 'Adobe', 'On-Site', 'https://adobe.com'),
    ('2024-01-14', 'Data Engineer', 'Job', 'Seattle', 'Amazon', 'Remote', 'https://amazon.com');