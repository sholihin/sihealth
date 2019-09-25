<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h4>Daftar Terapi</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="index.php?m=terapi_tambah" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Tindakan</th>
                    <th>Harga</th>
                    <th class="col-md-1">Komisi Senior</th>
                    <th class="col-md-1">Komisi Junior</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
        
            $rows = $db->get_results("SELECT * FROM tb_tindakan
                                    WHERE  kode_tindakan LIKE '%$q%' OR nama_tindakan LIKE '%$q%'
                                    OR harga LIKE '%$q%'
                                    ORDER BY kode_tindakan");
            
            $no=0;
            foreach($rows as $row):?>
            <tr>
                <td><?=$row->kode_tindakan ?></td>
                <td><?=$row->nama_tindakan?></td>
                <td><?=set_num($row->harga,0)?></td>
                <td><?=$row->ujroh_senior.'%'?></td>
                <td><?=$row->ujroh_junior.'%'?></td>
                <td class="text-center">
                    <a class="btn btn-xs btn-warning" href="?m=terapi_ubah&ID=<?=$row->kode_tindakan?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=terapi_hapus&ID=<?=$row->kode_tindakan?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
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