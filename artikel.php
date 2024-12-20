<?php
// Mengimpor file function.php untuk menggunakan fungsi yang telah dibuat
include('function.php');

// Mengecek apakah user sudah login
Login();

// Menambahkan artikel
if (isset($_POST['tambahArtikel'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $konten = htmlspecialchars($_POST['konten']);
    $penulis = htmlspecialchars($_POST['penulis']);
    $query = "INSERT INTO artikel (judul, konten, penulis, tanggal) VALUES ('$judul', '$konten', '$penulis', NOW())";
    tambahData($query);
    echo "<script>
    alert('Artikel berhasil ditambahkan');
    document.location.href = 'artikel.php';
    </script>";
}

// Menghapus artikel
if (isset($_GET['hapus'])) {
    $id_artikel = $_GET['hapus'];
    $query = "DELETE FROM artikel WHERE id_artikel = '$id_artikel'";
    hapusData($query);
    echo "<script>
    alert('Artikel berhasil dihapus');
    document.location.href = 'artikel.php';
    </script>";
}

// Mengambil artikel dari database
$query = "SELECT * FROM artikel ORDER BY tanggal DESC";
$artikel = getData($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Penyakit Ginjal</title>
</head>
<body>
    <h1>Artikel Penyakit Ginjal</h1>

    <!-- Form untuk menambah artikel -->
    <h3>Tambah Artikel</h3>
    <form action="artikel.php" method="POST">
        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" required><br>
        <label for="konten">Konten:</label><br>
        <textarea name="konten" id="konten" rows="5" required></textarea><br>
        <label for="penulis">Penulis:</label>
        <input type="text" name="penulis" id="penulis" required><br>
        <button type="submit" name="tambahArtikel">Tambah Artikel</button>
    </form>

    <h3>Daftar Artikel</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Konten</th>
                <th>Penulis</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artikel as $art): ?>
            <tr>
                <td><?= $art['judul'] ?></td>
                <td><?= substr($art['konten'], 0, 100) . '...' ?></td>
                <td><?= $art['penulis'] ?></td>
                <td><?= date("d-m-Y H:i", strtotime($art['tanggal'])) ?></td>
                <td>
                    <a href="artikel.php?hapus=<?= $art['id_artikel'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
