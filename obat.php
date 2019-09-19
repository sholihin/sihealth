
<div class="page-header">
    <h1>Produk</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="obat" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=obat_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-warning" href="cetak.php?m=obat"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>

        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
      
        $rows = $db->get_results("SELECT * FROM tb_obat 
                                  WHERE  kode_obat LIKE '%$q%' OR nama_obat LIKE '%$q%'
                                  ORDER BY kode_obat");
        
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_obat ?></td>
            <td><?=$row->nama_obat?></td>
            <td><?=set_num($row->harga_beli,2)?></td>
            <td><?=set_num($row->harga_jual,2)?></td>
            <td><?=$row->stok?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=obat_ubah&amp;ID=<?=$row->kode_obat?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=obat_hapus&amp;ID=<?=$row->kode_obat?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>