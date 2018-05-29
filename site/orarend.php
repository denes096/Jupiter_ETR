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
			if($_SESSION['jog'] == 0)// Hallgató
			{
				if(isset($_POST['askOrarend']))
				{
					$selectOption = $_POST['semester'];
					$table_query = "";
					$table_query = getHallgatoOrarend($azonosito,$selectOption);
				}
			}
			else if ($_SESSION['jog'] == 1)// Oktató
			{
				if(isset($_POST['askOrarend']))
				{
					$selectOption = $_POST['semester'];
					$table_query = "";
					$table_query = getOktatoOrarend($azonosito,$selectOption);
				}
			}      
		?>
		<div class="body">
			<div class="middle">
				<div class="pagename"><h2>Órarend</h2></div>
				<div>
					<form action="" method="post">
						<div class="formintext">Szemeszter:</div>
						<select name="semester">
							<option value="2017-2018-1">2017-2018-1</option>
							<option value="2016-2017-2">2016-2017-2</option>
							<option value="2016-2017-1">2016-2017-1</option>
							<option value="2015-2016-2">2015-2016-2</option>
						</select>
						<div  class="formdiv"> <button class="formbutton" name="askOrarend" id="askOrarend">Mehet</button></div>	
					</form>		
				</div>
				<table class="full-width kurzus-table">
					<th>Kurzus Név</th>
					<th>Helyszín</th>
					<th>Időpont</th>
					<?php 
						if (isset($_POST['askOrarend']))
						{
							$i=1;
							while($adat = mysqli_fetch_assoc($table_query))
							{
								echo "<tr>\n";
								echo "<td id=n" . $i . ">" . $adat['Kurzusnev'] . "</td> \n";
								echo "<td id=h" . $i . ">" . $adat['Helyszin'] . "</td> \n";
								echo "<td id=i" . $i . ">" . $adat['Idopont'] . "</td> \n";
								echo "</tr>\n";
								$i=$i+1;
							}
						}
					?>
				</table>
				<table class="full-width kurzus-table">
					<th></th>
					<th>Hétfő</th>
					<th>Kedd</th>
					<th>Szerda</th>
					<th>Csütörtök</th>
					<th>Péntek</th>
					<?php
						$i=8;
						while($i!=21)
						{
							echo "<tr>\n";
							if($i%2==0)
							{
								echo "<td class=orarend-cella>" . $i. ":00" . "</td> \n";
								echo "<td class=orarend-cella id="."h-" . $i . "></td> \n";
								echo "<td class=orarend-cella id="."k-" . $i . "></td> \n";
								echo "<td class=orarend-cella id="."sz-" . $i . "></td> \n";
								echo "<td class=orarend-cella id="."cs-" . $i . "></td> \n";
								echo "<td class=orarend-cella id="."p-" . $i . "></td> \n";
							}
							else
							{
								echo "<td class=orarend-cellb>" . $i. ":00" . "</td> \n";
								echo "<td class=orarend-cellb id="."h-" . $i . "></td> \n";
								echo "<td class=orarend-cellb id="."k-" . $i . "></td> \n";
								echo "<td class=orarend-cellb id="."sz-" . $i . "></td> \n";
								echo "<td class=orarend-cellb id="."cs-" . $i . "></td> \n";
								echo "<td class=orarend-cellb id="."p-" . $i . "></td> \n";
							}
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
	</body>
</html>