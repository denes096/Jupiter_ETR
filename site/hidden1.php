<?php
include_once("db_fuggvenyek.php");

session_start();
			
			if(!isset($_SESSION['jog'])) {
        $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
        header("location: Login.php");
        exit;
      }
			
			
if(isset($_POST['loginbtn'])){
			
			$hallgatoAzonosito = $_POST['hiddenB'];	
			$kurzusKod= (isset($_POST['kkod'])) ? ($_POST['kkod']): null;
			$erdemjegy=$_POST['username'];
			
			vizsgaErtekeles($kurzusKod, $hallgatoAzonosito, $erdemjegy);

	header("location: lista1.php?vizsgaKod=$kurzusKod");}
			
?>