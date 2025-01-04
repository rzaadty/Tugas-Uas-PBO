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
	<div class=" d-flex justify-content-between bg-secondary align-items-center  px-3 py-2 ">
		<h4 class="text-uppercase text-dark">
			<i class="bi bi-clipboard-data" style="font-size: 30px;"></i>
			Management Menu
		</h4>

		<button onclick="window.location='<?= site_url('Dashboard') ?>'" class="btn btn-dark ">
			<i class="bi bi-arrow-left"></i>
		</button>
	</div>



	<div class="container px-3 py-3">

		<div class="d-flex justify-content-between mb-3">
			<a href="<?= site_url('Menu/v_tambahmenu') ?>" class="btn btn-sm btn-success">
				<i class="bi bi-plus-circle"></i>
				Tambah Menu
			</a>
		</div>


		<div class="card border border-dark border-3">
			<div class="card-header bg-primary text-bold text-dark">
				<h4 class="text-dark"><i class="bi bi-clipboard-data"></i> Daftar Menu</h4>
			</div>
			<div class="card-body">
			<div class="table-responsive">
					<table id="table1" class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Barang</th>
								<th>Stok</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (count($menu_items) > 0): ?>
							<?php $no = 1; foreach ($menu_items as $item): ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= htmlspecialchars($item['nama_barang']) ?></td>
								<td><?= htmlspecialchars($item['stok']) ?></td>
								<td>
									<a href="<?= site_url('Menu/v_edit/' . $item['id_menu']) ?>"
										class="btn btn-warning btn-sm mb-2">
										<i class="bi bi-pencil"></i>
									</a>
									<a href="<?= site_url('Menu/delete/' . $item['id_menu']) ?>"
										class="btn btn-danger btn-sm mb-2"
										onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
										<i class="bi bi-trash"></i>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php else: ?>
							<tr>
								<td colspan="8">Belum ada data</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
