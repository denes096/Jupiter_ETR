<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/style.css"></link>
    <link id="theme" rel="stylesheet" type="text/css" href="css/szin1.css"> 

  </head>
  <body>
    <?php
      
      include_once("php/sqlconnect.php");
    ?>
	<?php
			session_start();
				
			function generateRandomString($length = 4) {
				$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
			}
			
			

			
			$_SESSION['message'] = '';


			if (isset($_POST['reg'])) {
				$name = $_POST['username'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$seccode = $_POST['seccode'];
				$idFirstPart =  substr (  $name , 0 , 2 );
				$idSecondPart =  substr (  $name , 2 , 1 );
				
				$ID = $idFirstPart . $idSecondPart . generateRandomString() . ".SZE";
				$IDUPPER = strtoupper($ID);

				$sql = "SELECT Email FROM `admin` WHERE Email='$email'";
				$result = mysqli_query($conn, $sql);
				
				
				
				if( mysqli_num_rows($result) == 1){
					$_SESSION['message'] = "Az email cím már foglalt!";
					
				}
				else 
	
				{
					if( $seccode == 1234 ){
						$sql = "INSERT INTO `admin` (`Azonosito`, `Jelszo`, `Nev`, `Email`) VALUES ('$IDUPPER', '$password', '$name', '$email')";
						if ($conn->query($sql) === TRUE) {
						echo "New record created successfully";
						} else {
							echo "Error: " . $sql . "<br>" . $conn->error;
}
						}
					else{
						$_SESSION['message'] = "Helytelen biztonsági kód ";
					}
				}				
				
			}
			mysqli_close($conn);
	?>
	
	<div class="loginbody bgsz">
		 <div class="header nar">	
			 <div class="hc">
				 <div class="hp1"><b>Szegedi Tudományegyetem</b> </div>
				 <div class="hp2"><b>University of Szeged</b></div>
			 </div>		 
		 </div>
		 
		 <div class="middle">
		    <form class="loginform" action="" method="post">
			
			<?php
				 if($_SESSION['message']){ ?>
					<div style="background-color:red;"> <?php echo $_SESSION['message'] ?> </div>
				 <?php } ?>
			
				<div class="loginformdiv"> 
					<div class="loginformintext">Név:</div><input name="username" id="username" class="loginformin"></input>
				</div>
				<div class="loginformdiv">
						<div class="loginformintext">Jelszó:</div><input type="password" name="password" id="password" class="loginformin"></input>
				</div>
				
				<div class="loginformdiv">
						<div class="loginformintext">E-mail:</div><input name="email" id="email" type="email" class="loginformin"></input>
				</div>
				<div class="loginformdiv">
						<div class="loginformintext">Biztonsági Kód:</div><input type="password" name="seccode" id="seccode" class="loginformin"></input>
				</div>
				
				<div  class="loginformdiv"> <button class="loginformbutton" name="reg" id="reg">Mehet</button> </div>
				</form>
			<span>
			
			</span>
		 </div>
		 
		 <div class="footer"> 
		 
		 </div>
	 </div>
    
  </body>

</html>