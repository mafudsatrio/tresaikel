<?php
include 'functions.php';
if($_SESSION["login"]){
    header("Location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $_POST['user'];
    
    if ($_POST["user"]==="user"){
        $sql = "SELECT * FROM $user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION["login"] = true;
			$_SESSION["user"] = true;
            header("Location: dashboard.php");
        } 
    }else if ($_POST["user"]==="pengepul"){
        $sql = "SELECT * FROM $user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION["login"] = true;
			$_SESSION["pengepul"] = true;
            header("Location: dashboard.php");
        }
    }
    $error = true;
} 

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/icon.ico">
    <title>Tresaikel - Masuk</title>
    <script src="script/login.js"></script>
</head>

<body>
    <div class="main">
    <div class="topnav">
        <a href="index.php" style="margin-left: 8%;">Beranda</a>
        <a href="profil.php">Profil</a>
        <a href="tentang.php">Tentang</a>
        <a class="split active" href="login.php" style="margin-right: 8%;">Masuk</a>
        <a class="split" href="signup.php">Daftar</a>
    </div><br>
    <img src="/tresaikel/img/trash.webp" width="38%" style="margin-left: 3.5cm; float: left;"/>
    
    <br><br><br><br><br><br><br>
    
    <form action="" method="POST" id="login">
        <div class="pilih-user">
        <label for="user"><p><b>Masuk Sebagai</b></p></label>
            <div class="switch-field">
                <input type="radio" id="user" name="user" value="user" checked />
                <label for="user">User</label>
                <input type="radio" id="pengepul" name="user" value="pengepul" />
                <label for="pengepul">Pengepul</label>
            </div>
		</div>
        <?php if (isset($error)) : ?>
			<p style="color:red; id="error">Username/Password salah</p>
		<?php endif; ?>
        <label for="username"><b>Username</b></label>
        <input class="form-input" type="text" name="username" required>
        <label for="password"><b>Password</b></label>
        <input class="form-input" type="password" name="password" required>
        <button type="submit" name="login" class="login-btn" style="font-family: poppins;">Masuk</button>
        <p>Belum punya akun? Silahkan daftar <a style="color: #9FC088; text-decoration: none;" href="signup.php">di sini</a></p>
  </form>
</body>
</html>
