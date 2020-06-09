<?php
ob_start();
session_start();
require "library/Config.php";
require "library/Database.php";
require "library/Utility.php";
$config = new Config();
$database = new Database();
$utility = new Utility();
if(!isset($_SESSION['login'])){
	$config->redirectUrl('login.php?sts=expired');
	exit();
}
$detail_web = $database->sqlQuery('SELECT * FROM tbl_info WHERE ID_INFO=1', TRUE);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $detail_web->JUDUL_WEBSITE ?> - Halaman Admin</title>
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/css/materialize.min.css') ?>">
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/css/jquery.dataTables.min.css') ?>">
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/font-awesome/css/font-awesome.min.css') ?>">
	<script type="text/javascript" src="<?php echo $config->baseUrl('assets/js/jquery-2.1.1.min.js') ?>"></script>
	<link rel="stylesheet" href="<?php echo $config->baseUrl('assets/css/style.css') ?>">
</head>
<body>
	<div class="container">

		<div class="col s12">
			<div class="card-panel">
			<div class="row">
				<div class="col s12"><h4><?= $detail_web->JUDUL_WEBSITE ?></h4><p><?= $detail_web->ALAMAT ?></p></div>
			</div>
			</div>
		</div>
		
	<div class="row">
		<div class="col s3">
			<h5>Menu</h5>
			 <div class="collection">
			    <a href="<?= $config->baseUrl('?p=master_dashboard/index') ?>" class="collection-item"><i class="fa fa-home fa-fw"></i> Beranda</a>
			    <a href="<?= $config->baseUrl('?p=master_transaksi/index') ?>" class="collection-item"><i class="fa fa-list fa-fw"></i> Daftar Sewa Buku</a>
			    <a href="<?= $config->baseUrl('?p=master_buku/lihat') ?>" class="collection-item"><i class="fa fa-archive fa-fw"></i> Master Buku</a>
			    <a href="<?= $config->baseUrl('?p=master_penerbit/lihat') ?>" class="collection-item"><i class="fa fa-user fa-fw"></i> Master Penerbit</a>
			    <a href="<?= $config->baseUrl('?p=master_penulis/lihat') ?>" class="collection-item"><i class="fa fa-pencil fa-fw"></i> Master Penulis</a>
			    <a href="<?= $config->baseUrl('?p=master_anggota/lihat') ?>" class="collection-item"><i class="fa fa-users fa-fw"></i> Master Anggota</a>
			    <a href="<?= $config->baseUrl('?p=master_admin/lihat') ?>" class="collection-item"><i class="fa fa-star fa-fw"></i> Master Admin</a>
			    <a href="<?= $config->baseUrl('?p=master_infoadmin/lihat') ?>" class="collection-item"><i class="fa fa-user fa-fw"></i> Detail Akun</a>
			    <a href="<?= $config->baseUrl('?p=master_info/lihat') ?>" class="collection-item"><i class="fa fa-info-circle fa-fw"></i> Informasi Website</a>
			    <a href="<?= $config->baseUrl('logout.php') ?>" class="collection-item"><i class="fa fa-power-off fa-fw"></i> Logout</a>
			  </div>	
		</div>
			<div class="col s9">
			<?php
		$pages_dir = 'halaman';
		if(!empty($_GET['p'])){
			$p = $_GET['p'];
			include($pages_dir.'/'.$p.'.php');
		} else {
			include($pages_dir.'/home.php');
		}
		?>
			</div>
			<div class="col s12">
			<div class="card-panel teal" style="padding: 10px;margin-bottom: 10px;margin-top: 10px">
			<span class="white-text">&copy; <?php echo date('Y') ?> <?= $detail_web->JUDUL_WEBSITE ?></span>
			</div>
		</div>
	</div>
	</div>
	<script src="<?php echo $config->baseUrl('assets/js/materialize.min.js') ?>"></script>
	<script src="<?php echo $config->baseUrl('assets/js/jquery.dataTables.min.js') ?>"></script>
</body>
</html>