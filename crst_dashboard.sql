-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2016 at 09:08 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

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
(5509, 'Simpsons', 'go home', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-06-30', '', 'eee', '', '', 1, 'Femina34534', 12, 223, '33', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Closed', '', '', '', '', '', '', '', '', '', '', 'July 6, 2016, 11:22 am'),
(5510, 'Simpsons', 'loves to work', '2016-05-03', '2016-05-04', 'JS', '', '', '0000-00-00', '0000-00-00', 0, 'waiting for materials', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-05-10', '', '', '', '', 0, 'Femina', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 3:06 pm'),
(5511, 'ABC COMPANY', 'rebel', '2016-05-04', '2016-05-10', 'FP', '1236', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'RP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 85520, '', '', '', 'Finished', '', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 1:40 pm'),
(5512, 'Femina', 'makes website', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-05-05', '31 Front', 'Kev', '6x9 One Side Postcard', 'card', 4000, 'Femina123', 2, 1, '6x9', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$18', 22929, 'YES', 'Paid postage and invoice', 'We had to deliver to Westchester', 'Finished', 'Job is printed and completed', 'no', 'no', '', '', '', '', '', '', '', 'May 4, 2016, 3:30 pm'),
(5513, 'Simpsons', 'loves to work', '2016-05-03', '2016-05-04', 'JS', '', '', '0000-00-00', '0000-00-00', 0, 'waiting for materials', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Cancelled', '', 'yes', 'yes', '', '', '', '', '', '', '', 'May 4, 2016, 3:07 pm'),
(5514, 'Simpsons', 'loves to work', '2016-05-03', '2016-05-04', 'JS', '', '', '0000-00-00', '0000-00-00', 0, 'waiting for materials', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'MB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2016-06-30', '', '09', '0', '', 0, 'Femina', 0, 0, 'uoiu', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Finished', '', '', '', '', '', '', '', '', '', '', 'July 6, 2016, 11:22 am'),
(5530, 'New Client', 'kjlk', '0000-00-00', '0000-00-00', '', 'lkjlkj', '', '0000-00-00', '0000-00-00', 0, 'in Production', 'lk', 0, 0, 0, 'lk', '0000-00-00', '0000-00-00', 'KM', '0000-00-00', 'lkj', 'ljl', 'kjl', 'kjl', 'lkjlkjl', 'lkj', 'lkj', 'lkj', 'lkl', 'kjl', 'kjlk', 'jlk', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Closed', '', '', '', '', '', '', '', '', '', '', 'July 6, 2016, 11:22 am'),
(5600, '', 'Yellow Sheet', '0000-00-00', '2016-05-19', '', '', '', '0000-00-00', '0000-00-00', 0, 'in P.M.', '', 123, 0, 0, '', '0000-00-00', '0000-00-00', 'jshwa', '0000-00-00', '', '', '', '', '1st class', '1230', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Closed', '', '', '', '', '', '', '', '', '', '', '2016-07-06 14:04:51'),
(5606, 'Another Client', 'go there and come back', '2016-04-06', '2016-04-15', 'JS', '123', 'fgjhd sdfkjjk\r\ndfdg', '2016-04-12', '2016-04-21', 12, '', 'C drive', 12, 2, 2, '4', '2016-04-14', '2016-04-22', '', '2016-04-08', '2', '2', '3', '5', '12', '12', '452', '54', '7', '5', '74', '57', 74, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '2016-04-06', 3, 1, 12, 63, 5, 4, 5, 8, 546, 5, 5, 45, 7, 5, 54, '', 0, '', '', '', 'Closed', '', '', '', '', '', '', '', '', '', '', '2016-07-06 12:38:23'),
(5613, 'ABC COMPANY', '12345', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', 'jjone', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Closed', '', '', '', '', '', '', '', '', '', '', '2016-07-06 12:47:32'),
(5614, 'Steve', 'This is a new job', '2016-07-20', '2016-07-20', 'tturn', '67', '98980', '2016-07-21', '2016-07-13', 45, 'waiting for materials', '45', 34, 789, 789, '789', '2016-07-19', '2016-07-19', 'admin', '2016-07-22', '809', '98', '98', '098', '645', '456', '45645', '456456', '456', '6565', '5645', '456546', 454, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '2016-07-19', 89, 980, 98908, 908, 90890, 88, 989, 89, 98, 980, 980, 89, 9, 98, 9098, '', 5, '', '', '', 'Closed', '', '', '', '', '', '', '', '', '', '', '2016-07-06 12:44:43'),
(5615, '', 'Yellow Sheet', '0000-00-00', '2016-05-19', 'djeff', '', '', '0000-00-00', '0000-00-00', 0, 'in P.M.', '', 123, 0, 0, '', '0000-00-00', '0000-00-00', 'jshmo', '0000-00-00', '', '', '', '', '1st class', '1230', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 'Closed', '', '', '', '', '', '', '', '', '', '', '2016-07-06 11:36:50'),
(5640, '', 'Yellow Sheet', '1969-12-31', '2016-05-19', '', '', '', '1969-12-31', '1969-12-31', 0, 'in P.M.', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5641, 'New Client', 'Hello There', '2016-05-04', '2016-05-26', '', '123', ' hee hee hee ', '2016-05-11', '2016-05-11', 1263, 'waiting for data', '', 500, 0, 0, '', '1969-12-31', '1969-12-31', 'jshmo', '1969-12-31', '', '', '', '', '123', '12', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '1969-12-31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 2, '', '', 'asdasdas', 'Closed', 'Reasons', '', '', '', '', '', '', '', '', '', '2016-07-13 10:25:26'),
(5647, 'Jill Lewis', '', '1969-12-31', '1969-12-31', '', '', '', '1969-12-31', '1969-12-31', 0, 'waiting for materials', '', 0, 0, 0, '', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '', '', '', '', 0, '', 0, 0, '', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `blue_sheet`
--

CREATE TABLE `blue_sheet` (
  `job_id` int(11) NOT NULL,
  `completed_date` date NOT NULL,
  `data_hrs` int(11) NOT NULL DEFAULT '0',
  `gd_hrs` int(11) NOT NULL DEFAULT '0',
  `initialrec_count` int(11) NOT NULL DEFAULT '0',
  `manual` int(11) NOT NULL DEFAULT '0',
  `uncorrected` int(11) NOT NULL DEFAULT '0',
  `unverifiable` int(11) NOT NULL DEFAULT '0',
  `bs_foreigns` int(11) NOT NULL DEFAULT '0',
  `bs_exact` int(11) NOT NULL DEFAULT '0',
  `loose` int(11) NOT NULL DEFAULT '0',
  `householded` int(11) NOT NULL DEFAULT '0',
  `basic` int(11) NOT NULL DEFAULT '0',
  `ncoa_errors` int(11) NOT NULL DEFAULT '0',
  `bs_ncoa` int(11) NOT NULL DEFAULT '0',
  `final_count` int(11) NOT NULL DEFAULT '0',
  `bs_domestic` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blue_sheet`
--

INSERT INTO `blue_sheet` (`job_id`, `completed_date`, `data_hrs`, `gd_hrs`, `initialrec_count`, `manual`, `uncorrected`, `unverifiable`, `bs_foreigns`, `bs_exact`, `loose`, `householded`, `basic`, `ncoa_errors`, `bs_ncoa`, `final_count`, `bs_domestic`) VALUES
(5649, '1969-12-31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5650, '1969-12-31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5651, '1969-12-31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
  `sec2` varchar(70) DEFAULT NULL,
  `sec3` varchar(70) DEFAULT NULL,
  `vendor_contact` varchar(70) DEFAULT NULL,
  `category` varchar(80) NOT NULL,
  `website` varchar(90) NOT NULL,
  `notes` text NOT NULL,
  `title` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_info`
--

INSERT INTO `client_info` (`client_name`, `client_add`, `contact_name`, `contact_phone`, `contact_email`, `sec1`, `sec2`, `sec3`, `vendor_contact`, `category`, `website`, `notes`, `title`) VALUES
('Another Client', 'jkljl', 'lkjlk', 'kjlk', 'jlkj', 'jlkjl', NULL, NULL, NULL, 'lkj', 'kjlkjl', 'kjlkjlkj', 'lkjlk'),
('Femina1', '8 Southside Avesdfsf', 'Femina Patel', '1234567890', 'femina@gmail.com', '1231231230', '', '', '', 'student', 'sbdbjsfj.com', 'new note', 'Circular progress bar (canvas)'),
('Hi', 'lkjl', 'kjlkj', 'kjlk', 'jlkj', 'kjlk', NULL, NULL, NULL, 'lkj', 'jlkj', 'lkjk', 'ljl'),
('james', '987', 'issac newtron', 'lkjlkjlk', 'lkjlkj', 'kjlk', '', '', '', 'lkjlk', 'lkjlkj', 'llkj', 'lklkj'),
('Jello', '2343 Jello', 'Jelloman', '123123434323', 'Tr@ello.com', '2346541235', NULL, NULL, NULL, 'dsf', 'p.com', 'dsfsdf', 'tret'),
('Jill Lewis', 'lkj', 'l', 'lkjlk', 'jlkj', 'lk', '', '', '', 'lkj', 'jlkjlkj', 'lkjlk', 'lkj'),
('jimmy', 'lkjlk', 'kiki', '098098098', 'lkjlkj', '0980989', '', '', '', 'lkjlkj', 'lkjlkj', 'yooo', 'lkjlkj'),
('Johny', 'jklj', 'lkjlk', 'klj', 'kljlk', 'jlkj', NULL, NULL, NULL, 'jlk', 'lkjl', 'kjllkj', 'kl'),
('Led Zeppelin', 'jlkj', 'lkjlk', 'ljlk', 'jlk', 'jlkj', '', '', '', 'jlk', 'lklkj', 'lkjlkj', 'jlk'),
('New Client', 'kljlk', 'Client', 'kljlklkj', 'lkjlklk', 'lkjlkjlkjl', '', '', '', 'lkllkjk', 'lkjlkj', 'lkj', 'lkjlkj'),
('peeetter', ';lk;lk', ';lkl;k', 'l;k;lk', ';lk;l', 'lkl;', NULL, NULL, NULL, ';lkl;k', 'llk', 'lklk', ';lkl'),
('pipoi', 'iop', 'oipo', 'ipo', 'ipo', 'ipo', NULL, NULL, NULL, 'ipo', 'ipoi', 'popi', 'ipo'),
('po pot', 'lkjlkj', 'kjlkj', 'kljlkj', 'lkjlkj', 'ljklj', '', '', '', 'lkjlkj', 'ljlkj', 'lkjlkj', 'lkjlkj'),
('Steve', '234 dfsdf', 'Stevo', '233 454 2343', 'T@r.com', '234 676 2342', '', '', '', 'trtert', 'www.gdf.vom', 'dgdfg', 'werw'),
('uoiuoiu', 'oiuoiuoiu', 'oiuoiuoi', 'oiuoiuiou', 'oiuou', 'oiuoiu', '', '', '', 'oiuoiuoi', 'oiuoiu', 'oiuoiui', 'iuoiu'),
('Yo', 'lkj', 'Dude', 'lkj', 'lkj', 'lkj', '', '', '', 'lkj', 'lkj', 'lkj', 'lkj');

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `title` varchar(45) NOT NULL,
  `text` varchar(500) NOT NULL,
  `user` varchar(15) NOT NULL,
  `timestamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documentation`
--

INSERT INTO `documentation` (`title`, `text`, `user`, `timestamp`) VALUES
('Another Test', 'fixed text', '', '2016-06-29'),
('Brother Earth', 'hello brother awe', '', '2016-06-29'),
('Father Earth', 'faaaaaaaaatttttttttttttttttthhhhhhhhhhhhherrrrrrrrrrrrr\r\nmmmmmmmmoooooooooooottttthhhhhherrrrrrrrrr\r\nchild', '', '2016-06-29'),
('femina', 'works', 'fpatel', '2016-04-22'),
('jezz', 'is adorable', 'fpatel', '2016-04-22'),
('kevin', 'rocks', 'fpatel', '2016-04-22'),
('Mother Earth', 'do this awe awe \r\n\r\ndo that awe \r\n\r\nalsoooooooooooooooooooooo do this and this and this\r\nThis is a new line\r\n', 'fpatel', '2016-04-12'),
('New Title', 'text stuff', '', '2016-06-29'),
('Sample', 'Hello', 'sayre', '2016-06-13'),
('Sister Earth', 'sister', 'fpatel', '0000-00-00'),
('Sup', 'Sup Dog', 'sayre', '0000-00-00'),
('Yolo', 'Yoollloooo', 'sayre', '2016-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `job_id` int(45) NOT NULL,
  `postage` varchar(3) DEFAULT NULL,
  `invoice_number` int(11) DEFAULT '0',
  `residual_returned` varchar(45) DEFAULT NULL,
  `2week_followup` varchar(45) DEFAULT NULL,
  `notes` text,
  `status` varchar(45) DEFAULT NULL,
  `reason` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`job_id`, `postage`, `invoice_number`, `residual_returned`, `2week_followup`, `notes`, `status`, `reason`) VALUES
(5649, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(5650, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(5651, NULL, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_ticket`
--

CREATE TABLE `job_ticket` (
  `job_id` int(45) NOT NULL,
  `client_name` varchar(45) NOT NULL,
  `project_name` varchar(45) NOT NULL,
  `ticket_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_by` varchar(30) NOT NULL,
  `estimate_number` varchar(10) NOT NULL DEFAULT '0',
  `special_instructions` text NOT NULL,
  `materials_ordered` date DEFAULT NULL,
  `materials_expected` date DEFAULT NULL,
  `expected_quantity` int(11) NOT NULL DEFAULT '0',
  `job_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_ticket`
--

INSERT INTO `job_ticket` (`job_id`, `client_name`, `project_name`, `ticket_date`, `due_date`, `created_by`, `estimate_number`, `special_instructions`, `materials_ordered`, `materials_expected`, `expected_quantity`, `job_status`) VALUES
(5649, 'james', '', '1969-12-31', '2016-07-15', '', '', '  poop', '1969-12-31', '1969-12-31', 300, 'none'),
(5650, 'james', '', '1969-12-31', '2016-07-31', '', '', '', '1969-12-31', '1969-12-31', 0, 'none'),
(5651, 'Another Client', '', '1969-12-31', '1969-12-31', '', '', '', '1969-12-31', '1969-12-31', 0, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `mail_data`
--

CREATE TABLE `mail_data` (
  `job_id` int(45) NOT NULL,
  `data_loc` text NOT NULL,
  `records_total` int(45) NOT NULL DEFAULT '0',
  `domestic` int(45) NOT NULL DEFAULT '0',
  `foreigns` int(45) NOT NULL DEFAULT '0',
  `data_source` varchar(45) NOT NULL,
  `data_received` date DEFAULT NULL,
  `data_completed` date DEFAULT NULL,
  `processed_by` varchar(45) DEFAULT NULL,
  `dqr_sent` date DEFAULT NULL,
  `exact` varchar(15) NOT NULL,
  `mail_foreigns` varchar(15) NOT NULL,
  `household` varchar(15) NOT NULL,
  `ncoa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_data`
--

INSERT INTO `mail_data` (`job_id`, `data_loc`, `records_total`, `domestic`, `foreigns`, `data_source`, `data_received`, `data_completed`, `processed_by`, `dqr_sent`, `exact`, `mail_foreigns`, `household`, `ncoa`) VALUES
(5649, '', 1000, 0, 0, '', '1969-12-31', '1969-12-31', 'djefferson', '1969-12-31', '', '', '', ''),
(5650, '', 4000, 0, 0, '', '1969-12-31', '1969-12-31', 'igadge', '1969-12-31', '', '', '', ''),
(5651, '', 5000, 0, 0, '', '1969-12-31', '1969-12-31', 'djefferson', '1969-12-31', '', '', '', '');

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
  `non_profit_number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_info`
--

INSERT INTO `mail_info` (`job_id`, `mail_class`, `rate`, `processing_category`, `mail_dim`, `weights_measures`, `permit`, `bmeu`, `based_on`, `non_profit_number`) VALUES
(5649, '', '', '', '', '', '', '', '', 0),
(5650, '', '', '', '', '', '', '', '', 0),
(5651, '', '', '', '', '', '', '', '', 0);

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
(5649, '2016-07-15', ' ', 'yu', 'oiui', 'kjhkjhj', 56, 'Kevin', 34, 34, '23', 234);

-- --------------------------------------------------------

--
-- Table structure for table `priority_level`
--

CREATE TABLE `priority_level` (
  `job_id` int(45) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority_level`
--

INSERT INTO `priority_level` (`job_id`, `priority`) VALUES
(5649, 0),
(5650, 0),
(5651, 0);

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
(5649, 'no', 'no', '', '', '', 'In-House Envelope Printing', '', '', ''),
(5650, 'no', 'no', '', '', '', 'Tabbing,Folding', '', '', ''),
(5651, 'no', 'no', '', '', '', 'Mail Merge', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `production_data`
--

CREATE TABLE `production_data` (
  `id` varchar(30) NOT NULL DEFAULT '0',
  `total_records` int(11) NOT NULL,
  `records_per` varchar(150) NOT NULL,
  `time_number` varchar(150) NOT NULL,
  `time_unit` varchar(75) NOT NULL,
  `people` varchar(50) NOT NULL,
  `job` varchar(75) NOT NULL,
  `hours` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production_data`
--

INSERT INTO `production_data` (`id`, `total_records`, `records_per`, `time_number`, `time_unit`, `people`, `job`, `hours`) VALUES
('5002', 1, '40', '1', 'hr.', '1', 'Letter Printing', 0.025),
('5004', 1000, '200,200', '30,1', 'sec.,hr.', '1,1', 'Sealing,Folding', 5.04167),
('5005', 10000, '100,100', '1,1', 'hr.,hr.', '1,1', 'Folding,Inserting', 200),
('5007', 500, '50,100', '1,1', 'hr.,hr.', '2,1', 'Mail Merge,Letter Printing', 10),
('5008', 1, '1,1', '1,1', 'hr.,hr.', '1,3', 'Mail Merge,Mail Merge', 1.33333),
('5009', 500, '50', '1', 'hr.', '1', 'Folding', 10),
('5012', 1000, '100', '1', 'hr.', '1', 'In-House Envelope Printing', 10),
('5013', 4000, '200,150', '1,1', 'hr.,hr.', '1,2', 'Folding,Tabbing', 33.3333),
('5014', 1000, '10', '1', 'hr.', '1', 'Mail Merge', 100);

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
  `id` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `vendor_name` varchar(30) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `occurence` varchar(30) NOT NULL,
  `current_day` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`id`, `user`, `text`, `date`, `vendor_name`, `client_name`, `occurence`, `current_day`) VALUES
(15, 'admin', 'Call Jill Lewis', '0000-00-00', 'None', 'Jill Lewis', 'Weekly', 'Thu'),
(16, 'admin', 'heeeeello', '2016-07-14', 'Kevin', 'jimmy', 'Once', 'None'),
(17, 'admin', 'Call New Client', '2016-07-13', 'None', 'New Client', 'Weekly', 'Wed'),
(18, 'admin', 'Call Sample and Led Zeppelin', '2016-07-13', 'Sample', 'Steve', 'Once', 'None'),
(19, 'admin', 'Call them', '2016-07-13', 'Jezz', 'Led Zeppelin', 'Once', 'None'),
(20, 'admin', 'Change Text', '2016-07-13', 'Femina', 'None', 'Once', 'None'),
(21, 'admin', 'Monthly Reminder', '0000-00-00', 'Venderoni', 'Johny', 'Monthly', 'None'),
(22, 'admin', 'Weekly Reminder for Thursday', '0000-00-00', 'None', 'jimmy', 'Weekly', 'Thu'),
(23, 'admin', 'call jimmy', '2016-07-15', 'None', 'jimmy', 'Once', 'None'),
(24, 'admin', 'Hello', '0000-00-00', 'None', 'None', 'Weekly', 'Sun');

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
('sayre', '2016-06-28 16:48:28', 'added popular Weights and Measures', 'PM'),
('sayre', '0000-00-00 00:00:00', 'added new doc', ''),
('sayre', '2016-06-29 09:17:53', 'added documentation', 'AM'),
('sayre', '0000-00-00 00:00:00', 'updated doc', ''),
('sayre', '2016-06-29 09:19:36', 'added documentation', 'AM'),
('sayre', '2016-06-29 09:21:04', 'added documentation', 'AM'),
('sayre', '2016-06-29 09:33:28', 'added documentation', 'AM'),
('sayre', '2016-06-29 09:34:58', 'deleted documentation', 'AM'),
('sayre', '2016-06-29 09:35:23', 'updated documentation', 'AM'),
('sayre', '2016-06-29 09:36:02', 'updated documentation', 'AM'),
('sayre', '2016-06-29 09:36:05', 'updated documentation', 'AM'),
('sayre', '0000-00-00 00:00:00', 'added new w&m', ''),
('sayre', '2016-06-29 10:38:47', 'updated vendor', 'AM'),
('sayre', '2016-06-29 10:40:26', 'added weights and measure', 'AM'),
('sayre', '2016-06-29 11:17:24', 'updated weights and measure', 'AM'),
('sayre', '2016-06-29 11:23:12', 'updated weights and measure', 'AM'),
('sayre', '2016-06-29 11:25:31', 'updated weights and measure', 'AM'),
('sayre', '2016-06-29 11:27:15', 'deleted weights and measure', 'AM'),
('sayre', '0000-00-00 00:00:00', 'created job ticket', ''),
('sayre', '0000-00-00 00:00:00', 'created job ticket', ''),
('sayre', '2016-06-29 15:03:46', 'created job ticket', ''),
('sayre', '2016-06-29 15:13:37', 'created job ticket', 'PM'),
('sayre', '2016-06-29 15:15:39', 'created job ticket', 'PM'),
('sayre', '2016-06-29 15:16:09', 'created job ticket', 'PM'),
('sayre', '2016-06-29 15:23:37', 'created job ticket', 'PM'),
('sayre', '2016-06-29 15:27:05', 'created job ticket', 'PM'),
('sayre', '0000-00-00 00:00:00', 'updated job ticket', ''),
('sayre', '0000-00-00 00:00:00', 'updated job ticket', ''),
('sayre', '0000-00-00 00:00:00', 'updated job ticket', ''),
('sayre', '2016-06-29 16:32:01', 'created job ticket', 'PM'),
('sayre', '2016-06-29 16:37:29', 'created job ticket', 'PM'),
('sayre', '2016-06-29 16:46:12', 'created job ticket', 'PM'),
('sayre', '2016-06-29 16:53:16', 'created job ticket', 'PM'),
('sayre', '0000-00-00 00:00:00', 'updated job ticket', ''),
('sayre', '2016-07-04 18:01:01', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:01:54', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:03:18', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:04:13', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:05:04', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:07:39', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:08:04', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:09:34', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:11:05', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 18:16:43', 'added new client', 'PM'),
('sayre', '2016-07-04 19:14:23', 'added new client', 'PM'),
('sayre', '2016-07-04 19:14:40', 'added new client', 'PM'),
('sayre', '2016-07-04 19:18:51', 'added new client', 'PM'),
('sayre', '2016-07-04 19:19:39', 'added new client', 'PM'),
('sayre', '2016-07-04 19:20:13', 'added new client', 'PM'),
('sayre', '2016-07-04 19:21:32', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 19:22:03', 'added weights and measure', 'PM'),
('sayre', '2016-07-04 19:27:28', 'deleted client info', 'PM'),
('sayre', '2016-07-04 19:28:50', 'deleted client info', 'PM'),
('sayre', '2016-07-04 21:52:09', 'created job ticket', 'PM'),
('sayre', '2016-07-04 21:57:09', 'created job ticket', 'PM'),
('admin', '2016-07-05 12:47:45', 'created job ticket', 'PM'),
('admin', '0000-00-00 00:00:00', 'updated job ticket', ''),
('admin', '0000-00-00 00:00:00', 'updated job ticket', ''),
('admin', '0000-00-00 00:00:00', 'updated job ticket', ''),
('admin', '2016-07-05 13:10:36', 'updated job ticket', ''),
('admin', '2016-07-05 13:11:16', 'updated job ticket', 'PM'),
('admin', '2016-07-05 13:12:57', 'updated job ticket', 'PM'),
('admin', '2016-07-05 13:13:15', 'updated job ticket', 'PM'),
('admin', '2016-07-05 13:13:30', 'updated job ticket', 'PM'),
('admin', '2016-07-05 13:16:31', 'updated job ticket', 'PM'),
('admin', '2016-07-05 13:16:44', 'updated job ticket', 'PM'),
('admin', '2016-07-05 13:26:54', 'updated job ticket', 'PM'),
('admin', '2016-07-05 13:30:35', 'deleted job ticket', 'PM'),
('admin', '2016-07-05 13:31:50', 'created job ticket', 'PM'),
('admin', '2016-07-05 13:32:34', 'created job ticket', 'PM'),
('admin', '2016-07-05 13:52:03', 'updated job ticket', 'PM'),
('admin', '2016-07-05 14:10:02', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:13:00', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:17:38', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:20:41', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:20:58', 'deleted job ticket', 'PM'),
('admin', '2016-07-05 14:23:41', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:24:35', 'updated job ticket', 'PM'),
('admin', '2016-07-05 14:24:53', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:27:02', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:32:34', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:36:49', 'created job ticket', 'PM'),
('admin', '2016-07-05 14:58:05', 'created job ticket', 'PM'),
('admin', '2016-07-05 15:09:47', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:10:08', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:10:15', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:12:52', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:15:17', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:53:26', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:56:04', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:56:52', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:59:18', 'updated job ticket', 'PM'),
('admin', '2016-07-05 15:59:37', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:01:13', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:03:17', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:04:40', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:17:20', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:32:16', 'created job ticket', 'PM'),
('admin', '2016-07-05 16:33:21', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:35:54', 'created job ticket', 'PM'),
('admin', '2016-07-05 16:37:02', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:38:02', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:39:21', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:44:41', 'created job ticket', 'PM'),
('admin', '2016-07-05 16:45:09', 'updated job ticket', 'PM'),
('admin', '2016-07-05 16:46:04', 'created job ticket', 'PM'),
('admin', '2016-07-06 09:14:07', 'updated job ticket', 'AM'),
('admin', '2016-07-06 09:15:06', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:02:00', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:08:33', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:09:36', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:10:32', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:39:26', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:41:25', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:47:03', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:47:18', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:47:37', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:48:21', 'updated job ticket', 'AM'),
('admin', '2016-07-06 10:50:31', 'updated job ticket', 'AM'),
('admin', '2016-07-06 11:07:15', 'updated job ticket', 'AM'),
('admin', '2016-07-06 11:07:31', 'updated job ticket', 'AM'),
('admin', '2016-07-06 11:12:38', 'added weights and measure', 'AM'),
('admin', '2016-07-06 11:15:43', 'updated job ticket', 'AM'),
('admin', '2016-07-06 11:16:02', 'updated job ticket', 'AM'),
('admin', '0000-00-00 00:00:00', 'archived job', ''),
('admin', '0000-00-00 00:00:00', 'archived job', ''),
('admin', '0000-00-00 00:00:00', 'archived job', ''),
('admin', '2016-07-06 11:26:04', 'updated job ticket', 'AM'),
('admin', '2016-07-06 11:26:23', 'updated job ticket', 'AM'),
('admin', '2016-07-06 11:36:50', 'archived job', ''),
('admin', '2016-07-06 11:44:13', 'job assigned to Project Management', 'AM'),
('admin', '2016-07-06 11:56:52', 'updated job ticket', 'AM'),
('admin', '2016-07-06 12:25:58', 'job assigned to Customer Service', 'PM'),
('admin', '2016-07-06 12:29:47', 'archived job', 'PM'),
('admin', '2016-07-06 12:35:32', 'archived job', 'PM'),
('admin', '2016-07-06 12:37:19', 'archived job', 'PM'),
('admin', '2016-07-06 12:37:23', 'archived job', 'PM'),
('admin', '2016-07-06 12:37:44', 'archived job', 'PM'),
('admin', '2016-07-06 12:38:23', 'archived job', 'PM'),
('admin', '2016-07-06 12:39:29', 'archived job', 'PM'),
('admin', '2016-07-06 12:39:51', 'archived job', 'PM'),
('admin', '2016-07-06 12:41:17', 'updated job ticket', 'PM'),
('admin', '2016-07-06 12:41:27', 'archived job', 'PM'),
('admin', '2016-07-06 12:42:54', 'updated job ticket', 'PM'),
('admin', '2016-07-06 12:44:04', 'updated job ticket', 'PM'),
('admin', '2016-07-06 12:44:21', 'archived job', 'PM'),
('admin', '2016-07-06 12:44:43', 'archived job', 'PM'),
('admin', '2016-07-06 12:47:32', 'archived job', 'PM'),
('admin', '2016-07-06 13:35:17', 'archived job', 'PM'),
('admin', '2016-07-06 13:49:55', 'deleted job ticket', 'PM'),
('admin', '2016-07-06 13:54:28', 'deleted job ticket', 'PM'),
('admin', '2016-07-06 14:04:51', 'archived job', 'PM'),
('admin', '2016-07-06 15:24:49', 'deleted documentation', 'PM'),
('admin', '2016-07-06 15:59:49', 'updated job ticket', 'PM'),
('admin', '2016-07-06 16:31:58', 'created job ticket', 'PM'),
('admin', '2016-07-06 16:32:46', 'updated job ticket', 'PM'),
('admin', '2016-07-06 16:33:06', 'updated job ticket', 'PM'),
('admin', '2016-07-06 16:33:34', 'created job ticket', 'PM'),
('admin', '2016-07-06 16:33:54', 'updated job ticket', 'PM'),
('admin', '2016-07-06 16:43:31', 'job assigned to Customer Service', 'PM'),
('admin', '2016-07-06 16:46:33', 'job assigned to Customer Service', 'PM'),
('admin', '2016-07-06 16:48:49', 'job assigned to Customer Service', 'PM'),
('admin', '2016-07-06 16:50:32', 'job assigned to Customer Service', 'PM'),
('admin', '2016-07-06 16:53:14', 'updated job ticket', 'PM'),
('admin', '2016-07-06 16:53:26', 'deleted job ticket', 'PM'),
('admin', '2016-07-06 16:53:34', 'deleted job ticket', 'PM'),
('sayre', '2016-07-10 12:20:44', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 12:21:36', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 12:32:46', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 12:55:12', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 12:55:49', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 12:56:07', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 12:56:56', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 12:57:53', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 13:07:19', 'updated job ticket', 'PM'),
('sayre', '2016-07-10 13:36:42', 'job assigned to Customer Service', 'PM'),
('sayre', '2016-07-11 13:28:27', 'updated job ticket', 'PM'),
('sayre', '2016-07-11 14:54:42', 'updated job ticket', 'PM'),
('sayre', '2016-07-11 15:01:05', 'updated job ticket', 'PM'),
('sayre', '2016-07-11 15:28:12', 'updated job ticket', 'PM'),
('sayre', '2016-07-11 15:32:29', 'updated job ticket', 'PM'),
('sayre', '2016-07-11 15:33:43', 'updated job ticket', 'PM'),
('sayre', '2016-07-11 16:08:54', 'job assigned to Customer Service', 'PM'),
('sayre', '2016-07-12 12:35:14', 'updated job ticket', 'PM'),
('sayre', '2016-07-12 13:27:06', 'updated job ticket', 'PM'),
('sayre', '2016-07-12 13:32:29', 'updated job ticket', 'PM'),
('sayre', '2016-07-12 13:33:01', 'updated job ticket', 'PM'),
('sayre', '2016-07-12 14:40:39', 'updated job ticket', 'PM'),
('sayre', '2016-07-12 14:41:45', 'updated job ticket', 'PM'),
('sayre', '2016-07-12 14:58:09', 'created job ticket', 'PM'),
('sayre', '2016-07-12 14:59:19', 'updated job ticket', 'PM'),
('sayre', '2016-07-12 15:00:06', 'archived job', 'PM'),
('admin', '2016-07-12 15:02:19', 'updated job ticket', 'PM'),
('admin', '2016-07-12 15:03:10', 'updated job ticket', 'PM'),
('admin', '2016-07-12 15:04:12', 'updated job ticket', 'PM'),
('admin', '2016-07-12 15:05:10', 'updated job ticket', 'PM'),
('admin', '2016-07-12 16:06:05', 'updated job ticket', 'PM'),
('admin', '2016-07-12 16:35:33', 'updated job ticket', 'PM'),
('sayre', '2016-07-13 09:08:28', 'updated job ticket', 'AM'),
('sayre', '2016-07-13 09:26:45', 'deleted archive job', 'AM'),
('sayre', '2016-07-13 09:27:08', 'deleted archive job', 'AM'),
('sayre', '2016-07-13 09:27:42', 'deleted job ticket', 'AM'),
('sayre', '2016-07-13 09:27:53', 'deleted job ticket', 'AM'),
('sayre', '2016-07-13 09:28:21', 'deleted job ticket', 'AM'),
('sayre', '2016-07-13 09:28:40', 'updated job ticket', 'AM'),
('sayre', '2016-07-13 09:29:07', 'updated job ticket', 'AM'),
('admin', '2016-07-13 09:29:56', 'updated job ticket', 'AM'),
('admin', '2016-07-13 09:30:05', 'archived job', 'AM'),
('admin', '2016-07-13 09:30:17', 'archived job', 'AM'),
('admin', '2016-07-13 09:34:31', 'archived job', 'AM'),
('admin', '2016-07-13 09:35:00', 'archived job', 'AM'),
('admin', '2016-07-13 09:39:30', 'archived job', 'AM'),
('admin', '2016-07-13 09:40:02', 'archived job', 'AM'),
('admin', '2016-07-13 09:42:14', 'updated job ticket', 'AM'),
('admin', '2016-07-13 09:42:21', 'archived job', 'AM'),
('admin', '2016-07-13 09:48:10', 'created job ticket', 'AM'),
('admin', '2016-07-13 09:50:45', 'job assigned to Customer Service', 'AM'),
('admin', '2016-07-13 09:57:01', 'archived job', 'AM'),
('admin', '2016-07-13 09:57:20', 'archived job', 'AM'),
('admin', '2016-07-13 10:00:13', 'job assigned to Customer Service', 'AM'),
('admin', '2016-07-13 10:02:22', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:03:00', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:03:47', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:04:29', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:05:21', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:05:34', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:06:26', 'deleted archive job', 'AM'),
('admin', '2016-07-13 10:19:25', 'job assigned to Customer Service', 'AM'),
('admin', '2016-07-13 10:19:44', 'archived job', 'AM'),
('admin', '2016-07-13 10:20:06', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:20:28', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:20:42', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:21:06', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:22:12', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:23:10', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:23:52', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:24:54', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:25:26', 'archived job', 'AM'),
('admin', '2016-07-13 10:25:53', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:32:34', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:33:25', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:33:31', 'archived job', 'AM'),
('admin', '2016-07-13 10:33:48', 'deleted archive job', 'AM'),
('admin', '2016-07-13 10:34:29', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:35:04', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:38:10', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:38:17', 'archived job', 'AM'),
('admin', '2016-07-13 10:40:26', 'deleted archive job', 'AM'),
('admin', '2016-07-13 10:45:15', 'added new client', 'AM'),
('admin', '2016-07-13 10:51:31', 'created job ticket', 'AM'),
('admin', '2016-07-13 10:51:50', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:52:22', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:52:50', 'updated job ticket', 'AM'),
('admin', '2016-07-13 10:53:11', 'updated job ticket', 'AM'),
('admin', '2016-07-13 11:07:13', 'created job ticket', 'AM'),
('admin', '2016-07-13 11:07:36', 'updated job ticket', 'AM'),
('admin', '2016-07-13 11:08:27', 'updated job ticket', 'AM'),
('admin', '2016-07-13 11:16:08', 'created job ticket', 'AM'),
('admin', '2016-07-13 11:16:21', 'updated job ticket', 'AM'),
('admin', '2016-07-13 12:06:03', 'updated job ticket', 'PM'),
('admin', '2016-07-13 12:10:54', 'added weights and measure', 'PM'),
('admin', '2016-07-13 14:39:57', 'updated job ticket', 'PM'),
('admin', '2016-07-13 14:40:14', 'updated job ticket', 'PM'),
('admin', '2016-07-13 14:40:25', 'updated job ticket', 'PM'),
('admin', '2016-07-13 16:42:41', 'updated job ticket', 'PM'),
('admin', '2016-07-13 16:43:03', 'updated job ticket', 'PM'),
('admin', '2016-07-17 14:19:59', 'created job ticket', 'PM'),
('sayre', '2016-07-18 12:22:12', 'updated job ticket', 'PM'),
('sayre', '2016-07-18 12:23:48', 'updated job ticket', 'PM'),
('sayre', '2016-07-18 14:49:23', 'deleted job ticket', 'PM');

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
('sdfsdf', 'sdfsdf', 'SS', 'Development', '4@asdasd', 'sdfsdf', 'sdfsdf', 'MEMBER'),
('jshmo', 'poopy', 'JS', 'Customer Service', 'poop@shit.net', 'Joe', 'Shmoe', 'MEMBER'),
('ghgfhgf', 'sdfsdf', 'SS', 'Project Management', 'fddsf@', 'sdfs', 'sdfdsf', 'MEMBER'),
('djefferson', 'tilda', 'DJ', 'Production', 'r@l.com', 'Denzel', 'Jefferson', 'MEMBER'),
('mbroc', 'veggies', 'MB', 'Project Management', 'm@b.com', 'Michael', 'Brocolli', 'MEMBER'),
('igadge', 'gadge', 'IG', 'Production', 'G@w.com', 'Inspector', 'Gadget', 'MEMBER');

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
  `1` tinyint(1) NOT NULL DEFAULT '0',
  `2` tinyint(1) NOT NULL DEFAULT '0',
  `3` tinyint(1) NOT NULL DEFAULT '0',
  `4` tinyint(1) NOT NULL DEFAULT '0',
  `5` tinyint(1) NOT NULL DEFAULT '0',
  `6` tinyint(1) NOT NULL DEFAULT '0',
  `7` tinyint(1) NOT NULL DEFAULT '0',
  `8` tinyint(1) NOT NULL DEFAULT '0',
  `9` tinyint(1) NOT NULL DEFAULT '0',
  `10` tinyint(1) NOT NULL DEFAULT '0',
  `11` tinyint(1) NOT NULL DEFAULT '0',
  `12` tinyint(1) NOT NULL DEFAULT '0',
  `13` tinyint(1) NOT NULL DEFAULT '0',
  `14` tinyint(1) NOT NULL DEFAULT '0',
  `percent` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yellow_sheet`
--

INSERT INTO `yellow_sheet` (`job_id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `percent`) VALUES
(5649, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5650, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5651, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD UNIQUE KEY `id` (`id`);

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
  MODIFY `job_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5652;
--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
