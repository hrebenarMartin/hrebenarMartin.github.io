<?php
session_start();
    include('funkcie.php');
    hlavicka('Domov');
    /*------*/
    include('db.php');
    nav();
    aside_left();
?>
	<section>
		<?php
            if (isset($_GET['id']) && is_numeric($_GET['id']) && count($_GET) == 1){
                vypis_clanok($_GET['id']);
            }else if (isset($_GET['id']) && !is_numeric($_GET['id'])){
                echo "<p class='permission_error'>Neplatný vstup pre stránku.</p>";
            }else {echo "<h1>Novinky</h1>"; vypis_clanky();}
        ?>
	</section>
    <?php
        aside_right();
        footer();
?>