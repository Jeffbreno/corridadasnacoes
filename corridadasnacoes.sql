-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql35-farm15.uni5.net
-- Tempo de geração: 18/09/2023 às 11:21
-- Versão do servidor: 10.6.14-MariaDB-log
-- Versão do PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `corridadasnaco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `link_pagamento` varchar(150) NOT NULL,
  `dt_cadastro` datetime NOT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `status` char(1) DEFAULT 'A'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `categorias`
--

INSERT INTO `categorias` (`id`, `titulo`, `link_pagamento`, `dt_cadastro`, `dt_alteracao`, `status`) VALUES
(1, 'Inscrições abertas ao Público Geral - 1º Lote R$ 89,90 + Taxas', 'https://pag.ae/7ZHEeBbr4', '2023-08-27 20:43:29', NULL, 'A'),
(2, 'PCD, Idoso ou doador de sangue (requer comprovação) - R$ 44,95 + Taxas\r\n', 'https://pag.ae/7ZJy2srhQ', '2023-08-27 20:43:29', NULL, 'A'),
(3, 'KIDS (até 12 anos) - R$ 49,90 + Taxas', 'https://pag.ae/7ZHEhePKo', '2023-08-27 20:43:29', NULL, 'A'),
(4, 'Clientes da Pacheco Assessoria (requer comprovação)', 'https://pag.ae/7ZJy5T7jo', '2023-08-27 20:43:29', NULL, 'E');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dt_cadastro` datetime DEFAULT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `id_alteracao` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela de usuário de login';

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `email`, `senha`, `dt_cadastro`, `dt_alteracao`, `id_alteracao`) VALUES
(1, 'Jefferson Lopes', 'jeffbreno', 'jeffbreno@gmail.com', '$2y$10$uy4JBDJWT.CDJrUODKQQuunoYFCyPvhlroGL5vIsmn5VAR3Vca7Ge', '2023-08-22 11:48:33', NULL, 1),
(2, 'Corrida das Nações', 'corridadasnacoes', 'corridadasnacoes.rn@gmail.com', '$2y$10$uy4JBDJWT.CDJrUODKQQuunoYFCyPvhlroGL5vIsmn5VAR3Vca7Ge', '2023-08-23 09:28:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_inscritos`
--

CREATE TABLE IF NOT EXISTS `usuarios_inscritos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nome_responsavel` varchar(255) DEFAULT NULL COMMENT 'Responsável em caso de atleta kid',
  `email` varchar(255) NOT NULL,
  `genero` char(1) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `categoria` int(11) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `celular` char(20) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `distancia` char(4) NOT NULL,
  `camisa` char(3) NOT NULL,
  `equipe` varchar(255) DEFAULT NULL,
  `dt_cadastro` datetime NOT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `status_pag` char(1) DEFAULT 'A'
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Fazendo dump de dados para tabela `usuarios_inscritos`
--

INSERT INTO `usuarios_inscritos` (`id`, `nome`, `nome_responsavel`, `email`, `genero`, `cpf`, `categoria`, `dt_nascimento`, `celular`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `distancia`, `camisa`, `equipe`, `dt_cadastro`, `dt_alteracao`, `status_pag`) VALUES
(2, 'Ivan Braga de Souza ', NULL, 'ivanbragall@yahoo.com.br', 'M', '70327319453', 1, '1969-11-24', '84996290706', 'Av Antártida ', '501', 'Cond Novo Leblon -CsD', 'Parque das Nações ', 'Parnamirim ', 'RN', '5km', 'G', 'Não tenho equipe', '2023-08-19 18:49:27', NULL, 'A'),
(12, 'João Paulo Leandro da Silva', NULL, 'joao.paulo.vip@hotmail.com', 'M', '012.790.054-32', 1, '1984-05-16', '(84) 99694-1327', 'Rua Pará ', '271', '', 'Loteamento Esperança', 'Macaíba', 'RN', '10km', 'M', 'Cuscuz Runner', '2023-08-20 11:18:07', NULL, 'A'),
(13, 'Ana Herica Soares de Oliveura', NULL, 'anaherica2012@hotmail.com', 'F', '050.687.944-57', 1, '1985-03-28', '(84) 99471-2234', 'Rua', '82', 'Casa', 'Liberdade ', 'Parnamirim ', 'RN', '10km', 'PP', 'Não Corra Não ', '2023-08-20 11:32:09', NULL, 'A'),
(14, 'Gleydso Rodrigues Monteiro ', NULL, 'gleydsonrodrigues1981@hotmail.com', 'M', '010.700.634-01', 1, '1981-08-26', '(84) 98775-3888', 'Rua Senador Dinarte Mariz ', '476', '', 'Vale do sol', 'Parnamirim ', 'Rn', '10km', 'P', 'GR. ASSESSORIA ESPORTIVA', '2023-08-20 11:39:47', NULL, 'A'),
(15, 'Giovanna Kallyne da Silva Souza ', NULL, 'gio.kally.01@gmail.com', 'F', '110.725.694-18', 1, '2001-04-30', '(84) 98860-0130', 'Rua professor Antônio trigueiro ', '766', 'Felipe camarão ', 'Felipe camarão ', 'Natal Rn ', 'Rn', '5km', 'PP', 'Patrocinador Superbox Natal', '2023-08-20 11:45:58', NULL, 'A'),
(16, 'Nara Dantas ', NULL, 'nara.contabilidade@gmail.com', 'F', '057.294.094-78', 1, '1984-12-13', '(84) 99961-0514', 'Avenida Olavo Lacerda Montenegro ', '2600', 'Condomínio ECOVILLE 1', 'Parque das Nações ', 'Parnamirim', 'Rn', '10km', 'P', 'ECOVILLE 1', '2023-08-20 11:51:14', NULL, 'A'),
(17, 'Marcelo Silveira Magalhães Duarte ', NULL, 'msduarte_88@hotmail.com', 'M', '069.541.804-16', 1, '1988-10-04', '(84) 98841-1765', 'Av das Américas ', '2400', '', 'Parque das nações ', 'Parnamirim ', 'RN', '5km', 'G', 'Não tenho equipe ', '2023-08-20 11:55:19', NULL, 'A'),
(18, 'Josué Gonçalves Júnior ', NULL, 'josuegonjunior@gmail.com', 'M', '638.022.874-87', 1, '1968-12-17', '(84) 99905-5959', 'Rua Oiti ', '266', 'Cidade Verde ', 'Nova Parnamirim ', 'Parnamirim ', 'RN', '10km', 'P', 'Não tenho equipe ', '2023-08-20 12:47:13', NULL, 'A'),
(19, 'Ivenio do Espírito Santo Hermes Júnior ', NULL, 'ivenio.hermes@gmail.com', 'M', '269.731.972-72', 2, '1967-05-28', '(84) 99819-5754', 'Rua Praia de Pititinga ', '9112', 'Esquina da Rua Paripueira ', 'Ponta Negra ', 'Natal ', 'RN', '10km', 'M', 'STI/ADRA', '2023-08-20 13:06:14', NULL, 'A'),
(20, 'Sharly soares sales', NULL, 'sharlyssales@hotmail.com', 'M', '092.976.054-94', 2, '1990-07-29', '(84) 99931-9656', 'Rua piracema', '4644', '', 'Neopolis', 'Natal', 'Rn', '10km', 'M', 'Banho e Tosa em Domicilio', '2023-08-20 13:08:11', NULL, 'A'),
(21, 'Ivenio do Espírito Santo Hermes Júnior ', NULL, 'ivenio.hermes@gmail.com', 'M', '269.731.972-72', 2, '1967-05-28', '(84) 99819-5754', 'Rua Praia de Pititinga ', '9112', 'Esquina da Rua Paripueira ', 'Ponta Negra ', 'Natal ', 'RN', '10km', 'M', 'STI/ADRA', '2023-08-20 13:08:17', NULL, 'A'),
(22, 'Carlos Renato Lisboa Ramos ', NULL, 'renatolisboa8615@gmail.com', 'M', '117.098.097-01', 1, '1986-12-15', '(21) 96908-2293', 'Olinto meira ', '1212', 'Ap503', 'Alecrim', 'Natal ', 'Rn', '5km', 'G', 'Débora Faião ', '2023-08-20 13:33:54', NULL, 'A'),
(23, 'Augusto Roschy Leão Borges ', NULL, 'augustoleao12@hotmail.com', 'M', '064.061.854-55', 2, '1986-07-23', '(84) 98706-5547', 'Avenida Brigadeiro Everaldo Breves ', '380', '', 'centro', 'Parnamirim ', 'RN', '5km', 'G', 'não tenho equipe', '2023-08-20 15:03:16', NULL, 'A'),
(24, 'Alessandro Dozena', NULL, 'sandozena@gmail.com', 'M', '149.597.508-80', 1, '1975-02-13', '(84) 99687-1246', 'Avenida das Américas', '1342', '301', 'Parque das Nações', 'Parnamirim', 'RN', '5km', 'G', 'não tenho  equipe', '2023-08-20 15:28:48', NULL, 'A'),
(25, 'Karla Regina da Silva Luciano cure ', NULL, 'adm.akrepres@ooutlook.com', 'F', '046.874.374-00', 2, '1983-01-06', '(84) 99627-8850', 'Av Maria Lacerda Montenegro 170', '126', 'Cond Porto Seguro ', 'Nova parnamirim ', 'Parnamirim ', 'Rn', '5km', 'P', 'Não tenho equipe', '2023-08-20 17:53:56', NULL, 'A'),
(26, 'Thathianne de carvalho arruda Alves ', NULL, 'tcarvalhoarruda@gmail.com', 'F', '065.942.544-05', 1, '1986-02-26', '(84) 98734-5040', 'Rua aeroporto dois de julho ', '41', '', 'Emaus ', 'Parnamirim ', 'Rn', '10km', 'M', 'Não tenho equipe ', '2023-08-20 20:02:44', NULL, 'A'),
(27, 'Alexsandro Martins de Sousa ', NULL, 'alexsandro_sst@yahoo.com.br', 'M', '010.451.754-98', 1, '1983-02-01', '(84) 99925-4839', 'Rua Ferro Cardoso, ', '148', 'Residencial Luiz de Barros', 'Rocas', 'Natal ', 'RN', '5km', 'G', 'Não tenho equipe', '2023-08-21 08:32:21', NULL, 'A'),
(28, 'Francicleison nascimento dos santos ', NULL, 'francicleison2012@gmail.com', 'M', '064.644.774-20', 2, '1990-09-21', '(84) 99435-5780', 'Rua primeiro de janeiro ', '04', '', 'Boa esperança ', 'Parnamirim ', 'RN', '10km', 'M', '#naocorranao', '2023-08-21 10:48:32', NULL, 'A'),
(30, 'Maria Josenilde da Silva ', NULL, 'josilvak65@gmail.com', 'F', '566.163.414-53', 1, '1971-04-29', '(84) 99179-6361', 'Rua Francisco Ferreira da Silva ', '486', 'A', 'Rosa dos Ventos ', 'Parnamirim ', 'RN', '5km', 'M', 'As poderosas runners ', '2023-08-21 12:27:46', NULL, 'A'),
(31, 'Suellen Furtado Ladeira de França ', NULL, 'hugoacobr@yahoo.com.br', 'F', '006.035.689-71', 1, '1988-07-25', '(84) 99708-7699', 'Av professor clementino Câmara ', '186', 'Bloco G casa 8', 'Santos ', 'Parnamirim', 'Br', '5km', 'G', 'Não tem', '2023-08-21 13:20:56', NULL, 'A'),
(32, 'Anderson Hugo Barbosa de França ', NULL, 'hugoacobr@yahoo.com.br', 'M', '109.679.887-56', 1, '1986-08-07', '(84) 99708-7699', 'Av professor Clementino Câmara ', '186', 'Bloco G casa 8', 'Santos Reis ', 'Parnamirim ', 'Br', '5km', 'GG', 'Não tem ', '2023-08-21 13:26:09', NULL, 'A'),
(33, 'Wilksiney porfirio Nunes ', NULL, 'wilksiney@hotmail.com', 'M', '037.020.744-06', 1, '1981-10-13', '(84) 99136-1826', 'Av Antártida ', '501', '', 'Parque das nações ', 'Parnamirim ', 'RN', '5km', 'M', 'Leblon Runners ', '2023-08-21 13:49:25', NULL, 'A'),
(34, 'Fernanda Mendes Moura Monteiro ', NULL, 'fernandamendesmoura@yahoo.com', 'F', '031.643.984-33', 1, '1979-09-02', '(84) 99193-8681', 'Rua Jeremias Pinheiro da Câmara Filho ', '1630 ', 'Cond Serrambi II ', 'Ponta Negra ', 'Natal', 'Rn', '10km', 'PP', 'Não tenho uma equipe ', '2023-08-21 13:56:49', NULL, 'A'),
(36, 'Gabriel Lucas de Oliveira ', NULL, 'biellucas3@gmail.com', 'M', '016.971.004-14', 2, '1995-12-15', '(84) 99155-9106', 'Rua Luiza Maria Conceição Santiago ', '', '', 'Passagem de Areia', 'Parnamirim ', 'RN', '10km', 'M', 'Não Corra Não ', '2023-08-21 14:27:59', NULL, 'A'),
(38, 'Lucineide Vital', NULL, 'lucineidevital160618@gmail.com', 'F', '030.588.814-52', 1, '1980-01-18', '(84) 99407-9503', 'R Manoel Patrícios de Medeiros', '2100', 'Bl 26 Ap 103', 'Jardins', 'São Gonçalo do Amarante', 'RN', '10km', 'P', 'ADRA/MARONAUTAS', '2023-08-21 21:01:27', NULL, 'A'),
(39, 'Wailly Randson Palhano Oliveira ', NULL, 'waillyrandson@hotmail.con', 'M', '068.522.404-01', 1, '1988-09-16', '(84) 99957-6919', 'Rua japao', '130', '', 'Parque das nações', 'Parnamirim ', 'Rn', '5km', 'GG', 'Não tenho equipe', '2023-08-21 21:10:10', NULL, 'A'),
(40, 'Wailly Randson Palhano Oliveira ', NULL, 'waillyrandson@hotmail.con', 'M', '068.522.404-01', 1, '1988-09-16', '(84) 99957-6919', 'Rua japao', '130', '', 'Parque das nações', 'Parnamirim ', 'Rn', '5km', 'GG', 'Não tenho equipe', '2023-08-21 21:10:14', NULL, 'A'),
(41, 'Francisco franca de Medeiros junior ', NULL, 'junior.medeiros1983@gmail.com', 'M', '012.353.174-80', 1, '1983-02-02', '(84) 99710-4198', 'Rua Venezuela ', '18', '', 'Parque das nações ', 'Parnamirim ', 'Rn', '10km', 'G', 'Não tenho equipe', '2023-08-21 21:25:26', NULL, 'A'),
(44, 'HAMILTON DE SOUSA ARAUJO', NULL, 'sgthamilton26@hotmail.com', 'M', '641.423.883-04', 2, '1980-07-20', '(84) 99675-8545', 'Rua Albertino José de Oliveira', '569', 'Casa', 'Nova Parnamirim', 'Parnamirim', 'RN', '10km', 'M', 'SELVA FITNESS', '2023-08-22 06:40:46', NULL, 'A'),
(45, 'Aucidalia Bezerra da Silva ', NULL, 'a3escritorio@gmail.com', 'F', '596.353.554-91', 1, '1968-02-03', '(84) 98836-6424', 'Rua Senador Agenor Maria', '76', 'Bl 03 apt 202 ', 'Parque das Nações ', 'Parnamirim ', 'RN', '5km', 'M', 'Não tenho equipe', '2023-08-22 09:53:27', NULL, 'A'),
(46, 'angela maria pereira da silva', NULL, 'leo_nilda@yahoo.com.br', 'F', '030.559.794-94', 1, '1967-06-29', '(84) 99993-9361', 'rua jacumã', '8', '', 'nova parnamirim', 'parnamirim', 'rn', '5km', 'M', 'pé na estrada', '2023-08-22 20:11:59', NULL, 'A'),
(47, 'Pedro Raoni (TESTE DE COMPRA)', NULL, 'pedroraoni@hotmail.com', 'M', '067.589.054-38', 1, '1987-11-23', '(84) 98735-9006', 'Rua expedicionário pontes lira', '70', 'ipe', 'Nova parnamirim', 'parnamirim', 'rn', '5km', 'PP', 'nao tenho', '2023-08-23 08:11:50', NULL, 'A'),
(50, 'Marivaldo tomaz Barros ', NULL, 'marivaldoxkr@hotmail.com', 'M', '055.886.514-30', 1, '1984-03-07', '(84) 99970-9850', 'Rua Agostinho Santos ', '349', 'Casa', 'Vila altiva 2 ', 'Caico ', 'Rn', '10km', 'M', 'Loketa ', '2023-08-23 11:50:32', NULL, 'A'),
(51, 'Hermes Neves maia de oliveira ', NULL, 'hermesnm@terra.com.br', 'M', '406.690.114-68', 1, '1963-08-10', '(47) 99981-0167', '89036301', '333', 'Apto 1702', 'Velha', 'Blumenau ', 'SC', '10km', 'GG', 'Não tenho equipe ', '2023-08-23 12:52:33', NULL, 'A'),
(52, 'Urias Oliveira de Souza ', NULL, 'uriassouza@yahoo.com.br', 'M', '052.317.884-06', 1, '1985-04-18', '(84) 98187-8127', 'Av. Eliza Branco Pereira ', '', '', 'Parque das Nações', 'Parnamirim', 'RN', '10km', 'G', 'não tenho equipe ', '2023-08-23 14:46:57', NULL, 'A'),
(53, 'Fabiana Cristina Targino de Oliveira', NULL, 'fabiana_ufrn@yahoo.com.br', 'F', '065.153.254-01', 1, '1988-06-03', '(84) 98168-8127', 'Av. Eliza Branco Pereira ', '', '', 'Parque das Nações', 'Parnamirim', 'RN', '5km', 'P', 'Não tenho equipe', '2023-08-23 15:07:55', NULL, 'A'),
(54, 'Iris Cabral de Araujo Souza', NULL, 'iriscabraldearaujosouza@gmail.com', 'F', '877.290.324-49', 1, '1973-07-21', '(84) 99925-0314', 'Rua Marieta Lacerda Montenegro ', '148', 'Casa', 'Quinta do Farol ', 'AÇU', 'RN', '10km', 'P', 'ASSU RUNNING', '2023-08-23 19:42:03', NULL, 'A'),
(55, 'Rita Cássia Rufino de Souza Cabral ', NULL, 'luthyan.vannuty@gmail.com', 'F', '009.213.474-21', 1, '1968-08-21', '(84) 99929-3768', 'Genésio Xavier Rebouças ', '620', '', 'Planalto treze de maio.', 'Mossoró', 'RN', '10km', 'P', 'Assú running', '2023-08-23 19:46:35', NULL, 'A'),
(56, 'Francisco Rufino de Souza ', NULL, 'rufinoimpressoes@gmail.com', 'M', '473.683.494-34', 1, '1966-06-06', '(84) 99945-8730', 'Rua Marieta Lacerda Montenegro ', '148', 'Casa', 'Quinta do Farol ', 'AÇU', 'RN', '10km', 'G', 'ASSU RUNNING', '2023-08-23 19:54:53', NULL, 'A'),
(57, 'Maria Luiza De Souza ', NULL, 'szpneus@gmail.com', 'F', '017.777.314-61', 1, '1998-05-16', '(84) 98839-5346', 'Ralfh soppor ', '03', '', 'Alto de são Manoel ', 'Mossoró ', 'RN', '10km', 'PP', 'Assu Running / Run Life', '2023-08-23 21:38:30', NULL, 'A'),
(58, 'Hermenegilson Barros de Macedo', NULL, 'hermenegilson@hotmail.com', 'M', '761.314.914-53', 1, '1971-04-14', '(84) 98894-3483', 'RUA JOSÉ GUILHERME LOPES', '163', '', 'VISTA BELA', 'Açu', 'RN', '5km', 'G', 'ASSÚ RUNNING', '2023-08-24 08:02:02', NULL, 'A'),
(59, 'Jaciara Araújo de Oliveira ', NULL, 'Jaciara.araujo85@Gmail.com', 'F', '067.879.174-06', 1, '2023-08-03', '(84) 99428-1962', 'Av.flor de liz', '421', 'Condomínio  vilages das órquidias ', 'Parque das nações ', 'Parnamimri ', 'RN', '10km', 'M', 'Não tenho ', '2023-08-24 10:50:02', NULL, 'A'),
(60, 'Gildomar Barros de macedo', NULL, 'gildomarmacedo@gmail.com', 'M', '784.628.514-91', 1, '1974-09-26', '(84) 99950-1064', 'Rua Mirabeau Pereira', '195', 'Apto 102', 'Alecrim', 'Natal', 'RN', '5km', 'GG', 'ASSU RUNNING', '2023-08-24 15:14:22', NULL, 'A'),
(61, 'Maria da Conceição Rufino de Souza Pinheiro ', NULL, 'rufinodesouzapinheiro@gmail.com', 'F', '010.785.254-39', 1, '1978-02-18', '(84) 99919-1057', 'Rua Nelson Alves de Moura ', '312', '', 'Quinta do Farol ', 'Assu', 'RN', '10km', 'P', 'Assu Runnig ', '2023-08-24 15:50:38', NULL, 'A'),
(62, 'Felipe alves dos santos', NULL, 'sdfsantos525@gmail.com', 'M', '708.796.634-05', 1, '2000-03-23', '(84) 99128-8107', 'Rua presidente café filho', '10', 'Casa', 'Santa teresa', 'Parnamirim ', 'Rn', '5km', 'P', 'Não tenho equipe', '2023-08-24 17:40:17', NULL, 'A'),
(64, 'Leonardo Souza Da Silva', NULL, 'leootica61@gmail.com', 'M', '711.487.957-15', 1, '1961-04-04', '(84) 98891-3633', 'AVENIDA ABEL CABRAL', '2092', 'CASA 44', 'NOVA PARNAMIRIM', 'Parnamirim', 'Ri', '5km', 'M', 'AVULSO', '2023-08-24 21:03:09', NULL, 'A'),
(65, 'Leonardo Souza Da Silva', NULL, 'leootica61@gmail.com', 'M', '711.487.957-15', 1, '1961-04-04', '(84) 98891-3633', 'AVENIDA ABEL CABRAL', '2092', 'CASA 44', 'NOVA PARNAMIRIM', 'Parnamirim', 'Ri', '5km', 'M', 'AVULSO', '2023-08-24 21:03:09', NULL, 'A'),
(66, 'Leonardo Souza Da Silva', NULL, 'leootica61@gmail.com', 'M', '711.487.957-15', 1, '1961-04-04', '(84) 98891-3633', 'AVENIDA ABEL CABRAL', '2092', 'CASA 44', 'NOVA PARNAMIRIM', 'Parnamirim', 'Ri', '5km', 'M', 'AVULSO', '2023-08-24 21:04:17', NULL, 'A'),
(67, 'Leonardo Souza Da Silva', NULL, 'leootica61@gmail.com', 'M', '711.487.957-15', 1, '1961-04-04', '(84) 98891-3633', 'AVENIDA ABEL CABRAL', '2092', 'CASA 44', 'NOVA PARNAMIRIM', 'Parnamirim', 'Ri', '5km', 'M', 'AVULSO', '2023-08-24 21:20:05', NULL, 'A'),
(68, 'Leonardo Souza Da Silva', NULL, 'leootica61@gmail.com', 'M', '711.487.957-15', 2, '1961-04-04', '(84) 98891-3633', 'AVENIDA ABEL CABRAL', '2092', 'CASA 44', 'NOVA PARNAMIRIM', 'Parnamirim', 'Ri', '5km', 'M', 'Não tenho equipe ', '2023-08-24 21:29:26', NULL, 'A'),
(99, 'Paulo Alberto da costa ', NULL, 'paulaoparelhas@hotmail.com', 'M', '058.966.374-70', 1, '1983-11-10', '(84) 99909-3962', 'Av Ayrton Senna', '1000', 'Bl 5 Apt 1202', 'Nova Parnamirim ', 'Parnamirim ', 'Rn', '10km', 'G', 'MG Assessoria Esportiva', '2023-08-25 23:18:13', NULL, 'A'),
(100, 'Roberto Brito', NULL, 'robertobritocn@yahoo.com', 'M', '507.360.604-30', 1, '1969-07-01', '(84) 99614-6506', 'Rua Padre João Maria ', '39', '8-302', 'Emaus', 'Parnamirim', 'RN', '10km', 'P', 'MG Assessoria Esportiva', '2023-08-26 15:02:13', NULL, 'A');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios_inscritos`
--
ALTER TABLE `usuarios_inscritos`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_categoria_idx` (`categoria`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `usuarios_inscritos`
--
ALTER TABLE `usuarios_inscritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=446;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `usuarios_inscritos`
--
ALTER TABLE `usuarios_inscritos`
ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
