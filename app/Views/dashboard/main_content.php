<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Selamat Datang, <?= esc(session()->get('name')) ?>!</h3>
                    </div>
                    <div class="card-body">
                        <p>Anda telah berhasil login ke dashboard BNN News.</p>
                        <p>Gunakan menu di sebelah kiri untuk menavigasi fitur yang tersedia untuk peran Anda.</p>
                        
                        <?php 
                            $role_id = session()->get('role_id');
                            $role_name = '';
                            if ($role_id == 1) $role_name = 'Admin';
                            if ($role_id == 2) $role_name = 'Editor';
                            if ($role_id == 3) $role_name = 'Wartawan';
                        ?>
                        <p>Anda saat ini login sebagai: <strong><?= esc($role_name) ?></strong></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
