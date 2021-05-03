<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Proveedores_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	
	function getProveedores($d=null){		
		$c = '';
		if($d['id_proveedor'])
			$c .= ' and p.id_proveedor = '.$d['id_proveedor'];
		if($d['busqueda'])
			$c .= " and (  p.clave like '%".$d['busqueda']."%' or p.rfc like '%".$d['busqueda']."%' or p.nombre like '%".$d['busqueda']."%' or p.vendedor like '%".$d['busqueda']."%' or  p.email like '%".$d['busqueda']."%' )  ";
		$c .= " order by p.clave asc";		
		$q = $this -> db -> query("select *,borrarProveedor(id_proveedor) as borrar from t_proveedores p  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function guardarProveedor($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_proveedor'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_proveedores', $d);			
			$id_proveedor = $this->db->insert_id();			
        }else{
        	$id_proveedor = $d['id_proveedor'];
			unset($d['id_proveedor']);
            $this->db->where('id_proveedor', $id_proveedor);			
            $this->db->update('t_proveedores', $d);	
        } 
		return array('status'=>1,'id_proveedor'=>$id_proveedor);
	}	
	function borrarProveedor($d){
		 $this->db->where('id_proveedor', $d['id_proveedor']);			
         $this->db->delete('t_proveedores');	
		 return array('status'=>1);
	}
}
