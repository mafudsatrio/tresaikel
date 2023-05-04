<?php
    include '../functions.php';

    if(!$_SESSION["login"]){
        echo "<script>alert('Anda harus Login!')
                window.location.href = 'login.php';
                </script>";
    }

    if(!$_SESSION["admin"]){
        echo "<script>alert('Anda harus Login!')
                window.location.href = 'login.php';
                </script>";
    }

    $result = mysqli_query($conn, "SELECT*from admin where username='$username'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tresaikel - Dashboard Admin</title>
    <link rel="stylesheet" href="../css/setilee.css">
    <link rel="icon" href="../img/icon.ico">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body style="background-image: url('../img/jojo.jpg'); background-size: 100%;">
       <nav>
       <ul>
       <br><br><br>
       <?php
       if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="profil">
        <center>
            <?php 
                if($row['foto'] != ""){
            ?>
        <img class="foto-profil" src="../img/pp/<?php echo $row['foto']; ?>">
        <?php }else{?>
            <img class="foto-profil" src="../img/pp/blank.png">
            <?php } ?>
        <br>
       <p><b><?php echo $row['nama']?></b></p>
    <p>(Admin)</p>
    </center><br></div>
       <?php
                }
            }
       ?>
       
       <li class="active"><a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
           <span class="nav-item">Dashboard</span>
       </a></li>
       <li><a href="transaksi.php">
       <i class="fas fa-file-alt"></i>
           <span class="nav-item">Transaksi</span>
       </a></li>
       <li><a href="user.php">
       <i class="fas fa-search-location"></i>
           <span class="nav-item">Data User</span>
       </a></li>
       <li><a href="pengepul.php">
       <i class="fas fa-cart-arrow-down"></i>
           <span class="nav-item">Data Pengepul</span>
       </a></li>
       </ul>
       </nav> 
       <div class="container">
       <section class="main">
           
           <div class="users">
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img  src="../img/money.jpg">
                    <h4>Data Transaksi</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'transaksi.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="../img/datauser.jpg">
                    <h4>Data User</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'user.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="../img/datapengepul.png">
                    <h4>Data Pengepul</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'pengepul.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
           </div>
           
       </section>     
    </div>
    <div class="mainn">
    <div class="topnav">
        <a class="active" href="index.php" style="margin-left: 8%;">Beranda</a>
        <a class="split" href="../logout.php" style="margin-right: 8%;">Keluar</a>
    </div><br>
</div>
</body>

</html>
