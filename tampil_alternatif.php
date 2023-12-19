<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Alternatif</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
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

    // Query SQL untuk mengambil data alternatif
    $sql = "SELECT * FROM alternatif";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menampilkan data dalam bentuk tabel
        echo "<div class=''>
                <div class='row'>
                    <div class='col'>
                        <a href='tampil_alternatif.php' style='color: white;' class='btn btn-primary'>Alternatif</a>
                        <a href='tampil_kriteria.php' style='color: white;' class='btn btn-primary'>Kriteria</a>
                        <a href='hasil.php' style='color: white;' class='btn btn-primary'>Nilai Preferensi</a>
                        <br><br>
                        <a href='tambah_alternatif.php' style='color: white;' class='btn btn-success'>Tambah Alternatif</a>
                    </div>
                </div>
                <table class='table table-bordered table-striped mt-3'>
                    <thead class='thead-light'>
                        <tr>
                            <th>ID</th>
                            <th>Kriteria 1</th>
                            <th>Kriteria 2</th>
                            <th>Kriteria 3</th>
                            <th>Kriteria 4</th>
                            <th>Kriteria 5</th>
                            <th>Kriteria 6</th>
                            <th>Kriteria 7</th>
                            <th>Kriteria 8</th>
                            <th>Kriteria 9</th>
                            <th>Kriteria 10</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["alternatif_id"] . "</td>
                    <td>" . $row["kriteria1"] . "</td>
                    <td>" . $row["kriteria2"] . "</td>
                    <td>" . $row["kriteria3"] . "</td>
                    <td>" . $row["kriteria4"] . "</td>
                    <td>" . $row["kriteria5"] . "</td>
                    <td>" . $row["kriteria6"] . "</td>
                    <td>" . $row["kriteria7"] . "</td>
                    <td>" . $row["kriteria8"] . "</td>
                    <td>" . $row["kriteria9"] . "</td>
                    <td>" . $row["kriteria10"] . "</td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='edit_alternatif.php?alternatif_id=" . $row["alternatif_id"] . "'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='hapus_alternatif.php?alternatif_id=" . $row["alternatif_id"] . "'>Hapus</a>
                    </td>
                </tr>";
        }

        echo "</table></div>";
    } else {
        echo "Tidak ada data alternatif.";
    }

    // Tutup koneksi
    $conn->close();
    ?>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
