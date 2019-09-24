
<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<div class="panel panel-default">
    <div class="panel-heading clearfix" style="margin-bottom:5px">      
        <h1 class="text-left pull-left" style="margin-top:0px">Laporan Penjualan</h1>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th class="col-md-2">Tanggal</th>
                <th class="col-md-3">Nama Herbal</th>
                <th class="col-md-3">Harga</th>
                <th class="col-md-1">Jumlah</th>
                <th class="col-md-3">Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $q = esc_field($_GET['q']);
      
        $rows = $db->get_results("SELECT tb_detail_obat.kode_regristrasi,tb_detail_obat.kode_obat,tb_detail_obat.jumlah_produk,tb_obat.nama_obat,tb_obat.harga_beli,tb_obat.harga_jual,tb_regristrasi.tanggal
                                    FROM tb_detail_obat 
                                    INNER JOIN tb_obat ON tb_detail_obat.kode_obat = tb_obat.kode_obat
                                    INNER JOIN tb_regristrasi ON tb_detail_obat.kode_regristrasi = tb_detail_obat.kode_regristrasi
                                    ORDER BY tb_regristrasi.tanggal DESC
                                    ");
        
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->tanggal?></td>
            <td><?=$row->kode_obat.' - '.$row->nama_obat?></td>
            <td><?=$row->harga_jual?></td>
            <td><?=$row->jumlah_produk?></td>
            <td><?=$row->jumlah_produk * $row->harga_jual?></td>
        </tr>
        <?php endforeach;
        ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
        </table>
    </div>
</div>

<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/js/jszip.min.js"></script>
<script src="vendor/datatables/js/pdfmake.min.js"></script>
<script src="vendor/datatables/js/vfs_fonts.js"></script>
<script src="vendor/datatables/js/buttons.html5.min.js"></script>
<script src="vendor/datatables/js/buttons.bootstrap.min.js"></script>
<script src="vendor/datatables/js/buttons.print.min.js"></script>
<script src="vendor/datatables/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable( {
            lengthChange: true,
            buttons: [ 'copy', 'excel', 'pdf' ],
            "order": [[ 0, "desc" ]],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
    
                // Total over all pages
                total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $( api.column( 4 ).footer() ).html(
                    'Rp. '+pageTotal +' Subtotal<br> (Rp. '+ total +' Total)'
                );
            }
        } );

        table.buttons().container()
            .appendTo( '#table_wrapper .col-sm-6:eq(0)' );
    } );
</script>