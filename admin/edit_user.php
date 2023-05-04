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

    $filename = '';
    $user1 = $_GET['user'];
    if (isset($_POST['register'])) {
        
        $nama = $_POST['nama'];
        $username1 = strtolower(stripslashes($_POST["username"]));
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);
        $nohp = $_POST['nohp'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $password = $_POST['password'];
        $sql = mysqli_query($conn, "SELECT kab_kota from user where username = '$user1'");
        $sql2 = mysqli_fetch_array($sql);
        if($_POST['kab_kota'] == ''){
            $kab_kota = $sql2['kab_kota'];
        }else{
            $kab_kota = $_POST['kab_kota'];
        }
        $filename = $_FILES['foto']['name'];

        $result = mysqli_query($conn, "SELECT username from user where username = '$username1' and username != '$user1'");

        $result2 = mysqli_query($conn, "SELECT email from user where username = '$user1'");
        $result3 = mysqli_fetch_array($result2);
        $email1 = $result3['email'];
        $result4 = mysqli_query($conn, "SELECT email from user where email = '$email1' and email != '$email'");

        //cek username sudah ada atau belum
        if (mysqli_fetch_assoc($result)) {
            echo "<script>alert('Username tidak tersedia');
            window.location.href = 'edit_user.php';
            </script>";
            return false;
        }
        //cek email sudah ada atau belum
        else if (mysqli_fetch_assoc($result4)) {
            echo "<script>alert('Email sudah terdaftar');
            window.location.href = 'edit_user.php';
            </script>";
            return false;
        }
        //cek apakah password dan konfirmasi sama
        else if (strcmp($password, $password2) != 0) {
            echo "<script>alert('Password dan konfirmasi berbeda');
            window.location.href = 'edit_user.php';
            </script>";
            return false;
            } 
        //update ke database
        else{
            //update dengan foto
            if($filename != ""){
                $rand = rand();
                $ekstensi =  array('png','jpg','jpeg');
                $ukuran = $_FILES['foto']['size'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                
                if(!in_array($ext,$ekstensi) ) {
                    echo "<script>alert('Ekstensi file tidak sesuai');
                    window.location.href = 'edit_user.php';
                    </script>";
                    return false;
                }else{
                    if($ukuran < 1044070){		
                        $xx = $rand.'_'.$filename;
                        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/pp/'.$rand.'_'.$filename);
                        mysqli_query($conn, "UPDATE user set username='$username1', nama='$nama', email='$email', password='$password', 
                        alamat='$alamat', no_hp='$nohp', kab_kota='$kab_kota', foto='$xx' where username='$user1'");
                        $_SESSION['username']=$username1;
                        echo "<script>alert('Berhasil edit profil');
                        window.location.href = 'edit_user.php';
                        </script>";
                    }else{
                        echo "<script>alert('Ukuran gambar terlalu besar');
                        window.location.href = 'edit_user.php';
                        </script>";
                        return false;
                    }
                }                    
            }else{
                //update tanpa foto
                mysqli_query($conn, "UPDATE user set username='$username1', nama='$nama', email='$email', password='$password', 
                alamat='$alamat', no_hp='$nohp', kab_kota='$kab_kota' where username='$user1'");
                echo "<script>alert('Berhasil edit profil');
                window.location.href = 'edit_user.php';
                </script>";
            }  
        }
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/setilee.css">
    <link rel="icon" href="img/icon.ico">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Tresaikel - Edit User</title>
</head>

<body style="background-image: url('../img/jojo.jpg'); background-size: 100%;">   
        <nav>
       <ul>
       <br><br><br>
       <?php
       $result5 = mysqli_query($conn, "SELECT*from admin where username='{$_SESSION['username']}'");
       if (mysqli_num_rows($result5) > 0) {
                while ($row = mysqli_fetch_assoc($result5)) {
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
            
            $sql = "SELECT * FROM user WHERE username='$user1'";
            $sql2 = mysqli_query($conn, $sql);
            if (mysqli_num_rows($sql2) > 0) {
                while ($row = mysqli_fetch_assoc($sql2)) {
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
       <div class="container" style="margin-top: 75px;">
        <form style="margin-left: 240px;" name="register" action="" method="POST" enctype="multipart/form-data">
        <h2>Edit Profil User</h2>
        <table>
        <tr>
            <td>
                <label for="nama"><b>Nama Lengkap</b></label>
            </td>
            <td>
                <label for="username"><b>Username</b></label>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-input" type="text" name="nama" value="<?php echo $row['nama']; ?>" required>
            </td>
            <td>
                <input class="form-input" type="tes" name="username" value="<?php echo $row['username']; ?>" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password"><b>Kata Sandi</b></label>
            </td>
            <td>
                <label for="password2"><b>Konfirmasi Kata Sandi</b></label>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-input" type="password" name="password" value="<?php echo $row['password']; ?>" required>
            </td>
            <td>
                <input class="form-input" type="password" name="password2" value="<?php echo $row['password']; ?>" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="nohp"><b>No. Hp</b></label>
            </td>
            <td>
                <label for="email"><b>Email</b></label>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-input" type="tel" name="nohp" value="<?php echo $row['no_hp']; ?>" required>
            </td>
            <td>
                <input class="form-input" type="email" name="email" value="<?php echo $row['email']; ?>" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="alamat"><b>Alamat</b></label>
            </td>
        </tr>
        </table>
        <span id='message'></span>
        <input class="form-input" style="width: 805px;" type="text" name="alamat" value="<?php echo $row['alamat']; ?>" required>
        <table>
        <tr>
            <td>
                <label for="kab_kota"><b>Kabupaten/Kota</b></label>
            </td>
            <td>
                <label for="foto"><b>Foto Profil</b></label>
            </td>
        </tr>
        <tr>
            <td>
            <select style="width: 400px; height: 1.13cm;" class="form-input" name="kab_kota">
                <option value="">-Pilih-</option>
                <option value="Mataram">Mataram</option>
                <option value="Lombok Barat">Lombok Barat</option>
                <option value="Lombok Timur">Lombok Timur</option>
                <option value="Lombok Tengah">Lombok Tengah</option>
                <option value="Lombok Utara">Lombok Utara</option>
            </select>
            </td>
            <td>
            <div class="form-input" style="margin-bottom: 0.761cm; height: 1.13cm;">
                <input name="foto" type="file">
            </div>
            </td>
        </tr>
        </table>
        <button type="submit" name="register" class="register-btn" style="font-family: poppins;">Edit</button>
        </form>
    </div>
    <?php }
        }else{
            header("Location: user.php");
        }
         ?>
    <div class="topnav">
            <a href="index.php" style="margin-left: 8%;">Beranda</a>
            <a href="profil.php">Profil</a>
            <a href="tentang.php">Tentang</a>
            <a class="split" href="../logout.php" style="margin-right: 8%;">Keluar</a>
        </div>
</body>

</html>