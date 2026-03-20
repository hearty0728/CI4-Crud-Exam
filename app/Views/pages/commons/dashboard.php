<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php $user = session('user'); ?>

<!-- Page Head -->
<div class="page-head">
    <div>
        <h1>Dashboard</h1>
        <p>Good <?= (date('H') < 12 ? 'morning' : (date('H') < 17 ? 'afternoon' : 'evening')) ?>, <?= esc(explode(' ', $user['fullname'] ?? 'User')[0]) ?>. Here's your overview.</p>
    </div>
    <div class="page-head-actions">
        <button class="btn btn-secondary"><i class="bi bi-sliders"></i> Filters</button>
        <button class="btn btn-primary"><i class="bi bi-plus"></i> Add Student</button>
    </div>
</div>

<!-- KPI Row -->
<div class="kpi-row">
    <?php foreach ([
        ['v', 'bi-people-fill',         'Total Students', '1,248', '+12%', true],
        ['e', 'bi-person-check-fill',   'Active Today',   '342',   '+5%',  true],
        ['a', 'bi-person-plus-fill',    'New This Month', '56',    '-2%',  false],
        ['s', 'bi-mortarboard-fill',    'Courses',        '18',    '+1',   true],
    ] as [$color, $icon, $label, $val, $delta, $up]): ?>
    <div class="kpi">
        <div class="kpi-top">
            <div class="kpi-icon <?= $color ?>"><i class="bi <?= $icon ?>"></i></div>
            <div class="kpi-trend <?= $up ? 'up' : 'down' ?>">
                <i class="bi bi-arrow-<?= $up ? 'up' : 'down' ?>-right"></i><?= $delta ?>
            </div>
        </div>
        <div class="kpi-val"><?= $val ?></div>
        <div class="kpi-lbl"><?= $label ?></div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Bento Grid -->
<div class="bento">

    <!-- Bar Chart — spans 2 cols -->
    <div class="card bento-wide">
        <div class="card-header">
            <span class="card-title">
                <i class="bi bi-bar-chart-fill" style="color:var(--violet);"></i>
                Monthly Enrollment
            </span>
            <div style="display:flex;gap:4px;">
                <button class="btn btn-ghost btn-sm" style="font-size:11px;">Weekly</button>
                <button class="btn btn-secondary btn-sm" style="font-size:11px;">Monthly</button>
                <button class="btn btn-ghost btn-sm" style="font-size:11px;">Yearly</button>
            </div>
        </div>
        <div class="card-body" style="padding:12px 18px 8px;">
            <div id="chart-bar"></div>
        </div>
    </div>

    <!-- Donut + Legend — right column, spans 2 rows -->
    <div class="card bento-tall" style="grid-column:3;grid-row:1/3;">
        <div class="card-header">
            <span class="card-title"><i class="bi bi-pie-chart-fill" style="color:var(--violet);"></i> User Breakdown</span>
        </div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:16px;">
            <div id="chart-donut"></div>

            <div style="display:flex;flex-direction:column;gap:2px;">
                <?php foreach ([
                    ['Students',     '#7c3aed', '72%', '900'],
                    ['Teachers',     '#059669', '15%', '187'],
                    ['Coordinators', '#b45309', '8%',  '100'],
                    ['Admins',       '#0284c7', '5%',  '61'],
                ] as [$l, $c, $pct, $n]): ?>
                <div style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--border);">
                    <span style="width:10px;height:10px;border-radius:3px;background:<?= $c ?>;flex-shrink:0;display:inline-block;"></span>
                    <span style="font-size:12px;color:var(--text-2);font-weight:500;flex:1;"><?= $l ?></span>
                    <span style="font-size:12px;font-weight:700;color:var(--text-1);"><?= $n ?></span>
                    <span style="font-size:11px;color:var(--text-3);width:30px;text-align:right;"><?= $pct ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Quick Actions -->
            <div>
                <div class="section-label">Quick Actions</div>
                <div style="display:flex;flex-direction:column;gap:6px;">
                    <a href="<?= base_url('students') ?>" class="btn btn-secondary btn-sm" style="justify-content:flex-start;">
                        <i class="bi bi-people"></i> View All Students
                    </a>
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary btn-sm" style="justify-content:flex-start;">
                        <i class="bi bi-person-badge"></i> Manage Users
                    </a>
                    <button class="btn btn-primary btn-sm" style="justify-content:flex-start;">
                        <i class="bi bi-file-earmark-bar-graph"></i> Generate Report
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="bi bi-clock-history" style="color:var(--violet);"></i> Recent Activity</span>
            <a href="#" style="font-size:11px;color:var(--violet);font-weight:600;">See all</a>
        </div>
        <div class="card-body" style="padding:8px 18px;">
            <?php foreach ([
                ['#7c3aed', '<strong>Maria Santos</strong> enrolled in BSIT — Section A', '2m ago'],
                ['#059669', '<strong>Teacher Cruz</strong> updated student records',       '15m ago'],
                ['#b45309', '<strong>New registration</strong> pending approval',          '1h ago'],
                ['#0284c7', '<strong>System</strong> backup completed',                    '3h ago'],
                ['#059669', '<strong>Juan dela Cruz</strong> profile updated',             '5h ago'],
            ] as [$dot, $text, $time]): ?>
            <div class="activity-item">
                <div class="activity-dot" style="background:<?= $dot ?>;"></div>
                <div style="flex:1;">
                    <div class="activity-text"><?= $text ?></div>
                    <div class="activity-time"><?= $time ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Top Courses Table -->
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="bi bi-list-ol" style="color:var(--violet);"></i> Top Courses</span>
            <span class="badge badge-gray">This semester</span>
        </div>
        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Students</th>
                        <th>Fill</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ([
                        ['BSIT', '312', 78, 'emerald', 'Active'],
                        ['BSCS', '278', 70, 'emerald', 'Active'],
                        ['BSBA', '201', 50, 'emerald', 'Active'],
                        ['BSED', '189', 47, 'amber',   'Review'],
                        ['BSHM', '145', 36, 'emerald', 'Active'],
                    ] as [$course, $count, $pct, $color, $status]): ?>
                    <tr>
                        <td style="font-weight:600;"><?= $course ?></td>
                        <td style="color:var(--text-2);"><?= $count ?></td>
                        <td style="min-width:80px;">
                            <div style="height:4px;background:var(--border);border-radius:99px;overflow:hidden;">
                                <div style="height:100%;width:<?= $pct ?>%;background:var(--violet);border-radius:99px;"></div>
                            </div>
                        </td>
                        <td><span class="badge badge-<?= $color ?>"><?= $status ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /bento -->

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
<script>
// Bar Chart
new ApexCharts(document.querySelector('#chart-bar'), {
    series: [
        { name: 'Enrolled', data: [820, 932, 901, 1034, 1090, 1130, 1248] },
        { name: 'Active',   data: [280, 310, 295, 320, 335, 342, 342] }
    ],
    chart: { height: 200, type: 'bar', toolbar: { show: false }, fontFamily: 'Inter, sans-serif', background: 'transparent' },
    colors: ['#7c3aed', '#e0d9fb'],
    plotOptions: { bar: { columnWidth: '55%', borderRadius: 4, borderRadiusApplication: 'end' } },
    dataLabels: { enabled: false },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: { show: false }, axisTicks: { show: false },
        labels: { style: { colors: '#94a3b8', fontSize: '11px' } }
    },
    yaxis: { labels: { style: { colors: '#94a3b8', fontSize: '11px' } } },
    grid: { borderColor: '#e2e8f0', strokeDashArray: 4, padding: { left: 0, right: 0, top: -10 } },
    legend: { position: 'top', horizontalAlign: 'right', fontSize: '12px', fontWeight: 500, markers: { radius: 3, width: 10, height: 10 } },
    tooltip: { style: { fontSize: '12px' } }
}).render();

// Donut Chart
new ApexCharts(document.querySelector('#chart-donut'), {
    series: [72, 15, 8, 5],
    chart: { height: 200, type: 'donut', fontFamily: 'Inter, sans-serif', background: 'transparent' },
    colors: ['#7c3aed', '#059669', '#b45309', '#0284c7'],
    labels: ['Students', 'Teachers', 'Coordinators', 'Admins'],
    dataLabels: { enabled: false },
    legend: { show: false },
    stroke: { show: true, colors: ['#ffffff'], width: 3 },
    plotOptions: {
        pie: { donut: { size: '68%', labels: { show: true,
            total: { show: true, showAlways: true, label: 'Total', fontSize: '11px', color: '#94a3b8', formatter: () => '1,248' },
            value: { show: true, fontSize: '22px', fontWeight: 700, color: '#0f172a' }
        }}}
    },
    tooltip: { style: { fontSize: '12px' } }
}).render();
</script>
<?= $this->endSection() ?>
