
<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<div class="panel panel-default">
    <div class="panel-heading clearfix" style="margin-bottom:5px">      
        <h4>Laporan Terapi</h4>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">Kode Transaksi</th>
                    <th class="col-md-2">Tanggal</th>
                    <th class="col-md-1">Jenis</th>
                    <th class="col-md-2">Nama Pasien</th>
                    <th class="col-md-2">Nama Terapi</th>
                    <th class="col-md-2">Terapis</th>
                    <th class="col-md-2 text-center">Harga</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $rows = $db->get_results("SELECT tb_detail_tindakan.id_detail_tindakan,tb_detail_tindakan.kode_regristrasi,tb_detail_tindakan.kode_tindakan,tb_regristrasi.tanggal,tb_tindakan.nama_tindakan,tb_tindakan.harga,tb_dokter.nama_dokter
                                        FROM tb_detail_tindakan 
                                        INNER JOIN tb_tindakan ON tb_detail_tindakan.kode_tindakan = tb_tindakan.kode_tindakan
                                        INNER JOIN tb_dokter ON tb_detail_tindakan.terapis_id = tb_dokter.kode_dokter
                                        INNER JOIN tb_regristrasi ON tb_detail_tindakan.kode_regristrasi = tb_regristrasi.kode_regristrasi
                                        WHERE tb_regristrasi.jenis_tindakan = 0
                                        ORDER BY tb_detail_tindakan.tanggal DESC
                                    ");
            
            foreach($rows as $row):?>
            <tr>
                <td><?=$row->id_detail_tindakan?></td>
                <td><?=$row->tanggal?></td>
                <td><?=jenis_rawat(getTransaksi($row->kode_regristrasi)->jenis_tindakan)?></td>
                <td><?=pasien(getTransaksi($row->kode_regristrasi)->kode_pasien)->nama_pasien?></td>
                <td><?=$row->nama_tindakan?></td>
                <td><?=$row->nama_dokter?></td>
                <td class="text-right"><?=$row->harga?></td>
            </tr>
            <?php endforeach;
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" class="text-right">Total:</th>
                    <th class="text-right"></th>
                </tr>
            </tfoot>
            </table>
        </div>
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
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $( api.column( 6 ).footer() ).html(
                    'Rp. '+pageTotal +' Subtotal<br> (Rp. '+ total +' Total)'
                );
            }
        } );

        table.buttons().container()
            .appendTo( '#table_wrapper .col-sm-6:eq(0)' );
    } );
</script>