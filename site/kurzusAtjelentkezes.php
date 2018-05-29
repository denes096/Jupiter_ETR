<html>
  <head>
    <?php include_once("php/htmlhead.php"); ?>
  </head>
  <body>
    <?php
      include_once("php/header.php");
      include_once("php/menu.php");
      include_once("db_fuggvenyek.php");

      $oldKurzusKod = $_REQUEST['kod'];
      $result = getTargyByKurzus($oldKurzusKod);
      $targy = mysqli_fetch_assoc($result);
      $targyKod = $targy['TargyKod'];

      $szak = $_REQUEST['szak'];
    ?>

    <div class="container">
      <div class="header"></div>
    <div class="body">

    <div class="errorDiv">
    <?php
      if(isset($_POST['newCourse'])) {
        if (isset($_POST['selectedCourse2'])) {
          $kurzusKod = $_POST['selectedCourse2'];
          $hallgato = $_SESSION['username'];
          $result = kurzusFelvetel($hallgato, $kurzusKod, $szak);
          if (!$result) {
            echo 'A kurzus cseréje nem sikerült!';
          } else {
            echo '<script>window.location.href="kurzusok.php";</script>';
          }
        } else {
          echo 'Nincs kiválasztva kurzus!';
        }
    }
    ?>
    </div>

    <div class="newCourseParent titleParent">
      <h2>Átjelentkezés</h2>
    </div>

    <form name="change_course_form" id="change_course_form" method="post">
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
        $result = getKurzusokByTargy($targyKod, "2017-2018-1");
      ?>

      <div class="buttonsParent">
          <input type="submit" value="Kurzus cseréje" name="newCourse"></input>
      </div>

      <table class="full-width query-table">
        <tr>
          <th>Tárgykód</th>
          <th>Kurzuskód</th>
          <th>Kurzusnév</th>
          <th>Helyszín</th>
          <th>Időpont</th>
          <th>Megjegyzés</th>
          <th></th>
        </tr>
        <?php
          while($kurzus = mysqli_fetch_assoc($result)) {
            $kurzusKod = $kurzus['KurzusKod'];
            echo "<tr>\n";
            echo "<td>" . $kurzus['TargyKod'] . "</td> \n";
            echo "<td>" . $kurzus['KurzusKod'] . "</td> \n";
            echo "<td>" . $kurzus['Kurzusnev'] . "</td> \n";
            echo "<td>" . $kurzus['Helyszin'] . "</td> \n";
            echo "<td>" . $kurzus['Idopont'] . "</td> \n";
            echo "<td>" . $kurzus['Megjegyzes'] . "</td> \n";
            echo "<td><input type=\"radio\" name=\"selectedCourse2\" value=\"$kurzusKod\"></td>";
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