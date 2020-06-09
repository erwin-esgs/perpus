<?php
$id = $_GET['id'];
$target_gambar = 'assets/img/buku/';
$target_ebook = 'assets/img/ebook/';
$data_gambar = $database->sqlQuery('SELECT GAMBAR FROM tbl_buku WHERE ID_BUKU='.$id, TRUE);
$data_ebook = $database->sqlQuery('SELECT EBOOK FROM tbl_buku WHERE ID_BUKU='.$id, TRUE);
if($data_gambar){	
	unlink($target_gambar.$data_gambar->GAMBAR);
}
if($data_ebook){
	unlink($target_ebook.$data_ebook->EBOOK);
}
$database->delete('tbl_buku',"ID_BUKU = ".$id);
$config->redirectUrl('?p=master_buku/lihat&sts=delete');
?>