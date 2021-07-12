-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2021 a las 12:10:33
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `weather`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wea_datareports`
--

CREATE TABLE `wea_datareports` (
  `id` int(10) UNSIGNED NOT NULL,
  `rawdata` text NOT NULL COMMENT 'Datos en bruto',
  `datetimerep` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del reporte'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Datos de los reporte de clima';

--
-- Volcado de datos para la tabla `wea_datareports`
--

INSERT INTO `wea_datareports` (`id`, `rawdata`, `datetimerep`) VALUES
(1, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-09 23:36:57'),
(2, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-09 23:37:32'),
(3, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-09 23:37:35'),
(4, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-09 23:37:51'),
(5, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-09 23:37:53'),
(6, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-09 23:38:25'),
(7, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":73}]', '2021-07-09 00:08:22'),
(8, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":73}]', '2021-07-10 00:09:19'),
(9, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":73}]', '2021-07-10 00:09:24'),
(10, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":73}]', '2021-07-10 00:09:33'),
(11, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":73}]', '2021-07-10 00:09:37'),
(12, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-10 00:11:49'),
(13, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-10 00:11:54'),
(14, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-10 00:13:21'),
(15, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":80},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":76}]', '2021-07-11 00:13:27'),
(16, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-11 00:23:22'),
(17, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-11 00:23:29'),
(18, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-11 00:23:38'),
(19, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-11 00:23:43'),
(20, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-11 00:33:28'),
(21, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-11 00:33:41'),
(22, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-12 00:37:19'),
(23, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-12 00:37:27'),
(24, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-12 00:37:33'),
(25, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-12 00:37:44'),
(26, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-12 00:37:56'),
(27, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-12 00:38:13'),
(28, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":24,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":28,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":25,\"humed\":75}]', '2021-07-12 00:38:21'),
(29, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":22,\"humed\":92},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":27,\"humed\":81},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":24,\"humed\":75}]', '2021-07-12 03:23:01'),
(30, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":22,\"humed\":93},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":27,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":24,\"humed\":72}]', '2021-07-12 04:05:23'),
(31, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":22,\"humed\":93},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":27,\"humed\":79},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":24,\"humed\":76}]', '2021-07-12 04:11:05'),
(32, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":22,\"humed\":93},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":27,\"humed\":77},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":24,\"humed\":76}]', '2021-07-12 04:13:38'),
(33, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":22,\"humed\":93},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":27,\"humed\":77},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":24,\"humed\":76}]', '2021-07-12 04:15:00'),
(34, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":22,\"humed\":93},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":27,\"humed\":77},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":24,\"humed\":76}]', '2021-07-12 04:16:01'),
(35, '[{\"city\":\"New York\",\"lat\":40.7143,\"lon\":-74.006,\"tempe\":22,\"humed\":93},{\"city\":\"Miami\",\"lat\":25.7743,\"lon\":-80.1937,\"tempe\":27,\"humed\":77},{\"city\":\"Orlando\",\"lat\":28.5383,\"lon\":-81.3792,\"tempe\":24,\"humed\":76}]', '2021-07-12 04:17:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `wea_datareports`
--
ALTER TABLE `wea_datareports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `wea_datareports`
--
ALTER TABLE `wea_datareports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
