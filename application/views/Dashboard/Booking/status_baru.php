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

    <button onclick="window.location='<?= site_url('Dapur') ?>'" class="btn btn-dark">
      <i class="bi bi-arrow-left"></i>
    </button>
  </div>

  <div class="container mt-3">
    <div class="card shadow-sm border border-dark border-3">
      <div class="card-header bg-secondary">
        <h3 class="mb-0 text-dark"><i class="bi bi-card-list"></i> Daftar Pesanan - Dapur</h3>
      </div>
      <div class="card-body mt-3">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jenis Order</th>
              <th>Total Harga</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($orders as $order): ?>
            <!-- Tampilkan hanya jika status 'Baru' dan reservasi = 'no' -->
            <?php if ($order['reservasi'] == 'yes' && $order['status_pesanan'] == 'Baru'): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $order['nama']; ?></td>
              <td><?= $order['jenis_order']; ?></td>
              <td>Rp <?= number_format($order['total_harga'], 0, ',', '.'); ?></td>
              <td><?= $order['status_pesanan']; ?></td>
              <td>
                <a href="<?= site_url('Dapur/view_order/'.$order['id_pesanan']); ?>"
                   class="btn btn-info btn-sm">View</a>
                <?php if ($order['status_pesanan'] == 'Menunggu'): ?>
                <a href="<?= site_url('Dapur/update_status/'.$order['id_pesanan'].'/Diproses'); ?>"
                   class="btn btn-warning btn-sm">Start Processing</a>
                <?php elseif ($order['status_pesanan'] == 'Diproses'): ?>
                <a href="<?= site_url('Dapur/update_status/'.$order['id_pesanan'].'/Selesai'); ?>"
                   class="btn btn-success btn-sm">Complete</a>
                <?php endif; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
