<?php
    session_start();
    include('funkcie.php');
    hlavicka('Nástroje admina');
    /*------*/
    include('db.php');
    nav();
    aside_left();
?>
	<section>
		<?php
            if(!isset($_GET['akcia'])){
                if(!isset($_SESSION['login_user'])) echo "Nemáte povolenie na prezeranie obsahu tejto stránky.";
                else {
                    if($_SESSION['admin'] == 1) {
                       
                            echo "<a href='nastroje_admina.php?akcia=sprava_prihlasok'><h2>Správa prihlášok</h2></a>\n";
                            echo "<a href='nastroje_admina.php?akcia=sprava_pouzivatelov'><h2>Správa používateľov</h2></a>\n";
                            echo "<a href='pridaj_clanok.php'><h2>Pridať článok</h2></a>\n";
                        
                    }else echo "Nemáte povolenie na prezeranie obsahu tejto stránky.";
                }
            }else {
            if(!isset($_SESSION['login_user'])) echo "Nemáte povolenie na prezeranie obsahu tejto stránky.";
                else {
                    if($_SESSION['admin'] == 1) {
                        if($_GET['akcia'] == 'sprava_prihlasok'){
                            if(isset($_GET['kod_prihlasky'])){
                                if (is_numeric($_GET['kod_prihlasky'])){
                                    if (isset($_GET['prijat']) && prihlaska_existuje($_GET['kod_prihlasky'])){
                                        if ($_GET['prijat'] == 'ano') prijat_prihlasku($_GET['kod_prihlasky']);
                                        else if ($_GET['prijat'] == 'nie') zamietnut_prihlasku($_GET['kod_prihlasky']);
                                        else echo "<p class='permission_error'>Neplatný vstup pre stránku alebo nemáš oprávnenie na prezeranie jej obsahu.</p>";
                                    }else vypis_prihlasku($_GET['kod_prihlasky']);
                                } else echo "<p class='permission_error'>Neplatný vstup pre stránku alebo nemáš oprávnenie na prezeranie jej obsahu.</p>";
                            }else vypis_prihlasky();
                        }else if($_GET['akcia'] == 'sprava_pouzivatelov') {
                            if (isset($_GET['zmazat'])) {
                                zmazat_pouzivatela($_GET['zmazat']);
                            }else vypis_pouzivatelov();
                        }else echo "<p class='permission_error'>Neplatný vstup pre stránku alebo nemáš oprávnenie na prezeranie jej obsahu.</p>";
                    }else echo "Nemáte povolenie na prezeranie obsahu tejto stránky.";
                }     
            }
        ?>
	</section>
    <?php
        aside_right();
        footer();
?>