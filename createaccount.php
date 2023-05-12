<?php
include 'config/phpconnection.php';

$errors = array('full-name' => '', 'email' => '', 'password' => '', 'address' => '', 'contact-number' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['full-name'])) {
        $errors['full-name'] = 'Full name is required <br/>';
    } else {
        $fullName = $_POST['full-name'];
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fullName)) {
            $errors['full-name'] = 'Full name should only contain letters, hyphens, spaces and apostrophes <br/>';
        }
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required<br>';
    } else {
        $email = $_POST['email'];
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $errors['email'] = 'Invalid email format<br>';
        }
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'A password is required<br>';
    } else {
        $password = $_POST['password'];
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $errors['password'] = 'Password must be at least 8 characters long, and contain at least one uppercase letter, one lowercase letter, one number, and one special character<br>';
        }
    }

    if (empty($_POST['address'])) {
        $errors['address'] = 'An address is required<br>';
    } else {
        $address = $_POST['address'];
        if (!preg_match("/^[a-zA-Z0-9\s,']+$/", $address)) {
            $errors['address'] = 'Address contains invalid characters<br>';
        }
    }

    if (empty($_POST['contact-number'])) {
        $errors['contact-number'] = 'A contact number is required<br>';
    } else {
        $contactNumber = $_POST['contact-number'];
        if (!preg_match("/^[0-9]+$/", $contactNumber)) {
            $errors['contact-number'] = 'Contact number can only contain numeric characters<br>';
        }
    }


    if (array_filter($errors)) {
        
    }else{
        include('config/phpconnection.php');

        if (!$conn) {
            echo 'Connection Error : ' . mysqli_connect_error();
        }

        $name = mysqli_real_escape_string($conn, $_POST['full-name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $contactNumber = mysqli_real_escape_string($conn, $_POST['contact-number']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sqlinsert = "INSERT INTO `user_account` (fullname, email, acc_password, user_address, contact_number) VALUES ('$name', '$email', '$hashedPassword', '$address', '$contactNumber')";

        if (mysqli_query($conn, $sqlinsert)) {
            echo 'User added successfully!';
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>



<html lang="en">
<?php include('templates/header.php'); ?>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;
        var errorMessage = document.getElementById("password-error-message");

        if (password != confirmPassword) {
            errorMessage.innerHTML = "Passwords do not match!";
            return false;
        }

        errorMessage.innerHTML = "";
        return true;
    }
</script>

<div class="container-sm ">
    <div class="text-center display-5"> CREATE AN ACCOUNT</div>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
            <label for="full-name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full-name" name="full-name">
            <div class="text-danger"><?php echo $errors['full-name'] ?></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div class="text-danger"><?php echo $errors['email'] ?></div>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Create Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password">
            <div id="password-error-message" class="form-text text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address">
            <div class="text-danger"><?php echo $errors['address'] ?></div>
        </div>
        <div class="mb-3">
            <label for="contact-number" class="form-label">Contact Number</label>
            <input type="tel" class="form-control" id="contact-number" name="contact-number">
            <div class="text-danger"><?php echo $errors['contact-number'] ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
</div>

<?php include('templates/footer.php'); ?>

</html>