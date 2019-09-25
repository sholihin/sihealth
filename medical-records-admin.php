<?php
    $kode_pasien = $_GET[ID];
    $rows = $db->get_row("select * from tb_pasien where kode_pasien = '$kode_pasien'");
    $total = 0;
?>
<style>
.form-control{
    width:30%;
}

.form-horizontal .control-label{
    text-align: left;
}
</style>

<script src="../vendor/jquery-qrcode/js/jquery-qrcode-0.17.0.min.js"></script>
<script>
window.onload = function () {
    <?php 
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
            $link = "https"; 
        else
            $link = "http"; 
        
        $link .= "://"; 
        $link .= $_SERVER['HTTP_HOST'].'/client/?page=pasien&ID='.$_GET[ID];
    ?>
    var url = '<?=$link?>';
    $('#qrcode').qrcode({
        size: 150,
        text: url
    });
}
</script>

<div class="row">
    <?php
        $tanggal = getNewDate();
        $antrian = $db->get_results("SELECT * FROM tb_antrian WHERE tanggal = '$tanggal' AND kode_pasien ='$_GET[ID]' ORDER BY kode_antrian DESC");
        $diagnosa = $db->get_row("SELECT * FROM tb_diagnosa WHERE kode_pasien ='$_GET[ID]'");
        
        $count = 0;
        if($diagnosa){
            $count += 1;
        }else if($antrian){
            $count += 1;
        }else{
            $count = 0;
        }
    ?>
    <div class="col-md-4<?=$count > 0 ? ' col-md-offset-2' : '' ?>">
        <div class="row">
        <?php
            if($antrian):
        ?>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title">Antrian</h1>
                    </div>
                    <div class="panel-body text-center">
                        <h1 style="font-size: 100px;">
                            <?=$antrian[0]->no_antrian?>
                        </h1>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php 
        if($diagnosa): ?>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title">Diagnosa</h1>
                    </div>
                    <div class="panel-body">
                        <p>
                            <i class="glyphicon glyphicon-search"></i> <?=diagnosa($rows->kode_pasien)->diagnosa ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Biodata</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="client/?page=pasien&ID=<?=$rows->kode_pasien?>"><div id="qrcode" class="img-thumbnail"></div></a>
                    </div>
                    <div class="col-md-12">
                        <h4><?=$rows->nama_pasien?></h4>
                        <h5><?=$rows->kode_pasien?></h5>
                        <p>
                            <i class="glyphicon glyphicon-user"></i> <?=jk($rows->jk)?>
                            &nbsp;
                            <i class="glyphicon glyphicon-gift"></i> <?=umur($rows->umur)?>
                            <br />
                            <i class="glyphicon glyphicon-asterisk"></i> <?=agama($rows->agama)?>
                            <br />
                            <i class="glyphicon glyphicon-phone-alt"></i> <?= $rows->telepon ? $rows->telepon : '<lable class="label label-danger">Telepon Belum diisi</lable>' ?>
                            <br />
                            <i class="glyphicon glyphicon-bookmark"></i> <?=$rows->pekerjaan ? $rows->pekerjaan : '<lable class="label label-danger">Pekerjaan Belum diisi</lable>' ?>
                            <br />
                            <i class="glyphicon glyphicon-map-marker"></i> <?=$rows->alamat?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Terapi Pengobatan</h1>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#Invoice</th>
                                <th>Tanggal</th>
                                <th>Jenis Tindakan</th>
                                <th>Biaya</th>
                            </tr>
                    </thead>
                    <tbody>
                    <?php
                        $pasiens = $db->get_results("SELECT * FROM tb_regristrasi
                                                    WHERE tb_regristrasi.kode_pasien = '$_GET[ID]' 
                                                    ORDER BY`tanggal` DESC");

                        $total = 0;
                        if($pasiens):
                        foreach($pasiens as $pasien){
                        $total += $pasien->total;
                        ?>
                        <tr>
                            <td class="col-md-1"><a href="index.php?m=detail-transaksi&trx_id=<?=$pasien->kode_regristrasi?>" class="btn btn-primary btn-xs" >#INV<?=$pasien->kode_regristrasi?> <i class="glyphicon glyphicon-search"></i></a></td>
                            <td class="col-md-2"><?=$pasien->tanggal?></td>
                            <td><?=jenis_rawat($pasien->jenis_tindakan)?></td>
                            <td>Rp. <?=$pasien->total?></td>
                        </tr>
                        <?php } else: ?>
                        <tr><td colspan="5" class="text-left"><h4>Rekam medis tidak ditemukan.</h4></td></tr>
                        <?php endif ?>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Grand Total :</strong></td>
                            <td><strong>Rp. <?=$total?></strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
