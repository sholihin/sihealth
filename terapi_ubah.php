<?php
$row = $db->get_row("select * from tb_tindakan where kode_tindakan='$_GET[ID]'");
?>

<div class="page-header">
    <h1>Tambah Tindakan</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=terapi_ubah&ID=<?=$row->kode_tindakan?>">
               <div class="form-group">
                <label>Kode Tindakan <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode"  readonly = "readonly" value="<?=$row->kode_tindakan?>"/>
            </div>
            <div class="form-group">
                <label>Nama Tindakan <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama"  value="<?=$row->nama_tindakan?>"/>
            </div>
             <div class="form-group">
                <label>Harga <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="harga"  value="<?=$row->harga?>"/>
            </div>
            <div class="form-group">
                <label>Komisi Senior <span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="ujroh_senior"  value="<?=$_POST['ujroh_senior']?>"/>
            </div>
            <div class="form-group">
                <label>Komisi Junior <span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="ujroh_junior"  value="<?=$_POST['ujroh_junior']?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=terapi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>