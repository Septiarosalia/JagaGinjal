<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tambah_btn"])) {
    require_once "function.php"; // Pastikan file ini memiliki koneksi $koneksi ke database
    $penyakit = mysqli_real_escape_string($koneksi, $_POST["penyakit"]);

    // Validasi input
    if (!empty($penyakit)) {
        // Masukkan data ke database
        $query = "INSERT INTO penyakit (penyakit) VALUES ('$penyakit')";
        if (mysqli_query($koneksi, $query)) {
            echo "<div class='alert alert-success'>Data penyakit berhasil ditambahkan!</div>";
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat menambahkan data: " . mysqli_error($koneksi) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Nama penyakit tidak boleh kosong!</div>";
    }
}
?>

<?php
require_once "function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
    }
} else {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"/>
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
        rel="stylesheet"/>
        <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="kiri">
        <section class="logo">
            <img src="gambar/logo.png" alt="logo" height="70px" />
        </section>
        <div class="sidebar-heading" style="background: linear-gradient(to right, #2193b0, #6dd5ed);">
            <h5 class="font-weight-bold text-white text-uppercase teks">Data User</h5>
        </div>
        <section class="isi">
            <a class="nav-link" href="indexAdmin.php">
            <span>Data Pasien</span></a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexPakar.php">
            <span>Data Pakar</span></a>
        </section>
        <div class="sidebar-heading" style="background: linear-gradient(to right, #2193b0, #6dd5ed);">
            <h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Penyakit</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexPenyakit.php">
            <span>Data Penyakit</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexGejala.php">
            <span>Data Gejala</span>
            </a>
        </section>
        <div class="sidebar-heading" style="background: linear-gradient(to right, #2193b0, #6dd5ed);">
            <h5 class="font-weight-bold text-white text-uppercase teks">Solusi</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexSolusi.php">
            <span>Data Solusi</span>
            </a>
        </section>
        </section>
        <section class="isi">
        <a class="btn btn-primary" href="logout.php" onclick="return confirmLogout();" role="button">Log Out</a>
        </section>
    </div>

    <div class="kanan">
        <div class="d-sm-flex align-items-center justify-content-between ml-4 py-5">
            <h1 class="h3 mb-0 text-gray-800 " id="tess"></h1>
        </div>

        <div class="form-container">
            <div>
                <form method="POST">
                    <div class="form-group">
                        <h3>Form Tambah Penyakit</h3>
                    </div>
                    <div class="form-group">
                        <label for="penyakit">Nama Penyakit</label>
                        <input type="text" name="penyakit" id="penyakit" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="tambah_btn" id="tambah" class="btn btn-primary" value="Tambah">
                    </div>
                </form>
            </div>
        </div>



    </div>
</body>
</html>
