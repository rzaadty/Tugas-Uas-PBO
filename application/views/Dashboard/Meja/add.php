<style>
    /* Gambar latar belakang responsif pada div tertentu */
    .background-container {
        background-image: url('<?= base_url('path/gambar_tampilan/background.png');?>');
        background-size: cover; /* Pastikan gambar menutupi seluruh area */
        background-position: bottom; /* Menempatkan gambar di bagian bawah */
        background-repeat: no-repeat; /* Menghindari pengulangan gambar */
        height: 100vh; /* Setel tinggi container agar memenuhi layar penuh */
        width: 100%; /* Lebar penuh agar menyesuaikan dengan layar */
        display: flex;
        flex-direction: column;
    }

    /* Scrollable content container */
    .content-container {
        flex: 1;
        overflow-y: auto; /* Izinkan konten untuk digulirkan vertikal */
        padding-bottom: 20px; /* Memberi ruang di bawah konten */
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

<div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
    <h4 class="text-uppercase text-dark">
        <i class="bi bi-clipboard-data" style="font-size: 30px;"></i>
        Tambah Meja
    </h4>

    <button onclick="window.location='<?= site_url('Meja') ?>'" class="btn btn-dark">
        <i class="bi bi-arrow-left"></i>
    </button>
</div>

<div class="background-container">
    <div class="content-container">
        <div class="container px-3 py-3">
            <!-- Add Form for Meja -->
            <div class="card border border-dark border-3">
                <div class="card-header bg-primary text-bold text-dark">
                    <i class="bi bi-plus-circle"></i> Tambah Meja
                </div>
                <div class="card-body mt-4">
                    <form action="<?= site_url('Meja/tambah_aksi') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nomor_meja" class="form-label">Nomor Meja</label>
                            <input type="text" id="nomor_meja" name="nomor_meja" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" id="kapasitas" name="kapasitas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="terpesan">Terpesan</option>
                                <option value="digunakan">Digunakan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" id="lokasi" name="lokasi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea id="catatan" name="catatan" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_dipesan" class="form-label">Waktu Dipesan</label>
                            <input type="datetime-local" id="waktu_dipesan" name="waktu_dipesan" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Tambah Meja</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
