<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "pkl";

$conn = mysqli_connect($host, $username, $password, $database);

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function tambah($data) {
    global $conn;

    $kode_barang = ($data["kode_barang"]);
    $nama_barang = ($data["nama_barang"]);
    $harga_hpp = ($data["harga_hpp"]);
    $harga_retail = ($data["harga_retail"]);
    $harga_distributor = ($data["harga_distributor"]);
    
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO tb_produk VALUES ('', '$kode_barang', '$nama_barang', '$harga_hpp', '$harga_retail', '$harga_distributor', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES ['gambar']['error'];
    $tmpName = $_FILES ['gambar']['tmp_name'];


    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));


    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id) {
    global $conn;

    $query = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id='$id'");
    if (!$query) {
        return false;
    }

    $file = mysqli_fetch_assoc($query);
    if ($file) {
        $filePath = 'img/' . $file['gambar'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $hapus = "DELETE FROM tb_produk WHERE id='$id'";
    mysqli_query($conn, $hapus);

    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $kode_barang = ($data["kode_barang"]);
    $nama_barang = ($data["nama_barang"]);
    $harga_hpp = ($data["harga_hpp"]);
    $harga_retail = ($data["harga_retail"]);
    $harga_distributor = ($data["harga_distributor"]);
    $gambar_lama = ($data["gambar_lama"]);
    
    
    $query = "UPDATE tb_produk SET kd_barang = '$kode_barang', nama_barang = '$nama_barang', harga_hpp = '$harga_hpp', harga_retail = '$harga_retail', harga_distributor = '$harga_distributor', gambar = '$gambar' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar');
        </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
        alert('password tidak sesuai');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO pengguna VALUES ('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}
?>