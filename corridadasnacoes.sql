-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22-Ago-2023 às 21:13
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `corridadasnacoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_cadastro` datetime DEFAULT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `id_alteracao` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela de usuário de login';

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `email`, `senha`, `dt_cadastro`, `dt_alteracao`, `id_alteracao`) VALUES
(1, 'Jefferson Lopes', 'jeffbreno', 'jeffbreno@gmail.com', '$2y$10$uy4JBDJWT.CDJrUODKQQuunoYFCyPvhlroGL5vIsmn5VAR3Vca7Ge', '2023-08-22 11:48:33', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_inscritos`
--

DROP TABLE IF EXISTS `usuarios_inscritos`;
CREATE TABLE IF NOT EXISTS `usuarios_inscritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_nascimento` date NOT NULL,
  `celular` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logradouro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distancia` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `camisa` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_cadastro` datetime NOT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `status_pag` char(1) COLLATE utf8mb4_unicode_ci DEFAULT 'P',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios_inscritos`
--

INSERT INTO `usuarios_inscritos` (`id`, `nome`, `email`, `genero`, `cpf`, `categoria`, `dt_nascimento`, `celular`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `distancia`, `camisa`, `equipe`, `dt_cadastro`, `dt_alteracao`, `status_pag`) VALUES
(2, 'Ivan Braga de Souza ', 'ivanbragall@yahoo.com.br', 'M', '70327319453', '1', '1969-11-24', '84996290706', 'Av Antártida ', '501', 'Cond Novo Leblon -CsD', 'Parque das Nações ', 'Parnamirim ', 'RN', '5', 'G', 'Não tenho equipe', '2023-08-19 18:49:27', NULL, 'P'),
(3, 'Gustavo Pacheco Ramos filho ', 'pacheco.personal92@gmail.com', 'M', '08730726425', '1', '1992-10-14', '84996147671', 'Rua coronel Alberto manso marciel ', '66', 'Casa ', 'Parque das nações ', 'Parnamirim ', 'Rn', '5', 'GG', 'Não ', '2023-08-19 18:52:02', NULL, 'P'),
(11, 'jessica bezerra nascimento', 'jessicabezerran.arq@gmail.com', 'F', '079.961.474-26', '1', '1992-05-28', '(84) 99635-5917', 'rua coronel alberto manso maciel', '66', 'casa', 'parque das nações', 'parnamirim', 'rn', '5', 'PP', 'NÃO TENHO', '2023-08-20 10:41:17', NULL, 'P'),
(12, 'João Paulo Leandro da Silva', 'joao.paulo.vip@hotmail.com', 'M', '012.790.054-32', '1', '1984-05-16', '(84) 99694-1327', 'Rua Pará ', '271', '', 'Loteamento Esperança', 'Macaíba', 'RN', '10', 'M', 'Cuscuz Runner', '2023-08-20 11:18:07', NULL, 'P'),
(13, 'Ana Herica Soares de Oliveura', 'anaherica2012@hotmail.com', 'F', '050.687.944-57', '1', '1985-03-28', '(84) 99471-2234', 'Rua', '82', 'Casa', 'Liberdade ', 'Parnamirim ', 'RN', '10', 'PP', 'Não Corra Não ', '2023-08-20 11:32:09', NULL, 'P'),
(14, 'Gleydso Rodrigues Monteiro ', 'gleydsonrodrigues1981@hotmail.com', 'M', '010.700.634-01', '1', '1981-08-26', '(84) 98775-3888', 'Rua Senador Dinarte Mariz ', '476', '', 'Vale do sol', 'Parnamirim ', 'Rn', '10', 'P', 'GR. ASSESSORIA ESPORTIVA', '2023-08-20 11:39:47', NULL, 'P'),
(15, 'Giovanna Kallyne da Silva Souza ', 'gio.kally.01@gmail.com', 'F', '110.725.694-18', '1', '2001-04-30', '(84) 98860-0130', 'Rua professor Antônio trigueiro ', '766', 'Felipe camarão ', 'Felipe camarão ', 'Natal Rn ', 'Rn', '5', 'PP', 'Patrocinador Superbox Natal', '2023-08-20 11:45:58', NULL, 'P'),
(16, 'Nara Dantas ', 'nara.contabilidade@gmail.com', 'F', '057.294.094-78', '1', '1984-12-13', '(84) 99961-0514', 'Avenida Olavo Lacerda Montenegro ', '2600', 'Condomínio ECOVILLE 1', 'Parque das Nações ', 'Parnamirim', 'Rn', '10', 'P', 'ECOVILLE 1', '2023-08-20 11:51:14', NULL, 'P'),
(17, 'Marcelo Silveira Magalhães Duarte ', 'msduarte_88@hotmail.com', 'M', '069.541.804-16', '1', '1988-10-04', '(84) 98841-1765', 'Av das Américas ', '2400', '', 'Parque das nações ', 'Parnamirim ', 'RN', '5', 'G', 'Não tenho equipe ', '2023-08-20 11:55:19', NULL, 'P'),
(18, 'Josué Gonçalves Júnior ', 'josuegonjunior@gmail.com', 'M', '638.022.874-87', '1', '1968-12-17', '(84) 99905-5959', 'Rua Oiti ', '266', 'Cidade Verde ', 'Nova Parnamirim ', 'Parnamirim ', 'RN', '10', 'P', 'Não tenho equipe ', '2023-08-20 12:47:13', NULL, 'P'),
(19, 'Ivenio do Espírito Santo Hermes Júnior ', 'ivenio.hermes@gmail.com', 'M', '269.731.972-72', '2', '1967-05-28', '(84) 99819-5754', 'Rua Praia de Pititinga ', '9112', 'Esquina da Rua Paripueira ', 'Ponta Negra ', 'Natal ', 'RN', '10', 'M', 'STI/ADRA', '2023-08-20 13:06:14', NULL, 'P'),
(20, 'Sharly soares sales', 'sharlyssales@hotmail.com', 'M', '092.976.054-94', '3', '1990-07-29', '(84) 99931-9656', 'Rua piracema', '4644', '', 'Neopolis', 'Natal', 'Rn', '10', 'M', 'Banho e Tosa em Domicilio', '2023-08-20 13:08:11', NULL, 'P'),
(21, 'Ivenio do Espírito Santo Hermes Júnior ', 'ivenio.hermes@gmail.com', 'M', '269.731.972-72', '2', '1967-05-28', '(84) 99819-5754', 'Rua Praia de Pititinga ', '9112', 'Esquina da Rua Paripueira ', 'Ponta Negra ', 'Natal ', 'RN', '10', 'M', 'STI/ADRA', '2023-08-20 13:08:17', NULL, 'P'),
(22, 'Carlos Renato Lisboa Ramos ', 'renatolisboa8615@gmail.com', 'M', '117.098.097-01', '1', '1986-12-15', '(21) 96908-2293', 'Olinto meira ', '1212', 'Ap503', 'Alecrim', 'Natal ', 'Rn', '5', 'G', 'Débora Faião ', '2023-08-20 13:33:54', NULL, 'P'),
(23, 'Augusto Roschy Leão Borges ', 'augustoleao12@hotmail.com', 'M', '064.061.854-55', '3', '1986-07-23', '(84) 98706-5547', 'Avenida Brigadeiro Everaldo Breves ', '380', '', 'centro', 'Parnamirim ', 'RN', '5', 'G', 'não tenho equipe', '2023-08-20 15:03:16', NULL, 'P'),
(24, 'Alessandro Dozena', 'sandozena@gmail.com', 'M', '149.597.508-80', '1', '1975-02-13', '(84) 99687-1246', 'Avenida das Américas', '1342', '301', 'Parque das Nações', 'Parnamirim', 'RN', '5', 'G', 'não tenho  equipe', '2023-08-20 15:28:48', NULL, 'P'),
(25, 'Karla Regina da Silva Luciano cure ', 'adm.akrepres@ooutlook.com', 'F', '046.874.374-00', '2', '1983-01-06', '(84) 99627-8850', 'Av Maria Lacerda Montenegro 170', '126', 'Cond Porto Seguro ', 'Nova parnamirim ', 'Parnamirim ', 'Rn', '5', 'P', 'Não tenho equipe', '2023-08-20 17:53:56', NULL, 'P'),
(26, 'Thathianne de carvalho arruda Alves ', 'tcarvalhoarruda@gmail.com', 'F', '065.942.544-05', '1', '1986-02-26', '(84) 98734-5040', 'Rua aeroporto dois de julho ', '41', '', 'Emaus ', 'Parnamirim ', 'Rn', '10', 'M', 'Não tenho equipe ', '2023-08-20 20:02:44', NULL, 'P'),
(27, 'Alexsandro Martins de Sousa ', 'alexsandro_sst@yahoo.com.br', 'M', '010.451.754-98', '1', '1983-02-01', '(84) 99925-4839', 'Rua Ferro Cardoso, ', '148', 'Residencial Luiz de Barros', 'Rocas', 'Natal ', 'RN', '5', 'G', 'Não tenho equipe', '2023-08-21 08:32:21', NULL, 'P'),
(28, 'Francicleison nascimento dos santos ', 'francicleison2012@gmail.com', 'M', '064.644.774-20', '3', '1990-09-21', '(84) 99435-5780', 'Rua primeiro de janeiro ', '04', '', 'Boa esperança ', 'Parnamirim ', 'RN', '10', 'M', '#naocorranao', '2023-08-21 10:48:32', NULL, 'P'),
(29, 'jessica bezerra nascimento', 'jessicabezerran.arq@gmail.com', 'F', '079.961.474-26', '1', '1992-05-28', '(84) 99635-5917', 'rua coronel alberto manso maciel', '66', 'CASA', 'parque das nações', 'natal', 'rn', '5', 'PP', 'NÃO TENHO', '2023-08-21 12:20:13', NULL, 'P'),
(30, 'Maria Josenilde da Silva ', 'josilvak65@gmail.com', 'F', '566.163.414-53', '1', '1971-04-29', '(84) 99179-6361', 'Rua Francisco Ferreira da Silva ', '486', 'A', 'Rosa dos Ventos ', 'Parnamirim ', 'RN', '5', 'M', 'As poderosas runners ', '2023-08-21 12:27:46', NULL, 'P'),
(31, 'Suellen Furtado Ladeira de França ', 'hugoacobr@yahoo.com.br', 'F', '006.035.689-71', '1', '1988-07-25', '(84) 99708-7699', 'Av professor clementino Câmara ', '186', 'Bloco G casa 8', 'Santos ', 'Parnamirim', 'Br', '5', 'G', 'Não tem', '2023-08-21 13:20:56', NULL, 'P'),
(32, 'Anderson Hugo Barbosa de França ', 'hugoacobr@yahoo.com.br', 'M', '109.679.887-56', '1', '1986-08-07', '(84) 99708-7699', 'Av professor Clementino Câmara ', '186', 'Bloco G casa 8', 'Santos Reis ', 'Parnamirim ', 'Br', '5', 'GG', 'Não tem ', '2023-08-21 13:26:09', NULL, 'P'),
(33, 'Wilksiney porfirio Nunes ', 'wilksiney@hotmail.com', 'M', '037.020.744-06', '1', '1981-10-13', '(84) 99136-1826', 'Av Antártida ', '501', '', 'Parque das nações ', 'Parnamirim ', 'RN', '5', 'M', 'Leblon Runners ', '2023-08-21 13:49:25', NULL, 'P'),
(34, 'Fernanda Mendes Moura Monteiro ', 'fernandamendesmoura@yahoo.com', 'F', '031.643.984-33', '1', '1979-09-02', '(84) 99193-8681', 'Rua Jeremias Pinheiro da Câmara Filho ', '1630 ', 'Cond Serrambi II ', 'Ponta Negra ', 'Natal', 'Rn', '10', 'PP', 'Não tenho uma equipe ', '2023-08-21 13:56:49', NULL, 'P'),
(35, 'jessica bezerra nascimento', 'jessicabezerran.arq@gmail.com', 'F', '079.961.474-26', '1', '1992-05-28', '(84) 99635-5917', 'rua coronel alberto manso maciel', '66', 'CASA', 'parque das nações', 'natal', 'rn', '5', 'PP', 'NÃO TENHO', '2023-08-21 14:13:59', NULL, 'P'),
(36, 'Gabriel Lucas de Oliveira ', 'biellucas3@gmail.com', 'M', '016.971.004-14', '3', '1995-12-15', '(84) 99155-9106', 'Rua Luiza Maria Conceição Santiago ', '', '', 'Passagem de Areia', 'Parnamirim ', 'RN', '10', 'M', 'Não Corra Não ', '2023-08-21 14:27:59', NULL, 'P'),
(37, 'jessica bezerra nascimento', 'jessicabezerran.arq@gmail.com', 'F', '079.961.474-26', '1', '1992-05-28', '(84) 99635-5917', 'rua coronel alberto manso maciel', '66', 'CASA', 'parque das nações', 'natal', 'rn', '5', 'PP', 'NÃO TENHO', '2023-08-21 19:00:32', NULL, 'P'),
(38, 'Lucineide Vital', 'lucineidevital160618@gmail.com', 'F', '030.588.814-52', '1', '1980-01-18', '(84) 99407-9503', 'R Manoel Patrícios de Medeiros', '2100', 'Bl 26 Ap 103', 'Jardins', 'São Gonçalo do Amarante', 'RN', '10', 'P', 'ADRA/MARONAUTAS', '2023-08-21 21:01:27', NULL, 'P'),
(39, 'Wailly Randson Palhano Oliveira ', 'waillyrandson@hotmail.con', 'M', '068.522.404-01', '1', '1988-09-16', '(84) 99957-6919', 'Rua japao', '130', '', 'Parque das nações', 'Parnamirim ', 'Rn', '5', 'GG', 'Não tenho equipe', '2023-08-21 21:10:10', NULL, 'P'),
(40, 'Wailly Randson Palhano Oliveira ', 'waillyrandson@hotmail.con', 'M', '068.522.404-01', '1', '1988-09-16', '(84) 99957-6919', 'Rua japao', '130', '', 'Parque das nações', 'Parnamirim ', 'Rn', '5', 'GG', 'Não tenho equipe', '2023-08-21 21:10:14', NULL, 'P'),
(41, 'Francisco franca de Medeiros junior ', 'junior.medeiros1983@gmail.com', 'M', '012.353.174-80', '1', '1983-02-02', '(84) 99710-4198', 'Rua Venezuela ', '18', '', 'Parque das nações ', 'Parnamirim ', 'Rn', '10', 'G', 'Não tenho equipe', '2023-08-21 21:25:26', NULL, 'P'),
(42, 'Jéssica Bezerra', 'jessicabezerran.arq@gmail.com', 'F', '079.961.474-26', '1', '1992-05-28', '(84) 99635-5917', 'Rua coronel Alberto manso Maciel ', '66', 'Casa', 'Parque das nações ', 'Parnamirim ', 'Rn', '5', 'PP', 'Não tenho ', '2023-08-22 04:36:39', NULL, 'P'),
(43, 'Jéssica Bezerra', 'jessicabezerran.arq@gmail.com', 'F', '079.961.474-26', '1', '1992-05-28', '(84) 99635-5917', 'Rua coronel Alberto manso Maciel ', '66', 'Casa', 'Parque das nações ', 'Parnamirim ', 'Rn', '5', 'PP', 'Não tenho ', '2023-08-22 04:42:10', NULL, 'P'),
(44, 'HAMILTON DE SOUSA ARAUJO', 'sgthamilton26@hotmail.com', 'M', '641.423.883-04', '3', '1980-07-20', '(84) 99675-8545', 'Rua Albertino José de Oliveira', '569', 'Casa', 'Nova Parnamirim', 'Parnamirim', 'RN', '10', 'M', 'SELVA FITNESS', '2023-08-22 06:40:46', NULL, 'P'),
(45, 'Aucidalia Bezerra da Silva ', 'a3escritorio@gmail.com', 'F', '596.353.554-91', '1', '1968-02-03', '(84) 98836-6424', 'Rua Senador Agenor Maria', '76', 'Bl 03 apt 202 ', 'Parque das Nações ', 'Parnamirim ', 'RN', '5', 'M', 'Não tenho equipe', '2023-08-22 09:53:27', NULL, 'P');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
