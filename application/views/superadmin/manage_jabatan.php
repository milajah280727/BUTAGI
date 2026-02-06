<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Kelola Jabatan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Aksi:</div>
                            <a class="dropdown-item" href="<?php echo site_url('superadmin/add_jabatan'); ?>">Tambah Jabatan</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <!-- Tombol Tambah Jabatan -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="<?php echo site_url('superadmin/add_jabatan'); ?>" class="btn btn-primary">Tambah Jabatan</a>
                        </div>
                        
                    </div>

                    <!-- Tabel Jabatan -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($jabatan)): ?>
                                    <?php $index = 1; ?>
                                    <?php foreach ($jabatan as $j): ?>
                                        <tr>
                                            <td><?php echo $index++; ?></td>
                                            <td><?php echo htmlspecialchars($j->nama_jabatan); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('superadmin/view_jabatan_staff/' . $j->id); ?>" class="btn btn-info btn-sm">Lihat Staff</a>
                                                <a href="<?php echo site_url('superadmin/edit_jabatan/' . $j->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?php echo site_url('superadmin/delete_jabatan/' . $j->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jabatan <?php echo htmlspecialchars($j->nama_jabatan); ?>?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada jabatan yang ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        <?php if (isset($pagination)): ?>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->