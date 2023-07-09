<?php
session_start();

$DOCKER_PROCESS = getenv("DOCKER_PROCESS");

if ($DOCKER_PROCESS == "true") {
   $server = getenv("DB_HOST");
   $username = getenv("DB_USERNAME");
   $password = getenv("DB_PASSWORD");
   $database = getenv("DB_SCHEME");
} else {
   // deklarasi parameter koneksi database
   $server   = "localhost";
   $username = "root";
   $password = "";
   $database = "db_apotek";
}

$conn = mysqli_connect($server, $username, $password, $database) or die(mysqli_error($conn));



// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Cek ke database
$proses_ambil = mysqli_query($conn, "SELECT * FROM login WHERE Username = '$username' AND Password = '$password'") or die(mysqli_error($conn));


if ($proses_ambil->num_rows == 1) {
    // Set variabel sesi untuk menandai bahwa pengguna telah login
    $_SESSION['logged_in'] = true;

    // Redirect pengguna ke halaman dashboard
    header("Location: dashboard.php");
    exit;

    // Login berhasil
    // echo
    //"<script> 
    //alert('login berhasil');
    //window.location.href='Dashboard.php'
    //</script>";
} else {
    // Login gagal
    echo "<script> 
    alert('login gagal');
    window.location.href='login.php'
    </script>";
}



