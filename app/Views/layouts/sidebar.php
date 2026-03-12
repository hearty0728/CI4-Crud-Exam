<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="<?= base_url() ?>" class="brand-link">
            <img src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">CodeIgniter4</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-header">COMMON PAGES</li>
                <li class="nav-item <?= ($segment == 'dashboard' || $segment == 'dashboard-v2' || $segment == 'dashboard-v3') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= ($segment == 'dashboard' || $segment == 'dashboard-v2' || $segment == 'dashboard-v3') ? 'active' : '' ?>">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard<i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($segment == 'dashboard' && !str_contains(current_url(), 'v2') && !str_contains(current_url(), 'v3')) ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard-v2') ?>" class="nav-link <?= ($segment == 'dashboard-v2') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard-v3') ?>" class="nav-link <?= ($segment == 'dashboard-v3') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php foreach ($MenuCategory as $mCategory) : ?>
                    <?php if ($mCategory['menu_category'] != 'Common Page') : ?>
                        <li class="nav-header"><?= $mCategory['menu_category'] ?></li>
                    <?php endif; ?>
                    <?php
                    $Menu = getMenu($mCategory['menuCategoryID'], $user['role']);
                    foreach ($Menu as $menu) :
                        if ($menu['title'] == 'Dashboard') continue;
                        if ($menu['parent'] == 0) :
                    ?>
                            <li class="nav-item">
                                <a href="<?= base_url($menu['url']) ?>" class="nav-link <?= ($segment == $menu['url']) ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-<?= $menu['icon'] ?>"></i>
                                    <p><?= $menu['title'] ?></p>
                                </a>
                            </li>
                        <?php
                        else :
                            $SubMenu = getSubMenu($menu['menu_id'], $user['role']);
                        ?>
                            <li class="nav-item <?= ($segment == $menu['url']) ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= ($segment == $menu['url']) ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-<?= $menu['icon'] ?>"></i>
                                    <p><?= $menu['title'] ?><i class="nav-arrow bi bi-chevron-right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php foreach ($SubMenu as $subMenu) : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url($menu['url'] . '/' . $subMenu['url']) ?>" class="nav-link <?= ($subsegment == $subMenu['url']) ? 'active' : '' ?>">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p><?= $subMenu['title'] ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php
                        endif;
                    endforeach;
                    ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</aside>