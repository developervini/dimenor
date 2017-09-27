-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Set-2017 às 13:19
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.0.21

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
(9, 'CredBrasil (U$)', 0.00, '(11) 99740-4001', '', 1, 'PS - 888 - bet365(alternativo) - PP', 0),
(10, 'VCreditos (U$)', 0.00, '', '', 1, '', 0);

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
(2, 9, 3, 0),
(3, 9, 4, 0),
(4, 10, 6, 0),
(5, 9, 6, 0);

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
(2, 'BB - Marina', '0628-9 / 34.540-0', 0.00, 0),
(3, 'Tiago DHO', 'em especie', 0.00, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chip_flow`
--

CREATE TABLE `chip_flow` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `client_site_user_id` int(11) NOT NULL,
  `agreed_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `operation` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `balance` float(10,2) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `client`
--

INSERT INTO `client` (`id`, `client`, `phone`, `facebook`, `observation`, `balance`, `active`) VALUES
(3, 'Tiago Nahin Fauth', '(51) 99990-9499', '', 'credito liberado: R$ 300,00\r\nconta BB: ag 06289 - cc 315400 - propria\r\n', 0.00, 0),
(4, 'Lucas Fauth', '(51) 99350-3940', '', '', 0.00, 0);

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
(9, 3, 3, 0),
(10, 3, 6, 0),
(11, 4, 3, 0);

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
(19, 9, 'tiagofauth', 0),
(20, 9, '', 0),
(21, 10, 'tiagobet / tiago nahin fauth', 0),
(22, 11, 'lucasdimenor', 0);

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
(1, 'R$', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `outlay`
--

CREATE TABLE `outlay` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `date_extract` date NOT NULL,
  `outlay` text NOT NULL,
  `plan_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `outlay`
--

INSERT INTO `outlay` (`id`, `date`, `date_extract`, `outlay`, `plan_id`, `bank_id`, `total`, `user_id`) VALUES
(5, '2017-06-27 16:53:13', '2017-06-27', 'pagamento telefone', 5, 2, 200.00, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `plan` varchar(100) NOT NULL,
  `operation` varchar(1) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plan`
--

INSERT INTO `plan` (`id`, `plan`, `operation`, `active`) VALUES
(4, 'Despesas Lucas (particular)', '-', 0),
(5, 'Despesas Casa', '-', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `portion_purchase`
--

CREATE TABLE `portion_purchase` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bank_id` int(11) NOT NULL,
  `portion` float(10,2) NOT NULL,
  `purchase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `portion_purchase`
--

INSERT INTO `portion_purchase` (`id`, `date`, `bank_id`, `portion`, `purchase_id`) VALUES
(1, '2017-08-05', 2, 10.00, 2),
(2, '2017-08-05', 2, 100.00, 2),
(3, '2017-08-05', 3, 190.00, 2),
(4, '2017-08-08', 2, 111.00, 7),
(5, '2017-08-29', 2, 2500.00, 8),
(6, '2017-08-29', 2, 99.00, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `portion_sale`
--

CREATE TABLE `portion_sale` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bank_id` int(11) NOT NULL,
  `portion` float(10,2) NOT NULL,
  `sale_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `portion_sale`
--

INSERT INTO `portion_sale` (`id`, `date`, `bank_id`, `portion`, `sale_id`) VALUES
(4, '2017-08-01', 2, 10.00, 13),
(5, '2017-08-01', 2, 30.00, 13),
(6, '2017-08-01', 2, 110.00, 13),
(13, '2017-08-02', 2, 89.50, 8),
(14, '2017-08-02', 3, 100.00, 8),
(19, '2017-08-01', 2, 89.50, 7),
(20, '2017-08-02', 2, 120.00, 7),
(21, '2017-08-08', 2, 113.00, 16),
(22, '2017-08-29', 2, 379.00, 6),
(23, '2017-08-29', 2, 100.00, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `client_site_user_id` int(11) NOT NULL,
  `agreed_id` int(11) NOT NULL,
  `poker_chip` float(10,2) NOT NULL,
  `poker_chip_value` float(10,2) NOT NULL,
  `poker_chip_total` float(10,2) NOT NULL,
  `pay` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` float(10,2) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `purchase`
--

INSERT INTO `purchase` (`id`, `client_site_user_id`, `agreed_id`, `poker_chip`, `poker_chip_value`, `poker_chip_total`, `pay`, `date`, `total`, `bank_id`, `status`) VALUES
(1, 22, 9, 100.00, 5.00, 500.00, 0, '2017-07-24', 550.00, 2, 1),
(2, 19, 9, 120.00, 2.50, 300.00, 0, '2017-08-05', 300.00, 2, 1),
(3, 22, 9, 100.00, 9.69, 968.50, 0, '2017-07-24', 968.50, 2, 1),
(4, 22, 9, 100.00, 10.00, 1000.00, 0, '2017-07-24', 1000.00, 3, 1),
(5, 22, 9, 130.00, 7.69, 1000.00, 0, '2017-07-26', 1000.00, 2, 1),
(6, 22, 9, 99.00, 1.00, 99.00, 1, '2017-08-29', 99.00, 0, 1),
(7, 22, 9, 111.00, 1.00, 111.00, 0, '2017-08-08', 111.00, 0, 1),
(8, 19, 9, 1000.00, 2.00, 2000.00, 1, '2017-08-29', 2500.00, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `client_site_user_id` int(11) NOT NULL,
  `agreed_id` int(11) NOT NULL,
  `returned_agreed_id` int(11) DEFAULT NULL,
  `returned_poker_chip` float(10,2) NOT NULL,
  `poker_chip` float(10,2) NOT NULL,
  `poker_chip_value` float(10,2) NOT NULL,
  `poker_chip_total` float(10,2) NOT NULL,
  `pay` int(11) NOT NULL,
  `date` date NOT NULL,
  `returned_date` date NOT NULL,
  `total` float(10,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sale`
--

INSERT INTO `sale` (`id`, `client_site_user_id`, `agreed_id`, `returned_agreed_id`, `returned_poker_chip`, `poker_chip`, `poker_chip_value`, `poker_chip_total`, `pay`, `date`, `returned_date`, `total`, `status`) VALUES
(6, 19, 9, NULL, 0.00, 100.00, 3.79, 379.00, 0, '2017-08-29', '0000-00-00', 379.00, 1),
(7, 21, 10, NULL, 0.00, 50.00, 3.79, 189.50, 0, '2017-08-02', '0000-00-00', 209.50, 1),
(8, 19, 9, NULL, 0.00, 50.00, 3.79, 189.50, 0, '2017-08-02', '0000-00-00', 189.50, 1),
(9, 22, 9, NULL, 0.00, 50.00, 3.79, 189.50, 0, '2017-06-27', '0000-00-00', 189.50, 1),
(10, 22, 9, NULL, 0.00, 100.00, 10.00, 1000.00, 0, '2017-07-24', '0000-00-00', 1000.00, 1),
(11, 22, 9, NULL, 0.00, 100.00, 10.00, 1000.00, 0, '2017-07-20', '0000-00-00', 1050.00, 1),
(12, 22, 9, NULL, 0.00, 50.00, 4.00, 200.00, 0, '2017-07-24', '0000-00-00', 200.00, 1),
(13, 22, 9, NULL, 0.00, 100.00, 1.50, 150.00, 1, '2017-08-01', '0000-00-00', 150.00, 1),
(14, 22, 9, NULL, 0.00, 100.00, 2.50, 250.00, 1, '2017-08-08', '0000-00-00', 0.00, 0),
(15, 22, 9, 10, 113.00, 112.00, 1.00, 112.00, 1, '2017-08-08', '2017-08-08', 0.00, 2),
(16, 22, 9, NULL, 0.00, 113.00, 1.00, 113.00, 0, '2017-08-08', '0000-00-00', 113.00, 1),
(17, 19, 9, NULL, 0.00, 100.00, 1.00, 100.00, 0, '2017-08-29', '0000-00-00', 100.00, 1),
(18, 19, 9, 9, 820.00, 820.00, 1.22, 1000.00, 1, '2017-08-29', '2017-08-29', 0.00, 2);

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
(3, 'Poker Stars', 'http://www.pokerstars.com', 'conv: Credbrasil', 0),
(4, 'Party Poker', 'http://www.partypoker.com', 'conv: Credbrasil', 1),
(5, 'Party Poker', 'http://www.partypoker.com', 'conv: Credbrasil', 0),
(6, 'Bet365', 'https://www.vcreditos.com/bet365/agente20/sports', 'conv: VCreditos\r\nConv. altenativo: Credbrasil', 0);

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
-- Indexes for table `chip_flow`
--
ALTER TABLE `chip_flow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_site_user_id` (`client_site_user_id`),
  ADD KEY `agreed_id` (`agreed_id`);

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
-- Indexes for table `outlay`
--
ALTER TABLE `outlay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `total` (`total`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portion_purchase`
--
ALTER TABLE `portion_purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `portion_sale`
--
ALTER TABLE `portion_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_site_user_id` (`client_site_user_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_site_user_id` (`client_site_user_id`),
  ADD KEY `returned_agreed_id` (`returned_agreed_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `agreed_site`
--
ALTER TABLE `agreed_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chip_flow`
--
ALTER TABLE `chip_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `client_site`
--
ALTER TABLE `client_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `client_site_user`
--
ALTER TABLE `client_site_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `coin`
--
ALTER TABLE `coin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `outlay`
--
ALTER TABLE `outlay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `portion_purchase`
--
ALTER TABLE `portion_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `portion_sale`
--
ALTER TABLE `portion_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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

--
-- Limitadores para a tabela `outlay`
--
ALTER TABLE `outlay`
  ADD CONSTRAINT `outlay_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`),
  ADD CONSTRAINT `outlay_ibfk_2` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`),
  ADD CONSTRAINT `outlay_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `portion_purchase`
--
ALTER TABLE `portion_purchase`
  ADD CONSTRAINT `portion_purchase_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`),
  ADD CONSTRAINT `portion_purchase_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`);

--
-- Limitadores para a tabela `portion_sale`
--
ALTER TABLE `portion_sale`
  ADD CONSTRAINT `portion_sale_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`),
  ADD CONSTRAINT `portion_sale_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
