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
      <h2>Kurzusok <?php 
        if($_SESSION['jog'] == 1) {
          echo "(Oktatott)";
        }
      ?>
      </h2>

      <?php if(($_SESSION['jog'] == 1 || $_SESSION['jog'] == 2) && $semester == '2017-2018-1') { //Oktato vagy admin ?>  
        <button class="newCourseButton" onclick="location.href='ujKurzus.php'">
          Új kurzus létrehozása
        </button>
      <?php } ?>
    </div>

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

    <?php
    if ($semester != "2017-2018-1") { ?>
    <table class="full-width query-table">
      <tr>
        <th>Tárgykód</th>
        <th>Kurzuskód</th>
        <th>Kurzusnév</th>
        <th>Helyszín</th>
        <th>Időpont</th>
        <th>Megjegyzés</th>
      </tr>
      <?php
        while($kurzus = mysqli_fetch_assoc($result)) {
          echo "<tr>\n";
          echo "<td>" . $kurzus['TargyKod'] . "</td> \n";
          echo "<td>" . $kurzus['KurzusKod'] . "</td> \n";
          echo "<td>" . $kurzus['Kurzusnev'] . "</td> \n";
          echo "<td>" . $kurzus['Helyszin'] . "</td> \n";
          echo "<td>" . $kurzus['Idopont'] . "</td> \n";
          echo "<td>" . $kurzus['Megjegyzes'] . "</td> \n";
          echo "</tr>\n";
        }
      ?>
    </table>

    <?php } else { 
        $id = 0;
    ?>

    <form name="manage_courses_form" id="manage_courses_form" method="post" action="">

      <input type="hidden" name="semester" value="<?php echo $semester ?>">
      <input type="hidden" name="szak" value="<?php echo $szak ?>">

        <div class="titleParent">
          <?php if ($_SESSION['jog'] == 0) { ?>
            <input type="submit" value="Új kurzus felvétele" name="newCourse"></input>
            <div class="buttonsParent">
              <input type="submit" value="Átjelentkezés" name="changeCourse"></input>
              <input type="submit" value="Törlés" name="deleteCourse"></input>
            </div>
          <?php } else { ?>
            <div class="buttonsParent">
              <input type="submit" value="Módosítás" name="updateCourse"></input>
              <input type="submit" value="Törlés" name="deleteCourseOktato"></input>
            </div>
          <?php } ?>
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
          <th></th>
        </tr>
		</form>
        <?php
      
          while($kurzus = mysqli_fetch_assoc($result)) {
            if ($_SESSION['jog']!=0 || $kurzus['SzakAzonosito'] == $szak) {
              $id++;
              $kurzusKod = $kurzus['KurzusKod'];
            echo "<tr>\n";
            echo "<td>" . $kurzus['TargyKod'] . "</td> \n";
            $payForm    = "<form  name='whatever' method='post' action='lista.php?kurzuskod=$kurzusKod'><br>";
        $payForm   .= "<input type=\"submit\" id=\"$kurzus[KurzusKod]\" name=info class=\"infB\" value=\"$kurzus[KurzusKod]\" > </form>";
        echo "<td>" . $payForm . "</td> \n"; 
            echo "<td>" . $kurzus['Kurzusnev'] . "</td> \n";
        //TODO: ID ELREJTÉSE
            // echo "<td>" . $kurzus['Letszam'] . " / " . $kurzus['Ferohely'] . "</td> \n";
            echo "<td>" . $kurzus['Helyszin'] . "</td> \n";
            echo "<td>" . $kurzus['Idopont'] . "</td> \n";
            echo "<td>" . $kurzus['Megjegyzes'] . "</td> \n";	      
            //if($_SESSION['jog'] == 0) {
              echo "<td>
              <input type=\"radio\" name=\"selectedCourse\" value=\"$kurzusKod\" form=\"manage_courses_form\">
              </td></tr>\n";
              echo "</tr>\n";
            //}
        
          }
      
        }
      
      
    ?>
  
      </table>

      <?php
      }?>

    
      </div>
      <div class="footer">
    <?php
    include_once("php/footer.php");
    ?>
    </div>
    </div>
  </body>

</html>