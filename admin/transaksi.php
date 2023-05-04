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

    if (isset($_POST['delete'])){
        $no = $_POST['delete'];
        mysqli_query($conn, "DELETE from menjual where no_transaksi_jual='$no'");
        echo "<script>alert('Berhasil')
                window.location.href = 'transaksi.php';
                </script>";
    }

    $result = mysqli_query($conn, "SELECT*from admin where username='$username'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tresaikel - Transaksi</title>
    <link rel="stylesheet" href="../css/setilee.css">
    <link rel="icon" href="img/icon.ico">
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
       
       <li><a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
           <span class="nav-item">Dashboard</span>
       </a></li>
       <li class="active"><a href="transaksi.php">
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
       <h2>Riwayat Transaksi</h2>
        <table style="width: 100%;" id="pul">
        <tr>
            <th style="">No. Transaksi</th> <th>ID Sampah</th> <th>Tanggal</th> <th>Berat (Kg)</th> <th>Harga (Rp)</th> 
            <th>Nama User</th> <th>Nama Pengepul</th> <th>Status Transaksi</th> <th>Hapus</th>
        </tr>
        <?php  
            $result3 = mysqli_query($conn, "SELECT menjual.no_transaksi_jual, sampah.id_sampah, menjual.tanggal_jual, sampah.berat, sampah.harga, 
            user.nama as 'nama_user', pengepul.nama as 'nama_pengepul', menjual.cek_user, menjual.cek_pengepul from sampah join menjual on sampah.id_sampah=menjual.id_sampah join pengepul on 
            sampah.username_pengepul=pengepul.username join user on user.username=menjual.username_masyarakat order by menjual.no_transaksi_jual");
            if (mysqli_num_rows($result3) > 0) {
            while($row = mysqli_fetch_array($result3)) {         
                echo "<tr>";
                echo "<td>".$row['no_transaksi_jual']."</td>";
                echo "<td>".$row['id_sampah']."</td>";
                echo "<td>".$row['tanggal_jual']."</td>";
                echo "<td>".$row['berat']."</td>";
                echo "<td>".$row['harga']."</td>";
                echo "<td>".$row['nama_user']."</td>";   
                echo "<td>".$row['nama_pengepul']."</td>";
                if($row['cek_user'] == '1' and $row['cek_pengepul'] == '1'){
                    echo "<td>Selesai</td>";
                } else{
                    echo "<td>Belum Selesai</td>";
                }
                echo "<td style='text-align: center;'><form id='delete' action='' name='delete' method='POST'><button 
                    style='font-size: 21px;' class='delete fas fa-trash-alt' type='submit' name='delete' value='".$row['no_transaksi_jual']."'>
                </button></form></td>";
                echo "</tr>";        
            }
        }
        ?>
        </table>  
    </section>   
    </div>
    <div class="mainn">
    <div class="topnav">
        <a href="index.php" style="margin-left: 8%;">Beranda</a>
        <a class="split" href="../logout.php" style="margin-right: 8%;">Keluar</a>
    </div><br>
</div>
</body>

</html>


