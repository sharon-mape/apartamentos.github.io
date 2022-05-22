<?php include('db_connect.php');?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Lista de pagos</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Alias apartamento</th>
                                    <th class="">Fecha entrada</th>
                                    <th class="">Fecha salida</th>
                                    <th class="">Cantidad días</th>
                                    <th class="">Precio día</th>
                                    <th class="">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    $pago= $conn->query("SELECT t.*, h.alias, h.precioDia FROM arrendatario t inner join apartamento h on h.id = t.alias
                                    where t.status = 1 order by h.alias desc");
                                    while($row=$pago->fetch_assoc()):
                                        $cantidadDias = abs(strtotime($row['salidaFecha']) - strtotime($row['ingresoFecha']));
                                        $cantidadDias =floor(($cantidadDias)/(60*60*24));
                                        $total = $cantidadDias * $row['precioDia'];
								?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td>
                                        <?php echo ucwords($row['alias']) ?>
                                    </td>
                                    <td class="">
                                        <p><?php echo date('M d, Y',strtotime($row['ingresoFecha'])) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo date('M d, Y',strtotime($row['salidaFecha'])) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo $cantidadDias ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo number_format($row['precioDia'],2) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo number_format($total,2) ?></p>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>

</div>
<style>
td {
    vertical-align: middle !important;
}

td p {
    margin: unset
}

img {
    max-width: 100px;
    max-height: 150px;
}
</style>
<script>
$(document).ready(function() {
    $('table').dataTable()
})
</script>