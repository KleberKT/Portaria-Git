-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 01/11/2021 às 19h35min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `fib`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `portaria`
--

CREATE TABLE IF NOT EXISTS `portaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `docto` varchar(60) NOT NULL,
  `lancado` varchar(1) NOT NULL,
  `porte_peq` varchar(1) NOT NULL DEFAULT 'N',
  `data_che` datetime DEFAULT NULL,
  `data_ent` datetime DEFAULT NULL,
  `data_sai` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `motorista` varchar(60) DEFAULT NULL,
  `rg` varchar(30) DEFAULT NULL,
  `cpf` varchar(30) DEFAULT NULL,
  `veiculo` varchar(30) DEFAULT NULL,
  `placa` varchar(30) DEFAULT NULL,
  `obs` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17118 ;

--
-- Extraindo dados da tabela `portaria`
--

INSERT INTO `portaria` (`id`, `nome`, `docto`, `lancado`, `porte_peq`, `data_che`, `data_ent`, `data_sai`, `id_usuario`, `motorista`, `rg`, `cpf`, `veiculo`, `placa`, `obs`) VALUES
(17117, 'GFASD', '12412431', 'N', 'N', '2021-10-26 19:57:00', '2021-10-27 23:54:00', '2021-10-28 22:58:00', NULL, '12412', '12314', '12412', '', '2131', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`usuario_id`, `usuario`, `senha`) VALUES
(1, 'teste', '202cb962ac59075b964b07152d234b70');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
