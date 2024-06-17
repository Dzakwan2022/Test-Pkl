<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambah');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambah');
        document.location.href = 'index.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="kode_barang">Kode Barang: </label>
                <input type="text" name="kode_barang" id="kode_barang" required> <br><br>
            </li>
            <li>
                <label for="nama_barang">Nama Barang: </label>
                <input type="text" name="nama_barang" id="nama_barang" required> <br><br>
            </li>
            <li>
                <label for="harga_hpp">Harga HPP: </label>
                <input type="number" name="harga_hpp" id="harga_hpp" required> <br><br>
            </li>
            <li>
                <label for="harga_retail">Harga Retail: </label>
                <input type="number" name="harga_retail" id="harga_retail" required> <br><br>
            </li>
            <li>
                <label for="harga_distributor">Harga Distributor: </label>
                <input type="number" name="harga_distributor" id="harga_distributor" required> <br><br>
            </li>
            <li>
                <label for="gambar">Gambar: </label>
                <input type="file" name="gambar" id="gambar" required> <br><br>
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>