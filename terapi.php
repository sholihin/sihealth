
<div class="page-header">
    <h1>Terapi</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="tindakan" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=terapi_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Tindakan</th>
                <th>Harga</th>
                <th class="col-md-1">Komisi Senior</th>
                <th class="col-md-1">Komisi Junior</th>
                <th>Aksi</th>
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
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=terapi_ubah&ID=<?=$row->kode_tindakan?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=terapi_hapus&ID=<?=$row->kode_tindakan?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>