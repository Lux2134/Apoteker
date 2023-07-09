<?php
    include "koneksi.php";

    $proses = mysqli_query($koneksi,"SELECT * FROM laporan_barang") 
                or die (mysqli_error($koneksi));

?>