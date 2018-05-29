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

      if(!isset($_SESSION['jog'])) {
          $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
          header("location: Login.php");
          exit;
      }

      if(isset($_POST['newExam'])) {
        if (isset($_POST['selectedExam'])) {
          $vizsgaKod = $_POST['selectedExam'];
          $hallgato = $_SESSION['username'];
          $result = vizsgaFelvetel($hallgato, $vizsgaKod);
          if ($result) {
            echo '<script>window.location.href="vizsgak.php";</script>';
          } else {
            echo 'Nem sikerült felvenni a vizsgát!';
          }
        } else {
          echo 'Nincs kiválasztva vizsga!';
        }
      }
      ?>
    </div>

    <div class="newCourseParent titleParent">
      <h2>Felvehető vizsgák</h2>
    </div>

    <form name="new_exam_form" id="new_exam_form" method="post">
      
      <?php
        $result = 0;
        $semester = "2017-2018-1";
        $result = getOsszesVizsga($semester);

      ?>

      <div class="buttonsParent">
          <input type="submit" value="Vizsga felvétele" name="newExam"></input>
      </div>

      <table class="full-width query-table">
        <tr>
          <th>Vizsga azonositó</th>
          <th>Kurzuskód</th>
          <th>Maximális létszám</th>
          <th>Helyszín</th>
          <th>Időpont</th>
          <th></th>
        </tr>
        <?php
          while($vizsga = mysqli_fetch_assoc($result)) {
            $vizsgaKod = $vizsga['VizsgaAzonosito'];
            echo "<tr>\n";
            echo "<td>" . $vizsga['VizsgaAzonosito'] . "</td> \n";
            echo "<td>" . $vizsga['KurzusKod'] . "</td> \n";
            echo "<td>" . $vizsga['Kurzusnev'] . "</td> \n";
            echo "<td>" . $vizsga['MaximalisLetszam'] . "</td> \n";
            echo "<td>" . $vizsga['Idopont'] . "</td> \n";
            echo "<td><input type=\"radio\" name=\"selectedExam\" value=\"$vizsgaKod\"></td>";
            echo "</tr>\n";
          }
        ?>
      </table>

    </form>

    </div>
      <div class="footer">
    <?php
    include_once("php/footer.php");
    ?>
    </div>
    </div>

  </body>

</html>