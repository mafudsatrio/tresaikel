<?php
    session_start();

    $dbServer = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbname = "tresaikel";
    $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbname);

    if (!$conn){
      die("<script>alert('Gagal tersambung dengan database.')</script>");
    }
#data session
    if (!isset($_SESSION["login"])) {
      $_SESSION["login"] = false;
    }
    if (!isset($_SESSION["username"])) {
      $_SESSION["username"] = "";
    }
    #untuk bedain menu admin/user/pengepul
    if (!isset($_SESSION["admin"])) {
      $_SESSION["admin"] = false;
    }
    if (!isset($_SESSION["user"])) {
      $_SESSION["user"] = false;
    }
    if (!isset($_SESSION["pengepul"])) {
      $_SESSION["pengepul"] = false;
    }

    $username = $_SESSION["username"];

    if($_SESSION['user']){
      $user = 'user';
    }else if($_SESSION['pengepul']){
        $user = 'pengepul';
    }
    ?>