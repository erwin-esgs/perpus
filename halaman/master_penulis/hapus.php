<?php
$id = $_GET['id'];
$target_gambar = 'assets/img/penulis/';
$data_gambar = $database->sqlQuery('SELECT FOTO FROM tbl_penulis WHERE ID_PENULIS='.$id, TRUE);
if($data_gambar){	
	unlink($target_gambar.$data_gambar->FOTO);
}
$database->delete('tbl_penulis',"ID_PENULIS = ".$id);
$config->redirectUrl('?p=master_penulis/lihat&sts=delete');
?>