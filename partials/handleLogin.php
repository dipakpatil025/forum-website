<?php
 $showError = " ";
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST") {
       include '_dbConnect.php';
       $username  = $_POST['lusername'];
       $pass      = $_POST['lpass'];
        // echo $username;
        // echo ''.password_hash($pass,PASSWORD_DEFAULT);
        // echo "<br>"  ;
        // $passv = password_verify($pass,);
        // check already exist otr not
        $sql = "SELECT * FROM `users` WHERE username = '$username'";
        $existResult = mysqli_query($conn,$sql);
        $numRow =  mysqli_num_rows($existResult);
        if ($numRow == 1) {
            $row = mysqli_fetch_assoc($existResult);
            $test = password_verify('d',$row['pass']);
            $userId = $row['srno'];
            // echo var_dump($test);
            // echo "<br>";
            // echo var_dump($row);

            
            if (password_verify($pass,$row['pass'])) {
                // echo "login success";
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $userId;
                header("location: /forum/index.php");
                // header("location: /forum/index.php?loginerror=true");
                exit(); 
            }
            else{
                echo "login Unsuccess";
                // header("location: /forum/index.php?loginerror=true");
                
            }
            // echo "success";
        }
        else{
            
            $showError = "Enail is already extist";
        }
        header("location: /forum/index.php?loginerror=false");
      
    }
    
?>