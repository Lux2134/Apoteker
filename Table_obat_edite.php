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
include "edit_data.php";
if (isset($proses_ambil)) {
    $data_edit = mysqli_fetch_assoc($proses_ambil);
}
?>

<html>
<header>
    <title>
    Update Stock
    </title>
    <link href="Library/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="Library/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="Library/assets/styles1.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="Library/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
    <script src="Library/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</header>

<body>
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="logo.png" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Apotek</span> </a>
                <div class="nav_list">
                    <a href="dashboard.php" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                    <a href="Table_obat_edite.php" class="nav_link active"> <i class='bx bx-table nav_icon'></i> <span class="nav_name">Tabel Obat</span> </a>
                    <a href="Form_Insert_obat.php" class="nav_link "> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Form Input Obat</span> </a>
                    <a href="kasir.php" class="nav_link "> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Kasir</span> </a>
                    <a href="laporan.php" class="nav_link "> <i class='bx bx-detail nav_icon'></i> <span class="nav_name">Laporan</span> </a>
                </div>
            </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
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
                                <form action="edit_data.php?Nama_barang=<?php echo $data_edit['Nama_barang'] ?>&&proses=1" method="POST">
                                <?php
                            } else {
                                ?>
                                    <form action="Table_obat_edite.php" method="POST">
                                    <?php

                                }
                                    ?>

                                    <fieldset>
                                        <legend>edit Barang</legend>
                                        <form action="Insert_obat.php" method="POST">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="hidden" class="input-xlarge focused" id="Nama_barang" name="Nama_barang" value="<?php if (isset($data_edit['Nama_barang']) != "") echo $data_edit['Nama_barang']; ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="Stok">Jenis obat : </label>
                                                <div class="controls">
                                                    <select id="jenis_obat" name="jenis_obat">
                                                        <option value="Obat cair">Obat cair</option>
                                                        <option value="Tablet">Tablet</option>
                                                        <option value="Kapsul">Kapsul</option>
                                                        <option value="Obat oles">Obat oles</option>
                                                        <option value="Supositoria">Supositoria</option>
                                                        <option value="Obat tetes">Obat tetes</option>
                                                        <option value="Inhaler">Inhaler</option>
                                                        <option value="Obat suntik">Obat suntik</option>
                                                        <option value="obat tempel">obat tempel</option>
                                                        <option value="sublingual">sublingual</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="Stok">Stok : </label>
                                                <div class="controls">
                                                    <input type="text" class="input-xlarge focused" id="Stok" name="Stok" value="<?php if (isset($data_edit['Stok']) != "") echo $data_edit['Stok']; ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="Harga">Harga : </label>
                                                <div class="controls">
                                                    <input type="text" class="input-xlarge focused" id="Harga" name="Harga" value="<?php if (isset($data_edit['Harga']) != "") echo $data_edit['Harga']; ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="tanggal_masuk">tanggal masuk barang : </label>
                                                <div class="controls">
                                                    <input type="date" class="input-xlarge focused" id="tanggal_masuk" name="tanggal_masuk" value="<?php if (isset($data_edit['tanggal_masuk']) != "") echo $data_edit['tanggal_masuk']; ?>">
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
                                        <th>jenis_obat</th>
                                        <th>Stock</th>
                                        <th>Harga</th>
                                        <th>tanggal masuk</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_assoc($proses)) {


                                    ?>
                                        <tr>
                                            <td><?php echo $data['Nama_barang'] ?></td>
                                            <td><?php echo $data['jenis_obat']?></td>
                                            <td><?php echo $data['Stok'] ?></td>
                                            <td><?php echo $data['Harga'] ?></td>
                                            <td><?php echo $data['tanggal_masuk'] ?></td>
                                            <td><a href="Table_obat_edite.php?Nama_barang=<?php echo $data['Nama_barang']; ?>">Edit </a>|
                                                <a href="hapus_data.php?Nama_barang=<?php echo $data['Nama_barang']; ?>"> Hapus</a>
                                            </td>
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

</html>