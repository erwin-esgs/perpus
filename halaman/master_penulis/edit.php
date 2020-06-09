<?php
$id = $_GET['id'];
$penulis = $database->sqlQuery('SELECT * FROM tbl_penulis WHERE ID_PENULIS='.$id, TRUE);
?>
<h5>Edit Penulis <?= $penulis->NAMA_PENULIS ?></h5>
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
		<input type="hidden" name="nama_penulis_sekarang" value="<?= $penulis->NAMA_PENULIS ?>"/>
		<input type="text" name="nama_penulis" value="<?= $penulis->NAMA_PENULIS ?>" required/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" value="<?= $penulis->EMAIL ?>"/>
	</div>
	<div class="form-group">
		<label>No Telp</label>
		<input type="text" name="no_telp" value="<?= $penulis->NO_TELP ?>" class="cumaangka"/>
	</div>
	<div class="form-group">
		<label>Website</label>
		<input type="text" name="website" placeholder="http://example.com" value="<?= $penulis->WEBSITE ?>"/>
	</div>
	<div class="form-group">
		<h6>Gambar</h6>
		<?php
			if($penulis->FOTO != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/penulis/'.$penulis->FOTO) ?>" width="200px"/>
        <?php endif; ?><br/>
        <input type="file" name="gambar"><br/>
    	<span style="font-size: 12px;color:#ccc">Kosongi jika tidak ingin mengganti foto</span>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="materialize-textarea" name="alamat"><?= $penulis->ALAMAT ?></textarea>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Perbaharui Informasi">
		<a href="<?php echo $config->baseUrl('?p=master_penulis/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
		<?php
if($_POST){
$id_penulis = $_POST['id_penulis'];
$nama_penulis = $_POST['nama_penulis'];
// Validasi Nama Penerbit
if($_POST['nama_penulis_sekarang'] != $_POST['nama_penulis']){
	$data_nama_penerbit = $database->sqlQuery('SELECT NAMA_PENULIS FROM tbl_penulis WHERE NAMA_PENULIS="'.$nama_penulis.'"',TRUE);
	if($data_nama_penerbit){
		$config->redirectUrl('?p=master_penulis/edit&id='.$id_penulis.'&sts=duplicate-data');
		exit();
	}
}
$target_penulis = 'assets/img/penulis/';
$data_foto = $database->sqlQuery('SELECT FOTO FROM tbl_penulis WHERE ID_PENULIS='.$id_penulis,TRUE);
if(!empty($_FILES['gambar']['tmp_name'])){
	if($data_foto){
		unlink($target_penulis.$data_foto->FOTO);
	}
	$sumber = $_FILES['gambar']['tmp_name'];
	$nama_foto = $_FILES['gambar']['name'];
	if(!move_uploaded_file($sumber, $target_penulis.$nama_foto)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_foto = $data_foto->FOTO;
}
$data_update = array(
	"NAMA_PENULIS" => $utility->filterInput($_POST['nama_penulis']),
	"EMAIL" => $_POST['email'],
	"NO_TELP" => $utility->filterInput($_POST['no_telp']),
	"FOTO" => $nama_foto,
	"ALAMAT" => $_POST['alamat'],
	"WEBSITE" => $_POST['website']
);
$where = array(
	"ID_PENULIS" => $id_penulis
);
$database->update('tbl_penulis',$data_update,$where);
$config->redirectUrl('?p=master_penulis/edit&id='.$id_penulis.'&sts=edit');
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