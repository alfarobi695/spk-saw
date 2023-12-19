<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil SAW</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="mx-5">

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_dss";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $criteria_query = "SELECT weight, type FROM criteria";
    $criteria_result = $conn->query($criteria_query);

    $weights = array();
    $criteria_types = array();

    while ($row = $criteria_result->fetch_assoc()) {
        $weights[] = $row['weight'];
        $criteria_types[] = $row['type'];
    }

    $alternatif_query = "SELECT * FROM alternatif";
    $alternatif_result = $conn->query($alternatif_query);

    $nilai_alternatif = array();

    while ($row = $alternatif_result->fetch_assoc()) {
        $nilai_alternatif[] = array(
            $row['kriteria1'], $row['kriteria2'], $row['kriteria3'],
            $row['kriteria4'], $row['kriteria5'], $row['kriteria6'],
            $row['kriteria7'], $row['kriteria8'], $row['kriteria9'],
            $row['kriteria10']
        );
    }

    function normalize_matrix($matrix, $criteria_type)
    {
        if ($criteria_type == 'benefit') {
            $max_value = max($matrix);
            return array_map(function ($value) use ($max_value) {
                return $value / $max_value;
            }, $matrix);
        } elseif ($criteria_type == 'cost') {
            $min_value = min($matrix);
            return array_map(function ($value) use ($min_value) {
                return $min_value / $value;
            }, $matrix);
        }
    }

    $normalized_matrices = array();
    for ($i = 0; $i < count($weights); $i++) {
        $normalized_matrices[] = normalize_matrix(array_column($nilai_alternatif, $i), $criteria_types[$i]);
    }

    $transposed_matrices = array_map(null, ...$normalized_matrices);
    $total_saw = array_map(function ($row) use ($weights) {
        return array_sum(array_map(function ($value, $weight) {
            return $value * $weight;
        }, $row, $weights));
    }, $transposed_matrices);

    echo "<h2 class='mt-4'>Hasil SAW</h2>";

    $rangking = array();
    foreach ($total_saw as $i => $total) {
        $rangking[] = array('alternatif' => $i + 1, 'nilai' => $total);
    }

    usort($rangking, function ($a, $b) {
        return $b['nilai'] <=> $a['nilai'];
    });

    // Use Bootstrap table classes
    echo "<table class='table table-bordered table-striped mt-3'>";
    echo "<thead class='thead-light'><tr><th>Rangking</th><th>Alternatif</th><th>Nilai SAW</th></tr></thead>";
    foreach ($rangking as $index => $data) {
        echo "<tr><td>" . ($index + 1) . "</td><td>Alternatif-" . $data['alternatif'] . "</td><td>" . $data['nilai'] . "</td></tr>";
    }
    echo "</table>";
    echo "<a class='btn btn-warning' href='tampil_alternatif.php'>Alternatif</a> &nbsp";
    echo "<a class='btn btn-warning' href='tampil_Kriteria.php'>Kriteria</a>";

    $conn->close();
    ?>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>