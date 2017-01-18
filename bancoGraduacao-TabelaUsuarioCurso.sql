-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 18/01/2017 às 13:26
-- Versão do servidor: 5.7.16-0ubuntu0.16.04.1
-- Versão do PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `graduacao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexo`
--

CREATE TABLE `anexo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `hash` int(11) NOT NULL,
  `solicitacao_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade`
--

CREATE TABLE `atividade` (
  `id` int(11) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `max_horas` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `atividade`
--

INSERT INTO `atividade` (`id`, `codigo`, `nome`, `max_horas`, `curso_id`, `grupo_id`) VALUES
(1, '1.1', 'Engajamento em trabalho comunitário em centros sociais, asilos, escolas, comunidades, hospitais..', 15, 1, 3),
(8, '3.1', 'Participação em eventos da SBC.', 10, 1, 1),
(4, '2.1', 'Participação em projetos de consultoria.', 10, 1, 3),
(5, '2.2', 'Estágio extracurricular vinculado à área do curso', 60, 1, 3),
(6, '2.3', 'Participação como membro de comissão organizadora de eventos científicos ou extensão', 60, 1, 3),
(7, '2.4', 'Visita técnica às organizações.', 5, 1, 3),
(9, '3.3', 'Participação em congressos, seminários, simpósios, conferências, fóruns, workshops, semana de curso', 10, 1, 1),
(10, '3.2', 'Comparecimento a treinamentos, conferências e palestras isoladas na área do curso', 10, 1, 1),
(11, '3.4', 'Participação em defesas de mestrado', 2, 1, 1),
(12, '3,5', 'Participação em defesas de doutorado', 4, 1, 1),
(13, '4.1', 'Autor ou co-autor de artigo científico completo publicado em anais.', 20, 1, 2),
(14, '4.4', 'Autor ou co-autor de capítulo de livro.', 30, 1, 2),
(15, '4.2', 'Autor ou coautor de artigo científico completo publicado em revistas', 30, 1, 2),
(16, '4.3', 'Autor ou coautor de artigo científico resumido/expandido, mural, ou pôster publicado em anais/rev', 15, 1, 2),
(17, '4.5', 'Premiação em trabalhos acadêmicos', 10, 1, 2),
(18, '4.6', 'Relatórios de livros e filmes indicados', 10, 1, 2),
(19, '4.7', 'Palestrante em congressos, seminários, simpósios, conferências, fóruns, workshops, semana de curso..', 10, 1, 2),
(20, '4.8', 'Palestrante em minicursos, oficinas ou mesas-redondas', 15, 1, 2),
(21, '4.9', 'Crítica de artigos e textos técnicocientíficos', 10, 1, 2),
(22, '4.10', 'Mediador de mesas-redondas', 10, 1, 2),
(23, '5.1', 'Participação em projetos de PIBIC, aprovados e concluídos', 40, 1, 2),
(24, '5.2', 'Participação em projetos de pesquisa aprovados em outros programas.', 40, 1, 2),
(25, '6.1', 'Participação em monitoria', 30, 1, 1),
(26, '7.1', 'Participação em projetos institucionais de extensão', 20, 1, 3),
(27, '8.1', 'Participação em Programa de Educação Tutorial – PET', 60, 1, 1),
(28, '9.1', 'Carga Horária Optativa Excedente', 60, 1, 1),
(29, '1.1', 'Participação em Monitoria', 60, 2, 1),
(30, '1.2', 'Carga Horária Optativa Excedente', 60, 2, 1),
(31, '1.3', 'Participação como aluno em treinamentos, cursos de nivelamento, mini-cursos, oficinas e certificaçõe', 40, 2, 1),
(32, '1.4', 'Participação como instrutor em treinamentos, cursos de nivelamento, mini-cursos, oficinas e certific', 60, 2, 1),
(33, '1.5', 'Curso de língua estrangeira', 60, 2, 1),
(34, '2.1', 'Autor principal de artigo científico publicado em anais de conferência da área do curso', 30, 2, 2),
(35, '2.2', 'Autor principal de artigo científico publicado em periódico da área do curso.', 60, 2, 2),
(36, '2.3', 'Autor principal de capítulo de livro da área do curso', 60, 2, 2),
(37, '2.4', 'Premiação em trabalhos acadêmicos', 10, 2, 2),
(38, '2.5', 'Participação em projetos de pesquisa na área do curso, devidamente aprovados', 60, 2, 2),
(39, '3.1', 'Programa de Educação Tutorial – PET', 60, 2, 3),
(40, '3.2', 'Participação em projetos institucionais de extensão', 60, 2, 3),
(41, '3.3', 'Estágio extracurricular vinculado à área do curso', 60, 2, 3),
(42, '3.4', 'Visita técnica a organizações', 4, 2, 3),
(43, '3.5', 'Participação em eventos técnico-científicos na área do curso', 20, 2, 3),
(44, '3.6', 'Organização de eventos técnico-científicos na área do curso', 40, 2, 3),
(45, '3.7', 'Participacao em competições de informática, tais como Maratona de Programação e Olimpíada Brasileira', 60, 2, 3),
(46, '3.8', 'Participação em defesas de TCC', 1, 2, 3),
(47, '3.9', 'Participação em defesas de mestrado', 2, 2, 3),
(48, '3.10', 'Participação em defesas de doutorado', 4, 2, 3),
(49, '3.11', 'Relatórios de livros e filmes indicados', 2, 2, 3),
(50, '3.12', 'Produção de sistema computacional (software), desenvolvido individualmente ou em grupo', 60, 2, 3),
(51, '3.13', 'Atividades de promoção da cidadania (promoção da igualdade étnica-racial, educação ambiental, direit', 10, 2, 3),
(52, '1.0', 'Engajamento em trabalho comunitário em centros sociais, asilos, escolas, comunidades, hospitais, ent', 15, 3, 5),
(53, '2.1', 'Participação em projetos de consultoria. ', 10, 3, 6),
(54, '2.2', 'Estágio extracurricular vinculado à área do curso', 60, 3, 6),
(55, '2.3', 'Participação como membro de comissão organizadora de eventos científicos ou extensão. ', 15, 3, 6),
(56, '2.4', 'Visita técnica às organizações. ', 5, 3, 6),
(57, '3.1', 'Participação em eventos da SBC.', 10, 3, 7),
(58, '3.2', 'Comparecimento a treinamentos, conferências e palestras isoladas na área do curso. ', 10, 3, 7),
(59, '3.3', 'Participação em congressos, seminários, simpósios, conferências, fóruns, workshops, semana de curso,', 10, 3, 7),
(60, '3.4', 'Participação em defesas de mestrado', 2, 3, 7),
(61, '3.5', 'Participação em defesas de doutorado', 4, 3, 7),
(62, '4.1', 'Autor ou coautor de artigo científico completo publicado em anais. ', 20, 3, 8),
(63, '4.2', 'Autor ou coautor de artigo científico completo publicado em revistas. ', 30, 3, 8),
(64, '4.3', 'Autor ou coautor de artigo científico resumido/expandido, mural, ou pôster publicado em anais ou rev', 15, 3, 8),
(65, '4.4', 'Autor ou coautor de capítulo de livro. ', 30, 3, 8),
(66, '4.5', 'Premiação em trabalhos acadêmicos. ', 10, 3, 8),
(67, '4.6', 'Relatórios de livros e filmes indicados. ', 5, 3, 8),
(68, '4.7', 'Palestrante em congressos, seminários, simpósios, conferências, fóruns, workshops, semana de curso, ', 10, 3, 8),
(69, '4.8', 'Palestrante em minicursos, oficinas ou mesas-redondas. ', 15, 3, 8),
(70, '4.9', 'Crítica de artigos e textos técnico-científicos. ', 5, 3, 8),
(71, '4.10', 'Mediador de mesas-redondas', 10, 3, 8),
(72, '5.1', 'Participação em projetos de PIBIC, aprovados e concluídos. ', 40, 3, 9),
(73, '5.2', 'Participação em projetos de pesquisa aprovados em outros programas. ', 40, 3, 9),
(74, '6.1', 'Participação em monitoria. ', 30, 3, 10),
(75, '7.1', 'Participação em projetos institucionaisde extensão (Exemplos: PACE/PIBEX). ', 20, 3, 11),
(76, '8.1', 'Participação em Programa de Educação Tutorial – PET', 30, 3, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comissao`
--

CREATE TABLE `comissao` (
  `id` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `comissao`
--

INSERT INTO `comissao` (`id`, `idProfessor`) VALUES
(11, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `max_horas` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `curso`
--

INSERT INTO `curso` (`id`, `codigo`, `nome`, `max_horas`) VALUES
(1, 'IE15', 'Sistemas de Informação', 120),
(2, 'IE08', 'Ciência da Computação - v2016', 200),
(3, '2012', 'Ciência da Computação - v2012', 140);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL,
  `codDisciplina` varchar(10) CHARACTER SET utf8 NOT NULL,
  `nomeDisciplina` varchar(150) CHARACTER SET utf8 NOT NULL,
  `cargaHoraria` int(3) NOT NULL,
  `creditos` int(3) NOT NULL,
  `possuiMonitoria` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `codDisciplina`, `nomeDisciplina`, `cargaHoraria`, `creditos`, `possuiMonitoria`) VALUES
(1729, 'ICC011', 'LABORATÓRIO DE PROGRAMAÇÃO A', 60, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina_periodo`
--

CREATE TABLE `disciplina_periodo` (
  `id` int(11) NOT NULL,
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
  `qtdMonitorNaoBolsista` int(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `disciplina_periodo`
--

INSERT INTO `disciplina_periodo` (`id`, `idDisciplina`, `codTurma`, `idCurso`, `idProfessor`, `nomeUnidade`, `qtdVagas`, `numPeriodo`, `anoPeriodo`, `dataInicioPeriodo`, `dataFimPeriodo`, `usaLaboratorio`, `qtdMonitorBolsista`, `qtdMonitorNaoBolsista`) VALUES
(129, 1729, 'TTE', 2, 9, 'IComp', 2, 2, 2015, '2016-01-24', '2016-01-30', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `id` int(11) NOT NULL,
  `IDMonitoria` int(11) NOT NULL,
  `dmy` date NOT NULL,
  `ch` float NOT NULL,
  `atividade` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `max_horas` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `grupo`
--

INSERT INTO `grupo` (`id`, `codigo`, `nome`, `max_horas`, `curso_id`) VALUES
(1, 'Grupo1', 'Ensino', 120, 1),
(2, 'Grupo2', 'Pesquisa', 120, 1),
(3, 'Grupo3', 'Extensão', 120, 1),
(5, '1', 'Atividades de Promoção da Cidadania - v2012', 30, 3),
(6, '2', 'Atividades de Intervenção Organizacional - v2012', 60, 3),
(7, '3', 'Participação em Eventos Técnico-Científicos - v2012', 50, 3),
(8, '4', 'Produção Técnico-Científica - v2012', 80, 3),
(9, '5', 'Iniciação Científica - v2012', 80, 3),
(10, '6', 'Monitoria - v2012', 60, 3),
(11, '7', 'Extensão - v2012', 60, 3),
(12, '8', 'Programa Especial de Treinamento - v2012', 60, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `migration`
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
-- Estrutura para tabela `monitoria`
--

CREATE TABLE `monitoria` (
  `id` int(11) NOT NULL,
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
  `pathArqRelatorioSemestral` varchar(250) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `monitoria`
--

INSERT INTO `monitoria` (`id`, `IDAluno`, `IDDisc`, `IDperiodoinscr`, `pathArqHistorico`, `status`, `semestreConclusao`, `anoConclusao`, `mediaFinal`, `bolsa`, `banco`, `agencia`, `conta`, `datacriacao`, `pathArqPlanoDisciplina`, `pathArqRelatorioSemestral`) VALUES
(34, 7, 129, 3, 'uploads/historicos/20902175_20162001_202456.pdf', 2, 2, 2017, 7.89, 0, 'ert45', 'X34', '2345x', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `periodo`
--

CREATE TABLE `periodo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `dtInicio` date NOT NULL,
  `dtTermino` date NOT NULL,
  `isAtivo` tinyint(1) DEFAULT NULL,
  `dtInicioInscMonitoria` date DEFAULT NULL,
  `dtTerminoInscMonitoria` date DEFAULT NULL,
  `justificativaPlanoSemestral` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `periodo`
--

INSERT INTO `periodo` (`id`, `codigo`, `dtInicio`, `dtTermino`, `isAtivo`, `dtInicioInscMonitoria`, `dtTerminoInscMonitoria`, `justificativaPlanoSemestral`) VALUES
(1, '2015/2', '2015-09-08', '2016-02-27', 0, '2016-01-01', '2016-02-27', NULL),
(2, '2016/1', '2016-05-23', '2016-09-30', 1, '2016-05-23', '2016-06-01', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `dtInicio` date NOT NULL,
  `dtTermino` date NOT NULL,
  `horasLancadas` int(11) NOT NULL,
  `horasComputadas` int(11) DEFAULT NULL,
  `observacoes` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `solicitante_id` int(11) NOT NULL,
  `aprovador_id` int(11) NOT NULL,
  `anexo_id` int(11) NOT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `anexoOriginalName` varchar(255) DEFAULT NULL,
  `anexoHashName` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `solicitacao`
--

INSERT INTO `solicitacao` (`id`, `descricao`, `dtInicio`, `dtTermino`, `horasLancadas`, `horasComputadas`, `observacoes`, `status`, `atividade_id`, `periodo_id`, `solicitante_id`, `aprovador_id`, `anexo_id`, `arquivo`, `anexoOriginalName`, `anexoHashName`, `created_at`) VALUES
(1, 'Encosis 2015', '2015-08-27', '2015-08-29', 10, 0, '', 'Pre-Aprovada', 9, 2, 16, 10, 0, NULL, 'GERAL_LARISSA_LORENA_EVANGELISTA_DAS_NEVES_2015.pdf', '16_992309.pdf', '2016-07-04'),
(2, 'Palestra', '2016-07-01', '2016-07-03', 10, 0, '', 'Aberto', 23, 2, 20, 0, 0, NULL, 'certificado.pdf', '20_229676.pdf', '2016-07-05'),
(3, 'Optativas Excedentes', '2016-07-01', '2016-07-04', 60, 0, '', 'Aberto', 28, 2, 20, 0, 0, '', NULL, NULL, '2016-07-05'),
(4, 'Monitoria - Disciplina IEC081-Introdução à Ciência dos Computadores', '2015-04-06', '2015-08-31', 30, 0, 'Orientado pelo prof Mario Salvatierra', 'Aberto', 25, 2, 21, 0, 0, NULL, 'ICC.jpg', '21_530287.jpg', '2016-07-14'),
(5, 'Participação Simpósio WEB-MEDIA', '2015-10-27', '2015-10-30', 10, 0, '', 'Aberto', 8, 2, 21, 0, 0, NULL, 'webmedia.jpg', '21_403047.jpg', '2016-07-14'),
(6, 'Participacao no EPA', '2015-04-29', '2015-04-30', 10, 0, 'part epa', 'Submetida', 9, 2, 19, 0, 0, '', 'Certificado EPA 16h.pdf', '19_444227.pdf', '2016-07-15'),
(7, 'Curso online FGV - gestão ti', '2016-05-20', '2016-05-21', 5, 0, 'curso', 'Submetida', 10, 2, 19, 0, 0, '', 'Certificado Fgv GestaoTI 5h.pdf', '19_892095.pdf', '2016-07-15'),
(9, 'WOPI - III Workshop de Pesquisa em Informática', '2013-09-12', '2013-09-13', 14, 14, '', 'Deferida', 43, 2, 30, 14, 0, NULL, 'certificadosWOPI-2013.170.pdf', '30_800116.pdf', '2016-08-03'),
(10, 'PIB-E/0217/2014 Sobre Grafos Rotulados, Graciosos e Colorações', '2014-08-01', '2015-07-31', 30, 0, '', 'Aberto', 38, 2, 29, 0, 0, '', 'pibic2014.pdf', '29_926586.pdf', '2016-08-03'),
(11, 'SEMINFO - Semana de Informática', '2013-06-12', '2013-06-14', 20, 20, '', 'Deferida', 44, 2, 30, 14, 0, NULL, 'voluntarios_seminfo.pdf', '30_877314.pdf', '2016-08-03'),
(12, 'CETELI - Programa de Formação Complementar "Tecnologias para dispositivos móveis"', '2014-05-01', '2014-08-31', 60, 60, '80 horas são referentes à formação teórica ministrada', 'Indeferida', 40, 2, 30, 14, 0, '', NULL, NULL, '2016-08-03'),
(13, 'CETELI - Programa de Formação Complementar "Tecnologias para dispositivos móveis"', '2014-09-01', '2014-12-31', 60, 60, 'Ao total são 100 horas referentes ao desenvolvimento de projeto de aplicativo', 'Deferida', 50, 2, 30, 14, 0, NULL, '2016-08-02 22.26.52.jpg', '30_323627.jpg', '2016-08-03'),
(14, 'PRODAM - Visita Técnica', '2012-05-03', '2012-05-04', 4, 4, '', 'Deferida', 42, 2, 30, 14, 0, NULL, '2016-08-02 23.00.00.jpg', '30_255870.jpg', '2016-08-03'),
(15, 'Participação no Segundo Encontro de Projetos em Ambientes Iterativos -  EPA 2015', '2015-04-29', '2015-04-30', 16, 0, '', 'Aberto', 31, 2, 33, 0, 0, NULL, 'EDWIN_EPA_Certificado.pdf', '33_764573.pdf', '2016-08-03'),
(16, 'EPA-2015', '2015-04-29', '2015-04-30', 16, 0, '', 'Aberto', 31, 2, 34, 0, 0, NULL, 'EPA.pdf', '34_701672.pdf', '2016-08-03'),
(17, 'Voluntário do projeto de pesquisa CURUPIRAPP - Fornecendo dados de mobilidade de dispositivo móvel.', '2015-05-27', '2015-05-31', 5, 0, '', 'Aberto', 31, 2, 34, 0, 0, NULL, 'FBR.pdf', '34_34127.pdf', '2016-08-03'),
(18, 'Participação em Treinamento em Base de Dados ', '2014-10-31', '2014-10-31', 4, 0, 'Treinamento em Base de Dados : Pergamum e Thomson Reuteres', 'Aberto', 31, 2, 33, 0, 0, '', 'BSFT_certificado.pdf', '33_299046.pdf', '2016-08-03'),
(19, 'Participação em Curso de Linux', '2014-05-15', '2014-05-16', 8, 0, 'Curso ministrado pelo professor Moises Carvalho', 'Aberto', 31, 2, 33, 0, 0, NULL, 'PresencasCC-EC_CursoLinux.pdf', '33_523042.pdf', '2016-08-03'),
(20, 'Curso de Linux', '2015-05-15', '2015-05-16', 8, 0, '', 'Aberto', 31, 2, 34, 0, 0, NULL, 'PresencasCC-EC_CursoLinux.pdf', '34_874639.pdf', '2016-08-03'),
(21, 'Certificado de Conclusão de Curso de Inglês', '2013-08-03', '2014-12-13', 60, 60, '', 'Deferida', 33, 2, 36, 14, 0, '', 'New Doc_1.pdf', '36_978029.pdf', '2016-08-03'),
(49, 'Aproveitamento de horas excedentes de matérias optativas', '2015-01-01', '2015-12-31', 75, NULL, 'Horas optativas já foram concluídas e gostaria de utilizar as horas excedentes como horas comp.', 'Aberto', 30, 2, 44, 0, 0, NULL, 'historico escolar jhonny.pdf', '44_664400.pdf', '2016-10-28'),
(48, 'Certificado de Participação do PIBIC 2014/2015', '2014-08-01', '2015-07-31', 60, 60, '', 'Deferida', 38, 2, 36, 14, 0, NULL, 'pesquisa_60h_pibic.pdf', '36_456217.pdf', '2016-10-27'),
(24, 'Certificado de Participação AASSQ 2015', '2015-08-17', '2015-08-21', 20, 20, '', 'Deferida', 43, 2, 36, 14, 0, '', 'v0_CERTIFICADO_Leandro.pdf', '36_44901.pdf', '2016-08-03'),
(46, 'Carga horária optativa excedente', '2016-10-26', '2016-10-26', 60, 60, 'Possuo 210h de carga horária optativa excedente, devido à mudanças na grade curricular do curso.', 'Indeferida', 30, 2, 37, 14, 0, NULL, 'HISTÓRICO ESCOLAR - VICTOR VALENTE - 21002593.pdf', '37_676825.pdf', '2016-10-26'),
(26, 'Certificado de participação no Hackathon do II EPA (3º lugar).', '2015-04-29', '2015-04-30', 12, 12, '', 'Deferida', 45, 2, 37, 14, 0, NULL, 'Certificados_Hackathon_Victor.pdf', '37_652442.pdf', '2016-08-05'),
(27, 'Certificado de participação no EPA 2015', '2015-04-29', '2015-04-30', 16, 16, '', 'Deferida', 43, 2, 37, 14, 0, NULL, 'CERTIFICADO EPA II.pdf', '37_843344.pdf', '2016-08-05'),
(28, 'Certificado de participação do curso Introdução ao Android oferecido pelo OCEAN - Samsung', '2014-11-18', '2014-11-18', 4, 4, '', 'Deferida', 31, 2, 37, 14, 0, NULL, 'CERTIFICADO INTRO AO ANDROID OCEAN.pdf', '37_946015.pdf', '2016-08-05'),
(29, 'Certificado de participação no WoPI II (2012)', '2012-11-12', '2012-11-13', 16, 16, '', 'Deferida', 31, 2, 37, 14, 0, NULL, 'CERTIFICADO WOPI 2012.pdf', '37_10152.pdf', '2016-08-05'),
(30, 'Certificado de participação na SEMINFO 2013', '2013-06-12', '2013-06-14', 4, 4, '', 'Deferida', 43, 2, 37, 14, 0, NULL, 'CERTIFICADO SEMINFO 2013.pdf', '37_441100.pdf', '2016-08-05'),
(31, 'Certificado de participação no curso de SCRUM da SEMINFO 2013', '2013-06-12', '2013-06-14', 4, 4, '', 'Deferida', 31, 2, 37, 14, 0, NULL, 'CERTIFICADO SCRUM SEMINFO 2013.pdf', '37_508061.pdf', '2016-08-05'),
(33, 'Participação do experimento “Reconhecimento de Engajamento em sessões de vídeos"', '2016-06-20', '2016-06-21', 3, 3, '', 'Deferida', 40, 2, 25, 14, 0, '', 'Cristhian Giovanni Lopes de Oliveira.pdf', '25_50139.pdf', '2016-09-08'),
(34, 'Certificado de Desenvolvedor de soluções Microsoft: Windows Store Apps Using C#', '2015-12-03', '2015-12-04', 2, 2, '', 'Deferida', 31, 2, 25, 14, 0, NULL, 'Certificate_1.pdf', '25_605645.pdf', '2016-09-08'),
(35, 'Certificação Especialista Microsoft: Programando em C#', '2015-05-03', '2015-05-04', 2, 2, '', 'Deferida', 31, 2, 25, 14, 0, NULL, 'Certificate_2.pdf', '25_33900.pdf', '2016-09-08'),
(36, 'Certificação Profissional Microsoft ', '2015-11-02', '2015-11-03', 2, 2, '', 'Deferida', 31, 2, 25, 14, 0, NULL, 'Certificate_3.pdf', '25_687521.pdf', '2016-09-08'),
(37, 'Participação na defesa: "Detecção de Elementos Antrópicos em Imagens da Floresta Amazônica”.', '2016-07-01', '2016-07-02', 2, 2, 'Defesa de tese de mestrado do disccente  Luiz Carlos', 'Indeferida', 47, 2, 25, 14, 0, '', NULL, NULL, '2016-09-08'),
(38, 'Curso FGV Online - Fundamentos da Gestão de TI', '2016-07-29', '2016-07-30', 5, 5, '', 'Deferida', 31, 2, 31, 14, 0, '', 'FundGestao_certificado_Fgv.pdf', '31_889725.pdf', '2016-09-13'),
(39, 'Curso FGV Online - Ciência e Tecnologia', '2016-07-29', '2016-07-30', 15, 15, '', 'Deferida', 31, 2, 31, 14, 0, NULL, 'CienciaTecnologia_certificado_Fgv.pdf', '31_946794.pdf', '2016-09-13'),
(41, 'WoPi 2012 - Workshop de Pesquisa em Informática', '2013-11-12', '2013-11-13', 20, 0, '', 'Aberto', 43, 2, 31, 0, 0, NULL, 'Certificado-WoPI.31.pdf', '31_310165.pdf', '2016-09-13'),
(45, 'Artigo: Um Relato de Experiência no Ensino de Programação Utilizando Scratch', '2016-05-14', '2016-05-14', 20, NULL, 'Email de confirmação', 'Pre-Aprovada', 13, 2, 16, 10, 0, NULL, 'emailconfirmacao_kodikos_Encosis.png', '16_240182.png', '2016-10-18'),
(43, 'Participou do curso de Times SCRUM ', '2016-03-18', '2016-03-19', 10, NULL, '', 'Pre-Aprovada', 10, 2, 16, 10, 0, NULL, 'Certificado_Larissa_Lorena_SCRUM.pdf', '16_798777.pdf', '2016-10-18'),
(44, 'Artigo: Testes Baseados em Tela Sensível ao Toque em Aplicações Móveis Apoiados por Robô', '2016-05-14', '2016-05-14', 20, NULL, 'Email de confirmação ', 'Pre-Aprovada', 13, 2, 16, 10, 0, NULL, 'emailconfirmacao_robo_Encosis.png', '16_123562.png', '2016-10-18'),
(42, 'Encosis 2016', '2016-06-02', '2016-06-04', 10, NULL, '', 'Pre-Aprovada', 9, 2, 16, 10, 0, '', 'CERTIFICADO_GERAL_LARISSA_LORENA_E_DAS_NEVES_2016.pdf', '16_287325.pdf', '2016-10-18'),
(47, 'Certificado de Monitoria', '2014-04-01', '2014-09-30', 60, 60, '', 'Deferida', 29, 2, 36, 14, 0, '', 'ensino_60h_monitoria.pdf', '36_357891.pdf', '2016-10-27'),
(50, 'Curso de língua estrangeira realizado nos EUA em 2015 através de bolsa CSF.', '2015-09-02', '2016-02-29', 60, NULL, 'Como visto no documento, foram 21 horas semanais, durante 13 semanas de curso. ', 'Aberto', 33, 2, 44, 0, 0, NULL, 'IMG_20161028_114821.jpg', '44_853039.jpg', '2016-10-28'),
(51, 'Maratona de Programação', '2016-09-10', '2016-09-10', 5, NULL, 'Participei de vários treinamentos pré-maratona. E a maratona em si, com duração de 5 horas. ', 'Submetida', 26, 2, 45, 0, 0, NULL, 'c8e2f772-b081-4814-b699-3f60851c83a8.jpg', '45_954679.jpg', '2016-11-02'),
(52, 'Curso de adaptação do calouro', '2013-05-13', '2013-05-25', 30, NULL, '', 'Aberto', 31, 2, 46, 0, 0, NULL, 'CAC.pdf', '46_572674.pdf', '2016-11-03'),
(53, 'Participação na Amazon Advanced School on Quality', '2015-08-17', '2015-08-21', 40, NULL, '', 'Aberto', 43, 2, 46, 0, 0, '', 'Certificado_AASSQ - Tay.pdf', '46_760729.pdf', '2016-11-03'),
(54, 'Participação no TechTalks', '2016-07-01', '2016-07-01', 4, NULL, '', 'Aberto', 43, 2, 46, 0, 0, '', 'CERTIFICADO_TECHTALKS2016_LASALLE_TAYNAH_ALMEIDA.pdf', '46_494455.pdf', '2016-11-03'),
(55, 'Participação na palestra sobre Comportamento nas Redes Sociais', '2014-11-13', '2014-11-13', 2, NULL, '', 'Aberto', 43, 2, 46, 0, 0, '', 'comportamendo redes sociais.pdf', '46_242716.pdf', '2016-11-03'),
(56, 'Participação na Feira de Aplicativos Pro-Mobile', '2015-02-20', '2015-02-20', 1, NULL, '', 'Aberto', 43, 2, 46, 0, 0, '', 'feira promobile.pdf', '46_384665.pdf', '2016-11-03'),
(57, 'Comparecimento para assistir filme Jogo da Imitação', '2015-02-16', '2015-02-16', 2, NULL, '', 'Aberto', 49, 2, 46, 0, 0, NULL, 'Jogo da Imitação.pdf', '46_283115.pdf', '2016-11-03'),
(58, 'Participação em projeto PAITI', '2015-05-27', '2015-05-27', 5, NULL, '', 'Aberto', 38, 2, 46, 0, 0, NULL, 'paiti.pdf', '46_800375.pdf', '2016-11-03'),
(59, 'Participação como voluntária SBQS 2015', '2015-08-17', '2015-08-21', 45, NULL, '', 'Aberto', 44, 2, 46, 0, 0, NULL, 'SBQS Voluntária.pdf', '46_215553.pdf', '2016-11-03'),
(60, 'Participação no Treinamento da base de dados da biblioteca central', '2014-10-31', '2014-10-31', 3, NULL, '', 'Aberto', 31, 2, 46, 0, 0, NULL, 'treinamento base dados.pdf', '46_57467.pdf', '2016-11-03'),
(61, 'Participação em palestra sobre e-commerce criativo', '2016-07-13', '2016-07-13', 2, NULL, '', 'Aberto', 43, 2, 46, 0, 0, '', 'TAYNAH MARCELE ALMEIDA SANTOS.pdf', '46_879867.pdf', '2016-11-03'),
(62, 'Monitoria em Introdução à Engenharia de Software', '2016-05-25', '2016-09-21', 144, NULL, '', 'Aberto', 29, 2, 46, 0, 0, '', NULL, NULL, '2016-11-03'),
(170, 'Feira de Tecnologia', '2012-03-13', '2012-03-17', 10, NULL, 'Reenvio - já foi apresentado documento original na secretaria.', 'Aberto', 32, 2, 65, 0, 0, NULL, '65_856647.jpg', '65_811211.jpg', '2017-01-07'),
(171, 'Participacação no XXXVI Congresso da Sociedade Brasileira de Computação', '2016-07-04', '2016-07-07', 42, NULL, '', 'Aberto', 57, 2, 120, 0, 0, NULL, 'cbsc_42h.pdf', '120_867236.pdf', '2017-01-07'),
(172, 'Participação na palestra "Tecnologia da Informação Integrada aos Objetivos de Negócios"', '2013-07-16', '2013-07-16', 2, NULL, '', 'Aberto', 58, 2, 120, 0, 0, NULL, '02h_ti-integrada-aos-objetivos-de-negocio.png', '120_856214.png', '2017-01-07'),
(67, 'EPA! 2015', '2015-04-29', '2015-04-30', 16, NULL, '', 'Aberto', 43, 2, 28, 0, 0, '', 'certificado.pdf', '28_256621.pdf', '2016-11-04'),
(68, 'Minicurso de Linux (CACI.Com)', '2015-05-08', '2015-05-08', 2, NULL, '', 'Aberto', 43, 2, 28, 0, 0, NULL, 'certificado(1).pdf', '28_679254.pdf', '2016-11-04'),
(69, 'Participação no Experimento de Engajamento em Sessões de Vídeos - Projeto Health', '2016-06-23', '2016-06-23', 3, NULL, '', 'Submetida', 26, 2, 48, 0, 0, '', 'Certificado.pdf', '48_561964.pdf', '2016-11-04'),
(70, 'Simulado Aberto da Maratona de Programação 2016', '2016-08-13', '2016-08-13', 10, NULL, '', 'Submetida', 6, 2, 48, 0, 0, NULL, 'Certicado do 13-08-2016002.pdf', '48_40125.pdf', '2016-11-04'),
(71, 'Voluntário na Maratona de Programação 2016', '2016-09-10', '2016-09-10', 10, NULL, '', 'Submetida', 6, 2, 48, 0, 0, NULL, 'Certicado do 10-09-2016001.pdf', '48_930361.pdf', '2016-11-04'),
(73, 'EARTH - Robótica com Scratch/S4A no Ensino Básico', '2016-01-25', '2016-01-29', 8, NULL, '', 'Aberto', 31, 2, 50, 0, 0, NULL, 'Scan 25.jpg', '50_563409.jpg', '2016-11-04'),
(74, 'EARTH - Robótica com Scratch/S4A no Ensino Básico', '2016-01-25', '2016-01-29', 20, NULL, '', 'Aberto', 31, 2, 50, 0, 0, NULL, 'Scan 26.jpg', '50_223002.jpg', '2016-11-04'),
(76, 'Maratona 2014', '2014-09-13', '2014-09-13', 5, NULL, '', 'Aberto', 45, 2, 50, 0, 0, NULL, 'Scan 23.jpg', '50_1335.jpg', '2016-11-04'),
(77, 'Maratona 2016', '2016-09-10', '2016-09-10', 5, NULL, '', 'Aberto', 45, 2, 50, 0, 0, NULL, 'Scan27.pdf', '50_486162.pdf', '2016-11-04'),
(78, 'Maratona 2015', '2015-09-12', '2015-09-12', 5, NULL, '', 'Aberto', 45, 2, 50, 0, 0, NULL, 'Scan 28.jpg', '50_258318.jpg', '2016-11-04'),
(79, '1.3 Curso Adaptação Calouro', '2013-05-13', '2013-05-25', 30, NULL, 'Curso ministrado pelo professor Leandro Galvão antes do inicio do periodo letivo de 2013/1', 'Aberto', 31, 2, 56, 0, 0, NULL, 'Páginas de CertificadosCursoCalouros2013-30h.pdf', '56_505938.pdf', '2016-11-04'),
(80, 'Primeira feira de aplicativos PROMOBILE ', '2015-02-20', '2015-02-20', 4, NULL, 'Feira de aplicativos promovida pelo professor Cesar Augusto  coordenador do PROMOBILE', 'Aberto', 32, 2, 56, 0, 0, '', 'certificado_PROMOBILE-4h.pdf', '56_730163.pdf', '2016-11-04'),
(81, 'Treinamento em base de dados: Pergamum e Thompson Reuters', '2014-10-31', '2014-10-31', 3, NULL, 'Mini treinamento oferecido pelo Sistema de bilibotecas da Universidade Federal do Amazonas', 'Aberto', 31, 2, 56, 0, 0, NULL, 'TreinamentoBasedeDados-3h_certificado.pdf', '56_579038.pdf', '2016-11-04'),
(82, 'Palestras da Semana de Informática (Seminfo)', '2013-06-12', '2013-06-12', 4, NULL, 'Semana de informática (Seminfo)', 'Aberto', 31, 2, 56, 0, 0, NULL, 'CertificadoDaSEMINFO.jpg', '56_317751.jpg', '2016-11-04'),
(83, 'PIAP -Programa institucional de apoio pedagógico', '2013-06-01', '2013-06-01', 4, NULL, '', 'Aberto', 31, 2, 56, 0, 0, NULL, 'Apoio-Pedagogico-IC-4h.jpg', '56_853082.jpg', '2016-11-04'),
(84, 'II Encontro de projetos em ambientes interativos (EPA!)', '2015-04-29', '2015-04-30', 16, NULL, 'EPAI- II', 'Aberto', 43, 2, 56, 0, 0, NULL, 'epa2015certificado-16h.pdf', '56_470555.pdf', '2016-11-04'),
(85, 'I Encontro de projetos em ambientes interativos (EPA!)', '2014-01-16', '2014-01-17', 16, NULL, '', 'Aberto', 43, 2, 56, 0, 0, NULL, 'epa2014certificados.pdf', '56_531464.pdf', '2016-11-04'),
(86, 'Curso de Times SCRUM ', '2016-03-18', '2016-03-19', 10, NULL, '', 'Pre-Aprovada', 9, 2, 16, 10, 0, NULL, 'Certificado_Larissa_Lorena_SCRUM.pdf', '16_418002.pdf', '2016-11-06'),
(87, 'Comitê de  Organização do Projeto Kodikós: Clube de Programação para Crianças', '2015-02-27', '2015-04-15', 20, NULL, '', 'Pre-Aprovada', 26, 2, 16, 10, 0, NULL, 'neves.pdf', '16_772285.pdf', '2016-11-06'),
(90, 'Certificado de conclusão de curso pré-avançado de língua Inglesa', '2013-01-25', '2013-06-25', 60, 60, '', 'Deferida', 33, 2, 25, 14, 0, NULL, 'new doc 520161107224128151.pdf', '25_90681.pdf', '2016-11-10'),
(89, 'Mencao Honrosa no II Concurso Apps.edu - V Congresso Brasileiro de Informatica na Educacao', '2016-10-24', '2016-10-27', 10, NULL, '', 'Aberto', 37, 2, 50, 0, 0, NULL, 'Scan 28.pdf', '50_519934.pdf', '2016-11-10'),
(91, 'Projeto de Banco de Dados da Assessoria de Relação Internacional e Interestitucional - Reitoria Ufam', '2014-09-01', '2015-02-27', 60, NULL, 'UFAM-Reitoria-ARII - Assessoria de Relação Internacional e Interestitucional ', 'Aberto', 50, 2, 56, 0, 0, '', 'Certificado do Jhon_ARII.pdf', '56_749161.pdf', '2016-11-13'),
(92, 'Participação como voluntário no Projeto de Pesquisa "Curupirapp-Disseminação de Conteúdo Multimídia"', '2015-05-27', '2015-05-27', 5, 5, 'Voluntário ao instalar e fornecer dados de mobilidade de dispositivo móvel através do APP FeriadoBr', 'Deferida', 38, 2, 43, 14, 0, NULL, 'certificado (2).pdf', '43_604594.pdf', '2016-11-14'),
(93, 'Monitoria', '2016-11-17', '2016-11-17', 30, NULL, '', 'Submetida', 25, 2, 99, 0, 0, NULL, '2016-09-26-PHOTO-00003145.jpg', '99_419427.jpg', '2016-11-17'),
(94, 'Carga horária optativa excedente', '2016-11-17', '2016-11-17', 30, NULL, '', 'Submetida', 28, 2, 99, 0, 0, NULL, 'report.pdf', '99_216880.pdf', '2016-11-17'),
(95, 'Curso na área', '2016-11-17', '2016-11-17', 15, NULL, '', 'Submetida', 20, 2, 99, 0, 0, NULL, 'Instrutor Vinitius Salomão.pdf', '99_882520.pdf', '2016-11-17'),
(96, 'palestrante', '2016-11-17', '2016-11-17', 10, NULL, '', 'Submetida', 19, 2, 99, 0, 0, NULL, 'certificado-vinitius.png', '99_64090.png', '2016-11-17'),
(97, 'mesa redonda', '2016-11-17', '2016-11-17', 15, NULL, '', 'Submetida', 20, 2, 99, 0, 0, NULL, 'certificado_frontend.png', '99_801243.png', '2016-11-17'),
(98, 'Monitoria', '2013-06-03', '2013-09-28', 30, NULL, '', 'Pre-Aprovada', 25, 2, 100, 10, 0, NULL, 'Monitoria.pdf', '100_303473.pdf', '2016-11-17'),
(99, 'Projeto Computação Desplugada', '2013-04-01', '2013-12-01', 40, NULL, '', 'Pre-Aprovada', 24, 2, 100, 10, 0, NULL, 'Computação Desplugada.pdf', '100_61038.pdf', '2016-11-18'),
(100, 'Introdução a Computação', '2012-12-10', '2013-04-18', 60, NULL, '', 'Pre-Aprovada', 28, 2, 100, 10, 0, NULL, 'Histórico Escolar.pdf', '100_635522.pdf', '2016-11-18'),
(101, 'PROGRAMA ESTRATÉGICO DE INDUÇÃO À FORMAÇÃO DE RECURSOS HUMANOS EM ENGENHARIAS E EM TI', '2015-08-01', '2016-08-28', 40, NULL, '', 'Submetida', 24, 2, 101, 0, 0, NULL, 'ProjetoCeti.pdf', '101_651726.pdf', '2016-11-21'),
(102, 'Roadsec', '2016-04-02', '2016-04-02', 8, NULL, '', 'Submetida', 9, 2, 101, 0, 0, NULL, 'certificado_roadsecam_Duivilly_Brito.pdf', '101_104040.pdf', '2016-11-22'),
(103, 'Participação no projeto "Sistema de Gestão de Projetos de Extensão"', '2013-11-10', '2014-11-10', 480, 60, '', 'Indeferida', 40, 2, 105, 14, 0, NULL, 'New Doc 1.pdf', '105_879801.pdf', '2016-11-22'),
(104, 'Participação em PIBIC', '2011-08-01', '2012-07-31', 480, 60, '', 'Indeferida', 38, 2, 105, 14, 0, NULL, 'New Doc 2.pdf', '105_44662.pdf', '2016-11-22'),
(105, 'Participação em PIBIC', '2012-08-01', '2013-07-31', 480, 60, '', 'Indeferida', 38, 2, 105, 14, 0, NULL, 'New Doc 3.pdf', '105_230771.pdf', '2016-11-22'),
(106, 'Apresentação de artigo', '2012-11-19', '2012-11-22', 30, 30, '', 'Deferida', 34, 2, 105, 14, 0, NULL, 'New Doc 5.pdf', '105_307093.pdf', '2016-11-22'),
(107, 'Voluntário no WebMedia 2015', '2015-10-26', '2015-10-30', 30, NULL, '', 'Submetida', 6, 2, 87, 0, 0, '', '20111231_205744.jpg', '87_843444.jpg', '2016-11-24'),
(108, 'Monitoria', '2015-09-01', '2016-01-31', 30, NULL, '', 'Submetida', 25, 2, 87, 0, 0, NULL, '20161124_143050.jpg', '87_26549.jpg', '2016-11-24'),
(109, 'Curso de Adaptação do Calouro 2013', '2013-05-13', '2013-05-15', 10, NULL, '', 'Submetida', 10, 2, 87, 0, 0, NULL, 'CAC-2013-PRESENCA-MAT-BASICA.pdf', '87_921568.pdf', '2016-11-24'),
(110, 'Participação no WOPI 2014', '2014-10-21', '2014-10-22', 10, NULL, '', 'Submetida', 9, 2, 87, 0, 0, NULL, 'certificadoWOPI.pdf', '87_71125.pdf', '2016-11-24'),
(111, 'Participação no EPA! 2014', '2014-01-16', '2014-01-17', 10, NULL, '', 'Submetida', 9, 2, 87, 0, 0, NULL, 'certificadoEPA.pdf', '87_260065.pdf', '2016-11-24'),
(112, 'Participação na Seminfo 2013', '2013-06-12', '2013-06-14', 5, NULL, '', 'Submetida', 9, 2, 87, 0, 0, '', 'seminfo.jpg', '87_556074.jpg', '2016-11-24'),
(113, 'Participação em curso do WeRT 2015 ', '2015-10-26', '2015-10-30', 8, NULL, '', 'Submetida', 10, 2, 87, 0, 0, '', '20161124_150435.jpg', '87_477829.jpg', '2016-11-24'),
(114, 'Autor de artigo ', '2016-06-01', '2016-06-30', 30, NULL, 'Título do artigo: A Quantitative Analysis of Learning Objects and Their Metadata in Web Repositories', 'Submetida', 15, 2, 87, 0, 0, NULL, 'Social+Computing+in+Digital+Education.compressed.pdf', '87_532543.pdf', '2016-11-24'),
(115, 'II Maratona de Programação da UEA', '2016-07-01', '2016-07-02', 8, NULL, '', 'Aberto', 45, 2, 50, 0, 0, NULL, 'Scan 29.jpg', '50_970923.jpg', '2016-11-26'),
(116, 'Participação na Campus Party Recife 2015', '2015-07-23', '2015-07-26', 300, NULL, '', 'Aberto', 43, 2, 108, 0, 0, NULL, 'campus.pdf', '108_521325.pdf', '2016-11-28'),
(117, 'Participação na Palestra de Economia Criativa com Carlos Ruas', '2015-02-25', '2015-02-25', 2, NULL, '', 'Aberto', 43, 2, 108, 0, 0, NULL, 'Carlos Ruas.jpg', '108_321614.jpg', '2016-11-28'),
(118, 'Participação no Curso de Linux', '2014-05-14', '2014-05-16', 8, NULL, 'Curso do 1 Período com o professor Moisés', 'Aberto', 43, 2, 108, 0, 0, NULL, 'PresencasCC-EC_CursoLinux.pdf', '108_842090.pdf', '2016-11-28'),
(119, 'Participação no evento Techday 2.0', '2014-05-17', '2014-05-17', 6, NULL, '', 'Aberto', 43, 2, 108, 0, 0, NULL, 'techday2.pdf', '108_633899.pdf', '2016-11-28'),
(120, 'Participação no evento Techday 3.0', '2014-07-19', '2014-07-19', 4, NULL, '', 'Aberto', 43, 2, 108, 0, 0, NULL, 'techday3.pdf', '108_860198.pdf', '2016-11-28'),
(121, 'Participação no evento Wopi', '2014-10-21', '2014-10-22', 20, NULL, '', 'Aberto', 43, 2, 108, 0, 0, NULL, 'Wopi certo.pdf', '108_10951.pdf', '2016-11-28'),
(122, 'Participação na Conferência A Hora do Salto', '2016-11-14', '2016-11-14', 10, NULL, '', 'Aberto', 43, 2, 108, 0, 0, NULL, 'Carlos Vicente Soares Araujo.pdf', '108_155330.pdf', '2016-11-28'),
(123, 'Participação na OBI', '2014-06-09', '2014-06-09', 60, NULL, '', 'Aberto', 45, 2, 108, 0, 0, NULL, 'certificado.pdf', '108_512377.pdf', '2016-11-28'),
(124, 'Certificado de Participação', '2013-05-13', '2013-05-25', 30, NULL, '', 'Aberto', 9, 2, 110, 0, 0, NULL, 'certificado.pdf', '110_509159.pdf', '2016-11-29'),
(125, 'Cusso do Time Scrum', '2016-03-18', '2016-03-19', 16, NULL, '', 'Submetida', 9, 2, 53, 0, 0, NULL, 'Certificado - SCRUM 30.03 Kleyfferson.pdf', '53_792043.pdf', '2016-11-30'),
(128, 'minicurso AUTOMATIZAÇÃO DE TESTE DE SOFTWARE UTILIZANDO A FERRAMENTA SIKULIX', '2016-06-02', '2016-06-04', 6, NULL, '', 'Submetida', 9, 2, 53, 0, 0, NULL, 'CERTIFICADO_MINICURSO_KLEYFFERSON_LIMA_DA_SILVA__2016-1.pdf', '53_322775.pdf', '2016-11-30'),
(127, 'Encontro Regional de Computação e Sistema de Informação', '2016-06-02', '2016-06-04', 30, NULL, '', 'Submetida', 9, 2, 53, 0, 0, NULL, 'CERTIFICADO_GERAL_KLEYFFERSON_LIMA_DA_SILVA_2016.pdf', '53_218932.pdf', '2016-11-30'),
(129, 'MINICURSO COMO OS TIMES ÁGEIS CHEGAM AO MÍNIMO PRODUTO VIÁVEL (MVP) NA PRÁTICA - APRENDA A TÉCNICA D', '2016-06-02', '2016-06-04', 8, NULL, '', 'Submetida', 9, 2, 53, 0, 0, NULL, 'CERTIFICADO_MINICURSO_KLEYFFERSON_LIMA_DA_SILVA__2016-2.pdf', '53_667838.pdf', '2016-11-30'),
(130, 'PIAP - Algoritmos e Estrutura de Dados', '2013-07-01', '2014-06-30', 60, 60, '', 'Deferida', 29, 2, 65, 14, 0, NULL, 'PIAP.jpg', '65_447203.jpg', '2016-12-10'),
(131, 'PIBIC', '2012-07-01', '2013-06-30', 60, 60, '', 'Deferida', 38, 2, 65, 14, 0, NULL, 'PIBIC.jpg', '65_962807.jpg', '2016-12-10'),
(132, 'Menção Honrosa - PIBIC', '2016-12-09', '2016-12-09', 10, 10, '', 'Deferida', 37, 2, 65, 14, 0, NULL, 'PIBIC - Menc?a?o.jpg', '65_36111.jpg', '2016-12-10'),
(133, 'Coorientador de Projeto - FEBRACE', '2012-01-01', '2012-03-17', 60, 60, '', 'Indeferida', 32, 2, 65, 14, 0, NULL, 'FEBRACE - Coorientador.jpg', '65_856647.jpg', '2016-12-10'),
(134, 'Premiação - EPA - Hackathon', '2014-01-17', '2014-01-17', 10, 10, '', 'Deferida', 37, 2, 65, 14, 0, NULL, 'EPA.jpg', '65_220701.jpg', '2016-12-10'),
(135, 'EARTH - Escola de Robótica - UFAM', '2016-01-25', '2016-01-29', 20, 20, '', 'Deferida', 43, 2, 65, 14, 0, NULL, 'EARTH - Aluno.jpg', '65_751602.jpg', '2016-12-10'),
(136, 'EARTH (Assistente) - Escola de robótica - UFAM', '2016-01-25', '2016-01-29', 30, 30, '', 'Deferida', 44, 2, 65, 14, 0, NULL, 'EARTH - Assistente.jpg', '65_970559.jpg', '2016-12-10'),
(137, 'Desafio Sebrae - Empreendedorismo', '2013-01-01', '2013-07-01', 32, 0, '', 'Deferida', 31, 2, 65, 14, 0, NULL, 'DESAFIO SEBRAE.jpg', '65_857462.jpg', '2016-12-10'),
(138, 'Intensive English Program - Drexel University', '2014-04-01', '2014-06-11', 60, 0, '', 'Deferida', 33, 2, 65, 14, 0, NULL, 'Drexel English - Proficiency.jpg', '65_35140.jpg', '2016-12-10'),
(139, 'Treinamento de GIT (PRODAM S/A)', '2016-07-04', '2016-12-08', 10, NULL, '', 'Aberto', 10, 2, 112, 0, 0, '', 'treinamentoGit.pdf', '112_900191.pdf', '2016-12-12'),
(140, 'InnovationDay - FabriQ', '2016-07-22', '2016-07-22', 4, NULL, '', 'Aberto', 9, 2, 112, 0, 0, '', 'CertificadoInovationDay.pdf', '112_111401.pdf', '2016-12-12'),
(141, 'Artigo - A quantitative analysis of Learning Objects and their Metadata in Web Repositories', '2015-01-20', '2015-08-18', 30, NULL, '', 'Aberto', 15, 2, 112, 0, 0, NULL, 'SocialEdu2015_paper_3.pdf', '112_709638.pdf', '2016-12-12'),
(142, 'IV WoPI', '2014-10-21', '2014-10-22', 10, NULL, '', 'Aberto', 9, 2, 112, 0, 0, NULL, 'certificado.pdf', '112_321297.pdf', '2016-12-12'),
(143, 'Curso de Adaptação do Calouro ', '2013-05-13', '2013-05-25', 30, NULL, 'Curso de Adaptação do Calouro  - Período 0 2013', 'Aberto', 26, 2, 112, 0, 0, '', 'certificado(1).pdf', '112_764750.pdf', '2016-12-12'),
(144, 'Curso de Adaptação do Calouro ', '2013-05-13', '2013-05-23', 10, NULL, 'Excedente sobre o Curso de Adaptação do Calouro ', 'Aberto', 28, 2, 112, 0, 0, NULL, 'certificado(1).pdf', '112_915309.pdf', '2016-12-12'),
(145, 'XX Congreso Internacional de Informática Educativa', '2015-12-01', '2015-12-03', 10, NULL, '', 'Pre-Aprovada', 9, 2, 16, 10, 0, NULL, '1.jpg', '16_599041.jpg', '2016-12-13'),
(146, 'Participação como discente voluntário - Cadastro de Horas', '2016-07-04', '2016-09-02', 180, NULL, '', 'Aberto', 26, 2, 117, 0, 0, NULL, 'Discentes Voluntários Francisco.pdf', '117_434915.pdf', '2016-12-13'),
(147, 'Cadastro de Hortas - Estágio extracurricular', '2015-02-08', '2016-02-08', 960, NULL, 'Estágio extracurricular de nível Superior realizado no INPA, sob matrícula 2191671', 'Aberto', 5, 2, 117, 0, 0, NULL, 'Novo Documento 7_1.pdf', '117_128872.pdf', '2016-12-13'),
(148, 'Curso de adaptação do calouro', '2013-05-13', '2013-05-25', 30, 30, '', 'Deferida', 31, 2, 32, 14, 0, NULL, 'certificado_curso_calouro_Roberta.pdf', '32_962038.pdf', '2016-12-14'),
(149, 'Defesa de TCC', '2015-03-16', '2015-03-16', 1, NULL, '', 'Aberto', 46, 2, 72, 0, 0, NULL, 'certificadoWorkShopTCC.pdf', '72_3036.pdf', '2016-12-15'),
(150, 'Participação em Projetos de Pesquisa', '2015-05-27', '2015-05-27', 5, NULL, '', 'Aberto', 38, 2, 72, 0, 0, NULL, 'certificadoProjetoDoGalvão.pdf', '72_935148.pdf', '2016-12-15'),
(151, 'Participação no EPA!', '2014-01-16', '2014-01-17', 20, NULL, '', 'Aberto', 43, 2, 72, 0, 0, NULL, 'EPA 2014.pdf', '72_825002.pdf', '2016-12-15'),
(152, 'Participação no EPA! 2015', '2015-04-29', '2015-04-30', 20, NULL, '', 'Aberto', 43, 2, 72, 0, 0, NULL, 'EPA 2015.pdf', '72_339492.pdf', '2016-12-15'),
(153, 'Organização da SEMINFO 2013', '2013-06-12', '2013-06-14', 40, NULL, '', 'Aberto', 44, 2, 72, 0, 0, NULL, 'SEMINFO.pdf', '72_542755.pdf', '2016-12-15'),
(154, 'discente voluntário em projeto na PROEXT', '2016-07-04', '2016-09-02', 180, NULL, '', 'Submetida', 26, 2, 109, 0, 0, NULL, 'Discentes Voluntários Neto.pdf', '109_645999.pdf', '2016-12-19'),
(155, 'Participação do curso de Times SCRUM', '2016-03-18', '2016-03-19', 16, NULL, '', 'Submetida', 10, 2, 109, 0, 0, NULL, 'Certificado - SCRUM 30.03 Aglair Neto_16.pdf', '109_895257.pdf', '2016-12-19'),
(156, 'workshop de integração entre Academia e Indústria com ênfase em Qualidade de Software', '2016-07-19', '2016-07-19', 4, NULL, '', 'Submetida', 7, 2, 109, 0, 0, NULL, 'CERTIFICADOaglair4horas.pdf', '109_480645.pdf', '2016-12-19'),
(157, 'Palestra E-commerce Criativo', '2016-07-13', '2016-07-13', 2, NULL, '', 'Submetida', 9, 2, 109, 0, 0, NULL, 'AGLAIR PEREIRA BARRONCAS NETO_2horas.pdf', '109_896771.pdf', '2016-12-19'),
(158, 'experimento “Reconhecimento de Engajamento em sessões de vídeos”', '2016-07-21', '2016-07-21', 3, NULL, '', 'Submetida', 9, 2, 109, 0, 0, NULL, '3horasCERTIFICADOAglair Pereira Barroncas Neto.pdf', '109_622191.pdf', '2016-12-19'),
(159, 'Participação em Seminário', '2016-04-30', '2016-04-30', 2, NULL, '', 'Submetida', 9, 2, 109, 0, 0, NULL, '2horasNIB.jpg', '109_995985.jpg', '2016-12-19'),
(160, 'Curso Manutenção de Computadores', '2012-02-12', '2012-02-17', 10, NULL, '', 'Submetida', 10, 2, 109, 0, 0, NULL, '10horasINPAComp.jpg', '109_103067.jpg', '2016-12-19'),
(161, 'Participação na oficina "Desenvolvimento de projetos avançados com arduino"', '2016-01-25', '2016-01-29', 20, 20, '', 'Indeferida', 31, 2, 57, 14, 0, '', NULL, NULL, '2016-12-19'),
(162, 'Monitoria Linguagem de Programação Avançada', '2016-05-02', '2016-09-02', 192, NULL, '', 'Aberto', 29, 2, 56, 0, 0, NULL, 'monitoriaLPAV.pdf', '56_628396.pdf', '2016-12-23'),
(163, 'Experimento “Reconhecimento de Engajamento em sessões de vídeos”', '2016-06-19', '2016-06-19', 3, NULL, '', 'Submetida', 10, 2, 104, 0, 0, NULL, 'Gisele Cristina Máximo Nunes.pdf', '104_572741.pdf', '2016-12-28'),
(164, 'II EncontroNortePet', '2015-06-24', '2015-06-25', 20, NULL, '', 'Submetida', 6, 2, 104, 0, 0, NULL, 'GISELE CRISTINA MÁXIMO NUNES.pdf', '104_128488.pdf', '2016-12-28'),
(165, 'Workshop de integração entre Academia e Indústria com ênfase em Qualidade de Software.', '2016-07-19', '2016-07-19', 4, NULL, '', 'Submetida', 9, 2, 104, 0, 0, NULL, 'gisele.pdf', '104_194018.pdf', '2016-12-28'),
(166, 'II Encontro de Projetos em Ambientes Interativos', '2015-04-29', '2015-04-30', 16, NULL, '', 'Submetida', 6, 2, 104, 0, 0, NULL, 'certificado.pdf', '104_749171.pdf', '2016-12-28'),
(167, 'Workshop de integração entre Academia e Indústria com ênfase em Qualidade de Software', '2016-07-19', '2016-07-19', 4, NULL, '', 'Submetida', 9, 2, 101, 0, 0, NULL, 'Interactive.pdf', '101_670022.pdf', '2017-01-02'),
(168, 'OCEAN Capacitação para Desenvolvimento de Aplicações Móveis: Turma Fechada de Jogos Digitais', '2015-07-03', '2015-12-16', 200, NULL, 'Conferida pela Universidade do Estado do Amazonas em parceria com a Samsung Ocean Center', 'Aberto', 31, 2, 43, 0, 0, NULL, 'Ocean.pdf', '43_123272.pdf', '2017-01-05'),
(169, 'Divus Curso Academia do Programador', '2014-08-18', '2014-10-22', 80, NULL, 'Certificado por Divus Tecnologia - Treinamento e Desenvolvimento de Software', 'Aberto', 31, 2, 43, 0, 0, NULL, 'DivusAcademiaProgramador.pdf', '43_654162.pdf', '2017-01-05'),
(173, 'Participação como apresentadora na I Feira  de Aplicativos PROMOBILE', '2015-02-20', '2015-02-20', 4, NULL, '', 'Aberto', 69, 2, 120, 0, 0, NULL, 'certificado_promobile04h.pdf', '120_444357.pdf', '2017-01-07'),
(174, 'Certificado de que tive trabalho apresentado 13 SBSC - Simpósio Brasileiro de Sistemas Colaborativos', '2016-07-04', '2016-07-04', 10, NULL, 'No certificado não há indicação de horas. Embora não fique claro, quem apresentou o trabalho fui eu.', 'Aberto', 68, 2, 120, 0, 0, NULL, 'certificado_trablho_csbc.pdf', '120_401109.pdf', '2017-01-07'),
(175, 'Palestrante do MINICURSO DE INTRODUÇÃO AO  WEB FRAMEWORK DJANGO', '2016-04-11', '2016-04-11', 8, NULL, '', 'Aberto', 69, 2, 120, 0, 0, NULL, 'certificado8h.pdf', '120_860897.pdf', '2017-01-07'),
(176, 'Participação do II Encontro de Projetos em Ambientes  Interativos', '2015-04-29', '2015-04-30', 16, NULL, '', 'Aberto', 59, 2, 120, 0, 0, NULL, 'certificadoEPA_2015_16h.pdf', '120_174160.pdf', '2017-01-07'),
(177, 'Participação no III Workshop  de Pesquisa em Informática (III WoPI 2013),', '2013-09-12', '2013-09-13', 14, NULL, '', 'Aberto', 59, 2, 120, 0, 0, NULL, 'certificadosWOPI-14h.pdf', '120_324907.pdf', '2017-01-07'),
(178, 'Participação em Palestra Formação de Cientistas', '2016-06-09', '2016-06-09', 4, NULL, '', 'Aberto', 59, 2, 120, 0, 0, NULL, 'gilson_palestra_4h.pdf', '120_267396.pdf', '2017-01-07'),
(179, 'Participação no Testes de Usabilidade em Plataformas Móveis', '2015-10-13', '2015-10-15', 4, NULL, '', 'Aberto', 59, 2, 120, 0, 0, NULL, 'teste_usabilidade_ingrid04horas.pdf', '120_291164.pdf', '2017-01-07'),
(180, 'Participação no experimento "Reconhecimento de Engajamento em sessões de vídeos"', '2016-06-23', '2016-06-23', 3, NULL, '', 'Aberto', 59, 2, 120, 0, 0, NULL, 'health_3h.pdf', '120_757952.pdf', '2017-01-09'),
(181, 'Participação em Artigo Completo no SBSC 2016', '2016-07-04', '2016-07-07', 20, NULL, '', 'Aberto', 62, 2, 120, 0, 0, NULL, 'csm-artigo.pdf', '120_105373.pdf', '2017-01-09'),
(182, 'Primeira a autora de artigo curto no WEBMEDIA 2016', '2016-11-08', '2016-11-11', 15, NULL, 'As datas são refentes aos dias do evento (não sabia o que colocar)', 'Aberto', 64, 2, 120, 0, 0, NULL, 'sentiment-analysis-portuguese.pdf', '120_978369.pdf', '2017-01-09'),
(183, 'Participação como coautora em artigo curto no WEBMEDIA 2016', '2016-11-08', '2016-11-11', 15, NULL, '', 'Aberto', 64, 2, 120, 0, 0, NULL, 'p335-souza.pdf', '120_167857.pdf', '2017-01-09'),
(184, 'PIBIC 2015/2016', '2015-08-01', '2016-07-31', 40, NULL, '', 'Aberto', 72, 2, 120, 0, 0, NULL, 'declaracao_pibic.pdf', '120_999373.pdf', '2017-01-09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_dynagrid`
--

CREATE TABLE `tbl_dynagrid` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid setting identifier',
  `filter_id` varchar(100) DEFAULT NULL COMMENT 'Filter setting identifier',
  `sort_id` varchar(100) DEFAULT NULL COMMENT 'Sort setting identifier',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid configuration'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dynagrid personalization configuration settings';

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_dynagrid_dtl`
--

CREATE TABLE `tbl_dynagrid_dtl` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid detail setting identifier',
  `category` varchar(10) NOT NULL COMMENT 'Dynagrid detail setting category "filter" or "sort"',
  `name` varchar(150) NOT NULL COMMENT 'Name to identify the dynagrid detail setting',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid detail configuration',
  `dynagrid_id` varchar(100) NOT NULL COMMENT 'Related dynagrid identifier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dynagrid detail configuration settings';

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
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
  `rg` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `cpf`, `email`, `password`, `matricula`, `siape`, `perfil`, `dtEntrada`, `isAdmin`, `isAtivo`, `auth_key`, `password_reset_token`, `curso_id`, `telefone`, `endereco`, `rg`) VALUES
(1, 'Admin Master', '999.999.999-99', 'ariloclaudio@gmail.com', 'b706835de79a2b4e80506f582af3676a', '', '', 'admin', '0000-00-00', 1, 1, NULL, 's8UQ3CbjFPTzlkXQqRJp', NULL, '', '', ''),
(2, 'Leonardo', '013.328.842-02', 'leonardo.almeida18@gmail.com', '4417ee9b580735c1a2a52b87691b2b8d', '21206254', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(41, 'Arilo', '704.574.332-72', 'arilo@icomp.ufam.edu.br', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 3, '', '', ''),
(14, 'Coordenador CC', '768.420.702-44', 'coord-cc@icomp.ufam.edu.br', '7341c60663027589e4e532d615f33e58', '345678', NULL, 'Coordenador', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(10, 'mary', '344.165.602-49', 'maryjani2010@gmail.com', '60301055f341a0d844c2cb181e2a6b87', '34567', NULL, 'Secretaria', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(12, 'Gabriel Gama', '00864294263', 'gabrielgamagga@gmail.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '21455604', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(13, 'Coordenador SI', '624.366.862-20', 'coord-si@icomp.ufam.edu.br', '4c1b4ae2630bf1646ca407355aaf73a8', '09876', NULL, 'Coordenador', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(16, 'LARISSA LORENA EVANGELISTA DAS NEVES', '016.185.902-00', 'llen@icomp.ufam.edu.br', '4297f44b13955235245b2497399d7a93', '21550339', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(15, 'Leandro Silva Galvão de Carvalho', '777.584.125-72', 'galvao@icomp.ufam.edu.br', '55b8573db216be77574fc4db6087a69f', '1552402', NULL, 'Coordenador', NULL, 0, 1, NULL, NULL, 3, '', '', ''),
(17, 'INGRID DO NASCIMENTO MENDES', '021.457.962-07', 'ingrid.mendes.si@gmail.com', '23d79586c76a7cec4e412c41674b1074', '21353720', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(20, 'LEONARDO SALES ALMEIDA', '013.328.842-02', 'LEO-S.A@HOTMAIL.COM', '4417ee9b580735c1a2a52b87691b2b8d', '21206254', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(19, 'Denilson de Albuquerque Carvalho', '742.478.242-87', 'zottozbr@gmail.com', 'a1f8f46cd8d8bba9a13e40f0312b62a7', '21203723', NULL, 'Aluno', NULL, 0, 1, NULL, 'huWTZgBt1O4nJi30a02x', 1, '', '', ''),
(21, 'ANDERSON ARAUJO DA CRUZ', '016.115.892-74', 'aac@icomp.ufam.edu.br', 'df9dcb9d747307af4e4a0068b8e7b329', '21353717', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(42, 'Jackson Leite Pereira', '013.221.882-89', 'jlp@icomp.ufam.edu.br', '0ec0973f8b44f5ef248e6ffd4a68d7ff', '21100242', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(23, 'IVAN JOSE NASCIMENTO DA SILVA JUNIOR', '940.927.532-68', 'ijnsj@icomp.ufam.edu.br', '995f72c344cc9f4bef27b493ed833c54', '20902098', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(24, 'GUILHERME DE BRITO CARNEIRO', '010.651.882-85', 'GUILHERMEB.CARNEIRO@GMAIL.COM', 'bf93aac5e4d6345f7b4bfda75f8a3f45', '21102572', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(25, 'CRISTHIAN GIOVANNI LOPES DE OLIVEIRA', '013.083.262-62', 'criisthian.oliveira@gmail.com', '8a95556f0d9218bdd35465006672a3e1', '21550200', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(43, 'Lukas Eiky Kurata Takatani', '944.776.122-49', 'lekt@icomp.ufam.edu.br', '1df40c50e746d371ce4cf5a93c989265', '21204522', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(26, 'Ana Carolina Melik Schramm', '027.138.222-89', 'acms@icomp.ufam.edu.br', '8fbda321e058942f347aaef9f3fdd6a7', '21456055', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(27, 'ADIEL WESLEY BEZERRA DA SILVA', '025.566.552-08', 'awbs@icomp.ufam.edu.br', '9fcda186b43fcee6219304b6d18a4035', '21456803', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, NULL, '', '', ''),
(28, 'Micael Levi Lima Cavalcante', '032.507.002-40', 'mllc@icomp.ufam.edu.br', '6e1a9e2ddfd99b7a108a926715d32615', '21554923', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(29, 'Victoria Patricia Silva Aires', '022.883.132-69', 'vpsa@icomp.ufam.edu.br', '9fd98dd93d57cb6219a0daffd309abc0', '21453369', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(30, 'Wesley Monteiro Carneiro', '012.994.642-70', 'wesleymc15@live.com', '3ca72ca7f16c19761833c59de9a539df', '21206090', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(31, 'Erick Alexandre', '005.352.122-67', 'eabc@icomp.ufam.edu.br', '7bb73b301d6af19ff75f0cf2c7edd5f0', '21100128', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(32, 'ROBERTA KATHLEEN BASTOS DOS ANJOS', '017.675.942-59', 'r_kathleen@hotmail.com', 'cda241199a6c768286f9c645d9e9c124', '21353619', NULL, 'Aluno', NULL, 0, 1, NULL, 'zGPHq0yRv26WnvrzgZuw', 2, '', '', ''),
(33, 'EDWIN JUAN LOPES BARBOZA MONTEIRO', '011.276.932-20', 'ejlbm@icomp.ufam.edu.br', 'ad6c2fd57e41302eade78230d910bdbc', '21453380', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(34, 'THIAGO MORAES ROCHA', '026.986.652-38', 'tmr@icomp.ufam.edu.br', 'a62277fc6daebe9b55a970918a8f2883', '21452625', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(35, 'VICTOR MEIRELES ROQUE', '021.927.442-85', 'vmr1@icomp.ufam.edu.br', '21468edf18a267b20bd869dc6afaf6cf', '21555174', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(36, 'LEANDRO YOUITI SILVA OKIMOTO', '012.093.072-27', 'leandrookimoto@gmail.com', '606e26585311b00c1378d67c25615ca7', '21351545', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(37, 'VICTOR DE ALMEIDA VALENTE', '015.665.162-93', 'victorvalentee@gmail.com', '59eb95c1fc4e3f00268e828a45d2b7d9', '21002593', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(39, 'Tanara Lauschner', '475.623.152-72', 'tanara@icomp.ufam.edu.br', 'e0dc81f214ae0fc6c17ba23760165b5d', '053053792', NULL, 'Coordenador', '2016-10-26', 0, 1, NULL, NULL, 2, '', '', ''),
(44, 'Jhonny Barbosa da Silva', '008.200.962-70', 'jbs@icomp.ufam.edu.br', '658648b7f25188786f31b313ef445002', '21206142', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(45, 'Van Den Berg da Gama Ferreira', '029.826.992-90', 'vdbdgf@icomp.ufam.edu.br', 'd593502347df56ee39daf55092eaa459', '21553986', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(46, 'Taynah Marcele Almeida dos Santos', '913.579.422-49', 'tmas@icomp.ufam.edu.br', '1fa64d48bfc2e45aecbc78c1a735b6cc', '21353607', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(47, 'rozildo pereira da silva', '001.401.142-54', 'rozildo.rps@gmail.com', '2fd0dcb42913bccfc9f4800f7bfb1d6f', '21602749', NULL, 'Aluno', NULL, 0, 1, NULL, 'zh9Z8BhElcD6LO2E0Cr5', 1, '', '', ''),
(48, 'Luiz Gustavo Pinto de Arruda', '007.328.202-27', 'lgpa@icomp.ufam.edu.br', '7b54d81f2f1c18a0bcbf744cea2a3131', '21351818', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(49, 'Bruno Quaresma Athaíde', '012.004.182-04', 'bqa@icomp.ufam.edu.br', 'fc933bc714db2db55bba108f4759f803', '21201968', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(50, 'Marcos Paulo Siqueira de Farias', '012.716.062-08', 'mpsf@icomp.ufam.edu.br', '0262f0900103210ee1615806934f4f1b', '21203352', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(51, 'MATHEUS DO CARMO DE OLIVEIRA', '026.984.282-95', 'matheus.oliveira05@gmail.com', 'fc04024fca5a97ba0a9d0aa7474c5caa', '21453672', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 3, '', '', ''),
(52, 'Felipe Sonntag Manzoni', '009.991.182-50', 'fsm2@icomp.ufam.edu.br', '9408bfe24cfdf8f322b55f15545d2c33', '21457273', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(53, 'Kleyfferson Lima Da Silva ', '023.082.792-65', 'kls@icomp.ufam.edu.br', 'd5e620aaa90b9d09a135a861676336c2', '21454751', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(54, 'Ruan Gabriel Gato Barros', '011.119.382-61', 'rggb@icomp.ufam.edu.br', '540533d1bc775d6e32ee63b925f53f4b', '21553690', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(55, 'Gilvan Oliveira dos Reis', '022.247.182-41', 'gilvano.dosreis@hotmail.com', '498f735069244b36715489b147c21369', '21453377', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(56, 'Jonathas Borges Cavalcante', '026.544.722-48', 'jbc@icomp.ufam.edu.br', 'eb8f161d3e79a351bbd3493af21c2845', '21353622', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(57, 'Thais Gabriele Cardoso do Nascimento', '023.618.792-98', 'tgcn@icomp.ufam.edu.br', '2b46fe48285972820e29500c27e45453', '21553696', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(58, 'Joseph Viana Levinthal de Oliveira', '766.820.722-87', 'jvlo@icomp.ufam.edu.br', 'a949772ca79f01020356307ec699ba57', '21553691', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(59, 'Brandell Cassio', '023.827.442-00', 'bccf@icomp.ufam.edu.br', 'd8433e057c9393e24558a339345139c6', '21453372', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(60, 'Felipe Guerra Monteiro', '022.072.452-09', 'fgm@icomp.ufam.edu.br', '0f2c3269cddcb305454387eebdc35ef0', '21453378', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(61, 'Rogenis Pereira da silva', '034.663.972-78', 'rps@icomp.ufam.edu.br', '65cb5a23260c08eb4e093f9262afe09e', '21650332', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(62, 'João Paulo Fontenele Brito', '002.232.992-78', 'jpfb@icomp.ufam.edu.br', 'f49fb092762ef6bc354d3a0744f2218d', '21456059', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(63, 'Isabelly Rohana Barbosa de Oliveira', '024.442.762-30', 'irbo@icomp.ufam.edu.br', 'f609865764ed703c8313e752c33fb4f2', '21352282', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(64, 'Cícero Higor Gomes de Sousa', '020.102.452-70', 'chgs@icomp.ufam.edu.br', 'd03799267297e453ef3aa26a13c04220', '21550190', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(65, 'Juscelino Tanaka Saraiva', '921.383.902-25', 'juscelino.tanaka@gmail.com', '0292e031195ca50fed149b421c7df329', '21100193', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(66, 'Lucas Vinícius da Silva Reis', '938.719.612-72', 'lvsr@icomp.ufam.edu.br', 'a5ef610e32e9a884851afb53d5c7fc4a', '21601062', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(67, 'Jean Carlos Araujo de Figueiredo', '518.164.902-53', 'jcf@icomp.ufam.edu.br', 'c3153c744dc53928e4fda269acb87d2f', '20800023', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(68, 'YAGO LOPES MARTINS', '016.141.452-45', 'ylm@icomp.ufam.edu.br', '19819750463fc47813830de3d364353c', '21550194', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(69, 'Raphael Carlos Pedroso de Souza', '003.173.292-51', 'raphael.carlos.souza@gmail.com', 'e692e7768caad9b86df10b3c72ae4c1f', '21551987', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(70, 'Bruno Pinheiro', '021.721.382-07', 'bsp@icomp.ufam.edu.br', '87f42baa143decf9ac6f0c43f2006fe2', '21650919', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(71, 'Renato Lousan da Silva', '026.515.942-37', 'rls@icomp.ufam.edu.br', '670e691082e275f6bd58863b649608d1', '21553693', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(72, 'Leonardo Carneiro Marques', '016.516.192-20', 'lcm@icomp.ufam.edu.br', '6e6203663d1ea766a87710e8b79ee1e8', '21100161', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(73, 'Tyller Jor\'El', '017.630.512-26', 'tylee.fne@gmail.com', '7657e4d6f3916601fe8afe1eba0054fd', '21204697', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 3, '', '', ''),
(74, 'Ives Matheus Pereira de Souza Alves', '017.776.592-56', 'impsa@icomp.ufam.edu.br', '2645703ee8d01fbfb57239d9f67c7a6d', '21353615', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(75, 'Thiago Lopes Costa', '002.586.212-06', 'tlc2@icomp.ufam.edu.br', 'bfd85564b0daca6eb6af912d1693d388', '21601238', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(76, 'Timóteo Fonseca Santos', '002.566.542-12', 'tfs@icomp.ufam.edu.br', 'a0f0e4f8276a4e332ecb705d2771c9cc', '21553687', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(77, 'Felipe Matheus Colares de Melo', '021.571.652-31', 'fmcm@icomp.ufam.edu.br', 'b694f2fa670029b2e496f88bd6835b16', '21454962', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(78, 'Nadny Dantas', '018.123.142-56', 'nmd@icomp.ufam.edu.br', '7166f235a48b57c63fc95cad994aa5b5', '21453371', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(79, 'Gabriel Graça Saldanha', '021.620.552-28', 'ggs@icomp.ufam.edu.br', '8aa5077bed42925158af0dc3afbe1ddb', '21355148', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(80, 'Carlos William Torres Machado', '700.707.392-18', 'cwtm@icomp.ufam.edu.br', '4e0138007b344fc8872f7dfc10315b16', '21601236', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(81, 'Thomaz Gustavo de Andrade Vieira', '021.261.692-78', 'thomaz.andradee@gmail.com', '98615ab8d4a342211ea5b1ed028d2c10', '21457269', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(82, 'Paulo Rodrigo Oliveira Martins', '009.393.862-40', 'prom@icomp.ufam.edu.br', 'e0001ddcc3dd212108ad13f5904677a4', '21453373', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(83, 'Ágatha Karolling Caldas de Almeida', '806.790.722-68', 'akca@icomp.ufam.edu.br', 'a87cf5adc6c267644474f87d7cb077df', '21651583', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(84, 'Emidio', '032.482.692-35', 'emidioaranha@hotmail.com', 'd8612705a77a173da4ce15fd7304beae', '21602639', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(85, 'João Gabriel Costa Gomes', '164.658.967-02', 'jgcg@icomp.ufam.edu.br', 'a229e8fdaca2a03662e53b06da119d23', '21602640', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(86, 'Katiely dos Santos Oliveira Moreira', '033.669.352-43', 'ksom@icomp.ufam.edu.br', 'e7d80ffeefa212b7c5c55700e4f7193e', '21600808', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(87, 'Helvio Lopes de Oliveira Neto', '020.144.062-86', 'hlon@icomp.ufam.edu.br', 'abdeb9ccdf1060da7f90e4b84ebad440', '21351438', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(88, 'Mikael Souza Silva', '016.569.392-40', 'mss2@icomp.ufam.edu.br', 'c799fdc8bc9073542ab105e45d9218bf', '21352279', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(89, 'Waldomiro Juan Gadelha Seabra', '023.074.062-63', 'wjgs@icomp.ufam.edu.br', '8b791cc7b9ec4111dbcdd7802cceb08b', '21456062', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(90, 'Davisom da Cunha Correa', '011.243.722-29', 'dcc2@icomp.ufam.edu.br', '73fe23cdbee0a59ce474eac01470c93c', '21101682', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(91, 'Luis Guilherme Magalhães Queiroz', '527.154.692-68', 'lgqueiroz3@gmail.com', 'e803adae1f5acc155699ad43e9b77629', '21002805', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(92, 'Uriel Guimarães Bicharra', '014.486.012-07', 'ugb@icomp.ufam.edu.br', '8e80fb61fb5a4ebc0c31da7ab87a0bda', '21353616', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(93, 'Giovanni Crisostomo Fiori', '026.721.432-42', 'gcf@icomp.ufam.edu.br', '30179a6676560b52a068216dda0d1a43', '21551623', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(94, 'Thalita Naiara Andre Alves', '015.511.192-26', 'tnaa@icomp.ufam.edu.br', 'c5e43ee038048f4e585066bedf583d13', '21352533', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(95, 'Edecio Matias Neto', '787.466.802-25', 'ematiasnt@gmail.com', 'd98bc9163ed16ec31bb7d558e97987b2', '21352532', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(96, 'Marcia Belchior Garcia', '003.230.952-08', 'mbelchior9@gmail.com', '6ba8ac9b87459c932108d237635a7581', '21101480', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(97, 'José Alberto Pacífico da Silva Filho', '014.921.482-02', 'alberto14.filho@gmail.com', '5b8fab1fc6d198412e041adfd57df9ca', '21101451', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(98, 'Felipe Correa Vilhena', '147.404.287-25', 'fcv@icomp.ufam.edu.br', '7bb49eecce79a190494fed8f42acb928', '21553894', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(99, 'Vinítius Salomão Pereira Júnior', '013.541.352-45', 'vspj@icomp.ufam.edu.br', 'b432076189b50d8e099ed3311da0849a', '21002919', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(100, 'Clawbert Pereira de Sá Barbosa', '015.340.232-67', 'cpsb@icomp.ufam.edu.br', '182d16d2bd41b46ddc70b62e0ba8fec7', '21101362', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(101, 'Duivilly Brito', '021.661.262-43', 'db@icomp.ufam.edu.br', '29c9da8504a9bc6c765eba53630325c2', '21454749', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(102, 'Arthur Veloso Gouveia de Melo', '981.159.792-87', 'avgm@icomp.ufam.edu.br', '8b49740f4c4802dd644db3c39a0621d0', '21550189', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(103, 'Aderlan Pinheiro de Melo', '233.958.002-10', 'apm@icomp.ufam.edu.br', '67a3d5d09d20d2c2f120414d0975a3e2', '21200137', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(104, 'Gisele Cristina Máximo Nunes', '021.156.752-31', 'gcmn@icomp.ufam.edu.br', '4ddaba599a4004ba573d508b06188ff3', '21453614', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(105, 'Diego Santos Azulay', '530.457.262-91', 'dsa@icomp.ufam.edu.br', '4f300f09bf2485bb48eb3cbc7c649610', '21106950', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(106, 'Daniel Godinho Pinto', '777.517.012-34', 'dgp@icomp.ufam.edu.br', '99d0d8abf7dbe98a4b4c27aa1c8b8d3b', '21205303', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(107, 'Marcos Soares Souza', '026.232.482-22', 'mss3@icomp.ufam.edu.br', '4a4e1423699daa27861140f38a9938fc', '21453612', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(108, 'Carlos Vicente Soares Araujo', '857.866.912-68', 'cvsa@icomp.ufam.edu.br', 'e56f840794ac1d0f8fa6efff47679f5c', '21453374', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(109, 'Aglair Pereira Barroncas Neto', '813.549.592-72', 'apbn@icomp.ufam.edu.br', '4bb35422980f14125f75788d6f0665d9', '21354856', NULL, 'Aluno', NULL, 0, 1, NULL, 'oxrBPxFtBvkHrTSLqQGN', 1, '', '', ''),
(110, 'Nikolas Rocha de Medeiros', '003.589.152-10', 'nrm@icomp.ufam.edu.br', '61281ebd36314c45cce41666b55ca54a', '21352599', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(111, 'Gustavo Noronha Matos', '025.324.142-19', 'gnm@icomp.ufam.edu.br', '8843629326cf58d3fb1ae7cdbd2c3b67', '21555193', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(112, 'Roberto Cavalcanti Campos Neto', '016.649.112-86', 'rccn@icomp.ufam.edu.br', 'a077decf1fa95ed7c2d9391ff57ce2d9', '21351820', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(113, 'Fabrício José da Silva Lima', '013.186.002-00', 'fabriciolima31@gmail.com', '56fb3005b866a4beb8104bd70053e6d9', '21101396', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(114, 'Rodrigo Soares Gouveia', '021.556.522-32', 'rsg@icomp.ufam.edu.br', 'a91bc049ec2c7519553cde697df0c841', '02155652232', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(115, 'Samantha Correa Leite', '021.342.622-65', 'scl@icomp.ufam.edu.br', 'dfbe9b84722f27c60aade2595f9f66da', '21550334', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(116, 'Ivo Machado de Souza', '026.142.462-98', 'ims@icomp.ufam.edu.br', '9473ef28a45b0175b6c152bb02687c4e', '21553684', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 2, '', '', ''),
(117, 'Francisco Ponciano Maciel Neto', '013.590.592-37', 'fpmn@icomp.ufam.edu.br', 'e40c31ad0caeafe88b4af8b0ba65077e', '21354731', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 1, '', '', ''),
(118, 'Tiago de Paula Custódio', '339.837.968-00', 'tpc@icomp.ufam.edu.br', 'a0b6f2053d905595597348a38ec7e341', '21201978', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 3, '', '', ''),
(119, 'Jo de Oliveira Vidal', '739.041.472-34', 'jov@icomp.ufam.edu.br', '7b17d33d14735732e5b22083cbec52e5', '21201962', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 3, '', '', ''),
(120, 'Thais Gomesde Almeida', '011.524.702-56', 'tga@icomp.ufam.edu.br', '899ba9c78587d7da3dfdfb0e779b28d9', '21353606', NULL, 'Aluno', NULL, 0, 1, NULL, NULL, 3, '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_curso`
--

CREATE TABLE `usuario_curso` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuario_curso`
--

INSERT INTO `usuario_curso` (`id`, `usuario`, `curso`) VALUES
(101, 27, 2);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_aluno_monitoria`
--
CREATE TABLE `view_aluno_monitoria` (
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
,`periodo` varchar(10)
,`IDperiodoinscr` int(11)
,`pathArqHistorico` varchar(250)
,`pathArqPlanoDisciplina` varchar(250)
,`pathArqRelatorioSemestral` varchar(250)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_disciplina_monitoria`
--
CREATE TABLE `view_disciplina_monitoria` (
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
-- Estrutura stand-in para view `view_professor_monitoria`
--
CREATE TABLE `view_professor_monitoria` (
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
,`periodo` varchar(10)
,`IDperiodoinscr` int(11)
,`pathArqPlanoDisciplina` varchar(250)
,`pathArqRelatorioSemestral` varchar(250)
);

-- --------------------------------------------------------

--
-- Estrutura para view `view_aluno_monitoria`
--
DROP TABLE IF EXISTS `view_aluno_monitoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_aluno_monitoria`  AS  select `m`.`id` AS `id`,`m`.`IDDisc` AS `id_disciplina`,`u`.`name` AS `aluno`,`m`.`IDAluno` AS `IDAluno`,`u`.`matricula` AS `matricula`,`u`.`cpf` AS `cpf`,`m`.`mediaFinal` AS `mediaFinal`,`m`.`bolsa` AS `bolsa`,if((`m`.`bolsa` = 1),'Sim','Não') AS `bolsa_traducao`,`m`.`banco` AS `banco`,`m`.`agencia` AS `agencia`,`m`.`conta` AS `conta`,`m`.`semestreConclusao` AS `semestreConclusao`,`m`.`anoConclusao` AS `anoConclusao`,`u`.`telefone` AS `telefoneAluno`,`u`.`endereco` AS `enderecoAluno`,`u`.`email` AS `emailAluno`,`u`.`rg` AS `RgAluno`,`ca`.`nome` AS `nomeCursoAluno`,`d`.`codDisciplina` AS `codDisciplina`,`d`.`nomeDisciplina` AS `nomeDisciplina`,`dp`.`codTurma` AS `codTurma`,`p`.`name` AS `professor`,`p`.`telefone` AS `telefoneProfessor`,`p`.`email` AS `emailProfessor`,`c`.`nome` AS `nomeCurso`,`m`.`status` AS `codStatus`,(case `m`.`status` when 0 then 'Aguardando Avaliação' when 1 then 'Selecionado com bolsa' when 2 then 'Selecionado sem bolsa' when 3 then 'Não selecionado' when 4 then 'Indeferido - Nota < 7' when 5 then 'Indeferido - Coeficiente < 5' when 6 then 'Indeferido - Não cursou a disciplina' end) AS `status`,`pi`.`codigo` AS `periodo`,`m`.`IDperiodoinscr` AS `IDperiodoinscr`,`m`.`pathArqHistorico` AS `pathArqHistorico`,`m`.`pathArqPlanoDisciplina` AS `pathArqPlanoDisciplina`,`m`.`pathArqRelatorioSemestral` AS `pathArqRelatorioSemestral` from (((((((`monitoria` `m` join `disciplina_periodo` `dp` on((`m`.`IDDisc` = `dp`.`id`))) join `disciplina` `d` on((`dp`.`idDisciplina` = `d`.`id`))) left join `usuario` `u` on((`m`.`IDAluno` = `u`.`id`))) left join `usuario` `p` on((`dp`.`idProfessor` = `p`.`id`))) left join `curso` `c` on((`dp`.`idCurso` = `c`.`id`))) left join `periodo` `pi` on((`m`.`IDperiodoinscr` = `pi`.`id`))) left join `curso` `ca` on((`u`.`curso_id` = `ca`.`id`))) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_disciplina_monitoria`
--
DROP TABLE IF EXISTS `view_disciplina_monitoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_disciplina_monitoria`  AS  select `a`.`id` AS `id`,`b`.`nomeDisciplina` AS `nomeDisciplina`,`b`.`codDisciplina` AS `codDisciplina`,`c`.`nome` AS `nomeCurso`,`a`.`codTurma` AS `codTurma`,`d`.`name` AS `nomeProfessor`,`a`.`numPeriodo` AS `numPeriodo`,`a`.`anoPeriodo` AS `anoPeriodo`,`a`.`qtdVagas` AS `qtdVagas`,`a`.`usaLaboratorio` AS `lab`,if((`a`.`usaLaboratorio` = 1),'Sim','Não') AS `lab_traducao`,`a`.`qtdMonitorBolsista` AS `qtdMonitorBolsista`,`a`.`qtdMonitorNaoBolsista` AS `qtdMonitorNaoBolsista` from (((`disciplina_periodo` `a` join `disciplina` `b` on((`a`.`idDisciplina` = `b`.`id`))) left join `curso` `c` on((`a`.`idCurso` = `c`.`id`))) left join `usuario` `d` on((`a`.`idProfessor` = `d`.`id`))) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_professor_monitoria`
--
DROP TABLE IF EXISTS `view_professor_monitoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_professor_monitoria`  AS  select `m`.`id` AS `id`,`m`.`IDDisc` AS `id_disciplina`,`d`.`codDisciplina` AS `codDisciplina`,`d`.`nomeDisciplina` AS `nomeDisciplina`,`dp`.`codTurma` AS `codTurma`,`p`.`name` AS `professor`,`p`.`cpf` AS `cpfProfessor`,`dp`.`idProfessor` AS `idProfessor`,`c`.`nome` AS `nomeCursoDisciplina`,`u`.`name` AS `aluno`,`m`.`IDAluno` AS `IDAluno`,`u`.`matricula` AS `matricula`,`ca`.`nome` AS `nomeCursoAluno`,`m`.`bolsa` AS `bolsa`,if((`m`.`bolsa` = 1),'Sim','Não') AS `bolsa_traducao`,`pi`.`codigo` AS `periodo`,`m`.`IDperiodoinscr` AS `IDperiodoinscr`,`m`.`pathArqPlanoDisciplina` AS `pathArqPlanoDisciplina`,`m`.`pathArqRelatorioSemestral` AS `pathArqRelatorioSemestral` from (((((((`monitoria` `m` join `disciplina_periodo` `dp` on((`m`.`IDDisc` = `dp`.`id`))) join `disciplina` `d` on((`dp`.`idDisciplina` = `d`.`id`))) left join `usuario` `u` on((`m`.`IDAluno` = `u`.`id`))) left join `usuario` `p` on((`dp`.`idProfessor` = `p`.`id`))) left join `curso` `c` on((`dp`.`idCurso` = `c`.`id`))) left join `periodo` `pi` on((`m`.`IDperiodoinscr` = `pi`.`id`))) left join `curso` `ca` on((`u`.`curso_id` = `ca`.`id`))) where (`m`.`status` in (1,2)) ;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comissao`
--
ALTER TABLE `comissao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProfessor` (`idProfessor`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codDisciplina` (`codDisciplina`);

--
-- Índices de tabela `disciplina_periodo`
--
ALTER TABLE `disciplina_periodo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idDisciplinaPeriodo` (`idDisciplina`,`numPeriodo`,`anoPeriodo`,`codTurma`),
  ADD KEY `fk_disciplina_periodo_idDisciplina` (`idDisciplina`),
  ADD KEY `fk_disciplina_periodo_idCurso` (`idCurso`),
  ADD KEY `fk_disciplina_periodo_idProfessor` (`idProfessor`);

--
-- Índices de tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDMonitoria` (`IDMonitoria`);

--
-- Índices de tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Índices de tabela `monitoria`
--
ALTER TABLE `monitoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDDisc` (`IDDisc`) USING BTREE,
  ADD KEY `IDAluno` (`IDAluno`),
  ADD KEY `IDperiodoinscr` (`IDperiodoinscr`);

--
-- Índices de tabela `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_dynagrid`
--
ALTER TABLE `tbl_dynagrid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_dynagrid_FK1` (`filter_id`),
  ADD KEY `tbl_dynagrid_FK2` (`sort_id`);

--
-- Índices de tabela `tbl_dynagrid_dtl`
--
ALTER TABLE `tbl_dynagrid_dtl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_dynagrid_dtl_UK1` (`name`,`category`,`dynagrid_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario_curso`
--
ALTER TABLE `usuario_curso`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `anexo`
--
ALTER TABLE `anexo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT de tabela `comissao`
--
ALTER TABLE `comissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1730;
--
-- AUTO_INCREMENT de tabela `disciplina_periodo`
--
ALTER TABLE `disciplina_periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT de tabela `frequencia`
--
ALTER TABLE `frequencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `monitoria`
--
ALTER TABLE `monitoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de tabela `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT de tabela `usuario_curso`
--
ALTER TABLE `usuario_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `disciplina_periodo`
--
ALTER TABLE `disciplina_periodo`
  ADD CONSTRAINT `disciplina_periodo_ibfk_1` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_dynagrid`
--
ALTER TABLE `tbl_dynagrid`
  ADD CONSTRAINT `tbl_dynagrid_FK1` FOREIGN KEY (`filter_id`) REFERENCES `tbl_dynagrid_dtl` (`id`),
  ADD CONSTRAINT `tbl_dynagrid_FK2` FOREIGN KEY (`sort_id`) REFERENCES `tbl_dynagrid_dtl` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
