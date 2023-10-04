<?php
$showError = false;
$showAlert = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include '_dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $exists = false;
  $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
  else if($exists==false){
    $sql = "INSERT INTO `users` (`username`,`email`, `password`,`address`,`phone`, `dt`) VALUES ('$username','$email', '$password','$address','$phone', current_timestamp())";
    $result = mysqli_query($conn,$sql);
    session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['email'] = $email;
    header("location: welcome.php");
    if($result){
      $showAlert = true;
    }
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<?php

  if($showAlert){
  
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>Your acount has been created successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  if($showError){
  
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Success!</strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
?>

  <div class="container my-4">
    <h1 class="text-center">Registration Page</h1>
    <form action="/Login/signup.php" method="POST">
      <div class="form-group">
        <label for="username">Name</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        
      </div>
      <div class="form-group">
        <label for="email">Email Id :</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We'll never share your Email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp">
        
      </div>
      <div class="form-group">
        <label for="phonr">Phone Number</label>
        <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp">
        
        
        <button type="submit" class="btn btn-primary my-2">Register</button>
      </form>
    </div>
  </div>
</body>

</html>