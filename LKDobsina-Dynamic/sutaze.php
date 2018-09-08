<?php
    session_start();
    include('funkcie.php');
    include('db.php');
    hlavicka('Súťaže');
    /*------*/
    nav();
    aside_left();
?>
	<section>
		<?php
        if (isset($_GET['id'])) {
            if (isset($_GET['akcia'])){
                if ($_GET['akcia'] == 'prihlasit'){
                    prihlasit_sutaz($_SESSION['id'], $_GET['id']);
                }else if ($_GET['akcia'] == 'odhlasit'){
                    odhlasit_sutaz($_SESSION['id'], $_GET['id']);
                }
                echo "<h2><a href=sutaze.php>Pokračovať.</a></h2>";
            }else  vypis_sutaz($_GET['id']);
		} else {
            echo "<h1>Kalendár súťaží</h1>";
            ?>
            <h3> Zobraziť: </h3>
            <form method='post'>
                <input type=submit name='filter' class='filter' value='Všetky súťaže'>
                <input type=submit name='filter' class='filter' value='Len budúce súťaže'>
                <input type=submit name='filter' class='filter' value='Len minulé súťaže'>
            </form>
            <?php
            if (isset($_POST['filter'])){
                //echo $_POST['filter'];
                vypis_sutaze($_POST['filter']);
                unset($_POST['filter']);
            } 
			else vypis_sutaze('all');
		}
        ?>
	</section>
    <?php
        aside_right();
        footer();
?>