<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}

if($action == "guardarApartamento"){
	$save = $crud->guardarApartamento();
	if($save)
		echo $save;
}
if($action == "eliminarApartamento"){
	$save = $crud->eliminarApartamento();
	if($save)
		echo $save;
}

if($action == "guardarArrendatario"){
	$save = $crud->guardarArrendatario();
	if($save)
		echo $save;
}
if($action == "eliminarArrendatario"){
	$save = $crud->eliminarArrendatario();
	if($save)
		echo $save;
}

ob_end_flush();
?>