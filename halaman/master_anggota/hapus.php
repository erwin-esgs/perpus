<?php
$id = $_GET['id'];
$target_gambar = 'assets/img/anggota/';
$data_gambar = $database->sqlQuery('SELECT FOTO FROM tbl_anggota WHERE ID_ANGGOTA='.$id, TRUE);
if($data_gambar){	
	unlink($target_gambar.$data_gambar->FOTO);
}
$database->delete('tbl_anggota',"ID_ANGGOTA = ".$id);
$config->redirectUrl('?p=master_anggota/lihat&sts=delete');
?>