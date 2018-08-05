<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
	private $db = null;	
	private $id_sucursal = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database('elecnet', TRUE);		
		$this->id_sucursal = $this->s['usuario']['id_sucursal'];
	}
		
	function getProductos($d){					
		if($d['id_sucursal'])
			$c = ' and r.id_sucursal =  '.$d['id_sucursal'];
		else 
			$c = ' and r.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';		
		if($d['id_almacen'])
			$c .= ' and r.id_almacen = '.$d['id_almacen'];
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
			$c .= " order by p.clave asc";		
		
		if(isset($d['limit']) && $d['limit']>=0 )
			$c .= ' limit '.$d['limit'].',50';
		
		$s = "select 
									r.id_almacen_producto,r.id_almacen,r.id_sucursal,p.id_producto,
									p.clave,p.clave_secundaria,
									p.concepto,p.marca,p.modelo,
									p.descripcion,p.colores,p.dimensiones,p.peso,
									p.id_departamento, d.clave as dep,d.nombre as departamento,
									p.id_categoria_padre, cp. clave as cat,cp.nombre as categoria,
									p.id_categoria, c.clave as subcat,c.nombre as subcategoria,
									r.stock_min,r.stock_max,
									p.id_unidad_medida_entrada, p.id_unidad_medida_entrada as ue,
									p.id_unidad_medida_salida,p.id_unidad_medida_salida as us,
									p.factor_unidades,r.existencia,r.entradas,r.salidas,p.existencia as existencia_general,p.costo_promedio as costo_promedio_general,
								 	p.precio_venta,r.costo_promedio,p.tiempo_garantia,	round(p.valuacion) as valuacion,p.visible,p.stock,p.nuevo,	p.precio_oferta,						 	
								 	borrarProducto(p.id_producto) as borrar							 	
									from 
									t_productos p 
									left join r_almacen_productos r on r.id_producto = p.id_producto
									left join t_departamentos d on d.id_departamento = p.id_departamento
									left join t_categorias cp on cp.id_categoria = p.id_categoria_padre
									left join t_categorias c on c.id_categoria = p.id_categoria
									 where 1=1 ".$c;
		
		$q = $this -> db -> query($s);		
	$r = $q->result_array();
	
		return $r;		
	}
	
	
	function replace($str){
		return str_replace(array('á','é','í','ó','ú','Á','É','Í','Ó','Ú'), array('a','e','i','o','u','A','E','I','O','U'), $str);
	}	
		
	
	function getProductosXProveedor($d){
					
		if($d['id_sucursal'])
			$c .= ' and r.id_sucursal = '.$d['id_sucursal'];
		else
			$c = ' and r.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';		
			
		// if($d['id_proveedor'])
			// $c .= ' and rp.id_proveedor = '.$d['id_proveedor']." or r.clave is null";		
		
		$c .= " group by p.id_producto";
		
						
		$q = $this -> db -> query("
							select 
									 p.id_producto, 
									 p.clave,
									 p.concepto,
									 p.id_unidad_medida_entrada as um, 
									 rp.precio  as precio,
									 rp.descuento as descuento,
									 group_concat(a.id_almacen SEPARATOR '-|-') as id_almacen, 
									 group_concat(a.clave SEPARATOR '-|-') as clave_almacen,
									 group_concat(a.nombre SEPARATOR '-|-') as almacen
								    from t_productos p 
								    left join r_almacen_productos r on r.id_producto = p.id_producto
								    left join t_almacenes a on a.id_almacen = r.id_almacen	
								    left join (select * from r_proveedor_productos where id_proveedor = ".$d['id_proveedor'].") rp on rp.id_producto = p.id_producto
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
			$c .= ' and r.id_sucursal = '.$d['id_sucursal'];
		else
			$c = ' and r.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';
		
		$c .= " group by p.id_producto ";		
						
		$q = $this -> db -> query("select 
									 p.id_producto, 
									 p.clave,
									 p.concepto,
									 p.existencia as existencia_ue,
									 p.id_unidad_medida_entrada  as ue, 
									 group_concat(getExistenciaUS(r.existencia,p.factor_unidades) SEPARATOR '-|-') as existencia_us,
									 p.id_unidad_medida_salida as us, 
									 p.factor_unidades,
									 p.precio_venta as precio_ue,
									 getPrecioUS(p.precio_venta,p.factor_unidades)  as precio_us,	
									 r.costo_promedio as costo_promedio_ue,
									 getPrecioUS(r.costo_promedio,p.factor_unidades) as costo_promedio_us,
									 group_concat(r.id_almacen SEPARATOR '-|-') as id_almacen, 
									 group_concat(a.clave SEPARATOR '-|-') as clave_almacen,
									 group_concat(a.nombre SEPARATOR '-|-') as almacen
									 from t_productos p 
								    left join r_almacen_productos r on r.id_producto = p.id_producto
								    left join t_almacenes a on a.id_almacen = r.id_almacen		
								    where 1=1  ".$c);		
		$result = $q->result_array();
		if(!empty($result)){
			foreach ($result as $key => $v) {											
				$result[$key]['nombre'] = $this->replace($v['nombre']);
			}
		}
		return $result;		
		
	}
	
	
	
	function getPrecioXProductoServicio(){
		$c = $cs = '';		
		if($d['id_sucursal']){
			$c .= ' and r.id_sucursal = '.$d['id_sucursal'];
			$cs .= ' and s.id_sucursal = '.$d['id_sucursal'];
		}else{
			$c = ' and r.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';
			$cs = ' and s.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';
		}
			
						
		$q = $this -> db -> query(" SELECT * FROM ( select 
									 p.id_producto, 
									 p.clave,
									 p.concepto,
									 p.existencia as existencia_ue,
									 p.id_unidad_medida_entrada  as ue, 
									 group_concat(getExistenciaUS(r.existencia,p.factor_unidades) SEPARATOR '-|-') as existencia_us,
									 p.id_unidad_medida_salida as us, 
									 p.factor_unidades,
									 p.precio_venta as precio_ue,
									 getPrecioUS(p.precio_venta,p.factor_unidades)  as precio_us,	
									 r.costo_promedio as costo_promedio_ue,
									 getPrecioUS(r.costo_promedio,p.factor_unidades) as costo_promedio_us,
									 group_concat(r.id_almacen SEPARATOR '-|-') as id_almacen, 
									 group_concat(a.clave SEPARATOR '-|-') as clave_almacen,
									 group_concat(a.nombre SEPARATOR '-|-') as almacen
									 from t_productos p 
								    left join r_almacen_productos r on r.id_producto = p.id_producto
								    left join t_almacenes a on a.id_almacen = r.id_almacen		
								    where 1=1  ".$c." group by p.id_producto 
								    
								    UNION 
									 
									 select s.id_servicio,s.clave,s.concepto,1,'SERV',1,'SERV',1,s.precio_venta,s.precio_venta,0,0,0,'',''
									 from t_servicios s
									 where 1=1  ".$cs."
									 
									 )  a");		
		$result = $q->result_array();
		if(!empty($result)){
			foreach ($result as $key => $v) {											
				$result[$key]['concepto'] = $this->replace($v['concepto']);
			}
		}
		return $result;		
		
	}

	
	
	function claveUnica($d){	
		if($d['id_almacen'])
			$c .= " and r.id_almacen = ".$d['id_almacen'];
		if($d['clave'])
			$c .= " and p.clave = '".$d['clave']."'";
		if($d['clave_secundaria'])		
			$c .= " and p.clave_secundaria = '".$d['clave_secundaria']."'";				
		$q = $this -> db -> query("select p.id_producto from t_productos p inner join r_almacen_productos r on r.id_producto = p.id_producto where 1=1  ".$c);		
		$r = $q->result_array();
		return empty($r)?'true':'false';		
	}	
	
	function guardarProducto($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');		  	
	  	$d['colores'] = implode(',', $d['colores']);	
	  	if(empty($d['id_producto'])){
	  		$rp = array('id_sucursal'=>$d['id_sucursal'],'id_almacen'=>$d['id_almacen'],'stock_max'=>$d['stock_max'],'stock_min'=>$d['stock_min']);			
			unset($d['stock_max']);unset($d['stock_min']);	unset($d['id_sucursal']);unset($d['id_almacen']);								
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_productos', $d);			
			$id_producto = $this->db->insert_id();	
			$rp['id_producto'] = $id_producto;
			$this->db->insert('r_almacen_productos', $rp);
        }else{
        	$id_producto = $d['id_producto'];   
        	$id_almacen_producto = $d['id_almacen_producto'];     
        	$rp = array('stock_max'=>$d['stock_max'],'stock_min'=>$d['stock_min']);						      	     	
			unset($d['id_producto']);unset($d['stock_max']);unset($d['stock_min']);	unset($d['id_sucursal']);unset($d['id_almacen']);unset($d['id_almacen_producto']);			
            $this->db->where('id_producto', $id_producto);			
            $this->db->update('t_productos', $d);
			$this->db->where('id_almacen_producto', $id_almacen_producto);
            $this->db->update('r_almacen_productos', $rp);	
        } 
		return array('status'=>1,'id_producto'=>$id_producto);
	}
	
	function setOpciones($d){
		 $this->db->where('id_producto', $d['id_producto']);			
         $this->db->update('t_productos', $d);
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

	function getImagenesProducto($d){
		$q = $this -> db -> query("select * from  r_producto_imagen where id_producto= ".$d['id_producto']);		
		$r = $q->result_array();
		return $r;
	}

	function guardarImagen($d){
		unset($d['status']);				
		$q = $this -> db -> insert('r_producto_imagen',$d);	
		return array('status'=>1,'imagen'=>$d['imagen']);	
	}

}
