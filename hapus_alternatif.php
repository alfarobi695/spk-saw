<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_dss"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil ID dari parameter URL
$id = $_GET['alternatif_id'];

// Query SQL untuk menghapus data berdasarkan ID
$sql = "DELETE FROM alternatif WHERE alternatif_id = $id";

if ($conn->query($sql) === TRUE) {
    // Jika berhasil dihapus, alihkan ke halaman tampil_alternatif.php
    header("Location: tampil_alternatif.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
