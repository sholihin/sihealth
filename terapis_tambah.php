<div class="page-header">
    <h1>Tambah Dokter</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=terapis_tambah">
               <div class="form-group">
                <label>Nama Dokter <span class="text-danger">*</span></label>
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
                <label>Ruangan <span class="text-danger">*</span></label>
                <select class="form-control" type="text" name="poli"><?=option_poliklinik()?></select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=ruangan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>