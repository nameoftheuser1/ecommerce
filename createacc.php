<?php

include 'config\phpconnection.php';

$fullname = $email = $password = $address = $contact_number = '';
$errors = array('fullname' => '', 'email' => '', 'password' => '', 'address' => '', 'contact-number' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['fullname'])) {
        $errors['fullname'] = 'Enter your full name';
    } else {
        $fullname = $_POST['fullname'];
        if (!preg_match("/^[A-Za-z]+(?:\s[A-Za-z]+)+$/", $fullname)) {
            $errors['fullname'] = 'Enter a valid name';
        }
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Enter your email';
    } else {
        $email = $_POST['email'];

        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $errors['email'] = 'Enter a valid email address';
        }
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Enter your password';
    } else {
        $password = $_POST['password'];
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
            $errors['password'] = 'Password must be at least 8 characters long, contain at least one lowercase letter, one uppercase letter, and one digit';
        }
    }

    if (empty($_POST['address'])) {
        $errors['address'] = 'Enter your address';
    } else {
        $address = $_POST['address'];
        if (!preg_match('/^[a-zA-Z0-9\s\.,#-]+$/', $address)) {
            $errors['address'] = 'Enter a valid address';
        }
    }

    if (empty($_POST['contact-number'])) {
        $errors['contact-number'] = 'Enter your contact number';
    } else {
        $contact_number = $_POST['contact-number'];

        if (!preg_match('/^\+?\d{10,}$/', $contact_number)) {
            $errors['contact_number'] = 'Enter a valid contact number';
        }
    }

    if (array_filter($errors)) {
    } else {

        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $contact_number = mysqli_real_escape_string($conn, $_POST['contact-number']);

        $sql = "INSERT INTO user_account (fullname, email, acc_password, user_address, contact_number) VALUES ('$fullname', '$email', '$hashed_password', '$address', '$contact_number')";

        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success" role="alert">User has been created successfully.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Something went wrong. Please try again later.</div>';
        }
        mysqli_close($conn);


        header('Location: login.php');
    }
}

?>
<html lang="en">
<?php include 'templates/header.php'; ?>

<script>
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordError = document.getElementById('password-error-message');

    form.addEventListener('submit', function(event) {
        // Prevent form submission
        event.preventDefault();

        // Check if passwords match
        if (passwordInput.value !== confirmPasswordInput.value) {
            passwordError.textContent = 'Passwords do not match';
            return;
        }

        // If all validations pass, submit form
        form.submit();
    });
</script>


<section class="container">
    <div class="container-fluid w-50 py-3 my-5 border border-dark rounded shadow-lg">
        <div class="display-5 text-center"> Create an Account</div>
        <form action="createacc.php" method="POST">

            <div class="form-group">
                <label for="fullname">Full name:</label>
                <input name="fullname" type="name" class="form-control" id="fullname" placeholder="e.g. Juan Dela Cruz" value="<?php echo htmlspecialchars($fullname) ?>">
                <div class="text-danger"><?php echo $errors['fullname']; ?></div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="e.g. Juancruz@gmail.com" value="<?php echo htmlspecialchars($email) ?>">
                <div class="text-danger"><?php echo $errors['email']; ?></div>
            </div>
            
            <div class="form-group">
                <label for="Xpassword">Password</label>
                <input name="password" type="password" class="form-control" id="Xpassword" placeholder="Password">
                <div class="text-danger"><?php echo $errors['password']; ?></div>
            </div>

            <div class="form-group">
                <label for="Ypassword">Confirm Password</label>
                <input type="password" class="form-control" id="Ypassword" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input name="address" type="name" class="form-control" id="address" placeholder="e.g Brgy 8, Balayan, Batangas" value="<?php echo htmlspecialchars($address) ?>">
                <div class="text-danger"><?php echo $errors['address']; ?></div>
            </div>

            <div class="form-group">
                <label for="contact-number">Contact Number</label>
                <input name="contact-number" type="name" class="form-control" id="contact-number" placeholder="e.g. Juan Dela Cruz" value="<?php echo htmlspecialchars($contact_number) ?>">
                <div class="text-danger"><?php echo $errors['contact-number']; ?></div>
            </div>

            <div class="text-center">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-1">
            </div>

        </form>

    </div>
</section>

<?php include 'templates/footer.php'; ?>

</html>