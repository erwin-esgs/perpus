<?php
$id = $_GET['id'];
$buku = $database->sqlQuery('SELECT * FROM tbl_buku WHERE ID_BUKU='.$id, TRUE);
?>
<h5><?= $buku->NM_BUKU ?></h5>
<div class="card-panel">
	<div class="row">
		<div class="col s4">
			<?php
				if($buku->GAMBAR != ''):
			?>
			<img src="<?php echo $config->baseUrl('assets/img/buku/'.$buku->GAMBAR) ?>" width="200px"/>
	        <?php endif; ?>
		</div>
		<div class="col s8">
			<table class="striped" width="100%">
				<tr>
					<td><b>ISBN</b></td>
					<td><?= $buku->ISBN ?></td>
				</tr>
				<tr>
					<td><b>Nama Buku</b></td>
					<td><?= $buku->NM_BUKU ?></td>
				</tr>
				<tr>
					<td><b>Waktu Posting</b></td>
					<td><?= $buku->TGL_POST.' '.$buku->WKT_POST ?></td>
				</tr>
				<tr>
					<td><b>Stok</b></td>
					<td><?= $buku->STOK ?></td>
				</tr>
				<tr>
					<td><b>Penerbit</b></td>
					<td>
						<?php
							$penerbit = $database->sqlQuery('SELECT * FROM tbl_penerbit WHERE ID_PENERBIT='.$buku->ID_PENERBIT,TRUE);
							echo $penerbit->NAMA_PENERBIT;
						?>
					</td>
				</tr>
				<tr>
					<td><b>Penulis</b></td>
					<td>
						<?php
							$penulis = $database->sqlQuery('SELECT * FROM tbl_penulis WHERE ID_PENULIS='.$buku->ID_PENULIS,TRUE);
							echo $penulis->NAMA_PENULIS;
						?>
					</td>
				</tr>
				<tr>
					<td><b>Rak Buku</b></td>
					<td>
						<?php
							$rakbuku = $database->sqlQuery('SELECT * FROM tbl_rakbuku WHERE ID_RAKBUKU='.$buku->ID_RAKBUKU,TRUE);
							echo $rakbuku->NAMA_RAKBUKU;
						?>
					</td>
				</tr>
				<tr>
					<td><b>E-book</b></td>
					<td>
						<?php
							if($buku->EBOOK != ''):
						?>
						<a href=""><?php echo $buku->EBOOK ?></a>
						<?php
							else:
						?>
						-
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"><b>Deskripsi</b></td>
				</tr>
				<tr>
					<td colspan=2>
						<?php
							echo $buku->DES_BUKU;
						?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<a class="waves-effect waves-light btn btn-sm" href="<?php echo $config->baseUrl('indexsiswa.php?p=siswa_sewa/cart&id_buku='.$buku->ID_BUKU) ?>">Booking</a>
              <a href="<?php echo $config->baseUrl('indexsiswa.php?p=siswa_bankbuku/index') ?>" class="waves-effect waves-light btn light-blue darken-1 btn-sm">Kembali</a>
</div>