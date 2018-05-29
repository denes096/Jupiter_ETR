<html>
  <head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link id="theme" rel="stylesheet" type="text/css" href="css/szin1.css"> 
		<script src="scripts/jquery-3.2.1.min.js"></script>
		<script src="scripts/main.js"></script>
		
  </head>
  <body>
<div class="container">	
	  <div class="header">
				<?php include_once('php/header.php'); ?>	
	  </div>
	  <div class="body">
		<?php
		  include_once("php/menu.php");
		  include_once("db_fuggvenyek.php");
		  
		  
		?>
		

		<?php
		  
		  if(!isset($_SESSION['jog'])) {
			$_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
			header("location: Login.php");
			exit;
		  }
		  

		  $result = 0;
		  
		  $CourseCode= $_GET['kurzuskod'];
		  if($_SESSION['jog'] == 0) {
			// Hallgató
			$result = getKurzusNevsor($CourseCode);
		  } else if ($_SESSION['jog'] == 1) {
			// Oktató
			$result = getKurzusNevsor($CourseCode);
		  } else if ($_SESSION['jog'] == 2) {
			// Admin
			$result = getKurzusNevsor($CourseCode);
			
		  }
		 

		?>

		<div class="newCourseParent">
		  <h2>Kurzusok <?php 
			if($_SESSION['jog'] == 1) {
			  echo "(Oktatott)";
			}
		  ?>
		  </h2>
		  
		</div>
		

		<table class="full-width query-table">
		  <tr>
			<th>Azonosító</th>
			<th>Kurzuskód</th>
			<th>Szak</th>
			<!-- <th>Létszám</th> -->
			<?php
			if($_SESSION['jog'] != 0 ) { ?>
				<th>Erdemjegy</th>
			<th>Módostítás</th>
				
			<?php }
			?>
			
			
		  </tr>
		  <?php
		  echo $CourseCode;
		  
		  
			while($kurzus = mysqli_fetch_assoc($result)) {
			  echo "<tr>\n";
			  echo "<td>" . $kurzus['HallgatoAzonosito'] . "</td> \n";
			  echo "<td>" . $kurzus['KurzusKod'] . "</td> \n";
			  echo "<td>" . $kurzus['SzakAzonosito'] . "</td> \n";
			  
			  
			  if($_SESSION['jog'] != 0 ){
				  echo "<td>" . $kurzus['Erdemjegy'] . "</td> \n";
				 echo "<td><form method='post' action='hidden.php'><input type='hidden' name='kkod' value='$kurzus[KurzusKod]'><input type='hidden' name='szak' value='$kurzus[SzakAzonosito]'><input type='hidden' name='hiddenB' value='$kurzus[HallgatoAzonosito]'><select name='username'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select><button class='loginformbutton' name='loginbtn' id='loginbtn' value='$kurzus[HallgatoAzonosito]'>Mehet</button></form></td>"; 			  
			   }
			  
			  echo "</tr>\n";
			  
			}
			

			
			
			 
		
		?>


		</table>
		</div>
		<div class="footer">
	<?php include_once("php/footer.php"); ?>
	</div>
		</div>
	
	

</body>
 
		
	
 

</html>