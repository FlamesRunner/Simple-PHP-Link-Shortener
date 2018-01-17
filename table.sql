SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `linkTable` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `clicks` int(32) NOT NULL,
  `shortCode` varchar(64) NOT NULL,
  `submittedBy` varchar(140) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `linkTable`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `linkTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;
