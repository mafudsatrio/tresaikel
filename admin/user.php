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
        $user1 = $_POST['delete'];
        mysqli_query($conn, "DELETE from user where username='$user1'");
        echo "<script>alert('Berhasil')
                window.location.href = 'user.php';
                </script>";
    }

    $result = mysqli_query($conn, "SELECT*from admin where username='$username'");

    $result2 = mysqli_query($conn, "SELECT*from user");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tresaikel - Data User</title>
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
       
       <li><a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
           <span class="nav-item">Dashboard</span>
       </a></li>
       <li><a href="transaksi.php">
       <i class="fas fa-file-alt"></i>
           <span class="nav-item">Transaksi</span>
       </a></li>
       <li class="active"><a href="user.php">
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
        <h2>Pilih Pengepul</h2>
        <table style="width: 100%;" id="pul">
        <tr>
            <th>Username</th> <th>Nama</th> <th>Email</th> <th>No. HP</th> <th>Alamat</th> <th>Kab/Kota</th> <th>Edit</th> <th>Hapus</th>
        </tr>
        <?php  if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_array($result2)) {         
            echo "<tr>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['no_hp']."</td>";
            echo "<td>".$row['alamat']."</td>";
            echo "<td>".$row['kab_kota']."</td>";    
            echo "<td><a class='pilih' href='edit_user.php?user=$row[username]'>Edit</a></td>";
            echo "<td style='text-align: center;'><form id='delete' action='' name='delete' method='POST'><button 
                    style='font-size: 21px;' class='delete fas fa-trash-alt' type='submit' name='delete' value='".$row['username']."'>
                </button></form></td>";     
            echo "</tr>";
        }}
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


