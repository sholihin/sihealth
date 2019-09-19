<?php
$row = $db->get_row("SELECT * FROM tb_pasien WHERE kode_pasien ='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Pasien</h1>
</div>
<div class="row">
    <?php if($_POST) include'aksi.php'?>
    <form method="post" action="?m=pasien_ubah&ID=<?=$row->kode_pasien?>">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-body responsive">
                    <div class="form-group">
                        <label>Kode Pasien<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode"  readonly = "readonly" value="<?=set_value('kode', $row->kode_pasien)?>"/>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama"  value="<?=set_value('nama',$row->nama_pasien)?>"/>
                    </div>
                    <div class="form-group">
                        <label>Alamat<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat"  value="<?=set_value('almaat',$row->alamat)?>"/>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin<span class="text-danger">*</span></label>
                        <select class="form-control" type="text" name="jk">
                        <option value="">Pilihan</option>
                        <option value="L" <?php echo $row->jk == 'L' ? 'selected' : ''; ?>>Laki-Laki</option>
                        <option value="P" <?php echo $row->jk == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Umur<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="umur"  value="<?=set_value('umur',$row->umur)?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-body responsive">      
                    <div class="form-group">
                        <label>Golongan Darah<span class="text-danger"></span></label>
                        <select class="form-control" type="text" name="golongan_darah"/>
                            <option value="">Pilihan</option>
                            <option value="A" <?php echo $row->golongan_darah == 'A' ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?php echo $row->golongan_darah == 'B' ? 'selected' : ''; ?>>B</option>
                            <option value="AB" <?php echo $row->golongan_darah == 'AB' ? 'selected' : ''; ?>>AB</option>
                            <option value="O" <?php echo $row->golongan_darah == 'O' ? 'selected' : ''; ?>>O</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Agama<span class="text-danger"></span></label>
                        <select class="form-control" type="text" name="agama"/>
                            <option value="">Pilihan</option>
                            <option value="islam" <?php echo $row->agama == 'islam' ? 'selected' : ''; ?>>Islam</option>
                            <option value="kristen_protestan" <?php echo $row->agama == 'kristen_protestan' ? 'selected' : ''; ?>>Kristen Protestan</option>
                            <option value="katolik" <?php echo $row->agama == 'katolik' ? 'selected' : ''; ?>>Katolik</option>
                            <option value="hindu" <?php echo $row->agama == 'hindu' ? 'selected' : ''; ?>>Hindu</option>
                            <option value="buddha" <?php echo $row->agama == 'buddha' ? 'selected' : ''; ?>>Buddha</option>
                            <option value="kong_hu_cu" <?php echo $row->agama == 'kong_hu_cu' ? 'selected' : ''; ?>>Kong Hu Cu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan<span class="text-danger"></span></label>
                        <input class="form-control" type="text" name="pekerjaan"  value="<?=$row->pekerjaan?>"/>
                    </div>
                    <div class="form-group">
                        <label>Telepon<span class="text-danger"></span></label>
                        <input class="form-control" type="text" name="telepon"  value="<?=$row->telepon?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=pasien"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </div>
    </form>
</div>