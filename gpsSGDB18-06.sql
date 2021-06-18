-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jun-2021 às 14:18
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gps`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `id_denuncia` int(11) NOT NULL,
  `denuncia_fato` varchar(100) NOT NULL,
  `id_denunciante` int(4) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `data_entrada` date NOT NULL,
  `anexo` int(5) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `data_digitacao` datetime NOT NULL DEFAULT current_timestamp(),
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denuncia`
--

INSERT INTO `denuncia` (`id_denuncia`, `denuncia_fato`, `id_denunciante`, `tipo_documento`, `numero_documento`, `data_entrada`, `anexo`, `observacao`, `data_digitacao`, `user`) VALUES
(1, '', 0, '', '', '0000-00-00', NULL, '', '2021-06-01 20:43:13', NULL),
(2, '', 0, '', '', '0000-00-00', NULL, '', '2021-06-01 20:43:18', NULL),
(3, '', 0, '', '', '0000-00-00', NULL, '', '2021-06-03 13:56:29', 1),
(5, 'ABANDONO DO POSTO DE TRABALHO', 1, 'oficio', '9999', '2021-06-06', NULL, '', '2021-06-13 22:36:23', NULL),
(6, 'BRIGA GENEREALIZADA ENTRE COLEGAS DE TRABALHO COM QUEBRADEIRA DE PRÓPRIOS ESCOLARES', 3, '1', '9999', '2021-06-15', NULL, '', '2021-06-13 22:36:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciado`
--

CREATE TABLE `denunciado` (
  `id_denunciado` int(11) NOT NULL,
  `id_pad` int(11) NOT NULL,
  `id_servidor` int(11) NOT NULL,
  `observacao` varchar(150) NOT NULL,
  `anexo` int(11) NOT NULL,
  `data_digitacao` datetime NOT NULL DEFAULT current_timestamp(),
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denunciado`
--

INSERT INTO `denunciado` (`id_denunciado`, `id_pad`, `id_servidor`, `observacao`, `anexo`, `data_digitacao`, `user`) VALUES
(1, 2, 1, 'teste', 1, '2021-06-13 12:01:56', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciante`
--

CREATE TABLE `denunciante` (
  `id_denunciante` int(11) NOT NULL,
  `nome_denunciante` varchar(80) NOT NULL,
  `observacao` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denunciante`
--

INSERT INTO `denunciante` (`id_denunciante`, `nome_denunciante`, `observacao`) VALUES
(1, 'ADM', 'SEM OBS'),
(3, 'TCE/MT - TRIBUNAL DE CONTAS DO ESTADO DE MATO GROSSO', 'SEM OBSERVAÇÃO'),
(19, 'CONTROLADORIA MUNICIPAL', 'CONTROLE INTERNO					'),
(20, 'INDEFINIDO', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fase`
--

CREATE TABLE `fase` (
  `id_fase` int(11) NOT NULL,
  `fase` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fase`
--

INSERT INTO `fase` (`id_fase`, `fase`) VALUES
(1, 'Procedimento Preliminar'),
(2, 'Sindicância'),
(3, 'PAD');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencia`
--

CREATE TABLE `ocorrencia` (
  `id` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `numero_processo` varchar(25) NOT NULL,
  `data_ocorrencia` date NOT NULL DEFAULT current_timestamp(),
  `ocorrencia` varchar(120) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `anexo` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `data_digitacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ocorrencia`
--

INSERT INTO `ocorrencia` (`id`, `id_fase`, `numero_processo`, `data_ocorrencia`, `ocorrencia`, `observacao`, `anexo`, `user`, `data_digitacao`) VALUES
(1, 1, '2', '2021-02-24', 'AGRESSÃO MÚTUA ENTRE SERVIDORES', 'LIVRE PARA OBSERVAÇÃO', 0, 0, '2021-06-15 07:57:00'),
(2, 1, '1', '2021-02-12', 'AGRESSÃO MÚTUA ENTRE SERVIDORES', 'LIVRE PARA OBSERVAÇÃO', 0, 0, '2021-06-15 07:57:00'),
(3, 1, '', '2000-01-15', '33FD1SA', '', 1, 0, '2021-06-17 22:17:23'),
(4, 1, '', '2021-06-21', 'PAD', '', 1, 0, '2021-06-18 06:51:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pad`
--

CREATE TABLE `pad` (
  `id_pad` int(11) NOT NULL,
  `id_denuncia` int(11) DEFAULT NULL,
  `id_pp_sindicancia` int(11) DEFAULT NULL,
  `numero_processo` varchar(20) NOT NULL,
  `data_instauracao` date NOT NULL DEFAULT current_timestamp(),
  `observacao` varchar(200) NOT NULL,
  `anexo` varchar(100) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pad`
--

INSERT INTO `pad` (`id_pad`, `id_denuncia`, `id_pp_sindicancia`, `numero_processo`, `data_instauracao`, `observacao`, `anexo`, `user`) VALUES
(10, 110, 1, '20520/2021', '2000-05-02', 'incluido anexo 101101', '', 1),
(11, 1, 1, '205/2020', '2012-12-12', 'alterado', '0', 1),
(14, 1, 1, '5555/2015', '2000-06-16', 'ver data', '', 1),
(15, 1, 1, '15151/2021', '2021-01-15', 'teste de sistema', '', 1),
(16, 1, 1, '20520/2021', '2000-05-02', 'incluido anexo 1011', '', 1),
(17, 1, 1, '20520/2021', '2000-05-02', 'incluido anexo 1011', '', 1),
(18, 1, 1, '1011/2021', '2021-06-18', 'incluido anexo', '', 1),
(19, 1, 1, '20520/2021', '2000-05-02', 'incluido anexo 1011', '', 1),
(20, 1, 1, '20520/2021', '2000-05-02', 'incluido anexo 1711', '', 1),
(21, 1, 1, '', '2000-05-02', 'incluido anexo', '', 1),
(22, 1, 1, '20520/2021', '2000-05-02', '', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `portaria`
--

CREATE TABLE `portaria` (
  `id` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `numero_processo` varchar(11) NOT NULL,
  `tipo` varchar(11) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `data_elaboracao` date NOT NULL DEFAULT current_timestamp(),
  `conteudo` text DEFAULT NULL,
  `data_publicacao` date NOT NULL DEFAULT current_timestamp(),
  `veiculo` varchar(15) NOT NULL DEFAULT 'AMM',
  `prazo` int(11) NOT NULL,
  `data_final` date NOT NULL,
  `data_realizada` int(11) NOT NULL,
  `prazo_atendido` varchar(3) DEFAULT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  `anexo` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pp_sindicancia`
--

CREATE TABLE `pp_sindicancia` (
  `id` int(11) NOT NULL,
  `id_denuncia` int(11) NOT NULL,
  `fase` int(25) NOT NULL,
  `numero_processo` int(11) NOT NULL,
  `data_instauracao` date NOT NULL DEFAULT current_timestamp(),
  `observacao` varchar(200) DEFAULT NULL,
  `anexo` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pp_sindicancia`
--

INSERT INTO `pp_sindicancia` (`id`, `id_denuncia`, `fase`, `numero_processo`, `data_instauracao`, `observacao`, `anexo`, `user`) VALUES
(1, 1, 1, 5555, '2021-05-01', 'LIVRE PARA OBSERVAÇÃO', 0, 0),
(2, 1, 1, 5555, '2021-06-14', 'LIVRE PARA OBSERVAÇÃO', 0, 0),
(4, 3, 1, 0, '2000-01-06', 'DFDSFASD', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor_func`
--

CREATE TABLE `servidor_func` (
  `id_servidor` int(11) NOT NULL,
  `nome_servidor` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `matricula` int(10) NOT NULL,
  `vinculo` varchar(15) NOT NULL,
  `secretaria` varchar(70) NOT NULL,
  `unidade` varchar(100) NOT NULL,
  `observacao` varchar(100) NOT NULL,
  `anexo` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `servidor_func`
--

INSERT INTO `servidor_func` (`id_servidor`, `nome_servidor`, `cpf`, `matricula`, `vinculo`, `secretaria`, `unidade`, `observacao`, `anexo`, `user`) VALUES
(1, 'IVO ABRAO', '015.214.491', 127, 'CONCURSADO', 'FINANÇAS', 'COORDENADORIA ADMINISTRATIVA', 'incluido via banco', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `data_criacao`) VALUES
(1, 'val@gmail.com', '123', '2021-02-26 21:55:12'),
(2, 'leyd@gmail.com', '#15', '2021-03-14 02:55:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`id_denuncia`,`id_denunciante`);

--
-- Índices para tabela `denunciado`
--
ALTER TABLE `denunciado`
  ADD PRIMARY KEY (`id_denunciado`);

--
-- Índices para tabela `denunciante`
--
ALTER TABLE `denunciante`
  ADD PRIMARY KEY (`id_denunciante`);

--
-- Índices para tabela `fase`
--
ALTER TABLE `fase`
  ADD PRIMARY KEY (`id_fase`);

--
-- Índices para tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_denuncia` (`id_fase`);

--
-- Índices para tabela `pad`
--
ALTER TABLE `pad`
  ADD PRIMARY KEY (`id_pad`),
  ADD KEY `fk_id_denuncia` (`id_denuncia`),
  ADD KEY `fk_id_pp_sindicancia` (`id_pp_sindicancia`);

--
-- Índices para tabela `portaria`
--
ALTER TABLE `portaria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pp_sindicancia`
--
ALTER TABLE `pp_sindicancia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_denuncia` (`id_denuncia`),
  ADD KEY `fk_fase` (`fase`);

--
-- Índices para tabela `servidor_func`
--
ALTER TABLE `servidor_func`
  ADD PRIMARY KEY (`id_servidor`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `denunciado`
--
ALTER TABLE `denunciado`
  MODIFY `id_denunciado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `denunciante`
--
ALTER TABLE `denunciante`
  MODIFY `id_denunciante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `fase`
--
ALTER TABLE `fase`
  MODIFY `id_fase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pad`
--
ALTER TABLE `pad`
  MODIFY `id_pad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `portaria`
--
ALTER TABLE `portaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pp_sindicancia`
--
ALTER TABLE `pp_sindicancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `servidor_func`
--
ALTER TABLE `servidor_func`
  MODIFY `id_servidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pad`
--
ALTER TABLE `pad`
  ADD CONSTRAINT `fk_id_pp_sindicancia` FOREIGN KEY (`id_pp_sindicancia`) REFERENCES `pp_sindicancia` (`id`);

--
-- Limitadores para a tabela `pp_sindicancia`
--
ALTER TABLE `pp_sindicancia`
  ADD CONSTRAINT `fk_fase` FOREIGN KEY (`fase`) REFERENCES `fase` (`id_fase`),
  ADD CONSTRAINT `fk_id_denuncia` FOREIGN KEY (`id_denuncia`) REFERENCES `denuncia` (`id_denuncia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
