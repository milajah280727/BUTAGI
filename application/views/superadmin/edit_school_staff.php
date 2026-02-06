<!DOCTYPE html>
<html>
<head>
    <title>Edit Staff Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Staff Sekolah</h2>
        <form method="post" action="<?php echo site_url('superadmin/edit_school_staff/' . $staff->id); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $staff->name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jabatan_id" class="form-label">Jabatan</label>
                <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <?php foreach ($jabatan as $j): ?>
                        <option value="<?php echo $j->id; ?>" <?php echo $j->id == $staff->jabatan_id ? 'selected' : ''; ?>><?php echo $j->nama_jabatan; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="room_id" class="form-label">Ruangan</label>
                <select class="form-control" id="room_id" name="room_id">
                    <option value="">-- Pilih Ruangan --</option>
                    <?php foreach ($rooms as $r): ?>
                        <option value="<?php echo $r->id; ?>" <?php echo $r->id == $staff->room_id ? 'selected' : ''; ?>><?php echo $r->room_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3" id="kelas-box" style="display:<?php echo $staff->jabatan_id == 3 ? 'block' : 'none'; ?>;">
                <label for="kelas_id" class="form-label">Kelas (Wali Kelas)</label>
                <select class="form-control" id="kelas_id" name="kelas_id" <?php echo $staff->jabatan_id == 3 ? 'required' : ''; ?>>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelas as $k): ?>
                        <option value="<?php echo $k->id; ?>" <?php echo $k->id == $staff->kelas_id ? 'selected' : ''; ?>><?php echo $k->nama_kelas; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo site_url('superadmin/manage_school_staff'); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#jabatan_id").change(function() {
                if ($(this).val() == 3) { // Wali Kelas
                    $("#kelas-box").show();
                    $("#kelas_id").prop('required', true);
                } else {
                    $("#kelas-box").hide();
                    $("#kelas_id").prop('required', false);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
