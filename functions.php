<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
session_start();
$config["server"]='localhost';
$config["username"]='root';
$config["password"]='admin';
$config["database_name"]='db_rawat_jalan';

include'includes/ez_sql_core.php';
include'includes/ez_sql_mysqli.php';
$db = new ezSQL_mysqli($config['username'], $config['password'], $config['database_name'], $config['server']);
include'includes/general.php';

$mod = $_GET['m'];
$act = $_GET['act'];   
$sid = session_id();

$rows = $db->get_results("SELECT kode_poliklinik, nama_poliklinik FROM tb_poliklinik ORDER BY kode_poliklinik");
foreach($rows as $row){
    $PL[$row->kode_poliklinik] = array(
        'nama_poliklinik'=>$row->nama_poliklinik
    );
}

function option_poliklinik($selected = 0){
    global $PL;  
    foreach($PL as $key => $value){
        if($key==$selected)
            $a.="<option value='$key' selected>$value[nama_poliklinik]</option>";
        else
            $a.="<option value='$key'>$value[nama_poliklinik]</option>";
    }
    return $a;
}

function kode_oto($field, $table, $prefix, $length){
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");    
    if($var){
        return $prefix . substr( str_repeat('0', $length) . (substr($var, - $length) + 1), - $length );
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function option_obat($selected=0){
    global $db;
    $row = $db->get_results("select * from tb_obat");
    foreach ($row as $rows) {
        
            $a.="<option value='$rows->kode_obat'>$rows->nama_obat</option>";
        
      
    }
    return $a;
}

function option_pasien($selected=0){
    global $db;
    $row = $db->get_results("select * from tb_pasien");
    foreach ($row as $rows) {
         if($rows->kode_pasien==$selected)
            $a.="<option selected>$rows->kode_pasien</option>";
        else{
            $a.="<option>$rows->kode_pasien</option>";
        }
      
    }
    return $a;
}

function options_terapis($selected=0){
    global $db;
    $row = $db->get_results("select * from tb_dokter");
    foreach ($row as $rows) {
        if($rows->kode_dokter==$selected)
            $a.="<option selected value='$rows->kode_dokter'>$rows->nama_dokter</option>";
        else
            $a.="<option value='$rows->kode_dokter'>$rows->nama_dokter</option>";
        
      
    }
    return $a;
}

function set_num($angka,$pemisah){
    $a.= number_format($angka,$pemisah,",",".");
    return $a;
}
function set_value($key = null, $default = null){
    global $_POST;
    if(isset($_POST[$key]))
        return $_POST[$key];
        
    if(isset($_GET[$key]))
        return $_GET[$key];
        
    return $default;
}

function oprator($name){
    global $db;
    $row = $db->get_row("SELECT * FROM tb_user WHERE username = 'admin'");
    return $row;
}

function pasien($kode){
    global $db;
    $row = $db->get_row("SELECT * FROM tb_pasien WHERE kode_pasien = '$kode'");
    return $row;
}

function diagnosa($kode_pasien){
    global $db;
    $row = $db->get_row("SELECT * FROM tb_diagnosa WHERE kode_pasien = '$kode_pasien'");
    return $row;
}

function option_tindakan(){
    $option = array(
        array('key'=>'', 'value' => 'Pilihan', 'selected' => 'selected disabled'),
        array('key'=>'rawat_jalan', 'value' => 'Rawat Jalan', 'selected' => ''),
        array('key'=>'rawat_inap', 'value' => 'Rawat Inap', 'selected' => '')
    );
    foreach($option as $x){
        $a.="<option value='$x[key]' $x[selected]>$x[value]</option>";
    }

    return $a;
}

function getNewDate(){
    date_default_timezone_set("Asia/Jakarta");
    return date("Y-m-d");
}

function getNewDateTime(){
    date_default_timezone_set("Asia/Jakarta");
    return date("Y-m-d H:i:s");
}

function agama($title){
    $result = '';
    switch ($title) {
        case 'islam':
            $result = 'Islam';
            break;
        case 'kristen_protestan':
            $result = 'Kristen Protestan';
            break;
        case 'katolik':
            $result = 'Katolik';
            break;
        case 'hindu':
            $result = 'Hindu';
            break;
        case 'buddha':
            $result = 'Buddha';
            break;
        case 'kong_hu_cu':
            $result = 'Kong Hu Cu';
            break;
        
        default:
            $result = '<label class="label label-danger">Agama Belum diisi</label>';
            break;
    }
    return $result;
}

function jk($var){
    $result = '';
    switch ($var) {
        case 'L':
            $result = 'Laki-laki';
            break;
        case 'P':
            $result = 'Perempuan';
            break;
        default:
            $result = '<label class="label label-danger">Jenis kelamin belum diisi</label>';
            break;
    }
    return $result;
}

function umur($var){
    $result = '';
    if($var)
        $result = $var.' tahun';
    else
        $result = '<label class="label label-danger">Umur belum diisi</label>';
    return $result;
}

function getAntrian($kode_pasien){
    global $db;
    $tanggal = getNewDate();
    $antrian = $db->get_results("SELECT max(no_antrian) as no_antrian FROM tb_antrian WHERE tanggal = '$tanggal'");
    $no_antrian = $antrian[0]->no_antrian + 1;
    $db->query("INSERT INTO tb_antrian (no_antrian,kode_pasien,tanggal) VALUES('$no_antrian', '$kode_pasien', '$tanggal')");
}

function getPrefixCode($code){
    $item = substr($code,0,2);
    $jenis = '';

    if($item == 'OB'){
        $jenis = 'obat';
    }elseif($item == 'TN'){
        $jenis = 'terapi';
    }else{
        $jenis = "tidak tersedia!";
    }

    return  $jenis;
}

function countPriceOfProduct($query){
    $total = 0;
    
    foreach($query as $x){
        $total += $x->jumlah_produk * $x->harga_jual;
    }

    return $total;
}

function countPriceOfTerapi($query){
    $total = 0;
    
    foreach($query as $x){
        if($x->discount > 1 && $x->discount < 100){
            $total += $x->harga - (($x->harga * $x->discount) / 100);
        }elseif($x->discount < 1){
            $total += $x->harga;
        }elseif($x->discount > 99){
            $total += $x->harga - $x->discount;
        }else{
            $total += $x->harga;
        }
    }

    return $total;
}

// HALAMAN PASIEN
function terapis($id){
    global $db;
    $results = $db->get_row("SELECT * FROM tb_dokter WHERE kode_dokter = '$id'");
    return $results;
}

function terapi($id){
    global $db;
    $results = $db->get_row("SELECT * FROM tb_tindakan WHERE kode_tindakan = '$id'");
    return $results;
}

function jenis_rawat($str){
    if($str == 'rawat_inap'){
        $str = "Rawat Inap";
    }else if($str == 'rawat_jalan'){
        $str = "Rawat Jalan";
    }else{
        $str = '<label class="label label-danger">Tidak Terdaftar</label>';
    }

    return $str;
}

function getTransaksi($kode){
    global $db;
    $reg = $db->get_row("SELECT * FROM `tb_regristrasi` WHERE kode_regristrasi = '$kode'");
    return $reg;
}

?>