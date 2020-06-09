<?php
$id = $_GET['id'];
$anggota = $database->sqlQuery('SELECT * FROM tbl_anggota WHERE ID_SISWA='.$id, TRUE);
?>
<h5>Edit Anggota <?= $anggota->NAMA_SISWA ?></h5>
      <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'success'){
			require_once('halaman/material/edit_msg.php');
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
      <input type="hidden" name="id_siswa" value="<?= $anggota->ID_SISWA ?>"/>
      <div class="row">
      	<div class="col s6">
      		
	<div class="form-group">
		<label>NIS</label>
		<input type="hidden" name="nis_sekarang" value="<?= $anggota->NIS ?>"/>
		<input type="text" name="nis" value="<?= $anggota->NIS ?>" class="cumaangka" required/>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="cumahuruf" value="<?= $anggota->NAMA_SISWA ?>" required/>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" style="margin-bottom: 0"/>
		<span style="font-size: 12px;color:#ccc">Kosongi jika tidak ingin mengganti password.</span>
	</div>
	<div class="form-group">
		<label>Tempat Lahir</label>
		<input type="text" value="<?= $anggota->TEMPAT_LAHIR ?>" name="tempat_lahir" />
	</div>
	<div class="form-group">
		<label>Tanggal Lahir</label>
		<input type="date" value="<?= $anggota->TGL_LAHIR ?>" name="tgl_lahir"/>
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
		<input type="text" name="no_telp" value="<?= $anggota->NO_TELP ?>"  class="cumaangka"/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" value="<?= $anggota->EMAIL ?>"/>
	</div>
	<div class="form-group">
		<h6>Foto</h6>
		<?php
			if($anggota->FOTO != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/anggota/'.$anggota->FOTO) ?>" width="200px"/>
        <?php endif; ?>
        <input type="file" name="gambar"/>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="materialize-textarea" name="alamat"><?= $anggota->ALAMAT ?></textarea>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Perbaharui Informasi">
		<a href="<?php echo $config->baseUrl('?p=master_anggota/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
<?php
if($_POST){
$id_siswa = $_POST['id_siswa'];
$nis = $_POST['nis'];
if($_POST['nis_sekarang'] != $_POST['nis']){
	$data_nisn = $database->sqlQuery('SELECT NIS FROM tbl_anggota WHERE NIS='.$nis,TRUE);
	if($data_nisn){
		$config->redirectUrl('?p=master_anggota/edit&id='.$id_siswa.'&sts=duplicate-data');
		exit();
	}
}
$target_gambar = 'assets/img/anggota/';
$gambar = $database->sqlQuery('SELECT FOTO,PASSWORD FROM tbl_anggota WHERE ID_SISWA='.$id_siswa,TRUE);
if(!empty($_FILES['gambar']['tmp_name'])){
	if($gambar){
		unlink($target_gambar.$gambar->FOTO);
	}
	$sumber = $_FILES['gambar']['tmp_name'];
	$nama_gambar = $_FILES['gambar']['name'];
	if(!move_uploaded_file($sumber, $target_gambar.$nama_gambar)) {
		echo 'Upload gagal';
	}
}
else{
	$nama_gambar = $gambar->FOTO;
}
if($_POST['password'] != ''){
	$password = md5($_POST['password']);
}
else{
	$password = $gambar->PASSWORD;
}
$data_update = array(
	"NIS" => $utility->filterInput($_POST['nis']),
	"NAMA_SISWA" => $_POST['nama'],
	"TEMPAT_LAHIR" => $_POST['tempat_lahir'],
	"TGL_LAHIR" => $_POST['tgl_lahir'],
	"JENIS_KELAMIN" => $_POST['jk'],
	"NO_TELP" => $_POST['no_telp'],
	"EMAIL" => $_POST['email'],
	"ALAMAT" => $_POST['alamat'],
	"FOTO" => $nama_gambar,
	"PASSWORD" => $password
	
);
$where = array(
	"ID_SISWA" => $id_siswa
);
$database->update('tbl_anggota',$data_update,$where);
$config->redirectUrl('?p=master_anggota/edit&id='.$id_siswa.'&sts=success');
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