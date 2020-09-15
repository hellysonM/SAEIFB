-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Ago-2020 às 21:25
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `helmac_49`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `ID` int(11) NOT NULL,
  `IDUsuario` int(11) NOT NULL,
  `Telefone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Matricula` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_curso`
--

CREATE TABLE `aluno_curso` (
  `ID` int(11) NOT NULL,
  `IDAluno` int(11) NOT NULL,
  `IDCurso` int(11) NOT NULL,
  `Status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `Ingresso` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `StatusAntigo` enum('0','1','','') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo_solicitacao`
--

CREATE TABLE `arquivo_solicitacao` (
  `ID` int(11) NOT NULL,
  `IDSolicitacao` int(11) NOT NULL,
  `Caminho` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Descricao` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Tipo` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `Semestres` int(11) NOT NULL,
  `Descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `DataInserido` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `DataInicio` date NOT NULL,
  `DataTermino` date NOT NULL,
  `Finalizado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE `materia` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Semestre` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf8_unicode_ci NOT NULL,
  `IDCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `ID` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Subtitulo` varchar(500) NOT NULL,
  `Autor` int(11) NOT NULL,
  `Conteudo` text NOT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `ID` int(11) NOT NULL,
  `IDAluno_curso` int(11) NOT NULL,
  `Status` int(11) DEFAULT 1,
  `Data` datetime NOT NULL,
  `DataProfessor` datetime NOT NULL,
  `DataServidor` datetime NOT NULL,
  `IDProfessor` int(11) DEFAULT NULL,
  `IDServidor` int(11) DEFAULT NULL,
  `Observacao` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `AssinaturaServidor` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Assinatura` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_materia`
--

CREATE TABLE `solicitacao_materia` (
  `ID` int(11) NOT NULL,
  `IDSolicitacao` int(11) NOT NULL,
  `IDMateria` int(11) NOT NULL,
  `MateriaOrigem` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Status` enum('0','1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_status`
--

CREATE TABLE `solicitacao_status` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Porcentagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `solicitacao_status`
--

INSERT INTO `solicitacao_status` (`ID`, `Nome`, `Porcentagem`) VALUES
(1, 'Enviado para avaliação', 33),
(2, 'Avaliado pelo professor', 66),
(3, 'Documentação incompleta. Aguardardando finalização', 66),
(4, 'Finalizado Aprovado', 100),
(5, 'Retornado ao professor', 66),
(6, 'Finalizado, recusado por doc incompleta', 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(100) NOT NULL,
  `Nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CPF` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `DataRegistro` datetime NOT NULL,
  `DataUltimoLogin` datetime NOT NULL,
  `IP` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Tipo` enum('1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `Logado` enum('0','1','','') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Matricula` (`Matricula`),
  ADD UNIQUE KEY `IDUsuario` (`IDUsuario`);

--
-- Índices para tabela `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDCurso` (`IDCurso`),
  ADD KEY `IDAluno` (`IDAluno`);

--
-- Índices para tabela `arquivo_solicitacao`
--
ALTER TABLE `arquivo_solicitacao`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDSolicitacao` (`IDSolicitacao`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDCurso` (`IDCurso`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Titulo` (`Titulo`),
  ADD KEY `Autor` (`Autor`);

--
-- Índices para tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDAluno_curso` (`IDAluno_curso`),
  ADD KEY `Status` (`Status`),
  ADD KEY `IDProfessor` (`IDProfessor`),
  ADD KEY `IDServidor` (`IDServidor`);

--
-- Índices para tabela `solicitacao_materia`
--
ALTER TABLE `solicitacao_materia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDMateria` (`IDMateria`),
  ADD KEY `IDSolicitacao` (`IDSolicitacao`);

--
-- Índices para tabela `solicitacao_status`
--
ALTER TABLE `solicitacao_status`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nome` (`Nome`,`Email`,`CPF`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aluno_curso`
--
ALTER TABLE `aluno_curso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `arquivo_solicitacao`
--
ALTER TABLE `arquivo_solicitacao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materia`
--
ALTER TABLE `materia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `solicitacao_materia`
--
ALTER TABLE `solicitacao_materia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`);

--
-- Limitadores para a tabela `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD CONSTRAINT `aluno_curso_ibfk_1` FOREIGN KEY (`IDCurso`) REFERENCES `curso` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `aluno_curso_ibfk_2` FOREIGN KEY (`IDAluno`) REFERENCES `aluno` (`ID`);

--
-- Limitadores para a tabela `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`IDCurso`) REFERENCES `curso` (`ID`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `usuario` (`ID`);

--
-- Limitadores para a tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`IDAluno_curso`) REFERENCES `aluno_curso` (`ID`),
  ADD CONSTRAINT `solicitacao_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `solicitacao_status` (`ID`),
  ADD CONSTRAINT `solicitacao_ibfk_3` FOREIGN KEY (`IDProfessor`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `solicitacao_ibfk_4` FOREIGN KEY (`IDServidor`) REFERENCES `usuario` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
