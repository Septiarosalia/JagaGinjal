<?php
session_start();
session_unset(); // Hapus semua data session
session_destroy(); // Hapus sesi
header("Location: index.php"); // Redirect ke halaman home
exit();
?>
