<?php
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

$koneksi = mysqli_connect($server, $username, $password, $database) or die(mysqli_error($koneksi));
//untuk mengetahui jumlah seluruh stok
$query_total_stok = mysqli_query($koneksi, "SELECT SUM(Stok) AS total_stok FROM laporan_barang");
$data_total_stok = mysqli_fetch_assoc($query_total_stok);
$total_stok = $data_total_stok['total_stok'];


//mengetahui jumlah jenis obat berdasarkan nama
$query_total_jenis_obat = mysqli_query($koneksi, "SELECT COUNT(DISTINCT Nama_barang) AS total_jenis_obat FROM laporan_barang");
$data_total_jenis_obat = mysqli_fetch_assoc($query_total_jenis_obat);
$total_jenis_obat = $data_total_jenis_obat['total_jenis_obat'];

//statistik
// Mengambil data stok barang per bulan
$query_statistik_stok = mysqli_query($koneksi, "SELECT MONTH(tanggal_masuk) AS bulan, SUM(Stok) AS total_stok FROM laporan_barang GROUP BY MONTH(tanggal_masuk)");

// Array untuk menyimpan statistik stok per bulan
$statistik_stok_per_bulan = array();

// Mengisi array dengan data statistik stok per bulan
while ($data_statistik_stok = mysqli_fetch_assoc($query_statistik_stok)) {
    $bulan = $data_statistik_stok['bulan'];
    $total_stok = $data_statistik_stok['total_stok'];

    // Menyimpan data statistik stok per bulan dalam array
    $statistik_stok_per_bulan[$bulan] = $total_stok;
}
//$query_statistik_stok = mysqli_query($koneksi, "SELECT Nama_barang, SUM(Stok) AS total_stok FROM laporan_barang WHERE Nama_barang = 'Nama_barang'");
//$data_statistik_stok = mysqli_fetch_assoc($query_statistik_stok);
//$nama_barang = $data_statistik_stok['Nama_barang'];
//$total_stok = $data_statistik_stok['total_stok'];

    // if($koneksi){
    //    echo "berhasil koneksi";
    //} else echo "gagal koneksi";
