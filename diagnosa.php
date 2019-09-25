<div class="col-md-6 col-md-offset-3">
    <?php 
        if(!$_GET[ID]){ 
            print_msg("Kode pasien tidak terdaftar!");
        } 
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Diagnosa Pasien</h4>
        </div>
        <div class="panel-body responsive">      
            <form class="inline" action="aksi.php?act=diagnosa" method="POST" id="form-diagnosa">
                <div class="form-horinzontal">
                    <div class="form-group">
                        <label>Kode Pasien</label>
                        <input type="text" class="form-control" readonly name="kode_pasien" value="<?=pasien($_GET['ID'])->kode_pasien?>">
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" class="form-control" readonly name="nama" value="<?=pasien($_GET['ID'])->nama_pasien?>">
                    </div>
                    <div class="form-group">
                        <label>Hasil Diagnosa</label>
                        <textarea class="form-control" style="height:300px" name="diagnosa"><?=diagnosa($_GET['ID'])->diagnosa?></textarea>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-9 col-md-3">
                            <button type="button" onClick="save()" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-save"></span> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

function save(){
    $("#form-diagnosa").submit();
}
</script>