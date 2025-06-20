<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Sumber Anggaran</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1, h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        input[type="submit"],
        .btn-kembali {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        input[type="submit"]:hover,
        .btn-kembali:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .fa {
            margin-right: 6px;
        }

        .back-container {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><i class="fas fa-donate"></i> Manajemen Sumber Anggaran</h1>

    <form action="<?= site_url('sumberanggaran/add'); ?>" method="post">
        <label for="nama_sumber"><i class="fas fa-pencil-alt"></i> Nama Sumber:</label>
        <input type="text" name="nama_sumber" id="nama_sumber" required>

        <label for="jumlah"><i class="fas fa-money-bill-wave"></i> Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" step="0.01" required>

        <input type="submit" value="Tambah Sumber Anggaran">
    </form>

    <h2><i class="fas fa-list"></i> Daftar Sumber Anggaran</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Sumber</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sumber)): ?>
                <?php foreach ($sumber as $item): ?>
                <tr>
                    <td><?= $item->id; ?></td>
                    <td><?= $item->nama_sumber; ?></td>
                    <td>Rp <?= number_format($item->jumlah, 0, ',', '.'); ?></td>
                    <td><?= date('d-m-Y', strtotime($item->created_at)); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">Belum ada data sumber anggaran.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Tombol Kembali -->
    <div class="back-container">
        <a href="<?= site_url('dashboard/bendahara'); ?>" class="btn-kembali"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
