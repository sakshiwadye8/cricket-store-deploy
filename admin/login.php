<?php
session_start();
include('../config/constants.php');
?>

<html>
<head>
     <link rel="stylesheet" href="<?php echo SITEURL; ?>css/admin.css">
    <title>Login - Cricket Store Admin Panel</title>


</head>

<body>
<div class="login-container">

    <form class="login-form" method="POST">

        <h2>Cricket Store Admin</h2>
        <p>Login to continue</p>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" name="submit" value="Login" class="btn-login">

    </form>

</div>

<?php
if(isset($_SESSION['login']))
{
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}
?>
</body>
</html>

<?php

if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin 
            WHERE username='$username' 
            AND password='$password'";

    $res = mysqli_query($conn, $sql);

    if($res && mysqli_num_rows($res) == 1)
    {
        $_SESSION['login'] = "Login Successful!";
        $_SESSION['user'] = $username;

        header("Location: index.php"); // change if needed
        exit();
    }
    else
    {
        $_SESSION['login'] = "Username or Password did not match!";
        header("Location: login.php");
        exit();
    }
}
?>
