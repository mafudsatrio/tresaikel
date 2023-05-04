<?php
include '../functions.php';
if($_SESSION["login"] and $_SESSION["admin"]){
    header("Location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION["login"] = true;
			$_SESSION["admin"] = true;
            header("Location: dashboard.php");
        } 
    $error = true;
} 

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="../img/icon.ico">
    <title>Tresaikel - Login Admin</title>
</head>

<body>
    <div class="main">
    <div class="topnav">
        <a href="index.php" style="margin-left: 8%;">Beranda</a>
        <a href="profil.php">Profil</a>
        <a href="tentang.php">Tentang</a>
        <a class="split active" href="login.php" style="margin-right: 8%;">Masuk</a>
    </div><br>
    <img src="/tresaikel/img/trash.webp" width="38%" style="margin-left: 3.5cm; float: left;"/>
    
    <br><br><br><br><br><br><br>
    
    <form action="" method="POST" id="login">
        <p><b>Admin Login</b></p>
        <?php if (isset($error)) : ?>
			<p style="color:red; id="error">Username/Password salah</p>
		<?php endif; ?>
        <label for="username"><b>Username</b></label>
        <input class="form-input" type="text" name="username" required>
        <label for="password"><b>Password</b></label>
        <input class="form-input" type="password" name="password" required>
        <button type="submit" name="login" class="login-btn" style="font-family: poppins;">Masuk</button>
  </form>
</body>
</html>
