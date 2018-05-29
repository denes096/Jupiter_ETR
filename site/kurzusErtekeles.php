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
			<div class="hc">
				<div class="hp1"><b>Szegedi Tudományegyetem</b> </div>
				<div class="hp2"><b>University of Szeged</b></div>
			</div>		
		</div>
    <?php
      include_once("php/menu.php");
      include_once("db_fuggvenyek.php");
    ?>
	

<?php
      session_start();
      if(!isset($_SESSION['jog'])) {
        $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
        header("location: Login.php");
        exit;
      }
	 
	  
      $result = 0;
      if($_SESSION['jog'] == 0) {
        // Hallgató
        $result = getHallgatoOsszesKurzus($_SESSION['username'], "2017-2018-1");
      } else if ($_SESSION['jog'] == 1) {
        // Oktató
        $result = getOktatoKurzusok($_SESSION['username'], "2017-2018-1");
      } else if ($_SESSION['jog'] == 2) {
        // Admin
        $result = ""; // TODO
      }

    ?>
<div class="body>
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
        <th>Tárgykód</th>
        <th>Kurzuskód</th>
        <th>Kurzusnév</th>
        <!-- <th>Létszám</th> -->
        <th>Helyszín</th>
        <th>Időpont</th>
        <th>Megjegyzés</th>
      </tr>
      <?php
	  
        while($kurzus = mysqli_fetch_assoc($result)) {
          echo "<tr>\n";
          echo "<td>" . $kurzus['TargyKod'] . "</td> \n";
          $payForm    = "<form  name='whatever' method='post' action='lista.php?kurzuskod=$kurzus[KurzusKod]' ><br>";
		  $payForm   .= "<input type=\"submit\" id=\"$kurzus[KurzusKod]\" name=info class=\"infB\" value=\"$kurzus[KurzusKod]\" > </form>";
		  echo "<td>" . $payForm . "</td> \n"; 
          echo "<td>" . $kurzus['Kurzusnev'] . "</td> \n";
		  //TODO: ID ELREJTÉSE
          // echo "<td>" . $kurzus['Letszam'] . " / " . $kurzus['Ferohely'] . "</td> \n";
          echo "<td>" . $kurzus['Helyszin'] . "</td> \n";
          echo "<td>" . $kurzus['Idopont'] . "</td> \n";
          echo "<td>" . $kurzus['Megjegyzes'] . "</td> \n";	      
          echo "</tr>\n";
		  
        }
		
		
		
    
	?>

    </table>
	</div>
	<div class="footer">
	<?php
		include_once("php/footer.php");
	?>
  </div>
</div>
  </body>
  

</html>