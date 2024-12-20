<?php
require_once 'function.php'; // Pastikan hanya sekali

// Mulai sesi jika belum aktif
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Logika diagnosa
$hasil_diagnosa = "Gagal Ginjal Akut = {$_SESSION['ginjalAkut']}%\n" .
                  "Gagal Ginjal Kronis = {$_SESSION['ginjalKronis']}%\n" .
                  "Batu Ginjal = {$_SESSION['batuGinjal']}%\n" .
                  "Infeksi Ginjal = {$_SESSION['infeksiGinjal']}%\n" .
                  "Kanker Ginjal = {$_SESSION['kankerGinjal']}%\n" .
                  "Gagal Ginjal = {$_SESSION['gagalGinjal']}%";

// Tentukan id_penyakit dengan fungsi maximum
$id_penyakit = maximum(
    $_SESSION['ginjalAkut'], 
    $_SESSION['ginjalKronis'], 
    $_SESSION['batuGinjal'], 
    $_SESSION['infeksiGinjal'], 
    $_SESSION['kankerGinjal'], 
    $_SESSION['gagalGinjal']
);

// Ambil solusi dari database berdasarkan id_penyakit
$solusi = '';
$query_solusi = "SELECT solusi FROM solusi WHERE id_penyakit = '$id_penyakit'";
$result_solusi = mysqli_query($koneksi, $query_solusi);

while ($row = mysqli_fetch_assoc($result_solusi)) {
    $solusi .= $row['solusi'] . "\n"; // Gabungkan solusi dengan newline
}

// Simpan hasil ke database
$id_user = $_SESSION['id_user'];
$query_insert = "INSERT INTO history_diagnosa (id_user, hasil_diagnosa, solusi) 
                 VALUES ('$id_user', '$hasil_diagnosa', '$solusi')";
mysqli_query($koneksi, $query_insert);

// Redirect ke riwayat
header("Location: history.php");
exit;

?>
