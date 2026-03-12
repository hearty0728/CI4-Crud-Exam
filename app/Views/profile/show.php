<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h3 class="mb-0">My Profile</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img class="profile-user-img img-fluid img-circle" 
                             src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>?v=<?= time() ?>" 
                             alt="User profile picture"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <img class="profile-user-img img-fluid img-circle" 
                             src="<?= base_url('assets/images/avatar4.png') ?>" 
                             alt="User profile picture"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    <?php endif; ?>
                </div>

                <h3 class="profile-username text-center mt-3"><?= esc($user['fullname']) ?></h3>

                <p class="text-muted text-center"><?= esc($user['course'] ?? 'No Course') ?></p>

                <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary btn-block mt-3">
                    <i class="bi bi-pencil"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile Information</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Full Name</dt>
                    <dd class="col-sm-8"><?= esc($user['fullname']) ?></dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8"><?= esc($user['username']) ?></dd>

                    <dt class="col-sm-4">Student ID</dt>
                    <dd class="col-sm-8"><?= esc($user['student_id'] ?? 'Not set') ?></dd>

                    <dt class="col-sm-4">Course</dt>
                    <dd class="col-sm-8"><?= esc($user['course'] ?? 'Not set') ?></dd>

                    <dt class="col-sm-4">Year Level</dt>
                    <dd class="col-sm-8"><?= esc($user['year_level'] ?? 'Not set') ?></dd>

                    <dt class="col-sm-4">Section</dt>
                    <dd class="col-sm-8"><?= esc($user['section'] ?? 'Not set') ?></dd>

                    <dt class="col-sm-4">Phone</dt>
                    <dd class="col-sm-8"><?= esc($user['phone'] ?? 'Not set') ?></dd>

                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8"><?= esc($user['address'] ?? 'Not set') ?></dd>

                    <dt class="col-sm-4">Account Created</dt>
                    <dd class="col-sm-8"><?= date('F d, Y', strtotime($user['created_at'])) ?></dd>

                    <dt class="col-sm-4">Last Updated</dt>
                    <dd class="col-sm-8"><?= !empty($user['updated_at']) ? date('F d, Y', strtotime($user['updated_at'])) : 'Never' ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
