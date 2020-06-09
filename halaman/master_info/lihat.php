<?php
$infowebsite = $database->sqlQuery('SELECT * FROM tbl_info WHERE ID_INFO=1', TRUE);
?>
<h5>Informasi Website</h5>
 <?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'edit'){
			require_once('halaman/material/edit_msg.php');
		}
	}
?>
<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
      	<div class="col s12">
      		
	<div class="form-group">
		<label>Judul Website</label>
		<input type="text" name="judul" style="margin-bottom: 0" value="<?= $infowebsite->JUDUL_WEBSITE ?>"/>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="materialize-textarea" name="alamat"><?= $infowebsite->ALAMAT ?></textarea>
	</div>
	<div class="form-group">
		<h6>Gambar</h6>
		<?php
			if($infowebsite->LOGO != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/logo/'.$infowebsite->LOGO) ?>" width="200px"/>
		<?php else: ?>
		Tidak ada foto
        <?php endif; ?><br/>
        <input type="file" name="gambar"><br/>
    	<span style="font-size: 12px;color:#ccc">Kosongi jika tidak ingin mengganti foto</span>
	</div>
      	</div>
      </div>
		<input type="submit" class="waves-effect waves-light btn" value="Perbaharui Informasi">
</form>
		</div>
		<?php
if($_POST){
	$target_penerbit = 'assets/img/logo/';
	$data_foto = $database->sqlQuery('SELECT LOGO FROM tbl_info WHERE ID_INFO=1',TRUE);
	if(!empty($_FILES['gambar']['tmp_name'])){
		if($data_foto){
			unlink($target_penerbit.$data_foto->LOGO);
		}
		$sumber = $_FILES['gambar']['tmp_name'];
		$nama_foto = $_FILES['gambar']['name'];
		if(!move_uploaded_file($sumber, $target_penerbit.$nama_foto)) {
			echo 'Upload gagal';
		}
	}
	else{
		$nama_foto = $data_foto->LOGO;
	}
	$data_update = array(
		"JUDUL_WEBSITE" => $utility->filterInput($_POST['judul']),
		"ALAMAT" => $_POST['alamat'],
		"LOGO" => $nama_foto
	);
	$where = array(
		"ID_INFO" => 1
	);
	$database->update('tbl_info',$data_update,$where);
	$config->redirectUrl('?p=master_info/lihat&sts=edit');
}
?>