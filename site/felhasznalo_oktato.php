<html>
  <head>
    <?php include_once("php/htmlhead.php"); ?>
  </head>
  <body>
    <?php
      include_once("php/header.php");
      include_once("php/menu.php");
      include_once("db_fuggvenyek.php");
      include_once("handle_post_requests.php");
    ?>

<div class="container">
	<div class="header"></div>
<div class="body">

    <div class="errorDiv">
    <?php
      function deleteCourse($kod, $szak) {
        $hallgato = $_SESSION['username'];
        $result = kurzusLeadas($hallgato, $kod, $szak);
        if (!$result) {
          echo 'A kurzus leadása nem sikerült!';
        }
      }
    
      if(isset($_POST['deleteCourse'])) {
        if (isset($_POST['selectedCourse'])) {
          $kurzusKod = $_POST['selectedCourse'];
          deleteCourse($kurzusKod, $szak);
        } else {
          echo 'Nincs kiválasztva kurzus!';
        }
      }

      if(isset($_POST['deleteCourseOktato'])) {
        if (isset($_POST['selectedCourse'])) {
          $kurzusKod = $_POST['selectedCourse'];
          $result = deleteKurzus($kurzusKod);
          if (!$result) {
            echo 'A kurzus törlése nem sikerült!';
          }
        } else {
          echo 'Nincs kiválasztva kurzus!';
        }
      }

      if(isset($_POST['updateCourse'])) {
        if (isset($_POST['selectedCourse'])) {
          $kurzusKod = $_POST['selectedCourse'];
          echo '<script>window.location.href="kurzusModositas.php?kod='.$kurzusKod.'"</script>';
        } else {
          echo 'Nincs kiválasztva kurzus!';
        }
      }
    
      if(isset($_POST['changeCourse'])) {
        if (isset($_POST['selectedCourse'])) {
          $kurzusKod = $_POST['selectedCourse'];
          deleteCourse($kurzusKod, $szak);
          echo '<script>window.location.href="kurzusAtjelentkezes.php?kod='.$kurzusKod.'&szak='.$szak.'"</script>';
        } else {
          echo 'Nincs kiválasztva kurzus!';
        }
      }
    
      if(isset($_POST['newCourse'])) {
        echo '<script>window.location.href="kurzusFelvetel.php";</script>';
      }
    ?>
    </div>

    <div class="titleParent">

    <div class="newCourseParent">
      <h2>Oktatók</h2>
      <button class="newCourseButton" onclick="location.href='felhasznalok_hallgato_uj.php'">
        Új Oktató felvétele
      </button>
    </div>

    </div>

    <?php
      $result = 0;
      if($_SESSION['jog'] == 2) {
        // Hallgató
        $result = getOktatok();
      } else {
		  header('location: index.php');
	  }
    ?>

    <form name="manage_hallgatok_form" id="manage_courses_form" method="post" action="">

	<div class="titleParent">
		<div class="buttonsParent">
			<input type="submit" value="Módosítás" name="updateHallgato"></input>
			<input type="submit" value="Törlés" name="deleteHallgato"></input>
		</div>
	</div>
	</form>

	<table class="full-width query-table">
        <tr>
          <th>Azonosító</th>
          <th>Név</th>
          <th>Email</th>
          <th>Születési dátum</th>
          <th>Nem</th>
		  <th>Intézmény</th>
		  <th></th>
        </tr>
        <?php
      
          while($felhasznalo = mysqli_fetch_assoc($result)) {
            echo "<tr>\n";
            echo "<td>" . $felhasznalo['Azonosito'] . "</td> \n";
            echo "<td>" . $felhasznalo['Nev'] . "</td> \n";
            echo "<td>" . $felhasznalo['Email'] . "</td> \n";
            echo "<td>" . $felhasznalo['SzuletesiDatum'] . "</td> \n";
			echo "<td>" . $felhasznalo['Nem'] . "</td> \n";	      
			echo "<td>" . $felhasznalo['Intezmeny'] . "</td> \n";	      
			echo "<td>
			<input type=\"radio\" name=\"selectedUser\" value=\"$felhasznalo[Azonosito]\" form=\"manage_users_form\">
			</td>\n";
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