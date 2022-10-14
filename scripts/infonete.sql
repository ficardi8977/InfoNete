-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2022 a las 03:05:11
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
  `Password` varchar(50) NOT NULL,
  `IdTipoUsuario` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `ValidacionMail` bit(1) NOT NULL,
  `UbicacionGeografica` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre`, `Password`, `IdTipoUsuario`, `Email`, `ValidacionMail`, `UbicacionGeografica`) VALUES
(1, 'Fer', '1234', 1, 'bmordey0@blogspot.com', b'1', 'Zouma'),
(2, 'Eve', '1234', 1, 'dbavidge1@ifeng.com', b'0', 'Maintang'),
(3, 'Sofi', '1234', 2, 'vpollak2@thetimes.co.uk', b'0', 'P’asanauri'),
(4, 'Tomy', '1234', 1, 'ldunbavin3@nasa.gov', b'0', 'Montpellier'),
(5, 'Juan', '1234', 1, 'aglavias4@reference.com', b'0', 'Sucre'),
(6, 'tgrzeszczyk5', '9KjoKu3S4qXM', 2, 'tpiatek5@purevolume.com', b'1', 'Paris 09'),
(7, 'hdevons6', '1QfCzABMq7', 1, 'rmacklam6@istockphoto.com', b'1', 'Bagrāmī'),
(8, 'mkornas7', 'FtA5CSjDnzg9', 1, 'emirando7@theglobeandmail.com', b'1', 'Rantaupanjang'),
(9, 'egurrado8', 'sxnRDt', 2, 'tlillistone8@hatena.ne.jp', b'0', 'San Juan'),
(10, 'csmithin9', '3qD3uTQX5', 2, 'smerrifield9@oaic.gov.au', b'0', 'Néa Péramos'),
(11, 'nbalama', 'WWg1FgHXg', 1, 'dkeiltya@microsoft.com', b'1', 'Caraballeda'),
(12, 'sdyballb', 'EBhD2oqZcfYB', 1, 'jnormingtonb@noaa.gov', b'0', 'Jiuchenggong'),
(13, 'rabernethyc', 'YuTmPscTiDKz', 2, 'pimlenc@boston.com', b'0', 'Berkovitsa'),
(14, 'bkinnockd', 'UQ7Rs6tgte9', 2, 'chessled@nhs.uk', b'0', 'Psary'),
(15, 'ngoodwine', 'efKNv8gODT', 1, 'rweale@reverbnation.com', b'1', 'Wuyang'),
(16, 'ccatchesidef', 'wvk6WWBm', 2, 'msorrellf@vkontakte.ru', b'1', 'Pembroke'),
(17, 'broyleg', 'vsArfo', 3, 'rgrewesg@sciencedirect.com', b'1', 'Biryulëvo'),
(18, 'dpucketth', 'e7iisHdekNbK', 1, 'gnorthfieldh@si.edu', b'1', 'Telnice'),
(19, 'jslacki', 'yBOb4K0ZRQP', 1, 'sselburni@wiley.com', b'0', 'Magangué'),
(20, 'sheightj', 'Sm5fJ5Px', 2, 'bgrouenj@bigcartel.com', b'1', 'Pinhão'),
(21, 'kwyndhamk', 'q16LLCdUsjL', 3, 'aalexandrescuk@cpanel.net', b'1', 'Katunayaka'),
(22, 'bkeppell', 'xcF5T2JQtr', 3, 'cprinnettl@liveinternet.ru', b'0', 'Krapina'),
(23, 'edyballm', 'UTHKwm6n', 3, 'mlodderm@spotify.com', b'1', 'Purwokerto'),
(24, 'bcromarn', 'fx7Dw3yQ', 1, 'fauburyn@samsung.com', b'1', 'Dalmacio Vélez Sársfield'),
(25, 'jrichemondo', 'y5TqfNXovM', 1, 'pthorntono@virginia.edu', b'1', 'Taguisa'),
(26, 'slindbladp', 'gT9Y2Q13C', 3, 'ecairnsp@yelp.com', b'0', 'São Gonçalo do Amarante'),
(27, 'kbatisteq', 'wPYFQF5', 1, 'dhuorticq@home.pl', b'1', 'Zykovo'),
(28, 'acrudgingtonr', 'OFIDJ9', 1, 'cguarnierr@microsoft.com', b'0', 'Lanlacuni Bajo'),
(29, 'cdavidovitzs', '3sJ5Ofq3', 1, 'bpetheridges@elegantthemes.com', b'0', 'Stockholm'),
(30, 'rscholcroftt', '8tFusIEl', 1, 'lzellmert@bluehost.com', b'0', 'Zhanbei'),
(31, 'dherleyu', 'hsxPeiKz3A4', 1, 'jbrimfieldu@miitbeian.gov.cn', b'0', 'Al ‘Anān'),
(32, 'nwallwoodv', 'j8z4BqlAX', 3, 'afraulov@sakura.ne.jp', b'0', 'Atamanovka'),
(33, 'kkellandw', 'TukdcUs', 1, 'wvernw@spotify.com', b'1', 'Ebene'),
(34, 'jwhebellx', 'Kf01buBuX2', 3, 'edunkinsonx@cornell.edu', b'1', 'Salaverry'),
(35, 'pdeyesy', '9UYrFI7waG', 3, 'pjanksy@kickstarter.com', b'0', 'El Pino'),
(36, 'klazarusz', '6PBTcEYV', 1, 'jbentzenz@yahoo.co.jp', b'1', 'Trpinja'),
(37, 'fdawnay10', 'aXddLvbGP5gQ', 1, 'oboundy10@usda.gov', b'1', 'Xiangyang'),
(38, 'laveline11', 'WJHeS9uDDeE', 3, 'lzincke11@squidoo.com', b'0', 'Batal'),
(39, 'rlawee12', 'cHWih3T', 3, 'stomasian12@bloglines.com', b'0', 'Holboo'),
(40, 'dlinden13', 'eAJ0N9nLgDA', 1, 'blight13@123-reg.co.uk', b'1', 'Yakymivka'),
(41, 'ddelos14', 'hXMwc2KRW', 2, 'bspohrmann14@google.es', b'0', 'Alingsås'),
(42, 'wtorregiani15', 'hrbkljrjpc', 3, 'rjacop15@biblegateway.com', b'0', 'Zekou'),
(43, 'mhansom16', 'A6A08YxC', 2, 'smeasures16@berkeley.edu', b'1', 'Paombong'),
(44, 'tcyster17', 'Q4pDcoNCmGe', 3, 'krycraft17@aboutads.info', b'0', 'Sykiés'),
(45, 'kchampionnet18', 'OMkIDGWHosCL', 1, 'tmoreinu18@berkeley.edu', b'1', 'Vysokovsk'),
(46, 'bfarrent19', 'tL5FpQBagV', 1, 'koxbury19@sphinn.com', b'1', 'Suizhou'),
(47, 'cfullegar1a', 'HN8UoOUfVVV9', 1, 'scominello1a@goo.gl', b'0', 'Wonokerso'),
(48, 'gpenchen1b', 'OlgF4loo', 1, 'afrowen1b@paypal.com', b'1', 'Popayán'),
(49, 'rbernardini1c', 'VBHhCTx', 1, 'kdymidowski1c@fotki.com', b'0', 'Mercier'),
(50, 'spetcher1d', 'ES9TlImO76S', 3, 'bdavidsohn1d@reuters.com', b'0', 'Sandaoba');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
