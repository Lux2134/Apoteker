<?php
session_start();

// Periksa apakah variabel sesi 'logged_in' ada dan bernilai true
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Pengguna belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

?>
<html>
<header>
    <title>
    Halaman Utama
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
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="logo.png" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Apotek</span> </a>
                <div class="nav_list">
                    <a href="dashboard.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                    <a href="Table_obat_edite.php" class="nav_link"> <i class='bx bx-table nav_icon'></i><span class="nav_name">Tabel Obat</span> </a>
                    <a href="Form_Insert_obat.php" class="nav_link"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Form Input Obat</span> </a>
                    <a href="kasir.php" class="nav_link "> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Kasir</span> </a>
                </div>
            </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>

    <div class="main-isi">
        <div class="span9" id="content">
            <!-- morris stacked chart -->
            <h2>Selamat Datang</h2>
            <div class="row-fluid">
                <!-- block -->
                <div class="block1">
                    <div class="inline">
                        <div class="point-1">
                            <h3>Total Stok Obat</h3><br><br>
                            <h4><?= $total_stok ?> pcs</h4>
                        </div>
                        <div class="point-2">
                            <h3>Total Jenis Obat:</h3><br>
                            <h4><?= $total_jenis_obat ?></h4>
                        </div>
                        <div class="point-3">
                            <h5>Statistik Stok Barang per Bulan</h3>
                                <canvas id="statistikStokChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="point-4">
                    <div class="point-4" style="height: 200px; overflow-y: scroll;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>jenis obat</th>
                                    <th>Stock</th>
                                    <th>Harga</th>
                                    <th>tanggal masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query untuk mengambil data dari tabel laporan_barang
                                $query = mysqli_query($koneksi, "SELECT * FROM laporan_barang");

                                // Loop untuk menampilkan data ke dalam tabel
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Nama_barang'] . "</td>";
                                    echo "<td>" . $row['jenis_obat'] . "</td>";
                                    echo "<td>" . $row['Stok'] . "</td>";
                                    echo "<td>" . $row['Harga'] . "</td>";
                                    echo "<td>" . $row['tanggal_masuk'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mengambil data bulan dan total stok dari PHP
        var bulanLabels = <?= json_encode(array_keys($statistik_stok_per_bulan)) ?>;
        var totalStokData = <?= json_encode(array_values($statistik_stok_per_bulan)) ?>;
        // Membuat diagram batang menggunakan Chart.js
        var statistikStokChart = new Chart(document.getElementById('statistikStokChart'), {
            type: 'bar',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Total Stok',
                    data: totalStokData,
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Total Stok'
                        }
                    }
                }
            }
        });
    </script>

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