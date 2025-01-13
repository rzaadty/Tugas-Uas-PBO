<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-calendar-week"></i> Laporan Periode Januari 2025
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Meja</th>
                            <th>Nama Pemesan</th>
                            <th>Jenis Order</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Uang Bayar</th>
                            <th>Kembalian</th>
                            <th>Tanggal</th>
                            <th>Status Pesanan</th>
                            <th>Bukti Pembayaran</th>
                            <th>Reservasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($laporan as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['id_meja']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><span class="badge bg-primary"><?= $row['jenis_order']; ?></span></td>
                            <td><?= $row['metode_pembayaran']; ?></td>
                            <td>Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td>Rp<?= number_format($row['uang_bayar'], 0, ',', '.'); ?></td>
                            <td>Rp<?= number_format($row['kembalian'], 0, ',', '.'); ?></td>
                            <td><?= $row['tanggal']; ?></td>
                            <td><span class="badge bg-success"><?= $row['status_pesanan']; ?></span></td>
                            <td><img src="<?= base_url('uploads/' . $row['bukti_pembayaran']); ?>" alt="Bukti" width="50"></td>
                            <td><?= $row['reservasi'] == 'yes' ? 'Ya' : 'Tidak'; ?></td>
                            <td>
                                <a href="<?= site_url('Laporan/detail/'.$row['id_pesanan']); ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="<?= site_url('Laporan/delete/'.$row['id_pesanan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus laporan ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
