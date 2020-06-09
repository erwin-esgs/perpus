<h5>Ganti Password</h5>
<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'success'){
			echo '<div class="alert alert-success">
					Password berhasil diubah.
				</div>';
		}
		elseif($_GET['sts'] == 'not-same'){
			echo '<div class="alert alert-danger">
					Password dan konfirmasi password tidak sama.
				</div>';
		}
	}
?>
<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
		<label>Password Baru</label>
		<input type="password" name="password" required/>
	</div>
	<div class="form-group">
		<label>Konfirmasi Password Baru</label>
		<input type="password" name="con_password"/>
	</div>
		<input type="submit" class="waves-effect waves-light btn" value="Ubah Password"/>
</form>
      </div>

<?php
if($_POST){
	if($_POST['password'] != $_POST['con_password']){
		$config->redirectUrl('indexsiswa.php?p=siswa_info/index&sts=not-same');
		exit();
	}
	$update = array(
		'PASSWORD' => md5($_POST['password'])
	);
	$where = array(
		'ID_SISWA' => $_SESSION['id_user']
	);
	$database->update('tbl_anggota',$update,$where);
	$config->redirectUrl('indexsiswa.php=siswa_info/index&sts=success');
}
?>