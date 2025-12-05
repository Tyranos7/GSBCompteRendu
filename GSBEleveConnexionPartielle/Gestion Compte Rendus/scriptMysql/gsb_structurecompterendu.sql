-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
-- > Les n° auto pour des attributs non clé primaire ont été transformés en INTEGER.
-- > Les tables générées sont de type InnoDb.
-- > Les clés étrangères ne sont gérées que si MySql gère les tables InnoDb.
-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
set names 'utf8';
create table `ACTIVITE_COMPL`(`AC_NUM` INT AUTO_INCREMENT not null,`AC_DATE` DATE,`AC_LIEU` VARCHAR(25),`AC_THEME` VARCHAR(10),`AC_MOTIF` VARCHAR(50),primary key(`AC_NUM`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `COMPOSANT`(`CMP_CODE` VARCHAR(4) not null,`CMP_LIBELLE` VARCHAR(25),primary key(`CMP_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `CONSTITUER`(`MED_DEPOTLEGAL` VARCHAR(10) not null,`CMP_CODE` VARCHAR(4) not null,`CST_QTE` FLOAT,primary key(`MED_DEPOTLEGAL`,`CMP_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `DOSAGE`(`DOS_CODE` VARCHAR(10) not null,`DOS_QUANTITE` VARCHAR(10),`DOS_UNITE` VARCHAR(10),primary key(`DOS_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `FAMILLE`(`FAM_CODE` VARCHAR(3) not null,`FAM_LIBELLE` VARCHAR(80),primary key(`FAM_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `FORMULER`(`MED_DEPOTLEGAL` VARCHAR(10) not null,`PRE_CODE` VARCHAR(2) not null,primary key(`MED_DEPOTLEGAL`,`PRE_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `INTERAGIR`(`MED_PERTURBATEUR` VARCHAR(10) not null,`MED_PERTURBE` VARCHAR(10) not null,primary key(`MED_PERTURBATEUR`,`MED_PERTURBE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `INVITER`(`AC_NUM` INT not null,`PRA_NUM` SMALLINT not null,`SPECIALISTEON` TINYINT(1),primary key(`AC_NUM`,`PRA_NUM`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `MEDICAMENT`(`MED_DEPOTLEGAL` VARCHAR(10) not null,`MED_NOMCOMMERCIAL` VARCHAR(25),`FAM_CODE` VARCHAR(3) not null,`MED_COMPOSITION` VARCHAR(255),`MED_EFFETS` VARCHAR(255),`MED_CONTREINDIC` VARCHAR(255),primary key(`MED_DEPOTLEGAL`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `OFFRIR`(`COL_MATRICULE` VARCHAR(10) not null,`RAP_NUM` INT not null,`MED_DEPOTLEGAL` VARCHAR(10) not null,`OFF_QTE` SMALLINT,primary key(`COL_MATRICULE`,`RAP_NUM`,`MED_DEPOTLEGAL`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `PRATICIEN`(`PRA_NUM` SMALLINT not null,`PRA_NOM` VARCHAR(25),`PRA_PRENOM` VARCHAR(30),`PRA_ADRESSE` VARCHAR(50),`PRA_CP` VARCHAR(5),`PRA_VILLE` VARCHAR(25),`PRA_COEFNOTORIETE` FLOAT,`TYP_CODE` VARCHAR(3) not null,primary key(`PRA_NUM`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `PRESCRIRE`(`MED_DEPOTLEGAL` VARCHAR(10) not null,`TIN_CODE` VARCHAR(5) not null,`DOS_CODE` VARCHAR(10) not null,`PRE_POSOLOGIE` VARCHAR(40),primary key(`MED_DEPOTLEGAL`,`TIN_CODE`,`DOS_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `PRESENTATION`(`PRE_CODE` VARCHAR(2) not null,`PRE_LIBELLE` VARCHAR(20),primary key(`PRE_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `RAPPORT_VISITE`(`COL_MATRICULE` VARCHAR(10) not null,`RAP_NUM` INT not null,`PRA_NUM` SMALLINT not null,`RAP_DATE` DATE,`RAP_BILAN` VARCHAR(255),primary key(`COL_MATRICULE`,`RAP_NUM`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `REALISER`(`AC_NUM` INT not null,`COL_MATRICULE` VARCHAR(10) not null,`REA_MTTFRAIS` FLOAT,primary key(`AC_NUM`,`COL_MATRICULE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `REGION`(`REG_CODE` VARCHAR(2) not null,`SEC_CODE` VARCHAR(1) not null,`REG_NOM` VARCHAR(50),primary key(`REG_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `SECTEUR`(`SEC_CODE` VARCHAR(1) not null,`SEC_LIBELLE` VARCHAR(15),primary key(`SEC_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `TRAVAILLER`(`COL_MATRICULE` VARCHAR(10) not null,`DATE_DEBUT` DATE not null,`REG_CODE` VARCHAR(2) not null,`TRA_ROLE` VARCHAR(11),primary key(`DATE_DEBUT`,`COL_MATRICULE`,`REG_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `TYPE_INDIVIDU`(`TIN_CODE` VARCHAR(5) not null,`TIN_LIBELLE` VARCHAR(50),primary key(`TIN_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `TYPE_PRATICIEN`(`TYP_CODE` VARCHAR(3) not null,`TYP_LIBELLE` VARCHAR(25),`TYP_LIEU` VARCHAR(35),primary key(`TYP_CODE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table `COLLABORATEUR`(`COL_MATRICULE` VARCHAR(10) not null,`COL_NOM` VARCHAR(25),`COL_PRENOM` VARCHAR(50),`COL_ADRESSE` VARCHAR(50),`COL_CP` VARCHAR(5),`COL_VILLE` VARCHAR(30),`COL_DATEEMBAUCHE` DATE,`SEC_CODE` VARCHAR(1),`COL_LOGIN` VARCHAR(20),`COL_MDP` VARCHAR(15), primary key(`COL_MATRICULE`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

alter table `PRESCRIRE` add foreign key (`MED_DEPOTLEGAL`) references `MEDICAMENT`(`MED_DEPOTLEGAL`);
alter table `INVITER` add foreign key (`AC_NUM`) references `ACTIVITE_COMPL`(`AC_NUM`);
alter table `PRATICIEN` add foreign key (`TYP_CODE`) references `TYPE_PRATICIEN`(`TYP_CODE`);
alter table `FORMULER` add foreign key (`PRE_CODE`) references `PRESENTATION`(`PRE_CODE`);
alter table `OFFRIR` add foreign key (`MED_DEPOTLEGAL`) references `MEDICAMENT`(`MED_DEPOTLEGAL`);
alter table `PRESCRIRE` add foreign key (`TIN_CODE`) references `TYPE_INDIVIDU`(`TIN_CODE`);
alter table `REGION` add foreign key (`SEC_CODE`) references `SECTEUR`(`SEC_CODE`);
alter table `FORMULER` add foreign key (`MED_DEPOTLEGAL`) references `MEDICAMENT`(`MED_DEPOTLEGAL`);
alter table `OFFRIR` add foreign key (`COL_MATRICULE`,`RAP_NUM`) references `RAPPORT_VISITE`(`COL_MATRICULE`,`RAP_NUM`);
alter table `TRAVAILLER` add foreign key (`REG_CODE`) references `REGION`(`REG_CODE`);
alter table `MEDICAMENT` add foreign key (`FAM_CODE`) references `FAMILLE`(`FAM_CODE`);
alter table `CONSTITUER` add foreign key (`CMP_CODE`) references `COMPOSANT`(`CMP_CODE`);
alter table `RAPPORT_VISITE` add foreign key (`PRA_NUM`) references `PRATICIEN`(`PRA_NUM`);
alter table `TRAVAILLER` add foreign key (`COL_MATRICULE`) references `COLLABORATEUR`(`COL_MATRICULE`);
alter table `RAPPORT_VISITE` add foreign key (`COL_MATRICULE`) references `COLLABORATEUR`(`COL_MATRICULE`);
alter table `CONSTITUER` add foreign key (`MED_DEPOTLEGAL`) references `MEDICAMENT`(`MED_DEPOTLEGAL`);
alter table `INTERAGIR` add foreign key (`MED_PERTURBATEUR`) references `MEDICAMENT`(`MED_DEPOTLEGAL`);
alter table `PRESCRIRE` add foreign key (`DOS_CODE`) references `DOSAGE`(`DOS_CODE`);
alter table `REALISER` add foreign key (`AC_NUM`) references `ACTIVITE_COMPL`(`AC_NUM`);
alter table `INVITER` add foreign key (`PRA_NUM`) references `PRATICIEN`(`PRA_NUM`);
alter table `REALISER` add foreign key (`COL_MATRICULE`) references `COLLABORATEUR`(`COL_MATRICULE`);
alter table `COLLABORATEUR` add foreign key (`SEC_CODE`) references `SECTEUR`(`SEC_CODE`);
alter table `INTERAGIR` add foreign key (`MED_PERTURBE`) references `MEDICAMENT`(`MED_DEPOTLEGAL`);
commit;

