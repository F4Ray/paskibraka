<?php
if (!$_GET) {
    echo "kwitansi tidak ditemukan";
    die();
}
$hargaSemua = $_GET['harga']*$_GET['jumlah'];
?>
<html>
	<head>
		<style>
			.table_footer{border:none;text-align:right;}
		</style>
	</head>
	
	<body onload="window.print()" onclick="window.close()">
		<table border=1 width="700px" align="center">
			<tr>
				<th colspan=5>
					<h2>Toko Gadget Hijau Klorofil</h2>
					<h3>Kode Transaksi : <?= $_GET['kode'] ?></h3>
					<b>Tanggal : </b> <?= $_GET['tanggal'] ?> <br/>
					<b>Nama Kasir : </b> <?= $_GET['namakasir'] ?>
				</th>
			</tr>
			<tr style="text-align:center;">
				<td><b>Nama Barang</b></td>
				<td><b>Jenis Transaksi</b></td>
				<td><b>Harga</b></td>
				<td><b>Jumlah Barang</b></td>
				<td><b>Total</b></td>
			</tr>
			<tr>
				<td>
                <?= $_GET['nama'] ?>
				</td>
				<td>
            <?= $_GET['jenis'] ?>
				</td>
				<td>
                <?= number_format($_GET['harga'], 0, ".", ".") ?>
				</td>
				<td>
                <?= $_GET['jumlah'] ?>
				</td>
				<td>
                <?= number_format($hargaSemua, 0, ".", ".")  ?>
				</td>
			</tr>
			
			<tr><td class="table_footer" colspan=5><b>Total : </b><?= number_format($hargaSemua, 0, ".", ".")  ?></td></tr>
			
		
		</table>
	</body>
</html>