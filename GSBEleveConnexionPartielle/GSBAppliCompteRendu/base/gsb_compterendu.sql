-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 17 mars 2026 à 08:23
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsb_compterendu`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite_compl`
--

CREATE TABLE `activite_compl` (
  `AC_NUM` int NOT NULL,
  `AC_DATE` date DEFAULT NULL,
  `AC_LIEU` varchar(25) DEFAULT NULL,
  `AC_THEME` varchar(10) DEFAULT NULL,
  `AC_MOTIF` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `collaborateur`
--

CREATE TABLE `collaborateur` (
  `COL_MATRICULE` varchar(10) NOT NULL,
  `COL_NOM` varchar(25) DEFAULT NULL,
  `COL_PRENOM` varchar(50) DEFAULT NULL,
  `COL_ADRESSE` varchar(50) DEFAULT NULL,
  `COL_CP` varchar(5) DEFAULT NULL,
  `COL_VILLE` varchar(30) DEFAULT NULL,
  `COL_DATEEMBAUCHE` date DEFAULT NULL,
  `COL_LOGIN` varchar(20) DEFAULT NULL,
  `COL_MDP` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `collaborateur`
--

INSERT INTO `collaborateur` (`COL_MATRICULE`, `COL_NOM`, `COL_PRENOM`, `COL_ADRESSE`, `COL_CP`, `COL_VILLE`, `COL_DATEEMBAUCHE`, `COL_LOGIN`, `COL_MDP`) VALUES
('a131', 'Villechalane', 'Louis', '8 cours Lafontaine', '29000', 'BREST', '2002-12-11', 'lvillechalane', 'jux7g'),
('a17', 'Andre', 'David', '1 r Aimon de Chissée', '38100', 'GRENOBLE', '2001-08-26', 'dandre', 'oppg5'),
('a55', 'Bedos', 'Christian', '1 r Bénédictins', '65000', 'TARBES', '1997-07-17', 'cbedos', 'gmhxd'),
('a93', 'Tusseau', 'Louis', '22 r Renou', '86000', 'POITIERS', '2009-01-02', 'ltusseau', 'ktp3s'),
('b13', 'Bentot', 'Pascal', '11 av 6 Juin', '67000', 'STRASBOURG', '2006-03-11', 'pbentot', 'doyw1'),
('b16', 'Bioret', 'Luc', '1 r Linne', '35000', 'RENNES', '2007-03-21', 'lbioret', 'hrjfs'),
('b19', 'Bunisset', 'Francis', '10 r Nicolas Chorier', '85000', 'LA ROCHE SUR YON', '2009-01-31', 'fbunisset', '4vbnd'),
('b25', 'Bunisset', 'Denise', '1 r Lionne', '49100', 'ANGERS', '2004-07-03', 'dbunisset', 's1y1r'),
('b28', 'Cacheux', 'Bernard', '114 r Authie', '34000', 'MONTPELLIER', '2000-08-02', 'bcacheux', 'uf7r3'),
('b34', 'Cadic', 'Eric', '123 r Caponière', '41000', 'BLOIS', '1995-01-15', 'ecadic', '6u8dc'),
('b4', 'Charoze', 'Catherine', '100 pl Géants', '33000', 'BORDEAUX', '2007-09-25', 'ccharoze', 'u817o'),
('b50', 'Clepkens', 'Christophe', '12 r Fédérico Garcia Lorca', '13000', 'MARSEILLE', '2008-01-18', 'cclepkens', 'bw1us'),
('b59', 'Cottin', 'Vincent', '36 sq Capucins', '5000', 'GAP', '2005-10-21', 'vcottin', '2hoh9'),
('c14', 'Daburon', 'François', '13 r Champs Elysées', '6000', 'NICE', '1990-09-01', 'fdaburon', '7oqpv'),
('c3', 'De', 'Philippe', '13 r Charles Peguy', '10000', 'TROYES', '2002-05-05', 'pde', 'gk9kx'),
('c54', 'Debelle', 'Michel', '181 r Caponière', '88000', 'EPINAL', '2001-04-09', 'mdebelle', 'od5rt'),
('d13', 'Debelle', 'Jeanne', '134 r Stalingrad', '44000', 'NANTES', '2001-12-05', 'jdebelle', 'nvwqq'),
('d51', 'Debroise', 'Michel', '2 av 6 Juin', '70000', 'VESOUL', '1985-03-01', 'mdebroise', 'sghkb'),
('e22', 'Desmarquest', 'Nathalie', '14 r Fédérico Garcia Lorca', '54000', 'NANCY', '1999-03-24', 'ndesmarquest', 'f1fob'),
('e24', 'Desnost', 'Pierre', '16 r Barral de Montferrat', '55000', 'VERDUN', '2003-05-17', 'pdesnost', '4k2o5'),
('e39', 'Dudouit', 'Frédéric', '18 quai Xavier Jouvin', '75000', 'PARIS', '1998-04-26', 'fdudouit', '44im8'),
('e49', 'Duncombe', 'Claude', '19 av Alsace Lorraine', '9000', 'FOIX', '2006-02-19', 'cduncombe', 'qf77j'),
('e5', 'Enault-Pascreau', 'Céline', '25B r Stalingrad', '40000', 'MONT DE MARSAN', '2000-11-27', 'cenault', 'y2qdu'),
('e52', 'Eynde', 'Valérie', '3 r Henri Moissan', '76000', 'ROUEN', '2001-10-31', 'veynde', 'i7sn3'),
('f21', 'Finck', 'Jacques', 'rte Montreuil Bellay', '74000', 'ANNECY', '2003-06-08', 'jfinck', 'mpb3t'),
('f39', 'Frémont', 'Fernande', '4 r Jean Giono', '69000', 'LYON', '2007-02-15', 'ffremont', 'xs5tq'),
('f4', 'Gest', 'Alain', '30 r Authie', '46000', 'FIGEAC', '2004-05-03', 'agest', 'dywvt'),
('g19', 'Gheysen', 'Galassus', '32 bd Mar Foch', '75000', 'PARIS', '2006-01-18', 'ggheysen', 'dv4q5'),
('g30', 'Girard', 'Yvon', '31 av 6 Juin', '80000', 'AMIENS', '1988-06-15', 'ygirard', 'lz5f7r'),
('g53', 'Gombert', 'Luc', '32 r Emile Gueymard', '56000', 'VANNES', '1995-10-02', 'lgombert', 'mp9s5z'),
('g7', 'Guindon', 'Caroline', '40 r Mar Montgomery', '87000', 'LIMOGES', '2006-01-13', 'cguindon', 'qz2fd6'),
('h13', 'Guindon', 'François', '44 r Picotière', '19000', 'TULLE', '2003-05-08', 'fguindon', 'kd6se7'),
('h30', 'Igigabel', 'Guy', '33 gal Arlequin', '94000', 'CRETEIL', '2008-04-26', 'gigigabel', 'cd6hg8'),
('h35', 'Jourdren', 'Pierre', '34 av Jean Perrot', '15000', 'AURILLAC', '2003-08-26', 'pjourdren', 'wv9f3u'),
('h40', 'Juttard', 'Pierre-Raoul', '34 cours Jean Jaurès', '8000', 'SEDAN', '2002-11-01', 'prjuttard', 'vn3wj9'),
('j45', 'Labouré-Morel', 'Saout', '38 cours Berriat', '52000', 'CHAUMONT', '2008-02-25', 'slaboure', 'jo5dt7'),
('j50', 'Landré', 'Philippe', '4 av Gén Laperrine', '59000', 'LILLE', '2002-12-16', 'plandre', 'qx8hb6'),
('j8', 'Langeard', 'Hugues', '39 av Jean Perrot', '93000', 'BAGNOLET', '2008-06-18', 'hlangeard', 'wp1sv8'),
('k4', 'Lanne', 'Bernard', '4 r Bayeux', '30000', 'NIMES', '2006-11-21', 'blanne', 'uh2ds6'),
('k53', 'Le', 'Noël', '4 av Beauvert', '68000', 'MULHOUSE', '1993-03-23', 'nle', 'pc2hg8'),
('l14', 'Le', 'Jean', '39 r Raspail', '53000', 'LAVAL', '2005-02-02', 'jle', 'sx3frt5'),
('l23', 'Leclercq', 'Servane', '11 r Quinconce', '18000', 'BOURGES', '2005-06-05', 'sleclercq', 'vg6dg3b'),
('l46', 'Lecornu', 'Jean-Bernard', '4 bd Mar Foch', '72000', 'LA FERTE BERNARD', '2007-01-24', 'jblecornu', 'qw5ve6kn'),
('l56', 'Lecornu', 'Ludovic', '4 r Abel Servien', '25000', 'BESANCON', '2006-02-27', 'llecornu', 'ad8vrt6v3'),
('m35', 'Lejard', 'Agnès', '4 r Anthoard', '82000', 'MONTAUBAN', '1997-10-06', 'alejard', 'gf9tvw3'),
('m45', 'Lesaulnier', 'Pascal', '47 r Thiers', '57000', 'METZ', '2000-10-13', 'plesaulnier', 'xvf8jhg6'),
('n42', 'Letessier', 'Stéphane', '5 chem Capuche', '27000', 'EVREUX', '2006-03-06', 'sletessier', 'khy8dre2'),
('n58', 'Loirat', 'Didier', 'Les Pêchers cité Bourg la Croix', '45000', 'ORLEANS', '2002-08-30', 'dloirat', 'zdc5kju4'),
('n59', 'Maffezzoli', 'Thibaud', '5 r Chateaubriand', '2000', 'LAON', '2004-12-19', 'tmaffezzoli', 'ijk7cfv2'),
('o26', 'Mancini', 'Anne', '5 r D\'Agier', '48000', 'MENDE', '2005-01-05', 'amancini', 'gsz9ybg3'),
('p32', 'Marcouiller', 'Gérard', '7 pl St Gilles', '91000', 'ISSY LES MOULINEAUX', '2002-12-24', 'gmarcouiller', 'vgb2wse6'),
('p40', 'Michel', 'Jean-Claude', '5 r Gabriel Péri', '61000', 'FLERS', '1992-07-10', 'jcmichel', 'xtr6khn5'),
('p41', 'Montecot', 'Françoise', '6 r Paul Valéry', '17000', 'SAINTES', '2008-07-27', 'fmontecot', 'sxw8rjh2'),
('p42', 'Notini', 'Veronique', '5 r Lieut Chabal', '60000', 'BEAUVAIS', '2004-12-12', 'vnotini', 'mqx9as4'),
('p49', 'Onfroy', 'Den', '5 r Sidonie Jacolin', '37000', 'TOURS', '1987-10-03', 'donfroy', 'gru5kl3'),
('p6', 'Pascreau', 'Charles', '57 bd Mar Foch', '64000', 'PAU', '2007-03-30', 'cpascreau', 'lfb3jn1'),
('p7', 'Pernot', 'Claude-Noël', '6 r Alexandre 1 de Yougoslavie', '11000', 'NARBONNE', '2000-03-01', 'cnpernot', 'nyz27d'),
('p8', 'Perrier', 'Maître', '6 r Aubert Dubayet', '71000', 'CHALON SUR SAONE', '2001-06-23', 'mperrier', 'ztf3ba4'),
('q17', 'Petit', 'Jean-Louis', '7 r Ernest Renan', '50000', 'SAINT LO', '2007-09-06', 'jlpetit', 'qkp8ve1v'),
('r24', 'Piquery', 'Patrick', '9 r Vaucelles', '14000', 'CAEN', '1994-07-29', 'ppiquery', 'va8drt9'),
('r58', 'Quiquandon', 'Joël', '7 r Ernest Renan', '29000', 'QUIMPER', '2000-06-30', 'jquiquandon', 'bas5vr0'),
('s10', 'Retailleau', 'Josselin', '88Bis r Saumuroise', '39000', 'DOLE', '2005-11-14', 'jretailleau', 'xg5nu3g'),
('s21', 'Retailleau', 'Pascal', '32 bd Ayrault', '23000', 'MONTLUCON', '2002-09-25', 'pretailleau', 'bip6cnm3'),
('t43', 'Souron', 'Maryse', '7B r Gay Lussac', '21000', 'DIJON', '2005-03-09', 'msouron', 'pui6de2'),
('t47', 'Tiphagne', 'Patrick', '7B r Gay Lussac', '62000', 'ARRAS', '2007-08-29', 'ptiphagne', 'wrb7io2'),
('t55', 'Tréhet', 'Alain', '7D chem Barral', '12000', 'RODEZ', '2004-11-29', 'atrehet', 'nyv7go'),
('t60', 'Tusseau', 'Josselin', '63 r Bon Repos', '28000', 'CHARTRES', '2001-03-29', 'jtusseau', 'xzo6hy2');

-- --------------------------------------------------------

--
-- Structure de la table `composant`
--

CREATE TABLE `composant` (
  `CMP_CODE` varchar(4) NOT NULL,
  `CMP_LIBELLE` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `constituer`
--

CREATE TABLE `constituer` (
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `CMP_CODE` varchar(4) NOT NULL,
  `CST_QTE` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `delegue_regional`
--

CREATE TABLE `delegue_regional` (
  `DEL_MATRICULE` varchar(10) NOT NULL,
  `REG_CODE` varchar(2) DEFAULT NULL,
  `DEL_DATEPROMOTION` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `delegue_regional`
--

INSERT INTO `delegue_regional` (`DEL_MATRICULE`, `REG_CODE`, `DEL_DATEPROMOTION`) VALUES
('a17', 'RA', '2009-09-19'),
('a55', 'RO', '2013-08-21'),
('b25', 'CE', '2006-07-01'),
('b28', 'LG', '2013-01-02'),
('b4', 'AQ', '2012-07-01'),
('d13', 'PL', '2008-12-05'),
('e24', 'AL', '2015-04-30'),
('g7', 'LI', '2011-01-13'),
('j45', 'FC', '2008-02-25'),
('j8', 'IF', '2010-06-01'),
('k53', 'CA', '2002-04-03'),
('p42', 'PI', '2009-01-01'),
('r24', 'BN', '2008-05-25'),
('t43', 'BG', '2007-05-15');

-- --------------------------------------------------------

--
-- Structure de la table `dosage`
--

CREATE TABLE `dosage` (
  `DOS_CODE` varchar(10) NOT NULL,
  `DOS_QUANTITE` varchar(10) DEFAULT NULL,
  `DOS_UNITE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `FAM_CODE` varchar(3) NOT NULL,
  `FAM_LIBELLE` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`FAM_CODE`, `FAM_LIBELLE`) VALUES
('AA', 'Antalgiques en association'),
('AAA', 'Antalgiques antipyrétiques en association'),
('AAC', 'Antidépresseur d\'action centrale'),
('AAH', 'Antivertigineux antihistaminique H1'),
('ABA', 'Antibiotique antituberculeux'),
('ABC', 'Antibiotique antiacnéique local'),
('ABP', 'Antibiotique de la famille des béta-lactamines (pénicilline A)'),
('AFC', 'Antibiotique de la famille des cyclines'),
('AFM', 'Antibiotique de la famille des macrolides'),
('AH', 'Antihistaminique H1 local'),
('AIM', 'Antidépresseur imipraminique (tricyclique)'),
('AIN', 'Antidépresseur inhibiteur sélectif de la recapture de la sérotonine'),
('ALO', 'Antibiotique local (ORL)'),
('ANS', 'Antidépresseur IMAO non sélectif'),
('AO', 'Antibiotique ophtalmique'),
('AP', 'Antipsychotique normothymique'),
('AUM', 'Antibiotique urinaire minute'),
('CRT', 'Corticoïde, antibiotique et antifongique à  usage local'),
('HYP', 'Hypnotique antihistaminique'),
('PSA', 'Psychostimulant, antiasthénique');

-- --------------------------------------------------------

--
-- Structure de la table `formuler`
--

CREATE TABLE `formuler` (
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `PRE_CODE` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `interagir`
--

CREATE TABLE `interagir` (
  `MED_PERTURBATEUR` varchar(10) NOT NULL,
  `MED_PERTURBE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `inviter`
--

CREATE TABLE `inviter` (
  `AC_NUM` int NOT NULL,
  `PRA_NUM` smallint NOT NULL,
  `SPECIALISTEON` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE `medicament` (
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `MED_NOMCOMMERCIAL` varchar(25) DEFAULT NULL,
  `FAM_CODE` varchar(3) NOT NULL,
  `MED_COMPOSITION` varchar(255) DEFAULT NULL,
  `MED_EFFETS` varchar(255) DEFAULT NULL,
  `MED_CONTREINDIC` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`MED_DEPOTLEGAL`, `MED_NOMCOMMERCIAL`, `FAM_CODE`, `MED_COMPOSITION`, `MED_EFFETS`, `MED_CONTREINDIC`) VALUES
('3MYC7', 'TRIMYCINE', 'CRT', 'Triamcinolone (acétonide) + Néomycine + Nystatine', 'Ce médicament est un corticoïde à  activité forte ou très forte associé à  un antibiotique et un antifongique, utilisé en application locale dans certaines atteintes cutanées surinfectées.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, d\'infections de la peau ou de parasitisme non traités, d\'acné. Ne pas appliquer sur une plaie, ni sous un pansement occlusif.'),
('ADIMOL9', 'ADIMOL', 'ABP', 'Amoxicilline + Acide clavulanique', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines ou aux céphalosporines.'),
('AMOPIL7', 'AMOPIL', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines. Il doit être administré avec prudence en cas d\'allergie aux céphalosporines.'),
('AMOX45', 'AMOXAR', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'La prise de ce médicament peut rendre positifs les tests de dépistage du dopage.'),
('AMOXIG12', 'AMOXI Gé', 'ABP', 'Amoxicilline', 'Ce médicament, plus puissant que les pénicillines simples, est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux pénicillines. Il doit être administré avec prudence en cas d\'allergie aux céphalosporines.'),
('APATOUX22', 'APATOUX Vitamine C', 'ALO', 'Tyrothricine + Tétracaïne + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, en cas de phénylcétonurie et chez l\'enfant de moins de 6 ans.'),
('BACTIG10', 'BACTIGEL', 'ABC', 'Erythromycine', 'Ce médicament est utilisé en application locale pour traiter l\'acné et les infections cutanées bactériennes associées.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antibiotiques de la famille des macrolides ou des lincosanides.'),
('BACTIV13', 'BACTIVIL', 'AFM', 'Erythromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).'),
('BITALV', 'BIVALIC', 'AAA', 'Dextropropoxyphène + Paracétamol', 'Ce médicament est utilisé pour traiter les douleurs d\'intensité modérée ou intense.', 'Ce médicament est contre-indiqué en cas d\'allergie aux médicaments de cette famille, d\'insuffisance hépatique ou d\'insuffisance rénale.'),
('CARTION6', 'CARTION', 'AAA', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas de troubles de la coagulation (tendances aux hémorragies), d\'ulcère gastroduodénal, maladies graves du foie.'),
('CLAZER6', 'CLAZER', 'AFM', 'Clarithromycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques. Il est également utilisé dans le traitement de l\'ulcère gastro-duodénal, en association avec d\'autres médicaments.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).'),
('DEPRIL9', 'DEPRAMIL', 'AIM', 'Clomipramine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères, certaines douleurs rebelles, les troubles obsessionnels compulsifs et certaines énurésies chez l\'enfant.', 'Ce médicament est contre-indiqué en cas de glaucome ou d\'adénome de la prostate, d\'infarctus récent, ou si vous avez reà§u un traitement par IMAO durant les 2 semaines précédentes ou en cas d\'allergie aux antidépresseurs imipraminiques.'),
('DIMIRTAM6', 'DIMIRTAM', 'AAC', 'Mirtazapine', 'Ce médicament est utilisé pour traiter les épisodes dépressifs sévères.', 'La prise de ce produit est contre-indiquée en cas de d\'allergie à  l\'un des constituants.'),
('DOLRIL7', 'DOLORIL', 'AAA', 'Acide acétylsalicylique (aspirine) + Acide ascorbique (Vitamine C) + Paracétamol', 'Ce médicament est utilisé dans le traitement symptomatique de la douleur ou de la fièvre.', 'Ce médicament est contre-indiqué en cas d\'allergie au paracétamol ou aux salicylates.'),
('DORNOM8', 'NORMADOR', 'HYP', 'Doxylamine', 'Ce médicament est utilisé pour traiter l\'insomnie chez l\'adulte.', 'Ce médicament est contre-indiqué en cas de glaucome, de certains troubles urinaires (rétention urinaire) et chez l\'enfant de moins de 15 ans.'),
('EQUILARX6', 'EQUILAR', 'AAH', 'Méclozine', 'Ce médicament est utilisé pour traiter les vertiges et pour prévenir le mal des transports.', 'Ce médicament ne doit pas être utilisé en cas d\'allergie au produit, en cas de glaucome ou de rétention urinaire.'),
('EVILR7', 'EVEILLOR', 'PSA', 'Adrafinil', 'Ce médicament est utilisé pour traiter les troubles de la vigilance et certains symptomes neurologiques chez le sujet agé.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants.'),
('INSXT5', 'INSECTIL', 'AH', 'Diphénydramine', 'Ce médicament est utilisé en application locale sur les piqûres d\'insecte et l\'urticaire.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antihistaminiques.'),
('JOVAI8', 'JOVENIL', 'AFM', 'Josamycine', 'Ce médicament est utilisé pour traiter des infections bactériennes spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie aux macrolides (dont le chef de file est l\'érythromycine).'),
('LIDOXY23', 'LIDOXYTRACINE', 'AFC', 'Oxytétracycline +Lidocaïne', 'Ce médicament est utilisé en injection intramusculaire pour traiter certaines infections spécifiques.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants. Il ne doit pas être associé aux rétinoïdes.'),
('LITHOR12', 'LITHORINE', 'AP', 'Lithium', 'Ce médicament est indiqué dans la prévention des psychoses maniaco-dépressives ou pour traiter les états maniaques.', 'Ce médicament ne doit pas être utilisé si vous êtes allergique au lithium. Avant de prendre ce traitement, signalez à  votre médecin traitant si vous souffrez d\'insuffisance rénale, ou si vous avez un régime sans sel.'),
('PARMOL16', 'PARMOCODEINE', 'AA', 'Codéine + Paracétamol', 'Ce médicament est utilisé pour le traitement des douleurs lorsque des antalgiques simples ne sont pas assez efficaces.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, chez l\'enfant de moins de 15 Kg, en cas d\'insuffisance hépatique ou respiratoire, d\'asthme, de phénylcétonurie et chez la femme qui allaite.'),
('PHYSOI8', 'PHYSICOR', 'PSA', 'Sulbutiamine', 'Ce médicament est utilisé pour traiter les baisses d\'activité physique ou psychique, souvent dans un contexte de dépression.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants.'),
('PIRIZ8', 'PIRIZAN', 'ABA', 'Pyrazinamide', 'Ce médicament est utilisé, en association à  d\'autres antibiotiques, pour traiter la tuberculose.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants, d\'insuffisance rénale ou hépatique, d\'hyperuricémie ou de porphyrie.'),
('POMDI20', 'POMADINE', 'AO', 'Bacitracine', 'Ce médicament est utilisé pour traiter les infections oculaires de la surface de l\'oeil.', 'Ce médicament est contre-indiqué en cas d\'allergie aux antibiotiques appliqués localement.'),
('TROXT21', 'TROXADET', 'AIN', 'Paroxétine', 'Ce médicament est utilisé pour traiter la dépression et les troubles obsessionnels compulsifs. Il peut également être utilisé en prévention des crises de panique avec ou sans agoraphobie.', 'Ce médicament est contre-indiqué en cas d\'allergie au produit.'),
('TXISOL22', 'TOUXISOL Vitamine C', 'ALO', 'Tyrothricine + Acide ascorbique (Vitamine C)', 'Ce médicament est utilisé pour traiter les affections de la bouche et de la gorge.', 'Ce médicament est contre-indiqué en cas d\'allergie à  l\'un des constituants et chez l\'enfant de moins de 6 ans.'),
('URIEG6', 'URIREGUL', 'AUM', 'Fosfomycine trométamol', 'Ce médicament est utilisé pour traiter les infections urinaires simples chez la femme de moins de 65 ans.', 'La prise de ce médicament est contre-indiquée en cas d\'allergie à  l\'un des constituants et d\'insuffisance rénale.');

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

CREATE TABLE `motif` (
  `MOT_CODE` varchar(5) NOT NULL,
  `MOT_LIBELLE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `motif`
--

INSERT INTO `motif` (`MOT_CODE`, `MOT_LIBELLE`) VALUES
('ACTAN', 'Actualisation annuelle'),
('AUTMO', 'Autre motif'),
('BAIAC', 'Baisse activité'),
('RAPAN', 'Rapport annuel'),
('RELAN', 'Relance'),
('SOLPR', 'Sollicitation praticien');

-- --------------------------------------------------------

--
-- Structure de la table `offrir`
--

CREATE TABLE `offrir` (
  `COL_MATRICULE` varchar(10) NOT NULL,
  `RAP_NUM` int NOT NULL,
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `OFF_QTE` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `offrir`
--

INSERT INTO `offrir` (`COL_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`, `OFF_QTE`) VALUES
('a131', 21, 'JOVAI8', 2),
('a131', 22, 'EQUILARX6', 2),
('a131', 25, 'EVILR7', 2),
('a131', 25, 'JOVAI8', 10);

-- --------------------------------------------------------

--
-- Structure de la table `praticien`
--

CREATE TABLE `praticien` (
  `PRA_NUM` smallint NOT NULL,
  `PRA_NOM` varchar(25) DEFAULT NULL,
  `PRA_PRENOM` varchar(30) DEFAULT NULL,
  `PRA_ADRESSE` varchar(50) DEFAULT NULL,
  `PRA_CP` varchar(5) DEFAULT NULL,
  `PRA_VILLE` varchar(25) DEFAULT NULL,
  `PRA_COEFNOTORIETE` float DEFAULT NULL,
  `PRA_COEFCONFIANCE` float DEFAULT NULL,
  `TYP_CODE` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `praticien`
--

INSERT INTO `praticien` (`PRA_NUM`, `PRA_NOM`, `PRA_PRENOM`, `PRA_ADRESSE`, `PRA_CP`, `PRA_VILLE`, `PRA_COEFNOTORIETE`, `PRA_COEFCONFIANCE`, `TYP_CODE`) VALUES
(1, 'Notini', 'Alain', '114 r Authie', '85000', 'LA ROCHE SUR YON', 290.03, 9, 'MH'),
(2, 'Gosselin', 'Albert', '13 r Devon', '41000', 'BLOIS', 307.49, 10, 'MV'),
(3, 'Delahaye', 'André', '36 av 6 Juin', '25000', 'BESANCON', 185.79, 8, 'PS'),
(4, 'Leroux', 'André', '47 av Robert Schuman', '60000', 'BEAUVAIS', 172.04, 7, 'PH'),
(5, 'Desmoulins', 'Anne', '31 r St Jean', '30000', 'NIMES', 94.75, 6, 'PO'),
(6, 'Mouel', 'Anne', '27 r Auvergne', '80000', 'AMIENS', 45.2, 5, 'MH'),
(7, 'Desgranges-Lentz', 'Antoine', '1 r Albert de Mun', '29000', 'MORLAIX', 20.07, 3, 'MV'),
(8, 'Marcouiller', 'Arnaud', '31 r St Jean', '68000', 'MULHOUSE', 396.52, 15, 'PS'),
(9, 'Dupuy', 'Benoit', '9 r Demolombe', '34000', 'MONTPELLIER', 395.66, 14, 'PH'),
(10, 'Lerat', 'Bernard', '31 r St Jean', '59000', 'LILLE', 257.79, 8, 'PO'),
(11, 'Marçais-Lefebvre', 'Bertrand', '86Bis r Basse', '67000', 'STRASBOURG', 450.96, 18, 'MH'),
(12, 'Boscher', 'Bruno', '94 r Falaise', '10000', 'TROYES', 356.14, 13, 'MV'),
(13, 'Morel', 'Catherine', '21 r Chateaubriand', '75000', 'PARIS', 379.57, 14, 'PS'),
(14, 'Guivarch', 'Chantal', '4 av Gén Laperrine', '45000', 'ORLEANS', 114.56, 6, 'PH'),
(15, 'Bessin-Grosdoit', 'Christophe', '92 r Falaise', '6000', 'NICE', 222.06, 7, 'PO'),
(16, 'Rossa', 'Claire', '14 av Thiès', '6000', 'NICE', 529.78, 20, 'MH'),
(17, 'Cauchy', 'Denis', '5 av Ste Thérèse', '11000', 'NARBONNE', 458.82, 17, 'MV'),
(18, 'Gaffé', 'Dominique', '9 av 1ère Armée Française', '35000', 'RENNES', 213.4, 6, 'PS'),
(19, 'Guenon', 'Dominique', '98 bd Mar Lyautey', '44000', 'NANTES', 175.89, 15, 'PH'),
(20, 'Prévot', 'Dominique', '29 r Lucien Nelle', '87000', 'LIMOGES', 151.36, 10, 'PO'),
(21, 'Houchard', 'Eliane', '9 r Demolombe', '49100', 'ANGERS', 436.96, 18, 'MH'),
(22, 'Desmons', 'Elisabeth', '51 r Bernières', '29000', 'QUIMPER', 281.17, 20, 'MV'),
(23, 'Flament', 'Elisabeth', '11 r Pasteur', '35000', 'RENNES', 315.6, 15, 'PS'),
(24, 'Goussard', 'Emmanuel', '9 r Demolombe', '41000', 'BLOIS', 40.72, 5, 'PH'),
(25, 'Desprez', 'Eric', '9 r Vaucelles', '33000', 'BORDEAUX', 406.85, 16, 'PO'),
(26, 'Coste', 'Evelyne', '29 r Lucien Nelle', '19000', 'TULLE', 441.87, 18, 'MH'),
(27, 'Lefebvre', 'Frédéric', '2 pl Wurzburg', '55000', 'VERDUN', 573.63, 17, 'MV'),
(28, 'Lemée', 'Frédéric', '29 av 6 Juin', '56000', 'VANNES', 326.4, 13, 'PS'),
(29, 'Martin', 'Frédéric', 'Bât A 90 r Bayeux', '70000', 'VESOUL', 506.06, 22, 'PH'),
(30, 'Marie', 'Frédérique', '172 r Caponière', '70000', 'VESOUL', 313.31, 15, 'PO'),
(31, 'Rosenstech', 'Geneviève', '27 r Auvergne', '75000', 'PARIS', 366.82, 14, 'MH'),
(32, 'Pontavice', 'Ghislaine', '8 r Gaillon', '86000', 'POITIERS', 265.58, 15, 'MV'),
(33, 'Leveneur-Mosquet', 'Guillaume', '47 av Robert Schuman', '64000', 'PAU', 184.97, 18, 'PS'),
(34, 'Blanchais', 'Guy', '30 r Authie', '8000', 'SEDAN', 502.48, 17, 'PH'),
(35, 'Leveneur', 'Hugues', '7 pl St Gilles', '62000', 'ARRAS', 7.39, 9, 'PO'),
(36, 'Mosquet', 'Isabelle', '22 r Jules Verne', '76000', 'ROUEN', 77.1, 15, 'MH'),
(37, 'Giraudon', 'Jean-Christophe', '1 r Albert de Mun', '38100', 'VIENNE', 92.62, 20, 'MV'),
(38, 'Marie', 'Jean-Claude', '26 r Hérouville', '69000', 'LYON', 120.1, 19, 'PS'),
(39, 'Maury', 'Jean-François', '5 r Pierre Girard', '71000', 'CHALON SUR SAONE', 13.73, 10, 'PH'),
(40, 'Dennel', 'Jean-Louis', '7 pl St Gilles', '28000', 'CHARTRES', 550.69, 25, 'PO'),
(41, 'Ain', 'Jean-Pierre', '4 résid Olympia', '2000', 'LAON', 5.59, 8, 'MH'),
(42, 'Chemery', 'Jean-Pierre', '51 pl Ancienne Boucherie', '14000', 'CAEN', 396.58, 16, 'MV'),
(43, 'Comoz', 'Jean-Pierre', '35 r Auguste Lechesne', '18000', 'BOURGES', 340.35, 18, 'PS'),
(44, 'Desfaudais', 'Jean-Pierre', '7 pl St Gilles', '29000', 'BREST', 71.76, 14, 'PH'),
(45, 'Phan', 'JérÃ´me', '9 r Clos Caillet', '79000', 'NIORT', 451.61, 23, 'PO'),
(46, 'Riou', 'Line', '43 bd Gén Vanier', '77000', 'MARNE LA VALLEE', 193.25, 17, 'MH'),
(47, 'Chubilleau', 'Louis', '46 r Eglise', '17000', 'SAINTES', 202.07, 16, 'MV'),
(48, 'Lebrun', 'Lucette', '178 r Auge', '54000', 'NANCY', 410.41, 19, 'PS'),
(49, 'Goessens', 'Marc', '6 av 6 Juin', '39000', 'DOLE', 548.57, 25, 'PH'),
(50, 'Laforge', 'Marc', '5 résid Prairie', '50000', 'SAINT LO', 265.05, 17, 'PO'),
(51, 'Millereau', 'Marc', '36 av 6 Juin', '72000', 'LA FERTE BERNARD', 430.42, 18, 'MH'),
(52, 'Dauverne', 'Marie-Christine', '69 av Charlemagne', '21000', 'DIJON', 281.05, 22, 'MV'),
(53, 'Vittorio', 'Myriam', '3 pl Champlain', '94000', 'BOISSY SAINT LEGER', 356.23, 7, 'PS'),
(54, 'Lapasset', 'Nhieu', '31 av 6 Juin', '52000', 'CHAUMONT', 107, 24, 'PH'),
(55, 'Plantet-Besnier', 'Nicole', '10 av 1ère Armée Française', '86000', 'CHATELLEREAULT', 369.94, 22, 'PO'),
(56, 'Chubilleau', 'Pascal', '3 r Hastings', '15000', 'AURRILLAC', 290.75, 15, 'MH'),
(57, 'Robert', 'Pascal', '31 r St Jean', '93000', 'BOBIGNY', 162.41, 12, 'MV'),
(58, 'Jean', 'Pascale', '114 r Authie', '49100', 'SAUMUR', 375.52, 18, 'PS'),
(59, 'Chanteloube', 'Patrice', '14 av Thiès', '13000', 'MARSEILLE', 478.01, 16, 'PH'),
(60, 'Lecuirot', 'Patrice', 'résid St Pères 55 r Pigacière', '54000', 'NANCY', 239.66, 21, 'PO'),
(61, 'Gandon', 'Patrick', '47 av Robert Schuman', '37000', 'TOURS', 599.06, 25, 'MH'),
(62, 'Mirouf', 'Patrick', '22 r Puits Picard', '74000', 'ANNECY', 458.42, 19, 'MV'),
(63, 'Boireaux', 'Philippe', '14 av Thiès', '10000', 'CHALON EN CHAMPAGNE', 454.48, 23, 'PS'),
(64, 'Cendrier', 'Philippe', '7 pl St Gilles', '12000', 'RODEZ', 164.16, 14, 'PH'),
(65, 'Duhamel', 'Philippe', '114 r Authie', '34000', 'MONTPELLIER', 98.62, 12, 'PO'),
(66, 'Grigy', 'Philippe', '15 r Mélingue', '44000', 'CLISSON', 285.1, 13, 'MH'),
(67, 'Linard', 'Philippe', '1 r Albert de Mun', '81000', 'ALBI', 486.3, 15, 'MV'),
(68, 'Lozier', 'Philippe', '8 r Gaillon', '31000', 'TOULOUSE', 48.4, 8, 'PS'),
(69, 'Dechâtre', 'Pierre', '63 av Thiès', '23000', 'MONTLUCON', 253.75, 18, 'PH'),
(70, 'Goessens', 'Pierre', '22 r Jean Romain', '40000', 'MONT DE MARSAN', 426.19, 17, 'PO'),
(71, 'Leménager', 'Pierre', '39 av 6 Juin', '57000', 'METZ', 118.7, 13, 'MH'),
(72, 'Née', 'Pierre', '39 av 6 Juin', '82000', 'MONTAUBAN', 72.54, 9, 'MV'),
(73, 'Guyot', 'Pierre-Laurent', '43 bd Gén Vanier', '48000', 'MENDE', 352.31, 19, 'PS'),
(74, 'Chauchard', 'Roger', '9 r Vaucelles', '13000', 'MARSEILLE', 552.19, 25, 'PH'),
(75, 'Mabire', 'Roland', '11 r Boutiques', '67000', 'STRASBOURG', 422.39, 24, 'PO'),
(76, 'Leroy', 'Soazig', '45 r Boutiques', '61000', 'ALENCON', 570.67, 25, 'MH'),
(77, 'Guyot', 'Stéphane', '26 r Hérouville', '46000', 'FIGEAC', 28.85, 9, 'MV'),
(78, 'Delposen', 'Sylvain', '39 av 6 Juin', '27000', 'DREUX', 292.01, 16, 'PS'),
(79, 'Rault', 'Sylvie', '15 bd Richemond', '2000', 'SOISSON', 526.6, 22, 'PH'),
(80, 'Renouf', 'Sylvie', '98 bd Mar Lyautey', '88000', 'EPINAL', 425.24, 25, 'PO'),
(81, 'Alliet-Grach', 'Thierry', '14 av Thiès', '7000', 'PRIVAS', 451.31, 25, 'MH'),
(82, 'Bayard', 'Thierry', '92 r Falaise', '42000', 'SAINT ETIENNE', 271.71, 18, 'MV'),
(83, 'Gauchet', 'Thierry', '7 r Desmoueux', '38100', 'GRENOBLE', 406.1, 22, 'PS'),
(84, 'Bobichon', 'Tristan', '219 r Caponière', '9000', 'FOIX', 218.36, 17, 'PH'),
(85, 'Duchemin-Laniel', 'Véronique', '130 r St Jean', '33000', 'LIBOURNE', 265.61, 16, 'PO'),
(86, 'Laurent', 'Younès', '34 r Demolombe', '53000', 'MAYENNE', 496.1, 23, 'MH');

-- --------------------------------------------------------

--
-- Structure de la table `prescrire`
--

CREATE TABLE `prescrire` (
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `TIN_CODE` varchar(5) NOT NULL,
  `DOS_CODE` varchar(10) NOT NULL,
  `PRE_POSOLOGIE` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

CREATE TABLE `presentation` (
  `PRE_CODE` varchar(2) NOT NULL,
  `PRE_LIBELLE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `presenter`
--

CREATE TABLE `presenter` (
  `MED_DEPOTLEGAL` varchar(10) NOT NULL,
  `COL_MATRICULE` varchar(10) NOT NULL,
  `RAP_NUM` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `presenter`
--

INSERT INTO `presenter` (`MED_DEPOTLEGAL`, `COL_MATRICULE`, `RAP_NUM`) VALUES
('JOVAI8', 'a131', 21),
('ADIMOL9', 'a131', 22),
('INSXT5', 'a131', 25),
('JOVAI8', 'a131', 25);

-- --------------------------------------------------------

--
-- Structure de la table `rapport_visite`
--

CREATE TABLE `rapport_visite` (
  `COL_MATRICULE` varchar(10) NOT NULL,
  `RAP_NUM` int NOT NULL,
  `PRA_NUM` smallint NOT NULL,
  `PRA_NUM_REMPLACANT` smallint DEFAULT NULL,
  `RAP_DATE_VISITE` date DEFAULT NULL,
  `RAP_DATE_SAISIE` date DEFAULT NULL,
  `RAP_BILAN` varchar(255) DEFAULT NULL,
  `RAP_MOTIF_AUTRE` varchar(255) DEFAULT NULL,
  `MOT_CODE` varchar(5) NOT NULL,
  `RAP_DOCUMENTATION` tinyint(1) NOT NULL,
  `RAP_SAISIEDEFINITIVE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `rapport_visite`
--

INSERT INTO `rapport_visite` (`COL_MATRICULE`, `RAP_NUM`, `PRA_NUM`, `PRA_NUM_REMPLACANT`, `RAP_DATE_VISITE`, `RAP_DATE_SAISIE`, `RAP_BILAN`, `RAP_MOTIF_AUTRE`, `MOT_CODE`, `RAP_DOCUMENTATION`, `RAP_SAISIEDEFINITIVE`) VALUES
('a131', 16, 42, 15, '2025-06-11', '2025-12-12', 'medoc', '', 'SOLPR', 1, 1),
('a131', 17, 12, 42, '2025-12-17', '2025-12-19', 'c\'est nul ', 'a revoir ', 'BAIAC', 0, 1),
('a131', 20, 41, 64, '2026-01-08', '2025-12-19', 'aie aie', 'defecit ', 'BAIAC', 0, 1),
('a131', 21, 41, 63, '2026-01-17', '2025-12-19', 'tes', 'defecit ', 'AUTMO', 0, 1),
('a131', 22, 63, 84, '2026-01-07', '2025-12-19', '', 'a revoir ', 'AUTMO', 0, 0),
('a131', 23, 15, 82, '2026-01-15', '2025-12-19', '', 'a revoir ', 'ACTAN', 0, 0),
('a131', 24, 41, 41, '2026-01-31', '2025-12-19', 'hgh', '', 'BAIAC', 0, 0),
('a131', 25, 43, 63, '2026-01-21', '2025-12-19', '7', 'a revoir ', 'AUTMO', 1, 0),
('a17', 1, 63, 41, '2026-03-21', '2026-03-16', '				', 'ok', 'ACTAN', 0, 1),
('a17', 2, 63, 84, '2026-03-19', '2026-03-16', '', 'ok', 'ACTAN', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `realiser`
--

CREATE TABLE `realiser` (
  `AC_NUM` int NOT NULL,
  `COL_MATRICULE` varchar(10) NOT NULL,
  `REA_MTTFRAIS` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `REG_CODE` varchar(2) NOT NULL,
  `SEC_CODE` varchar(1) NOT NULL,
  `REG_NOM` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`REG_CODE`, `SEC_CODE`, `REG_NOM`) VALUES
('AL', 'E', 'Alsace Lorraine'),
('AQ', 'S', 'Aquitaine'),
('AU', 'P', 'Auvergne'),
('BG', 'O', 'Bretagne'),
('BN', 'O', 'Basse Normandie'),
('BO', 'E', 'Bourgogne'),
('CA', 'N', 'Champagne Ardennes'),
('CE', 'P', 'Centre'),
('FC', 'E', 'Franche Comté'),
('HN', 'N', 'Haute Normandie'),
('IF', 'P', 'Ile de France'),
('LG', 'S', 'Languedoc'),
('LI', 'P', 'Limousin'),
('MP', 'S', 'Midi Pyrénée'),
('NP', 'N', 'Nord Pas de Calais'),
('PA', 'S', 'Provence Alpes Cote d\'Azur'),
('PC', 'O', 'Poitou Charente'),
('PI', 'N', 'Picardie'),
('PL', 'O', 'Pays de Loire'),
('RA', 'E', 'Rhone Alpes'),
('RO', 'S', 'Roussilon'),
('VD', 'O', 'Vendée');

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `RES_MATRICULE` varchar(10) NOT NULL,
  `SEC_CODE` varchar(1) DEFAULT NULL,
  `RES_DATENOMINATION` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`RES_MATRICULE`, `SEC_CODE`, `RES_DATENOMINATION`) VALUES
('b34', 'P', '2003-01-01'),
('c14', 'S', '2015-01-02'),
('d51', 'E', '2000-07-01'),
('g30', 'N', '2013-09-01'),
('p40', 'O', '2010-07-01');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `SEC_CODE` varchar(1) NOT NULL,
  `SEC_LIBELLE` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`SEC_CODE`, `SEC_LIBELLE`) VALUES
('E', 'Est'),
('N', 'Nord'),
('O', 'Ouest'),
('P', 'Paris centre'),
('S', 'Sud');

-- --------------------------------------------------------

--
-- Structure de la table `travailler`
--

CREATE TABLE `travailler` (
  `COL_MATRICULE` varchar(10) NOT NULL,
  `DATE_DEBUT` date NOT NULL,
  `REG_CODE` varchar(2) NOT NULL,
  `DATE_FIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `travailler`
--

INSERT INTO `travailler` (`COL_MATRICULE`, `DATE_DEBUT`, `REG_CODE`, `DATE_FIN`) VALUES
('d51', '1985-03-01', 'RO', '2000-06-30'),
('p49', '1987-10-03', 'CE', NULL),
('g30', '1988-06-15', 'IF', '2013-08-31'),
('c14', '1990-09-01', 'BG', '2015-01-31'),
('p40', '1992-07-10', 'BN', '2010-06-30'),
('k53', '1993-03-23', 'AL', '2002-04-02'),
('r24', '1994-07-29', 'BG', '2008-05-24'),
('b34', '1995-01-15', 'AL', '2002-12-31'),
('g53', '1995-10-02', 'BG', '2009-03-26'),
('a55', '1997-07-17', 'RA', '2005-05-18'),
('m35', '1997-10-06', 'MP', NULL),
('e39', '1998-04-26', 'IF', NULL),
('c3', '1999-02-01', 'PA', '2002-05-04'),
('e22', '1999-03-24', 'AL', '2012-03-19'),
('p7', '2000-03-01', 'RO', NULL),
('r58', '2000-06-30', 'BG', NULL),
('m45', '2000-10-13', 'HN', '2009-04-07'),
('e5', '2000-11-27', 'MP', '2005-11-26'),
('t60', '2001-03-29', 'CE', NULL),
('c54', '2001-04-09', 'AL', '2011-03-02'),
('p8', '2001-06-23', 'BO', NULL),
('a17', '2001-08-26', 'LI', '2007-09-18'),
('e52', '2001-10-31', 'HN', NULL),
('d13', '2001-12-05', 'PL', NULL),
('k53', '2002-04-03', 'CA', NULL),
('c3', '2002-05-05', 'CA', NULL),
('n58', '2002-08-30', 'CE', NULL),
('s21', '2002-09-25', 'LI', NULL),
('h40', '2002-11-01', 'CA', NULL),
('a131', '2002-12-11', 'BN', NULL),
('p42', '2002-12-14', 'BN', '2004-12-11'),
('j50', '2002-12-16', 'NP', NULL),
('p32', '2002-12-24', 'IF', NULL),
('h13', '2003-05-08', 'LI', NULL),
('e24', '2003-05-17', 'BG', '2012-02-28'),
('f21', '2003-06-08', 'RA', NULL),
('h35', '2003-08-26', 'AU', NULL),
('b25', '2003-12-06', 'CE', '2004-07-02'),
('f4', '2004-05-03', 'MP', NULL),
('b25', '2004-07-03', 'PL', '2009-06-17'),
('t55', '2004-11-29', 'MP', NULL),
('p42', '2004-12-12', 'PI', NULL),
('n59', '2004-12-19', 'PI', NULL),
('o26', '2005-01-05', 'LG', NULL),
('l14', '2005-02-02', 'PL', NULL),
('t43', '2005-03-09', 'BO', '2006-05-26'),
('a55', '2005-05-19', 'MP', '2009-08-20'),
('l23', '2005-06-05', 'PC', NULL),
('b59', '2005-10-21', 'RA', NULL),
('s10', '2005-11-14', 'FC', NULL),
('e5', '2005-11-27', 'PA', '2010-11-26'),
('g7', '2006-01-13', 'LI', NULL),
('g19', '2006-01-18', 'IF', NULL),
('e49', '2006-02-19', 'MP', NULL),
('l56', '2006-02-27', 'FC', NULL),
('n42', '2006-03-06', 'HN', NULL),
('b13', '2006-03-11', 'AL', NULL),
('t43', '2006-05-27', 'BG', NULL),
('k4', '2006-11-21', 'LG', NULL),
('l46', '2007-01-24', 'PL', NULL),
('c14', '2007-02-01', 'PA', NULL),
('f39', '2007-02-15', 'RA', NULL),
('b16', '2007-03-21', 'BG', NULL),
('p6', '2007-03-30', 'AQ', NULL),
('t47', '2007-08-29', 'PI', NULL),
('q17', '2007-09-06', 'BN', NULL),
('a17', '2007-09-19', 'RA', NULL),
('b4', '2007-09-25', 'AQ', NULL),
('b50', '2008-01-18', 'PA', NULL),
('j45', '2008-02-25', 'FC', NULL),
('h30', '2008-04-26', 'IF', NULL),
('r24', '2008-05-25', 'BN', NULL),
('j8', '2008-06-18', 'IF', NULL),
('p41', '2008-07-27', 'PC', NULL),
('a93', '2009-01-02', 'PC', NULL),
('b19', '2009-01-31', 'PL', NULL),
('g53', '2009-03-27', 'PL', '2010-10-30'),
('m45', '2009-04-08', 'AL', NULL),
('b25', '2009-06-18', 'CE', NULL),
('a55', '2009-08-21', 'RO', NULL),
('b28', '2010-08-02', 'LG', NULL),
('g53', '2010-10-31', 'PI', NULL),
('e5', '2010-11-27', 'AQ', NULL),
('c54', '2011-03-03', 'PA', NULL),
('e24', '2012-02-29', 'AL', NULL),
('e22', '2012-03-20', 'FC', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_individu`
--

CREATE TABLE `type_individu` (
  `TIN_CODE` varchar(5) NOT NULL,
  `TIN_LIBELLE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `type_praticien`
--

CREATE TABLE `type_praticien` (
  `TYP_CODE` varchar(3) NOT NULL,
  `TYP_LIBELLE` varchar(25) DEFAULT NULL,
  `TYP_LIEU` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type_praticien`
--

INSERT INTO `type_praticien` (`TYP_CODE`, `TYP_LIBELLE`, `TYP_LIEU`) VALUES
('MH', 'Médecin Hospitalier', 'Hopital ou clinique'),
('MV', 'Médecine de Ville', 'Cabinet'),
('PH', 'Pharmacien Hospitalier', 'Hopital ou clinique'),
('PO', 'Pharmacien Officine', 'Pharmacie'),
('PS', 'Personnel de santé', 'Centre paramédical');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite_compl`
--
ALTER TABLE `activite_compl`
  ADD PRIMARY KEY (`AC_NUM`);

--
-- Index pour la table `collaborateur`
--
ALTER TABLE `collaborateur`
  ADD PRIMARY KEY (`COL_MATRICULE`);

--
-- Index pour la table `composant`
--
ALTER TABLE `composant`
  ADD PRIMARY KEY (`CMP_CODE`);

--
-- Index pour la table `constituer`
--
ALTER TABLE `constituer`
  ADD PRIMARY KEY (`MED_DEPOTLEGAL`,`CMP_CODE`),
  ADD KEY `CMP_CODE` (`CMP_CODE`);

--
-- Index pour la table `delegue_regional`
--
ALTER TABLE `delegue_regional`
  ADD PRIMARY KEY (`DEL_MATRICULE`),
  ADD KEY `REG_CODE` (`REG_CODE`);

--
-- Index pour la table `dosage`
--
ALTER TABLE `dosage`
  ADD PRIMARY KEY (`DOS_CODE`);

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`FAM_CODE`);

--
-- Index pour la table `formuler`
--
ALTER TABLE `formuler`
  ADD PRIMARY KEY (`MED_DEPOTLEGAL`,`PRE_CODE`),
  ADD KEY `PRE_CODE` (`PRE_CODE`);

--
-- Index pour la table `interagir`
--
ALTER TABLE `interagir`
  ADD PRIMARY KEY (`MED_PERTURBATEUR`,`MED_PERTURBE`),
  ADD KEY `MED_PERTURBE` (`MED_PERTURBE`);

--
-- Index pour la table `inviter`
--
ALTER TABLE `inviter`
  ADD PRIMARY KEY (`AC_NUM`,`PRA_NUM`),
  ADD KEY `PRA_NUM` (`PRA_NUM`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`MED_DEPOTLEGAL`),
  ADD KEY `FAM_CODE` (`FAM_CODE`);

--
-- Index pour la table `motif`
--
ALTER TABLE `motif`
  ADD PRIMARY KEY (`MOT_CODE`);

--
-- Index pour la table `offrir`
--
ALTER TABLE `offrir`
  ADD PRIMARY KEY (`COL_MATRICULE`,`RAP_NUM`,`MED_DEPOTLEGAL`),
  ADD KEY `MED_DEPOTLEGAL` (`MED_DEPOTLEGAL`);

--
-- Index pour la table `praticien`
--
ALTER TABLE `praticien`
  ADD PRIMARY KEY (`PRA_NUM`),
  ADD KEY `TYP_CODE` (`TYP_CODE`);

--
-- Index pour la table `prescrire`
--
ALTER TABLE `prescrire`
  ADD PRIMARY KEY (`MED_DEPOTLEGAL`,`TIN_CODE`,`DOS_CODE`),
  ADD KEY `TIN_CODE` (`TIN_CODE`),
  ADD KEY `DOS_CODE` (`DOS_CODE`);

--
-- Index pour la table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`PRE_CODE`);

--
-- Index pour la table `presenter`
--
ALTER TABLE `presenter`
  ADD PRIMARY KEY (`MED_DEPOTLEGAL`,`COL_MATRICULE`,`RAP_NUM`),
  ADD KEY `COL_MATRICULE` (`COL_MATRICULE`,`RAP_NUM`);

--
-- Index pour la table `rapport_visite`
--
ALTER TABLE `rapport_visite`
  ADD PRIMARY KEY (`COL_MATRICULE`,`RAP_NUM`),
  ADD KEY `PRA_NUM` (`PRA_NUM`),
  ADD KEY `PRA_NUM_REMPLACANT` (`PRA_NUM_REMPLACANT`),
  ADD KEY `MOT_CODE` (`MOT_CODE`);

--
-- Index pour la table `realiser`
--
ALTER TABLE `realiser`
  ADD PRIMARY KEY (`AC_NUM`,`COL_MATRICULE`),
  ADD KEY `COL_MATRICULE` (`COL_MATRICULE`);

--
-- Index pour la table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`REG_CODE`),
  ADD KEY `SEC_CODE` (`SEC_CODE`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`RES_MATRICULE`),
  ADD KEY `SEC_CODE` (`SEC_CODE`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`SEC_CODE`);

--
-- Index pour la table `travailler`
--
ALTER TABLE `travailler`
  ADD PRIMARY KEY (`DATE_DEBUT`,`COL_MATRICULE`),
  ADD KEY `REG_CODE` (`REG_CODE`),
  ADD KEY `COL_MATRICULE` (`COL_MATRICULE`);

--
-- Index pour la table `type_individu`
--
ALTER TABLE `type_individu`
  ADD PRIMARY KEY (`TIN_CODE`);

--
-- Index pour la table `type_praticien`
--
ALTER TABLE `type_praticien`
  ADD PRIMARY KEY (`TYP_CODE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite_compl`
--
ALTER TABLE `activite_compl`
  MODIFY `AC_NUM` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `constituer`
--
ALTER TABLE `constituer`
  ADD CONSTRAINT `constituer_ibfk_1` FOREIGN KEY (`CMP_CODE`) REFERENCES `composant` (`CMP_CODE`),
  ADD CONSTRAINT `constituer_ibfk_2` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`);

--
-- Contraintes pour la table `delegue_regional`
--
ALTER TABLE `delegue_regional`
  ADD CONSTRAINT `delegue_regional_ibfk_1` FOREIGN KEY (`DEL_MATRICULE`) REFERENCES `collaborateur` (`COL_MATRICULE`),
  ADD CONSTRAINT `delegue_regional_ibfk_2` FOREIGN KEY (`REG_CODE`) REFERENCES `region` (`REG_CODE`);

--
-- Contraintes pour la table `formuler`
--
ALTER TABLE `formuler`
  ADD CONSTRAINT `formuler_ibfk_1` FOREIGN KEY (`PRE_CODE`) REFERENCES `presentation` (`PRE_CODE`),
  ADD CONSTRAINT `formuler_ibfk_2` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`);

--
-- Contraintes pour la table `interagir`
--
ALTER TABLE `interagir`
  ADD CONSTRAINT `interagir_ibfk_1` FOREIGN KEY (`MED_PERTURBATEUR`) REFERENCES `medicament` (`MED_DEPOTLEGAL`),
  ADD CONSTRAINT `interagir_ibfk_2` FOREIGN KEY (`MED_PERTURBE`) REFERENCES `medicament` (`MED_DEPOTLEGAL`);

--
-- Contraintes pour la table `inviter`
--
ALTER TABLE `inviter`
  ADD CONSTRAINT `inviter_ibfk_1` FOREIGN KEY (`AC_NUM`) REFERENCES `activite_compl` (`AC_NUM`),
  ADD CONSTRAINT `inviter_ibfk_2` FOREIGN KEY (`PRA_NUM`) REFERENCES `praticien` (`PRA_NUM`);

--
-- Contraintes pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD CONSTRAINT `medicament_ibfk_1` FOREIGN KEY (`FAM_CODE`) REFERENCES `famille` (`FAM_CODE`);

--
-- Contraintes pour la table `offrir`
--
ALTER TABLE `offrir`
  ADD CONSTRAINT `offrir_ibfk_1` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`),
  ADD CONSTRAINT `offrir_ibfk_2` FOREIGN KEY (`COL_MATRICULE`,`RAP_NUM`) REFERENCES `rapport_visite` (`COL_MATRICULE`, `RAP_NUM`);

--
-- Contraintes pour la table `praticien`
--
ALTER TABLE `praticien`
  ADD CONSTRAINT `praticien_ibfk_1` FOREIGN KEY (`TYP_CODE`) REFERENCES `type_praticien` (`TYP_CODE`);

--
-- Contraintes pour la table `prescrire`
--
ALTER TABLE `prescrire`
  ADD CONSTRAINT `prescrire_ibfk_1` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`),
  ADD CONSTRAINT `prescrire_ibfk_2` FOREIGN KEY (`TIN_CODE`) REFERENCES `type_individu` (`TIN_CODE`),
  ADD CONSTRAINT `prescrire_ibfk_3` FOREIGN KEY (`DOS_CODE`) REFERENCES `dosage` (`DOS_CODE`);

--
-- Contraintes pour la table `presenter`
--
ALTER TABLE `presenter`
  ADD CONSTRAINT `presenter_ibfk_1` FOREIGN KEY (`MED_DEPOTLEGAL`) REFERENCES `medicament` (`MED_DEPOTLEGAL`),
  ADD CONSTRAINT `presenter_ibfk_2` FOREIGN KEY (`COL_MATRICULE`,`RAP_NUM`) REFERENCES `rapport_visite` (`COL_MATRICULE`, `RAP_NUM`);

--
-- Contraintes pour la table `rapport_visite`
--
ALTER TABLE `rapport_visite`
  ADD CONSTRAINT `rapport_visite_ibfk_1` FOREIGN KEY (`PRA_NUM`) REFERENCES `praticien` (`PRA_NUM`),
  ADD CONSTRAINT `rapport_visite_ibfk_2` FOREIGN KEY (`PRA_NUM_REMPLACANT`) REFERENCES `praticien` (`PRA_NUM`),
  ADD CONSTRAINT `rapport_visite_ibfk_3` FOREIGN KEY (`COL_MATRICULE`) REFERENCES `collaborateur` (`COL_MATRICULE`),
  ADD CONSTRAINT `rapport_visite_ibfk_4` FOREIGN KEY (`MOT_CODE`) REFERENCES `motif` (`MOT_CODE`);

--
-- Contraintes pour la table `realiser`
--
ALTER TABLE `realiser`
  ADD CONSTRAINT `realiser_ibfk_1` FOREIGN KEY (`AC_NUM`) REFERENCES `activite_compl` (`AC_NUM`),
  ADD CONSTRAINT `realiser_ibfk_2` FOREIGN KEY (`COL_MATRICULE`) REFERENCES `collaborateur` (`COL_MATRICULE`);

--
-- Contraintes pour la table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`SEC_CODE`) REFERENCES `secteur` (`SEC_CODE`);

--
-- Contraintes pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD CONSTRAINT `responsable_ibfk_1` FOREIGN KEY (`RES_MATRICULE`) REFERENCES `collaborateur` (`COL_MATRICULE`),
  ADD CONSTRAINT `responsable_ibfk_2` FOREIGN KEY (`SEC_CODE`) REFERENCES `secteur` (`SEC_CODE`);

--
-- Contraintes pour la table `travailler`
--
ALTER TABLE `travailler`
  ADD CONSTRAINT `travailler_ibfk_1` FOREIGN KEY (`REG_CODE`) REFERENCES `region` (`REG_CODE`),
  ADD CONSTRAINT `travailler_ibfk_2` FOREIGN KEY (`COL_MATRICULE`) REFERENCES `collaborateur` (`COL_MATRICULE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
