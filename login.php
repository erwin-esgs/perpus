<?php
ob_start();
session_start();
require "library/Config.php";
require "library/Database.php";
require "library/Utility.php";
$config = new Config();
$database = new Database();
$utility = new Utility();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Your page title</title>
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/css/materialize.min.css') ?>">
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/css/jquery.dataTables.min.css') ?>">
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/font-awesome/css/font-awesome.min.css') ?>">
	<script type="text/javascript" src="<?php echo $config->baseUrl('assets/js/jquery-2.1.1.min.js') ?>"></script>
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/css/style.css') ?>">
</head>
<body style="margin-top: 30px">
	<div class="container">
	
	<div class="row">
		<div class="col s3"></div>
		<div class="col s6">
			<div class="card-panel">
				<h5>Login</h5>
			</div>
			<div class="card-panel">
			<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'failed'){
		echo '<div class="alert alert-danger">
					Username dan password salah.
				</div>';
		}
		elseif($_GET['sts'] == 'expired'){
		echo '<div class="alert alert-info">
					Sesi Anda telah habis, silahkan login kembali.
				</div>';
		}
		elseif($_GET['sts'] == 'logout'){
		echo '<div class="alert alert-info">
					Anda berhasil logout.
				</div>';
		}
	}
?>
	<form action="" method="post">
			<div class="form-group">
		<label>Username/NIS</label>
		<input type="text" name="username"/>
	</div>
	<div class="form-group">
		<label>password</label>
		<input type="password" name="password"/>
	</div>
	<div class="form-group">
		<label>Level <span style="color:red"></span></label>
        <select name="role">
			<option value="1">Siswa</option>
			<option value="0">Admin</option>
        </select>
	</div>
	<input type="submit" class="waves-effect waves-light btn" value="Login">
	</form>
	<?php
		if($_POST){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$role = $_POST['role'];
		if($role == 1){
			$data_login = $database->sqlQuery('SELECT ID_SISWA,PASSWORD FROM tbl_anggota WHERE NIS="'.$username.'" AND PASSWORD ="'.$password.'"',TRUE);	
			$id_user = $data_login->ID_SISWA;
		}
		else{
			$data_login = $database->sqlQuery('SELECT ID_ADMIN,PASSWORD FROM tbl_admin WHERE USERNAME="'.$username.'" AND PASSWORD ="'.$password.'"',TRUE);
			$id_user = $data_login->ID_ADMIN;
		}
		if($data_login){
			$_SESSION['login'] = TRUE;
			$_SESSION['id_user'] = $id_user;
			$_SESSION['role'] = $role;
			if($role == 1){
				$config->redirectUrl('indexsiswa.php?p=siswa_dashboard/index');
			}
			else{
				$config->redirectUrl('?p=master_dashboard/index');
			}
			
			exit();
		}
		else{
			$config->redirectUrl('login.php?sts=failed');
			exit();
		}		
		}
	?>
			</div>
			<div class="card-panel teal" style="padding: 10px;margin-bottom: 10px;margin-top: 10px">
				<span class="white-text">&copy; <?php echo date('Y') ?> Aplikasi Perpustakaan</span>
			</div>
		</div>
		<div class="col s3"></div>
	</div>
	</div>
	<script>
$(document).ready(function() {
    $('select').material_select();
    
  });
</script>
	<script src="<?php echo $config->baseUrl('assets/js/materialize.min.js') ?>"></script>
	<script src="<?php echo $config->baseUrl('assets/js/jquery.dataTables.min.js') ?>"></script>
</body>
</html>