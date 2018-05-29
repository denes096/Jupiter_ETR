<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/style.css"></link>
    <link id="theme" rel="stylesheet" type="text/css" href="css/szin1.css"> 

  </head>
  <body>
  <div class="header">
    <?php
      include_once("php/menu.php");      
	  include_once("db_fuggvenyek.php");
    ?>
	</div>
	<div class="body">
    <?php
      
      if(!isset($_SESSION['jog'])) {
        $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
        header("location: Login.php");
        exit;
      }
		$azonosito=$_SESSION['username'];
      $table_query = "";
      if($_SESSION['jog'] == 0) {
        // Hallgató
        $table_query = getHallgatoAdatok($azonosito);
      } else if ($_SESSION['jog'] == 1) {
        // Oktató
        $table_query = getOktatoAdatok($azonosito);
		
      } else if ($_SESSION['jog'] == 2) {
        // Admin
        $table_query = getAdminAdatok($adminAzonosito);
      }

      
    ?>

    <h2>Személyes Adatok <?php 
      
    ?>
    </h2>

    <table class="full-width kurzus-table">
      
        <th>Azonositó</th>
        <th>Jelszó</th>
        <th>Név</th>
        <th>Email</th>
        <th>Születési Dátum</th>
        <th>Nem</th>
        <th>OktatásiAzonositó</th>
      
      <?php
        while($adat = mysqli_fetch_assoc($table_query)) {
          echo "<tr>\n";
          echo "<td>" . $adat['Azonosito'] . "</td> \n";
          echo "<td>" . $adat['Jelszo'] . "</td> \n";
          echo "<td>" . $adat['Nev'] . "</td> \n";
          echo "<td>" . $adat['Email'] . "</td> \n";
          echo "<td>" . $adat['SzuletesiDatum'] . "</td> \n";
          echo "<td>" . $adat['Nem'] . "</td> \n";
          echo "<td>" . $adat['OktatasiAzonosito'] . "</td> \n";
          echo "</tr>\n";
        }
      ?>
    </table>
	</div>
	<div class="footer">
	<?php include_once("php/footer.php");?>
	</div>
  </body>

</html>