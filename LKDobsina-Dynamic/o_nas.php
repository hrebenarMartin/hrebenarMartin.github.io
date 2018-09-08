<?php
session_start();
    include('funkcie.php');
    hlavicka('O Nás');
    /*------*/
    include('db.php');
    nav();
    aside_left();
?>
	<section>
		<h2>Členovia</h2>
		<table>
        <h3> Zoradiť podľa: </h3>
        <form method='post'>
            <input type=submit name='zorad' class='filter' value='Podľa mena(A-Z)'>
            <input type=submit name='zorad' class='filter' value='Podľa mena(Z-A)'>
            <input type=submit name='zorad' class='filter' value='Podľa divízie'>
            <input type=submit name='zorad' class='filter' value='Podľa veku(vzostupne)'>
            <input type=submit name='zorad' class='filter' value='Podľa veku(zostupne)'>
        </form>
			<tr>
				<td>Meno</td>
				<td>Vek</td>
				<td>Divízia luku</td>
				<td>Licencia</td>
			</tr>
			<?php
                if(isset($_POST['zorad'])){
                    tabulka_clenov($_POST['zorad']);
                }
                else tabulka_clenov('basic');
            ?>
		</table>
        <?php
            if(isset($_POST['zorad'])){
                    vypis_bio_clenov($_POST['zorad']);
                    unset($_POST['zorad']);
                }
                else vypis_bio_clenov('basic');
        ?>
	</section>
    <?php
        aside_right();
        footer();
?>