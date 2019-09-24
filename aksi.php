<?php
require_once'functions.php';
/**LOGIN */ 
if ($act=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    
    $row = $db->get_row("SELECT * FROM tb_user WHERE username='$user' AND password='$pass'");
    if($row){
        $_SESSION['login'] = $row->username;
        $_SESSION['jabatan'] = $row->jabatan;
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }         
}

/** USER */    
if($mod=='user_tambah'){
   
    $user =$_POST['user'];
    $pass = $_POST['pass'];
    $jabatan = $_POST['jabatan'];
    if($user==''||$pass==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else
    {
        $db->query("insert into tb_user(username,password,jabatan) values('$user','$pass','$jabatan')");
        redirect_js("index.php?m=user");
    }
                    
} else if($mod=='user_ubah'){
    $user =$_POST['user'];
    $pass = $_POST['pass'];
    $jabatan = $_POST['jabatan'];
    if($user==''||$pass==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else
    {
        $db->query("update tb_user set username='$user',password='$pass',jabatan='$jabatan' where id_user='$_GET[ID]'");
        redirect_js("index.php?m=user");
    }
} else if ($act=='user_hapus'){
    $db->query("delete from tb_user where id_user='$_GET[ID]'");
    header("location:index.php?m=user");
} 


/**PASSWORD */
else if ($mod=='password'){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];
    
    $row = $db->get_row("SELECT * FROM tb_user WHERE username='$_SESSION[login]' AND password='$pass1'");        
    
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg('Field bertanda * harus diisi.');
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif( $pass2 != $pass3 )
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE tb_user SET password='$pass2' WHERE username='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif($act=='logout'){
    unset($_SESSION[login]);
    header("location:login.php");
}


/** Ruangan */    
if($mod=='ruangan_tambah'){
    $nama = $_POST['nama'];
    
    if($nama==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }
    
    else{
        $db->query("INSERT INTO tb_poliklinik (nama_poliklinik) VALUES ('$nama')");          
       redirect_js("index.php?m=ruangan");
    }                    
}else if($mod=='ruangan_ubah'){
    $nama = $_POST['nama'];
    if($nama==''){
         print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $db->query("update tb_poliklinik set nama_poliklinik ='$nama' where kode_poliklinik ='$_GET[ID]' ");
        redirect_js('index.php?m=ruangan');
    }
}else if($act=='ruangan_hapus'){
    $db->query("delete from tb_poliklinik where kode_poliklinik='$_GET[ID]'");
    header("location:index.php?m=ruangan");
}


/** Trapis */    
if($mod=='terapis_tambah'){
   
    $nama =$_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $level = $_POST['level_terapis'];
    if($nama==''||$alamat==''||$telp==''||$level==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else
    {
        $db->query("insert into tb_dokter(nama_dokter,alamat,telp,level_terapis) values('$nama','$alamat','$telp','$level')");
        redirect_js("index.php?m=terapis");
    }
                    
} else if($mod=='terapis_ubah'){
    $nama =$_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $level = $_POST['level_terapis'];
    if($nama==''||$alamat==''||$telp==''||$level==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else
    {
        $db->query("update tb_dokter set nama_dokter='$nama',alamat='$alamat',telp='$telp', level_terapis='$level' where kode_dokter ='$_GET[ID]'");
        redirect_js("index.php?m=terapis");
    }
} else if ($act=='terapis_hapus'){
    $db->query("delete from tb_dokter where kode_dokter='$_GET[ID]'");
    header("location:index.php?m=terapis");
} 


/**TINDAKAN */
if($mod=='terapi_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $senior = $_POST['senior'];
    $junior = $_POST['junior'];

    if($nama==''||$harga==''||$senior==''||$junior==''){ 
        print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $db->query("insert into tb_tindakan (kode_tindakan,nama_tindakan,harga,ujroh_senior,ujroh_junior) values('$kode','$nama','$harga','$senior','$junior')");
        redirect_js("index.php?m=terapi");
    }

}elseif($mod=='terapi_ubah'){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $ujroh_senior = $_POST['ujroh_senior'];
    $ujroh_junior = $_POST['ujroh_junior'];

    if($nama==''||$harga==''){ 
        print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $db->query("update tb_tindakan set nama_tindakan='$nama',harga='$harga', ujroh_senior='$ujroh_senior',ujroh_junior='$ujroh_junior'  where kode_tindakan='$_GET[ID]'");
        redirect_js("index.php?m=terapi");
    }
}elseif($act =='terapi_hapus'){
$db->query("delete from tb_tindakan where kode_tindakan='$_GET[ID]'");
header("location:index.php?m=terapi");
}


/**OBAT*/
if($mod=='obat_tambah'){
    $kode=$_POST['kode'];
    $nama=$_POST['nama'];
    $hargab=$_POST['hargabeli'];
    $hargaj=$_POST['hargajual'];
    $stok =$_POST['stok'];

    if($nama ==''||$hargab==''||$hargaj==''||$stok==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $db->query("insert into tb_obat (kode_obat,nama_obat,harga_beli,harga_jual,stok) values('$kode','$nama','$hargab','$hargaj','$stok')");
        redirect_js("index.php?m=obat");
    }
}elseif($mod=='obat_ubah'){
    $kode=$_POST['kode'];
    $nama=$_POST['nama'];
    $hargab=$_POST['hargabeli'];
    $hargaj=$_POST['hargajual'];
    $stok =$_POST['stok'];

    if($nama ==''||$hargab==''||$hargaj==''||$stok==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $db->query("update tb_obat set nama_obat ='$nama',harga_beli='$hargab',harga_jual='$hargaj',stok='$stok' where kode_obat='$_GET[ID]'");
        redirect_js("index.php?m=obat");
    }
}elseif($act=='obat_hapus'){
    $db->query("delete from tb_obat where kode_obat='$_GET[ID]'");
    header("location:index.php?m=obat");
}


/**PASIEN*/
if($mod=='pasien_tambah'){
    $kode = set_value('kode', kode_oto('kode_pasien', 'tb_pasien', 'RSB', 4));
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk=$_POST['jk'];
    $umur = $_POST['umur'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $telepon = $_POST['telepon'];
    $golongan_darah = $_POST['golongan_darah'];

    if($nama ==''||$alamat==''||$jk==''||$umur==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $db->query("insert into tb_pasien (kode_pasien,nama_pasien,alamat,jk,umur,agama,pekerjaan,telepon,golongan_darah) values('$kode','$nama','$alamat','$jk','$umur','$agama','$pekerjaan','$telepon','$golongan_darah')");
        redirect_js("index.php?m=pasien");
    }
}elseif($mod=='pasien_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk=$_POST['jk'];
    $umur = $_POST['umur'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $telepon = $_POST['telepon'];
    $golongan_darah = $_POST['golongan_darah'];

    if($nama ==''||$alamat==''||$jk==''||$umur==''){
    print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $db->query("update tb_pasien set nama_pasien='$nama',alamat='$alamat',jk='$jk',umur='$umur',agama='$agama',pekerjaan='$pekerjaan',telepon='$telepon',golongan_darah='$golongan_darah' where kode_pasien='$_GET[ID]'");
        redirect_js("index.php?m=pasien");
    }
}elseif($act=='pasien_hapus'){
    $db->query("DELETE FROM tb_pasien WHERE kode_pasien='$_GET[ID]'");
    header("location:index.php?m=pasien");
}

/**Kunjungan Pasien*/
if($mod=='regristrasi_lama'){
    $tanggal = date("Y/m/d");
    if(empty($_GET['kode_dokter']))
    {
        $r = $db->get_row("select * from tb_dokter d inner join tb_poliklinik p on d.kode_poliklinik = p.kode_poliklinik where d.kode_poliklinik='$_GET[kode_poliklinik]'");
        $kode_dokter = $r->kode_dokter;
    }else{
         $kode_dokter = $_GET['kode_dokter'];
    }
    $db->query("insert into tb_regristrasi (tanggal,kode_pasien,kode_dokter) values('$tanggal','$_GET[kode_pasien]','$kode_dokter')");
    header("location:index.php?m=registrasi");

}elseif($mod=='registrasi'){
    $kode = $_POST['kode_dokter'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk=$_POST['jk'];
    $umur = $_POST['umur'];

    if($nama ==''||$alamat==''||$jk==''||$umur==''){
    
    }else{
        $db->query("insert into tb_pasien (kode_pasien,nama_pasien,alamat,jk,umur) values('$kode','$nama','$alamat','$jk','$umur')");
        redirect_js("index.php?m=registrasi");
    }
}elseif($act =='tindakan_kunjungan'){
    $tindakan = $_POST['tindakan'];
    $obat = $_POST['obat'];
    $kode = $_GET['kodereg'];
    $ID = $_GET['ID'];
    if($obat!='' && $tindakan!=''){
        $db->query("insert into tb_detail_tindakan (kode_regristrasi,kode_tindakan) values('$_GET[kodereg]','$tindakan')");
        $db->query("insert into tb_detail_obat (kode_regristrasi,kode_obat) values('$_GET[kodereg]','$obat')");
    }elseif($obat ==''){
        $db->query("insert into tb_detail_tindakan (kode_regristrasi,kode_tindakan) values('$_GET[kodereg]','$tindakan')");
    }elseif($tindakan ==''){
         $db->query("insert into tb_detail_obat (kode_regristrasi,kode_obat) values('$_GET[kodereg]','$obat')");
    }
         

   header("location:index.php?m=tindakan_kunjungan&ID=$ID&kodereg=$kode");
}elseif ($act == 'kunjungan_pasien_hapus') {
  $db->query("DELETE FROM tb_regristrasi WHERE kode_regristrasi = '$_GET[ID]'");
  $db->query("DELETE FROM tb_detail_obat WHERE kode_regristrasi = '$_GET[ID]'");
  $db->query("DELETE FROM tb_detail_tindakan WHERE kode_regristrasi = '$_GET[ID]'");
        header("location:index.php?m=kunjungan_pasien");
}elseif($act=="tindakan_kunjungan_hapus"){
    if($_GET['kode']=='TN'){
        $db->query("DELETE FROM `tb_detail_tindakan` WHERE `id_detail_tindakan` = $_GET[kodetindakan]"); 
    }else{
        $db->query("DELETE FROM tb_detail_obat WHERE id_detail_obat ='$_GET[kodeobat]'");
    }
    header("location:index.php?m=tindakan_kunjungan&c=$_GET[ID]");
}elseif($act=='logout'){
    unset($_SESSION[login]);
    header("location:login.php");
}

/**SHOLIHIN SCRIPT*/
/**PROSES REGISTRASI PASIEN*/
if($act=='registrasi_tindakan'){
    $tanggal = getNewDate();
    $kode_pasien = $_POST['kode_pasien'];
    $jenis_tindakan = $_POST['jenis_tindakan'];

    if($kode_pasien ==''){
        print_msg("Pasien tidak terdaftar!");
        header("location:index.php?m=registrasi_tindakan&c=$kode_pasien");
    }else{
        $pasien = $db->get_row("SELECT * FROM tb_pasien WHERE kode_pasien = '$kode_pasien'");
        if($pasien->transaksi_id != NULL){
            $db->query("UPDATE tb_regristrasi SET jenis_tindakan='$jenis_tindakan' WHERE kode_regristrasi = '$pasien->transaksi_id'");
            header("location:index.php?m=tindakan_kunjungan&c=".$pasien->kode_pasien);
        }else{
            getAntrian($kode_pasien);
            $db->query("INSERT INTO tb_regristrasi (tanggal, kode_pasien, total, jenis_tindakan) values('$tanggal','$kode_pasien', 0, '$jenis_tindakan')");
            $db->query("UPDATE tb_pasien SET transaksi_id='$db->insert_id' WHERE kode_pasien = '$kode_pasien'");
            header("location:index.php?m=tindakan_kunjungan&c=$kode_pasien");
        }
        
    }
}

if($act=='diagnosa'){
    $tanggal = getNewDate();
    $kode_pasien = $_POST['kode_pasien'];
    $diagnosa = $_POST['diagnosa'];

    if($kode_pasien ==''){
        alert("Pasien tidak terdaftar!");
        header("location:index.php?m=pasien");
    }else{
        $pasien = $db->get_row("SELECT * FROM tb_diagnosa WHERE kode_pasien = '$kode_pasien'");
        if($pasien){
            $query=$db->query("UPDATE tb_diagnosa SET diagnosa='$diagnosa', tanggal='$tanggal' WHERE kode_pasien = '$kode_pasien'");
            if($query){
                msg("Data berhasil disimpan.");
            }
            header("location:index.php?m=pasien");
        }else{
            $query=$db->query("INSERT INTO tb_diagnosa (kode_pasien, diagnosa, tanggal) values('$kode_pasien','$diagnosa','$tanggal')");
            if($query){
                msg("Data berhasil disimpan.");
            }
            header("location:index.php?m=pasien");
        }
        
    }
}

/**Cart - Tambah Item*/
if($mod=='tindakan_kunjungan'){
    $tanggal = getNewDate();
    $kode_pasien = $_POST['kode_pasien'];
    $item = $_POST['item'];

    $jenis = explode(" - ",$item);

    if($kode_pasien ==''){
        print_msg("Pasien tidak terdaftar!");
    }else if($item == ''){
        print_msg("Item tidak tersedia!");
    }else{
        $pasien = $db->get_row("SELECT * FROM tb_pasien WHERE kode_pasien = '$kode_pasien'");
        if($pasien->transaksi_id != NULL){
            if(getPrefixCode($jenis[0]) == 'obat'){
                $kode_obat = $jenis[0];
                $jumlah = 1;
                $db->query("INSERT INTO tb_detail_obat (kode_regristrasi,kode_obat,jumlah_produk) values('$pasien->transaksi_id','$kode_obat','$jumlah')");
            }else if(getPrefixCode($jenis[0]) == 'terapi'){
                $kode_tindakan = $jenis[0];
                $db->query("INSERT INTO tb_detail_tindakan (kode_regristrasi,kode_tindakan) values('$pasien->transaksi_id','$kode_tindakan')");
            }else{
                print_msg("Item gagal di proses!");
            }

            header("location:index.php?m=tindakan_kunjungan&c=".$pasien->kode_pasien);
        }else{
            header("location:index.php?m=tindakan_kunjungan&c=$kode_pasien");
        }
        
    }
}

if($act=="pilihterapis"){
    $terapis_id = $_POST['terapis_id'];
    $id_detail_tindakan = $_POST['id_detail_tindakan'];

    $db->query("UPDATE `tb_detail_tindakan` SET `terapis_id` = '$terapis_id' WHERE `id_detail_tindakan` = '$id_detail_tindakan'"); 
    header("location:index.php?m=tindakan_kunjungan&c=$_GET[ID]");
}

if($act=="discount_terapi"){
    $discount = $_POST['diskon'];
    $id_detail_tindakan = $_POST['id_detail_tindakan'];
    $db->query("UPDATE `tb_detail_tindakan` SET `discount` = '$discount' WHERE `id_detail_tindakan` = '$id_detail_tindakan'"); 
    header("location:index.php?m=tindakan_kunjungan&c=$_GET[ID]");
}

if($act=="change-qty"){
    $id_detail_obat = $_POST['id_detail_obat'];
    $qty = $_POST['qty'];

    $db->query("UPDATE `tb_detail_obat` SET `jumlah_produk` = '$qty' WHERE `tb_detail_obat`.`id_detail_obat` = '$id_detail_obat'"); 
    header("location:index.php?m=tindakan_kunjungan&c=$_GET[ID]");
}

if($act=="transaksi_rawat_selesai"){
    //Update tb_pasien
    $kode_pasien = $_POST['kode_pasien'];
    $db->query("UPDATE `tb_pasien` SET `transaksi_id` = NULL WHERE `kode_pasien` = '$kode_pasien'"); 
    
    //Update tb_regristrasi
    $selesai = getNewDateTime();
    $kode_reg = $_POST['kode_reg'];
    $total_bayar = $_POST['total_bayar'];
    $db->query("UPDATE `tb_regristrasi` SET `tanggal_selesai` = '$selesai', `total` = '$total_bayar' WHERE `tb_regristrasi`.`kode_regristrasi` = $kode_reg"); 

    header("location:print.php?trx_id=$kode_reg");
}

if($mod=="kunjungan_hapus"){
    $kode_pasien = $_GET[ID];
    $pasien = $db->get_row("SELECT * FROM tb_pasien WHERE kode_pasien = '$kode_pasien'");
    $db->query("DELETE FROM `tb_detail_obat` WHERE kode_regristrasi = $pasien->transaksi_id"); 
    $db->query("DELETE FROM `tb_detail_tindakan` WHERE kode_regristrasi = $pasien->transaksi_id"); 
    $db->query("DELETE FROM tb_regristrasi WHERE kode_regristrasi = '$pasien->transaksi_id'");
    $db->query("UPDATE `tb_pasien` SET transaksi_id = NULL WHERE kode_pasien = '$pasien->kode_pasien'");

    header("location:index.php?m=transaksi_belum_selesai");
}

/**REGISTER*/
if($mod=='register'){
    $kode_pasien = set_value('kode', kode_oto('kode_pasien', 'tb_pasien', 'RSB', 4));
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk=$_POST['jk'];
    $umur = $_POST['umur'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $telepon = $_POST['telepon'];
    $golongan_darah = $_POST['golongan_darah'];
    $tanggal = getNewDate();
    $jenis_tindakan = $_POST['jenis_tindakan'];

    if($nama ==''||$alamat==''||$jk==''||$umur==''){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        $pasien = $db->query("insert into tb_pasien (kode_pasien,nama_pasien,alamat,jk,umur,agama,pekerjaan,telepon,golongan_darah) values('$kode_pasien','$nama','$alamat','$jk','$umur','$agama','$pekerjaan','$telepon','$golongan_darah')");
        getAntrian($kode_pasien);
        $db->query("INSERT INTO tb_regristrasi (tanggal, kode_pasien, total, jenis_tindakan) values('$tanggal','$kode_pasien', 0, '$jenis_tindakan')");
        $db->query("UPDATE tb_pasien SET transaksi_id='$db->insert_id' WHERE kode_pasien = '$kode_pasien'");
        redirect_js("client/?page=pasien&ID=$kode_pasien");
    }
}

/**REGISTER PASIEN LAMA*/
if($act=='registrasi-pasien-lama'){
    $kode_pasien = $_POST['kode_pasien'];
    $jenis_tindakan = $_POST['jenis_tindakan'];
    $tanggal = getNewDate();

    getAntrian($kode_pasien);
    $db->query("INSERT INTO tb_regristrasi (tanggal, kode_pasien, total, jenis_tindakan) values('$tanggal','$kode_pasien', 0, '$jenis_tindakan')");
    $db->query("UPDATE tb_pasien SET transaksi_id='$db->insert_id' WHERE kode_pasien = '$kode_pasien'");
    redirect_js("client/?page=pasien&ID=$kode_pasien");
}
   
?>
