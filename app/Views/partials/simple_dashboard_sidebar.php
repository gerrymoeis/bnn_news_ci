<div class="sidebar p-3">
    <h4 class="text-white">BNN News</h4>
    <hr class="text-white-50">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?= site_url('dashboard') ?>" class="nav-link text-white <?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <?php $role_id = session()->get('role_id'); ?>

        <!-- Menu untuk Admin -->
        <?php if ($role_id == 1): ?>
            <li class="nav-item">
                <a href="<?= site_url('admin/users/pending') ?>" class="nav-link text-white <?= (strpos(uri_string(), 'admin/users') !== false) ? 'active' : '' ?>">
                    <i class="bi bi-people me-2"></i>
                    Manajemen User
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('admin/categories/manage') ?>" class="nav-link text-white <?= (strpos(uri_string(), 'admin/categories') !== false) ? 'active' : '' ?>">
                    <i class="bi bi-tags me-2"></i>
                    Manajemen Kategori
                </a>
            </li>
        <?php endif; ?>

        <!-- Menu untuk Editor -->
        <?php if ($role_id == 2): ?>
            <li class="nav-item">
                <a href="<?= site_url('editor/pending') ?>" class="nav-link text-white <?= (strpos(uri_string(), 'editor/pending') !== false) ? 'active' : '' ?>">
                    <i class="bi bi-journal-check me-2"></i>
                    Pending Approval
                </a>
            </li>
        <?php endif; ?>

        <!-- Menu untuk Wartawan -->
        <?php if ($role_id == 3): ?>
             <li class="nav-item">
                <a href="<?= site_url('posts') ?>" class="nav-link text-white <?= (strpos(uri_string(), 'posts') !== false) ? 'active' : '' ?>">
                    <i class="bi bi-pencil-square me-2"></i>
                    Kelola Postingan
                </a>
            </li>
        <?php endif; ?>

        <hr class="text-white-50">

        <li class="nav-item">
            <a href="<?= site_url('profile') ?>" class="nav-link text-white <?= (uri_string() == 'profile') ? 'active' : '' ?>">
                <i class="bi bi-person-circle me-2"></i>
                Profil Saya
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('logout') ?>" class="nav-link text-white">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </a>
        </li>
    </ul>
</div>
