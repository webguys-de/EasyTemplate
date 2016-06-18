-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2016 at 03:21 PM
-- Server version: 5.7.12-0ubuntu1
-- PHP Version: 7.0.4-7ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `streetandtrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `easytemplate`
--

CREATE TABLE `easytemplate_template` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `group_id` smallint(6) NOT NULL COMMENT 'group_id',
  `code` varchar(255) NOT NULL COMMENT 'code',
  `name` varchar(255) NOT NULL COMMENT 'name',
  `active` smallint(6) NOT NULL DEFAULT '0' COMMENT 'active',
  `position` int(10) UNSIGNED NOT NULL COMMENT 'position',
  `valid_from` datetime DEFAULT NULL COMMENT 'valid_from',
  `valid_to` datetime DEFAULT NULL COMMENT 'valid_to'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Template';

-- --------------------------------------------------------

--
-- Table structure for table `easytemplate_data_datetime`
--

CREATE TABLE `easytemplate_data_datetime` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `template_id` int(10) UNSIGNED NOT NULL COMMENT 'block_id',
  `field` varchar(255) NOT NULL COMMENT 'field',
  `value` datetime DEFAULT NULL COMMENT 'value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Template Data Datetime';

-- --------------------------------------------------------

--
-- Table structure for table `easytemplate_data_decimal`
--

CREATE TABLE `easytemplate_data_decimal` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `template_id` int(10) UNSIGNED NOT NULL COMMENT 'block_id',
  `field` varchar(255) NOT NULL COMMENT 'field',
  `value` decimal(12,4) DEFAULT NULL COMMENT 'value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Template Data Decimal';

-- --------------------------------------------------------

--
-- Table structure for table `easytemplate_data_int`
--

CREATE TABLE `easytemplate_data_int` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `template_id` int(10) UNSIGNED NOT NULL COMMENT 'block_id',
  `field` varchar(255) NOT NULL COMMENT 'field',
  `value` int(11) DEFAULT NULL COMMENT 'value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Template Data Int';

-- --------------------------------------------------------

--
-- Table structure for table `easytemplate_data_text`
--

CREATE TABLE `easytemplate_data_text` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `template_id` int(10) UNSIGNED NOT NULL COMMENT 'block_id',
  `field` varchar(255) NOT NULL COMMENT 'field',
  `value` text COMMENT 'value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Template Data Text';

-- --------------------------------------------------------

--
-- Table structure for table `easytemplate_data_varchar`
--

CREATE TABLE `easytemplate_data_varchar` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Id',
  `template_id` int(10) UNSIGNED NOT NULL COMMENT 'block_id',
  `field` varchar(255) NOT NULL COMMENT 'field',
  `value` varchar(255) DEFAULT NULL COMMENT 'value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Template Data Varchar';

-- --------------------------------------------------------

--
-- Table structure for table `easytemplate_group`
--

CREATE TABLE `easytemplate_group` (
  `id` smallint(6) NOT NULL COMMENT 'Id',
  `entity_type` varchar(255) NOT NULL COMMENT 'entity_type',
  `entity_id` smallint(5) UNSIGNED NOT NULL COMMENT 'entity_id',
  `store_id` smallint(6) DEFAULT NULL,
  `copy_of` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Templategroup';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `easytemplate_template`
--
ALTER TABLE `easytemplate_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EASYTEMPLATE_CODE` (`code`),
  ADD KEY `FK_EASYTEMPLATE_GROUP_ID_EASYTEMPLATE_GROUP_ID` (`group_id`);

--
-- Indexes for table `easytemplate_data_datetime`
--
ALTER TABLE `easytemplate_data_datetime`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_EASYTEMPLATE_DATA_DATETIME_TEMPLATE_ID_FIELD` (`template_id`,`field`),
  ADD KEY `IDX_EASYTEMPLATE_DATA_DATETIME_FIELD` (`field`);

--
-- Indexes for table `easytemplate_data_decimal`
--
ALTER TABLE `easytemplate_data_decimal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_EASYTEMPLATE_DATA_DECIMAL_TEMPLATE_ID_FIELD` (`template_id`,`field`),
  ADD KEY `IDX_EASYTEMPLATE_DATA_DECIMAL_FIELD` (`field`);

--
-- Indexes for table `easytemplate_data_int`
--
ALTER TABLE `easytemplate_data_int`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_EASYTEMPLATE_DATA_INT_TEMPLATE_ID_FIELD` (`template_id`,`field`),
  ADD KEY `IDX_EASYTEMPLATE_DATA_INT_FIELD` (`field`);

--
-- Indexes for table `easytemplate_data_text`
--
ALTER TABLE `easytemplate_data_text`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_EASYTEMPLATE_DATA_TEXT_TEMPLATE_ID_FIELD` (`template_id`,`field`),
  ADD KEY `IDX_EASYTEMPLATE_DATA_TEXT_FIELD` (`field`);

--
-- Indexes for table `easytemplate_data_varchar`
--
ALTER TABLE `easytemplate_data_varchar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_EASYTEMPLATE_DATA_VARCHAR_TEMPLATE_ID_FIELD` (`template_id`,`field`),
  ADD KEY `IDX_EASYTEMPLATE_DATA_VARCHAR_FIELD` (`field`);

--
-- Indexes for table `easytemplate_group`
--
ALTER TABLE `easytemplate_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `easytemplate_template`
--
ALTER TABLE `easytemplate_template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `easytemplate_data_datetime`
--
ALTER TABLE `easytemplate_data_datetime`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id';
--
-- AUTO_INCREMENT for table `easytemplate_data_decimal`
--
ALTER TABLE `easytemplate_data_decimal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id';
--
-- AUTO_INCREMENT for table `easytemplate_data_int`
--
ALTER TABLE `easytemplate_data_int`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `easytemplate_data_text`
--
ALTER TABLE `easytemplate_data_text`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `easytemplate_data_varchar`
--
ALTER TABLE `easytemplate_data_varchar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `easytemplate_group`
--
ALTER TABLE `easytemplate_group`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=0;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `easytemplate_template`
--
ALTER TABLE `easytemplate_template`
  ADD CONSTRAINT `FK_EASYTEMPLATE_GROUP_ID_EASYTEMPLATE_GROUP_ID` FOREIGN KEY (`group_id`) REFERENCES `easytemplate_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `easytemplate_data_datetime`
--
ALTER TABLE `easytemplate_data_datetime`
  ADD CONSTRAINT `FK_EASYTEMPLATE_DATA_DATETIME_TEMPLATE_ID_EASYTEMPLATE_ID` FOREIGN KEY (`template_id`) REFERENCES `easytemplate_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `easytemplate_data_decimal`
--
ALTER TABLE `easytemplate_data_decimal`
  ADD CONSTRAINT `FK_EASYTEMPLATE_DATA_DECIMAL_TEMPLATE_ID_EASYTEMPLATE_ID` FOREIGN KEY (`template_id`) REFERENCES `easytemplate_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `easytemplate_data_int`
--
ALTER TABLE `easytemplate_data_int`
  ADD CONSTRAINT `FK_EASYTEMPLATE_DATA_INT_TEMPLATE_ID_EASYTEMPLATE_ID` FOREIGN KEY (`template_id`) REFERENCES `easytemplate_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `easytemplate_data_text`
--
ALTER TABLE `easytemplate_data_text`
  ADD CONSTRAINT `FK_EASYTEMPLATE_DATA_TEXT_TEMPLATE_ID_EASYTEMPLATE_ID` FOREIGN KEY (`template_id`) REFERENCES `easytemplate_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `easytemplate_data_varchar`
--
ALTER TABLE `easytemplate_data_varchar`
  ADD CONSTRAINT `FK_EASYTEMPLATE_DATA_VARCHAR_TEMPLATE_ID_EASYTEMPLATE_ID` FOREIGN KEY (`template_id`) REFERENCES `easytemplate_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
