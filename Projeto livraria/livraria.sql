-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 09/06/2025 às 20h33min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `livraria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `autor`
--

INSERT INTO `autor` (`codigo`, `nome`, `pais`) VALUES
(1, 'Napoleon Hill', 'joel'),
(2, ' Haemin Sunim', 'Marcia'),
(3, 'Clarice Lispector', 'Cris'),
(4, 'Mark Wolynn', 'Mariane '),
(5, 'Raphael Montes', 'Marcos'),
(6, 'Philippa Perry', 'Jair'),
(7, 'Bruno Perini', 'Laura'),
(8, 'Clarissa Pinkola Estés', 'Lara'),
(9, 'Charles Duhigg', 'Zenaide');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`) VALUES
(0, 'Psicologia '),
(2, 'Romance '),
(3, 'Autoconhecimento'),
(4, 'Literatura Brasileira'),
(5, ' Autoajuda'),
(6, 'Espiritualidade'),
(7, 'Terror'),
(8, 'Aventura'),
(9, 'Suspense');

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE IF NOT EXISTS `editora` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`codigo`, `nome`) VALUES
(1, 'Editora Sextante'),
(2, 'Citadel Editora'),
(3, 'Rocco'),
(4, 'Fontanar'),
(5, 'Companhia das Letras'),
(6, 'Gente'),
(7, 'Objetiva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
  `codigo` int(5) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `nrpaginas` int(4) NOT NULL,
  `ano` int(4) NOT NULL,
  `codautor` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codeditora` int(5) NOT NULL,
  `resenha` text NOT NULL,
  `preco` float(6,2) NOT NULL,
  `fotocapa1` varchar(100) NOT NULL,
  `fotocapa2` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codautor` (`codautor`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codeditora` (`codeditora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`codigo`, `titulo`, `nrpaginas`, `ano`, `codautor`, `codcategoria`, `codeditora`, `resenha`, `preco`, `fotocapa1`, `fotocapa2`) VALUES
(1, ' O Poder do Agora', 192, 2017, 2, 6, 2, 'Um guia prÃ¡tico para encontrar paz interior e equilÃ­brio na vida cotidiana, com ensinamentos simples baseados no budismo e mindfulness.', 90.00, '4550135501a3933a85ca39ce380ca9b0webp', 'ca79adf1dfe8c540265d91a096280456webp'),
(2, 'As coisas que vocÃª sÃ³ vÃª quando desacelera', 256, 2017, 2, 6, 1, 'Um guia leve e inspirador sobre como encontrar paz interior em meio ao caos do dia a dia. Com reflexÃµes e ilustraÃ§Ãµes suaves, o monge zen Haemin Sunim convida o leitor a desacelerar, cultivar a compaixÃ£o e viver o presente com mais atenÃ§Ã£o e serenidade.', 0.00, '157648dfaccbf9ddd5885441316fdd97.jpg', '40b3e60aafabad165f992a731905c953webp'),
(3, 'Think and Grow Rich', 280, 1937, 1, 5, 1, ' Um clÃ¡ssico do desenvolvimento pessoal e autoajuda, este livro apresenta os princÃ­pios para alcanÃ§ar o sucesso financeiro e pessoal, baseados em entrevistas com os maiores empresÃ¡rios da Ã©poca.', 79.00, 'aad369a75585c2629b784df1e271974a.jpg', '3d834b974506dff41e357480f7ed2043.jpg'),
(4, 'Quem Pensa, Enriquece', 200, 2010, 1, 0, 6, 'Publicado originalmente em 1937, â€œQuem Pensa, Enriqueceâ€ Ã© a obra mais famosa de Napoleon Hill e uma das maiores referÃªncias do desenvolvimento pessoal e da literatura sobre sucesso financeiro. Hill passou mais de 20 anos pesquisando o segredo do sucesso, entrevistando centenas de pessoas ricas e influentes, como Andrew Carnegie, Henry Ford, Thomas Edison e outros.', 0.00, '8e296c34d0c72659f3a8829d85ae9573.jpg', '3c56b0bc9318b38873bd5cccc56f6c5fwebp'),
(5, 'A Hora da Estrela', 96, 1977, 3, 4, 5, 'Romance que explora a vida e os pensamentos de MacabÃ©a, uma jovem nordestina em busca de significado e identidade na cidade grande.', 55.00, '81a518eeeeb2054c3e4adbb4ce53cc8d.jpg', '7d6b9bae785bfccf62b14cbc9ce9dc37.jpg'),
(6, 'It Didnâ€™t Start with You', 336, 2016, 4, 3, 3, 'Explora como traumas familiares nÃ£o resolvidos podem ser transmitidos entre geraÃ§Ãµes e oferece estratÃ©gias para identificar e curar essas feridas emocionais.', 100.00, '5e8f4e418e0c626f583db7517982e711.jpg', '5a4ea0321a439bc8abf3911701b2d8cb.jpg'),
(7, 'Suicidas', 256, 2012, 5, 7, 4, 'Thriller de terror e suspense que narra a investigaÃ§Ã£o de um grupo de jovens que se suicidam em circunstÃ¢ncias misteriosas, com reviravoltas impactantes.', 56.00, '6a10c61c75a5c4f1b88b5231a507768fwebp', '561ece91be944dc10025796420259bf5.jpg'),
(8, 'Como Fazer as Pazes com seu Corpo', 256, 2021, 6, 0, 6, 'Um olhar psicoterapÃªutico sobre a relaÃ§Ã£o que temos com nossos corpos, propondo reflexÃ£o e ferramentas para melhorar a autoestima e aceitaÃ§Ã£o corporal.', 44.00, '07f9722fc61afb22b9e52552b697bb03.jpg', 'c21e63e8baece1b18c1efd671f6456f3.jpg'),
(9, ' Descomplique', 320, 2017, 7, 5, 7, 'Livro de finanÃ§as pessoais que desmistifica conceitos econÃ´micos complexos, ajudando o leitor a entender e aplicar estratÃ©gias para melhorar sua vida financeira.', 87.00, '9958d233e12103ed883bd435edb7a17awebp', '8dbef5cbec63d56610741d275d341909.jpg'),
(10, 'Mulheres que Correm com os Lobos', 416, 1992, 8, 3, 3, 'AnÃ¡lise profunda dos arquÃ©tipos femininos atravÃ©s de mitos e contos de fadas, incentivando o empoderamento e a redescoberta da forÃ§a instintiva da mulher.', 67.00, '9daa1de6198dcc4139d408df6e15a60d.jpg', 'fdd05177dd0cc303dcef91dca723ef2cwebp'),
(11, 'O Poder do HÃ¡bito', 408, 2012, 9, 6, 5, 'Explica como os hÃ¡bitos funcionam no cÃ©rebro e como podemos mudÃ¡-los para melhorar nossa vida pessoal e profissional, usando exemplos reais e pesquisas cientÃ­ficas.', 59.00, '3f4a2c5370ad426025b3a78d1bb1b3d1.jpg', 'e001686b19562128e78860ea03e77ea1.jpg'),
(12, 'Dias Perfeitos', 256, 2014, 5, 9, 4, 'Suspense e terror se misturam nessa trama intensa sobre um homem obcecado que sequestra a garota de quem gosta, revelando a escuridÃ£o por trÃ¡s do amor obsessivo.', 49.00, 'd5ddcc39a83dc9bac4181d79e1aaca02.jpg', 'd6758d0d17983cc77fc28414fb83396c.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`codautor`) REFERENCES `autor` (`codigo`),
  ADD CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categoria` (`codigo`),
  ADD CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`codeditora`) REFERENCES `editora` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
