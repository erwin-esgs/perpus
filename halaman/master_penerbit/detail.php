<?php
$id = $_GET['id'];
$penerbit = $database->sqlQuery('SELECT * FROM tbl_penerbit WHERE ID_PENERBIT='.$id, TRUE);
?>
<h5>Detail Penerbit <?= $penerbit->NAMA_PENERBIT ?></h5>

<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id_penerbit" value="<?= $penerbit->ID_PENERBIT ?>"/>
      <div class="row">
      	<div class="col s12">
      		
	<div class="form-group">
		<label>Nama Penerbit</label>
		<input type="hidden" name="nama_penerbit_sekarang" value="<?= $penerbit->NAMA_PENERBIT ?>"/>
		<p style="margin: 0"><?= $penerbit->NAMA_PENERBIT ?></p>
	</div>
	<div class="form-group">
		<label>Email</label>
		<p style="margin: 0"><?= $penerbit->EMAIL ?></p>
	</div>
	<div class="form-group">
		<label>No Telp</label>
		<p style="margin: 0"><?= $penerbit->NO_TELP ?></p>
	</div>
	<div class="form-group">
		<label>Website</label>
		<p style="margin: 0"><?= $penerbit->WEBSITE ?></p>
	</div>
	<div class="form-group">
		<h6>Gambar</h6>
		<?php
			if($penerbit->FOTO != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/penerbit/'.$penerbit->FOTO) ?>" width="200px"/>
		<?php else: ?>
		Tidak ada foto
        <?php endif; ?>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<?php
			if($penerbit->ALAMAT != ''):
		?>
		<p style="margin: 0"><?= $penerbit->ALAMAT ?></p>
		<?php else: ?>
		<p style="margin: 0">-</p>
        <?php endif; ?>
	</div>
      	</div>
      </div>
      <a href="<?php echo $config->baseUrl("?p=master_penerbit/edit&id=".$penerbit->ID_PENERBIT) ?>" class="waves-effect waves-light btn light-blue darken-1">Edit</a>
		<a href="<?php echo $config->baseUrl('?p=master_penerbit/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
		
		<script>
$(document).ready(function() {
    $('select').material_select();
    $('.cumahuruf').bind('keyup blur',function(){ 
		var node = $(this);
	node.val(node.val().replace(/[^a-zA-Z -]+/,'') ); }
	);
	$('.cumaangka').bind('keyup blur',function(){ 
		var node = $(this);
		node.val(node.val().replace(/[^0-9 @]+/,'') ); }
	);
  });
</script>