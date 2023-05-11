<?php
    include('connect/connection.php');
    session_start();
    require_once "vendor/autoload.php";
    use Twilio\Rest\Client;
    $sid = 'AC07452f24c1fecd9006152b11fb684344';
    $token = '79bb041be45ee05b8f8894b854b318fb';
    
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $numbers = $_POST["numbers"];
        $password = $_POST["password"];
    
    $conn = mysqli_connect("localhost", "root", "", "testing_verify");
    
    $sql = "SELECT * FROM login WHERE numbers = '$numbers'";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_object($result);
        if (password_verify($password,$row->password))
        {
            if($row->is_tfa_enabled)
            {
    $row->is_verified =  false;
    $_SESSION["user"] = $row;
    
    $pin = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) ;
    $sql = "UPDATE login SET pin = '$pin' WHERE id = '" . $row->id . "'";
    mysqli_query($conn, $sql);
    $client = new Client($sid, $token);
    $client->messages->create(
       $row->phone,array(
        // A Twilio phone number you purchased at twilio.com/console
        "from" => "+27600115087",
        // the body of the text message you'd like to send
        "body" => "Your Brutus 2.0 (Pty) Ltd, login OTP is: " . $pin
    )
        
    );
    header("Location: enter-pin.php");
            }
            else{
                $row->is_verified = true;
                $_SESSION['user'] = $row;
                header("Location: allow.php");
            }
    
        }
        else
        {
            
            ?>
            <script>
                alert("<?php echo "Wrong password"?>");
            </script>
        <?php
        }
    }
    else{
       
        ?>
        <script>
            alert("<?php echo "User does not exist"?>");
        </script>
    <?php
    }
    }
?>
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" re="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!---before-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
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
<style>
    /*-------------------Footer------------*/.footer{
    width: 100%;
    text-align: center;
    padding: 30px 0;
    }
    .footer h4 {
        margin-bottom: 25px;
        margin-top: 20px;
        font-weight: 600;
    }
    .icons .fa{
        color: blue;
        margin: 0 13px;
        cursor: pointer;
        padding: 18px 0;
    }
  
    label {
        display: block;
        color: #7d7d7d;
      }
      
      .floatBlock {
        margin: 0 1.81em 0 0;
        text-align: center;
      }
      
      .labelish {
        text-align: center;
        background-color:blue;
          color:white;
          margin: 0;
      }
      .labelish p{
          color:blue;
          margin: 5em;
      }
     
      .paymentOptions {
       
          border: none;
          display: flex;
          flex-direction: row;
          justify-content: flex-start;
          text-align: center;
          break-before: always;
          margin: 0 0 3em 0;
      }
      
      #purchaseOrder {
          margin: 0 0 2em 0;
      }
      
      
</style>
    <title>Login Form</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
<div class="logo" style="size"><a href="index.php"><img src=""></a></div>
    <div class="container">
        <a class="navbar-brand" href="#">STUDENT LOGIN PAGE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="font-weight:bold; color:black; text-decoration:underline">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="login-form">
<p class="labelish">NB: Only registered students</p>
            <div id="paymentContainer" name="paymentContainer" class="paymentOptions">

                <div id="payCC" class="floatBlock">
                    <label for="paymentCC"> <input id="paymentCC" name="paymentType" type="radio" value="CREDIT_CARD" />  Student </label>
                </div>

                <div id="payInvoice" class="floatBlock">
                    <label for="paymentInv"> <input id="paymentInv" name="paymentType" type="radio" value="INVOICE" /> Alumni </label>
                </div>

                <div id="pay3rdParty" class="floatBlock">
                    <label for="payment3rd"> <input id="payment3rd" name="paymentType" type="radio" /> Stuff </label>
                </div>

            </div>
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="login">
                            <div class="form-group row">
                                <label for="numbers" class="col-md-4 col-form-label text-md-right">Student Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="numbers" class="form-control" name="numbers" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required>
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Login" name="login">
                                <a href="recover_psw.php" class="btn btn-link">
                                    Forgot Your Password?
                                </a>
                            </div>
                    </div>
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
            <div class="icons">
                <i class="fa fa-facebook-official"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-linkedin"></i>
                <i class="fa fa-twitter"></i>
            </div>
    </section>
</body>
</html>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function(){
        if(password.type === "password"){
            password.type = 'text';
        }else{
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>
