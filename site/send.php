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
				$_SESSION['message'] = '';  
				
				if (isset($_POST['Send']))
				{
					include_once("db_fuggvenyek.php");
					$cimzett = $_POST['cimzett'];
					$targy = $_POST['targy'];
					$szoveg = $_POST['szoveg'];
					$messId = md5($targy . $szoveg);
					$messId = substr($messId, 0, 30);
					if(getHallgatoAdatok($cimzett)){
						if(!addNewUzenet($messId, $azonosito, $cimzett, $targy, $szoveg)){
							$_SESSION['message'] = 'Az üzenetet sikeresen elküldtük!';
						}
						else
						{
							$_SESSION['message'] = 'Sikertelen küldés!Probálja újra később!';
						}
					}
					else if(getOktatoAdatok($cimzett))
					{
						if(!addNewUzenet($messId, $azonosito, $cimzett, $targy, $szoveg)){
							$_SESSION['message'] = 'Az üzenetet sikeresen elküldtük!';
						}
						else
						{
							$_SESSION['message'] = 'Sikertelen küldés!Probálja újra később!';
						}
					}
					else
					{
						$_SESSION['message'] = 'Cimzett nem létezik!';
					}				
				}
			?>
			<div class="body">
				<div class="middle">
					<div class="pagename"><h2>Üzenet küldés</h2></div>
					<div class="messageformbox">
						<form action="" method="post">
							<?php if($_SESSION['message']){ ?>
									<div style="background-color:red;"> <?php echo $_SESSION['message'] ?> </div>
							<?php } ?>
							<div><span class="messageintext">Címzett</span><input id="cimzett" name="cimzett" placeholder="Azonosító"></div>
							<div><span class="messageintext">Tárgy</span><input id="targy" name="targy" placeholder="Tárgy"></div>
							<div><textarea id="szoveg" name="szoveg" name="Text1" cols="70" rows="10" placeholder="Szöveg"></textarea></div>
							<div class="formdiv"><button id="Send" name="Send" class="messagebutton">Küldés</button></div>
						</form>
					</div>
				</div>
			</div>
			<div class="footer">
				<?php include_once('php/footer.php'); ?>
			</div>
		</div>
	</body>
</html>