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

<div class="background-container">
    <div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
        <h4 class="text-uppercase text-dark">
            <i class="bi bi-tags" style="font-size: 30px;"></i>
            Management Kategori
        </h4>

        <button onclick="window.location='<?= site_url('Dashboard') ?>'" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>

    <div class="container px-3 py-3">
        <div class="d-flex justify-content-between mb-3">
            <a href="<?= site_url('Kategori/v_tambahkategori') ?>" class="btn btn-sm btn-success">
                <i class="bi bi-plus-circle"></i>
                Tambah Kategori
            </a>
        </div>

        <div class="card border border-dark border-3 shadow">
            <div class="card-header bg-secondary text-bold text-dark">
                <h3 class="text-dark"><i class="bi bi-card-list"></i> Daftar Kategori</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($kategori_items) > 0): ?>
                            <?php $no = 1; foreach ($kategori_items as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($item['nama_kategori']) ?></td>
                                <td>
                                    <a href="<?= site_url('Kategori/v_edit/' . $item['id_kategori']) ?>"
                                       class="btn btn-warning btn-sm mb-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('Kategori/delete/' . $item['id_kategori']) ?>"
                                       class="btn btn-danger btn-sm mb-2"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="3">Belum ada data</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
