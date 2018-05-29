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

    $vizsgaKod = $_REQUEST['kod'];
    $result = getVizsgaByAzonosito($vizsgaKod);
    $vizsga = mysqli_fetch_assoc($result);

    $vizsgaAzonosito = $vizsga["VizsgaAzonosito"];
    $kurzusKod = $vizsga["KurzusKod"];
    $maxLetszam = $vizsga["MaximalisLetszam"];
    $helyszin = $vizsga["Helyszin"];
    $idopont = $vizsga["Idopont"];

    if(isset($_POST['submit']))
        {
            updateExam();
        }

        function updateExam()
        {
            $kurzusKod = $_POST["kurzusKod"];
            $maxLetszam = $_POST["maxLetszam"];
            $helyszin = $_POST["helyszin"];
            $idopont = $_POST["idopont"];

            if ($kurzusKod != null) {
                $result = updateVizsga($_REQUEST['kod'], $kurzusKod, $maxLetszam, $helyszin, $idopont);

                if (!$result) {
                    echo 'Hibás adatok! A vizsga módosítása nem sikerült!';
                } else {
                    header("location: vizsgak.php");
                    exit;
                }
            } else {
                echo 'A vizsga azonosító és a kurzus kód megadása kötelező!';
            }
        }
        if(isset($_POST['submit']))
        {
            updateExam();
        } 
    ?>
    </div>

    <?php
        $courses = getOktatoKurzusok($_SESSION['username'], '2017-2018-1');
    ?>

    <h2 class="titleParent">Vizsga módosítása</h2>
    
    <form class="newItemForm" method="post">
        <div class="innerDiv1">
            <div class="inputContainer">
                <div>Vizsga azonosító</div>
                <div><?php echo $vizsgaKod ?></div>
            </div>
            <div class="inputContainer">
                <div>Kurzus kód</div>
                <select id="kurzuskod-select" name="kurzusKod">
                    <?php
                        while($course = mysqli_fetch_Assoc($courses)) {
                            echo "<option name=\"" . $course['KurzusKod'] . "\"" . ($kurzusKod == $course['KurzusKod'] ? " selected " : "") . ">" . $course['KurzusKod'] . "</option>\n";
                        }
                    ?>
                </select>
            </div>
            <div class="inputContainer">
                <div>Maximális létszám</div>
                <input type="number" name="maxLetszam" value="<?php echo $maxLetszam ?>"</input>
            </div>
            <div class="inputContainer">
                <div>Helyszín</div>
                <input type="text" name="helyszin" value="<?php echo $helyszin ?>"></input>
            </div>
            <div class="inputContainer">
                <div>Időpont</div>
                <input type="text" name="idopont" value="<?php echo $idopont ?>"></input>
            </div>
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