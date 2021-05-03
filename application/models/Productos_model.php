<<<<<<< HEAD
﻿<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	
		
	function getProductos($d){
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
				
		if($d['order_by']){			
			$c .= " order by ".$d['order_by'].' '.($d['order_flag'] ?$d['order_flag']:'asc');
		}else
			$c .= " order by p.clave asc";	
		
		$s = "select 
									p.id_producto,p.clave,p.concepto,p.marca,p.modelo,
									p.colores,p.dimensiones,p.peso,
									p.id_departamento, d.clave as dep,d.nombre as departamento,
									p.id_categoria_padre, cp. clave as cat,cp.nombre as categoria,
									p.id_categoria, c.clave as subcat,c.nombre as subcategoria,																	
									p.costo_promedio,p.valuacion,p.tags,
								 	p.precio_venta,p.tiempo_garantia,p.visible,p.nuevo,p.stock,p.precio_oferta,	
								 	p.id_unidad_medida_entrada,p.id_unidad_medida_salida,p.factor_unidades,p.descripcion,					 	
								 	borrarProducto(p.id_producto) as borrar							 	
									from 
									t_productos p								
									left join t_departamentos d on d.id_departamento = p.id_departamento
									left join t_categorias cp on cp.id_categoria = p.id_categoria_padre
									left join t_categorias c on c.id_categoria = p.id_categoria
									 where 1=1 ".$c;
		
		$q = $this -> db -> query($s);		
	$r = $q->result_array();
	
		return $r;		
	}
	
	function getProductosAlmacen($d){					
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
		
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
	
	function getProductosSitio($d){					
		$c = ' and r.id_sucursal = '.$this->id_sucursal;	
				
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
			
		if($d['busqueda'])
			$c .= " and (  p.descripcion like '%".$d['busqueda']."%' or p.concepto like '%".$d['busqueda']."%' or p.marca like '%".$d['busqueda']."%'  )  ";
				
		$c .= " order by p.clave asc";
				
		$s = "select 
									r.id_almacen_producto,r.id_almacen,r.id_sucursal,p.id_producto,
									p.clave,p.clave_secundaria,
									p.concepto,p.marca,p.modelo,
									p.descripcion,p.colores,p.dimensiones,p.peso,
									p.id_departamento, d.clave as dep,d.nombre as departamento,
									p.id_categoria_padre, cp. clave as cat,cp.nombre as categoria,
									p.id_categoria, c.clave as subcat,c.nombre as subcategoria,									
									p.existencia as existencia,
								 	p.precio_venta,p.tiempo_garantia,round(p.valuacion) as valuacion,
								 	p.visible,p.stock,p.nuevo,p.precio_oferta	
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
		$find = array('á','é','í','ó','ú','â','ê','î','ô','û','ã','õ','ç','ñ','Á','É','Í','Ó','Ú','Â','Ê','Î','Ô','Û','Ã','Õ','Ç','Ñ');
		$repl = array('a','e','i','o','u','a','e','i','o','u','a','o','c','n','A','E','I','O','U','A','E','I','O','U','A','O','C','N');		
		return str_replace($find, $repl, $str);
	}	
		
	
	function getProductosXProveedor($d){
					
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
			
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
				
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
		
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
		
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
		$cs = ' and s.id_sucursal = '.$this->id_sucursal;
		
		
		$sql = "  select a.*,
			 d.clave as dep,d.nombre as departamento,
			 cp.clave as cat,cp.nombre as categoria,
			 c.clave as subcat,c.nombre as subcategoria			
			
		 from (
						select 
									 'p' as tipo,
									 p.id_producto, 
									 p.id_departamento,
									 p.id_categoria_padre,
									 p.id_categoria,
									 p.clave,
									 p.concepto,
									 p.existencia as existencia_ue,
									 p.id_unidad_medida_entrada  as ue, 
									 getExistenciaUS(r.existencia,p.factor_unidades) as existencia_us,
									 p.id_unidad_medida_salida as us, 
									 p.factor_unidades,
									 p.precio_venta as precio_ue,
									 getPrecioUS(p.precio_venta,p.factor_unidades)  as precio_us,	
									 r.costo_promedio as costo_promedio_ue,
									 getPrecioUS(r.costo_promedio,p.factor_unidades) as costo_promedio_us,
									 r.id_almacen  as id_almacen, 
									 a.clave  as clave_almacen,
									 a.nombre  as almacen
									 from t_productos p 
								    left join r_almacen_productos r on r.id_producto = p.id_producto
								    left join t_almacenes a on a.id_almacen = r.id_almacen		
								    where 1=1 ".$c." 
								    
								    UNION 
									 
									 select 's' as tipo,s.id_servicio,s.id_departamento, s.id_categoria_padre, s.id_categoria,
									 s.clave,s.concepto,1,'SERV',1,'SERV',1,s.precio_venta,s.precio_venta,0,0,0,'SERV','Servicios'
									 from t_servicios s
									 where 1=1 ".$cs ." ) a
									 
									inner join t_departamentos d on d.id_departamento = a.id_departamento
									inner join t_categorias cp on cp.id_categoria = a.id_categoria_padre
									inner join t_categorias c on c.id_categoria = a.id_categoria
									 
									 ";
						
		$q = $this -> db -> query($sql);		
									
		$result = $q->result_array();
		return $this->armDataSet($result);		
		
	}

	function armDataSet($result){
		if(!empty($result)){					
			$aux = array('list'=>array(),'data'=>array(),'keys'=>array(),'names'=>array());
			foreach ($result as $key => $v) {								
				$v['concepto'] = trim(strtolower(self::replace($v['concepto'])));				
				$v['clave'] = trim(strtolower(self::replace($v['clave'])));				
				$v['uid'] = $v['tipo'].$v['id_producto'];				
				if(!in_array($v['clave'],$aux['keys']))				
					$aux['keys'][] = array('clave'=>$v['clave']);
				if(!in_array($v['concepto'],$aux['names']))
					$aux['names'][] =  array('concepto'=>$v['concepto']);
				if(!isset($aux['data'][$v['clave']]))
					$aux['data'][$v['clave']] = array();
				if(!isset($aux['data'][$v['concepto']]))
					$aux['data'][$v['concepto']] = array();	
				$aux['data'][$v['clave']][] = $v['tipo'].$v['id_producto'];				
				$aux['data'][$v['concepto']][] = $v['tipo'].$v['id_producto'];	
				$aux['list'][$v['tipo'].$v['id_producto']] = $v;				
			}
			$result = $aux;
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
		$q = $this -> db -> query("select p.id_producto from t_productos p left join r_almacen_productos r on r.id_producto = p.id_producto where 1=1  ".$c);		
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
            $this->db->where('id_producto', $id_producto);			
            $this->db->update('t_productos', $d);
        } 
		return array('status'=>1,'id_producto'=>$id_producto);
	}

	function guardarProductoAlmacen($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');		  	
	  	$d['colores'] = implode(',', $d['colores']);	
	  	if(empty($d['id_producto'])){
	  		$rp = array('id_sucursal'=>$this->id_sucursal,'id_almacen'=>$d['id_almacen'],'stock_max'=>$d['stock_max'],'stock_min'=>$d['stock_min']);			
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
		 $this->borrarImagen($d);		 
		 return array('status'=>1);
	}	

	function hacerPortada($d){
		$this -> db -> query("update r_producto_imagen  set portada = 0 where id_producto = ".$d['id_producto']);		
		$this -> db -> query("update r_producto_imagen  set portada = 1 where imagen = '".$d['imagen']."' and id_producto = ".$d['id_producto']);		
		return array('status'=>1);
	}	


	function borrarImagen($d){
		$c = '';
		if($d['id_producto'])
			$c .= " and id_producto = ".$d['id_producto'];			
		if($d['imagen'])
			$c .= " and imagen = '".$d['imagen']."'";				
		
		$imgs = $this->getImagenesProducto($d);
		if(!empty($imgs)){
			foreach ($imgs as $key => $i) {				
				unlink(FCPATH.'application/views/img/uploads/'.$i['imagen']);
			}			
			$this -> db -> query("delete from r_producto_imagen where 1=1 ".$c);		
		}		
		return array('status'=>1);		
	}



	function getImagenesProducto($d){
		
		$c = '';
		if($d['id_producto'])
			$c .= " and id_producto = ".$d['id_producto'];			
		if($d['imagen'])
			$c .= " and imagen = '".$d['imagen']."'";		
		$q = $this -> db -> query("select * from  r_producto_imagen where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;
	}

	function guardarImagen($d){
		unset($d['status']);				
		$q = $this -> db -> insert('r_producto_imagen',$d);	
		return array('status'=>1,'imagen'=>$d['imagen']);	
	}

=======
﻿<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	
		
	function getProductos($d){
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
				
		if($d['order_by']){			
			$c .= " order by ".$d['order_by'].' '.($d['order_flag'] ?$d['order_flag']:'asc');
		}else
			$c .= " order by p.clave asc";	
		
		$s = "select 
									p.id_producto,p.clave,p.concepto,p.marca,p.modelo,
									p.colores,p.dimensiones,p.peso,
									p.id_departamento, d.clave as dep,d.nombre as departamento,
									p.id_categoria_padre, cp. clave as cat,cp.nombre as categoria,
									p.id_categoria, c.clave as subcat,c.nombre as subcategoria,																	
									p.costo_promedio,p.valuacion,p.tags,
								 	p.precio_venta,p.tiempo_garantia,p.visible,p.nuevo,p.stock,p.precio_oferta,	
								 	p.id_unidad_medida_entrada,p.id_unidad_medida_salida,p.factor_unidades,p.descripcion,					 	
								 	borrarProducto(p.id_producto) as borrar							 	
									from 
									t_productos p								
									left join t_departamentos d on d.id_departamento = p.id_departamento
									left join t_categorias cp on cp.id_categoria = p.id_categoria_padre
									left join t_categorias c on c.id_categoria = p.id_categoria
									 where 1=1 ".$c;
		
		$q = $this -> db -> query($s);		
	$r = $q->result_array();
	
		return $r;		
	}
	
	function getProductosAlmacen($d){					
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
		
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
	
	function getProductosSitio($d){					
		$c = ' and r.id_sucursal = '.$this->id_sucursal;	
				
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
			
		if($d['busqueda'])
			$c .= " and (  p.descripcion like '%".$d['busqueda']."%' or p.concepto like '%".$d['busqueda']."%' or p.marca like '%".$d['busqueda']."%'  )  ";
				
		$c .= " order by p.clave asc";
				
		$s = "select 
									r.id_almacen_producto,r.id_almacen,r.id_sucursal,p.id_producto,
									p.clave,p.clave_secundaria,
									p.concepto,p.marca,p.modelo,
									p.descripcion,p.colores,p.dimensiones,p.peso,
									p.id_departamento, d.clave as dep,d.nombre as departamento,
									p.id_categoria_padre, cp. clave as cat,cp.nombre as categoria,
									p.id_categoria, c.clave as subcat,c.nombre as subcategoria,									
									p.existencia as existencia,
								 	p.precio_venta,p.tiempo_garantia,round(p.valuacion) as valuacion,
								 	p.visible,p.stock,p.nuevo,p.precio_oferta	
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
		$find = array('á','é','í','ó','ú','â','ê','î','ô','û','ã','õ','ç','ñ','Á','É','Í','Ó','Ú','Â','Ê','Î','Ô','Û','Ã','Õ','Ç','Ñ');
		$repl = array('a','e','i','o','u','a','e','i','o','u','a','o','c','n','A','E','I','O','U','A','E','I','O','U','A','O','C','N');		
		return str_replace($find, $repl, $str);
	}	
		
	
	function getProductosXProveedor($d){
					
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
			
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
				
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
		
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
		
		$c = ' and r.id_sucursal = '.$this->id_sucursal;
		$cs = ' and s.id_sucursal = '.$this->id_sucursal;
		
		
		$sql = "  select a.*,
			 d.clave as dep,d.nombre as departamento,
			 cp.clave as cat,cp.nombre as categoria,
			 c.clave as subcat,c.nombre as subcategoria			
			
		 from (
						select 
									 'p' as tipo,
									 p.id_producto, 
									 p.id_departamento,
									 p.id_categoria_padre,
									 p.id_categoria,
									 p.clave,
									 p.concepto,
									 p.existencia as existencia_ue,
									 p.id_unidad_medida_entrada  as ue, 
									 getExistenciaUS(r.existencia,p.factor_unidades) as existencia_us,
									 p.id_unidad_medida_salida as us, 
									 p.factor_unidades,
									 p.precio_venta as precio_ue,
									 getPrecioUS(p.precio_venta,p.factor_unidades)  as precio_us,	
									 r.costo_promedio as costo_promedio_ue,
									 getPrecioUS(r.costo_promedio,p.factor_unidades) as costo_promedio_us,
									 r.id_almacen  as id_almacen, 
									 a.clave  as clave_almacen,
									 a.nombre  as almacen
									 from t_productos p 
								    left join r_almacen_productos r on r.id_producto = p.id_producto
								    left join t_almacenes a on a.id_almacen = r.id_almacen		
								    where 1=1 ".$c." 
								    
								    UNION 
									 
									 select 's' as tipo,s.id_servicio,s.id_departamento, s.id_categoria_padre, s.id_categoria,
									 s.clave,s.concepto,1,'SERV',1,'SERV',1,s.precio_venta,s.precio_venta,0,0,0,'SERV','Servicios'
									 from t_servicios s
									 where 1=1 ".$cs ." ) a
									 
									inner join t_departamentos d on d.id_departamento = a.id_departamento
									inner join t_categorias cp on cp.id_categoria = a.id_categoria_padre
									inner join t_categorias c on c.id_categoria = a.id_categoria
									 
									 ";
						
		$q = $this -> db -> query($sql);		
									
		$result = $q->result_array();
		return $this->armDataSet($result);		
		
	}

	function armDataSet($result){
		if(!empty($result)){					
			$aux = array('list'=>array(),'data'=>array(),'keys'=>array(),'names'=>array());
			foreach ($result as $key => $v) {								
				$v['concepto'] = trim(strtolower(self::replace($v['concepto'])));				
				$v['clave'] = trim(strtolower(self::replace($v['clave'])));				
				$v['uid'] = $v['tipo'].$v['id_producto'];				
				if(!in_array($v['clave'],$aux['keys']))				
					$aux['keys'][] = array('clave'=>$v['clave']);
				if(!in_array($v['concepto'],$aux['names']))
					$aux['names'][] =  array('concepto'=>$v['concepto']);
				if(!isset($aux['data'][$v['clave']]))
					$aux['data'][$v['clave']] = array();
				if(!isset($aux['data'][$v['concepto']]))
					$aux['data'][$v['concepto']] = array();	
				$aux['data'][$v['clave']][] = $v['tipo'].$v['id_producto'];				
				$aux['data'][$v['concepto']][] = $v['tipo'].$v['id_producto'];	
				$aux['list'][$v['tipo'].$v['id_producto']] = $v;				
			}
			$result = $aux;
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
		$q = $this -> db -> query("select p.id_producto from t_productos p left join r_almacen_productos r on r.id_producto = p.id_producto where 1=1  ".$c);		
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
            $this->db->where('id_producto', $id_producto);			
            $this->db->update('t_productos', $d);
        } 
		return array('status'=>1,'id_producto'=>$id_producto);
	}

	function guardarProductoAlmacen($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');		  	
	  	$d['colores'] = implode(',', $d['colores']);	
	  	if(empty($d['id_producto'])){
	  		$rp = array('id_sucursal'=>$this->id_sucursal,'id_almacen'=>$d['id_almacen'],'stock_max'=>$d['stock_max'],'stock_min'=>$d['stock_min']);			
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
		 $this->borrarImagen($d);		 
		 return array('status'=>1);
	}	

	function hacerPortada($d){
		$this -> db -> query("update r_producto_imagen  set portada = 0 where id_producto = ".$d['id_producto']);		
		$this -> db -> query("update r_producto_imagen  set portada = 1 where imagen = '".$d['imagen']."' and id_producto = ".$d['id_producto']);		
		return array('status'=>1);
	}	


	function borrarImagen($d){
		$c = '';
		if($d['id_producto'])
			$c .= " and id_producto = ".$d['id_producto'];			
		if($d['imagen'])
			$c .= " and imagen = '".$d['imagen']."'";				
		
		$imgs = $this->getImagenesProducto($d);
		if(!empty($imgs)){
			foreach ($imgs as $key => $i) {				
				unlink(FCPATH.'application/views/img/uploads/'.$i['imagen']);
			}			
			$this -> db -> query("delete from r_producto_imagen where 1=1 ".$c);		
		}		
		return array('status'=>1);		
	}



	function getImagenesProducto($d){
		
		$c = '';
		if($d['id_producto'])
			$c .= " and id_producto = ".$d['id_producto'];			
		if($d['imagen'])
			$c .= " and imagen = '".$d['imagen']."'";		
		$q = $this -> db -> query("select * from  r_producto_imagen where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;
	}

	function guardarImagen($d){
		unset($d['status']);				
		$q = $this -> db -> insert('r_producto_imagen',$d);	
		return array('status'=>1,'imagen'=>$d['imagen']);	
	}

>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
}