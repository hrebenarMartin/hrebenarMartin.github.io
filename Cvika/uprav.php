<?php
session_start();
include('db.php');
include('udaje.php');
include('funkcie.php');
hlavicka('Uprav kyticu');
include('navigacia.php');
?>

<section>
<?php 
if (isset($_SESSION['user']) && $_SESSION['admin']) {

$zobraz_form = false;

if (isset ($_POST['posli']) && 
    isset ($_POST['nazov']) && nazov_ok($_POST['nazov']) && 
    isset ($_POST['popis']) && popis_ok($_POST['popis']) && 
    isset ($_POST['cena']) && cena_ok($_POST['cena']) && 
    isset ($_POST['na_sklade']) && sklad_ok($_POST['na_sklade']) ) {      
	    uprav_kyticu($_GET['kod']);
        if (isset($_FILES['obrazok']) && $_FILES['type'] == 'image/png'){
            $nazov = "kytice-obrazky/".$_GET['kod'].".png";
            move_uploaded_file($_FILES['obrazok']['tmp_name'], $nazov);   
        }
              
} elseif (isset($_POST['posli'])) {
	echo '<p class="chyba">Nezadali ste všetky údaje!</p>';
	$udaje = $_POST;
	$zobraz_form = true;	
} elseif (!(isset($_GET['kod']) && ((int)$_GET['kod'] > 0))) {	// číslo v parametri kod v adrese nie je správne
	// chybne ID
	echo '<p class="chyba">Chybne odoslaný kód kytice</p>';
} else { // isset($_GET['kod']) && ((int)$_GET['kod'] > 0))	// prvýkrát bol načítaný a zobrazený formulár na úpravu údajov
	if ($udaje = daj_udaje_kytice($_GET['kod'])) // zisti údaje o kytici z databázy
		$zobraz_form = true;
}

if ($zobraz_form) {

?>
	<p>Všetky údaje sú povinné</p>
	<form enctype="multipart/form-data" method="post">
		<p>
		<label for="nazov">Názov kytice (3-100 znakov):</label>
		<input type="text" name="nazov" id="nazov" size="30" value="<?php if (isset($udaje['nazov'])) echo $udaje['nazov']; ?>">
		<br>
		<label for="popis">Popis (min. 10 znakov):</label>
		<br>
		<textarea cols="40" rows="4" name="popis" id="popis"><?php if (isset($udaje['popis'])) echo $udaje['popis']; ?></textarea>
		<br>
		<label for="cena">Cena (&gt;0):</label>
		<input type="text" name="cena" id="cena" size="5" maxlength="5" value="<?php if (isset($udaje['cena'])) echo $udaje['cena']; ?>">
		<br>
		<label for="na_sklade">Počet ks na sklade (&gt;0):</label>
		<input type="text" name="na_sklade" id="na_sklade" size="5" maxlength="5" value="<?php if (isset($udaje['na_sklade'])) echo $udaje['na_sklade']; ?>"> <br>
		<label for="obrazok">Obrázok:</label>
		<input type="file" name="obrazok" id="obrazok" accept="image/png"> <br>
		<input type="submit" name="posli" value="Zmeň kyticu">
		</p>
    </form>
<?php
} 
if (file_exists("kytice-obrazky/".$_GET['kod'].".png")){
        $obr = "kytice-obrazky/".$_GET['kod'].".png";
        echo "<img src=$obr alt=$obr>"; 
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
