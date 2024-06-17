<?php
require 'functions.php';

if (isset($_POST["registrasi"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('berhasil Registrasi');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Halaman Registrasi</h1>

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
                <label for="password2">Konfirmasi password: </label>
                <input type="password" name="password2" id="password2" required> <br><br>
            </li>
            <li>
                <button type="submit" name="registrasi">Registrasi</button>
            </li>
        </ul>
    </form>
    <a href="login.php">Back To Login</a>
</body>
</html>