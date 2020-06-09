<?php
$id = $_GET['id'];
$penerbit = $database->sqlQuery('SELECT * FROM tbl_penerbit WHERE ID_PENERBIT='.$id, TRUE);
?>
<h5>Edit Penerbit <?= $penerbit->NAMA_PENERBIT ?></h5>
 <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'edit'){
			require_once('halaman/material/edit_msg.php');
		}
		if($_GET['sts'] == 'duplicate-data'){
			echo '<div class="alert alert-danger">
					Nama Penerbit sudah terdaftar di database.
				</div>';
		}
	}
?>
<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id_penerbit" value="<?= $penerbit->ID_PENERBIT ?>"/>
      <div class="row">
      	<div class="col s12">
      		
	<div class="form-group">
		<label>Nama Penerbit</label>
		<input type="hidden" name="nama_penerbit_sekarang" value="<?= $penerbit->NAMA_PENERBIT ?>"/>
		<input type="text" name="nama_penerbit" value="<?= $penerbit->NAMA_PENERBIT ?>" required/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" value="<?= $penerbit->EMAIL ?>"/>
	</div>
	<div class="form-group">
		<label>No Telp</label>
		<input type="text" name="no_telp" value="<?= $penerbit->NO_TELP ?>" class="cumaangka"/>
	</div>
	<div class="form-group">
		<label>Website</label>
		<input type="text" name="website" placeholder="http://example.com" value="<?= $penerbit->WEBSITE ?>"/>
	</div>
	<div class="form-group">
		<h6>Gambar</h6>
		<?php
			if($penerbit->FOTO != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/penerbit/'.$penerbit->FOTO) ?>" width="200px"/>
        <?php endif; ?><br/>
        <input type="file" name="gambar"><br/>
    	<span style="font-size: 12px;color:#ccc">Kosongi jika tidak ingin mengganti foto</span>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="materialize-textarea" name="alamat"><?= $penerbit->ALAMAT ?></textarea>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Perbaharui Informasi">
		<a href="<?php echo $config->baseUrl('?p=master_penerbit/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
		<?php
if($_POST){
$id_penerbit = $_POST['id_penerbit'];
$nama_penerbit = $_POST['nama_penerbit'];
// Validasi Nama Penerbit
if($_POST['nama_penerbit_sekarang'] != $_POST['nama_penerbit']){
	$data_nama_penerbit = $database->sqlQuery('SELECT NAMA_PENERBIT FROM tbl_penerbit WHERE NAMA_PENERBIT="'.$nama_penerbit.'"',TRUE);
	if($data_nama_penerbit){
		$config->redirectUrl('?p=master_penerbit/edit&id='.$id_penerbit.'&sts=duplicate-data');
		exit();
	}
}
$target_penerbit = 'assets/img/penerbit/';
$data_foto = $database->sqlQuery('SELECT FOTO FROM tbl_penerbit WHERE ID_PENERBIT='.$id_penerbit,TRUE);
if(!empty($_FILES['gambar']['tmp_name'])){
	if($data_foto){
		unlink($target_penerbit.$data_foto->FOTO);
	}
	$sumber = $_FILES['gambar']['tmp_name'];
	$nama_foto = $_FILES['gambar']['name'];
	if(!move_uploaded_file($sumber, $target_penerbit.$nama_foto)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_foto = $data_foto->FOTO;
}
$data_update = array(
	"NAMA_PENERBIT" => $utility->filterInput($_POST['nama_penerbit']),
	"EMAIL" => $_POST['email'],
	"NO_TELP" => $utility->filterInput($_POST['no_telp']),
	"FOTO" => $nama_foto,
	"ALAMAT" => $_POST['alamat'],
	"WEBSITE" => $_POST['website']
);
$where = array(
	"ID_PENERBIT" => $id_penerbit
);
$database->update('tbl_penerbit',$data_update,$where);
$config->redirectUrl('?p=master_penerbit/edit&id='.$id_penerbit.'&sts=edit');
}
?>
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