<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Anggaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Manajemen Anggaran</h1>
        <a href="<?php echo site_url('dashboard/bendahara'); ?>" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Tambah Anggaran
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('anggaran/add'); ?>" method="post">
                <div class="mb-3">
                    <label for="user_id" class="form-label">Pengguna</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">Pilih Pengguna</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->nama_lengkap; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah_anggaran" class="form-label">Jumlah Anggaran</label>
                    <input type="number" name="jumlah_anggaran" step="0.01" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Tambah Anggaran</button>
            </form>
        </div>
    </div>

    <h2 class="h4 mb-3">Daftar Anggaran</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Pengguna</th>
                    <th>Jumlah Anggaran</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anggaran as $item): ?>
                <tr>
                    <td><?php echo $item->id; ?></td>
                    <td><?php echo $this->User_model->get_user_by_id($item->user_id)->nama_lengkap; ?></td>
                    <td>Rp <?php echo number_format($item->jumlah_anggaran, 2, ',', '.'); ?></td>
                    <td><?php echo $item->tahun; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
