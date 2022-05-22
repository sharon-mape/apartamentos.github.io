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
						<b>Lista de apartamentos</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="nuevoApartamento">
					<i class="fa fa-plus"></i> Nuevo apartamento
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Alias apartamento</th>
									<th class="">Direccion</th>
									<th class="">Cantidad camas</th>
									<th class="">Precio día</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$apartamento= $conn->query("SELECT * FROM apartamento order by id asc");
								while($row=$apartamento->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<?php echo ucwords($row['alias']) ?>
									</td>
									<td class="">
										 <p><?php echo $row['direccion'] ?></p>
									</td>
									<td class="">
										 <p><?php echo $row['cantidadCamas'] ?></p>
									</td>
									<td class="">
										 <p><?php echo number_format($row['precioDia'],2) ?></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary editarApartamento" type="button" data-id="<?php echo $row['id'] ?>" >Editar</button>
										<button class="btn btn-sm btn-outline-danger eliminarApartamento" type="button" data-id="<?php echo $row['id'] ?>">Eliminar</button>
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
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height:150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('#nuevoApartamento').click(function(){
		uni_modal("Nuevo apartamento","manage_apart.php","mid-large")
		
	})
	$('.editarApartamento').click(function(){
		uni_modal("Administrar detalles apartamentos","manage_apart.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.eliminarApartamento').click(function(){
		_conf("Estas seguro de eliminar este apartamento","eliminarApartamento",[$(this).attr('data-id')])
	})
	
	function eliminarApartamento($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=eliminarApartamento',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Datos eliminados exitosamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>