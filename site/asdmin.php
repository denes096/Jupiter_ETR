<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css"> 
		<link id="theme" rel="stylesheet" type="text/css" href="css/szin1.css"> 
		<script src="scripts/jquery-3.2.1.min.js"></script>
		<script src="scripts/main.js"></script>	
	</head>
	<body style="background-color: #404040;">
	<?php
			session_start();
			
			error_reporting(0);
			if($_SESSION['username']!=null)
			{
				header("location: index.php");
			}
			error_reporting(1);

			$_SESSION['message'] = '';
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			// Create connection
			$conn = new mysqli($servername, $username, $password,"jupiter");
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			} 

			if (isset($_POST['loginbtn'])) {
				$username = $_POST['username'];
				$password = md5($_POST['password']);
				$logintype = $_POST['logintype'];
				$sql = "SELECT Azonosito, Jelszo FROM admin WHERE Azonosito='$username' AND Jelszo='$password'";
				$result = mysqli_query($conn, $sql);
				echo $password;
				if( mysqli_num_rows($result) == 1){
					$_SESSION['username'] = $username;
					$_SESSION['jog'] = 2;
					header("location: index.php");
				}
				else
				{
					$_SESSION['message'] = "Hibás felhasználónév vagy jelszó!";
				}				
			}
			mysqli_close($conn);
	?>
	
		<div class="loginbody">
			<div class="header">	
				<div class="hc">
					<div class="hp1"><b>Szegedi Tudományegyetem</b> </div>
					<div class="hp2"><b>University of Szeged</b></div>
				</div>	
<div align="right">
				<a class="adminlogin" href="Login.php">Felhasználóként</a>
				</div>				
			</div>
			<div class="loginmiddle">
				<form class="loginform" action="" method="post">

					<?php
					if($_SESSION['message']){ ?>
						<div style="background-color:red;"> <?php echo $_SESSION['message'] ?> </div>
					<?php } ?>
					
					<div> <div class="loginformintext">Felhasználó:</div><input name="username" id="username" class="loginformin"></input> </div>
					<div class="loginformdiv"> <div class="loginformintext">Jelszó:</div><input type="password" name="password" id="password" class="loginformin"></input> </div>
					<div  class="loginformdiv"> <button class="loginformbutton" name="loginbtn" id="loginbtn">Mehet</button> </div>
				</form>
			</div>
			<div class="footer" style="clear: both;"> 
				<div class="logoLeftTable">
					<table class="logoTable">
						<img src="juplogo.png" >
					</table>
				</div>
				<div class="rightLogos">
					<table class="logosTable" cellpadding="10">
						<td><a href="https://www.coosp.etr.u-szeged.hu"><img src="coospace_logo2014.png" height="50"></a></td>	
						<td><a href="https://modulo.etr.u-szeged.hu/Modulo2/default/login/index"><img src="szte_neptun_btn_mod.png" ></a></td>					
					</table>
				</div>
			</div>
		</div>
	</body>
</html>