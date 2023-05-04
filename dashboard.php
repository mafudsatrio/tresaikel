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
    <title>Tresaikel - Dashboard</title>
    <link rel="stylesheet" href="css/setilee.css">
    <link rel="icon" href="img/icon.ico">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body style="background-image: url('img/jojo.jpg'); background-size: 100%;">
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
       <li class="active"><a href="dashboard.php">
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
       <li><a href="jenhar.php">
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
       <div class="container">
       <section class="main">
           
           <div class="users">
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img  src="img/pro.png">
                    <h4>Prosedur Penukaran</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'prosedur.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="img/l.jpeg">
                    <h4>Lokasi</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'lokasi.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="img/oo.png">
                    <h4>Kriteria & Harga</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'jenhar.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="img/money.jpg">
                    <h4>Transaksi Sampah</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'pilih.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="img/sak.jpg">
                    <h4>Saran</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'saran.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
           </div>
           
       </section>     
    </div>
    <?php 
        }else if($_SESSION["pengepul"]){
    ?>
    <li class="active"><a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
           <span class="nav-item">Dashboard</span>
       </a></li>
       <li><a href="prosedur.php">
       <i class="fas fa-file-alt"></i>
           <span class="nav-item">Prosedur</span>
       </a></li>
       <li><a href="jenhar.php">
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
       <div class="container">
       <section class="main">
           
           <div class="users">
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img  src="img/pro.png">
                    <h4>Prosedur Penukaran</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'prosedur.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="img/oo.png">
                    <h4>Kriteria & Harga</h4><br>
                    <div class="per"></div>
                    <button onclick="location.href = 'jenhar.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="img/bk.png">
                    <h4>Sampah Yang Terkumpul</h4>
                    <div class="per"></div><br>
                    <button onclick="location.href = 'sampah.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
               <div class="tampilan"> <!--  class tampilan = class card -->
                    <img src="img/sak.jpg">
                    <h4>Saran</h4><br>
                    <div class=""></div>
                    <button onclick="location.href = 'saran.php';">Klik</button> <!-- button tombol = button profile -->
               </div>
           </div>
           
       </section>     
    </div>
    <?php
        }
    ?>
    <div class="mainn">
    <div class="topnav">
        <a class="active" href="index.php" style="margin-left: 8%;">Beranda</a>
        <a href="profil.php">Profil</a>
        <a href="tentang.php">Tentang</a>
        <a class="split" href="logout.php" style="margin-right: 8%;">Keluar</a>
    </div><br>
</div>
</body>

</html>
