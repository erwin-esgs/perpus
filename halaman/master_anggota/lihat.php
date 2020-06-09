<h5>Master Anggota</h5>
<?php 
	if(isset($_GET['sts'])){
		if($_GET['sts'] == 'delete'){
			require_once('halaman/material/delete_msg.php');
		}
	}
?>
	<div class="card-panel">
		<div class="form-group">
			<a href="<?php echo $config->baseUrl('?p=master_anggota/tambah') ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah Anggota</a>
		</div>
		<table id="example" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                        <?php
                        $no = 1;
                        $data_siswa = $database->sqlQuery('SELECT * FROM tbl_anggota');
                        if($data_siswa):
	                        foreach($data_siswa as $data_murid):
	                    ?>
	                            <tr>
	                                <td><?php echo $data_murid->NIS; ?></td>
	                                <td><?php echo $data_murid->NAMA_SISWA; ?></td>
	                                <td><?php echo $data_murid->EMAIL; ?></td>
	                                <td>
	                                	<div class="btn-group btn-group-sm">
	                                		<a href="<?php echo $config->baseUrl("?p=master_anggota/detail&id=".$data_murid->ID_SISWA) ?>" class="waves-effect waves-light btn btn-small light-blue darken-1">Detail</a>
	                                		<a href="<?php echo $config->baseUrl("?p=master_anggota/edit&id=".$data_murid->ID_SISWA) ?>" class="waves-effect waves-light btn btn-small light-blue darken-1">Edit</a>
	                                		<a href="<?php echo $config->baseUrl("?p=master_anggota/hapus&id=".$data_murid->ID_SISWA) ?>" onclick="return confirm('Apakah Anda Yakin ?')" class="waves-effect waves-light btn btn-small red darken-1">Hapus</a>
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