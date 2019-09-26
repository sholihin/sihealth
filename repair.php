<?php
// include "functions.php";

// $pasiens = $db->get_results("select * from tb_pasien");
// $no = 0;
// foreach($pasiens as $pasien){
//     $no += 1;
//     $new_kode_pasien = set_value('kode', kode_oto('kode_pasien', 'tb_pasien', 'RSB', 4));
//     $db->query("UPDATE tb_pasien SET kode_pasien = '$new_kode_pasien' WHERE kode_pasien = '$pasien->kode_pasien'");
//     $db->query("UPDATE tb_diagnosa SET kode_pasien = '$new_kode_pasien' WHERE kode_pasien = '$pasien->kode_pasien'");
//     echo $no.'. '.$pasien->kode_pasien. '=> '.$new_kode_pasien.'<br>';
// }
?>