SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

ALTER TABLE `eventinfo` ADD `file_name` TEXT NOT NULL AFTER `deleted`, ADD `full_path` TEXT NOT NULL AFTER `file_name`, ADD `file_ext` TEXT NOT NULL AFTER `full_path`;