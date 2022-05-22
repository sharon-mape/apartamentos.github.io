<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM arrendatario where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<div class="container-fluid">
	<form action="" id="administrarArrendatario">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row form-group">
			<div class="col-md-4">
				<label for="" class="control-label">Nombre</label>
				<input type="text" class="form-control" name="nombre"  value="<?php echo isset($nombre) ? $nombre :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Número de documento</label>
				<input type="text" class="form-control" name="numeroDocumento"  value="<?php echo isset($numeroDocumento) ? $numeroDocumento:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Dirección</label>
				<input type="text" class="form-control" name="direccion"  value="<?php echo isset($direccion) ? $direccion :'' ?>">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">Origen</label>
				<input type="text" class="form-control" name="origen"  value="<?php echo isset($origen) ? $origen :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Número de acompañantes</label>
				<input type="number" class="form-control" name="numeroAcompanante"  value="<?php echo isset($numeroAcompanante) ? $numeroAcompanante :'' ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">Apartamento</label>
				<select name="alias" id="" class="custom-select select2">
					<option value=""></option>
					<?php 
					$apartamento = $conn->query("SELECT * FROM apartamento where id not in (SELECT alias from arrendatario where status = 1) ".(isset($alias)? " or id = $alias": "" )." ");
					while($row= $apartamento->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($alias) && $alias == $row['id'] ? 'selected' : '' ?>><?php echo $row['alias'] ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Fecha de ingreso</label>
				<input type="date" class="form-control" name="ingresoFecha"  value="<?php echo isset($ingresoFecha) ? date("Y-m-d",strtotime($ingresoFecha)) :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Fecha de salida</label>
				<input type="date" class="form-control" name="salidaFecha"  value="<?php echo isset($salidaFecha) ? date("Y-m-d",strtotime($salidaFecha)) :'' ?>" required>
			</div>
		</div>
	</form>
</div>
<script>
	
	$('#administrarArrendatario').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=guardarArrendatario',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Datos guardado exitosamente",'success')
						setTimeout(function(){
							location.reload()
						},1000)
				}
			}
		})
	})
</script>