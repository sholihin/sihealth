
<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<div class="panel panel-default">
    <div class="panel-heading">        
        <h4>Daftar Terapis</h4>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Dokter</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $rows = $db->get_results("SELECT * FROM tb_dokter ORDER BY kode_dokter");
            
            foreach($rows as $row):?>
            <tr>
                <td><?=$row->kode_dokter ?></td>
                <td><?=$row->nama_dokter?></td>
                <td><?=$row->alamat?></td>
                <td><?=$row->telp?></td>
                <td><?=levelTerapis($row->level_terapis)?></td>
                <td class="nw">
                    <a class="btn btn-xs btn-warning" href="?m=terapis_ubah&amp;ID=<?=$row->kode_dokter?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=terapis_hapus&amp;ID=<?=$row->kode_dokter?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <?php endforeach;
            ?>
            </table>
        </div>
    </div>
</div>

<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/js/jszip.min.js"></script>
<script src="vendor/datatables/js/pdfmake.min.js"></script>
<script src="vendor/datatables/js/vfs_fonts.js"></script>
<script src="vendor/datatables/js/buttons.html5.min.js"></script>
<script src="vendor/datatables/js/buttons.bootstrap.min.js"></script>
<script src="vendor/datatables/js/buttons.print.min.js"></script>
<script src="vendor/datatables/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf' ]
        } );
    
        table.buttons().container()
            .appendTo( '#table_wrapper .col-sm-6:eq(0)' );
    } );
</script>