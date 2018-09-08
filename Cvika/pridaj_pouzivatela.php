<?php
session_start();
include('db.php');
include('udaje.php');
include('funkcie.php');
include('User.class.php');
hlavicka('Pridaj používateľa');
include('navigacia.php');
?>

<section>
<?php 
if (isset($_SESSION['user']) && $_SESSION['admin']) {

$zobraz_form = true;

if (isset($_POST['posli']) && 
    isset($_POST['prihlasmeno']) && nazov_ok($_POST['prihlasmeno']) && 
    isset($_POST['heslo']) && nazov_ok($_POST['heslo']) && 
    isset($_POST['heslo2']) && nazov_ok($_POST['heslo2']) && 
    ($_POST['heslo'] == $_POST['heslo2']) &&
    isset($_POST['meno']) && nazov_ok($_POST['meno']) &&
    isset($_POST['priezvisko']) && nazov_ok($_POST['priezvisko']) &&
    isset($_POST['admin']) && in_array($_POST['admin'], array('1', '0')) ) { 
// pridanie používateľa
	if (pridaj_pouzivatela()) $zobraz_form = false;
} else { 
	if (isset ($_POST['posli'])) {
		echo '<p class="chyba">Nezadali ste všetky údaje, resp. nemajú správny formát!</p>';
		if ($_POST['heslo'] != $_POST['heslo2'])
			echo '<p class="chyba">Nezadali ste 2x rovnaké nové heslo!</p>'; 
	}
}

if ($zobraz_form) {
?>
	<p>Všetky údaje sú povinné</p>
	<form method="post">
		<p><label for="prihlasmeno">Prihlasovacie meno (3-20 znakov):</label> 
		<input name="prihlasmeno" type="text" size="20" maxlength="20" id="prihlasmeno" value="<?php if (isset($_POST["prihlasmeno"])) echo $_POST["prihlasmeno"]; ?>" ><br>
		<label for="heslo">Heslo (3-30 znakov):</label> 
		<input name="heslo" type="password" size="30" maxlength="30" id="heslo"> 
		<br>
		<label for="heslo2">Heslo (znovu):</label> 
		<input name="heslo2" type="password" size="30" maxlength="30" id="heslo2">
		<br> 
		<label for="meno">Meno (3-20 znakov):</label>
		<input type="text" name="meno" id="meno" size="20" value="<?php if (isset($_POST['meno'])) echo $_POST['meno'] ?>">
		<br>
		<label for="priezvisko">Priezvisko (3-30 znakov):</label>
		<input type="text" name="priezvisko" id="priezvisko" size="30" value="<?php if (isset($_POST['priezvisko'])) echo $_POST['priezvisko'] ?>">
		<br>
		Práva administrátora: <input type="radio" name="admin" id="admin_ano" value="1"<?php if (isset($_POST['admin']) && $_POST["admin"]=="1") echo ' checked'; ?>> <label for="admin_ano">áno</label>
		<input type="radio" name="admin" id="admin_nie" value="0"<?php if (isset($_POST['admin']) && $_POST["admin"]=="0") echo ' checked'; ?>> <label for="admin_nie">nie</label>
		</p>
		<p>
			<input name="posli" type="submit" id="posli" value="Pridaj používateľa">
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
