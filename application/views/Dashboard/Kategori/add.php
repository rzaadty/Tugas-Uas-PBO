<style>
    /* Gambar latar belakang responsif pada div tertentu */
    .background-container {
        background-image: url('<?= base_url('path/gambar_tampilan/background.png');?>');
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .content-container {
        flex: 1;
        overflow-y: auto;
        padding-bottom: 20px;
    }

    @media (max-width: 768px) {
        .background-container {
            height: 100vh;
        }
    }

    @media (min-width: 769px) {
        .background-container {
            height: 100vh;
        }
    }
</style>

<div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
    <h4 class="text-uppercase text-dark">
        <i class="bi bi-clipboard-data" style="font-size: 30px;"></i>
        Tambah kategori
    </h4>

    <button onclick="window.location='<?= site_url('Meja') ?>'" class="btn btn-dark">
        <i class="bi bi-arrow-left"></i>
    </button>
</div>

<div class="background-container">
    <div class="content-container">
        <div class="container px-3 py-3">
            <!-- Add Form for Kategori -->
            <div class="card border border-dark border-3">
                <div class="card-header bg-primary text-bold text-dark">
                    <i class="bi bi-plus-circle"></i> Tambah Kategori
                </div>
                <div class="card-body mt-4">
                    <form action="<?= site_url('Kategori/add') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>