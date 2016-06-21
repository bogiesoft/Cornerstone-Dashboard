-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2016 at 10:52 PM
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
('Jill Lewis', 'lkj', 'l', 'lkjlk', 'jlkj', 'lk', '', '', '', 'lkj', 'jlkjlkj', 'lkjlk', 'lkj'),
('Led Zeppelin', 'jlkj', 'lkjlk', 'ljlk', 'jlk', 'jlkj', '', '', '', 'jlk', 'lklkj', 'lkjlkj', 'jlk'),
('New Client', 'kljlk', 'Client', 'kljlklkj', 'lkjlklk', 'lkjlkjlkjl', '', '', '', 'lkllkjk', 'lkjlkj', 'lkj', 'lkjlkj'),
('Steve', '234 dfsdf', 'Stevo', '233 454 2343', 'T@r.com', '234 676 2342', '', '', '', 'trtert', 'www.gdf.vom', 'dgdfg', 'werw'),
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
  `total_records` int(11) NOT NULL,
  `records_per` int(11) NOT NULL,
  `time_number` int(11) NOT NULL,
  `time_unit` varchar(75) NOT NULL,
  `people` varchar(50) NOT NULL,
  `employees` varchar(150) NOT NULL,
  `job` varchar(75) NOT NULL,
  `hours` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production_data`
--

INSERT INTO `production_data` (`total_records`, `records_per`, `time_number`, `time_unit`, `people`, `employees`, `job`, `hours`) VALUES
(1, 1, 1, 'min.', '1', 'NONE', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', 'NONE', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', 'NONE', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', 'NONE', 'Insertion', '12312'),
(14000, 123, 13, 'sec.', '5', 'NONE', 'Tabbing', '12312'),
(1, 1, 1, 'min.', '1', '', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', 'NONE', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', 'NONE', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', 'NONE', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', ', ', 'Insertion', '12312'),
(1, 1, 1, 'min.', '1', ', ', 'Insertion', '12312');

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
('sayre', '2016-06-09 10:57:21', 'deleted client info', 'PM'),
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
('sayre', '2016-06-13 11:23:48', 'deleted client info', 'AM'),
('sayre', '2016-06-13 11:23:52', 'deleted client info', 'AM'),
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
('sayre', '2016-06-13 15:25:43', 'deleted client info', 'PM'),
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
('sayre', '2016-06-13 15:58:41', 'deleted client info', 'PM'),
('sayre', '2016-06-14 09:48:50', 'updated client info', 'AM'),
('sayre', '2016-06-14 13:22:17', 'created job ticket', 'PM'),
('sayre', '2016-06-14 13:40:51', 'deleted client info', 'PM'),
('sayre', '2016-06-14 14:15:21', 'updated client info', 'PM'),
('sayre', '2016-06-14 14:16:41', 'updated client info', 'PM'),
('admin', '2016-06-15 09:06:46', 'updated client info', 'AM'),
('admin', '2016-06-15 16:47:27', 'added new client', 'PM');

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
('Sample', 'oiuoiu', 'oiuoiu', 'uoiuoi', 'oioiuo', 'uoiu');

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
('Femina', 'po', '2', '3', '9', '1');

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
  MODIFY `job_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5531;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
