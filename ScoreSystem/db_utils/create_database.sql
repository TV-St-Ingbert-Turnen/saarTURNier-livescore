-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Nov 2019 um 21:37
-- Server-Version: 5.6.26
-- PHP-Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `scoresystem`
--
CREATE DATABASE IF NOT EXISTS `scoresystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `scoresystem`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `command`
--

CREATE TABLE IF NOT EXISTS `command` (
  `cmd` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gymnastic_apparatus`
--

CREATE TABLE IF NOT EXISTS `gymnastic_apparatus` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `eID` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `gymnastic_apparatus`
--

INSERT INTO `gymnastic_apparatus` (`id`, `name`, `gender`, `eID`) VALUES
(1, 'Boden', 'b', 1),
(2, 'Sprung', 'b', 2),
(3, 'Barren', 'm', 3),
(4, 'Reck', 'm', 4),
(5, 'Stufenbarren', 'w', 4),
(6, 'Schwebebalken', 'w', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tabellenstruktur für Tabelle `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `participant_apparatus`
--

CREATE TABLE IF NOT EXISTS `participant_apparatus` (
  `pID` int(10) unsigned NOT NULL,
  `aID` int(10) unsigned NOT NULL,
  `d_value` double NOT NULL,
  `e_value` double NOT NULL,
  `score` double unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `participant_apparatus`
--
DELIMITER $$
CREATE TRIGGER `insert_score_trigger` BEFORE INSERT ON `participant_apparatus`
 FOR EACH ROW SET NEW.`score` = NEW.`e_value` + NEW.`d_value`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_score_trigger` BEFORE UPDATE ON `participant_apparatus`
 FOR EACH ROW SET NEW.score = NEW.d_value + NEW.e_value
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_best_participants`
--
CREATE TABLE IF NOT EXISTS `v_best_participants` (
`gender` varchar(1)
,`team` int(11)
,`id` int(10) unsigned
,`aID` int(10) unsigned
,`score` double unsigned
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `v_team_apparatus`
--
CREATE TABLE IF NOT EXISTS `v_team_apparatus` (
`team` int(11)
,`aID` int(10) unsigned
,`SUM(v.score)` double
);

-- --------------------------------------------------------

--
-- Struktur des Views `v_best_participants`
--
DROP TABLE IF EXISTS `v_best_participants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_best_participants` AS select `p`.`gender` AS `gender`,`p`.`team` AS `team`,`p`.`id` AS `id`,`pa`.`aID` AS `aID`,`pa`.`score` AS `score` from (`participants` `p` join `participant_apparatus` `pa`) where ((`p`.`id` = `pa`.`pID`) and ((select count(0) from (`participants` `p2` join `participant_apparatus` `pa2`) where ((`p2`.`id` = `pa2`.`pID`) and (`p`.`team` = `p2`.`team`) and (`pa`.`aID` = `pa2`.`aID`) and (`p`.`gender` = `p2`.`gender`) and (`pa2`.`score` >= `pa`.`score`))) <= 2));

-- --------------------------------------------------------

--
-- Struktur des Views `v_team_apparatus`
--
DROP TABLE IF EXISTS `v_team_apparatus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_team_apparatus` AS select `v`.`team` AS `team`,`v`.`aID` AS `aID`,sum(`v`.`score`) AS `SUM(v.score)` from `v_best_participants` `v` group by `v`.`team`,`v`.`aID` order by `v`.`aID`,`v`.`team`;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `gymnastic_apparatus`
--
ALTER TABLE `gymnastic_apparatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `participant_apparatus`
--
ALTER TABLE `participant_apparatus`
  ADD PRIMARY KEY (`pID`,`aID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `gymnastic_apparatus`
--
ALTER TABLE `gymnastic_apparatus`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
