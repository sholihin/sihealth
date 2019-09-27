<?php
$row = $db->get_row("select * from tb_kategori_tindakan where kode_kategori='$_GET[ID]'");
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:5px">      
                <h4>Ubah Paket</h4>
            </div>
            <div class="panel-body">
                <?php if($_POST) include'aksi.php'?>
                <form method="post" action="?m=kategori_terapi_ubah&ID=<?=$row->kode_kategori?>">
                    <div class="form-group">
                        <label>Nama Paket <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama" value="<?=$row->nama_kategori?>"/>
                    </div>
                    <div class="form-group">
                        <label>Harga <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="harga" value="<?=$row->harga?>"/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                        <a class="btn btn-danger" href="?m=kategori_terapi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
    