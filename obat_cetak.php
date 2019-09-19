
<div class="page-header">
    <h1>Produk Cetak</h1>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
            </tr>
        </thead>
        <?php
        $rows = $db->get_results("SELECT * FROM tb_obat");
        
        $no=0;
        foreach($rows as $row):?>
            <tr>
                <td><?=$row->kode_obat ?></td>
                <td><?=$row->nama_obat?></td>
                <td><?=set_num($row->harga_beli,2)?></td>
                <td><?=set_num($row->harga_jual,2)?></td>
                <td><?=$row->stok?></td>
                
            </tr>
        <?php endforeach;
        ?>
    </table>
</div>
