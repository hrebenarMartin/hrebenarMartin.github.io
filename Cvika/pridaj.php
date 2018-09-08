<?php
session_start();
include('db.php');
include('udaje.php');
include('funkcie.php');
hlavicka('Pridaj kyticu');
include('navigacia.php');
?>

<section>
<?php 
if (isset($_SESSION['user']) && $_SESSION['admin']) {

if (isset($_POST['posli']) && 
    isset($_POST['nazov']) && nazov_ok($_POST['nazov']) && 
    isset($_POST['popis']) && popis_ok($_POST['popis']) && 
    isset($_POST['cena']) && cena_ok($_POST['cena']) && 
    isset($_POST['na_sklade']) && sklad_ok($_POST['na_sklade']) ) { 
	// pridanie kytice do DB
	pridaj_kyticu();
} else { 
	if (isset ($_POST['posli'])) echo '<p class="chyba">Nezadali ste všetky údaje!</p>';
?>
	<p>Všetky údaje sú povinné</p>
	<form method="post">
		<p>
		<label for="nazov">Názov kytice (3-100 znakov):</label>
		<input type="text" name="nazov" id="nazov" size="30" value="<?php if (isset($_POST['nazov'])) echo $_POST['nazov'] ?>">
		<br>
		<label for="popis">Popis (min. 10 znakov):</label>
		<br>
		<textarea cols="40" rows="4" name="popis" id="popis"><?php if (isset($_POST['popis'])) echo $_POST['popis'] ?></textarea>
		<br>
		<label for="cena">Cena (&gt;0):</label>
		<input type="text" name="cena" id="cena" size="5" maxlength="5" value="<?php if (isset($_POST['cena'])) echo $_POST['cena'] ?>">
		<br>
		<label for="na_sklade">Počet ks na sklade (&gt;0):</label>
		<input type="text" name="na_sklade" id="na_sklade" size="5" maxlength="5" value="<?php if (isset($_POST['na_sklade'])) echo $_POST['na_sklade'] ?>"> <br>
		<input type="submit" name="posli" value="Pridaj kyticu">
		</p>  
	</form>
<?php
}

} else { // ci je prihlaseny nejaky pouzivatel (typu administrator)
	echo '<p><strong>K tejto stránke nemáte prístup.</strong></p>'; 
}
?>	
</section>

<?php
include('akcie.php');
include('pata.php');
?>
