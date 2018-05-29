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
			$szakAzonosito= (isset($_POST['szak'])) ? ($_POST['szak']): null;
			$kurzusKod= (isset($_POST['kkod'])) ? ($_POST['kkod']): null;
			$erdemjegy=$_POST['username'];
			kurzusErtekeles($hallgatoAzonosito, $szakAzonosito, $kurzusKod, $erdemjegy);

	header("location: lista.php?kurzuskod=$kurzusKod");}
			
?>