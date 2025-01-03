<div class="container px-3 py-3">

	<div class="d-flex justify-content-between align-items-center mb-3">
		<h3 class="text-uppercase">
			<i class="bi bi-clipboard-data" style="font-size: 30px;"></i>
			Management Menu
		</h3>
		<button onclick="history.back()" class="btn btn-dark">
			<i class="bi bi-arrow-left"></i>
		</button>

	</div>


	<div class="d-flex justify-content-between mb-3">
		<a href="<?= site_url('Menu/add') ?>" class="btn btn-sm btn-success">
			<i class="bi bi-plus-circle"></i>
			Tambah Menu
		</a>
	</div>


	<div class="card border border-dark border-3">
		<div class="card-header bg-secondary text-bold text-dark">
			<i class="bi bi-clipboard-data"></i> Daftar Menu
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table1" class="table table-bordered text-center text-dark align-middle">
					<thead class="table-primary text-dark">
						<tr>
							<th>No</th>
							<th>Gambar</th>
							<th>Kategori</th>
							<th>Nama Barang</th>
							<th>Harga Dasar</th>
							<th>Harga Jual</th>
							<th>Stok</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($menu_items) > 0): ?>
						<?php $no = 1; foreach ($menu_items as $item): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td>
								<?php if ($item['gambar']): ?>
								<img src="<?= base_url('path/gambar_menu/' . $item['gambar']) ?>" class="img-thumbnail"
									alt="Gambar Barang" style="max-width: 100px; height: auto;">
								<?php else: ?>
								<img src="https://via.placeholder.com/20" class="img-thumbnail" alt="Gambar Barang"
									style="max-width: 100px; height: auto;">
								<?php endif; ?>
							</td>

							<td><?= htmlspecialchars($item['kategori']) ?></td>
							<td><?= htmlspecialchars($item['nama_barang']) ?></td>
							<td>Rp <?= number_format($item['harga_dasar'], 0, ',', '.') ?></td>
							<td>Rp <?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
							<td><?= htmlspecialchars($item['stok']) ?></td>
							<td>
								<a href="<?= site_url('Menu/edit/' . $item['id_menu']) ?>"
									class="btn btn-warning btn-sm">
									<i class="bi bi-pencil"></i>
								</a>
								<a href="<?= site_url('Menu/delete/' . $item['id_menu']) ?>"
									class="btn btn-danger btn-sm"
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
