<?php
$id = $_GET['id'];
$anggota = $database->sqlQuery('SELECT * FROM tbl_anggota WHERE ID_SISWA='.$id, TRUE);
?>
<h5>Detail Anggota <?= $anggota->NAMA_SISWA ?></h5>
<div class="card-panel">
      <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
      	<div class="col s6">
      		
	<div class="form-group">
		<label>NIS</label>
		<p style="margin: 0"><?= ($anggota->NIS != '' ? $anggota->NIS : "-") ?></p>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<p style="margin: 0"><?= ($anggota->NAMA_SISWA != '' ? $anggota->NAMA_SISWA : "-") ?></p>
	</div>
	<div class="form-group">
		<label>Tempat Lahir</label>
		<p style="margin: 0"><?= ($anggota->TEMPAT_LAHIR != '' ? $anggota->TEMPAT_LAHIR : "-") ?></p>
	</div>
	<div class="form-group">
		<label>Tanggal Lahir</label>
		<p style="margin: 0"><?= ($anggota->TGL_LAHIR != '' ? $anggota->TGL_LAHIR : "-") ?></p>
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
		<p style="margin: 0"><?= ($anggota->NO_TELP != '' ? $anggota->NO_TELP : "-") ?></p>
	</div>
	<div class="form-group">
		<label>Email</label>
		<p style="margin: 0"><?= ($anggota->EMAIL != '' ? $anggota->EMAIL : "-") ?></p>
	</div>
	<div class="form-group">
		<h6>Foto</h6>
		<?php
			if($anggota->FOTO != ''):
		?>
		<img src="<?php echo $config->baseUrl('assets/img/anggota/'.$anggota->FOTO) ?>" width="200px"/>
		<?php else: ?>
		<p style="margin: 0">Tidak ada foto.</p>
        <?php endif; ?>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<p style="margin: 0"><?= ($anggota->ALAMAT != '' ? $anggota->ALAMAT : "-") ?></p>
	</div>
      	</div>
      </div>
		<a href="<?php echo $config->baseUrl("?p=master_anggota/edit&id=".$anggota->ID_SISWA) ?>" class="waves-effect waves-light btn light-blue darken-1">Edit</a>
		<a href="<?php echo $config->baseUrl('?p=master_anggota/lihat') ?>" class="waves-effect waves-light btn light-blue darken-1">Kembali</a>
</form>
		</div>