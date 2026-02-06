<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Staff dengan Jabatan: <?php echo $jabatan->nama_jabatan; ?></h2>
        <a href="<?php echo site_url('superadmin/manage_jabatan'); ?>" class="btn btn-secondary mb-3">Kembali</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Ruangan</th>
                    <th>Kelas (Wali Kelas)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($staff)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada staff dengan jabatan ini.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($staff as $s): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $s->name; ?></td>
                            <td><?php echo $s->room_name ?: 'Tidak ada'; ?></td>
                            <td><?php echo $s->kelas_id ? $this->db->get_where('kelas', ['id' => $s->kelas_id])->row()->nama_kelas : 'Tidak ada'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
