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
      
     if ($_SESSION['jog'] == 2) {
        // Admin
        $result =  getAdminok($_SESSION['username']); // TODO
      }
    ?>
<div class="body">	

     <?php
        if(!isset($_SESSION['jog'])) {
          $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
          header("location: Login.php");
          exit;
        }
      ?>
    </form>
 </div>  
	

	<table class="Statisztika-Table">
	<tr>
	<th>Azonosito</th>
	<th>Név</th>
	<th>Email</th>
	</tr>
	
	 <?php 
		
			while($kurzus = mysqli_fetch_assoc($result)) {			 
		  echo "<tr>\n";          
		  echo "<td class=stat-cellb>".$kurzus['Azonosito']."</td> \n";		    
		  echo "<td class=stat-cellb>".$kurzus['Nev']."</td> \n";
		  echo "<td class=stat-cellb>".$kurzus['Email']."</td> \n";
		  echo "</tr>\n<tr>";
		}
		
        
      ?>
	</table>

    
   
       

 </div>

    <div class="footer">
	<?php include_once("php/footer.php");?>
	</div>
  </body>
  

</html>