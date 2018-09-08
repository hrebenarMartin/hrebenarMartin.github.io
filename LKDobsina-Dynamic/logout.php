<?php
    session_start();
    unset($_SESSION['login_user']);
    session_destroy();
    header('location: '.$_SESSION['last_page']);
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>LogOut</title>
</head>
<body>
</body>
</html>