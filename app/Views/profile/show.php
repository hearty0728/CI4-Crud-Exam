<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$role    = session('user')['role'] ?? 'student';
$initial = strtoupper(substr($user['fullname'] ?? 'U', 0, 1));
?>

<!-- Page Head -->
<div class="page-head">
    <div>
        <h1>My Profile</h1>
        <p>View and manage your personal information.</p>
    </div>
    <div class="page-head-actions">
        <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary">
            <i class="bi bi-pencil-fill"></i> Edit Profile
        </a>
    </div>
</div>

<div style="display:grid; grid-template-columns: 280px 1fr; gap: 16px; align-items: start;">

    <!-- ── LEFT: Identity Card ── -->
    <div style="display:flex; flex-direction:column; gap:16px;">

        <!-- Avatar + Name -->
        <div style="background:#0f172a; border-radius:16px; overflow:hidden; border:1px solid rgba(255,255,255,.07);">
            <!-- Top accent bar -->
            <div style="height:4px; background:linear-gradient(90deg, #7c3aed, #a78bfa);"></div>

            <div style="padding:28px 20px 20px; display:flex; flex-direction:column; align-items:center; text-align:center;">
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                         alt="Profile"
                         style="width:88px; height:88px; border-radius:50%; object-fit:cover;
                                border:3px solid #7c3aed; box-shadow:0 0 0 4px rgba(124,58,237,.2);
                                margin-bottom:16px;">
                <?php else: ?>
                    <div style="width:88px; height:88px; border-radius:50%;
                                background:linear-gradient(135deg,#7c3aed,#a78bfa);
                                color:#fff; font-size:32px; font-weight:700;
                                display:flex; align-items:center; justify-content:center;
                                border:3px solid rgba(124,58,237,.4);
                                box-shadow:0 0 0 4px rgba(124,58,237,.15);
                                margin-bottom:16px;">
                        <?= $initial ?>
                    </div>
                <?php endif; ?>

                <div style="font-size:16px; font-weight:700; color:#f1f5f9; letter-spacing:-0.2px; margin-bottom:4px;">
                    <?= esc($user['fullname'] ?? 'User') ?>
                </div>
                <div style="font-size:12px; color:rgba(255,255,255,.4); margin-bottom:14px;">
                    <?= esc($user['username'] ?? '') ?>
                </div>

                <span style="display:inline-flex; align-items:center; gap:6px;
                             background:rgba(124,58,237,.2); color:#a78bfa;
                             border:1px solid rgba(124,58,237,.35);
                             font-size:11px; font-weight:700; text-transform:uppercase;
                             letter-spacing:0.06em; padding:4px 12px; border-radius:99px;">
                    <i class="bi bi-shield-fill" style="font-size:10px;"></i>
                    <?= esc($role) ?>
                </span>
            </div>

            <!-- Meta row -->
            <div style="border-top:1px solid rgba(255,255,255,.06); padding:14px 20px;
                        display:flex; flex-direction:column; gap:10px;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:11px; color:rgba(255,255,255,.35); font-weight:500;">Member since</span>
                    <span style="font-size:12px; color:rgba(255,255,255,.75); font-weight:600;">
                        <?= isset($user['created_at']) ? date('M Y', strtotime($user['created_at'])) : '—' ?>
                    </span>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:11px; color:rgba(255,255,255,.35); font-weight:500;">Status</span>
                    <span style="font-size:12px; font-weight:700; color:#34d399; display:flex; align-items:center; gap:5px;">
                        <span style="width:6px; height:6px; border-radius:50%; background:#34d399;
                                     box-shadow:0 0 6px #34d399; display:inline-block;"></span>
                        Active
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick nav links -->
        <div style="background:#0f172a; border-radius:16px; border:1px solid rgba(255,255,255,.07); padding:8px;">
            <div style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.07em;
                        color:rgba(255,255,255,.25); padding:8px 10px 6px;">Navigation</div>
            <a href="<?= base_url('profile') ?>"
               style="display:flex; align-items:center; gap:10px; padding:9px 10px; border-radius:8px;
                      background:rgba(124,58,237,.15); color:#a78bfa; font-size:13px; font-weight:600;
                      margin-bottom:2px;">
                <i class="bi bi-person-fill" style="font-size:14px;"></i> Profile
            </a>
            <a href="<?= base_url('profile/edit') ?>"
               style="display:flex; align-items:center; gap:10px; padding:9px 10px; border-radius:8px;
                      color:rgba(255,255,255,.5); font-size:13px; font-weight:500;
                      transition:all .15s;"
               onmouseover="this.style.background='rgba(255,255,255,.06)';this.style.color='rgba(255,255,255,.9)'"
               onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,.5)'">
                <i class="bi bi-gear-fill" style="font-size:14px;"></i> Edit Settings
            </a>
            <a href="<?= base_url('logout') ?>"
               style="display:flex; align-items:center; gap:10px; padding:9px 10px; border-radius:8px;
                      color:rgba(225,29,72,.7); font-size:13px; font-weight:500;
                      transition:all .15s;"
               onmouseover="this.style.background='rgba(225,29,72,.08)';this.style.color='#fb7185'"
               onmouseout="this.style.background='transparent';this.style.color='rgba(225,29,72,.7)'">
                <i class="bi bi-box-arrow-right" style="font-size:14px;"></i> Sign Out
            </a>
        </div>

    </div>

    <!-- ── RIGHT: Detail Panels ── -->
    <div style="display:flex; flex-direction:column; gap:16px;">

        <!-- Academic Info -->
        <div style="background:#0f172a; border-radius:16px; border:1px solid rgba(255,255,255,.07); overflow:hidden;">
            <div style="padding:14px 20px; border-bottom:1px solid rgba(255,255,255,.06);
                        display:flex; align-items:center; gap:10px;">
                <div style="width:30px; height:30px; border-radius:8px;
                             background:rgba(124,58,237,.2); color:#a78bfa;
                             display:flex; align-items:center; justify-content:center; font-size:14px;">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <span style="font-size:13px; font-weight:700; color:#f1f5f9;">Academic Information</span>
            </div>

            <div style="padding:4px 0;">
                <?php foreach ([
                    ['bi-person-badge-fill', 'Student ID',    $user['student_id'] ?? null],
                    ['bi-book-fill',          'Course',        $user['course']     ?? null],
                    ['bi-calendar3',          'Year Level',    $user['year_level'] ?? null],
                    ['bi-collection-fill',    'Section',       $user['section']    ?? null],
                ] as [$icon, $label, $value]): ?>
                <div style="display:flex; align-items:center; padding:12px 20px;
                            border-bottom:1px solid rgba(255,255,255,.04);">
                    <div style="display:flex; align-items:center; gap:8px; width:180px; flex-shrink:0;">
                        <i class="bi <?= $icon ?>" style="font-size:13px; color:rgba(124,58,237,.8);"></i>
                        <span style="font-size:12px; font-weight:600; color:rgba(255,255,255,.35);
                                     text-transform:uppercase; letter-spacing:0.04em;"><?= $label ?></span>
                    </div>
                    <?php if ($value): ?>
                        <span style="font-size:13px; font-weight:600; color:#f1f5f9;"><?= esc($value) ?></span>
                    <?php else: ?>
                        <span style="font-size:12px; color:rgba(255,255,255,.2); font-style:italic;">Not set</span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Contact Info -->
        <div style="background:#0f172a; border-radius:16px; border:1px solid rgba(255,255,255,.07); overflow:hidden;">
            <div style="padding:14px 20px; border-bottom:1px solid rgba(255,255,255,.06);
                        display:flex; align-items:center; gap:10px;">
                <div style="width:30px; height:30px; border-radius:8px;
                             background:rgba(124,58,237,.2); color:#a78bfa;
                             display:flex; align-items:center; justify-content:center; font-size:14px;">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <span style="font-size:13px; font-weight:700; color:#f1f5f9;">Contact Details</span>
            </div>

            <div style="padding:4px 0;">
                <?php foreach ([
                    ['bi-envelope-fill',  'Email',   $user['username'] ?? $user['email'] ?? null],
                    ['bi-telephone-fill', 'Phone',   $user['phone']    ?? null],
                    ['bi-geo-alt-fill',   'Address', $user['address']  ?? null],
                ] as [$icon, $label, $value]): ?>
                <div style="display:flex; align-items:flex-start; padding:12px 20px;
                            border-bottom:1px solid rgba(255,255,255,.04);">
                    <div style="display:flex; align-items:center; gap:8px; width:180px; flex-shrink:0; padding-top:1px;">
                        <i class="bi <?= $icon ?>" style="font-size:13px; color:rgba(124,58,237,.8);"></i>
                        <span style="font-size:12px; font-weight:600; color:rgba(255,255,255,.35);
                                     text-transform:uppercase; letter-spacing:0.04em;"><?= $label ?></span>
                    </div>
                    <?php if ($value): ?>
                        <span style="font-size:13px; font-weight:600; color:#f1f5f9; line-height:1.5;">
                            <?= nl2br(esc($value)) ?>
                        </span>
                    <?php else: ?>
                        <span style="font-size:12px; color:rgba(255,255,255,.2); font-style:italic;">Not set</span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
