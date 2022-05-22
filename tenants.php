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
						<b>Lista de arrendatarios</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="nuevoArrendatario">
					<i class="fa fa-plus"></i> Nuevo arrendatario
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Nombre arrendatario</th>
									<th class="">Número documento</th>
									<th class="">Direccion</th>
									<th class="">Origen</th>
									<th class="">Número acompañantes</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$arrendatario = $conn->query("SELECT * FROM arrendatario order by id asc");
								while($row=$arrendatario->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<?php echo ucwords($row['nombre']) ?>
									</td>
									<td class="">
										 <p><?php echo $row['numeroDocumento'] ?></p>
									</td>
									<td class="">
										 <p><?php echo $row['direccion'] ?></p>
									</td>
									<td class="">
										 <p><?php echo $row['origen'] ?></p>
									</td>
									<td class="">
										 <p><?php echo $row['numeroAcompanante'] ?></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary editarArrendatario" type="button" data-id="<?php echo $row['id'] ?>" >Editar</button>
										<button class="btn btn-sm btn-outline-danger eliminarArrendatario" type="button" data-id="<?php echo $row['id'] ?>">Eliminar</button>
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
	
	$('#nuevoArrendatario').click(function(){
		uni_modal("Nuevo arrendatario","manage_tenant.php","mid-large")
		
	})
	$('.editarArrendatario').click(function(){
		uni_modal("Administrar detalles arrendatario","manage_tenant.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.eliminarArrendatario').click(function(){
		_conf("Estas seguro de eliminar este arrendatario","eliminarArrendatario",[$(this).attr('data-id')])
	})
	
	function eliminarArrendatario($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=eliminarArrendatario',
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