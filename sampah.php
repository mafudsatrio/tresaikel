<?php
    include 'functions.php';

    if(!$_SESSION["login"] or !$_SESSION["pengepul"]){
        echo "<script>alert('Anda harus Login!')
                window.location.href = 'login.php';
                </script>";
    }

    if (isset($_POST['cek'])) {
        $no = $_POST['cek'];
        mysqli_query($conn, "UPDATE menjual set cek_pengepul='1' where no_transaksi_jual='$no'");
        echo"<script>alert('Berhasil');</script>";
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
    <p>(Pengepul)</p>
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
       <li><a href="jenhar.php">
       <i class="fas fa-cart-arrow-down"></i>
           <span class="nav-item">Kriteria & Harga</span>
       </a></li>
       <li class="active"><a href="sampah.php">
       <i class="fas fa-trash"></i>
           <span class="nav-item">Sampah Terkumpul</span>
       </a></li>
       <li><a href="saran.php">
       <i class="fas fa-comment"></i>
           <span class="nav-item">Saran</span>
       </a></li>
       </ul>
       </nav> 
    <div class="main container" style="margin-top: 55px;">
        <h2>Transaksi</h2>
        <table style="width: 100%;" id="pul">
        <tr>
            <th>No. Transaksi</th> <th>ID Sampah</th> <th>Tanggal</th> <th>Berat (Kg)</th> <th>Harga (Rp)</th> 
            <th>Nama User</th> <th>Status Transaksi</th> <th>Konfirmasi Transaksi</th> <th>Edit Berat</th>
        </tr>
        <?php  
            $result2 = mysqli_query($conn, "SELECT menjual.no_transaksi_jual, sampah.id_sampah, menjual.tanggal_jual, sampah.berat, sampah.harga, 
            user.nama, menjual.cek_user, menjual.cek_pengepul from sampah join menjual on sampah.id_sampah=menjual.id_sampah join pengepul on 
            sampah.username_pengepul=pengepul.username join user on user.username=menjual.username_masyarakat and pengepul.username='$username' 
            and (menjual.cek_user='0' or menjual.cek_pengepul='0')");
            if (mysqli_num_rows($result2) > 0) {
            while($row = mysqli_fetch_array($result2)) {         
                echo "<tr>";
                echo "<td>".$row['no_transaksi_jual']."</td>";
                echo "<td>".$row['id_sampah']."</td>";
                echo "<td>".$row['tanggal_jual']."</td>";
                echo "<td>".$row['berat']."</td>";
                echo "<td>".$row['harga']."</td>";
                echo "<td>".$row['nama']."</td>";   
                if($row['cek_user'] == '1' and $row['cek_pengepul'] == '1'){
                    echo "<td>Selesai</td>";
                } else{
                    echo "<td>Belum Selesai</td>";
                }
                if($row['cek_pengepul'] == '1'){
                    echo "<td style='text-align: center;'><i style='color: #9FC088; font-size: 25px;' class='fas fa-check-circle'></i></td>";
                } else{
                    echo "<td style='text-align: center;'><form id='konfir' action='' name='konfir' method='POST'><button 
                    style='font-size: 25px;' class='check far fa-check-circle' type='submit' name='cek' value='".$row['no_transaksi_jual']."'>
                </button></form></td>";
                }
                echo "<td><a class='pilih' href='edit_sampah.php?no_transaksi=$row[no_transaksi_jual]'>Edit</a></td></tr>";
                echo "</tr>";        
            }
        }
        ?>
        </table>
        <br>
        <h2>Riwayat Transaksi (Selesai)</h2>
        <table style="width: 100%;" id="pul">
        <tr>
            <th style="">No. Transaksi</th> <th>ID Sampah</th> <th>Tanggal</th> <th>Berat (Kg)</th> <th>Harga (Rp)</th> 
            <th>Nama User</th> <th>Status Transaksi</th> 
        </tr>
        <?php  
            $result3 = mysqli_query($conn, "SELECT menjual.no_transaksi_jual, sampah.id_sampah, menjual.tanggal_jual, sampah.berat, sampah.harga, 
            user.nama, menjual.cek_user, menjual.cek_pengepul from sampah join menjual on sampah.id_sampah=menjual.id_sampah join pengepul on 
            sampah.username_pengepul=pengepul.username join user on user.username=menjual.username_masyarakat and pengepul.username='$username' 
            and menjual.cek_user='1' and menjual.cek_pengepul='1'");
            if (mysqli_num_rows($result3) > 0) {
            while($row = mysqli_fetch_array($result3)) {         
                echo "<tr>";
                echo "<td>".$row['no_transaksi_jual']."</td>";
                echo "<td>".$row['id_sampah']."</td>";
                echo "<td>".$row['tanggal_jual']."</td>";
                echo "<td>".$row['berat']."</td>";
                echo "<td>".$row['harga']."</td>";
                echo "<td>".$row['nama']."</td>";   
                if($row['cek_user'] == '1' and $row['cek_pengepul'] == '1'){
                    echo "<td>Selesai</td>";
                } else{
                    echo "<td>Belum Selesai</td>";
                }
                echo "</tr>";        
            }
        }
        ?>
        </table><br>
        <h2>Total Sampah Yang Telah Terkumpul</h2>
        <table id="pul">
        <tr>
            <th style="width: 150px;">Total (Kg)</th>
        </tr>
        <?php  
        $result4 = mysqli_query($conn, "SELECT round(sum(berat), 1) as total from sampah where id_sampah in (select id_sampah from sampah where username_pengepul='$username') and id_sampah in (select id_sampah from menjual where cek_user='1' and cek_pengepul='1')");
        if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_array($result4)) {         
            echo "<tr>";
            echo "<td>".$row['total']."</td>";       
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
