-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2016 at 10:57 PM
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
CREATE DATABASE IF NOT EXISTS `crst_dashboard` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crst_dashboard`;

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
  `materials_ordered` date NOT NULL,
  `materials_expected` date NOT NULL,
  `expected_quantity` int(11) NOT NULL,
  `job_status` varchar(45) NOT NULL,
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
  `ncoa` varchar(15) NOT NULL,
  `mail_class` varchar(45) NOT NULL,
  `rate` varchar(45) NOT NULL,
  `processing_category` varchar(45) NOT NULL,
  `mail_dim` varchar(45) NOT NULL,
  `weights_measures` varchar(45) NOT NULL,
  `permit` varchar(45) NOT NULL,
  `bmeu` varchar(45) NOT NULL,
  `based_on` varchar(45) NOT NULL,
  `non_profit_number` int(11) NOT NULL,
  `received` date NOT NULL,
  `location` varchar(80) NOT NULL,
  `checked_in` varchar(45) NOT NULL,
  `material` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor` varchar(45) NOT NULL,
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
  `bs_foreigns` int(11) NOT NULL,
  `bs_exact` int(11) NOT NULL,
  `bs_ncoa` int(11) NOT NULL,
  `bs_domestic` int(11) NOT NULL,
  `postage` varchar(45) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `residual_returned` varchar(45) NOT NULL,
  `2week_followup` varchar(45) NOT NULL,
  `notes` text NOT NULL,
  `status` varchar(45) NOT NULL,
  `reason` varchar(45) NOT NULL,
  `hold_postage` varchar(45) NOT NULL,
  `postage_paid` varchar(45) NOT NULL,
  `print_template` text NOT NULL,
  `special_address` text NOT NULL,
  `delivery` varchar(45) NOT NULL,
  `tasks` text NOT NULL,
  `task1` varchar(45) NOT NULL,
  `task2` varchar(45) NOT NULL,
  `task3` varchar(45) NOT NULL,
  `archive_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archive_jobs`
--

INSERT INTO `archive_jobs` (`job_id`, `client_name`, `project_name`, `ticket_date`, `due_date`, `created_by`, `estimate_number`, `special_instructions`, `materials_ordered`, `materials_expected`, `expected_quantity`, `job_status`, `data_loc`, `records_total`, `domestic`, `foreigns`, `data_source`, `data_received`, `data_completed`, `processed_by`, `dqr_sent`, `exact`, `mail_foreigns`, `household`, `ncoa`, `mail_class`, `rate`, `processing_category`, `mail_dim`, `weights_measures`, `permit`, `bmeu`, `based_on`, `non_profit_number`, `received`, `location`, `checked_in`, `material`, `type`, `quantity`, `vendor`, `height`, `weight`, `size`, `completed_date`, `data_hrs`, `gd_hrs`, `initialrec_count`, `manual`, `uncorrected`, `unverifiable`, `loose`, `householded`, `basic`, `ncoa_errors`, `final_count`, `bs_foreigns`, `bs_exact`, `bs_ncoa`, `bs_domestic`, `postage`, `invoice_number`, `residual_returned`, `2week_followup`, `notes`, `status`, `reason`, `hold_postage`, `postage_paid`, `print_template`, `special_address`, `delivery`, `tasks`, `task1`, `task2`, `task3`, `archive_date`) VALUES
(1, 'ABC COMPANY', 'print it', '2016-05-11', '2016-05-21', 'JS', '45', '', '0000-00-00', '2016-05-18', 0, 'in Production', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '1st class', '123', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:46 am'),
(4, 'DickButt', 'loves to work', '2016-04-07', '2016-04-09', 'AB', '1234', 'fdhj ', '2016-04-23', '2016-04-28', 12, 'on hold', ' c ll wer vg', 12, 96, 456, 'fgfgt', '2016-04-07', '2016-04-21', 'FP', '2016-04-06', '32', '86', '867', '876', 'asd', 'dsf', 'bf', 'fg', 'gd', 'dg', 'fg', 'fg', 123, '2016-04-21', 'sfsdg', 'FP', 'envelopes', 'sd', 1224, 'Jezz', 12, 75, '57', '2016-04-07', 2, 5, 8, 87, 78, 8, 87, 87, 8, 54, 78, 876, 867, 787, 54, 'cvb', 123, 'vnbv', 'vnb', 'fgvf jh j ', 'Finished', 'work done', 'yes', 'no', 'sdsfdbv', 'fhghnj', 'ghj', 'Mail Merge, Letter Printing, In-House Envelope Printing', 'd', 'dftg', 'trg', '0000-00-00'),
(5, 'Femina', 'go there and come back', '2016-04-06', '2016-04-15', 'JS', '123', 'fgjhd sdfkjjk\r\ndfdg', '2016-04-12', '2016-04-21', 12, 'waiting for data', 'C drive', 12, 2, 2, '4', '2016-04-14', '2016-04-22', 'MB', '2016-04-08', '2', '2', '3', '5', '12', '12', '452', '54', '7', '5', '74', '57', 74, '2016-04-12', 'sfsdg', 'FP', '', '', 123, 'Jezz', 123, 456, '56', '2016-04-06', 3, 1, 12, 63, 5, 4, 5, 8, 546, 5, 5, 45, 7, 5, 54, '123', 1234, 'fdg', 'fghgfhj', 'sdd f f yhg', 'Finished', 'done', 'no', 'yes', 'cgvcb', 'cb', 'vb', 'Mail Merge, Tabbing', 'sds', 'fs', 'f', '0000-00-00'),
(6, 'ABC COMPANY', 'print it', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', 'what so ever', 'no', 'no', '', '', '', '', '', '', '', '0000-00-00'),
(7, 'Simpsons', 'drinks water', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'April 25, 2016, 12:55 pm'),
(8, 'john Snow', 'kills', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 12345, '', '', 'g,hj.j mhl.', 'Finished', 'gui.jik', 'no', 'no', '', '', '', '', '', '', '', 'April 26, 2016, 9:47 am'),
(9, 'ABC COMPANY', '12345', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'RP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-04-12', '', '', '', '', 0, 'Femina', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 123, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:32 am'),
(10, 'Simpsons', 'Hello There', '2016-05-04', '2016-05-26', 'JS', '123', 'la la la la', '2016-05-11', '2016-05-11', 1263, 'waiting for data', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '123', '12', '', '', '', '', '', '', 0, '2016-05-18', '', 'FP', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:29 am'),
(11, 'Somebody', 'is a ghost', '2016-05-17', '2016-05-28', 'KM', '789', '', '2016-05-04', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:26 am'),
(12, 'Femina', 'Yellow Sheet', '0000-00-00', '2016-05-19', 'FP', '', '', '0000-00-00', '0000-00-00', 0, 'in P.M.', '', 123, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '1st class', '1230', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:23 am'),
(13, '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 2, 2016, 11:59 am'),
(14, 'Femina', 'Print', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:39 am'),
(15, 'john Snow', 'dies', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:41 am'),
(5501, 'john Snow', 'dies', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:47 am'),
(5502, 'Somebody', 'rebel', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 9:47 am'),
(5503, 'Somebody', 'go home', '0000-00-00', '0000-00-00', '', '', 'jdghkjfdhkgllg dbvfjdgkj f dfhg idfjgf\r\nsdfjshjgkhuf  jdflgkjhkj \r\nfgjfdihg\r\n fdgjifjgo fgklhkl\r\n rgkj r jgtfrjgko fdgjthkjgf dslrksltk\r\ndfgkl kh g tkljlo,gfhkolytiu \r\nrtgr myk fgt;l ty', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 11:22 am'),
(5504, 'Simpsons', 'play', '2016-05-16', '2016-05-19', 'JS', '', '', '0000-00-00', '0000-00-00', 0, 'on hold', '', 123, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 11:24 am'),
(5505, 'ABC COMPANY', 'nail it', '2016-05-03', '2016-05-21', 'KM', '', '', '0000-00-00', '0000-00-00', 0, 'in Production', '', 456, 0, 0, '', '0000-00-00', '0000-00-00', 'RP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 11:49 am'),
(5506, 'Somebody', 'adsfds', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-05-03', '', '', '', '', 0, 'Femina', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 11:51 am'),
(5507, 'ABC COMPANY', 'loves to work', '0000-00-00', '0000-00-00', '', '', 'safsdgdfhb th tjyj uyk uikuik uil , lui\r\nsafsdgdfhb th tjyj uyk uikuik uil , lui\r\nsafsdgdfhb th tjyj uyk uikuik uil , lui\r\nsafsdgdfhb th tjyj uyk uikuik uil , lui\r\nsafsdgdfhb th tjyj uyk uikuik uil , lui\r\nsafsdgdfhb th tjyj uyk uikuik uil , lui\r\n', '0000-00-00', '0000-00-00', 0, 'on hold', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'RP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-05-02', '123', '76', 'bday', 'small', 34, 'Femina123', 12, 10, '12', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', '', '', '', '', '', '', '', '', '', 'May 9, 2016, 2:27 pm'),
(5508, 'john Snow', 'climbes', '2016-05-04', '2016-05-12', 'Jess', '544040', 'Mail Foreigns: Yes\r\nHousehold: NO\r\nNCOA: Yes\r\n\r\nPROJECT MANAGEMENT:\r\n\r\nPRODUCTION:\r\n\r\nCUSTOMER SERVICE:\r\n\r\nfajlkfjealkfjealkjflkeajlkfejkla', '2016-05-04', '2016-05-06', 3000, 'in P.M.', '', 2500, 2000, 500, '', '2016-05-04', '2016-05-05', 'RP', '2016-05-12', '50', 'YES', 'YES', '', 'First Class', 'Auto', 'Letter', '#10 Envelope', '.75 in x .45 lb', '473', 'Newburgh, NY 12550', '50', 103838, '2016-05-17', 'somewhere123', 'Jim', 'envelopes', 'large', 123, 'Kevin', 96, 80, '4', '0000-00-00', 2, 0, 2091, 5, 2, 1, 1, 0, 4, 10, 2000, 10, 2, 25, 2500, '', 0, '', '', '', 'Finished', '', '', '', '', '', '', '', '', '', '', 'May 31, 2016, 5:02 pm'),
(5510, 'Simpsons', 'loves to work', '2016-05-03', '2016-05-04', 'JS', '', '', '0000-00-00', '0000-00-00', 0, 'waiting for materials', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-05-10', '', '', '', '', 0, 'Femina', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 3:06 pm'),
(5511, 'ABC COMPANY', 'rebel', '2016-05-04', '2016-05-10', 'FP', '1236', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'RP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 85520, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 1:40 pm'),
(5512, 'Femina', 'makes website', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-05-05', '31 Front', 'Kev', '6x9 One Side Postcard', 'card', 4000, 'Femina123', 2, 1, '6x9', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$18', 22929, 'YES', 'Paid postage and invoice', 'We had to deliver to Westchester', 'Finished', 'Job is printed and completed', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 3:30 pm'),
(5513, 'Simpsons', 'loves to work', '2016-05-03', '2016-05-04', 'JS', '', '', '0000-00-00', '0000-00-00', 0, 'waiting for materials', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'yes', 'yes', '', '', '', '', '', '', '', 'May 4, 2016, 3:07 pm');

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
  `bs_foreigns` int(11) NOT NULL,
  `bs_exact` int(11) NOT NULL,
  `loose` int(11) NOT NULL,
  `householded` int(11) NOT NULL,
  `basic` int(11) NOT NULL,
  `ncoa_errors` int(11) NOT NULL,
  `bs_ncoa` int(11) NOT NULL,
  `final_count` int(11) NOT NULL,
  `bs_domestic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_sheet`
--

INSERT INTO `blue_sheet` (`job_id`, `completed_date`, `data_hrs`, `gd_hrs`, `initialrec_count`, `manual`, `uncorrected`, `unverifiable`, `bs_foreigns`, `bs_exact`, `loose`, `householded`, `basic`, `ncoa_errors`, `bs_ncoa`, `final_count`, `bs_domestic`) VALUES
(5509, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5514, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5515, '0000-00-00', 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5516, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5517, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5518, '2016-06-22', 5, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5519, '2016-06-10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0),
(5520, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5521, '0000-00-00', 2, 0, 2091, 5, 2, 1, 10, 2, 1, 0, 4, 10, 25, 2000, 2500),
(5522, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5523, '2016-05-26', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5524, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5530, '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
('Femina1', '8 Southside Avesdfsf', 'Femina Patel', '1234567890', 'femina@gmail.com', '1231231230', '', '', '', 'student', 'sbdbjsfj.com', 'new note', 'Circular progress bar (canvas)'),
('james', '987', 'issac newtron', 'lkjlkjlk', 'lkjlkj', 'kjlk', '', '', '', 'lkjlk', 'lkjlkj', 'llkj', 'lklkj'),
('Jill Lewis', 'lkj', 'l', 'lkjlk', 'jlkj', 'lk', '', '', '', 'lkj', 'jlkjlkj', 'lkjlk', 'lkj'),
('jimmy', 'lkjlk', 'kiki', '098098098', 'lkjlkj', '0980989', '', '', '', 'lkjlkj', 'lkjlkj', 'yooo', 'lkjlkj'),
('Led Zeppelin', 'jlkj', 'lkjlk', 'ljlk', 'jlk', 'jlkj', '', '', '', 'jlk', 'lklkj', 'lkjlkj', 'jlk'),
('New Client', 'kljlk', 'Client', 'kljlklkj', 'lkjlklk', 'lkjlkjlkjl', '', '', '', 'lkllkjk', 'lkjlkj', 'lkj', 'lkjlkj'),
('po pot', 'lkjlkj', 'kjlkj', 'kljlkj', 'lkjlkj', 'ljklj', '', '', '', 'lkjlkj', 'ljlkj', 'lkjlkj', 'lkjlkj'),
('poipoi', '98', 'lkjklj', '09097097', 'lkklj', '0980980', '', '', '', 'kljlkj', 'lkjlkj', 'lklj', 'lkjlkjl'),
('Steve', '234 dfsdf', 'Stevo', '233 454 2343', 'T@r.com', '234 676 2342', '', '', '', 'trtert', 'www.gdf.vom', 'dgdfg', 'werw'),
('uoiuoiu', 'oiuoiuoiu', 'oiuoiuoi', 'oiuoiuiou', 'oiuou', 'oiuoiu', '', '', '', 'oiuoiuoi', 'oiuoiu', 'oiuoiui', 'iuoiu'),
('Yo', 'lkj', 'Dude', 'lkj', 'lkj', 'lkj', '', '', '', 'lkj', 'lkj', 'lkj', 'lkj');

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `title` varchar(45) NOT NULL,
  `text` text NOT NULL,
  `user` varchar(15) NOT NULL,
  `timestamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documentation`
--

INSERT INTO `documentation` (`title`, `text`, `user`, `timestamp`) VALUES
('Brother Earth', 'hello brother awe', '', '0000-00-00'),
('Father Earth', 'faaaaaaaaatttttttttttttttttthhhhhhhhhhhhherrrrrrrrrrrrr\r\nmmmmmmmmoooooooooooottttthhhhhherrrrrrrrrr\r\nchild', '', '0000-00-00'),
('femina', 'works', 'fpatel', '2016-04-22'),
('jezz', 'is adorable', 'fpatel', '2016-04-22'),
('kevin', 'rocks', 'fpatel', '2016-04-22'),
('lkjlkj', 'lkjlkjlk', 'sayre', '2016-06-13'),
('Mother Earth', 'do this awe awe \r\n\r\ndo that awe \r\n\r\nalsoooooooooooooooooooooo do this and this and this\r\nThis is a new line\r\n', 'fpatel', '2016-04-12'),
('Sample', 'Hello', 'sayre', '2016-06-13'),
('Sister Earth', 'sister', 'fpatel', '0000-00-00');

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
  `status` varchar(45) NOT NULL,
  `reason` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`job_id`, `postage`, `invoice_number`, `residual_returned`, `2week_followup`, `notes`, `status`, `reason`) VALUES
(5509, '', 0, '', '', '', '', ''),
(5514, '', 0, '', '', '', '', ''),
(5515, '', 0, '', '', '', '', ''),
(5516, '', 0, '', '', '', '', ''),
(5517, '', 0, '', '', '', '', ''),
(5518, '', 0, '', '', '', '', ''),
(5519, '', 0, '', '', '', '', ''),
(5520, '', 0, '', '', '', '', ''),
(5521, '', 0, '', '', '', '', ''),
(5522, '', 0, '', '', '', '', ''),
(5523, '', 0, '', '', '', '', ''),
(5524, '', 0, '', '', '', '', ''),
(5530, '', 0, '', '', '', '', '');

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
  `created_by` varchar(5) NOT NULL,
  `estimate_number` varchar(10) NOT NULL,
  `special_instructions` text NOT NULL,
  `materials_ordered` date NOT NULL,
  `materials_expected` date NOT NULL,
  `expected_quantity` int(11) NOT NULL,
  `job_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_ticket`
--

INSERT INTO `job_ticket` (`job_id`, `client_name`, `project_name`, `ticket_date`, `due_date`, `created_by`, `estimate_number`, `special_instructions`, `materials_ordered`, `materials_expected`, `expected_quantity`, `job_status`) VALUES
(5509, 'Simpsons', 'go home', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5514, 'Simpsons', 'loves to work', '2016-05-03', '2016-05-04', 'JS', '', '', '0000-00-00', '0000-00-00', 0, 'waiting for materials'),
(5515, 'Simpsons', 'Hello There', '2016-05-04', '2016-05-26', 'JS', '123', 'la la la la', '2016-05-11', '2016-05-11', 1263, 'waiting for data'),
(5516, 'john Snow', 'comes back', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5517, 'Somebody', 'rebel', '2016-05-09', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5518, 'DickButt', 'sdfasdf', '2016-06-07', '2016-06-14', 'KM', '3', 'hhh', '0000-00-00', '0000-00-00', 5, 'on hold'),
(5519, 'DickButt', 'Something13', '2016-06-08', '2016-06-08', 'SA', '234', 'sd', '2016-06-15', '2016-06-21', 0, 'on hold'),
(5520, 'ABC COMPANY', 'nail it', '2016-05-03', '2016-05-21', 'KM', '', '', '0000-00-00', '0000-00-00', 0, 'in Production'),
(5521, 'john Snow', 'climbes', '2016-05-04', '2016-05-12', 'Jess', '544040', 'Mail Foreigns: Yes\r\nHousehold: NO\r\nNCOA: Yes\r\n\r\nPROJECT MANAGEMENT:\r\n\r\nPRODUCTION:\r\n\r\nCUSTOMER SERVICE:\r\n\r\nfajlkfjealkfjealkjflkeajlkfejkla', '2016-05-04', '2016-05-06', 3000, 'in P.M.'),
(5522, '$client_name', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5523, 'Steve', '', '2016-06-14', '2016-06-21', 'SA', '', '', '2016-06-16', '2016-06-16', 0, 'on hold'),
(5524, 'Somebody', 'go home', '0000-00-00', '0000-00-00', '', '', 'jdghkjfdhkgllg dbvfjdgkj f dfhg idfjgf\r\nsdfjshjgkhuf  jdflgkjhkj \r\nfgjfdihg\r\n fdgjifjgo fgklhkl\r\n rgkj r jgtfrjgko fdgjthkjgf dslrksltk\r\ndfgkl kh g tkljlo,gfhkolytiu \r\nrtgr myk fgt;l ty', '0000-00-00', '0000-00-00', 0, ''),
(5525, '$client_name', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5526, '$client_name', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5527, '$client_name', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5528, '$client_name', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5529, '$client_name', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, ''),
(5530, 'New Client', 'kjlk', '0000-00-00', '0000-00-00', '', 'lkjlkj', '', '0000-00-00', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `mail_data`
--

CREATE TABLE `mail_data` (
  `job_id` int(11) NOT NULL,
  `data_loc` text NOT NULL,
  `records_total` int(11) NOT NULL,
  `domestic` int(11) NOT NULL,
  `foreigns` int(45) NOT NULL,
  `data_source` varchar(45) NOT NULL,
  `data_received` date NOT NULL,
  `data_completed` date NOT NULL,
  `processed_by` varchar(45) DEFAULT NULL,
  `dqr_sent` date NOT NULL,
  `exact` varchar(3) NOT NULL,
  `mail_foreigns` varchar(3) NOT NULL,
  `household` varchar(3) NOT NULL,
  `ncoa` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_data`
--

INSERT INTO `mail_data` (`job_id`, `data_loc`, `records_total`, `domestic`, `foreigns`, `data_source`, `data_received`, `data_completed`, `processed_by`, `dqr_sent`, `exact`, `mail_foreigns`, `household`, `ncoa`) VALUES
(5509, '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', ''),
(5514, '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'MB', '0000-00-00', '', '', '', ''),
(5515, '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', ''),
(5516, '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', ''),
(5517, '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', ''),
(5518, 'dfg', 0, 0, 0, 'fhg', '2016-06-15', '2016-06-21', 'FP', '2016-06-10', 'tgf', 'gfd', 'dfg', 'asa'),
(5519, 's', 0, 0, 0, 'fsdf', '2016-06-07', '2016-06-03', 'SA', '0000-00-00', 'sdf', 'sdf', 'sdf', 'dsd'),
(5520, '', 456, 0, 0, '', '0000-00-00', '0000-00-00', 'RP', '0000-00-00', '', '', '', ''),
(5521, '', 2500, 2000, 500, '', '2016-05-04', '2016-05-05', 'RP', '2016-05-12', '50', 'YES', 'YES', ''),
(5522, '', 0, 0, 0, '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', ''),
(5523, '', 0, 0, 0, '', '2016-06-22', '2016-06-20', 'SA', '2016-06-20', '', '', '', ''),
(5524, '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'AB', '0000-00-00', '', '', '', ''),
(5530, 'lk', 0, 0, 0, 'lk', '0000-00-00', '0000-00-00', '', '0000-00-00', 'lkj', 'ljl', 'kjl', 'kjl');

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

--
-- Dumping data for table `mail_info`
--

INSERT INTO `mail_info` (`job_id`, `mail_class`, `rate`, `processing_category`, `mail_dim`, `weights_measures`, `permit`, `bmeu`, `based_on`, `non_profit_number`) VALUES
(5509, '', '', '', '', '', '', '', '', 0),
(5514, '', '', '', '', '', '', '', '', 0),
(5515, '123', '12', '', '', '', '', '', '', 0),
(5516, '', '', '', '', '', '', '', '', 0),
(5517, '', '', '', '', '', '', '', '', 0),
(5518, 'fdasdff', '34', 'sdfsadf', 'fdsa', 'gffgh', 'dgf', 'dfgd', 'fgdfg', 0),
(5519, 'sdf', 'sdf', 'sdf', 'sf', 'sdf', 'sd', 'sa', 's', 0),
(5520, '', '', '', '', '', '', '', '', 0),
(5521, 'First Class', 'Auto', 'Letter', '#10 Envelope', '.75 in x .45 lb', '473', 'Newburgh, NY 12550', '50', 103838),
(5522, '', '', '', '', '', '', '', '', 0),
(5523, '', '', '', '', '', '', '', '', 0),
(5524, '', '', '', '', '', '', '', '', 0),
(5530, 'lkjlkjl', 'lkj', 'lkj', 'lkj', 'lkl', 'kjl', 'kjlk', 'jlk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `job_id` int(11) NOT NULL,
  `received` date NOT NULL,
  `location` varchar(15) NOT NULL,
  `checked_in` varchar(3) NOT NULL,
  `material` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor` varchar(45) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `based_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`job_id`, `received`, `location`, `checked_in`, `material`, `type`, `quantity`, `vendor`, `height`, `weight`, `size`, `based_on`) VALUES
(5509, '2016-05-31', 'somewhere', 'eee', '', '', 1, 'Femina34534', 12, 223, '33', 5),
(5514, '0000-00-00', '09', '09', '0', '', 0, 'Femina', 0, 0, 'uoiu', 0),
(5515, '2016-06-24', 'ljljl', 'lkj', 'lk', 'jlkj', 0, 'Femina', 0, 0, 'jlkj', 0);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `job_id` int(11) NOT NULL,
  `hold_postage` varchar(45) NOT NULL,
  `postage_paid` varchar(45) NOT NULL,
  `print_template` text NOT NULL,
  `special_address` text NOT NULL,
  `delivery` varchar(45) NOT NULL,
  `tasks` text NOT NULL,
  `task1` varchar(45) NOT NULL,
  `task2` varchar(45) NOT NULL,
  `task3` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`job_id`, `hold_postage`, `postage_paid`, `print_template`, `special_address`, `delivery`, `tasks`, `task1`, `task2`, `task3`) VALUES
(5509, 'no', 'no', '', '', '', 'Mail Merge, In-House Envelope Printing, Tabbing, Sealing, Collating', '', '', ''),
(5514, 'yes', 'yes', '', '', '', '', '', '', ''),
(5515, 'yes', 'yes', '', '', '', '', '', '', ''),
(5516, 'yes', 'yes', '', '', '', '', '', '', ''),
(5517, 'yes', 'yes', '', '', '', '', '', '', ''),
(5518, 'no', 'yes', 'jhkh', 'fghfg', 'fghfd', 'Letter Printing', 't', 'r', 'e'),
(5519, 'no', 'yes', 'sdf', 'sdf', 'sdf', 'In-House Envelope Printing', 'sdf', 'sad', 'sdf'),
(5520, 'yes', 'yes', '', '', '', '', '', '', ''),
(5521, 'yes', 'yes', '', '', '', '', '', '', ''),
(5522, 'no', 'no', '', '', '', '', '', '', ''),
(5523, 'no', 'no', '', '', '', '', '', '', ''),
(5524, 'yes', 'yes', '', '', '', '', '', '', ''),
(5530, 'no', 'no', 'lkj', 'lkj', 'lkj', 'Letter Printing', '', 'lkj', 'lkj');

-- --------------------------------------------------------

--
-- Table structure for table `production_data`
--

CREATE TABLE `production_data` (
  `id` varchar(30) NOT NULL,
  `total_records` int(11) NOT NULL,
  `records_per` int(11) NOT NULL,
  `time_number` int(11) NOT NULL,
  `time_unit` varchar(75) NOT NULL,
  `people` varchar(50) NOT NULL,
  `employees` varchar(200) NOT NULL,
  `job` varchar(75) NOT NULL,
  `hours` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production_data`
--

INSERT INTO `production_data` (`id`, `total_records`, `records_per`, `time_number`, `time_unit`, `people`, `employees`, `job`, `hours`) VALUES
('1', 10000, 100, 1, 'hr.', '2', 'sayre, jshwat', 'Tabbing', 50),
('2', 10000, 50, 10, 'min.', '1', 'jshwat', 'Printing', 33.3333);

-- --------------------------------------------------------

--
-- Table structure for table `projectmanager`
--

CREATE TABLE `projectmanager` (
  `pm` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projectmanager`
--

INSERT INTO `projectmanager` (`pm`) VALUES
('FP'),
('KM');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `id` varchar(30) NOT NULL,
  `user` varchar(45) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `vendor_name` varchar(30) NOT NULL,
  `client_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`id`, `user`, `text`, `date`, `vendor_name`, `client_name`) VALUES
('2', 'sayre', 'ertert', '2016-06-22', 'Femina', 'New Client'),
('3', 'sayre', 'Call Jill', '2016-06-16', '', 'Jill Lewis'),
('4', 'admin', 'Call Jill', '2016-06-14', '', 'Jill Lewis');

-- --------------------------------------------------------

--
-- Table structure for table `timestamp`
--

CREATE TABLE `timestamp` (
  `user` varchar(30) NOT NULL,
  `time` datetime NOT NULL,
  `job` varchar(70) NOT NULL,
  `a_p` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timestamp`
--

INSERT INTO `timestamp` (`user`, `time`, `job`, `a_p`) VALUES
('sayre', '2016-06-09 10:54:43', 'updated client info', 'PM'),
('sayre', '2016-06-28 15:43:12', 'deleted client info', ''),
('sayre', '2016-06-09 11:12:57', 'added new client', 'PM'),
('sayre', '2016-06-09 11:20:05', 'updated vendor', 'PM'),
('sayre', '2016-06-09 11:23:31', 'added new vendor', 'PM'),
('sayre', '2016-06-09 11:23:55', 'deleted vendor', 'PM'),
('sayre', '2016-06-09 11:30:47', 'added new weights and measure', 'PM'),
('sayre', '2016-06-09 11:51:30', 'added new doc', 'PM'),
('sayre', '2016-06-10 12:02:44', 'updated doc', 'AM'),
('sayre', '2016-06-10 12:16:34', 'delete doc', 'AM'),
('sayre', '2016-06-10 12:17:21', 'deleted doc', 'AM'),
('sayre', '2016-06-10 12:21:55', 'updated doc', 'AM'),
('sayre', '2016-06-10 12:23:19', 'deleted doc', 'AM'),
('sayre', '2016-06-13 11:18:56', 'added new client', 'AM'),
('sayre', '2016-06-13 11:21:58', 'added new client', 'AM'),
('sayre', '2016-06-13 11:22:27', 'added new client', 'AM'),
('sayre', '2016-06-28 15:43:12', 'deleted client info', 'PM'),
('sayre', '2016-06-13 11:24:16', 'added new weights and measure', 'AM'),
('sayre', '2016-06-13 11:25:57', 'added new vendor', 'AM'),
('sayre', '2016-06-13 11:26:26', 'added new weights and measure', 'AM'),
('sayre', '2016-06-13 11:28:18', 'added new vendor', 'AM'),
('sayre', '2016-06-13 11:31:18', 'added new doc', 'AM'),
('sayre', '2016-06-13 11:42:47', 'updated w&m', 'AM'),
('sayre', '2016-06-13 11:45:35', 'deleted w&m', 'AM'),
('sayre', '0000-00-00 00:00:00', 'added new w&m', ''),
('sayre', '2016-06-13 11:51:51', 'added new w&m', 'AM'),
('sayre', '0000-00-00 00:00:00', 'created job ticket', ''),
('sayre', '2016-06-13 12:23:25', 'created job ticket', 'PM'),
('sayre', '2016-06-13 12:29:28', 'created job ticket', 'PM'),
('sayre', '2016-06-13 12:31:20', 'created job ticket', 'PM'),
('sayre', '2016-06-13 12:38:11', 'updated job ticket', 'PM'),
('sayre', '2016-06-13 01:14:58', 'updated client info', 'PM'),
('sayre', '2016-06-13 01:15:31', 'updated client info', 'PM'),
('sayre', '2016-06-13 01:40:55', 'updated client info', 'PM'),
('sayre', '2016-06-13 01:41:02', 'updated client info', 'PM'),
('sayre', '2016-06-13 01:42:04', 'updated client info', 'PM'),
('sayre', '2016-06-13 01:48:57', 'updated client info', 'PM'),
('sayre', '2016-06-13 02:07:37', 'updated client info', 'PM'),
('sayre', '2016-06-13 02:07:43', 'updated client info', 'PM'),
('sayre', '2016-06-13 02:09:56', 'updated client info', 'PM'),
('sayre', '2016-06-13 02:18:53', 'updated client info', 'PM'),
('sayre', '2016-06-13 02:21:19', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:00:15', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:00:19', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:01:44', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:02:48', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:04:17', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:08:01', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:08:15', 'updated vendor', 'PM'),
('sayre', '2016-06-13 15:13:53', 'updated client info', 'PM'),
('sayre', '2016-06-13 03:23:56', 'deleted doc', 'PM'),
('sayre', '2016-06-13 15:25:09', 'deleted doc', 'PM'),
('sayre', '2016-06-13 15:25:24', 'added new client', 'PM'),
('sayre', '2016-06-13 15:25:34', 'updated client info', 'PM'),
('sayre', '0000-00-00 00:00:00', 'added new weights and measure', ''),
('sayre', '2016-06-13 15:25:55', 'added new vendor', 'PM'),
('sayre', '2016-06-13 15:26:04', 'updated vendor', 'PM'),
('sayre', '2016-06-13 15:26:13', 'deleted vendor', 'PM'),
('sayre', '2016-06-13 15:26:32', 'added new weights and measure', 'PM'),
('sayre', '2016-06-13 15:27:05', 'updated doc', 'PM'),
('sayre', '2016-06-13 15:27:11', 'deleted doc', 'PM'),
('sayre', '2016-06-13 03:27:20', 'added new doc', 'PM'),
('sayre', '2016-06-13 15:30:24', 'updated w&m', 'PM'),
('sayre', '2016-06-13 15:30:36', 'deleted w&m', 'PM'),
('sayre', '2016-06-13 15:31:44', 'added new w&m', 'PM'),
('sayre', '2016-06-13 15:33:03', 'created job ticket', 'PM'),
('sayre', '0000-00-00 00:00:00', 'added new vendor', ''),
('sayre', '2016-06-14 09:48:50', 'updated client info', 'AM'),
('sayre', '2016-06-14 13:22:17', 'created job ticket', 'PM'),
('sayre', '2016-06-14 14:15:21', 'updated client info', 'PM'),
('sayre', '2016-06-14 14:16:41', 'updated client info', 'PM'),
('admin', '2016-06-15 09:06:46', 'updated client info', 'AM'),
('admin', '2016-06-15 16:47:27', 'added new client', 'PM'),
('sayre', '2016-06-28 09:18:42', 'added new client', 'AM'),
('sayre', '2016-06-28 09:19:04', 'added new client', 'AM'),
('sayre', '2016-06-28 09:19:25', 'added new client', 'AM'),
('sayre', '2016-06-28 09:20:13', 'added new client', 'AM'),
('sayre', '2016-06-28 09:20:32', 'added new client', 'AM'),
('sayre', '2016-06-28 09:56:18', 'added new client', 'AM'),
('sayre', '2016-06-28 15:21:37', 'added new client', 'PM'),
('sayre', '2016-06-28 15:26:10', 'updated client info', 'PM'),
('sayre', '2016-06-28 15:26:28', 'updated client info', 'PM'),
('sayre', '2016-06-28 15:32:21', 'deleted client info', 'PM'),
('sayre', '2016-06-28 15:28:57', 'added new client', 'PM'),
('sayre', '2016-06-28 15:32:14', 'added new client', 'PM'),
('sayre', '2016-06-28 16:01:26', 'updated vendor', 'PM'),
('sayre', '2016-06-28 16:01:26', 'updated vendor', 'PM'),
('sayre', '2016-06-28 16:02:23', 'updated vendor', 'PM'),
('sayre', '2016-06-28 16:02:45', 'deleted vendor', 'PM'),
('sayre', '2016-06-28 16:04:01', 'added new vendor', 'PM'),
('sayre', '2016-06-28 16:48:28', 'added popular Weights and Measures', 'PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `initial` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user`, `password`, `initial`, `department`, `email`, `first_name`, `last_name`, `title`) VALUES
('admin', 'test', 'AD', 'Sales', 'r@fvf.com', 'Paul', 'Schmidt', 'ADMIN'),
('sayre', '1234', 'SA', 'Sales', 'e@aol.com', 'Stephen', 'Ayre', 'MEMBER'),
('jshwat', 'sdfsdf', 'JJ', 'Customer Service', 'Js@k.com', 'Jim', 'John', 'MEMBER'),
('jjones', 'sdfsdf', 'JJ', 'Customer Service', 't@aol.com', 'James', 'Jones', 'MEMBER'),
('sdfsdf', 'sdfsdf', 'SS', 'Development', '4@asdasd', 'sdfsdf', 'sdfsdf', 'MEMBER');

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
('Femina', 'Femina Patel', '5 South', 'f@gmail.com', '2223334545', 'flo rida.com'),
('Greg', 'kklj', 'kjlk', 'kkkklj', 'jlkjl', 'lkj'),
('Jezz', 'jessica treryery', '314 rockavilsdfds', 'sf@fg.com', '123', 's.com'),
('Kevin', 'Kevin Mc Awe', '31 crst', 'k@gmail.com', '1234567896', 'k.com'),
('Sample', 'oiuoiu', 'oiuoiu', 'uoiuoi', 'oioiuo', 'uoiu'),
('Venderoni', 'klkj', 'kjlkjl', 'lkjkljlk', 'kjlkj', 'jlkjklj');

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
('Femina', 'Post Cards', '12', '13', '8', '10'),
('Jezz', 'bday', '', '', '', '1'),
('S. Cartoon', 'mugs', '4" * 2"', '12', '80', '10'),
('Femina123', 'cards', '6 * 6', '12', '96', '20'),
('Femina123', '', '12', '96', '78', '50'),
('Femina', '', '123', '456', '45', '1'),
('Kevin', 'Letter', '8.5 x 11', '1.2', '.85', '25'),
('Kevin', '', '', '', '', '20'),
('Test', '', '67', '3', '17', '10'),
('Test', '', '67', '3', '17', '10'),
('Test', 'sd', '3', '23', '44', '25'),
('Femina', '', '', '', '', '1'),
('Femina', 'Posts', '56', '7', '8', '1'),
('Femina', 'ioi', '3', '12', '12', '1'),
('Greg', 'Posts', '23', '1', '123', '1'),
('Femina', 'po', '2', '3', '9', '1'),
('Vendoroni', 'Post Cards', '5', '3', '2', '1'),
('Venderoni', 'Posts', '45', '45', '3', '20');

-- --------------------------------------------------------

--
-- Table structure for table `yellow_sheet`
--

CREATE TABLE `yellow_sheet` (
  `job_id` int(11) NOT NULL,
  `1` tinyint(1) NOT NULL,
  `2` tinyint(1) NOT NULL,
  `3` tinyint(1) NOT NULL,
  `4` tinyint(1) NOT NULL,
  `5` tinyint(1) NOT NULL,
  `6` tinyint(1) NOT NULL,
  `7` tinyint(1) NOT NULL,
  `8` tinyint(1) NOT NULL,
  `9` tinyint(1) NOT NULL,
  `10` tinyint(1) NOT NULL,
  `11` tinyint(1) NOT NULL,
  `12` tinyint(1) NOT NULL,
  `13` tinyint(1) NOT NULL,
  `14` tinyint(1) NOT NULL,
  `percent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yellow_sheet`
--

INSERT INTO `yellow_sheet` (`job_id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `percent`) VALUES
(5509, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100),
(5514, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 14),
(5515, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5516, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5517, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5518, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5519, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5520, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5521, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5522, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5523, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5524, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5530, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive_jobs`
--
ALTER TABLE `archive_jobs`
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `blue_sheet`
--
ALTER TABLE `blue_sheet`
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `client_info`
--
ALTER TABLE `client_info`
  ADD UNIQUE KEY `clientname` (`client_name`);

--
-- Indexes for table `documentation`
--
ALTER TABLE `documentation`
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `job_ticket`
--
ALTER TABLE `job_ticket`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `jobid` (`job_id`);

--
-- Indexes for table `mail_data`
--
ALTER TABLE `mail_data`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `mail_info`
--
ALTER TABLE `mail_info`
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_name`),
  ADD UNIQUE KEY `vendor_name` (`vendor_name`);

--
-- Indexes for table `yellow_sheet`
--
ALTER TABLE `yellow_sheet`
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_ticket`
--
ALTER TABLE `job_ticket`
  MODIFY `job_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5531;--
-- Database: `importertest`
--
CREATE DATABASE IF NOT EXISTS `importertest` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `importertest`;

-- --------------------------------------------------------

--
-- Table structure for table `csvtest`
--

CREATE TABLE `csvtest` (
  `ID` int(11) DEFAULT NULL,
  `FirstName` varchar(40) DEFAULT NULL,
  `LastName` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csvtest`
--

INSERT INTO `csvtest` (`ID`, `FirstName`, `LastName`) VALUES
(1, 'james', 'smith\r'),
(2, 'meggie', 'smith');
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'CRST', '{"quick_or_custom":"quick","what":"sql","structure_or_data_forced":"0","table_select[]":["archive_jobs","blue_sheet","client_info","documentation","invoice","job_ticket","mail_data","mail_info","materials","reminder","timestamp","users","vendors","w_and_m"],"table_structure[]":["archive_jobs","blue_sheet","client_info","documentation","invoice","job_ticket","mail_data","mail_info","materials","reminder","timestamp","users","vendors","w_and_m"],"table_data[]":["archive_jobs","blue_sheet","client_info","documentation","invoice","job_ticket","mail_data","mail_info","materials","reminder","timestamp","users","vendors","w_and_m"],"output_format":"sendit","filename_template":"@DATABASE@","remember_template":"on","charset":"utf-8","compression":"none","maxsize":"","codegen_structure_or_data":"data","codegen_format":"0","csv_separator":",","csv_enclosed":"\\"","csv_escaped":"\\"","csv_terminated":"AUTO","csv_null":"NULL","csv_structure_or_data":"data","excel_null":"NULL","excel_edition":"win","excel_structure_or_data":"data","htmlword_structure_or_data":"structure_and_data","htmlword_null":"NULL","json_structure_or_data":"data","latex_caption":"something","latex_structure_or_data":"structure_and_data","latex_structure_caption":"Structure of table @TABLE@","latex_structure_continued_caption":"Structure of table @TABLE@ (continued)","latex_structure_label":"tab:@TABLE@-structure","latex_relation":"something","latex_comments":"something","latex_mime":"something","latex_columns":"something","latex_data_caption":"Content of table @TABLE@","latex_data_continued_caption":"Content of table @TABLE@ (continued)","latex_data_label":"tab:@TABLE@-data","latex_null":"\\\\textit{NULL}","mediawiki_structure_or_data":"structure_and_data","mediawiki_caption":"something","mediawiki_headers":"something","ods_null":"NULL","ods_structure_or_data":"data","odt_structure_or_data":"structure_and_data","odt_relation":"something","odt_comments":"something","odt_mime":"something","odt_columns":"something","odt_null":"NULL","pdf_report_title":"","pdf_structure_or_data":"structure_and_data","phparray_structure_or_data":"data","sql_include_comments":"something","sql_header_comment":"","sql_compatibility":"NONE","sql_structure_or_data":"structure_and_data","sql_create_table":"something","sql_auto_increment":"something","sql_create_view":"something","sql_procedure_function":"something","sql_create_trigger":"something","sql_backquotes":"something","sql_type":"INSERT","sql_insert_syntax":"both","sql_max_query_size":"50000","sql_hex_for_binary":"something","sql_utc_time":"something","texytext_structure_or_data":"structure_and_data","texytext_null":"NULL","xml_structure_or_data":"data","xml_export_events":"something","xml_export_functions":"something","xml_export_procedures":"something","xml_export_tables":"something","xml_export_triggers":"something","xml_export_views":"something","xml_export_contents":"something","yaml_structure_or_data":"data","":null,"lock_tables":null,"as_separate_files":null,"csv_removeCRLF":null,"csv_columns":null,"excel_removeCRLF":null,"excel_columns":null,"htmlword_columns":null,"json_pretty_print":null,"ods_columns":null,"sql_dates":null,"sql_relation":null,"sql_mime":null,"sql_use_transaction":null,"sql_disable_fk":null,"sql_views_as_tables":null,"sql_metadata":null,"sql_create_database":null,"sql_drop_table":null,"sql_if_not_exists":null,"sql_truncate":null,"sql_delayed":null,"sql_ignore":null,"texytext_columns":null}'),
(2, 'root', 'server', 'temp', '{"quick_or_custom":"quick","what":"sql","db_select[]":["crst_dashboard","phpmyadmin","sample","test"],"output_format":"sendit","filename_template":"@SERVER@","remember_template":"on","charset":"utf-8","compression":"none","maxsize":"","codegen_structure_or_data":"data","codegen_format":"0","csv_separator":",","csv_enclosed":"\\"","csv_escaped":"\\"","csv_terminated":"AUTO","csv_null":"NULL","csv_structure_or_data":"data","excel_null":"NULL","excel_edition":"win","excel_structure_or_data":"data","htmlword_structure_or_data":"structure_and_data","htmlword_null":"NULL","json_structure_or_data":"data","latex_caption":"something","latex_structure_or_data":"structure_and_data","latex_structure_caption":"Structure of table @TABLE@","latex_structure_continued_caption":"Structure of table @TABLE@ (continued)","latex_structure_label":"tab:@TABLE@-structure","latex_relation":"something","latex_comments":"something","latex_mime":"something","latex_columns":"something","latex_data_caption":"Content of table @TABLE@","latex_data_continued_caption":"Content of table @TABLE@ (continued)","latex_data_label":"tab:@TABLE@-data","latex_null":"\\\\textit{NULL}","mediawiki_structure_or_data":"data","mediawiki_caption":"something","mediawiki_headers":"something","ods_null":"NULL","ods_structure_or_data":"data","odt_structure_or_data":"structure_and_data","odt_relation":"something","odt_comments":"something","odt_mime":"something","odt_columns":"something","odt_null":"NULL","pdf_report_title":"","pdf_structure_or_data":"data","phparray_structure_or_data":"data","sql_include_comments":"something","sql_header_comment":"","sql_compatibility":"NONE","sql_structure_or_data":"structure_and_data","sql_create_table":"something","sql_auto_increment":"something","sql_create_view":"something","sql_procedure_function":"something","sql_create_trigger":"something","sql_backquotes":"something","sql_type":"INSERT","sql_insert_syntax":"both","sql_max_query_size":"50000","sql_hex_for_binary":"something","sql_utc_time":"something","texytext_structure_or_data":"structure_and_data","texytext_null":"NULL","yaml_structure_or_data":"data","":null,"as_separate_files":null,"csv_removeCRLF":null,"csv_columns":null,"excel_removeCRLF":null,"excel_columns":null,"htmlword_columns":null,"json_pretty_print":null,"ods_columns":null,"sql_dates":null,"sql_relation":null,"sql_mime":null,"sql_use_transaction":null,"sql_disable_fk":null,"sql_views_as_tables":null,"sql_metadata":null,"sql_drop_database":null,"sql_drop_table":null,"sql_if_not_exists":null,"sql_truncate":null,"sql_delayed":null,"sql_ignore":null,"texytext_columns":null}'),
(3, 'root', 'server', 'crst_dashboard', '{"quick_or_custom":"quick","what":"sql","db_select[]":["crst_dashboard","importertest","phpmyadmin","sample","test"],"output_format":"sendit","filename_template":"@SERVER@","remember_template":"on","charset":"utf-8","compression":"none","maxsize":"","codegen_structure_or_data":"data","codegen_format":"0","csv_separator":",","csv_enclosed":"\\"","csv_escaped":"\\"","csv_terminated":"AUTO","csv_null":"NULL","csv_structure_or_data":"data","excel_null":"NULL","excel_edition":"win","excel_structure_or_data":"data","htmlword_structure_or_data":"structure_and_data","htmlword_null":"NULL","json_structure_or_data":"data","latex_caption":"something","latex_structure_or_data":"structure_and_data","latex_structure_caption":"Structure of table @TABLE@","latex_structure_continued_caption":"Structure of table @TABLE@ (continued)","latex_structure_label":"tab:@TABLE@-structure","latex_relation":"something","latex_comments":"something","latex_mime":"something","latex_columns":"something","latex_data_caption":"Content of table @TABLE@","latex_data_continued_caption":"Content of table @TABLE@ (continued)","latex_data_label":"tab:@TABLE@-data","latex_null":"\\\\textit{NULL}","mediawiki_structure_or_data":"data","mediawiki_caption":"something","mediawiki_headers":"something","ods_null":"NULL","ods_structure_or_data":"data","odt_structure_or_data":"structure_and_data","odt_relation":"something","odt_comments":"something","odt_mime":"something","odt_columns":"something","odt_null":"NULL","pdf_report_title":"","pdf_structure_or_data":"data","phparray_structure_or_data":"data","sql_include_comments":"something","sql_header_comment":"","sql_compatibility":"NONE","sql_structure_or_data":"structure_and_data","sql_create_table":"something","sql_auto_increment":"something","sql_create_view":"something","sql_procedure_function":"something","sql_create_trigger":"something","sql_backquotes":"something","sql_type":"INSERT","sql_insert_syntax":"both","sql_max_query_size":"50000","sql_hex_for_binary":"something","sql_utc_time":"something","texytext_structure_or_data":"structure_and_data","texytext_null":"NULL","yaml_structure_or_data":"data","":null,"as_separate_files":null,"csv_removeCRLF":null,"csv_columns":null,"excel_removeCRLF":null,"excel_columns":null,"htmlword_columns":null,"json_pretty_print":null,"ods_columns":null,"sql_dates":null,"sql_relation":null,"sql_mime":null,"sql_use_transaction":null,"sql_disable_fk":null,"sql_views_as_tables":null,"sql_metadata":null,"sql_drop_database":null,"sql_drop_table":null,"sql_if_not_exists":null,"sql_truncate":null,"sql_delayed":null,"sql_ignore":null,"texytext_columns":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{"db":"crst_dashboard","table":"production_data"},{"db":"crst_dashboard","table":"production"},{"db":"crst_dashboard","table":"vendors"},{"db":"crst_dashboard","table":"timestamp"},{"db":"crst_dashboard","table":"projectmanager"},{"db":"crst_dashboard","table":"users"},{"db":"crst_dashboard","table":"reminder"},{"db":"crst_dashboard","table":"mail_data"},{"db":"crst_dashboard","table":"client_info"},{"db":"importertest","table":"csvtest"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'crst_dashboard', 'job_ticket', '{"sorted_col":"`job_id`  DESC","CREATE_TIME":"2016-04-15 12:39:49","col_visib":["1","1","1","1","1","1","1","1","1","1","1"]}', '2016-04-25 15:51:06'),
('root', 'crst_dashboard', 'mail_data', '{"sorted_col":"`job_id` ASC"}', '2016-04-25 15:50:03'),
('root', 'crst_dashboard', 'mail_info', '{"sorted_col":"`job_id` ASC"}', '2016-04-25 15:40:10'),
('root', 'crst_dashboard', 'production', '{"sorted_col":"`production`.`postage_paid` ASC"}', '2016-04-15 16:57:53'),
('root', 'crst_dashboard', 'reminder', '{"sorted_col":"`user` ASC"}', '2016-05-04 19:51:30'),
('root', 'crst_dashboard', 'timestamp', '{"sorted_col":"`timestamp`.`time`  DESC"}', '2016-06-08 20:44:43'),
('root', 'crst_dashboard', 'users', '[]', '2016-06-15 14:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2016-02-16 17:36:35', '{"collation_connection":"utf8mb4_unicode_ci"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;--
-- Database: `sample`
--
CREATE DATABASE IF NOT EXISTS `sample` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sample`;

-- --------------------------------------------------------

--
-- Table structure for table `clientinfo`
--

CREATE TABLE `clientinfo` (
  `client` varchar(45) NOT NULL,
  `clientadd` varchar(45) NOT NULL,
  `contactname` varchar(45) NOT NULL,
  `contactnum` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientinfo`
--

INSERT INTO `clientinfo` (`client`, `clientadd`, `contactname`, `contactnum`) VALUES
('abcd inc', '31 cornerstone new paltz', 'Sean Griffin', '123-456-9999'),
('femina pvt ltd', 'somewhere', 'femina', '202-363-6565'),
('hello', '', '', ''),
('kevin inc', '31 cornerstone', 'kevin', '123-456-7890'),
('new company', 'here', 'obama', '1112223333'),
('sean inc', '31 new cornerstone', 'sean', '111-222-3333');

-- --------------------------------------------------------

--
-- Table structure for table `jobticket`
--

CREATE TABLE `jobticket` (
  `client` varchar(45) NOT NULL,
  `job` varchar(45) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobticket`
--

INSERT INTO `jobticket` (`client`, `job`, `startdate`, `enddate`) VALUES
('femina pvt ltd', 'print this ', '2016-02-03', '2016-02-27'),
('kevin inc', 'this thing', '2016-02-28', '2016-05-20'),
('sean inc', 'managing', '2016-03-17', '2016-02-24'),
('abcd inc', 'print many letters', '2016-02-04', '2016-04-01'),
('kevin inc', 'print cartoon', '2017-01-03', '2018-01-02'),
('kevin inc', 'pppp ', '2017-01-03', '2018-01-02'),
('femina pvt ltd', 'qqqqqq', '2017-01-03', '2018-01-02'),
('new company', 'cvgdfh', '0000-00-00', '0000-00-00'),
('new company', 'print many letters', '0000-00-00', '0000-00-00'),
('hello', 'from the other side', '0000-00-00', '0000-00-00'),
('', '', '0000-00-00', '0000-00-00'),
('femina pvt ltd', 'print many letters', '0000-00-00', '0000-00-00'),
('femina pvt ltd', 'print many letters', '2016-02-03', '2016-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `job` varchar(45) NOT NULL,
  `dataloc` varchar(100) NOT NULL,
  `processedby` varchar(1) NOT NULL,
  `recordstotal` bigint(255) NOT NULL,
  `domestic` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`job`, `dataloc`, `processedby`, `recordstotal`, `domestic`) VALUES
('print this ', 'here/there/everywhere', 'F', 12356, 89453),
('this thing', 'aasda/thggffg/waafdcf', 'k', 11111, 22222),
('managing', 'aaaaaaaaa/ffff/qqqqqqqqqq/hhhhhhhh', 's', 77777, 88888),
('print many letters', 'aaa/sssssssssss/dddddddddd', 'k', 1235, 4563),
('pppp ', 'qqqqqqqqqqq', 'F', 99, 78),
('qqqqqq', 'qqqqqqqqqqq', 'K', 100, 101),
('cvgdfh', 'fmmmmm', 'S', 12, 98),
('print many letters', '', '', 0, 0),
('from the other side', '', 'G', 0, 0),
('', '', '', 0, 0),
('print many letters', '', '', 0, 0),
('print many letters', '', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientinfo`
--
ALTER TABLE `clientinfo`
  ADD PRIMARY KEY (`client`),
  ADD UNIQUE KEY `client` (`client`),
  ADD UNIQUE KEY `clientadd` (`clientadd`),
  ADD UNIQUE KEY `contactname` (`contactname`),
  ADD UNIQUE KEY `contactnum` (`contactnum`);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
