<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="pull-left" style="margin-top:10px">Registrasi Online</h3>
                    <div class="btn-group pull-right">
                        <a href="#Registration" data-toggle="tab" class="btn btn-primary">Daftar Baru</a>
                        <a href="#Login" data-toggle="tab" class="btn btn-danger">Sudah Pernah Daftar</a> 
                    </div>
                </div>
                <div class="modal-body">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane" id="Login">
                            <form action="../aksi.php?act=registrasi-pasien-lama" method="POST">
                                <div class="form-group">
                                    <label>Kode Pasien</label>
                                    <input type="hidden" class="form-control" name="kode_pasien" id="kode_pasien" value="">
                                    <input type="text" class="form-control" name="pasien" id="pasien" onchange="ganti()" value="">
                                </div>
                                <div class="form-group">
                                    <label>Tindakan</label>
                                    <select class="form-control" required name="jenis_tindakan">
                                        <option value='' selected disabled>Pilihan</option>
                                        <option value='0'>Rawat Jalan</option>
                                        <?php
                                            $options = $db->get_results("SELECT * FROM tb_kategori_tindakan");
                                            foreach($options as $x){
                                                echo "<option value='$x->kode_kategori'>$x->nama_kategori</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <div class="col-md-offset-9 col-md-3">
                                            <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-save"></span> Proses</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane active" id="Registration">
                            <form method="post" action="../aksi.php?m=register">
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
                                    <select class="form-control" required name="jenis_tindakan">
                                        <option value='' selected disabled>Pilihan</option>
                                        <option value='0'>Rawat Jalan</option>
                                        <?php
                                            $options = $db->get_results("SELECT * FROM tb_kategori_tindakan");
                                            foreach($options as $x){
                                                echo "<option value='$x->kode_kategori'>$x->nama_kategori</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <label class="pull-left text-danger">*<small> wajib di isi..</small></label>
                                    <div class="form-group">
                                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="../vendor/jquery-ui/css/jquery-ui.css">
<!-- <script src="../vendor/jquery-ui/js/jquery-1.12.4.js"></script> -->
<script src="../vendor/jquery-ui/js/jquery-ui.js"></script>

<?php 
$pasiens = $db->get_results("SELECT * FROM tb_pasien"); 
?>
<script>
    var pasiens = <?php echo json_encode($pasiens); ?>;
    $( function() {
        var listPasien = [];
        var i;
        for(i in pasiens){
            listPasien.push(pasiens[i]['kode_pasien']+' - '+ pasiens[i]['nama_pasien']+' - '+ pasiens[i]['telepon']);
        }
        
        $( "#pasien" ).autocomplete({
            source: listPasien
        });
        
    } );

    function ganti(){
        var str = $( "#pasien" ).val();
        var value = str.slice(0, 7);
        $( "#kode_pasien" ).val(value);
    }
</script>