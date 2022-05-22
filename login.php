<!DOCTYPE html>
<html lang="es">
<?php 
session_start();
include('./db_connect.php');
ob_start();
ob_end_flush();
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="./assets/css/login.css">
    <title> Sistema gestión de alquiler de apartamentos</title>
    <?php include('./header.php'); ?>
    <?php 
    if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");

?>
</head>

<body>
    <main id="main" class=" bg-light">
        <div id="login-left" class="bg-dark">
        </div>

        <div id="login-right" class="bg-light">
            <div class="w-100">
                <h4 class="titulo">Sistema de gestión alquiler de apartamentos</h4>
                <br>
                <br>
                <div class="card col-md-8">
                    <div class="card-body">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="username" class="control-label">Usuario</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <button class="btn-sm btn-block btn-wave col-md-5 btn-primary  col-6 mx-auto">Iniciar
                                    Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
$('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Iniciando sesión...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

        },
        success: function(resp) {
            if (resp == 1) {
                location.href = 'index.php?page=home';
            } else {
                $('#login-form').prepend(
                    '<div class="alert alert-danger">Usuario o contraseña incorrecta.</div>')
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
            }
        }
    })
})
</script>

</html>