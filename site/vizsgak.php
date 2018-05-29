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
      if(isset($_POST['newExam'])) {
        echo '<script>window.location.href="vizsgaFelvetel.php";</script>';
      }

      if(isset($_POST['deleteExam'])) {
        if (isset($_POST['selectedExam'])) {
          $vizsgaKod = $_POST['selectedExam'];
          $hallgato = $_SESSION['username'];
          vizsgaLeadas($hallgato, $vizsgaKod);
        } else {
          echo 'Nincs kiválasztva vizsga!';
        }
      }

      if(isset($_POST['deleteExamOktato'])) {
        if (isset($_POST['selectedExam'])) {
          $vizsgaKod = $_POST['selectedExam'];
          $result = deleteVizsga($vizsgaKod);
          if (!$result) {
            echo 'A vizsga törlése nem sikerült!';
          }
        } else {
          echo 'Nincs kiválasztva vizsga!';
        }
      }

      if(isset($_POST['updateExam'])) {
        if (isset($_POST['selectedExam'])) {
          $vizsgaKod = $_POST['selectedExam'];
          echo '<script>window.location.href="vizsgaModositas.php?kod='.$vizsgaKod.'"</script>';
        } else {
          echo 'Nincs kiválasztva vizsga!';
        }
      }

      if(isset($_POST['changeExam'])) {
        if (isset($_POST['selectedExam'])) {
          $vizsgaKod = $_POST['selectedExam'];
          $hallgato = $_SESSION['username'];
          vizsgaLeadas($hallgato, $vizsgaKod);
          echo '<script>window.location.href="vizsgaAtjelentkezes.php?kod='.$vizsgaKod.'"</script>';
        } else {
          echo 'Nincs kiválasztva vizsga!';
        }
      }
    ?>
    </div>

    <div class="titleParent">

    <div class="newExamParent">
      <h2>Vizsgák <?php 
        if($_SESSION['jog'] == 1) {
          echo "(Oktatott kurzusokon)";
        }
      ?>
      </h2>

      <?php if(($_SESSION['jog'] == 1 || $_SESSION['jog'] == 2) && $semester=='2017-2018-1') { //Oktato vagy admin ?>  
        <button class="newExamButton" onclick="location.href='ujVizsga.php';">
          Új vizsga létrehozása
        </button>
      <?php } ?>
    </div>

    
    
  <form name="semester" id="semester" action="" method="post"> 
    <?php include('php/elements/form-semester.php'); ?>
  </form>

  </div>

  <?php 
    if(!isset($_SESSION['jog'])) {
        $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
        header("location: Login.php");
        exit;

      }

      $result = 0;
      if($_SESSION['jog'] == 0) {
        // Hallgató
        $result = getHallgatoVizsgak($_SESSION['username'], $semester);
      } else if ($_SESSION['jog'] == 1) {
        // Oktató
        $result = getOktatoVizsgak($_SESSION['username'], $semester);
      } else if ($_SESSION['jog'] == 2) {
        // Admin
		$result = getOsszesVizsga($semester);
      }

    ?>

    <?php if ($semester == "2017-2018-1") { ?>
    <form name="manage_exams_form" id="manage_exams_form" method="post" action="">

      <input type="hidden" name="semester" value="<?php echo $semester ?>">

        <?php if ($_SESSION['jog'] == 0) { ?>
          <div class="titleParent">
            <input type="submit" value="Új vizsga felvétele" name="newExam"></input>

            <div class="buttonsParent">
              <input type="submit" value="Átjelentkezés" name="changeExam"></input>
              <input type="submit" value="Törlés" name="deleteExam"></input>
            </div>
          </div>
        <?php } else { ?>
          <div class="buttonsParent">
            <input type="submit" value="Módosítás" name="updateExam"></input>
            <input type="submit" value="Törlés" name="deleteExamOktato"></input>
          </div>
        <?php } ?>

      <table class="full-width query-table">
        <tr>
          <th>Vizsgaazonosító</th>
          <th>Kurzuskód</th>
          <th>Kurzusnév</th>
          <th>Helyszín</th>
          <th>Időpont</th>
          <th></th>
        </tr>
		</form>
        <?php
          while($vizsga = mysqli_fetch_assoc($result)) {
			  $vizsgaKod = $vizsga['KurzusKod'];
            $vizsgaKod = $vizsga['VizsgaAzonosito'];
            echo "<tr>\n";
            echo "<td>" . $vizsga['VizsgaAzonosito'] . "</td> \n";
			$payForm    = "<form  name='whatever' method='post' action='lista1.php?vizsgaKod=$vizsgaKod'><br>";
        $payForm   .= "<input type=\"submit\" id=\"$vizsga[KurzusKod]\" name=info class=\"infB\" value=\"$vizsga[KurzusKod]\" > </form>";
        echo "<td>" . $payForm . "</td> \n"; 
            echo "<td>" . $vizsga['Kurzusnev'] . "</td> \n";
            echo "<td>" . $vizsga['Helyszin'] . "</td> \n";
            echo "<td>" . $vizsga['Idopont'] . "</td> \n";
            echo "<td><input type=\"radio\" name=\"selectedExam\" value=\"$vizsgaKod\" form=\"manage_exams_form\"></td>";
            echo "</tr>\n";
          }
        ?>
      </table>

    

    <?php } else { ?>

    <table class="full-width query-table">
        <tr>
          <th>Vizsgaazonosító</th>
          <th>Kurzuskód</th>
          <th>Kurzusnév</th>
          <th>Helyszín</th>
          <th>Időpont</th>
        </tr>
        <?php
          while($vizsga = mysqli_fetch_assoc($result)) {
            echo "<tr>\n";
            echo "<td>" . $vizsga['VizsgaAzonosito'] . "</td> \n";
            echo "<td>" . $vizsga['KurzusKod'] . "</td> \n";
            echo "<td>" . $vizsga['Kurzusnev'] . "</td> \n";
            echo "<td>" . $vizsga['Helyszin'] . "</td> \n";
            echo "<td>" . $vizsga['Idopont'] . "</td> \n";
            echo "</tr>\n";
          }
        ?>
      </table>

    <?php } ?>
        </div>
        <div class="footer">
          <?php include_once("php/footer.php"); ?>
        </div>
        </div>
  </body>

</html>