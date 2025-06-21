<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <meta charset="UTF-8">
    <title>Haii, Selamat Datang <?php echo $this->session->userdata('nama_lengkap'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tambahan CSS/JS lainnya -->
</head>

    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 220px;
            background-color: #007bff;
            padding: 15px;
            color: white;
            height: 100vh;
        }
        .app-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
        .sidebar h1 {
            font-size: 18px;
            margin-top: 10px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
        }
        .sidebar a i {
            margin-right: 8px;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        .logout {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout:hover {
            background-color: #c82333;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-menu {
            position: relative;
            display: inline-block;
        }
        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #007bff;
            object-fit: cover;
        }
        .dropdown {
            display: none;
            position: absolute;
            top: 45px;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            z-index: 1000;
            min-width: 150px;
        }
        .profile-menu.active .dropdown {
            display: block;
        }
        .dropdown a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }
        .dropdown a:hover {
            background: #f0f0f0;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(25% - 20px);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 5px solid #007bff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        .card:nth-child(4n+1) { border-left-color: #007bff; }
        .card:nth-child(4n+2) { border-left-color: #28a745; }
        .card:nth-child(4n+3) { border-left-color: #ffc107; }
        .card:nth-child(4n+4) { border-left-color: #17a2b8; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }

        h2.pagu-anggaran {
            font-weight: bold;
            font-size: 22px;
        }
        h4.anggaran-disalurkan {
            color: green;
            font-weight: 600;
        }
        h4.anggaran-belum {
            color: red;
            font-weight: 600;
        }

        .card h3 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            margin: 4px 0;
            font-size: 14px;
        }

        .card p.jumlah-anggaran {
            font-weight: bold;
        }

        .card p.sisa-anggaran {
            color: orange;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .profile-pic {
                width: 60px;
                height: 60px;
            }
        }
        
    </style>
</head>
<body>

<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="app-header">
            <img src="<?= base_url('assets/img/logo.png'); ?>" class="logo" alt="Logo">
            <h1>SIKEUSEK</h1>
        </div>
        <!-- Menu Dashboard -->
    <a href="<?php echo site_url('dashboard/bendahara'); ?>"><i class="fas fa-home"></i> Dashboard</a>
        <a href="<?= site_url('usermanagement'); ?>"><i class="fas fa-users"></i> Manajemen Pengguna</a>
        <a href="<?= site_url('sumberanggaran'); ?>"><i class="fas fa-coins"></i> Sumber Anggaran</a>
        <a href="<?= site_url('anggaran'); ?>"><i class="fas fa-wallet"></i> Anggaran</a>
        <a href="<?= site_url('expenditure'); ?>"><i class="fas fa-money-bill-wave"></i> Pengeluaran</a>
        <a href="<?= site_url('report'); ?>"><i class="fas fa-chart-line"></i> Laporan</a>
        <a href="<?= site_url('laporanpenggunaan'); ?>"><i class="fas fa-file-alt"></i> Laporan Penggunaan</a>
        <a href="<?= site_url('auth/logout'); ?>" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <span><strong>Haii, Selamat Datang <?= $this->session->userdata('nama_lengkap'); ?> 👋</strong></span>

            <div class="profile-menu">
                <img src="<?= base_url('assets/img/profil/' . ($this->session->userdata('foto') ?: 'default.png')); ?>" class="profile-pic" alt="Foto Profil">
                <div class="dropdown">
                    <a href="<?= site_url('profil'); ?>"><i class="fas fa-user"></i> Ubah Profil</a>
                    <a href="<?= site_url('profil/password'); ?>"><i class="fas fa-lock"></i> Ganti Password</a>
                </div>
            </div>
        </div>

        <h2 class="pagu-anggaran">Pagu Anggaran: Rp <?= number_format($total_pagu, 0, ',', '.'); ?></h2>
        <h4 style="color: green;">
    <strong>Anggaran yang Disalurkan:</strong> 
    Rp 
    <?php
    $total_disalurkan = 0;
    foreach ($users as $user) {
        if (!in_array(strtolower($user->role), ['bendahara', 'superadmin'])) {
            $anggaran = $this->Anggaran_model->get_anggaran_by_user($user->id);
            $total_disalurkan += !empty($anggaran) ? $anggaran[0]->jumlah_anggaran : 0;
        }
    }
    echo number_format($total_disalurkan, 0, ',', '.');
    ?>
</h4>

<h4 style="color: red;">
    <strong>Sisa Anggaran yang Belum Disalurkan:</strong> 
    Rp <?= number_format($total_pagu - $total_disalurkan, 0, ',', '.'); ?>
</h4>


        <div class="card-container">
            <?php foreach ($users as $user): ?>
                <?php
                if (in_array(strtolower($user->role), ['bendahara', 'superadmin'])) continue;
                $anggaran = $this->Anggaran_model->get_anggaran_by_user($user->id);
                $total_anggaran = !empty($anggaran) ? $anggaran[0]->jumlah_anggaran : 0;

                $expenditures_user = $this->Expenditure_model->get_expenditures_by_user($user->id);
                $total_pengeluaran = 0;
                foreach ($expenditures_user as $ex) {
                    $total_pengeluaran += is_array($ex) ? $ex['jumlah_pengeluaran'] : $ex->jumlah_pengeluaran;
                }

                $sisa_anggaran = $total_anggaran - $total_pengeluaran;
                ?>
                <div class="card">
                    <h3><?= $user->nama_lengkap; ?></h3>
                    <p class="jumlah-anggaran">Jumlah Anggaran: Rp <?= number_format($total_anggaran, 0, ',', '.'); ?></p>
                    <p class="sisa-anggaran">Sisa Anggaran: Rp <?= number_format($sisa_anggaran, 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>Daftar Pengeluaran</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pengguna</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($expenditures)): ?>
                    <tr><td colspan="5">Tidak ada data pengeluaran.</td></tr>
                <?php else: ?>
                    <?php foreach ($expenditures as $ex): ?>
                        <?php $user = $this->User_model->get_user_by_id($ex->user_id); ?>
                        <tr>
                            <td><?= $ex->id; ?></td>
                            <td><?= $user ? $user->nama_lengkap : 'Tidak Diketahui'; ?></td>
                            <td><?= $ex->tanggal_pengeluaran; ?></td>
                            <td>Rp <?= number_format($ex->jumlah_pengeluaran, 0, ',', '.'); ?></td>
                            <td><?= $ex->keterangan; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Dropdown JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileMenu = document.querySelector('.profile-menu');
        const profilePic = profileMenu.querySelector('.profile-pic');

        profilePic.addEventListener('click', function (e) {
            e.stopPropagation();
            profileMenu.classList.toggle('active');
        });

        document.addEventListener('click', function () {
            profileMenu.classList.remove('active');
        });

        profileMenu.querySelector('.dropdown').addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
</script>

</body>
</html>
