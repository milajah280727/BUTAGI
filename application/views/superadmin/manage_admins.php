<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Atur Penanggung Jawab Ruangan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-group" method="POST" action="<?= site_url('superadmin/assign_admin_to_room'); ?>">
                        <label for="admin_id">Pilih Admin:</label>
                        <select class="form-control form-select" name="admin_id">
                            <?php foreach ($admins as $admin): ?>
                                <option value="<?= $admin->id; ?>"><?= $admin->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="room_id">Pilih Ruangan:</label>
                        <select class="form-control form-select" name="room_id">
                            <?php foreach ($rooms as $room): ?>
                                <option value="<?= $room->id; ?>"><?= $room->room_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-success mt-2" type="submit">Tugaskan Admin</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Kelola Admin Ruangan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="<?= site_url('superadmin/add_admin'); ?>" class="btn btn-primary mb-3">Tambah Admin</a>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari admin..." id="searchInput" value="<?= $this->input->get('search') ?: ''; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="searchAdmins()">Cari</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>Room</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admins as $index => $admin): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= $admin->name; ?></td>
                                        <td><?= $admin->username; ?></td>
                                        <td><?= $admin->room_name ?: 'Belum ditugaskan'; ?></td>
                                        <td>
                                            <a href="<?= site_url('superadmin/edit_admin/'.$admin->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= site_url('superadmin/delete_admin/'.$admin->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchAdmins() {
            var search = document.getElementById('searchInput').value;
            window.location.href = '<?= site_url('superadmin/manage_admins'); ?>?search=' + encodeURIComponent(search);
        }

        $('#searchInput').on('keypress', function(e) {
            if (e.which == 13) {
                searchAdmins();
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