<?php
    include 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/icon.ico">
    <title>Tresaikel - Tentang</title>
<style>
    body {
    background-image: url("img/jojo.jpg" );
    
}       

.center {
  margin: auto;
  width: 80%;
  padding: 10px;
  font-size: 25px;
  text-align: justify;
  background-color: rgba(159, 192, 136, 0.8);
  border-radius: 0.3rem;
  
}

</style>
</head>

<body> 
    <div class="main">
    <div class="topnav">
        <a href="index.php" style="margin-left: 8%;">Beranda</a>
        <a href="profil.php">Profil</a>
        <a class="active" href="tentang.php">Tentang</a>
        <?php if($_SESSION["login"]) : ?>            
            <a class="split" href="logout.php" style="margin-right: 8%;">Keluar</a>
        <?php endif; ?>
        <?php if(!$_SESSION["login"]) : ?> 
            <a class="split" href="login.php" style="margin-right: 8%;">Masuk</a>
            <a class="split" href="signup.php">Daftar</a>
        <?php endif; ?>
    </div><br>
    <center><a href="index.php"><h1>Tresaikel</h1></a></center>
    <br><br><br>
</div>
    <div class="center">Tresaikel merupakan website yang dibuat untuk mempermudah proses pengumpulan dan penyetoran sampah di pulau Lombok. 
Dengan penggunaan website ini diharapkan masyarakat dapat memulai kebiasaan baru yang lebih baik dimulai
dari kesadaran untuk mengolah sampah dengan cara yang benar. Penggunaan website ini juga diharapkan dapat mengurangi
jumlah pembuangan sampah sembarangan, yang mana sampah yang telah dikumpulkan akan dapat dijual kembali oleh pengepul 
kepada para pembeli untuk diolah dan didaur ulang.</div>
</body>

</html>