<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Kriteria</title>
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
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query SQL untuk mendapatkan data dari tabel criteria
    $sql = "SELECT * FROM criteria";
    $result = $conn->query($sql);

    // Periksa apakah ada data yang diambil
    if ($result->num_rows > 0) {
        // Output data dari setiap baris
        echo "<div class='container'>
                <div class='row'>
                    <div class='col'>
                    <a href='tampil_alternatif.php' style='color: white;' class='btn btn-primary'>Alternatif</a>
                    <a href='tampil_kriteria.php' style='color: white;' class='btn btn-primary'>Kriteria</a>
                    <a href='hasil.php' style='color: white;' class='btn btn-primary'>Nilai Preferensi</a>
                    </div>
                </div>
                <table class='table table-bordered table-striped mt-3'>
                    <thead class='thead-light'>
                        <tr>
                            <th>ID</th>
                            <th>Weight</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["weight"] . "</td>
                    <td>" . $row["type"] . "</td>
                    <td><a class='btn btn-warning btn-sm' href='edit_kriteria.php?id=" . $row["id"] . "'>Edit</a></td>
                  </tr>";
        }

        echo "</table></div>";
    } else {
        echo "Tidak ada data";
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
