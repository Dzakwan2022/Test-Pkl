<?php
session_start();

if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
} 

require 'functions.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;


            header("location: index.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color:red;">Username / password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" required> <br><br>
            </li>
            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" required> <br><br>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
    <p>Belum ada akun Untuk Login? <a href="registrasi.php">Registrasi disini</a></p>
</body>
</html>