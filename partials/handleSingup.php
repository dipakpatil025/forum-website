<?php
 $showError = " ";
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST") {
       include '_dbConnect.php';
       $username  = $_POST['semail'];
       $pass      = $_POST['pass'];
       $cpass     = $_POST['cpass'];
    
        // check already exist otr not
        $existSql = "SELECT * FROM `users` WHERE username = '$username'";
        $existResult  = mysqli_query($conn,$existSql);
        $numRow =  mysqli_num_rows($existResult);
        if ($numRow>0) {
            $showError = "Enail is already extist";
            header("location: /forum/index.php?aleadyexist=true");
            exit();
        }
        else{

            
            
            if (($pass != null && $cpass !=null) && $pass == $cpass ) {
                $passHash = password_hash($pass,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users`(`username`, `pass`) VALUES('$username','$passHash')";
                
                $result = mysqli_query($conn,$sql);
                if ($result) {
                    header("location: /forum/index.php?singupsuccess=true");
                    exit();
                }
                
            }
            else{
                $showError = "Password does not match";
            }
        }
        header("location: /forum/index.php?singupsuccess=false&error='.$showError.'");   
       
    }
    
?>