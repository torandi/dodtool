
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `battles`
--

CREATE TABLE IF NOT EXISTS `battles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE IF NOT EXISTS `entities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `battle_id` int(10) unsigned NOT NULL,
  `name` varchar(32) COLLATE utf8_swedish_ci NOT NULL,
  `life` int(10) unsigned NOT NULL,
  `life_remaining` int(11) NOT NULL,
  `armor` int(10) unsigned NOT NULL,
  `armor_type` enum('normal','natural') COLLATE utf8_swedish_ci NOT NULL DEFAULT 'normal',
  `type` enum('friendly','neutral','hostile') COLLATE utf8_swedish_ci NOT NULL DEFAULT 'hostile',
  `state` enum('normal','unconscious','dead') COLLATE utf8_swedish_ci NOT NULL DEFAULT 'normal',
  `color` varchar(32) COLLATE utf8_swedish_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `info` text COLLATE utf8_swedish_ci NOT NULL,
  `position_x` int(11) NOT NULL,
  `position_y` int(11) NOT NULL,
  `rotation` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `battle_id` (`battle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entities`
--
ALTER TABLE `entities`
 ADD CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`battle_id`) REFERENCES `battles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
