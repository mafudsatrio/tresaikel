<?php
include '../functions.php';
if($_SESSION["login"] and $_SESSION["admin"]){
    header("Location: dashboard.php");
}else{
    header("Location: login.php");
}
?>