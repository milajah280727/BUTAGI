<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tamu per Event</h6>
        </div>
        <div class="card-body">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="eventTabs" role="tablist">
                <?php foreach ($events as $index => $event): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>" 
                                id="event-<?php echo $event->event_id; ?>-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#event-<?php echo $event->event_id; ?>" 
                                type="button" 
                                role="tab" 
                                aria-controls="event-<?php echo $event->event_id; ?>" 
                                aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                            Event <?php echo $event->event_id; ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-4" id="eventTabContent">
                <?php foreach ($events as $index => $event): ?>
                    <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>" 
                         id="event-<?php echo $event->event_id; ?>" 
                         role="tabpanel" 
                         aria-labelledby="event-<?php echo $event->event_id; ?>-tab">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NO.Hp</th>
                                    <th>Hubungan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($guests_by_event[$event->event_id])): ?>
                                    <?php $no = 1; foreach ($guests_by_event[$event->event_id] as $guest): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $guest->nama; ?></td>
                                            <td><?php echo $guest->no_hp; ?></td>
                                            <td><?php echo $guest->hubungan; ?></td>
                                            <td>
                                                <?php if ($guest->attended == 1): ?>
                                                    <span class="badge bg-success">Hadir</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Belum Hadir</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center">Tidak ada tamu untuk event ini.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS dan CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>