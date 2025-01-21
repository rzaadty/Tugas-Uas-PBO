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



<!-- View: index.php -->
<div class="background-container">
	<div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
		<h4 class="text-uppercase text-dark">
			<i class="bi bi-card-list" style="font-size: 30px;"></i>
			Management Akun
		</h4>
		<button onclick="window.location='<?= site_url('Dashboard') ?>'" class="btn btn-dark">
			<i class="bi bi-arrow-left"></i>
		</button>
	</div>

	<div class="container px-3 py-3">
		<div class="d-flex justify-content-between mb-3">
			<a href="<?= site_url('Dashboard_akun/create') ?>" class="btn btn-sm btn-success">
				<i class="bi bi-plus-circle"></i>
				Tambah Akun
			</a>
		</div>

		<div class="card border border-dark border-3 shadow">
			<div class="card-header bg-secondary text-dark">
				<h3 class="text-dark"><i class="bi bi-card-list text-dark"></i> Daftar Akun</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>No Telepon</th>
								<th>Email</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($users)): ?>
							<?php $no = 1; ?>
							<?php foreach ($users as $user): ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $user->nama; ?></td>
								<td><?= $user->alamat; ?></td>
								<td><?= $user->no_telepon; ?></td>
								<td><?= $user->email; ?></td>
								<td><?= $user->status; ?></td>
								<td>
									<a href="<?= site_url('Dashboard_akun/edit/'.$user->id_login) ?>"
										class="btn btn-sm btn-warning mb-2"><i class="bi bi-pencil-square"></i></a>
									<a href="<?= site_url('Dashboard_akun/delete/'.$user->id_login) ?>"
										class="btn btn-sm btn-danger mb-2"
										onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php else: ?>
							<tr>
								<td colspan="7">Belum ada data</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
