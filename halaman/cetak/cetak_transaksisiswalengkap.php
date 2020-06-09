<?php
session_start();
require "../../library/Config.php";
require "../../library/Database.php";
require "../../library/Utility.php";
$config = new Config();
$database = new Database();
$utility = new Utility();
$detail_transaksi = $database->sqlQuery('SELECT * FROM tbl_sewa WHERE ID_TRANSAKSI='.$_GET['id_transaksi'], TRUE);
$detail_siswa = $database->sqlQuery('SELECT * FROM tbl_anggota WHERE ID_SISWA='.$detail_transaksi->ID_SISWA, TRUE);
?>
<h1 style="text-align: center">Detail Sewa <?php echo $detail_transaksi->ID_TRANSAKSI; ?></h1>
<body onload="window.print()">
<table width="100%">
	<tr>
		<td>
			<h3 style="margin-bottom: 5px">Informasi Sewa</h3>
			<span style="margin: 0">Tanggal Sewa</span>
			<p style="margin: 0;font-weight: bold;"><?php echo $detail_transaksi->TGL_SEWA; ?></p>
			<div style="margin-bottom: 5px"></div>
			<span style="margin: 0">Waktu Sewa</span>
			<p style="margin: 0;font-weight: bold;"><?php echo $detail_transaksi->WKT_SEWA; ?></p>
		</td>
		<td>
			<h3 style="margin-bottom: 5px">Informasi Kembali</h3>
			<span style="margin: 0">Tanggal Ambil</span>
			<p style="margin: 0;font-weight: bold;"><?php if($detail_transaksi->TGL_AMBIL != NULL) echo $detail_transaksi->TGL_AMBIL;else echo '-'; ?></p>
			<div style="margin-bottom: 5px"></div>
			<span style="margin: 0">Tanggal Kembali</span>
			<p style="margin: 0;font-weight: bold;"><?php if($detail_transaksi->TGL_KEMBALI != NULL) echo $detail_transaksi->TGL_KEMBALI;else echo '-'; ?></p>
		</td>
		<td>
			<h3 style="margin-bottom: 5px">Denda</h3>
			<span style="margin: 0">Terlambat</span>
			<p style="margin: 0;font-weight: bold;">
				<?php
					if($detail_transaksi->TGL_KEMBALI != '' and $detail_transaksi->TGL_AMBIL != ''){
						$selisih = $utility->selisihTanggal("$detail_transaksi->TGL_AMBIL", "$detail_transaksi->TGL_KEMBALI");
						$hari = $selisih;
						$keterlambatan = $selisih - 3;
						if($keterlambatan >= 0){
							$dendanya = 3500;
							$denda = $dendanya * $keterlambatan;
						}
						elseif($keterlambatan <= 0){
							$denda = 0;
							$keterlambatan = 0;
						}
					}
					else{
						$keterlambatan = 0;
						$denda = 0;
					}
				?>
				<?= $keterlambatan ?> Hari
			</p>
			<div style="margin-bottom: 5px"></div>
			<span style="margin: 0">Harga Denda</span>
			<p style="margin: 0;font-weight: bold;"><?= $denda ?></p>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td>
			<h3 style="margin-bottom: 5px">Informasi Siswa</h3>
			<span style="margin: 0">NIS</span>
			<p style="margin: 0;font-weight: bold;"><?= $detail_siswa->NIS ?></p>
			<div style="margin-bottom: 5px"></div>
			<span style="margin: 0">Nama</span>
			<p style="margin: 0;font-weight: bold;"><?= $detail_siswa->NAMA_SISWA ?></p>
		</td>
	</tr>
</table>
<div style="margin-bottom: 15px">
	<table width="100%" border="1" style="border-collapse: collapse;">
		<tr>
			<th>ISBN</th>
			<th>Nama Buku</th>
			<th width="10%">QTY</th>
		</tr>
		<tr>
			<?php
				$data_keranjang = $database->sqlQuery('SELECT * FROM tbl_keranjangsewa WHERE ID_TRANSAKSI="'.$detail_transaksi->ID_TRANSAKSI.'"');
				if($data_keranjang):
				$qty = 0;
				$a = 1;
			?>
			<?php foreach($data_keranjang as $data_keranjang):
				$detail_buku = $database->sqlQuery('SELECT * FROM tbl_buku WHERE ID_BUKU='.$data_keranjang->ID_BUKU, TRUE);
			?>
			<tr>
				<td><?= $detail_buku->ISBN ?></td>
				<td><?= $detail_buku->NM_BUKU ?></td>
				<td><?php $qty = $qty + $data_keranjang->QTY;echo $data_keranjang->QTY ?></td>
			</tr>
			<?php $a++;endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="4">Tidak ada buku yang disewa, silahkan pilih buku <a href="<?= $config->baseUrl('indexsiswa.php?p=siswa_bankbuku/index'); ?>">disini</a>.</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td colspan="2" style="text-align: right">
					<b>Total Buku</b>
				</td>
				<td>
					<?= $qty ?>
				</td>
			</tr>
		</tr>
	</table>
</div>
</body>