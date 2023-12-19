<?php

// Nilai kecocokan alternatif terhadap setiap kriteria
$nilai_alternatif = array(
    array(5, 5, 1, 1, 5, 1, 5, 3, 3, 1),
    array(5, 5, 4, 1, 2, 2, 5, 5, 5, 1),
    array(5, 5, 2, 1, 4, 2, 1, 1, 3, 1),
    array(4, 5, 4, 1, 4, 2, 5, 5, 3, 1),
    array(5, 5, 2, 1, 1, 1, 5, 3, 5, 1)
);

// Menentukan bobot untuk masing-masing kriteria
$weights = array(5, 5, 4, 3, 3, 3, 3, 2, 1, 1);

// Menentukan tipe kriteria (cost atau benefit)
$criteria_types = array('cost', 'cost', 'benefit', 'benefit', 'cost', 'cost', 'benefit', 'benefit', 'benefit', 'benefit');

// Fungsi normalisasi matriks
function normalizeMatrix($matrix, $criteriaType) {
    if ($criteriaType == 'benefit') {
        return array_map(function ($value) use ($matrix) {
            return $value / max($matrix);
        }, $matrix);
    } elseif ($criteriaType == 'cost') {
        return array_map(function ($value) use ($matrix) {
            return min($matrix) / $value;
        }, $matrix);
    }
}

// Normalisasi matriks untuk setiap kriteria
$normalizedMatrices = array_map(function ($i) use ($nilai_alternatif, $criteria_types) {
    return normalizeMatrix(array_column($nilai_alternatif, $i), $criteria_types[$i]);
}, array_keys($weights));

// Menghitung nilai total SAW untuk setiap alternatif
$totalSaw = array_map(function ($row) use ($weights) {
    return array_sum(array_map(function ($value, $weight) {
        return $value * $weight;
    }, $row, $weights));
}, transpose($normalizedMatrices));

// Menampilkan hasil
foreach ($totalSaw as $i => $total) {
    echo "Nilai SAW Alternatif-" . ($i + 1) . ": " . $total . PHP_EOL;
}

// Fungsi transpose matriks
function transpose($array) {
    return array_map(null, ...$array);
}

?>
