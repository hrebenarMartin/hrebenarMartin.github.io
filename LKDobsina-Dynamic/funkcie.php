<?php
//        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
function hlavicka($nadpis){
?>
    <!DOCTYPE html>
    <html lang="sk">
        <?php $_SESSION['last_page'] = $_SERVER['PHP_SELF'];date_default_timezone_set("CET");?>
        <head>
	    <meta charset="utf-8">
		<link rel="shortcut icon" href="Obrazky/logo_ico.ico">
	    <link rel="stylesheet" type="text/css" href="style_basic.css" media="all">
	    <link rel="stylesheet" type="text/css" href="style_min.css" media="screen and (min-width: 721px)">
	    <link rel="stylesheet" type="text/css" href="style_full.css" media="screen and (min-width: 1281px)">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	    <title><?php echo $nadpis; ?></title>
    </head>
    <body>
    <header class="main_header">
		Lukostrelecký klub Dobšiná
	</header>
<?php
    }

    function aside_right(){
?>
    <aside class="aside_right">
		<img src="Obrazky/logo.jpg" alt="logo">
		<div>
			<h3>Najbližšie súťaže</h3>
			<ul>
                <?php
                    najblizsie_sutaze();
                ?>
			</ul>
		</div>
		<div class="socialne_siete">
			<h3>Nájdete nás na:</h3>
			<a href="https://www.facebook.com/LukostreleckyKlubDobsina/?fref=ts"><i class="fa fa-facebook fcb"></i></a>
			<a href="#"><i class="fa fa-instagram insta"></i></a>
			<a href="#"><i class="fa fa-google gplus"></i></a>
		</div>
	</aside>
<?php
    }

    function aside_left(){
?>
    <aside class="aside_left">
		<div>
			<p class="nav_path"><a href="index.php">Domov</a></p>
            <ul>
                <li class="active"><a href="index.php">Domov</a></li>
				<li><a href="o_nas.php">O nás</a></li>
				<li><a href="prihlaska.php">Prihláška</a></li>
				<li><a href="kontakt.php">Kontakt</a></li>
                <li><a href="template.php">Template</a></li>
            </ul>
		</div>
		<div class="partneri">
			<h4>Partneri:</h4>
			<a href="http://www.archery3d.sk"><img src="Obrazky/sla3d-logo.svg" alt="sla_logo"></a>
			<a href="http://www.dobsina.sk"><img src="Obrazky/erb_dobsina1.png" alt="erb_dobsina"></a>
			<a href="http://www.mldobsina.sk/"><img src="Obrazky/lesy_logo.png" alt="logo_lesy"></a>
		</div>
	</aside>
<?php
    }

    function footer(){
?>
    <footer class="main_footer">
		<p>Vytvoril: <strong>Martin Hrebeňár 2017</strong></p>
		<img src="Obrazky/logo.jpg" alt="logo">
	</footer>
    </body>
    </html>
<?php
    }

    function nav(){
?>
	<div id='logInOut_compensation'><a href='logout.php' class='button'></a></div>
    <nav>
		<a href="index.php" class="button"><i class="fa fa-home"></i>Domov</a>
        <a href="sutaze.php" class="button"><i class="fa fa-calendar"></i>Súťaže</a>
        <?php
        if (!isset($_SESSION['login_user'])) echo "<a href='prihlaska.php' class='button'><i class='fa fa-file-text'></i>Prihláška</a>";
        ?>
        <a href="o_nas.php" class="button"><i class="fa fa-question-circle"></i>O Nás</a>
		<a href="kontakt.php" class="button"><i class="fa fa-phone"></i>Kontakt</a>
        <?php
            if (isset($_SESSION['login_user']) && isset($_SESSION['id'])){ 
                echo "<a href='profil.php?id=".$_SESSION['id']."' class='button login'><i class='fa fa-id-card'></i>Profil</a>\n";
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) echo "<a href='nastroje_admina.php' class='button login'><i class='fa fa-cog'></i>Administrácia</a>\n";;
            }
        ?>
	</nav>
	<?php   
            if (!isset($_SESSION['login_user'])) echo "<div id='logInOut'><a href='login.php' class='button login'><i class='fa fa-chevron-right'></i>LogIn</a></div>";
            else { 
                echo "<div id='logInOut'><a href='logout.php' class='button login'><i class='fa fa-chevron-right'></i>Odhlásiť(".$_SESSION['login_user'].")</a></div>\n";
            }
        ?>
<?php
    }

    //Funkcia overuje prihlasovacie údaje
    function check_user($name, $pass, $check = 0){
        global $mysqli;
         
          $myusername = mysqli_real_escape_string($mysqli,$name);
          $mypassword = mysqli_real_escape_string($mysqli,$pass); 
          $sql = "SELECT * FROM users WHERE user_name = '$myusername' and user_password = MD5('$mypassword')";
          $result = $mysqli->query($sql);
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);      
          $count = mysqli_num_rows($result);
      
          // If result matched $myusername and $mypassword, table row must be 1 row
		  
          if($count == 1) {
             if($check == 0){
                $_SESSION['login_user'] = $myusername;
                 $_SESSION['id'] = $row['ID'];
                 $_SESSION['admin'] = $row['Admin'];
             
                 $result->free();
                 header("location: index.php");
             }else if ($check == 1) {
                return true;
             }
             
          }else {
             return false;
          }
      }
    
    //Vypíše zoznam súťaží z databázy
    function vypis_sutaze($filter){
        global $mysqli;

        $dnes = date("Y-m-d");

        if (!$mysqli->connect_errno) {
  
            if ($filter == 'Všetky súťaže') $sql = "SELECT * FROM sutaze ORDER BY datum_zac";
            else if ($filter == 'Len budúce súťaže') $sql = "SELECT * FROM sutaze WHERE datum_zac > '$dnes' ORDER BY datum_zac";
            else if ($filter == 'Len minulé súťaže') $sql = "SELECT * FROM sutaze WHERE datum_zac <= '$dnes' ORDER BY datum_zac";
            else $sql = "SELECT * FROM sutaze ORDER BY datum_zac";


            //echo $sql;
            if ($result = $mysqli->query($sql)){
                echo '<table id="sutaze">';
                echo "<tr><td>Dátum</td><td>Názov súťaže</td><td>Prihlásenie</td></tr>";
	            while ($row = $result->fetch_assoc()) {
                    $date = explode('-', $row['datum_zac']);
		            echo "<tr><td><span>" . $date[2] . '</span>.<span>' . $date[1] . '</span></td><td><a href="sutaze.php?id=' . $row['id'] . '"><strong>' . $row['nazov'] . "</strong></a></td>\n";
                    if (isset($_SESSION['login_user'])) {
                        if ($row['prihlasovanie_do'] > $dnes) {
                            if (!skontroluj_prihlasenie($_SESSION['id'], $row['id'])) echo "<td><a href='sutaze.php?id=".$row['id']."&akcia=prihlasit'>Prihlásiť na súťaž.</a></td>\n";
                            else echo "<td><a href='sutaze.php?id=".$row['id']."&akcia=odhlasit'>Odhlásiť sa zo súťaže.</a></td>\n";
                        } else {
                            echo "<td>Po termíne prihlasovania.</td>\n";
                        }
                    }else {
                        echo "<td>Prihlasovať sa môžu len prihlásený pouívatelia.</td>";
                    }
                    echo "</tr>";
	            }
                echo "</table>";
	            $result->free();
            }else{
                echo "<br>Nepodarilo sa vykonat dopyt";
            }
        }else {
            echo "Nepodarilo sa pripojiť k databáze.";
        }
    }

    //Funkcia zistí, či práve prihlásený pouívateľ je už prihlásený na vybranú súťaž
    function skontroluj_prihlasenie($id, $ids){
        global $mysqli;

        $sql = "SELECT * FROM sutaze WHERE id=$ids";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $row = $result->fetch_assoc();
                $prihl = explode(',',$row['prihlaseny']);
                /*echo count($row['prihlaseny']);
                print_r($row['prihlaseny']);
                print_r($prihl);
                echo "<br>";*/
                foreach ($prihl as $tmp){
                    if ($tmp == $id) return true;
                }
                return false;
            }return false;
        }return false;
        return false;
    }

    //Funkcia prihlási práve prihláseného používateľa na vybranú sútaž
    function prihlasit_sutaz($id, $ids){
        global $mysqli;

        $sql = "SELECT * FROM sutaze WHERE id=$ids";
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $row = $result->fetch_assoc();
                $prihl = explode(',',$row['prihlaseny']);
                array_push($prihl, $id);
                $tmp = implode(',',$prihl);
                $result->free();

                $sql = "UPDATE sutaze SET prihlaseny='$tmp' WHERE id=$ids";
                if ($result = $mysqli->query($sql)){
                    echo "<h1>Bol si prihlásený na súťaž.<h1>";
                }else echo "Nastala chyba pri spracovaní dopytu1.";
            }else echo "Nastala chyba pri spracovaní dopytu2.";
        }else echo "Nastala chyba pri spripájaní k databáze";
    }

    //Funkcia odhlási prihláseného používateľa z vybranej súťaže
    function odhlasit_sutaz($id, $ids){
        global $mysqli;

        $sql = "SELECT * FROM sutaze WHERE id=$ids";
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $row = $result->fetch_assoc();
                $prihl = explode(',',$row['prihlaseny']);
                $tmp = array_search($id, $prihl);
                unset($prihl[$tmp]);// = '';
                $tmp = implode(',', $prihl);
                $result->free();

                $sql = "UPDATE sutaze SET prihlaseny='$tmp' WHERE id=$ids";
                if ($result = $mysqli->query($sql)){
                    echo "<h1>Bol si Odhlásený zo súťaže.<h1>";
                }else echo "Nastala chyba pri spracovaní dopytu.";
            }else echo "Nastala chyba pri spracovaní dopytu.";
        }else echo "Nastala chyba pri spripájaní k databáze";
    }
    
    //Vypíše detailne vybranú súťaž
    function vypis_sutaz($id){
        global $mysqli;

        $sql = "SELECT * FROM sutaze WHERE id='$id'";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $count = mysqli_num_rows($result);
                if ($count > 0 && is_numeric($id)){

                    $row = $result->fetch_assoc();
                    $dnes = date("Y-m-d");
                    echo "<h1>".$row['nazov']."<br>( ".$row['typ']." )</h1>\n";
                    echo "<div class='sutaz'><div class='sutaz_1'>Limit počtu súťažiacich:</div><div class='sutaz_2'>".$row['pocet']."</div><br></div><div class='sutaz_3'></div>\n";
                    echo "<div class='sutaz'><br><div class='sutaz_1'>Dátum konania:</div><div class='sutaz_2'>".$row['datum_zac']." - ".$row['datum_kon']."</div><br></div><div class='sutaz_3'></div>\n";
                    echo "<div class='sutaz'><br><div class='sutaz_1'>Na súťaž je možné prihlásiť sa do:</div><div class='sutaz_2'>".$row['prihlasovanie_do'];

                    //neponúkne prihlásenie ak už prihlásený je alebo ak je po dátume prihlasovania
                    if (isset($_SESSION['login_user']) && !skontroluj_prihlasenie($_SESSION['id'], $_GET['id']) && $row['prihlasovanie_do'] > $dnes) echo "<a href='sutaze.php?id=".$_GET['id']."&akcia=prihlasit'> Prihlásiť sa.</a></div><br></div><div class='sutaz_3'></div>\n";
                    else echo "</div><br></div><div class='sutaz_3'></div>\n";
                
                    echo "<div class='sutaz'><br><div class='sutaz_1'>Miesto konania:</div><div class='sutaz_2'>".$row['miesto']."</div><br></div><div class='sutaz_3'></div>\n";
                    echo "<div class='sutaz'><br><div class='sutaz_1'>GPS súradnice miesta konania:</div><div class='sutaz_2'>".$row['GPS']."</div><br></div><div class='sutaz_3'></div>\n";
                    echo "<div class='sutaz'><br><div class='sutaz_1'>Popis:</div><div class='sutaz_2'>".$row['popis']."</div><br></div><div class='sutaz_3'></div>\n";
                    echo "<div class='sutaz'><br><div class='sutaz_1'>Kto sa prihlásil:</div><div class='sutaz_2'>";
                    $prihlas = explode(',', $row['prihlaseny']);
                    $result->free();
                
                    //Vypíše všetkých prihlásených
                    if (count($prihlas) > 1){
                        foreach($prihlas as $tmp){
                            $sql = "SELECT * FROM profiles WHERE ID=$tmp";
                            if ($result = $mysqli->query($sql)){
                                $row = $result->fetch_assoc();
                                if (isset($_SESSION['id']) && $tmp == $_SESSION['id']) echo "<p><a href='profil.php?id=$tmp'>".$row['meno']."</a> --- ".$row['licencia']." ( <a href='sutaze.php?id= ".$_GET['id']."&akcia=odhlasit'>Odhlásiť</a> )</p>\n";
                                else echo "<p><a href='profil.php?id=$tmp'>".$row['meno']."</a> --- ".$row['licencia']."</p>\n";
                                $result->free();
                            } 
                        }
                    }else echo "<p>Zatiaľ nikto.</p>\n";
                    echo "</div></div><div class='sutaz_3'></div>";
                }else echo "<p class='permission_error'>Súťaž s takýmto ID neexistuje.</p>";
            }else echo "<p class='permission_error'>Dopyt z databázy bol neúspešný, skúste to prosím neskôr.</p>";
        }else echo "<p class='permission_error'>Chyba pri spojení s databázou, skúste to prosím neskôr.</p>";

    }   
     
    //Vypíše 3 najbližšie súťaže
    function najblizsie_sutaze(){
        global $mysqli;
        $dnes = date("Y-m-d");
        
        $sql = "SELECT * FROM sutaze WHERE datum_zac > '$dnes' ORDER BY datum_zac LIMIT 3";
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                 while ($row = $result->fetch_assoc()) {
                     $date = explode('-', $row['datum_zac']);
                     echo "<li>\n<p><strong>".$date[2].'.'.$date[1].'</strong>   '.$row['nazov'];
                     echo '</p><span class="info">';
			         echo 'Dátum: '.$date[2].'.'.$date[1] .'<br>Názov: '.$row['nazov'].'<br>Miesto konania: '.$row['miesto'].'<br />';
			         echo 'Typ: '. $row['typ'] .'<br /></span></li>';
                 }
                 $result->free();
            }else {
                echo "Nic som nenasiel.";
            }
         }else echo "Chyba pri pripájaní sa k databáze." ;
    }

    function vypis_profil($id, $akcia){
        global $mysqli;

        $sql = "SELECT * FROM profiles WHERE ID=$id";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $row = $result->fetch_assoc();
                $count = mysqli_num_rows($result);
                if ($count > 0 && is_numeric($id) && is_numeric($akcia)){
                    //ak $akcia == 1 znamená že uívateľ chce meniť údaje a tak vypíše formulár
                    echo "<div id='prof_pic'>";
                    if (file_exists('Obrazky/Profiles/'.$id.'.png')){
                          echo "<img class='profile_picture' src=Obrazky/Profiles/".$id.".png alt='profilova foto'>";
                    }else echo "<img class='profile_picture' src=Obrazky/profile-placeholder.png alt='profilova foto'>";
                    echo "</div>";
                    if($akcia == 1){
                        echo "<form method='post' enctype='multipart/form-data' action='profil.php?id=".$_GET['id']."'>\n<div id='prof_pic'>";
                        echo "\n<input type='file' name='obrazok' id='profil_obr' accept='image/png'>\n";
                        echo "</div>\n";
                        echo "\n<h2 id='meno_pouz'>".$row['meno']."</h2>\n";
                        echo "<p id='id_pouz'>(#".$id.")</p>\n";
                        echo "<h5 class='nadpis_info'>Bio:</h5><p><textarea name='bio' class='uprav_input' rows='6'>".$row['bio']."</textarea></p>\n";
                        echo "<div class='info50'><h5 class='nadpis_info'>Základné informácie:</h5>";
                        echo "<h6>E-Mail:</h6><p class='popis_info_2'>".$row['email']."</p>";
                        echo "<h6>Nick:</h6><p class='popis_info_2'><input type='text' name='nick' class='uprav_input' value='".$row['nick']."'></p>";
                        echo "<h6>Vek:</h6><p class='popis_info_2'>".$row['vek']."</p>";
                        echo "<h6>Adresa:</h6><address id='adresa_info'><input type='text' name='mesto' class='uprav_input' value='".$row['mesto']."' required><br>
                              <input type='text' name='adresa' class='uprav_input' value='".$row['adresa']."' required><br>
                              <input type='text' name='psc' class='uprav_input' value='".$row['psc']."' required></address>";
                        echo "<h6>Mobil:</h6><p class='popis_info_2'><input type='text' name='mobil' class='uprav_input' value='".$row['mobil']."'></p></div>";
                        echo "<div class='info50'><h5 class='nadpis_info'>Informácie o luku:</h5>";
                        echo "<h6>Divízia</h6><p class='popis_info_2'><input type='text' name='divizia' class='uprav_input' value='".$row['divizia']."'></p>";
                        echo "<h6>Licencia:</h6><p class='popis_info_2'><input type='text' name='licencia' class='uprav_input' value='".$row['licencia']."'></p></div>";
                        echo "\n<input type='submit' name='uloz_zmeny' id='posli' value='uloz zmeny'>\n</form>";
                    }else if($akcia == 0){ // inak vypíše len údaje
                        if (isset($_SESSION['id']) && $id == $_SESSION['id'])echo "<p id='zmen_udaje'><a href='profil.php?id=".$id."&akcia=1'>Zmen udaje</a></p>\n<p id='zmen_heslo'><a href='profil.php?id=".$id."&akcia=2'>Zmen heslo</a></p>";
                        echo "\n<h2 id='meno_pouz'>".$row['meno']."</h2>\n";
                        echo "<p id='id_pouz'>(#".$id.")</p>\n";
                        echo "<h5 class='nadpis_info'>Bio:</h5><p class='popis_info'>".$row["bio"]."</p>\n";
                        echo "<div class='info50'><h5 class='nadpis_info'>Základné informácie:</h5>";
                        echo "<h6>E-Mail:</h6><p class='popis_info_2'>".$row['email']."</p>";
                        echo "<h6>Nick:</h6><p class='popis_info_2'>".$row['nick']."</p>";
                        echo "<h6>Vek:</h6><p class='popis_info_2'>".$row['vek']."</p>";
                        echo "<h6>Adresa:</h6><address id='adresa_info'>".$row['mesto']."<br>".$row['adresa']."<br>".$row['psc']."</address>";
                        echo "<h6>Mobil:</h6><p class='popis_info_2'>".$row['mobil']."</p></div>";
                        echo "<div class='info50'><h5 class='nadpis_info'>Informácie o luku:</h5>";
                        echo "<h6>Divízia:</h6><p class='popis_info_2'>".$row['divizia']."</p>";
                        echo "<h6>Licencia:</h6><p class='popis_info_2'>".$row['licencia']."</p></div>";
                    }else if($akcia == 2){
                        echo "<h2>Zmena hesla</h2>\n<form method='post'>\n";
                        echo '<label for="s_heslo">Staré heslo:</label> 
		                <input name="s_heslo" type="password" size="30" required maxlength="30" id="s_heslo">
                        <label for="heslo">Heslo (3-30 znakov):</label> 
		                <input name="heslo" type="password" size="30" required maxlength="30" id="heslo"> 
		                <br>
		                <label for="heslo2">Heslo (znovu):</label> 
		                <input name="heslo2" type="password" size="30" required maxlength="30" id="heslo2">
                        <input type="submit" name="zmen_heslo" id="posli" value="Zmeň heslo"></form>';
                    } else echo "<p class='permission_error'>Naznáma akcia.</p>";
                    $result->free();
                 }else echo "<p class='permission_error'>Používateľ s takýmto ID neexistuje.</p>";
            }else echo "<p class='permission_error'>Dopyt z databázy bol neúspešný, skúste to prosím neskôr.</p>";
        }else echo "<p class='permission_error'>Chyba pri spojení s databázou, skúste to prosím neskôr.</p>";

    }

    //Odošle správne vyplnenú prihášku do databázy
    function posli_prihlasku($meno, $priezvisko, $poh, $vek, $mesto, $adresa, $psc, $email, $mobil="0", $news=0){
        global $mysqli;        

        $sql = "INSERT INTO prihlasky (meno, priezvisko, pohlavie, vek, mesto, adresa, psc, mobil, email, newsletter) VALUES ('$meno', '$priezvisko', '$poh', '$vek', '$mesto', '$adresa', '$psc', '$mobil', '$email', '$news')";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                echo "Prihlaska poslaná.";
                //$result->free();
            }else echo "Nebolo možné vykonať dopyt z databázy.";
        }else echo "Chyba pri pripájaní sa k databáze." ;
    }

    //Vypíše zoznam doručených prihlášok
    function vypis_prihlasky(){
        global $mysqli;

        $sql = "SELECT * FROM prihlasky";
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                if(mysqli_num_rows($result) <= 0){
                    echo "<h2>Neboli prijaté žiadne nové prihlášky.</h2>\n";
                }else {
                    echo "<h1>Zoznam prijatých prihlášok</h1>\n";
                    echo "<table id='sutaze'>\n";
                    echo "<tr><td>Meno a Priezvisko</td><td>Vek</td><td>Mesto</td><td>Prijať?</td></tr>\n";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td><a href='nastroje_admina.php?akcia=".$_GET['akcia']."&kod_prihlasky=". $row['id'] ."'>".$row['meno'].' '.$row['priezvisko'].
                                "</a></td><td>".$row['vek']."</td><td>".$row['mesto'].
                                "</td><td><a href='nastroje_admina.php?akcia=".$_GET['akcia']."&kod_prihlasky=".$row['id']."&prijat=ano'>Áno</a> / <a href='nastroje_admina.php?akcia=".$_GET['akcia']."&kod_prihlasky=".$row['id']."&prijat=nie'>Nie</a></td></tr>\n";
                    }
                    echo "</table><br>\n";
	                $result->free();
                }
            }else echo "Nebolo možné vykonať dopyt z databázy.";
        }else echo "Chyba pri pripájaní sa k databáze." ;
    }

    //Vypíše detaily vybranej prihlášky
    function vypis_prihlasku($id){
        global $mysqli;

        $sql = "SELECT * FROM prihlasky WHERE id=$id";
        //echo $sql;
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $count = mysqli_num_rows($result);
                if ($count > 0 && is_numeric($id)){
                    $row = $result->fetch_assoc();
                    echo "<h2>Detaily prihlášky</h2>";
                    echo "<div id='prihlaska'><p>ID prihlášky: ".$row['id']."</p>";
                    echo "<p>Meno a Priezvisko: ".$row['meno']." ".$row['priezvisko']."</p>";
                    echo "<p>Pohlavie: ".$row['pohlavie']."</p>";
                    echo "<p>Vek: ".$row['vek']."</p>";
                    echo "<address><p>Mesto: ".$row['mesto']."</p>";
                    echo "<p>Adresa: ".$row['adresa']."</p>";
                    echo "<p>PSČ: ".$row['psc']."</p></address>";
                    echo "<p>Mobil: ".$row['mobil']."</p>";
                    echo "<p>E-Mail: ".$row['email']."</p>";
                    echo "<p>Newsletter: ".$row['newsletter']."</p>";
                    echo "<p><a href='nastroje_admina.php?akcia=".$_GET['akcia']."&kod_prihlasky=".$row['id']."&prijat=ano'>Prijať</a></p>";
                    echo "<p><a href='nastroje_admina.php?akcia=".$_GET['akcia']."&kod_prihlasky=".$row['id']."&prijat=nie'>Zamietnuť</a></p></div>";
                 }else echo "<p class='permission_error'>Prihláška s takýmto ID neexistuje.</p>";
            }else echo "<p class='permission_error'>Dopyt z databázy bol neúspešný, skúste to prosím neskôr.</p>";
        }else echo "<p class='permission_error'>Chyba pri spojení s databázou, skúste to prosím neskôr.</p>";
    }   
    
    function prihlaska_existuje($id){
        global $mysqli;

        $sql = "SELECT * FROM prihlasky WHERE id=$id"   ;
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $count = mysqli_num_rows($result);
                if ($count > 0) return true;
                else return false;
            }
        }
    }
    
    //Akceptuje prihlášku
    function prijat_prihlasku($id){
        global $mysqli;
        
        $sql = "SELECT * FROM prihlasky WHERE id=$id";
        echo $sql;
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $row = $result->fetch_assoc();
                $meno = $row['meno']." ".$row['priezvisko'];
                $p = $row['pohlavie'];
                $vek = $row['vek'];
                $mesto = $row['mesto'];
                $adresa = $row['adresa'];
                $psc = $row['psc'];
                $mobil = $row['mobil'];
                if ($mobil == '') $mobil = '-';
                $mail = $row['email'];
                $news = $row['newsletter'];
                //print_r($row);
                if (pridaj_clena_prihlaska($meno, $p, $vek, $mesto, $adresa, $psc, $mobil, $mail, $news)){
                    echo "Tu som";
                    $meno = $meno . rand();
                    echo $meno;
                    $heslo = rand(100000,999999999);
                    echo $heslo;
                    pridaj_pouzivatela($meno, $heslo, $mail);
                    zamietnut_prihlasku($id);
                }else "Chyba pri spracovávaní prihlášky";
            }else echo "Chyba pri spracovávaní prihlasky";
     
        }else echo "Chyba pri pripájaní k databáze";
    }

    //Vytvorí nový profil v databáze z údajov z prihlášky
    function pridaj_clena_prihlaska($meno, $p, $vek, $mesto, $adresa, $psc, $mobil, $mail, $news){
        global $mysqli;

        $sql = "INSERT INTO profiles (meno,pohlavie,vek,mesto,adresa,psc,mobil,newsletter) VALUES ('$meno','$p','$vek','$mesto','$adresa','$psc','$mobil','$news')";
        echo "<br>".$sql;
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
               
                return true;
            }else return false;
        }else return false;
    }

    //Vytvorí nový profil priamo z údajov zadaných adminom
    function pridaj_clena($meno, $mail, $nick, $vek, $poh, $mes, $adr, $psc, $mob, $mail, $news){
        global $mysqli;

        $sql = "INSERT INTO profiles (meno,pohlavie,vek,mesto,adresa,psc,mobil,newsletter,nick, email) VALUES ('$meno','$poh','$vek','$mes','$adr','$psc','$mob','$news','$nick', '$mail')";
        echo "<br>".$sql;
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
               
                return true;
            }else return false;
        }else return false;
    }

    //Vytvorí a zapíše prihlasovacie údaje nového člena do databázy
    function pridaj_pouzivatela($meno, $heslo, $mail, $admin){
        global $mysqli;

        $sql = "INSERT INTO users (user_name, user_password, email, admin) VALUES ('$meno', MD5('$heslo'), '$mail', '$admin')";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou"; 
    }

    //Zahodí prihlášku bez ďalšieho spracovania
    function zamietnut_prihlasku($id){
        global $mysqli;

        $sql = "DELETE FROM prihlasky WHERE id=$id";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                header('location: nastroje_admina.php');
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou"; 
    }

    //Vypíše zoznam používateľov
    function vypis_pouzivatelov(){
        global $mysqli;
        
        $sql = "SELECT * FROM profiles"; 

        echo "<a href='pridat_clena.php'><p id='pridaj_clena'>Pridať člena.</p></a>";
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                 echo "<h1>Zoznam členov</h1>\n";
                 echo "<table id='sutaze'>\n";
                 echo "<tr><td>ID</td><td>Meno a Priezvisko</td><td>Licencia</td><td>Divizia</td><td>Akcia</td></tr>\n";
                 while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['ID']."</td><td><a href='profil.php?id=". $row['ID'] ."'>".$row['meno'].
                             "</a></td><td>".$row['licencia']."</td><td>".$row['divizia']."</td><td><a href='nastroje_admina.php?akcia=".$_GET['akcia']."&zmazat=".$row['ID']."'>Odstrániť člena</a></td></tr>\n";
                 }
                 echo "</table><br>\n";
	             $result->free();
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou"; 
    }

    //Zmaže používateľa
    function zmazat_pouzivatela($id){
        global $mysqli;

        $sql = "DELETE FROM users WHERE ID=$id";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                zmazat_profil($id);
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou"; 
    }

    //Zmaže profil používateľa
    function zmazat_profil($id){
        global $mysqli;

        $sql = "DELETE FROM profiles WHERE ID=$id";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $f = 'Obrazky/Profiles/'.$id.'.png' ;
                if (unlink($f)){
                    header('location: nastroje_admina.php?akcia=sprava_pouzivatelov');
                    echo "Používateľ zmazaný";
                }
                header('location: nastroje_admina.php?akcia=sprava_pouzivatelov');
                echo "Používateľ zmazaný, súbor sa nepodarilo zmazať";
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou";
    }
    
    //Funkcia na uloženie upravených údajov do databázy
    function uprav_udaje($data, $id){
        global $mysqli;

        $sql = "UPDATE profiles SET bio='".addslashes(htmlspecialchars(strip_tags($data['bio']))).
                "', nick='".addslashes(htmlspecialchars(strip_tags($data['nick']))).
                "', mesto='".addslashes(htmlspecialchars(strip_tags($data['mesto']))).
                "', adresa='".addslashes(htmlspecialchars(strip_tags($data['adresa']))).
                "', psc='".addslashes(htmlspecialchars(strip_tags($data['psc']))).
                "', mobil='".addslashes(htmlspecialchars(strip_tags($data['mobil']))).
                "', divizia='".addslashes(htmlspecialchars(strip_tags($data['divizia']))).
                "', licencia='".addslashes(htmlspecialchars(strip_tags($data['licencia'])))."' WHERE ID='$id'";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                echo "<p>Udaje boli zmenene.<p><br>";    
            }else echo "<p>Nastala chyba pri zmene udajov.<p><br>";
        }else echo "Chyba pri spájaní s databázou";
    }

    //Funkcia kontroluje správne zadanú e-mailovú adresu
    function check_email($str){
    
        $tmp = explode('@', $str);

        if (count($tmp) < 2 || count($tmp) > 2){
            echo "nespravne zadany mail.";    
            return false;
        }else return true;

    }


    function nazov_ok ($nazov) {
	    $nazov = addslashes(strip_tags(trim($nazov)));
	    return strlen($nazov) >= 3 && strlen($nazov) <= 50;
    }

    function prihlasmeno_ok ($nazov) {
	    $nazov = addslashes(strip_tags(trim($nazov)));
	    return strlen($nazov) >= 5 && strlen($nazov) <= 20;
    }

    function heslo_ok ($nazov) {
	    $nazov = addslashes(strip_tags(trim($nazov)));
	    return strlen($nazov) >= 6 && strlen($nazov) <= 30;
    }

    function psc_ok ($psc){
        $psc = addslashes(strip_tags(trim($psc)));
        if (!is_numeric($psc)){
            echo "<p class=chyba>Zlý formát PSČ</p>";
            return false;
        }
        else return true;
    }

    //Funkcia mení heslo používateľa v databáze
    function zmen_heslo($id, $heslo){
        global $mysqli;

        $sql = "UPDATE users SET user_password=MD5('$heslo') WHERE ID='$id'";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                echo "<p>Heslo bolo zmenené.</p>";
            }else echo "<p>Nastala chyba pri zmene udajov.<p><br>";
       }else echo "Chyba pri spájaní s databázou";
    }

    //Vypíše tabuľku členov
    function tabulka_clenov($usp){
        global $mysqli;

        if ($usp == 'basic') $sql = "SELECT * FROM profiles ORDER BY divizia";
        else if ($usp == 'Podľa mena(A-Z)') $sql = "SELECT * FROM profiles ORDER BY meno";
        else if ($usp == 'Podľa mena(Z-A)') $sql = "SELECT * FROM profiles ORDER BY meno DESC";
        else if ($usp == 'Podľa divízie') $sql = "SELECT * FROM profiles ORDER BY divizia";
        else if ($usp == 'Podľa veku(vzostupne)') $sql = "SELECT * FROM profiles ORDER BY vek";
        else if ($usp == 'Podľa veku(zostupne)') $sql = "SELECT * FROM profiles ORDER BY vek DESC";


        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                while ($row = $result->fetch_assoc()){
                    echo "<tr><td><strong><a href='profil.php?id=".$row['ID']."'>".$row['meno']."</a></strong></td><td>".$row['vek']."</td><td>".$row['divizia']."</td><td>".$row['licencia']."</td></tr>";
                }
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou";
    }

    //Vypíše krátky popis členov
    function vypis_bio_clenov($usp){
        global $mysqli;

        if ($usp == 'basic') $sql = "SELECT * FROM profiles ORDER BY divizia";
        else if ($usp == 'Podľa mena(A-Z)') $sql = "SELECT * FROM profiles ORDER BY meno";
        else if ($usp == 'Podľa mena(Z-A)') $sql = "SELECT * FROM profiles ORDER BY meno DESC";
        else if ($usp == 'Podľa divízie') $sql = "SELECT * FROM profiles ORDER BY divizia";
        else if ($usp == 'Podľa veku(vzostupne)') $sql = "SELECT * FROM profiles ORDER BY vek";
        else if ($usp == 'Podľa veku(zostupne)') $sql = "SELECT * FROM profiles ORDER BY vek DESC";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                while ($row = $result->fetch_assoc()){
                    echo "<div class='clen_bio'>\n";
                    if (file_exists('Obrazky/Profiles/'.$row['ID'].'.png')){
                        echo "<img src='Obrazky/Profiles/".$row['ID'].".png' alt='Obrazky/Profiles/".$row['ID'].".png'>";
                    }else echo "<img src='Obrazky/profile-placeholder.png' alt='profil-placeholder'>";
                    echo "<div>\n<p><strong>".$row['meno']."</strong></p>\n";
                    echo "<p>".$row['bio']."</p></div>\n</div>\n";
                }
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou";

    }

    function pridaj_clanok($nazov, $clanok, $id){
        global $mysqli;

        $dnes = date("Y-m-d");

        $sql = "INSERT INTO clanky (nazov, clanok, datum, autor) VALUES ('$nazov', '$clanok', '$dnes', '$id')";

        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                echo "<h2>Clanok bol pridaný<h1>";
                return $mysqli->insert_id;
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou";
        return false;
        echo "<h3><a href='pridaj_clanok.php'>Späť</a></h3>";
    }

    function vypis_clanky(){
        global $mysqli;

        $sql = "SELECT * FROM clanky ORDER BY id DESC";
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                while ($row = $result->fetch_assoc()){
                    $clanok = explode(' ',$row['clanok']);
                    $nahlad = array();
                    $velkost = count($clanok);
                    if ($velkost < 80) $n = $velkost;
                    else $n = 80;
                    for($i=0 ; $i<$n; $i++){
                        array_push($nahlad, $clanok[$i]);
                    }
                    $tmp = implode(' ',$nahlad);
                    echo "<div>\n<h2><a href='index.php?id=".$row['id']."'>".$row['nazov']."</a></h2>\n";
                    if (file_exists('Obrazky/Thumbnails/'.$row['id'].'.png')) echo "<img src='Obrazky/Thumbnails/".$row['id'].".png' alt='Obrazky/Thumbnails/".$row['id'].".png' id='nahlad'>";
                    echo "<p class='nahlad'>\n".$tmp."<a href='index.php?id=".$row['id']."'>...Čítať ďalej.</a></p></div>";
                }
            }else echo "Chyba pri vykonávaní dopytu";
        }else echo "Chyba pri spájaní s databázou";
    }

    function vypis_clanok($id){
        global $mysqli;

        $sql = "SELECT * FROM clanky , profiles WHERE clanky.id='$id' AND profiles.ID=clanky.autor ORDER BY datum";
        if (!$mysqli->connect_errno) {
            if ($result = $mysqli->query($sql)){
                $count = mysqli_num_rows($result);
                if ($count > 0){
                    $row = $result->fetch_assoc();
                    echo "<header><h2>".$row['nazov']."</h2>\n";
                    echo "<span>".$row['datum']."</span></header>";
                    echo "<p>".$row['clanok']."</p>\n";
                    echo "<footer><strong>Napísal: ".$row['meno']."</strong></footer>";
                }else echo "<p class='permission_error'>Článok s takýmto ID neexistuje.</p>";
            }else echo "<p class='permission_error'>Dopyt z databázy bol neúspešný, skúste to prosím neskôr.</p>";
        }else echo "<p class='permission_error'>Chyba pri spojení s databázou, skúste to prosím neskôr.</p>";
    }
?>

