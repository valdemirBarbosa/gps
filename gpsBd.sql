-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Jun-2021 às 13:20
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
  `observacao` text NOT NULL,
  `data_digitacao` datetime NOT NULL DEFAULT current_timestamp(),
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denuncia`
--

INSERT INTO `denuncia` (`id_denuncia`, `denuncia_fato`, `id_denunciante`, `tipo_documento`, `numero_documento`, `data_entrada`, `observacao`, `data_digitacao`, `user`) VALUES(1, 'ROUBO DE AR CONDICIONADO', 3, 'CI', '20015', '2021-06-22', 'NINGUÉM VIU O ROSTO PORQUE ERA NOITE ESCURA', '2021-06-01 20:43:13', NULL);
INSERT INTO `denuncia` (`id_denuncia`, `denuncia_fato`, `id_denunciante`, `tipo_documento`, `numero_documento`, `data_entrada`, `observacao`, `data_digitacao`, `user`) VALUES(2, 'ROUBO DE AR CONDICIONADO', 3, 'CI', '20015', '2021-06-22', 'NINGUÉM VIU O ROSTO PORQUE ERA NOITE ESCURA', '2021-06-01 20:43:18', NULL);
INSERT INTO `denuncia` (`id_denuncia`, `denuncia_fato`, `id_denunciante`, `tipo_documento`, `numero_documento`, `data_entrada`, `observacao`, `data_digitacao`, `user`) VALUES(3, 'Improbidade Administrativa', 3, 'OFICIO', '12345', '2015-07-21', '...', '2021-06-03 13:56:29', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciado`
--

CREATE TABLE `denunciado` (
  `id_denunciado` int(11) NOT NULL,
  `id_denuncia` int(11) NOT NULL,
  `id_servidor` int(11) DEFAULT NULL,
  `nome_provisorio` varchar(80) NOT NULL,
  `observacao` text NOT NULL,
  `anexo` int(11) NOT NULL,
  `data_digitacao` datetime NOT NULL DEFAULT current_timestamp(),
  `user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denunciado`
--

INSERT INTO `denunciado` (`id_denunciado`, `id_denuncia`, `id_servidor`, `nome_provisorio`, `observacao`, `anexo`, `data_digitacao`, `user`) VALUES(1, 1, 1, '', 'incluido manualmente no banco de dados', 1, '2021-06-02 00:00:00', 1);
INSERT INTO `denunciado` (`id_denunciado`, `id_denuncia`, `id_servidor`, `nome_provisorio`, `observacao`, `anexo`, `data_digitacao`, `user`) VALUES(2, 3, 1, 'desconhecido', '...', 0, '2021-06-03 10:06:10', 1);

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

INSERT INTO `denunciante` (`id_denunciante`, `nome_denunciante`, `observacao`) VALUES(1, 'ADM', 'SEM OBS');
INSERT INTO `denunciante` (`id_denunciante`, `nome_denunciante`, `observacao`) VALUES(3, 'TCE/MT - TRIBUNAL DE CONTAS DO ESTADO DE MATO GROSSO', 'SEM OBSERVAÇÃO');
INSERT INTO `denunciante` (`id_denunciante`, `nome_denunciante`, `observacao`) VALUES(19, 'CONTROLADORIA MUNICIPAL', 'CONTROLE INTERNO					');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processado`
--

CREATE TABLE `processado` (
  `id_processo` int(11) NOT NULL,
  `id_servidor` int(11) NOT NULL,
  `id_denuncia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `servidor_func` (`id_servidor`, `nome_servidor`, `cpf`, `matricula`, `vinculo`, `secretaria`, `unidade`, `observacao`, `anexo`, `user`) VALUES(1, 'IVO ABRAO', '015.214.491', 127, 'CONCURSADO', 'ADMINISTRAÇÃO', 'COORDENADORIA ADMINISTRATIVA', 'incluido via banco', 0, 1);

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

INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `data_criacao`) VALUES(1, 'val@gmail.com', '123', '2021-02-26 21:55:12');
INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `data_criacao`) VALUES(2, 'leyd@gmail.com', '#15', '2021-03-14 02:55:17');

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
  ADD PRIMARY KEY (`id_denunciado`),
  ADD KEY `id_denuncia` (`id_denuncia`),
  ADD KEY `id_servidor` (`id_servidor`);

--
-- Índices para tabela `denunciante`
--
ALTER TABLE `denunciante`
  ADD PRIMARY KEY (`id_denunciante`);

--
-- Índices para tabela `processado`
--
ALTER TABLE `processado`
  ADD PRIMARY KEY (`id_processo`);

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
  MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `denunciado`
--
ALTER TABLE `denunciado`
  MODIFY `id_denunciado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `denunciante`
--
ALTER TABLE `denunciante`
  MODIFY `id_denunciante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `processado`
--
ALTER TABLE `processado`
  MODIFY `id_processo` int(11) NOT NULL AUTO_INCREMENT;

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
-- Limitadores para a tabela `denunciado`
--
ALTER TABLE `denunciado`
  ADD CONSTRAINT `id_denuncia` FOREIGN KEY (`id_denuncia`) REFERENCES `denuncia` (`id_denuncia`),
  ADD CONSTRAINT `id_servidor` FOREIGN KEY (`id_servidor`) REFERENCES `servidor_func` (`id_servidor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
