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
            <i class="bi bi-bar-chart" style="font-size: 30px;"></i>
            Management Laporan
        </h4>

        <button onclick="window.location='<?= site_url('Dashboard') ?>'" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>
	<div class="container mt-4">
		<div class="card shadow-sm border border-dark border-3">
			<div class="card-header bg-secondary text-white ">
            <h3 class="mb-0 text-dark"><i class="bi bi-bar-chart"></i> Daftar Laporan</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive mt-2">
					<table class="table table-striped table-bordered" id="table1">
						<thead>
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
								<td class="text-center"><?= $no++; ?></td>
								<td class="text-center"><?= $row['id_meja']; ?></td>
								<td><?= htmlspecialchars($row['nama']); ?></td>
								<td class="text-center">
									<span class="badge bg-primary"><?= htmlspecialchars($row['jenis_order']); ?></span>
								</td>
								<td class="text-center"><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
								<td class="text-end">Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
								<td class="text-end">Rp<?= number_format($row['uang_bayar'], 0, ',', '.'); ?></td>
								<td class="text-end">Rp<?= number_format($row['kembalian'], 0, ',', '.'); ?></td>
								<td class="text-center"><?= htmlspecialchars($row['tanggal']); ?></td>
								<td class="text-center">
									<?php if ($row['status_pesanan'] == 'Menunggu'): ?>
									<span
										class="badge bg-primary" value=" <?= htmlspecialchars($row['status_pesanan']); ?>"><i class="bi bi-arrow-down"></i></span>
									<?php elseif ($row['status_pesanan'] == 'Diproses'): ?>
									<span
										class="badge bg-warning text-dark" value="<?= htmlspecialchars($row['status_pesanan']); ?>"><i class="bi bi-hourglass-split"></i></span>
									<?php elseif ($row['status_pesanan'] == 'Selesai'): ?>
									<span
										class="badge bg-success" value="<?= htmlspecialchars($row['status_pesanan']); ?>"><i class="bi bi-file-check"></i></span>
									<?php else: ?>
									<span
										class="badge bg-secondary"><?= htmlspecialchars($row['status_pesanan']); ?></span>
									<?php endif; ?>
								</td>

								<td class="text-center">
									<?php if (!empty($row['bukti_pembayaran'])): ?>
									<img src="<?= base_url('path/gambar_bukti_transfer/' . $row['bukti_pembayaran']); ?>"
										alt="Bukti" width="50">
									<?php else: ?>
									<span class="text-muted">Order Offline</span>
									<?php endif; ?>
								</td>

								<td class="text-center"><?= $row['reservasi'] == 'yes' ? 'Ya' : 'Tidak'; ?></td>
								<td class="text-center">
									<a href="<?= site_url('Laporan/delete/' . $row['id_pesanan']); ?>"
										class="btn btn-danger btn-sm" onclick="return confirm('Hapus laporan ini?')">
                                        <i class="bi bi-trash"></i>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
