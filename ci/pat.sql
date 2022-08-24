-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Jan-2022 às 19:38
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanha`
--

CREATE TABLE `campanha` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nome` varchar(245) DEFAULT NULL,
  `logo` varchar(245) DEFAULT NULL,
  `url` varchar(245) DEFAULT NULL,
  `cor1` varchar(7) NOT NULL,
  `cor2` varchar(7) NOT NULL,
  `cor3` varchar(7) NOT NULL,
  `cor4` varchar(7) NOT NULL,
  `status` enum('A','I') DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `campanha`
--

INSERT INTO `campanha` (`id`, `id_empresa`, `nome`, `logo`, `url`, `cor1`, `cor2`, `cor3`, `cor4`, `status`, `criado_em`, `atualizado_em`) VALUES
(1, 2, 'Loja Perfeita', '61cafdc5810ab-imagem_.png', 'https://pat.cwbecommerce.com.br', '#e86969', '#34df56', '#df7620', '#2229f7', 'A', '2021-12-28 01:04:45', '2021-12-30 22:34:00'),
(2, 2, 'Campanha 2', '61ca57fea4aef-empresa-2.docx', 'campanha-2', '', '', '', '', 'A', '2021-12-28 01:05:05', '2021-12-28 01:19:10'),
(3, 2, 'Campanha 3', '61ca54d1d781d-empresa-1.docx', 'campanha-3', '', '', '', '', 'A', '2021-12-28 01:05:37', '2021-12-28 01:11:59'),
(4, 2, 'Campanha 4', '61ca5828a339f-empresa-4.docx', 'campanha-4', '', '', '', '', 'A', '2021-12-28 01:11:07', '2021-12-28 01:19:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanha_importacao`
--

CREATE TABLE `campanha_importacao` (
  `id` int(11) NOT NULL,
  `id_campanha` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `arquivo_nome` varchar(255) NOT NULL,
  `arquivo_url` varbinary(255) NOT NULL,
  `status` enum('N','C','P','I','E') NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `campanha_importacao`
--

INSERT INTO `campanha_importacao` (`id`, `id_campanha`, `id_usuario`, `arquivo_nome`, `arquivo_url`, `status`, `criado_em`, `atualizado_em`) VALUES
(4, 1, 2, 'padrao-03-01-2022 (5).csv', 0x75706c6f61642f696d706f72746163616f2f363164333034316630613238632e637376, 'C', '2022-01-03 15:11:43', NULL),
(5, 1, 2, 'padrao-03-01-2022 (7).csv', 0x75706c6f61642f696d706f72746163616f2f363164333036616535663962352e637376, 'C', '2022-01-03 15:22:38', NULL),
(6, 1, 2, 'padrao-03-01-2022 (9).csv', 0x75706c6f61642f696d706f72746163616f2f363164333263323039303365622e637376, 'C', '2022-01-03 18:02:24', NULL),
(7, 1, 2, 'padrao-03-01-2022 (9).csv', 0x75706c6f61642f696d706f72746163616f2f363164333263663861653035622e637376, 'P', '2022-01-03 18:06:00', '2022-01-03 18:51:46'),
(8, 1, 2, 'padrao-03-01-2022 (11).csv', 0x75706c6f61642f696d706f72746163616f2f363164333365346534653835632e637376, 'P', '2022-01-03 19:19:58', '2022-01-03 19:21:04'),
(9, 1, 2, 'padrao-03-01-2022 (11).csv', 0x75706c6f61642f696d706f72746163616f2f363164333430353161656432312e637376, 'P', '2022-01-03 19:28:33', '2022-01-03 19:29:47'),
(10, 1, 2, '61d34051aed21.csv', 0x75706c6f61642f696d706f72746163616f2f363164333432343633303361632e637376, 'C', '2022-01-03 19:36:54', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanha_padrao`
--

CREATE TABLE `campanha_padrao` (
  `id` int(11) NOT NULL,
  `id_campanha` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `exibe` tinyint(1) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `campanha_padrao`
--

INSERT INTO `campanha_padrao` (`id`, `id_campanha`, `tipo`, `nome`, `ordem`, `exibe`, `criado_em`, `atualizado_em`) VALUES
(1, 1, 'NUMERO', 'CÓDIGO', 0, 1, '2022-01-03 00:47:49', '2022-01-03 17:54:19'),
(2, 1, 'TEXTO', 'NOME', 1, 1, '2022-01-03 00:48:44', '2022-01-03 17:55:03'),
(3, 1, 'EMAIL', 'EMAIL', 2, 1, '2022-01-03 00:50:16', '2022-01-03 17:55:14'),
(4, 1, 'CPF', 'CPF', 3, 1, '2022-01-03 00:50:26', '2022-01-03 17:55:42'),
(5, 1, 'CNPJ', 'CNPJ', 4, 1, '2022-01-03 00:50:35', '2022-01-03 17:55:51'),
(6, 1, 'TELEFONE', 'TELEFONE', 5, 1, '2022-01-03 00:51:07', '2022-01-03 17:55:59'),
(7, 1, 'OPCOES', 'REGIÃO', 6, 1, '2022-01-03 00:51:26', '2022-01-03 17:56:19'),
(8, 1, 'OPCOES', 'SUBREGIÂO', 7, 1, '2022-01-03 00:51:49', '2022-01-03 17:57:00'),
(9, 1, 'OPCOES', 'PERFIL', 8, 1, '2022-01-03 00:56:59', '2022-01-03 17:57:18'),
(10, 1, 'CEP', 'CEP', 9, 1, '2022-01-03 15:20:58', '2022-01-03 17:57:58'),
(11, 1, 'TEXTO', 'UF', 10, 1, '2022-01-03 17:58:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanha_participantes`
--

CREATE TABLE `campanha_participantes` (
  `id` int(11) NOT NULL,
  `id_campanha` int(11) NOT NULL,
  `id_import` int(11) NOT NULL,
  `indice` int(11) NOT NULL,
  `line` longtext NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `campanha_participantes`
--

INSERT INTO `campanha_participantes` (`id`, `id_campanha`, `id_import`, `indice`, `line`, `criado_em`, `atualizado_em`) VALUES
(9, 1, 9, 0, 'a:11:{i:0;s:6:\"CÓDIGO\";i:1;s:4:\"NOME\";i:2;s:5:\"EMAIL\";i:3;s:3:\"CPF\";i:4;s:4:\"CNPJ\";i:5;s:8:\"TELEFONE\";i:6;s:6:\"REGIÃO\";i:7;s:9:\"SUBREGIÂO\";i:8;s:6:\"PERFIL\";i:9;s:3:\"CEP\";i:10;s:2:\"UF\";}', '2022-01-03 19:29:47', NULL),
(10, 1, 9, 1, 'a:11:{i:0;s:1:\"1\";i:1;s:14:\"Participante 1\";i:2;s:23:\"participante1@gmail.com\";i:3;s:13:\"00.000.000-01\";i:4;s:18:\"00.000.000/0000-01\";i:5;s:15:\"(41) 00000-0001\";i:6;s:1:\"A\";i:7;s:2:\"AA\";i:8;s:6:\"Master\";i:9;s:8:\"80010001\";i:10;s:2:\"PR\";}', '2022-01-03 19:29:47', NULL),
(11, 1, 9, 2, 'a:11:{i:0;s:1:\"2\";i:1;s:14:\"Participante 2\";i:2;s:23:\"participante2@gmail.com\";i:3;s:13:\"00.000.000-02\";i:4;s:18:\"00.000.000/0000-02\";i:5;s:15:\"(41) 00000-0002\";i:6;s:1:\"A\";i:7;s:2:\"AA\";i:8;s:6:\"Master\";i:9;s:8:\"80010002\";i:10;s:2:\"SC\";}', '2022-01-03 19:29:47', NULL),
(12, 1, 9, 3, 'a:11:{i:0;s:1:\"3\";i:1;s:14:\"Participante 3\";i:2;s:23:\"participante3@gmail.com\";i:3;s:13:\"00.000.000-03\";i:4;s:18:\"00.000.000/0000-03\";i:5;s:15:\"(41) 00000-0003\";i:6;s:1:\"A\";i:7;s:2:\"AA\";i:8;s:12:\"Visualizador\";i:9;s:8:\"80010003\";i:10;s:2:\"SP\";}', '2022-01-03 19:29:47', NULL),
(13, 1, 9, 4, 'a:11:{i:0;s:1:\"4\";i:1;s:14:\"Participante 4\";i:2;s:23:\"participante4@gmail.com\";i:3;s:13:\"00.000.000-04\";i:4;s:18:\"00.000.000/0000-04\";i:5;s:15:\"(41) 00000-0004\";i:6;s:1:\"A\";i:7;s:3:\"AAA\";i:8;s:12:\"Visualizador\";i:9;s:8:\"80010004\";i:10;s:2:\"PR\";}', '2022-01-03 19:29:47', NULL),
(14, 1, 9, 5, 'a:11:{i:0;s:1:\"5\";i:1;s:14:\"Participante 5\";i:2;s:23:\"participante5@gmail.com\";i:3;s:13:\"00.000.000-05\";i:4;s:18:\"00.000.000/0000-05\";i:5;s:15:\"(41) 00000-0005\";i:6;s:1:\"A\";i:7;s:3:\"AAA\";i:8;s:12:\"Visualizador\";i:9;s:8:\"80010005\";i:10;s:2:\"PR\";}', '2022-01-03 19:29:47', NULL),
(15, 1, 9, 6, 'a:11:{i:0;s:1:\"6\";i:1;s:14:\"Participante 6\";i:2;s:23:\"participante6@gmail.com\";i:3;s:13:\"00.000.000-06\";i:4;s:18:\"00.000.000/0000-06\";i:5;s:15:\"(41) 00000-0006\";i:6;s:1:\"A\";i:7;s:3:\"AAA\";i:8;s:8:\"Operador\";i:9;s:8:\"80010006\";i:10;s:2:\"PR\";}', '2022-01-03 19:29:47', NULL),
(16, 1, 9, 7, 'a:11:{i:0;s:1:\"7\";i:1;s:14:\"Participante 7\";i:2;s:23:\"participante7@gmail.com\";i:3;s:13:\"00.000.000-07\";i:4;s:18:\"00.000.000/0000-07\";i:5;s:15:\"(41) 00000-0007\";i:6;s:1:\"A\";i:7;s:3:\"AAA\";i:8;s:8:\"Operador\";i:9;s:8:\"80010007\";i:10;s:2:\"PR\";}', '2022-01-03 19:29:47', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nome` varchar(145) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `fantasia` varchar(245) DEFAULT NULL,
  `razao_social` varchar(245) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `status` enum('N','A','R') DEFAULT 'N' COMMENT 'N = Novo\nA = Aprovado\nR = Reprovado',
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Empresa';

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `email`, `telefone`, `fantasia`, `razao_social`, `cnpj`, `status`, `criado_em`, `atualizado_em`) VALUES
(1, 'Mondelez', 'mondelez@mondelez.com', '41 00000-0001', 'Mondelez', 'Mondelez', '00.000.000/0000-01', 'A', '2021-12-12 15:12:37', '2021-12-30 22:33:04'),
(2, 'Empresa 2', 'teste2@email.com', '41 98888-2222', 'Fantasia 2', 'Razão Social 2', '00.000.000/0000-02', 'R', '2021-12-27 01:15:42', '2022-01-03 00:01:55'),
(3, 'Teste 3', 'teste3@gmail.com', '41 90000-3333', 'Fantasia 3', 'Razão Social 3', '00.000.000/0000-03', 'A', '2021-12-27 01:16:10', '2021-12-27 01:36:34'),
(4, 'Empresa 4', 'empresa4@gmail.com', '41 98888-0008', 'Fantasia 4', 'Razão Social 4', '10.122.323/0090-99', 'A', '2021-12-28 00:29:43', '2021-12-28 01:27:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `cabecalho` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`id`, `id_empresa`, `id_usuario`, `cabecalho`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '[{\"user\": \"Item1\"}]', '2021-12-20 22:29:22', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `perfil` enum('E','P','A','C') DEFAULT NULL COMMENT 'E = Empresa\\nP = Participante\\nA = Administrador, C = Campanhas',
  `id_empresa` int(11) DEFAULT NULL,
  `id_campanha` int(11) DEFAULT NULL,
  `usuario` varchar(145) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `status` enum('A','I') DEFAULT NULL COMMENT 'A = Ativo\nI = Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `perfil`, `id_empresa`, `id_campanha`, `usuario`, `senha`, `criado_em`, `atualizado_em`, `status`) VALUES
(1, 'A', NULL, NULL, 'adm', 'adm123', '2021-12-11 22:38:36', '2021-12-27 23:12:50', 'A'),
(2, 'E', 1, NULL, 'mondelez', 'mondelez', '2021-12-12 11:29:27', '2021-12-30 22:33:12', 'A'),
(3, NULL, NULL, NULL, '66.126.430/0001-62', 'empresa1', '2021-12-27 23:13:54', NULL, 'A'),
(4, 'E', 2, NULL, 'empresa2', 'empresa2', '2021-12-27 23:25:00', '2021-12-28 01:45:10', 'A'),
(5, 'E', 3, NULL, 'empresa3', 'empresa3', '2021-12-27 23:25:26', '2021-12-28 01:36:29', 'A'),
(6, 'C', NULL, 1, 'lojaperfeita', 'lojaperfeita', '2021-12-28 02:11:00', '2021-12-31 00:48:01', 'A'),
(7, 'C', NULL, 2, 'campanha2_user', 'campanha2_user', '2021-12-28 02:13:34', '2021-12-28 02:16:09', 'A');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `campanha`
--
ALTER TABLE `campanha`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `campanha_importacao`
--
ALTER TABLE `campanha_importacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `campanha_padrao`
--
ALTER TABLE `campanha_padrao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `campanha_participantes`
--
ALTER TABLE `campanha_participantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campanha`
--
ALTER TABLE `campanha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `campanha_importacao`
--
ALTER TABLE `campanha_importacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `campanha_padrao`
--
ALTER TABLE `campanha_padrao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `campanha_participantes`
--
ALTER TABLE `campanha_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



--
-- Estrutura da tabela `etapas`
--
CREATE TABLE `pat`.`etapas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_campanha` VARCHAR(11) NOT NULL,
  `nome` VARCHAR(145) NOT NULL,
  `inicio_em` DATETIME NOT NULL,
  `termina_em` DATETIME NOT NULL,
  `metricas` LONGTEXT NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL
  PRIMARY KEY (`id`));