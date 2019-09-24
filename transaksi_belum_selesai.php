
<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<div class="panel panel-default">
    <div class="panel-heading clearfix" style="margin-bottom:5px">      
        <h1 class="text-left pull-left" style="margin-top:0px">Transaksi Belum Selesai</h1>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>Golongan Darah</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $rows = $db->get_results("SELECT * FROM tb_pasien WHERE transaksi_id IS NOT NULL ORDER BY transaksi_id DESC");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><a target="_blank" href="index.php?m=medical-records-admin&ID=<?=$row->kode_pasien ?>"><?=$row->kode_pasien ?></a></td>
            <td><?=$row->nama_pasien?></td>
            <td><?=$row->alamat?></td>
            <td><?php if($row->jk==1){echo "Laki-Laki";}else{echo "Perempuan";}?></td>
            <td><?=$row->umur.' tahun'?></td>
            <td><?=$row->golongan_darah?></td>
            <td><?=agama($row->agama)?></td>
            <td><?=$row->pekerjaan?></td>
            <td><?=$row->telepon?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=tindakan_kunjungan&c=<?=$row->kode_pasien?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?m=kunjungan_hapus&amp;ID=<?=$row->kode_pasien?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
        </tr>
        <?php endforeach;
        ?>
        </table>
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