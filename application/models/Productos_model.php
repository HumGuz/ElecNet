<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
	private $db = null;	
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
	}	
	function getProductos($d){		
		$c = '';
		if($d['id_almacen'])
			$c .= ' and p.id_almacen = '.$d['id_almacen'];
		if($d['id_producto'])		
			$c .= ' and p.id_producto = '.$d['id_producto'];	
		
		if($d['busqueda'])
			$c .= " and (  p.clave like '%".$d['busqueda']."%' or p.clave_secundaria like '%".$d['busqueda']."%' or p.descripcion like '%".$d['busqueda']."%' or p.observaciones like '%".$d['busqueda']."%' or p.marca like '%".$d['busqueda']."%'  )  ";
		$c .= " order by p.clave asc";		
		$q = $this -> db -> query("select * from t_productos p  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}
	
	function claveUnica($d){		
		$c = '';
		if($d['clave'])
			$c .= " and p.clave = '".$d['clave']."'";
		if($d['clave_secundaria'])		
			$c .= " and p.clave_secundaria = '".$d['clave_secundaria']."'";				
		$q = $this -> db -> query("select id_producto from t_productos p  where 1=1  ".$c);		
		$r = $q->result_array();
		return empty($r)?'true':'false';		
	}	
	
	function guardarProducto($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_producto'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_productos', $d);			
			$id_producto = $this->db->insert_id();			
        }else{
        	$id_producto = $d['id_producto'];
			unset($d['id_cliente_cliente']);
            $this->db->where('id_producto', $id_producto);			
            $this->db->update('t_productos', $d);	
        } 
		return array('status'=>1,'id_producto'=>$id_producto);
	}
	
	function getUnidadesDeMedida($d= null){			
		$sql = "select id_unidad_medida,nombre,magnitud from t_unidades_medida ";		
		$q = $this -> db -> query($sql);		
		$r = $q->result_array();			
		if(!empty($r)){
			$aux = array();
			foreach ($r as $key => $v) {
				if(!isset($aux[$v['magnitud']]))
					$aux[$v['magnitud']] = array();
				
				$aux[$v['magnitud']][$v['id_unidad_medida']] = $v;
					
			}
			$r = $aux;
		}		
		return $r;
	}
	
	function borrarProducto($d){
		 $this->db->where('id_producto', $d['id_producto']);			
         $this->db->delete('t_productos');	
		 return array('status'=>1);
	}	
}
