
<div class="page-header">
    <h1>Terapis</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="terapis" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=terapis_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Dokter</th>
                <th>Alamat</th>
                <th>Telpon</th>
                <th>Nama Poliklinik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
      
        $rows = $db->get_results("SELECT * FROM tb_dokter t INNER JOIN tb_poliklinik p
                                  ON t.kode_poliklinik = p.kode_poliklinik
                                  WHERE  kode_dokter LIKE '%$q%' OR nama_dokter LIKE '%$q%'
                                  OR alamat LIKE '%$q%' OR telp LIKE '%$q%'
                                  ORDER BY kode_dokter");
        
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_dokter ?></td>
            <td><?=$row->nama_dokter?></td>
            <td><?=$row->alamat?></td>
            <td><?=$row->telp?></td>
            <td><?=$row->nama_poliklinik?></td>
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