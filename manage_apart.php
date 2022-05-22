<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM apartamento where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<div class="container-fluid">
    <form action="" id="administrarApartamento">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row form-group">
            <div class="col-md-4">
                <label for="" class="control-label">Alias apartamento</label>
                <input type="text" class="form-control" name="alias" value="<?php echo isset($alias) ? $alias :'' ?>"
                    required>
            </div>
            <div class="col-md-4">
                <label for="" class="control-label">Dirección</label>
                <input type="text" class="form-control" name="direccion"
                    value="<?php echo isset($direccion) ? $direccion:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label for="" class="control-label">Cantidad camas</label>
                <input type="number" class="form-control" name="cantidadCamas"
                    value="<?php echo isset($cantidadCamas) ? $cantidadCamas :'' ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="" class="control-label">Precio día</label>
                <input type="number" class="form-control" name="precioDia"
                    value="<?php echo isset($precioDia) ? $precioDia :'' ?>" required>
            </div>
        </div>
    </form>
</div>

<script>
$('#administrarApartamento').submit(function(e) {
    e.preventDefault()
    start_load()
    $('#msg').html('')
    $.ajax({
        url: 'ajax.php?action=guardarApartamento',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Datos guardado exitosamente", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1000)
            }
        }
    })
})
</script>