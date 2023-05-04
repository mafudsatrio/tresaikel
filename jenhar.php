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

    $result = mysqli_query($conn, "SELECT*from $user where username='$username'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/setilee.css">
    <link rel="icon" href="img/icon.ico">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Tresaikel - Kriteria dan harga</title>
</head>

<body style="background-color: #e9e7d9">
<nav>
       <ul>
       <br><br><br>
       <?php
       if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="profil">
        <center><a href="profil.php">
            <?php 
                if($row['foto'] != ""){
            ?>
        <img class="foto-profil" src="img/pp/<?php echo $row['foto']; ?>">
        <?php }else{?>
            <img class="foto-profil" src="img/pp/blank.png">
            <?php } ?>
        </a><br>
       <p><b><?php echo $row['nama']?></b></p>
    <p><?php
        if($_SESSION["user"]){
            echo "(User)";
        }else if($_SESSION["pengepul"]){
            echo "(Pengepul)";
        }?>
        </p>
    </center><br></div>
       <?php
                }
            }
       ?>
       <?php 
            if($_SESSION["user"]){ 
        ?>
       <li><a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
           <span class="nav-item">Dashboard</span>
       </a></li>
       <li><a href="prosedur.php">
       <i class="fas fa-file-alt"></i>
           <span class="nav-item">Prosedur</span>
       </a></li>
       <li><a href="lokasi.php">
       <i class="fas fa-search-location"></i>
           <span class="nav-item">Lokasi</span>
       </a></li>
       <li class="active"><a href="jenhar.php">
       <i class="fas fa-cart-arrow-down"></i>
           <span class="nav-item">Kriteria & Harga</span>
       </a></li>
       <li><a href="pilih.php">
       <i class="fas fa-money-bill-alt"></i>
           <span class="nav-item">Transaksi Sampah</span>
       </a></li>
       <li><a href="saran.php">
       <i class="fas fa-comment"></i>
           <span class="nav-item">Saran</span>
       </a></li>
       </ul>
       </nav> 
    <?php 
        }else if($_SESSION["pengepul"]){
    ?>
    <li><a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
           <span class="nav-item">Dashboard</span>
       </a></li>
       <li><a href="prosedur.php">
       <i class="fas fa-file-alt"></i>
           <span class="nav-item">Prosedur</span>
       </a></li>
       <li class="active"><a href="jenhar.php">
       <i class="fas fa-cart-arrow-down"></i>
           <span class="nav-item">Kriteria & Harga</span>
       </a></li>
       <li><a href="sampah.php">
       <i class="fas fa-trash"></i>
           <span class="nav-item">Sampah Terkumpul</span>
       </a></li>
       <li><a href="saran.php">
       <i class="fas fa-comment"></i>
           <span class="nav-item">Saran</span>
       </a></li>
       </ul>
       </nav> 
    <?php
        }
    ?>
       <div class="container">
       <center><img src="img/kriteria_sampah.png" style="width: 60%; align: center;" alt="Trash"></center>
        </div>
    <div class="mainn">
    <div class="topnav">
        <a style="margin-left: 8%;" href="index.php">Beranda</a>
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
    
</div>
</body>

</html>
