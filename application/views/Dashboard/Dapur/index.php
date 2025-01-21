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

	<div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
		<h4 class="text-uppercase text-dark">
			<i class="bi bi-cash-coin" style="font-size: 30px;"></i>
			Dapur
		</h4>

		<button onclick="window.location='<?= site_url('Dashboard') ?>'" class="btn btn-dark">
			<i class="bi bi-arrow-left"></i>
		</button>
	</div>

	<div class="container mt-3">
  <div class="card shadow-sm border border-dark border-3">
    <div class="card-header bg-secondary">
      <h3 class="mb-0 text-dark"><i class="bi bi-card-list"></i> Daftar Pesanan</h3>
    </div>
    <div class="card-body mt-3">
      <div class="row">
        <!-- Card Status Baru -->
        <div class="col-md-4 mb-4">
          <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border border-dark border-3">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-white">Status: Baru</h5>
              </div>
              <div class="card-body">
                <p>Pesanan baru yang belum diproses.</p>
                <a href="<?= site_url('Dapur/status_baru')?>" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Lihat Detail</a>
              </div>
            </div>
          </a>
        </div>
        <!-- Card Status Diproses -->
        <div class="col-md-4 mb-4">
          <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border border-dark border-3">
              <div class="card-header bg-warning text-dark">
                <h5 class="mb-0 text-white">Status: Diproses</h5>
              </div>
              <div class="card-body">
                <p>Pesanan sedang diproses oleh tim.</p>
                <a href="<?= site_url('Dapur/status_diproses')?>" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Lihat Detail</a>
              </div>
            </div>
          </a>
        </div>
        <!-- Card Status Selesai -->
        <div class="col-md-4">
          <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border border-dark border-3">
              <div class="card-header bg-success text-white">
                <h5 class="mb-0 text-white">Status: Selesai</h5>
              </div>
              <div class="card-body">
                <p>Pesanan telah selesai diproses</p>
                <a href="<?= site_url('Dapur/status_selesai')?>" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Lihat Detail</a>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>



</div>
