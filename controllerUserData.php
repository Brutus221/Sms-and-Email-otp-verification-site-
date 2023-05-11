<?php 

require "connect/connection.php";
$email = "";
$name = "";
$errors = array();

  include('connect/connection.php');
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];
    }
?>
