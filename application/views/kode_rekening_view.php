<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kode Rekening</title>
</head>
<body>
    <h1>Manajemen Kode Rekening</h1>
    <form action="<?php echo site_url('koderekening/add'); ?>" method="post">
        <label for="kode">Kode Rekening:</label>
        <input type="text" name="kode" required><br>

        <label for="nama_rekening">Nama Rekening:</label>
        <input type="text" name="nama_rekening" required><br>

        <input type="submit" value="Tambah Kode Rekening">
    </form>

    <h2>Daftar Kode Rekening</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama Rekening</th>
        </tr>
        <?php foreach ($kode_rekening as $kode): ?>
        <tr>
            <td><?php echo $kode->id; ?></td>
            <td><?php echo $kode->kode; ?></td>
            <td><?php echo $kode->nama_rekening; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
