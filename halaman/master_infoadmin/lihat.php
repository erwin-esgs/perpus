<?php
$id_user = $_SESSION['id_user'];
$admin = $database->sqlQuery('SELECT * FROM tbl_admin WHERE ID_ADMIN='.$id_user, TRUE);
?>
<h5>Detail Akun</h5>
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
      <div class="row">
      	<div class="col s12">
      		
	<div class="form-group">
		<label>Username</label>
		<p style="margin: 0"><?= $admin->USERNAME ?></p>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" style="margin-bottom: 0"/>
		<span style="font-size: 12px;color:#ccc">Kosongi jika tidak ingin mengganti password.</span>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" value="<?= $admin->NAMA ?>"/>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" value="<?= $admin->EMAIL ?>"/>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Perbaharui Informasi">
</form>
		</div>
		<?php
if($_POST){
$id_user = $_SESSION['id_user'];
$admin = $database->sqlQuery('SELECT PASSWORD FROM tbl_admin WHERE ID_ADMIN='.$id_user,TRUE);
if($_POST['password'] != ''){
	$password = md5($_POST['password']);
}
else{
	$password = $admin->PASSWORD;
}
$data_update = array(
	"PASSWORD" => $password,
	"NAMA" => $_POST['nama'],
	"EMAIL" => $_POST['email']
);
$where = array(
	"ID_ADMIN" => $id_user
);
$database->update('tbl_admin',$data_update,$where);
$config->redirectUrl('?p=master_infoadmin/lihat&sts=edit');
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