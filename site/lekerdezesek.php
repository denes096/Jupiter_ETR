<?php	
	//SELECT
	define("HALLGATO_ADATOK", "SELECT * FROM HALLGATO WHERE AZONOSITO = ?");
	define("HALLGATO_KURZUSOK", "SELECT * FROM KURZUS, KURZUSJELENTKEZES WHERE KURZUS.KURZUSKOD=KURZUSJELENTKEZES.KURZUSKOD 
				AND KURZUSJELENTKEZES.HALLGATOAZONOSITO=? AND KURZUSJELENTKEZES.SZAKAZONOSITO=? AND KURZUS.SZEMESZTER=?");
	define("HALLGATO_OSSZES_KURZUS", "SELECT * FROM Kurzus INNER JOIN Kurzusjelentkezes ON Kurzus.Kurzuskod = Kurzusjelentkezes.Kurzuskod 
				WHERE Kurzusjelentkezes.hallgatoAzonosito = ? AND Kurzus.Szemeszter = ?");
	define("HALLGATO_KURZUSOK_TARGY","SELECT * FROM Kurzus WHERE Kurzus.TargyKod = ? AND Kurzus.Szemeszter = ?");
	define("HALLGATO_TARGY_KURZUS","SELECT TargyKod FROM Kurzus WHERE KurzusKod = ?");
	define("HALLGATO_VIZSGAK", "SELECT Vizsga.VizsgaAzonosito, Vizsga.KurzusKod, Vizsga.MaximalisLetszam, Vizsga.Helyszin, Vizsga.Idopont, 
			Vizsgajelentkezes.HallgatoAzonosito, Vizsgajelentkezes.Erdemjegy, Kurzus.TargyKod, Kurzus.Kurzusnev, Kurzus.Szemeszter 
			FROM VIZSGA, VIZSGAJELENTKEZES, KURZUS WHERE VIZSGA.VIZSGAAZONOSITO=VIZSGAJELENTKEZES.VIZSGAAZONOSITO AND VIZSGA.KURZUSKOD=KURZUS.KURZUSKOD AND 
			VIZSGAJELENTKEZES.HALLGATOAZONOSITO=? AND KURZUS.SZEMESZTER=?");

	define("OKTATO_ADATOK","SELECT * FROM OKTATO WHERE AZONOSITO=?");
	define("OKTATO_KURZUSOK","SELECT * FROM KURZUS, OKTATAS WHERE KURZUS.KURZUSKOD=OKTATAS.KURZUSAZONOSITO AND OKTATAS.OKTATOAZONOSITO=? AND KURZUS.SZEMESZTER=?");

	define("OKTATO_VIZSGAK", "SELECT Vizsga.VizsgaAzonosito, Vizsga.KurzusKod, Vizsga.MaximalisLetszam, Vizsga.Helyszin, Vizsga.Idopont, 
			Oktatas.OktatoAzonosito, Kurzus.TargyKod, Kurzus.Kurzusnev, Kurzus.Szemeszter FROM VIZSGA, OKTATAS, KURZUS 
			WHERE VIZSGA.KURZUSKOD=OKTATAS.KURZUSAZONOSITO AND OKTATAS.KURZUSAZONOSITO=KURZUS.KURZUSKOD 
			AND OKTATAS.OKTATOAZONOSITO=? AND KURZUS.SZEMESZTER=?");

	define("ADMIN_ADATOK","SELECT * FROM ADMIN WHERE AZONOSITO=?");
	define("ADMINOK","SELECT * FROM ADMIN WHERE AZONOSITO!=?");
	define("ADMIN_KURZUSOK","SELECT * FROM KURZUS WHERE SZEMESZTER=?");
	define("ADMIN_VIZSGAK", "SELECT Vizsga.VizsgaAzonosito, Vizsga.KurzusKod, Vizsga.MaximalisLetszam, Vizsga.Helyszin, Vizsga.Idopont, 
			Kurzus.TargyKod, Kurzus.Kurzusnev, Kurzus.szemeszter FROM VIZSGA, KURZUS WHERE VIZSGA.KURZUSKOD=KURZUS.KURZUSKOD AND KURZUS.SZEMESZTER=?");

	define("ELOFELTETEL","SELECT Elofeltetel FROM Elofeltetel WHERE TargyKod = (SELECT TargyKod FROM Kurzus WHERE KurzusKod = ?) AND SzakAzonosito = ?");

	define("TARGY_NEV", "SELECT TargyNev FROM targy WHERE TargyKod = ?");

	define("HALLGATO_ORAREND","SELECT Kurzus.Kurzusnev, Kurzus.Helyszin, Kurzus.Idopont FROM Kurzusjelentkezes INNER JOIN Kurzus ON Kurzusjelentkezes.KurzusKod = Kurzus.KurzusKod
				WHERE Kurzusjelentkezes.HallgatoAzonosito = ? AND Kurzus.Szemeszter = ?");

	define("VIZSGA_HALLGATOK","SELECT * FROM Vizsgajelentkezes WHERE VizsgaAzonosito = ?");
	define("KURZUS_HALLGATOK","SELECT * FROM KurzusJelentkezes WHERE KurzusKod = ?");

	define("OKTATO_ORAREND","SELECT KurzusKod, Kurzusnev, Helyszin, Idopont FROM Kurzus INNER JOIN Oktatas ON Kurzus.KurzusKod = Oktatas.KurzusAzonosito 
				WHERE Oktatas.OktatoAzonosito = ? AND Kurzus.Szemeszter = ?");

	define("BEERKEZETT_UZENETEK","SELECT UzenetAzonosito, Felado, Cimzett, Targy, Szoveg FROM Uzenet WHERE Cimzett = ?");
	define("ELKULDOTT_UZENETEK","SELECT UzenetAzonosito, Felado, Cimzett, Targy, Szoveg FROM Uzenet WHERE Felado = ?");
	define("FELEVEK", "SELECT DISTINCT Szemeszter FROM Kurzus ORDER BY Szemeszter ASC");
	define("FELEVEK_HALLGATO", "SELECT DISTINCT Szemeszter FROM Kurzus RIGHT JOIN Kurzusjelentkezes ON Kurzus.KurzusKod = Kurzusjelentkezes.KurzusKod WHERE HallgatoAzonosito = ? ORDER BY Szemeszter ASC");
	define("FELEVEK_OKTATO", "SELECT DISTINCT Szemeszter FROM Kurzus RIGHT JOIN Oktatas ON Kurzus.KurzusKod = Oktatas.KurzusAzonosito WHERE OktatoAzonosito = ? ORDER BY Szemeszter ASC");

	define("HALLGATO_SZAKOK", "SELECT SzakAzonosito FROM Felvettszak WHERE HallgatoAzonosito = ? GROUP BY SzakAzonosito");

	define("KURZUS_VIZSGA", "SELECT KurzusKod FROM Vizsga WHERE VizsgaAzonosito = ?");
	define("VIZSGAK_KURZUS","SELECT * FROM Vizsga WHERE KurzusKod = ?");
	define("HALLGATO_KURZUS_KURZUSKOD","SELECT * FROM Kurzus WHERE KurzusKod = ?");
	define("HALLGATO_VIZSGA_AZONOSITO","SELECT * FROM Vizsga WHERE VizsgaAzonosito = ?");

	define("HALLGATO_LISTA", "SELECT * FROM hallgato");
	define("OKTATO_LISTA", "SELECT * FROM oktato");
	//INSERT
	define("KURZUS_FELVETEL","INSERT INTO Kurzusjelentkezes (HallgatoAzonosito, KurzusKod, SzakAzonosito) VALUES (?, ?, ?)");
	define("KURZUS_FELVETEL_OKTATO","INSERT INTO Oktatas (OktatoAzonosito, KurzusAzonosito) VALUES (?, ?)");
	define("VIZSGA_FELVETEL","INSERT INTO Vizsgajelentkezes (HallgatoAzonosito, VizsgaAzonosito) VALUES (?, ?)");
	define("HALLGATO_LETREHOZAS","INSERT INTO Hallgato (Azonosito, Jelszo, Nev, Email, SzuletesiDatum, Nem, OktatasiAzonosito) VALUES (?, ?, ?, ?, ?, ?, ?)");
	define("OKTATO_LETREHOZAS","INSERT INTO Oktato (Azonosito, Jelszo, Nev, Email, SzuletesiDatum, Nem, Intezmeny) VALUES (?, ?, ?, ?, ?, ?, ?)");
	define("ADMIN_LETREHOZAS","INSERT INTO Admin (Azonosito, Jelszo, Nev, Email) VALUES (?, ?, ?, ?)");
	define("KURZUS_LETREHOZAS","INSERT INTO Kurzus (KurzusKod, TargyKod, Kurzusnev, Szemeszter, Ferohely, Helyszin, Idopont, Megjegyzes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	define("VIZSGA_LETREHOZAS","INSERT INTO Vizsga (VizsgaAzonosito, KurzusKod, MaximalisLetszam, Helyszin, Idopont) VALUES (?, ?, ?, ?, ?)");
	define("OKTATO_KURZUSHOZ","INSERT INTO Oktatas (OktatoAzonosito, KurzusAzonosito) VALUES (?, ?)");
	define("TARGY_LETREHOZASA","INSERT INTO Targy (TargyKod, Targynev, Kredit, Tipus) VALUES (?, ?, ?, ?)");
	define("SZAK_LETREHOZASA","INSERT INTO Szak (SzakAzonosito, Nev, KepzesHossz, KreditSzam) VALUES (?, ?, ?, ?)");
	define("TARGY_SZAKHOZ","INSERT INTO Szakadat (SzakAzonosito, TargyAzonosito, AjanlottFelev) VALUES (?, ?, ?)");
	define("SZAK_HALLGATOHOZ","INSERT INTO FelvettSzak (HallgatoAzonosito, SzakAzonosito, Kezdes) VALUES (?, ?, ?)");
	define("ELOFELTETEL_LETREHOZASA","INSERT INTO Elofeltetel (TargyKod, Elofeltetel, SzakAzonosito) VALUES (?, ?, ?)");
	define("UZENET_LETREHOZASA","INSERT INTO Uzenet (UzenetAzonosito, Felado, Cimzett, Targy, Szoveg) VALUES (?, ?, ?, ?, ?)");

	//DELETE
	define("KURZUS_LEADAS","DELETE FROM Kurzusjelentkezes WHERE HallgatoAzonosito = ? AND KurzusKod = ? AND SzakAzonosito = ?");
	define("KURZUS_LEADAS_OKTATO","DELETE FROM Oktatas WHERE OktatoAzonosito = ? AND KurzusAzonosito = ?");
	define("VIZSGA_LEADAS","DELETE FROM Vizsgajelentkezes WHERE HallgatoAzonosito = ? AND VizsgaAzonosito = ?");

	define("KURZUS_TORLES","DELETE FROM Kurzus WHERE KurzusKod = ?");
	define("VIZSGA_TORLES","DELETE FROM Vizsga WHERE VizsgaAzonosito = ?");
	define("UZENET_TORLESE","DELETE FROM Uzenet WHERE UzenetAzonosito = ?");
	
	//UPDATE
	define("KURZUS_MODOSITAS","UPDATE Kurzus SET TargyKod = ?, Kurzusnev = ?, Szemeszter = ?, Ferohely = ?, Helyszin = ?, Idopont = ?, Megjegyzes = ? 
			WHERE KurzusKod = ?");
	define("VIZSGA_MODOSITAS","UPDATE Vizsga SET KurzusKod = ?, MaximalisLetszam = ?, Helyszin = ?, Idopont = ? WHERE VizsgaAzonosito = ?");
	define("KURZUS_ERTEKELES","UPDATE Kurzusjelentkezes SET Erdemjegy = ? WHERE HallgatoAzonosito = ? AND SzakAzonosito = ? AND KurzusKod = ?");
	define("VIZSGA_ERTEKELES","UPDATE Vizsgajelentkezes SET Erdemjegy = ? WHERE VizsgaAzonosito = ? AND HallgatoAzonosito = ?");
	

	// Statisztikák

	// A hallgató kurzusairól lista eredményekkel, kreditekkel: SzakAzonosito, TargyKod, KurzusKod, TargyNev, Kredit, Erdemjegy
	define("HALLGATO_KURZUSEREDMENY_LISTA", 
		"SELECT kurzusjelentkezes.SzakAzonosito, targy.TargyKod, kurzus.KurzusKod, targy.TargyNev, targy.Kredit, kurzusjelentkezes.Erdemjegy FROM kurzusjelentkezes
		 INNER JOIN kurzus ON kurzusjelentkezes.KurzusKod = kurzus.KurzusKod
		 INNER JOIN targy ON targy.TargyKod = kurzus.TargyKod
		 WHERE HallgatoAzonosito = ? AND Szemeszter = ?");
	
	define("HALLGATO_VIZSGAEREDMENY_LISTA", 
		"SELECT vizsga.VizsgaAzonosito, targy.TargyKod, vizsga.KurzusKod, targy.TargyNev, targy.Kredit, vizsgajelentkezes.Erdemjegy FROM vizsgajelentkezes
		 INNER JOIN vizsga ON vizsgajelentkezes.VizsgaAzonosito = vizsga.VizsgaAzonosito
		 INNER JOIN kurzus ON vizsga.KurzusKod = kurzus.KurzusKod
		 INNER JOIN targy ON kurzus.TargyKod = targy.TargyKod		 
		 WHERE HallgatoAzonosito = ? AND Szemeszter = ?");


	// A hallgató eredményei egy félévre: Kredit és Erdemjegy
	define("HALLGATO_EREDMENYEK", 
		"SELECT targy.Kredit, kurzusjelentkezes.Erdemjegy FROM kurzusjelentkezes
	 	INNER JOIN kurzus ON kurzusjelentkezes.KurzusKod = kurzus.KurzusKod
	 	INNER JOIN targy ON targy.TargyKod = kurzus.TargyKod
	 	WHERE HallgatoAzonosito = ? AND Szemeszter = ?");
		
	

	// Felvett kreditek száma: FelvettKredit
	define("HALLGATO_FELVETT_KREDIT",
		"SELECT SUM(targy.Kredit) AS FelvettKredit FROM kurzusjelentkezes
	 	 INNER JOIN kurzus ON kurzusjelentkezes.KurzusKod = kurzus.KurzusKod
	 	 INNER JOIN targy ON targy.TargyKod = kurzus.TargyKod
		 WHERE HallgatoAzonosito = ? AND Szemeszter = ?");


	// Hagyományos átlag: atlag
	define("HALLGATO_HAGYOMANYOS_ATLAG", 
		"SELECT AVG(kurzusjelentkezes.Erdemjegy) AS atlag FROM kurzusjelentkezes
 	 	INNER JOIN kurzus ON kurzusjelentkezes.KurzusKod = kurzus.KurzusKod
	 	INNER JOIN targy ON targy.TargyKod = kurzus.TargyKod
	 	WHERE HallgatoAzonosito = ? AND Szemeszter = ?");


	// Súlyozott átlag: atlag
	define("HALLGATO_SULYOZOTT_ATLAG", 
		"SELECT SUM(kurzusjelentkezes.Erdemjegy * targy.Kredit) / SUM(targy.Kredit) AS atlag FROM kurzusjelentkezes
		 INNER JOIN kurzus ON kurzusjelentkezes.KurzusKod = kurzus.KurzusKod
		 INNER JOIN targy ON targy.TargyKod = kurzus.TargyKod
		 WHERE HallgatoAzonosito = ? AND Szemeszter = ?");


	// Teljesített kreditek: TeljesitettKredit
	define("HALLGATO_TELJESITETT_KREDIT",
		"SELECT SUM(targy.Kredit) AS TeljesitettKredit FROM kurzusjelentkezes
 		 INNER JOIN kurzus ON kurzusjelentkezes.KurzusKod = kurzus.KurzusKod
		 INNER JOIN targy ON targy.TargyKod = kurzus.TargyKod
		 WHERE HallgatoAzonosito = ? AND Szemeszter = ? AND Erdemjegy IS NOT NULL AND Erdemjegy > 1");

	define("HALLGATO_KREDITEK_SZAKON",
		"SELECT SUM(targy.Kredit) AS kreditek FROM kurzusjelentkezes
 		 INNER JOIN kurzus ON kurzusjelentkezes.KurzusKod = kurzus.KurzusKod
		 INNER JOIN targy ON targy.TargyKod = kurzus.TargyKod
		 WHERE HallgatoAzonosito = ? AND Erdemjegy IS NOT NULL AND Erdemjegy > 1 AND SzakAzonosito=?");
		
	

	// Oktató eredménylista egy kurzuson
	define("OKTATO_EREDMENYEK_A_KURZUSON", 
		"SELECT * FROM kurzusjelentkezes
		 WHERE kurzusjelentkezes.KurzusKod = ?");

	// Oktató átlag egy kurzuson
	define("OKTATO_ATLAG", 
		"SELECT AVG(Erdemjegy) AS atlag FROM kurzusjelentkezes
		 WHERE kurzusjelentkezes.KurzusKod = ?");

	// Oktató Bukási arány egy kurzuson
	define("OKTATO_BUKAS", 
		"SELECT 1 - (COUNT(Erdemjegy) / (
 		 SELECT COUNT(Erdemjegy) FROM kurzusjelentkezes WHERE kurzusjelentkezes.KurzusKod = ?)) AS bukas
		 FROM kurzusjelentkezes
		 WHERE kurzusjelentkezes.KurzusKod = ? AND kurzusjelentkezes.Erdemjegy IS NOT NULL AND kurzusjelentkezes.Erdemjegy > 1");

?>