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
      if(isset($_POST['newCourse'])) {
        if (isset($_POST['selectedCourse2'])) {
          $kurzusKod = $_POST['selectedCourse2'];
          $hallgato = $_SESSION['username'];

          // Előfeltételek ellenőrzése
          $elofeltetelek_result = getElofeltetel($kurzusKod, $szak);
          $elofeltetelek = array();

          while($elofeltetel = mysqli_fetch_assoc($elofeltetelek_result)) {
            array_push($elofeltetelek, $elofeltetel['Elofeltetel']);
          }

          $szemeszterek = array();
          $szemeszterek_result = getHallgatoFelevek($hallgato);
          
          while($szem = mysqli_fetch_assoc($szemeszterek_result)) {
            array_push($szemeszterek, $szem['Szemeszter']);
          }

          $teljesitettTargyak = array();
          foreach($szemeszterek as $szem) {
            $eredmenyek_szem = getHallgatoKurzusEredmenyLista($hallgato, $szem);
            while($eredmeny = mysqli_fetch_assoc($eredmenyek_szem)) {
              if($eredmeny['Erdemjegy'] > 1) {
                array_push($teljesitettTargyak, $eredmeny['TargyKod']);
              }
            }
            unset($szem);
          }

          $targyFelveheto = true;

          $teljesitendoElofeltetelek = array();

          foreach($elofeltetelek as $elofeltetel) {
            if(!in_array($elofeltetel, $teljesitettTargyak)) {
              array_push($teljesitendoElofeltetelek, $elofeltetel);
            }
            unset($elofeltetel);
          }


          if(count($teljesitendoElofeltetelek) > 0) {
            $targyFelveheto = false;
            echo 'A tárgy következő előfeltételei nincsenek teljesítve: ';
          }

          $i = 0;
          foreach($teljesitendoElofeltetelek as $teljesitendo) {

            if($i != 0) {
              echo ", ";
            }

            echo $teljesitendo . ' (' . getTargyNev($teljesitendo) . ')';

            unset($teljesitendo);
          }
          unset($i);

          echo '<br />';
          
          $result = null;
          
          if($targyFelveheto == true) { 
            $result = kurzusFelvetel($hallgato, $kurzusKod, $szak);
          }

          if (!$result) {
            echo 'A kurzus felvétele nem sikerült'. (!$targyFelveheto ? ', mert nem sikerült a tárgyfelvétel' : '') . '!';
          } else {
            echo '<script>window.location.href="kurzusok.php";</script>';
          }
        } else {
          echo 'Nincs kiválasztva kurzus!';
        }
      }
    ?>
    </div>

    <div class="titleParent">

    <div class="newCourseParent">
      <h2>Felvehető kurzusok</h2>
    </div>

    </div>

    <form name="new_course_form" id="new_course_form" method="post">
      <div>
          
          <div class="titleParent">
          <?php
            echo 'Szak:';
            include('php/elements/form-szak.php');
          ?>
          </div>

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
        $semester = "2017-2018-1";
        $result = getOsszesKurzus($semester);

        $id = 0;

        if (!empty($szak)) {
      ?>

      <div class="buttonsParent">
          <input type="submit" value="Kurzus felvétele" name="newCourse"></input>
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

    <?php
    } ?>

    </div>
      <div class="footer">
    <?php
    include_once("php/footer.php");
    ?>
    </div>
    </div>

  </body>

</html>