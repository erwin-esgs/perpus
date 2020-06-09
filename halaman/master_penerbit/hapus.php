<?php
$id = $_GET['id'];
$target_gambar = 'assets/img/penerbit/';
$data_gambar = $database->sqlQuery('SELECT FOTO FROM tbl_penerbit WHERE ID_PENERBIT='.$id, TRUE);
if($data_gambar){	
	unlink($target_gambar.$data_gambar->FOTO);
}
$database->delete('tbl_penerbit',"ID_PENERBIT = ".$id);
$config->redirectUrl('?p=master_penerbit/lihat&sts=delete');
?>