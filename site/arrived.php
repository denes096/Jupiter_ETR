<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css"></link>
		<link id="theme" rel="stylesheet" type="text/css" href="css/szin1.css"> 
		<script src="scripts/jquery-3.2.1.min.js"></script>
		<script src="scripts/main.js"></script>
	</head>
	<body onload="generate_orarend()">
		<div class="container">

			<div class="header"><?php include_once("php/header.php"); ?></div>
			<?php include_once("php/menu.php"); ?>
			<?php     
				include_once("db_fuggvenyek.php");
				if(!isset($_SESSION['jog'])) {
					$_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
					header("location: Login.php");
					exit;
				}
				$azonosito=$_SESSION['username'];

				$table_query = "";
				$table_query = getBeerkezettUzenetek($azonosito);   
			?>
			<div class="body">
				<div class="middle">
					<div class="pagename"><h2>Beérkezett üzenetek</h2></div>
					<div>
						<table class="messages">
							<th>Feladó</th>
							<th>Tárgy</th>
							<?php 
								$i=1;
								while($adat = mysqli_fetch_assoc($table_query))
								{
									echo '<tr class="message">'."";

									echo "<td id=n" . $i . ">" . $adat['Felado'] . "</td>";
									echo '<td id=h' . $i . ">";
									
									echo '<div class="messagetext">';
									echo $adat['Szoveg'] . "\n";
									echo '</div>';
									
									
									echo $adat['Targy'];
									echo "</td> \n";
									echo "</tr>\n";
									$i=$i+1;
								}
							?>
						</table>
					</div>
				</div>
				<div class="footer">
					<?php include_once('php/footer.php'); ?>
				</div>
			</div>
		</div>
	</body>
</html>