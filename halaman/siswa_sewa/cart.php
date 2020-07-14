<h5>Daftar Peminjaman Buku</h5>
<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'cart'){
			echo '<div class="alert alert-info">
				Keranjang berhasil diperbaharui.
			</div>';
		}
		if($_GET['sts'] == 'stok'){
			echo '<div class="alert alert-info">
				Pastikan qty yang Anda masukkan tidak melebihi stok.
			</div>';
		}
	}
?>
<?php
	$status_cart = 0;
	// Generate id transaksi
	if(!isset($_SESSION['id_transaksi'])){
		$_SESSION['id_transaksi'] = date('Ymdhis');
		$id_transaksi = $_SESSION['id_transaksi'];
	}
	else{
		$id_transaksi = $_SESSION['id_transaksi'];
	}
	
	if(isset($_GET['id_buku'])){
		$cek = $database->sqlQuery('SELECT * FROM tbl_keranjangsewa WHERE ID_BUKU='.$_GET['id_buku'].' AND ID_TRANSAKSI='.$_SESSION['id_transaksi'], TRUE);
		if(!$cek){
			$data_insert = array(
				"ID_BUKU" => $_GET['id_buku'],
				"ID_TRANSAKSI" => $_SESSION['id_transaksi'],
				"QTY" => 1,
				"STS_ACTIVE" => 0,
			);
			$database->insert('tbl_keranjangsewa',$data_insert);
			$status_cart = 1;
		}
		else{
			$status_cart = 0;
		}
	}
	
		if(isset($_GET['idbuku'])){
		$cek = $database->query('DELETE FROM tbl_keranjangsewa WHERE ID_BUKU='.$_GET['idbuku'].' AND ID_TRANSAKSI='.$_SESSION['id_transaksi'], TRUE);
	}
	
?>
<?php
if($status_cart == 1):
?>
<div class="alert alert-info">Berhasil menambah buku ke keranjang sewa.</div>
<?php endif; ?>
<div class="card-panel">
	<form action="" method="post">
	<div class="form-group">
		<input type="submit" name="refresh_keranjang" class="waves-effect waves-light btn light-blue darken-1 btn-small" value="Refresh Keranjang"/>
		<table class="bordered">
		<tr>
			<th>ISBN</th>
			<th>Nama Buku</th>
			<th width="10%">QTY</th>
			<th>Aksi</th>
		</tr>
		<tr>
			<?php
				$data_keranjang = $database->sqlQuery('SELECT * FROM tbl_keranjangsewa WHERE ID_TRANSAKSI="'.$id_transaksi.'"');
				if($data_keranjang):
				$a = 1;
			?>
			<?php foreach($data_keranjang as $data_keranjang):
				$detail_buku = $database->sqlQuery('SELECT * FROM tbl_buku WHERE ID_BUKU='.$data_keranjang->ID_BUKU, TRUE);
			?>
			<tr>
				<td><?= $detail_buku->ISBN ?></td>
				<td><?= $detail_buku->NM_BUKU ?></td>
				<td><input type="hidden" name="qtyid<?= $a ?>" value="<?= $detail_buku->ID_BUKU ?>"/> <input min="1" type="number" name="qtyvalue<?= $a ?>" style="margin: 0" placeholder="" value="<?= $data_keranjang->QTY ?>"/></td>
				<td><a href="<?= $config->baseUrl('indexsiswa.php?p=siswa_sewa/cart&idbuku='.$detail_buku->ID_BUKU) ?>" class="waves-effect waves-light btn btn-small red darken-1">Hapus</a></td>
			</tr>
			<?php $a++;endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="4">Tidak ada buku yang disewa, silahkan pilih buku <a href="<?= $config->baseUrl('indexsiswa.php?p=siswa_bankbuku/index'); ?>">disini</a>.</td>
			</tr>
			<?php endif; ?>
		</tr>
	</table>
	</div>
	<p></p>
	<input type="hidden" name="jum_qty" value="<?= ($a-1) ?>"/>
	<input type="hidden" name="id_transaksi" value="<?= $_SESSION['id_transaksi'] ?>"/>
	</form>
	<form action="" method="post">
		<input type="submit" name="checkout" class="waves-effect waves-light btn" value="Checkout"/>
	</form>
</div>

<?php
	if(isset($_POST['refresh_keranjang'])){
		$jum_qty = $_POST['jum_qty'];
		$id_transaksi = $_POST['id_transaksi'];
		for($a = 1;$a<=$jum_qty;$a++){
			$id_buku = $_POST['qtyid'.$a];
			$qty = $_POST['qtyvalue'.$a];
			$data_update = array(
				"QTY" => $qty
			);
			$where = array(
				"ID_BUKU" => $id_buku,
				"ID_TRANSAKSI" => $id_transaksi
			);
			$cek_stok = $database->sqlQuery('SELECT STOK FROM tbl_buku WHERE ID_BUKU='.$id_buku, TRUE);
			if($cek_stok->STOK < $qty){
				$config->redirectUrl('indexsiswa.php?p=siswa_sewa/cart&sts=stok');
				exit();
			}
			else{
				$database->update('tbl_keranjangsewa',$data_update,$where);				
			}
		}
		$config->redirectUrl('indexsiswa.php?p=siswa_sewa/cart&sts=cart');
	}
	
	if(isset($_POST['checkout'])){
		$data_update = array(
			"STS_ACTIVE" => 1
		);
		$where = array(
			"ID_TRANSAKSI" => $_SESSION['id_transaksi']
		);
		$database->update('tbl_keranjangsewa',$data_update,$where);
		$data_insert = array(
			"ID_TRANSAKSI" => $_SESSION['id_transaksi'],
			"TGL_SEWA" => $utility->dateNow(),
			"TGL_AMBIL" => $utility->dateNow(),
			"WKT_SEWA" => $utility->timeNow(),
			"TGL_KEMBALI" => date('Y-m-d', strtotime("+3 day")) ,
			"ID_SISWA" => $_SESSION['id_user'],
			"STS_CONFIRM" => 1
		);
		$database->insert('tbl_sewa',$data_insert);
		$config->redirectUrl('indexsiswa.php?p=siswa_detailtrans/index&id_transaksi='.$_SESSION['id_transaksi']);
		unset($_SESSION['id_transaksi']);
	}
?>