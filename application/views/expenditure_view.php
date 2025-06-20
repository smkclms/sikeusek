<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengeluaran</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f7f7f7;
    }

    .wrapper {
      max-width: 720px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .top-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      flex-wrap: wrap;
    }

    .top-nav h2 {
      color: #007bff;
      margin: 0 0 10px 0;
    }

    .top-nav a {
      text-decoration: none;
      background-color: #007bff;
      color: #fff;
      padding: 8px 15px;
      border-radius: 5px;
      margin-left: 10px;
    }

    .top-nav a.logout {
      background-color: #dc3545;
    }

    .top-nav a:hover {
      opacity: 0.9;
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    form input[type="text"],
    form input[type="date"],
    form input[type="number"],
    form select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    form input[type="submit"] {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    form input[type="submit"]:hover {
      background-color: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    @media (max-width: 600px) {
      .top-nav {
        flex-direction: column;
        align-items: flex-start;
      }

      .top-nav a {
        margin: 5px 0;
      }

      h2 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="wrapper">
    <div class="top-nav">
      <h2>Pengeluaran</h2>
      <div>
        <a href="<?php echo site_url(
          $this->session->userdata('role') == 'bendahara' ? 'dashboard/bendahara' : 'dashboard/view'
        ); ?>">← Dashboard</a>
        <a href="<?php echo site_url('auth/logout'); ?>" class="logout">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>

    <p>Selamat datang, <strong><?php echo $this->session->userdata('nama_lengkap'); ?></strong>!</p>

    <form action="<?php echo site_url('expenditure/add'); ?>" method="post">
      <?php if ($this->session->userdata('role') === 'bendahara'): ?>
        <label for="user_id">Pengguna:</label>
        <select name="user_id" id="user_id" required>
          <?php foreach ($users as $user): ?>
            <?php if (!in_array(strtolower($user->role), ['bendahara', 'superadmin'])): ?>
              <option value="<?= $user->id; ?>"><?= $user->nama_lengkap; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      <?php else: ?>
        <p><strong>Pengguna:</strong> <?= $this->session->userdata('nama'); ?></p>
        <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id'); ?>">
      <?php endif; ?>

      <label for="tanggal_pengeluaran">Tanggal Pengeluaran:</label>
      <input type="date" name="tanggal_pengeluaran" required>

      <label for="jumlah_pengeluaran">Jumlah Pengeluaran:</label>
      <input type="number" name="jumlah_pengeluaran" step="0.01" required>

      <label for="keterangan">Keterangan:</label>
      <input type="text" name="keterangan" required>

      <label for="kode_rekening_id">Kode Rekening:</label>
      <select name="kode_rekening_id" id="kode_rekening_id" required>
        <?php foreach ($kode_rekening as $kode): ?>
          <option value="<?php echo $kode->id; ?>">
            <?php echo $kode->kode . ' - ' . $kode->nama_rekening; ?>
          </option>
        <?php endforeach; ?>
      </select>

      <input type="submit" value="Tambah Pengeluaran">
    </form>

    <h3>Daftar Pengeluaran</h3>
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
          <?php foreach ($expenditures as $expenditure): ?>
            <?php $user = $this->User_model->get_user_by_id($expenditure->user_id); ?>
            <tr>
              <td><?php echo $expenditure->id; ?></td>
              <td><?php echo $user ? $user->nama_lengkap : 'Tidak ditemukan'; ?></td>
              <td><?php echo $expenditure->tanggal_pengeluaran; ?></td>
              <td>Rp <?php echo number_format($expenditure->jumlah_pengeluaran, 0, ',', '.'); ?></td>
              <td><?php echo $expenditure->keterangan; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
