<?php
    include 'functions.php';
    if($_SESSION["login"]){
        header("Location: dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/icon.ico">
    <title>Tresaikel</title>
</head>

<body>
    <div class="main">
    <div class="topnav">
        <a class="active" href="index.php" style="margin-left: 8%;">Beranda</a>
        <a href="profil.php">Profil</a>
        <a href="tentang.php">Tentang</a>
        <?php if($_SESSION["login"]) : ?>            
            <a class="split" href="logout.php" style="margin-right: 8%;">Keluar</a>
        <?php endif; ?>
        <?php if(!$_SESSION["login"]) : ?> 
            <a class="split" href="login.php" style="margin-right: 8%;">Masuk</a>
            <a class="split" href="signup.php">Daftar</a>
        <?php endif; ?>
    </div><br>
    <center><a href="index.php"><h1>Tresaikel</h1></a></center>
    <center><img src="img/background.webp" style="width: 78%;" alt="Trash"></center>
</div>
</body>

</html>
