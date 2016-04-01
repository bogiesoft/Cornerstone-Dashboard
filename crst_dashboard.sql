-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2016 at 10:10 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crst_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive_jobs`
--

CREATE TABLE `archive_jobs` (
  `job_id` int(11) NOT NULL,
  `client_name` varchar(45) NOT NULL,
  `project_name` varchar(45) NOT NULL,
  `ticket_date` date NOT NULL,
  `due_date` date NOT NULL,
  `created_by` varchar(5) NOT NULL,
  `estimate_number` varchar(10) NOT NULL,
  `special_instructions` text NOT NULL,
  `data_loc` varchar(80) NOT NULL,
  `records_total` int(11) NOT NULL,
  `domestic` int(11) NOT NULL,
  `foreigns` int(11) NOT NULL,
  `data_source` varchar(80) NOT NULL,
  `data_received` date NOT NULL,
  `data_completed` date NOT NULL,
  `processed_by` varchar(5) NOT NULL,
  `dqr_sent` date NOT NULL,
  `exact` varchar(15) NOT NULL,
  `mail_foreigns` varchar(15) NOT NULL,
  `household` varchar(15) NOT NULL,
  `noca` varchar(15) NOT NULL,
  `mail_class` varchar(45) NOT NULL,
  `rate` varchar(45) NOT NULL,
  `processing_category` varchar(45) NOT NULL,
  `mail_dim` varchar(45) NOT NULL,
  `weights_measures` varchar(45) NOT NULL,
  `permit` varchar(45) NOT NULL,
  `bmeu` varchar(45) NOT NULL,
  `based_on` varchar(45) NOT NULL,
  `non_profit_number` int(11) NOT NULL,
  `materials_ordered` date NOT NULL,
  `expected` date NOT NULL,
  `received` date NOT NULL,
  `location` varchar(80) NOT NULL,
  `checked_in` varchar(45) NOT NULL,
  `material` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor` varchar(45) NOT NULL,
  `expected_quantity` varchar(15) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `size` varchar(15) NOT NULL,
  `completed_date` date NOT NULL,
  `data_hrs` int(11) NOT NULL,
  `gd_hrs` int(11) NOT NULL,
  `initialrec_count` int(11) NOT NULL,
  `manual` int(11) NOT NULL,
  `uncorrected` int(11) NOT NULL,
  `unverifiable` int(11) NOT NULL,
  `loose` int(11) NOT NULL,
  `householded` int(11) NOT NULL,
  `basic` int(11) NOT NULL,
  `ncoa_errors` int(11) NOT NULL,
  `final_count` int(11) NOT NULL,
  `postage` varchar(45) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `residual_returned` varchar(45) NOT NULL,
  `2week_followup` varchar(45) NOT NULL,
  `notes` text NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blue_sheet`
--

CREATE TABLE `blue_sheet` (
  `job_id` int(11) NOT NULL,
  `completed_date` date NOT NULL,
  `data_hrs` int(11) NOT NULL,
  `gd_hrs` int(11) NOT NULL,
  `initialrec_count` int(11) NOT NULL,
  `manual` int(11) NOT NULL,
  `uncorrected` int(11) NOT NULL,
  `unverifiable` int(11) NOT NULL,
  `foreigns` int(11) NOT NULL,
  `exact` int(11) NOT NULL,
  `loose` int(11) NOT NULL,
  `householded` int(11) NOT NULL,
  `basic` int(11) NOT NULL,
  `ncoa_errors` int(11) NOT NULL,
  `ncoa` int(11) NOT NULL,
  `final_count` int(11) NOT NULL,
  `domestic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_info`
--

CREATE TABLE `client_info` (
  `client_name` varchar(45) NOT NULL,
  `client_add` varchar(45) NOT NULL,
  `contact_name` varchar(45) NOT NULL,
  `contact_phone` varchar(45) NOT NULL,
  `contact_email` varchar(45) NOT NULL,
  `sec1` varchar(70) NOT NULL,
  `sec2` varchar(70) NOT NULL,
  `sec3` varchar(70) NOT NULL,
  `vendor_contact` varchar(70) NOT NULL,
  `category` varchar(80) NOT NULL,
  `website` varchar(90) NOT NULL,
  `notes` text NOT NULL,
  `title` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_info`
--

INSERT INTO `client_info` (`client_name`, `client_add`, `contact_name`, `contact_phone`, `contact_email`, `sec1`, `sec2`, `sec3`, `vendor_contact`, `category`, `website`, `notes`, `title`) VALUES
('', '', 'Anna', '', '', '', '', '', '', '', '', '', ''),
('Anna', '', '', '', '', '', '', '', '', '', '', '', ''),
('DickButt', '7 Hawkins St Awe', 'Kevin McReady Awe', '3474050304Awe', 'kevin.mcready@yahoo.com', '7183263163', '', '', '', 'BUsinessman', 'kevinmcready.com', 'Just a boss Awe', 'President'),
('Femina', '8 Southside Awesome', 'Femina Awesome Patel', '1234567890Awe', 'femina@gmail.comAwe', ' 2112345566Awe', '', '', '', 'studentAwe', 'sbdbjsfj.comAwe', 'Awedsf etgrrkjngkdfkgl  vng gjhjhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhg       dfjlads fkdslg               elfkldk fl;drk lfkldrjfklr jfji riooooooot', 'AweCircular progress bar (canvas)'),
('Femina1', '8 Southside Ave', 'Femina Patel', '1234567890', 'femina@gmail.com', '1231231230', '', '', '', 'student', 'sbdbjsfj.com', 'ermtr hyt y ju', 'Circular progress bar (canvas)'),
('Somebody', '31 CRST', 'HI ', '111-111-1111', 'sb@gmail.com', '454-545-5545', '', '', '', 'Artist', 'dfnkjjkgd.com', 'sd fefgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfge', 'CEO');

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `title` varchar(45) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `job_id` int(11) NOT NULL,
  `postage` varchar(3) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `residual_returned` varchar(45) NOT NULL,
  `2week_followup` varchar(45) NOT NULL,
  `notes` text NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_ticket`
--

CREATE TABLE `job_ticket` (
  `job_id` int(45) NOT NULL,
  `client_name` varchar(45) NOT NULL,
  `project_name` varchar(45) NOT NULL,
  `ticket_date` date NOT NULL,
  `due_date` date NOT NULL,
  `created_by` varchar(2) NOT NULL,
  `estimate_number` varchar(10) NOT NULL,
  `special_instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_data`
--

CREATE TABLE `mail_data` (
  `job_id` int(11) NOT NULL,
  `data_loc` varchar(80) NOT NULL,
  `records_total` int(11) NOT NULL,
  `domestic` int(11) NOT NULL,
  `foreigns` int(45) NOT NULL,
  `data_source` varchar(45) NOT NULL,
  `data_received` date NOT NULL,
  `data_completed` date NOT NULL,
  `processed_by` varchar(45) NOT NULL,
  `dqr_sent` date NOT NULL,
  `exact` varchar(3) NOT NULL,
  `mail_foreigns` varchar(3) NOT NULL,
  `household` varchar(3) NOT NULL,
  `ncoa` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_info`
--

CREATE TABLE `mail_info` (
  `job_id` int(11) NOT NULL,
  `mail_class` varchar(45) NOT NULL,
  `rate` varchar(45) NOT NULL,
  `processing_category` varchar(45) NOT NULL,
  `mail_dim` varchar(45) NOT NULL,
  `weights_measures` varchar(15) NOT NULL,
  `permit` varchar(45) NOT NULL,
  `bmeu` varchar(45) NOT NULL,
  `based_on` varchar(45) NOT NULL,
  `non_profit_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `job_id` int(11) NOT NULL,
  `materials_ordered` date NOT NULL,
  `expected` date NOT NULL,
  `received` date NOT NULL,
  `location` varchar(15) NOT NULL,
  `checked_in` varchar(3) NOT NULL,
  `material` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor` varchar(45) NOT NULL,
  `expected_quantity` varchar(15) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `user` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timestamp`
--

CREATE TABLE `timestamp` (
  `user` varchar(45) NOT NULL,
  `time` varchar(70) NOT NULL,
  `job` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user`, `password`) VALUES
('fpatel', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_name` varchar(45) NOT NULL,
  `vendor_contact` varchar(45) NOT NULL,
  `vendor_add` varchar(45) NOT NULL,
  `vendor_email` varchar(45) NOT NULL,
  `vendor_phone` varchar(45) NOT NULL,
  `vendor_website` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_name`, `vendor_contact`, `vendor_add`, `vendor_email`, `vendor_phone`, `vendor_website`) VALUES
('1', '2', '3', 'vendor_email', '4', 'vendor_website'),
('Femina', 'Femina P', '5 South', 'f@gmail.com', '2223334545', 'f.com'),
('hello', '', '', 'vendor_email', '', 'vendor_website'),
('Jezz', 'F Patel', '145 Main', 'vendor_email', '7878787878', 'vendor_website'),
('Kevin', 'Kevin Mc', '31 crst', 'k@gmail.com', '1234567896', 'k.com');

-- --------------------------------------------------------

--
-- Table structure for table `w_and_m`
--

CREATE TABLE `w_and_m` (
  `vendor` varchar(45) NOT NULL,
  `material` varchar(45) NOT NULL,
  `size` varchar(45) NOT NULL,
  `height` varchar(45) NOT NULL,
  `weight` varchar(45) NOT NULL,
  `based_on` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `w_and_m`
--

INSERT INTO `w_and_m` (`vendor`, `material`, `size`, `height`, `weight`, `based_on`) VALUES
('Femina', 'postcard', '15 * 11', '1.25"', '0.65', '10'),
('Femina', 'envelop', '25 * 2.2', '7.9', '9.3', '15'),
('Kevin', 'envelopes', '6 * 9', '1.25"', '0.8', '25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_info`
--
ALTER TABLE `client_info`
  ADD UNIQUE KEY `clientname` (`client_name`);

--
-- Indexes for table `job_ticket`
--
ALTER TABLE `job_ticket`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `jobid` (`job_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_ticket`
--
ALTER TABLE `job_ticket`
  MODIFY `job_id` int(45) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
