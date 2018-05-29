<?php

session_start();

if(!(isset($_SESSION['username']) && isset($_SESSION['jog']) && isset($_POST['semester']))) {
	echo "Érvénytelen lekérés.";
	header("location: ../error.php");
}

// Feltölt egy tömböt a mysqli_result objektum alapján
function push_result($result, $indices = NULL) {
	$array = array();
	while($row = mysqli_fetch_assoc($result)) {
		if($indices == NULL) {
			array_push($array, $row);
		} else {
			$resultrow = array();
			foreach($indices as $index) {
				$resultrow[$index] = $row[$index];
			}
			unset($index);
			array_push($array, $resultrow);
		}
	}
	return $array;
}

include('../db_fuggvenyek.php');

$stats = array();
$semesters = array();

$semesters = push_result(getFelevek(), array('Szemeszter'));

if($_SESSION['jog'] == 0) {
	// HALLGATÓ

	// 0. Scatter-plot: x-tengely: kreditszám, y-tengely: jegy
	$stats[0]['type'] = "ScatterChart";
	$stats[0]['data'] = push_result(getHallgatoEredmenyek($_SESSION['username'], $_POST['semester']), null);
	$stats[0]['graphOptions'] = array();
	$stats[0]['graphOptions']['title'] = "Érdemjegyek a tantárgyak kreditszámának arányában";
	$stats[0]['graphOptions']['vAxis']['minValue'] = 1;
	$stats[0]['graphOptions']['vAxis']['maxValue'] = 5;
	$stats[0]['graphOptions']['vAxis']['ticks'] = array(1, 2, 3, 4, 5);
	$stats[0]['graphOptions']['vAxis']['title'] = "Érdemjegy";
	foreach($stats[0]['data'] as &$item) {
		$item['Érdemjegy'] = $item['Erdemjegy'];
		$item['Erdemjegy'] = null;
		unset($item);
	}

	// 1. Donut plot: szemeszterenként hány kreditet vett fel a hallgató
	$stats[1]['type'] = "PieChart";
	$stats[1]['data'] = array();
	foreach($semesters as $szem) {
		$_arrayItem = array();
		$_arrayItem['Kredit'] = getHallgatoFelvettKredit($_SESSION['username'], $szem['Szemeszter']);
		$_arrayItem['Szemeszter'] = $szem['Szemeszter'];
		array_push($stats[1]['data'], $_arrayItem);
		unset($_arrayItem);
	}
	$stats[1]['graphOptions'] = array();
	$stats[1]['graphOptions']['pieHole'] = 0.4;
	$stats[1]['graphOptions']['title'] = "Felvett kreditek aránya félévenként";

	// 2. Bar Chart: félévenkénti átlagok, súlyozott átlagok és kreditindex
	$stats[2]['type'] = "LineChart";
	$stats[2]['data'] = array();
	foreach($semesters as $szem) {
		$_arrayItem = array();
		$_arrayItem['Szemeszter'] = $szem['Szemeszter'];
		$_arrayItem['Átlag'] = getHallgatoAtlag($_SESSION['username'], $szem['Szemeszter']);
		$_arrayItem['Súlyozott átlag'] = getHallgatoSulyozottAtlag($_SESSION['username'], $szem['Szemeszter']);
		$_arrayItem['Kreditindex'] = getHallgatoKreditindex($_SESSION['username'], $szem['Szemeszter']);
		array_push($stats[2]['data'], $_arrayItem);
		unset($_arrayItem);
	}
	$stats[2]['graphOptions']['title'] = "Félévenkénti átlagok";
	$stats[2]['graphOptions']['hAxis']['title'] = "Szemeszter";
	$stats[2]['graphOptions']['vAxis']['title'] = "Tanulmányi átlag";
	$stats[2]['deleteNull'] = true;

	unset($szem);
	
} else if ($_SESSION['jog'] == 1) {
	// Oktató

	// 0. Bar Chart: kurzusonkénti átlagok
	$stats[0]['type'] = "BarChart";
	$stats[0]['data'] = array();
	$tmp_kurzusok = push_result(getOktatoKurzusok($_SESSION['username'], $_POST['semester']), array('KurzusKod'));

	foreach($tmp_kurzusok as $tmp_kurzus) {
		$_arrayItem = array();
		$_arrayItem['Kurzuskód'] = $tmp_kurzus['KurzusKod'];
		$_arrayItem['Átlag'] = getOktatoAtlag($tmp_kurzus['KurzusKod']);
		array_push($stats[0]['data'], $_arrayItem);
		unset($_arrayItem);
	}
	unset($tmp_kurzus);
	$stats[0]['graphOptions']['title'] = "Kurzusonkénti tanulmányi átlagok";
	$stats[0]['graphOptions']['hAxis']['title'] = "Átlag";
	$stats[0]['graphOptions']['vAxis']['title'] = "Kurzuskód";

	// 1. Column Chart: bukási arányok kurzusonként
	$stats[1]['type'] = "ColumnChart";
	$stats[1]['data'] = array();
	$tmp_kurzusok = push_result(getOktatoKurzusok($_SESSION['username'], $_POST['semester']), array('KurzusKod'));

	foreach($tmp_kurzusok as $tmp_kurzus) {
		$_arrayItem = array();
		$_arrayItem['Kurzuskód'] = $tmp_kurzus['KurzusKod'];
		$_arrayItem['Bukási arány'] = getOktatoBukasArany($tmp_kurzus['KurzusKod']);
		array_push($stats[1]['data'], $_arrayItem);
		unset($_arrayItem);
	}
	unset($tmp_kurzus);
	$stats[1]['graphOptions']['title'] = "Kurzusonkénti bukási arányok (százalékban)";

}

echo json_encode($stats);

?>