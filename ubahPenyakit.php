<?php


include "function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
    }
} else {
    header("location:index.php");
}

$id_penyakit = $_GET["id_penyakit"];

$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit WHERE id_penyakit = '$id_penyakit'");
$penyakit = mysqli_fetch_assoc($queryPenyakit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ubah Penyakit</title>
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
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }

        .form-container h3 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .form-container .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 4px;
        }

        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<div class="kiri" >
        <section class="logo">
            <img src="gambar/logo.png" alt="logo" height="70px" />
        </section>
        <div class="sidebar-heading" style="background: linear-gradient(to right, #2193b0, #6dd5ed);">
            <h5 class="font-weight-bold text-white text-uppercase teks">Data User</h5>
        </div>
        <section class="isi1">
            <a class="nav-link" href="indexAdmin.php">
            <span>Data Pasien</span></a>
        </section>
        <section class="isi1">
            <a class="nav-link" href="indexPakar.php">
            <span>Data Pakar</span></a>
        </section>
        <div class="sidebar-heading" style="background: linear-gradient(to right, #2193b0, #6dd5ed);">
            <h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Penyakit</h5> 
        </div>
        <section class="isi1">
            <a class="nav-link" href="indexPenyakit.php">
            <span>Data Penyakit</span>
            </a>
        </section>
        <section class="isi1">
            <a class="nav-link" href="indexGejala.php">
            <span>Data Gejala</span>
            </a>
        </section>
        <div class="sidebar-heading" style="background: linear-gradient(to right, #2193b0, #6dd5ed);">
            <h5 class="font-weight-bold text-white text-uppercase teks">Solusi</h5> 
        </div>
        <section class="isi1">
            <a class="nav-link" href="indexSolusi.php">
            <span>Data Solusi</span>
            </a>
        </section>
        </section>
        <section class="isi1">
            <a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');">
                 <span>Logout</span>
                </a>
            </section>

        
    </div>


    <div class="kanan">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between ml-4 py-5">
                <h1 class="h3 mb-0 text-gray-800 " id="tess"></h1>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <form action="function.php?act=ubahPenyakit&id_penyakit=<?= htmlspecialchars($penyakit['id_penyakit']); ?>" method="POST">
                    <div class="form-group">
                        <h3>Form Ubah Penyakit</h3>
                    </div>
                    <div class="form-group">
                        <label for="namaPenyakit">Nama Penyakit</label>
                        <input type="text" class="form-control" id="namaPenyakit" name="namaPenyakit" 
                               value="<?= htmlspecialchars($penyakit['penyakit']); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="ubah_btn" id="ubah" class="btn btn-primary" value="Ubah">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


