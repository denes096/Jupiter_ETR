<html>
  <head>
    <?php include_once("php/htmlhead.php"); ?> 
  </head>
  <body>
    <?php
	  include_once("php/header.php");
      include_once("php/menu.php");      
	  include_once("db_fuggvenyek.php");
	  
    ?>
<div class="container">
	<div class="header"></div>
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
        $table_query = getAdminAdatok($azonosito);
      }

      
    ?>

    <h2>Személyes Adatok <?php 
      
    ?>
    </h2>

    <table>
      
        
       
      
      <?php
        while($adat = mysqli_fetch_assoc($table_query)) {
          echo "<tr>\n";
		  echo "<th class=stat-cella>Azonositó</th>\n";
          echo "<td class=stat-cellb>" . $adat['Azonosito'] . "</td> \n";
		  echo "</tr><tr>\n";
		  echo "<th class=stat-cella>Jelszó</th>\n";
          echo "<td class=stat-cellb>" . $adat['Jelszo'] . "</td> \n";
		  echo "</tr><tr>\n";
		  echo "<th class=stat-cella>Név</th>\n";
          echo "<td class=stat-cellb>" . $adat['Nev'] . "</td> \n";
		  echo "</tr><tr>\n";
		  echo "<th class=stat-cella>Email</th>\n";
          echo "<td class=stat-cellb>" . $adat['Email'] . "</td> \n";
		  echo "</tr><tr>\n";
		  if($_SESSION['jog']<2){
		  echo "<th class=stat-cella>SzuletesiDatum</th>\n";
          echo "<td class=stat-cellb>" . $adat['SzuletesiDatum'] . "</td> \n";
		  echo "</tr><tr>\n";
		  echo "<th class=stat-cella>Nem</th>\n";
          echo "<td class=stat-cellb>" . $adat['Nem'] . "</td> \n";
		  echo "</tr><tr>\n";
		  if($_SESSION['jog']==0){
			  echo "<th class=stat-cella>OktatasiAzonosito</th>\n";
			  echo "<td class=stat-cellb>" . $adat['OktatasiAzonosito'] . "</td> \n";}
		  else if($_SESSION['jog']==1){
			 echo "<th class=stat-cella>Intézmény</th>\n";
			 echo "<td class=stat-cellb>" . $adat['Intezmeny'] . "</td> \n";
		  }
          echo "</tr>\n";
        }}
      ?>
    </table>
</div>
<div class="footer">	
	<?php include_once("php/footer.php"); ?>
</div>	
</div>

  </body>

</html>