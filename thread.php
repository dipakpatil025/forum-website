<?php
// session_start();
$set = false;
if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin'])) {
    $username =  $_SESSION['username'];
    $set = true;
}
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
</head>
<style>
    .uquestion {
        display: flex;
    }
</style>

<body>

    <?php require 'partials/_header.php' ?>
    <?php require 'partials/_dbConnect.php' ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE categories_id =$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['categories_name'];
        $catdesc = $row['categories_description'];
    }
    ?>

    <?php
    $showaleart = false;
    // echo "dipak";
    // INSERT INTO `treads` (`thread_id`, `thread_title`, `thread_desc`, `thread_categorie_id`, `thread_user_id`, `datetime`) VALUES ('1', 'can anyone tell me how to reverse array', 'I am not able to reverses array please help me, i am new in coding ', '2', '0', '2021-05-21 12:57:28.000000');

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {
        // insert record in to Database

        $q_title = $_POST['question'];
        $q_desc = $_POST['qdesc'];
        // echo $id . "<br>";
        
        $q_userid = $_SESSION['userId'];

        $q_title = str_replace("<", "&lt;", $q_title);
        $q_desc = str_replace("<", "&lt;", $q_title);
        $q_title = str_replace(">", "&gt;", $q_title);
        $q_desc = str_replace(">", "&gt;", $q_title);
        $sql =  "INSERT INTO `treads` (`thread_title`, `thread_desc`, `thread_categorie_id`, `thread_user_id`) VALUES ('$q_title','$q_desc',$id,'$q_userid' )";
        $result = mysqli_query($conn, $sql);
        // echo var_dump($result);
        $showaleart = true;
    }
    ?>
    <?php

    if ($showaleart) {
        echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Qusestion Submites succesfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    ';
    }

    ?>
    <!-- slider/catehories -->
    <div class="container my-4 ">
        <div class="jumbotron bg-secondary text-light my-4">
            <h1 class="display-4">Welcome to <?php echo $catname ?></h1>
            <hr class="my-4">
            <h2>Description</h2>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>Do not Spam / Advertising / Self-promote in the forums.<br>Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. <br>
                Do not cross post questions. <br>
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg mx-2 my-2" href="#" role="button">Learn more</a>
        </div>

    </div>

    <?php
 if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin'])) {
    echo '
    <div class="container my-3">
        <!--  -->
        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
    <h2>Ask AQuestion</h2>
    <div class="form-group ">
        <label for="exampleInputEmail1">Problem Title</label>
        <input type="text" class="form-control" id="question" name="question" aria-describedby="ptitle">
        <small id="emailHelp" class="form-text text-muted">Keep your title short and crips.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea id="qdesc" name="qdesc" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>';
}
else{
    echo '
    <div class="container">
    <h4 class="lead">Login for Post Qusestion</h4>
    </div> 
    ';
}
    ?>

    <div class="container" style="margin-bottom:3.5rem;">
        <h1>Qusestions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `treads` WHERE thread_categorie_id=$id";
        $Noresut = true;
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $Noresut = false;
            $qustion_title = $row['thread_title'];
            $question_desc = $row['thread_desc'];
            $qid            = $row['thread_id'];
            $ctime          = $row['datetime'];
            $userid        = $row['thread_user_id'];
            
            $sqluserid = "SELECT `username` FROM `users` WHERE srno = $userid";
            $resultuser  = mysqli_query($conn,$sqluserid);
            $username = mysqli_fetch_assoc($resultuser);
            // echo $username['username'];
            echo '
            <div class="media my-4  uquestion">
            <img class="mr-3" src="img/userdefoult.png" alt="Generic placeholder image" width="64px" height="64px">
            <div class="media-body">
            @'.$username['username'].'
                <h5 class="mt-0 "><a class="text-dark" href="thread_qustion.php?threadQustionid=' . $qid . '&userid='.$userid.'">' . $qustion_title .' </a></h5>
                </div>
                <div class="mx-1">
                    At ' . $ctime . '
                </div>
        </div>
            ';
        }
        if ($Noresut) {
            echo "<b>Be the first person to ask question.....</b>";
        }
        ?>



        <!-- <div class="media my-4">
            <img class="mr-3" src="img/userdefoult.png" alt="Generic placeholder image" width="64px" height="64px">
            <div class="media-body">
                <h5 class="mt-0"><a href="thread_qustion.php?threadQustionid='.$id.'">Dipak</a></h5>
                Hello i am dipak
            </div>
        </div> -->


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