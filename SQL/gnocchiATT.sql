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
    `user_id` int(6) NOT NULL DEFAULT '0',
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
INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_cohort`, `user_job_status`, `user_seeking`)
VALUES
    (1, 'Peter', 'Griffin', 'peter@greenriver.edu', 19, 'Not Actively Searching', 'Ernie'),
    (2, 'Ernie', 'The Giant Chicken', 'ernie@greenriver.edu', 19, 'Seeking Job', 'Peter Griffin'),
    (3, 'John', 'Doe', 'john@greenriver.edu', 19, 'Seeking internship', 'Web Developer'),
    (5, 'Jane', 'Doe', 'jane@greenriver.edu', 19, 'Seeking internship', 'Data Analyst');
-- --------------------------------------------------------
--
-- Table Structure for table `applications`
--
CREATE TABLE IF NOT EXISTS `applications` (
    `application_id` int(6) NOT NULL DEFAULT '0',
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
INSERT INTO `applications` (`application_id`, `application_name`, `application_url`, `application_date`, `application_status`, `application_updates`, `application_followUp`)
VALUES
    (1, 'Web Developer @Amazon', 'https://amazon.com', '2024-01-11', 'Applied', 'None yet', '2024-01-25'),
    (2, 'Data Analyst @Microsoft', 'https://microsoft.com', '2024-01-12', 'Applied', 'None yet', '2024-01-26'),
    (3, 'Product Manager @Google', 'https://google.com', '2024-01-14', 'Interviewing', 'Completed first round of Interviews', '2024-01-28'),
    (4, 'Systems Engineer @Dassault Systèmes', 'https://3ds.com', '2024-01-17', 'Rejected', 'Ghosted', '2024-01-31');
-- --------------------------------------------------------