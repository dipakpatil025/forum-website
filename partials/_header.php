<?php
    //  $username = 'dipak';
    session_start();
    $set = false;
    if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin'])) {
            $username =  $_SESSION['username'];
            $set = true;
    
    }
    
    echo '
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="contactus.php" tabindex="-1" >Contact</a>
                </li>
            </ul>
            <form action="search.php"  method="GET" class="d-flex">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                
                </form>
                ';
                if ($set) {
                    echo '
                    <div class="mx-2 ">        
                  
                    <i class="fa fa-user-circle-o " style = "color:white" aria-hidden="true"></i>
                    <label class="text-light" for="">'.$username.'</label>
                  
                    <a class="btn btn-primary p-1  " href="partials/logout.php" role="button">Logout</a>
                    </div>
                    ';
                }
                else{
                    
                    echo '
                    <div class="mx-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">Login</button>
                    <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#singup">Singup</button>
                    </div>';
                }
                echo '
        </div>
    </div>
</nav>
    
    ';


    include 'partials/loginModal.php';
    include 'partials/singupModal.php';
  
    if (isset($_GET['singupsuccess']) && ($_GET['singupsuccess'] == "true") ) {
        echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Singup Success!</strong> Yor are successfully singup .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        ';
    }
    elseif(isset($_GET['singupsuccess']) && ($_GET['singupsuccess'] == "false")){
        echo '
        <div class="alert alert-danger  alert-dismissible fade show my-0 mx-0 h-1" role="alert">
        <strong>Passwod mismatch! </strong>Try again to singUp.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        ';
    }
   
    if (isset($_GET['loginerror'])  && ($_GET['loginerror'] == "true") ) {
        echo '
        <div class="alert alert-success  alert-dismissible fade show my-0 mx-0 h-1" role="alert">
        <strong>Login Success! </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        ';
    }
    elseif(isset($_GET['loginerror']) && ($_GET['loginerror'] == "false")){
        echo '
        <div class="alert alert-danger  alert-dismissible fade show my-0 mx-0 h-1" role="alert">
        <strong>Somthing is Wromg! </strong>Try again to Login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    if (isset($_GET['aleadyexist'])  && ($_GET['aleadyexist'] == "true") ) {
        echo '
        <div class="alert alert-danger  alert-dismissible fade show my-0 mx-0 h-1" role="alert">
        <strong>Username is already exist !</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        ';
    }
    // echo "login";


?>