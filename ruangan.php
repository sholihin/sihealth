
<div class="page-header">
    <h1>Ruangan</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="ruangan" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=ruangan_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="oxa">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Ruangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
      
        $rows = $db->get_results("SELECT * FROM tb_poliklinik 
                                  WHERE  kode_poliklinik LIKE '%$q%' OR nama_poliklinik LIKE '%$q%' 
                                  ORDER BY kode_poliklinik");
        
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_poliklinik ?></td>
            <td><?=$row->nama_poliklinik?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=ruangan_ubah&amp;ID=<?=$row->kode_poliklinik?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=ruangan_hapus&amp;ID=<?=$row->kode_poliklinik?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>