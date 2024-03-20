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
DROP TABLE IF EXISTS announcements;
-- --------------------------------------------------------
--
-- Table Structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(6) NOT NULL AUTO_INCREMENT,
    `user_first` varchar(30) DEFAULT NULL,
    `user_last` varchar(30) DEFAULT NULL,
    `user_email` varchar(75) DEFAULT NULL,
    `user_password_hash` varchar(255) DEFAULT NULL,
    `user_cohort` int(2) DEFAULT 0,
    `user_job_status` varchar(30) DEFAULT NULL,
    `user_seeking` varchar(150) DEFAULT NULL,
    `is_admin` BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `users`
--
INSERT INTO `users` (`user_first`, `user_last`, `user_email`, `user_password_hash`, `user_cohort`, `user_job_status`, `user_seeking`, `is_admin`)
VALUES
    ('John', 'Doe', 'john.doe@example.com', '$2y$12$GEJqlZObG6ZDVt/BnmMcwOSTXq32QVfG2/4yQm.vVRiYTKrb3uBGm', 19, 'Seeking internship', 'Software Engineer', false), -- password
    ('Jane', 'Smith', 'jane.smith@example.com', '$2y$12$R4edOkWimUOMZCMWCh8r/OnzvnIo0XvYADhmV4oKTlZ8wDeWtMLWi',  19, 'Seeking internship', 'Data Scientist', false), -- password
    ('Alice', 'Johnson', 'alice.johnson@example.com', '$2y$12$rS7GQwBabKQARh9qx3DLvO5IntPWn6uwseG7EW6O7pAeuIQ/UeRIK', 19, 'Not actively searching', 'Project Manager', false), -- 123456
    ('Bob', 'Williams', 'bob.williams@example.com', '$2y$12$h3YdxNv14cBRit0H28ALueMuYm7DhEbhz.2uCacO.u1KK4.b3K/ZC', 19, 'Seeking job', 'UX Designer', false), -- qwerty
    ('Administrator', 'Administrator', 'admin@example.com', '$2y$12$zXcq5SlznwM5ot4nqdeXYO.UPY43..Ijp8YJF/2pl2cay9vwqWsBq', 19, 'Seeking job', 'Database Administrator', true); -- admin
-- --------------------------------------------------------
--
-- Table Structure for table `applications`
--
CREATE TABLE IF NOT EXISTS `applications` (
    `application_id` int(6) NOT NULL AUTO_INCREMENT,
    `user_id` int(6) NOT NULL,
    `application_name` varchar(150) DEFAULT NULL,
    `application_url` varchar(150) DEFAULT NULL,
    `application_date` varchar(30) DEFAULT NULL,
    `application_status` varchar(30) DEFAULT NULL,
    `application_updates` varchar(150) DEFAULT NULL,
    `application_followUp` varchar(30) DEFAULT NULL,
    `is_deleted` BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (`application_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `applications`
--
INSERT INTO `applications` (`user_id`, `application_name`, `application_url`, `application_date`, `application_status`, `application_updates`, `application_followUp`)
VALUES
    (5, 'Web Developer @Amazon', 'https://amazon.com', '2024-01-11', 'Applied', 'None yet', '2024-01-25'),
    (5, 'Data Analyst @Microsoft', 'https://microsoft.com', '2024-01-12', 'Applied', 'None yet', '2024-01-26'),
    (5, 'Product Manager @Google', 'https://google.com', '2024-01-14', 'Interviewing', 'Completed first round of Interviews', '2024-01-28'),
    (1, 'Systems Engineer @Dassault Systemes', 'https://3ds.com', '2024-01-17', 'Rejected', 'Ghosted', '2024-01-31');
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