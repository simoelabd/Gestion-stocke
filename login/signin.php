<?php
//include connection file
include('connection.php');
//create in instance of class Connection
$connection = new Connection();
//call the selectDatabase method
$connection->selectDatabase('gestion_stock');
$emailValue = "";
$usernameValue = "";
$passwordValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submit"])){

  $emailValue = $_POST["email"];
  $usernameValue = $_POST["username"];
  $passwordValue = $_POST["password"];
  
  if(empty($emailValue) || empty($usernameValue) || empty($passwordValue)){

          $errorMesage = "all fileds must be filed out!";

  }else if(strlen($passwordValue) < 8 ){
      $errorMesage = "password must contains at least 8 char";
  }else if(preg_match("/[A-Z]+/", $passwordValue)==0){
      $errorMesage = "password must contains  at least one capital letter!";
  }else{

    //include the client file
    include('user.php');

    //create new instance of client class with the values of the inputs
    $client = new user($usernameValue,$emailValue,$passwordValue);
    //call the insertClient method
    $client->insertClient('users',$connection->conn);
    //give the $successMesage the value of the static $successMsg of the class
    $successMesage = user::$successMsg;
    //give the $errorMesage the value of the static $errorMsg of the class
    $errorMesage = user::$errorMsg;
    $emailValue = "";
    $usernameValue = "";
  }
}
?>
<!DOCTYPE html>
<header></header>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-ebook-landing.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Unbounded', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #0289d1;
            margin-bottom: 30px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4a5170;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        button {
            background-color: #0289d1;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #1a66ff;
        }

        .alert {
            margin-top: 15px;
            text-align: center;
        }

        p {
            text-align: center;
            margin-top: 15px;
            color: #4a5170;
        }

        a {
            color: #0289d1;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        img {
            width: 800px; /* Set the width of the image */
            height: auto; /* Maintain the aspect ratio */
            border-radius: 10px; /* Add border-radius for rounded corners */
            margin: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Signup</h1>
        <form method="post" >
        
        <?php
            if(!empty($errorMesage)){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMesage</strong>
            </div>";
            }
        ?>
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" name="submit">Sign up</button>
            <?php
            if(!empty($successMesage)){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMesage</strong>
                </div>";
            }
        ?>
        </form>
        <p>If you have an account? <a href="login.php">Login here</a></p>
    </div>
    <img src="../public/img/g_stock.png" alt="gestion de stock img">

</body>

</html>
