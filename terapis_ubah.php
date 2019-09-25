<?php
$rows = $db->get_row("select * from tb_dokter where kode_dokter='$_GET[ID]'");
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:5px">      
                <h4>Tambah Terapis</h4>
            </div>
            <div class="panel-body">
                <?php if($_POST) include'aksi.php'?>
                <form method="post" action="?m=terapis_ubah&ID=<?=$rows->kode_dokter?>">
                    <div class="form-group">
                        <label>Nama Terapis <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama"  value="<?=set_value('nama',$rows->nama_dokter)?>"/>
                    </div>
                    <div class="form-group">
                        <label>Alamat <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat"  value="<?=set_value('alamat',$rows->alamat)?>"/>
                    </div>
                    <div class="form-group">
                        <label>Telpon <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="telp"  value="<?=set_value('telp',$rows->telp)?>"/>
                    </div>
                    <div class="form-group">
                        <label>Level <span class="text-danger">*</span></label>
                        <select class="form-control" type="text" name="level_terapis"  value="<?=$_POST['level_terapis']?>">
                            <option value="" disable>Pilihan</option>
                            <option value="junior" <?=$rows->level_terapis == 'junior' ? 'selected' : ''?>>Junior</option>
                            <option value="senior" <?=$rows->level_terapis == 'senior' ? 'selected' : ''?>>Senior</option>
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
    