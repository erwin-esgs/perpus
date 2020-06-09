<h5>Tambah Anggota</h5>
      <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'success'){
			require_once('halaman/material/success_msg.php');
		}
		if($_GET['sts'] == 'duplicate-data'){
			echo '<div class="alert alert-danger">
					NIS Sudah terdaftar di database.
				</div>';
		}
	}
?>
<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
      	<div class="col s6">
      		
	<div class="form-group">
		<label>NIS</label>
		<input type="text" name="nis" class="cumaangka" required/>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" required/>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" />
	</div>
	<div class="form-group">
		<label>Tempat Lahir</label>
		<input type="text" name="tempat_lahir" />
	</div>
	<div class="form-group">
		<label>Tanggal Lahir</label>
		<input type="date" name="tgl_lahir"/>
	</div>
      	</div>
    <div class="col s6">
      	
	<div class="form-group">
		<label>Jenis Kelamin <span style="color:red"></span></label>
        <select name="jk" required>
			<option value="1">Laki - Laki</option>
			<option value="0">Perempuan</option>
        </select>
	</div>
	<div class="form-group">
		<label>No. Telp</label>
		<input type="text" name="no_telp" class="cumaangka"/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email"/>
	</div>
	<div class="form-group">
		<h6>Foto</h6>
        <input type="file" name="gambar">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="materialize-textarea" name="alamat"></textarea>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Tambah">
		<a href="<?php echo $config->baseUrl('?p=master_anggota/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
<?php
if($_POST){
$nis = $_POST['nis'];
$data_nisn = $database->sqlQuery('SELECT NIS FROM tbl_anggota WHERE NIS='.$nis,TRUE);
if($data_nisn){
	$config->redirectUrl('?p=master_anggota/tambah&sts=duplicate-data');
	exit();
}
$target_gambar = 'assets/img/anggota/';
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
	"NIS" => $utility->filterInput($_POST['nis']),
	"NAMA_SISWA" => $_POST['nama'],
	"TEMPAT_LAHIR" => $_POST['tempat_lahir'],
	"TGL_LAHIR" => $_POST['tgl_lahir'],
	"JENIS_KELAMIN" => $_POST['jk'],
	"NO_TELP" => $_POST['no_telp'],
	"EMAIL" => $_POST['email'],
	"ALAMAT" => $_POST['alamat'],
	"FOTO" => $nama_gambar,
	"PASSWORD" => md5($_POST['alamat'])
	
);
$database->insert('tbl_anggota',$data_insert);
$config->redirectUrl('?p=master_anggota/tambah&sts=success');
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