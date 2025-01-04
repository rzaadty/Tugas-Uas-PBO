<style>
	/* Gambar latar belakang responsif pada div tertentu */
	.background-container {
		background-image: url('<?= base_url('path/gambar_tampilan/decor.png');?>');
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
	<!-- Header atau bagian atas -->
	<div class="bg-secondary px-2 py-2 d-flex align-items-center">
		<img src="<?= base_url('path/gambar_tampilan/logo.png')?>" alt="Logo"
			style="width: 60px; height: 40px; margin-right: 10px;">
		<h3 class="text-dark mb-0">Home <br>RESTAURANTKU</h3>
	</div>

	<!-- Kontainer konten yang dapat digulir -->
	<div class="content-container">
		<div class="container text-center py-3 px-4">
			<h1 class="mb-3">
				<img src="<?= base_url('path/gambar_tampilan/logo.png')?>" alt="Logo"
					style="width: 120px; height: 80px;">
			</h1>
			<h2 class="mb-3">Welcome App <br> RESTAURANTKU</h2>

			<div class="row justify-content-center">
				<div class="col-12 mb-4">
					<h3>
						<span class="badge rounded-pill bg-secondary text-white border border-dark border-4">MENU
							FITUR</span>
					</h3>
				</div>

				<!-- MODUL APLIKASI -->
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Menu')?>" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-card-list" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Menu</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="#" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-cash" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Kasir</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="#" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-box-seam" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Stok</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="#" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-basket" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Dapur</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Meja')?>" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-table" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Meja</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="#" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-tags" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Kategori</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="#" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-bar-chart" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Laporan</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="#" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-person" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Profil</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="#" class="card h-100 text-center border border-dark border-4">
						<div class="card-body">
							<i class="bi bi-gear" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Akun</h5>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
