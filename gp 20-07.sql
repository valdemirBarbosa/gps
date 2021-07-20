-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jul-2021 às 13:21
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `id_denuncia` int(11) NOT NULL,
  `id_denunciante` int(11) NOT NULL,
  `denuncia_fato` varchar(100) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `numero_documento` varchar(50) NOT NULL,
  `data_entrada` date NOT NULL,
  `observacao` varchar(100) NOT NULL,
  `anexo` int(5) NOT NULL,
  `data_digitacao` datetime NOT NULL DEFAULT current_timestamp(),
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denuncia`
--

INSERT INTO `denuncia` (`id_denuncia`, `id_denunciante`, `denuncia_fato`, `tipo_documento`, `numero_documento`, `data_entrada`, `observacao`, `anexo`, `data_digitacao`, `user`) VALUES
(37, 1, '	roubo', 8, '505', '2010-07-15', 'teste		', 0, '2021-07-12 20:06:02', 0),
(40, 1, '	teste', 8, '14', '2021-07-14', '14 teste		', 0, '2021-07-14 18:52:18', 0),
(41, 1, '	teste de 14/07 /:/ denunciante:TCE\r\n/:/ Tipo de documento: ofício /:/ numero do documento: 514 /:/ ', 8, '', '2021-07-14', '		teste', 0, '2021-07-14 19:08:31', 0),
(43, 1, 'teste de II de 14/07 /:/ denunciante:TCE\r\n/:/ Tipo de documento: ofício /:/ numero do documento: 515', 1, '1', '2021-07-14', 'teste 2		', 0, '2021-07-14 19:39:39', 0),
(44, 1, '	TESTE 3', 1, '1', '2021-07-14', 'TESTE WATS		', 0, '2021-07-14 19:40:39', 0),
(45, 1, '	tsete 4', 1, '516', '2021-07-14', 'teste 4		', 0, '2021-07-14 19:43:42', 0),
(46, 1, '	teste 5', 8, '5', '2021-07-14', 'teste 5		', 0, '2021-07-14 19:44:40', 0),
(47, 3, 'TESTE 6', 2, '600', '2021-07-14', 'TESTE 600		', 0, '2021-07-14 19:46:10', 0),
(48, 1, 'Denuncia: TESTE 7', 1, '700', '2021-07-14', 'TESTE 700		', 0, '2021-07-14 19:54:06', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciante`
--

CREATE TABLE `denunciante` (
  `id_denunciante` int(11) NOT NULL,
  `nome_denunciante` varchar(80) NOT NULL,
  `observacaoDenunciante` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denunciante`
--

INSERT INTO `denunciante` (`id_denunciante`, `nome_denunciante`, `observacaoDenunciante`) VALUES
(1, 'TCE/MT', '			'),
(2, 'MP/MT', '			'),
(3, 'CONTROLADORIA INTERNA', '			Município de Várzea Grande'),
(4, 'NÃO INFORMADO', '			');

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
(1, 'PROCESSO PRELIMINAR'),
(2, 'SINDICÂNCIA'),
(3, 'PAD');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencia`
--

CREATE TABLE `ocorrencia` (
  `id_ocorrencia` int(11) NOT NULL,
  `id_processo` int(11) NOT NULL,
  `numero_processo` varchar(20) NOT NULL,
  `data_ocorrencia` date NOT NULL DEFAULT current_timestamp(),
  `ocorrencia` varchar(120) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `anexo` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `data_digitacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ocorrencia`
--

INSERT INTO `ocorrencia` (`id_ocorrencia`, `id_processo`, `numero_processo`, `data_ocorrencia`, `ocorrencia`, `observacao`, `anexo`, `user`, `data_digitacao`) VALUES
(4, 3, '505', '2021-07-15', 'TESTE DE OCORRÊNCIA EM PROCESSO', '', 0, 1, '2021-07-17 09:39:09'),
(9, 2, '209', '2021-07-19', 'reativando processo', '', 0, 1, '2021-07-19 06:19:15'),
(18, 3, '505', '2021-07-19', 'teste com formulário vinculado', 'teste', 0, 1, '2021-07-19 21:19:22'),
(19, 3, '505', '2021-07-19', 'TESTANDO HEADER', '', 0, 1, '2021-07-19 21:26:16'),
(20, 3, '505', '2021-07-19', 'TESTE DE HEADER', '', 0, 1, '2021-07-19 21:26:57'),
(21, 3, '505', '2021-07-19', 'TESTE', '', 0, 1, '2021-07-19 21:29:45'),
(23, 4041, '202', '2021-07-19', 'incluindo ocorrência um processo que não existe', '', 0, 1, '2021-07-19 21:44:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `portaria`
--

CREATE TABLE `portaria` (
  `id_portaria` int(11) NOT NULL,
  `id_processo` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `numero_processo` varchar(11) NOT NULL,
  `tipo` varchar(11) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `data_elaboracao` date NOT NULL DEFAULT current_timestamp(),
  `conteudo` text DEFAULT NULL,
  `data_publicacao` date DEFAULT current_timestamp(),
  `veiculo` varchar(15) DEFAULT NULL,
  `prazo` int(11) NOT NULL,
  `data_final` date DEFAULT NULL,
  `dias_a_vencer` int(11) NOT NULL,
  `data_realizada` date DEFAULT current_timestamp(),
  `prazo_atendido` varchar(3) DEFAULT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  `anexo` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `portaria`
--

INSERT INTO `portaria` (`id_portaria`, `id_processo`, `id_fase`, `numero_processo`, `tipo`, `numero`, `data_elaboracao`, `conteudo`, `data_publicacao`, `veiculo`, `prazo`, `data_final`, `dias_a_vencer`, `data_realizada`, `prazo_atendido`, `observacao`, `anexo`, `user`) VALUES
(0, 0, 0, '202', 'instauração', '10', '2021-07-01', '1', '2021-07-03', 'amm', 15, '2021-07-18', -2, '2021-07-25', '', '				', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processo`
--

CREATE TABLE `processo` (
  `id_processo` int(11) NOT NULL,
  `id_denuncia` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `numero_processo` varchar(20) NOT NULL,
  `data_instauracao` date NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `anexo` varchar(100) NOT NULL,
  `data_encerramento` date DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `processo`
--

INSERT INTO `processo` (`id_processo`, `id_denuncia`, `id_fase`, `numero_processo`, `data_instauracao`, `observacao`, `anexo`, `data_encerramento`, `user`) VALUES
(2, 40, 3, '4040', '2015-01-15', ' \r\n					 \r\n					teste pra ver data de encerramento \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					 \r\n					teste \r\n				 \r', '', '2021-07-11', 1),
(3, 48, 2, '505', '2021-07-15', 'TESTANDO PROCESSO PARA INCLUSÃO DE OCORRÊNCIA \r\n	', '', '0000-00-00', 1),
(4, 40, 1, '202', '2021-07-01', ' \r\n					Incluindo um processo que já foi até incluído ocorrência \r\n	 \r\n				', '', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor`
--

CREATE TABLE `servidor` (
  `id_servidor` int(11) NOT NULL,
  `nome_servidor` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `matricula` int(10) NOT NULL,
  `vinculo` varchar(15) NOT NULL,
  `secretaria` varchar(70) NOT NULL,
  `unidade` varchar(100) NOT NULL,
  `observacao` varchar(100) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `tipo_de_documento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `tipo_de_documento`) VALUES
(1, 'COMUNICAÇÃO INTERNA'),
(2, 'OFÍCIO'),
(3, 'CARTA'),
(4, 'BILHETE'),
(5, 'BOLETIM DE OCORRÊNCIA'),
(6, 'WATSAPP'),
(8, 'SEM DOCUMENTO');

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
(2, 'leyd@gmail.com', '#15', '2021-03-14 02:55:17'),
(1, 'val@gmail.com', '123', '2021-02-26 21:55:12'),
(2, 'leyd@gmail.com', '#15', '2021-03-14 02:55:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`id_denuncia`),
  ADD KEY `fk_id-denunciante` (`id_denunciante`),
  ADD KEY `fk_id_tipo_documento` (`tipo_documento`);

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
  ADD PRIMARY KEY (`id_ocorrencia`),
  ADD KEY `fk_id_processo` (`id_processo`),
  ADD KEY `numero_processo` (`numero_processo`),
  ADD KEY `numero_processo_2` (`numero_processo`);

--
-- Índices para tabela `processo`
--
ALTER TABLE `processo`
  ADD PRIMARY KEY (`id_processo`),
  ADD KEY `id_denuncia` (`id_denuncia`),
  ADD KEY `id_fase` (`id_fase`);

--
-- Índices para tabela `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `denunciante`
--
ALTER TABLE `denunciante`
  MODIFY `id_denunciante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  MODIFY `id_ocorrencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `processo`
--
ALTER TABLE `processo`
  MODIFY `id_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD CONSTRAINT `fk_id-denunciante` FOREIGN KEY (`id_denunciante`) REFERENCES `denunciante` (`id_denunciante`),
  ADD CONSTRAINT `fk_id_tipo_documento` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`);

--
-- Limitadores para a tabela `processo`
--
ALTER TABLE `processo`
  ADD CONSTRAINT `processo_ibfk_1` FOREIGN KEY (`id_denuncia`) REFERENCES `denuncia` (`id_denuncia`),
  ADD CONSTRAINT `processo_ibfk_2` FOREIGN KEY (`id_fase`) REFERENCES `fase` (`id_fase`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
