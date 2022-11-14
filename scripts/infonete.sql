-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2022 a las 20:18:19
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infonete`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `Id` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdEdicion` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Pagado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`Id`, `IdUsuario`, `IdEdicion`, `Precio`, `Pagado`) VALUES
(1, 1, 5, '999.99', b'1'),
(2, 1, 6, '999.99', b'1'),
(3, 1, 2, '999.99', b'1'),
(4, 1, 8, '7007.97', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contraseña`
--

CREATE TABLE `contraseña` (
  `Id` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `Validado` bit(1) NOT NULL,
  `CodigoValidador` varchar(6) DEFAULT NULL,
  `FechaExpiracionCodigo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contraseña`
--

INSERT INTO `contraseña` (`Id`, `IdUsuario`, `clave`, `FechaVencimiento`, `Validado`, `CodigoValidador`, `FechaExpiracionCodigo`) VALUES
(1, 1, '81dc9bdb52d04dc20036dbd8313ed055', '2029-04-04', b'1', NULL, NULL),
(2, 2, '81dc9bdb52d04dc20036dbd8313ed055', '2029-04-04', b'1', NULL, NULL),
(3, 3, '81dc9bdb52d04dc20036dbd8313ed055', '2029-04-04', b'1', NULL, NULL),
(4, 4, '81dc9bdb52d04dc20036dbd8313ed055', '2029-04-04', b'1', NULL, NULL),
(5, 5, '81dc9bdb52d04dc20036dbd8313ed055', '2029-04-04', b'1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `Id` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`Id`, `Numero`, `IdProducto`, `Fecha`, `precio`) VALUES
(1, 1, 1, '2022-10-01', '4453.49'),
(2, 2, 1, '2022-10-08', '4453.49'),
(3, 3, 1, '2022-10-15', '4591.18'),
(4, 4, 1, '2022-10-22', '11004.93'),
(5, 1, 2, '2022-10-02', '22343.46'),
(6, 2, 2, '2022-10-18', '9379.33'),
(7, 1, 3, '2022-10-10', '20092.91'),
(8, 1, 3, '2022-10-28', '7007.97'),
(9, 1, 4, '2022-10-01', '15382.41'),
(10, 2, 4, '2022-10-08', '12576.12'),
(11, 3, 4, '2022-10-15', '8745.02'),
(12, 4, 4, '2022-10-22', '21222.75'),
(13, 1, 5, '2022-10-23', '10294.50'),
(14, 2, 5, '2022-10-24', '2070.01'),
(15, 3, 5, '2022-10-25', '16103.03'),
(16, 4, 5, '2022-10-26', '17492.13'),
(17, 5, 5, '2022-10-27', '5043.19'),
(18, 6, 5, '2022-10-28', '10894.37'),
(19, 7, 5, '2022-10-29', '1787.03'),
(20, 8, 5, '2022-10-30', '10558.94'),
(21, 30, 5, '2022-12-01', '19633.39'),
(22, 31, 1, '2022-12-01', '4453.49'),
(23, 32, 1, '2022-12-01', '4453.49'),
(24, 33, 1, '2022-12-01', '4591.18'),
(25, 34, 1, '2022-12-01', '11004.93'),
(26, 31, 2, '2022-12-01', '22343.46'),
(27, 32, 2, '2022-12-01', '9379.33'),
(28, 31, 3, '2022-12-01', '20092.91'),
(29, 31, 3, '2022-12-01', '7007.97'),
(30, 31, 4, '2022-12-01', '15382.41'),
(31, 32, 4, '2022-12-01', '12576.12'),
(32, 33, 4, '2022-12-01', '8745.02'),
(33, 34, 4, '2022-12-14', '21222.75'),
(34, 31, 5, '2022-12-14', '10294.50'),
(35, 32, 5, '2022-12-14', '2070.01'),
(36, 33, 5, '2022-12-14', '16103.03'),
(37, 34, 5, '2022-12-14', '17492.13'),
(38, 35, 5, '2022-12-14', '5043.19'),
(39, 36, 5, '2022-12-14', '10894.37'),
(40, 37, 5, '2022-12-14', '1787.03'),
(41, 38, 5, '2022-12-14', '10558.94'),
(42, 39, 5, '2022-12-14', '19633.39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicionseccion`
--

CREATE TABLE `edicionseccion` (
  `Id` int(11) NOT NULL,
  `IdEdicion` int(11) NOT NULL,
  `IdSeccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicionseccion`
--

INSERT INTO `edicionseccion` (`Id`, `IdEdicion`, `IdSeccion`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 4, 2),
(6, 6, 1),
(7, 7, 1),
(8, 9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `IdNoticia` int(11) NOT NULL,
  `IdTipoMultimedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`Id`, `Nombre`, `IdNoticia`, `IdTipoMultimedia`) VALUES
(1, 'bitcoin.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Subtitulo` varchar(150) NOT NULL,
  `Cuerpo` mediumtext NOT NULL,
  `IdEdicionSeccion` int(11) NOT NULL,
  `CoordenadaX` varchar(100) NOT NULL,
  `CoordenadaY` varchar(100) NOT NULL,
  `Link` varchar(100) NULL,  
  `EStado` varchar(100) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`Id`, `Titulo`, `Subtitulo`, `Cuerpo`, `IdEdicionSeccion`, `CoordenadaX`, `CoordenadaY`) VALUES
(1, 'Bitcoin como moneda oficial, ¿una buena medida para estimular la economía nacional?', 'La noticia de que El Salvador reconocía la criptomoneda alegró a los portadores, pero la inestabilidad del precio pone en duda su viabilidad como medi', 'Esta teoría explica por qué bitcoin, sin ningún respaldo, vale mucho más que petro, emitido por el Gobierno venezolano con petróleo como respaldo. La gente la prefiere, simplemente porque la moneda creada por Satoshi Nakamoto tiene más compradores que la ', 8, '-34.608055555556', '-58.370277777778');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `IdTipoProducto` int(11) NOT NULL,
  `Imagen` varchar(100) NOT NULL,
  `Mensualidad` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id`, `Nombre`, `IdTipoProducto`, `Imagen`, `Mensualidad`) VALUES
(1, 'Bien Verde', 2, 'bienVerde.jpg', '300.00'),
(2, 'Billiken', 2, 'billiken.jpg', '300.00'),
(3, 'Campeones', 2, 'campeones.jpg', '300.00'),
(4, 'Caras', 2, 'caras.jpg', '300.00'),
(5, 'Clarin', 1, 'clarin.jpg', '300.00'),
(6, 'Cosmopolitan', 2, 'cosmopolitan.jpg', '300.00'),
(7, 'Cronica', 1, 'cronica.jpg', '300.00'),
(8, 'Lo Gourmet', 2, 'loGourmet.jpg', '300.00'),
(9, 'Ohlala!', 2, 'ohlala.jpg', '300.00'),
(10, 'Pais', 2, 'ohlala.jpg', '300.00'),
(11, 'Rolling Stone', 2, 'rollingStone.jpg', '300.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`Id`, `Nombre`) VALUES
(1, 'Deporte'),
(2, 'Espectáculos'),
(3, 'Arte y cultura'),
(4, 'Economía y política'),
(5, 'Sociedad'),
(6, 'Editorial y opinión'),
(7, 'Infantil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `Id` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `FechaDesde` date NOT NULL,
  `FechaHasta` date NOT NULL,
  `Precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `suscripcion`
--

INSERT INTO `suscripcion` (`Id`, `IdUsuario`, `IdProducto`, `FechaDesde`, `FechaHasta`, `Precio`) VALUES
(16, 1, 2, '2022-11-07', '2023-01-07', '600.00'),
(20, 1, 4, '2020-11-17', '2026-11-09', '14400.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomultimedia`
--

CREATE TABLE `tipomultimedia` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipomultimedia`
--

INSERT INTO `tipomultimedia` (`Id`, `Nombre`) VALUES
(1, 'Audio'),
(2, 'Imagen'),
(3, 'Video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE `tipoproducto` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`Id`, `Nombre`) VALUES
(1, 'Diario'),
(2, 'Revista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`Id`, `Nombre`) VALUES
(1, 'Lector'),
(2, 'Contenidista'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `IdTipoUsuario` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `CoordenadasX` varchar(50) NOT NULL,
  `CoordenadasY` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre`, `IdTipoUsuario`, `Email`, `CoordenadasX`, `CoordenadasY`) VALUES
(1, 'Fer', 3, 'fernando.icardi@gmail.com', '-34.663050', '-58.593712'),
(2, 'Sofi', 3, 'sofia@gmail.com', '-34.663050', '-58.593712'),
(3, 'Eve', 3, 'eve@gmail.com', '-34.663050', '-58.593712'),
(4, 'Tomas', 3, 'tomy@gmail.com', '-34.663050', '-58.593712'),
(5, 'Juan', 3, 'juan@gmail.com', '-34.663050', '-58.593712');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `contraseña`
--
ALTER TABLE `contraseña`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `edicionseccion`
--
ALTER TABLE `edicionseccion`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `IdEdicion` (`IdEdicion`,`IdSeccion`),
  ADD KEY `IdSeccion` (`IdSeccion`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdNoticia` (`IdNoticia`),
  ADD KEY `IdTipoMultimedia` (`IdTipoMultimedia`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdEdicionSeccion` (`IdEdicionSeccion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdTipoProducto` (`IdTipoProducto`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `tipomultimedia`
--
ALTER TABLE `tipomultimedia`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdTipoUsuario` (`IdTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
  ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `seccion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contraseña`
--
ALTER TABLE `contraseña`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `edicion`
--
ALTER TABLE `edicion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `edicionseccion`
--
ALTER TABLE `edicionseccion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contraseña`
--
ALTER TABLE `contraseña`
  ADD CONSTRAINT `contraseña_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`Id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD CONSTRAINT `edicion_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`Id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `edicionseccion`
--
ALTER TABLE `edicionseccion`
  ADD CONSTRAINT `edicionseccion_ibfk_1` FOREIGN KEY (`IdEdicion`) REFERENCES `edicion` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `edicionseccion_ibfk_2` FOREIGN KEY (`IdSeccion`) REFERENCES `seccion` (`Id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `multimedia_ibfk_1` FOREIGN KEY (`IdNoticia`) REFERENCES `noticia` (`Id`),
  ADD CONSTRAINT `multimedia_ibfk_2` FOREIGN KEY (`IdTipoMultimedia`) REFERENCES `tipomultimedia` (`Id`);

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`IdEdicionSeccion`) REFERENCES `edicionseccion` (`Id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdTipoProducto`) REFERENCES `tipoproducto` (`Id`);

--
-- Filtros para la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `suscripcion_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `suscripcion_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`Id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`Id`);
COMMIT;
