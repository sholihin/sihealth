<?php
$data = $db->get_row("select *  FROM tb_regristrasi r INNER JOIN tb_pasien p ON r.kode_pasien = p.kode_pasien 
            INNER JOIN tb_detail_tindakan t ON t.kode_regristrasi = r.kode_regristrasi
            INNER JOIN tb_tindakan td ON td.kode_tindakan = t.kode_tindakan where r.kode_regristrasi='$_GET[ID]'")?>
<h1>Nota Rawat Jalan</h1>
<th>
<td>Nama </td>
<td>:</td>
<td><?=$data->nama_pasien?></td></br>
<td>Alamat</td>
<td>:</td>
<td><?=$data->alamat?></td>
</th>
</br>
</br>
<table class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Jenis </th>
            <th>Nama </th>
            <th>Biaya</th>
            <th>Total</th>
        </tr>
       </thead>
       <?php
       $t=0;
         $q = esc_field($_GET['kodereg']);
        $row = $db->get_results("SELECT td.nama_tindakan AS nama, td.harga AS harga, p.kode_pasien,r.kode_regristrasi,t.id_detail_tindakan,'id_detail_obat' ,LEFT(td.kode_tindakan,2) AS kode 
            FROM tb_regristrasi r INNER JOIN tb_pasien p ON r.kode_pasien = p.kode_pasien 
            INNER JOIN tb_detail_tindakan t ON t.kode_regristrasi = r.kode_regristrasi
            INNER JOIN tb_tindakan td ON td.kode_tindakan = t.kode_tindakan
            WHERE t.kode_regristrasi = '$_GET[ID]' GROUP BY t.id_detail_tindakan
            UNION SELECT tn.nama_obat AS nama, tn.harga_jual AS harga, p.kode_pasien,r.kode_regristrasi,'id_detail_tindakan', o.id_detail_obat , LEFT(o.kode_obat,2) AS kode FROM tb_regristrasi r 
            INNER JOIN tb_pasien p ON r.kode_pasien = p.kode_pasien 
            INNER JOIN tb_detail_obat o ON o.kode_regristrasi = r.kode_regristrasi 
            INNER JOIN tb_obat tn ON o.kode_obat = tn.kode_obat WHERE o.kode_regristrasi = '$_GET[ID]' GROUP BY o.id_detail_obat");
        
        $no=1;
        foreach($row as $rows):
            $t= $rows->harga ;
            $total = $total + $t;?>
        <tr>
            <td><?=$no++?></td>
            <td><?php if($rows->kode =="TN"){echo"Tindakan";}else{echo"Obat";}?></td>
            <td><?=$rows->nama?></td>
            <td><?=set_num($rows->harga,2)?></td>
            <td><?=set_num($t,2)?></td>
        </tr>
        <?php endforeach;?>
</table>      
        <tr style="position: right">
            <td>Total Biaya :</td>
            <td><?=set_num($total,2)?></td>
        </tr>