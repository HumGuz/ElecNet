<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Servicios_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	
		
	function getServicios($d){					
		$c = ' and s.id_sucursal = '.$this->id_sucursal;
		
		if($d['id_servicio'])		
			$c .= ' and s.id_servicio = '.$d['id_servicio'];
		if($d['id_departamento'])		
			$c .= ' and s.id_departamento = '.$d['id_departamento'];	
		if($d['id_categoria_padre'])		
			$c .= ' and s.id_categoria_padre = '.$d['id_categoria_padre'];	
		if($d['id_categoria'])		
			$c .= ' and s.id_categoria = '.$d['id_categoria'];		
		if($d['busqueda'])
			$c .= " and (  s.clave like '%".$d['busqueda']."%' or s.clave_secundaria like '%".$d['busqueda']."%' or s.descripcion like '%".$d['busqueda']."%' or s.concepto like '%".$d['busqueda']."%' )  ";
				
		if($d['group_by'])
			$c .= " group by ".$d['group_by'];	
		
		if($d['order_by']){			
			if(is_array($d['order_by'])){					
				$o = " order by ";						
				foreach ($d['order_by'] as $ko => $o) {
					$o .= " order by ".$o.' '.( is_array($d['order_flag']) && isset($d['order_flag'][$ko]) ?$d['order_flag'][$ko]: ($d['order_flag'] && !is_array($d['order_flag']) ? $d['order_flag'] :'asc') ).',' ;
				}
				$c .= trim($o,',');
			}else{
				$c .= " order by ".$d['order_by'].' '.($d['order_flag'] ?$d['order_flag']:'asc');
			}
		}else
			$c .= " order by s.clave asc";		
		
		if($d['limit'])
			$c .= 'limit '.$d['limit'].',50';
		
		$q = $this -> db -> query("select 
									s.id_sucursal,s.id_servicio,
									s.clave,s.clave_secundaria,
									s.concepto,s.descripcion,
									s.id_departamento, d.clave as dep,d.nombre as departamento,
									s.id_categoria_padre, cp.clave as cat,cp.nombre as categoria,
									s.id_categoria, c.clave as subcat,c.nombre as subcategoria,								
									'SERV' as us,s.salidas,									
								 	s.precio_venta,s.tiempo_garantia,				 	
								 	borrarServicio(s.id_servicio) as borrar							 	
									from 
									t_servicios s 									
									inner join t_departamentos d on d.id_departamento = s.id_departamento
									inner join t_categorias cp on cp.id_categoria = s.id_categoria_padre
									inner join t_categorias c on c.id_categoria = s.id_categoria
									 where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}
		
	function replace($str){
		return str_replace(array('á','é','í','ó','ú','Á','É','Í','Ó','Ú'), array('a','e','i','o','u','A','E','I','O','U'), $str);
	}	
	
	function getPrecioXServicio(){
				
		$c = ' and s.id_sucursal = '.$this->id_sucursal;
		
		$c .= " group by s.id_servicio ";		
						
		$q = $this -> db -> query("select 
									 s.id_servicio, 
									 s.clave,
									 s.concepto,									
									 'SERV' as us, 									
									 s.precio_venta as precio_us
									 from t_servicios s 								   
								    where 1=1  ".$c);		
		$result = $q->result_array();
		if(!empty($result)){
			foreach ($result as $key => $v) {											
				$result[$key]['nombre'] = $this->replace($v['nombre']);
			}
		}
		return $result;		
		
	}
	
	function claveUnica($d){	
		if($d['id_sucursal'])
			$c .= " and s.id_sucursal = ".$d['id_sucursal'];
		if($d['clave'])
			$c .= " and s.clave = '".$d['clave']."'";
		if($d['clave_secundaria'])		
			$c .= " and s.clave_secundaria = '".$d['clave_secundaria']."'";				
		$q = $this -> db -> query("select s.id_servicio from t_servicios s  where 1=1  ".$c);		
		$r = $q->result_array();
		return empty($r)?'true':'false';		
	}	
	
	function guardarServicio($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');
		
	  	if(empty($d['id_servicio'])){
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];	
			$d['id_sucursal'] = $this->id_sucursal;						
            $this->db->insert('t_servicios', $d);			
			$id_servicio = $this->db->insert_id();	
        }else{
        	$id_servicio = $d['id_servicio']; 
            $this->db->where('id_servicio', $id_servicio);			
            $this->db->update('t_servicios', $d);
        } 
		return array('status'=>1,'id_servicio'=>$id_servicio);
	}
	
	function borrarServicio($d){
		 $this->db->where('id_servicio', $d['id_servicio']);		 			
         $this->db->delete('t_servicios');	
		 return array('status'=>1);
	}	
	
}
