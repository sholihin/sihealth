<div class="page-header">
    <h1>Tambah Tindakan</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=terapi_tambah">
               <div class="form-group">
                <label>Kode Tindakan <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode"  readonly = "readonly" value="<?=set_value('nip', kode_oto('kode_tindakan', 'tb_tindakan', 'TN', 3))?>"/>
            </div>
            <div class="form-group">
                <label>Nama Tindakan <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama"  value="<?=$_POST['nama']?>"/>
            </div>
            <div class="form-group">
                <label>Harga <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="harga"  value="<?=$_POST['harga']?>"/>
            </div>
            <div class="form-group">
                <label>Komisi Senior <span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="senior" value="<?=$_POST['senior']?>"/>
            </div>
            <div class="form-group">
                <label>Komisi Junior <span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="junior" value="<?=$_POST['junior']?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=terapi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>