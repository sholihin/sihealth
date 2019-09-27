<?php
$pasien = $db->get_row("select * from tb_pasien where kode_pasien = '$_GET[c]'");
$row = $db->get_row("SELECT * FROM tb_regristrasi WHERE kode_regristrasi = '$pasien->transaksi_id'"); 
$total = 0;
?>
<div class="page-header">
    <h1>Transaksi - <?=kategoriTerapi($row->jenis_tindakan)->nama_kategori?></h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="panel-title">Data Pasien</h1>
                    </div>
                    <div class="col-md-6">
                        <form action="index.php?m=tindakan_kunjungan" method="GET">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="basic-addon1">Kode Pasien</span>
                                <input type="hidden" class="form-control" name="m" value="tindakan_kunjungan">
                                <input type="text" class="form-control" name="c" value="<?=$pasien->kode_pasien ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-body ">
                <div class="form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3">Nama</label>
                            <div class="col-md-9">
                            <input type="text"  class="form-control" readonly="readonly" name="nama_pasien" value="<?=$pasien->nama_pasien ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" readonly="readonly" name="umur" value="<?=$pasien->alamat ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3">JK</label>
                            <div class="col-md-9">
                            <input type="text"  class="form-control" readonly="readonly" name="nama_pasien" 
                                value="<?php if($pasien->jk == 'P') echo 'Perempuan'; elseif($pasien->jk == 'L') echo'Laki-laki'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3">Umur</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" readonly="readonly" name="umur" value="<?=$pasien->umur ?>" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h1 class="panel-title">Data Oprator</h1>
            </div>
            <div class="panel-body ">
                <div class="form-horizontal">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3">Username</label>
                            <div class="col-md-9">
                                <input type="text"  class="form-control" readonly="readonly" name="nama_oprator" value="<?=oprator($_SESSION['login'])->username ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Akses User</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" readonly="readonly" name="hak_akses" value="<?=oprator($_SESSION['login'])->jabatan ?>" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
//untuk suggestions
$produk = $db->get_results("SELECT * FROM tb_obat"); 
$terapi = $db->get_results("SELECT * FROM tb_tindakan"); 
if($row) :
?>

<link rel="stylesheet" href="vendor/jquery-ui/css/jquery-ui.css">
<!--  Sudah ada di index
    <script src="vendor/jquery-ui/js/jquery-1.12.4.js"></script> -->
<script src="vendor/jquery-ui/js/jquery-ui.js"></script>
<script>
    $( function() {
        var terapi = <?php echo json_encode($terapi); ?>;
        var products = [];
        var i;

        for(i in terapi){
            products.push(terapi[i]['kode_tindakan']+' - '+ terapi[i]['nama_tindakan']+' - '+ terapi[i]['harga']);
        }
        
        $( "#item" ).autocomplete({
            source: products
        });

        $('#bayar').on('keyup',function() {
            hitung();
        });
        
        hitung();
    } );

    function hitung(){
        var total = $( "#total" ).val();
        var bayar = $( "#bayar" ).val();

        $("#kembali").val(bayar - total);
    }

    function terapisChanger(id){
        $('#form-terapis-'+id).submit();
    }

    function changeQty($id){
        $("#form-qty-"+$id).submit();
    }
    function discount($id){
        $("#form-discount-"+$id).submit();
    }
</script>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h1 class="panel-title">Tindakan</h1>
            </div>
            <div class="panel-body ">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Pilih Item</label>
                        <div class="col-lg-8">
                            <form method="post" action="aksi.php?act=tindakan_kategori_kunjungan&c=<?=$_GET[c]?>">
                                <div class="input-group">
                                    <input type="hidden" class="form-control" name="kodereg" value="<?=$pasien->transaksi_id?>">
                                    <input type="text" class="form-control" name="item" id="item">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
                                    </div><!-- /btn-group -->
                                </div><!-- /input-group -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Daftar Perawatan</h1>
    </div>
    <div class="panel-body">
            <div class="table-responsive">
                <h4>Terapi</h4>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th>Nama</th>
                        <th>Terapis</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <?php
                    $no=1;
                    $tindakan = $db->get_results("SELECT tb_detail_tindakan.discount,tb_detail_tindakan.id_detail_tindakan,tb_detail_tindakan.kode_regristrasi,tb_detail_tindakan.kode_tindakan,tb_detail_tindakan.terapis_id,tb_tindakan.nama_tindakan,tb_tindakan.harga FROM tb_detail_tindakan INNER JOIN tb_tindakan ON tb_detail_tindakan.kode_tindakan = tb_tindakan.kode_tindakan WHERE tb_detail_tindakan.kode_regristrasi = '$pasien->transaksi_id'");
                    foreach($tindakan as $trx):
                ?>
                    <tr>
                        <td class="col-md-1"><?=$no++?></td>
                        <td><?=$trx->nama_tindakan?></td>
                        <td class="col-md-2">
                        <form method="POST" action="aksi.php?act=pilih_terapis_kategori&ID=<?=$_GET[c]?>" id="form-terapis-<?=$trx->id_detail_tindakan?>">
                            <input type="hidden" name="id_detail_tindakan" value="<?=$trx->id_detail_tindakan?>">
                            <select class="form-control input-sm" id="terapis" name="terapis_id" onChange="terapisChanger(<?=$trx->id_detail_tindakan?>)">
                                <option value="">Pilihan</option>
                                <?php echo options_terapis($trx->terapis_id); ?>
                            </select>
                        </form>
                        </td>
                        <td class="col-md-1 text-center">
                            <a class="btn btn-xs btn-danger" href="aksi.php?act=tindakan_kategori_kunjungan_hapus&c=<?=$_GET[c]?>&id=<?=$trx->id_detail_tindakan?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                            <a class="btn btn-xs btn-warning" href="index.php?m=rekam-medis&c=<?=$_GET[c]?>&id=<?=$trx->id_detail_tindakan?>"><span class="glyphicon glyphicon-plus"></span></a>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </table>
                <hr>
                <form action="aksi.php?act=transaksi_kategori_rawat_selesai" method="POST">
                    <div class="col-md-4">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">Total Biaya</span>
                            <input type="text" class="form-control" name="harga_paket" id="total" readonly value="<?=kategoriTerapi($row->jenis_tindakan)->harga?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="input-group input-group-lg">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Yakin sudah selesai?')">Bayar/DP</button>
                                </span>
                                <input type="hidden" class="form-control" name="kode_pasien" value="<?=$_GET[c]?>">
                                <input type="hidden" class="form-control" name="kode_reg" value="<?=$pasien->transaksi_id ?>">
                                <input type="text" class="form-control" name="total_bayar" id="bayar" onchange="hitung()" value="<?=$row->total?>" placeholder="Bayar">
                            </div>
                    </div>
                </form>
                <div class="col-md-4">
                    <div class="input-group input-group-lg">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">Belum Lunas</button>
                        </span>
                        <input type="text" class="form-control" id="kembali" value="0" readonly>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php endif ?>


