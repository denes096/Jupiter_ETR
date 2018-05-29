<html>
  <head>
	<?php include_once("php/htmlhead.php"); ?>
  </head>
  <body>
  <?php
 include_once('php/header.php');
      include_once("php/menu.php");
      include_once("db_fuggvenyek.php");
      include_once("handle_post_requests.php");
	
	
    ?>
  <div class="header">
    
</div>
    <?php
      $result = 0;
      if($_SESSION['jog'] == 0) {
        // Hallgató
        $result = getHallgatoOsszesKurzus($_SESSION['username'], $semester);
      } else if ($_SESSION['jog'] == 1) {
        // Oktató
        $result = getOktatoKurzusok($_SESSION['username'], $semester);
      } else if ($_SESSION['jog'] == 2) {
        // Admin
        $result = getOsszesKurzus($semester); // TODO
      }
    ?>
<div class="body">	
<div class="szak-semester">
    <form name="szak-semester-form" id="szak-semester-form" action="" method="post">
      <?php
	   if ($_SESSION['jog'] == 0) {
          echo 'Szak:';
          include('php/elements/form-szak.php');
        }
        
        echo 'Félév:';
        include('php/elements/form-semester.php');
        //echo $szak;

        if(!isset($_SESSION['jog'])) {
          $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
          header("location: Login.php");
          exit;
        }
      ?>
    </form>
 </div>  
	

	<table class="Statisztika-Table">
	 <?php 
		if($_SESSION['jog']==0){
		$atlag= getHallgatoAtlag($_SESSION['username'], $semester);
		$satlag=getHallgatoSulyozottAtlag($_SESSION['username'], $semester);
		$tkredit=getHallgatoTeljesitettKredit($_SESSION['username'], $semester);
		$kindex=getHallgatoKreditindex($_SESSION['username'], $semester);
		$kkindex=getHallgatoKorrigaltKreditIndex($_SESSION['username'], $semester);
		$szkredit=getHallgatoKreditekSzakon($_SESSION['username'], $szak);
		$fkredit=getHallgatoFelvettKredit($_SESSION['username'], $semester);
          echo "<tr>\n";
          echo "<th class=stat-cella>Összes Kredit </th> \n";  
		  echo "<td class=stat-cellb>".$szkredit."</td> \n";
		  echo "</tr>\n<tr>";
		  echo "<tr>\n";
          echo "<th class=stat-cella>Átlag </th> \n";  
		  echo "<td class=stat-cellb>".$atlag."</td> \n";
		  echo "</tr>\n<tr>";
		  echo "<th class=stat-cella>Súlyozott Átlag </th> \n";  
		  echo "<td class=stat-cellb>".$satlag."</td> \n";
		  echo "</tr>\n<tr>";
		  echo "<th class=stat-cella>Felvett Kredit </th> \n";  
		  echo "<td class=stat-cellb>".$fkredit."</td> \n";
		  echo "</tr>\n<tr>";
		  echo "<th class=stat-cella>Telsesített Kredit </th> \n";  
		  echo "<td class=stat-cellb>".$tkredit."</td> \n";
		  echo "</tr>\n<tr>";
		  echo "<th class=stat-cella>Kreditindex </th> \n";  
		  echo "<td class=stat-cellb>".$kindex."</td> \n";
		  echo "</tr>\n<tr>";
		  echo "<th class=stat-cella>Korrigált Kreditindex </th> \n";  
		  echo "<td class=stat-cellb>".$kkindex."</td> \n";
		echo "</tr>\n";}
		elseif($_SESSION['jog']==1){
			$result = getOktatoKurzusok($_SESSION['username'], $semester);
			while($kurzus = mysqli_fetch_assoc($result)) {
			$kurzusKod=$kurzus['KurzusKod'];
			 $oAtlag=getOktatoAtlag($kurzusKod);
			 $bArany=getOktatoBukasArany($kurzusKod);
			 
			 
			 echo "<tr>\n";
          
		  echo "</tr>\n<tr>";
		  echo "<tr>\n";
          echo "<th class=stat-cella>Átlag </th> \n";  
		  echo "<td class=stat-cellb>".$oAtlag."</td> \n";
		  echo "</tr>\n<tr>";
		  echo "<th class=stat-cella>Bukási Arány </th> \n";  
		  echo "<td class=stat-cellb>".$bArany."</td> \n";
		  echo "</tr>\n<tr>";
		}}
		
        
      ?>
	  <td><a href='statisztikak_graf.php'>Diagram</a></td>
	</table>

    
   
       

 </div>

    <div class="footer">
	<?php include_once("php/footer.php");?>
	</div>
  </body>
  

</html>