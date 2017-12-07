<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Sucursales_model extends CI_Model {
	private $db = null;	
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
	}	
	function getSucursales($d=null){		
		$c = '';
		if($d['id_sucursal'])
			$c .= ' and s.id_sucursal = '.$d['id_sucursal'];
		if($d['busqueda'])
			$c .= " and (  s.clave like '%".$d['busqueda']."%' or s.nombre like '%".$d['busqueda']."%' or s.encargado like '%".$d['busqueda']."%' or  s.email like '%".$d['busqueda']."%' )  ";
		$c .= " order by s.clave asc";		
		$q = $this -> db -> query("select *,borrarSucursal(id_sucursal) as borrar from t_sucursales s  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function guardarSucursal($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');	
	  	if(empty($d['id_sucursal'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_sucursales', $d);			
			$id_sucursal = $this->db->insert_id();			
        }else{
        	$id_sucursal = $d['id_sucursal'];
			unset($d['id_sucursal']);
            $this->db->where('id_sucursal', $id_sucursal);			
            $this->db->update('t_sucursales', $d);	
        } 
		return array('status'=>1,'id_sucursal'=>$id_sucursal);
	}	
	function borrarSucursal($d){
		 $this->db->where('id_sucursal', $d['id_sucursal']);			
         $this->db->delete('t_sucursales');	
		 return array('status'=>1);
	}	
	function getAlmacenesPorSucursal($d=null){
		$c = '';
		if($d['id_sucursal'])
			$c .= ' and s.id_sucursal = '.$d['id_sucursal'];
		if($d['id_almacen'])
			$c .= ' and a.id_almacen = '.$d['id_almacen'];
		$q = $this -> db -> query("
		  select s.id_sucursal,s.clave as clave_sucursal,s.nombre as sucursal,s.encargado as encargado_sucursal,
		  		 a.id_almacen,a.clave,a.nombre as almacen,a.elementos  
		  		 from t_sucursales s 
		  		 left join t_almacenes a on a.id_sucursal = s.id_sucursal where 1=1 ".$c);		
		$r = $q->result_array();		
		if(!empty($r)){
			$a = array();
			foreach ($r as $k => $v) {
				if(!isset($a[$v['clave_sucursal']]))
					$a[$v['clave_sucursal']] = array(
						'id_sucursal'=>$v['id_sucursal'],
						'clave_sucursal'=>$v['clave_sucursal'],
						'sucursal'=>$v['sucursal'],
						'encargado_sucursal'=>$v['encargado_sucursal'],						
						'a'=>array()
					);					
				$a[$v['clave_sucursal']]['a'][$v['clave']]= $v;					
			}
			$r = $a;
		}		
		return $r;
	}
}
