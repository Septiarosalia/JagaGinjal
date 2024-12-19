<?php
require_once 'function.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$hasil_diagnosa = "Gagal Ginjal Akut = {$_SESSION['ginjalAkut']}%\n" .
                  "Gagal Ginjal Kronis = {$_SESSION['ginjalKronis']}%\n" .
                  "Batu Ginjal = {$_SESSION['batuGinjal']}%\n" .
                  "Infeksi Ginjal = {$_SESSION['infeksiGinjal']}%\n" .
                  "Kanker Ginjal = {$_SESSION['kankerGinjal']}%\n" .
                  "Gagal Ginjal = {$_SESSION['gagalGinjal']}%";

$id_penyakit = maximum(
    $_SESSION['ginjalAkut'], 
    $_SESSION['ginjalKronis'], 
    $_SESSION['batuGinjal'], 
    $_SESSION['infeksiGinjal'], 
    $_SESSION['kankerGinjal'], 
    $_SESSION['gagalGinjal']
);

$solusi = '';
$query_solusi = "SELECT solusi FROM solusi WHERE id_penyakit = '$id_penyakit'";
$result_solusi = mysqli_query($koneksi, $query_solusi);

while ($row = mysqli_fetch_assoc($result_solusi)) {
    $solusi .= $row['solusi'] . "\n";
}

$id_user = $_SESSION['id_user'];
$query_insert = "INSERT INTO history_diagnosa (id_user, hasil_diagnosa, solusi) 
                 VALUES ('$id_user', '$hasil_diagnosa', '$solusi')";
mysqli_query($koneksi, $query_insert);

header("Location: history.php");
exit;

?>
