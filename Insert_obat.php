<?php

include "koneksi.php";

//Mengambil data inputan
$Nama_barang = $_POST['Nama_barang'];
$jenis_obat=$_POST['jenis_obat'];
$Stok = $_POST['Stok'];
$Harga = $_POST['Harga'];
$tanggal_masuk = $_POST['tanggal_masuk'];

$proses = mysqli_query($koneksi, "INSERT INTO laporan_barang (Nama_barang,jenis_obat,Stok,Harga,tanggal_masuk) values ('$Nama_barang','$jenis_obat','$Stok','$Harga','$tanggal_masuk')")
    or die(mysqli_error($koneksi));

if ($proses) {
    echo "<script>alert('Data Berhasil Disimpan')
               window.location.href='Form_Insert_obat.php';
        </script>";
} else echo "<script>alert('Data tidak Disimpan')
                window.location.href='Form_Insert_obat.php';
        </script> ";
