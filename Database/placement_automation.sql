SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `placement_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(100) NOT NULL,
  `comp_city` varchar(100) NOT NULL,
  `comp_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `company` VALUES
('1','Infosys','Mysore','https://www.infosys.com/ar-vr/mysore360.html'),
('2','Samsung','Bangalore','https://research.samsung.com/sri-b'),
('3','Microsoft','Hyderabad','https://www.microsoft.com/en-in/msidc/hyderabad-campus.aspx');
-- --------------------------------------------------------

--
-- Table structure for table `drive`
--

CREATE TABLE `drive` (
  `drive_id` int(11) NOT NULL,
  `drive_title` varchar(200) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `job_position` varchar(100) NOT NULL,
  `job_profile` text NOT NULL,
  `dod` date NOT NULL,
  `salary` int(11) NOT NULL,
  `ssc_result` float NOT NULL,
  `hsc_result` float NOT NULL,
  `graduation_result` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `drive` VALUES
('51','INTERNSHIP','1','Full Stack Developer','BE-CSE,BE-IT','02/04/2021','30000','80.0','80.0','9.00'),
('52','INTERNSHIP','3','Consultant Intern','BE-CSE,BE-IT,BE-ECE','01/04/2021','25000','70.0','70.0','8.5');
UPDATE drive SET dod='2021-05-14' WHERE drive_id=51;
UPDATE drive SET dod='2021-05-10' WHERE drive_id=52;
UPDATE drive SET drive_title='INFOSYS_INTERN' WHERE drive_id=51;
UPDATE drive SET drive_title='MICROSOFT_INTERN' WHERE drive_id=52;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `date_of_registration` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `users` (`user_id`,`user_name`,`user_email`,`user_pass`) VALUES
('101','ADWIN','rahulananth12@gmail.com','guru'),
('102','ANANTH','anantharoobanbr@gmail.com','guru'),
('103','ROOBAN','branantharooban@gmail.com','guru');
-- --------------------------------------------------------

--
-- Table structure for table `enrolled_students`
--

CREATE TABLE `enrolled_students` (
  `user_id` int(11) NOT NULL,
  `drive_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `enrolled_students` VALUES
('101','51'),
('103','52');
-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `dob` varchar(50) NOT NULL,
  `ssc_marks` float NOT NULL,
  `hsc_marks` float NOT NULL,
  `graduation_discipline` varchar(100) NOT NULL,
  `graduation` varchar(100) NOT NULL,
  `graduation_marks` float DEFAULT NULL,
  -- `post_graduation` varchar(100),
  -- `post_graduation_discipline` varchar(100),
  -- `post_graduation_marks` float DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `resume` varchar(100),
  `profile_image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `profile` (`dob`,`ssc_marks`,`hsc_marks`,`graduation_discipline`, `graduation`,`graduation_marks``gender`,`uid`,`mobile`) VALUES
('21-12-2000','95.7'.'98.4','BE','CSE','9.34','Male','101','7598893621'),
('12-03-2000','96.7'.'97.4','BE','CSE','9.65','Male','102','9952272172'),
('12-03-2001','99.0'.'98.0','BE','CSE','9.69','Male','103','9600896680');
UPDATE `profile` SET dob="12/03/2001" WHERE uid=103;
UPDATE `profile` SET dob="12/03/2000" WHERE uid=102;
UPDATE `profile` SET dob="21/12/2000" WHERE uid=101;
UPDATE `profile` SET graduation="BE",graduation_discipline="CSE" WHERE uid=101;
UPDATE `profile` SET graduation="BE",graduation_discipline="CSE" WHERE uid=102;
UPDATE `profile` SET graduation="BE",graduation_discipline="CSE" WHERE uid=103;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `drive`
--
ALTER TABLE `drive`
  ADD PRIMARY KEY (`drive_id`),
  ADD KEY `f3` (`comp_id`);

--
-- Indexes for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  ADD KEY `f2` (`user_id`),
  ADD KEY `f1` (`drive_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `drive`
--
ALTER TABLE `drive`
  MODIFY `drive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `drive`
--
ALTER TABLE `drive`
  ADD CONSTRAINT `f3` FOREIGN KEY (`comp_id`) REFERENCES `company` (`comp_id`);

--
-- Constraints for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  ADD CONSTRAINT `f1` FOREIGN KEY (`drive_id`) REFERENCES `drive` (`drive_id`),
  ADD CONSTRAINT `f2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `f4` FOREIGN KEY (`uid`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
