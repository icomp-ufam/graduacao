-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `graduacaoatv`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexo`
--

CREATE TABLE IF NOT EXISTS `anexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `hash` int(11) NOT NULL,
  `solicitacao_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE IF NOT EXISTS `atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `max_horas` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `atividade`
--

INSERT INTO `atividade` (`id`, `codigo`, `nome`, `max_horas`, `curso_id`, `grupo_id`) VALUES
(1, 'Atv01', 'AtividadeEnsino', 20, 1, 1),
(2, 'Atv02', 'AtividadPesquisa', 20, 1, 2),
(3, 'Atv3', 'AtividadeExtensão', 30, 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comissao`
--

CREATE TABLE IF NOT EXISTS `comissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `comissao`
--

INSERT INTO `comissao` (`id`, `idProfessor`) VALUES
(11, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `max_horas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `codigo`, `nome`, `max_horas`) VALUES
(1, 'IE15', 'Sistemas de Informação', 120),
(2, 'IE08', 'Ciência da Computação', 150);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codDisciplina` varchar(10) CHARACTER SET utf8 NOT NULL,
  `nomeDisciplina` varchar(150) CHARACTER SET utf8 NOT NULL,
  `cargaHoraria` int(3) NOT NULL,
  `creditos` int(3) NOT NULL,
  `possuiMonitoria` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codDisciplina` (`codDisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1730 ;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `codDisciplina`, `nomeDisciplina`, `cargaHoraria`, `creditos`, `possuiMonitoria`) VALUES
(1729, 'ICC011', 'LABORATÓRIO DE PROGRAMAÇÃO A', 60, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_periodo`
--

CREATE TABLE IF NOT EXISTS `disciplina_periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idDisciplina` int(11) NOT NULL,
  `codTurma` varchar(10) CHARACTER SET utf8 NOT NULL,
  `idCurso` int(11) NOT NULL,
  `idProfessor` int(11) DEFAULT NULL,
  `nomeUnidade` varchar(100) CHARACTER SET utf8 NOT NULL,
  `qtdVagas` int(4) NOT NULL,
  `numPeriodo` tinyint(1) NOT NULL,
  `anoPeriodo` int(4) NOT NULL,
  `dataInicioPeriodo` date DEFAULT NULL,
  `dataFimPeriodo` date DEFAULT NULL,
  `usaLaboratorio` tinyint(1) DEFAULT '0',
  `qtdMonitorBolsista` int(4) DEFAULT '0',
  `qtdMonitorNaoBolsista` int(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idDisciplinaPeriodo` (`idDisciplina`,`numPeriodo`,`anoPeriodo`,`codTurma`),
  KEY `fk_disciplina_periodo_idDisciplina` (`idDisciplina`),
  KEY `fk_disciplina_periodo_idCurso` (`idCurso`),
  KEY `fk_disciplina_periodo_idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Extraindo dados da tabela `disciplina_periodo`
--

INSERT INTO `disciplina_periodo` (`id`, `idDisciplina`, `codTurma`, `idCurso`, `idProfessor`, `nomeUnidade`, `qtdVagas`, `numPeriodo`, `anoPeriodo`, `dataInicioPeriodo`, `dataFimPeriodo`, `usaLaboratorio`, `qtdMonitorBolsista`, `qtdMonitorNaoBolsista`) VALUES
(129, 1729, 'TTE', 2, 9, 'IComp', 2, 2, 2015, '2016-01-24', '2016-01-30', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE IF NOT EXISTS `frequencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDMonitoria` int(11) NOT NULL,
  `dmy` date NOT NULL,
  `ch` float NOT NULL,
  `atividade` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDMonitoria` (`IDMonitoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `max_horas` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `codigo`, `nome`, `max_horas`, `curso_id`) VALUES
(1, 'Grupo1', 'Ensino', 40, 1),
(2, 'Grupo2', 'Pesquisa', 40, 1),
(3, 'Grupo3', 'Extensão', 40, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1452529416),
('m151023_003007_Tabela_Usua', 1452529419),
('m151023_004230_Inserir_Usuario', 1452529419),
('m151023_232410_Adc_Coluna_Curso_id', 1452529419),
('m151026_134015_Tabela_Cursos', 1452529419),
('m151026_134357_Tabela_Grupos', 1452529419),
('m151026_134526_Tabela_Atividade', 1452529419),
('m151026_134945_Tabela_Periodo', 1452529419),
('m151026_135427_Tabela_Anexo', 1452529419),
('m151026_140506_Tabela_Solicitacao', 1452529419),
('m151123_212428_add_sol_id_anexo', 1452529419),
('m151207_195653_add_collumn_arquivo', 1452529419),
('m151208_011339_add_colunas_solicitacao', 1452529419),
('m160110_171631_Coluna_Ativo_Periodo', 1452529419),
('m160110_192210_Coluna_Curso_Grupo', 1452529419),
('m160111_020838_Add_Coluna_DATACRIACAO_SOLI', 1452529419);

-- --------------------------------------------------------

--
-- Estrutura da tabela `monitoria`
--

CREATE TABLE IF NOT EXISTS `monitoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDAluno` int(11) NOT NULL,
  `IDDisc` int(11) NOT NULL,
  `IDperiodoinscr` int(11) NOT NULL,
  `pathArqHistorico` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` int(11) DEFAULT NULL,
  `semestreConclusao` tinyint(1) NOT NULL,
  `anoConclusao` int(4) NOT NULL,
  `mediaFinal` float NOT NULL,
  `bolsa` tinyint(1) NOT NULL,
  `banco` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `agencia` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `conta` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `datacriacao` datetime DEFAULT NULL,
  `pathArqPlanoDisciplina` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `pathArqRelatorioSemestral` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDDisc` (`IDDisc`) USING BTREE,
  KEY `IDAluno` (`IDAluno`),
  KEY `IDperiodoinscr` (`IDperiodoinscr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Extraindo dados da tabela `monitoria`
--

INSERT INTO `monitoria` (`id`, `IDAluno`, `IDDisc`, `IDperiodoinscr`, `pathArqHistorico`, `status`, `semestreConclusao`, `anoConclusao`, `mediaFinal`, `bolsa`, `banco`, `agencia`, `conta`, `datacriacao`, `pathArqPlanoDisciplina`, `pathArqRelatorioSemestral`) VALUES
(34, 7, 129, 3, 'uploads/historicos/20902175_20162001_202456.pdf', 2, 2, 2017, 7.89, 0, 'ert45', 'X34', '2345x', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `dtInicio` date NOT NULL,
  `dtTermino` date NOT NULL,
  `isAtivo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `periodo`
--

INSERT INTO `periodo` (`id`, `codigo`, `dtInicio`, `dtTermino`, `isAtivo`) VALUES
(1, '2015/2', '2015-09-08', '2016-01-27', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `periodoinscricao`
--

CREATE TABLE IF NOT EXISTS `periodoinscricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `periodo` tinyint(1) NOT NULL,
  `ano` int(4) NOT NULL,
  `justificativa` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `periodoinscricao`
--

INSERT INTO `periodoinscricao` (`id`, `dataInicio`, `dataFim`, `periodo`, `ano`, `justificativa`) VALUES
(3, '2016-01-19', '2016-01-30', 2, 2015, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE IF NOT EXISTS `solicitacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `dtInicio` date NOT NULL,
  `dtTermino` date NOT NULL,
  `horasComputadas` int(11) DEFAULT NULL,
  `observacoes` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  `solicitante_id` int(11) NOT NULL,
  `aprovador_id` int(11) NOT NULL,
  `anexo_id` int(11) NOT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `anexoOriginalName` varchar(255) DEFAULT NULL,
  `anexoHashName` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `solicitacao`
--

INSERT INTO `solicitacao` (`id`, `descricao`, `dtInicio`, `dtTermino`, `horasComputadas`, `observacoes`, `status`, `atividade_id`, `solicitante_id`, `aprovador_id`, `anexo_id`, `arquivo`, `anexoOriginalName`, `anexoHashName`, `created_at`) VALUES
(1, 'Certificado de Palestra', '2016-01-11', '2016-01-11', 5, '', 'Aberto', 1, 3, 0, 0, '', NULL, NULL, '2016-01-11'),
(4, 'Atividade2', '2016-01-11', '2016-01-11', 5, '', 'Aberto', 2, 3, 0, 0, '', NULL, NULL, '2016-01-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cpf` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `matricula` varchar(20) DEFAULT NULL,
  `siape` varchar(20) DEFAULT NULL,
  `perfil` varchar(20) NOT NULL,
  `dtEntrada` date DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `isAtivo` tinyint(1) NOT NULL,
  `auth_key` varchar(65) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `telefone` varchar(25) NOT NULL,
  `endereco` text NOT NULL,
  `rg` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `cpf`, `email`, `password`, `matricula`, `siape`, `perfil`, `dtEntrada`, `isAdmin`, `isAtivo`, `auth_key`, `password_reset_token`, `curso_id`, `telefone`, `endereco`, `rg`) VALUES
(1, 'Admin Master', '999', 'admin@master.com', 'b706835de79a2b4e80506f582af3676a', '', '', 'admin', '0000-00-00', 1, 1, NULL, NULL, NULL, '', '', ''),
(2, 'Leonardo', '01332884202', 'leonardo.almeida18@gmail.com', '4417ee9b580735c1a2a52b87691b2b8d', '21206254', NULL, 'Aluno', NULL, 0, 0, NULL, NULL, 1, '', '', ''),
(3, 'Luciene Oliveira da Silva', '51950880206', 'lucieneolivi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '20902150', NULL, 'Aluno', NULL, 0, 0, NULL, NULL, 1, '', '', ''),
(8, 'Coordenador 1', '34233710993', 'coord@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '09876', NULL, 'Coordenador', NULL, 0, 0, NULL, NULL, 1, '', '', ''),
(9, 'Coordenador 2', '04260027921', 'coord2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '345678', NULL, 'Coordenador', NULL, 0, 0, NULL, NULL, 2, '', '', ''),
(10, 'Secretaria', '78783447792', 'sec@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '34567', NULL, 'Secretaria', NULL, 0, 0, NULL, NULL, NULL, '', '', ''),
(12, 'Gabriel Gama', '00864294263', 'gabrielgamagga@gmail.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '21455604', NULL, 'Aluno', NULL, 0, 0, NULL, NULL, 1, '', '', '');

-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `view_aluno_monitoria`
--
CREATE TABLE IF NOT EXISTS `view_aluno_monitoria` (
`id` int(11)
,`id_disciplina` int(11)
,`aluno` varchar(100)
,`IDAluno` int(11)
,`matricula` varchar(20)
,`cpf` varchar(100)
,`mediaFinal` float
,`bolsa` tinyint(1)
,`bolsa_traducao` varchar(3)
,`banco` varchar(5)
,`agencia` varchar(10)
,`conta` varchar(10)
,`semestreConclusao` tinyint(1)
,`anoConclusao` int(4)
,`telefoneAluno` varchar(25)
,`enderecoAluno` text
,`emailAluno` varchar(100)
,`RgAluno` varchar(15)
,`nomeCursoAluno` varchar(100)
,`codDisciplina` varchar(10)
,`nomeDisciplina` varchar(150)
,`codTurma` varchar(10)
,`professor` varchar(100)
,`telefoneProfessor` varchar(25)
,`emailProfessor` varchar(100)
,`nomeCurso` varchar(100)
,`codStatus` int(11)
,`status` varchar(36)
,`periodo` varchar(16)
,`IDperiodoinscr` int(11)
,`pathArqHistorico` varchar(250)
,`pathArqPlanoDisciplina` varchar(250)
,`pathArqRelatorioSemestral` varchar(250)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `view_disciplina_monitoria`
--
CREATE TABLE IF NOT EXISTS `view_disciplina_monitoria` (
`id` int(11)
,`nomeDisciplina` varchar(150)
,`codDisciplina` varchar(10)
,`nomeCurso` varchar(100)
,`codTurma` varchar(10)
,`nomeProfessor` varchar(100)
,`numPeriodo` tinyint(1)
,`anoPeriodo` int(4)
,`qtdVagas` int(4)
,`lab` tinyint(1)
,`lab_traducao` varchar(3)
,`qtdMonitorBolsista` int(4)
,`qtdMonitorNaoBolsista` int(4)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `view_professor_monitoria`
--
CREATE TABLE IF NOT EXISTS `view_professor_monitoria` (
`id` int(11)
,`id_disciplina` int(11)
,`codDisciplina` varchar(10)
,`nomeDisciplina` varchar(150)
,`codTurma` varchar(10)
,`professor` varchar(100)
,`cpfProfessor` varchar(100)
,`idProfessor` int(11)
,`nomeCursoDisciplina` varchar(100)
,`aluno` varchar(100)
,`IDAluno` int(11)
,`matricula` varchar(20)
,`nomeCursoAluno` varchar(100)
,`bolsa` tinyint(1)
,`bolsa_traducao` varchar(3)
,`periodo` varchar(16)
,`IDperiodoinscr` int(11)
,`pathArqPlanoDisciplina` varchar(250)
,`pathArqRelatorioSemestral` varchar(250)
);
-- --------------------------------------------------------

--
-- Estrutura para visualizar `view_aluno_monitoria`
--
DROP TABLE IF EXISTS `view_aluno_monitoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_aluno_monitoria` AS select `m`.`id` AS `id`,`m`.`IDDisc` AS `id_disciplina`,`u`.`name` AS `aluno`,`m`.`IDAluno` AS `IDAluno`,`u`.`matricula` AS `matricula`,`u`.`cpf` AS `cpf`,`m`.`mediaFinal` AS `mediaFinal`,`m`.`bolsa` AS `bolsa`,if((`m`.`bolsa` = 1),'Sim','Não') AS `bolsa_traducao`,`m`.`banco` AS `banco`,`m`.`agencia` AS `agencia`,`m`.`conta` AS `conta`,`m`.`semestreConclusao` AS `semestreConclusao`,`m`.`anoConclusao` AS `anoConclusao`,`u`.`telefone` AS `telefoneAluno`,`u`.`endereco` AS `enderecoAluno`,`u`.`email` AS `emailAluno`,`u`.`rg` AS `RgAluno`,`ca`.`nome` AS `nomeCursoAluno`,`d`.`codDisciplina` AS `codDisciplina`,`d`.`nomeDisciplina` AS `nomeDisciplina`,`dp`.`codTurma` AS `codTurma`,`p`.`name` AS `professor`,`p`.`telefone` AS `telefoneProfessor`,`p`.`email` AS `emailProfessor`,`c`.`nome` AS `nomeCurso`,`m`.`status` AS `codStatus`,(case `m`.`status` when 0 then 'Aguardando Avaliação' when 1 then 'Selecionado com bolsa' when 2 then 'Selecionado sem bolsa' when 3 then 'Não selecionado' when 4 then 'Indeferido - Nota < 7' when 5 then 'Indeferido - Coeficiente < 5' when 6 then 'Indeferido - Não cursou a disciplina' end) AS `status`,concat(`pi`.`ano`,'/',`pi`.`periodo`) AS `periodo`,`m`.`IDperiodoinscr` AS `IDperiodoinscr`,`m`.`pathArqHistorico` AS `pathArqHistorico`,`m`.`pathArqPlanoDisciplina` AS `pathArqPlanoDisciplina`,`m`.`pathArqRelatorioSemestral` AS `pathArqRelatorioSemestral` from (((((((`monitoria` `m` join `disciplina_periodo` `dp` on((`m`.`IDDisc` = `dp`.`id`))) join `disciplina` `d` on((`dp`.`idDisciplina` = `d`.`id`))) left join `usuario` `u` on((`m`.`IDAluno` = `u`.`id`))) left join `usuario` `p` on((`dp`.`idProfessor` = `p`.`id`))) left join `curso` `c` on((`dp`.`idCurso` = `c`.`id`))) left join `periodoinscricao` `pi` on((`m`.`IDperiodoinscr` = `pi`.`id`))) left join `curso` `ca` on((`u`.`curso_id` = `ca`.`id`)));

-- --------------------------------------------------------

--
-- Estrutura para visualizar `view_disciplina_monitoria`
--
DROP TABLE IF EXISTS `view_disciplina_monitoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_disciplina_monitoria` AS select `a`.`id` AS `id`,`b`.`nomeDisciplina` AS `nomeDisciplina`,`b`.`codDisciplina` AS `codDisciplina`,`c`.`nome` AS `nomeCurso`,`a`.`codTurma` AS `codTurma`,`d`.`name` AS `nomeProfessor`,`a`.`numPeriodo` AS `numPeriodo`,`a`.`anoPeriodo` AS `anoPeriodo`,`a`.`qtdVagas` AS `qtdVagas`,`a`.`usaLaboratorio` AS `lab`,if((`a`.`usaLaboratorio` = 1),'Sim','Não') AS `lab_traducao`,`a`.`qtdMonitorBolsista` AS `qtdMonitorBolsista`,`a`.`qtdMonitorNaoBolsista` AS `qtdMonitorNaoBolsista` from (((`disciplina_periodo` `a` join `disciplina` `b` on((`a`.`idDisciplina` = `b`.`id`))) left join `curso` `c` on((`a`.`idCurso` = `c`.`id`))) left join `usuario` `d` on((`a`.`idProfessor` = `d`.`id`)));

-- --------------------------------------------------------

--
-- Estrutura para visualizar `view_professor_monitoria`
--
DROP TABLE IF EXISTS `view_professor_monitoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_professor_monitoria` AS select `m`.`id` AS `id`,`m`.`IDDisc` AS `id_disciplina`,`d`.`codDisciplina` AS `codDisciplina`,`d`.`nomeDisciplina` AS `nomeDisciplina`,`dp`.`codTurma` AS `codTurma`,`p`.`name` AS `professor`,`p`.`cpf` AS `cpfProfessor`,`dp`.`idProfessor` AS `idProfessor`,`c`.`nome` AS `nomeCursoDisciplina`,`u`.`name` AS `aluno`,`m`.`IDAluno` AS `IDAluno`,`u`.`matricula` AS `matricula`,`ca`.`nome` AS `nomeCursoAluno`,`m`.`bolsa` AS `bolsa`,if((`m`.`bolsa` = 1),'Sim','Não') AS `bolsa_traducao`,concat(`pi`.`ano`,'/',`pi`.`periodo`) AS `periodo`,`m`.`IDperiodoinscr` AS `IDperiodoinscr`,`m`.`pathArqPlanoDisciplina` AS `pathArqPlanoDisciplina`,`m`.`pathArqRelatorioSemestral` AS `pathArqRelatorioSemestral` from (((((((`monitoria` `m` join `disciplina_periodo` `dp` on((`m`.`IDDisc` = `dp`.`id`))) join `disciplina` `d` on((`dp`.`idDisciplina` = `d`.`id`))) left join `usuario` `u` on((`m`.`IDAluno` = `u`.`id`))) left join `usuario` `p` on((`dp`.`idProfessor` = `p`.`id`))) left join `curso` `c` on((`dp`.`idCurso` = `c`.`id`))) left join `periodoinscricao` `pi` on((`m`.`IDperiodoinscr` = `pi`.`id`))) left join `curso` `ca` on((`u`.`curso_id` = `ca`.`id`))) where (`m`.`status` in (1,2));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
