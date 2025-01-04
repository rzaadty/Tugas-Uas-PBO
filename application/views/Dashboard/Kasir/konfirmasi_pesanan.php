<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Konfirmasi Pesanan</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}

		.container {
			width: 80%;
			margin: 0 auto;
		}

		.header {
			text-align: center;
			margin-bottom: 20px;
		}

		.header h1 {
			margin: 0;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		.table th,
		.table td {
			border: 1px solid #ccc;
			padding: 10px;
			text-align: left;
		}

		.table th {
			background-color: #f2f2f2;
		}

		.total {
			font-size: 18px;
			font-weight: bold;
			text-align: right;
		}

		.print-btn {
			display: block;
			width: 100%;
			padding: 10px;
			background-color: #28a745;
			color: white;
			text-align: center;
			text-decoration: none;
			font-size: 16px;
			border-radius: 5px;
		}

		.print-btn:hover {
			background-color: #218838;
		}

	</style>
	<script>
		function printStruk() {
			window.print();
		}

	</script>
</head>

<body>
	<div class="container">
		<div class="header">
			<h1>Konfirmasi Pesanan</h1>
			<p>Tanggal: <?= date('d-m-Y H:i:s') ?></p>
		</div>

		<h3>Detail Pesanan</h3>
		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Harga Satuan</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                $no = 1; 
                $total_harga = 0;
                foreach ($detail_pesanan as $item): 
                    $subtotal = $item['jumlah'] * $item['harga_jual'];
                    $total_harga += $subtotal;
                ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $item['nama_barang'] ?></td>
					<td><?= $item['jumlah'] ?></td>
					<td><?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
					<td><?= number_format($subtotal, 0, ',', '.') ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<p class="total">Total Harga: Rp <?= number_format($total_harga, 0, ',', '.') ?></p>
		<p>
			Uang Bayar:
			<?php 
    echo isset($detail_pesanan[0]['uang_bayar']) ? 'Rp ' . number_format($detail_pesanan[0]['uang_bayar'], 0, ',', '.') : 'N/A'; 
    ?>
		</p>
		<p>
			Kembalian:
			<?php 
    echo isset($detail_pesanan[0]['kembalian']) ? 'Rp ' . number_format($detail_pesanan[0]['kembalian'], 0, ',', '.') : 'N/A'; 
    ?>
		</p>

		<div class="row">
			<div class="col-6"><a href="#" class="print-btn" onclick="printStruk()">Cetak Struk</a></div>
			<div class="col-6"><a href="#" class="print-btn"
					onclick="window.location.href='<?php echo site_url('Dashboard'); ?>'">Selesai</a></div>
		</div>



	</div>
</body>

</html>
