<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
	private $db = null;	
	private $id_sucursal = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
		$this->id_sucursal = $this->s['usuario']['id_sucursal'];
	}
		
	function getProductos($d){					
		if($d['id_sucursal'])
			$c = ' and p.id_sucursal =  '.$d['id_sucursal'];
		else 
			$c = ' and p.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';		
		if($d['id_almacen'])
			$c .= ' and p.id_almacen = '.$d['id_almacen'];
		if($d['id_producto'])		
			$c .= ' and p.id_producto = '.$d['id_producto'];
		if($d['id_departamento'])		
			$c .= ' and p.id_departamento = '.$d['id_departamento'];	
		if($d['id_categoria_padre'])		
			$c .= ' and p.id_categoria_padre = '.$d['id_categoria_padre'];	
		if($d['id_categoria'])		
			$c .= ' and p.id_categoria = '.$d['id_categoria'];
		if($d['id_unidad_medida_entrada'])		
			$c .= " and p.id_unidad_medida_entrada ='".$d['id_unidad_medida_entrada']."' ";	
		if($d['id_unidad_medida_salida'])		
			$c .= " and p.id_unidad_medida_salida = '".$d['id_unidad_medida_salida']."' ";		
		if($d['busqueda'])
			$c .= " and (  p.clave like '%".$d['busqueda']."%' or p.clave_secundaria like '%".$d['busqueda']."%' or p.descripcion like '%".$d['busqueda']."%' or p.concepto like '%".$d['busqueda']."%' or p.marca like '%".$d['busqueda']."%'  )  ";
		$c .= " order by p.clave asc";		
		$q = $this -> db -> query("select 
									p.id_almacen,p.id_producto,
									p.clave,p.clave_secundaria,
									p.concepto,p.marca,p.modelo,
									p.descripcion,p.colores,p.dimensiones,p.peso,
									p.id_departamento, d.clave as dep,
									p.id_categoria_padre, cp. clave as cat,
									p.id_categoria, c.clave as subcat,
									p.stock_min,p.stock_max,
									p.id_unidad_medida_entrada, p.id_unidad_medida_entrada as ue,
									p.id_unidad_medida_salida,p.id_unidad_medida_salida as us,
									p.factor_unidades,p.existencia,p.entradas,p.salidas,
								 	p.precio_min_venta,p.costo_promedio,p.tiempo_garantia,								 	
								 	borrarProducto(p.id_producto) as borrar							 	
									from 
									t_productos p 
									inner join t_departamentos d on d.id_departamento = p.id_departamento
									inner join t_categorias cp on cp.id_categoria = p.id_categoria_padre
									inner join t_categorias c on c.id_categoria = p.id_categoria
									 where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}
	
	
	function replace($str){
		return str_replace(array('á','é','í','ó','ú','Á','É','Í','Ó','Ú'), array('a','e','i','o','u','A','E','I','O','U'), $str);
	}	
		
	
	function getProductosXProveedor($d){
					
		if($d['id_sucursal'])
			$c .= ' and p.id_sucursal = '.$d['id_sucursal'];
		else
			$c = ' and p.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';		
			
		if($d['id_proveedor'])
			$c .= ' and r.id_proveedor = '.$d['id_proveedor']." or r.clave is null";		
		
		$c .= " group by p.id_producto order by p.clave asc";
		
						
		$q = $this -> db -> query("select 
									 group_concat(p.id_producto SEPARATOR '-|-') as id_producto, 
									 p.clave,
									 group_concat(p.concepto SEPARATOR '-|-') as concepto,
									 group_concat(p.id_unidad_medida_entrada SEPARATOR '-|-') as um, 
									 group_concat(r.precio SEPARATOR '-|-') as precio,
									 group_concat(r.descuento SEPARATOR '-|-') as descuento,
									 group_concat(p.id_almacen SEPARATOR '-|-') as id_almacen, 
									 group_concat(a.clave SEPARATOR '-|-') as clave_almacen,
									 group_concat(a.nombre SEPARATOR '-|-') as almacen
								    from t_productos p 
								    left join r_proveedor_productos r on r.clave = p.clave
								    left join t_almacenes a on a.id_almacen = p.id_almacen	
								    where 1=1 ".$c);		
		$result = $q->result_array();
		if(!empty($result)){
			foreach ($result as $key => $v) {											
				$result[$key]['nombre'] = $this->replace($v['nombre']);
			}
		}
		return $result;			
	}

	function getPrecioXProducto(){
				
		if($d['id_sucursal'])
			$c .= ' and p.id_sucursal = '.$d['id_sucursal'];
		else
			$c = ' and p.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';
		
		$c .= " group by p.id_producto order by p.clave asc";		
						
		$q = $this -> db -> query("select 
									 group_concat(p.id_producto SEPARATOR '-|-') as id_producto, 
									 p.clave,
									 group_concat(p.concepto SEPARATOR '-|-') as concepto,
									 group_concat(p.existencia SEPARATOR '-|-') as existencia_ue,
									 group_concat(p.id_unidad_medida_entrada SEPARATOR '-|-') as ue, 
									 group_concat(getExistenciaUS(p.existencia,p.factor_unidades) SEPARATOR '-|-') as existencia_us,
									 group_concat(p.id_unidad_medida_salida SEPARATOR '-|-') as us, 
									 group_concat(p.precio_min_venta  SEPARATOR '-|-') as precio_ue,
									 group_concat(getPrecioUS(p.precio_min_venta,p.factor_unidades)  SEPARATOR '-|-') as precio_us,	
									 group_concat( p.costo_promedio SEPARATOR '-|-') as costo_promedio,
									 group_concat(p.id_almacen SEPARATOR '-|-') as id_almacen, 
									 group_concat(a.clave SEPARATOR '-|-') as clave_almacen,
									 group_concat(a.nombre SEPARATOR '-|-') as almacen
									 from t_productos p 
								    left join r_proveedor_productos r on r.clave = p.clave
								    left join t_almacenes a on a.id_almacen = p.id_almacen		
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
		if($d['id_almacen'])
			$c .= " and p.id_almacen = ".$d['id_almacen'];
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
	  	$d['colores'] = implode(',', $d['colores']);
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
