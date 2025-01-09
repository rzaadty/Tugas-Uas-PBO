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
            <i class="bi bi-basket" style="font-size: 30px;"></i>
            Daftar Pesanan
        </h4>

        <button onclick="window.location='<?= site_url('Customer_pesanan') ?>'" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>

    <div class="container mt-3">
        <div class="card shadow-sm border border-dark border-3">
            <div class="card-header bg-secondary">
                <h3 class="mb-0 text-dark"><i class="bi bi-card-list"></i> Detail Pesanan</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>No Meja</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $detail): ?>
                            <tr>
                                <td><?= $detail['id_barang']; ?></td>
                                <td><?= $detail['nama_barang']; ?></td>
                                <td><?= $detail['jumlah']; ?></td>
                                <td><?= $detail['id_meja']; ?></td>
                                <td>Rp <?= number_format($detail['harga_jual'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

</div>
