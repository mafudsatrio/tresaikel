<?php
    include 'functions.php';

    if(!$_SESSION["login"] or !$_SESSION["user"]){
        echo "<script>alert('Anda harus Login!')
                window.location.href = 'login.php';
                </script>";
    }

    $result = mysqli_query($conn, "SELECT*from $user where username='$username'");
    $result2 = mysqli_query($conn, "SELECT*from pengepul order by kab_kota");
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
    <title>Tresaikel - Transaksi Sampah</title>
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
    <p>(User)</p>
    </center><br></div>
       <?php
                }
            }
       ?>
       <li><a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
           <span class="nav-item">Dashboard</span>
       </a></li>
       <li><a href="prosedur.php">
       <i class="fas fa-file-alt"></i>
           <span class="nav-item">Prosedur</span>
       </a></li>
       <li class="active"><a href="lokasi.php">
       <i class="fas fa-search-location"></i>
           <span class="nav-item">Lokasi</span>
       </a></li>
       <li><a href="jenhar.php">
       <i class="fas fa-cart-arrow-down"></i>
           <span class="nav-item">Kriteria & Harga</span>
       </a></li>
       <li><a href="transaksi.php">
       <i class="fas fa-money-bill-alt"></i>
           <span class="nav-item">Transaksi Sampah</span>
       </a></li>
       <li><a href="saran.php">
       <i class="fas fa-comment"></i>
           <span class="nav-item">Saran</span>
       </a></li>
       </ul>
       </nav> 
    <div class="main container" style="margin-top: 55px;">
        <h2>Daftar Pengepul</h2>
        <table style="width: 100%;" id="pul">
        <tr>
            <th>Nama Pengepul</th> <th>Alamat</th> <th>Kab/Kota</th> <th>Lihat Lokasi</th> <th>Pilih Pengepul</th>
        </tr>
        <?php  if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_array($result2)) {         
            echo "<tr>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['alamat']."</td>";
            echo "<td>".$row['kab_kota']."</td>";    
            echo "<td style='text-align: center;'><a class='pilih' href='https://www.google.com/maps/search/$row[alamat]' target='_blank'><i style='font-size: 23px;' class='loc fas fa-search-location'></i></a></td>";        
            echo "<td><a class='pilih' href='transaksi.php?userp=$row[username]'>Pilih</a></td></tr>";
        }}
        ?>
        </table>
    </div>
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
    <br>
    
</div>
</body>

</html>
