-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2020 at 08:23 AM
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
-- Structure for view `design_view`
--
DROP TABLE IF EXISTS `design_view`;

CREATE  VIEW `design_view`  AS  select `design`.`id` AS `id`,`design`.`designName` AS `designName`,`design`.`designSeries` AS `designSeries`,`erc`.`desCode` AS `desCode`,`erc`.`rate` AS `rate`,`design`.`stitch` AS `stitch`,`design`.`dye` AS `dye`,`design`.`matching` AS `matching`,`src`.`sale_rate` AS `sale_rate`,`design`.`htCattingRate` AS `htCattingRate`,`design`.`designPic` AS `designPic`,`design`.`fabricName` AS `fabricName`,`design`.`barCode` AS `barCode`,`design`.`designOn` AS `designOn` from ((`design` left join `erc` on((`design`.`designName` = `erc`.`desName`))) left join `src` on(((`src`.`fabName` = `design`.`fabricName`) and (`src`.`fabCode` = `erc`.`desCode`)))) order by `design`.`id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `dispatch_view`
--
DROP TABLE IF EXISTS `dispatch_view`;

CREATE  VIEW `dispatch_view`  AS  select `transaction_meta`.`trans_meta_id` AS `trans_meta_id`,`transaction`.`challan_out` AS `challan_out`,`transaction`.`from_godown` AS `from_godown`,`transaction`.`to_godown` AS `to_godown`,`transaction`.`status` AS `status`,`order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`image` AS `image`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`design_name` AS `design_name`,`order_product`.`dye` AS `dye`,`order_product`.`pbc` AS `pbc`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_code` AS `design_code`,`order_product`.`design_barcode` AS `design_barcode`,`transaction_meta`.`finish_qty` AS `finish_qty`,`transaction_meta`.`stat` AS `stat`,`transaction`.`created_at` AS `created_at`,`transaction_meta`.`transaction_id` AS `transaction_id`,`order_product`.`matching` AS `matching`,`job_work_party`.`name` AS `Party_name` from ((((`transaction_meta` join `transaction`) join `order_table`) join `order_product`) join `job_work_party`) where ((`transaction`.`transaction_id` = `transaction_meta`.`transaction_id`) and (convert(`order_product`.`order_barcode` using utf8) = `transaction_meta`.`order_barcode`) and (`order_product`.`order_id` = `order_table`.`order_id`) and (`transaction`.`transaction_type` = 'dispatch') and (`job_work_party`.`id` = `transaction`.`toParty`)) ;

-- --------------------------------------------------------

--
-- Structure for view `fabric_stock_view`
--
DROP TABLE IF EXISTS `fabric_stock_view`;

CREATE  VIEW `fabric_stock_view`  AS  select `fabric_stock_received`.`fsr_id` AS `fsr_id`,`fabric_stock_received`.`parent_barcode` AS `parent_barcode`,`fabric_stock_received`.`parent` AS `parent`,`fabric`.`fabricType` AS `fabric_type`,`fabric`.`fabHsnCode` AS `hsn`,`fabric_stock_received`.`stock_quantity` AS `stock_quantity`,`fabric_stock_received`.`current_stock` AS `current_stock`,`fabric_stock_received`.`stock_unit` AS `stock_unit`,`fabric_stock_received`.`challan_no` AS `challan_no`,`fabric_stock_received`.`unit_id` AS `unit_id`,`fabric_stock_received`.`color_name` AS `color_name`,`fabric_stock_received`.`ad_no` AS `ad_no`,`fabric_stock_received`.`purchase_code` AS `purchase_code`,`fabric_stock_received`.`purchase_rate` AS `purchase_rate`,`fabric_stock_received`.`total_value` AS `total_value`,`fabric_stock_received`.`tc` AS `tc`,`fabric_stock_received`.`challan_type` AS `challan_type`,`fabric_stock_received`.`created_date` AS `created_date`,`fc`.`challan_to` AS `godownid`,`fabric`.`fabricName` AS `fabricName`,`sb1`.`subDeptName` AS `challan_from`,`sb2`.`subDeptName` AS `challan_to` from ((((`fabric_stock_received` join `fabric` on((`fabric`.`id` = `fabric_stock_received`.`fabric_id`))) join `fabric_challan` `fc` on((`fc`.`challan_no` = `fabric_stock_received`.`challan_no`))) join `sub_department` `sb1` on((`sb1`.`id` = `fc`.`challan_from`))) join `sub_department` `sb2` on((`sb2`.`id` = `fc`.`challan_to`))) where ((`fabric_stock_received`.`isStock` = 1) and (`fabric_stock_received`.`deleted` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `godown_stock_view`
--
DROP TABLE IF EXISTS `godown_stock_view`;

CREATE  VIEW `godown_stock_view`  AS  select `transaction_meta`.`trans_meta_id` AS `trans_meta_id`,`transaction`.`challan_out` AS `challan_out`,`transaction`.`from_godown` AS `from_godown`,`transaction`.`to_godown` AS `to_godown`,`transaction`.`status` AS `status`,`order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`image` AS `image`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`design_name` AS `design_name`,`order_product`.`dye` AS `dye`,`order_product`.`pbc` AS `pbc`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_code` AS `design_code`,`order_product`.`design_barcode` AS `design_barcode`,`transaction_meta`.`finish_qty` AS `finish_qty`,`transaction_meta`.`is_tc` AS `is_tc`,`transaction_meta`.`stat` AS `stat`,`order_product`.`matching` AS `matching` from (((`transaction_meta` join `transaction`) join `order_table`) join `order_product`) where ((`transaction`.`transaction_id` = `transaction_meta`.`transaction_id`) and (convert(`order_product`.`order_barcode` using utf8) = `transaction_meta`.`order_barcode`) and (`order_product`.`order_id` = `order_table`.`order_id`) and (`transaction`.`status` = 'old') and (`transaction`.`transaction_type` = 'challan') and (`transaction_meta`.`stat` = 'recieved')) ;

-- --------------------------------------------------------

--
-- Structure for view `godown_tc_view`
--
DROP TABLE IF EXISTS `godown_tc_view`;

CREATE  VIEW `godown_tc_view`  AS  select `transaction_meta`.`trans_meta_id` AS `trans_meta_id`,`transaction`.`challan_out` AS `challan_out`,`transaction`.`from_godown` AS `from_godown`,`transaction`.`status` AS `status`,`order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`image` AS `image`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`design_name` AS `design_name`,`order_product`.`dye` AS `dye`,`order_product`.`pbc` AS `pbc`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_code` AS `design_code`,`order_product`.`design_barcode` AS `design_barcode`,`transaction_meta`.`finish_qty` AS `finish_qty`,`transaction_meta`.`stat` AS `stat`,`transaction`.`created_at` AS `created_at`,`transaction_meta`.`transaction_id` AS `transaction_id`,`order_product`.`matching` AS `matching` from (((`transaction_meta` join `transaction`) join `order_table`) join `order_product`) where ((`transaction`.`transaction_id` = `transaction_meta`.`transaction_id`) and (convert(`order_product`.`order_barcode` using utf8) = `transaction_meta`.`order_barcode`) and (`order_product`.`order_id` = `order_table`.`order_id`) and (`transaction`.`transaction_type` = 'tc')) ;

-- --------------------------------------------------------

--
-- Structure for view `order_view`
--
DROP TABLE IF EXISTS `order_view`;

CREATE  VIEW `order_view`  AS  select `order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date`,`order_product`.`order_product_id` AS `order_product_id`,`order_product`.`order_id` AS `order_id`,`order_product`.`series_number` AS `series_number`,`order_product`.`design_barcode` AS `design_barcode`,`order_product`.`pbc` AS `pbc`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`priority` AS `priority`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`remark` AS `remark`,`order_product`.`image` AS `image`,`order_product`.`design_code` AS `design_code`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_name` AS `design_name`,`order_product`.`stitch` AS `stitch`,`order_product`.`dye` AS `dye`,`order_product`.`matching` AS `matching`,`order_product`.`status` AS `status`,`customer_detail`.`name` AS `customer_name`,`sub_department`.`subDeptName` AS `godown` from (((`order_table` join `order_product` on((`order_product`.`order_id` = `order_table`.`order_id`))) join `customer_detail` on((`customer_detail`.`id` = `order_table`.`customer_name`))) left join `sub_department` on((`sub_department`.`id` = `order_product`.`godown`))) ;

-- --------------------------------------------------------

--
-- Structure for view `plain_godown_stock`
--
DROP TABLE IF EXISTS `plain_godown_stock`;

CREATE  VIEW `plain_godown_stock`  AS  select `order_product`.`order_product_id` AS `order_product_id`,`order_product`.`design_barcode` AS `design_barcode`,`order_product`.`pbc` AS `pbc`,`order_product`.`unit` AS `unit`,`order_product`.`quantity` AS `quantity`,`order_product`.`order_barcode` AS `order_barcode`,`order_product`.`image` AS `image`,`order_product`.`design_code` AS `design_code`,`order_product`.`fabric_name` AS `fabric_name`,`order_product`.`hsn` AS `hsn`,`order_product`.`design_name` AS `design_name`,`order_product`.`stitch` AS `stitch`,`order_product`.`dye` AS `dye`,`order_product`.`matching` AS `matching`,`order_product`.`status` AS `status`,`order_product`.`godown` AS `godown`,`order_table`.`order_number` AS `order_number`,`order_table`.`order_date` AS `order_date` from (`order_product` join `order_table`) where ((`order_table`.`order_id` = `order_product`.`order_id`) and (`order_product`.`pbc` <> '') and (`order_product`.`status` = 'DONE')) ;

-- --------------------------------------------------------

--
-- Structure for view `second_pbc_view`
--
DROP TABLE IF EXISTS `second_pbc_view`;

CREATE  VIEW `second_pbc_view`  AS  select `fabric_stock_received`.`fsr_id` AS `fsr_id`,`fabric_stock_received`.`parent_barcode` AS `parent_barcode`,`fabric_stock_received`.`parent` AS `parent`,`fabric_stock_received`.`fabric_type` AS `fabric_type`,`fabric_stock_received`.`hsn` AS `hsn`,`fabric_stock_received`.`stock_quantity` AS `stock_quantity`,`fabric_stock_received`.`current_stock` AS `current_stock`,`fabric_stock_received`.`stock_unit` AS `stock_unit`,`fabric_stock_received`.`challan_no` AS `challan_no`,`fabric_stock_received`.`unit_id` AS `unit_id`,`fabric_stock_received`.`color_name` AS `color_name`,`fabric_stock_received`.`ad_no` AS `ad_no`,`fabric_stock_received`.`purchase_code` AS `purchase_code`,`fabric_stock_received`.`purchase_rate` AS `purchase_rate`,`fabric_stock_received`.`total_value` AS `total_value`,`fabric_stock_received`.`tc` AS `tc`,`fabric_stock_received`.`challan_type` AS `challan_type`,`fabric_stock_received`.`created_date` AS `created_date`,`fabric`.`fabricName` AS `fabricName`,`sb1`.`subDeptName` AS `challan_from`,`sb2`.`subDeptName` AS `challan_to` from ((((`fabric_stock_received` join `fabric` on((`fabric`.`id` = `fabric_stock_received`.`fabric_id`))) join `fabric_challan` `fc` on((`fc`.`challan_no` = `fabric_stock_received`.`challan_no`))) join `sub_department` `sb1` on((`sb1`.`id` = `fc`.`challan_from`))) join `sub_department` `sb2` on((`sb2`.`id` = `fc`.`challan_from`))) where ((`fabric_stock_received`.`isSecond` = 1) and (`fabric_stock_received`.`deleted` = 0)) order by `fabric_stock_received`.`parent_barcode` ;

-- --------------------------------------------------------

--
-- Structure for view `tc_view`
--
DROP TABLE IF EXISTS `tc_view`;

CREATE  VIEW `tc_view`  AS  select `fabric_stock_received`.`fsr_id` AS `fsr_id`,`fabric_stock_received`.`parent_barcode` AS `parent_barcode`,`fabric_stock_received`.`fabric_id` AS `fabric_id`,`fabric_stock_received`.`parent` AS `parent`,`fabric_stock_received`.`fabric_type` AS `fabric_type`,`fabric_stock_received`.`hsn` AS `hsn`,`fabric_stock_received`.`stock_quantity` AS `stock_quantity`,`fabric_stock_received`.`current_stock` AS `current_stock`,`fabric_stock_received`.`stock_unit` AS `stock_unit`,`fabric_stock_received`.`challan_no` AS `challan_no`,`fabric_stock_received`.`unit_id` AS `unit_id`,`fabric_stock_received`.`color_name` AS `color_name`,`fabric_stock_received`.`ad_no` AS `ad_no`,`fabric_stock_received`.`purchase_code` AS `purchase_code`,`fabric_stock_received`.`purchase_rate` AS `purchase_rate`,`fabric_stock_received`.`total_value` AS `total_value`,`fabric_stock_received`.`tc` AS `tc`,`fabric_stock_received`.`challan_type` AS `challan_type`,`fabric_stock_received`.`created_date` AS `created_date`,`fabric`.`fabricName` AS `fabricName`,`sb1`.`subDeptName` AS `challan_from`,`sb2`.`subDeptName` AS `challan_to` from ((((`fabric_stock_received` join `fabric` on((`fabric`.`id` = `fabric_stock_received`.`fabric_id`))) join `fabric_challan` `fc` on((`fc`.`fc_id` = `fabric_stock_received`.`fabric_challan_id`))) join `sub_department` `sb1` on((`sb1`.`id` = `fc`.`challan_from`))) join `sub_department` `sb2` on((`sb2`.`id` = `fc`.`challan_from`))) where (((`fabric_stock_received`.`tc` <> '') or (`fabric_stock_received`.`tc` <> 0)) and (`fabric_stock_received`.`isTc` = 0) and (`fabric_stock_received`.`challan_type` = 'recieve')) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
