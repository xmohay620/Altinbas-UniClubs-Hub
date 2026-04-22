<?php
session_start();
include 'db_connect.php';
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user == "admin" && $pass == "123") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else { $error = "Wrong credentials!"; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Admin Login</title><link rel="stylesheet" href="style.css"></head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <form method="POST" style="background:#ddd; padding:30px; border-radius:10px;">
        <h2>Admin Login</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>