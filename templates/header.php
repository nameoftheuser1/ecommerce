<?php
session_start();

include 'config/phpconnection.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  // Retrieve user information from the database
  $result = mysqli_query($conn, "SELECT * FROM user_account WHERE user_id = " . $_SESSION['user_id']);
  $user = mysqli_fetch_assoc($result);
  // Store user information in session variables
  $_SESSION['fullname'] = $user['fullname'];
  $_SESSION['email'] = $user['email'];
  $_SESSION['acc_address'] = $user['user_address'];
  $_SESSION['contact_number'] = $user['contact_number'];
}

?>

<!DOCTYPE html>

<!DOCTYPE html>

<head>
  <!-- misc -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/ce93933aa6.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">


  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wood Mart</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="assets\logo (2).png" class="img-fluid rounded-top" alt="logo" height="50" width="50">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active " aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#contact">Contact Us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="showproduct.php">Bed</a></li>
              <li><a class="dropdown-item" href="#">Chairs</a></li>
              <li><a class="dropdown-item" href="#">Tables</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Package</a></li>
            </ul>
          </li>
        </ul>

        <form class="d-flex" role="search">
          <?php
          if (isset($_SESSION['user_id'])) {
            echo '<a href="#" class="text-muted overflow-hidden text-decoration-none pe-5" style="height:25px;width:100px" >' . $_SESSION['fullname'] . '</a>';
            echo '<a href="logout.php" class="text-muted text-decoration-none pt-1 pe-3">Logout</a>';
          } else {
            echo '<a href="login.php" class="text-muted text-decoration-none pt-1 pe-3">Sign In</a>';
          }
          ?>
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>