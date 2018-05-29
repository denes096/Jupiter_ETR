#hallgato adatai (azonosító)
SELECT * 
FROM HALLGATO 
WHERE AZONOSITO = ?

#kurzusok listázása (hallgatoazonosito, szakazonosito, szemeszter)
SELECT * 
FROM KURZUS, KURZUSJELENTKEZES 
WHERE KURZUS.KURZUSKOD=KURZUSJELENTKEZES.KURZUSKOD AND KURZUSJELENTKEZES.HALLGATOAZONOSITO=? AND KURZUSJELENTKEZES.SZAKAZONOSITO=? AND KURZUS.SZEMESZTER=?

#vizsgák listázása (hallgatoazonosito, szemeszter)
SELECT * 
FROM VIZSGA, VIZSGAJELENTKEZES, KURZUS 
WHERE VIZSGA.VIZSGAAZONOSITO=VIZSGAJELENTKEZES.VIZSGAAZONOSITO AND VIZSGA.KURZUSKOD=KURZUS.KURZUSKOD AND VIZSGAJELENTKEZES.HALLGATOAZONOSITO=? AND KURZUS.SZEMESZTER=?

#oktató adatai (azonosító)
SELECT * 
FROM OKTATO 
WHERE AZONOSITO=?

#oktató kurzusai (oktatoazonosito, szemeszter)
SELECT * 
FROM KURZUS, OKTATAS 
WHERE KURZUS.KURZUSKOD=OKTATAS.KURZUSAZONOSITO AND OKTATAS.OKTATOAZONOSITO=? AND KURZUS.SZEMESZTER=?

#oktató vizsgái (oktatoazonosito, szemeszter)
SELECT * 
FROM VIZSGA, OKTATAS, KURZUS 
WHERE VIZSGA.KURZUSKOD=OKTATAS.KURZUSAZONOSITO AND OKTATAS.KURZUSAZONOSITO=KURZUS.KURZUSKOD AND OKTATAS.OKTATOAZONOSITO=? AND KURZUS.SZEMESZTER=?

#admin személyes adatok (azonosító)
SELECT * 
FROM ADMIN 
WHERE AZONOSITO=?

#admin kurzusok (szemeszter)
SELECT * 
FROM KURZUS 
WHERE SZEMESZTER=?

#admin vizsgák (szemeszter)
SELECT * 
FROM VIZSGA, KURZUS
WHERE VIZSGA.KURZUSKOD=KURZUS.KURZUSKOD AND KURZUS.SZEMESZTER=?


# -----------------------------------------------------------------------

# kurzus felvétele (azonosító, szak, kurzuskód)
INSERT INTO Kurzusjelentkezes (HallgatoAzonosito, KurzusKod, SzakAzonosito) 
VALUES (?, ?, ?);

# kurzus leadása (azonosító, szak kurzuskód)
DELETE FROM Kurzusjelentkezes 
WHERE HallgatoAzonosito = ? AND KurzusKod = ? AND SzakAzonosito = ?;

# vizsga felvétele (azonosító, szak, vizsgakód)
INSERT INTO Vizsgajelentkezes (HallgatoAzonosito, VizsgaAzonosito) 
VALUES (?, ?);

# vizsga leadása (azonosító, vizsgakód)
DELETE FROM Vizsgajelentkezes 
WHERE HallgatoAzonosito = ? AND VizsgaAzonosito = ?;

# előfeltételek lekérdezése (kurzuskód, szak)
SELECT Elofeltetel 
FROM Elofeltetel 
WHERE TargyKod = (
	SELECT TargyKod 
	FROM Kurzus 
	WHERE KurzusKod = ?
);

# hallgatói órarend (azonosító, félév)
SELECT Kurzus.Kurzusnev, Kurzus.Helyszin, Kurzus.Idopont 
FROM Kurzusjelentkezes 
INNER JOIN Kurzus 
WHERE Kurzusjelentkezes.HallgatoAzonosito = ? AND Kurzus.Szemeszter = ?;

# hallgatók listázása a vizsgán (vizsgakód)
SELECT HallgatoAzonosito, Erdemjegy 
FROM Vizsgajelentkezes 
WHERE VizsgaAzonosito = ?;

# hallgatók listázása a kurzuson (kurzuskód)
SELECT HallgatoAzonosito, Erdemjegy 
FROM KurzusJelentkezes 
WHERE KurzusKod = ?;

# oktatói órarend (azonosító, félév)
SELECT KurzusKod, Kurzusnev, Helyszin, Idopont 
FROM Kurzus 
INNER JOIN Oktatas ON Kurzus.KurzusKod = Oktatas.KurzusKod 
WHERE Oktatas.OktatoAzonosito = ?;

# kurzus törlése (kurzuskód)
DELETE FROM Kurzus 
WHERE KurzusKod = ?;

# vizsga törlése (azonosító)
DELETE FROM Vizsga 
WHERE VizsgaAzonosito = ?;

# új hallgató (érékek)
INSERT INTO Hallgato (Azonosito, Jelszo, Nev, Email, SzuletesiDatum, Nem, OktatasiAzonosito) 
VALUES (?, ?, ?, ?, ?, ?, ?);

# új oktató (értékek)
INSERT INTO Oktato (Azonosito, Jelszo, Nev, Email, SzuletesiDatum, Nem, Intezmeny) 
VALUES (?, ?, ?, ?, ?, ?, ?);

# új admin (értékek)
INSERT INTO Admin (Azonosito, Jelszo, Nev, Email) 
VALUES (?, ?, ?, ?);

# új kurzus (értékek)
INSERT INTO Kurzus (KurzusKod, TargyKod, Kurzusnev, Szemeszter, Ferohely, Helyszin, Idopont, Megjegyzes) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?);

# új vizsga (értékek)
INSERT INTO Vizsga (VizsgaAzonosito, KurzusKod, MaximalisLetszam, Helyszin, Idopont) 
VALUES (?, ?, ?, ?, ?);

# oktató hozzárendelése kurzushoz
INSERT INTO Oktatas (OktatoAzonosito, KurzusAzonosito) 
VALUES (?, ?);

# új tárgy hozzáadása
INSERT INTO Targy (TargyKod, Targynev, Kredit, Tipus) 
VALUES (?, ?, ?, ?);

# új szak létrehozása
INSERT INTO Szak (SzakAzonosito, Nev, KepzesHossz, KreditSzam) 
VALUES (?, ?, ?, ?);

# tárgy szakhoz rendelése
INSERT INTO Szakadat (SzakAzonosito, TargyAzonosito, AjanlottFelev) 
VALUES (?, ?, ?);

# szak hallgatóhoz rendelése
INSERT INTO FelvettSzak (HallgatoAzonosito, SzakAzonosito, Kezdes) 
VALUES (?, ?, ?);

# előfeltétel megadása (tárgy, tárgy, szak)
INSERT INTO Elofeltetel (TargyKod, Elofeltetel, SzakAzonosito) 
VALUES (?, ?, ?);

# üzenetek listázása (beérkező)
SELECT UzenetAzonosito, Felado, Cimzett, Targy, Szoveg 
FROM Uzenet 
WHERE Cimzett = ?;

# üzenetek listázása (elküldött)
SELECT UzenetAzonosito, Felado, Cimzett, Targy, Szoveg 
FROM Uzenet 
WHERE Felado = ?;

# új üzenet
INSERT INTO Uzenet (UzenetAzonosito, Felado, Cimzett, Targy, Szoveg) 
VALUES (?, ?, ?, ?, ?);

# üzenet törlése (azonosító)
DELETE FROM Uzenet
WHERE UzenetAzonosito = ?;

# kurzus módosítása új adatokkal
UPDATE Kurzus 
SET TargyKod = ?, Kurzusnev = ?, Szemeszter = ?, Ferohely = ?, Helyszin = ?, Idopont = ?, Megjegyzes = ? 
WHERE KurzusKod = ?;

# vizsga módosítása
UPDATE Vizsga 
SET KurzusKod = ?, MaximalisLetszam = ?, Helyszin = ?, Idopont = ? 
WHERE VizsgaAzonosito = ?;

# kurzus értékelés (hallgatói azonosító, szak, kurzuskód)
UPDATE Kurzusjelentkezes
SET Erdemjegy = ? 
WHERE HallgatoAzonosito = ? AND SzakAzonosito = ? AND KurzusKod = ?;

# vizsga értékelés (hallgatói azonosító, szak, vizsgakód)
UPDATE Vizsgajelentkezes 
SET Erdemjegy = ? 
WHERE VizsgaAzonosito = ? AND HallgatoAzonosito = ?;

# ---------------------------------------------------------

# hallgatók eredményei (azonosító, szak, félév) -> kurzus, kreditérték, jegy
SELECT Kurzus.Kurzusnev, Targy.Kredit, Kurzusjelentkezes.Eredmeny 
FROM Kurzusjelentkezes
INNER JOIN Kurzus ON Kurzus.KurzusKod = KurzusJelentkezes.KurzusKod 
INNER JOIN Targy ON Kurzus.TargyKod = Targy.TargyKod 
WHERE Kurzusjelentkezes.HallgatoAzonosito = ? AND Kurzusjelentkezes.SzakAzonosito = ? AND Kurzus.Szemeszter = ?;

# oktatói statisztika (azonosító, félév)
SELECT Kurzusjelentkezes.Erdemjegy 
FROM Kurzusjelentkezes 
INNER JOIN Kurzus ON Kurzus.KurzusKod = Kurzusjelentkezes.KurzusKod 
INNER JOIN Oktatas ON Oktatas.KurzusKod = Kurzus.KurzusKod 
WHERE Oktatas.OktatoAzonosito = ? AND Kurzus.Szemeszter = ?;

# ...