<?php
$id = $_GET['id'];
$buku = $database->sqlQuery('SELECT * FROM tbl_buku WHERE ID_BUKU='.$id, TRUE);
?>
<h5>Edit Buku <?= $buku->NM_BUKU ?></h5>
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
      	<div class="col s6">
      		
	<div class="form-group">
		<label>No. ISBN</label>
		<input type="hidden" name="isbn_sekarang" value="<?= $buku->ISBN ?>"/>
		<input type="text" name="isbn" value="<?= $buku->ISBN ?>" class="cumaangka" required/>
	</div>
	<div class="form-group">
		<label>Nama Buku</label>
		<input type="text" name="nm_buku" value="<?= $buku->NM_BUKU ?>" required/>
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" name="stok" value="<?= $buku->STOK ?>" required/>
	</div>
	<div class="form-group">
		<?php $penerbit = $database->sqlQuery('SELECT * FROM tbl_penerbit'); ?>
		<label>Penerbit <span style="color:red"></span></label>
        <select name="id_penerbit" required>
			<?php foreach($penerbit as $penerbit): ?>
			<option value="<?php echo $penerbit->ID_PENERBIT ?>"  <?php if($penerbit->ID_PENERBIT == $buku->ID_PENERBIT) echo 'selected'; ?>><?php echo $penerbit->NAMA_PENERBIT ?></option>
			<?php endforeach; ?>
        </select>
	</div>
	<div class="form-group">
		<?php $penulis = $database->sqlQuery('SELECT * FROM tbl_penulis'); ?>
		<label>Penulis <span style="color:red"></span></label>
        <select name="id_penulis" required>
			<?php foreach($penulis as $penulis): ?>
			<option value="<?php echo $penulis->ID_PENULIS ?>" <?php if($penulis->ID_PENULIS == $buku->ID_PENULIS) echo 'selected'; ?>><?php echo $penulis->NAMA_PENULIS ?></option>
			<?php endforeach; ?>
        </select>
	</div>
      	</div>
    <div class="col s6">
      	
	<div class="form-group">
		<?php $rakbuku = $database->sqlQuery('SELECT * FROM tbl_rakbuku'); ?>
		<label>Rak Buku <span style="color:red"></span></label>
        <select name="id_rakbuku" required>
			<?php foreach($rakbuku as $rakbuku): ?>
			<option value="<?php echo $rakbuku->ID_RAKBUKU ?>" <?php if($rakbuku->ID_RAKBUKU == $buku->ID_RAKBUKU) echo 'selected'; ?>><?php echo $rakbuku->NAMA_RAKBUKU ?></option>
			<?php endforeach; ?>
        </select>
	</div>
	<div class="form-group">
		<label>Status <span style="color:red"></span></label>
        <select name="sts_publish" required>
			<option value="1" <?php if($buku->STS_PUBLISH == 1) echo 'selected'; ?>>Publish</option>
			<option value="0" <?php if($buku->STS_PUBLISH == 0) echo 'selected'; ?>>Draft</option>
		</select>
	</div>
	<div class="form-group">
	<h6>E-book</h6>
	<?php
		if($buku->EBOOK != ''):
	?>
	<div class="form-group">
	<a href="<?php echo $config->baseUrl('assets/img/ebook/download.php?file='.$utility->base64_encode_fix($buku->EBOOK)) ?>"><?php echo $buku->EBOOK ?></a>
	</div>
	<?php endif; ?>
	<input type="file" name="ebook">
	<p style="font-size: 12px;color:#ccc;margin:0">Kosongi jika tidak ingin mengganti buku</p>
	</div>
	<div class="form-group">
		<h6>Gambar</h6>
		<?php
			if($buku->GAMBAR != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/buku/'.$buku->GAMBAR) ?>" width="200px"/>
        <?php endif; ?>
		<input type="file" name="gambar">
    	<p style="font-size: 12px;color:#ccc;margin:0">Kosongi jika tidak ingin mengganti gambar</p>
	</div>
	<div class="form-group">
		<label>Deskripsi Buku</label>
		<textarea class="materialize-textarea" name="des_buku"><?= $buku->DES_BUKU ?></textarea>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Perbaharui Informasi">
		<a href="<?php echo $config->baseUrl('?p=master_buku/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
		<?php
if($_POST){
$id_buku = $_POST['id_buku'];
$isbn = $_POST['isbn'];
// Validasi ISBN
if($_POST['isbn_sekarang'] != $_POST['isbn']){
	$data_no_isbn = $database->sqlQuery('SELECT ISBN FROM tbl_buku WHERE ISBN='.$isbn,TRUE);
	if($data_no_isbn){
		$config->redirectUrl('?p=master_buku/edit&id='.$id_buku.'&sts=duplicate-data');
		exit();
	}
}
$target_ebook = 'assets/img/ebook/';
// Untuk ebook
$data_ebook = $database->sqlQuery('SELECT EBOOK FROM tbl_buku WHERE ID_BUKU='.$id_buku,TRUE);
if(!empty($_FILES['ebook']['tmp_name'])){
	if($data_ebook){	
		unlink($target_ebook.$data_ebook->EBOOK);
	}
	$sumber = $_FILES['ebook']['tmp_name'];
	$nama_ebook = $_FILES['ebook']['name'];
	if(!move_uploaded_file($sumber, $target_ebook.$nama_ebook)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_ebook = $data_ebook->EBOOK;
}
$target_gambar = 'assets/img/buku/';
$data_gambar = $database->sqlQuery('SELECT GAMBAR FROM tbl_buku WHERE ID_BUKU='.$id_buku,TRUE);
if(!empty($_FILES['gambar']['tmp_name'])){
	if($data_gambar){
		unlink($target_gambar.$data_gambar->GAMBAR);
	}
	$sumber = $_FILES['gambar']['tmp_name'];
	$nama_gambar = $_FILES['gambar']['name'];
	if(!move_uploaded_file($sumber, $target_gambar.$nama_gambar)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_gambar = $data_gambar->GAMBAR;
}
$data_update = array(
	"ISBN" => $utility->filterInput($_POST['isbn']),
	"NM_BUKU" => $_POST['nm_buku'],
	"DES_BUKU" => $utility->filterInput($_POST['des_buku']),
	"STOK" => $_POST['stok'],
	"ID_PENERBIT" => $utility->filterInput($_POST['id_penerbit']),
	"ID_PENULIS" => $utility->filterInput($_POST['id_penulis']),
	"ID_RAKBUKU" => $utility->filterInput($_POST['id_rakbuku']),
	"EBOOK" => $nama_ebook,
	"GAMBAR" => $nama_gambar,
	"STS_PUBLISH" => $_POST['sts_publish']
	
);
$where = array(
	"ID_BUKU" => $id_buku
);
$database->update('tbl_buku',$data_update,$where);
$config->redirectUrl('?p=master_buku/edit&id='.$id_buku.'&sts=edit');
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