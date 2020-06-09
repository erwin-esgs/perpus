<h5>Master Penulis</h5>
<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'delete'){
			require_once('halaman/material/delete_msg.php');
		}
	}
?>
	<div class="card-panel">
		<div class="form-group">
			<a href="<?php echo $config->baseUrl('?p=master_penulis/tambah') ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah Penulis</a>
		</div>
		<table id="example" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Penulis</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                        <?php
                        $no = 1;
                        $data_penulis = $database->sqlQuery('SELECT * FROM tbl_penulis');
                        if($data_penulis):
	                        foreach($data_penulis as $data_penulis):
	                    ?>
	                            <tr>
	                                <td><?php echo $data_penulis->NAMA_PENULIS; ?></td>
	                                <td><?php if($data_penulis->EMAIL == '' or $data_penulis->EMAIL == '') echo '-';else echo $data_penulis->EMAIL; ?></td>
	                                <td>
	                                	<div class="btn-group btn-group-sm">
	                                		<a href="<?php echo $config->baseUrl("?p=master_penulis/detail&id=".$data_penulis->ID_PENULIS) ?>" class="waves-effect waves-light btn btn-small light-blue darken-1">Detail</a>
	                                		<a href="<?php echo $config->baseUrl("?p=master_penulis/edit&id=".$data_penulis->ID_PENULIS) ?>" class="waves-effect waves-light btn btn-small light-blue darken-1">Edit</a>
	                                		<a href="<?php echo $config->baseUrl("?p=master_penulis/hapus&id=".$data_penulis->ID_PENULIS) ?>" onclick="return confirm('Apakah Anda Yakin ?')" class="waves-effect waves-light btn btn-small red darken-1">Hapus</a>
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