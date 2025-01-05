<div class="container mt-5 px-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                <img src="<?= base_url('path/gambar_tampilan/logo.png')?>" class="img-fluid mx-auto d-block" alt="Restaurant Logo">
                    <h2 class="text-center mt-3">Register</h2>
                    <p class="text-center">RESTAURANTKU</p>

                    <!-- Menampilkan pesan flashdata error jika ada -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form action menggunakan site_url('auth/register') -->
                    <form method="POST" action="<?= site_url('auth/register'); ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Enter Nomor Telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <!-- Link untuk menuju halaman login -->
                    <div class="mt-3 text-center">
                        <p>Sudah punya akun? <a href="<?= site_url('auth/login'); ?>">Login Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
