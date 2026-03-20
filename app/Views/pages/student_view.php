<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-head">
    <div class="page-head-left">
        <h1>Students</h1>
        <p><?= count($students ?? []) ?> enrolled students in the directory.</p>
    </div>
    <div class="page-head-actions">
        <button class="btn btn-secondary" onclick="toggleForm()">
            <i class="bi bi-funnel"></i> Filter
        </button>
        <button class="btn btn-primary" id="addBtn" onclick="toggleForm()">
            <i class="bi bi-plus"></i> Add Student
        </button>
    </div>
</div>

<!-- Inline Add / Edit Form (hidden by default unless editing) -->
<div class="card mb-16" id="studentForm" style="<?= isset($student) ? '' : 'display:none;' ?>">
    <div class="card-header">
        <span class="card-title">
            <i class="bi bi-person-plus" style="color:var(--accent);"></i>
            <?= isset($student) ? 'Edit Student' : 'Add New Student' ?>
        </span>
        <button class="btn btn-ghost btn-sm" onclick="toggleForm()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="card-body">
        <form action="<?= isset($student) ? '/student/update/'.$student['id'] : '/student/store' ?>" method="post">
            <?= csrf_field() ?>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:12px;align-items:flex-end;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Juan dela Cruz"
                           value="<?= isset($student) ? esc($student['name']) : '' ?>" required>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="student@school.edu"
                           value="<?= isset($student) ? esc($student['email']) : '' ?>" required>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Course</label>
                    <input type="text" name="course" class="form-input" placeholder="e.g. BSIT"
                           value="<?= isset($student) ? esc($student['course']) : '' ?>" required>
                </div>
                <div style="display:flex;gap:8px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> <?= isset($student) ? 'Update' : 'Save' ?>
                    </button>
                    <?php if (isset($student)): ?>
                    <a href="/students" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Student Table -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="bi bi-people" style="color:var(--accent);"></i> Student Directory</span>
        <div style="display:flex;align-items:center;gap:8px;">
            <div class="search-bar" style="min-width:220px;">
                <i class="bi bi-search" style="font-size:12px;flex-shrink:0;"></i>
                <input type="text" id="tableSearch" placeholder="Search students..." oninput="filterTable(this.value)">
            </div>
            <span class="badge badge-indigo" id="countBadge"><?= count($students ?? []) ?> records</span>
        </div>
    </div>

    <div class="data-table-wrap">
        <table class="data-table" id="studentTable">
            <thead>
                <tr>
                    <th style="width:48px;">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Enrolled</th>
                    <th style="width:100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): foreach ($students as $i => $s): ?>
                <tr>
                    <td style="color:var(--text-3);font-weight:600;font-size:12px;"><?= $i + 1 ?></td>
                    <td>
                        <a href="/student/show/<?= $s['id'] ?>"
                           style="font-weight:600;color:var(--text-1);transition:color .15s;"
                           onmouseover="this.style.color='var(--accent)'"
                           onmouseout="this.style.color='var(--text-1)'">
                            <?= esc($s['name']) ?>
                        </a>
                    </td>
                    <td style="color:var(--text-2);"><?= esc($s['email']) ?></td>
                    <td><span class="badge badge-indigo"><?= esc($s['course']) ?></span></td>
                    <td style="color:var(--text-3);font-size:12px;">
                        <?= isset($s['created_at']) ? date('M d, Y', strtotime($s['created_at'])) : '—' ?>
                    </td>
                    <td>
                        <div style="display:flex;gap:4px;">
                            <a href="/student/edit/<?= $s['id'] ?>" class="btn btn-secondary btn-xs">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="/student/delete/<?= $s['id'] ?>" method="post" class="d-inline"
                                  onsubmit="return confirm('Delete <?= esc($s['name']) ?>?')">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <p>No students found. Add your first student above.</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($students) && isset($pager)): ?>
    <div style="padding:12px 20px;border-top:1px solid var(--border);">
        <?= $pager->links() ?>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
function toggleForm() {
    const f = document.getElementById('studentForm');
    f.style.display = f.style.display === 'none' ? '' : 'none';
}

function filterTable(q) {
    const rows = document.querySelectorAll('#studentTable tbody tr');
    let visible = 0;
    rows.forEach(row => {
        const match = row.textContent.toLowerCase().includes(q.toLowerCase());
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('countBadge').textContent = visible + ' records';
}
</script>
<?= $this->endSection() ?>
