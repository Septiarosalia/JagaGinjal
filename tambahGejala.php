<?php


include "function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
    }
} else {
    header("location:index.php");
}

$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");

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

<body >
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
    <div class="container-fluid">

    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between ml-4 py-5">
            <h3 class="h3 mb-0 text-gray-800 " id="tess"></h3>
        </div>


    <div class="form-container">
        <div>

        <form action="function.php?act=tambahGejala" id="tambah" method="POST" >
            <div class="form-group">
                <h3>Form Tambah Gejala</h3>
            </div>
            <div class="form-group">
                <label for="namaGejala">Gejala</label>
                <input type="text" class="form-control" id="namaGejala" name="namaGejala"  placeholder="Masukkan gejala">
            </div>
            <div class="form-group">
                <label for="id_penyakit" class="form-label">Nama Penyakit</label>
                <select name="id_penyakit" id="id_penyakit" class="form-control">
                    <option value="">Pilih Penyakit dari Gejala</option>
                    <?php while ($penyakit = mysqli_fetch_assoc($queryPenyakit)) { ?>
                        <option value="<?= $penyakit["id_penyakit"]; ?>"><?= $penyakit["penyakit"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" name="tambah_btn" id="tambah" class="btn btn-primary" value="Tambah">
        </form>

        </div>
    </div>


</div>
</div>

</body>

</html>