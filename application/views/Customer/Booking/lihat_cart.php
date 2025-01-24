
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
    </style>

<div class="background-container">
    <div class="d-flex justify-content-between bg-secondary align-items-center px-3 py-2">
        <h4 class="text-uppercase text-dark">
            <i class="bi bi-cart4" style="font-size: 30px;"></i> Keranjang Belanja
        </h4>
        <button onclick="window.location='<?= site_url('Customer_booking') ?>'" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i>
        </button>
    </div>

    <div class="container mt-3 px-3 content-container">
        <div class="card card-custom border border-dark border-3">
            <div class="card-header bg-secondary">
                <h3 class="mb-0 text-dark"><i class="bi bi-card-list"></i> Daftar Keranjang Belanja</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table1">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
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
                                <td>
                                    <a href="<?= site_url('Customer_booking/hapus_item_cart/' . $item['rowid']); ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Keranjang belanja kosong</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th>Rp <?= number_format($this->cart->total(), 0, ',', '.'); ?></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>

                <a href="<?= site_url('Customer_booking'); ?>" class="btn btn-primary mb-3"><i class="bi bi-bag-plus"></i> Tambah Pesanan</a>
                <a href="<?= site_url('Customer_booking/checkout'); ?>" class="btn btn-success mb-3"><i class="bi bi-cart4"></i> Checkout</a>
            </div>
        </div>
    </div>
</div>
