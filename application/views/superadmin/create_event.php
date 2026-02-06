<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buat Event Baru</h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?= site_url('superadmin/create_event'); ?>">
                <div class="form-group">
                    <label>Nama Event</label>
                    <input type="text" name="nama_event" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Event</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Buat Event</button>
            </form>
            <?php if ($this->session->flashdata('link')): ?>
                <div class="alert alert-success mt-3">
                    Link untuk dibagikan: <a href="<?= $this->session->flashdata('link'); ?>" target="_blank"><?= $this->session->flashdata('link'); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>