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
	<div class="bg-secondary px-2 py-2 d-flex align-items-center justify-content-between">
		<div class="d-flex align-items-center">
			<img src="<?= base_url('path/gambar_tampilan/logo.png') ?>" alt="Logo"
				style="width: 60px; height: 40px; margin-right: 10px;">
			<h3 class="text-dark mb-0">Home <br>RESTAURANTKU</h3>
		</div>
		<h1><a href="<?= base_url('Auth/logout') ?>" class="text-dark text-bold px-3"><i class="bi bi-power"></i></a>
		</h1>
	</div>


	<div class="content-container">
		<div class="container text-center py-3 px-4">
			<!-- Logo -->
			<h1 class="mb-3">
				<img src="<?= base_url('path/gambar_tampilan/logo.png')?>" alt="Logo"
					style="width: 230px; height: 150px;">
			</h1>

			<!-- Theme Toggle -->
			<div class="d-flex justify-content-center align-items-center gap-2 mb-3">
				<label for="toggle-dark" class="me-2">Tema:</label>
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
					role="img" class="iconify iconify--system-uicons" width="20" height="20"
					preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
					<g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
						stroke-linejoin="round">
						<path
							d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
							opacity=".3"></path>
						<g transform="translate(-210 -1)">
							<path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
							<circle cx="220.5" cy="11.5" r="4"></circle>
							<path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
							</path>
						</g>
					</g>
				</svg>
				<div class="form-check form-switch">
					<input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
					role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
					viewBox="0 0 24 24">
					<path fill="currentColor"
						d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
					</path>
				</svg>
			</div>

			<!-- Welcome Title -->
			<h2 class="mb-3">Welcome App <br> RESTAURANTKU</h2>

			<!-- Menu Fitur -->
			<div class="row justify-content-center">
				<div class="col-12 mb-4">
					<h3>
						<span class="badge rounded-pill bg-secondary text-white border border-dark border-4">
							<i class="bi bi-menu-button-wide"></i> MENU FITUR
						</span>
					</h3>
				</div>

				<!-- MODUL APLIKASI -->
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Menu')?>" class="card h-100 text-center border border-dark border-4 shadow">
						<div class="card-body">
							<i class="bi bi-card-list" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Menu</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Kasir')?>" class="card h-100 text-center border border-dark border-4 shadow">
						<div class="card-body">
							<i class="bi bi-cash-coin" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Kasir</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Booking')?>"
						class="card h-100 text-center border border-dark border-4 shadow">
						<div class="card-body">
							<i class="bi bi-wifi" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Booking Online</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Dapur')?>" class="card h-100 text-center border border-dark border-4 shadow">
						<div class="card-body">
							<i class="bi bi-basket" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Dapur</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Meja')?>" class="card h-100 text-center border border-dark border-4 shadow">
						<div class="card-body">
							<i class="bi bi-table" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Meja</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Kategori')?>"
						class="card h-100 text-center border border-dark border-4 shadow">
						<div class="card-body">
							<i class="bi bi-tags" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Kategori</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Laporan')?>"
						class="card h-100 text-center border border-dark border-4 shadow">
						<div class="card-body">
							<i class="bi bi-bar-chart" style="font-size: 40px; color: #000000;"></i>
							<h5 class="card-title mt-2 text-dark">Laporan</h5>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-3 mb-3 px-2">
					<a href="<?= site_url('Dashboard_akun')?>"
						class="card h-100 text-center border border-dark border-4 shadow">
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
