<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> Nuevo
                Usuario</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
 					include 'db_connect.php';
 					$type = array("","Admin","Staff");
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo ucwords($row['name']) ?>
                            </td>

                            <td>
                                <?php echo $row['username'] ?>
                            </td>
                            <td>
                                <?php echo $type[$row['type']] ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary edit_user" type="button"
                                    data-id="<?php echo $row['id'] ?>">Editar</button>
                                <button class="btn btn-sm btn-outline-danger delete_user" type="button"
                                    data-id="<?php echo $row['id'] ?>">Eliminar</button>
                            </td>         
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
$('table').dataTable();
$('#new_user').click(function() {
    uni_modal('Nuevo usuario', 'manage_user.php')
})
$('.edit_user').click(function() {
    uni_modal('Editar usuario', 'manage_user.php?id=' + $(this).attr('data-id'))
})
$('.delete_user').click(function() {
    _conf("Estas seguro de eliminar este usuario", "delete_user", [$(this).attr('data-id')])
})

function delete_user($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_user',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Eliminado exitosamente", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}
</script>