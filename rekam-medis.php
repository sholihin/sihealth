<?php
$rekam = $db->get_row("select * from tb_detail_tindakan where id_detail_tindakan = '$_GET[id]'");
$total = 0;
?>
<div class="page-header">
    <h1>Rekam Medis</h1>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4>Hasil Tindakan</h4>
            </div>
            <div class="panel-body ">
                <div class="form-vertical">
                    <form action="aksi.php?act=rekam-medis&id=<?=$_GET[id]?>&c=<?=$_GET[c]?>" method="POST">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" style="height: 200px;" name="rekam_medis"><?=$rekam->rekam_medis ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-warning"><i class="glyphicon glyphicon-ok"></i> Rekam</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>