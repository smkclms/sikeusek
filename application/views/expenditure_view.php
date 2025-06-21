<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Pengeluaran</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container-custom {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .form-section {
      flex: 1 1 300px;
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .table-section {
      flex: 2 1 600px;
    }

    .btn {
      border-radius: 6px;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .table th {
      background-color: #007bff;
      color: white;
    }

    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <h2><i class="fas fa-money-bill-wave"></i> Pengeluaran</h2>
    <div class="d-flex gap-2">
      <a href="<?= site_url(
        $this->session->userdata('role') == 'bendahara' ? 'dashboard/bendahara' : 'dashboard/view'
      ); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Dashboard</a>
      <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

  <p>Selamat datang, <strong><?= $this->session->userdata('nama_lengkap'); ?></strong>!</p>

  <div class="container-custom">
    <!-- Form Input -->
    <div class="form-section">
      <h5 class="mb-3">Tambah Pengeluaran</h5>
      <form action="<?= site_url('expenditure/add'); ?>" method="post">
        <?php if ($this->session->userdata('role') === 'bendahara'): ?>
          <div class="mb-3">
            <label for="user_id" class="form-label"><i class="fas fa-user"></i> Pengguna</label>
            <select name="user_id" id="user_id" class="form-select" required>
              <?php foreach ($users as $user): ?>
                <?php if (!in_array(strtolower($user->role), ['bendahara', 'superadmin'])): ?>
                  <option value="<?= $user->id; ?>"><?= $user->nama_lengkap; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
        <?php else: ?>
          <p><strong>Pengguna:</strong> <?= $this->session->userdata('nama'); ?></p>
          <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id'); ?>">
        <?php endif; ?>

        <div class="mb-3">
          <label for="tanggal_pengeluaran" class="form-label"><i class="fas fa-calendar-alt"></i> Tanggal</label>
          <input type="date" name="tanggal_pengeluaran" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="jumlah_pengeluaran" class="form-label"><i class="fas fa-money-bill"></i> Jumlah</label>
          <input type="number" name="jumlah_pengeluaran" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
          <label for="keterangan" class="form-label"><i class="fas fa-info-circle"></i> Keterangan</label>
          <input type="text" name="keterangan" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="kode_rekening_id" class="form-label"><i class="fas fa-file-invoice-dollar"></i> Kode Rekening</label>
          <select name="kode_rekening_id" class="form-select" required>
            <?php foreach ($kode_rekening as $kode): ?>
              <option value="<?= $kode->id; ?>"><?= $kode->kode . ' - ' . $kode->nama_rekening; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-plus"></i> Tambah</button>
      </form>
    </div>

    <!-- Tabel -->
    <div class="table-section">
      <h5 class="mb-3">Daftar Pengeluaran</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
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
              <tr><td colspan="5" class="text-center">Tidak ada data pengeluaran.</td></tr>
            <?php else: ?>
              <?php foreach ($expenditures as $expenditure): ?>
                <?php $user = $this->User_model->get_user_by_id($expenditure->user_id); ?>
                <tr>
                  <td><?= $expenditure->id; ?></td>
                  <td><?= $user ? $user->nama_lengkap : 'Tidak ditemukan'; ?></td>
                  <td><?= date('d-m-Y', strtotime($expenditure->tanggal_pengeluaran)); ?></td>
                  <td>Rp <?= number_format($expenditure->jumlah_pengeluaran, 0, ',', '.'); ?></td>
                  <td><?= $expenditure->keterangan; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
