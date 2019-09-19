
<div class="page-header">
    <h1>User</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="user" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=user_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
      
        $rows = $db->get_results("SELECT * FROM tb_user 
                                  WHERE  username LIKE '%$q%' OR jabatan LIKE '%$q%'
                                  ORDER BY id_user");
        
        $no=1;
        foreach($rows as $row):?>
        <tr>
            <td><?=$no++ ?></td>
            <td><?=$row->username?></td>
            <td><?=$row->jabatan?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=user_ubah&amp;ID=<?=$row->id_user?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=user_hapus&amp;ID=<?=$row->id_user?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>