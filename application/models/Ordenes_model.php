<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Ordenes_model extends CI_Model {
	private $db = null;	
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
	}	
	function getOrdenes($d=null){		
		$c = '';
		if($d['id_orden_compra'])
			$c .= ' and o.id_orden_compra = '.$d['id_orden_compra'];
		if($d['id_proveedor']){
			if(is_array($d['id_proveedor']))
			$c .= ' and o.id_proveedor in ('.implode(',', $d['id_proveedor']).') ' ;
			else
				$c .= ' and o.id_proveedor = '.$d['id_proveedor'];
		}
			
		if($d['fecha_inicial'] && $d['fecha_final'])
			$c .= " and  date(o.fecha_registro)  >= '".$d['fecha_inicial']."' and date(o.fecha_registro) <= '".$d['fecha_final']."' ";	
			
		if($d['busqueda'])
			$c .= " and (  o.folio like '%".$d['busqueda']."%' or o.observaciones like '%".$d['busqueda']."%' or p.clave like '%".$d['busqueda']."%' or p.nombre like '%".$d['busqueda']."%'  )  ";
		
		$c .= " order by o.fecha_registro desc";		
		
		$q = $this -> db -> query("select 
									o.*,IF(o.status=2,0,1) as borrar,
									pr.clave clave_proveedor,pr.nombre  nombre_proveedor
								    from t_ordenes_compra o 
								    inner join t_proveedores pr on pr.id_proveedor = o.id_proveedor 								
								    where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function guardarOrden($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_orden_compra'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_ordenes', $d);			
			$id_orden_compra = $this->db->insert_id();			
        }else{
        	$id_orden_compra = $d['id_orden_compra'];
			unset($d['id_orden_compra']);
            $this->db->where('id_orden_compra', $id_orden_compra);			
            $this->db->update('t_ordenes', $d);	
        } 
		return array('status'=>1,'id_orden_compra'=>$id_orden_compra);
	}	
	function borrarOrden($d){
		 $this->db->where('id_orden_compra', $d['id_orden_compra']);			
         $this->db->delete('t_ordenes');	
		 return array('status'=>1);
	}
}
