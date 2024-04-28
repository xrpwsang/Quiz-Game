<?php
include 'dbconnection.php';

$username_err = $password_err = '';
$error = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation for Username
    if (empty($_POST['username'])) {
        $username_err = 'Please enter your username.';
    } else {
        $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    }

    // Validation for Password
    if (empty($_POST['password'])) {
        $password_err = 'Please enter your password.';
    } else {
        $password = md5($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
        $select = "SELECT * FROM admin_info WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            // Admin credentials are correct, redirect to admin dashboard or perform other actions
            header('location: newquestion_form.php');
            exit();
        } else {
            $error[] = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="form-container">
        <h3>Login</h3>

        <?php if (!empty($error)): ?>
            <div style="color: red;"><?php echo implode('<br>', $error); ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
            <span style="color: red;"><?php echo $username_err; ?></span><br>

            <label for="password">Password:</label>
            <input type="password" name="password">
            <span style="color: red;"><?php echo $password_err; ?></span><br>

            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>
