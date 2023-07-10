<?php
    include "koneksi.php";

    $proses = mysqli_query($koneksi,"SELECT * FROM laporan_penjualan") 
                or die (mysqli_error($koneksi));

?>