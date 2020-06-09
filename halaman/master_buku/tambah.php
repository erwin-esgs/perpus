<h5>Tambah Buku</h5>
      <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'success'){
			require_once('halaman/material/success_msg.php');
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
      <div class="row">
      	<div class="col s6">
      		
	<div class="form-group">
		<label>No. ISBN</label>
		<input type="text" name="isbn" class="cumaangka" required/>
	</div>
	<div class="form-group">
		<label>Nama Buku</label>
		<input type="text" name="nm_buku" required/>
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" name="stok" required/>
	</div>
	<div class="form-group">
		<?php $penerbit = $database->sqlQuery('SELECT * FROM tbl_penerbit'); ?>
		<label>Penerbit <span style="color:red"></span></label>
        <select name="id_penerbit" required>
			<?php foreach($penerbit as $penerbit): ?>
			<option value="<?php echo $penerbit->ID_PENERBIT ?>"><?php echo $penerbit->NAMA_PENERBIT ?></option>
			<?php endforeach; ?>
        </select>
	</div>
	<div class="form-group">
		<?php $penulis = $database->sqlQuery('SELECT * FROM tbl_penulis'); ?>
		<label>Penulis <span style="color:red"></span></label>
        <select name="id_penulis" required>
			<?php foreach($penulis as $penulis): ?>
			<option value="<?php echo $penulis->ID_PENULIS ?>"><?php echo $penulis->NAMA_PENULIS ?></option>
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
			<option value="<?php echo $rakbuku->ID_RAKBUKU ?>"><?php echo $rakbuku->NAMA_RAKBUKU ?></option>
			<?php endforeach; ?>
        </select>
	</div>
	<div class="form-group">
		<?php $rakbuku = $database->sqlQuery('SELECT * FROM tbl_rakbuku'); ?>
		<label>Status <span style="color:red"></span></label>
        <select name="sts_publish" required>
			<option value="1">Publish</option>
			<option value="0">Draft</option>
		</select>
	</div>
	<div class="form-group">
	<h6>E-book</h6>
    <input type="file" name="ebook">
    <span style="font-size: 12px;color:#ccc">Kosongi jika tidak e-book buku</span>
	</div>
	<div class="form-group">
		<h6>Gambar</h6>
        <input type="file" name="gambar">
    	<span style="font-size: 12px;color:#ccc">Kosongi jika tidak gambar buku</span>
	</div>
	<div class="form-group">
		<label>Deskripsi Buku</label>
		<textarea class="materialize-textarea" name="des_buku"></textarea>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Tambah">
		<a href="<?php echo $config->baseUrl('?p=master_buku/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
<?php
if($_POST){
$isbn = $_POST['isbn'];
$data_no_isbn = $database->sqlQuery('SELECT ISBN FROM tbl_buku WHERE ISBN='.$isbn,TRUE);
if($data_no_isbn){
	$config->redirectUrl('?p=master_buku/tambah&sts=duplicate-data');
	exit();
}
$target_ebook = 'assets/img/ebook/';
// Untuk ebook
if(!empty($_FILES['ebook']['tmp_name'])){
	$sumber = $_FILES['ebook']['tmp_name'];
	$nama_ebook = $_FILES['ebook']['name'];
	if(!move_uploaded_file($sumber, $target_ebook.$nama_ebook)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_ebook = '';
}
$target_gambar = 'assets/img/buku/';
if(!empty($_FILES['gambar']['tmp_name'])){
	$sumber = $_FILES['gambar']['tmp_name'];
	$nama_gambar = $_FILES['gambar']['name'];
	if(!move_uploaded_file($sumber, $target_gambar.$nama_gambar)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_gambar = '';
}
$data_insert = array(
	"ISBN" => $utility->filterInput($_POST['isbn']),
	"NM_BUKU" => $_POST['nm_buku'],
	"DES_BUKU" => $utility->filterInput($_POST['des_buku']),
	"STOK" => $_POST['stok'],
	"ID_PENERBIT" => $utility->filterInput($_POST['id_penerbit']),
	"ID_PENULIS" => $utility->filterInput($_POST['id_penulis']),
	"ID_RAKBUKU" => $utility->filterInput($_POST['id_rakbuku']),
	"EBOOK" => $nama_ebook,
	"GAMBAR" => $nama_gambar,
	"TGL_POST" => $utility->dateNow(),
	"WKT_POST" => $utility->timeNow(),
	"STS_PUBLISH" => $_POST['sts_publish']
	
);
$database->insert('tbl_buku',$data_insert);
$config->redirectUrl('?p=master_buku/tambah&sts=success');
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