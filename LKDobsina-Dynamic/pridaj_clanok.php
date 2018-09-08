<?php
    session_start();
    include('funkcie.php');
    hlavicka('template');
    /*------*/
    include('db.php');
    nav();
    aside_left();
    if(isset($_POST['posli_clanok'])&&
        isset($_POST['nazov_clanku'])&&
        isset($_POST['clanok'])){
            $id = pridaj_clanok(addslashes(htmlspecialchars(strip_tags($_POST['nazov_clanku']))), addslashes(htmlspecialchars(strip_tags($_POST['clanok']))), $_SESSION['id']);
            if(isset($_FILES['nahlad']) && $id){
                $nazov = "Obrazky/Thumbnails/".$id.".png";
                
                move_uploaded_file($_FILES['nahlad']['tmp_name'], $nazov);
            }
    }
?>
	<section>
        <h1>Pridaj Článok</h1>
		<form method='post' enctype='multipart/form-data'>
            <fieldset>
                <label for='nazov_clanku'>Názov článku</label><input type='text' id='nazov_clanku' name='nazov_clanku' required>
                <textarea name='clanok' id='clanok' required rows='30' cols='20'></textarea>
                <input type='file' name='nahlad' accept='image/png'><br>
                <input type='submit' name='posli_clanok' id='posli'>
            </fieldset>
        </form>
	</section>
    <?php
        aside_right();
        footer();
?>