<?php
    include "koneksi.php";
    $Nama_barang = $_GET['Nama_barang'] ?? '';
    $apakah_proses = $_GET['proses'] ?? '';

    $proses_ambil = mysqli_query($koneksi,"SELECT * FROM laporan_barang WHERE Nama_barang = '$Nama_barang'")
                    or die(mysqli_error($koneksi));

    if($apakah_proses == 1){
        $Nama_barang = $_POST['Nama_barang'];
        $jenis_obat = $_POST['jenis_obat'];
        $Stok = $_POST['Stok'];
        $Harga = $_POST['Harga'];
        $tanggal_masuk = $_POST['tanggal_masuk'];

        $proses_update_data = mysqli_query($koneksi,"UPDATE laporan_barang SET Nama_barang 
                                = '$Nama_barang', jenis_obat = '$jenis_obat', Stok = '$Stok',Harga ='$Harga',tanggal_masuk ='$tanggal_masuk' WHERE Nama_barang = '".$Nama_barang."'")
                                or die(mysqli_error($koneksi));

                                if($proses_update_data){
                                    echo "<script>alert('Data Berhasil Diupdate')
                                            window.location.href='Table_obat_edite.php';
                                    </script>";
                                }else echo "<script>alert('Data gagal Diupdate')
                                            window.location.href='Table_obat_edite.php';
                                    </script> ";
    }   
    
?>