<html>
    <head>
        <?php include_once("php/htmlhead.php"); ?>
    </head>
    <body>
        <?php
            include_once("php/header.php");
            include_once("php/menu.php");
            include_once("db_fuggvenyek.php");
        ?>

        <div class="container">
            <div class="header"></div>
        <div class="body">

        <div class="errorDiv">
        <?php
        if(isset($_POST['submit']))
            {
                createCourse();
            }

            function createCourse()
            {
                $kurzusKod = $_POST["kurzusKod"];
                $targyKod = $_POST["targyKod"];
                $nev = $_POST["nev"];
                $szemeszter = $_POST["szemeszter"];
                $ferohely = $_POST["ferohely"];
                $helyszin = $_POST["helyszin"];
                $idopont = $_POST["idopont"];
                $megjegyzes = $_POST["megjegyzes"];

                if ($_SESSION['jog'] == 1)  { //Oktató
                    $azonosito = $_SESSION['username'];
                } else { //Admin
                    $azonosito = $_POST["oktato"];
                }

                if ($kurzusKod != null && $targyKod != null && $nev != null && $szemeszter != null) {
                        $result = addNewKurzus($kurzusKod, $targyKod, $nev, $szemeszter, $ferohely, $helyszin, $idopont, $megjegyzes);
                        $result2 = addNewOktatoToKurzus($azonosito, $kurzusKod);
                        if (!$result || !$result2) {
                            echo 'Hibás adatok! A kurzus létrehozása nem sikerült.';
                        } else {
                            header("location: kurzusok.php");
                            exit;
                        }
                } else {
                    echo 'A kurzuskód, tárgykód, név és szemeszter megadása kötelező!';
                }
            } 
        ?>
        </div>

        <div class="titleParent">

        <h2>Új kurzus létrehozása</h2>
        <form method="post" action="ujKurzus.php" class="newItemForm">
            <div class="innerDiv1">
                <div class="inputContainer">
                    <div>Kurzus kód</div>
                    <input type="text" name="kurzusKod"></input>
                </div>
                <div class="inputContainer">
                    <div>Tárgy kód</div>
                    <input type="text" name="targyKod"></input>
                </div>
                <div class="inputContainer">
                    <div>Név</div>
                    <input type="text" name="nev"></input>
                </div>
                <div class="inputContainer">
                    <div>Szemeszter</div>
                    <input type="text" name="szemeszter"></input>
                </div>
                <div class="inputContainer">
                    <div>Férőhely</div>
                    <input type="number" name="ferohely"></input>
                </div>
                <div class="inputContainer">
                    <div>Helyszín</div>
                    <input type="text" name="helyszin"></input>
                </div>
                <div class="inputContainer">
                    <div>Időpont</div>
                    <input type="text" name="idopont"></input>
                </div>
                <div class="inputContainer">
                    <div>Megjegyzés</div>
                    <input type="text" name="megjegyzes"></input>
                </div>
                <?php 
                if($_SESSION['jog'] == 2) { //Admin ?>  
                    <div class="inputContainer">
                    <div>Oktató azonosító</div>
                    <input type="text" name="oktato"></input>
                </div>
                <?php } ?>
            </div>
            <div class="innerDiv2">
                <input type="submit" value="Mentés" name="submit"></input>
            </div>

            </div>
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