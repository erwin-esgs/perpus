<h5>Master Admin</h5>
<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'delete'){
			require_once('halaman/material/delete_msg.php');
		}
	}
?>
	<div class="card-panel">
		<div class="form-group">
			<a href="<?php echo $config->baseUrl('?p=master_admin/tambah') ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah Admin</a>
		</div>
		<table id="example" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                        <?php
                        $no = 1;
                        $data_admin = $database->sqlQuery('SELECT * FROM tbl_admin');
                        if($data_admin):
	                        foreach($data_admin as $data_admin):
	                    ?>
	                            <tr>
	                                <td><?php echo $data_admin->USERNAME; ?></td>
	                                <td><?php if($data_admin->EMAIL == '' or $data_admin->EMAIL == '') echo '-';else echo $data_admin->EMAIL; ?></td>
	                                <td>
	                                	<div class="btn-group btn-group-sm">
	                                		<a href="<?php echo $config->baseUrl("?p=master_admin/hapus&id=".$data_admin->ID_ADMIN) ?>" onclick="return confirm('Apakah Anda Yakin ?')" class="waves-effect waves-light btn btn-small red darken-1">Hapus</a>
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