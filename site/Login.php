<html>
	<head>
		<?php include_once('php/htmlhead.php'); ?>
	</head>

	<body>
	
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
				echo  $password;
				$logintype = $_POST['logintype'];
				$sql = "SELECT Azonosito, Jelszo FROM $logintype WHERE Azonosito='$username' AND Jelszo='$password'";
				$result = mysqli_query($conn, $sql);
				
				
				
				if( mysqli_num_rows($result) == 1){
					$_SESSION['username'] = $username;
					if($logintype == "hallgato") $_SESSION['jog'] = 0;
					else if($logintype == "oktato") $_SESSION['jog'] = 1;
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
				<?php include_once('php/header.php'); ?>
				<div align="right">
				<a class="adminlogin" href="asdmin.php">Adminként</a>
				</div>	
</div>				
			
		
			<div class="loginmiddle">
			   <form class="loginform" action="" method="post">
				
					<?php if($_SESSION['message']){ ?>
							<div style="background-color:red;"> <?php echo $_SESSION['message'] ?> </div>
					<?php } ?>
					
					<div><div class="loginformintext">Felhasználó:</div><input name="username" id="username" class="loginformin"></input> </div>
					<div class="loginformdiv"> <div class="loginformintext">Jelszó:</div><input type="password" name="password" id="password" class="loginformin"></input> </div>
					<div class="loginformdiv">
						<input type="radio" class="loginradio" name="logintype" id="logintype" value="hallgato" checked> Hallgató
						<input type="radio" class="loginradio" name="logintype" id="logintype" value="oktato"> Oktató
						<div  class="loginformdiv"> <button class="loginformbutton" name="loginbtn" id="loginbtn">Mehet</button> </div>
						
					</div>
					
				</form>
				
			</div>
			
		
			
			
			<div class="footer" > 
				<?php include_once('php/footer.php'); ?>
				</div>
		</div>
	</body>
</html>