-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 208.97.163.222
-- Tiempo de generación: 12-01-2021 a las 00:04:37
-- Versión del servidor: 5.7.28-log
-- Versión de PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pdflibrary`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `belongings`
--

CREATE TABLE `belongings` (
  `id` int(4) NOT NULL,
  `bookid` int(4) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `belongings`
--

INSERT INTO `belongings` (`id`, `bookid`, `userid`) VALUES
(77, 130, 1),
(78, 131, 1),
(79, 132, 1),
(82, 137, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id` int(4) NOT NULL,
  `book_name` char(50) NOT NULL,
  `book_url` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id`, `book_name`, `book_url`) VALUES
(130, 'Puppet_Best_Practices', 'https://drive.google.com/file/d/1JuFILRGkE0WLXN3OSqHbNwVMV1vfKXMM/view?usp=sharing'),
(131, 'Prometeus_Up_And_Running', 'https://drive.google.com/file/d/1nQjAn3REMoca9RSVc3MksOVP3mnXQOHC/view?usp=sharing'),
(137, 'aaaaaaa', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$EAFHIw3v1.WwCxFL3vEa0u5hSI5Ncd2s1JKwFkMCn6fyNXpOpuIIq', '2021-01-08 22:56:26'),
(2, 'NevaLOL', '$2y$10$4ED2D1YDDutMaTnxUEjY7eOKGLlGSdRprPy3XpgIdaNgwn/bDAHW2', '2021-01-08 23:37:15'),
(3, 'Bennok', '$2y$10$uInNFBXrUYmmIYziy5c.l.Af09ihY.kksHRSwRnSKyYIsHE0K8tPi', '2021-01-09 00:25:53'),
(4, 'Edgelord', '$2y$10$to6y.FpmhRrR1Ze6BMihe.Wzz7vgdTXyF8Vf4FdJNLdf1/gnmlXa2', '2021-01-09 12:14:19'),
(5, 'Rafoide', '$2y$10$HjgdmaT7.87ENMZjf7kZV.dHSQi6Di41KOil8.vM4npwjB2tXojNa', '2021-01-10 13:08:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `belongings`
--
ALTER TABLE `belongings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `belongings`
--
ALTER TABLE `belongings`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
