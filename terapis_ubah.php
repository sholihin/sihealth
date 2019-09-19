<?php
$rows = $db->get_row("select * from tb_dokter d inner join tb_poliklinik k on d.kode_poliklinik = k.kode_poliklinik where kode_dokter='$_GET[ID]'");
?>

<div class="page-header">
    <h1>Tambah Dokter</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=terapis_ubah&ID=<?=$rows->kode_dokter?>">
               <div class="form-group">
                <label>Nama Dokter <span class="text-danger">*</span></label>
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
                <label>Ruangan <span class="text-danger">*</span></label>
                <select class="form-control" type="text" name="poli"><?=option_poliklinik($rows->kode_poliklinik)?></select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=ruangan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>