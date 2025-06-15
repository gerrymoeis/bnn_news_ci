<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5">

                        <h3 class="mb-5 text-center">Daftar Akun Baru</h3>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('errors')) : ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= url_to('AuthController::attemptRegister') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" value="<?= old('name') ?>" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?= old('email') ?>" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="role_id">Daftar sebagai</label>
                                <select name="role_id" id="role_id" class="form-control form-control-lg" required>
                                    <option value="" disabled selected>-- Pilih Peran --</option>
                                    <option value="3" <?= old('role_id') == '3' ? 'selected' : '' ?>>Wartawan</option>
                                    <option value="2" <?= old('role_id') == '2' ? 'selected' : '' ?>>Editor</option>
                                </select>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="pass_confirm">Konfirmasi Kata Sandi</label>
                                <input type="password" id="pass_confirm" name="pass_confirm" class="form-control form-control-lg" required />
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Daftar</button>
                            </div>

                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <p>Sudah punya akun? <a href="<?= url_to('AuthController::login') ?>">Masuk di sini</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
