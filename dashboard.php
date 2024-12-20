<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Mulai sesi jika belum dimulai
}

// Jika pengguna belum login, redirect ke halaman login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        document.location.href = 'index.php';
        </script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Cek Ginjal Yuk!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: #f8f9fa;
      }

      /* Header */
      .header {
        background: linear-gradient(135deg, #6dd5ed, #2193b0);
        padding: 20px 0;
        color: #fff;
        text-align: center;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
      }
      .header img {
        max-height: 60px;
        margin-right: 10px;
      }

      /* Article Card */
      .card {
        border: none;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      }

      /* Sidebar */
      .sidebar {
        background: #fff;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-top: 60px; /* Tambahkan margin lebih besar */
      }

      /* Footer */
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
    <div class="header">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="gambar/logo.png" alt="Logo Cek Ginjal">
            </div>
            <div>
                <h5 class="d-inline-block mb-0 mr-3">
                    Welcome, 
                    <?php
                    // Tampilkan nama pengguna yang login
                    echo htmlspecialchars($_SESSION['nama']);
                    ?>
                </h5>
                <a href="logout.php" class="btn btn-danger" onclick="return confirmLogout();">Log Out</a>
                </div>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <h2 class="mb-4 text-primary">Artikel Kesehatan Ginjal</h2>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Mengenal Penyakit Ginjal Akut</h5>
                        <p class="card-text">
                            Penyakit ginjal akut terjadi ketika ginjal tidak dapat berfungsi dengan baik. Penyebab utama meliputi infeksi, cedera fisik, dan kondisi medis lainnya.
                        </p>
                        <a href="tampilanArtikel.php" class="btn btn-info">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gejala Penyakit Ginjal Kronis</h5>
                        <p class="card-text">
                            Penting mengenali gejala penyakit ginjal kronis, seperti pembengkakan kaki, sesak napas, dan perubahan pola buang air kecil.
                        </p>
                        <a href="tampilanArtikel.php" class="btn btn-info">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <h4>Aksi Cepat</h4>
                    <a href="register.php" class="btn btn-success btn-block">Periksa Ginjal Anda</a>
                </div>
                <div class="sidebar">
                    <h4>History</h4>
                    <a href="history.php" class="btn btn-warning btn-block">Lihat History Anda</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Cek Ginjal Yuk! - All Rights Reserved</p>
            <p>
                <a href="privacy.php">Privacy Policy</a> |
                <a href="terms.php">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
    function confirmLogout() {
        return confirm("Apakah Anda yakin ingin logout?");
    }
    </script>
</body>
</html>
