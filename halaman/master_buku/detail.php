<?php
$id = $_GET['id'];
$buku = $database->sqlQuery('SELECT * FROM tbl_buku WHERE ID_BUKU='.$id, TRUE);
?>
<h5>Detail Buku <?= $buku->NM_BUKU ?></h5>
 <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'edit'){
			require_once('halaman/material/edit_msg.php');
		}
		if($_GET['sts'] == 'duplicate-data'){
			echo '<div class="alert alert-danger">
					ISBN Sudah terdaftar di database.
				</div>';
		}
	}
?>
<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id_buku" value="<?= $buku->ID_BUKU ?>"/>
      <div class="row">
		<div class="col s4">
	<div class="form-group">
		<h5>Gambar</h5>
		<?php
			if($buku->GAMBAR != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/buku/'.$buku->GAMBAR) ?>" width="200px"/>
        <?php endif; ?>
	</div>
      </div>
		<div class="col s8">
			<h5>Deskripsi Buku</h5>
			<p style="margin: 0;text-align: justify;"><?= $buku->DES_BUKU ?></p>
		</div>
	</div>
      <h5>Informasi Buku</h5>
      <div class="row">
      
      	<div class="col s6">
      		
	<div class="form-group">
		<label>No. ISBN</label>
		<p style="margin: 0"><?= $buku->ISBN ?></p>
	</div>
	<div class="form-group">
		<label>Nama Buku</label>
		<p style="margin: 0"><?= $buku->NM_BUKU ?></p>
	</div>
	<div class="form-group">
		<label>Stok</label>
		<p style="margin: 0"><?= $buku->STOK ?></p>
	</div>
	<div class="form-group">
		<label>Penerbit</label>
		<?php $penerbit = $database->sqlQuery('SELECT * FROM tbl_penerbit WHERE ID_PENERBIT='.$buku->ID_PENERBIT, TRUE); ?>
		<p style="margin: 0"><?= $penerbit->NAMA_PENERBIT; ?></p>
	</div>
	<div class="form-group">
		<label>Penulis</label>
		<?php $penulis = $database->sqlQuery('SELECT * FROM tbl_penulis WHERE ID_PENULIS='.$buku->ID_PENULIS, TRUE); ?>
		<p style="margin: 0"><?= $penulis->NAMA_PENULIS; ?></p>
	</div>
      	</div>
    <div class="col s6">
      	
	<div class="form-group">
		<?php $rakbuku = $database->sqlQuery('SELECT * FROM tbl_rakbuku WHERE ID_RAKBUKU='.$buku->ID_RAKBUKU, TRUE); ?>
		<label>Rak Buku</label>
		<p style="margin: 0"><?= $rakbuku->NAMA_RAKBUKU; ?></p>
	</div>
	<div class="form-group">
		<label>Status <span style="color:red"></span></label>
        <p style="margin: 0"><?= ($buku->STS_PUBLISH == 1 ? "Publish" : "Draft") ?></p>
	</div>
	<div class="form-group">
	<label>E-Book</label>
	<?php
		if($buku->EBOOK != ''):
	?>
	<div class="form-group">
	<a href="<?php echo $config->baseUrl('assets/img/ebook/download.php?file='.$utility->base64_encode_fix($buku->EBOOK)) ?>"><?php echo $buku->EBOOK ?></a>
	</div>
	<?php else: ?>
	<p style="margin: 0">Tidak ada file ditemukan.</p>
	<?php endif; ?>
	</div>
	
      	</div>
	</div>
		<a href="<?php echo $config->baseUrl("?p=master_buku/edit&id=".$buku->ID_BUKU) ?>" class="waves-effect waves-light btn light-blue darken-1">Edit</a>
		<a href="<?php echo $config->baseUrl('?p=master_buku/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
		<script>
			$(document).ready(function() {
    $('select').material_select();
});
		</script>