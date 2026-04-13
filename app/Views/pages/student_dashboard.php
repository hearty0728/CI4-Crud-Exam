<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-head">
    <div class="page-head-left">
        <h1>My Dashboard</h1>
        <p>Your academic profile and information at a glance.</p>
    </div>
    <div class="page-head-actions">
        <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit Profile
        </a>
    </div>
</div>

<!-- Profile Hero -->
<div class="card mb-16">
    <div class="profile-hero">
        <?php
        $profileImg = $user['profile_image'] ?? null;
        $initials   = strtoupper(substr($user['fullname'] ?? 'S', 0, 2));
        ?>
        <?php if ($profileImg): ?>
            <img src="<?= base_url('uploads/profiles/' . $profileImg) ?>"
                 style="width:64px;height:64px;border-radius:50%;object-fit:cover;border:3px solid #fff;box-shadow:0 0 0 2px #e2e0dd;"
                 alt="Profile">
        <?php else: ?>
            <div class="profile-avatar-lg"><?= $initials ?></div>
        <?php endif; ?>
        <div>
            <div class="profile-name"><?= esc($user['fullname'] ?? 'Student') ?></div>
            <div class="profile-meta">
                <?= esc($user['username'] ?? '') ?>
                <?php if (!empty($user['student_id'])): ?>
                    &nbsp;·&nbsp; ID: <?= esc($user['student_id']) ?>
                <?php endif; ?>
            </div>
        </div>
        <div style="margin-left:auto;">
            <span class="badge badge-indigo"><i class="bi bi-mortarboard-fill"></i> Student</span>
        </div>
    </div>
</div>

<!-- Academic Info Cards -->
<div class="stat-grid mb-16">
    <?php
    $cards = [
        ['indigo', 'bi-person-badge-fill', 'Student ID',  $user['student_id'] ?? '—'],
        ['green',  'bi-book-fill',          'Course',      $user['course']     ?? '—'],
        ['amber',  'bi-calendar3',          'Year Level',  $user['year_level'] ?? '—'],
        ['blue',   'bi-collection-fill',    'Section',     $user['section']    ?? '—'],
    ];
    foreach ($cards as [$color, $icon, $label, $value]):
    ?>
    <div class="stat-card <?= $color ?>">
        <div class="stat-icon <?= $color ?>"><i class="bi <?= $icon ?>"></i></div>
        <div class="stat-value" style="font-size:20px;"><?= esc($value) ?></div>
        <div class="stat-label"><?= $label ?></div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Contact Details -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="bi bi-person-lines-fill" style="color:var(--accent);"></i> Contact Information</span>
        <a href="<?= base_url('profile/edit') ?>" class="btn btn-ghost btn-sm">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>
    <div class="card-body">
        <?php foreach ([
            ['Email',   'bi-envelope',  $user['username'] ?? '—'],
            ['Phone',   'bi-telephone', $user['phone']    ?? '—'],
            ['Address', 'bi-geo-alt',   $user['address']  ?? '—'],
        ] as [$key, $icon, $val]): ?>
        <div class="detail-row">
            <div class="detail-key"><i class="bi <?= $icon ?>" style="margin-right:6px;color:var(--accent);"></i><?= $key ?></div>
            <div class="detail-val"><?= esc($val) ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
