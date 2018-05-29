<html>
  <head>
    <?php include_once("php/htmlhead.php"); ?>
  </head>
  <body>
    <?php
      include_once("php/header.php");
      include_once("php/menu.php");
      include_once("db_fuggvenyek.php");

      $oldVizsgaKod = $_REQUEST['kod'];
    ?>

    <div class="container">
      <div class="header"></div>
    <div class="body">

    <div class="errorDiv">
    <?php
      if(isset($_POST['newCourse'])) {
        if (isset($_POST['selectedExam'])) {
          $vizsgaKod = $_POST['selectedExam'];
          $hallgato = $_SESSION['username'];
          $result = vizsgaFelvetel($hallgato, $vizsgaKod);
          if (!$result) {
            echo 'A vizsga cseréje nem sikerült!';
          } else {
            echo '<script>window.location.href="vizsgak.php";</script>';
          }
        } else {
          echo 'Nincs kiválasztva vizsga!';
        }
      }
    ?>
    </div>

    <div class="newCourseParent titleParent">
      <h2>Átjelentkezés</h2>
      </div>

    <form name="change_exam_form" id="change_exam_form" method="post">
      <div>
          <?php
          if(!isset($_SESSION['jog'])) {
              $_SESSION['message'] = 'Nincs jogosultsága megtekinteni a lapot!';
              header("location: Login.php");
              exit;
          }
          ?>
      </div>
      
      <?php
        $result = 0;
        $hallgato = $_SESSION['username'];
        $result = getKurzusOfVizsga($oldVizsgaKod);
        $kurzus = mysqli_fetch_assoc($result);
        $kurzusKod = $kurzus['KurzusKod'];
        $result = getVizsgakByKurzus($kurzusKod);
      ?>

      <div class="buttonsParent">
          <input type="submit" value="Vizsga cseréje" name="newCourse"></input>
      </div>

      <table class="full-width query-table">
      <tr>
        <th>Vizsgaazonosító</th>
        <th>Kurzuskód</th>
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
          echo "<td>" . $vizsga['Helyszin'] . "</td> \n";
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