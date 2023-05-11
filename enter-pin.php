<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Verification</title>
</head>
<body>


<main class="login-form">
<div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style=" text-align: center;" >ENTER PIN</div>
                    <div class="card-body"  style=" text-align: center;">
<form method="POST" action="enter-pin.php">
    <input type="text" name="pin">
     
    <input type="submit" name="enter_pin">
</form>
</div>
            </div>
        </div>
    </div>
    </div>

</main>
 <!---------------Footer------------------>
 <section class="footer">

            <p>
                © 2023 Brutus Mudau Production. All rights reserved
            </p>
          
    </section>
</body>
</html>
	<?php
  include('connect/connection.php');
    session_start();
 
    if (isset($_POST["enter_pin"]))
    {
        $pin = $_POST["pin"];
        $user_id = $_SESSION["user"]->id;
 
        $connect = mysqli_connect("localhost", "root", "", "testing_verify");
         
        $sql = "SELECT * FROM login WHERE id = '$user_id' AND pin = '$pin'";
        $result = mysqli_query($connect, $sql);
 
        if (mysqli_num_rows($result) > 0)
        {
            $sql = "UPDATE login SET pin = '' WHERE id = '$user_id'";
            mysqli_query($connect, $sql);
 
            $_SESSION["user"]->is_verified = true;
            header("Location: home.php");
        }
        else
        {
            ?>
            <script>
                        alert("Wrong pin");
                    </script>
                    <?php
        }
    }
 
?>