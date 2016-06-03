SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `urldata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortcode` int(6) NOT NULL,
  `url` varchar(255) NOT NULL,
  `counter` int(11) NOT NULL,
  `ip` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

