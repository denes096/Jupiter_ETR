CREATE DATABASE Jupiter;

CREATE TABLE `Hallgato` (
  `Azonosito` CHAR(11) NOT NULL,
  `Jelszo` CHAR(32) NOT NULL,
  `Nev` VARCHAR(100) NOT NULL,
  `Email` VARCHAR(100) NOT NULL,
  `SzuletesiDatum` DATE NOT NULL,
  `Nem` VARCHAR(5) NOT NULL,
  `OktatasiAzonosito` CHAR(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Oktato` (
	`Azonosito` CHAR(11) NOT NULL,
	`Jelszo` CHAR(32) NOT NULL,
	`Nev` VARCHAR(100) NOT NULL,
	`Email` VARCHAR(100) NOT NULL,
	`SzuletesiDatum` DATE NOT NULL,
	`Nem` VARCHAR(5) NOT NULL,
	`Intezmeny` VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Admin` (
	`Azonosito` CHAR(11) NOT NULL,
	`Jelszo` CHAR(32) NOT NULL,
	`Nev` VARCHAR(100) NOT NULL,
	`Email` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Targy` (
	`TargyKod` VARCHAR(30) NOT NULL,
	`TargyNev` VARCHAR(100) NOT NULL,
	`Kredit` INT NOT NULL,
	`Tipus` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Kurzus` (
	`KurzusKod` VARCHAR(30) NOT NULL,
	`TargyKod` VARCHAR(30) NOT NULL,
	`Kurzusnev` VARCHAR(100) NOT NULL,
	`Szemeszter` CHAR(11) NOT NULL,
	`Ferohely` INT,
	`Helyszin` VARCHAR(100),
	`Idopont` VARCHAR(100),
	`Megjegyzes` VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Kurzusjelentkezes` (
	`HallgatoAzonosito` CHAR(11) NOT NULL,
	`KurzusKod` VARCHAR(30) NOT NULL,
	`SzakAzonosito` VARCHAR(30) NOT NULL,
	`Erdemjegy` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Vizsga` (
	`VizsgaAzonosito` VARCHAR(30) NOT NULL,
	`KurzusKod` VARCHAR(30) NOT NULL,
	`MaximalisLetszam` INT,
	`Helyszin` VARCHAR(100),
	`Idopont` DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Vizsgajelentkezes` (
	`HallgatoAzonosito` CHAR(11) NOT NULL,
	`VizsgaAzonosito` VARCHAR(30) NOT NULL,
	`Erdemjegy` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Szak` (
	`SzakAzonosito` VARCHAR(30) NOT NULL,
	`Nev` VARCHAR(100) NOT NULL,
	`KepzesHossz` INT NOT NULL,
	`KreditSzam` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Szakadat` (
	`SzakAzonosito` VARCHAR(30) NOT NULL,
	`TargyAzonosito` VARCHAR(30) NOT NULL,
	`AjanlottFelev` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `FelvettSzak` (
	`HallgatoAzonosito` CHAR(11) NOT NULL,
	`SzakAzonosito` VARCHAR(30) NOT NULL,
	`Kezdes` CHAR(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Elofeltetel` (
	`TargyKod` VARCHAR(30) NOT NULL,
	`Elofeltetel` VARCHAR(30) NOT NULL,
	`SzakAzonosito` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Uzenet` (
	`UzenetAzonosito` VARCHAR(30) NOT NULL,
	`Felado` VARCHAR(30) NOT NULL,
	`Cimzett` VARCHAR(30) NOT NULL,
	`Targy` VARCHAR(100) NOT NULL,
	`Szoveg` VARCHAR(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Oktatas` (
	`OktatoAzonosito` CHAR(11) NOT NULL,
	`KurzusAzonosito` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `Hallgato`
	ADD PRIMARY KEY (`Azonosito`);
	
ALTER TABLE `Oktato`
	ADD PRIMARY KEY (`Azonosito`);

ALTER TABLE `Admin`
	ADD PRIMARY KEY (`Azonosito`);

ALTER TABLE `Targy`
	ADD PRIMARY KEY (`TargyKod`);

ALTER TABLE `Kurzus`
	ADD PRIMARY KEY (`KurzusKod`);

ALTER TABLE `Kurzusjelentkezes`
	ADD PRIMARY KEY (`HallgatoAzonosito`, `KurzusKod`, `SzakAzonosito`),
	ADD KEY (`KurzusKod`),
	ADD KEY (`SzakAzonosito`);

ALTER TABLE `Vizsga`
	ADD PRIMARY KEY (`VizsgaAzonosito`);

ALTER TABLE `Vizsgajelentkezes`
	ADD PRIMARY KEY (`HallgatoAzonosito`, `VizsgaAzonosito`),
	ADD KEY (`VizsgaAzonosito`);

ALTER TABLE `Szak`
	ADD PRIMARY KEY (`SzakAzonosito`);

ALTER TABLE `Szakadat`
	ADD PRIMARY KEY (`SzakAzonosito`, `TargyAzonosito`),
	ADD KEY(`TargyAzonosito`);

ALTER TABLE `FelvettSzak`
	ADD PRIMARY KEY (`HallgatoAzonosito`, `SzakAzonosito`),	
	ADD KEY (`SzakAzonosito`);
	
ALTER TABLE `Elofeltetel`
	ADD PRIMARY KEY (`TargyKod`, `Elofeltetel`, `SzakAzonosito`),
	ADD KEY (`Elofeltetel`),
	ADD KEY (`SzakAzonosito`);
	
ALTER TABLE `Uzenet`
	ADD PRIMARY KEY (`UzenetAzonosito`);
	
ALTER TABLE `Oktatas`
	ADD PRIMARY KEY (`OktatoAzonosito`, `KurzusAzonosito`),
	ADD KEY (`KurzusAzonosito`);



ALTER TABLE `Kurzus`
	ADD FOREIGN KEY (`TargyKod`) REFERENCES `Targy` (`TargyKod`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Kurzusjelentkezes`
	ADD FOREIGN KEY (`HallgatoAzonosito`) REFERENCES `Hallgato` (`Azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Kurzusjelentkezes`
	ADD FOREIGN KEY (`KurzusKod`) REFERENCES `Kurzus` (`KurzusKod`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Kurzusjelentkezes`
	ADD FOREIGN KEY (`SzakAzonosito`) REFERENCES `Szak` (`SzakAzonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Vizsga`
	ADD FOREIGN KEY (`KurzusKod`) REFERENCES `Kurzus` (`KurzusKod`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Vizsgajelentkezes`
	ADD FOREIGN KEY (`HallgatoAzonosito`) REFERENCES `Hallgato` (`Azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Vizsgajelentkezes`
	ADD FOREIGN KEY (`VizsgaAzonosito`) REFERENCES `Vizsga` (`VizsgaAzonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Szakadat`
	ADD FOREIGN KEY (`SzakAzonosito`) REFERENCES `Szak` (`SzakAzonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Szakadat`
	ADD FOREIGN KEY (`TargyAzonosito`) REFERENCES `Targy` (`TargyKod`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `FelvettSzak`
	ADD FOREIGN KEY (`HallgatoAzonosito`) REFERENCES `Hallgato` (`Azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `FelvettSzak`
	ADD FOREIGN KEY (`SzakAzonosito`) REFERENCES `Szak` (`SzakAzonosito`) ON DELETE CASCADE ON UPDATE CASCADE;
	
ALTER TABLE `Elofeltetel`
	ADD FOREIGN KEY (`TargyKod`) REFERENCES `Targy` (`TargyKod`) ON DELETE CASCADE ON UPDATE CASCADE;
	
ALTER TABLE `Elofeltetel`
	ADD FOREIGN KEY (`Elofeltetel`) REFERENCES `Targy` (`TargyKod`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Elofeltetel`
	ADD FOREIGN KEY (`SzakAzonosito`) REFERENCES `Szak` (`SzakAzonosito`) ON DELETE CASCADE ON UPDATE CASCADE;
	
ALTER TABLE `Oktatas`
	ADD FOREIGN KEY (`OktatoAzonosito`) REFERENCES `Oktato` (`Azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Oktatas`
	ADD FOREIGN KEY (`KurzusAzonosito`) REFERENCES `Kurzus` (`KurzusKod`) ON DELETE CASCADE ON UPDATE CASCADE;

