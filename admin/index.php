<?php
require "../partials/_dbConnect.php";
  $nullstatus   = false;
  $login_status = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['usernmae'];
    $pass = $_POST['pass'];
    
    if ($pass == NULL || $username == NULL) {
      $nullstatus = true;
    }
    else{
        
        $sql = "SELECT * FROM `admintbl` WHERE `username` = '$username'";
        $result = mysqli_query($conn,$sql);
        $numRow =  mysqli_num_rows($result);
        // echo var_dump($numRow);
        if ($numRow == 1) {
          $row = mysqli_fetch_assoc($result);
          if ($pass == $row['password']) {
            $login_status = true;
          }
        }
        if ($login_status) {
          session_start();
          $_SESSION['adminname'] = $username;
          header("location:adminDash.php");
        }
    }
    
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/index_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
      <h3>Admin Login</h3>
    </div>

    <!-- Login Form -->
    <form action="index.php" method="POST">
      <input type="text" id="login" class="fadeIn second" name="usernmae" placeholder="Username">
      <!-- <br><label for=""><?php ?></label><br> -->
      <input type="password" id="password" class="fadeIn third" name="pass" placeholder="password">
      <br><label for=""style="color:red;"><?php 
        if ($nullstatus) {
          echo "Please Fill data*";
        }
      ?></label><br></label>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>