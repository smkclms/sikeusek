<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Pengguna</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        h2, h4 {
            color: #333;
            margin-bottom: 15px;
        }

        .container {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .form-section {
            flex: 1 1 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 400px;
        }

        .table-section {
            flex: 2 1 600px;
            overflow-x: auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-secondary {
        background-color: #6c757d;
        color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <h2><i class="fas fa-users"></i> Pengelolaan Pengguna</h2>
    <div class="container">

        <!-- Form Tambah -->
        <div class="form-section">
            <h4>Tambah Pengguna Baru</h4>
            <form id="form-tambah-user">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Role:</label>
                    <select name="role" required>
                        <option value="bendahara">Bendahara</option>
                        <option value="operator">Operator</option>
                        <option value="pengguna">Pengguna</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap:</label>
                    <input type="text" name="nama_lengkap" required>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 10px;">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Pengguna
    </button>
    <button type="button" onclick="history.back()" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </button>
</div>

            </form>
        </div>

        <!-- Tabel Pengguna -->
        <div class="table-section">
            <h4>Daftar Pengguna</h4>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Nama Lengkap</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabel-user">
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td><?= $user->username; ?></td>
                        <td><?= ucfirst($user->role); ?></td>
                        <td><?= $user->nama_lengkap; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-user" data-id="<?= $user->id; ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm delete-user" data-id="<?= $user->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Script AJAX -->
    <script>
    $(document).ready(function(){
        $('#form-tambah-user').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '<?= site_url("usermanagement/add_ajax"); ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response){
                    $('#konten').load('<?= site_url("usermanagement"); ?>');
                }
            });
        });

        $('.delete-user').click(function(){
            const id = $(this).data('id');
            if(confirm('Yakin ingin menghapus pengguna ini?')) {
                $.post('<?= site_url("usermanagement/delete_ajax"); ?>', {id: id}, function(res){
                    $('#konten').load('<?= site_url("usermanagement"); ?>');
                });
            }
        });
    });
    </script>

</body>
</html>
