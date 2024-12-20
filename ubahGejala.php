<?php


include "function.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
    }
} else {
    header("location:index.php");
}

$id_gejala = $_GET["id_gejala"];

$queryPenyakit = mysqli_query($koneksi, "SELECT * FROM penyakit");

$query = mysqli_query($koneksi, "SELECT * FROM relasi INNER JOIN penyakit ON relasi.id_penyakit = penyakit.id_penyakit INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala WHERE relasi.id_gejala = '$id_gejala'");
$data = mysqli_fetch_assoc($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ubah Gejala</title>
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
                <h3 class="h3 mb-0 text-gray-800 " id="tess"></h3>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <form action="function.php?act=ubahGejala&id_gejala=<?= $data['id_gejala']; ?>" id="ubah" method="POST">
                    <div class="form-group">
                        <h3>Form Ubah Gejala</h3>
                    </div>
                    <div class="form-group">
                        <label for="namaGejala">Gejala</label>
                        <input type="text" class="form-control" id="namaGejala" name="namaGejala" 
                               value="<?= htmlspecialchars($data['gejala']); ?>" placeholder="Masukkan gejala">
                    </div>
                    <div class="form-group">
                        <label for="id_penyakit" class="form-label">Nama Penyakit</label>
                        <select name="id_penyakit" id="id_penyakit" class="form-control">
                            <option value="<?= $data['id_penyakit']; ?>" selected><?= htmlspecialchars($data['penyakit']); ?></option>
                            <?php while ($penyakit = mysqli_fetch_assoc($queryPenyakit)) { ?>
                                <option value="<?= $penyakit["id_penyakit"]; ?>"><?= htmlspecialchars($penyakit["penyakit"]); ?></option>
                            <?php } ?>
                        </select>
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
