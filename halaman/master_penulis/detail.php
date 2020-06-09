<?php
$id = $_GET['id'];
$penulis = $database->sqlQuery('SELECT * FROM tbl_penulis WHERE ID_PENULIS='.$id, TRUE);
?>
<h5>Detail Penulis <?= $penulis->NAMA_PENULIS ?></h5>
 <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'edit'){
			require_once('halaman/material/edit_msg.php');
		}
		if($_GET['sts'] == 'duplicate-data'){
			echo '<div class="alert alert-danger">
					Nama Penulis sudah terdaftar di database.
				</div>';
		}
	}
?>
<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id_penulis" value="<?= $penulis->ID_PENULIS ?>"/>
      <div class="row">
      	<div class="col s12">
      		
	<div class="form-group">
		<label>Nama Penerbit</label>
		<p style="margin: 0"><?= $penulis->NAMA_PENULIS ?></p>
	</div>
	<div class="form-group">
		<label>Email</label>
		<p style="margin: 0"><?= ($penulis->EMAIL != '' ? $penulis->EMAIL : "-") ?></p>
	</div>
	<div class="form-group">
		<label>No Telp</label>
		<p style="margin: 0"><?= ($penulis->NO_TELP != '' ? $penulis->NO_TELP : "-") ?></p>
	</div>
	<div class="form-group">
		<label>Website</label>
		<p style="margin: 0"><?= ($penulis->WEBSITE != '' ? $penulis->WEBSITE : "-") ?></p>
	</div>
	<div class="form-group">
		<label>Website</label>
		<?php
			if($penulis->FOTO != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/penulis/'.$penulis->FOTO) ?>" width="200px"/>
		<?php else: ?>
		<p style="margin: 0">Tidak ada gambar.</p>
        <?php endif; ?><br/>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<p style="margin: 0"><?= ($penulis->ALAMAT != '' ? $penulis->ALAMAT : "-") ?></p>
	</div>
      	</div>
      </div>
		<a href="<?php echo $config->baseUrl("?p=master_penulis/edit&id=".$penulis->ID_PENULIS) ?>" class="waves-effect waves-light btn light-blue darken-1">Edit</a>
		<a href="<?php echo $config->baseUrl('?p=master_penulis/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>