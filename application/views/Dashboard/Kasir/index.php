<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin-top: 20px;
        }

        .currency {
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Daftar Pesanan</h2>
        <form id="orderForm">
            <!-- Pilihan Meja -->
            <div class="mb-3">
                <label for="id_meja" class="form-label">Pilih Meja</label>
                <select id="id_meja" name="id_meja" class="form-select" required>
                    <option value="">Pilih Meja</option>
                    <?php foreach ($meja_items as $meja): ?>
                    <option value="<?= $meja['id_meja'] ?>"><?= $meja['nomor_meja'] ?> - <?= $meja['lokasi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Jenis Order -->
            <div class="mb-3">
                <label for="jenis_order" class="form-label">Jenis Order</label>
                <select id="jenis_order" name="jenis_order" class="form-select" required>
                    <option value="dine-in">Dine-in</option>
                    <option value="takeaway">Takeaway</option>
                    <option value="delivery">Delivery</option>
                </select>
            </div>

            <!-- Pilihan Menu -->
            <div class="mb-3">
                <label for="menu_items" class="form-label">Pilih Menu</label>
                <select id="menu_items" name="menu_items" class="form-select">
                    <option value="">Pilih Menu</option>
                    <?php foreach ($menu_items as $menu): ?>
                    <option value="<?= $menu['id_menu'] ?>" data-harga="<?= $menu['harga_jual'] ?>">
                        <?= $menu['nama_barang'] ?> - Rp <?= number_format($menu['harga_jual'], 0, ',', '.') ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" id="addMenu" class="btn btn-primary mt-2">Tambah Menu</button>
            </div>

            <!-- Daftar Pesanan -->
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="orderTableBody">
                        <!-- Pesanan akan ditambahkan di sini -->
                    </tbody>
                </table>
            </div>

            <!-- Total Harga dan Uang Bayar -->
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="text" id="total_harga" name="total_harga" class="form-control currency" readonly>
            </div>
            <div class="mb-3">
                <label for="uang_bayar" class="form-label">Uang Bayar</label>
                <input type="number" id="uang_bayar" name="uang_bayar" class="form-control" required>
            </div>

            <!-- Kembalian -->
            <div class="mb-3">
                <label for="kembalian" class="form-label">Kembalian</label>
                <input type="text" id="kembalian" name="kembalian" class="form-control currency" readonly>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select id="metode_pembayaran" name="metode_pembayaran" class="form-select" required>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

            <!-- Tanggal Pesanan -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="datetime-local" id="tanggal" name="tanggal" class="form-control" required>
            </div>

            <!-- Status Pesanan -->
            <div class="mb-3">
                <label for="status_pesanan" class="form-label">Status Pesanan</label>
                <select id="status_pesanan" name="status_pesanan" class="form-select" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </form>
    </div>

    <script>
        const orderTableBody = document.getElementById('orderTableBody');
        const totalHargaInput = document.getElementById('total_harga');
        const uangBayarInput = document.getElementById('uang_bayar');
        const kembalianInput = document.getElementById('kembalian');
        let totalHarga = 0;

        // Fungsi untuk format angka menjadi format 'Rp' dan ribuan
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        document.getElementById('addMenu').addEventListener('click', function () {
            const menuSelect = document.getElementById('menu_items');
            const selectedOption = menuSelect.options[menuSelect.selectedIndex];
            const menuId = selectedOption.value;
            const menuName = selectedOption.text;
            const menuPrice = parseInt(selectedOption.getAttribute('data-harga'));

            const row = document.createElement('tr');
            row.setAttribute('data-menu-id', menuId);
            row.innerHTML = `
                <td>${menuName}</td>
                <td><input type="number" value="1" min="1" class="form-control jumlah-input" data-harga="${menuPrice}"></td>
                <td class="harga">Rp ${formatRupiah(menuPrice)}</td>
                <td class="total-cell">Rp ${formatRupiah(menuPrice)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm delete">Hapus</button>
                </td>
            `;

            orderTableBody.appendChild(row);

            updateTotalHarga();

            row.querySelector('.delete').addEventListener('click', function () {
                row.remove();
                updateTotalHarga();
            });

            row.querySelector('.jumlah-input').addEventListener('input', function () {
                const jumlah = parseInt(this.value) || 0;
                const harga = parseInt(this.getAttribute('data-harga'));
                const totalCell = row.querySelector('.total-cell');

                totalCell.textContent = formatRupiah(jumlah * harga);
                updateTotalHarga();
            });
        });

        function updateTotalHarga() {
            totalHarga = 0;
            document.querySelectorAll('.jumlah-input').forEach(input => {
                const jumlah = parseInt(input.value) || 0;
                const harga = parseInt(input.getAttribute('data-harga'));
                totalHarga += jumlah * harga;
            });
            totalHargaInput.value = formatRupiah(totalHarga);

            const uangBayar = parseInt(uangBayarInput.value) || 0;
            const kembalian = uangBayar - totalHarga;
            kembalianInput.value = formatRupiah(kembalian < 0 ? 0 : kembalian);
        }
    </script>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
