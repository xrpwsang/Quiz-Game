<?php
include 'dbconnection.php';

$name_err = $email_err = $username_err = $password_err = $confirm_password_err = '';
$error = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation for Name
    if (empty($_POST['name'])) {
        $name_err = 'Please enter your name.';
    } else {
        $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    }

    // Validation for Email
    if (empty($_POST['email'])) {
        $email_err = 'Please enter your email.';
    } else {
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    }

    // Validation for Username
    if (empty($_POST['username'])) {
        $username_err = 'Please enter a username.';
    } else {
        $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    }

    // Validation for Password
    if (empty($_POST['password'])) {
        $password_err = 'Please enter a password.';
    } else {
        $password = md5($_POST['password']);
    }

    // Validation for Confirm Password
    if (empty($_POST['confirm'])) {
        $confirm_password_err = 'Please confirm your password.';
    } else {
        $confirm_password = md5($_POST['confirm']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'Password and confirmation do not match.';
        }
    }

    if (empty($name_err) && empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $select = "SELECT * FROM admin_info WHERE username='$username'";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $error[] = 'User already exists!';
        } else {
            $insert = "INSERT INTO admin_info (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";
            mysqli_query($conn, $insert);
            $success_message = 'Admin registered successfully!';

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="form-container">
        <h3>Register Admin</h3>
        <?php if (!empty($success_message)): ?>
            <div style="color: green;"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
            <span style="color: red;"><?php echo $name_err; ?></span><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
            <span style="color: red;"><?php echo $email_err; ?></span><br>

            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
            <span style="color: red;"><?php echo $username_err; ?></span><br>

            <label for="password">Password:</label>
            <input type="password" name="password">
            <span style="color: red;"><?php echo $password_err; ?></span><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm">
            <span style="color: red;"><?php echo $confirm_password_err; ?></span><br>

            <input type="submit" name="submit" value="Register">
            <div class="alreadyHaveAccount">
                <label><a href="adminlogin.php" class="register">Already have an account?</a></label>
            </div>
        </form>
    </div>
</body>
</html>
