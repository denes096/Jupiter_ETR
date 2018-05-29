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

		<?php
			if($_SESSION['jog'] != 2) {
				header("location: index.php");
			}
		?>

        <div class="container">
            <div class="header"></div>
        <div class="body">

        <div class="errorDiv">
        <?php
        if(isset($_POST['submit']))
            {
                createHallgato();
            }

            function createHallgato()
            {


				$Azonosito = $_POST['Azonosito'];
				$Jelszo = $_POST['Jelszo'];
				$Nev = $_POST['Nev'];
				$Email = $_POST['Email'];
				$SzuletesiDatum = $_POST['SzuletesiDatum'];
				$Nem = $_POST['Nem'];
				$OktatasiAzonosito = $_POST['OktatasiAzonosito'];


                if (
					$_POST['Azonosito'] != null &&
					$_POST['Jelszo'] != null &&
					$_POST['Nev'] != null &&
					$_POST['Email'] != null &&
					$_POST['SzuletesiDatum'] != null &&
					$_POST['Nem'] != null &&
					$_POST['OktatasiAzonosito'] != null 
				) {
						$result = addNewHallgato($Azonosito, md5($Jelszo), $Nev, $Email, $SzuletesiDatum, $Nem, $OktatasiAzonosito);
                        if ($result == false) {
							header("location: felhasznalok_hallgato.php");
                            exit;
                        } else {
							echo 'Hibás adatok! A hallgató felvétele nem sikerült.';
							echo mysqli_error($result);
                        }
                } else {
                    echo 'Minden adatot kötelező megadni!';
                }
            } 
        ?>
        </div>

        <div class="titleParent">

        <h2>Új hallgató felvétele</h2>
        <form method="post" action="" class="newItemForm">
            <div class="innerDiv1">
                <div class="inputContainer">
                    <div>Azonosító</div>
                    <input type="text" name="Azonosito"></input>
                </div>
                <div class="inputContainer">
                    <div>Jelszó</div>
                    <input type="password" name="Jelszo"></input>
                </div>
                <div class="inputContainer">
                    <div>Név</div>
                    <input type="text" name="Nev"></input>
                </div>
                <div class="inputContainer">
                    <div>Email cím</div>
                    <input type="text" name="Email"></input>
                </div>
                <div class="inputContainer">
                    <div>Születési Dátum (YYYY-MM-DD)</div>
                    <input type="date" name="SzuletesiDatum"></input>
                </div>
                <div class="inputContainer">
                    <div>Nem</div>
                    <input type="text" name="Nem"></input>
                </div>
                <div class="inputContainer">
                    <div>Oktatási azonosító</div>
                    <input type="text" name="OktatasiAzonosito"></input>
                </div>
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