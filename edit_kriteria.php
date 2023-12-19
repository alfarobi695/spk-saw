<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kriteria</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        table {
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        button {
            margin-top: 10px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h2 class="mt-4" style="text-align: center; line-height: 1.5;">Edit Data Kriteria</h2>
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

    // Proses edit data jika ada parameter id yang dikirimkan
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Proses form edit yang dikirimkan
            $weight = $_POST['weight'];
            $type = $_POST['type'];

            // Query SQL untuk melakukan update data
            $sql = "UPDATE criteria SET weight = '$weight', type = '$type' WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                header("Location: tampil_kriteria.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        } else { // Tampilkan form edit data
            // Query SQL untuk mendapatkan data dari tabel criteria berdasarkan ID
            $sql = "SELECT * FROM criteria WHERE id = $id";
            $result = $conn->query($sql);

            // Periksa apakah ada data yang diambil
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Form untuk mengedit data
                echo "<form action='edit_kriteria.php?id=$id' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <div class='form-group'>
                            <label for='weight'>Weight:</label>
                            <input type='text' class='form-control' name='weight' value='" . $row["weight"] . "'>
                        </div>
                        <div class='form-group'>
                            <label for='type'>Type:</label>
                            <input type='text' class='form-control' name='type' value='" . $row["type"] . "'>
                        </div>
                        <button type='submit' class='btn btn-primary'>Simpan</button>
                        <a href='tampil_kriteria.php' class='btn btn-secondary mt-2'>Kembali</a>

                    </form>";
            } else {
                echo "Data tidak ditemukan";
            }
        }

    } else { // Tampilkan data dan tombol edit
        // Query SQL untuk mendapatkan data dari tabel criteria
        $sql = "SELECT * FROM criteria";
        $result = $conn->query($sql);

        // Periksa apakah ada data yang diambil
        if ($result->num_rows > 0) {
            // Output data dari setiap baris
            echo "<table class='table table-bordered'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Weight</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["weight"] . "</td>
                        <td>" . $row["type"] . "</td>
                        <td><a href='edit_kriteria.php?id=" . $row["id"] . "' class='btn btn-warning'>Edit</a></td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "Tidak ada data";
        }
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
