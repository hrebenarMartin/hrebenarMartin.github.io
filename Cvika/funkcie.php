<?php
date_default_timezone_set('Europe/Bratislava');


function vypis_select($zac, $kon, $default = 0) {
	for($i = $zac; $i <= $kon; $i++) {
		echo "<option value='$i'";
		if ($i == $default) echo ' selected';
		echo ">$i</option>\n";
	}
}
	
function hlavicka($nadpis) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $nadpis; ?></title>
<link href="styly.css" rel="stylesheet">
</head>

<body>

<header>
<h1><?php echo $nadpis; ?></h1>
</header>
<?php
}

function vypis_select_kytice($default = 0) {
	global $mysqli;
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM kvety_tovar WHERE na_sklade > 0 ORDER BY nazov ASC"; // definuj dopyt
		if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
			// dopyt sa podarilo vykonať
			while ($row = $result->fetch_assoc()) {
				echo "<option value='" . $row['kod'] . "'";
				if ($row['kod'] == $default) echo ' selected';
				echo '>' . $row['nazov'] . ' (' . $row['cena'] . " &euro;)</option>\n";
			}
			$result->free();
		}
	}
}

/* kontroluje meno (meno a priezvisko)
vráti TRUE, ak celé meno ($m) obsahuje práve 1 medzeru, pred a za medzerou sú časti aspoň dĺžky 3 znaky
*/
function spravne_meno($m) {
  $medzera = strpos($m, ' ');
  if (!$medzera) return false;       
  $priezvisko = substr($m, $medzera+1);  
  return ($medzera > 2 && (strpos($priezvisko, ' ') === FALSE) && strlen($priezvisko) > 2);
}

function vypis_kosik() {
  global $kvety;
	echo '<p><strong>Obsah košíka:</strong></p>';
	echo '<p>Adresa doručenia: ' . $_SESSION["adresa"] . '</p>';
	$cena = 0;
	foreach ($_SESSION['kytica'] as $kluc => $hodn) {
		echo '<p>Kytica: <strong>' . $kvety[$kluc]['nazov'] . '</strong> v počte kusov <strong>' . $_SESSION['kytica'][$kluc] . '</strong></p>'; 
		$cena += cena_objednavky($kluc, $hodn); 
	}
	echo '<p>Cena: ' . $cena . ' &euro;</p>';  
?>
	<form method="post">
		<p><input type="submit" name="zrus" value="Zruš obsah košíka"></p>
	</form>
<?php
}

// vráti TRUE, ak je adresa neprázdna
function spravna_adresa($a) {
	$a = addslashes(htmlspecialchars(strip_tags($a)));
  return $a != '';
}

// vráti TRUE, ak počet objednaných kytíc > 0
function spravny_pocet($p){
  $p = addslashes(htmlspecialchars(strip_tags($p)));
  return ($p > 0);
}

// vráti TRUE, ak bol označený checkbox so súhlasom 
function suhlas_spodmienkami($s){
  $s = addslashes(htmlspecialchars(strip_tags($s)));
  return ($s == "ano");
}

// vráti celkovú cenu objednávky pre kyticu $ind s počtom kusov $poc 
function cena_objednavky($ind, $poc) {
  $ind = addslashes(htmlspecialchars(strip_tags($ind)));
  $poc = addslashes(htmlspecialchars(strip_tags($poc)));
  global $kvety;
  return $kvety[$ind]['cena'] * $poc;
}

// vráti TRUE, ak zadané číslo kytice existuje 
function spravna_kytica($k){
  $k = addslashes(htmlspecialchars(strip_tags($k)));
  global $kvety;
  return (isset($kvety[$k]));
}

function nazov_ok ($nazov) {
	$nazov = addslashes(strip_tags(trim($nazov)));
	return strlen($nazov) >= 3 && strlen($nazov) <= 100;
}

function popis_ok ($popis) {
	$popis = addslashes(strip_tags(trim($popis)));
	return strlen($popis) >= 10;
}

function cena_ok ($cena) {
	return (1 * $cena) > 0;
}

function sklad_ok ($sklad) {
	return (1 * $sklad) > 0;
}

function pridaj_kyticu() {
	global $mysqli;
	if (!$mysqli->connect_errno) {
		$nazov = $mysqli->real_escape_string($_POST['nazov']);
		$popis = $mysqli->real_escape_string($_POST['popis']);
		$cena = $mysqli->real_escape_string($_POST['cena']);
		$na_sklade = $mysqli->real_escape_string($_POST['na_sklade']);

		$sql = "INSERT INTO kvety_tovar SET nazov='$nazov', popis='$popis', cena='$cena', na_sklade='$na_sklade'"; // definuj dopyt
	
		if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
 	    echo '<p>Kytica s kódom <strong>'. $mysqli->insert_id .'</strong> bola pridaná.</p>'. "\n"; 
		} elseif ($mysqli->errno) {
			echo '<p class="chyba">Nastala chyba pri pridávaní kytice. (' . $mysqli->error . ')</p>';
		}
	}
}	// koniec funkcie

function vypis_kytice_uprav_zrus() {
?>
	<p><a href="pridaj.php">pridaj kyticu</a></p>
<?php
	global $mysqli;
	if (!$mysqli->connect_errno) {
		$sql="SELECT * FROM kvety_tovar ORDER BY nazov ASC";
		if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
			// dopyt sa podarilo vykonať
			echo '<form method="post">';
			echo '<p>'; 
			while ($row = $result->fetch_assoc()) {
    		echo "<input type='checkbox' name='tovar[]' value='{$row['kod']}' id='tovar{$row['kod']}'><label for='tovar{$row['kod']}'>{$row['nazov']}</label><br>\n";
			} 
			echo '</p>'; 
  		echo '<p><input type="submit" name="zrus" value="Zruš kytice"></p>';
  		echo '</form>';
			$result->free();
  	} else {
			// NEpodarilo sa vykonať dopyt!
    	echo '<p class="chyba">Nastala chyba pri získavaní údajov z DB.</p>' . "\n";
    }
	}
}

// zrusi kyticu c. $idk z tabulky kvety_tovar
function zrus_kyticu($idk) {
	global $mysqli;
	if (!$mysqli->connect_errno) {
		$sql="DELETE FROM kvety_tovar WHERE kod='$idk'"; // definuj dopyt
		if ($result = $mysqli->query($sql) && ($mysqli->affected_rows > 0)) {  // vykonaj dopyt
			// dopyt sa podarilo vykonať
	    echo "<p>Kytica č. $idk bola zrušená.</p>\n"; 
  	} else {
			// NEpodarilo sa vykonať dopyt!
    	echo "<p class='chyba'>Nastala chyba pri rušení kytice č. $idk.</p>\n";
    }
	}
} 	// koniec funkcie

// vypise tabulku vsetkych objednavok s odkazom na podrobne udaje o konkretnej objednavke
function vypis_objednavky() {
	global $mysqli;
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM kvety_objednavky, kvety_pouzivatelia WHERE kvety_objednavky.id_pouz = kvety_pouzivatelia.id_pouz ORDER BY id ASC"; // definuj dopyt
//		echo "sql = $sql <br>";
		if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
			// dopyt sa podarilo vykonať
			echo '<table>';
			echo '<tr><th>číslo objednávky</th><th>meno a priezvisko</th><th>dátum doručenia</th><th>cena</th></tr>';
			while ($row = $result->fetch_assoc()) {
				echo '<tr><td><a href="administracia.php?kod=' . $row['id'] . '">' . $row['id'] . '</a></td><td>' . $row['meno'] . ' ' . $row['priezvisko'] . '</td><td>' . $row['kedy_dorucit'] . '</td><td>' . $row['cena_spolu'] . '&euro;</td>';
				echo "</tr>\n";
			}
			echo '</table>';
			$result->free();
		} else {
			// dopyt sa NEpodarilo vykonať!
			echo '<p class="chyba">NEpodarilo sa získať údaje z databázy</p>';
		}
	}
}

function vypis_objednavku($id) {
	// do premennej $row treba priradiť jednotlivé položky objednávky $id 
	global $mysqli;
	if (!$mysqli->connect_errno) {
		$id = $mysqli->real_escape_string($id);
		$sql = "SELECT * FROM kvety_objednavky, kvety_tovar, kvety_pouzivatelia WHERE kvety_objednavky.kytica = kvety_tovar.kod AND kvety_objednavky.id='$id' AND kvety_objednavky.id_pouz = kvety_pouzivatelia.id_pouz"; // definuj dopyt
//		echo "sql = $sql <br>";
		if (($result = $mysqli->query($sql)) && ($row = $result->fetch_assoc()) ) {  // vykonaj dopyt
			echo '<table border="1">';
			echo "<tr><th>číslo objednávky</th><td>{$row['id']}</td></tr>\n";
			echo "<tr><th>meno a priezvisko</th><td>{$row['meno']} {$row['priezvisko']}</td></tr>\n";
			echo "<tr><th>adresa doručenia</th><td>{$row['adresa']}</td></tr>\n";
			echo "<tr><th>kytica</th><td>{$row['nazov']}</td></tr>\n";
			echo "<tr><th>počet</th><td>{$row['pocet']}</td></tr>\n";
			echo "<tr><th>venovanie</th><td>{$row['venovanie']}</td></tr>\n";
			echo "<tr><th>dátum doručenia</th><td>{$row['kedy_dorucit']}</td></tr>\n";
			echo "<tr><th>cena</th><td>{$row['cena_spolu']} &euro;</td></tr>\n";
			echo '</table>';
		} else {
			// dopyt sa NEpodarilo vykonať!
			echo '<p class="chyba">NEpodarilo sa získať údaje z databázy, resp. objednávka neexistuje</p>' . $mysqli->error ;
		}
	}
}

// vrati udaje pouzivatela ako asociativne pole, ak existuje pouzivatel $username s heslom $pass, inak vrati FALSE
function over_pouzivatela($username, $pass) {
	global $mysqli;
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM kvety_pouzivatelia WHERE prihlasmeno='$username' AND heslo=MD5('$pass')";  // definuj dopyt
//		echo "sql = $sql <br>";
		if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {  // vykonaj dopyt
			// dopyt sa podarilo vykonať
			$row = $result->fetch_assoc();
			$result->free();
			return $row;
		} else {
			// dopyt sa NEpodarilo vykonať, resp. používateľ neexistuje!
			return false;
		}
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		return false;
	}
}

// zmeni heslo $pass pouzivatelovi s id cislom $id
function zmen_heslo($id, $pass) {
    $pouz = new User($_SESSION['user'],$_SESSION['meno'],$_SESSION['heslo'],$_SESSION['priezvisko'],$_SESSION['admin']);
    $pouz->zmen_heslo($id, $pass);
    
    //global $mysqli;
    //if (!$mysqli->connect_errno) {
    //  $sql="UPDATE kvety_pouzivatelia SET heslo=MD5('$pass') WHERE id_pouz='$id'"; // definuj dopyt   
    //    echo "sql = $sql <br>";
    //    if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
    //         dopyt sa podarilo vykonať
    //  echo '<p>Heslo bolo zmenené.</p>'. "\n"; 
    //} else {
    //         NEpodarilo sa vykonať dopyt!
    //  echo '<p class="chyba">Nastala chyba pri zmene hesla.</p>'. "\n"; 
    //    }
    //} else {
    //     NEpodarilo sa spojiť s databázovým serverom alebo vybrať databázu!
    //    echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
    //}
}	// koniec funkcie

function pridaj_pouzivatela() {

    $pouz = new User($_POST['prihlasmeno'],$_POST['meno'],$_POST['heslo'],$_POST['priezvisko'],$_POST['admin']);   
    $pouz->pridaj(); 

    //global $mysqli;
    //if (!$mysqli->connect_errno) {
    //    $prihlasmeno = $mysqli->real_escape_string($_POST['prihlasmeno']);
    //    $heslo = $mysqli->real_escape_string($_POST['heslo']);
    //    $meno = $mysqli->real_escape_string($_POST['meno']);
    //    $priezvisko = $mysqli->real_escape_string($_POST['priezvisko']);
    //    $admin = isset($_POST['admin']) && ($mysqli->real_escape_string($_POST['admin']) == '1') ? 1 : 0;
    //    $sql = "INSERT INTO kvety_pouzivatelia SET prihlasmeno='$prihlasmeno', heslo=MD5('$heslo'), meno='$meno', priezvisko='$priezvisko', admin='$admin'"; // definuj dopyt
    //    if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
    //        // dopyt sa podarilo vykonať
    //    echo '<p>Používateľ bol pridaný.</p>'. "\n"; 
    //        return true;
    //     } else {
    //        // NEpodarilo sa vykonať dopyt!
    //        echo '<p class="chyba">Nastala chyba pri pridávaní používateľa';
    //        // kontrola, či nenastala duplicita kľúča (číslo chyby 1062) - prihlasovacie meno už existuje
    //        if ($mysqli->errno == 1062) echo ' (zadané prihlasovacie meno už existuje)';
    //        echo '.</p>' . "\n";
    //        return false;
    //  }
    //} else {
    //    // NEpodarilo sa spojiť s databázovým serverom alebo vybrať databázu!
    //    echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
    //    return false;
    //}
}	// koniec funkcie
?>
