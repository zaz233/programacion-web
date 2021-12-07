-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2021 a las 22:01:53
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examen_medico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `cedula` int(8) UNSIGNED NOT NULL,
  `correo` varchar(75) NOT NULL,
  `contraseña` varchar(32) NOT NULL,
  `rango` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `cedula`, `correo`, `contraseña`, `rango`) VALUES
(1, 'Angel', 'Soto', 28197556, 'angelsoto02@hotmail.com', '9450476b384b32d8ad8b758e76c98a69', 'administrador'),
(2, 'Simon', 'Diaz', 28436652, 'ulisesacosta2002@gmail.com', '4d186321c1a7f0f354b297e8914ab240', 'Medico'),
(3, 'Marcelo', 'Mendez', 7979819, 'zaz2332001@gmail.com', '4d186321c1a7f0f354b297e8914ab240', 'Enfermero'),
(4, 'maibel', 'arnaez', 7979818, 'tiuchis03@hotmail.com', '4d186321c1a7f0f354b297e8914ab240', 'Medico'),
(5, 'Diego', 'Arnaez', 7979817, 'diego2002@gmail.com', '4d186321c1a7f0f354b297e8914ab240', 'Medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `id` int(11) NOT NULL,
  `nombre_paciente` varchar(20) NOT NULL,
  `apellido_paciente` varchar(20) NOT NULL,
  `cedula_paciente` int(8) NOT NULL,
  `email_paciente` varchar(75) NOT NULL,
  `examen` varchar(23) NOT NULL,
  `nombre_enfermero` varchar(20) NOT NULL,
  `apellido_enfermero` varchar(20) NOT NULL,
  `cedula_enfermero` int(8) NOT NULL,
  `fecha_atencion_enfermero` datetime NOT NULL,
  `estado` varchar(9) NOT NULL,
  `nombre_medico` varchar(20) DEFAULT NULL,
  `apellido_medico` varchar(20) DEFAULT NULL,
  `cedula_medico` int(8) DEFAULT NULL,
  `fecha_atencion_medico` datetime DEFAULT NULL,
  `diagnostico` varchar(1000) DEFAULT NULL,
  `estado_medico` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`id`, `nombre_paciente`, `apellido_paciente`, `cedula_paciente`, `email_paciente`, `examen`, `nombre_enfermero`, `apellido_enfermero`, `cedula_enfermero`, `fecha_atencion_enfermero`, `estado`, `nombre_medico`, `apellido_medico`, `cedula_medico`, `fecha_atencion_medico`, `diagnostico`, `estado_medico`) VALUES
(2, 'Angel', 'Soto', 28197556, 'angelsoto02@hotmail.com', 'Heces', 'Marcelo', 'Mendez', 7979819, '2021-04-12 23:44:49', 'Realizado', 'Diego', 'Arnaez', 7979817, '2021-12-05 01:03:44', 'sano', 'Enviar'),
(4, 'Simon', 'Diaz', 7979819, 'zaz@gmail.com', 'Hemograma', 'Diego', 'Arnaez', 7979817, '2021-05-12 01:04:34', 'Activo', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
