<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:5px">      
                <h4>Tambah Terapis</h4>
            </div>
            <div class="panel-body">
                <?php if($_POST) include'aksi.php'?>
                <form method="post" action="?m=terapis_tambah">
                    <div class="form-group">
                        <label>Nama Terapis <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama"  value="<?=$_POST['nama']?>"/>
                    </div>
                    <div class="form-group">
                        <label>Alamat <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat"  value="<?=$_POST['alamat']?>"/>
                    </div>
                    <div class="form-group">
                        <label>Telpon <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="telp"  value="<?=$_POST['telp']?>"/>
                    </div>
                    <div class="form-group">
                        <label>Level <span class="text-danger">*</span></label>
                        <select class="form-control" type="text" name="level_terapis" value="<?=$_POST['level_terapis']?>">
                            <option value="" disable>Pilihan</option>
                            <option value="junior">Junior</option>
                            <option value="senior">Senior</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                        <a class="btn btn-danger" href="?m=terapis"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    