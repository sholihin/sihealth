<div class="page-header">
    <h1>Tambah Produk</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=obat_tambah">
               <div class="form-group">
                <label>Kode Obat<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode"  readonly = "readonly" value="<?=set_value('kode', kode_oto('kode_obat', 'tb_obat', 'OB', 3))?>"/>
            </div>
            <div class="form-group">
                <label>Nama Produk<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama"  value="<?=$_POST['nama']?>"/>
            </div>
             <div class="form-group">
                <label>Harga Beli<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="hargabeli"  value="<?=$_POST['hargajual']?>"/>
            </div>
            <div class="form-group">
                <label>Harga Jual<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="hargajual"  value="<?=$_POST['hargajual']?>"/>
            </div>
            <div class="form-group">
                <label>Stok<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="stok"  value="<?=$_POST['stok']?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=obat"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>