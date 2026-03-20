<?php
$seg    = service('uri')->getSegment(1);
$subseg = service('uri')->getSegment(2);
$name   = session('user')['fullname'] ?? 'User';
$initial = strtoupper(substr($name, 0, 1));

$crumb = $seg ? ucwords(str_replace(['-','_'], ' ', $seg)) : 'Home';
if ($subseg) $crumb .= ' / ' . ucwords(str_replace(['-','_'], ' ', $subseg));
?>
<header class="app-header">
    <div class="header-breadcrumb">
        <span>HSE Portal</span>
        <span class="sep">/</span>
        <span class="current"><?= esc($crumb) ?></span>
    </div>

    <div class="header-search">
        <i class="bi bi-search" style="font-size:12px;flex-shrink:0;color:var(--text-3);"></i>
        <input type="text" placeholder="Search anything...">
        <span style="font-size:10px;color:var(--text-3);background:var(--border);padding:1px 5px;border-radius:3px;white-space:nowrap;">⌘K</span>
    </div>

    <div class="header-actions">
        <div class="hdr-btn">
            <i class="bi bi-bell"></i>
            <span class="notif-dot"></span>
        </div>

        <div class="dropdown">
            <div class="hdr-avatar" data-bs-toggle="dropdown" aria-expanded="false"><?= $initial ?></div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <div style="padding:8px 10px 10px;border-bottom:1px solid var(--border);margin-bottom:4px;">
                        <div style="font-size:13px;font-weight:600;color:var(--text-1);"><?= esc($name) ?></div>
                        <div style="font-size:11px;color:var(--text-3);text-transform:capitalize;"><?= esc(session('user')['role'] ?? '') ?></div>
                    </div>
                </li>
                <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="bi bi-person"></i> Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Sign out</a></li>
            </ul>
        </div>
    </div>
</header>
