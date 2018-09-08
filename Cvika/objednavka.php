<?php
session_start();
include('db.php');
include('udaje.php');
include('funkcie.php');
hlavicka('Objednávka');
include('navigacia.php');
?>

<section>
<?php
$vsetko = false;
if (isset($_POST["meno"]) && spravne_meno($_POST["meno"]) && 
    isset($_POST["adresa"]) && spravna_adresa($_POST["adresa"]) &&
    isset($_POST["kytica"]) && spravna_kytica($_POST["kytica"]) &&  
    isset($_POST["pocet"]) && spravny_pocet($_POST["pocet"]) &&
    isset($_POST["suhlas"]) && suhlas_spodmienkami($_POST["suhlas"])) {
      $vsetko = true;

	if (!isset($_SESSION['meno'])) {
		$_SESSION['meno'] = $_POST["meno"];
		$_SESSION['adresa'] = $_POST["adresa"];
  }
	if (!isset($_SESSION['kytica'][$_POST["kytica"]])) {
		$_SESSION['kytica'][$_POST["kytica"]] = $_POST["pocet"];
	} else {
		$_SESSION['kytica'][$_POST["kytica"]] += $_POST["pocet"];
	}
}  

if (isset($_POST['zrus'])){
	session_unset();
	session_destroy();
}

if (isset($_SESSION['meno'])) {
	vypis_kosik();
} 

	// ak bol odoslaný formulár, ale neboli zadané alebo boli zle zadané všetky povinné položky 
	if (!$vsetko && isset($_POST["posli"])) {
		echo '<p class="chyba">Nevyplnili ste všetky povinné údaje objednávky</p>';
	}
?>
<p>Objednajte krásnu kyticu pre svojich najmilších. Z nášho širokého sortimentu kytíc nostalgických, radostných či bláznivo veselých si určite vyberiete!</p>
<form method="post">
<fieldset>
	<legend>Kontaktné údaje</legend>
	<label for="meno">Meno a priezvisko:</label> <input type="text" name="meno" id="meno" size="30" value="<?php if (isset($_POST["meno"])) echo $_POST["meno"]; ?>"><br>
	<label for="adresa">Adresa doručenia:</label><br>
	<textarea name="adresa" id="adresa" rows="3" cols="35"><?php if (isset($_POST["adresa"])) echo $_POST["adresa"]; ?></textarea>
</fieldset>
<fieldset>
	<legend>Údaje o objednávke</legend>
	<label for="kytica">Kytica:</label> 
	<select name="kytica" id="kytica">
<?php 
if (isset($_POST['kytica'])) 
	vypis_select_kytice($_POST['kytica']); 
else 
	vypis_select_kytice();
?>
	</select>
	<label for="pocet">počet kusov:</label>
	<select name="pocet" id="pocet">
<?php 
if (isset($_POST['pocet'])) 
	vypis_select(0, 20, $_POST['pocet']); 
else 
	vypis_select(0, 20);
?>
  </select><br>
	<label for="venovanie">Venovanie:</label><br>
	<textarea cols="30" rows="4" name="venovanie" id="venovanie"><?php if (isset($_POST["venovanie"])) echo $_POST["venovanie"]; ?></textarea><br>
	Dátum doručenia objednávky (deň.mes.rok): 
	<select name="den" id="den">
<?php 
if (isset($_POST['den'])) 
	vypis_select(1, 31, $_POST['den']); 
else 
	vypis_select(1, 31, date("j"));
?>
  </select> . 
  <select name="mesiac" id="mesiac">
<?php 
if (isset($_POST['mesiac'])) 
	vypis_select(1, 12, $_POST['mesiac']);
else 
	vypis_select(1, 12, date("n"));
?>
 </select> . <?php echo date("Y"); ?>
  <br>
  <?php 
		if ((date("G") == $sh_hodina) && (date("i") <= $sh_minuty)) echo "<em>$sh_text</em><br>\n"; 
	?>
	<label for="spolu">spolu:</label> <input name="spolu" type="text" id="spolu" value="0" size="10" maxlength="10" readonly>
</fieldset>
	<p><label for="suhlas">Súhlasím s podmienkami nákupu</label>
	<input name="suhlas" type="checkbox" id="suhlas" value="ano"<?php if (isset($_POST['suhlas']) && ($_POST["suhlas"]=="ano")) echo ' checked'; ?>></p>
<input type="submit" name="posli" value="Odošli objednávku">
</form>

</section>

<?php
include('akcie.php');
include('pata.php');
?>
