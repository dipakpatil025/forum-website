<?php
// echo "dipak";
// INSERT INTO `treads` (`thread_id`, `thread_title`, `thread_desc`, `thread_categorie_id`, `thread_user_id`, `datetime`) VALUES ('1', 'can anyone tell me how to reverse array', 'I am not able to reverses array please help me, i am new in coding ', '2', '0', '2021-05-21 12:57:28.000000');

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/style.css">

    <title>DTech-Coding</title>
    <style>
    .ucomment{
        display: flex;
        /* background-color: red; */
    }
    </style>
</head>

<body>
    <?php require 'partials/_header.php' ?>
    <?php require 'partials/_dbConnect.php' ?>

<!-- fetching user name  -->
    <?php
    $uid = $_GET['userid'];
    $sqluserid = "SELECT `username` FROM `users` WHERE srno = '$uid'";
$resultuser  = mysqli_query($conn,$sqluserid);
$username = mysqli_fetch_assoc($resultuser);
// echo $username["username"];  
?>
    <?php
    $id = $_GET['threadQustionid'];
    $sql = "SELECT * FROM `treads` WHERE thread_id =$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $qtitle = $row['thread_title'];
        $qdesc = $row['thread_desc'];
    }
    ?>
    <?php
    $showaleart = false;
    // echo "dipak";
    // INSERT INTO `treads` (`thread_id`, `thread_title`, `thread_desc`, `thread_categorie_id`, `thread_user_id`, `datetime`) VALUES ('1', 'can anyone tell me how to reverse array', 'I am not able to reverses array please help me, i am new in coding ', '2', '0', '2021-05-21 12:57:28.000000');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {
        // insert record in to Database

        $q_comment = $_POST['comment'];
        // echo $id . "<br>";
        
        
        $q_comment = str_replace("<", "&lt;",  $q_comment);
        // $q_userid = str_replace("<", "&lt;",  $q_comment);
        $q_comment = str_replace(">", "&gt;",  $q_comment);
        // $q_userid = str_replace(">", "&gt;",  $q_comment);
        $q_userid = $_SESSION['userId'];
        // echo $q_userid;
        $sql =  "INSERT INTO `comment`(`comment_text`, `thread_id`,`comment_by`)VALUES ('$q_comment',$id,'$q_userid')";
        $result = mysqli_query($conn, $sql);
        // echo var_dump($result);
        $showaleart = true;
    }
    ?>
    <!-- slider/catehories -->
    <div class="container rounded-top my-4 ">
        <div class="jumbotron bg-secondary text-light my-4 p-3">
            <h1 class="display-4"><?php echo $qtitle ?></h1>
            <hr class="my-4">
            <p class="lead"><?php echo $qdesc ?></p>
            <p class=" text-dark"><b>Posted by : <?php echo $username['username']; ?></b></p>
            <a class="btn btn-success btn-lg mx-2 my-2 rounded-top" href="#" role="button">Learn more</a>
        </div>

    </div>
    <?php


    if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin'])) {
 
        echo ' <div class="container my-3 ">
        <!--  -->
        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
        <h2>Comment</h2>
        <div class="form-group">
        <label for="exampleInputPassword1">Type your comment</label>
        <textarea id="comment" name="comment" class="form-control"></textarea>
        </div>
        
        <button type="submit" class="btn btn-success my-3">Submit</button>
        </form>
        ';
    }
    else{
        echo '
        <div class="container">
        <h4 class="lead">Login for Answer Qusestion</h4>
        </div>
        ';
    }
?>  

        <div class="container my-4">
            <h1 class="my-3">Discussion</h1>
            <?php
            $Noresut = true;
            $id = $_GET['threadQustionid'];
            $sql = "SELECT * FROM `comment` WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $Noresut = false;
                $coment_by = $row['comment_by'];
                $comment = $row['comment_text'];

                $cid            = $row['comment_id'];
                $datetime          = $row['datetime'];
                $userid        = $row['comment_by'];
            
                $sqluserid = "SELECT `username` FROM `users` WHERE srno = $userid";
                $resultuser  = mysqli_query($conn,$sqluserid);
                $username = mysqli_fetch_assoc($resultuser);

                echo '
            <div class="media my-4 ucomment">
            <span><img class="mr-3" src="img/userdefoult.png" alt="Generic placeholder image" width="64px" height="64px"></span>
            <div class="media-body">
                <p class="mt-0"><span><b>@'.$username['username'].'  </b></span>  </p> 
                ' . $comment . '
            </div>
        </div>
            ';
            }

            if ($Noresut) {
                echo "<b>Be the first person to ask question.....</b>";
            }
            ?>
          </div>


        <?php require 'partials/_fooder.php' ?>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

</body>

</html>