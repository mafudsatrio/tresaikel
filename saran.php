<?php
include 'functions.php';

if(!$_SESSION["login"]){
    echo "<script>alert('Anda harus Login!')
            window.location.href = 'login.php';
            </script>";
}

if(!$_SESSION["user"] & !$_SESSION["pengepul"]){
    echo "<script>alert('Anda harus Login!')
            window.location.href = 'login.php';
            </script>";
}

if(isset($_POST['submit'])){
    $username = $_SESSION["username"];
    $komentar = $_POST['saran'];
    if ($_SESSION['user']){
        mysqli_query($conn, "INSERT INTO saran (komentar, username_user) values('$komentar', '$username')");
            echo "<script>alert('Terima kasih sarannyaa');
            window.location.href = 'login.php';
            </script>";
    }else if ($_SESSION['pengepul']) {
        mysqli_query($conn, "INSERT INTO saran (komentar, username_pengepul) values('$komentar', '$username')");
            echo "<script>alert('Terima kasih sarannya');
            window.location.href = 'login.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/saran.css">
    <link rel="icon" href="img/icon.ico">
    <title>Tresaikel - Saran</title>
</head>

<body>
    <div class="main">
    <div class="topnav">
        <a href="index.php" style="margin-left: 8%;">Beranda</a>
        <a href="profil.php">Profil</a>
        <a href="tentang.php">Tentang</a>
        <?php if($_SESSION["login"]) : ?>            
            <a class="split" href="logout.php" style="margin-right: 8%;">Keluar</a>
        <?php endif; ?>
        <?php if(!$_SESSION["login"]) : ?> 
            <a class="split" href="login.php" style="margin-right: 8%;">Masuk</a>
            <a class="split" href="signup.php">Daftar</a>"
        <?php endif; ?>
    
    </div><br><br>
    <img src="img/trash.webp" height="550px" style="margin-left: 3.5cm; float: left;"/>
    
    <br><br><br><br><br><br><br>
    
    <table style="float: left;" ><form name="submit" method="POST" action="saran.php">
        <h2 style="margin-bottom: -4px;">Saran</h2>
        <p>Silahkan beri kami saran.</p>
        <tr>
            <td>
                <textarea class="form-input" type="textarea" name="saran" required /></textarea>
            </td>
        </tr>
        <tr>
            <td>
            <button type="submit" name="submit" class="submit-btn" style="font-family: poppins; margin-top: -4px;">Kirim</button>
            </td>
        </tr>
  </form>
</body>
</html>
