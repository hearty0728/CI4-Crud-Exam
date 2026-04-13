<?php
$role   = session('user')['role'] ?? 'guest';
$seg    = service('uri')->getSegment(1);
$subseg = service('uri')->getSegment(2);
$name   = session('user')['fullname'] ?? 'User';
$initial = strtoupper(substr($name, 0, 1));

function sideLink($href, $icon, $label, $active, $badge = null) {
    $cls = 'nav-link' . ($active ? ' active' : '');
    $b   = $badge ? "<span class=\"nav-badge\">{$badge}</span>" : '';
    return "<a href=\"{$href}\" class=\"{$cls}\"><i class=\"bi bi-{$icon}\"></i> {$label}{$b}</a>";
}
?>
<aside class="app-sidebar">
    <div class="sidebar-logo">
        <div class="logo-mark">HSE</div>
        <span class="logo-name">HSE Portal</span>
        <span class="logo-badge">v4</span>
    </div>

    <?php if ($role === 'admin'): ?>
    <div class="sidebar-section">
        <div class="sidebar-section-label">Main</div>
        <?= sideLink(base_url('dashboard'), 'grid-1x2-fill', 'Dashboard', $seg === 'dashboard') ?>
        <?= sideLink(base_url('students'),  'people-fill',   'Students',  $seg === 'students', '1,248') ?>
    </div>
    <div class="sidebar-section">
        <div class="sidebar-section-label">Administration</div>
        <?= sideLink(base_url('admin/users'), 'person-badge-fill', 'Users',  $seg === 'admin' && $subseg === 'users') ?>
        <?= sideLink(base_url('admin/roles'), 'shield-fill',       'Roles',  $seg === 'admin' && $subseg === 'roles') ?>
    </div>

    <?php elseif ($role === 'teacher' || $role === 'coordinator'): ?>
    <div class="sidebar-section">
        <div class="sidebar-section-label">Main</div>
        <?= sideLink(base_url('dashboard'), 'grid-1x2-fill', 'Dashboard',   $seg === 'dashboard') ?>
        <?= sideLink(base_url('students'),  'people-fill',   'My Students', $seg === 'students') ?>
    </div>

    <?php else: ?>
    <div class="sidebar-section">
        <div class="sidebar-section-label">My Space</div>
        <?= sideLink(base_url('student/dashboard'), 'house-fill',  'Home',     $seg === 'student') ?>
        <?= sideLink(base_url('profile'),            'person-fill', 'Profile',  $seg === 'profile' && !$subseg) ?>
        <?= sideLink(base_url('profile/edit'),       'gear-fill',   'Settings', $seg === 'profile' && $subseg === 'edit') ?>
    </div>
    <?php endif; ?>

    <div class="sidebar-footer">
        <div class="dropdown">
            <div class="sidebar-user" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="sidebar-avatar"><?= $initial ?></div>
                <div>
                    <div class="sidebar-user-name"><?= esc($name) ?></div>
                    <div class="sidebar-user-role"><?= esc($role) ?></div>
                </div>
                <i class="bi bi-chevron-up" style="margin-left:auto;font-size:11px;color:rgba(255,255,255,.3);"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end" style="margin-bottom:8px;">
                <li>
                    <div style="padding:8px 10px 10px;border-bottom:1px solid var(--border);margin-bottom:4px;">
                        <div style="font-size:13px;font-weight:600;color:var(--text-1);"><?= esc($name) ?></div>
                        <div style="font-size:11px;color:var(--text-3);text-transform:capitalize;"><?= esc($role) ?></div>
                    </div>
                </li>
                <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="bi bi-person"></i> Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Sign out</a></li>
            </ul>
        </div>
    </div>
</aside>
