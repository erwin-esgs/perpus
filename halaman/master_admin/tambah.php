<h5>Tambah Admin</h5>
      <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'success'){
			require_once('halaman/material/success_msg.php');
		}
		elseif($_GET['sts'] == 'duplicate-data'){
			echo '<div class="alert alert-danger">
					Username sudah terdaftar di database.
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
      <div class="row">
      	<div class="col s12">
      		
	<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" required/>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password"/>
	</div>
	<div class="form-group">
		<label>Konfirmasi Password</label>
		<input type="password" name="password_conf"/>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama"/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email"/>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Tambah">
		<a href="<?php echo $config->baseUrl('?p=master_penulis/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>
<?php
if($_POST){
$username = $_POST['username'];
$data_username = $database->sqlQuery('SELECT USERNAME FROM tbl_admin WHERE USERNAME="'.$data_username.'"',TRUE);
if($data_username){
	$config->redirectUrl('?p=master_admin/tambah&sts=duplicate-data');
	exit();
}
if($_POST['password'] != $_POST['password_conf']){
	$config->redirectUrl('?p=master_admin/tambah&sts=not-same');
	exit();
}
$data_insert = array(
	"USERNAME" => $username,
	"PASSWORD" => md5($_POST['password']),
	"NAMA" => $_POST['nama'],
	"EMAIL" => $_POST['email']
);
$database->insert('tbl_admin',$data_insert);
$config->redirectUrl('?p=master_admin/tambah&sts=success');
}
?>