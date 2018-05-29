<div onpageshow="cssreload()" class="menu">
	<a href="szemelyesadatok.php" class="menuspan" >Személyes Adatok</a>
	<?php
	session_start();
	if($_SESSION['jog'] < 2)// Hallgató,oktató
	{
	?>
	<span class="menuspan">Tanulmányok
		<span class="menupoints">
			 <a href="kurzusok.php" >Kurzusok </a><br>
			 <a href="vizsgak.php" >Vizsgák </a>
			 <a href="eredmenyek.php" >Eredmények </a>
		</span>
	</span>
	<span class="menuspan">Üzenetek
		<span class="menupoints">
			 <a href="arrived.php">Beérkezettek </a>
			 <a href="sent.php">Elküldöttek </a>
			 <a href="send.php" >Küldés </a>
		</span>
	</span>
	<a href="orarend.php" class="menuspan" >Órarend</a>
	<a href="statisztika.php" class="menuspan" >Statisztikák</a>
	<?php
	}
	else if($_SESSION['jog'] == 2)// Admin
	{
	?>
	<span class="menuspan">Felhasználók
		<span class="menupoints">
			 <a href="adminok.php" >Adminok </a><br>
			 <a href="felhasznalo_oktato.php" >Oktatók </a>
			 <a href="felhasznalok_hallgato.php" >Hallgatók </a>
		</span>
	</span>
	<span class="menuspan">Üzenetek
		<span class="menupoints">
			<a href="arrived.php">Beérkezettek </a>
			<a href="sent.php">Elküldöttek </a>
			<a href="send.php" >Küldés </a>
		</span>
	</span>
	<a href="kurzusok.php" class="menuspan" >Kurzusok</a>
	<a href="vizsgak.php" class="menuspan" >Vizsgák</a>
	<?php
	}
	?>
	<!-- onclick="$.post('./php/dest.php')" -->
	<a href="./php/dest.php" class="menuspan exitbutton">Kijelentkezés</a>
	<span class="style">Style
		<span class="menupoints">
			 <a id="Jupiter" href="#" >Jupiter </a>
			 <a id="oldskool" href="#" >oldskool </a>
			 <a id="Red" href="#" >Red </a>
			 <a id="Dream" href="#" >Dream </a>
			 <a id="Nature" href="#" >Nature </a>
			 <a id="Gold" href="#" >Gold </a> <br>
			 <a id="Sky" href="#" >Sky </a> <br>
			 <a id="Last" href="#" >City </a>
		</span>
	</span>
</div>