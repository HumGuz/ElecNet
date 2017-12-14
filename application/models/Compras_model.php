<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Compras_model extends CI_Model {
	private $db = null;	
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
	}	
	function getCompras($d=null){		
		$c = '';
		if($d['id_compra'])
			$c .= ' and c.id_compra = '.$d['id_compra'];
		if($d['busqueda'])
			$c .= " and (  c.clave like '%".$d['busqueda']."%' or c.rfc like '%".$d['busqueda']."%' or c.nombre like '%".$d['busqueda']."%' or c.contacto like '%".$d['busqueda']."%' or  c.email like '%".$d['busqueda']."%' )  ";
		$c .= " order by c.clave asc";		
		$q = $this -> db -> query("select *,borrarCompra(id_compra) as borrar from t_compras c  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function guardarCompra($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_compra'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_compras', $d);			
			$id_compra = $this->db->insert_id();			
        }else{
        	$id_compra = $d['id_compra'];
			unset($d['id_compra']);
            $this->db->where('id_compra', $id_compra);			
            $this->db->update('t_compras', $d);	
        } 
		return array('status'=>1,'id_compra'=>$id_compra);
	}	
	function borrarCompra($d){
		 $this->db->where('id_compra', $d['id_compra']);			
         $this->db->delete('t_compras');	
		 return array('status'=>1);
	}
}
