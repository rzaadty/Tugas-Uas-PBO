<div class="container px-3 py-3">

	<div class="d-flex justify-content-between align-items-center mb-3">
		<h3 class="text-uppercase">
			<i class="bi bi-clipboard-data" style="font-size: 30px;"></i>
			Edit Menu
		</h3>
		<button onclick="history.back()" class="btn btn-dark">
			<i class="bi bi-arrow-left"></i>
		</button>
	</div>

	<!-- Edit Form for Menu -->
	<div class="card border border-dark border-3">
		<div class="card-header bg-secondary text-bold text-dark">
			<i class="bi bi-pencil"></i> Edit Menu
		</div>
		<div class="card-body mt-4">
			<form action="<?= site_url('Menu/edit/' . $menu_item['id_menu']) ?>" method="POST" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="nama_barang" class="form-label">Nama Barang</label>
					<input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?= htmlspecialchars($menu_item['nama_barang']) ?>" required>
				</div>
				<div class="mb-3">
					<label for="kategori" class="form-label">Kategori</label>
					<input type="text" id="kategori" name="kategori" class="form-control" value="<?= htmlspecialchars($menu_item['kategori']) ?>" required>
				</div>
				<div class="mb-3">
					<label for="harga_dasar" class="form-label">Harga Dasar</label>
					<input type="number" id="harga_dasar" name="harga_dasar" class="form-control" value="<?= $menu_item['harga_dasar'] ?>" required>
				</div>
				<div class="mb-3">
					<label for="harga_jual" class="form-label">Harga Jual</label>
					<input type="number" id="harga_jual" name="harga_jual" class="form-control" value="<?= $menu_item['harga_jual'] ?>" required>
				</div>
				<div class="mb-3">
					<label for="stok" class="form-label">Stok</label>
					<input type="number" id="stok" name="stok" class="form-control" value="<?= $menu_item['stok'] ?>" required>
				</div>
				<div class="mb-3">
					<label for="gambar" class="form-label">Gambar Menu</label>
					<input type="file" id="gambar" name="gambar" class="form-control">
					<?php if ($menu_item['gambar']): ?>
					<img src="<?= base_url('path/gambar_menu/' . $menu_item['gambar']) ?>" class="img-thumbnail mt-2" alt="Gambar Barang">
					<?php else: ?>
					<img src="https://via.placeholder.com/50" class="img-thumbnail mt-2" alt="Gambar Barang">
					<?php endif; ?>
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>

</div>
