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
      <h2>Eredmények <?php 
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
        $result = getHallgatoKurzusEredmenyLista($_SESSION['username'], $semester);
		$result1 = getHallgatoVizsgaEredmenyLista($_SESSION['username'], $semester);
      } else {
		 header("location: kurzusok.php");
	  }

    ?>

      <table class="full-width query-table">
        <tr>
          <th>Tárgykód</th>
          <th>Kurzuskód</th>
          <th>Tárgynév</th>
          <th>Kreditszám</th>
          <th>Eredmény</th>
        </tr>
		</form>
        <?php
          while($eredmeny = mysqli_fetch_assoc($result)) {
            echo "<tr>\n";
			echo "<td>" . $eredmeny['TargyKod'] . "</td> \n";
            echo "<td>" . $eredmeny['KurzusKod'] . "</td> \n";
            echo "<td>" . $eredmeny['TargyNev'] . "</td> \n";
            echo "<td>" . $eredmeny['Kredit'] . "</td> \n";
            echo "<td>" . $eredmeny['Erdemjegy'] . "</td> \n";
            echo "</tr>\n";
          }
        ?>
      </table>
	  <table class="full-width query-table">
        <tr>
          <th>VizsgaAzonosito</th>
          <th>Tárgykód</th>
		  <th>Kurzuskód</th>
          <th>TargyNev</th>
          <th>Kreditszám</th>
          <th>Eredmény</th>
		  
        </tr>
		</form>
        <?php
          while($eredmeny1 = mysqli_fetch_assoc($result1)) {
            echo "<tr>\n";
			echo "<td>" . $eredmeny1['VizsgaAzonosito'] . "</td> \n";
            echo "<td>" . $eredmeny1['TargyKod'] . "</td> \n";
            echo "<td>" . $eredmeny1['KurzusKod'] . "</td> \n";
            echo "<td>" . $eredmeny1['TargyNev'] . "</td> \n";
            echo "<td>" . $eredmeny1['Kredit'] . "</td> \n";
			echo "<td>" . $eredmeny1['Erdemjegy'] . "</td> \n";
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