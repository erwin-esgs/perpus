<style>
	.crop {
    height: 200px;
    overflow: hidden;
}

.crop img {
    width: 200px;
}
</style>
<h5>Beranda</h5>
<p>Berikut ini adalah 6 buku terbaru.</p>
<div class="row">
 		<?php
 			$data_buku = $database->sqlQuery('SELECT * FROM tbl_buku WHERE STS_PUBLISH=1 ORDER BY ID_BUKU DESC LIMIT 6');
            if($data_buku):
            foreach($data_buku as $data_buku):
 		?>
        <div class="col s4">
          <div class="card-panel">
          	<div class="crop">
			    <img src="<?= $config->baseUrl('assets/img/buku/'.$data_buku->GAMBAR); ?>">
			</div>
            <h6><?= substr($data_buku->NM_BUKU,0,20).' ...' ?></h6>
              <p>Stok : <?= $data_buku->STOK; ?></p>
              <a href="<?php echo $config->baseUrl('indexsiswa.php?p=siswa_bankbuku/lihat&id='.$data_buku->ID_BUKU) ?>" class="waves-effect waves-light btn light-blue darken-1 btn-sm" style="width:100%">Detail</a>
          </div>
        </div>
        <?php endforeach;endif; ?>
</div>
<div class="row">
	<div class="col s12">
		<a class="waves-effect waves-light btn light-blue darken-1 btn-sm" href="<?= $config->baseUrl('indexsiswa.php?p=siswa_bankbuku/index'); ?>" style="width:100%">Semua Buku</a>
	</div>
</div>