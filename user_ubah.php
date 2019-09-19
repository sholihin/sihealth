<?php
$row = $db->get_row("select * from tb_user where id_user='$_GET[ID]'");
?>

<div class="page-header">
    <h1>Ubah User</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=user_ubah&ID=<?=$row->id_user?>">
              <div class="form-group">
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="user"  value="<?=$row->username?>"/>
            </div>
             <div class="form-group">
                <label>Password<span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass"  value="<?=$row->password?>"/>
            </div>
            <div class="form-group">
                <label>Jabatan<span class="text-danger">*</span></label>
                <select class="form-control" name="jabatan">
                    <option>Admin</option>
                    <option>Dokter</option>
                    <option>Apoteker</option>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=user"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>