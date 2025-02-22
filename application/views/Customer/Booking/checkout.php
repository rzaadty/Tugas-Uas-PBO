<style>
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

	.card-custom {
		box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
	}

	.card-header {
		font-size: 1.25rem;
		color: #333;
	}

	.table th,
	.table td {
		text-align: center;
	}

	.table th {
		background-color: #f8f9fa;
	}

	.form-label {
		font-weight: bold;
	}

	.btn-custom {
		margin-top: 10px;
		font-size: 16px;
	}

	.footer-btn {
		margin-top: 20px;
		display: flex;
		justify-content: space-between;
	}

</style>

<div class="background-container">
	<div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
		<h4 class="text-uppercase text-dark">
			<i class="bi bi-cart4" style="font-size: 30px;"></i> Checkout
		</h4>
		<button onclick="window.location='<?= site_url('Customer_booking/lihat_cart') ?>'" class="btn btn-dark">
			<i class="bi bi-arrow-left"></i>
		</button>
	</div>

	<div class="container mt-3 px-3 content-container">
		<div class="card card-custom border border-dark border-3">
			<div class="card-header bg-secondary text-dark">
				<h3 class="mb-0 text-dark"><i class="bi bi-card-list"></i> List Keranjang</h3>
			</div>
			<div class="card-body mt-3">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Barang</th>
							<th>Harga Satuan</th>
							<th>Jumlah</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($cart_items)) : ?>
						<?php $no = 1; foreach ($cart_items as $item) : ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $item['name']; ?></td>
							<td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
							<td><?= $item['qty']; ?></td>
							<td>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
						</tr>
						<?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="5" class="text-center">Keranjang belanja kosong</td>
						</tr>
						<?php endif; ?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="4">Total</th>
							<th>Rp <?= number_format($total_harga, 0, ',', '.'); ?></th>
						</tr>
					</tfoot>
				</table>


				<form action="<?= site_url('Customer_booking/buat_pesanan'); ?>" method="post"
					enctype="multipart/form-data">
					<div class="mb-3">
						<label for="nama" class="form-label">Atas Nama</label>
						<input type="text" name="nama" id="nama" class="form-control"
							value="<?= $this->session->userdata('nama'); ?>" readonly>
					</div>
					<div id="hidden_data" style="display: none;">
						<input type="hidden" name="id_pemesan_online" value="<?= $this->session->userdata('id'); ?>">
					</div>

					<div class="mb-3">
						<label for="tanggal_pemesanan" class="form-label">Tanggal dan Jam Pemesanan</label>
						<input type="datetime-local" name="tanggal_pemesanan" id="tanggal_pemesanan"
							class="form-control">
					</div>

					<div class="mb-3">
						<label for="nama" class="form-label">Atas Nama</label>
						<input type="text" name="nama" id="nama" class="form-control"
							value="<?= $this->session->userdata('nama'); ?>" readonly>
					</div>

					<div class="mb-3">
						<label for="id_meja" class="form-label">Nomor Meja</label>
						<select name="id_meja" id="id_meja" class="form-select" required>
							<option value="">Pilih Nomor Meja</option>
							<?php if (!empty($meja_items)) : ?>
							<?php foreach ($meja_items as $meja) : ?>
							<?php if ($meja['status'] === 'tersedia') : ?>
							<option value="<?= $meja['id_meja']; ?>">No Meja <?= $meja['nomor_meja']; ?> - Kapasitas
								<?= $meja['kapasitas']; ?></option>
							<?php endif; ?>
							<?php endforeach; ?>
							<?php else : ?>
							<option value="">Tidak ada meja tersedia</option>
							<?php endif; ?>
						</select>
					</div>

					<div class="mb-3">
						<label for="jenis_order" class="form-label">Jenis Order</label>
						<select name="jenis_order" id="jenis_order" class="form-select" readonly>
							<option value="Tempat">Tempat</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
						<select name="metode_pembayaran" id="metode_pembayaran" class="form-select" readonly>
							<option value="Transfer">Transfer</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="uang_bayar" class="form-label">Uang Dibayarkan</label>
						<input type="number" name="uang_bayar" id="uang_bayar" class="form-control"
							placeholder="Masukkan nominal uang" required>
					</div>
					<div class="mb-3">
						<label for="bukti_pembayaran" class="form-label">Bukti Transfer</label>
						<input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required>
					</div>
					<div class="footer-btn float-end">
						<button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Proses
							Pesanan</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
