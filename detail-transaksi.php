<?php
$trx = $db->get_row("select * from tb_regristrasi where kode_regristrasi = '$_GET[trx_id]'");
$pasien = $db->get_row("select * from tb_pasien where kode_pasien = '$trx->kode_pasien'");
$total = 0;
?>
<div class="page-header">
    <h1>Transaksi</h1>
</div>
<div class="row">
    <div class="col-md-12">
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
                                <input type="text" class="form-control" readonly name="c" value="<?=$pasien->kode_pasien ?>">
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
                            <label class="col-md-3">Jenis Kelamin</label>
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
</div>
<?php 
$row = $db->get_results("SELECT * FROM tb_regristrasi WHERE kode_regristrasi = '$_GET[trx_id]'"); 
if($row) :
?>

<link rel="stylesheet" href="vendor/jquery-ui/css/jquery-ui.css">
<!--  Sudah ada di index
    <script src="vendor/jquery-ui/js/jquery-1.12.4.js"></script> -->
<script src="vendor/jquery-ui/js/jquery-ui.js"></script>
<script>
    $( function() {
        var produk = <?php echo json_encode($produk); ?>;
        var terapi = <?php echo json_encode($terapi); ?>;
        var products = [];
        var i;
        for(i in produk){
            products.push(produk[i]['kode_obat']+' - '+ produk[i]['nama_obat']+' - '+ produk[i]['harga_jual']);
        }

        for(i in terapi){
            products.push(terapi[i]['kode_tindakan']+' - '+ terapi[i]['nama_tindakan']+' - '+ terapi[i]['harga']);
        }
        
        $( "#item" ).autocomplete({
            source: products
        });

        $('#bayar').on('keyup',function() {
            hitung();
        });
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

<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title">Transaksi</h1>
    </div>
    <div class="panel-body">
            <div class="table-responsive">
                <h4>Terapi</h4>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th>Nama</th>
                        <th>Biaya</th>
                        <th>Terapis</th>
                        <th>Diskon</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <?php
                    $no=1;
                    $tindakan = $db->get_results("SELECT tb_detail_tindakan.discount,tb_detail_tindakan.id_detail_tindakan,tb_detail_tindakan.kode_regristrasi,tb_detail_tindakan.kode_tindakan,tb_detail_tindakan.terapis_id,tb_tindakan.nama_tindakan,tb_tindakan.harga FROM tb_detail_tindakan INNER JOIN tb_tindakan ON tb_detail_tindakan.kode_tindakan = tb_tindakan.kode_tindakan WHERE tb_detail_tindakan.kode_regristrasi = '$_GET[trx_id]'");
                    foreach($tindakan as $trx):
                ?>
                    <tr>
                        <td class="col-md-1"><?=$no++?></td>
                        <td><?=$trx->nama_tindakan?></td>
                        <td>Rp. <?=set_num($trx->harga,0)?></td>
                        <td class="col-md-2">
                            <?=terapis($trx->terapis_id)->nama_dokter ?>
                        </td>
                        <td class="col-md-2">
                            <?php 
                            if($trx->discount > 100)
                                echo 'Rp. '.set_num($trx->discount,0);
                            else
                                echo $trx->discount.'%';
                            ?>
                        </td>
                        <td class="col-md-2">
                            <strong>Rp. 
                            <?php
                                if($trx->discount > 1 && $trx->discount < 100){
                                    echo set_num(($trx->harga - ($trx->harga * $trx->discount) / 100),0);
                                }elseif($trx->discount > 99){
                                    echo set_num($trx->harga - $trx->discount,0);
                                }else{
                                    echo set_num($trx->harga,0);
                                }
                            ?>
                            </strong>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                    <tr>
                        <td colspan="5" class="text-right"><strong>Total : </strong></td>
                        <td colspan="2"><strong>Rp. <?=set_num(countPriceOfTerapi($tindakan),0)?></strong></td>
                    </tr>
                </table>
                <hr>
                <h4>Herbal</h4>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th>Nama </th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no=1;
                            $produk = $db->get_results("SELECT tb_detail_obat.id_detail_obat,tb_detail_obat.kode_obat,tb_detail_obat.kode_regristrasi,tb_detail_obat.jumlah_produk,tb_obat.nama_obat,tb_obat.harga_jual FROM tb_detail_obat INNER JOIN tb_obat ON tb_detail_obat.kode_obat = tb_obat.kode_obat WHERE tb_detail_obat.kode_regristrasi = '$_GET[trx_id]'");
                            foreach($produk as $rows):
                        ?>
                        <tr>
                            <td class="col-md-1"><?=$no++?></td>
                            <td><?=$rows->nama_obat?></td>
                            <td>Rp. <?=set_num($rows->harga_jual,0)?></td>
                            <td class="col-md-1">
                                <?=$rows->jumlah_produk?>
                            </td>
                            <td class="col-md-2"><strong>Rp. <?=set_num($rows->harga_jual * $rows->jumlah_produk, 0)?></strong></td>
                        </tr>
                        <?php endforeach;
                        ?>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total : </strong></td>
                            <td colspan="2"><strong>Rp. <?=set_num(countPriceOfProduct($produk),0)?></strong></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <form action="aksi.php?act=transaksi_rawat_selesai" method="POST">
                    <div class="col-md-4 col-md-offset-8 text-right">
                        <h4>Grand Total</h4>
                        <h1>Rp. <?=set_num(countPriceOfProduct($produk)+countPriceOfTerapi($tindakan),0)?></h1>
                    </div>
                </form>
            </div>
    </div>
</div>
<?php endif ?>


