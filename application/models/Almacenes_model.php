<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Almacenes_model extends CI_Model {	
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	
	function getAlmacenes($d){			
		$c = ' and a.id_sucursal = '.$this->id_sucursal;
		if($d['id_almacen'])
			$c .= ' and a.id_almacen = '.$d['id_almacen'];
		if($d['busqueda'])
			$c .= " and (  a.clave like '%".$d['busqueda']."%' or a.nombre like '%".$d['busqueda']."%' or a.encargado like '%".$d['busqueda']."%'  )  ";
		$c .= " order by a.clave asc";		
		$q = $this -> db -> query("select *,IF(elementos>0,0,1) as borrar from t_almacenes a  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function guardarAlmacen($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_almacen'])){
	  		$d['fecha_registro'] = $d['fecha_cambio'];		
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['id_sucursal'] = $this->id_sucursal;						
            $this->db->insert('t_almacenes', $d);			
			$id_almacen = $this->db->insert_id();			
        }else{
        	$id_almacen = $d['id_almacen'];
			unset($d['id_cliente_cliente']);
            $this->db->where('id_almacen', $id_almacen);			
            $this->db->update('t_almacenes', $d);	
        } 
		return array('status'=>1,'id_almacen'=>$id_almacen);
	}
	
	function borrarAlmacen($d){
		 $this->db->where('id_almacen', $d['id_almacen']);			
         $this->db->delete('t_almacenes');	
		 return array('status'=>1);
	}	
}