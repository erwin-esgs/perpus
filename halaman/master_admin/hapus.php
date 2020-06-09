<?php
$id = $_GET['id'];
$database->delete('tbl_admin',"ID_ADMIN = ".$id);
$config->redirectUrl('?p=master_admin/lihat&sts=delete');
?>