<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Kelola Jabatan dalam Kategori</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="<?php echo site_url('superadmin/manage_jabatan_kategori'); ?>">Kembali ke Kelola Kategori</a>
                            <div class="dropdown-divider"></div>
                            
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

                    <!-- Tombol Tambah Admin -->
                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addJabatanModal">Tambah Jabatan</a>

                    <!-- Main Content -->
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
                                <?php if (!empty($jabatan_in_kategori)): ?>
                                    <?php $index = 1; ?>
                                    <?php foreach ($jabatan_in_kategori as $jabatan): ?>
                                        <tr>
                                            <td><?php echo $index++; ?></td>
                                            <td><?php echo htmlspecialchars($jabatan->nama_jabatan); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('superadmin/remove_jabatan_from_kategori/' . $kategori->id . '/' . $jabatan->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jabatan <?php echo htmlspecialchars($jabatan->nama_jabatan); ?> dari kategori ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada jabatan yang terkait dengan kategori ini.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Main Content -->

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

<!-- Modal untuk Tambah Jabatan -->
<div class="modal fade" id="addJabatanModal" tabindex="-1" role="dialog" aria-labelledby="addJabatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJabatanModalLabel">Tambah Jabatan ke Kategori: <?php echo htmlspecialchars($kategori->nama_kategori); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('superadmin/manage_jabatan_kategori_relasi/' . $kategori->id); ?>">
                    <?php if (!empty($jabatan_not_in_kategori)): ?>
                        <?php foreach ($jabatan_not_in_kategori as $jabatan): ?>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="jabatan_ids[]" value="<?php echo $jabatan->id; ?>" id="jabatan_<?php echo $jabatan->id; ?>">
                                <label class="form-check-label" for="jabatan_<?php echo $jabatan->id; ?>">
                                    <?php echo htmlspecialchars($jabatan->nama_jabatan); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Tidak ada jabatan yang tersedia untuk ditambahkan (semua jabatan sudah terkait dengan kategori lain).</p>
                    <?php endif; ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->