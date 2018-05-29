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

    $kurzusKod = $_REQUEST['kod'];
    $result = getKurzusByKurzusKod($kurzusKod);
    $kurzus = mysqli_fetch_assoc($result);
    $ktargyKod = $kurzus['TargyKod'];
    $knev = $kurzus['Kurzusnev'];
    $kszemeszter = $kurzus['Szemeszter'];
    $kferohely = $kurzus['Ferohely'];
    $khelyszin = $kurzus['Helyszin'];
    $kidopont = $kurzus['Idopont'];
    $kmegjegyzes = $kurzus['Megjegyzes'];

    if(isset($_POST['submit']))
        {
            updateCourse();
        }

        function updateCourse()
        {
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

            if ($targyKod != null && $nev != null && $szemeszter != null) {
                    $result = updateKurzus($_REQUEST['kod'], $targyKod, $nev, $szemeszter, $ferohely, $helyszin, $idopont, $megjegyzes);
                    if (!$result) {
                        echo 'Hibás adatok! A kurzus létrehozása nem sikerült.';
                    } else {
                        header("location: kurzusok.php");
                        exit;
                    }
            } else {
                echo 'A tárgykód, név és szemeszter megadása kötelező!';
            }
        } 
    ?>
    </div>

    <h2 class="titleParent">Kurzus módosítása</h2>
    <form method="post" class="newItemForm">
        <div class="innerDiv1">
            <div class="inputContainer">
                <div>Kurzus kód</div>
                <div><?php echo $kurzusKod?></div>
            </div>
            <div class="inputContainer">
                <div>Tárgy kód</div>
                <input type="text" name="targyKod" value="<?php echo $ktargyKod?>"></input>
            </div>
            <div class="inputContainer">
                <div>Név</div>
                <input type="text" name="nev" value="<?php echo $knev?>"></input>
            </div>
            <div class="inputContainer">
                <div>Szemeszter</div>
                <input type="text" name="szemeszter" value="<?php echo $kszemeszter?>"></input>
            </div>
            <div class="inputContainer">
                <div>Férőhely</div>
                <input type="number" name="ferohely" value="<?php echo $kferohely?>"></input>
            </div>
            <div class="inputContainer">
                <div>Helyszín</div>
                <input type="text" name="helyszin" value="<?php echo $khelyszin?>"></input>
            </div>
            <div class="inputContainer">
                <div>Időpont</div>
                <input type="text" name="idopont" value="<?php echo $kidopont?>"></input>
            </div>
            <div class="inputContainer">
                <div>Megjegyzés</div>
                <input type="text" name="megjegyzes" value="<?php echo $kmegjegyzes?>"></input>
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