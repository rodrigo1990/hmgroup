-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-08-2018 a las 16:25:33
-- Versión del servidor: 5.1.73-cll
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hmgroup_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloques_inferiores`
--

CREATE TABLE IF NOT EXISTS `bloques_inferiores` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `foto1` varchar(300) NOT NULL,
  `video1` varchar(70) NOT NULL,
  `foto2` varchar(300) NOT NULL,
  `video2` varchar(70) NOT NULL,
  `foto3` varchar(300) NOT NULL,
  `video3` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `titulo`) VALUES
(1, 'ACORDEONES'),
(2, 'AFINADORES Y METRÓNOMOS'),
(20, 'GUITARRAS'),
(19, 'ARMONICAS'),
(24, 'CABLES'),
(9, 'TECLADOS'),
(10, 'VIENTOS'),
(18, 'EQUALIZADORES'),
(16, 'MELODICAS'),
(17, 'ACCESORIOS - KYSER'),
(22, 'AUDIO Y SONIDO'),
(23, 'BAJOS'),
(25, 'UKELELES'),
(26, 'SOPORTES'),
(28, 'PLATILLOS'),
(29, 'PEDALES DE EFECTO'),
(30, 'CUERDAS Y ENCORDADOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(40) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `codigo` varchar(300) NOT NULL,
  `contrasenia` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=264 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `usuario`, `nombre`, `codigo`, `contrasenia`) VALUES
(1, 'minorista', 'Antigua Casa Nuñez S.A.', '100', '123456'),
(2, 'distribuidor', 'De Volder Matias', '101', '12345'),
(3, 'minorista', 'pato', '100', 'pato06'),
(4, 'distribuidor', 'Prodmusicales', '159', '159'),
(5, 'distribuidor', 'Bokin Sociedad Anonima (Daiam)', '108', '30519103121'),
(6, 'distribuidor', 'ABELENDA ALBERTO JOSE (MUSICAL IOCCO)', '722', '20123618832'),
(7, 'distribuidor', 'ABREU JOSE MARIA (AUDIO FILM)', '841', '20114909751'),
(8, 'distribuidor', 'ADAMO ALEJANDRO JAVIER (DRUMS CENTER)', '2022', '20228450996'),
(9, 'distribuidor', 'ADUR ROMINA SALOME', '1336', '27246136608'),
(10, 'distribuidor', 'Agro Pampa S.A', '1339', '30710608411'),
(11, 'distribuidor', 'Aguilera Mario Roberto (Service Philips)', '330', '20161567656'),
(12, 'distribuidor', 'Aguirre Bruno Gabriel - Casa de Musica B&D', '1290', '23356430859'),
(13, 'distribuidor', 'Aguirre Pablo Daniel (Music Pro)', '847', '20322504048'),
(14, 'distribuidor', 'Alanis Lila Victoria (Venus)', '1912', '27112137888'),
(15, 'distribuidor', 'Ale Ernesto Fabio', '1213', '20327803426'),
(16, 'distribuidor', 'Alessandrini Antonela Luz Marina', '765', '23346473924'),
(17, 'distribuidor', 'Alfandari Roberto Jose (Ruazol)', '433', '20131841044'),
(18, 'distribuidor', 'Alfieri Jorge Alfredo - Alvarez Musica', '2219', '20131308044'),
(19, 'distribuidor', 'Alfieri Osvaldo Hector - Grey', '2334', '20123016271'),
(20, 'distribuidor', 'Alfil Hogar S.R.L', '606', '30707990542'),
(21, 'distribuidor', 'All Music SH de Tinarelli Guillermo y Tiranel', '1295', '30710072503'),
(22, 'distribuidor', 'Allegretti Alejandro Guillermo', '706', '20166270767'),
(23, 'distribuidor', 'Alvado Maria Gladys (Disqueria Genesis)', '1940', '27112093260'),
(24, 'distribuidor', 'Alvarenga Ariel A. (Confortavs) Casa Central', '2187', '20317755970'),
(25, 'distribuidor', 'Alvarenga Fernando Ezequiel (Confort avs)', '2179', '20260245563'),
(26, 'distribuidor', 'Alvarez Daniel Alejandro (Sentry Music)', '2222', '20164023495'),
(27, 'distribuidor', 'Alvarez Ramirez Nestor Horacio (Maj 7 Musica)', '2235', '20244348948'),
(28, 'distribuidor', 'Amado Roque (Roque Music)', '1046', '20132754757'),
(29, 'minorista', 'Andaluzia S.A', '729', '30710839383'),
(30, 'distribuidor', 'Andrea Bove (Soundmatch)', '256', '27288437438'),
(31, 'distribuidor', 'Antigua Fabrica de Guitarras S.R.L', '2205', '30696075383'),
(32, 'distribuidor', 'Antonelli Carlos Alberto', '709', '20117366872'),
(33, 'distribuidor', 'Apud Julio Alberto', '616', '20185435734'),
(34, 'distribuidor', 'Aragon Sol Andres (Unisono)', '336', '20264123616'),
(35, 'distribuidor', 'Arevalo Juan D - Trochine', '1018', '30710160941'),
(36, 'distribuidor', 'Argent Music', '266', '30712345833'),
(37, 'distribuidor', 'Arguello Aurora Juana (Netos)', '559', '27118238309'),
(38, 'distribuidor', 'Arias Bernardo Luis (Bronx)', '117', '20105337346'),
(39, 'distribuidor', 'ARISMENDI HUGO Y ARISMENDI GASTON SOC.HECHO', '2302', '30710215630'),
(40, 'distribuidor', 'ARNAUDO GRACIELA EDIT', '944', '27213940258'),
(41, 'distribuidor', 'ARROYO SUSANA MARIEL  (DISQUERIA KEOPS)', '1804', '27161435215'),
(42, 'distribuidor', 'ARRUA JOSUE ALBERTO(NEBEMUSIC)', '157', '20232240009'),
(43, 'distribuidor', 'ARTE MUSICAL S.A.', '140', '30642004596'),
(44, 'distribuidor', 'ASOC COMP.POR VIG.DE LOS DERECHOS HUMANOS SOC', '107', '30707901434'),
(45, 'distribuidor', 'ASTUDILLO RICARDO OSCAR - BETA LUJAN', '2163', '20234030990'),
(46, 'distribuidor', 'AUDIO 2000 SRL', '413', '30633209096'),
(49, 'distribuidor', 'AUDIOIMPORT SANTA FE FIDEICOMISO', '1257', '30710356536'),
(50, 'distribuidor', 'AVALOS RICARDO LUCAS', '962', '20141618890'),
(51, 'distribuidor', 'BAB S.R.L.(AUDIOMUSIC)', '1930', '30711769281'),
(52, 'distribuidor', 'BABAGLIO DIANA ALEJANDRA(DIGITAL RECORD)', '1256', '27238638815'),
(53, 'distribuidor', 'BAIRES MUSIC S.R.L', '114', '30709433373'),
(54, 'distribuidor', 'BALEANI CARLOS ERNESTO', '1053', '20162147170'),
(55, 'distribuidor', 'BAMBIL MIGUEL(CASA MAIKEL)', '526', '20057128780'),
(56, 'distribuidor', 'BARBERA ALFREDO ORLANDO', '401', '20050883249'),
(57, 'distribuidor', 'BARBERA SANCHEZ ANDRES EMILIO', '453', '20314422873'),
(58, 'distribuidor', 'BARBERO SANTIAGO PABLO(MUNDO HOGAR)', '1931', '20265614516'),
(59, 'distribuidor', 'BARBIERI GRACIELA,CAPPELLO R,L,V Y CORRALES S', '1050', '30714543748'),
(60, 'distribuidor', 'BAROTTO ADRIANO(LA ROKERIA)', '1028', '20320735115'),
(61, 'distribuidor', 'BELGRANO SUR S.R.L.', '756', '30708558032'),
(62, 'distribuidor', 'BELSITO MATIAS NICOLAS(CUERDASHOP)', '2236', '20321496432'),
(63, 'distribuidor', 'BENEGAS MILENA LILIANA', '971', '27394076789'),
(64, 'distribuidor', 'BERGESIO HUGO Y BERGESIO ALICIA', '1043', '30707212396'),
(65, 'distribuidor', 'BERTOTTO SEBASTIAN GERONIMO(GN MUSIC)', '260', '20246037540'),
(66, 'distribuidor', 'BIANCHI PABLO EZEQUIEL(ESCULTORES DEL AIRE)', '144', '20298662265'),
(67, 'distribuidor', 'BIASOTTO MIGUEL ANGEL(TRABIA ELECTRONICA)', '964', '20121562651'),
(68, 'distribuidor', 'BIASOTTO QUEVEDO ALEJANDRO MIGUEL', '976', '20324671200'),
(69, 'distribuidor', 'BLAZQUEZ NICOLAS (AUDIO ROSARIO)', '1261', '20311156765'),
(70, 'distribuidor', 'BLUE NOTE MUSICA SRL', '441', '30714252433'),
(71, 'distribuidor', 'BOCCELLARI PABLO DANIEL(ALTERNATIVA MUSICA)', '655', '20306282892'),
(72, 'distribuidor', 'BOKIN SOCIEDAD ANONIMA(COSTA)', '863', '30519103121'),
(73, 'distribuidor', 'BONANSEA RUBEN SANTOS(AIRES HOGAR)', '409', '20073767033'),
(74, 'distribuidor', 'BONATO RAUL MARCELO', '1304', '20111610291'),
(75, 'distribuidor', 'BONELLI JORGE', '1052', '20180100408'),
(76, 'distribuidor', 'BONIN MIGUEL ANGEL(ELECTRICIDAD MITRE)', '755', '20076957984'),
(77, 'distribuidor', 'BORZI JOSE ANTONIO', '622', '20166214700'),
(78, 'distribuidor', 'BOUCHET PABLO CRISTIAN(FONOTECA MUSICA)', '1049', '20219527900'),
(79, 'distribuidor', 'BRANDAN ATILIO Y BRANDAN OSCAR SH-MUNDO AUDIO', '2149', '30711140804'),
(80, 'minorista', 'BRITO AGUSTIN ENRIQUE(CRI-CRI)', '2232', '23077734899'),
(81, 'distribuidor', 'BRUMATTI MARIA ALEJANDRA(ELECTRO CORONDA)', '1285', '27208940703'),
(82, 'distribuidor', 'BUSTOS JORGE RAUL(440 GARAGE)', '1044', '20174748242'),
(83, 'distribuidor', 'BYS SAMUEL(OBERA)', '518', '20163310229'),
(84, 'distribuidor', 'CALBUCURA GUERRERO FRANCISO(MUSIC STORE)', '1942', '20188094768'),
(85, 'distribuidor', 'CAMEL NORMANDO SUED (TV MUNDO)', '301', '20148040169'),
(86, 'distribuidor', 'CAPPARELLI - LONGARTE (HAMUSIC)', '2180', '30714241830'),
(87, 'distribuidor', 'CASA MARRODAN S.R.L.', '501', '33653852679'),
(88, 'distribuidor', 'CASA MARTINEZ DE PIETROWSKI Y DE VERON(AUDIO)', '2029', '30657327421'),
(89, 'distribuidor', 'CASA SILVIA S.A(GRUPO ACCEDER)', '724', '33666615609'),
(90, 'distribuidor', 'CASA SUHRING S.R.L', '414', '30518320544'),
(91, 'distribuidor', 'CASTELUCCI ERNESTO FABIAN - COVER DISC', '1206', '20200167350'),
(92, 'distribuidor', 'CATELOTTI JAVIER ELIAS(MAYNARD MUSIC)', '1322', '20321366601'),
(93, 'distribuidor', 'CESARI DORA BEATRIZ (ILUSION MUSICAL)', '817', '27056434009'),
(94, 'distribuidor', 'CHAS EDUARDO GUILLERMO(LA PROTESTONA INST)', '1331', '23286750079'),
(95, 'distribuidor', 'CHAVARRI RICARDO MARTIN', '1033', '20276842677'),
(96, 'distribuidor', 'CHUECABA 2016 SOCIEDAD ANONIMA', '762', '30715201476'),
(97, 'distribuidor', 'CINGOLANI CARLOS JAVIER(FA SOL LA)', '2183', '20349228816'),
(98, 'distribuidor', 'CIPOLLONE FERNANDO JOSE', '1621', '20276413644'),
(99, 'distribuidor', 'CISERA JUAN (LA MAGA)', '500', '20168716894'),
(100, 'distribuidor', 'CLAUSEN CELIO MENDRADO - RINCON MUSICAL', '506', '20075494832'),
(101, 'distribuidor', 'COMPUMUSIC S.R.L', '309', '30702411188'),
(102, 'distribuidor', 'COMUNICACIONES FUEGUINAS S.R.L.(SUCURSAL)', '1924', '30670643510'),
(103, 'distribuidor', 'D ASCANIO MARIO GUSTAVO- MYM COMPUTACION', '1054', '20164362257'),
(104, 'distribuidor', 'DAMICO RUBEN EDUARDO- HABITATREPRESENTACIONE', '450', '20161991385'),
(105, 'distribuidor', 'DE OLIVEIRA JOSE CARLOS', '1291', '23172344429'),
(106, 'distribuidor', 'DE OLIVEIRA MARIANO JOSE(GUITAR SHOP)', '1272', '20349334101'),
(107, 'distribuidor', 'DE OLIVEIRA MARISA', '1244', '27147295044'),
(108, 'distribuidor', 'DE SOUSA JUAN MARCELO  (ARROBA MIL MUSICA)', '634', '20249967131'),
(109, 'distribuidor', 'DELUCCHI HECTOR JORGE  (COSAS DEL CONDE)', '1807', '20078136422'),
(110, 'distribuidor', 'DISCOMANIA S.A.', '1944', '33714629749'),
(111, 'distribuidor', 'DOLCE HERMANOS SOCIEDAD ANONIMA', '1320', '30708408758'),
(112, 'distribuidor', 'DOMINGUEZ FRANCO JULIAN (RD MUSIC STORE)', '1947', '20322451904'),
(113, 'distribuidor', 'DON JOSE HOGAR SOCIEDAD ANONIMA', '1906', '30707229663'),
(114, 'distribuidor', 'ECO MUSIC S.A', '1605', '30708252820'),
(115, 'distribuidor', 'EDEN SRL', '916', '30592977032'),
(116, 'distribuidor', 'EDICIONES MUSICALES S.A.', '152', '30561699867'),
(117, 'distribuidor', 'EL CIPRES HOGAR S.R.L.', '1007', '30672732308'),
(118, 'distribuidor', 'EL EMPORIO AUSTRAL S.R.L', '1921', '30709250074'),
(119, 'distribuidor', 'EMAVE S A', '1222', '30506084691'),
(120, 'distribuidor', 'ERRANDONEA ADRIANA VALERIA', '2117', '27249834241'),
(121, 'distribuidor', 'ESPINOSA FEDERICO - MUSIFAN', '2258', '23229233769'),
(122, 'distribuidor', 'ESPOSITO RUBEN EZEQUIEL(HOUSE MUSIC)', '561', '20329767508'),
(123, 'distribuidor', 'FALLET HUMBERTO RAUL Y FALLET HUGO F. S.H', '1316', '30671121356'),
(124, 'distribuidor', 'FAZZARI CARLOS EDUARDO', '837', '20114518949'),
(125, 'distribuidor', 'FERNANDEZ HAYDEE MARGARITA(BAZAR RODRIGUEZ)', '735', '27045219769'),
(126, 'distribuidor', 'FERREYRO MARIO Y FERREYRO FACUNDO S.H', '2165', '30712146059'),
(127, 'distribuidor', 'FIESTA MUSICAL SH DE PALADINO Y CANAGLIAS', '2309', '30680422601'),
(128, 'distribuidor', 'FISTECHOK JUAN CARLOS(CASA LIBRA)', '2208', '20134374730'),
(129, 'distribuidor', 'FLOREANI HECTOR GUILLERMO', '608', '20200161441'),
(130, 'distribuidor', 'FLORES JAVIER HERNAN(AUDIO VISION)', '1273', '23220264939'),
(131, 'distribuidor', 'G.H MUSICA S.R.L', '446', '30714193437'),
(132, 'distribuidor', 'GASPARINI NESTOR DARIO(LIBRERIA CABILDO)', '630', '20200339704'),
(133, 'distribuidor', 'GASPARRI LUIS JUAN', '2228', '20084147274'),
(134, 'distribuidor', 'GEREZ CRISTIAN RODOLFO', '352', '20349602793'),
(135, 'distribuidor', 'GHEZZI FERNANDO HECTOR', '1009', '23073006309'),
(136, 'distribuidor', 'GIL RAUL ENRIQUE (LA CASA DEL MUSICO)', '934', '20071058582'),
(137, 'distribuidor', 'GIORDANO RUBEN ALBERTO', '902', '20122417965'),
(138, 'distribuidor', 'GIOVAZZINI KAHIR ALI-  SOLO MUSICA', '1624', '20373851907'),
(139, 'distribuidor', 'GLOBAL ELECTRONICA S.A', '956', '30712500316'),
(140, 'distribuidor', 'GOMEZ ANALIA(ROBIMAR)', '217', '27120883998'),
(141, 'distribuidor', 'GORDILLO NESTOR RAMON(TOP MUSIC)', '412', '20213573501'),
(142, 'distribuidor', 'GRANDA LUIS NESTOR(LG)', '849', '20055249351'),
(143, 'distribuidor', 'GRASSO HECTOR CLAUDIO ROQUE(CASA DE MUSICOS)', '2035', '23126479999'),
(144, 'distribuidor', 'GRISOLIA HECTOR', '2241', '20046361084'),
(145, 'distribuidor', 'GUAS OMAR JULIO', '1806', '20139821824'),
(146, 'distribuidor', 'HERNANDEZ ABEL OSCAR(ERATO)', '2209', '20083832194'),
(147, 'distribuidor', 'HUENANTE LUIS ARTURO(DANILO RELOJERIA)', '1813', '20139895313'),
(148, 'distribuidor', 'IAKIMCZUK ROBERTO C. Y IAKIMCZUK JORGE R. SH', '2314', '30694201772'),
(149, 'distribuidor', 'J. F MUEBLES SRL- GRUPO MARQUEZ', '575', '30712151893'),
(150, 'distribuidor', 'JAITT SERGIO DANIEL(CORDOBA AUDIO)', '320', '20288844071'),
(151, 'distribuidor', 'JANDULA ALBERTO(SHOWMUSIC)', '329', '20282238323'),
(152, 'distribuidor', 'JOFRE BARRIOS GUILLERMO ALBERTO', '432', '23254629049'),
(153, 'distribuidor', 'JOSE MARIA LAMI HERNANDEZ Y CIA SRL', '300', '30566692887'),
(154, 'distribuidor', 'JUAN HOTZ E HIJOS SA', '809', '30707727329'),
(155, 'distribuidor', 'LA CUADRADA MUSICAL S.R.L.', '2103', '30708706708'),
(156, 'distribuidor', 'LACAMARA PRUDENCIO(INSTRUMENTOS MUSICALES)', '1212', '20060598305'),
(157, 'distribuidor', 'LAGOS CARLOS WALTER(CASA DE MUSICA LA MONEDA)', '1927', '20316255125'),
(158, 'distribuidor', 'LAS BASES S.R.L.', '310', '30709487848'),
(159, 'distribuidor', 'LISOWYJ EMANUEL ALEJANDRO(WARBEAST ROCKERIA)', '1283', '20317006471'),
(160, 'distribuidor', 'LLERAL SUSANA EMILIA', '836', '27045678836'),
(161, 'distribuidor', 'LOPEZ JORGE ALBERTO(ZEPOL DISTRIBUCIONES)', '420', '23277184729'),
(162, 'distribuidor', 'LORUSSO CONSTRUCTORA SA', '845', '30609297030'),
(163, 'distribuidor', 'LUTERIA S.A (ODDITYMUSIC)', '101', '30710355688'),
(164, 'distribuidor', 'MAIZ DANIEL ALBERTO(MEGAMUSIC)', '853', '20082936034'),
(165, 'distribuidor', 'MANDRILE ALCIDES,ADRIAN Y DIEGO(CONFORT)', '1214', '30674874738'),
(166, 'distribuidor', 'MANTINI FABIO Y CLAUDIO S.H', '331', '30633235194'),
(167, 'distribuidor', 'MARCUCCI HECTOR ORLANDO(MARCUCCI MUSICA)', '1220', '20138842984'),
(168, 'distribuidor', 'MARIO GOROSTIZA E HIJOS S.R.L', '328', '30710208669'),
(169, 'distribuidor', 'MARTEARENA FELIX WALTER(MUNDO MUSICAL)', '306', '20127126691'),
(170, 'distribuidor', 'MATAR ADOLFO GABRIEL(BLUSET)', '823', '20101014097'),
(171, 'distribuidor', 'MAXIHOGAR SRL', '317', '30646757327'),
(172, 'distribuidor', 'MC ELECTRONIC S.R.L', '938', '30709921599'),
(173, 'distribuidor', 'MERCADO CESAR ANTONIO', '910', '20066088759'),
(174, 'distribuidor', 'MISTRALETTI JORGE ALBERTO(YAMAHA MUSIC)', '905', '23066005003'),
(175, 'distribuidor', 'MITTICA CYNTHIA GISELA MAGDALENA-DASSEL MUSIC', '2133', '27298011587'),
(176, 'distribuidor', 'MK2 S.R.L.', '400', '30708268859'),
(177, 'distribuidor', 'MOLFINO RICARDO FABIAN(MOLFINO MANIA)', '749', '20125838708'),
(178, 'distribuidor', 'MORENO EZEQUIEL ENRIQUE - LA ROCKOLA', '2190', '20311761235'),
(179, 'distribuidor', 'MOYANO SILVIA(PENTAGRAMA-INSTRUMENTOS Y ACC.)', '422', '27136149623'),
(180, 'distribuidor', 'MUEBLERIA CARLITOS DE CARLOS Y NESTOR STERZ', '705', '30664873377'),
(181, 'distribuidor', 'MULONE EDUARDO VICENTE', '1345', '20171670242'),
(182, 'distribuidor', 'MUSIC GROUP FAMILIY SH', '153', '30714021377'),
(183, 'distribuidor', 'NEGRO JUSTO AURELIO', '576', '20167622128'),
(184, 'distribuidor', 'NUCIFORO FEDERICO', '2043', '20053199209'),
(185, 'distribuidor', 'OBON DIEGO GUSTAVO(MENDOZA MUSIC)', '406', '20227915634'),
(186, 'distribuidor', 'ORSI JAVIER EZEQUIEL   (CASA HENNING)', '2174', '23266664559'),
(187, 'distribuidor', 'PALACIO DE LA MUSICA ARGENTINA S.R.L.', '1343', '30715384945'),
(188, 'distribuidor', 'PALACIOS HUGO (MELODY)', '703', '20055048348'),
(189, 'distribuidor', 'PAOLETTI SERGIO NELSON (MUSICALIDAD 41)', '1602', '20170828365'),
(190, 'distribuidor', 'PATANE ROMAN ANDRES(MAX MUSIC-TANDIL)', '857', '20254529746'),
(191, 'distribuidor', 'PAZ RAMIRO HERNAN', '1016', '20268540130'),
(192, 'distribuidor', 'PERES OSVALDO ANIBAL', '521', '20116534070'),
(193, 'distribuidor', 'PEREZ DIEGO MARTIN(MUSICAL MONROE)', '269', '20268030515'),
(194, 'distribuidor', 'PEZZOTO GERMAN JOSE(MUSICA DEL ALMA)', '1251', '20184787327'),
(195, 'distribuidor', 'POLAK DANIEL ERNESTO', '764', '20201661227'),
(196, 'distribuidor', 'PORRO ENRIQUE RUBEN(ELECTRONICA PORRO)', '1814', '23104770169'),
(197, 'distribuidor', 'PRO AUDIO CENTER S.A - Alma de Musicos', '957', '30712485872'),
(198, 'distribuidor', 'RAMSES S.R.L(CENTRO HOGAR)', '805', '30685574213'),
(199, 'distribuidor', 'RECCHIONI MAURICIO ALBERTO(PLAY MUSIC)', '1209', '20147270357'),
(200, 'distribuidor', 'RESCHIGNA MARTIN ALFREDO', '975', '20204689475'),
(201, 'distribuidor', 'RICCI RICARDO JAVIER - STAFF RIVAL BERISSO', '1623', '20261921163'),
(202, 'distribuidor', 'RICCI RICARDO JAVIER - STAFF RIVAL LOS HORNOS', '1625', '20261921163'),
(203, 'distribuidor', 'RIMADA DANIEL R. Y RIMADA JORGE E. S.H.', '1006', '30709028274'),
(204, 'distribuidor', 'RINOLFI JUAN CARLOS(HAMELIN)', '1805', '20145781818'),
(205, 'distribuidor', 'RIUS JUAN ESTEBAN(SALAS LA CASA DE LA MUSICA)', '1935', '20296901823'),
(206, 'distribuidor', 'RIVERO OMAR EMILIO', '909', '20112294865'),
(207, 'distribuidor', 'RIVES HERMANOS SOCIEDAD RESPONSABILIDAD LIMIT', '449', '30620834927'),
(208, 'distribuidor', 'RODRIGUEZ C. Y DELLEDONNE M.(LA CUERDA)', '1620', '30714173835'),
(209, 'distribuidor', 'RODRIGUEZ JUAN MANUEL- MUSIC START', '161', '20288620971'),
(210, 'distribuidor', 'RODRIGUEZ LEANDRO', '2306', '23233048569'),
(211, 'distribuidor', 'ROLDAN ARIEL OSVALDO(CASA CAMUSSI)', '1262', '20284153473'),
(212, 'distribuidor', 'ROMERO SUSANA ANGELA', '2346', '27126275396'),
(213, 'distribuidor', 'RUIZ JUAN CARLOS  (RINCON DE LA MUSICA)', '1837', '20266078464'),
(214, 'distribuidor', 'SAFE S.A.', '423', '30711139709'),
(215, 'distribuidor', 'SAUER MARTA SUSANA -INSTRUMENTO MUSICAL FENIX', '2106', '23063725714'),
(216, 'distribuidor', 'SCARAMAL HERNAN EZEQUIEL(DELIA MUSIC)', '2242', '20325655152'),
(217, 'distribuidor', 'SHERIDAN JULIO ANIBAL(VICTORIA MUSICAL)', '513', '20115788729'),
(218, 'distribuidor', 'SILVERO LUIS ANTONIO (EL ANCORA)', '525', '20078651467'),
(219, 'distribuidor', 'SOTELO MIGUEL DE JESUS', '530', '20311684907'),
(220, 'distribuidor', 'SPAGOLLA LUIS', '1838', '20119004781'),
(221, 'distribuidor', 'STANFIELD JULIO GUILLERMO - MUNDO MUSICAL', '908', '20105123419'),
(222, 'distribuidor', 'SUAREZ EDUARDO JOSE', '612', '20120866363'),
(223, 'distribuidor', 'SUAREZ NESTOR DARIO(MASTER AUDIO INGENIERIA)', '617', '23149475389'),
(224, 'distribuidor', 'SUCESION DE FADEL JORGE', '404', '20034286575'),
(225, 'distribuidor', 'SUCESION DE SCHAPIRO ENRIQUE NORBERTO', '1603', '20051583508'),
(226, 'distribuidor', 'SUCESION DE STEFANICH LINO', '1015', '20186866860'),
(227, 'distribuidor', 'TARNOFSKY MARTIN LEANDRO(TALISMAN)', '1817', '20219512407'),
(228, 'distribuidor', 'TENNEN LUIS SEGUNDO(ARTEC)', '1823', '20113919621'),
(229, 'distribuidor', 'TERUSI JORGE ENRIQUE Y BOCELLI ALFREDO HECTOH', '452', '30625788974'),
(230, 'distribuidor', 'TOLABA EDELMIRO ROLANDO(ELECTRO GAMMA)', '1036', '20263088930'),
(231, 'distribuidor', 'TOMAS JOSE LUIS - SONOTECH', '325', '20224506105'),
(232, 'distribuidor', 'TOMBA GUILLERMO(DA CAPO)', '1303', '20263062311'),
(233, 'distribuidor', 'TOMMARELLO TOMAS(AUDIO TOMMARELLO)', '2041', '20932437466'),
(234, 'distribuidor', 'URIBE CASTAÐON CARLOS ALBERTO- ANGOSTURA SYST', '1055', '20260816722'),
(235, 'distribuidor', 'VARELA FERNANDO Y RAINA RAMIRO SOC.LEY 19550V', '2194', '30715480898'),
(236, 'distribuidor', 'VENTRE VALENTIN- PANACEA INSTRUMENTOS MUSICAL', '1622', '20360362052'),
(237, 'distribuidor', 'VERON JULIO MARCELO-CASA MARTINEZ', '2153', '20214628164'),
(238, 'distribuidor', 'VETRANO MARCELO MARIANO(IMAGENES BAIRES)', '2321', '20177077772'),
(239, 'distribuidor', 'VETRANO OSCAR', '2300', '20170141386'),
(240, 'distribuidor', 'VICARIO S.A.', '410', '30708936916'),
(241, 'distribuidor', 'VIENTOS DEL MUNDO S.R.L', '149', '30713237201'),
(242, 'distribuidor', 'VIERA JORGE EDUARDO(LIBRERIA DEL COLEGIO)', '1253', '20179741343'),
(243, 'distribuidor', 'VILLACORTA CRISTIAN FABIAN', '337', '20300720421'),
(244, 'distribuidor', 'VISCIGLIO CARLOS A. Y HERNAN S.H', '1832', '30712423168'),
(245, 'distribuidor', 'VIVANI CECILIA', '1604', '27237880108'),
(246, 'minorista', 'WIURNOS EZEQUIEL(BERNALMUSIC STORE)', '2240', '20277551188'),
(247, 'distribuidor', 'YOSSEN MARTA MERCEDES - FERIA MUSICAL', '966', '27113343260'),
(248, 'minorista', 'ZAPATA CARLOS ALBERTO(LA PAZ)', '2224', '20077874861'),
(249, 'distribuidor', 'ZUBILLAGA OMAR DARIO', '2192', '20290371687'),
(250, 'distribuidor', 'Matias de volver', 'matias', '36110495'),
(251, 'distribuidor', 'Alejandro', 'alejandro', '22818975'),
(252, 'distribuidor', 'Kevin', 'kevin', '39963214'),
(255, 'distribuidor', 'PATANE CLAUDIO', '743', '20226714651'),
(254, 'distribuidor', 'Lucas', 'lucas', '33798312'),
(256, 'distribuidor', 'LOPEZ RAUL RICARDO(UMMAGUMMA MUSICA)', '2340', '23312822849'),
(257, 'distribuidor', 'JOHN & PAUL SRL', '1610', '30709569836'),
(258, 'distribuidor', 'DELLEDONNE MARIANO ANDRES ( LA VIOLA)     ', '1626', '20309585004'),
(259, 'distribuidor', 'SUCESION DE SCHWAB MIGUEL ANGEL        ', '763', '20123639554'),
(260, 'distribuidor', 'TOMASSINI ALBERTO CESAR(PIANOLANDIA)', '701', '20073715602'),
(261, 'distribuidor', 'COWES DIEGO', '2246', '20239236708'),
(262, 'distribuidor', '  ORLANDO ANDRES SEBASTIAN(HEY JUDE)          ', '1042', '20256250021'),
(263, 'distribuidor', 'HERRERA ERICA ELIANA', '405', '27257004177');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_contenido`
--

CREATE TABLE IF NOT EXISTS `home_contenido` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `foto1` varchar(300) NOT NULL,
  `foto2` varchar(300) NOT NULL,
  `foto3` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `home_contenido`
--

INSERT INTO `home_contenido` (`id`, `foto1`, `foto2`, `foto3`) VALUES
(1, '16_501477home.jpg', '17_37216home.jpg', '12_01598home.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listados`
--

CREATE TABLE IF NOT EXISTS `listados` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `precios_m` varchar(1000) NOT NULL,
  `precios_d` varchar(21000) NOT NULL,
  `catalogo_m` varchar(1000) NOT NULL,
  `catalogo_d` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `listados`
--

INSERT INTO `listados` (`id`, `precios_m`, `precios_d`, `catalogo_m`, `catalogo_d`) VALUES
(1, '12_23_2314082018 HMG LPM AGOSTO.xlsx', '12_23_0414082018 HMG LISTA DE PRECIOS AGOSTO.xls', '05_12_25home.jpg', '05_12_25home.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(1000) NOT NULL,
  `foto` varchar(300) NOT NULL,
  `recordListingID` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `descripcion`, `foto`, `recordListingID`) VALUES
(2, 'Sigue liderando el mercado, siendo sinónimo de tradición y calidad, son las cuerdas más vendidas en Argentina y países limítrofes. Acorde al paso del tiempo Mugica Hnos. S.A sigue creciendo, incorporando tecnología, seleccionando materias primas, e investigando para conseguir los mejores estándares de calidad.', '14_49331marca.jpg', 16),
(29, 'Los platillos de la prestigiosa marca Bosphorus Cymbals son reconocidos en todo el mundo por su calidad y sonido. Hechos en Turquía por 3 maestros artesanos estos exclusivos platillos son hechos a mano, torneados y martillados a la perfección.  ', '17_251822marca.jpg', 9),
(28, 'Contamos con la prestigiosa marca de micrófonos, amplificadores y auriculares Superlux.\r\nReconocida a nivel mundial por el cuidado del producto desde el comienzo hasta el final de su elaboración.', '11_55577marca.png', 4),
(26, 'Contamos con la prestigiosa marca THONET & VANDER en nuestra linea de productos. Sistemas de audio con diseño de vanguardia, ingeniería Alemana, mínima distorsión a máximo volumen.', '14_152571marca.jpg', 13),
(5, 'La fábrica de instrumentos de percusión MVT es conocida por brindar sonidos delicados y sensibles junto a instrumentos de gran calidad deseados por todos los percusionistas.', '14_501733marca.jpg', 15),
(6, 'Innovación tecnológica, materiales de alta calidad y continuo desarrollo ha hecho de esta empresa crecer y expandirse en el mercado de cuerdas para instrumentos eléctricos y electroacústicos de todos los estilos musicales', '14_551402producto.jpg', 14),
(24, 'Contamos con la prestigiosa marca de acordeones Paolo Soprani, fundada en 1864, la misma tuvo sus primeros logros en la provincia de Ancona, Italia, la cual poco a poco se expandió, hasta ser reconocida en todo el mundo.', '12_431049marca.jpg', 10),
(23, 'Los productos On-Stage se utilizan todos los días en los estudios, salas de exposición y en los escenarios de todo el mundo. Con los años la marca a crecido hasta incluir más de 300 productos en 8 categorías diferentes. En cada categoría On-Stage Stands se ha convertido en un líder, tanto profesionales y aficionados de todo el mundo confían plenamente en la marca.', '14_452910marca.jpg', 5),
(13, 'La nueva línea de Guitarras Luis Basilio están realizadas por expertos Luthiers, con sumo cuidado y dedicación. Las mismas están fabricadas íntegramente en Argentina. Cubren una amplia gama de modelos: Guitarras clásicas, acústicas como también bajos. \r\nToda su línea ha sido creada para hacer llegar a nuestros clientes la mejor relación de precio y calidad.', '12_221103producto.jpg', 12),
(31, 'Es una empresa iniciada por músicos para músicos.\r\nTodos los productos MAKAI se fabrican por expertos Luthiers que entienden que la fabricación de instrumentos es un arte.', '14_571651marca.png', 7),
(16, 'Harmony Music Group S.A importa y garantiza esta amplia gama de instrumentos y accesorios de gran aceptación entre nuestros clientes y el mercado argentino.', '14_511188marca.jpg', 8),
(20, 'Somos representantes exclusivos en Argentina de la prestigiosa marca de Guitarras Silvertone, conocida por sus clásicos modelos de aquellas épocas doradas, que hoy en día son los elegidos de muchos artistas.', '13_291696marca.jpg', 11),
(21, 'Somos distribuidores exclusivos de la prestigiosa marca Kyser, reconocida a nivel mundial por la fabricación de capos, y accesorios para el cuidado de las guitarras. Diseño, calidad y prestigio, caracterizan a la marca.', '15_041086marca.jpg', 6),
(18, 'Electro-Harmonix fue fundada por Mike Matthews en octubre de 1968 en nueva York, EE.UU. Ofrece un amplia gama de pedales capaces de crear diferentes tipos de manipulación de sonido adecuado para las señales de guitarra, bajo, voz y teclado, así como otros instrumentos. Una empresa que fabrica los mejores pedales de efectos de la historia del rock y otros.', '14_511863marca.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_home`
--

CREATE TABLE IF NOT EXISTS `marcas_home` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(300) NOT NULL,
  `recordListingID` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Volcado de datos para la tabla `marcas_home`
--

INSERT INTO `marcas_home` (`id`, `foto`, `recordListingID`) VALUES
(79, '15_371340marca.png', 0),
(96, '15_471664marca.png', 0),
(90, '15_471657marca.png', 0),
(89, '15_472049marca.png', 0),
(92, '15_472588marca.png', 0),
(95, '15_472706marca.png', 0),
(94, '15_471715marca.png', 0),
(97, '15_522876marca.png', 0),
(85, '15_47876marca.png', 0),
(82, '15_461141marca.png', 0),
(84, '15_471860marca.png', 0),
(93, '15_471556marca.png', 0),
(91, '15_472188marca.png', 0),
(88, '15_472260marca.png', 0),
(87, '15_471817marca.png', 0),
(83, '15_46233marca.png', 0),
(81, '15_46106marca.png', 0),
(80, '15_462014marca.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` int(10) NOT NULL,
  `subcategoria` int(10) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `foto` varchar(300) NOT NULL,
  `destacado` varchar(10) NOT NULL,
  `recordListingID` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=257 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria`, `subcategoria`, `titulo`, `descripcion`, `foto`, `destacado`, `recordListingID`) VALUES
(112, 2, 31, 'MATRIX Afinador / Metrónomo GT555B cromático', 'Código: 110006\r\nAfinador / Metrónomo GT555B cromático. \r\nPara guitarra, bajo, violín y ukelele\r\ncon micrófono y soporte.\r\nOrigen: China.', '13_431545producto.jpg', 'no', 89),
(40, 1, 26, 'MULLER ACORDEON de 2 Bajos', 'Código: 10751  \r\nAcordeón de 2 bajos, para niño\r\n7 Tonos, color\r\nOrigen: China     \r\n      ', '15_09136producto.jpg', 'no', 60),
(47, 9, 18, 'MATRIX Teclado MK 939', 'Código: 20103   \r\n61teclas / 136 tonos / 128 ritmos / 8 percusión / sensitivo / Midi y Pitch.\r\nColor: Gris\r\n    ', '14_59782producto.png', 'no', 61),
(12, 17, 7, 'CAPO ABIERTO', 'Código: 200021\r\nCapo abierto para clasica PRO/AM \r\nOrigen: EEUU\r\n', '13_001299producto.jpg', 'no', 62),
(13, 17, 7, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para clasica 12 CUERDAS color BLACK. \r\nCod. 200026', '13_041570producto.jpg', 'no', 63),
(14, 17, 7, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para clasica color BLACK\r\nCod. 200022', '13_171589producto.jpg', 'no', 64),
(15, 17, 7, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para clasica color GOLD\r\nCod. 200023', '13_18326producto.jpg', 'no', 65),
(16, 17, 7, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para clasica color PURE WHITE\r\nCod. 200025', '13_20826producto.jpg', 'no', 66),
(17, 17, 7, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para clasica color SILVER\r\nCod.200024', '13_212844producto.jpg', 'no', 67),
(18, 17, 11, 'HUMIFICADOR', 'Código: 200028\r\nHumidificador para clásica.\r\nPreserva las condiciones de la madera\r\nMantiene las condiciones de humedad adecuada\r\nOrigen: EEUU', '13_251909producto.jpg', 'no', 68),
(19, 17, 11, 'KYSER KIT de limpieza x 18 unidades.', 'Código: 200029\r\nKIT de limpieza x 18 unidades.\r\nSurtido limpiador de diapasón, trastes y cuerdas. \r\n6 unidades de cada uno\r\nOrigen: EEUU\r\n', '13_282240producto.jpg', 'no', 72),
(20, 17, 11, 'KYSER Limpiador de cuerdas KDS100', 'Código: 200034\r\nLimpiador de cuerdas KDS100\r\nOrigen: EEUU', '14_17203producto.jpg', 'no', 69),
(21, 17, 11, 'KYSER Limpiador de diaspason KDS500 POLISH', 'Código: 200035\r\nLimpiador de diaspason KDS50\r\nOrigen: EEUU\r\n', '14_251515producto.jpg', 'no', 70),
(22, 17, 11, 'KYSER Limpiador de traste KDS800 LEM - OIL', 'Código: 200036\r\nLimpiador de traste KDS800 LEM - OIL\r\nOrigen: EEUU\r\n', '14_181676producto.jpg', 'no', 71),
(23, 17, 9, 'CAPO ABIERTO', 'KYSER capo abierto para acustica PRO/AM\r\nCod. 200020', '14_272914producto.jpg', 'no', 74),
(24, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acústica color BLACK\r\nCod. 200010', '14_302799producto.jpg', 'no', 75),
(25, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color BLACK CHROME\r\nCod. 200011', '14_322565producto.jpg', 'no', 76),
(26, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color BLUE\r\nCod. 200015', '14_32782producto.jpg', 'no', 77),
(27, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color CAMO\r\nCod. 200019', '14_33388producto.jpg', 'no', 78),
(28, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color FREEDOM\r\nCod. 200018', '14_332472producto.jpg', 'no', 79),
(29, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color GOLD\r\nCod. 200012', '14_34152producto.jpg', 'no', 80),
(30, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color ORANGE BLAZE\r\nCod. 200017', '14_351122producto.jpg', 'no', 81),
(31, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color SILVER\r\nCod. 200013', '14_48696producto.jpg', 'no', 82),
(32, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color SILVER VEIN\r\nCod. 200014', '14_491328producto.jpg', 'no', 83),
(33, 17, 9, 'CAPO TIPO PINZA', 'KYSER capo tipo pinza para acustica color WHITE\r\nCod. 200016', '14_502969producto.jpg', 'no', 84),
(34, 17, 9, 'KYSER humidificador para acustica KLHAA', 'Código: 200027\r\nHumidificador para acústica\r\nPreserva las condiciones de la madera\r\nMantiene las condiciones de humedad adecuada\r\nOrigen: EEUU \r\n', '14_511482producto.jpg', 'no', 85),
(36, 2, 10, 'MATRIX AFINADOR GT-12B', 'Código: 110005\r\nAfinador cromático para guitarra, bajo, violín y ukelele\r\nTipo pinza\r\nGira 360º\r\nOrigen: China\r\n', '13_042816producto.jpg', 'no', 86),
(37, 2, 10, 'MATRIX AFINADOR GT-10B', 'Código: 124001\r\nAfinador cromático para guitarra, bajo, violín, instrumentos de viento y ukelele\r\nTipo pinza\r\nGira 180º y 360º,\r\nOrigen: China\r\n', '13_081115producto.jpg', 'no', 87),
(38, 2, 10, 'CHERRY AFINADOR Y TRANSPORTE', 'Código: 123000\r\nAfinador cromático y transporte todo en uno\r\nTipo pinza\r\nCabezal giratorio 360°\r\nOrigen: China\r\n', '14_45639producto.jpg', 'no', 88),
(39, 17, 11, 'KYSER KIT de limpieza x 3 unidades.', 'Código: 200067\r\nKIT de limpieza x 3 unidades.\r\nLimpiador de diapasón, trastes y cuerdas. Uno de cada uno\r\nIncluye paños.\r\nOrigen: EEUU\r\n', '13_502429producto.jpg', 'no', 73),
(41, 18, 1, 'Matrix Equalizador GE33', 'MATRIX Equalizador GE33, 4 bandas, con afinador, salida cannon y plug.\r\nPara criolla: cod.: 110025\r\nPara acústica: cod.: 110024\r\n ', '12_011211producto.jpg', 'no', 93),
(42, 18, 1, 'Matrix Equalizador GE32', 'MATRIX Equalizador GE32, 4 bandas, mas volumen deslizable, c/afinador y metrónomo.\r\nPara criolla: cod.:110027   \r\nPara acústica: cod.: 110026  ', '12_111985producto.jpg', 'no', 94),
(43, 18, 1, 'Matrix Equalizador GE35', 'MATRIX Equalizador GE35, 4 bandas, importado.       \r\nPara criolla: cod.: 110021        \r\nPara acústica: cod.: 110020         ', '12_17921producto.jpg', 'no', 95),
(44, 18, 1, 'Matrix Equalizador GE36', 'MATRIX Equalizador GE36, 4 bandas, curvo, importado.          \r\nPara criolla: cod.: 110023\r\nPara acústica: cod.: acústica.: 110022        ', '12_222861producto.jpg', 'no', 96),
(109, 2, 31, 'JOYO Metrónomo JM69 piramidal,plástico.', 'Código: 110009\r\nMetrónomo JM69 piramidal, plástico, color, con péndulo.\r\nOrigen: China.\r\n', '13_261636producto.jpg', 'no', 91),
(67, 22, 21, 'THONET & VANDER Hoch 2.0 Bluetooth', 'Código: 200092   \r\nHoch 2.0 BLUETOOTH + C/Remoto 70 w  \r\nAlta Voz 2.0\r\nPotencia de salida: 70W RMS (35W + 35W)\r\nEntrada: BLUETOOTH® 4.0 / 3.5MM STEREO / RCA STEREO\r\nMATERIAL:  MADERA HDAA? \r\nTAMAÑO:  460 x 181 x 230 mm', '15_05262producto.jpg', 'no', 97),
(48, 19, 12, 'SWAN Armónica Blusera', 'SWAN Armónica Blusera, cuerpo ABS, en caja, afinación A/B/C/D/E/F/G.  \r\nCod.: 12600          ', '14_14211producto.jpg', 'no', 98),
(49, 19, 12, 'SWAN Armónica Blusera', 'SWAN Armónica Blusera, cuerpo ABS, caja plástica, afinación A/B/C/D/E/F/G.    \r\nCod.: 12601  \r\n', '14_151582producto.jpg', 'no', 99),
(50, 19, 12, 'SWAN Armónica Blusera', 'SWAN Armónica Blusera, cuerpo ABS, caja plástica, VINTAGE, A/B/C/D/E/F/G.       \r\nCod.: 12602', '14_17133producto.jpg', 'no', 100),
(51, 19, 14, 'SWAN Armónica 48 voces', 'SWAN Armónica 48 voces, cuerpo ABS, en caja, afinación \\\\\\"C\\\\\\".        \r\nCod.: 12604             ', '14_182902producto.jpg', 'no', 101),
(52, 19, 12, 'SWAN Armónicas KIT', 'SWAN KIT Armónica 12 unidades/tonos, estuche rígido forrado.      \r\nCod.: 12605              ', '14_202887producto.jpg', 'no', 102),
(53, 19, 12, 'SWAN Armónicas KIT', 'SWAN KIT Armónica 12 unidades/tonos, ORO, estuche rígido forrado.   \r\nCod.: 12606            ', '14_202127producto.jpg', 'no', 103),
(54, 19, 13, 'SWAN Armónica Cromática', 'SWAN Armónica Cromática 64 voces, cuerpo ABS, con estuche, afinación C.\r\nCod.: 12607  ', '14_211520producto.jpg', 'no', 104),
(63, 9, 18, 'MATRIX Teclado LV 50', 'Código: 20102\r\n54 teclas medianas / 16 tonos / 8 Ritmos / 8 Melodías \r\nCon Micrófono\r\nColor : Negro', '13_362591producto.png', 'no', 105),
(64, 9, 18, 'MATRIX Teclado LV 200USB ', 'Código: 20104\r\n61 Teclas / Teclas largas símil piano (144 mm) /  Sensitivo (Touch) / Puerto USB Flash Disk Jak / Función aprender en tres pasos / Pitch Bend y Vibrato / 10 Canciones / 128 Ritmos / 200 Timbres\r\nEntrada de audio para conectar teléfonos y otros dispositivos\r\nColor Negro', '15_291955producto.jpg', 'no', 106),
(68, 22, 22, 'THONET & VANDER Ratsel 2.1+1', 'Código: 200093\r\nRatsel 2.1+1 BLUETOOTH + C/Remoto 72w.\r\nSISTEMA DE SONIDO ENVOLVENTE\r\nPOTENCIA DE SALIDA: 72W RMS (32W + 20W x 2)\r\nEntrada: RCA ESTÉREO / BLUETOOTH® con NFC® / RCA ESTÉREO / 3.5mm stereo\r\nMATERIAL: MADERA HDAA? \r\nMEDIDAS: SUBWOOFER: 253 x 100 x 111 mm / SATELITE: 210 x 70 x 200 mm', '15_171731producto.jpg', 'no', 107),
(74, 22, 22, 'THONET & VANDER Grub 2.1 ', 'Código: 200100\r\nGrub 2.1 48w   /  SISTEMA DE SONIDO ESTÉREO\r\nPOTENCIA DE SALIDA: 48W RMS (20W + 14W x 2)\r\nENTRADA: RCA ESTÉREO / RCA ESTÉREO / 3.5MM ESTÉREO\r\nSALIDA: 3.5MM ESTÉREO \r\nCONTROL: VOLUMEN, AGUDO Y BAJOS \r\nMATERIAL: MADERA HDAA?\r\nMEDIDAS: SUBWOOFER: 185 x 325 x 270 mm / SATELITE: 185 x 135 x 105 mm', '16_26933producto.jpg', 'no', 108),
(73, 22, 25, 'THONET & VANDER FLUG BT', 'Código: 200094\r\nRECEPTOR BLUETOOTH\r\nDISTANCIA DE TRANSMISIÓN: 32X (mas de 10m.)\r\nDIMENSIONES: 24 x 72 x 64 mm\r\nCONTROLES: Botón de encendido / Botón de emparejamiento\r\nPOTENCIA ELÉCTRICA: 5V', '16_15121producto.jpg', 'no', 109),
(75, 22, 21, 'THONET & VANDER Koloss 2.0 BLUETOOTH ', 'Código: 200102\r\nKoloss 2.0 BLUETOOTH + C/ Remoto 160w\r\nALTAVOZ 2.0 \r\nPOTENCIA DE SALIDA: 160W RMS (80W + 80W)\r\nCONTROLES:  VOLUMEN, BAJOS, Y AGUDOS / CONTROL REMOTO\r\nENTRADA: BLUETOOTH® 4.0 / 3.5MM STEREO / ÓPTICA (SPDIF)\r\nCAJA ACÚSTICA / MATERIAL: MADERA HDAA?\r\nTAMAÑO: 555 x 225 x 225 mm', '16_371914producto.jpg', 'no', 110),
(76, 22, 21, 'THONET & VANDER Kugel 2.0 BLUETOOTH ', 'Código: 200097\r\nKugel 2.0 BLUETOOTH  / ALTAVOZ 2.0\r\nPOTENCIA DE SALIDA: 140W RMS (70W + 70W)\r\nCONTROLES: VOLUMEN, AGUDOS, Y BAJOS / CONTROL REMOTO\r\nENTRADA: BLUETOOTH® 4.0 / 3.5MM STEREO / ÓPTICA (SPDIF)\r\nMATERIAL: MADERA HDAA?\r\nTAMAÑO: 355 x 222 x 239 mm', '16_42553producto.jpg', 'no', 111),
(77, 22, 21, 'THONET & VANDER Kurbis 2.0 BLUETOOTH 60w.', 'Código: 200091\r\nKurbis 2.0 BLUETOOTH 60w.  / ALTAVOZ 2.0 / Transforma cualquier habitación en un estudio semi profesional\r\nPOTENCIA DE SALIDA: 60W RMS (30W + 30W)\r\nCONTROLES: VOLUMEN, AGUDOS, Y BAJOS \r\nENTRADA: BLUETOOTH® 4.0 / 3.5MM STEREO / RCA STEREO\r\nMATERIAL: MADERA HDAA?\r\nTAMAÑO: 276 x 181 x 222 mm', '16_562062producto.jpg', 'no', 112),
(78, 22, 22, 'THONET & VANDER Laut 2.1 60w', 'Código: 200106\r\nLaut 2.1 60w \r\nSISTEMA ESTÉREO BLUETOOTH / Viví una experiencia en sonido sin límites\r\nPOTENCIA DE SALIDA: 68W RMS (32W + 18W x 2)\r\nENTRADA: RCA ESTÉREO\r\nCONTROL: VOLUMEN, AGUDO Y BAJOS MATERIAL: MADERA HDAA?\r\nMEDIDAS: SUBWOOFER: 253 x 253 x 365 mm / SATELITE: 100 x 160 x 100 mm', '17_061818producto.jpg', 'no', 113),
(79, 22, 21, 'THONET & VANDER Riss 2.1 32w', 'Código: 200104\r\nRiss 2.1 32w ALTAVOZ DE PC / El equilibrio entre forma y funcionalidad\r\nPOTENCIA DE SALIDA: 32W RMS (14W + 9W x 2)\r\nCONTROL: VOLUMEN, BAJOS Y AGUDOS \r\nENTRADA: RCA ESTÉREO\r\nMATERIAL: MADERA HDAA?\r\nMEDIDAS: SUBWOOFER: 205 x 300 x 205 mm / SATELITE: 85 x 85 x 85 mm\r\n\r\n', '17_17885producto.jpg', 'no', 114),
(80, 22, 22, 'THONET & VANDER Spiel 2.1', 'Código: 200103\r\nSpiel 2.1 16w. ALTAVOZ PARA ORDENADOR  / Gran claridad y potencia\r\nPOTENCIA DE SALIDA: 16W RMS (8W + 4W x 2)\r\nCONTROL: VOLUMEN \r\nENTRADA: 3.5mm estéreo\r\nMATERIAL: MADERA HDAA?\r\nMEDIDAS: SUBWOOFER: 200 x 150 x 215 mm  /  SATELITE: 115 x 78 x 105 mm\r\n\r\n', '17_232792producto.jpg', 'no', 115),
(81, 22, 22, 'THONET & VANDER Stil 2.1', 'Código: 200105\r\nStil 2.1 40w  /  SISTEMA ESTÉREO  /  Excelente rendimiento\r\nPOTENCIA DE SALIDA: 40W (20W + 10W x 2)\r\nCONTROL: VOLUMEN, AGUDO Y BAJOS \r\nENTRADA:  RCA ESTÉREO  / RCA ESTÉREO  /  3.5mm stereo\r\nMATERIAL: MADERA HDAA?\r\nMEDIDAS:  SUBWOOFER: 159 x 299 x 232 mm  /  SATELITE: 135 x 135 x 135 mm\r\n\r\n\r\n', '17_32977producto.jpg', 'no', 116),
(82, 22, 23, '200099	THONET & VANDER SW10 - SUBWOOFER 100w', 'Código: 200099\r\nSW10 - SUBWOOFER 100w  /  La combinación perfecta para tu equipo profesional\r\nPOTENCIA DE SALIDA: 100W RMS\r\nCONTROL:  Gain  /  FRECUENCIA\r\nENTRADA: RCA STEREO  /  CABLE DE ALTAVOZ\r\nMATERIAL: MADERA HDAA?\r\nTAMAÑO: 330 x 300 x 372 mm', '17_37165producto.jpg', 'no', 117),
(83, 22, 21, 'THONET & VANDER Vertrag 2.0', 'Código: 200095\r\nVertrag 2.0 32w  /  ALTAVOZ 2.0  /  Alto rendimiento y respuesta\r\nPOTENCIA DE SALIDA: 32W RMS (16W + 16W)\r\nCONTROL: VOLUMEN, AGUDOS, Y BAJOS \r\nENTRADA: RCA STEREO\r\nMATERIAL: MADERA HDAA?\r\nTAMAÑO: 161 x 190 x 240 mm', '17_44111producto.jpg', 'no', 118),
(84, 22, 1, 'THONET & VANDER Titan 2.0 BLUETOOTH ', 'Código: 200098\r\nTitan 2.0 BLUETOOTH + C/Remoto 180w \r\nPOTENCIA DE SALIDA: 180 W  RMS ( 90 + 90)\r\nCONTROL: VOLUMEN, GRAVES Y AGUDOS\r\nMATERIAL: MADERA HDAA\r\nTAMAÑO: 400 x 300 x 300 mm\r\n', '17_5547producto.jpg', 'no', 119),
(86, 1, 15, 'PAOLO SOPRANI Acordeon Studio  072 ', 'Código: 13503\r\nAcordeón Studio  072   -  34-72 3/4 5+2\r\nOrigen: ITALIA\r\n', '18_581865producto.jpg', 'no', 120),
(87, 1, 15, 'PAOLO SOPRANI Acordeon Studio  096/4 A MUSETTE', 'Código: 13505\r\nAcordeón Studio  096/4 A MUSETTE\r\nOrigen: ITALIA\r\n', '13_19512producto.jpg', 'no', 121),
(88, 1, 15, 'PAOLO SOPRANI Acordeon Studio  120', 'Código: 13502\r\nAcordeon Studio  120\r\nOrigen: ITALIA\r\n', '13_19633producto.jpg', 'no', 122),
(89, 20, 16, 'LUIS BASILIO Guitarra Clasica Modelo LB10 ', 'Código: 3300\r\nGuitarra Clásica Modelo LB10 de estudio\r\nTamaño normal 4/4\r\nTapa: Símil pino color natural\r\nAros y fondo color\r\nOrigen: Argentina\r\n\r\n', '21_341533producto.jpg', 'no', 123),
(90, 20, 16, 'LUIS BASILIO Guitarra Clasica Modelo LB14 de Estudio superior, tamaño normal.', 'Código: 3302	\r\nGuitarra Clasica Modelo LB14 Estudio superior,\r\nTamaño normal 4/4 \r\nTapa: Símil Pino, color natural\r\nAros y Fondo: de Abedul color natural, con doble cenefa negra \r\nOrigen: Argentina\r\n', '21_162928producto.jpg', 'no', 125),
(91, 20, 16, 'LUIS BASILIO Guitarra Clasica Modelo LB10C ', 'Código: 3301\r\nGuitarra Clásica Modelo LB10C de Estudio color.\r\nTamaño normal 4/4\r\nTapa; Pino color\r\nAros y fondo: Pino color\r\nOrigen: Argentina\r\n', '21_452090producto.jpg', 'no', 124),
(93, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Avalon 700,sin corte.', 'Código: 773	\r\nGuitarra Acústica, tipo Avalon 700, sin corte, \r\nTapa: Laminada\r\nOrigen: Argentina', '22_19812producto.jpg', 'no', 45),
(94, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Avalon 708,con corte.', 'Código: 774	\r\nGuitarra Acústica, tipo Avalon 708, con corte. \r\nTapa: Laminada\r\nOrigen: Argentina', '22_262569producto.jpg', 'no', 46),
(122, 24, 33, 'SANTO ANGELO Cable KILLSWITCH GUITAR', 'Código: 12074 Cable de 3,05 metros.\r\nCódigo: 12075 Cable de 6,10 metros.\r\nSANTO ANGELO Cable KILLSWITCH GUITAR\r\nPlugs niquelados e inyectados con capa polímera plástica. Con sistema MUTE\r\nPara Instrumentos (Guit. Eléctrica)\r\nOrigen: BRASIL', '16_091547producto.jpg', 'no', 40),
(92, 20, 16, 'LUIS BASILIO Guitarra Clasica Modelo LB50 con corte y Ecualizador', 'Código: 3309	\r\nGuitarra Clásica Modelo LB50 con corte y Ecualizador \r\nTamaño normal 4/4\r\nTapa: Símil pino color natural\r\nAros y fondo: de color nogal con doble cenefa negra\r\nOrigen: Argentina\r\n', '21_592496producto.jpg', 'no', 126),
(95, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Jumbo 720, con corte.', 'Código: 775	\r\nGuitarra Acústica, tipo Jumbo 720,con corte\r\nTapa de pino araucaria\r\nOrigen: Argentina\r\n', '22_311482producto.jpg', 'no', 47),
(96, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Jumbo 725, sin corte.', 'Código: 776\r\nGuitarra Acústica, tipo Jumbo 725, sin corte.\r\nTapa de pino araucaria\r\nOrigen: Argentina\r\n', '22_342281producto.jpg', 'no', 48),
(97, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Martin 707', 'Código: 777	\r\nGuitarra Acústica, tipo Martin 707, Sin corte.\r\nOrigen: Argentina\r\n', '22_392884producto.jpg', 'no', 49),
(98, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Martin 707', 'Código: 778\r\nGuitarra Acústica, tipo Martin 707, Con corte.\r\nOrigen: Argentina\r\n', '22_421990producto.jpg', 'no', 50),
(99, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Avalon 700 con Ecualizador', 'Código: 779\r\nGuitarra Acústica, tipo Avalon 700 con Ecualizador, sin corte.\r\nTapa: Laminada \r\nOrigen: Argentina\r\n', '17_03284producto.png', 'no', 51),
(100, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Avalon 708 con Ecualizador', 'Código: 780\r\nGuitarra Acústica, tipo Avalon 708 con Ecualizador, con corte.\r\nTapa: Laminada\r\nOrigen: Argentina', '17_081087producto.png', 'no', 52),
(101, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Jumbo 720con Ecualizador, con corte.', 'Código: 781\r\nGuitarra Acústica, tipo Jumbo 720 con Ecualizador, con corte.\r\nTapa: Pino araucaria\r\nOrigen: Argentina\r\n', '17_232110producto.png', 'no', 53),
(102, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Jumbo 725 con Ecualizador.', 'Código: 782\r\nGuitarra Acústica, tipo Jumbo 725 con Ecualizador, sin corte.\r\nTapa: Pino araucaria\r\nOrigen: Argentina\r\n', '17_242068producto.png', 'no', 54),
(103, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Martin 707 con Ecualizador', 'Código: 783\r\nGuitarra Acústica, tipo Martin 707 con Ecualizador, sin corte.\r\nTapa:\r\nOrigen: Argentina\r\n', '17_391327producto.png', 'no', 55),
(104, 20, 17, 'LUIS BASILIO Guitarra acustica, tipo Martin 707 con Ecualizador, Con corte.', 'Código: 784\r\nGuitarra Acústica, tipo Martin 707 con Ecualizador, con corte.\r\nOrigen: Argentina\r\n', '17_41320producto.png', 'no', 56),
(105, 23, 27, 'LUIS BASILIO Bajo Acustico ', 'Código: 754\r\nBajo Acústico con ecualizador de 4 bandas\r\nTapa:\r\nOrigen: Argentina\r\n', '23_032905producto.jpg', 'no', 57),
(106, 23, 27, 'LUIS BASILIO Bajo Acustico MANGO FILETEADO ', 'Código: 755\r\nBajo Acústico MANGO FILETEADO con ecualizador de 4 bandas.\r\nOrigen: Argentina\r\n', '16_331185producto.png', 'no', 58),
(107, 23, 29, 'LUIS BASILIO Bajo tipo Violín 4 cuerdas.', 'Código: 766\r\nBajo tipo Violín 4 cuerdas, 2 micrófonos, especiales.\r\nPuente de madera\r\nOrigen: Argentina\r\n', '23_152752producto.jpg', 'no', 59),
(108, 20, 30, 'SILVERTONE Guitarra electrica Black 1303U2 BK  /  SILVERTONE Guitarra electrica Silverburst 1303U2 SVB', 'Código: 200040  Guitarra eléctrica Black 1303U2 BK\r\nCódigo: 200041  Guitarra eléctrica Silverburst 1303U2 SVB\r\nCuerpo: Macizo\r\nDiapasón: Palisandro color caoba - Incrustaciones de nácar en punto\r\nTrastes: 21 de Alpaca', '16_132156producto.jpg', 'no', 127),
(110, 2, 31, 'JOYO Metrónomo JM69W piramidal, plástico.', 'Código: 110010\r\nMetrónomo JM69W piramidal, plástico, color símil madera, con péndulo.\r\nOrigen: China', '13_291596producto.jpg', 'no', 92),
(111, 2, 31, 'JOYO Drum Pad JMD5 con Metrónomo.', 'Código: 110008\r\nDrum Pad JMD5, es un Pad de práctica para bateristas.\r\nMetrónomo incorporado.\r\nEntrada para auricular.\r\nSuperficie golpeadora con sensor para conteo de golpes.\r\nPantalla de leds retro iluminada.\r\nOrigen: China.', '13_361595producto.jpg', 'no', 90),
(121, 24, 33, 'SANTO ANGELO - CABLES', '', '16_03982producto.jpg', 'si', 34),
(114, 24, 33, 'SANTO ANGELO Cable ANGELS NI, plugs metálicos', 'Código: 12001 de 3,05 metros,\r\nCódigo: 12002 de 6,10 metros,\r\nCódigo: 12034 de 9,15 metros,\r\nCable ANGELS NI,  plug / plug metálicos\r\nPara instrumentos\r\nOrigen: BRASIL', '15_152856producto.jpg', 'no', 35),
(115, 24, 33, 'SANTO ANGELO Cable ANGELS TX plug metálico forrado, textil.', 'Código: 12060 Cable de 3.05 metros\r\nCódigo: 12061 Cable de 6.10 metros \r\nCable ANGELS TX, revestimiento textil, plugs metálicos.\r\nPara Instrumentos\r\nOrigen: BRASIL\r\n\r\n', '15_28340producto.jpg', 'no', 36),
(116, 24, 34, 'SANTO ANGELO Cable ANGELS LW, Cannon /  Cannon.', 'Código: 12024 Cable de 0.91 metros \r\nCódigo: 12052 Cable de 3.05 metros\r\nCódigo: 12003 Cable de 6,10 metros\r\nCódigo: 12036 Cable de 9,15 metros \r\nCable ANGELS LW,  Cannon /  Cannon inyectados en Zamac\r\nPara micrófonos (Baja impedancia)\r\nOrigen: BRASIL', '15_42127producto.jpg', 'no', 37),
(117, 24, 36, 'SANTO ANGELO Cable EXODUS ', 'Código: 12080 Cable EXODUS 2mts.\r\nCódigo: 12081 Cable EXODUS 3mts.\r\nPara audio paralelo, plugs niquelados y blindados termocontraíbles  \r\nOrigen: BRASIL\r\n', '15_48638producto.jpg', 'no', 38),
(118, 24, 33, 'SANTO ANGELO Cable ICTHUS', 'Código: 12038 Cable de 3.05 metros\r\nCódigo: 12039 Cable de 6.10 metros\r\nSANTO ANGELO Cable ICTHUS\r\nRevestimiento Textil y plugs metálicos, con punta bañada en oro 18K\r\nPara Instrumentos\r\nOrigen: BRASIL', '15_542568producto.jpg', 'no', 39),
(119, 24, 33, 'SANTO ANGELO Cable KILLSWITCH ACOUSTIC', 'Código: 12076 Cable de 3,05 metros.\r\nCódigo: 12077 Cable de 6,10 metros.\r\nCable KILLSWITCH ACOUSTIC, plugs niquelados, inyectados en polímero plástico y madera. Con Mute\r\nPara Instrumento (Guit. Acústica)\r\nOrigen: BRASIL\r\n\r\n', '16_012602producto.jpg', 'no', 41),
(123, 24, 33, 'SANTO ANGELO Cable KILLSWITCH BASS', 'Código: 12078 Cable de 3,05 metros\r\nCódigo: 12079 Cable de 6,10 metros.\r\nSANTO ANGELO Cable KILLSWITCH BASS\r\nPlugs niquelados e inyectados con capa polímera plástica. Con sistema MUTE\r\nPara Instrumento (Bajo)\r\nOrigen: BRASIL', '16_161694producto.jpg', 'no', 42),
(124, 24, 33, 'SANTO ANGELO Cable SHOGUN', 'Código: 12072 Cable de 3.05 metros\r\nCódigo: 12073 Cable de 6.10 metros.\r\nSANTO ANGELO Cable SHOGUN\r\nPlugs bañados en oro 18K e inyectados con doble capa PVC  termocontraíble\r\nPara Instrumentos\r\nOrigen: BRASIL', '16_242186producto.jpg', 'no', 43),
(125, 24, 35, 'SANTO ANGELO Cable CORD B', 'Código: 12018\r\nSANTO ANGELO Cable CORD B, de 0,25 cm, con plugs niquelados e inyectados en PVC.\r\nPara pedal\r\nOrigen: BRASIL', '16_31435producto.jpg', 'no', 44),
(126, 26, 37, 'ON STAGE Soporte de bafle tripode SSP7750', 'Código: 30220\r\nSoporte de bafle, trípode, modelo SSP7750.Con funda\r\nColor: Negro.\r\n', '15_00745producto.jpg', 'no', 32),
(127, 26, 38, 'ON STAGE Soporte de trompeta TRS7301B', 'Código: 30211\r\nSoporte de trompeta\r\nModelo TRS7301B, trípode.\r\nColor: Negro.\r\n', '15_001330producto.jpg', 'no', 33),
(128, 26, 34, 'ON STAGE - SOPORTES', '', '17_07575producto.jpg', 'si', 31),
(129, 26, 39, 'ON STAGE Soporte de guitarra Acustica GS7141', 'Código: 30222\r\nSoporte de guitarra Acústica o eléctrica, Modelo GS7141, trípode, con cuello.\r\n¡Un pequeño soporte con seguridad de tiempo grande! El GS7141 destaca un mecanismo único de primavera que cierra su guitarra en el lugar, con eficacia haciendo el soporte y el instrumento una unidad. \r\nColor Negro\r\n\r\n', '14_351570producto.jpg', 'no', 1),
(130, 26, 39, 'ON STAGE Soporte de guitarra GS7362B', 'Código: 30202\r\nSoporte de guitarra Modelo GS7362B, en V.\r\nEs un soporte robusto que puede sostener una guitarra acústica o eléctrica. \r\nColor: Negro.\r\n', '14_432290producto.jpg', 'no', 2),
(131, 26, 39, 'ON STAGE Soporte de guitarra GS8100', 'Código: 30206	\r\nSoporte de guitarra ya sea Clásica, Acústica o Eléctrica. \r\nModelo GS8100, trípode, con cuello y traba. Sistema PROGRIP. \r\nNuestro ProGrip es un sistema que sostiene su guitarra cerrándose en cuanto  es apoyada en él e impide caerse\r\nColor: Negro\r\n', '14_442903producto.jpg', 'no', 3),
(132, 26, 39, 'ON STAGE Soporte de guitarra GS8200', 'Código: 30200\r\nSoporte de guitarra, Modelo GS8200, trípode con cuello y traba. Sistema PROGRIP2\r\nEl GS8200 combina la seguridad y la conveniencia de un soporte que se autocierra con la facilidad del Colgar \r\nColor: Negro\r\n', '14_45642producto.jpg', 'no', 4),
(133, 26, 39, 'ON STAGE Soporte de guitarra XCG-4', 'Código: 30204\r\nSoporte de guitarra\r\nModelo XCG-4, trípode, con cuello. Perfecto para cualquier guitarra\r\nColor: Negro\r\n', '14_452386producto.jpg', 'no', 5),
(134, 26, 39, 'ON STAGE Soporte de guitarra y bajo GS7465', 'Código: 30203\r\nSoporte de guitarra y bajo, Modelo GS7465, en V con cuello.\r\nEl diseño patentado sostiene guitarras eléctricas, acústicas o bajos. El eje superior anida entre piernas plegables para el almacenaje.\r\nColor: Negro\r\n', '14_451991producto.jpg', 'no', 6),
(135, 26, 39, 'ON STAGE Soporte de guitarra GS7800 ajustable al pie de microfono.', 'Código: 30218\r\nSoporte de Guitarra ajustable al pie de micrófono\r\nModelo GS7800 para colgar guitarra.\r\nColor: Negro\r\n', '14_462990producto.jpg', 'no', 7),
(136, 26, 39, 'ON STAGE Soporte para 6 guitarras GS7652B', 'Código: 30205\r\nSoporte para 6 guitarras\r\nModelo GS7652B, trípode, con cuello.\r\nColor: Cromado\r\n', '14_46545producto.jpg', 'no', 8),
(137, 26, 39, 'ON STAGE Soporte de clasica,acustica y bajo GS6500', 'Código: 30217\r\nSoporte de Guitarras y bajo\r\nModelo GS6500, en V.\r\nColor: Negro\r\n', '14_46277producto.jpg', 'no', 9),
(138, 26, 39, 'ON STAGE Soporte de guitarra Electrtica GS7140', 'Código: 30225\r\nSoporte de guitarra Eléctrica \r\nModelo GS7140, trípode, con resorte ajustable.\r\nColor: Negro\r\n', '14_4772producto.jpg', 'no', 10),
(139, 26, 38, 'ON STAGE Soporte de trompeta DST7600', 'Código: 30214\r\nSoporte de trompeta\r\nModelo DST7600\r\nColor: Negro.\r\n', '14_47332producto.jpg', 'no', 11),
(140, 26, 38, 'ON STAGE Soporte de clarinete DSC7600', 'Código: 30215\r\nSoporte de clarinete\r\nModelo DSC7600.\r\nColor: Negro.\r\n', '14_48666producto.jpg', 'no', 12),
(141, 26, 38, 'ON STAGE Soporte de saxo y flauta SXS7101B', 'Código: 30212	\r\nON STAGE Soporte de saxo y flauta \r\nModelo SXS7101B, trípode.\r\nColor: Negro.\r\n', '14_491852producto.jpg', 'no', 13),
(142, 26, 38, 'ON STAGE Soporte para 2 saxos y 2 flautas SXS7201B', 'Código: 30213\r\nSoporte para 2 saxos y 2 flautas\r\nModelo SXS7201B\r\nColor: Negro.\r\n', '14_49898producto.jpg', 'no', 14),
(143, 26, 40, 'ON STAGE Soporte de microfono MS7201', 'Código: 30216\r\nSoporte de micrófono \r\nModelo MS7201, recto, base redonda maciza.\r\nColor: Blanco.\r\n', '14_552149producto.jpg', 'no', 15),
(144, 26, 40, 'ON STAGE Soporte de microfono MS7625PG', 'Código: 30210\r\nSoporte de micrófono\r\nModelo MS7625PG, recto, base redonda maciza. En un movimiento rápido, solamente empuje abajo y gire el eje un cuarto en el sentido de las agujas del reloj para cerrarse, o empujar abajo y girar un cuarto en sentido contrario a las agujas del reloj para quitar\r\nColor: Negro.\r\n', '14_571141producto.jpg', 'no', 16),
(145, 26, 40, 'ON STAGE Soporte de microfono MS7700B', 'Código: 30208\r\nSoporte de micrófono \r\nModelo MS7700B, recto, trípode.\r\nColor: Negro\r\n', '14_582162producto.jpg', 'no', 17),
(146, 26, 40, 'ON STAGE Soporte de microfono MS7701B', 'Código: 30207\r\nSoporte de micrófono\r\nModelo MS7701B, con boom, trípode, liviano.\r\nColor: Negro\r\n', '14_581189producto.jpg', 'no', 18),
(147, 26, 40, 'ON STAGE Soporte de microfono MS8301', 'Código: 30224\r\nSoporte de micrófono\r\nModelo MS8301, recto con inclinación superior, base trípode.\r\nColor: Negro\r\n', '14_582565producto.jpg', 'no', 19),
(148, 26, 40, 'ON STAGE Soporte de microfono MS8310', 'Código: 30223\r\nSoporte de micrófono\r\nModelo MS8310, recto, con inclinación superior, base redonda.\r\nColor: Negro\r\n', '14_592755producto.jpg', 'no', 20),
(149, 26, 40, 'ON STAGE Soporte de microfono MS9701B', 'Código: 30209\r\nSoporte de micrófono\r\nModelo MS9701B, con boom, trípode, pesado.\r\nColor: Negro\r\n', '14_59859producto.jpg', 'no', 21),
(150, 26, 41, 'ON STAGE Soporte VS7200', 'Código: 30226\r\nSoporte para colgar violín y arco\r\nModelo VS7200, ajustable a cualquier atril de partitura, para colgar Violín y arco.\r\nColor: Negro\r\n', '14_59371producto.jpg', 'no', 22),
(152, 25, 46, 'MAKAI Ukelele baritono BK-55.', 'Código: 90010\r\nUkelele baritono \r\nModelo: BK-55\r\nTapa, aros y fondo caoba\r\nCuerdas GHS.\r\n', '15_121952producto.jpg', 'no', 23),
(153, 25, 45, 'MAKAI Ukelele concierto, CK-55.', 'Código: 90008\r\nUkelele concierto \r\nModelo: CK-55.\r\nTapa, aros y fondo caoba\r\nCuerdas GHS\r\n', '15_092227producto.jpg', 'no', 24),
(154, 25, 43, 'MAKAI Ukelele soprano, LK-80W.', 'Código: 90014\r\nUkelele soprano \r\nModelo: LK-80W.\r\nTapa de cedro maciza\r\nCuerdas Aquila.\r\n', '15_151238producto.jpg', 'no', 29),
(155, 25, 43, 'MAKAI Ukelele soprano, PK-55..', 'Código: 90007\r\nUkelele soprano \r\nModelo: PK-55 (PIÑA)\r\nTapa, aros y fondo caoba.\r\nCuerdas GHS.\r\n', '15_192941producto.jpg', 'no', 28),
(156, 25, 44, 'MAKAI Ukelele tenor, TK-55.', 'Código: 90009\r\nUkelele tenor \r\nModelo: TK-55.\r\nTapa, aros y fondo caoba.\r\nCuerdas GHS.\r\n', '15_21385producto.jpg', 'no', 30),
(157, 25, 45, 'MAKAI Ukelele concierto. SMC-80.', 'Código: 90015\r\nUkelele concierto\r\nModelo:  SMC-80.\r\nTapa, aros y fondo arce.\r\nCuerdas Aquila, \r\n', '15_201958producto.jpg', 'no', 25),
(158, 25, 43, 'MAKAI Ukelele soprano, MK-90.', 'Código: 90016\r\nUkelele soprano\r\nModelo:   MK-90.\r\nTapa, aros y fondo macizo caoba distintos. tonos.\r\n', '15_172511producto.jpg', 'no', 27),
(159, 25, 43, 'MAKAI Ukelele soprano colores varios', 'Código: 90021 Ukelele soprano color amarillo, MK-10YW\r\nCódigo: 90005 Ukelele soprano color azul, MK-10BU.\r\nCódigo: 90001 Ukelele soprano color blanco, MK-10WT.\r\nCódigo: 90022 Ukelele soprano color celeste, MK-10LBU\r\nCódigo: 90023 Ukelele soprano color marron, MK-10BR\r\nCódigo: 90024 Ukelele soprano color naranja, MK-10OR\r\nCódigo: 90000 Ukelele soprano color negro, MK-10BK.\r\nCódigo: 90020 Ukelele soprano color purpura, MK-10PP\r\nCódigo: 90019 Ukelele soprano color rosa oscuro, MK-10SR.\r\nCódigo: 90002 Ukelele soprano color rosa, MK-10PK.\r\nCódigo: 90004 Ukelele soprano color turquesa, MK-10TU.\r\nCódigo: 90003 Ukelele soprano color verde, MK-10GN.', '14_09724producto.jpg', 'no', 26),
(160, 25, 43, 'MAKAI - UKELELES', '', '', 'si', 0),
(161, 17, 9, 'KYSER - ACCESORIOS', '', '15_531104producto.jpg', 'si', 0),
(162, 22, 22, 'THONET & VANDER - Sistemas multimedias', '', '16_001917producto.jpg', 'si', 0),
(163, 20, 30, 'SILVERTONE - GUITARRAS Y BAJOS', '', '16_182021producto.jpg', 'si', 0),
(164, 22, 24, 'HD - 381', 'Auricular Superlux In-Ear Semi Abierto con Adaptador Para Oidos, Incluye Cable de Extension y Clip de Agarre, Prod Importado.\r\nCod.: 200191', '15_512708producto.png', 'no', 0),
(165, 22, 24, 'HD - 330', 'Auricular Superlux Semi Abierto Profesional Con estuche Rígido, Incluye Adaptador de Ficha de 3.5 mm a 6.3 mm. Prod Importado\r\nCod.: 200196', '16_50551producto.png', 'no', 0),
(166, 22, 24, 'HD - 651', 'Auricular Superlux Cerrado Modelo Black, Incluye Funda. Importado.\r\nCod.: 200190', '16_48551producto.png', 'no', 0),
(167, 22, 24, 'HD - 662 ', 'Auricular Superlux Cerrado Profesional, Incluye Funda Y adaptador de Ficha 3.5 mm a 6.3 mm. Importado\r\nCod.: 200194', '17_04239producto.png', 'no', 0),
(168, 22, 24, 'HD - 660', 'Auricular Superlux Cerrado Profesional, Incluye Estuche Rígido y Adaptador de 3.5 mm a 6.3 mm. Importado\r\nCod.: 200192 ', '17_192773producto.png', 'no', 0),
(169, 22, 24, 'HD - 661', 'Auricular Superlux Cerrado Profesional, Incluye Cable De Extensión de 1 a 3 Mts, Funda y Ficha Adaptadora de  3.5 mm a 6.3 mm. Importado\r\nCod.: 200193', '17_32167producto.png', 'no', 0),
(170, 22, 47, 'Micrófono D112', 'Superlux Micrófono Para Armónica Con Cable, Importado.\r\nCod.: 200147', '17_47986producto.png', 'no', 0),
(171, 22, 47, 'Micrófono ECO-A1', 'Superlux Micrófono Dinámico de Mano Con Funda y Pipeta, Importado\r\nCod.: 200139', '17_592287producto.png', 'no', 0),
(172, 22, 47, 'Microfono DM838', 'Superlux Microfono Dinamico Con cable. Importado\r\nCod.: 200140', '18_141075producto.png', 'no', 0),
(173, 22, 47, 'Microfono VT9-6', 'Superlux Micrófono Doble de Mano inalambrico, Incluye Cable. Importado\r\nCod.: 200167', '18_262515producto.png', 'no', 0),
(174, 22, 47, 'Micrófono WH5', 'Superlux Micrófono Dinámico, Clásico de 3 Capsulas de estilo \\\\\\\\\\\\\\''\\\\\\\\\\\\\\''Vintage\\\\\\\\\\\\\\''\\\\\\\\\\\\\\'', Incluye Base y Soporte. Importado\r\nCod.: 200168', '18_30898producto.png', 'no', 0),
(175, 22, 47, 'Micrófono PRO-268B', 'Superlux Micrófono Condenser Aéreo Profesional, Incluye Funda, Pipeta y Protector de Espuma. Importado\r\nCod.: 200171', '18_392521producto.png', 'no', 0),
(176, 22, 47, 'Micrófono CM-H8C', 'Superlux Micrófono de Múltiple patrones polares de Estudio, Incluye estuche Rígido y pipeta. Importado\r\nCod.: 200176', '18_471076producto.png', 'no', 0),
(177, 28, 52, 'Bosphorus Serie Antique', 'Platillos que mezclan la brillantes de los clásicos platillos torneados con el complejo y seco sonido de los platillos sin tornear. Las distintas superficies proveen un gran rango de texturas en el sonido.\r\n\r\nDisponibles en los siguientes Modelos:\r\n\r\nANTIQUE 10 Splash, Thin. Cod: 6822\r\nANTIQUE 14 Hi-Hat, Dark. Cod: 6811\r\nANTIQUE 16 Crash, Thin. Cod: 6812\r\nANTIQUE 18 Crash, Thin. Cod: 6823\r\nANTIQUE 20 Ride, Medium. Cod: 6813\r\n\r\nSet Platillos ANTIQUE 14 Hi Hat, 16 Crash, 20 Ride. Cod: 6832', '16_422366producto.png', 'no', 0),
(178, 28, 52, 'Bosphorus Serie Gold', 'La serie Gold Fusiona la calidez de los Platillos hechos a mano del ¨Viejo Mundo¨ con el poder, Proyección y durabilidad necesaria en los escenarios de Hoy\r\nCada Platillo de la serie Gold esta completamente Martillado a Mano y pulido hasta obtener un acabado Brillante.\r\n\r\nDisponible en los siguientes modelos:\r\n\r\nGOLD de 10, Splash Thin. Cod:6800\r\nGOLD de 14, HiHat Top. Cod:6801\r\nGOLD de 16, Crash Thin. Cod:6802\r\nGOLD de 18, Crash Full. Cod:6803\r\nGOLD de 20, Ride. Cod:6805\r\nGOLD de 22, Ride. Cod:6821\r\nSet Platillos GOLD de 14 Hi Hat, 16 Crash, 20 Ride. Cod:6833\r\n', '16_59179producto.png', 'no', 0),
(179, 28, 52, 'Bosphorus Serie New Orleans', 'Platillo que captura el sonido puro del histórico New Orleans, Martillado a mano y completado ,de arriba a abajo, con un espiral continuo desde el centro hasta los bordes. Esta técnica trae consigo platillos con sonidos llenos de expresión, Dando una respuesta definida y exótica.\r\n\r\nDisponible en los siguientes Modelos\r\n\r\nNEW ORLEANS 14 Hi-Hat Dark. Cod: 6829\r\nNEW ORLEANS 16 Crash Thin. Cod: 6830\r\nNEW ORLEANS 20 Ride. Cod: 6831\r\n', '17_021962producto.png', 'no', 0),
(180, 28, 52, 'Bosphorus Serie Traditional', 'La serie Traditional ofrece los clásicos platillos turcos en una gran variedad de tamaños para adaptarse a cualquier situación musical.\r\nSu rango de sonidos van desde lo oscuro y delicado hasta lo brillante y penetrante.\r\n\r\nDisponible en los siguientes modelos.\r\n\r\nTRADITIONAL de 10, Splash, Thin. Cod: 6806\r\nTRADITIONAL de 14, Hihat, Dark. Cod: 6807\r\nTRADITIONAL de 16, Crash, Thin. Cod: 6808\r\nTRADITIONAL de 18, Crash, Thin. Cod: 6809\r\nTRADITIONAL de 20, Ride, Medium. Cod: 6810\r\nTRADITIONAL de 22, Ride, Medium. Cod: 6820\r\n\r\nSet Platillos TRADITIONAL 14 Hi Hat, 16 Crash, 20 Ride. Cod: 6834\r\n\r\n\r\n', '17_252889producto.png', 'no', 0),
(181, 28, 52, 'Bosphorus Serie Turk', 'La serie Turk provee al artista sofisticado con un instrumento que da una gran respuesta y ofrece un sonido oscuro y crudo, con un platillo completamente sin tornear y con un acabado martillado a mano.\r\nEste sonido exótico hace de este platillo la perfecta adición para cualquier batería tradicional como platillo de efecto o como instrumento primario para músicos que busquen un sonido oscuro y esotérico.\r\n\r\nDisponibles en los siguientes modelos\r\n\r\nTURK 10, Splash, Thin. Cod: 6825\r\nTURK 14, Hi-Hat, Dark Cod: 6826\r\nTURK 16, Crash, thin. Cod: 6827\r\nTURK 18, Crash, thin. Cod: 6828\r\nTURK 20, Ride, Medium Thin. Cod: 6814\r\nTURK 22, Ride, Thin. Cod: 6815\r\n\r\nSet Platillos TURK 14\\" Hi Hat, 16\\" Crash, 20\\" Ride. Cod: 6835', '17_47815producto.png', 'no', 0),
(182, 29, 26, 'Electro Harmonix 45000 Multi-Track looping Recorder', 'El 45000 combina los controles familiares de un grabador digital multi-track con tecnología de ultima generación que permiten crear complejos loops de varias pistas fácil y rápido.\r\n\r\nCódigo: 13099\r\n', '16_471826producto.png', 'no', 0),
(183, 29, 54, 'Electro Harmonix Big Muff pi', 'Elegido por mas de 40 Años, Alabado por los guitarristas contemporáneos y legendas del rock por igual debido a su Excelente Sustain, este pedal que ayudo a definir el sonido de las Guitarras de Rock es hasta el dia de hoy uno de los mas queridos y vendidos de Electro Harmonix.\r\n\r\nCodigo: 13036\r\n', '18_512827producto.png', 'no', 0),
(184, 29, 54, 'Black Finger Optical Tube Compressor', 'Magia de Doble Tubo! usando las mismas técnicas avanzadas que los compresores vintage y mas queridos. El black finger provee una compresión verdaderamente profesional. a diferencia de otros que usan de 9 a 50 volts el transformador toroidal de black finger usa sus 300 voltios preservando el ataque y dando la compresión mas cálida posible. con un sustain increíble, este pedal es esencial para cualquier guitarrista de acústica\r\n\r\nCodigo: 13231', '17_16887producto.png', 'no', 0),
(185, 29, 54, 'English Muff´n', 'Basado en los legendarios amps Británicos, El English Muff´n Recrea su majestuoso y clásico tono con excelente precisión, En vez de emular como otros pedales, el English Muff´n usa Tubos de Vacio (Vaccum Tube) para producir la característica saturacion de los amps valvulares británicos !!\r\n\r\nCodigo: 13040\r\n', '17_092599producto.png', 'no', 0),
(186, 29, 54, 'Flanger Hoax', 'Un pedal de modulación único, Controles de Performance e interacción de parámetros permiten crear un sinfín de sonidos, Colisiones de frecuencias que van desde sonidos oceánicos a fuertes asaltos de guerra, Flanging es solo una de las muchas posibilidades de este pedal. el \r\nFlanger Hoax es el sueño del diseñador de Sonido.\r\n\r\nCodigo: 13059\r\n', '17_232846producto.png', 'no', 0),
(187, 29, 54, 'HOG2 Harmonic Octave Generator', 'El conocido Hog, Bien recibido por los músicos por su habilidad de expandir exponencialmente las paletas de sonidos del músico. Ahora Electro Harmonix lleva el HOG a un nuevo nivel con el HOG2. Este provee control total de 10 voces totalmente polifónicas que van desde las 2 octavas abajo hasta 4 octavas arriba del instrumento, Sin necesidad de ningún añadido o modificación adicional.\r\n\r\nCódigo: 13097', '18_4224producto.png', 'no', 0),
(188, 29, 54, 'Small Clone', 'El Pedal analog chorus clásico popularizado por Kurt Cobain !! El mas refinado sonido de coro desde claros, ricos y dimensionales hasta cálidos y pulsantes. que pueden ser intensificados con el Depth Control. Ajustes sencillos generan efectos de duplicación excitantes que van desde alegres tonos de 12 Cuerdas o trinos Excelentes.\r\n\r\nCodigo: 13043', '17_141699producto.png', 'no', 0),
(189, 29, 54, 'Tube EQ', 'El Tube EQ es lisa y llanamente el primer ecualizador de tubo de vacio asequible que garantiza el mas calido balance de tono. No hay nada como la ecualización de tubos de vacío de calidad.\r\n\r\nCodigo: 13071', '17_232068producto.png', 'no', 0),
(190, 29, 54, 'Tube Zipper ', 'El Tube Zipper trae con su sistema de filtro móvil Harmonicos analógicos controlables a tu señal, En la típica costumbre EHX, Cada control se puede subir al máximo, Generando una enorme variedad de tonos.\r\n\r\nCodigo: 13044', '19_041380producto.png', 'no', 0),
(191, 29, 54, '#1 Echo Digital Delay', 'Electro-Harmonix tiene una gran reputación para delays de calidad y el #1 Echo es un excelente ejemplo de ello. Con un tono de ultra calidad seguido de un máximo de 2 segundos de un cálido delay de sonido analogico. El control de feedback asigna el numero de repeticiones y cuanto tardan en desaparecer. El control de blend deja ajustar el balance del volumen del echo directo desde la señal, Poniendo el sonido donde quieras.\r\n\r\nCodigo: 13009', '16_3151producto.png', 'no', 0),
(192, 29, 54, '#1 Echo Digital Delay', 'Electro-Harmonix tiene una gran reputación para delays de calidad y el #1 Echo es un excelente ejemplo de ello. Con un tono de ultra calidad seguido de un máximo de 2 segundos de un cálido delay de sonido analogico. El control de feedback asigna el numero de repeticiones y cuanto tardan en desaparecer. El control de blend deja ajustar el balance del volumen del echo directo desde la señal, Poniendo el sonido donde quieras.\r\n\r\nCodigo: 13009', '16_481727producto.png', 'no', 0),
(193, 29, 54, 'Stereo Looper 720', 'Con 720 Segundos (12 Minutos) de Grabacion en estereo en 10 Loops Independientes y Overdubbing sin Limite. El Compacto 720 Estereo Looper provee a los guitarristas con una herramienta intuitiva que es perfecta para practicas y shows en vivo\r\n\r\nCodigo: 13233', '17_071056producto.png', 'no', 0),
(194, 29, 54, '8 Step Program', 'Este pedal se conecta a otro dispositivo para entregar control secuencial sobre parámetros que responden a pedales de expresión o generadores de CV como osciladores, Filtros, Parámetros de Delay y demás. Ajusta tu tempo con el rate slider o el interruptor de pie tap tempo, o puedes añadir el 8 step program foot controller opcional que expande hasta 100 presets mas !!\r\n\r\nCodigo: 13202', '16_25677producto.png', 'no', 0),
(195, 29, 54, 'B9 Organ Machine', 'Con 9 Presets diseñados para emular los órganos mas legendarios de los 60 y mas, el B9 organ machine transformara tu guitarra o teclado, Usando el control de click percusivo de tu instrumento y modulación, Mezcla tu señal pura para obtener ese excelente sonido de órgano Característico de la gran era del Rock.\r\n\r\nCodigo: 13217', '16_462814producto.png', 'no', 0),
(196, 29, 54, '8 Step Program Foot Controller', 'Este controlador de pie opcional te permite guardar y usar hasta 100 presets del pedal 8 Step Program.\r\n\r\nCodigo: 13203', '16_581993producto.png', 'no', 0),
(197, 29, 54, 'Bass Big Muff Pi', 'El aclamado Pedal Big Muff Vuelve diseñado a la medida para el Bajo, el pedal que los bajistas que amaron el sonido del big muff estuvieron esperando.\r\n\r\nCodigo: 13010', '17_062896producto.png', 'no', 0),
(198, 29, 54, 'Big Muff Pi Con Tono Wicker', 'El Big muff pi con tono wicker aprovecha el poder sonico del legendario Big Muff Pi, Pero con un movimiento de su interruptor (o dos) crea nuevas posibilidades tonales. Usa el interruptor Wicker para abrir hasta 3 filtros de alta frecuencia para una Rosca y sostenida distorsión o usa el interruptor de tono para sortear el control de tono y obtener un tono sin limites. Queres el sonido original del big muff? Desactiva el interruptor wicker y activa el tono. crea tu propio sonido big muff personalizado !!\r\n\r\nCodigo: 13014', '17_372019producto.png', 'no', 0),
(199, 29, 54, 'Blurst Synthesizer', 'Electro Harmonix a implantado tecnología encontrada en teclados y sintetizadores modulares en un pedal diseñado para guitarristas y tocadores de bajo. El Blurst modula el sonido de un instrumento como un filtro envolvente, Pero en vez de la respuesta de filtros siendo controlada por la dinámica de reproducción, Esta es controlada por un oscilador interno. El Blurst es esencial para el Guitarrista aventurero que quiere explorar nuevos territorios musicales !!\r\n\r\nCodigo: 13114', '18_151285producto.png', 'no', 0),
(200, 29, 54, 'C9 Organ Machine', 'El C9 Organ Machine Transformara tu instrumento en un Muy convincente organo electrico o teclado vintage. Por Cada preset elegido, le provee controles precisos sobre elementos de ese sonido particular como el click percusivo, Modulacion, Ataque, Sustain y mas.\r\n\r\nCodigo: 13227', '19_591536producto.png', 'no', 0),
(201, 29, 54, 'Cathedral Stereo Reverb', 'Usa el Cathedral para envolver tu música con un aura celestial. Gracias a su sistema True stereo Reverb y su fácil Programación el Cathedral da a tu voz o instrumento un sonido Angelical digno de iglesia.\r\n\r\nCódigo: 13051', '16_361745producto.png', 'no', 0),
(202, 29, 54, 'Clockworks Rhythm Generator/Synthetizer', 'El Clockworks es una Reedicion del pedal hecho por Electro Harmonix en 1970. Este pedal es usado como un reloj maestro para secuenciadores y Drum Machines, y activar productos de percusion electronica como el EHX Crash pad Classic Drum Synth. Este pedal no hace sonidos por si mismo. Solo genera pulsos para activar otros productos y posicionar el tempo para un drum machine o secuenciador como el EHX 8 Step Program.\r\n\r\nCódigo: 13228', '17_55642producto.png', 'no', 0),
(203, 29, 54, 'Cock Fight - Cocked Talking Wah', 'El Cock Fight Permite usar el llamado cocked wah sin el pedal wah. Sintoniza el tono a tu manera y Añade la distorsion de fabrica del pedal para un tono grueso o cambia al modo talking wah para un sonido de caja de voz.\r\n\r\nCódigo: 13107', '18_061676producto.png', 'no', 0),
(204, 29, 54, 'Bass Clone - Bass Chorus', 'El Circuito del Bass Clone Chorus es casi identico a el del legendario Small Clone Chorus, pero con caracteristicas añadidas especificamente para bajo. Chorus es una combinacion de señales secas y moduladas, El interruptor Crossover de Bass Clone corta el extremo inferior de la señal modulada para que el pedal ofrezca un extremo inferior articulado con mayor precisión y una excelente definición de notas. El control de agudos afecta a toda la señal mientras que el control de graves sólo afecta a la mitad seca. Junto con el interruptor Crossover, proporcionan un sonido preciso que le permite conseguir un sonido de bajo preciso y concentrado con un coro de graves bien definido y brillante en la parte superior.    \r\n\r\nCódigo: 13039', '17_241856producto.png', 'no', 0),
(205, 29, 54, 'Operation Overlord - Allied Overdrive', 'Un pedal versátil de Overdrive stereo/Distorsión con un gran rango de opciones y controles de sonido. Ya sea para Guitarra, Bajo, Teclado o Cualquier tipo de instrumento electrico, El Overlord es un gran aliado.\r\n\r\nCódigo: 13064', '16_222331producto.png', 'no', 0),
(206, 29, 54, 'Battalion - Bass Preamp + DI', 'El Battalion Bass Preamp y DI es un pedal compacto y flexible que ofrece potentes funciones de modelado de tonos en un robusto paquete compatible con pedaleras. El Batallón está repleto de características que atraerán a los bajistas conscientes del tono e incluye un ecualizador de cuatro bandas, una sección de distorsión MOSFET completamente equipada con tres opciones de trayectoria de señal, un compresor, una puerta de ruido y una E/S completa.\r\n\r\nCódigo: 13065', '17_331136producto.png', 'no', 0),
(207, 29, 54, 'Platform - Stereo Compressor/Limiter', 'El PLATFORM es un sofisticado compresor y limitador estéreo profesional que incluye aumento de volumen y cinta inversa, además de Overdrive. Es potente para trabajos de estudio o postproducción, pero lo suficientemente compacto como para llevar a un concierto!\r\n\r\nCódigo: 13077\r\n', '18_552891producto.png', 'no', 0),
(208, 29, 54, 'Cock Fight Plus - Talking Wah y Fuzz', 'El EHX Cock Fight Plus ofrece el tono premiado del original Cock Fight en un pedal robusto y ligero con un mecanismo de operación tradicional de cremallera y piñón. Contiene dos filtros expresivos diferentes: un filtro de pedal wah tradicional y un filtro formante usado para sonidos vocálicos. El Cock Fight también cuenta con una sección de fuzz animada que se puede añadir antes o después de la sección del filtro, o se puede quitar completamente de la trayectoria de la señal.\r\n\r\nCódigo: 13074', '19_232662producto.png', 'no', 0),
(209, 29, 54, 'Dual Expression Pedal - Dual Output', 'El diseño de salida dual permite obtener control de dos funciones o dos productos separados desde un solo lugar.\r\n\r\nCódigo: 13076', '16_38683producto.png', 'no', 0),
(210, 29, 54, 'EHX Expression - Single Output', 'Pedal de Salida Simple que es lo suficientemente versatil como para controlar cualquier equipo con entrada EXP.\r\n\r\nCódigo: 13100', '16_54202producto.png', 'no', 0),
(211, 29, 54, 'Slammi Plus - Pitch Shifter/Harmony Pedal', 'Esta maravilla polifónica fácilmente traspone el tono en 2 direcciones diferentes sobre un rango de +/- 3 Octavas, Ya sea arriba, abajo o en ambas simultáneamente ! ya sea Efectos Whammy, Dive Bombs, Crossfade entre la señal seca y sonidos transpuestos.. este pedal lo hace todo!\r\n\r\nCódigo: 13102', '17_001497producto.png', 'no', 0),
(212, 29, 54, 'Crash Pad - Electronic Crash Drum', 'Como el original de 1980, El nuevo Crash Pad puede crear un gran rango de sonidos de Drum y otros Barridos de oscillacion ademas de procesar sonidos externos a traves de su filtro resonante. Ademas a sido actualizado para usarse junto a pedales de Expresion/Entrada CV para un control externo sobre el filtro en tiempo real.\r\n\r\nCódigo: 13108', '17_201040producto.png', 'no', 0),
(213, 29, 54, 'Deluxe Bass Big Muff Pi - Distortion/Sustainer', 'El nuevo Deluxe Bass Big Muff es lo ultimo de EHX en la linea de efectos específicos para Bajo. Este pedal trae mejoras sobre el clásico Bass Big Muff Pi que están especialmente pensadas para  las necesidades del Bajista Moderno y dan muchas mas opciones para moldear el tono que antes!\r\n\r\nCódigo: 13096', '16_352859producto.png', 'no', 0),
(214, 29, 54, 'Deluxe Big Muff Pi - The Icon Reimagined', 'Muy venerado por su dulce tono de canto y su sustain similar al violín, el Clasico Big Muff Pi de tres perillas ha ayudado a definir el sonido de la guitarra rock durante más de 40 años. Ahora, hemos añadido algunos extras para aquellos que desean más control de sonido. Presentamos el \r\nDeluxe Big Muff Pi. Entrega todos los sonidos clásicos del Big Muff Pi original de NYC, y mucho más.\r\n\r\nCódigo: 13214', '16_45968producto.png', 'no', 0);
INSERT INTO `productos` (`id`, `categoria`, `subcategoria`, `titulo`, `descripcion`, `foto`, `destacado`, `recordListingID`) VALUES
(215, 29, 54, 'Deluxe Memory Boy - Analog delay with Tap Tempo', 'El Deluxe Memory Boy es el Nuevo delay de la familia de productos Memory Man. su IC de Calidad entrega Calidos y orgánicos tonos analógicos mientras que el \\''\\''Tap Tempo\\''\\'' Permite que estés siempre en sincronía. Elige 5 divisiones de notas para variaciones Metronomicas. Increíbles modulaciones se pueden poner mientras que la entrada de pedal de expresión da control externo al pedal. El Deluxe Memory Boy es el Delay Análogo mas flexible jamas Diseñado.\r\n\r\nCódigo: 13067', '17_022394producto.png', 'no', 0),
(216, 29, 54, 'Deluxe Memory Man - Analog Delay/Chorus/Vibrato', 'El Delay análogo con la mayor demanda jamas creado. Los músicos lo aman y los coleccionistas lo adoran. nada se puede comparar Con el sonido orgánico del delay analogico, y ningún pedal lo hace mejor que el Deluxe Memory Man! Hasta 550 mS de Vibrante echo que rivaliza el Tape Delay; un Chorus espacial y un aterrador Vibrato son solo algunos de los Trucos del Memory Man!\r\n\r\nCódigo: 13015', '17_282393producto.png', 'no', 0),
(217, 29, 54, 'Deluxe Memory Man 1100-TT - Tap Tempo Delay', 'Electro-Harmonix a Creado el Memory Man Definitivo ! El Deluxe Memory Man equipado con Tap Tempo, 1100 mS de tiempo Máximo de Delay, Control de Expresión y Loops de Efecto. El añadir el Tap tempo asegura que siempre se este sincronizado con la música. Mientras 5 subdivisiones de Tap Divide proveen variación Rítmica. la entrada de pedal de expresión provee Control en tiempo Real sobre el Blend, Rate, Depth, Feedback y delay. El Effects loop te permite insertar efectos en la señal húmeda sin cambiar la señal seca. todo esto hace a el Deluxe Memory Man 1100-TT el Delay Análogo mas poderoso jamas diseñado.\r\n\r\nCódigo: 13082', '18_122623producto.png', 'no', 0),
(218, 29, 54, 'Chillswitch Momentary Line Selector', 'El CHILLSWITCH Momentary Line Selector es un nuevo pedal utilitario de Electro-Harmonix. Con 2 Modos, En modo Kill Produce un Mute Instantáneo que corta la señal, Mientras que en modo Line Selector Permite Cambiar la Linea de Señal Alternando entre Efectos y Señal Seca y Muchas mas Formas creativas de usar 2 Lineas en 1 Guitarra.\r\n\r\nCódigo: 13086', '20_24367producto.png', 'no', 0),
(219, 29, 54, 'Tone Tattoo - Analog Multi Effects Pedal', 'TONE TATTOO es nuestro primer pedal multiefectos analógico totalmente interactivo. Satisfaga sus tonos con una cadena que incluye Metal Muff Distortion, Neo Clone Chorus y Memory Toy Analog Delay.\r\nProporciona aplastantes tonos Lead & Rhythm. Incluye escultura de tono completo, incluyendo dos niveles de scoop. Nueva noise gate para minimizar el ruido. Con tres efectos aclamados por la crítica, es como un talismán para una gran guitarra.\r\n\r\nCódigo: 13085', '18_13967producto.png', 'no', 0),
(220, 29, 54, 'HOG2 Foot Controller', 'Recordatorio Instantáneo! Con los miles de sonidos del HOG2, el Foot Controller HOG2 le permite acceder fácilmente a hasta 100 presets almacenados. Todo su espectáculo puede configurarse con sólo pulsar un botón. Al grabar, usted tiene acceso a transiciones de sonido complejas que pueden darle a sus canciones una nueva profundidad e integridad.\r\n\r\nCódigo: 13098', '20_041025producto.png', 'no', 0),
(221, 29, 54, '22500 Dual Stereo Looper - Foot Controller', 'Un mando a distancia con cable para el 22500 Dual Stereo Looper que le da control de pie sobre la paginación hacia arriba y hacia abajo a través de los bancos de pedaleo Loop Banks.\r\n\r\nEl 22500 graba y toca en hasta 100 Loop Bank. El Foot Controller facilita la navegación por los 100 bancos de bucles del 22500, moviéndose hacia arriba o hacia abajo por uno o diez bancos a la vez.\r\n\r\nCódigo: 13105', '20_151105producto.png', 'no', 0),
(222, 29, 54, '45000 Foot Controller', 'Hace que todo sea más rápido y sencillo, ya que ofrece la posibilidad de utilizar las funciones de las teclas con las manos libres. Elija una nueva pista o bucle sin perder un compás. Obtenga acceso instantáneo a hasta 100 bucles por tarjeta SDHC. El Foot Controller recibe energía del 45000 y se conecta a él con un cable estándar de guitarra mono. Es una necesidad!\r\n\r\nCódigo: 13200', '20_25262producto.png', 'no', 0),
(223, 29, 54, 'Bass Metaphors', 'Un Preamp de Bajo en una Caja de Herramientas de Banda de Canal. Nueva Distorsión que se fusiona con un Compresor Cuidadosamente seleccionado y un EQ específicamente hecho para Bajo que añade estructura a una Muy solida fundación. Adicionalmente sirve como un silencioso y excelente DI. Útil para todo tipo de Bajistas ya sean los que Tocan en vivo, Graban en un estudio Profesional o en una Laptop en casa.\r\n\r\nCódigo: 13012', '20_11504producto.png', 'no', 0),
(224, 29, 54, 'Bass Micro Synthesizer - Analog Microsynth', 'El Bass Micro Synthesizer tiene las mismas características que el Micro Synthesizer, pero incluye una gama de barrido de gatillo y filtro especialmente diseñada para el bajo. Las mismas texturas de sintetizador analógico le dan a su bajo una gama de posibilidades completamente nueva: desde puñaladas percusivas hasta sonidos de reverencia reversible.\r\n\r\nCódigo: 13013', '20_23246producto.png', 'no', 0),
(225, 29, 54, 'Green Russian Big Muff', 'De vuelta por abrumadora demanda... ¡en un mini paquete! El clásico de culto Green Russian Big Muff sacudió el suelo por primera vez a mediados de los noventa. Desde entonces ha sido anunciado por guitarristas y bajistas por sus devastadores bajos y únicos fangos y chisporroteos. El Green Russian Big Muff crea un tono enorme que es todo suyo, pero es innegablemente Big Muff. \r\n\r\nCodigo: 13037', '19_59317producto.png', 'no', 0),
(227, 29, 54, 'Freeze - Sound Retainer', 'Capture un momento congelado y conviértelo en una base sónica tonalmente única. El Freeze Sound Retainer ofrece un sustain infinito de cualquier nota o acorde con la pulsación de un interruptor de pedal momentáneo. Suelte la pedalera y estará de nuevo listo para la muestra. Tres velocidades de decaimiento seleccionables, incluyendo un modo de cierre, garantizan transiciones tonales suaves y líquidas. Conecta el Freeze con tus pedales favoritos para crear un collage sonoro que no se parecerá a nada que hayas escuchado. Es como añadir un músico extra a la banda.\r\n\r\nCódigo: 13075', '20_1614producto.png', 'no', 0),
(228, 29, 54, 'Double/Muff - Fuzz/overdrive', 'Clásico overdrive dual. El plug-in original de 1969 Muff Fuzz tenía un toque de overdrive y sonaba como un amplificador vintage con un altavoz ligeramente desgarrado. Hemos emparejado dos de estos en una caja para crear el Double Muff. Usa sólo un Muff para una pizca de distorsión lechosa, o cascada el segundo Muff para un overdrive superior que convierte la leche en crema. ¡Dos distorsiones en una! Ahora en un paquete compacto y robusto de tamaño nano.\r\n\r\nCódigo: 13072', '20_202517producto.png', 'no', 0),
(229, 29, 54, '44 Magnum - Power Amp', 'El nuevo pedal amplificador de guitarra Magnum 44 Magnum proporciona 44 Watts de potencia limpia y natural, pero también puede entregar un verdadero overdrive de amplificador en el giro de una perilla. Desde tu bolsillo hasta el escenario, el 44 Magnum es la solución perfecta para tocar y practicar. A pesar de ser descrito como una \\"cabeza de guitarra\\", el 44 tiene el carácter y control para trabajar con cualquier instrumento eléctrico. Mueva el interruptor de brillo para un extremo superior más definido. El tono dulce de nuestro legendario calibre 22, pero con un borde de potencia extra que puede marcar la diferencia.\r\n\r\nCódigo: 13073', '20_262703producto.png', 'no', 0),
(230, 29, 54, 'Turnip Greens - Multi-Effect', 'El Turnip Greens es un pedal compacto multi-efecto que combina el ganador de premios Soul Food Overdrive y Holy Grail Max Reverb. El Soul Food proporciona sonidos transparentes que comienzan con un impulso limpio y progresan hasta llegar a un intenso overdrive. Es igualmente hábil para añadir Fuerza al tono del músico, empujar un amplificador a la saturación o delante de otros pedales de distorsión llevarlos a nuevos mundos de distorsión\r\n\r\nCódigo: 13218', '20_051939producto.png', 'no', 0),
(233, 29, 54, 'Super Pulsar - Stereo Tap Tremolo', 'Un verdadero super tremolo con potentes controles y enrutamiento de señales. \r\nEsculpe la forma del tremolo con formas de onda ajustables de seno, triángulo y pulso, mientras que el tap tempo y la división de tap aseguran la sincronicidad. Crea tus propios patrones rítmicos y guárdalos. Guarde y recupere hasta ocho programas predefinidos personalizados. Convierta trémolos en movimiento sobre la marcha con el control EXP sobre la velocidad, profundidad, forma, fase o volumen. La entrada/salida estéreo deluxe I/O le permite elegir la entrada/salida estéreo, la entrada/salida mono, la entrada/salida estéreo o la operación de entrada/salida mono mono. Los circuitos analógicos producen un tono cálido y exuberante que le envolverá en ondas de cambio de forma.\r\n\r\nCódigo: 13230', '16_392598producto.png', 'no', 0),
(232, 22, 4, 'Bafles Matrix', 'Los Matrix son bafles nacionales que están recibiendo una gran aceptación entre el publico argentino por su calidad y rendimiento a precios asequibles', '20_0999producto.png', 'no', 0),
(234, 29, 54, 'Bassballs - Twin Dynamic Envelope Filter', 'No uno, sino dos filtros estrechos barren tus tonos bajo control de la envolvente, generando sonidos vocales únicos. Un interruptor de distorsión enriquece los armónicos. El control de respuesta varía el rango de barrido determinado por su ataque. No sólo está diseñado para y genial en el bajo, pero también muy funky en la guitarra.\r\n\r\nCódigo: 13045', '17_041117producto.png', 'no', 0),
(235, 30, 55, 'DR Encordado Bajo HI-BEAM', 'Las Cuerdas de acero inoxidable Hi-Beam de DR son Roundwound con la característica de estar sobre un núcleo redondeado lo que las hace únicas en toda la industria. Estas cuerdas requieren mucho mas tiempo, cuidado y pasos adicionales para fabricar que otras cuerdas de bajo. Este esfuerzo extra resulta en una cuerda de bajo que es altamente flexible y con una brillantez musical extra suave. Estas son reconocidas por su durabilidad, su largo periodo de uso, Consistencia y balance entre cuerda y cuerda. Estas no dañan los trastes y son la opción ideal para los bajistas que eligen claridad, poder y la calidad líder de DR.\r\n\r\nDisponibles en las siguientes medidas: 040-120  045-125  030-130  030-125  040-100  045-105\r\n\r\nCódigos:\r\n\r\nDR62BA 040 - 120\r\nDR63BA 045 - 125\r\nDR65BA 030 - 130\r\nDR64BA 030 - 125\r\nDR60BA 040 - 100\r\nDR61BA 045 - 105', '16_561893producto.png', 'no', 0),
(236, 30, 55, 'DR Encordado Bajo NEON GREEN', 'Las cuerdas de Bajo DR NEON Green con tecnología K3 son las primeras cuerdas con recubrimiento que los guitarristas aseguran Se escucha igual o mejor que una cuerda común.\r\nEl Recubrimiento K3 es el primero en poseer las mismas calidades sonoras que las cuerdas sin recubrimiento, ademas de tener mas volumen, una mayor claridad y articulación que una cuerda estándar las NEON Green proveen la misma protección ante la corrosión y daños ademas de una larga expectativa de uso y la característica única de brillar en la oscuridad con un leve resplandor Verde!!\r\n\r\nDisponible en las Siguientes Medidas: 040-100  045-105\r\n\r\nCodigos:\r\n\r\nDR70BA 040 - 100\r\nDR71BA 045 - 105', '16_572686producto.png', 'si', 0),
(237, 30, 55, 'DR Encordado Bajo NEON ORANGE', 'Las cuerdas de Bajo DR NEON ORANGE con tecnología K3 son las primeras cuerdas con recubrimiento que los guitarristas aseguran Se escucha igual o mejor que una cuerda común.\r\nEl Recubrimiento K3 es el primero en poseer las mismas calidades sonoras que las cuerdas sin recubrimiento, ademas de tener mas volumen, una mayor claridad y articulación que una cuerda estándar las NEON ORANGE proveen la misma protección ante la corrosión y daños ademas de una larga expectativa de uso y la característica única de brillar en la oscuridad con un leve resplandor Naranja!!\r\n\r\nDisponible en las siguientes Medidas: 040 - 100 045 - 105\r\n\r\nCodigos:\r\n\r\nDR72BA 040 - 100\r\nDR73BA 045 - 105\r\n', '16_562072producto.png', 'no', 0),
(238, 30, 55, 'DR Encordado Bajo PURE BLUES', 'Las cuerdas de bajo PURE BLUES combinan un golpe gordo y cálido con un borde especialmente diseñado para el bajista moderno. Combinando un nuevo y único Quantum-Nickel con el más alto nivel posible en técnicas de cuerda, las cuerdas de bajo PURE BLUES consiguen un sonido y una sensación insuperables. Con fabricación manual en núcleos redondos para una mayor flexibilidad.  Las cuerdas DR son hechas a mano (no a máquina) porque nuestros expertos fabricantes de cuerdas son capaces de hacer los ajustes necesarios a lo largo del proceso para obtener el mejor sonido y la mejor sensación posible.\r\n\r\nDisponible en las siguientes Medidas: 045 - 125 040 - 100 045 - 105\r\n \r\nCodigos:\r\n\r\nDR69BA 045 - 125\r\nDR66BA 040 - 100\r\nDR67BA 045 - 105\r\n', '17_20126producto.png', 'no', 0),
(239, 30, 55, 'DR Encordado Ukelele Clear Fluorocarbon Soprano/Concert', 'Auténtico, de alto grado, el fluorocarbono moderno dura más tiempo y mantiene la sintonía mejor que el nylon regular. \r\n\r\nToca fuerte, toca largo. Disfruta rasgueando y escuchando toda la producción musical de la que tu ukelele es capaz.\r\nHecho para el disfrute profesional y amateur.\r\n\r\nCodigo:\r\n\r\nDR2UK\r\n', '17_30835producto.png', 'no', 0),
(240, 30, 55, 'DR Encordado Ukelele Multicolor soprano/concert', 'Colores súper brillantes diseñados para un sonido claro, brillante y musical.  Cuerdas multicolor... 4 cuerdas, 4 colores... hacen que aprender Ukulele sea divertido.\r\n\r\nCodigo: DR1UK\r\n', '17_52193producto.png', 'no', 0),
(241, 30, 55, 'DR Encordado Acustica DRAGON SKIN', 'Los sets de Dragon Skin se caracterizan por su recubrimiento en todas las cuerdas, incluyendo los trebles de acero bañados en latón para mayor volumen y un sonido mas cálido. La capa K3 es la primera capa que los guitarristas reportan, suena tan bien o mejor que las cuerdas no recubiertas. El extraordinario y patentado recubrimiento de la tecnología K3 de DR es el primer recubrimiento Capaz de igualar a las cuerdas estándar. Los jugadores nos dicen que estas cuerdas tienen más volumen, menos sobretonos no deseados, mayor claridad y articulación que las cuerdas estándar no recubiertas. Sin embargo, proporcionan la misma protección debido a la corrosión y la transpiración, así como una mayor duración del tono que las cuerdas recubiertas son conocidas.\r\n\r\nCódigo:\r\n\r\nDR47AC 010 - 048\r\nDR48AC 012 - 054', '19_082512producto.png', 'no', 0),
(242, 30, 55, 'DR Encordado Acustica NEON GREEN', 'DR NEON es aplicado para darle a una cuerda de alta duración un resplandor verde super brillante. Que brilla en la luz del dia, o bajo la luz del escenario. Las cuerdas DR NEON Se introducen en el escenario, resplandeciendo brillantemente, ademas se activan con la luz negra y tambien resplandecen bajo los rayos UV. Estos colores super brillantes sonaran claros, brillantes y musicales y gracias a su recubrimiento K3 duraran por mucho mas tiempo.\r\n\r\nCódigos:\r\n\r\nDR49AC 010 - 048\r\nDR50AC 012 - 054\r\n', '19_241568producto.png', 'no', 0),
(243, 30, 55, 'DR Encordado Acustica NEON ORANGE', 'DR NEON es aplicado para darle a una cuerda de alta duración un resplandor Naranja super brillante Que brilla en la luz del día, o bajo la luz del escenario. Las cuerdas DR NEON Se introducen en el escenario, resplandeciendo brillantemente, ademas se activan con la luz negra y tambien resplandecen bajo los rayos UV. Estos colores super brillantes sonaran claros, cálidos y musicales y gracias a su recubrimiento K3 duraran por mucho mas tiempo.\r\n\r\nCódigo:\r\n\r\nDR51AC 010 - 048\r\nDR52AC 011 - 050', '18_241424producto.png', 'no', 0),
(244, 30, 55, 'DR Encordado Acustica RARE', 'Las Cuerdas acústicas Rare Phosphor Bronze son un cambio de el bronce de buena calidad usado en las cuerdas estándar. No necesariamente mejor, pero con una voz nueva, diferente y mas fuerte. Cuando DR se propone a crear Cuerdas con nuevas características, Su propósito es rediseñar el pensamiento contemporáneo de que exactamente puede hacer el phosphor bronze por una buena guitarra acústica. Las guitarras hechas con palo de rosa, Maple y Caoba se benefician de grandes mejoras respecto al tono, profundidad y sustain con cuerdas de phosphor Rare. Guitarristas que quieren un sonido mas gordo y fuerte, ademas de unos bajos mas profundo (para aquellos que les gusta escuchar a sus guitarras resonar) apreciaran el Tono, Sonido y la sensacion que provee el Phosphor Bronze de Rare', '20_292008producto.png', 'no', 0),
(245, 30, 55, 'DR Encordado Acustica VERITAS', 'VERITAS es la cuerda acústica que dura hasta 4 veces mas que las cuerdas ordinarias. Segun Stefan Grossman, un reconocido artista, educador y dueño de The Guitar Workshop Catalog. Gracias a la tecnología ACT (Accurate Core Technology) dentro de cada cuerda, Estas contienen un mejor tono, entonación y durabilidad. Accurate Core Technology fue creado para reforzar el núcleo de la cuerda y llenar las imperfecciones sobre todo el largo del hilo, resultando en cuerdas con mucha mas estabilidad y una mejor retención de tono.\r\n\r\nTodos los guitarristas que las probaron dicen lo mismo, Las cuerdas VERITAS suenan mas alto, mas cálido y duran mas!\r\n\r\nCodigos:\r\n\r\nDR42AC 010 - 048\r\nDR43AC 011 - 050\r\nDR44AC 012 - 054\r\n', '17_042589producto.png', 'no', 0),
(246, 30, 55, 'DR Encordado Electroacustica Zebra', 'Desde las guitarras electroacústicas con pickups de piezo debajo del puente o pickups magnéticos dentro de la boca de la guitarra. Hasta las guitarras de jazz responden a ZEBRA con tonos mas ricos según los guitarristas. Cualquier Acústica Amplificada mejora increíblemente con las cuerdas ZEBRA de DR. Revolucionarias ya que ninguna compania hace este tipo de cuerdas. Es la primera cuerda donde se puede escuchar la diferencia!\r\n\r\nCódigos:\r\n\r\nDR45EA 010 - 048\r\nDR46EA 012 - 054\r\n', '17_461515producto.png', 'no', 0),
(247, 30, 55, 'DR Encordado Clasica NSA Deluxe silver plated - Hard Tension', 'Rediseñadas por completo para el músico exigente y  el artista de escenario!\r\n\r\nCodigo: DR37CL\r\n', '18_061133producto.png', 'no', 0),
(248, 30, 55, 'DR Encordado Clasica RNS-PLUS silver plated, Medium tension', 'Rediseñadas por completo para el músico exigente y el artista de escenario!\r\n\r\nCodigo: DR36CL\r\n', '18_102451producto.png', 'no', 0),
(249, 30, 55, 'DR Encordado Electrica DRAGON SKIN 2 SETS', 'Los sets de Dragon Skin se caracterizan por su recubrimiento en todas las cuerdas, incluyendo los trebles de acero bañados en latón para mayor volumen y un sonido mas cálido. La capa K3 es la primera capa que los guitarristas reportan, suena tan bien o mejor que las cuerdas no recubiertas. El extraordinario y patentado recubrimiento de la tecnología K3 de DR es el primer recubrimiento Capaz de igualar a las cuerdas estándar. Los jugadores nos dicen que estas cuerdas tienen más volumen, menos sobretonos no deseados, mayor claridad y articulación que las cuerdas estándar no recubiertas. Sin embargo, proporcionan la misma protección debido a la corrosión y la transpiración, así como una mayor duración del tono que las cuerdas recubiertas son conocidas.\r\n\r\nCodigos:\r\n\r\nDR28EL 010 - 046\r\nDR27EL 009 - 042\r\n', '18_37576producto.png', 'no', 0),
(250, 30, 55, 'DR Encordado Electrica NEON GREEN', 'DR NEON es aplicado para darle a una cuerda de alta duración un resplandor verde super brillante. Que brilla en la luz del dia, o bajo la luz del escenario. Las cuerdas DR NEON Se introducen en el escenario, resplandeciendo brillantemente, ademas se activan con la luz negra y tambien resplandecen bajo los rayos UV. Estos colores super brillantes sonaran claros, brillantes y musicales y gracias a su recubrimiento K3 duraran por mucho mas tiempo.\r\n\r\nCodigos:\r\n\r\nDR31EL 010 - 046\r\nDR30EL 009 - 042\r\n', '18_501578producto.png', 'no', 0),
(251, 30, 55, 'DR Encordado Electrica NEON MULTICOLOR', 'DR NEON es aplicado para darle a una cuerda de alta duración un resplandor super brillante de diferente color a todas las cuerdas. Que brilla en la luz del día, o bajo la luz del escenario. Las cuerdas DR NEON Se introducen en el escenario, resplandeciendo brillantemente, ademas se activan con la luz negra y tambien resplandecen bajo los rayos UV. Estos colores super brillantes sonaran claros, brillantes y musicales y gracias a su recubrimiento K3 duraran por mucho mas tiempo.\r\n\r\nDR29EL 010 - 046\r\n', '18_53361producto.png', 'no', 0),
(252, 30, 55, 'DR Encordado Electrica NEON ORANGE', 'DR NEON es aplicado para darle a una cuerda de alta duración un resplandor Naranja super brillante Que brilla en la luz del día, o bajo la luz del escenario. Las cuerdas DR NEON Se introducen en el escenario, resplandeciendo brillantemente, ademas se activan con la luz negra y tambien resplandecen bajo los rayos UV. Estos colores super brillantes sonaran claros, cálidos y musicales y gracias a su recubrimiento K3 duraran por mucho mas tiempo.\r\n\r\nCódigos:\r\n\r\nDR34EL 010 - 046\r\nDR33EL 009 - 042\r\n', '18_582605producto.png', 'no', 0),
(253, 30, 55, 'DR Encordado Electrica PURE BLUES', 'En la tradición de DR de usar estilos de construcción antiguos para mejorar el rendimiento moderno, Las cuerdas Pure Blues para guitarra eléctrica son diseñadas alambre de nickel puro redondeado en un núcleo redondeado. Aunque este es un modo lento y caro de crear cuerdas, este produce cuerdas amadas por su sustain, tono vintage y excelentes tonos bajos. El paso extra de cubrir un núcleo redondo con nickel puro le da a las cuerdas Pure Blues el golpe que los músicos dicen estar sorprendidos de obtener en una cuerda de estilo vintage.\r\n\r\nCódigos:\r\n\r\nDR21EL 010 - 046\r\nDR20EL 009 - 042\r\n', '19_38482producto.png', 'no', 0),
(254, 30, 55, 'DR Encordado Electrica TITE-FIT 7C', 'Las cuerdas Tite-Fit para guitarra eléctrica de nickel están diseñadas para ser cuerdas versátiles para cualquier uso. Estas están disponibles en un gran rango de calibres. Basado en un núcleo Redondo, las técnicas de construcción de las cuerdas Tite-Fit son muy antiguas. Sin Embargo el alambrado del núcleo y su envoltura están hechos con los mas avanzados y caros metales disponibles en DR.\r\n\r\nYa sea para Flexibilidad, Tono, Larga duración; Para estilos de Rock, Blues, Heavy metal, Jazz. las Tite-Fits son cuerdas perfectas para uso general.\r\n\r\nCódigos:\r\n\r\nDR15EL 009 - 052\r\nDR16EL 010 - 056\r\n', '20_20717producto.png', 'no', 0),
(255, 30, 55, 'DR Encordado Electrica TITE FIT ', 'Las cuerdas Tite-Fit para guitarra eléctrica de nickel están diseñadas para ser cuerdas versátiles para cualquier uso. Estas están disponibles en un gran rango de calibres. Basado en un núcleo Redondo, las técnicas de construcción de las cuerdas Tite-Fit son muy antiguas. Sin Embargo el alambrado del núcleo y su envoltura están hechos con los mas avanzados y caros metales disponibles en DR.\r\n\r\nYa sea para Flexibilidad, Tono, Larga duración; Para estilos de Rock, Blues, Heavy metal, Jazz. las Tite-Fits son cuerdas perfectas para uso general.\r\n\r\nDR14EL 011 - 050\r\nDR12EL 009 - 046 Heavy \r\nDR10EL 008 - 038\r\nDR11EL 009 - 042\r\nDR13EL 010 - 046\r\n', '20_241320producto.png', 'no', 0),
(256, 30, 55, 'DR Encordado Electrica VERITAS', 'Las Cuerdas de guitarra eléctrica VERITAS de DR entran en otra categoría completamente distinta al resto de cuerdas, Con músicos notando como el encordado VERITAS con Accurate Core Technology (ACT) y QUANTUM-Nickel dura mucho mas y suena con mas poder que las cuerdas de nickel ordinarias. La tecnología ACT de DR es el corazón de VERITAS, ACT fue diseñado para reforzar el núcleo y rellenar las imperfecciones a lo largo de toda la cuerda. Este núcleo superior es reconocido por su tono mas rico, una mejor entonación y mas durabilidad.\r\nQUANTUM-Nickel es una nueva aleación para entorchar la cuerda, debido a que es mas magnética, esta es mas responsiva y suena con mas potencia que las cuerdas NPS 8% de alambre de nickel.\r\n\r\nCódigos:\r\n\r\nDR26EL 010 - 046\r\nDR25EL 009 - 042\r\n', '16_42310producto.png', 'no', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider_home`
--

CREATE TABLE IF NOT EXISTS `slider_home` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(300) NOT NULL,
  `recordListingID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Volcado de datos para la tabla `slider_home`
--

INSERT INTO `slider_home` (`id`, `foto`, `recordListingID`) VALUES
(70, '14_271663slider.png', 3),
(71, '14_272834slider.png', 2),
(72, '14_282568slider.png', 1),
(68, '14_27106slider.png', 4),
(69, '14_271993slider.png', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` int(20) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `categoria`, `titulo`) VALUES
(1, 1, 'Diatónicas'),
(2, 22, 'Consolas'),
(55, 30, 'DR'),
(4, 22, 'Bafles'),
(6, 18, 'clasica'),
(7, 17, 'Clásica'),
(10, 2, 'Cromático'),
(9, 17, 'Acústica'),
(11, 17, 'Liquidos de Limpieza y Kit'),
(12, 19, 'Bluseras'),
(13, 19, 'Cromáticas'),
(14, 19, 'Diatónicas'),
(15, 1, 'A Piano'),
(16, 20, 'Clásica'),
(17, 20, 'Acústicas'),
(18, 9, 'Teclados '),
(31, 2, 'Metrónomos'),
(21, 22, 'Altavoces'),
(22, 22, 'Sistemas de Sonido'),
(23, 22, 'Subwoofers'),
(24, 22, 'Audio Profesional'),
(25, 22, 'Accesorios'),
(26, 1, ''),
(27, 23, 'Acústico'),
(29, 23, 'Violin'),
(30, 20, 'Eléctricas'),
(37, 26, 'Para audio y sonido'),
(33, 24, 'Para instrumentos'),
(34, 24, 'Para micrófonos'),
(35, 24, 'Para pedales'),
(36, 24, 'Para audio'),
(38, 26, 'Para Clarinete, Saxo y Trompeta'),
(39, 26, 'Para Guitarras y Bajos'),
(40, 26, 'Para Mícrófono'),
(41, 26, 'Para Violín'),
(47, 27, 'Microfonos'),
(43, 25, 'Soprano'),
(44, 25, 'Tenor'),
(45, 25, 'Concierto'),
(46, 25, 'Baritono'),
(52, 28, 'Bosphorus'),
(54, 29, 'Electro Harmonix');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_id` int(2) NOT NULL AUTO_INCREMENT,
  `usu_login` varchar(8) NOT NULL,
  `usu_clave` varchar(20) NOT NULL,
  `usu_nombre` varchar(50) NOT NULL,
  `usu_email` varchar(70) NOT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_login` (`usu_login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_login`, `usu_clave`, `usu_nombre`, `usu_email`) VALUES
(1, 'admin', 'hmg2015', 'daniela', 'daniela@mail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
