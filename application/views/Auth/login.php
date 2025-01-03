<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <img src="https://via.placeholder.com/200x100/ff0000/ffffff/?text=Restaurant+Logo" class="img-fluid mx-auto d-block" alt="Restaurant Logo">
                    <h2 class="text-center mt-3">Login</h2>
                    <p class="text-center">RESTAURANTKU</p>

                    <!-- Menampilkan pesan flashdata error jika ada -->
                    <?php if ($this->session->flashdata('error_login')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error_login'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form action menggunakan site_url('auth/login') -->
                    <form method="POST" action="<?= site_url('auth/login'); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="email" placeholder="Enter Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Log In</button>
                    </form>

                    <!-- Link untuk menuju halaman register jika belum punya akun -->
                    <div class="mt-3 text-center">
                        <p>Belum punya akun? <a href="<?= site_url('auth/register'); ?>">Daftar Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
