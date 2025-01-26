<?php
include("connection.php");

if (!isset($_SESSION['name'])){
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}


