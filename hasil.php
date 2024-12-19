<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
    }
} else {
    header("location:index.php");
}

if(isset($_POST['cek_ulang'])) {
    unset($_SESSION['persentase']);
    unset($_SESSION['id_gejala']);
    unset($_SESSION['ginjalAkut']);
    unset($_SESSION['ginjalKronis']); 
    unset($_SESSION['batuGinjal']);
    unset($_SESSION['infeksiGinjal']);
    unset($_SESSION['kankerGinjal']);
    unset($_SESSION['gagalGinjal']);
    
    header("Location: test.php");
    exit;
}
if (isset($_POST['simpan_diagnosa'])) {
    $id_user = $_SESSION['id_user'];
    $hasil_diagnosa = "Gagal Ginjal Akut = {$_SESSION['ginjalAkut']}%, 
                       Gagal Ginjal Kronis = {$_SESSION['ginjalKronis']}%, 
                       Batu Ginjal = {$_SESSION['batuGinjal']}%, 
                       Infeksi Ginjal = {$_SESSION['infeksiGinjal']}%, 
                       Kanker Ginjal = {$_SESSION['kankerGinjal']}%, 
                       Gagal Ginjal = {$_SESSION['gagalGinjal']}%";

    $solusi = "";
    $id_penyakit = maximum(
        $_SESSION['ginjalAkut'], 
        $_SESSION['ginjalKronis'], 
        $_SESSION['batuGinjal'], 
        $_SESSION['infeksiGinjal'], 
        $_SESSION['kankerGinjal'], 
        $_SESSION['gagalGinjal']
    );

    $query = "SELECT solusi FROM solusi WHERE id_penyakit = '$id_penyakit'";
    $result = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $solusi .= $row['solusi'] . "\n";
    }

    $query_insert = "INSERT INTO history_diagnosa (id_user, hasil_diagnosa, solusi) 
                     VALUES ('$id_user', '$hasil_diagnosa', '$solusi')";
    mysqli_query($koneksi, $query_insert);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Hasil diagnosa berhasil disimpan di riwayat!');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan hasil diagnosa!');</script>";
    }
}


$gejala = mysqli_query($koneksi, "SELECT * FROM gejala");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"/>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
    rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>Hasil Diagnosa Ginjal</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        footer {
        background-color: #2193b0;
        color: #fff;
        padding: 10px 0;
        text-align: center;
        margin-top: 50px;
      }
      footer a {
        color: #6dd5ed;
        text-decoration: none;
      }
        </style>
</head>
<body>
<!-- Header -->
<div class="header" style="background: linear-gradient(135deg, #6dd5ed, #2193b0); border-radius: 0 0 30px 30px; padding: 20px 0; color: #fff;">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="gambar/JAGAGINJAL.png" alt="Logo Jaga Ginjal" style="max-height: 50px;">
        </div>

        <h3 class="mb-0 font-weight-bold text-center" style="flex-grow: 1;">Hasil Diagnosa Anda</h3>

        <div class="d-flex">
            <a href="dashboard.php" class="btn btn-success mr-2" style="border-radius: 20px; padding: 8px 15px;">
                Dashboard
            </a>
            <a href="history.php" class="btn btn-primary mr-2" style="border-radius: 20px; padding: 8px 15px;">
                History Diagnosa
            </a>
            <form method="post" class="mr-2">
                <button type="submit" name="cek_ulang" class="btn btn-warning" style="border-radius: 20px; padding: 8px 15px;">
                    Periksa Ulang
                </button>
            </form>
            <a href="logout.php" class="btn btn-danger" style="border-radius: 20px; padding: 8px 15px;">
                <i class="fas fa-sign-out-alt mr-2"></i>Log Out
            </a>
        </div>
    </div>
</div>

    <section class="hasil mt-4">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h3 class="mb-4">Penyakit yang anda alami : </h3>
                    <?php if(isset($_SESSION)) { ?>
                    <h5 class="mb-4">
                        <div class="py-1">
                            <strong>
                            Gagal Ginjal Akut = <?= $_SESSION['ginjalAkut']; ?>%
                            </strong>
                        </div>
                        <div class="py-1">
                            <strong>
                            Gagal Ginjal Kronis = <?= $_SESSION['ginjalKronis']; ?>%
                            </strong>
                        </div>
                        <div class="py-1">
                            <strong>
                            Batu Ginjal = <?= $_SESSION['batuGinjal']; ?>%
                            </strong>
                        </div>
                        <div class="py-1">
                            <strong>
                            Infeksi Ginjal = <?= $_SESSION['infeksiGinjal']; ?>%
                            </strong>
                        </div>
                        <div class="py-1">
                            <strong>
                            Kanker Ginjal = <?= $_SESSION['kankerGinjal']; ?>%
                            </strong>
                        </div>
                        <div class="py-1">
                            <strong>
                            Gagal Ginjal = <?= $_SESSION['gagalGinjal']; ?>%
                            </strong>
                        </div>
                    </h5>
                    <?php } ?>

                    <h3 class="mb-4">Solusi untuk penyakit anda adalah : </h3>
                    <?php
                    
                    $id_penyakit = maximum(
                        $_SESSION['ginjalAkut'], 
                        $_SESSION['ginjalKronis'], 
                        $_SESSION['batuGinjal'], 
                        $_SESSION['infeksiGinjal'], 
                        $_SESSION['kankerGinjal'], 
                        $_SESSION['gagalGinjal']
                    );

                    $query = "SELECT * FROM solusi WHERE id_penyakit = '$id_penyakit'";
                    $data = mysqli_query($koneksi, $query);
                    while ($row = mysqli_fetch_array($data)) {
                        echo '<p>' . $row['solusi'] . '</p>';
                    }
                    ?>

                    <form action="diagnosa.php" method="POST">
                    <button type="submit" class="btn btn-success">Simpan Hasil Diagnosa</button>
                    </form>
                </div>
                <div class="col d-none d-sm-block">
                    <img width="500" src="gambar/hasil.png" alt="hero" />
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Jaga Ginjal - All Rights Reserved</p>
            <p>
                <a href="privacy.php">Privacy Policy</a> |
                <a href="terms.php">Terms of Service</a>
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html> 