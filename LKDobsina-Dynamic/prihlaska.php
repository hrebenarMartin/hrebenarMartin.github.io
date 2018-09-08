<?php
    session_start();
    include('funkcie.php');
    hlavicka('Prihláška');
    /*------*/
    include('db.php');
    nav();
    aside_left();
    echo "<section>\n";
    if(isset($_POST['posli'])&& 
       isset($_POST['meno']) && nazov_ok($_POST['meno']) &&
       isset($_POST['priezvisko']) && nazov_ok($_POST['priezvisko']) &&
       isset($_POST['p']) &&
       isset($_POST['vek']) && 
       isset($_POST['mesto']) &&  nazov_ok($_POST['esto']) &&
       isset($_POST['adresa']) && nazov_ok($_POST['adresa']) &&
       isset($_POST['psc']) &&  psc_ok($_POST['psc']) &&
       isset($_POST['mail']) && check_email($_POST['mail'])){
            if (isset($_POST['tel_cislo'])) $tel = addslashes(htmlspecialchars(strip_tags($_POST['tel_cislo'])));
            else $tel = '-';
            if(isset($_POST['spravy'])) $news = 1;
            else $news = 0;
            posli_prihlasku(addslashes(htmlspecialchars(strip_tags($_POST['meno']))),
                            addslashes(htmlspecialchars(strip_tags($_POST['priezvisko']))),
                            addslashes(htmlspecialchars(strip_tags($_POST['p']))),
                            addslashes(htmlspecialchars(strip_tags($_POST['vek']))),
                            addslashes(htmlspecialchars(strip_tags($_POST['mesto']))),
                            addslashes(htmlspecialchars(strip_tags($_POST['adresa']))),
                            addslashes(htmlspecialchars(strip_tags($_POST['psc']))),
                            addslashes(htmlspecialchars(strip_tags($_POST['mail']))),$tel,$news);
            unset($_POST);
       }
?>
	
		<h2>Prihláška</h2>
		<form method="post">
			<fieldset>
				<legend>Základné údaje</legend>
				<label for="meno">Meno:* (3-30 znakov)</label> <input type="text" name="meno" id="meno" size="15" required value="<?php if(isset($_POST['meno'])) echo $_POST['meno']; ?>"><br>
				<label for="priezvisko">Priezvisko:* (3-50 znakov)</label> <input type="text" name="priezvisko" id="priezvisko" size="30" required value="<?php if(isset($_POST['priezvisko'])) echo $_POST['priezvisko']; ?>">
				<br>Pohlavie:* <label for="muz">Muž</label> <input type="radio" name="p" id="muz" required value='muz' <?php if(isset($_POST['p']) && $_POST['p'] == 'muz') echo 'checked'; ?>> | <input type="radio" name="p" id="zena" value='zena' <?php if(isset($_POST['p']) && $_POST['p'] == 'zena') echo 'checked'; ?>> <label for="zena">Žena</label>
				<br> <label for="vek">Vek:*</label> <input type="number" name="vek" id="vek" required min='6' value="<?php if(isset($_POST['vek'])) echo $_POST['vek']; ?>">
			</fieldset>
			<fieldset>
				<legend>Kontaktné údaje</legend>
				<label for="mesto">Mesto:* (3-30 znakov)</label> <input type="text" name="mesto" id="mesto" required value="<?php if(isset($_POST['mesto'])) echo $_POST['mesto']; ?>"><br />
				<label for="adresa">Adresa:* (3-30 znakov)</label> <input type="text" name="adresa" id="adresa" required value="<?php if(isset($_POST['adresa'])) echo $_POST['adresa']; ?>"><br />
				<label for="psc">PSČ:*</label> <input type="text" name="psc" id="psc" required value="<?php if(isset($_POST['psc'])) echo $_POST['psc']; ?>"><br />
				<label for="tel_cislo">Telefón(Mobil):</label> <input type="text" name="tel_cislo" id="tel_cislo" value="<?php if(isset($_POST['tel_cislo'])) echo $_POST['tel_cislo']; ?>"><br />
				<label for="mail">E-mail:*</label> <input type="text" name="mail" id="mail" required value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; ?>"><br />
			</fieldset>
			<label for="spravy">Chceš dostávať dôležité správy mailom?</label> <input type="checkbox" name="spravy" id="spravy" checked> <br>
			*: povinná informácia<br />
			<input type="submit" name="posli" id="posli" value="Pošli prihlášku">
		</form>
	</section>
    <?php
        aside_right();
        footer();
?>