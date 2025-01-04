<style>
	/* Gambar latar belakang responsif pada div tertentu */
	.background-container {
		background-image: url('<?= base_url('path/gambar_tampilan/background.png');?>');
		background-size: cover;
		/* Pastikan gambar menutupi seluruh area */
		background-position: bottom;
		/* Menempatkan gambar di bagian bawah */
		background-repeat: no-repeat;
		/* Menghindari pengulangan gambar */
		height: 100vh;
		/* Setel tinggi container agar memenuhi layar penuh */
		width: 100%;
		/* Lebar penuh agar menyesuaikan dengan layar */
		display: flex;
		flex-direction: column;
	}

	/* Scrollable content container */
	.content-container {
		flex: 1;
		overflow-y: auto;
		/* Izinkan konten untuk digulirkan vertikal */
		padding-bottom: 20px;
		/* Memberi ruang di bawah konten */
	}

	/* Responsif untuk perangkat mobile */
	@media (max-width: 768px) {
		.background-container {
			height: 100vh;
			/* Tetap 100% tinggi pada layar kecil */
		}
	}

	/* Responsif untuk desktop */
	@media (min-width: 769px) {
		.background-container {
			height: 100vh;
			/* Menjaga agar latar belakang tetap full screen pada desktop */
		}
	}

</style>

<div class="background-container">

	<div class=" d-flex justify-content-between bg-secondary align-items-center  px-3 py-2 ">
		<h4 class="text-uppercase text-dark">
			<i class="bi bi-cash-coin" style="font-size: 30px;"></i>
			Kasir
		</h4>

		<button onclick="window.location='<?= site_url('Dashboard') ?>'" class="btn btn-dark ">
			<i class="bi bi-arrow-left"></i>
		</button>
	</div>

	<div class="container mt-3 px-3">
		<div class="card shadow-sm border border-dark border-3">
			<div class="card-header bg-secondary">
				<h3 class="mb-0 text-dark"><i class="bi bi-list-check"></i> Daftar Menu</h3>
			</div>
			<div class="card-body">
				<table class="table table-striped table-bordered" id="table1">
					<thead>
						<tr>
							<th class="text-dark">No</th>
							<th class="text-dark">Nama Barang</th>
							<th class="text-dark">Harga</th>
							<th class="text-dark">Stok</th>
							<th class="text-dark">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($menu_items as $item) : ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $item['nama_barang']; ?></td>
							<td>Rp <?= number_format($item['harga_jual'], 0, ',', '.'); ?></td>
							<td><?= $item['stok']; ?></td>
							<td>
								<form action="<?= site_url('Kasir/tambah_ke_cart'); ?>" method="post"
									class="d-flex align-items-center">
									<input type="hidden" name="id_barang" value="<?= $item['id_menu']; ?>">
									<input type="hidden" name="nama_barang" value="<?= $item['nama_barang']; ?>">
									<input type="hidden" name="harga" value="<?= $item['harga_jual']; ?>">
									<div class="input-group" style="width: 120px;">
										<button type="button" class="btn btn-danger btn-sm"
											onclick="updateJumlah(this, -1)">−</button>
										<input type="number" name="jumlah" class="form-control text-center" min="1"
											max="<?= $item['stok']; ?>" value="1" required>
										<button type="button" class="btn btn-warning btn-sm"
											onclick="updateJumlah(this, 1)">+</button>
									</div>
									<button type="submit" class="btn btn-success ms-2"><i
											class="bi bi-cart-plus"></i></button>
								</form>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<a href="<?= site_url('Kasir/lihat_cart')?>" class="btn btn-primary float-end"><i class="bi bi-eye"></i>
					Lihat Pesanan</a>

			</div>
		</div>
	</div>
</div>

<script>
	function updateJumlah(button, change) {
		// Temukan elemen input jumlah di dalam grup input
		const input = button.parentElement.querySelector('input[name="jumlah"]');
		const currentValue = parseInt(input.value) || 0;
		const minValue = parseInt(input.min) || 1;
		const maxValue = parseInt(input.max) || Infinity;

		// Hitung nilai baru
		let newValue = currentValue + change;

		// Pastikan nilai berada dalam batas minimum dan maksimum
		if (newValue >= minValue && newValue <= maxValue) {
			input.value = newValue;
		}
	}

</script>
