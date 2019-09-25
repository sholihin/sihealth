<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:5px">      
                <h4>Tambah User</h4>
            </div>
            <div class="panel-body">
                <?php if($_POST) include'aksi.php'?>
                <form method="post" action="?m=user_tambah">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="user"  value="<?=$_POST['user']?>"/>
                    </div>
                    <div class="form-group">
                        <label>Password<span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="pass"  value="<?=$_POST['pass']?>"/>
                    </div>
                    <div class="form-group">
                        <label>Jabatan<span class="text-danger">*</span></label>
                        <select class="form-control" name="jabatan">
                            <option value="" selected disable>Pilihan</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                        <a class="btn btn-danger" href="?m=user"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>