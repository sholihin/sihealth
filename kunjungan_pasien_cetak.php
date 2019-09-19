<div class="page-header">
    <h1>Kunjungan Pasien</h1>
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
        $tanggal = " d.tanggal>='$_GET[t_awal]' AND d.tanggal<='$_GET[t_akhir]'";
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
           
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
