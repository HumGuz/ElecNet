<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {	
	function __construct() {
		parent::__construct();				
	}	
	function login($mail,$pass){
		// $this->load->database();
		$q = $this -> db -> query("select u.id_usuario from t_usuarios u  inner join t_clientes c on c.id_cliente = u.id_cliente 
								   where c.status = 1 and u.status = 1 and u.email = ".$this->db->escape($mail));		
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
													u.id_usuario_in as id_usuario, u.nombre, u.apellidos, u.imagen, u.fecha_registro as fecha,u.id_sucursal,
											   		c.*  
											   from 
													t_usuarios u
												    inner join t_clientes c on c.id_cliente = u.id_cliente
											   where 
											   		u.status = 1 and c.status = 1 
											   		and u.id_usuario = ".$r->id_usuario." 
											   		and u.email = ".$this->db->escape($mail)." 
											   		and u.pass = md5(".$this->db->escape($pass).") ");		
				$r = $q->row_array();				
				if(isset($r)){		
					$dbIn = $this -> load -> database($r['db_name'], TRUE);					
					$q = $dbIn -> query("select sucursales from t_usuarios u where u.id_usuario = ".$r['id_usuario']);
					$rIn = $q->row_array();					
					$s['usuario'] = array('id_usuario'=>$r['id_usuario'],'nombre'=>$r['nombre'],'apellidos'=>$r['apellidos'],'imagen'=>$r['imagen'],'fecha_registro'=>$r['fecha'],'id_sucursal'=>$r['id_sucursal'],'sucursales'=>$rIn['sucursales']);		
					foreach ($s['usuario'] as $k) {
						unset($r[$k]);
					}
					unset($r['status']);
					$s['db'] = $r['db_name']; 
					unset($r['db_name']);
					$s['cliente'] = $r;
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
	// }