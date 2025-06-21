-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2025 a las 16:12:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pingpong_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` text NOT NULL,
  `avatar` varchar(255) DEFAULT '/pingpong_game/public/images/default_avatar.png',
  `victorias` int(11) DEFAULT 0,
  `derrotas` int(11) DEFAULT 0,
  `partidas_jugadas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `nombre_usuario`, `contrasena`, `avatar`, `victorias`, `derrotas`, `partidas_jugadas`) VALUES
(1, 'Juan', 'juan123', '$2y$10$9j1ebw8oL1KePdzyNY7aJeqLj.bLnfu3j0fxQS7QVEHlCZbte1wNm', '/pingpong_game/public/avatars/1.jpg', 0, 0, 0),
(2, 'Maria', 'maria456', '$2y$10$BnV2eBtipMRnoDOimV/rM.e8an/y8ENy./JtK1VYYpFRlYzZnYQL.', '/pingpong_game/public/images/default_avatar.png', 0, 0, 0),
(4, 'Adrian', 'adrian2304', '$2y$10$4JQNSSkpwAbpuok0jeU3jed2EIf1REzkICAIWJQeEt9.CUWnLpHfi', '/pingpong_game/public/images/default_avatar.png', 0, 0, 0),
(5, 'Jesus', 'jesus087', '$2y$10$xEepf0oGLktoZEpaF840aexxHl8FLsi4BSPTlhpaQIOw2J8Ppbdd.', '/pingpong_game/public/images/default_avatar.png', 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
