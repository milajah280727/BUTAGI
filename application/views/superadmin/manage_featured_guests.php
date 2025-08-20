<div class="container-fluid">
    <h1 class="mt-4">Manage Featured Guests</h1>
    <p>Pilih tamu yang akan ditampilkan di carousel Daftar Tamu pada landing page.</p>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Featured?</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($guests)): ?>
                <?php foreach ($guests as $guest): ?>
                    <tr>
                        <td><?= $guest->id; ?></td>
                        <td><?= $guest->name; ?></td>
                        <td><?= $guest->institution; ?></td>
                        <td><?= $guest->room_name; ?></td>
                        <td><?= date('d M Y', strtotime($guest->created_at)); ?></td>
                        <td><?= ucfirst($guest->status); ?></td>
                        <td><?= ($guest->is_featured == 1) ? 'Ya' : 'Tidak'; ?></td>
                        <td>
                            <form method="post" action="<?= base_url('superadmin/manage_featured_guests'); ?>">
                                <input type="hidden" name="action" value="toggle_featured">
                                <input type="hidden" name="id" value="<?= $guest->id; ?>">
                                <input type="hidden" name="current_featured" value="<?= $guest->is_featured; ?>">
                                <button type="submit" class="btn btn-sm <?= ($guest->is_featured == 1) ? 'btn-warning' : 'btn-success'; ?>">
                                    <?= ($guest->is_featured == 1) ? 'Unfeature' : 'Feature'; ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">Tidak ada tamu.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>