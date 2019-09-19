<?php
$row = $db->get_row("select * from tb_obat where kode_obat='$_GET[ID]'");
?>

<div class="page-header">
    <h1>Ubah Produk</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=obat_ubah&ID=<?=$row->kode_obat?>">
               <div class="form-group">
                <label>Kode Produk<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode"  readonly = "readonly" value="<?=$row->kode_obat?>"/>
            </div>
            <div class="form-group">
                <label>Nama Produk<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama"  value="<?=$row->nama_obat?>"/>
            </div>
             <div class="form-group">
                <label>Harga Beli<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="hargabeli"  value="<?=$row->harga_beli?>"/>
            </div>
            <div class="form-group">
                <label>Harga Jual<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="hargajual"  value="<?=$row->harga_jual?>"/>
            </div>
            <div class="form-group">
                <label>Stok<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="stok"  value="<?=$row->stok?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=obat"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>