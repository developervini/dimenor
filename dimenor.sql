-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jun-2017 às 05:34
-- Versão do servidor: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dimenor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agreed`
--

CREATE TABLE `agreed` (
  `id` int(11) NOT NULL,
  `agreed` varchar(100) NOT NULL,
  `balance` float(10,2) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `facebook` varchar(150) NOT NULL,
  `coin_id` int(11) NOT NULL,
  `observation` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agreed`
--

INSERT INTO `agreed` (`id`, `agreed`, `balance`, `phone`, `facebook`, `coin_id`, `observation`, `active`) VALUES
(1, 'Conveniado 01', 5000.00, '(99) 99999-9999', 'http://fb.com', 1, '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `agreed_site`
--

CREATE TABLE `agreed_site` (
  `id` int(11) NOT NULL,
  `agreed_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agreed_site`
--

INSERT INTO `agreed_site` (`id`, `agreed_id`, `site_id`, `active`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `account` varchar(100) NOT NULL,
  `balance` float(10,2) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bank`
--

INSERT INTO `bank` (`id`, `bank`, `account`, `balance`, `active`) VALUES
(1, 'Banco do Brasil', '1234 5678-9', 0.00, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `client` varchar(150) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `facebook` varchar(150) NOT NULL,
  `observation` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `client`
--

INSERT INTO `client` (`id`, `client`, `phone`, `facebook`, `observation`, `active`) VALUES
(1, 'Fulano Santos', '(51) 99999-9999', 'http://fb.com/fulano', 'Uma pessoa bem peculiar.', 0),
(2, 'Teste de cliente', '(11)11111-1111', '', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `client_site`
--

CREATE TABLE `client_site` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `client_site`
--

INSERT INTO `client_site` (`id`, `client_id`, `site_id`, `active`) VALUES
(6, 1, 1, 0),
(7, 1, 2, 0),
(8, 2, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `client_site_user`
--

CREATE TABLE `client_site_user` (
  `id` int(11) NOT NULL,
  `client_site_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `client_site_user`
--

INSERT INTO `client_site_user` (`id`, `client_site_id`, `username`, `active`) VALUES
(11, 6, 'vinibsantos', 0),
(12, 6, 'developervini', 0),
(13, 6, 'viniciusbs', 0),
(14, 7, 'viniteste', 0),
(15, 8, 'testecliente', 0),
(16, 8, 'testinho', 0),
(17, 8, 'testao', 0),
(18, 8, 'zoeira', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `coin`
--

CREATE TABLE `coin` (
  `id` int(11) NOT NULL,
  `coin` varchar(10) NOT NULL,
  `percentage` float NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `coin`
--

INSERT INTO `coin` (`id`, `coin`, `percentage`, `active`) VALUES
(1, 'R$', 0, 0),
(2, 'U$$', 3.026, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `plan` varchar(100) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plan`
--

INSERT INTO `plan` (`id`, `plan`, `active`) VALUES
(1, 'Receita ', 0),
(2, 'Insumos escritório', 0),
(3, 'Insumos higiênicos', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `client_site_user_id` int(11) NOT NULL,
  `agreed_id` int(11) NOT NULL,
  `poker_chip` int(11) NOT NULL,
  `poker_chip_value` float(10,2) NOT NULL,
  `poker_chip_total` float(10,2) NOT NULL,
  `pay` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` float(10,2) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sale`
--

INSERT INTO `sale` (`id`, `client_site_user_id`, `agreed_id`, `poker_chip`, `poker_chip_value`, `poker_chip_total`, `pay`, `date`, `total`, `bank_id`, `status`) VALUES
(1, 11, 1, 100, 2.00, 200.00, 0, '2017-05-28', 200.00, 1, 0),
(2, 11, 1, 1000, 1.55, 1550.00, 0, '2017-05-27', 1550.00, 1, 1),
(3, 11, 1, 100, 5.00, 500.00, 0, '2017-05-28', 500.00, 1, 1),
(4, 11, 1, 100, 2.54, 254.00, 0, '2017-05-27', 254.00, 1, 0),
(5, 11, 1, 100, 2.54, 254.00, 0, '2017-05-16', 254.00, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `site` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `observation` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `site`
--

INSERT INTO `site` (`id`, `site`, `address`, `observation`, `active`) VALUES
(1, 'Bet365', 'http://bet365.com', 'Site de apostas que aceita real.', 0),
(2, 'PokerStars', 'https://www.pokerstars.com/', 'oi', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nomd5password` varchar(100) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `user`, `email`, `password`, `nomd5password`, `active`) VALUES
(1, 'Vinicius Santos', 'developervini@gmail.com', '7ef6156c32f427d713144f67e2ef14d2', '12qwaszx', 0),
(2, 'Lucas Fauth', 'dimenorfichasonline@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agreed`
--
ALTER TABLE `agreed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coin_id` (`coin_id`);

--
-- Indexes for table `agreed_site`
--
ALTER TABLE `agreed_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agreed_id` (`agreed_id`),
  ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_site`
--
ALTER TABLE `client_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `client_site_user`
--
ALTER TABLE `client_site_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_site_id` (`client_site_id`);

--
-- Indexes for table `coin`
--
ALTER TABLE `coin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_site_user_id` (`client_site_user_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agreed`
--
ALTER TABLE `agreed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `agreed_site`
--
ALTER TABLE `agreed_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client_site`
--
ALTER TABLE `client_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `client_site_user`
--
ALTER TABLE `client_site_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `coin`
--
ALTER TABLE `coin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agreed`
--
ALTER TABLE `agreed`
  ADD CONSTRAINT `agreed_ibfk_1` FOREIGN KEY (`coin_id`) REFERENCES `coin` (`id`);

--
-- Limitadores para a tabela `agreed_site`
--
ALTER TABLE `agreed_site`
  ADD CONSTRAINT `agreed_site_ibfk_1` FOREIGN KEY (`agreed_id`) REFERENCES `agreed` (`id`),
  ADD CONSTRAINT `agreed_site_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Limitadores para a tabela `client_site`
--
ALTER TABLE `client_site`
  ADD CONSTRAINT `client_site_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `client_site_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Limitadores para a tabela `client_site_user`
--
ALTER TABLE `client_site_user`
  ADD CONSTRAINT `client_site_user_ibfk_1` FOREIGN KEY (`client_site_id`) REFERENCES `client_site` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
