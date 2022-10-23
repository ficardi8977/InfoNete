-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2022 a las 21:37:27
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
  `Precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 1, '1234', '2029-04-04', b'1', NULL, NULL),
(2, 2, '1234', '2029-04-04', b'1', NULL, NULL),
(3, 3, '1234', '2029-04-04', b'1', NULL, NULL),
(4, 4, '1234', '2029-04-04', b'1', NULL, NULL),
(5, 5, '1234', '2029-04-04', b'1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `Id` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`Id`, `Numero`, `IdProducto`, `Fecha`) VALUES
(1, 1, 1, '2022-10-01'),
(2, 2, 1, '2022-10-08'),
(3, 3, 1, '2022-10-15'),
(4, 4, 1, '2022-10-22'),
(5, 1, 2, '2022-10-02'),
(6, 2, 2, '2022-10-18'),
(7, 1, 3, '2022-10-10'),
(8, 1, 3, '2022-10-28'),
(9, 1, 4, '2022-10-01'),
(10, 2, 4, '2022-10-08'),
(11, 3, 4, '2022-10-15'),
(12, 4, 4, '2022-10-22'),
(13, 1, 5, '2022-10-23'),
(14, 2, 5, '2022-10-24'),
(15, 3, 5, '2022-10-25'),
(16, 4, 5, '2022-10-26'),
(17, 5, 5, '2022-10-27'),
(18, 6, 5, '2022-10-28'),
(19, 7, 5, '2022-10-29'),
(20, 8, 5, '2022-10-30'),
(21, 9, 5, '2022-10-31');

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
  `CoordenadaY` varchar(100) NOT NULL
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
  `Imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id`, `Nombre`, `IdTipoProducto`, `Imagen`) VALUES
(1, 'Bien Verde', 2, 'bienVerde.jpg'),
(2, 'Billiken', 2, 'billiken.jpg'),
(3, 'Campeones', 2, 'campeones.jpg'),
(4, 'Caras', 2, 'caras.jpg'),
(5, 'Clarin', 1, 'clarin.jpg'),
(6, 'Cosmopolitan', 2, 'cosmopolitan.jpg'),
(7, 'Cronica', 1, 'cronica.jpg'),
(8, 'Lo Gourmet', 2, 'loGourmet.jpg'),
(9, 'Ohlala!', 2, 'ohlala.jpg'),
(10, 'Pais', 2, 'ohlala.jpg'),
(11, 'Rolling Stone', 2, 'rollingStone.jpg');

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
  `Precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Fer', 1, 'fernando.icardi@gmail.com', '-34.663050', '-58.593712'),
(2, 'Fer', 1, 'sofia@gmail.com', '-34.663050', '-58.593712'),
(3, 'Eve', 1, 'eve@gmail.com', '-34.663050', '-58.593712'),
(4, 'Tomas', 1, 'tomy@gmail.com', '-34.663050', '-58.593712'),
(5, 'Juan', 1, 'juan@gmail.com', '-34.663050', '-58.593712');

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

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contraseña`
--
ALTER TABLE `contraseña`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipomultimedia`
--
ALTER TABLE `tipomultimedia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contraseña`
--
ALTER TABLE `contraseña`
  ADD CONSTRAINT `contraseña_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`Id`);

--
-- Filtros para la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD CONSTRAINT `edicion_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`Id`);

--
-- Filtros para la tabla `edicionseccion`
--
ALTER TABLE `edicionseccion`
  ADD CONSTRAINT `edicionseccion_ibfk_1` FOREIGN KEY (`IdEdicion`) REFERENCES `edicion` (`Id`),
  ADD CONSTRAINT `edicionseccion_ibfk_2` FOREIGN KEY (`IdSeccion`) REFERENCES `seccion` (`Id`);

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
  ADD CONSTRAINT `suscripcion_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`Id`),
  ADD CONSTRAINT `suscripcion_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`Id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
