-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2016 at 10:52 PM
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
(5518, '2016-06-22', 5, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
('ABC COMPANY', '123 AWE', 'abc  AWE', '3474050304', 'jfg fhg', 'gfg ', '', '', '', 'BUsinessman', 'gh hj ', 'g yhgfh g', 'fggh'),
('Anna', '', '', '', '', '', '', '', '', '', '', '', ''),
('dfgsf', 'fdfg', 'dfg', '343 32432 23', 'dsfsd', 'sadf', '', '', '', 'dfsd', 'fsdf', 'sdfsdff', 'sdf'),
('DickButt', '7 Hawkins St Awe', 'Kevin McReady Awe', '3474050304Awe', 'kevin.mcready@yahoo.com', '7183263163', '', '', '', 'BUsinessman', 'kevinmcready.com', 'Just a boss Awe', 'President'),
('Femina', '8 Southside Awesome', 'Femina AwePatel', '1234567890', 'femina@gmail.com', ' 2112345566Awe', '', '', '', 'studentAwe', 'sbdbjsfj.comAwe', 'Awedsf etgrrkjngkdfkgl  vng gjhjhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhg       dfjlads fkdslg               elfkldk fl;drk lfkldrjfklr jfji riooooooot', 'AweCircular progress bar (canvas)'),
('Femina1', '8 Southside Ave', 'Femina Patel', '1234567890', 'femina@gmail.com', '1231231230', '', '', '', 'student', 'sbdbjsfj.com', 'ermtr hyt y ju', 'Circular progress bar (canvas)'),
('john Snow', '', 'john snow', '', '', '', '', '', '', '', '', '', ''),
('Simpsons', '123 St ABC ', 'abc ', '123-456-7896', '123@gmail.com', '123-654-9878', '', '', '', 'Cartoon', 'abc.com', '123 abc check', 'Actor'),
('Somebody', '31 CRST', 'HI ', '111-111-1111', 'sb@gmail.com', '454-545-5545', '', '', '', 'Artist', 'dfnkjjkgd.com', 'sd fefgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfgfge', 'CEO'),
('Steve', '234 dfsdf', 'Stevo', '233 454 2343', 'T@r.com', '234 676 2342', '', '', '', 'trtert', 'www.gdf.vom', 'dgdfg', 'werw');

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
('anna', 'invite her', 'fpatel', '2016-04-22'),
('Brother Earth', 'hello brother awe', '', '0000-00-00'),
('Cousin Earth', 'awe123', 'fpatel', '0000-00-00'),
('Father Earth', 'faaaaaaaaatttttttttttttttttthhhhhhhhhhhhherrrrrrrrrrrrr\r\nmmmmmmmmoooooooooooottttthhhhhherrrrrrrrrr\r\nchild', '', '0000-00-00'),
('femina', 'works', 'fpatel', '2016-04-22'),
('How to create a postcard', 'jlkfejaklfenaklfnekalfnekalnfeklanfkleanfklenaklfneklafnkleanfkleanfklenaklfneaklfneaklfnlafnea', 'fpatel', '2016-05-04'),
('jezz', 'is adorable', 'fpatel', '2016-04-22'),
('kevin', 'rocks', 'fpatel', '2016-04-22'),
('kevin Mc', 'eats pizza', 'fpatel', '2016-04-22'),
('Mother Earth', 'do this awe awe \r\n\r\ndo that awe \r\n\r\nalsoooooooooooooooooooooo do this and this and this\r\nThis is a new line\r\n', 'fpatel', '2016-04-12'),
('s', 'awe', 'fpatel', '2016-04-11'),
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
(5518, '', 0, '', '', '', '', '');

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
(5518, 'DickButt', 'sdfasdf', '2016-06-07', '2016-06-14', 'KM', '3', 'hhh', '0000-00-00', '0000-00-00', 5, 'on hold');

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
(5518, 'dfg', 0, 0, 0, 'fhg', '2016-06-15', '2016-06-21', 'FP', '2016-06-10', 'tgf', 'gfd', 'dfg', 'asa');

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
(5518, 'fdasdff', '34', 'sdfsadf', 'fdsa', 'gffgh', 'dgf', 'dfgd', 'fgdfg', 0);

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
(5509, '2016-05-31', 'somewhere123', '', '', '', 0, 'Femina', 12, 2, '3', 5),
(5514, '0000-00-00', '', '', '', '', 0, 'Femina', 0, 0, '', 0),
(5516, '2016-06-06', '31 front', 'rp', 'postcard', 'oversized', 4000, 'Kevin', 4, 7, '6x9', 25);

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
(5518, 'no', 'yes', 'jhkh', 'fghfg', 'fghfd', 'Letter Printing', 't', 'r', 'e');

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
  `user` varchar(45) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`user`, `text`, `date`) VALUES
('fpatel', 'hello', '2016-04-11'),
('someone', 'hello there', '2016-04-11'),
('fpatel', 'not to be printed', '2016-04-12'),
('fpatel', 'today is here', '2016-04-11'),
('fpatel', 'kevin is here', '2016-04-11'),
('fpatel', 'no one', '2016-04-12'),
('fpatel', '17th +6', '2016-04-17'),
('fpatel', '16th +5', '2016-04-16'),
('fpatel', 'gfh gh', '2017-02-03'),
('fpatel', 'Remember to call Mr. Poopybutthole', '2016-05-18'),
('fpatel', 'hello', '2016-05-04'),
('fpatel', 'tomorrow', '2016-05-06'),
('fpatel', 'day after', '2016-05-07'),
('fpatel', 'go home', '2016-05-09'),
('fpatel', 'mother earth', '2016-05-13'),
('kmcready', 'tyfyjfyf', '2016-06-07'),
('sayre', 'fgsdfgsdfgsfdg', '2016-06-07'),
('sayre', 'asdsdfsdfs', '2016-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `timestamp`
--

CREATE TABLE `timestamp` (
  `user` varchar(45) NOT NULL,
  `time` varchar(70) NOT NULL,
  `job` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timestamp`
--

INSERT INTO `timestamp` (`user`, `time`, `job`) VALUES
('', 'May 4, 2016, 11:51 am', 'archived job'),
('', 'May 4, 2016, 12:06 pm', 'created job ticket'),
('', 'May 4, 2016, 12:11 pm', 'added new w&m'),
('fpatel', 'May 4, 2016, 12:26 pm', 'created job ticket'),
('fpatel', 'May 4, 2016, 12:28 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 12:50 pm', 'created job ticket'),
('fpatel', 'May 4, 2016, 12:52 pm', 'added new w&m'),
('fpatel', 'May 4, 2016, 1:05 pm', 'added new w&m'),
('fpatel', 'May 4, 2016, 1:10 pm', 'updated w&m'),
('fpatel', 'May 4, 2016, 1:10 pm', 'updated w&m'),
('fpatel', 'May 4, 2016, 1:11 pm', 'created job ticket'),
('fpatel', 'May 4, 2016, 1:11 pm', 'added new w&m'),
('fpatel', 'May 4, 2016, 1:24 pm', 'updated w&m'),
('fpatel', 'May 4, 2016, 1:25 pm', 'updated w&m'),
('fpatel', 'May 4, 2016, 1:34 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 1:36 pm', 'created job ticket'),
('fpatel', 'May 4, 2016, 1:36 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 1:37 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 1:38 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 1:38 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 1:40 pm', 'archived job'),
('fpatel', 'May 4, 2016, 2:36 pm', 'created job ticket'),
('fpatel', 'May 4, 2016, 2:46 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 2:47 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 2:47 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 2:47 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:06 pm', 'archived job'),
('fpatel', 'May 4, 2016, 3:06 pm', 'created job ticket'),
('fpatel', 'May 4, 2016, 3:07 pm', 'archived job'),
('fpatel', 'May 4, 2016, 3:07 pm', 'created job ticket'),
('fpatel', 'May 4, 2016, 3:10 pm', 'added new weights and measure'),
('fpatel', 'May 4, 2016, 3:12 pm', 'added new doc'),
('fpatel', 'May 4, 2016, 3:16 pm', 'added new w&m'),
('fpatel', 'May 4, 2016, 3:26 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:26 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:26 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:27 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:27 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:28 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:28 pm', 'updated job ticket'),
('fpatel', 'May 4, 2016, 3:30 pm', 'archived job'),
('fpatel', 'May 4, 2016, 4:20 pm', 'created job ticket'),
('fpatel', 'May 9, 2016, 2:27 pm', 'archived job'),
('fpatel', 'May 9, 2016, 2:36 pm', 'created job ticket'),
('fpatel', 'May 9, 2016, 2:36 pm', 'updated job ticket'),
('fpatel', 'May 9, 2016, 2:38 pm', 'updated client info'),
('fpatel', 'May 9, 2016, 2:42 pm', 'added new weights and measure'),
('fpatel', 'May 9, 2016, 2:48 pm', 'updated w&m'),
('fpatel', 'May 9, 2016, 2:50 pm', 'added new w&m'),
('fpatel', 'May 9, 2016, 3:28 pm', 'created job ticket'),
('fpatel', 'May 31, 2016, 5:01 pm', 'updated job ticket'),
('fpatel', 'May 31, 2016, 5:02 pm', 'archived job'),
('fpatel', 'June 6, 2016, 4:37 pm', 'added new w&m'),
('kmcready', 'June 7, 2016, 9:24 am', 'created job ticket'),
('kmcready', 'June 7, 2016, 9:39 am', 'added new client'),
('kmcready', 'June 7, 2016, 9:47 am', 'added new client'),
('sayre', 'June 7, 2016, 4:08 pm', 'updated job ticket');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `initial` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user`, `password`, `initial`, `department`, `name`) VALUES
('fpatel', '1234', 'FP', 'Devel', 'Femina'),
('kmcready', 'DC3#CRST1', 'KM', 'Project Management', 'Kevin McReady'),
('mbirnbaum', 'Ibanez1!', 'MB', 'Project Management', 'Michael Birnbaum'),
('rob', 'rob123', 'RP', 'Production', 'Rob Philipes'),
('sayre', '1234', 'SA', 'Development', 'Stephen Ayre');

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
('Femina', 'Femina Awe Awe', '5 South Awe', 'f@gmail.com', '2223334545', 'f.com'),
('Femina123', 'Miss Femina', '31 crst dr', 'dsfd@gmail.com', '1231231230', 'sdsdgfrf.com'),
('Jezz', 'jessica', '31', 'sf@fg.com', '123', 'sda.com'),
('Kevin', 'Kevin Mc Awe', '31 crst', 'k@gmail.com', '1234567896', 'k.com'),
('S. Cartoon', 'john ', 'hilarious dr', 'j@gmail.com', '777-888-9999', 'john.com');

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
('Kevin', '', '', '', '', '20');

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
(5518, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `user` (`user`);

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
  MODIFY `job_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5519;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
