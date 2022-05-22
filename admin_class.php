<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				if($_SESSION['login_type'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					return 1;
			}else{
				return 3;
			}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		if($type == 1)
			$establishment_id = 0;
		$data .= ", establishment_id = '$establishment_id' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$username' and id !='$id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function signup(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$uid = $this->db->insert_id;
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			$data .= ", user_id = '$uid' ";
			$save = $this->db->query("INSERT INTO user_details set ".$data);
			if($save){
				return 1;
			}
		}
	}

	function update_account(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
		if($save){
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("UPDATE user_details set $data where user_id = '{$_SESSION['login_id']}' ");
			if($save){
				return 1;
			}
		}
	}

	function guardarApartamento(){
		extract($_POST);
		$data = " alias = '$alias' ";
		$data .= ", direccion = '$direccion' ";
		$data .= ", cantidadCamas = '$cantidadCamas' ";
		$data .= ", precioDia = '$precioDia' ";

			if(empty($id)){
				$save = $this->db->query("INSERT INTO apartamento set $data");
			}else{
				$save = $this->db->query("UPDATE apartamento set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function eliminarApartamento(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM apartamento where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function guardarArrendatario(){
		extract($_POST);
		$data = " nombre = '$nombre' ";
		$data .= ", numeroDocumento = '$numeroDocumento' ";
		$data .= ", direccion = '$direccion' ";
		$data .= ", numeroAcompanante = '$numeroAcompanante' ";
		$data .= ", origen = '$origen' ";
		$data .= ", alias = '$alias' ";
		$data .= ", ingresoFecha = '$ingresoFecha' ";
		$data .= ", salidaFecha = '$salidaFecha' ";

			if(empty($id)){
				$save = $this->db->query("INSERT INTO arrendatario set $data");
			}else{
				$save = $this->db->query("UPDATE arrendatario set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function eliminarArrendatario(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM arrendatario where id = ".$id);
		if($delete){
			return 1;
		}
	}
}