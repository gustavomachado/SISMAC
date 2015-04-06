-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 08-Mar-2015 às 00:12
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-04:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `marina`
--
-- DROP DATABASE IF EXISTS `marina` ;
CREATE DATABASE IF NOT EXISTS `marina` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `marina`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--
/*
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `conjugue` varchar(45) DEFAULT NULL,
  `tipo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;
*/
--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `foto`, `cpf`, `rg`, `datanascimento`, `ativo`, `nome`, `conjugue`, `tipo`) VALUES
(1, '', '75010690268', '', '1986-01-02', 1, 'gustavo de souza machado', 'caroline marques de macedo', 'f'),
(2, '', '65963059291', '', '2014-12-16', 1, 'alexandre oliveira de araujo', '', 'f'),
(3, '', '', '', '0000-00-00', 1, 'rivaldo junior', '', 'f'),
(4, '', '12772488268', '02318753', '1957-08-06', 1, 'anibal guedes lobo', 'marlene lobo', 'f'),
(5, '', '84134501000150', '', '0000-00-00', 1, 'amazon ecopark', 'davi israel', 'j'),
(6, '', '07811853272', '', '0000-00-00', 1, 'agostinho de oliveira freitas', '', 'f'),
(7, '', '07741030272', '04130170', '0000-00-00', 1, 'ahmed barbosa assi', 'afatecidos', 'f'),
(8, '', '84117506000175', '', '1958-03-07', 1, 'sebastiao bezerra vasconcelos', 'rosangela vasconcelos', 'j'),
(9, '', '34510648200', '5589452', '1960-07-02', 1, 'analeda pessoa de andrade', '', 'f'),
(10, '', '02118049000179', '', '0000-00-00', 1, 'r.g.cardoso-me', 'davi', 'j'),
(11, '', '04411765000175', '', '0000-00-00', 1, 'dodo veiculos', 'pedro marins de menezes filho', 'j'),
(12, '', '05436597000135', '', '0000-00-00', 1, 'novo horizonte', 'rebeca costa dos santos', 'j'),
(13, '', '14032295204', '4033841', '1958-10-20', 1, 'augusto cezar louzada carvalho', 'grace anne', 'f'),
(14, '', '05790315860', '10688931x', '1959-08-16', 1, 'marcos caleffi', 'cristina caleffi', 'f'),
(15, '', '00561150249', '128395', '0000-00-00', 1, 'oldeney sa valente', '', 'f'),
(16, '', '52178706215', '13504908', '0000-00-00', 1, 'jose joaquim teixeira lopes neto', '', 'f'),
(17, '', '27312122841', '', '0000-00-00', 1, 'fabio guarnieri', 'mahite bueno', 'f'),
(18, '', '00563331291', '1030', '0000-00-00', 1, 'eloi pinto de andrade', 'socorro', 'f'),
(19, '', '85019348287', '17953227', '0000-00-00', 1, 'fernando souza', '', 'f'),
(20, '', '52961079008', '9036163906', '1968-04-05', 1, 'marcelo parise', 'eliana nascimento', 'f'),
(21, '', '60097590215', '10932372', '0000-00-00', 1, 'marcelo rodrigues da silva', 'suzy adrielle', 'f'),
(22, '', '41392370230', '10227989', '0000-00-00', 1, 'acacio sergio seco ferreira', '', 'f'),
(23, '', '00703311204', '116253', '1936-06-29', 1, 'raimundo do vale sena', 'cleide bessa', 'f'),
(24, '', '042963125', '13117701', '0000-00-00', 1, 'robson da silva', 'celso alves', 'f'),
(25, '', '13684531200', '04367332', '0000-00-00', 1, 'irlandes braga de almeida', 'leide maria', 'f'),
(26, '', '05065778809', '', '0000-00-00', 1, 'djabir jose kodra', '', 'f'),
(27, '', '66215919268', '', '0000-00-00', 1, 'claudio chaves filho', 'julio cezar', 'f'),
(28, '', '45597700206', '', '0000-00-00', 1, 'marcio amed bastos', 'walace, eduardo,paulo', 'f'),
(29, '', '41811356249', '', '1975-03-30', 1, 'ANTONIO MILITAO DE SOUZA NETO', 'ZAIRA SIMOES', 'f'),
(30, '', '00536962200', '2997077', '1944-06-27', 1, 'ADSTON POMPEU PIZA FILHO', 'ELZA ARAUJO', 'f'),
(31, '', '07999140000164', '11902401', '0000-00-00', 1, 'fbl imports', 'chiquito', 'j'),
(32, '', '00006304974', '2362076', '1974-05-19', 1, 'adalmir durval brito ramos', '', 'f'),
(33, '', '93451660253', '', '0000-00-00', 1, 'jorge maia', 'daniel oliveira filho', 'f'),
(34, '', '19427085000117', '', '0000-00-00', 1, 'formula import', 'cristiano lima', 'j'),
(35, '', '03240219000156', '', '0000-00-00', 1, 'aecs-amazon expeditions ltda', '', 'j'),
(39, '', '04571587000140', '', '0000-00-00', 1, 'alegra ind. e com. ltda', 'peter heugen herog', 'j'),
(40, '', '01191032221', '', '0000-00-00', 1, 'henrique jose mendonÃ§a oliveira filho', 'alessandro bronze toniza', 'f'),
(41, '', '96833335320', '', '0000-00-00', 1, 'jorge torquato', '', 'f'),
(42, '', '07812655253', '', '0000-00-00', 1, 'rubenilson rodrigues mansulo', '', 'f'),
(43, '', '19342080278', '', '0000-00-00', 1, 'afranio george', '', 'f'),
(44, '', '74031171234', '', '0000-00-00', 1, 'sidney leite', '', 'f'),
(45, '', '55978991200', '473650 sspro', '1977-03-12', 1, 'thiago de meneses erse', '', 'f'),
(46, '', '34501215291', '', '0000-00-00', 1, 'luis almir ( TT )', '', 'f'),
(49, '', '34533935000155', '391316 sspam', '0000-00-00', 1, 'j.m dos santos filho e cia ltda', 'jorge mathias', 'j'),
(50, '', '27927040472', '', '2061-06-28', 1, 'cÃ­cero ferreira f. costa filho', 'marly guimarÃ£es f. costa', 'f'),
(51, '', '05443304000147', '', '0000-00-00', 1, 'JANGO CORTINAS', 'JOÃƒO PEREIRA DA SILVA', 'j'),
(52, '', '4525', '', '0000-00-00', 1, 'DAVI ALVES DE MELLO NETO', '', 'f'),
(53, '', '11111', '', '0000-00-00', 1, 'BETAO TRANNSPORTE', 'BETOI', 'j'),
(55, '', '29174716204', '1613869', '0000-00-00', 1, 'UDSON MARANHÃƒO SANTOS DUARTE', '', 'f'),
(59, '', '83703411287', '', '0000-00-00', 1, 'JUAREZ BALDOINO DA COSTA', '', 'f'),
(60, '', '11111111111', '041920244', '1960-01-25', 1, 'DEVANEI GRIGOLETTO ', '', 'f'),
(61, '', '27557170253', '', '0000-00-00', 1, 'oswaldo alves de oliveira filho', '', 'f'),
(62, '', '08842862827', '1078637', '1963-07-21', 1, 'paulo fernando fonseca', '', 'f'),
(63, '', '20082460272', '', '0000-00-00', 1, 'jose wilson carvalho de lima', '', 'f'),
(64, '', '15909355864', '353727767', '0000-00-00', 1, 'rubens mauricio alecio de oliveira', '', 'f'),
(66, '', '12345678900', '1234567899', '0000-00-00', 1, 'marcos costa', '', 'f'),
(67, '', '52838811720', '', '0000-00-00', 1, 'walter reichl filho', '', 'f'),
(68, '', '90146778200', '20575700', '0000-00-00', 1, 'ytahlo azevedo yuri', '', 'f'),
(69, '', '43659241253', '', '0000-00-00', 1, 'marcelo', '', 'f'),
(70, '', '47414200272', '', '0000-00-00', 1, 'jean wakim hanna filho', '', 'f'),
(71, '', '23130008500', '', '0000-00-00', 1, 'ANTONIO CARLOS DE JESUS', '', 'f'),
(72, '', '04562088000196', '', '0000-00-00', 1, 'SORESA REPRESENTAÃ‡Ã•ES LTDA', '', 'j'),
(73, '', '02628724200', '', '0000-00-00', 1, 'RAIMUNDO ANTONINO B. ARAUJO', '', 'f'),
(74, '', '34380086291', '', '0000-00-00', 1, 'fERNANDO PINTO GAZEL', '', 'f'),
(75, '', '01804019000153', '12264601', '0000-00-00', 1, 'SSP-SECRETARIA DE SEGURANÃ‡A PÃšPLICA', 'THOMAS  VASCONCELOS DIAS', 'j'),
(76, '', '11112476253', '', '0000-00-00', 1, 'RAIMUNDO LIRA DE SALES', '', 'f'),
(77, '', '06879276253', '', '0000-00-00', 1, 'BERNARDO WALTER ALMEIDA', 'FANCIELE CAVALCANTE', 'f'),
(78, '', '61575780259', '2366', '0000-00-00', 1, 'ANDRÃ‰ SOUZA D ASILVA', '', 'f'),
(79, '', '22443088200', '596239', '1963-08-14', 1, 'VIVALDO MACIEL DA CUNHA', 'MARIA MARINETE L. DA CUNHA', 'f'),
(80, '', '59264039287', '', '1977-12-14', 1, 'FERNANDO SILVA DE ARAUJO', 'LIDIANE CRISTINA', 'f'),
(81, '', '22798094000129', '', '0000-00-00', 1, 'FLEX IMP. E EXP. DE MAQUINAS', 'ZÃ‰ RENATO', 'j'),
(82, '', '00695424220', '', '0000-00-00', 1, 'DANIEL MOREIRA DE MESQUITA', '', 'f'),
(83, '', '06363067200', '03493547', '0000-00-00', 1, 'JOSÃ‰ MANOEL CARNEIRO FROTA', '', 'f'),
(84, '', '07311823000187', '', '0000-00-00', 1, 'CRC DO BRASIL MINERAÃ‡ÃƒO LTDA', 'MARCELO PINTO', 'j'),
(85, '', '03689603234', '02616653', '0000-00-00', 1, 'VIVALDINO RODRIGUES FEITOSA', 'MARIA DA CONCEIÃ‡ÃƒO', 'f'),
(86, '', '04110765234', '2052385', '1949-01-20', 1, 'EDDY BEZERRA DE SOUZA', 'SIGLIA DINIZ DE SOUZA', 'f'),
(87, '', '51790785200', '', '0000-00-00', 1, 'TULIO MOREIRA ISRAEL', '', 'f'),
(88, '', '69712875415', '', '0000-00-00', 1, 'SERGIO LINS AMORIN', 'MARIA FERNANDA SOUZA', 'f'),
(89, '', '05463597000135', '69037515', '0000-00-00', 1, 'NOVO HORIZONTE', 'REBECA COSTA DOS SANTOS', 'j'),
(90, '', '57306990268', '7641594 SSP MG', '0000-00-00', 1, 'JOSÃ‰ CARLOS RIBEIRO JÃšNIOR', '', 'f'),
(91, '', '66322949204', '5219 oab.am', '0000-00-00', 1, 'andrÃ© de souza oliveira', 'nattasha oliveira', 'f'),
(92, '', '33225656999', '', '0000-00-00', 1, 'jony', '', 'f');

-- --------------------------------------------------------

--
-- Estrutura da tabela `embarcacao`
--
/*
CREATE TABLE IF NOT EXISTS `embarcacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `marcamotor` varchar(45) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `casco` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;
*/
--
-- Extraindo dados da tabela `embarcacao`
--

INSERT INTO `embarcacao` (`id`, `nome`, `cor`, `marcamotor`, `ativo`, `casco`) VALUES
(1, 'embarcaÃ§Ã£o', 'cor', 'motor', 1, 'casco'),
(2, 'emb', 'aojid', 'odji', 1, 'dajis'),
(3, 'mermaid', 'branco/ faixa azul', 'volvo penta', 1, ''),
(4, 'fordlÃ¢ndia', 'branco', 'mercury', 1, ''),
(5, 'wolfgang', 'branco/azul', 'mwm', 1, 'icoma 26 pÃ©s'),
(6, 'acesso ecopark', 'todos', 'todos', 1, ''),
(7, 'lagotrix', 'branco/verde', 'suzuki 115hp', 1, ''),
(8, 'acesso agostinho', 'bote', 'bote', 1, ''),
(9, 'vitoria ', 'branco', 'mariner 225 hp', 1, ''),
(10, 'ana luisa', 'preto/branco', 'yamaha 60 hp', 1, ''),
(11, 'anjo i', 'branco/ azul', 'volvo penta 200hp', 1, ''),
(12, 'atrium', 'branco/ preto', 'mwm', 1, ''),
(13, 'ava1 e ava2 ', 'branco', 'cumins/volvo', 1, ''),
(14, 'anathi 2', 'branco', '2 mercruiser 220 hp', 1, '30 pes'),
(15, 'novo horizonte', 'branco/ vermelha', '2 mercruiser 270 hp', 1, '35 pes'),
(16, 'bethoven', 'branco/ preto', 'scania 315 hp', 1, '22 mts'),
(17, 'bella', 'branco', '2 mercedes 200 hp', 1, '33 pes'),
(18, 'bibi valente', 'branco/ preto', 'suzuki 140 hp', 1, '7,5 mts'),
(19, 'big daad', 'branco /azul', 'mercruiser 300 hp', 1, '25 pes'),
(20, 'bloody mary', 'branco/ vermelho', 'volvo penta 300 hp', 1, '23 pes'),
(21, 'bossa nova', 'branco', 'cat 360 hp', 1, '20 mts'),
(22, 'bote laranja', 'laranja', 'yamaha 15 hp', 1, '6 mts'),
(23, 'caiaques', 'verde', '2', 1, ''),
(24, 'cap.marcelinho', 'branco/ preto', 'yamaha 115 hp', 1, '19 pes'),
(25, 'coimbra', 'branco / azul', 'volvo penta', 1, '20 pes'),
(26, 'coronel teixeira', 'branco/ vermelho', 'mwm 160 hp', 1, '12,50 mts'),
(27, 'crd1', 'branco/ azul', 'volvo penta 270 hp', 1, '21 pes'),
(28, 'djabout', 'branco/ preto ', 'mercruiser 200 hp', 1, '19 pes'),
(29, 'dolphin', 'branco', 'mercruiser 200 hp', 1, '19 pes'),
(30, 'don don ', 'branco', 'yamaha 115 hp', 1, '19 pes'),
(31, 'dona eliSA', 'BRANCO /AZUL', 'MERCRUISER DIESEL 200 HP', 1, '20 PES'),
(32, 'DONA OLGA', 'BRANCO /CINZA', 'MERCRUISER 220 HP', 1, '20 PES'),
(33, 'DUNA', 'BRANCO /CINZA', '2 VOLVO PENTA 200 HP', 1, '33 PES'),
(34, 'fbl racing', 'branco/ azul', '3 mercruiser 600 hp', 1, '42 pes'),
(35, 'fe 1', 'branco/ vermelho', 'mercruiser 350 hp', 1, '25 pes'),
(36, 'fe 2', 'branco / vermelho', 'kawasaki 160 hp', 1, ''),
(37, 'fe 3', 'branco', 'nnnn', 1, ''),
(38, 'fabio preta', 'preto/ branco', 'mercruiser 350 hp', 1, '28 pes'),
(39, 'bote jorge maia', 'branco e azul', 'yamaha 60hp', 1, '7 metros'),
(40, 'ayahuasca', 'branca e preta', 'yamaha 115hp', 1, 'ventura 19,5 pes'),
(41, 'desafio', 'branco e madeira', '2 caterpillar', 1, ''),
(42, 'alegra', 'azul', 'yamaha 200hp', 1, '21 pÃ©s'),
(43, 'apoema 2', 'azul e branca', '', 1, 'sea ray 22 pÃ©s'),
(44, 'baja', 'cinza', 'mercruiser', 1, '27 pÃ©s'),
(45, 'balada', 'preta e branca', 'mercruiser 4.3', 1, '21 pÃ©s'),
(46, 'comdt. george', 'branco', 'mwm 114', 1, '11 metros'),
(47, 'delle', 'branca e azul', 'mercruiser 350 hp', 1, '25 pÃ©s ventura'),
(48, 'erse', 'preto branco e vermelho', '', 1, '19 pÃ©s sea ray'),
(49, 'falak', 'branca e azul', 'yamaha 115 hp', 1, '19,5 pÃ©s ventura'),
(50, 'ha kunamatata', 'branca com faixas', 'volvo penta', 1, '29 pÃ©s'),
(51, 'hopi hari', 'branca e azul', 'mercury 225 hp', 1, '25,5 pÃ©s focker'),
(52, 'FUGITIVA', 'BRANCA COM FAIXAS', 'VOLVO PENTA', 1, '44 PÃ‰S'),
(53, 'GREEN SOUL', ' VERDE E BRANCO', 'MERCUISER V-6', 1, '19 PÃ‰S'),
(54, 'GURIA', 'BRANCA E AZUL', 'SUZUKI 140', 1, '19 PÃ‰S'),
(55, 'IATE MRIE', 'BRANCO', '', 1, '26M'),
(56, 'IRENE', 'BRANCA', 'MERCRUISER V-8', 1, '28,55 BAY LINER'),
(57, 'infinity', 'branca', 'yanmar 600', 1, '30m'),
(58, 'asas de fogo', 'amarelo', 'yamaha 210 hp', 1, 'wave runner'),
(59, 'jet bebesita', 'amarelo e branco', 'bombardier 130hp', 1, '3 lugares'),
(60, 'jet gold star', 'branco e verde', 'bombardier 130 hp', 1, 'sea-doo'),
(61, 'jet gigriolla', 'vermelho e preto', 'bombardier130hp', 1, 'sea-doo'),
(62, 'jet marcos', 'prata e preto', 'yamaha', 1, 'wave runner'),
(63, 'jet orion 1', 'cinza', 'yamaha', 1, 'wave runner'),
(64, 'jet pÃ© de pano', 'amarelo e branco', 'bombaedier', 1, 'sea-doo'),
(65, 'jet super film', 'prata', 'yamaha', 1, 'wave runner'),
(66, 'JET LE BANON', 'PRETO E LARANJA', 'BOMBARDIER', 1, 'SEA DOO'),
(67, 'JET STELLA MARIS', 'PRETO E AMARELO', 'YAMAHA', 1, 'WAVE RUNNER'),
(68, 'JÃ´', 'CINZA', 'VOLVO PENTA', 1, 'CORONETE 32'),
(69, 'LADY QUEEN', 'BRANCO E PRETO', 'VOLVO PENTA', 1, 'BAY LINER '),
(70, 'LADY RAYEELE', 'BRANCA E AZUL', 'MECRUISER V-8', 1, 'REGAL 26 PÃ‰S'),
(71, 'LANCHAS SSP', '', '', 1, ''),
(72, 'BARCO LIRA', 'ALUMINIO', 'SCANIA', 1, '30 M'),
(73, 'LORENA III', 'PREATA E LARANJA', 'YAMAHA 200HP', 1, '8M'),
(74, 'MABEL', 'AZUL BRANCA E AMARELA', 'MERCRUISER 350HP', 1, 'REGAL 25 PÃ‰S'),
(75, 'MADAME', 'BRANCO', 'MWM 250', 1, '19 M'),
(76, 'JET BIBI V. M', 'BRANCA E PRETA', 'BOMBARDIER', 1, 'SEA-DOO'),
(77, 'MARCELA', 'AZUL E BRANCA', 'VOLVO PENTA 200HP', 1, 'BAY LINER 27 PÃ‰S'),
(78, 'MARESIAS', 'PRETA E BRANCA', '2 VOLVO PENTA', 1, '44 PÃ‰S REGAL'),
(79, 'MARIA EDUARDA', 'PRETA E BRANCA', 'MERCRUISER 350', 1, 'SEA RAY 26 PÃ‰S'),
(80, 'MARIA HELENA', 'BRANCA', 'MERCURY 225', 1, '19 PÃ‰S DIAMAR'),
(81, 'MINA CUNHÃƒ', 'BRANCA COM FAIXAS', '115 YAMAHA', 1, '19,5PÃ‰S'),
(82, 'MINEUVA', 'BRANCO E PRETO', 'SCANIA', 1, '16 M'),
(83, 'MODERNA', '', 'VOLVO PENTA', 1, 'REGAL 22PÃ‰S'),
(84, 'MOLEQUE', 'PRETA', 'MERCURY 90', 1, '19 PÃ‰S'),
(85, 'MUCHACHA', 'PRETA', 'VOLVO PENTA', 1, '12M'),
(86, 'NOVO HORIZONTE 1', 'BRANCA', 'MERCUISER DIESEL', 1, '35 PÃ‰S'),
(87, 'JET NOVO HORIZONTE', 'VERDE E BRANCO', 'BOMBARDIER', 1, 'SEA DOO'),
(88, 'NA BASE', 'BRANCA COM FAIXAS', 'MERCRUISER V6', 1, '20 PÃ‰S PRO WAKE'),
(89, 'oliveira ii', 'branco e preto', 'mercury', 1, '26,5 ventura'),
(90, 'jet oliveira', 'verde e branco', 'rotax', 1, 'bombardier'),
(91, 'mac 2', '', '', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--
/*
CREATE TABLE IF NOT EXISTS `contrato` (
  `idcliente` int(11) NOT NULL,
  `idembarcacao` int(11) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `datainicio` date NOT NULL,
  `datafim` date DEFAULT NULL,
  `vencimento` smallint(6) NOT NULL,
  `mensalidade` float NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `tipo` varchar(3) NOT NULL,
  PRIMARY KEY (`id`,`idcliente`,`idembarcacao`),
  KEY `fk_cliente_has_embarcacao_embarcacao1_idx` (`idembarcacao`),
  KEY `fk_cliente_has_embarcacao_cliente_idx` (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;
*/
--
-- Extraindo dados da tabela `contrato`
--

INSERT INTO `contrato` (`idcliente`, `idembarcacao`, `id`, `datainicio`, `datafim`, `vencimento`, `mensalidade`, `ativo`, `tipo`) VALUES
(1, 1, 1, '2015-02-08', '0000-00-00', 10, 300, 1, 'pre'),
(1, 2, 2, '2015-02-10', '0000-00-00', 5, 362, 1, 'pos'),
(2, 3, 3, '2015-12-16', '0000-00-00', 16, 788, 1, 'pos'),
(3, 4, 4, '2015-01-29', '0000-00-00', 14, 550, 1, 'pos'),
(4, 5, 5, '2014-11-06', '0000-00-00', 6, 1180, 1, 'pos'),
(5, 6, 6, '2007-08-03', '0000-00-00', 3, 1576, 1, 'pos'),
(5, 7, 7, '2011-03-24', '0000-00-00', 24, 788, 1, 'pos'),
(6, 8, 8, '2007-09-01', '0000-00-00', 30, 506, 1, 'pos'),
(7, 9, 9, '2013-11-30', '0000-00-00', 30, 788, 1, 'pos'),
(8, 10, 10, '2010-03-04', '0000-00-00', 4, 620.4, 1, 'pre'),
(9, 11, 11, '2013-10-06', '0000-00-00', 10, 1090, 1, 'pre'),
(10, 12, 12, '2014-07-04', '0000-00-00', 15, 1576, 1, 'pos'),
(11, 13, 13, '2005-07-01', '0000-00-00', 30, 1605, 1, 'pos'),
(11, 14, 14, '2014-09-19', '0000-00-00', 19, 1576, 1, 'pos'),
(12, 15, 15, '2015-02-13', '0000-00-00', 13, 394, 1, 'pos'),
(13, 16, 16, '2008-10-14', '0000-00-00', 14, 1899, 1, 'pos'),
(14, 17, 17, '2009-05-23', '0000-00-00', 23, 1970, 1, 'pos'),
(15, 18, 18, '2009-02-08', '0000-00-00', 30, 680.25, 1, 'pos'),
(16, 19, 19, '2014-08-12', '0000-00-00', 30, 1182, 1, 'pos'),
(17, 20, 20, '2011-12-22', '0000-00-00', 22, 1182, 1, 'pos'),
(18, 21, 21, '2011-07-30', '0000-00-00', 30, 1594, 1, 'pos'),
(19, 22, 22, '2014-10-15', '0000-00-00', 15, 250, 1, 'pos'),
(20, 23, 23, '2011-01-30', '0000-00-00', 30, 120, 1, 'pos'),
(21, 24, 24, '2014-03-22', '0000-00-00', 22, 788, 1, 'pos'),
(22, 25, 25, '2013-09-21', '0000-00-00', 21, 788, 1, 'pos'),
(23, 26, 26, '2006-09-07', '0000-00-00', 7, 623, 1, 'pos'),
(24, 27, 27, '2013-08-01', '0000-00-00', 31, 788, 1, 'pos'),
(25, 28, 28, '2011-05-11', '0000-00-00', 11, 788, 1, 'pos'),
(26, 29, 29, '2005-07-01', '0000-00-00', 15, 788, 1, 'pos'),
(27, 30, 30, '2010-08-26', '0000-00-00', 26, 788, 1, 'pos'),
(28, 31, 31, '2012-07-18', '0000-00-00', 30, 788, 1, 'pos'),
(29, 32, 32, '2013-03-09', '0000-00-00', 10, 788, 1, 'pos'),
(30, 33, 33, '2006-05-01', '0000-00-00', 30, 1182, 1, 'pos'),
(31, 34, 34, '2012-05-22', '0000-00-00', 22, 1970, 1, 'pos'),
(32, 35, 35, '2014-11-22', '0000-00-00', 22, 1182, 1, 'pos'),
(32, 36, 36, '2014-11-22', '0000-00-00', 22, 394, 1, 'pos'),
(32, 37, 37, '2014-11-22', '0000-00-00', 22, 22.22, 1, 'pos'),
(11, 38, 38, '2014-10-24', '0000-00-00', 24, 1576, 1, 'pos'),
(33, 39, 39, '2013-11-01', '0000-00-00', 1, 788, 1, 'pre'),
(34, 40, 40, '2014-08-18', '0000-00-00', 18, 788, 1, 'pre'),
(35, 41, 41, '2012-11-11', '0000-00-00', 11, 2364, 1, 'pre'),
(39, 42, 42, '2006-12-03', '0000-00-00', 3, 788, 1, 'pre'),
(40, 43, 43, '2014-11-29', '0000-00-00', 29, 1182, 1, 'pre'),
(41, 44, 44, '2014-04-12', '0000-00-00', 12, 1970, 1, 'pre'),
(42, 45, 45, '2014-03-19', '0000-00-00', 19, 788, 1, 'pre'),
(43, 46, 46, '2014-09-06', '0000-00-00', 6, 1182, 1, 'pre'),
(44, 47, 47, '2012-11-05', '0000-00-00', 5, 1182, 1, 'pre'),
(45, 48, 48, '2011-04-06', '0000-00-00', 6, 788, 1, 'pre'),
(46, 49, 49, '2014-08-23', '0000-00-00', 23, 707, 1, 'pre'),
(49, 50, 50, '2005-07-01', '0000-00-00', 30, 1182, 1, 'pre'),
(50, 51, 51, '2010-09-11', '0000-00-00', 11, 1182, 1, 'pre'),
(51, 52, 52, '2013-03-03', '0000-00-00', 8, 2172, 1, 'pre'),
(52, 53, 53, '2011-09-02', '0000-00-00', 2, 788, 1, 'pre'),
(53, 54, 54, '2010-01-12', '0000-00-00', 12, 693.44, 1, 'pre'),
(55, 55, 55, '2014-08-20', '0000-00-00', 20, 2364, 1, 'pre'),
(59, 56, 56, '2013-01-20', '0000-00-00', 22, 1576, 1, 'pre'),
(60, 57, 57, '2009-09-19', '0000-00-00', 1, 3940, 1, 'pre'),
(61, 58, 58, '2014-08-08', '0000-00-00', 8, 394, 1, 'pre'),
(62, 59, 59, '2012-06-06', '0000-00-00', 6, 379, 1, 'pre'),
(63, 60, 60, '2014-09-05', '0000-00-00', 5, 394, 1, 'pre'),
(64, 61, 61, '2014-06-07', '0000-00-00', 7, 394, 1, 'pre'),
(66, 62, 62, '2013-03-09', '0000-00-00', 9, 300, 1, 'pre'),
(67, 63, 63, '2012-04-21', '0000-00-00', 21, 394, 1, 'pre'),
(68, 64, 64, '2014-09-25', '0000-00-00', 7, 394, 1, 'pre'),
(69, 65, 65, '2012-05-27', '0000-00-00', 26, 315, 1, 'pre'),
(70, 66, 66, '2014-08-15', '0000-00-00', 15, 394, 1, 'pre'),
(71, 67, 67, '2010-07-23', '0000-00-00', 30, 354.6, 1, 'pre'),
(72, 68, 68, '2005-07-01', '0000-00-00', 15, 1522, 1, 'pre'),
(73, 69, 69, '1013-10-15', '0000-00-00', 15, 2200, 1, 'pre'),
(74, 70, 70, '2013-01-25', '0000-00-00', 25, 1182, 1, 'pre'),
(75, 71, 71, '2005-07-06', '0000-00-00', 30, 6227.05, 1, 'pre'),
(76, 72, 72, '2005-07-01', '0000-00-00', 30, 400, 1, 'pre'),
(77, 73, 73, '2013-02-25', '0000-00-00', 25, 788, 1, 'pre'),
(78, 74, 74, '2014-09-20', '0000-00-00', 20, 1182, 1, 'pre'),
(79, 75, 75, '2012-08-01', '0000-00-00', 1, 1880, 1, 'pre'),
(79, 76, 76, '2012-05-01', '0000-00-00', 1, 394, 1, 'pre'),
(80, 77, 77, '2014-03-07', '0000-00-00', 7, 1576, 1, 'pre'),
(81, 78, 78, '2013-08-30', '0000-00-00', 30, 2681.05, 1, 'pre'),
(82, 79, 79, '2011-12-02', '0000-00-00', 2, 1447.6, 1, 'pre'),
(83, 80, 80, '2014-05-30', '0000-00-00', 30, 550, 1, 'pre'),
(84, 81, 81, '2010-08-07', '0000-00-00', 7, 698, 1, 'pre'),
(85, 82, 82, '2014-05-12', '0000-00-00', 12, 788, 1, 'pre'),
(86, 83, 83, '2010-07-11', '0000-00-00', 11, 950.86, 1, 'pre'),
(87, 84, 84, '2010-09-07', '0000-00-00', 16, 788, 1, 'pre'),
(88, 85, 85, '2010-04-24', '0000-00-00', 24, 1970, 1, 'pre'),
(89, 86, 86, '2015-01-29', '0000-00-00', 29, 1970, 1, 'pre'),
(89, 87, 87, '2015-02-13', '0000-00-00', 13, 394, 1, 'pre'),
(90, 88, 88, '2011-07-04', '0000-00-00', 4, 788, 1, 'pre'),
(91, 89, 89, '2014-08-12', '0000-00-00', 15, 1576, 1, 'pre'),
(91, 90, 90, '1014-08-12', '0000-00-00', 15, 394, 1, 'pre'),
(92, 91, 91, '2015-03-07', '0000-00-00', 10, 300, 1, 'pos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `email`
--
/*
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`idcliente`),
  KEY `fk_email_cliente1_idx` (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;
*/
--
-- Extraindo dados da tabela `email`
--

INSERT INTO `email` (`id`, `email`, `idcliente`, `ativo`) VALUES
(1, 'alo-entulho@hotmail.com', 2, 1),
(2, 'aniballobus@hotmail.com', 4, 1),
(3, 'agostinho@internext.com.br', 6, 1),
(4, 'afatecidos@uol.com.br', 7, 1),
(5, 'rosangela.bentes@hotmail.com', 8, 1),
(6, 'r.o.novohorizonte@yahoo.com.br', 12, 1),
(7, 'acesar@vivax.com.br', 13, 1),
(8, 'jjneto333@gmail.com', 16, 1),
(9, 'fabio@outitude.com.br', 17, 1),
(10, 'eloi@eloiefilhos.adv.br', 18, 1),
(11, 'fernando@codama.com.br', 19, 1),
(12, 'mparise13@yahoo.com.br', 20, 1),
(13, 'casadaprotecao.cp@hotmail.com', 21, 1),
(14, 'rj14@uol.com.br', 23, 1),
(15, 'karen.amaral@crd1.com.br', 24, 1),
(16, 'irlandesbraga@tov.com.br', 25, 1),
(17, 'djabir.kodra@ddwson.com', 26, 1),
(18, 'jca_adv@hotmail.com', 27, 1),
(19, 'maobam@gmail.com', 28, 1),
(20, 'ANTMILNETO@HOTMAIL.COM', 29, 1),
(21, 'ADSTON_PIZA@YAHOO.COM.BR', 30, 1),
(22, 'dr7financeiro2@hotmail.com', 32, 1),
(23, 'alegra@alegranautica.com.br', 39, 1),
(24, 'pfernandocastagnari@terra.com.br', 62, 1),
(25, 'j.wilson-carvalho@hotmail.com', 63, 1),
(26, 'JEANHANNA@HOTMAIL.COM', 70, 1),
(27, 'ACJFORMULA@GMAIL.COM', 71, 1),
(28, 'DIRCESOUZA@UOL.COM.BR', 72, 1),
(29, 'BERNARDOWALTERALMEIDA@YAHOO.COM', 77, 1),
(30, 'ANDRESOUZA@MSN.COM', 78, 1),
(31, 'FERNANDO_ _ARAUJO@HOTMAIL.COM', 80, 1),
(32, 'SIDNEY@FLEX-AM.COM.BR', 81, 1),
(33, 'FATIMA.MARQUES@BDMAIL.COM.BR', 82, 1),
(34, 'VIVALDINO@METALFINOAM.COM.BR', 85, 1),
(35, 'GRAFICAMODERNA@NETIUM.COM.BR', 86, 1),
(36, 'TULHIO@PORTALVIDROSAM.COM.BR', 87, 1),
(37, 'RO_NOVOHORIZONTE@YAHOO.COM.BR', 89, 1),
(38, 'andre@assessoriacorporativa.adv.br', 91, 1);


-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--
/*
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `cep` varchar(11) DEFAULT NULL,
  `ativo` varchar(45) NOT NULL,
  `tipo` char(1) NOT NULL,
  PRIMARY KEY (`id`,`idcliente`),
  KEY `fk_endereco_cliente1_idx` (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;
*/
--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `idcliente`, `rua`, `bairro`, `cidade`, `estado`, `numero`, `complemento`, `referencia`, `cep`, `ativo`, `tipo`) VALUES
(1, 1, 'aishud', 'iuhaihud', 'iuhda', 'AM', '106', '', '', '66666666', '1', 'c'),
(2, 2, '23 quadra A29 ', 'conj. jardim de versalles', 'Manaus', 'AM', '17', '', '', '69044700', '1', 'c'),
(3, 4, 'rua: nova', 'aleixo', 'Manaus', 'AM', '561', '', '', '69060830', '1', 'c'),
(4, 5, 'rua : auxiliadora ', 'centro', 'Manaus', 'AM', '04', 'praÃ§a auxiliadora', '', '69020190', '1', 'c'),
(5, 6, 'efigenio sales rua envira', 'aleixo', 'Manaus', 'AM', '135', 'conj.efigenio sales', '', '69060020', '1', 'r'),
(6, 7, 'rua:joaquim sarmento', 'centro', 'Manaus', 'AM', '10 a', '', '', '69010020', '1', 'c'),
(7, 8, 'av: sao pedro', 'compensa ii', 'Manaus', 'AM', '233', '', '', '69035210', '1', 'c'),
(8, 8, 'av.pedro teixeira q-12', 'd.pedro 1', 'manaus', 'am', '1', 'deborah', '', '69040000', '1', 'r'),
(9, 9, 'rua:araxÃ¡', 'flores ', 'Manaus', 'AM', '29', 'conj duque de caxias', '', '69043120', '1', 'r'),
(10, 10, 'rua: rio barao do jaceguai', 'parque das laranjeiras', 'Manaus', 'AM', '12', '', '', '69058180', '1', 'c'),
(11, 11, 'av. ramos ferreira ', 'centro', 'Manaus', 'AM', '2372', '', '', '69020080', '1', 'c'),
(12, 12, 'rua:jose augusto de queiroz', 'nova esperanÃ§a', 'Manaus', 'AM', '16', '', '', '69037515', '1', 'c'),
(13, 13, 'rua:03 q/f cond.parque aripuana', 'd.pedro', 'Manaus', 'AM', '04', '', '', '69040612', '1', 'r'),
(14, 13, 'rua:criciuma', 'alvorada', 'manaus', 'am', '2011', '', '', '69043140', '1', 'c'),
(15, 14, 'rua:seringas conj.acariquara', 'coroado', 'Manaus', 'AM', '60', '', '', '69082676', '1', 'r'),
(16, 15, 'rua:rio madeira conj.vieira alves', 'n.sra.das graÃ§as', 'Manaus', 'AM', '154', '', '', '69053030', '1', 'c'),
(17, 16, 'rua ;04 ', 'd.pedro', 'Manaus', 'AM', '08', '', '', '69040613', '1', 'r'),
(18, 17, 'rua: salvador  12 andar business center', 'vieira alves', 'Manaus', 'AM', '120', '', '', '69057040', '1', 'c'),
(19, 18, 'rua:dr. machado ', 'centro', 'Manaus', 'AM', '137', '', '', '69013000', '1', 'c'),
(20, 19, 'rua:rio jutai  ap.701 conj.saint patrick', 'vieira alves', 'Manaus', 'AM', '1139', '', '', '69053020', '1', 'c'),
(21, 20, 'rua: caravelle', 'taruma', 'Manaus', 'AM', '5a', '', '', '69022280', '1', 'c'),
(22, 23, 'rua:rio javari q/33 vieira alves', 'n.sra.das graÃ§as', 'Manaus', 'AM', '14 a', '', '', '69053110', '1', 'r'),
(23, 24, 'rua:general carneiro', 'sao francisco', 'Manaus', 'AM', '385', '', '', '69079020', '1', 'c'),
(24, 25, 'rua : 24 de maio 7 andar sala 708 e 709 ed.rio negro center', 'centro', 'Manaus', 'AM', '220', '', '', '69010080', '1', 'c'),
(25, 25, 'rua:glaudencio ramos ', 'sao francisco', 'manaus', 'am', '02', '', '', '69010080', '1', 'r'),
(26, 26, 'rua;ab conj.morada do sol', 'aleixo', 'Manaus', 'AM', '04', '', '', '69080780', '1', 'c'),
(27, 27, 'rua;lindon johnson c 13', 'parque 10', 'Manaus', 'AM', '55', '', '', '69054712', '1', 'r'),
(28, 28, 'av:coronel teixeira cond.aquarelle ap 703 ciano ', 'ponta negra', 'Manaus', 'AM', '4475', '', '', '69037000', '1', 'r'),
(29, 29, 'AV:CORONEL TEIXEIRA ', 'PONTA NEGRA', 'Manaus', 'AM', '2113', '', '', '69037000', '1', 'c'),
(30, 30, 'RUA:SALVADOR AP 804', 'ADRIANOPOLIS', 'Manaus', 'AM', '225', '', '', '69057040', '1', 'c'),
(31, 31, 'raimundo parente', 'canaa', 'Manaus', 'AM', '', '', '', '', '1', 'c'),
(32, 32, 'av:coronel teixeira cond.ilhas gregas ap 702', 'ponta negra', 'Manaus', 'AM', '00050', '', '', '69307063', '1', 'r'),
(33, 33, 'rua criciÃºma nÂº 370 alvorada-2', 'avorada -2', 'Manaus', 'AM', '', '', '', '69042049', '1', 'c'),
(34, 34, 'rua ferreira pena', 'centro', 'Manaus', 'AM', '2387', '', '', '', '1', 'c'),
(35, 35, 'dulcemar', 'sao jorge - vila militar', 'Manaus', 'AM', '60', '', '', '69033810', '1', 'c'),
(36, 39, 'av. efigenio sales ', 'parque-10', 'Manaus', 'AM', '127', '', '', '69057050', '1', 'c'),
(37, 40, 'jose de arimatÃ©ia', 'adrianÃ³polis', 'Manaus', 'AM', '1088', '', '', '69060081', '1', 'c'),
(38, 41, 'monte gerizin', 'pq. das laranjeiras - flors', 'Manaus', 'AM', '16', '', '', '69058400', '1', 'c'),
(39, 42, 'tokio', 'parque-1o  conj. jardim oriente', 'Manaus', 'AM', '20', '', '', '', '1', 'c'),
(40, 43, 'av. pedro teixeira', 'd. pedro cond. thiago de melo ap-1602 torre-b', 'Manaus', 'AM', '2292', '', '', '', '1', 'c'),
(41, 44, 'av tokio', 'campos eliseos - planalto', 'Manaus', 'AM', '160', '', '', '', '1', 'r'),
(42, 45, 'av. expedicionÃ¡rios', 'ed. farol da ponta negra apto-1402', 'Manaus', 'AM', '2163', '', '', '', '1', 'c'),
(43, 46, 'av. coronel teixeira', 'residencial ponta negra-2   ponta negra', 'Manaus', 'AM', '15', '', '', '', '1', 'c'),
(44, 49, 'av. torquato tapajos', 'flores', 'Manaus', 'AM', '5056', '', '', '', '1', 'c'),
(45, 50, 'av. efigenio sales ', 'aleixo - casa- 95', 'Manaus', 'AM', '1980', '', '', '69060020', '1', 'c'),
(46, 51, 'JANGO CORTINAS', 'DENTRO', 'Manaus', 'AM', '', '', '', '', '1', 'c'),
(47, 53, 'AAAAA', 'BBBBB', 'Manaus', 'AM', '', '', '', '', '1', 'c'),
(48, 55, 'ALVARO MOREIRA', 'PARQUE SÃƒO PEDRO - TARUMÃƒ', 'Manaus', 'AM', '108', '', '', '', '1', 'c'),
(49, 59, 'RUA-11', 'PQ-10 PARQUE TROPICAL', 'Manaus', 'AM', '09', '', '', '69055740', '1', 'c'),
(50, 60, 'av. torquato tapajos', 'flores', 'Manaus', 'AM', '1262', '', '', '69048660', '1', 'c'),
(51, 61, 'rua autazes', 'res. ephygenio salles - aleixo', 'Manaus', 'AM', '40', '', '', '', '1', 'c'),
(52, 62, 'av. coronel teixeira', 'ponta negra', 'Manaus', 'AM', '1320', '', '', '69037000', '1', 'c'),
(53, 63, 'alameda dos aÃ§aÃ­s', 'cond. res. laranjeiras - flores', 'Manaus', 'AM', '201', '', '', '69048750', '1', 'c'),
(54, 64, 'nao consta', 'nao consta', 'Manaus', 'AM', '', '------', '', '', '1', 'c'),
(55, 66, 'nao consta', 'nao consta', 'Manaus', 'AM', '', '', '', '111111', '1', 'c'),
(56, 67, 'rua-14', 'conj.castelo branco pq-10', 'Manaus', 'AM', '442', '', '', '69055320', '1', 'c'),
(57, 68, 'guilherme moreira', 'centro', 'Manaus', 'AM', '296', '', '', '69005300', '1', 'c'),
(58, 69, 'rua c5', 'conj. ajuricaba bairro- planalto', 'Manaus', 'AM', '398', '', '', '', '1', 'c'),
(59, 70, 'est. do tarumÃ£', 'COND. RES. TARUMÃƒ - TARUMÃƒ', 'Manaus', 'AM', '2000', '', '', '69022155', '1', 'c'),
(60, 71, 'RUA RECIFE', 'ADRIANÃ“POLIS APT-202', 'Manaus', 'AM', '639', '', '', '69057001', '1', 'c'),
(61, 72, 'PRAÃ‡A HELIODORO BALBI', 'CENTRO', 'Manaus', 'AM', '86', '', '', '69005000', '1', 'r'),
(62, 73, 'AV. CORONEL TEIXEIRA', 'RES. BARRA DO RIO NEGRO BAIRRO - PONTA NEGRA', 'Manaus', 'AM', '1759', '', '', '69057000', '1', 'c'),
(63, 74, 'AV. PEDRO TEIXEIRA', 'D.PEDRO1 COND. THIAGO DE MELO 504B', 'Manaus', 'AM', '2292', '', '', '', '1', 'c'),
(64, 75, 'AV. TORQUATO TAPAJOS', 'FLORES', 'Manaus', 'AM', '5555', '', '', '', '1', 'c'),
(65, 76, 'RUA MANGIRONA', 'PLANALTO. QUADRA-F CASA-06 FLAMANAL', 'Manaus', 'AM', '06', '', '', '', '1', 'c'),
(66, 78, 'RUA RIO JUTAI APTO 401 ED. CAP.FERRETI', 'VIEIRALVES', 'Manaus', 'AM', '45', '', '', '69053020', '1', 'c'),
(67, 79, 'RUA AUSTRIA', 'PQ. DAS NAÃ‡Ã•ES', 'Manaus', 'AM', '261', '', '', '69028060', '1', 'c'),
(68, 80, 'RUA ACRE BL-27C AP-16', 'CJ.ELDORADO PQ-10', 'Manaus', 'AM', '16', '', '', '69050450', '1', 'c'),
(69, 81, 'AV. BURITI', 'D. INDUSTRIAL', 'Manaus', 'AM', '4821', '', '', '69075000', '1', 'c'),
(70, 82, 'RUA CRISTINA TAVARES', 'PLANALTO- JARDIM VERSALES', 'Manaus', 'AM', '150', '', '', '69044740', '1', 'c'),
(71, 83, 'AV. SOLIMÃ•ES', 'STO. AGOSTINHO', 'Manaus', 'AM', '66', '', '', '69037710', '1', 'c'),
(72, 84, 'RUA-1 CASA-3 CONJ. PQ. ARIPUANÃƒ', 'D. PEDRO', 'Manaus', 'AM', '3', '', '', '69040610', '1', 'c'),
(73, 85, 'RUA JONAS BARRETO', 'SÃƒO LÃZARO', 'Manaus', 'AM', '36', '', '', '69073570', '1', 'c'),
(74, 86, 'AV. ANDRÃ‰ ARAÃšJO', 'ALEIXO', 'Manaus', 'AM', '2075', '', '', '69075700', '1', 'c'),
(75, 87, 'RUA VITÃ“RIA', 'FLORES', 'Manaus', 'AM', '101', '', '', '69058340', '1', 'c'),
(76, 88, 'RUA EMÃLIO MOREIRA', 'PRAÃ‡A-14', 'Manaus', 'AM', '638', '', '', '', '1', 'c'),
(77, 89, 'RUA JOSÃ‰ AUGUSTO DE QUEIROZ ', 'NOVA ESPERANÃ‡A', 'Manaus', 'AM', '16', '', '', '69037000', '1', 'c'),
(78, 90, 'NAO CONSTA', 'NAO CONSTA', 'Manaus', 'AM', '', '', '', '', '1', 'c'),
(79, 91, 'rua franco de sÃ¡', 'sÃ£o francisco - edifÃ­cil amazon trade center 4Âºandar sala-406', 'Manaus', 'AM', '270', '', '', '69079210', '1', 'c');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--
/*
CREATE TABLE IF NOT EXISTS `mensalidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acrescimo` float DEFAULT '0',
  `mesreferencia` smallint(6) NOT NULL,
  `formapagamento` varchar(50) NOT NULL,
  `idcontrato` bigint(20) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  `dataPagamento` date DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `desconto` float DEFAULT '0',
  `anoreferencia` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mensalidade_contrato1_idx` (`idcontrato`),
  KEY `fk_mensalidade_usuario1_idx` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=586 ;
*/
--
-- Extraindo dados da tabela `mensalidade`
--
 
-- --------------------------------------------------------

--
-- Estrutura da tabela `parametros`
--
/*
CREATE TABLE IF NOT EXISTS `parametros` (
  `idparametro` int(11) NOT NULL AUTO_INCREMENT,
  `chave` varchar(45) NOT NULL,
  `valor` varchar(45) NOT NULL,
  PRIMARY KEY (`idparametro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/
-- --------------------------------------------------------

--
-- Estrutura da tabela `recibo`
--
/*
CREATE TABLE IF NOT EXISTS `recibo` (
  `idrecibo` bigint(20) NOT NULL AUTO_INCREMENT,
  `valor` varchar(45) DEFAULT NULL,
  `recebido` varchar(45) DEFAULT NULL,
  `recibocol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrecibo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/
-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--
/*
CREATE TABLE IF NOT EXISTS `telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(15) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `operadora` varchar(45) DEFAULT NULL,
  `tipo` char(1) NOT NULL,
  PRIMARY KEY (`id`,`idcliente`),
  KEY `fk_telefone_cliente1_idx` (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;
*/
--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`id`, `telefone`, `idcliente`, `ativo`, `operadora`, `tipo`) VALUES
(1, '092992041037', 1, 1, 'Vivo', 'c'),
(2, '092981290003', 2, 1, 'TIM', 'c'),
(3, '09232387724', 2, 1, 'OI', 'r'),
(4, '092981339964', 4, 1, 'TIM', 'c'),
(5, '092991460588', 5, 1, 'Vivo', 'c'),
(6, '09236222612', 5, 1, 'OI', 'r'),
(7, '092981340952', 6, 1, 'TIM', 'r'),
(8, '09236153281', 6, 1, 'OI', 'c'),
(9, '09236157515', 6, 1, 'OI', 'c'),
(10, '092991325641', 7, 1, 'Vivo', 'r'),
(11, '092991260158', 8, 1, 'Vivo', 'r'),
(12, '09236573009', 8, 1, 'OI', 'c'),
(13, '09236562528', 8, 1, 'OI', 'c'),
(14, '09236542886', 9, 1, 'OI', 'r'),
(15, '092981197577', 10, 1, 'TIM', 'c'),
(16, '09236427222', 10, 1, 'OI', 'c'),
(17, '992999839028', 11, 1, 'Vivo', 'r'),
(18, '09232343425', 11, 1, 'OI', 'c'),
(19, '092994053800', 12, 1, 'Vivo', 'r'),
(20, '09236853608', 12, 1, 'OI', 'c'),
(21, '09232383847', 13, 1, 'OI', 'r'),
(22, '09236577730', 13, 1, 'OI', 'c'),
(23, '09232488683', 14, 1, 'OI', 'r'),
(24, '092992148504', 14, 1, 'Vivo', 'c'),
(25, '092981279645', 15, 1, 'TIM', 'r'),
(26, '09235843888', 15, 1, 'OI', 'c'),
(27, '092993014001', 16, 1, 'Vivo', 'c'),
(28, '092981501366', 16, 1, 'TIM', 'c'),
(29, '092992265128', 17, 1, 'Vivo', 'c'),
(30, '09238782601', 17, 1, 'OI', 'c'),
(31, '092991140800', 18, 1, 'Vivo', 'c'),
(32, '09232312006', 18, 1, 'OI', 'c'),
(33, '092981122769', 19, 1, 'TIM', 'c'),
(34, '092991479159', 20, 1, 'Vivo', 'c'),
(35, '092991425675', 21, 1, 'Vivo', 'c'),
(36, '092981129081', 22, 1, 'TIM', 'c'),
(37, '092981230809', 23, 1, 'Vivo', 'c'),
(38, '09236336282', 23, 1, 'OI', 'c'),
(39, '092988425199', 24, 1, 'Claro', 'c'),
(40, '09236636969', 24, 1, 'OI', 'c'),
(41, '092981593066', 25, 1, 'TIM', 'c'),
(42, '09226220180', 25, 1, 'TIM', 'c'),
(43, '09236631685', 25, 1, 'OI', 'c'),
(44, '092999878790', 26, 1, 'Vivo', 'c'),
(45, '09232368790', 26, 1, 'OI', 'c'),
(46, '092981121870', 27, 1, 'TIM', 'c'),
(47, '09232145710', 27, 1, 'OI', 'c'),
(48, '092992146655', 28, 1, 'Vivo', 'c'),
(49, '09238776769', 28, 1, 'OI', 'c'),
(50, '092981369803', 29, 1, 'TIM', 'c'),
(51, '092991023003', 29, 1, 'Vivo', 'c'),
(52, '092991266161', 30, 1, 'Vivo', 'c'),
(53, '09236220895', 30, 1, 'Vivo', 'c'),
(54, '09236524888', 31, 1, 'OI', 'c'),
(55, '09226514089', 31, 1, 'OI', 'c'),
(56, '09233026126', 32, 1, 'OI', 'c'),
(57, '092993014746', 33, 1, 'Vivo', 'c'),
(58, '092991266881', 34, 1, 'Vivo', 'c'),
(59, '09236570045', 34, 1, 'Vivo', 'c'),
(60, '09236338644', 35, 1, 'Vivo', 'c'),
(61, '09236481641', 39, 1, 'Vivo', 'c'),
(62, '092991142316', 39, 1, 'Vivo', 'c'),
(63, '092991519737', 40, 1, 'Vivo', 'c'),
(64, '092991287649', 41, 1, 'Vivo', 'c'),
(65, '092999859453', 42, 1, 'Vivo', 'c'),
(66, '092991356602', 43, 1, 'Vivo', 'c'),
(67, '092994251212', 44, 1, 'Vivo', 'c'),
(68, '092996034384', 45, 1, 'Vivo', 'c'),
(69, '092991412805', 46, 1, 'Vivo', 'c'),
(70, '092981369791', 49, 1, 'Vivo', 'c'),
(71, '09236511115', 49, 1, 'Vivo', 'c'),
(72, '09233054695', 50, 1, 'Vivo', 'c'),
(73, '09232363179', 50, 1, 'Vivo', 'c'),
(74, '09281319775', 52, 1, 'Vivo', 'c'),
(75, '092996017460', 53, 1, 'Vivo', 'c'),
(76, '092991709080', 55, 1, 'Vivo', 'c'),
(77, '092999826667', 59, 1, 'Vivo', 'c'),
(78, '09232311107', 59, 1, 'Vivo', 'c'),
(79, '092988023605', 60, 1, 'Vivo', 'c'),
(80, '09221250900', 60, 1, 'Vivo', 'c'),
(81, '092981110229', 61, 1, 'Vivo', 'c'),
(82, '092991511366', 62, 1, 'Vivo', 'c'),
(83, '092999816193', 63, 1, 'Vivo', 'c'),
(84, '092998644335', 64, 1, 'Vivo', 'c'),
(85, '092992429095', 64, 1, 'Vivo', 'c'),
(86, '092992026454', 64, 1, 'Vivo', 'c'),
(87, '092111111111', 66, 1, 'Vivo', 'c'),
(88, '092981167884', 67, 1, 'Vivo', 'c'),
(89, '09236117047', 67, 1, 'Vivo', 'c'),
(90, '092992503004', 68, 1, 'Vivo', 'c'),
(91, '09232324453', 68, 1, 'Vivo', 'c'),
(92, '092999832058', 69, 1, 'Vivo', 'c'),
(93, '092991222321', 70, 1, 'Vivo', 'c'),
(94, '092991268392', 71, 1, 'Vivo', 'c'),
(95, '09236310237', 71, 1, 'Vivo', 'c'),
(96, '09232368785', 72, 1, 'Vivo', 'c'),
(97, '09232341445', 72, 1, 'Vivo', 'c'),
(98, '092991207818', 73, 1, 'Vivo', 'c'),
(99, '092991834931', 74, 1, 'Vivo', 'c'),
(100, '09236132444', 75, 1, 'Vivo', 'c'),
(101, '092992024025', 75, 1, 'Vivo', 'c'),
(102, '092991220791', 76, 1, 'Vivo', 'c'),
(103, '092981338886', 76, 1, 'Vivo', 'c'),
(104, '092999810147', 77, 1, 'Vivo', 'c'),
(105, '09236531819', 77, 1, 'Vivo', 'c'),
(106, '092981380015', 78, 1, 'Vivo', 'c'),
(107, '092999859717', 79, 1, 'Vivo', 'c'),
(108, '09236533619', 79, 1, 'Vivo', 'c'),
(109, '09236510653', 79, 1, 'Vivo', 'c'),
(110, '092991325218', 80, 1, 'Vivo', 'c'),
(111, '09236462021', 80, 1, 'Vivo', 'c'),
(112, '09221268741', 81, 1, 'Vivo', 'c'),
(113, '09236551700', 82, 1, 'Vivo', 'c'),
(114, '092994051934', 83, 1, 'Vivo', 'c'),
(115, '092981050033', 84, 1, 'Vivo', 'c'),
(116, '092991361736', 85, 1, 'Vivo', 'c'),
(117, '092991122760', 85, 1, 'Vivo', 'c'),
(118, '092999852001', 86, 1, 'Vivo', 'c'),
(119, '09232378791', 86, 1, 'Vivo', 'c'),
(120, '092981230704', 87, 1, 'TIM', 'c'),
(121, '092991287658', 88, 1, 'Vivo', 'c'),
(122, '09232323410', 88, 1, 'Vivo', 'c'),
(123, '092994053800', 89, 1, 'Vivo', 'c'),
(124, '09236583608', 89, 1, 'Vivo', 'c'),
(125, '092991849525', 90, 1, 'Vivo', 'c'),
(126, '092991423270', 91, 1, 'Vivo', 'c'),
(127, '09233026995', 91, 1, 'Vivo', 'c'),
(128, '09233026992', 91, 1, 'Vivo', 'c');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--
/*
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
*/
--
-- Extraindo dados da tabela `usuario`
--
 

insert into `perfil`(perfil)values('administrador'),('usuario');

INSERT INTO `usuario` (`id`, `login`, `senha`, `idperfil`, `ativo`, `nome`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'root'),
(2, 'gustavo.machado', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'gustavo de souza machado');



-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarioembarcacao`
--
/*
CREATE TABLE IF NOT EXISTS `usuarioembarcacao` (
  `idusuario` int(11) NOT NULL,
  `idembarcacao` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`,`idembarcacao`),
  KEY `fk_usuario_has_embarcacao_embarcacao1_idx` (`idembarcacao`),
  KEY `fk_usuario_has_embarcacao_usuario1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
-- 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
