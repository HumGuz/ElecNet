<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Clasificaciones_model extends CI_Model {
	private $db = null;	
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
	}	
	function getDepartamentos($d=null){		
		$c = '';
		if($d['id_departamento'])
			$c .= ' and d.id_departamento = '.$d['id_departamento'];
		if($d['busqueda'])
			$c .= " and (  d.clave like '%".$d['busqueda']."%' or d.nombre like '%".$d['busqueda']."%'  )  ";
		$c .= " order by d.clave asc";		
		$q = $this -> db -> query("select d.id_departamento,d.clave,d.nombre,d.descripcion,d.categorias,IF(categorias > 0 , 0 , 1) as borrar from t_departamentos d  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function getCategorias($d=null){		
		$c = '';
		if($d['id_categoria'])
			$c .= ' and c.id_categoria = '.$d['id_categoria'];
		if($d['id_departamento'] )
			$c .= ' and c.id_departamento = '.$d['id_departamento'];
		if(isset($d['id_categoria_padre']) && $d['id_categoria_padre'] >=0 )
			$c .= ' and c.id_categoria_padre = '.$d['id_categoria_padre'];	
		if($d['busqueda'])
			$c .= " and (  c.clave like '%".$d['busqueda']."%' or c.nombre like '%".$d['busqueda']."%' or c.descripcion like '%".$d['descripcion']."%'  )  ";
		$c .= " order by c.clave asc";		
		$q = $this -> db -> query("select c.id_categoria,c.id_categoria_padre,c.id_departamento,c.clave,c.nombre,c.descripcion,subcategorias(id_categoria) as subcategorias,IF(subcategorias(id_categoria) > 0 , 0 , 1) as borrar from t_categorias c  where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}		
	
	function guardarClasificacion($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');		
		$o = $d['op'];
		unset($d['op']);
		if($o==1){
			if(empty($d['id_departamento'])){	
				$d['id_usuario_registro'] = $d['id_usuario_cambio'];
				$d['fecha_registro'] = $d['fecha_cambio'];						
	            $this->db->insert('t_departamentos', $d);			
				$id_departamento = $this->db->insert_id();			
	        }else{
	        	$id_departamento = $d['id_departamento'];
				unset($d['id_departamento']);
	            $this->db->where('id_departamento', $id_departamento);			
	            $this->db->update('t_departamentos', $d);	
	        } 
			return array('status'=>1,'id_departamento'=>$id_departamento);
		}elseif($o==2 || $o==3){
			if(empty($d['id_categoria'])){	
				$d['id_usuario_registro'] = $d['id_usuario_cambio'];
				$d['fecha_registro'] = $d['fecha_cambio'];						
	            $this->db->insert('t_categorias', $d);			
				$id_categoria = $this->db->insert_id();			
	        }else{
	        	$id_categoria = $d['id_categoria'];
				unset($d['id_categoria']);
	            $this->db->where('id_categoria', $id_categoria);			
	            $this->db->update('t_categorias', $d);	
	        } 
			return $o==2 ? array('status'=>1,'id_departamento'=>$d['id_departamento'],'id_categoria_padre'=>$id_categoria) : array('status'=>1,'id_departamento'=>$d['id_departamento'],'id_categoria_padre'=>$d['id_categoria_padre'],'id_categoria'=>$id_categoria);
		}
		  	
		
	}	
	function borrarClasificacion($d){
		 if($d['op']==1){
		 	$this->db->where('id_departamento', $d['id_departamento']);			
	        $this->db->delete('t_departamentos');
		 }else{
		 	$this->db->where('id_categoria', $d['id_categoria']);			
	        $this->db->delete('t_categorias');
		 }
			 	
		 return array('status'=>1);
	}
	
	function getClasificaciones($d=null){
		
		$sql = "SELECT 
				c.id_categoria,
				c.id_categoria_padre,
				c.id_departamento,
				c.nombre as categoria,
				cp.nombre as categoria_padre,
				d.nombre as departamento
				FROM t_categorias c
				left join t_categorias cp on cp.id_categoria = c.id_categoria_padre
				inner join t_departamentos d on d.id_departamento = c.id_departamento
				WHERE 1=1";
				
		$q = $this -> db -> query($sql);		
		$r = $q->result_array();
		
		if(!empty($r)){
			$aux = array();
			foreach ($r as $k => $d) {
								
				if(!isset($aux[$d['id_departamento']]))
					$aux[$d['id_departamento']] = array('departamento'=>$d['departamento'],'categorias'=>array());				
				
				if($d['id_categoria_padre']==0 && !isset($aux[$d['id_departamento']]['categorias'][$d['id_categoria']])){
					$aux[$d['id_departamento']]['categorias'][$d['id_categoria']] = array('categoria'=>$d['categoria'],'subcategorias'=>array());
				}else{
					
					if(!isset($aux[$d['id_departamento']]['categorias'][$d['id_categoria_padre']]))								
						$aux[$d['id_departamento']]['categorias'][$d['id_categoria_padre']] = array('categoria'=>$d['categoria_padre'],'subcategorias'=>array());
						
					if(!isset($aux[$d['id_departamento']]['categorias'][$d['id_categoria_padre']]['subcategorias'][$d['id_categoria']]))								
						$aux[$d['id_departamento']]['categorias'][$d['id_categoria_padre']]['subcategorias'][$d['id_categoria']] = array('subcategoria'=>$d['categoria']);							
				}
				
			}
			
			$r = $aux;
			
		}

		return $r;
		
		
	}
	
}
