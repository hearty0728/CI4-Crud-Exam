<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-head">
    <div class="page-head-left">
        <h1>Student Profile</h1>
        <p>Viewing record for <strong><?= esc($student['name'] ?? '') ?></strong></p>
    </div>
    <div class="page-head-actions">
        <a href="/students" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <a href="/student/edit/<?= $student['id'] ?>" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <form action="/student/delete/<?= $student['id'] ?>" method="post" class="d-inline"
              onsubmit="return confirm('Permanently delete this student?')">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
    </div>
</div>

<div style="display:grid;grid-template-columns:260px 1fr;gap:16px;align-items:start;">

    <!-- Left: Identity Card -->
    <div class="card">
        <div style="padding:28px 20px;text-align:center;border-bottom:1px solid var(--border);">
            <div style="width:72px;height:72px;border-radius:50%;background:var(--accent);color:#fff;font-size:26px;font-weight:700;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;border:3px solid #fff;box-shadow:0 0 0 2px var(--border);">
                <?= strtoupper(substr($student['name'] ?? 'S', 0, 1)) ?>
            </div>
            <div style="font-size:16px;font-weight:700;color:var(--text-1);letter-spacing:-0.2px;margin-bottom:4px;">
                <?= esc($student['name']) ?>
            </div>
            <div style="font-size:12px;color:var(--text-3);margin-bottom:12px;">
                <?= esc($student['email']) ?>
            </div>
            <span class="badge badge-indigo"><i class="bi bi-book"></i> <?= esc($student['course']) ?></span>
        </div>
        <div style="padding:16px 20px;">
            <div class="section-label">Quick Info</div>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <div style="display:flex;justify-content:space-between;font-size:12px;">
                    <span style="color:var(--text-3);">Student ID</span>
                    <span style="font-weight:600;color:var(--text-1);">#<?= $student['id'] ?></span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:12px;">
                    <span style="color:var(--text-3);">Enrolled</span>
                    <span style="font-weight:600;color:var(--text-1);">
                        <?= isset($student['created_at']) ? date('M Y', strtotime($student['created_at'])) : '—' ?>
                    </span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:12px;">
                    <span style="color:var(--text-3);">Last Updated</span>
                    <span style="font-weight:600;color:var(--text-1);">
                        <?= isset($student['updated_at']) ? date('M d, Y', strtotime($student['updated_at'])) : '—' ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Full Details -->
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="bi bi-card-list" style="color:var(--accent);"></i> Student Information</span>
        </div>
        <div class="card-body">
            <?php foreach ([
                ['bi-hash',         'Record ID',    '#' . $student['id']],
                ['bi-person',       'Full Name',    $student['name']],
                ['bi-envelope',     'Email',        $student['email']],
                ['bi-book',         'Course',       $student['course']],
                ['bi-calendar-plus','Date Enrolled', isset($student['created_at']) ? date('F d, Y', strtotime($student['created_at'])) : 'N/A'],
                ['bi-calendar-check','Last Updated', isset($student['updated_at']) ? date('F d, Y', strtotime($student['updated_at'])) : 'N/A'],
            ] as [$icon, $label, $value]): ?>
            <div class="detail-row">
                <div class="detail-key">
                    <i class="bi <?= $icon ?>" style="color:var(--accent);margin-right:6px;"></i><?= $label ?>
                </div>
                <div class="detail-val"><?= esc($value) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
