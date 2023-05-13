<?php
include 'config/phpconnection.php';



if (isset($_POST['submit'])) {
  

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($email) || empty($password)) {
    $error = 'Please enter both email and password';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Please enter a valid email address';
  } else {
    // Query database
    $result = mysqli_query($conn, "SELECT * FROM user_account WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);
    $hashed_password = $user['acc_password'];

    // Verify password
    if (password_verify($password, $hashed_password)) {
      session_start();
      $_SESSION['user_id'] = $user['user_id'];
      // Redirect to appropriate page
      header('Location: index.php');
      exit();
    } else {
      // Password is incorrect, show error message
      $error = 'Incorrect password, please try again';
    }
  }
}

?>

<!DOCTYPE html>
<html>
<?php include 'templates/header.php'; ?>

<?php if (isset($error)) : ?>
  <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="container-lg">

  <div class="row justify-content-center">
    <div class="display-5 text-center my-5">Sign In</div>

    <form method="POST" >
      <div class="row justify-content-center input-group">
        <div class= "col-md-2 w-75 mx-auto">
          <span class="input-group-text">Email </span>
          <input type="email" name="email" class="form-control" required>
        </div>
        <br>
        <div class= "col-md-2 mb-2 w-75 mx-auto">
          <span class="input-group-text">Password </span>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class='col-md-2 text-center w-100'>
          <input type="submit" name="submit" value="Login" class="btn btn-secondary">
        </div>
      </div>
    </form>
  </div>
</div>



<?php include 'templates/footer.php'; ?>

</html>