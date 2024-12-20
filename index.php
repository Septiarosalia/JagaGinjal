<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Mulai sesi jika belum dimulai
}

// Periksa apakah pengguna sudah login
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Redirect sesuai role
    if ($_SESSION['role'] === 1) {
        header("Location: dashboard.php"); // Role 1 diarahkan ke dashboard
        exit;
    } elseif ($_SESSION['role'] === 0) {
        header("Location: indexAdmin.php"); // Role 0 diarahkan ke indexAdmin
        exit;
    } elseif ($_SESSION['role'] === 2) {
        header("Location: indexPakar.php"); // Role 2 diarahkan ke indexPakar
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cek Ginjal Yuk!</title>

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />

    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(180deg, #f8f9fa, #ffffff);
        color: #333;
      }
      .navbar {
        background: #ffffff;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      }
      .welcome-section {
        background: linear-gradient(135deg, #6dd5ed, #2193b0);
        color: #fff;
        padding: 30px 0;
        text-align: center;
        border-radius: 0 0 30px 30px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
      }
      .welcome-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
      }
      .btn-primary {
        background-color: #2193b0;
        border-color: #6dd5ed;
        transition: 0.3s;
      }
      .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004080;
      }
      .heroBWA img {
        animation: fadeInUp 1.5s ease-in-out;
      }
      .card {
        transition: transform 0.3s, box-shadow 0.3s;
      }
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
      }
      footer {
        background: #333;
        color: #fff;
      }
      footer a {
        text-decoration: none;
        color: #fff;
        transition: color 0.3s;
      }
      footer a:hover {
        color: #007bff;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="gambar/logo.png" width="147" alt="logo" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#alur">Alur Kerja</a>
            </li>
            <!-- Login Button -->
            <li>
              <button
                type="button"
                class="btn btn-secondary ml-3"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                Log In
              </button>
            </li>
            <li>
              <a class="btn btn-primary ml-3" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Welcome Section -->
    <section id="welcome" class="welcome-section">
      <div class="container">
        <h1>Selamat Datang di <span class="text-warning">Cek Ginjal Yuk!</span></h1>
        <p class="lead">Solusi cepat dan tepat untuk memeriksa kesehatan ginjal Anda.</p>
      </div>
    </section>

    <!-- Hero Section -->
    <section class="heroBWA mt-5">
      <div class="container">
        <div class="row">
          <div class="col align-self-center">
            <h1 class="mb-4">Cek Ginjal Yuk!</h1>
            <p class="mb-4">
              Sistem informasi berbasis web untuk memeriksa kondisi ginjal Anda
              menggunakan teknologi sistem pakar. Jawab beberapa pertanyaan dan
              dapatkan hasil diagnosis serta solusinya.
            </p>
            <a class="btn btn-primary" href="register.php">Ayo Mulai!</a>
          </div>
          <div class="col d-none d-sm-block">
            <img width="500" src="gambar/hero.png" alt="hero" />
          </div>
        </div>
      </div>
    </section>

    <!-- Alur Kerja -->
    <section id="alur" class="mt-5">
      <div class="container text-center">
        <h2 style="font-weight: bold">Alur Kerja Sistem Pakar</h2>
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="card p-3">
              <i class="fas fa-sign-in-alt fa-3x text-primary my-3"></i>
              <h5>Login</h5>
              <p>Pengguna harus login sebelum memulai test.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3">
              <i class="fas fa-question-circle fa-3x text-success my-3"></i>
              <h5>Test Gejala</h5>
              <p>Jawab pertanyaan mengenai gejala yang Anda alami.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3">
              <i class="fas fa-poll fa-3x text-warning my-3"></i>
              <h5>Hasil & Solusi</h5>
              <p>Hasil diagnosis akan ditampilkan beserta solusinya.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Log In</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="login-form" action="function.php?act=login" method="POST">
              <div class="form-group">
                <label for="nama">Username:</label>
                <input type="text" class="form-control" id="nama" name="nama" required />
                <label for="password" class="mt-3">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required />
              </div>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="py-4">
      <div class="container text-center">
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
  </body>
</html>
