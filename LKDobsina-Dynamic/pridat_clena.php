<?php
    session_start();
    include('funkcie.php');
    hlavicka('Pridaj clena');
    /*------*/
    include('db.php');
    nav();
    aside_left();
?>
	<section>
		<?php 
if (isset($_SESSION['login_user']) && $_SESSION['admin']==1) {

$zobraz_form = true;

if (isset($_POST['posli']) && 
    isset($_POST['prihlasmeno']) && nazov_ok($_POST['prihlasmeno']) && 
    isset($_POST['heslo']) && nazov_ok($_POST['heslo']) && 
    isset($_POST['heslo2']) && nazov_ok($_POST['heslo2']) && ($_POST['heslo'] == $_POST['heslo2']) &&
    isset($_POST['meno']) && nazov_ok($_POST['meno']) &&
    isset($_POST['priezvisko']) && nazov_ok($_POST['priezvisko']) &&
    isset($_POST['mesto']) && nazov_ok($_POST['mesto']) &&
    isset($_POST['adresa']) && nazov_ok($_POST['adresa']) &&
    isset($_POST['psc']) && psc_ok($_POST['psc']) &&
    isset($_POST['mail']) && check_email($_POST['mail']) &&
    isset($_POST['admin']) && in_array($_POST['admin'], array('1', '0')) ) { 
    $meno = addslashes(htmlspecialchars(strip_tags($_POST['meno']))).' '.addslashes(htmlspecialchars(strip_tags($_POST['priezvisko'])));
	if (pridaj_clena($meno,
                addslashes(htmlspecialchars(strip_tags($_POST['mail']))),
                addslashes(htmlspecialchars(strip_tags($_POST['nick']))),
                addslashes(htmlspecialchars(strip_tags($_POST['vek']))),
                addslashes(htmlspecialchars(strip_tags($_POST['p']))),
                addslashes(htmlspecialchars(strip_tags($_POST['mesto']))),
                addslashes(htmlspecialchars(strip_tags($_POST['adresa']))),
                addslashes(htmlspecialchars(strip_tags($_POST['psc']))),
                addslashes(htmlspecialchars(strip_tags($_POST['tel_cislo']))),
                addslashes(htmlspecialchars(strip_tags($_POST['mail']))),
                $_POST['spravy'])){
                    pridaj_pouzivatela(
                                    addslashes(htmlspecialchars(strip_tags($_POST['prihlasmeno']))),
                                    addslashes(htmlspecialchars(strip_tags($_POST['heslo']))),
                                    addslashes(htmlspecialchars(strip_tags($_POST['mail']))),
                                    $_POST['admin']);
                    header('location: nastroje_admina.php?akcia=sprava_pouzivatelov');
    }
} else { 
	if (isset ($_POST['posli'])) {
		echo '<p class="chyba">Nezadali ste všetky údaje, resp. nemajú správny formát!</p>';
		if ($_POST['heslo'] != $_POST['heslo2'])
			echo '<p class="chyba">Nezadali ste 2x rovnaké nové heslo!</p>'; 
	}
}

if ($zobraz_form) {
?>
    <h2> Pridaj používateľa </h2>
	<form method="post">
        <fieldset>
            <legend>Prihlasovacie údaje</legend>
		    <label for="prihlasmeno">Prihlasovacie meno (5-20 znakov)*:</label> 
		    <input name="prihlasmeno" type="text" minlength="5" size="20" maxlength="20" id="prihlasmeno" required value="<?php if (isset($_POST["prihlasmeno"])) echo $_POST["prihlasmeno"]; ?>" ><br>
		    <label for="heslo">Heslo (6-30 znakov)*:</label> 
		    <input name="heslo" type="password" size="30" minlength="6" required maxlength="30" id="heslo"> 
		    <br>
		    <label for="heslo2">Heslo (znovu)*:</label> 
		    <input name="heslo2" type="password" size="30" required maxlength="30" id="heslo2">
            Práva administrátora: <input type="radio" name="admin" id="admin_ano" value="1"<?php if (isset($_POST['admin']) && $_POST["admin"]=="1") echo ' checked'; ?>> <label for="admin_ano">áno</label>
            <input type="radio" name="admin" id="admin_nie" checked value="0"<?php if (isset($_POST['admin']) && $_POST["admin"]=="0") echo ' checked'; ?>> <label for="admin_nie">nie</label>
        </fieldset>
		<fieldset>
            <legend> Základné údaje</legend>
		    <label for="meno">Meno (3-20 znakov)*:</label><input type="text" name="meno" id="meno" size="20" minlength="3" required value="<?php if (isset($_POST['meno'])) echo $_POST['meno'] ?>">
		    <br><label for="priezvisko">Priezvisko (3-30 znakov)*:</label><input type="text" name="priezvisko" id="priezvisko" minlength="3" required size="30" value="<?php if (isset($_POST['priezvisko'])) echo $_POST['priezvisko'] ?>">
            <br><label for="nick">Nick:</label> <input type="text" name="nick" id="nick" value="<?php if(isset($_POST['nick'])) echo $_POST['nick']; ?>"><br />
            <br>Pohlavie:* <label for="muz">Muž</label> <input type="radio" name="p" id="muz" required value='muz' <?php if(isset($_POST['p']) && $_POST['p'] == 'muz') echo 'checked'; ?>> | <input type="radio" name="p" id="zena" value='zena' <?php if(isset($_POST['p']) && $_POST['p'] == 'zena') echo 'checked'; ?>> <label for="zena">Žena</label>
		    <br><label for="vek">Vek:*</label> <input type="number" name="vek" id="vek" required min='6' value="<?php if(isset($_POST['vek'])) echo $_POST['vek']; ?>">
        </fieldset>
        <fieldset>
            <legend>Doplňujúce údaje</legend>
            <label for="mesto">Mesto (3-30 znakov)*:</label> <input type="text" name="mesto" id="mesto" minlength="3" required value="<?php if(isset($_POST['mesto'])) echo $_POST['mesto']; ?>"><br />
		    <label for="adresa">Adresa (3-50 znakov)*:</label> <input type="text" name="adresa" id="adresa" minlength="3" required value="<?php if(isset($_POST['adresa'])) echo $_POST['adresa']; ?>"><br />
		    <label for="psc">PSČ*:</label> <input type="text" name="psc" id="psc" required value="<?php if(isset($_POST['psc'])) echo $_POST['psc']; ?>"><br />
		    <label for="tel_cislo">Telefón(Mobil):</label> <input type="text" name="tel_cislo" id="tel_cislo" value="<?php if(isset($_POST['tel_cislo'])) echo $_POST['tel_cislo']; ?>"><br />
		    <label for="mail">E-mail*:</label> <input type="text" name="mail" id="mail" placeholder='example@email.com' required value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; ?>"><br />
            <br><label for="spravy">Chceš dostávať dôležité správy mailom?</label> <input type="checkbox" name="spravy" id="spravy" checked> <br>
		</fieldset>
        Polia označené * sú povinné.<br>
	    <input name="posli" type="submit" id="posli" value="Pridaj používateľa">
	</form>
<?php
}
  
} else { // ci je prihlaseny nejaky pouzivatel (typu administrator)
	echo '<p><strong>K tejto stránke nemáte prístup.</strong></p>'; 
}
  
?>
	</section>
    <?php
        aside_right();
        footer();
?>