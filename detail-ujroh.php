
<link href="vendor/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="vendor/datatables/css/buttons.bootstrap.min.css" rel="stylesheet"/>

<?php
    $terapis = $db->get_row("SELECT * FROM tb_dokter WHERE kode_dokter = $_GET[id]");
?>  
<div class="panel panel-default">
    <div class="panel-heading clearfix" style="margin-bottom:5px">      
        <h4>Detail Ujroh - <?=$terapis->nama_dokter?></h4>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">#ID Transaksi</th>
                    <th class="col-md-2">Tanggal</th>
                    <th class="col-md-2">Jenis</th>
                    <th class="col-md-4">Nama Terapi</th>
                    <th class="col-md-3">Ujroh</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $rows = $db->get_results("SELECT tb_detail_tindakan.id_detail_tindakan,tb_regristrasi.tanggal,tb_regristrasi.jenis_tindakan,tb_tindakan.kode_tindakan,tb_tindakan.harga,tb_tindakan.nama_tindakan,tb_tindakan.ujroh_senior,tb_tindakan.ujroh_junior,tb_dokter.level_terapis
                                        FROM tb_detail_tindakan
                                        RIGHT OUTER JOIN tb_regristrasi USING (kode_regristrasi)
                                        RIGHT OUTER JOIN tb_tindakan USING (kode_tindakan)
                                        RIGHT JOIN tb_dokter ON tb_dokter.kode_dokter = tb_detail_tindakan.terapis_id
                                        WHERE terapis_id = 4 ORDER BY id_detail_tindakan DESC");
            foreach($rows as $row):?>
            <tr>
                <td><?=$row->id_detail_tindakan?></td>
                <td><?=$row->tanggal?></td>
                <td><?=jenis_rawat($row->jenis_tindakan)?></td>
                <td><?=$row->kode_tindakan .' - '. $row->nama_tindakan?></td>
                <td><?=$row->level_terapis == 'senior' ? ($row->harga * $row->ujroh_senior)/100 : ($row->harga * $row->ujroh_junior)/100 ?></td>
            </tr>
            <?php endforeach;
            ?>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total:</th>
                    <th class="text-right"></th>
                </tr>
            </tfoot>
            </tbody>
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