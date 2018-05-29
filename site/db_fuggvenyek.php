<?php
	include_once("php/sqlconnect.php");
	include_once("lekerdezesek.php");
	
	function getHallgatoAdatok($azonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_ADATOK);
		mysqli_stmt_bind_param($sql_query, "s", $azonosito );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getHallgatoOsszesKurzus($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_OSSZES_KURZUS);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}
	
	function getHallgatoKurzusok($hallgatoazonosito, $szakazonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_KURZUSOK);
		mysqli_stmt_bind_param($sql_query, "sss", $hallgatoazonosito, $szakazonosito, $szemeszter );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getKurzusokByTargy($targyKod, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_KURZUSOK_TARGY);
		mysqli_stmt_bind_param($sql_query, "ss", $targyKod, $szemeszter);
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getKurzusByKurzusKod($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_KURZUS_KURZUSKOD);
		mysqli_stmt_bind_param($sql_query, "s", $kurzusKod);
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}
	
	function getTargyByKurzus($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_TARGY_KURZUS);
		mysqli_stmt_bind_param($sql_query, "s", $kurzusKod );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getHallgatoVizsgak($hallgatoazonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_VIZSGAK);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoazonosito, $szemeszter );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getVizsgaByAzonosito($vizsgaKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_VIZSGA_AZONOSITO);
		mysqli_stmt_bind_param($sql_query, "s", $vizsgaKod);
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOktatoAdatok($azonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_ADATOK);
		mysqli_stmt_bind_param($sql_query, "s", $azonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOktatoKurzusok($oktatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_KURZUSOK);
		mysqli_stmt_bind_param($sql_query, "ss", $oktatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOktatoVizsgak($oktatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_VIZSGAK);
		mysqli_stmt_bind_param($sql_query, "ss", $oktatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getAdminAdatok($adminAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ADMIN_ADATOK);
		mysqli_stmt_bind_param($sql_query, "s", $adminAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}
	function getAdminok($adminAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ADMINOK);
		mysqli_stmt_bind_param($sql_query, "s", $adminAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOsszesKurzus($szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ADMIN_KURZUSOK);
		mysqli_stmt_bind_param($sql_query, "s", $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOsszesVizsga($szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ADMIN_VIZSGAK);
		mysqli_stmt_bind_param($sql_query, "s", $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getElofeltetel($kurzusKod, $szakAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ELOFELTETEL);
		mysqli_stmt_bind_param($sql_query, "ss", $kurzusKod, $szakAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getTargyNev($targyKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, TARGY_NEV);
		mysqli_stmt_bind_param($sql_query, "s", $targyKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$result_1 = mysqli_stmt_get_result($sql_query);
		$result_2 = mysqli_fetch_assoc($result_1);

		$returnString = $result_2['TargyNev'];

		return $returnString;
	}

	function getHallgatoOrarend($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_ORAREND);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getVizsgaNevsor($vizsgaAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGA_HALLGATOK);
		mysqli_stmt_bind_param($sql_query, "s", $vizsgaAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getKurzusNevsor($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_HALLGATOK);
		mysqli_stmt_bind_param($sql_query, "s", $kurzusKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOktatoOrarend($oktatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_ORAREND);
		mysqli_stmt_bind_param($sql_query, "ss", $oktatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getBeerkezettUzenetek($felhasznaloAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, BEERKEZETT_UZENETEK);
		mysqli_stmt_bind_param($sql_query, "s", $felhasznaloAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getElkuldottUzenetek($felhasznaloAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ELKULDOTT_UZENETEK);
		mysqli_stmt_bind_param($sql_query, "s", $felhasznaloAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getFelevek() {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, FELEVEK );

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getHallgatoFelevek($felhasznaloAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, FELEVEK_HALLGATO );
		mysqli_stmt_bind_param( $sql_query, "s", $felhasznaloAzonosito );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOktatoFelevek($felhasznaloAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}
		
		$sql_query = mysqli_prepare( $conn, FELEVEK_OKTATO );
		mysqli_stmt_bind_param( $sql_query, "s", $felhasznaloAzonosito );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getHallgatoSzakok($hallgatoAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}
		
		$sql_query = mysqli_prepare( $conn, HALLGATO_SZAKOK );
		mysqli_stmt_bind_param( $sql_query, "s", $hallgatoAzonosito );
		
		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}


	// UPDATE


	function kurzusFelvetel($hallgatoAzonosito, $kurzusKod, $szakAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_FELVETEL);
		mysqli_stmt_bind_param($sql_query, "sss", $hallgatoAzonosito, $kurzusKod, $szakAzonosito);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function kurzusFelvetelOktato($azonosito, $kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_FELVETEL_OKTATO);
		mysqli_stmt_bind_param($sql_query, "ss", $azonosito, $kurzusKod);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function vizsgaFelvetel($hallgatoAzonosito, $vizsgaAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGA_FELVETEL);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $vizsgaAzonosito);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function vizsgaLeadas($hallgatoAzonosito, $vizsgaAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGA_LEADAS);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $vizsgaAzonosito);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function getKurzusOfVizsga($vizsgaKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_VIZSGA);
		mysqli_stmt_bind_param($sql_query, "s", $vizsgaKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getVizsgakByKurzus($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGAK_KURZUS);
		mysqli_stmt_bind_param($sql_query, "s", $kurzusKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getHallgatok() {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_LISTA);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}
	function getOktatok() {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_LISTA);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewHallgato($azonosito, $jelszo, $nev, $email, $szuletesiDatum, $nem, $oktatasiAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_LETREHOZAS);
		mysqli_stmt_bind_param($sql_query, "sssssss", $azonosito, $jelszo, $nev, $email, $szuletesiDatum, $nem, $oktatasiAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewOktato($azonosito, $jelszo, $nev, $email, $szuletesiDatum, $nem, $intezmeny) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_LETREHOZAS);
		mysqli_stmt_bind_param($sql_query, "sssssss", $azonosito, $jelszo, $nev, $email, $szuletesiDatum, $nem, $intezmeny);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewAdmin($azonosito, $jelszo, $nev, $email) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ADMIN_LETREHOZAS);
		mysqli_stmt_bind_param($sql_query, "ssss", $azonosito, $jelszo, $nev, $email);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewKurzus($kurzusKod, $targyKod, $kurzusNev, $szemeszter, $ferohely, $helyszin, $idopont, $megjegyzes) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_LETREHOZAS);
		mysqli_stmt_bind_param($sql_query, "ssssisss", $kurzusKod, $targyKod, $kurzusNev, $szemeszter, $ferohely, $helyszin, $idopont, $megjegyzes);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function addNewVizsga($vizsgaAzonosito, $kurzusKod, $maximalisLetszam, $helyszin, $idopont) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGA_LETREHOZAS);
		mysqli_stmt_bind_param($sql_query, "ssiss", $vizsgaAzonosito, $kurzusKod, $maximalisLetszam, $helyszin, $idopont);

		$result = mysqli_stmt_execute($sql_query);	

		return $result;
	}

	function addNewOktatoToKurzus($oktatoAzonosito, $kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_KURZUSHOZ);
		mysqli_stmt_bind_param($sql_query, "ss", $oktatoAzonosito, $kurzusKod);

		$result = mysqli_stmt_execute($sql_query);	

		return $result;
	}

	function addNewTargy($targyKod, $targynev, $kredit, $tipus) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, TARGY_LETREHOZASA);
		mysqli_stmt_bind_param($sql_query, "ssis", $targyKod, $targynev, $kredit, $tipus);

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewSzak($szakAzonosito, $nev, $kepzesHossz, $kreditSzam) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, SZAK_LETREHOZASA);
		mysqli_stmt_bind_param($sql_query, "ssii", $szakAzonosito, $nev, $kepzesHossz, $kreditSzam);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewTargyToSzak($szakAzonosito, $targyAzonosito, $ajanlottFelev) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, TARGY_SZAKHOZ);
		mysqli_stmt_bind_param($sql_query, "ssi", $szakAzonosito, $targyAzonosito, $ajanlottFelev);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewSzakToHallgato($hallgatoAzonosito, $szakAzonosito, $kezdes) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, SZAK_HALLGATOHOZ);
		mysqli_stmt_bind_param($sql_query, "sss", $hallgatoAzonosito, $szakAzonosito, $kezdes);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewElofeltetel($targyKod, $elofeltetel, $szakAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, ELOFELTETEL_LETREHOZASA);
		mysqli_stmt_bind_param($sql_query, "sss", $targyKod, $elofeltetel, $szakAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function addNewUzenet($uzenetAzonosito, $felado, $cimzett, $targy, $szoveg) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, UZENET_LETREHOZASA);
		mysqli_stmt_bind_param($sql_query, "sssss", $uzenetAzonosito, $felado, $cimzett, $targy, $szoveg);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function kurzusLeadas($hallgatoAzonosito, $kurzusKod, $szakAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_LEADAS);
		mysqli_stmt_bind_param($sql_query, "sss", $hallgatoAzonosito, $kurzusKod, $szakAzonosito);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function kurzusLeadasOktato($azonosito, $kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_LEADAS_OKTATO);
		mysqli_stmt_bind_param($sql_query, "ss", $azonosito, $kurzusKod);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function deleteKurzus($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_TORLES);
		mysqli_stmt_bind_param($sql_query, "s", $kurzusKod);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function deleteVizsga($vizsgaAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGA_TORLES);
		mysqli_stmt_bind_param($sql_query, "s", $vizsgaAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function deleteUzenet($uzenetAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, UZENET_TORLESE);
		mysqli_stmt_bind_param($sql_query, "s", $uzenetAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function updateKurzus($kurzusKod, $targyKod, $kurzusNev, $szemeszter, $ferohely, $helyszin, $idopont, $megjegyzes) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_MODOSITAS);
		mysqli_stmt_bind_param($sql_query, "sssissss", $targyKod, $kurzusNev, $szemeszter, $ferohely, $helyszin, $idopont, $megjegyzes, $kurzusKod);

		!$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function updateVizsga($vizsgaAzonosito, $kurzusKod, $maximalisLetszam, $helyszin, $idopont) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGA_MODOSITAS);
		mysqli_stmt_bind_param($sql_query, "sisss", $kurzusKod, $maximalisLetszam, $helyszin, $idopont, $vizsgaAzonosito);

		$result = mysqli_stmt_execute($sql_query);

		return $result;
	}

	function kurzusErtekeles($hallgatoAzonosito, $szakAzonosito, $kurzusKod, $erdemjegy) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, KURZUS_ERTEKELES);
		mysqli_stmt_bind_param($sql_query, "isss", $erdemjegy, $hallgatoAzonosito, $szakAzonosito, $kurzusKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function vizsgaErtekeles($vizsgaAzonosito, $hallgatoAzonosito, $erdemjegy) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, VIZSGA_ERTEKELES);
		mysqli_stmt_bind_param($sql_query, "iss", $erdemjegy, $vizsgaAzonosito, $hallgatoAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}


	function getHallgatoKurzusEredmenyLista($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_KURZUSEREDMENY_LISTA);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}
	function getHallgatoVizsgaEredmenyLista($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_VIZSGAEREDMENY_LISTA);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getHallgatoEredmenyek($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_EREDMENYEK);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getHallgatoFelvettKredit($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_FELVETT_KREDIT);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$res = mysqli_stmt_get_result($sql_query);

		$ret = mysqli_fetch_assoc($res);
		return $ret['FelvettKredit'];
	}

	function getHallgatoAtlag($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_HAGYOMANYOS_ATLAG);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$res = mysqli_stmt_get_result($sql_query);

		$ret = mysqli_fetch_assoc($res);
		return $ret['atlag'];
	}

	function getHallgatoSulyozottAtlag($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_SULYOZOTT_ATLAG);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$res = mysqli_stmt_get_result($sql_query);

		$ret = mysqli_fetch_assoc($res);
		return $ret['atlag'];
	}

	function getHallgatoTeljesitettKredit($hallgatoAzonosito, $szemeszter) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_TELJESITETT_KREDIT);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szemeszter);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$res = mysqli_stmt_get_result($sql_query);

		$ret = mysqli_fetch_assoc($res);
		return $ret['TeljesitettKredit'];
	}

	function getHallgatoKreditindex($hallgatoAzonosito, $szemeszter) {
		$sulyozottAtlag = getHallgatoSulyozottAtlag($hallgatoAzonosito, $szemeszter);
		$felvettKredit = getHallgatoFelvettKredit($hallgatoAzonosito, $szemeszter);
		$teljesitettKredit = getHallgatoTeljesitettKredit($hallgatoAzonosito, $szemeszter);

		return $sulyozottAtlag * ($teljesitettKredit / 30);
	}

	function getHallgatoKorrigaltKreditIndex($hallgatoAzonosito, $szemeszter) {
		$sulyozottAtlag = getHallgatoSulyozottAtlag($hallgatoAzonosito, $szemeszter);
		$felvettKredit = getHallgatoFelvettKredit($hallgatoAzonosito, $szemeszter);
		$teljesitettKredit = getHallgatoTeljesitettKredit($hallgatoAzonosito, $szemeszter);

		return $sulyozottAtlag * ($teljesitettKredit / 30) * ($teljesitettKredit / $felvettKredit);
	}

	function getHallgatoKreditekSzakon($hallgatoAzonosito, $szakAzonosito) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, HALLGATO_KREDITEK_SZAKON);
		mysqli_stmt_bind_param($sql_query, "ss", $hallgatoAzonosito, $szakAzonosito);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$res = mysqli_stmt_get_result($sql_query);

		$ret = mysqli_fetch_assoc($res);
		return $ret['kreditek'];
	}

	function getOktatoEredmenyekAKurzuson($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_EREDMENYEK_A_KURZUSON);
		mysqli_stmt_bind_param($sql_query, "s", $kurzusKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		return mysqli_stmt_get_result($sql_query);
	}

	function getOktatoAtlag($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_ATLAG);
		mysqli_stmt_bind_param($sql_query, "s", $kurzusKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$res = mysqli_stmt_get_result($sql_query);
		$ret = mysqli_fetch_assoc($res);
		return $ret["atlag"];
	}

	function getOktatoBukasArany($kurzusKod) {
		if ( !($conn = csatlakozas())) {
			return null;
		}

		$sql_query = mysqli_prepare( $conn, OKTATO_BUKAS);
		mysqli_stmt_bind_param($sql_query, "ss", $kurzusKod, $kurzusKod);

		if(!$result = mysqli_stmt_execute($sql_query)) {
			die("Query failed: " . mysqli_error($conn));
		}

		$res = mysqli_stmt_get_result($sql_query);
		$ret = mysqli_fetch_assoc($res);
		return $ret["bukas"] * 100;
	}

?>