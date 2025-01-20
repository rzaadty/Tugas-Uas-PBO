<style>
    /* Gambar latar belakang responsif pada div tertentu */
    .background-container {
        background-image: url('<?= base_url('path/gambar_tampilan/background.png');?>');
        background-size: cover; /* Pastikan gambar menutupi seluruh area */
        background-position: bottom; /* Menempatkan gambar di bagian bawah */
        background-repeat: no-repeat; /* Menghindari pengulangan gambar */
        height: 100vh; /* Setel tinggi container agar memenuhi layar penuh */
        width: 100%; /* Lebar penuh agar menyesuaikan dengan layar */
    }

    /* Responsif untuk perangkat mobile */
    @media (max-width: 768px) {
        .background-container {
            height: 100vh; /* Tetap 100% tinggi pada layar kecil */
        }
    }

    /* Responsif untuk desktop */
    @media (min-width: 769px) {
        .background-container {
            height: 100vh; /* Menjaga agar latar belakang tetap full screen pada desktop */
        }
    }
</style>
<div class="background-container">
    <div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
        <h4 class="text-uppercase text-dark">
            <i class="bi bi-person-plus" style="font-size: 30px;"></i>
            Tambah Akun
        </h4>
        <button onclick="window.location='<?= site_url('Dashboard_akun') ?>'" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>

    <div class="container px-3 py-3">
        <div class="card border border-dark border-3 shadow">
            <div class="card-header bg-secondary text-dark">
                <h3 class="text-dark"><i class="bi bi-person-plus"></i> Tambah Akun</h3>
            </div>
            <div class="card-body">
                <form action="<?= site_url('Dashboard_akun/create') ?>" method="POST">
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_telepon">No Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="owner">Owner</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah Akun</button>
                </form>
            </div>
        </div>
    </div>
</div>
