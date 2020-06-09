<?php
$detail_info = $database->sqlQuery('SELECT * FROM tbl_anggota WHERE ID_SISWA='.$_SESSION['id_user'], TRUE);
?>
<h5>Info Profil</h5>
<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'success'){
			echo '<div class="alert alert-success">
					Informasi berhasil diperbaharui
				</div>';
		}
	}
?>
<div class="card-panel">
	<form action="" method="post">
		
	
	<div class="row">
		<div class="col s4">
			<?php
				if($detail_info->FOTO != ''):
			?>
			<img src="<?php echo $config->baseUrl('assets/img/anggota/'.$detail_info->FOTO) ?>" width="200px"/>
	        <?php endif; ?>
		</div>
		<div class="col s8">
		<table class="table" width="100%">
				<tr>
					<td><b>NIS</b></td>
					<td><?= $detail_info->NIS ?></td>
				</tr>
				<tr>
					<td><b>Nama Siswa</b></td>
					<td><?= $detail_info->NAMA_SISWA ?></td>
				</tr>
				<tr>
					<td><b>Tempat Lahir</b></td>
					<td><?= $detail_info->TEMPAT_LAHIR ?></td>
				</tr>
				<tr>
					<td><b>Tanggal Lahir</b></td>
					<td><?= $detail_info->TGL_LAHIR ?></td>
				</tr>
				<tr>
					<td><b>Jenis Kelamin</b></td>
					<td><?= $detail_info->JENIS_KELAMIN ?></td>
				</tr>
				<tr>
					<td><b>Nomer Telepon</b></td>
					<td>
					<input type="text" name="no_telp" style="margin: 0" class="cumaangka" value="<?= $detail_info->NO_TELP ?>"/></td>
				</tr>
				<tr>
					<td><b>Email</b></td>
					<td>
					<input type="text" name="email" style="margin: 0"value="<?= $detail_info->EMAIL ?>"/></td>
				</tr>
				<tr>
					<td><b>Alamat</b></td>
					<td>
						<textarea class="materialize-textarea" name="alamat"><?= $detail_info->ALAMAT ?></textarea>
					</td>
				</tr>
			</table></div>
	</div>
	<input type="submit" class="waves-effect waves-light btn btn-sm" value="Perbaharui Informasi"/>
              <a href="<?php echo $config->baseUrl('indexsiswa.php?p=siswa_info/index') ?>" class="waves-effect waves-light btn light-blue darken-1 btn-sm">Ganti Password</a>
</form>
</div>
<?php
if($_POST){
	$update = array(
		'NO_TELP' => $_POST['no_telp'],
		'EMAIL' => $_POST['email'],
		'ALAMAT' => $_POST['alamat'],
	);
	$where = array(
		'ID_SISWA' => $_SESSION['id_user']
	);
	$database->update('tbl_anggota',$update,$where);
	$config->redirectUrl('indexsiswa.php?p=siswa_info/info_profil&sts=success');
}
?>
<script>
$(document).ready(function() {
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