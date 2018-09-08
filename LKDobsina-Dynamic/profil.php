<?php
    session_start();
    include('funkcie.php');
    hlavicka('Profil');
    /*------*/
    include('db.php');
    nav();
    aside_left();
?>
	<section>

    <?php
        if (isset($_GET['id'])){

            if (isset($_POST['uloz_zmeny'])){
                    uprav_udaje($_POST, $_GET['id']);
                    if (isset($_FILES['obrazok'])){
                        $nazov = "Obrazky/Profiles/".$_GET['id'].".png";
                        //echo "<h2>".$nazov."</h2>";
                        move_uploaded_file($_FILES['obrazok']['tmp_name'], $nazov);
                    }
                    unset($_POST['uloz_zmeny']);
                    header("location: profil.php?id=".$_GET['id']."");
            }

            if(isset($_POST['zmen_heslo'])&&
               isset($_POST['s_heslo'])&&
               isset($_POST['heslo'])&&
               isset($_POST['heslo2'])){
                if(check_user($_SESSION['login_user'], addslashes(htmlspecialchars(strip_tags($_POST['s_heslo']))),1)){
                    if ($_POST['heslo'] === $_POST['heslo2']) zmen_heslo($_GET['id'], $_POST['heslo']);
                    else echo "<p>Nové heslá sa nezhodujú.</p>";    
                }else echo "<p>Nesprývne zadané staré heslo.</p>";
            }          
            
            if (isset($_GET['akcia']) && is_numeric($_GET['akcia'])){
                if ($_GET['akcia'] == 1 && isset($_SESSION['login_user']) && $_SESSION['id'] == $_GET['id']){
                   
                    vypis_profil($_GET['id'],1);
               
                }
                else if ($_GET['akcia'] == 2 && isset($_SESSION['login_user']) && $_SESSION['id'] == $_GET['id']){
                    vypis_profil($_GET['id'],2);

                }else echo "<p class='permission_error'>Neplatný vstup pre stránku alebo nemáš oprávnenie na prezeranie jej obsahu.</p>";


            }else{
                vypis_profil($_GET['id'],0);
            }
            
        } else echo "<p class='permission_error'>Neplatný vstup pre stránku alebo nemáš oprávnenie na prezeranie jej obsahu.</p>";
    ?>
		
	</section>
    <?php
        aside_right();
        footer();
?>