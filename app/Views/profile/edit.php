<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Profile</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Your Profile</h3>
            </div>
            <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control <?= session('errors.fullname') ? 'is-invalid' : '' ?>" 
                                       id="fullname" 
                                       name="fullname" 
                                       value="<?= old('fullname', esc($user['fullname'])) ?>" 
                                       required>
                                <?php if (session('errors.fullname')): ?>
                                    <div class="invalid-feedback"><?= session('errors.fullname') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" 
                                       id="username" 
                                       name="username" 
                                       value="<?= old('username', esc($user['username'])) ?>" 
                                       required>
                                <?php if (session('errors.username')): ?>
                                    <div class="invalid-feedback"><?= session('errors.username') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student ID</label>
                                <input type="text" 
                                       class="form-control <?= session('errors.student_id') ? 'is-invalid' : '' ?>" 
                                       id="student_id" 
                                       name="student_id" 
                                       value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>" 
                                       placeholder="e.g. 2021-00123">
                                <?php if (session('errors.student_id')): ?>
                                    <div class="invalid-feedback"><?= session('errors.student_id') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="course" class="form-label">Course</label>
                                <input type="text" 
                                       class="form-control <?= session('errors.course') ? 'is-invalid' : '' ?>" 
                                       id="course" 
                                       name="course" 
                                       value="<?= old('course', esc($user['course'] ?? '')) ?>" 
                                       placeholder="e.g. BSIT, BSCS">
                                <?php if (session('errors.course')): ?>
                                    <div class="invalid-feedback"><?= session('errors.course') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="year_level" class="form-label">Year Level</label>
                                <select class="form-control <?= session('errors.year_level') ? 'is-invalid' : '' ?>" 
                                        id="year_level" 
                                        name="year_level">
                                    <option value="">Select Year Level</option>
                                    <option value="1" <?= old('year_level', $user['year_level'] ?? '') == '1' ? 'selected' : '' ?>>1st Year</option>
                                    <option value="2" <?= old('year_level', $user['year_level'] ?? '') == '2' ? 'selected' : '' ?>>2nd Year</option>
                                    <option value="3" <?= old('year_level', $user['year_level'] ?? '') == '3' ? 'selected' : '' ?>>3rd Year</option>
                                    <option value="4" <?= old('year_level', $user['year_level'] ?? '') == '4' ? 'selected' : '' ?>>4th Year</option>
                                    <option value="5" <?= old('year_level', $user['year_level'] ?? '') == '5' ? 'selected' : '' ?>>5th Year</option>
                                </select>
                                <?php if (session('errors.year_level')): ?>
                                    <div class="invalid-feedback"><?= session('errors.year_level') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="section" class="form-label">Section</label>
                                <input type="text" 
                                       class="form-control <?= session('errors.section') ? 'is-invalid' : '' ?>" 
                                       id="section" 
                                       name="section" 
                                       value="<?= old('section', esc($user['section'] ?? '')) ?>" 
                                       placeholder="e.g. IT3A">
                                <?php if (session('errors.section')): ?>
                                    <div class="invalid-feedback"><?= session('errors.section') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" 
                                       class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" 
                                       id="phone" 
                                       name="phone" 
                                       value="<?= old('phone', esc($user['phone'] ?? '')) ?>" 
                                       placeholder="e.g. 09XX-XXX-XXXX">
                                <?php if (session('errors.phone')): ?>
                                    <div class="invalid-feedback"><?= session('errors.phone') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control <?= session('errors.address') ? 'is-invalid' : '' ?>" 
                                          id="address" 
                                          name="address" 
                                          rows="3" 
                                          placeholder="Enter your home address"><?= old('address', esc($user['address'] ?? '')) ?></textarea>
                                <?php if (session('errors.address')): ?>
                                    <div class="invalid-feedback"><?= session('errors.address') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">Profile Image</label>
                                <input type="file" 
                                       class="form-control <?= session('errors.profile_image') ? 'is-invalid' : '' ?>" 
                                       id="profile_image" 
                                       name="profile_image" 
                                       accept="image/*">
                                <small class="text-muted">Max size: 2MB. Allowed: JPG, PNG, WEBP</small>
                                <?php if (session('errors.profile_image')): ?>
                                    <div class="invalid-feedback"><?= session('errors.profile_image') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Current/Preview Image</label>
                                <div class="text-center">
                                    <?php if (!empty($user['profile_image'])): ?>
                                        <img id="imagePreview" 
                                             src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" 
                                             alt="Profile Preview" 
                                             class="img-thumbnail" 
                                             style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                    <?php else: ?>
                                        <img id="imagePreview" 
                                             src="<?= base_url('assets/images/avatar4.png') ?>" 
                                             alt="Profile Preview" 
                                             class="img-thumbnail" 
                                             style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Profile
                    </button>
                    <a href="<?= base_url('profile') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
document.getElementById('profile_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?= $this->endSection() ?>
