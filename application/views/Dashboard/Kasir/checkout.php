<style>
    .background-container {
        background-image: url('<?= base_url('path/gambar_tampilan/background.png');?>');
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .content-container {
        flex: 1;
        overflow-y: auto;
        padding-bottom: 20px;
    }

    .card-custom {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-size: 1.25rem;
        color: #333;
    }

    .table th,
    .table td {
        text-align: center;
    }

    .table th {
        background-color: #f8f9fa;
    }

    .form-label {
        font-weight: bold;
    }

    .btn-custom {
        margin-top: 10px;
        font-size: 16px;
    }

    .footer-btn {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

</style>

<div class="background-container">
    <div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
        <h4 class="text-uppercase text-dark">
            <i class="bi bi-cart4" style="font-size: 30px;"></i> Checkout
        </h4>
        <button onclick="window.location='<?= site_url('Kasir') ?>'" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>

    <div class="container mt-3 px-3 content-container">
        <div class="card card-custom border border-dark border-3">
            <div class="card-header bg-secondary text-dark">
                <h3 class="mb-0 text-dark"><i class="bi bi-card-list"></i> List Keranjang</h3>
            </div>
            <div class="card-body mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cart_items)) : ?>
                        <?php $no = 1; foreach ($cart_items as $item) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $item['name']; ?></td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                            <td><?= $item['qty']; ?></td>
                            <td>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">Keranjang belanja kosong</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <th>Rp <?= number_format($total_harga, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>

                <form action="<?= site_url('Kasir/buat_pesanan'); ?>" method="post">
                    <div class="mb-3">
                        <label for="id_meja" class="form-label">Atas Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
    <label for="id_meja" class="form-label">Nomor Meja</label>
    <select name="id_meja" id="id_meja" class="form-select" required>
        <option value="">Pilih Nomor Meja</option>
        <?php if (!empty($meja_items)) : ?>
            <?php foreach ($meja_items as $meja) : ?>
                <option value="<?= $meja['id_meja']; ?>">No meja <?= $meja['nomor_meja']; ?> - Kapasitas <?= $meja['kapasitas']; ?></option>
            <?php endforeach; ?>
        <?php else : ?>
            <option value="">Tidak ada meja tersedia</option>
        <?php endif; ?>
    </select>
</div>

                    <div class="mb-3">
                        <label for="jenis_order" class="form-label">Jenis Order</label>
                        <select name="jenis_order" id="jenis_order" class="form-select" required>
                            <option value="Tempat">Tempat</option>
                            <option value="Bawa Pulang">Bawa Pulang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                            <option value="Cash">Cash</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="uang_bayar" class="form-label">Uang Dibayarkan</label>
                        <input type="text" name="uang_bayar" id="uang_bayar" class="form-control"
                               placeholder="Masukkan nominal uang" required oninput="updateKembalian()">
                    </div>
                    <div class="mb-3">
                        <label for="kembalian" class="form-label">Kembalian</label>
                        <input type="text" name="kembalian" id="kembalian" class="form-control" readonly>
                    </div>
                    <div class="footer-btn float-end">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Proses Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to format input as currency (Rp)
    function formatRupiah(input) {
        let value = input.value.replace(/[^\d]/g, '');  // Remove non-numeric characters
        let formattedValue = '';

        if (value) {
            formattedValue = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        input.value = formattedValue;
    }

    // Function to update the "Kembalian" field based on the total and uang_bayar
    function updateKembalian() {
        let totalHarga = <?= $total_harga; ?>;
        let uangBayar = document.getElementById('uang_bayar').value.replace(/[^\d]/g, ''); // Remove non-numeric characters
        let kembalian = 0;

        if (uangBayar) {
            kembalian = parseInt(uangBayar) - totalHarga;
            kembalian = kembalian >= 0 ? kembalian : 0;
            document.getElementById('kembalian').value = 'Rp ' + kembalian.toLocaleString();
        } else {
            document.getElementById('kembalian').value = 'Rp 0';
        }
    }
</script>
