-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Mrz 2016 um 18:42
-- Server-Version: 5.6.26
-- PHP-Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db617247485`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kundennavigation`
--

CREATE TABLE IF NOT EXISTS `kundennavigation` (
  `nav_id` bigint(20) unsigned NOT NULL,
  `symbol` varchar(30) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kundennavigation`
--

INSERT INTO `kundennavigation` (`nav_id`, `symbol`, `name`, `parent_id`) VALUES
(1, 'fa fa-male', 'Kunden', 0),
(2, 'fa fa-html5', 'HTML-Standard', 0),
(3, '', 'TYPO3-Standard', 0),
(4, 'fa fa-tasks', 'Aufgaben', 0),
(5, 'fa fa-money', 'Rechnungs-Export', 0),
(6, 'fa fa-puzzle-piece', 'Modulbibliothek', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kundennavigation`
--
ALTER TABLE `kundennavigation`
  ADD UNIQUE KEY `nav_id` (`nav_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kundennavigation`
--
ALTER TABLE `kundennavigation`
  MODIFY `nav_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
