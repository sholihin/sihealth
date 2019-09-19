<?php
$tanggalawal = ($_GET['tanggalawal']) ? $_GET['tanggalawal'] : date('Y-m-01');
$tanggalakhir = ($_GET['tanggalakhir']) ? $_GET['tanggalakhir'] : date('Y-m-d');

?>

<div class="page-header">
    <h1>Data Pasien</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="kunjungan_pasien" />
            <div class="form-horinzontal">
             <fieldset>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
                </div>
                 <div class="form-group">
                    <input class="form-control" type="date" name="tanggalawal" value="<?=$tanggalawal?>" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="tanggalakhir" value="<?=$tanggalakhir?>" />
                </div>
                  <div class="form-group">
                    <select class="form-control" name="kode_poliklinik" onchange="this.form.submit()"><?=option_poliklinik($_GET['kode_poliklinik'])?></select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                </div>
                <div class="form-group">
                    <a class="btn btn-warning" href="cetak.php?m=kunjungan_pasien&t_awal=<?=$tanggalawal?>&t_akhir=<?=$tanggalakhir?>&kode_poliklinik=<?=$_GET['kode_poliklinik']?>"><span class="glyphicon glyphicon-print"></span> Cetak</a>
                </div>
            </fieldset>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tanggal</th>
                <th>Kode Pasien</th>
                <th>Nama Pasien</th>
                <th>Poliklinik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $tanggal = " d.tanggal>='$tanggalawal' AND d.tanggal<='$tanggalakhir'";
        $poliklinik = " OR pl.kode_poliklinik ='$_GET[kode_poliklinik]'";

        $rows = $db->get_results("SELECT * FROM tb_pasien p INNER JOIN tb_regristrasi d 
                    ON p.kode_pasien = d.kode_pasien INNER JOIN tb_dokter dr
                    ON d.kode_dokter = dr.kode_dokter INNER JOIN tb_poliklinik pl
                    ON pl.kode_poliklinik = dr.kode_poliklinik where $tanggal $poliklinik OR p.kode_pasien like '%$q%' OR p.nama_pasien like '%$q%'  order by p.kode_pasien,d.kode_dokter");
        
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_regristrasi ?></td>
            <td><?=$row->tanggal?></td>
            <td><?=$row->kode_pasien?></td>
            <td><?=$row->nama_pasien?></td>
            <td><?=$row->nama_poliklinik?></td>
            <td class="nw">
                <a class="btn btn-xs btn-danger" href="aksi.php?act=kunjungan_pasien_hapus&amp;ID=<?=$row->kode_regristrasi?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                 <a class="btn btn-xs btn-info" href="?m=tindakan_kunjungan&amp;ID=<?=$row->kode_pasien?>&kodereg=<?=$row->kode_regristrasi?>">Tindakan</span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>