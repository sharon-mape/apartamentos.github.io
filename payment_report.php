<?php include 'db_connect.php' ?>
<?php 

$month_of = isset($_GET['month_of']) ? $_GET['month_of'] : date( 'd M, y');

?>
<style>
.on-print {
    display: none;
}
</style>
<noscript>
    <style>
    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    table {
        width: 100%;
        border-collapse: collapse
    }

    tr,
    td,
    th {
        border: 1px solid black;
    }
    </style>
</noscript>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <form id="filter-report">
                        <div class="row form-group">
                            <label class="control-label col-md-2 offset-md-2 text-right">Mes de: </label>
                            <input type="month" name="month_of" class='from-control col-md-4'
                                value="<?php echo ($month_of) ?>">
                            <button class="btn btn-sm btn-block btn-primary col-md-2 ml-1">Filtrar</button>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <button class="btn btn-sm btn-block btn-success col-md-2 ml-1 float-right" type="button"
                                id="print"><i class="fa fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                    <div id="report">
                        <div class="on-print">
                            <p class="text-center">
                                Informe de pagos de alquiler
                            </p>
                            <p class="text-center">Para el mes
                                de<b><?php echo date('F ,Y',strtotime($month_of.'-1')) ?></b>
                            </p>
                        </div>
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha de ingreso</th>
                                        <th>Fecha de salida</th>
                                        <th>Cantidad de días alquilado</th>
                                        <th>Alias</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
									$i = 1;
									$tamount = 0;
									$payments  = $conn->query("SELECT t.*, h.alias, h.precioDia FROM arrendatario t inner join apartamento h on h.id = t.alias
                                    where t.status = 1 order by h.alias desc");
									if($payments->num_rows > 0 ):
									while($row=$payments->fetch_assoc()):
                                        $cantidadDias = abs(strtotime($row['salidaFecha']) - strtotime($row['ingresoFecha']));
									    $cantidadDias =floor(($cantidadDias)/(60*60*24));
									    $total = $cantidadDias * $row['precioDia'];
                                        $tamount += $total;
									?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="">
                                            <p><?php echo date('d M, Y',strtotime($row['ingresoFecha'])) ?></p>
                                        </td>
                                        <td class="">
                                            <p><?php echo date('d M, Y',strtotime($row['salidaFecha'])) ?></p>
                                        </td>
                                        <td class="text-right">
                                            <p><?php echo $cantidadDias ?></p>
                                        </td>
                                        <td>
                                            <?php echo $row['alias']?>
                                        </td>
                                        <td class="text-right">
                                            <p><?php echo number_format($total,2) ?></p>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php else: ?>
                                    <tr>
                                        <th colspan="6">
                                            <p class="text-center">No Data.</p>
                                        </th>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5">Total monto</th>
                                        <th class='text-right'><?php echo number_format($tamount,2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#print').click(function() {
    var _style = $('noscript').clone()
    var _content = $('#report').clone()
    var nw = window.open("", "_blank", "width=800,height=700");
    nw.document.write(_style.html())
    nw.document.write(_content.html())
    nw.document.close()
    nw.print()
    setTimeout(function() {
        nw.close()
    }, 500)
})
$('#filter-report').submit(function(e) {
    e.preventDefault()
    location.href = 'index.php?page=payment_report&' + $(this).serialize()
})
</script>