<?php 
    session_start();
    include('db.php');
    include('funkcie.php');
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style_login.css" media="all">
</head>
<body>
    <section>
	<a href="<?php echo $_SESSION['last_page'];?>" class="button"><i class="fa fa-arrow-left"></i>Back</a>
    <h2>Prihlásenie</h2>
    <form method="post">
         <input type="text" name="meno" id="meno" size="20" minlength="5" required placeholder="username" value="<?php if(isset($_POST['meno'])) echo $_POST['meno'] ?>"><br>
         <input type="password" name="heslo" id="heslo" size="30" minlength="6" required placeholder="password"><br>
         <input type="submit" name="login" id="login" value="Prihlási">    
    </form>
    <?php
        
        if(isset($_POST['login']) && isset($_POST['meno']) && prihlasmeno_ok($_POST['meno']) && isset($_POST['heslo']) && heslo_ok($_POST['heslo'])) {
            if(!check_user(addslashes(htmlspecialchars(strip_tags($_POST['meno']))),addslashes(htmlspecialchars(strip_tags($_POST['heslo']))),0)){
                echo "<p id='login_error'>Nesprávne zadané prihlasovacie údaje</p>";
            };
        }
    ?>

    </section>
</body>
</html>