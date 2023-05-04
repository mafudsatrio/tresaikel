<?php
    include 'functions.php';
    
    if($_SESSION["login"]){
        header("Location: dashboard.php");
    }
    
    if (isset($_POST['register'])) {
        $nama = $_POST['nama'];
        $username = strtolower(stripslashes($_POST["username"]));
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);
        $nohp = $_POST['nohp'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $password = $_POST['password'];
        $kab_kota = $_POST['kab_kota'];
        $role = $_POST['role'];
        
        //cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username from $role where username = '$username'");
        $result2 = mysqli_query($conn, "SELECT email from $role where email = '$email'");
        $result3 = mysqli_query($conn, "SELECT no_hp from $role where no_hp = '$nohp'");
        if (mysqli_fetch_assoc($result)) {
            echo "<script>alert('Username tidak tersedia');
            window.location.href = 'signup.php';
            </script>";
            return false;
        }
        //cek email sudah ada atau belum
        else if (mysqli_fetch_assoc($result2)) {
            echo "<script>alert('Email sudah terdaftar');
            window.location.href = 'signup.php';
            </script>";
            return false;
        }
        //cek no_hp sudah ada atau belum
        else if (mysqli_fetch_assoc($result3)) {
            echo "<script>alert('No. HP sudah terdaftar');
            window.location.href = 'signup.php';
            </script>";
            return false;
        }
        //cek apakah password dan konfirmasi sama
        else if (strcmp($password, $password2) != 0) {
            echo "<script>alert('Password dan konfirmasi berbeda');
            window.location.href = 'signup.php';
            </script>";
            return false;
            } 
        //insert ke database
        else{
            mysqli_query($conn, "INSERT INTO $role (username, nama, email, password, alamat, no_hp, kab_kota) 
            values('$username', '$nama', '$email', '$password', '$alamat', '$nohp', '$kab_kota')");
            echo "<script>alert('Registrasi Berhasil!');
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
    <link rel="stylesheet" href="css/register.css">
    <link rel="icon" href="img/icon.ico">
    <title>Tresaikel - Daftar</title>
</head>

<body>
    <div class="main">
        <div class="topnav">
            <a href="index.php" style="margin-left: 8%;">Beranda</a>
            <a href="profil.php">Profil</a>
            <a href="tentang.php">Tentang</a>
            <a class="split" href="login.php" style="margin-right: 8%;">Masuk</a>
            <a class="split active" href="signup.php">Daftar</a>
        </div>
        <div class="main">
        <img src="img/trash.webp" style="margin-top: 1cm; margin-left: 0.5cm; width: 38%; float: left;" alt="yeay">
        <form name="register" action="" method="POST">
        <h2>Daftar</h2>
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
                <input class="form-input" type="text" name="nama" required>
            </td>
            <td>
                <input class="form-input" type="tes" name="username" required>
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
                <input class="form-input" type="password" name="password" required>
            </td>
            <td>
                <input class="form-input" type="password" name="password2" required>
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
                <input class="form-input" type="tel" name="nohp" required>
            </td>
            <td>
                <input class="form-input" type="email" name="email" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="alamat"><b>Alamat</b></label>
            </td>
        </tr>
        </table>
        <span id='message'></span>
        <input class="form-input" style="width: 833px;" type="text" name="alamat" required>
        <table>
        <tr>
            <td>
                <label for="nohp"><b>Kabupaten/Kota</b></label>
            </td>
            <td>
                <label for="email"><b>Daftar Sebagai</b></label>
            </td>
        </tr>
        <tr>
            <td>
            <select style="width: 426px; height: 1.13cm;" class="form-input" name="kab_kota">
                <option value="Mataram">Mataram</option>
                <option value="Lombok Barat">Lombok Barat</option>
                <option value="Lombok Timur">Lombok Timur</option>
                <option value="Lombok Tengah">Lombok Tengah</option>
                <option value="Lombok Utara">Lombok Utara</option>
            </select>
            </td>
            <td>
            <select style="width: 426px; height: 1.13cm;" class="form-input" name="role">
                <option value="user">User</option>
                <option value="pengepul">Pengepul</option>
            </select>
            </td>
        </tr>
        </table>
        <button type="submit" name="register" class="register-btn" style="font-family: poppins;">Daftar</button>
        <p>Sudah punya akun? Silahkan Masuk <a style="color: #9FC088; text-decoration: none;" href="login.php">di sini</a></p>
        </form>
    </div>
</body>

</html>
