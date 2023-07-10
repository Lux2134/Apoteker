<?php
include "koneksi.php";
$Nama_barang = $_GET['Nama_barang'];

$proses = mysqli_query($koneksi, "DELETE FROM laporan_Penjualan WHERE Nama_barang = '$Nama_barang'")
    or die(mysqli_error($koneksi));

if ($proses) {
    echo "<script>alert('Data Berhasil Dihapus')
                        window.location.href='laporan.php';
                </script>";
} else echo "<script>alert('Data tidak Dihapus')
                        window.location.href='laporan.php';
                </script> ";
