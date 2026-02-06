<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Kelola Kategori Jabatan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Aksi:</div>
                            <a class="dropdown-item" href="<?php echo site_url('superadmin/add_jabatan_kategori'); ?>">Tambah Kategori</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <!-- Tombol Tambah Kategori -->
                    <a href="<?php echo site_url('superadmin/add_jabatan_kategori'); ?>" class="btn btn-primary mb-3">Tambah Kategori</a>

                    <!-- Search Form -->
                    <form method="get" action="<?php echo site_url('superadmin/manage_jabatan_kategori'); ?>" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari kategori jabatan..." value="<?php echo $this->input->get('search'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Kategori Jabatan -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($jabatan_kategori)): ?>
                                    <?php $index = 1; ?>
                                    <?php foreach ($jabatan_kategori as $kategori): ?>
                                        <tr>
                                            <td><?php echo $index++; ?></td>
                                            <td><?php echo htmlspecialchars($kategori->nama_kategori); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('superadmin/edit_jabatan_kategori/' . $kategori->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?php echo site_url('superadmin/delete_jabatan_kategori/' . $kategori->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori <?php echo htmlspecialchars($kategori->nama_kategori); ?>?');">Hapus</a>
                                                <a href="<?php echo site_url('superadmin/manage_jabatan_kategori_relasi/' . $kategori->id); ?>" class="btn btn-info btn-sm">Kelola Jabatan</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada kategori jabatan yang ditemukan.</td>
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