-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: mariadb:3306
-- Tiempo de generación: 06-11-2022 a las 12:47:17
-- Versión del servidor: 10.6.10-MariaDB
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoServidor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reservations`
--

CREATE TABLE `Reservations` (
  `idResource` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTimeSlot` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `Reservations`
--

INSERT INTO `Reservations` (`idResource`, `idUser`, `idTimeSlot`, `date`, `remarks`) VALUES
(1, 1, 1, '2022-11-16', 'aaaa'),
(1, 1, 2, '2022-11-23', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Resources`
--

CREATE TABLE `Resources` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `Resources`
--

INSERT INTO `Resources` (`id`, `name`, `description`, `location`, `image`) VALUES
(1, 'Impresora Láser', 'Es una impresora HP láser.', 'Aula 8', ''),
(8, 'a', 'a', 'a', ''),
(68, 'x', 'x', 'x', ''),
(69, 'x', 'x', 'x', ''),
(72, 'b', 'b', 'b', ''),
(73, 'c', 'c', 'c', ''),
(74, 'c', 'c', 'c', ''),
(75, 'a', 'a', 'a', ''),
(76, 'a', 'a', 'a', 'Images/guapa.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TimeSlots`
--

CREATE TABLE `TimeSlots` (
  `id` int(11) NOT NULL,
  `dayOfWeek` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `TimeSlots`
--

INSERT INTO `TimeSlots` (`id`, `dayOfWeek`, `startTime`, `endTime`) VALUES
(38, '2022-11-07', '09:00:00', '10:00:00'),
(39, '2022-11-07', '10:00:00', '11:00:00'),
(40, '2022-11-07', '11:00:00', '12:00:00'),
(41, '2022-11-08', '09:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` int(11) NOT NULL,
  `realname` varchar(150) NOT NULL,
  `type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `realname`, `type`) VALUES
(1, 'lcp622', 1111, 'Lucía', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`idResource`,`idUser`,`idTimeSlot`);

--
-- Indices de la tabla `Resources`
--
ALTER TABLE `Resources`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `TimeSlots`
--
ALTER TABLE `TimeSlots`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Resources`
--
ALTER TABLE `Resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `TimeSlots`
--
ALTER TABLE `TimeSlots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
