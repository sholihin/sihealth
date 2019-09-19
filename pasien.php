
<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<div class="panel panel-default">
    <div class="panel-heading clearfix" style="margin-bottom:5px">      
            <h1 class="text-left pull-left" style="margin-top:0px">Pasien</h1>
            <form class="form-inline pull-right">
                <input type="hidden" name="m" value="pasien" />
                <div class="form-group">
                    <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                </div>
                <div class="form-group">
                    <a class="btn btn-primary" href="?m=pasien_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                </div>
            </form>
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
        $rows = $db->get_results("SELECT * FROM tb_pasien ORDER BY kode_pasien");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><a target="_blank" href="/client/?page=pasien&ID=<?=$row->kode_pasien ?>"><?=$row->kode_pasien ?></a></td>
            <td><?=$row->nama_pasien?></td>
            <td><?=$row->alamat?></td>
            <td><?php if($row->jk==1){echo "Laki-Laki";}else{echo "Perempuan";}?></td>
            <td><?=$row->umur.' tahun'?></td>
            <td><?=$row->golongan_darah?></td>
            <td><?=agama($row->agama)?></td>
            <td><?=$row->pekerjaan?></td>
            <td><?=$row->telepon?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=pasien_ubah&amp;ID=<?=$row->kode_pasien?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=pasien_hapus&amp;ID=<?=$row->kode_pasien?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                <a class="btn btn-xs btn-default" href="?m=diagnosa&amp;ID=<?=$row->kode_pasien?>"><span class="glyphicon glyphicon-list"></span></a>
                <a class="btn btn-xs btn-info" target="_blank" href="?m=registrasi_tindakan&c=<?=$row->kode_pasien?>"><span class="glyphicon glyphicon-new-window"></span></a>
            </td>
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