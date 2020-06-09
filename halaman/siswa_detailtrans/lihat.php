<h5>Daftar Sewa</h5>
	<div class="card-panel">
		<table id="example" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                        <?php
                        $no = 1;
                        $data_sewa = $database->sqlQuery('SELECT * FROM tbl_sewa WHERE ID_SISWA='.$_SESSION['id_user']);
                        if($data_sewa):
	                        foreach($data_sewa as $data_sewa):
	                    ?>
	                            <tr>
	                                <td><?php echo $data_sewa->ID_TRANSAKSI; ?></td>
	                                <td><?php echo $data_sewa->TGL_SEWA; ?></td>
	                                <td><?php if($data_sewa->TGL_KEMBALI != '') echo $data_sewa->TGL_KEMBALI;else echo '-'; ?></td>
	                                <td><a href="<?php echo $config->baseUrl('indexsiswa.php?p=siswa_detailtrans/index&id_transaksi='.$data_sewa->ID_TRANSAKSI) ?>" class="waves-effect waves-light btn light-blue darken-1 btn-small">detail</a></td>
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
<script>
$(document).ready(function() {
    $('#example').DataTable({
    	"bLengthChange": false
    });
} );
</script>