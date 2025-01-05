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
            <i class="bi bi-table" style="font-size: 30px;"></i>
            Management Meja
        </h4>

        <button onclick="window.location='<?= site_url('Dashboard') ?>'" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>

    <div class="container px-3 py-3">

        <div class="d-flex justify-content-between mb-3">
            <a href="<?= site_url('Meja/v_tambahmeja') ?>" class="btn btn-sm btn-success">
                <i class="bi bi-plus-circle"></i>
                Tambah Meja
            </a>
        </div>

        <div class="card border border-dark border-3 shadow">
            <div class="card-header bg-secondary text-bold text-dark">
                <h3 class="text-dark"><i class="bi bi-card-list"></i> Daftar Meja</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Meja</th>
                                <th>Kapasitas</th>
                                <th>Status</th>
                                <th>Lokasi</th>
                                <th>Waktu Terpesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($meja_items) > 0): ?>
                            <?php $no = 1; foreach ($meja_items as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($item['nomor_meja']) ?></td>
                                <td><?= htmlspecialchars($item['kapasitas']) ?></td>
                                <td><?= htmlspecialchars($item['status']) ?></td>
                                <td><?= htmlspecialchars($item['lokasi']) ?></td>
                                <td><?= htmlspecialchars($item['waktu_dipesan']) ?></td>
                                <td>
                                    <a href="<?= site_url('Meja/v_edit/' . $item['id_meja']) ?>"
                                        class="btn btn-warning btn-sm mb-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('Meja/delete/' . $item['id_meja']) ?>"
                                        class="btn btn-danger btn-sm mb-2"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus meja ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6">Belum ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
