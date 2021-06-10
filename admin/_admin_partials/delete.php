<?php
    require "/xampp/htdocs/forum/partials/_dbConnect.php";

    $userid = 0;
    if (isset($_GET)) {
        $userid = number_format($_GET['udeleteid']);
        $s = "DELETE FROM `users` WHERE `users`.`srno` = $userid";
        $result = mysqli_query($conn,$s);
        header("location:/forum/admin/adminDash.php");
    }

    
// Notice: Undefined index: udeleteid in C:\xampp\htdocs\forum\admin\adminDash.php on line 7
    
?>
<!-- C:\xampp\htdocs\forum\admin\_admin_partials\delete.php -->