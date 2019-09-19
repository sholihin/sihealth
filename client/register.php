<div class="page-header">
    <h1>Registrasi Online</h1>
</div>
<div class="row">
        <form method="post" action="../aksi.php?m=register">
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-body responsive">
                        <div class="form-group">
                            <label>Kode Pasien <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="kode"  readonly = "readonly" value="<?=set_value('kode', kode_oto('kode_pasien', 'tb_pasien', 'RM', 7))?>"/>
                        </div>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" required name="nama"  value="<?=$_POST['nama']?>"/>
                        </div>
                        <div class="form-group">
                            <label>Alamat<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" required name="alamat"  value="<?=$_POST['alamat']?>"/>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin<span class="text-danger">*</span></label>
                            <select class="form-control" type="text" required name="jk"/>
                            <option value="">Pilihan</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Umur<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="umur" required min="1" name="umur" value="<?=$_POST['umur']?>"/>
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
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Agama<span class="text-danger"></span></label>
                            <select class="form-control" type="text" name="agama"/>
                                <option value="">Pilihan</option>
                                <option value="islam">Islam</option>
                                <option value="kristen_protestan">Kristen Protestan</option>
                                <option value="katolik">Katolik</option>
                                <option value="hindu">Hindu</option>
                                <option value="buddha">Buddha</option>
                                <option value="kong_hu_cu">Kong Hu Cu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan<span class="text-danger"></span></label>
                            <input class="form-control" type="text" name="pekerjaan"  value="<?=$_POST['pekerjaan']?>"/>
                        </div>
                        <div class="form-group">
                            <label>Telepon<span class="text-danger"></span></label>
                            <input class="form-control" type="text" name="telepon"  value="<?=$_POST['telepon']?>"/>
                        </div>
                        <div class="form-group">
                            <label>Tindakan</label>
                            <select class="form-control" required name="jenis_tindakan"><?=option_tindakan()?></select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Daftar</button>
                </div>
            </div>
        </form>
    </div>
</div>