<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h4>Daftar Paket</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="index.php?m=terapi" class="btn btn-danger"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a>
                <a href="index.php?m=kategori_terapi_tambah" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah Paket</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <?php
            $rows = $db->get_results("SELECT * FROM tb_kategori_tindakan ORDER BY kode_kategori DESC");
            foreach($rows as $row):?>
            <tr>
                <td><?=$row->kode_kategori ?></td>
                <td><?=$row->nama_kategori?></td>
                <td><?=set_num($row->harga,0)?></td>
                <td class="text-center">
                    <a class="btn btn-xs btn-warning" href="?m=kategori_terapi_ubah&ID=<?=$row->kode_kategori?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=kategori_terapi_hapus&ID=<?=$row->kode_kategori?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
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
            "order": [[ 0, "desc" ]],
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf' ]
        } );
    
        table.buttons().container()
            .appendTo( '#table_wrapper .col-sm-6:eq(0)' );
    } );
</script>