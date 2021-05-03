<<<<<<< HEAD
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {	
	function __construct() {
		parent::__construct();				
	}	
	function login($mail,$pass){		
		$q = $this -> db -> query("select u.id_usuario from t_usuarios u  where u.status = 1 and u.email = ".$this->db->escape($mail));		
		$r = $q->row();
		if (isset($r)){
			$q = $this -> db -> query("select id_usuario from t_usuarios 
									   where status = 1 and 
									   id_usuario = ".$r->id_usuario." 
									   and email = ".$this->db->escape($mail)." 
									   and pass = md5(".$this->db->escape($pass).") ");		
			$r = $q->row();
			if(isset($r)){				
				$s = array('usuario'=>array(),'cliente'=>array(),'db'=>'');				
				$q = $this -> db -> query("select 
													u.id_usuario, u.nombre, u.apellidos, u.imagen, u.fecha_registro as fecha,u.id_sucursal,u.sucursales
											   from 
													t_usuarios u												    
											   where 
											   		u.status = 1
											   		and u.id_usuario = ".$r->id_usuario." 
											   		and u.email = ".$this->db->escape($mail)." 
											   		and u.pass = md5(".$this->db->escape($pass).") ");		
				$r = $q->row_array();				
				if(isset($r)){	
					$s['usuario'] = $r;	
					$s['id_sucursal'] = $r['id_sucursal'];
					$this->session->set_userdata($s);					
					return array('code'=>1252);
				}else{
					return array('email'=>'Error desconocido');
				}				
			}else{
				return array('pass'=>'Contraseña es incorrecta');
			}
		}else{
			return array('email'=>'Usuario inexistente o con acceso restringido');
		}
	}	
}




//private $s = null;
	// function __construct() {
		// parent::__construct();
		// date_default_timezone_set("America/Mexico_City");
		// setlocale(LC_TIME, "es_MX.utf8");
		// $this->s = $this -> session -> userdata();
		// $this -> db = $this -> load -> database($s["db"], TRUE);
=======
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {	
	function __construct() {
		parent::__construct();				
	}	
	function login($mail,$pass){		
		$q = $this -> db -> query("select u.id_usuario from t_usuarios u  where u.status = 1 and u.email = ".$this->db->escape($mail));		
		$r = $q->row();
		if (isset($r)){
			$q = $this -> db -> query("select id_usuario from t_usuarios 
									   where status = 1 and 
									   id_usuario = ".$r->id_usuario." 
									   and email = ".$this->db->escape($mail)." 
									   and pass = md5(".$this->db->escape($pass).") ");		
			$r = $q->row();
			if(isset($r)){				
				$s = array('usuario'=>array(),'cliente'=>array(),'db'=>'');				
				$q = $this -> db -> query("select 
													u.id_usuario, u.nombre, u.apellidos, u.imagen, u.fecha_registro as fecha,u.id_sucursal,u.sucursales
											   from 
													t_usuarios u												    
											   where 
											   		u.status = 1
											   		and u.id_usuario = ".$r->id_usuario." 
											   		and u.email = ".$this->db->escape($mail)." 
											   		and u.pass = md5(".$this->db->escape($pass).") ");		
				$r = $q->row_array();				
				if(isset($r)){	
					$s['usuario'] = $r;	
					$s['id_sucursal'] = $r['id_sucursal'];
					$this->session->set_userdata($s);					
					return array('code'=>1252);
				}else{
					return array('email'=>'Error desconocido');
				}				
			}else{
				return array('pass'=>'Contraseña es incorrecta');
			}
		}else{
			return array('email'=>'Usuario inexistente o con acceso restringido');
		}
	}	
}




//private $s = null;
	// function __construct() {
		// parent::__construct();
		// date_default_timezone_set("America/Mexico_City");
		// setlocale(LC_TIME, "es_MX.utf8");
		// $this->s = $this -> session -> userdata();
		// $this -> db = $this -> load -> database($s["db"], TRUE);
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
	// }