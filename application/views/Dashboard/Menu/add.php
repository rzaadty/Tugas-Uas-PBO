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
        Tambah Menu
    </h4>

    <button onclick="window.location='<?= site_url('Menu') ?>'" class="btn btn-dark">
        <i class="bi bi-arrow-left"></i>
    </button>
</div>

<div class="background-container">
    <div class="content-container">
        <div class="container px-3 py-3">
            <!-- Add Form for Menu -->
            <div class="card border border-dark border-3">
                <div class="card-header bg-primary text-bold text-dark">
                    <i class="bi bi-plus-circle"></i> Tambah Menu
                </div>
                <div class="card-body mt-4">
                    <form action="<?= site_url('Menu/add') ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select id="kategori" name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategoris as $kategori): ?>
                                    <option value="<?= $kategori['nama_kategori'] ?>">
                                        <?= htmlspecialchars($kategori['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga_dasar" class="form-label">Harga Dasar</label>
                            <input type="number" id="harga_dasar" name="harga_dasar" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" id="harga_jual" name="harga_jual" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" id="stok" name="stok" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Menu</label>
                            <input type="file" id="gambar" name="gambar" class="form-control" onchange="previewImage(event)">
                            <img id="preview" src="https://via.placeholder.com/50" class="img-thumbnail mt-2" alt="Preview Gambar" style="max-width: 100px; height: auto;">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Tambah Menu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to preview the image
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('preview');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
