<<<<<<< HEAD
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	
	function getClientes($d=null){		
		$c = '';
		if($d['id_cliente'])
			$c .= ' and c.id_cliente = '.$d['id_cliente'];
		if($d['busqueda'])
			$c .= " and (  c.clave like '%".$d['busqueda']."%' or c.rfc like '%".$d['busqueda']."%' or c.nombre like '%".$d['busqueda']."%' or c.contacto like '%".$d['busqueda']."%' or  c.email like '%".$d['busqueda']."%' )  ";
		$c .= " order by c.clave asc";		
		$q = $this -> db -> query("select *,borrarCliente(id_cliente) as borrar from t_clientes c  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function guardarCliente($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_cliente'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_clientes', $d);			
			$id_cliente = $this->db->insert_id();			
        }else{
        	$id_cliente = $d['id_cliente'];
			unset($d['id_cliente']);
            $this->db->where('id_cliente', $id_cliente);			
            $this->db->update('t_clientes', $d);	
        } 
		return array('status'=>1,'id_cliente'=>$id_cliente);
	}	
	function borrarCliente($d){
		 $this->db->where('id_cliente', $d['id_cliente']);			
         $this->db->delete('t_clientes');	
		 return array('status'=>1);
	}
}
=======
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	
	function getClientes($d=null){		
		$c = '';
		if($d['id_cliente'])
			$c .= ' and c.id_cliente = '.$d['id_cliente'];
		if($d['busqueda'])
			$c .= " and (  c.clave like '%".$d['busqueda']."%' or c.rfc like '%".$d['busqueda']."%' or c.nombre like '%".$d['busqueda']."%' or c.contacto like '%".$d['busqueda']."%' or  c.email like '%".$d['busqueda']."%' )  ";
		$c .= " order by c.clave asc";		
		$q = $this -> db -> query("select *,borrarCliente(id_cliente) as borrar from t_clientes c  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function guardarCliente($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_cliente'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_clientes', $d);			
			$id_cliente = $this->db->insert_id();			
        }else{
        	$id_cliente = $d['id_cliente'];
			unset($d['id_cliente']);
            $this->db->where('id_cliente', $id_cliente);			
            $this->db->update('t_clientes', $d);	
        } 
		return array('status'=>1,'id_cliente'=>$id_cliente);
	}	
	function borrarCliente($d){
		 $this->db->where('id_cliente', $d['id_cliente']);			
         $this->db->delete('t_clientes');	
		 return array('status'=>1);
	}
}
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
