<?php
session_start();

// Periksa apakah variabel sesi 'logged_in' ada dan bernilai true
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Pengguna belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit;
}

require 'koneksi.php';
include "Tampilkan_data.php";
include "proses_kasir.php";
if (isset($proses_ambil)) {
    $data_edit = mysqli_fetch_assoc($proses_ambil);
}
?>

<html>
<header>
    <title>
    Kasir
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="Library/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="Library/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="Library/assets/styles1.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
</header>

<body>
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="header_img">
            <img src="logo.png" alt="">
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Apotek</span>
                </a>
                <div class="nav_list">
                    <a href="dashboard.php" class="nav_link">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="Table_obat_edite.php" class="nav_link">
                        <i class='bx bx-table nav_icon'></i><span class="nav_name">Tabel Obat</span>
                    </a>
                    <a href="Form_Insert_obat.php" class="nav_link">
                        <i class='bx bx-add-to-queue nav_icon'></i>
                        <span class="nav_name">Form Input Obat</span>
                    </a>
                    <a href="kasir.php" class="nav_link active">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Kasir</span>
                    </a>
                </div>
            </div>
            <a href="logout.php" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>

    <div class="main-isi">
        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Obat</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">

                            <?php
                            if (isset($_GET['Nama_barang']) != '') {
                                //proses edit data
                            ?>
                                <form action="proses_kasir.php?Nama_barang=<?php echo $data_edit['Nama_barang'] ?>&&proses=1" method="POST">
                                <?php
                            } else {
                                ?>
                                    <form action="proses_kasir.php" method="POST">
                                    <?php

                                }
                                    ?>

                                    <fieldset>
                                        <legend>Kasir</legend>
                                        <form action="proses_kasir.php" method="POST">
                                            <div class="control-group">
                                                <label class="control-label" for="jumlah">Nama Barang : </label>
                                                <div class="controls">
                                                    <input type="text" class="input-xlarge focused" id="Nama_barang" name="Nama_barang" value="<?php if (isset($data_edit['Nama_barang']) != "") echo $data_edit['Nama_barang']; ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="jumlah">Jumlah : </label>
                                                <div class="controls">
                                                    <input type="number" class="input-xlarge focused" id="Jumlah" name="Jumlah" value="">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="Harga">Harga : </label>
                                                <div class="controls">
                                                    <input type="number" class="input-xlarge focused" id="Harga" name="Harga" value="<?php if (isset($data_edit['Harga']) != "") echo $data_edit['Harga']; ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="No.telepon">Nomor Telepon : </label>
                                                <div class="controls">
                                                    <input type="text" class="input-xlarge focused" id="nomor" name="nomor" value="">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="jumlah">Nama Pelanggan : </label>
                                                <div class="controls">
                                                    <input type="text" class="input-xlarge focused" id="nama" name="nama" value="">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="hidden" class="input-xlarge focused" id="Stok" name="Stok" value="<?php if (isset($data_edit['Stok']) != "") echo $data_edit['Stok']; ?>">
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Proses</button>
                                                <button type="reset" class="btn">Cancel</button>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Data Obat</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_assoc($proses)) {


                                    ?>
                                        <tr>
                                            <td><?php echo $data['Nama_barang'] ?></td>
                                            <td><?php echo $data['Harga'] ?></td> 
                                            <td><?php echo $data['Stok'] ?></td>
                                            <td><a href="kasir.php?Nama_barang=<?php echo $data['Nama_barang']; ?>">Pilih </a>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /block -->
            </div>






        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'content', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>

</body>