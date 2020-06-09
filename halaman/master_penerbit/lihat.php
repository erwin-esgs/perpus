<h5>Master Penerbit</h5>
<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'delete'){
			require_once('halaman/material/delete_msg.php');
		}
	}
?>
	<div class="card-panel">
		<div class="form-group">
			<a href="<?php echo $config->baseUrl('?p=master_penerbit/tambah') ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah Penerbit</a>
		</div>
		<table id="example" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Penerbit</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                        <?php
                        $no = 1;
                        $data_penerbit = $database->sqlQuery('SELECT * FROM tbl_penerbit');
                        if($data_penerbit):
	                        foreach($data_penerbit as $data_penerbit):
	                    ?>
	                            <tr>
	                                <td><?php echo $data_penerbit->NAMA_PENERBIT; ?></td>
	                                <td><?php if($data_penerbit->EMAIL == '' or $data_penerbit->EMAIL == '') echo '-';else echo $data_penerbit->EMAIL; ?></td>
	                                <td>
	                                	<div class="btn-group btn-group-sm">
	                                		<a href="<?php echo $config->baseUrl("?p=master_penerbit/detail&id=".$data_penerbit->ID_PENERBIT) ?>" class="waves-effect waves-light btn btn-small light-blue darken-1">Detail</a>
	                                		<a href="<?php echo $config->baseUrl("?p=master_penerbit/edit&id=".$data_penerbit->ID_PENERBIT) ?>" class="waves-effect waves-light btn btn-small light-blue darken-1">Edit</a>
	                                		<a href="<?php echo $config->baseUrl("?p=master_penerbit/hapus&id=".$data_penerbit->ID_PENERBIT) ?>" onclick="return confirm('Apakah Anda Yakin ?')" class="waves-effect waves-light btn btn-small red darken-1">Hapus</a>
	                                	</div>
	                                </td>
			
	                            </tr>
	                        <?php
		                    endforeach;
		                	?>
							
		                	<?php
		                endif;
	                    ?>
                        </tbody>
    </table>
	</div>
<?php 
if(isset($_GET['id'])){
	require_once('modules/admin_mastersiswa/delete_action.php');
}
?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
    	"bLengthChange": false
    });
} );
</script>