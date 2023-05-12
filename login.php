<?php
    include 'config/phpconnection.php';

session_start();

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
      // Password is correct, set session variable
      $_SESSION['user_id'] = $user['id'];
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

  <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
  
  <form method="post">
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" name="submit" value="Login">
  </form>

  <?php include 'templates/footer.php'; ?>

</html>
