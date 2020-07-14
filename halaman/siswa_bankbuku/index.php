<style>
	.crop {
    height: 200px;
    overflow: hidden;
}

.crop img {
    width: 200px;
}
</style>
<h5>Daftar Buku</h5>
<div class="row">
	<div class="col-md-6">
		
	</div>
	<div class="col-md-6">
		
	</div>
</div>
 <?php 
  $halaman = 6;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  if(isset($_GET['query'])){
  	$query = " AND NM_BUKU LIKE '%".$_GET['query']."%' ";
  	$link = '&query='.$_GET['query'];
  }
  else{
  	$query = '';
  	$link = '';
  }
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $data_buku = $database->sqlQuery("SELECT * FROM tbl_buku WHERE STS_PUBLISH=1 ".$query." ORDER BY ID_BUKU DESC LIMIT $mulai, $halaman");
  $total = $database->numRows("SELECT * FROM tbl_buku WHERE STS_PUBLISH=1".$query);
  $pages = ceil($total/$halaman);
  $no =$mulai+1;
    ?>
<div class="row">
	<div class="col s7">
		<form action="" method="get">
			<input type="hidden" name="p" value="siswa_bankbuku/index"/>
			<div class="form-group">
				<input type="text" name="query" placeholder="Cari disini..."/> 
				<input type="submit" class="waves-effect waves-light btn" value="Cari"/>
				<?php
					if(isset($_GET['query'])):
				?>
				<a href="<?= $config->baseUrl('indexsiswa.php?p=siswa_bankbuku/index') ?>" class="waves-effect waves-light btn red darken-1"><i class="fa fa-times"></i> Matikan Pencarian</a>
				<?php endif; ?>
			</div>
		</form>
	</div>
</div>
<div class="row">
 		<?php
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
              <a class="waves-effect waves-light btn btn-sm" href="<?php echo $config->baseUrl('indexsiswa.php?p=siswa_sewa/cart&id_buku='.$data_buku->ID_BUKU) ?>" style="width:100%">Booking</a>
          </div>
        </div>
        <?php endforeach;endif; ?>
</div>
<ul class="pagination">
  <?php for ($i=1; $i<=$pages ; $i++){ ?>
    <li class="<?php if(isset($_GET["halaman"]) and $_GET["halaman"] == $i){ echo 'active';}else{ echo 'waves-effect';} ?>"><a href="indexsiswa.php?p=siswa_bankbuku/index&halaman=<?php echo $i.$link; ?>"><?php echo $i; ?></a></li>
  <?php } ?>
  </ul>