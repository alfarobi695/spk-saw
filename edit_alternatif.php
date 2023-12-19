<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Alternatif</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            margin-top: 10px;
        }

        button {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h2 class="mt-4" style="text-align: center; line-height: 1.5;">Edit Data Alternatif</h2>

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

    // Cek apakah form telah disubmit untuk update data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['alternatif_id'];
        $kriteria1 = $_POST['kriteria1'];
        $kriteria2 = $_POST['kriteria2'];
        $kriteria3 = $_POST['kriteria3'];
        $kriteria4 = $_POST['kriteria4'];
        $kriteria5 = $_POST['kriteria5'];
        $kriteria6 = $_POST['kriteria6'];
        $kriteria7 = $_POST['kriteria7'];
        $kriteria8 = $_POST['kriteria8'];
        $kriteria9 = $_POST['kriteria9'];
        $kriteria10 = $_POST['kriteria10'];

        // Query SQL untuk update data
        $sql = "UPDATE alternatif SET 
                kriteria1 = '$kriteria1', 
                kriteria2 = '$kriteria2', 
                kriteria3 = '$kriteria3', 
                kriteria4 = '$kriteria4', 
                kriteria5 = '$kriteria5', 
                kriteria6 = '$kriteria6', 
                kriteria7 = '$kriteria7', 
                kriteria8 = '$kriteria8', 
                kriteria9 = '$kriteria9', 
                kriteria10 = '$kriteria10' 
                WHERE alternatif_id = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: tampil_alternatif.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Ambil ID dari parameter URL
    $id = $_GET['alternatif_id'];

    // Query SQL untuk mengambil data berdasarkan ID
    $sql = "SELECT * FROM alternatif WHERE alternatif_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <input type="hidden" name="alternatif_id" value="<?php echo $row['alternatif_id']; ?>">

        <label for="kriteria1">Kriteria 1:</label>
        <input type="number" class="form-control" name="kriteria1" value="<?php echo $row['kriteria1']; ?>" required>

        <label for="kriteria2">Kriteria 2:</label>
        <input type="number" class="form-control" name="kriteria2" value="<?php echo $row['kriteria2']; ?>" required>

        <label for="kriteria3">Kriteria 3:</label>
        <input type="number" class="form-control" name="kriteria3" value="<?php echo $row['kriteria3']; ?>" required>

        <label for="kriteria4">Kriteria 4:</label>
        <input type="number" class="form-control" name="kriteria4" value="<?php echo $row['kriteria4']; ?>" required>

        <label for="kriteria5">Kriteria 5:</label>
        <input type="number" class="form-control" name="kriteria5" value="<?php echo $row['kriteria5']; ?>" required>

        <label for="kriteria6">Kriteria 6:</label>
        <input type="number" class="form-control" name="kriteria6" value="<?php echo $row['kriteria6']; ?>" required>

        <label for="kriteria7">Kriteria 7:</label>
        <input type="number" class="form-control" name="kriteria7" value="<?php echo $row['kriteria7']; ?>" required>

        <label for="kriteria8">Kriteria 8:</label>
        <input type="number" class="form-control" name="kriteria8" value="<?php echo $row['kriteria8']; ?>" required>

        <label for="kriteria9">Kriteria 9:</label>
        <input type="number" class="form-control" name="kriteria9" value="<?php echo $row['kriteria9']; ?>" required>

        <label for="kriteria10">Kriteria 10:</label>
        <input type="number" class="form-control" name="kriteria10" value="<?php echo $row['kriteria10']; ?>" required>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="tampil_alternatif.php" class="btn btn-secondary mt-3">Kembali</a>
    </form>
    <?php
    } else {
        echo "Data tidak ditemukan.";
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
