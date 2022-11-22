-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2022 a las 03:29:38
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
  `Pagado` bit(1) NOT NULL,
  `FechaCompra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`Id`, `IdUsuario`, `IdEdicion`, `Precio`, `Pagado`, `FechaCompra`) VALUES
(15, 6, 47, '100.00', b'1', '2022-11-21'),
(16, 8, 47, '100.00', b'1', '2022-11-21'),
(17, 7, 47, '100.00', b'1', '2022-11-22'),
(18, 7, 55, '100.00', b'1', '2022-11-22');

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
(14, 6, '81dc9bdb52d04dc20036dbd8313ed055', '2023-11-21', b'1', NULL, NULL),
(15, 7, '81dc9bdb52d04dc20036dbd8313ed055', '2023-11-21', b'1', NULL, NULL),
(16, 8, '81dc9bdb52d04dc20036dbd8313ed055', '2023-11-21', b'1', NULL, NULL),
(17, 9, '81dc9bdb52d04dc20036dbd8313ed055', '2023-11-21', b'1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `Id` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`Id`, `Numero`, `IdProducto`, `Fecha`, `Precio`) VALUES
(47, 1, 1, '2022-11-01', '100.00'),
(48, 1, 3, '2022-11-21', '250.00'),
(49, 2, 3, '2022-11-24', '240.00'),
(50, 1, 4, '2022-11-15', '250.00'),
(51, 2, 1, '2022-12-01', '400.00'),
(52, 1, 7, '2022-11-17', '100.00'),
(53, 2, 7, '2022-11-21', '350.00'),
(54, 1, 8, '2022-11-02', '70.00'),
(55, 2, 8, '2022-11-22', '100.00'),
(57, 2, 4, '2022-11-21', '223.00'),
(59, 3, 4, '2022-12-09', '400.00');

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
(24, 47, 12),
(25, 48, 10),
(27, 48, 15),
(28, 49, 10),
(29, 50, 16),
(30, 51, 12),
(31, 52, 11),
(32, 52, 13),
(33, 53, 10),
(34, 53, 11),
(35, 54, 17),
(36, 55, 17),
(37, 57, 16),
(38, 59, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadonoticia`
--

CREATE TABLE `estadonoticia` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadonoticia`
--

INSERT INTO `estadonoticia` (`Id`, `Nombre`) VALUES
(1, 'Borrador'),
(2, 'A publicar'),
(3, 'Publicada'),
(4, 'Baneada');

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
(8, 'Banner-testimonio.jpg', 6, 2),
(9, '09aa4393-9c61-40c8-978a-cb979abdc82f.jpg', 7, 2),
(10, 'Avión-aeroaplicador (1).jpg', 8, 2),
(11, 'comunicado-casafe-768x398.jpg', 8, 2),
(12, 'max-verstappen-red-bull-racing-1.jpg', 9, 2),
(13, 'cronos.jpg', 10, 2),
(14, '60205-1-400x267.jpg', 11, 2),
(15, '221121-F1-Hamilton-Jeddah-21-400x237.jpeg', 12, 2),
(16, '221121-F1-Hamilton-Russell-400x235.jpeg', 12, 2),
(17, 'tomas-holder-1457200.jpg', 13, 2),
(18, 'susana-gimenez-revelo-por-que-rechazo-dos-veces-conducir-quien-es-la-mascara-1423723.jpg', 14, 2),
(19, 'images.jpg', 15, 2),
(20, '1119-agroecología.jpg', 16, 2),
(21, '1119-agroecología1.jpg', 16, 2),
(22, '2021070319062492804.jpg', 17, 2),
(23, 'india-niños.jpg', 17, 2),
(24, 'whatsapp_image_2022-11-21_at_12_30_49_crop1669053571756.jpeg_674070907.jpeg', 18, 2),
(25, '5a0.jpg', 19, 2),
(26, 'ftx.r_d.815-492.jpeg', 20, 2),
(27, 'recetas-cocina-internacional.jpg', 21, 2),
(28, '1366_2000.jpg', 22, 2),
(29, 'qatar-2022-antonela-roccuzzo-y-sofia-balbi-la-primera-foto-oficial-1457331.jpg', 23, 2),
(30, 'chapu.jpg', 24, 2);

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
  `Link` varchar(100) DEFAULT NULL,
  `IdEstadoNoticia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`Id`, `Titulo`, `Subtitulo`, `Cuerpo`, `IdEdicionSeccion`, `CoordenadaX`, `CoordenadaY`, `Link`, `IdEstadoNoticia`) VALUES
(6, '¿Los árboles hablan bajo tierra? La fascinante teoría de la “red de los bosques” enfrenta a los cien', 'La llamada “wood wide web” sostiene que existe una red de filamentos fúngicos que conecta a los árboles y transporta nutrientes e información a través', 'NUEVA YORK.— Justine Karst, micóloga en la Universidad de Alberta, temió que las cosas habían ido demasiado lejos cuando su hijo de octavo grado llegó a casa y le dijo que había aprendido que los árboles podían hablar entre sí a través de redes subterráneas.\r\n\r\nSu colega, Jason Hoeksema de la Universidad de Misisipi, tuvo una sensación similar cuando vio un episodio de Ted Lasso en el que un entrenador de fútbol le decía a otro que los árboles del bosque cooperan en vez de competir por los recursos.\r\n\r\n\r\nPocos descubrimientos científicos recientes han capturado la imaginación del público como la llamada wood wide web, una red de filamentos fúngicos que conecta a los árboles y se cree que transporta nutrientes e información a través del suelo para ayudar al desarrollo de los bosques. La idea surgió a finales de los años 90 a partir de estudios que demostraron que los azúcares y nutrientes podían fluir bajo la tierra entre los árboles. En unos cuantos bosques, algunos investigadores han rastreado hongos de la raíz de un árbol a la de otros, lo que sugiere que algunos hilos miceliales podrían funcionar como conductos entre los árboles.\r\n\r\nEstos hallazgos han puesto en duda la perspectiva convencional de que los bosques son solo una población de árboles: de hecho, los árboles y los hongos desempeñan un papel de la misma importancia en la esfera ecológica, según dicen los científicos. Sin árboles y hongos no existirían los bosques tal y como los conocemos.\r\n\r\nTanto científicos como personas de otros campos han llegado a conclusiones grandiosas y extensas de esta investigación. Consideran que las redes compartidas de hongos están presentes en bosques de todo el mundo, que ayudan a los árboles a comunicarse y, como dijo el entrenador Beard en Ted Lasso, convierten a los bosques en espacios de cooperación, en esencia, donde los árboles y los hongos unen fuerzas para conseguir un propósito común: un contraste drástico con la escena darwiniana usual de competencia entre especies. El concepto se ha difundido en varias noticias en los medios, programas de televisión y libros de los más vendidos, incluido un ganador del Premio Pulitzer. Incluso aparece en Avatar, la película más taquillera de todos los tiempos.\r\n\r\n\r\nAdemás, es posible que la teoría comience a influir en lo que sucede en los bosques reales. Por ejemplo, algunos científicos han propuesto gestionar los bosques específicamente para proteger las redes de hongos.', 24, '-35.012797584796125', '-59.53042795448036', NULL, 3),
(7, 'La UTT quiere tierras del INTA y estallaron las críticas: “Es institucionalizar el trabajo esclavo”', 'La organización agropecuaria viene gestionando hectáreas del Inta Castelar para aumentar sus colonias de pequeños productores. En tanto, el precandida', 'Luego de que trascendiera el pedido del municipio de Hurlingham, provincia de Buenos Aires, a las autoridades nacionales para que cedan 100 hectáreas de campos del Inta Castelar para la construcción de un parque industrial, una organización se sumó a los pedidos de expropiación: la Unión de Trabajadores de la Tierra (UTT), que buscaampliar su proyecto de colonias de pequeños productores.\r\n\r\nLa propuesta no fue bien vista por el productor y precandidato a diputado nacional por CABA, Huberto Bourlon (Partido Renovador Federal), quien volvió a hacer fuertes declaraciones en su cuenta de Twitter.\r\n\r\n\r\nMÁS INFORMACIÓN\r\nEn el corazón triguero de Buenos Aires, la sequía es la más intensa y prolongada en 22 años\r\nSegún datos del INTA Balcarce, las precipitaciones ocurridas desde mayo son las más bajas en una serie que comienza en el año 2000. Para los próximos días, se espera un frente de lluvias que aliviaría la situación de los trigales de la zona.\r\n\r\nEn Río Negro, los ganaderos suman remolacha para ganar kilos en el lote\r\nDe acuerdo a un trabajo del INTA, el cultivo en su variante forrajera aporta hasta 20 toneladas de materia seca por hectárea y permite una ganancia diaria de peso de 1 kilo.\r\n\r\nEn esta oportunidad aseguró que la UTT busca “institucionalizar el trabajo esclavo“.\r\n\r\n\r\nPor su parte, la UTT viene gestionando el traspaso de entre 50 a 60 hectáreas de campos del Inta Castelar para la creación de una nueva colonia agroecológica de pequeños productores.\r\n\r\nLa organización ya cuenta con varias colonias: en Jáuregui, cerca de Luján; en Mercedes, Castelli, Máximo Paz y San Vicente, en Buenos Aires; Puerto Piray, Misiones; Gualeguaychú, Entre Ríos.\r\n\r\nAsimismo, sus dirigentes expresaron que la propuesta se da luego de ver que el organismo de investigación agropecuaria tiene hectáreas en desuso.\r\n\r\n\r\nInta Castelar \r\nEl predio de Castelar es una de las sedes que alberga varios de los principales institutos de investigación del Inta y dispone de un total de 600 hectáreas en una zona clave de la región metropolitana.\r\n\r\nDe concretarse las dos iniciativas, significaría una pérdida de 150 hectáreas, es decir, el 25% del total disponible.\r\n\r\n\r\nTambién te puede interesar: Fernández le pide al Congreso apurar la ley agroindustrial para que haya “menos planes sociales”', 24, '-34.65544048135212', '-58.59452044623376', 'https://www.infocampo.com.ar/la-utt-quiere-tierras-del-inta-y-estallaron-las-criticas-es-institucion', 3),
(8, 'Críticas del agro a la campaña #BastaDeVenenos', 'Casafe emitió un comunicado criticando la postura del video y aseguró que \"la producción agropecuaria no es ficción\".', 'En el video de la campaña #BastaDeVenenos se puede ver a reconocidos actores y figuras públicas como Leonardo Sbaraglia, Laura Azcurra y Francis Mallmann entre otros, afirmando que los agroquímicos son “venenos que llegan a nuestro cuerpo a través del aire, del suelo y el agua”.\r\n\r\nPero la campaña #BastaDeVenenos rápidamente tuvo su contracampaña denominada #BastaDeMiedos que fue impulsada por la Cámara de Sanidad Agropecuaria y Fertilizantes (Casafe), quien emitió un comunicado en respuesta y pidió “basta de estigmatizaciones, de grietas, de argumentos sin ciencia y basta de infundir miedos“.\r\n\r\n\r\nMÁS INFORMACIÓN\r\nEficiencia en el barbecho: claves para el correcto uso de preemergentes en tiempos secos\r\nLos herbicidas preemergentes son una herramienta fundamental para el éxito del control de malezas. Pero la solubilidad y residualidad son hoy, ante la falta de agua, factores muy importantes a tener en cuenta.\r\n\r\nEstablecen nuevas regulaciones para el transporte de envases vacíos de agroquímicos\r\nEl Ministerio de Ambiente de la Nación dispuso que los bidones tipo “B”, aquellos que no se pueden recuperar o reciclar, deberán trasladarse con una carta de porte.\r\n\r\nCasafe afirmó que la producción agropecuaria no es ficción, y que quienes realizan todas esas labores “son personas que se preocupan por lo que comemos, por el ambiente y por la salud“.\r\n\r\n \r\n\r\n\r\nLa Cámara además explicó que los sistemas de producción trabajan con principios agroecológicos y pueden convivir, y pidió dejar de sembrar miedo y comenzar a sembrar responsabilidad.', 24, '-34.57920242998016', '-61.40024011521072', NULL, 3),
(9, 'Verstappen: No habría sido justo retener a Leclerc para ayudar a Pérez', 'Max Verstappen se alegró de no haber recibido un pedido para retener a Charles Leclerc en favor de Sergio Pérez, ya que cree que no hubiera sido \"la f', 'El campeón del mundo de F1 2022 consiguió su 15° victoria de la temporada en el Gran Premio de Abu Dhabi, mientras que Charles Leclerc se impuso a Sergio Pérez en la segunda posición y, con ello, en el segundo puesto del campeonato de pilotos.\r\n\r\nCon Pérez cazando a Leclerc en las últimas vueltas, Verstappen dijo que no recibió ninguna una orden de Red Bull para ayudar a su compañero de equipo, lo que podría haber sido una opción, ya que el piloto neerlandés podría haber sido capaz de levantar su ritmo para contener a Leclerc y permitir el alcance de Pérez.\r\n\r\nLuego de la polémica en torno a las órdenes de equipo en Red Bull en el GP de Brasil, cuando Verstappen ignoró un pedido para dejar que Pérez lo adelantara en la última vuelta para ganar una posición, el bicampeón del mundo de F1 consideró que otro pedido de órdenes de equipo habría empañado el final de temporada.\r\n\r\nVerstappen admitió que tanto él como Pérez podrían haber presionado más durante la fase media de la carrera para ampliar la brecha sobre Leclerc, pero Red Bull estaba preocupado por la vida de los neumáticos en el transcurso del stint.', 25, '23.28243250568237', '52.4457104868835', NULL, 3),
(10, 'Fiat Cronos: el auto más vendido del país se actualizó y le dio de baja a uno de sus motores', 'El Fiat Cronos, el modelo más vendido de la Argentina por lejos, acaba de presentar la actualización de su diseño y también de su gama.', 'Ser el modelo más exitoso del mercado obliga a que la marca italiana lo mantenga siempre vigente, es por eso que el nuevo Cronos se renovó a tan solo un año de su último restyling, cuando actualizó la imagen de la variante S-Design e introdujo la inédita versión Attractive como entrada de gama.\r\n\r\nAdemás de su nuevo look, la noticia destacada es que fue eliminado el motor 1.8 litros de 130 caballos de potencia, quedando como única opción disponible el propulsor Firefly 1.3 litros que desarrolla 99 caballos.\r\n\r\nEsta configuración estará acompañada por ahora De esta manera, la gama quedó conformada por cinco versiones, con precios que parten desde los $ 2.928.900.', 27, '-34.59252629157189', '-58.38678163974018', 'https://www.clarin.com/autos/fiat-cronos-auto-vendido-pais-actualizo-dio-baja-motores_0_Zw3WBNJ6e7.h', 3),
(11, 'El piloto de TC que quiere dar la sorpresa sobre Urcera y Werner', 'Esteban Gini se arrimó en la lucha por el título de Turismo Carretera y lanza una advertencia por si los de arriba se equivocan.', 'La desafiante condición que tuvieron los pilotos de la Copa de Oro de Turismo Carretera en Toay, La Pampa, desacomodó algunas piezas del torneo. La tanda clasificatoria con disparidad en cuanto a la humedad del suelo hizo penar a este grupo, que en su mayoría debió recuperar posiciones en la Serie y Final. Tras ello, las ecuaciones han variado y más de una sorpresa puede aparecer en la última fecha de TC, a disputarse en San Juan Villicum el 11 de diciembre.\r\n\r\n«Tengo un gran equipo y un gran auto, voy confiado a pelear por la victoria en San Juan»\r\n\r\nEntre los que más han crecido en la lista de candidatos se encuentra Esteban Gini (Torino). Con un fortalecido andar en Toay, haciendo podio a milésimas del dúo que peleó la victoria en el último hálito de la carrera, se colocó a 37 puntos de la cima cuando el puntaje especial entrega 70,5 al trabajo ideal.\r\n\r\n\r\n\r\nLa base de su confianza es el rendimiento de su vehículo, con el que cree poder conseguir la necesaria victoria que le habilite a batallar por el campeonato: «Recortamos puntos, nos falta la victoria pero ¿porqué no ilusionarse si falta una carrera? Estamos para pelear«.\r\n\r\nSi bien dependerá del andar de quienes le preceden, su compañero de equipo en el Maquin Parts Racing José Manuel Urcera (Torino) y el bicampeón Mariano Werner (Ford), nada garantiza un resultado a nadie. Ya dio su punto de vista al respecto Agustín Canapino (Chevrolet), que por la rotura del motor quedó bastante más lejos de la batalla en un año en el que se perfilaba como gran candidato, quedando a 44,5 unidades de Urcera.', 28, '-33.65414436327887', '-59.56338693885536', NULL, 3),
(12, 'Inédito: Hamilton cerró por primera vez una temporada sin ganar', 'Una año aciago en cuanto a victorias cerró en 2022 el heptacampeón de Fórmula 1, quebrando una estadística que lo mostró durante los 15 certámenes ant', 'Desde su debut en 2007, Lewis Hamilton siempre ha conseguido un triunfo en el campeonato mundial de Fórmula 1, seguidilla que se interrumpió en 2022 ante la nula cosecha de victorias con el equipo Mercedes que sí festejó en Brasil con el “1-2” que encabezó George Russell, siendo ese hasta el momento el último de los 191 podios que registró en su historial el heptacampeón mundial.\r\n\r\nHamilton Russell\r\n\r\nHamilton este año estuvo en el podio en nueve competencias de las 22 que se desarrollaron, lo que representa el 41% de presencias entre los tres premiados de cada Gran Premio, subiendo en el segundo lugar en Francia, Hungría, Estados Unidos, México y San Pablo; en tanto que fue tercero en Bahrein, Canadá, Gran Bretaña y Austria.\r\n\r\nY por si fuera poco: 2022 fue el peor en materia de resultados para él, al culminar sexto en la tabla del campeonato. Su anteriores años bajos fueron en 2009 y 2011 cuando terminó quinto en cada temporada, a bordo del McLaren.\r\n\r\nLa “sequía” de triunfos se extiende desde el primer Gran Premio de Arabia Saudí en Jeddah el 5 de diciembre de 2021, cuando fue reubicado por delante de Max Verstappen (Red Bull) por una maniobra polémica del neerlandés sobre él, obstaculizándolo durante los últimos giros en el trazado callejero, marcando con ello la última de sus 103 victorias en Fórmula 1.\r\n\r\nHamilton Jeddah 2021\r\n\r\nEn la estadística personal, Hamilton solo en 2013 registró una victoria (Hungría), mientras que en los restantes certámenes ganó 11 competencias en 2014, 2018, 2019 y 2020; 10 en 2015 y 2016; 9 en 2017; 8 en 2021; 5 en 2008; 4 en 2007 y 2012; 3 en 2010 y 2011; 2 en 2009.  El inglés lo hizo con McLaren en 21 Grandes Premios entre 2007 (el primero fue en Canadá) y 2012, y con Mercedes los restantes 82, entre 2013 y 2021.\r\n\r\nEntre sus notables resultados se destacan seis Grand Chelem, conseguidos en 2015 en Malasia, 2015 en Italia, 2017 en Gran Bretaña, Canadá y China, y 2019 en Abu Dhabi. Allí ganó tras largar en pole, hacer el récord de vuelta y liderar de principio a fin cada carrera.\r\n\r\nAhora, enfocado en 2023, el piloto emblema de Mercedes buscará recuperar esa exitosa performance para también obtener su octava corona y dejar por sentado una nueva marca en la historia de la F1.', 28, '53.00111210287688', '-2.383648708758055', NULL, 3),
(13, 'La triste historia familiar detrás de Tomás Holder, exparticipante de Gran Hermano', 'Sigue la polémica para el tiktoker, quien fue el primer eliminado de la casa más famosa.', 'a participación de Tomás Holder en Gran Hermano fue fugaz, sin embargo, a pesar de haber sido el primer eliminado de la competencia, sigue dando de que hablar. El reconocido influencer de TikTok se ganó el odio de la audiencia tras presentar un personaje homofóbico y clasista, características que nadie perdona en pleno 2022. Salió con el 60% de los votos, pero detrás de él existe una triste historia familiar, que fue revelada en las últimas horas. \r\n\r\nPrecisamente fue su madre, Gisela Gordillo quién en una entrevista con Ulises Jaitt para su programa de radio XLFM, contó el oscuro pasado que la sigue a ella y su hijo, Tomás Holder. \"Tomás no tiene vínculo con su padre. Desapareció. Se quiere esconder tres metros bajo tierra\", partió comentando Gisela.', 29, '-34.67326292127359', '-58.585594054632196', NULL, 3),
(14, 'La lapidaria respuesta de Susana Giménez sobre si considera volver a la Argentina', 'Previo al viaje de la diva argentina hacia Qatar, le consultaron si estaría considerando la alternativa de regresar para Buenos Aires y su respuesta f', 'esde la pandemia del 2020, Susana Giménez optó por instalarse en Uruguay y al parecer, de forma permanente. Aunque en un principio viajó hacia el país por temas puntuales -como las últimas elecciones presidenciales- la diva siempre regresó a Punta del Este. Lugar que ha convertido en su nuevo hogar estable.\r\n\r\nActualmente cuenta con la ciudadanía uruguaya y recientemente viajó hacia Qatar para acompañar a Marley en el programa que comenzó el pasado domingo 13 de noviembre: “Por el mundo\", edición Mundial. Para mostrar la otra cara de la Copa del Mundo 2023, es decir, \"el lado B\" no futbolístico.', 29, '-34.61945772820957', '-56.03891199021072', 'https://caras.perfil.com/noticias/celebridades/la-lapidaria-respuesta-de-susana-gimenez-sobre-si-con', 3),
(15, 'Los destinos agroecológicos crecen en Misiones', 'Misiones cuenta mucha naturaleza, por lo cual Poi determino que se debería aprovechar más el verde que posee y diseño un mapa de todos los eco sitios ', 'Este movimiento puede salvaguardar los recursos naturales y la biodiversidad, como también promover la adaptación y la mitigación del cambio climático. Además de nutrir la identidad, la cultura y reforzar la viabilidad económica de las zonas rurales.\r\n\r\nPara algunas personas esto puede ser algo novedoso, pero para otras es un estilo de vida como es el caso de Juan Martin Bigues (Poi). El cual vive en la reserva natural regenerativa “La Espiral” ubicado en Cerro Cora, habitando hace años de forma comunitaria en la naturaleza y practicando la permacultura, agroecología y cultivos agroforestales.\r\n\r\nMisiones cuenta mucha naturaleza, por lo cual Poi determino que se debería aprovechar más el verde que posee y diseño un mapa de todos los eco sitios que existen en la provincia. Actualmente son más de setenta, los cuales manejan personas, familias que se autoproclaman como espacios en el cuidado de la vida, de los ecosistemas y de las personas, donde propician la sustentabilidad, la agroecología y el buen vivir. Así pudieron sistematizarlo como una propuesta para los que hacen voluntariados, capacitaciones educativas, quienes comercializan productos orgánicos y también para aquellos que hacen ecoturismo o turismo comunitario', 30, '-26.93884765538797', '-54.53999561824277', NULL, 3),
(16, 'Exponen jóvenes avileños experiencias en agroecología', 'ROMÁN ROMERO LÓPEZ | FOTOS: CORTESÍA DE LA FUENTE', 'Ciego de Ávila, 19 nov (ACN) Procedentes de la provincia de Ciego de Ávila, Diana Rosa Gómez Guerra y Yirian Garcías Bermúdez, constituyen la más joven representación de Cuba en el VIII Encuentro Internacional de Agroecología, Soberanía Alimentaria, Educación Nutricional y Cooperativismo, con sede en el territorio de Artemisa.\r\n\r\nGómez Guerra, con 21 años y estudiante de primer año de Agronomía, informó a la Agencia Cubana de Noticias que participa con la ponencia titulada Sostenibilidad alimentaria mediante el uso de la ciencia, tecnología e innovación en la finca agroecológica Rincón Los Hondones, ubicada en el tramo del macizo montañoso de Bamburanao perteneciente al municipio avileño de Chambas.\r\n\r\nEn el trabajo expone resultados de una Finca Escuela con Enfoque de Paisaje ―condición otorgada por el proyecto internacional Conectando Paisajes―, donde demuestran (en 3.21 hectáreas) la capacidad para autoabastecerse y aportar al consumo social, destacó vía internet .\r\n\r\nSubrayó que contribuyen a una alimentación sana, reducen la dependencia de medios e insumos externos e implementan prácticas amigables y favorecedoras de la recuperación del ecosistema montañoso.', 30, '-31.62181158510059', '-60.58725183396072', NULL, 1),
(17, 'India será la tercera economía del mundo en cinco años', 'Es un pronóstico de Morgan Stanley. El actual gobierno indio revirtió las políticas distribucionistas y apostó por medidas de apoyo a la inversión pri', 'Analista Internacional\r\n\r\nEl cálculo de Morgan Stanley es que India se convierte en la tercera economía del mundo en 2027, y duplicará su producto bruto en los próximos 10 años, lo que significa que pasa del actual US$3,4 billones a US$8,5 billones en ese periodo.\r\n\r\nEsto significa que todos los años, y en forma acumulada, India incorpora más de US$400.000 millones a su PBI, lo que equivale a una escala solo superada por las 2 grandes superpotencias, que son EE.UU. y China.\r\n\r\nPor su parte, los mercados bursátiles indios aumentarán tres veces su capitalización en la próxima década, y aumentarían de US$3,4 billones en 2021 a US$11 billones en 2032, y de esa manera se convertirían en los terceros del mundo.\r\n\r\nEn este logro extraordinario la acción del primer ministro Narendra Modi es esencial, y responde al hecho de que ha orientado estratégicamente la acción de su gobierno a impulsar la inversión privada y la creación de puestos de trabajo, al tiempo que ha dejado atrás las políticas distribucionistas de las anteriores administraciones del Partido del Congreso.\r\n\r\nLa orientación estratégica del premier Modi es nítidamente procapitalista, y tiende a establecer un mercado doméstico unificado, ante todo en términos impositivos. Para eso ha creado por primera vez en la historia del Subcontinente un impuesto al valor agregado de bienes y servicios de 15% en cada transacción, que abarca a un universo productivo de más de 600 millones de personas, incluyendo una clase media cuya lengua es el inglés y poseedora de una alta cultura informática.', 31, '18.006153275444678', '79.95875760467088', NULL, 3),
(18, 'Tres detenidos por el copamiento de la subcomisaría de Arroyo Leyes y el robo del patrullero', 'Personal de la Agencia de Control Policial realizó allanamientos en barrio Villa Hipódromo de la capital provincial. Allí aprehendieron a dos hombres ', 'os agentes lograron aprehender a tres personas, dos adultos y un menor de 17 años. Los mismos fueron puestos a disposición de la Justicia aunque aún no está claro si formaron parte del golpe comando o de algún encubrimiento posterior.\r\n\r\nAdemás de las detenciones, en los allanamientos también se secuestraron teléfonos celulares que podrían ser de interés para la causa. También encontraron plantas de marihuana en una de las propiedades por lo que se dio intervención a la Justicia Federal.\r\n\r\n\r\nEl copamiento de la subcomisaría de Arroyo Leyes ocurrió en la madrugada del jueves cuando al menos siete personas con uniforme policial ingresó a la dependencia y redujo al personal. Una vez que maniataron a los agentes de turno, fueron a una vivienda lindera donde golpearon a los dueños y les exigían dinero.', 32, '-32.61828842316409', '-60.87930247826712', NULL, 1),
(19, 'Argentina goleó 5-0 a Emiratos Árabes en su último partido previo al Mundial', 'Sin problemas, Argentina resolvió con aplomo el último ensayo mundialista, en un examen propicio de cara a un Mundial que la tiene como uno de los can', 'La selección de Argentina superó a su similar de Emiratos Árabes Unidos por 5-0 (parcial 4-0), en el último amistoso previo de la Albiceleste antes del comienzo de su participación en el Mundial Catar-2022. En el partido jugado en el estadio Mohammed Bin Zayed, en Abu Dabi, Julián Álvarez, Ángel Di María, Lionel Messi y Joaquín Correa anotaron para la Albiceleste.\r\n\r\nNo tardó más que unos minutos la selección de Lionel Scaloni para encontrar el primer gol en un contraataque veloz y letal, con un pase frontal al vacío de Di María hacia Messi, que escapó en soledad por la izquierda y cuando tenía por delante al arquero asistió a Julián Álvarez, que resolvió por derecha con un toque a la red.\r\n\r\nEl encuentro mostraba un buen nivel de la selección argentina, con capacidad para presionar alto y moverse constantemente en el campo contrario, y poco después llegó el 2-0, originado en una subida por izquierda de Marcos Acuña, que envió el centro y por la derecha llegó Di María, que anotó con una volea cruzada, en una fantástica resolución a un toque.', 33, '23.985315417613897', '46.74774291605932', NULL, 3),
(20, 'Cripto crash: FTX debe más de USD 3.000 millones a sus 50 principales acreedores', 'Las repercusiones por el colapso de una de las mayores plataformas de criptomonedas sigue conmoviendo al mercado. Los daños económicos alcanzarían los', 'Los coletazos por el colapso de la plataforma de criptomonedas FTX se suceden día a día, después de que este mes se declarara en bancarrota este mes. Según trascendió este lunes, la firma debe más de USD 3.000 millones a sus principales 50 acreedores, tal como admitió en un documento judicial presentado este fin de semana.\r\n\r\nLa lista no hace pública ninguna identidad, pero sí el dinero que se adeuda, que alcanza los USD 226 millones en el caso del acreedor que la encabeza y que incluye a una decena a los que se deben más de 100 millones. En otro escrito previo, FTX calcula que puede tener en total más de un millón de acreedores tras su repentino colapso.\r\n\r\nDe acuerdo con expertos, “lo más probable es que los usuarios de la plataforma afectados nunca recuperen sus fondos, dado que -a diferencia de lo que ocurre en la banca tradicional- los depósitos no estaban garantizados y no está claro cuánto dinero podría quedar para resarcirlos cuando se liquide la empresa”, indicó la agencia EFE.', 34, '36.98237322471192', '-89.02413719273457', NULL, 1),
(21, 'Las mejores recetas de cocina internacional', 'Platos de cualquier rincón explicados en detalle, cocina las recetas perfectas para dar la vuelta al mundo de los sabores y disfrutar de todas las gas', 'Qué mejor forma de viajar que a través de recetas de todas las partes del mundo. La comida tiene la capacidad de transpórtanos hasta cualquier lugar a través de los sabores, y nunca antes había sido tan fácil acceder a los secretos de lejanas gastronomías o conseguir los productos necesarios para su cocinado como ahora. Te invitamos a preparar tus papilas gustativas para descubrir de verdad a qué sabe el mundo que nos rodea.\r\n\r\nIndagaremos en las que se elaboran en Europa, con especial atención en España pero también en el resto de cocinas del viejo continente, referencia culinaria indiscutible en todo el planeta gracias a la refinada gastronomía francesa, al recetario italiano de pastas y pizzas, a la frescura de países bañados por el Mediterráneo como Grecia y Turquía, a las preparaciones nórdicas y escandinavas que mejor reflejan su salvaje naturaleza…\r\n\r\nFijaremos la mirada en los recetarios norteamericanos buscando mucho más que fast food, diseccionaremos la enorme riqueza gastronómica de México, probaremos las creaciones más características de la cocina peruana y nikkei, llegaremos hasta las antípodas para mostrar la pujante cocina tailandesa, acudiremos a la ortodoxia japonesa para saborear mucho más que sushi, investigaremos en las alacenas de la fría Rusia, viviremos la comida popular que reúne pueblos orientales o africanos…', 35, '45.37441895502846', '1.5774203217596572', NULL, 3),
(22, 'Recao de Binéfar, un plato de cuchara que recupera la historia, reconforta y nutre, y brilla con sus', 'El recao de Binéfar, es una auténtica delicia. Un plato sencillo y humilde, tiene su origen en el alto Aragón. ', 'Cómo hacer recao de Binéfar\r\nDificultad: Media\r\nTiempo total\r\n8 h 50 m\r\nElaboración\r\n8 h\r\nCocción\r\n50 m\r\nLa noche anterior, lavar bien las judías y dejar en remojo en agua fría durante toda la noche.\r\n\r\nAl día siguiente, escurrir y llevar a olla mediana donde se ponen a cocer con agua fría y sin sal. Al primer hervor se retiran y se dejan 5 minutos, tapadas, fuera del fuego.\r\n\r\nPasados ese tiempo de reposo, se les cambia el agua que tienen por otra fría, se acercan de nuevo al fuego y se dejan cocer despacio hasta que estén tiernas de 35 a 40 minutos. Añadir al momento del cambio de agua, los dientes de ajo, la cebolla picada, las hojas de laurel y los granos de pimienta o pimentón picante a fuego medio alto. Todo ello en crudo le damos un punto de sal.\r\n\r\nCuando las judías están casi cocidas, añadir las patatas cortadas en porciones pequeñas, de un tamaño aproximado al de las judías. Se mantiene la cocción, procurando que el guiso se conserve caldoso, y a los cinco minutos de haber añadido las patatas, se incorpora el arroz y se baja el fuego a medio para dejar cocinar unos 12 a 15 minutos.\r\n\r\nUna vez que se ha cocido todo, se prueba el gusto de sal, y si está bien, se sirve en caliente y se condimenta con unos hilos de aceite de oliva en crudo.', 36, '40.415002046438936', '-3.7136000869434405', NULL, 3),
(23, 'Qatar 2022: Antonela Roccuzzo y Sofia Balbi, la primera foto oficial ', ' Las esposas de los futbolistas ya se encuentran en la Copa del Mundo para alentar a la Selección Argentina. ', 'go de cautivar a sus seguidores con una tierna foto de sus hijos rumbo a Qatar 2022, Antonela Rocuzzo ya se encuentra disfrutando de la Copa del Mundo. En su primer día de estadía en el Medio Oriente, la rosarina compartió la primera foto oficial junto a Sofia Balbi.\r\n\r\nLa esposa de Lio Messi tiene un grupo de amigas que hasta el día de hoy mantiene, y que conoció cuando el futbolista jugaba en el Barcelona. Una de las chicas de este grupo es Sofía Balbi, la esposa del uruguayo Luis Suárez, con quien Roccuzzo se encontró en su primer día en Qatar 2022. \r\n\r\n“Reunidas en Qatar. Te extrañaba amiga” escribió la rosarina en su historia de Instagram, junto a un emoji de corazón. En la foto se puede ver a ambas disfrutando de su reencuentro en lo que parecería ser un bar catarí. ', 37, '25.47885011445931', '55.826323137127716', NULL, 1),
(24, 'Estafa mundial: El Chapu Martínez compró entradas que nunca recibió', 'El influencer de “Traeme la copa Messi” fue víctima de una estafa junto a otros argentinos.', 'El Chapu Martínez es uno de los 50.000 argentinos que viajaron a Qatar. En sus redes sociales confesó estar cumpliendo el sueño de su vida que es alentar a la selección nacional.\r\n\r\n“Hace 4 años me fui con la ilusión y el sueño de un hincha de ver por primera vez un mundial a mi país, lo conseguí y me cambió la vida para siempre. Lamentablemente como todos los mundiales anteriores después del 86 no pudimos levantar la copa, pero seguimos bancando a la celeste y blanca. Hoy la vida me da la revancha, o la nueva oportunidad de ir a una copa del mundo, a disfrutar, a trabajar y a poder seguir creciendo y cambiando mi vida y la de mi familia”, expresó el influencer.\r\n\r\nPero la experiencia de presenciar la Copa del Mundo no es todo alegría pues cuando llegó al país sede se enteró que lo habían estafado.', 38, '-34.750505482574496', '-58.29889101474018', NULL, 3);

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
(3, 'Campeones', 2, 'campeones.jpg', '300.00'),
(4, 'Caras', 2, 'caras.jpg', '300.00'),
(7, 'Cronica', 1, 'cronica.jpg', '300.00'),
(8, 'Lo Gourmet', 2, 'loGourmet.jpg', '300.00');

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
(10, 'Deporte'),
(11, 'Economia'),
(12, 'Naturaleza'),
(13, 'Policial'),
(15, 'Publicidad'),
(16, 'Espectaculos'),
(17, 'Gastronomia');

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
(37, 6, 3, '2022-11-21', '2023-11-21', '3600.00'),
(39, 8, 7, '2022-11-21', '2023-11-21', '3600.00'),
(40, 6, 8, '2022-11-22', '2024-11-22', '7200.00');

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
(3, 'Video'),
(4, 'Otro');

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
(3, 'Editor'),
(4, 'Administrador');

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
(6, 'Lector', 1, 'fernando.icardi@gmail.com', '-34.6638486921525', '-58.58979975836755'),
(7, 'Administrador', 4, 'fernando.icardi@gmail.com', '-35.17800874690634', '-59.10501284091205'),
(8, 'Contenidista', 2, 'fernando.icardi@gmail.com', '-34.652803602418025', '-58.60044276373864'),
(9, 'Editor', 3, 'fernando.icardi@gmail.com', '-34.66582486981936', '-58.54723251456798');

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
-- Indices de la tabla `estadonoticia`
--
ALTER TABLE `estadonoticia`
  ADD PRIMARY KEY (`Id`);

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
  ADD KEY `IdEstadoNoticia` (`IdEstadoNoticia`),
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

ALTER TABLE `Producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `contraseña`
--
ALTER TABLE `contraseña`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `edicion`
--
ALTER TABLE `edicion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `edicionseccion`
--
ALTER TABLE `edicionseccion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `edicion_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `multimedia_ibfk_1` FOREIGN KEY (`IdNoticia`) REFERENCES `noticia` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `multimedia_ibfk_2` FOREIGN KEY (`IdTipoMultimedia`) REFERENCES `tipomultimedia` (`Id`);

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `IdEdicionSeccion` FOREIGN KEY (`IdEdicionSeccion`) REFERENCES `edicionseccion` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `IdEstadoNoticia` FOREIGN KEY (`IdEstadoNoticia`) REFERENCES `estadonoticia` (`Id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `suscripcion_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suscripcion_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`Id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
