<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

$produk = query("SELECT * FROM tb_produk WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah');
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
        <input type="hidden" name="id" id="id" value="<?= $produk["id"]; ?>">
        <input type="hidden" name="gambar_lama" id="id" value="<?= $produk["gambar"]; ?>">  
        <ul>
            <li>
                <label for="kode_barang">Kode Barang: </label>
                <input type="text" name="kode_barang" id="kode_barang" value="<?= $produk["kd_barang"]; ?>" required> <br><br>
            </li>
            <li>
                <label for="nama_barang">Nama Barang: </label>
                <input type="text" name="nama_barang" id="nama_barang" value="<?= $produk["nama_barang"]; ?>" required> <br><br>
            </li>
            <li>
                <label for="harga_hpp">Harga HPP: </label>
                <input type="number" name="harga_hpp" id="harga_hpp" value="<?= $produk["harga_hpp"]; ?>" required> <br><br>
            </li>
            <li>
                <label for="harga_retail">Harga Retail: </label>
                <input type="number" name="harga_retail" id="harga_retail" value="<?= $produk["harga_retail"]; ?>" required> <br><br>
            </li>
            <li>
                <label for="harga_distributor">Harga Distributor: </label>
                <input type="number" name="harga_distributor" id="harga_distributor" value="<?= $produk["harga_distributor"]; ?>" required> <br><br>
            </li>
            <li>
                <label for="gambar">Gambar: </label>
                <img src="img/<?= $produk['gambar']; ?>" width="50"> <br>
                <input type="file" name="gambar" id="gambar"> <br><br>
            </li>
            <li>
                <button type="submit" name="submit">Ubah</button>
            </li>
        </ul>
    </form>
</body>
</html>