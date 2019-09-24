<div class="page-header">
    <h1>Registrasi Pasien</h1>
</div>
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
        <div class="panel-body responsive">      
            <form class="inline" action="aksi.php?act=registrasi_tindakan" method="POST">
                <div class="form-horinzontal">
                    <div class="form-group">
                        <label>Kode Pasien</label>
                        <input type="hidden" class="form-control" name="kode_pasien" id="kode_pasien" value="<?=$_GET[c]?>">
                        <input type="text" class="form-control" name="pasien" id="pasien" onchange="ganti()" value="<?=pasien($_GET['c'])->kode_pasien?>">
                    </div>
                    <div class="form-group">
                        <label>Tindakan</label>
                        <select class="form-control" required name="jenis_tindakan"><?=option_tindakan()?></select>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-9 col-md-3">
                            <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-save"></span> Proses</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="vendor/jquery-ui/css/jquery-ui.css">
<!--  Sudah ada di index
    <script src="vendor/jquery-ui/js/jquery-1.12.4.js"></script> -->
<script src="vendor/jquery-ui/js/jquery-ui.js"></script>

<?php 
$pasien = $db->get_row("SELECT * FROM tb_pasien WHERE kode_pasien='$_GET[c]'"); 
$pasiens = $db->get_results("SELECT * FROM tb_pasien"); 
?>
<script>
    var pasien = <?php echo json_encode($pasien); ?>;
    var pasiens = <?php echo json_encode($pasiens); ?>;
    
    $( function() {
        var listPasien = [];
        var i;
        for(i in pasiens){
            listPasien.push(pasiens[i]['kode_pasien']+' - '+ pasiens[i]['nama_pasien']);
        }
        
        $( "#pasien" ).autocomplete({
            source: listPasien
        });

        if(pasien){
            $( "#pasien" ).val(pasien['kode_pasien']+' - '+ pasien['nama_pasien']);
        }
        
    } );

    function ganti(){
        var str = $( "#pasien" ).val();
        var value = str.slice(0, 6);
        $( "#kode_pasien" ).val(value);
    }
</script>