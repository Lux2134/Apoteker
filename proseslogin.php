<?php
$hostname = "localhost";
$userDataBase = "root";
$passwordUser = "";
$databseName = "apoteker";

$conn = mysqli_connect($hostname, $userDataBase, $passwordUser, $databseName) or die(mysqli_error($conn));

if ($conn) {
    echo "berhasil";
} else echo "gagal";

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Cek ke database
$proses_ambil = mysqli_query($conn, "SELECT * FROM login WHERE Username = '$username' AND Password = '$password'") or die(mysqli_error($conn));


if ($proses_ambil->num_rows == 1) {
    session_start();

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