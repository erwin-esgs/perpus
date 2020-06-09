<?php
$detail_transaksi = $database->sqlQuery('SELECT * FROM tbl_sewa WHERE ID_TRANSAKSI='.$_GET['id_transaksi'], TRUE);
?>
<h5>Detail peminjaman <?php echo $detail_transaksi->ID_TRANSAKSI; ?></h5>
<div class="card-panel">
	<div class="row">
		<div class="col s4">
			<h6><i class="fa fa-info-circle"></i> Informasi Sewa</h6>
			<div class="form-group">
				<label>Tanggal Sewa</label>
				<p style="margin:0"><?php echo $detail_transaksi->TGL_SEWA; ?></p>
			</div>
			<div class="form-group">
				<label>Waktu Sewa</label>
				<p style="margin:0"><?php echo $detail_transaksi->WKT_SEWA; ?></p>
			</div>
		</div>
		<div class="col s4">
			<h6><i class="fa fa-calendar"></i> Informasi Kembali</h6>
			<div class="form-group">
				<label>Tanggal Ambil</label>
				<p style="margin:0"><?php if($detail_transaksi->TGL_AMBIL != NULL) echo $detail_transaksi->TGL_AMBIL;else echo '-'; ?></p>
			</div>
			<div class="form-group">
				<label>Tanggal Kembali</label>
				<p style="margin:0"><?php if($detail_transaksi->TGL_KEMBALI != NULL) echo $detail_transaksi->TGL_KEMBALI;else echo '-'; ?></p>
			</div>
		</div>
		<div class="col sm4">
			<h6><i class="fa fa-info-circle"></i> Denda</h6>
			<div class="form-group">
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
				<label>Terlambat</label>
				<p style="margin:0"><?= $keterlambatan ?> Hari</p>
			</div>
			<div class="form-group">
				<label>Harga Denda</label>
				<p style="margin:0"><?= $denda ?></p>
			</div>
		</div>
	</div>
	<h6><i class="fa fa-book"></i> Buku yang dipinjam</h6>
	<table class="highlight bordered" style="margin-bottom: 10px">
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
				<td><a href="<?= $config->baseUrl('indexsiswa.php?p=siswa_bankbuku/lihat&id='.$data_keranjang->ID_BUKU) ?>"><?= $detail_buku->ISBN ?></a></td>
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
	<div style="color:red;margin-bottom: 10px">Denda akan dikenakan setelah 3 hari menyewa dengan harga Rp. 3500</div>
	<a onclick="window.open('<?php echo $config->baseUrl('halaman/cetak/cetak_transaksisiswa.php?id_transaksi='.$detail_transaksi->ID_TRANSAKSI) ?>', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');" href="#" class="waves-effect waves-light btn light-blue darken-1"><i class="fa fa-print"></i> Cetak</a>
	<a href="<?= $config->baseUrl('indexsiswa.php?p=siswa_detailtrans/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</div>