-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2020 at 01:16 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shree`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `design_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `design_view`;
CREATE TABLE IF NOT EXISTS `design_view` (
`id` int(11)
,`designName` varchar(20)
,`designSeries` varchar(50)
,`desCode` varchar(255)
,`rate` varchar(62)
,`stitch` text
,`dye` varchar(20)
,`matching` varchar(225)
,`sale_rate` double
,`htCattingRate` int(10)
,`designPic` varchar(128)
,`fabricName` varchar(64)
,`barCode` varchar(20)
,`designOn` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dispatch_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `dispatch_view`;
CREATE TABLE IF NOT EXISTS `dispatch_view` (
`trans_meta_id` int(11)
,`challan_no` varchar(32)
,`from_godown` int(5)
,`to_godown` int(5)
,`status` enum('new','old')
,`order_number` varchar(20)
,`order_date` date
,`unit` varchar(20)
,`quantity` float(6,2)
,`order_barcode` varchar(30)
,`image` text
,`fabric_name` varchar(30)
,`design_name` varchar(30)
,`dye` varchar(30)
,`pbc` varchar(32)
,`hsn` varchar(30)
,`design_code` varchar(50)
,`design_barcode` varchar(30)
,`finish_qty` float(5,2)
,`stat` enum('pending','recieved','out')
,`created_at` date
,`transaction_id` int(11)
,`matching` varchar(30)
,`Party_name` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `fabric_stock_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `fabric_stock_view`;
CREATE TABLE IF NOT EXISTS `fabric_stock_view` (
`fsr_id` int(11)
,`parent_barcode` varchar(24)
,`parent` varchar(11)
,`fabric_type` varchar(24)
,`hsn` varchar(64)
,`stock_quantity` double(6,2)
,`current_stock` double(6,2)
,`stock_unit` varchar(6)
,`challan_no` varchar(64)
,`unit_id` varchar(11)
,`color_name` varchar(24)
,`ad_no` varchar(32)
,`purchase_code` varchar(12)
,`purchase_rate` int(11)
,`total_value` double(8,2)
,`tc` double(5,2)
,`challan_type` enum('recieve','return','tc')
,`created_date` date
,`godownid` varchar(9)
,`fabricName` varchar(20)
,`challan_from` varchar(20)
,`challan_to` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `godown_stock_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `godown_stock_view`;
CREATE TABLE IF NOT EXISTS `godown_stock_view` (
`trans_meta_id` int(11)
,`challan_no` varchar(32)
,`from_godown` int(5)
,`to_godown` int(5)
,`status` enum('new','old')
,`order_number` varchar(20)
,`order_date` date
,`unit` varchar(20)
,`quantity` float(6,2)
,`order_barcode` varchar(30)
,`image` text
,`fabric_name` varchar(30)
,`design_name` varchar(30)
,`dye` varchar(30)
,`pbc` varchar(32)
,`hsn` varchar(30)
,`design_code` varchar(50)
,`design_barcode` varchar(30)
,`finish_qty` float(5,2)
,`stat` enum('pending','recieved','out')
,`matching` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `order_view`;
CREATE TABLE IF NOT EXISTS `order_view` (
`order_number` varchar(20)
,`order_date` date
,`order_product_id` int(11)
,`order_id` varchar(32)
,`series_number` varchar(20)
,`design_barcode` varchar(30)
,`pbc` varchar(32)
,`unit` varchar(20)
,`quantity` float(6,2)
,`priority` varchar(50)
,`order_barcode` varchar(30)
,`remark` varchar(20)
,`image` text
,`design_code` varchar(50)
,`fabric_name` varchar(30)
,`hsn` varchar(30)
,`design_name` varchar(30)
,`stitch` varchar(30)
,`dye` varchar(30)
,`matching` varchar(30)
,`status` enum('PENDING','CANCEL','INPROCESS','DONE','OUT')
,`customer_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `plain_godown_stock`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `plain_godown_stock`;
CREATE TABLE IF NOT EXISTS `plain_godown_stock` (
`order_product_id` int(11)
,`design_barcode` varchar(30)
,`pbc` varchar(32)
,`unit` varchar(20)
,`quantity` float(6,2)
,`order_barcode` varchar(30)
,`image` text
,`design_code` varchar(50)
,`fabric_name` varchar(30)
,`hsn` varchar(30)
,`design_name` varchar(30)
,`stitch` varchar(30)
,`dye` varchar(30)
,`matching` varchar(30)
,`status` enum('PENDING','CANCEL','INPROCESS','DONE','OUT')
,`godown` int(5)
,`order_number` varchar(20)
,`order_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `second_pbc_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `second_pbc_view`;
CREATE TABLE IF NOT EXISTS `second_pbc_view` (
`fsr_id` int(11)
,`parent_barcode` varchar(24)
,`parent` varchar(11)
,`fabric_type` varchar(24)
,`hsn` varchar(64)
,`stock_quantity` double(6,2)
,`current_stock` double(6,2)
,`stock_unit` varchar(6)
,`challan_no` varchar(64)
,`unit_id` varchar(11)
,`color_name` varchar(24)
,`ad_no` varchar(32)
,`purchase_code` varchar(12)
,`purchase_rate` int(11)
,`total_value` double(8,2)
,`tc` double(5,2)
,`challan_type` enum('recieve','return','tc')
,`created_date` date
,`fabricName` varchar(20)
,`challan_from` varchar(20)
,`challan_to` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tc_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `tc_view`;
CREATE TABLE IF NOT EXISTS `tc_view` (
`fsr_id` int(11)
,`parent_barcode` varchar(24)
,`fabric_id` varchar(11)
,`parent` varchar(11)
,`fabric_type` varchar(24)
,`hsn` varchar(64)
,`stock_quantity` double(6,2)
,`current_stock` double(6,2)
,`stock_unit` varchar(6)
,`challan_no` varchar(64)
,`unit_id` varchar(11)
,`color_name` varchar(24)
,`ad_no` varchar(32)
,`purchase_code` varchar(12)
,`purchase_rate` int(11)
,`total_value` double(8,2)
,`tc` double(5,2)
,`challan_type` enum('recieve','return','tc')
,`created_date` date
,`fabricName` varchar(20)
,`challan_from` varchar(20)
,`challan_to` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `design_view`
--
DROP TABLE IF EXISTS `design_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `design_view`  AS  select `design`.`id` AS `id`,`design`.`designName` AS `designName`,`design`.`designSeries` AS `designSeries`,`erc`.`desCode` AS `desCode`,`erc`.`rate` AS `rate`,`design`.`stitch` AS `stitch`,`design`.`dye` AS `dye`,`design`.`matching` AS `matching`,`src`.`sale_rate` AS `sale_rate`,`design`.`htCattingRate` AS `htCattingRate`,`design`.`designPic` AS `designPic`,`design`.`fabricName` AS `fabricName`,`design`.`barCode` AS `barCode`,`design`.`designOn` AS `designOn` from ((`design` left join `erc` on((`design`.`designName` = `erc`.`desName`))) left join `src` on(((`src`.`fabName` = `design`.`fabricName`) and (`src`.`fabCode` = `erc`.`desCode`)))) order by `design`.`id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `dispatch_view`
--
DROP TABLE IF EXISTS `dispatch_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dispatch_view`  AS  select `transaction_meta`.`trans_meta_id` AS `trans_meta_id`,`transaction`.`challan_no` AS `challan_no`,`transaction`.`from_godown` AS `from_godown`,`transaction`.`to_godown` AS `to_godown`,`transaction`.`status` AS `status`,`order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`image` AS `image`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`design_name` AS `design_name`,`order_product`.`dye` AS `dye`,`order_product`.`pbc` AS `pbc`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_code` AS `design_code`,`order_product`.`design_barcode` AS `design_barcode`,`transaction_meta`.`finish_qty` AS `finish_qty`,`transaction_meta`.`stat` AS `stat`,`transaction`.`created_at` AS `created_at`,`transaction_meta`.`transaction_id` AS `transaction_id`,`order_product`.`matching` AS `matching`,`job_work_party`.`name` AS `Party_name` from ((((`transaction_meta` join `transaction`) join `order_table`) join `order_product`) join `job_work_party`) where ((`transaction`.`transaction_id` = `transaction_meta`.`transaction_id`) and (convert(`order_product`.`order_barcode` using utf8) = `transaction_meta`.`order_barcode`) and (`order_product`.`order_id` = `order_table`.`order_id`) and (`transaction`.`transaction_type` = 'dispatch') and (`job_work_party`.`id` = `transaction`.`toParty`)) ;

-- --------------------------------------------------------

--
-- Structure for view `fabric_stock_view`
--
DROP TABLE IF EXISTS `fabric_stock_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fabric_stock_view`  AS  select `fabric_stock_received`.`fsr_id` AS `fsr_id`,`fabric_stock_received`.`parent_barcode` AS `parent_barcode`,`fabric_stock_received`.`parent` AS `parent`,`fabric_stock_received`.`fabric_type` AS `fabric_type`,`fabric_stock_received`.`hsn` AS `hsn`,`fabric_stock_received`.`stock_quantity` AS `stock_quantity`,`fabric_stock_received`.`current_stock` AS `current_stock`,`fabric_stock_received`.`stock_unit` AS `stock_unit`,`fabric_stock_received`.`challan_no` AS `challan_no`,`fabric_stock_received`.`unit_id` AS `unit_id`,`fabric_stock_received`.`color_name` AS `color_name`,`fabric_stock_received`.`ad_no` AS `ad_no`,`fabric_stock_received`.`purchase_code` AS `purchase_code`,`fabric_stock_received`.`purchase_rate` AS `purchase_rate`,`fabric_stock_received`.`total_value` AS `total_value`,`fabric_stock_received`.`tc` AS `tc`,`fabric_stock_received`.`challan_type` AS `challan_type`,`fabric_stock_received`.`created_date` AS `created_date`,`fc`.`challan_to` AS `godownid`,`fabric`.`fabricName` AS `fabricName`,`sb1`.`subDeptName` AS `challan_from`,`sb2`.`subDeptName` AS `challan_to` from ((((`fabric_stock_received` join `fabric` on((`fabric`.`id` = `fabric_stock_received`.`fabric_id`))) join `fabric_challan` `fc` on((`fc`.`challan_no` = `fabric_stock_received`.`challan_no`))) join `sub_department` `sb1` on((`sb1`.`id` = `fc`.`challan_from`))) join `sub_department` `sb2` on((`sb2`.`id` = `fc`.`challan_to`))) where ((`fabric_stock_received`.`isStock` = 1) and (`fabric_stock_received`.`deleted` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `godown_stock_view`
--
DROP TABLE IF EXISTS `godown_stock_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `godown_stock_view`  AS  select `transaction_meta`.`trans_meta_id` AS `trans_meta_id`,`transaction`.`challan_no` AS `challan_no`,`transaction`.`from_godown` AS `from_godown`,`transaction`.`to_godown` AS `to_godown`,`transaction`.`status` AS `status`,`order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`image` AS `image`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`design_name` AS `design_name`,`order_product`.`dye` AS `dye`,`order_product`.`pbc` AS `pbc`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_code` AS `design_code`,`order_product`.`design_barcode` AS `design_barcode`,`transaction_meta`.`finish_qty` AS `finish_qty`,`transaction_meta`.`stat` AS `stat`,`order_product`.`matching` AS `matching` from (((`transaction_meta` join `transaction`) join `order_table`) join `order_product`) where ((`transaction`.`transaction_id` = `transaction_meta`.`transaction_id`) and (convert(`order_product`.`order_barcode` using utf8) = `transaction_meta`.`order_barcode`) and (`order_product`.`order_id` = `order_table`.`order_id`) and (`transaction`.`status` = 'old') and (`transaction`.`transaction_type` = 'challan') and (`transaction_meta`.`stat` = 'recieved')) ;

-- --------------------------------------------------------

--
-- Structure for view `order_view`
--
DROP TABLE IF EXISTS `order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view`  AS  select `order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date`,`order_product`.`order_product_id` AS `order_product_id`,`order_product`.`order_id` AS `order_id`,`order_product`.`series_number` AS `series_number`,`order_product`.`design_barcode` AS `design_barcode`,`order_product`.`pbc` AS `pbc`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`priority` AS `priority`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`remark` AS `remark`,`order_product`.`image` AS `image`,`order_product`.`design_code` AS `design_code`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_name` AS `design_name`,`order_product`.`stitch` AS `stitch`,`order_product`.`dye` AS `dye`,`order_product`.`matching` AS `matching`,`order_product`.`status` AS `status`,`customer_detail`.`name` AS `customer_name` from ((`order_table` join `order_product` on((`order_product`.`order_id` = `order_table`.`order_id`))) join `customer_detail` on((`customer_detail`.`id` = `order_table`.`customer_name`))) ;

-- --------------------------------------------------------

--
-- Structure for view `plain_godown_stock`
--
DROP TABLE IF EXISTS `plain_godown_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `plain_godown_stock`  AS  select `order_product`.`order_product_id` AS `order_product_id`,`order_product`.`design_barcode` AS `design_barcode`,`order_product`.`pbc` AS `pbc`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`image` AS `image`,`order_product`.`design_code` AS `design_code`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_name` AS `design_name`,`order_product`.`stitch` AS `stitch`,`order_product`.`dye` AS `dye`,`order_product`.`matching` AS `matching`,`order_product`.`status` AS `status`,`order_product`.`godown` AS `godown`,`order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date` from (`order_product` join `order_table`) where ((`order_table`.`order_id` = `order_product`.`order_id`) and (`order_product`.`pbc` <> '') and (`order_product`.`status` = 'DONE')) ;

-- --------------------------------------------------------

--
-- Structure for view `second_pbc_view`
--
DROP TABLE IF EXISTS `second_pbc_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `second_pbc_view`  AS  select `fabric_stock_received`.`fsr_id` AS `fsr_id`,`fabric_stock_received`.`parent_barcode` AS `parent_barcode`,`fabric_stock_received`.`parent` AS `parent`,`fabric_stock_received`.`fabric_type` AS `fabric_type`,`fabric_stock_received`.`hsn` AS `hsn`,`fabric_stock_received`.`stock_quantity` AS `stock_quantity`,`fabric_stock_received`.`current_stock` AS `current_stock`,`fabric_stock_received`.`stock_unit` AS `stock_unit`,`fabric_stock_received`.`challan_no` AS `challan_no`,`fabric_stock_received`.`unit_id` AS `unit_id`,`fabric_stock_received`.`color_name` AS `color_name`,`fabric_stock_received`.`ad_no` AS `ad_no`,`fabric_stock_received`.`purchase_code` AS `purchase_code`,`fabric_stock_received`.`purchase_rate` AS `purchase_rate`,`fabric_stock_received`.`total_value` AS `total_value`,`fabric_stock_received`.`tc` AS `tc`,`fabric_stock_received`.`challan_type` AS `challan_type`,`fabric_stock_received`.`created_date` AS `created_date`,`fabric`.`fabricName` AS `fabricName`,`sb1`.`subDeptName` AS `challan_from`,`sb2`.`subDeptName` AS `challan_to` from ((((`fabric_stock_received` join `fabric` on((`fabric`.`id` = `fabric_stock_received`.`fabric_id`))) join `fabric_challan` `fc` on((`fc`.`challan_no` = `fabric_stock_received`.`challan_no`))) join `sub_department` `sb1` on((`sb1`.`id` = `fc`.`challan_from`))) join `sub_department` `sb2` on((`sb2`.`id` = `fc`.`challan_from`))) where ((`fabric_stock_received`.`isSecond` = 1) and (`fabric_stock_received`.`deleted` = 0)) order by `fabric_stock_received`.`parent_barcode` ;

-- --------------------------------------------------------

--
-- Structure for view `tc_view`
--
DROP TABLE IF EXISTS `tc_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tc_view`  AS  select `fabric_stock_received`.`fsr_id` AS `fsr_id`,`fabric_stock_received`.`parent_barcode` AS `parent_barcode`,`fabric_stock_received`.`fabric_id` AS `fabric_id`,`fabric_stock_received`.`parent` AS `parent`,`fabric_stock_received`.`fabric_type` AS `fabric_type`,`fabric_stock_received`.`hsn` AS `hsn`,`fabric_stock_received`.`stock_quantity` AS `stock_quantity`,`fabric_stock_received`.`current_stock` AS `current_stock`,`fabric_stock_received`.`stock_unit` AS `stock_unit`,`fabric_stock_received`.`challan_no` AS `challan_no`,`fabric_stock_received`.`unit_id` AS `unit_id`,`fabric_stock_received`.`color_name` AS `color_name`,`fabric_stock_received`.`ad_no` AS `ad_no`,`fabric_stock_received`.`purchase_code` AS `purchase_code`,`fabric_stock_received`.`purchase_rate` AS `purchase_rate`,`fabric_stock_received`.`total_value` AS `total_value`,`fabric_stock_received`.`tc` AS `tc`,`fabric_stock_received`.`challan_type` AS `challan_type`,`fabric_stock_received`.`created_date` AS `created_date`,`fabric`.`fabricName` AS `fabricName`,`sb1`.`subDeptName` AS `challan_from`,`sb2`.`subDeptName` AS `challan_to` from ((((`fabric_stock_received` join `fabric` on((`fabric`.`id` = `fabric_stock_received`.`fabric_id`))) join `fabric_challan` `fc` on((`fc`.`fc_id` = `fabric_stock_received`.`fabric_challan_id`))) join `sub_department` `sb1` on((`sb1`.`id` = `fc`.`challan_from`))) join `sub_department` `sb2` on((`sb2`.`id` = `fc`.`challan_from`))) where (((`fabric_stock_received`.`tc` <> '') or (`fabric_stock_received`.`tc` <> 0)) and (`fabric_stock_received`.`isTc` = 0) and (`fabric_stock_received`.`challan_type` = 'recieve')) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
