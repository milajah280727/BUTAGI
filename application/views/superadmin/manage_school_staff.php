<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Kelola Staff Sekolah</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Aksi:</div>
                            <a class="dropdown-item" href="<?php echo site_url('superadmin/add_school_staff'); ?>">Tambah Staff</a>
                            <a class="dropdown-item" href="<?php echo site_url('superadmin/manage_jabatan'); ?>">Kelola Jabatan</a>
                            <a class="dropdown-item" href="<?php echo site_url('superadmin/manage_jabatan_kategori'); ?>">Kelola Kategori Jabatan</a>
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

                    <!-- Tombol Tambah Staff -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="<?php echo site_url('superadmin/add_school_staff'); ?>" class="btn btn-primary">Tambah Staff</a>
                        </div>
                    </div>

                    <!-- Tabel Staff -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Ruangan</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($staff)): ?>
                                    <?php $index = 1; ?>
                                    <?php foreach ($staff as $s): ?>
                                        <tr>
                                            <td><?php echo $index++; ?></td>
                                            <td><?php echo htmlspecialchars($s->name ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($s->nama_jabatan ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($s->room_name ?? 'Belum ditugaskan'); ?></td>
                                            <td><?php echo htmlspecialchars($s->nama_kelas ?? 'Belum ditugaskan'); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('superadmin/edit_school_staff/' . $s->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?php echo site_url('superadmin/delete_school_staff/' . $s->id . '?redirect=' . urlencode(current_url())); ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete('staff', '<?php echo $s->id; ?>', '<?php echo urlencode(current_url()); ?>')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada staff ditemukan.</td>
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

<script>
    function confirmDelete(type, id, redirect) {
        Swal.fire({
            title: 'Yakin menghapus ' + type + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo site_url('superadmin/delete_school_staff/'); ?>' + id + '?redirect=' + redirect;
            }
        });
        return false;
    }

    function searchStaff() {
        var search = document.getElementById('searchInput').value;
        window.location.href = '<?php echo site_url('superadmin/manage_school_staff'); ?>?search=' + encodeURIComponent(search);
    }

    $('#searchInput').on('keypress', function(e) {
        if (e.which == 13) {
            searchStaff();
        }
    });

    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().destroy();
        }
        $('#dataTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "destroy": true
        });
    });
</script>

<?php

?>