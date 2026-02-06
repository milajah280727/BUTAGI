<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Event</h6>
        </div>
        <div class="card-body">
            <a href="<?= site_url('superadmin/create_event'); ?>" class="btn btn-primary mb-3">Tambah Event</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Event</th>
                        <th>Tanggal</th>
                        <th>Kode Event</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= $event->nama_event; ?></td>
                            <td><?= $event->tanggal; ?></td>
                            <td>localhost/butagi-mainn/event/form/<?= $event->kode_event; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>