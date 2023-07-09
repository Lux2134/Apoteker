<?php
    include "koneksi.php";
    $nama_barang = $_GET['Nama_barang'] ?? '';
    $apakah_proses = $_GET['proses'] ?? '';
    if(isset($_POST['Jumlah'])){
        $Jumlah = $_POST['Jumlah'];
    }
    if(isset($_POST['Harga'])){
        $harga = $_POST['Harga'];
    }
    if(isset($_POST['Jumlah'])){
        $total_harga = $Jumlah * $harga;
    }
    if(isset($_POST['Stok'])){
        $stok = $_POST['Stok'];
    }
    $nama_p = $_POST['nama'] ?? '';
    $no_telp = $_POST['nomor'] ?? '';
    if(isset($_POST['Stok'])){
        $kurang = $stok - $Jumlah;
    }

    $proses_ambil = mysqli_query($koneksi,"SELECT * FROM laporan_barang WHERE Nama_barang = '$nama_barang'")
                    or die(mysqli_error($koneksi));

    if($apakah_proses == 1){
        $proses_update_data = mysqli_query($koneksi,"INSERT INTO laporan_penjualan (Nama_barang, stok_dijual, total_Harga) VALUES ('".$nama_barang."','".$Jumlah."','".$total_harga."')")
                                or die(mysqli_error($koneksi));
                            
        $proses2 = mysqli_query($koneksi,"INSERT INTO data_pelanggan (Nama_P, Nomor_HP) VALUES ('".$nama_p."','".$no_telp."')")
                                or die (mysqli_error ($koneksi));
        
        $proses_update_data = mysqli_query($koneksi,"UPDATE laporan_barang SET Stok = '$kurang' WHERE Nama_barang = '".$nama_barang."'")
                            or die(mysqli_error($koneksi));                        
        
                        
                                                        if($proses_update_data && $proses2){
                                                            echo "<script>alert('Data Berhasil Diupdate')
                                                                    window.location.href='kasir.php';
                                                            </script>";
                                                        }else echo "<script>alert('Data gagal Diupdate')
                                                                    window.location.href='kasir.php';
                                                            </script> ";
    } ?>
