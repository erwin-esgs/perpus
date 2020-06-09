<h5>Tambah Penerbit</h5>
      <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'success'){
			require_once('halaman/material/success_msg.php');
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
      <div class="row">
      	<div class="col s12">
      		
	<div class="form-group">
		<label>Nama Penerbit</label>
		<input type="text" name="nama_penerbit" required/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email"/>
	</div>
	<div class="form-group">
		<label>No Telp</label>
		<input type="text" name="no_telp" class="cumaangka"/>
	</div>
	<div class="form-group">
		<label>Website</label>
		<input type="text" name="website" placeholder="http://example.com"/>
	</div>
	<div class="form-group">
		<h6>Gambar</h6>
        <input type="file" name="gambar"><br/>
    	<span style="font-size: 12px;color:#ccc">Kosongi jika tidak gambar</span>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="materialize-textarea" name="alamat"></textarea>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Tambah">
		<a href="<?php echo $config->baseUrl('?p=master_penerbit/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
<?php
if($_POST){
$nama_penerbit = $_POST['nama_penerbit'];
$data_nama_penerbit = $database->sqlQuery('SELECT NAMA_PENERBIT FROM tbl_penerbit WHERE NAMA_PENERBIT="'.$nama_penerbit.'"',TRUE);
if($data_nama_penerbit){
	$config->redirectUrl('?p=master_penerbit/tambah&sts=duplicate-data');
	exit();
}
$target_penerbit = 'assets/img/penerbit/';
if(!empty($_FILES['gambar']['tmp_name'])){
	$sumber = $_FILES['gambar']['tmp_name'];
	$nama_gambar = $_FILES['gambar']['name'];
	if(!move_uploaded_file($sumber, $target_penerbit.$nama_gambar)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_gambar = '';
}
$data_insert = array(
	"NAMA_PENERBIT" => $utility->filterInput($_POST['nama_penerbit']),
	"EMAIL" => $_POST['email'],
	"NO_TELP" => $utility->filterInput($_POST['no_telp']),
	"FOTO" => $nama_gambar,
	"ALAMAT" => $_POST['alamat'],
	"WEBSITE" => $_POST['website']
	
);
$database->insert('tbl_penerbit',$data_insert);
$config->redirectUrl('?p=master_penerbit/tambah&sts=success');
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