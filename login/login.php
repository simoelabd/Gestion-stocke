<?php
session_start();

?><?php
// Include connection file
include('connection.php');
// Create an instance of the Connection class
$connection = new Connection();
// Select the database
$connection->selectDatabase('gestion_stock');
$emailValue = "";
$passwordValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submit"])) {

  $emailValue = $_POST["email"];
  $passwordValue = $_POST["password"];


  if(empty($emailValue) || empty($passwordValue)) {
      $errorMesage = "all fileds must be filed out!";
  } else {
      $query = "SELECT * FROM users WHERE email = '$emailValue'";
      $result = mysqli_query($connection->conn, $query);

      if($row = mysqli_fetch_assoc($result)) {
          if(password_verify($passwordValue, $row['password'])) {
              // Password is correct, redirect to lessons.php
              $_SESSION['id'] = $row['id'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['username'] = $row['username'];
              header("Location: ../vue/dashboard.php");
                            
          } else {
            $errorMesage = "Wrong password !";
          }
      } else {
        $errorMesage = "User not found !";
      }
  }
}
?>


<!DOCTYPE html>
<header></header>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Login</title>
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
            width: 800px;
            height: auto; 
            border-radius: 10px; 
            margin: 15px;
        }
    </style>
</head>


<body>
  <div class="container">
        <h1>Login</h1>

        <form method="post" >
        <?php
        if(!empty($errorMesage)){
        echo "<div style='color: red;' class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMesage</strong>
        </div>";
        }
        ?>
        
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" name="submit">Login</button>
        </form>
        <p>You don't have an account? <a href="signin.php">Register here</a></p>
  </div>
  <img src="../public/img/g_stock.png" alt="gestion de stock img">
</body>

</html>