<?php
// echo "dipak";
// serch Query
// SELECT * FROM `treads` WHERE MATCH (`thread_title`,`thread_desc`) against ('array')
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/style.css">

    <title>DTech-Coding</title>
    <style>
    .uquestion {
        display: flex;
    }
    </style>
</head>

<body>
    <?php require 'partials/_header.php' ?>
    <?php require 'partials/_dbConnect.php' ?>
    
    <div class="search container my-4">
        <h1>Serach result for <em>"<?php echo $_GET['search'];?>"</em> </h1>
    <?php
    
    $Noresut = true;

    $Noresut = true;
    $search = $_GET['search'];
    $sql = "SELECT * FROM `treads` WHERE MATCH (`thread_title`,`thread_desc`) against ('$search')";
    $Noresut = true;
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $Noresut = false;
    
        $Noresut = false;
        $qustion_title = $row['thread_title'];
        $question_desc = $row['thread_desc'];
        $qid            = $row['thread_id'];
        $ctime          = $row['datetime'];
        $userid        = $row['thread_user_id'];
        
        
        //   decoreation 
        
        
        //   $sqluserid = "SELECT `username` FROM `users` WHERE srno = $userid";
        //   $resultuser  = mysqli_query($conn,$sqluserid);
        //   $username = mysqli_fetch_assoc($resultuser);
        
        // @'.$username['username'].'
        // <img class="mr-3" src="img/userdefoult.png" alt="Generic placeholder image" width="64px" height="64px">
        
        
        echo '
        <div class="result uquestion">
        <div class="media-body">
        <h5 class="mt-0 "><a class="text-dark" href="thread_qustion.php?threadQustionid=' . $qid . '&userid='.$userid.'">' . $qustion_title .' </a></h5>
        <p>'.$question_desc.'</p>
        </div>
        </div>
        ';
    }
    // <h3><a href="" class="text-dark">' . $qustion_title .'</a></h3>
    // <p>'. $question_desc.'</p>
    
    if ($Noresut) {
        echo "<h4><b>No Result Found .....</b> </h4>";
    }
    ?>

        <!-- Serach result -->




    </div>




    <?php require 'partials/_fooder.php' ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" cross rigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

</body>

</html>