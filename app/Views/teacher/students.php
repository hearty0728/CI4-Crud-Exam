<?= $this->extend('layouts/main') ?>
<?= $this->section('breadcrumb') ?>
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-bold"><i class="bi bi-people me-2 text-success"></i>Student Management</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Students</li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="fw-bold mb-0"><i class="bi bi-people me-2 text-success"></i>Student Management</h3>
    <span class="badge bg-success px-3 py-2">
        <i class="bi bi-person-badge me-1"></i>Teacher / Admin View
    </span>
</div>

<div class="clean-card">
    <div class="clean-card-header">
        <h6 class="mb-0 text-white">
            <i class="bi bi-table me-2"></i>All Enrolled Students
            <span class="badge badge-green ms-2"><?= count($students) ?></span>
        </h6>
        <input type="text" id="searchInput" class="clean-input w-auto"
               placeholder="🔍 Search student..." style="min-width:200px; padding: 0.4rem 1rem;">
    </div>
    <div class="p-0">
        <div class="table-responsive">
            <table class="table mb-0" id="studentTable">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Course</th>
                        <th>Year & Section</th>
                        <th>Email</th>
                        <th class="text-center pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No students found.
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($students as $i => $s): ?>
                    <tr>
                        <td class="ps-4 text-muted small"><?= $i + 1 ?></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <?php if (!empty($s['profile_image'])): ?>
                                    <img src="<?= base_url('uploads/profiles/' . esc($s['profile_image'])) ?>"
                                         class="rounded-circle border" style="width:36px;height:36px;object-fit:cover;" alt="">
                                <?php else: ?>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:36px;height:36px;flex-shrink:0;background:rgba(139, 92, 246, 0.2);border: 1px solid rgba(139, 92, 246, 0.4);color:#a78bfa;">
                                        <i class="bi bi-person-fill small"></i>
                                    </div>
                                <?php endif; ?>
                                <span class="fw-semibold text-white"><?= esc($s['name']) ?></span>
                            </div>
                        </td>
                        <td class="text-muted small"><?= esc($s['student_id'] ?? '—') ?></td>
                        <td>
                            <?php if ($s['course']): ?>
                            <span class="badge badge-purple">
                                <?= esc($s['course']) ?>
                            </span>
                            <?php else: ?>
                            <span class="text-muted small">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="small text-muted">
                            <?= $s['year_level'] ? 'Year ' . $s['year_level'] : '' ?>
                            <?= $s['section'] ? ' — ' . esc($s['section']) : '' ?>
                            <?= (!$s['year_level'] && !$s['section']) ? '—' : '' ?>
                        </td>
                        <td class="text-muted small"><?= esc($s['email']) ?></td>
                        <td class="text-center pe-4">
                            <a href="<?= base_url('/students/show/' . $s['id']) ?>"
                               class="btn-secondary-custom" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#studentTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
<?= $this->endSection() ?>
