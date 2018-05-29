<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link id="theme" rel="stylesheet" type="text/css" href="css/szin1.css">
		 <script src="scripts/jquery-3.2.1.min.js"></script>
		 <script src="scripts/main.js"></script>		
	</head>

	<body style="background-image: url('https://napitroll.hu/image.axd?picture=/2017/08/teszt_eredmenyei_doktor.jpg');">
		<?php
			session_start();
		    if(!isset($_SESSION['jog'])) {
				$_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
				header("location: Login.php");
				exit;
		    }
			include ("./php/menu.php");
		?>
		
	<?php
		// Temporal redirect:
		header('location: kurzusok.php');
	?>

	</body>

</html>