<?php
    include 'functions.php';

    if(!$_SESSION["login"] or !$_SESSION["user"]){
        echo "<script>alert('Anda harus Login!')
                window.location.href = 'login.php';
                </script>";
    }

    $userp = $_GET['userp'];

    if (isset($_POST['transaksi'])){
        $berat = $_POST['berat'];
        mysqli_query($conn, "INSERT INTO sampah (berat, username_pengepul) values ('$berat', '$userp')");
        $result3 = mysqli_query($conn, "SELECT*from sampah order by id_sampah desc limit 1");
        $result4 = mysqli_fetch_array($result3);
        $id_sampah = $result4['id_sampah'];
        $berat = $result4['berat'];
        mysqli_query($conn, "UPDATE sampah set harga=berat*2500 where id_sampah='$id_sampah'");

        $date = date('Y-m-d H:i:s');
        mysqli_query($conn, "INSERT INTO menjual (`tanggal_jual`, `username_masyarakat`, `id_sampah`) 
        VALUES ('$date', '$username', '$id_sampah')");
        echo "<script>alert('Berhasil')
                window.location.href = 'pilih.php';
                </script>";
    }

    $result = mysqli_query($conn, "SELECT*from $user where username='$username'");
    $result2 = mysqli_query($conn, "SELECT*from pengepul where username='$userp'");
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
       <li><a href="lokasi.php">
       <i class="fas fa-search-location"></i>
           <span class="nav-item">Lokasi</span>
       </a></li>
       <li><a href="jenhar.php">
       <i class="fas fa-cart-arrow-down"></i>
           <span class="nav-item">Kriteria & Harga</span>
       </a></li>
       <li class="active"><a class="active" href="transaksi.php">
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
        <h2>Data Pengepul</h2>
        <table style="width: 100%;" id="pul">
        <tr>
            <th style="width: 280px;">Nama</th> <th style="width: 530px;">Alamat</th> <th style="width: 230px;">Kab/Kota</th> <th>No. HP</th>
        </tr>
        <?php  if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_array($result2)) {         
            echo "<tr>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['alamat']."</td>";
            echo "<td>".$row['kab_kota']."</td>";    
            echo "<td>".$row['no_hp']."</td>";        
        
        ?>
        </table><br><br>
        <form name="transaksi" action="" method="POST">
            <h2>Transaksi Sampah</h2>
            <table>
                <tr>
                    <label for="berat"><b>Berat Sampah (Kg)</b></label>
                    <p>Kosongkan jika belum menimbang sampah</p>
                </tr>
                <tr>
                    <input style="margin-top: 2px; width: 225px;" class="form-input" type="number" min="1" max="999" step="0.1" name="berat" value="">
                </tr>
                <tr>
                    <input style="margin-top: -10px;" name="transaksi" class="submit-btn" type="submit" value="Submit">
                </tr>
            </table> 
        </form>
        <?php }
        }else{
            header("Location: pilih.php");
        }
         ?>
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
