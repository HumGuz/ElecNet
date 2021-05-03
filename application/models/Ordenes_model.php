<<<<<<< HEAD
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Ordenes_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	

	function getOrdenes($d=null){		
		$c = ' and o.id_sucursal = '.$this->id_sucursal;
		
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
									o.*,IF(o.status=2,1,0) as borrar,
									pr.clave clave_proveedor,pr.nombre  nombre_proveedor
								    from t_ordenes_compra o 
								    inner join t_proveedores pr on pr.id_proveedor = o.id_proveedor 								
								    where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function getProductosXOrden($d){
				
		if($d['id_orden_compra'])
			$c .= ' and r.id_orden_compra = '.$d['id_orden_compra'];
		
		$q = $this -> db -> query("
			select 
			r.id_producto,
			r.id_almacen,
			p.clave,
			p.concepto,
			p.id_unidad_medida_entrada as um,
			r.cantidad_pedido as cantidad,
			r.descuento,
			r.precio,
			r.subtotal,
			r.total
			from r_orden_compra_productos r
			inner join t_productos p on p.id_producto = r.id_producto
			where 1=1 ".$c);
		$r = $q->result_array();
		return $r;	
		
	}
	
	function guardarOrden($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');
		
		$p = $d['productos'];
		$d['productos'] = count($p);
			
	  	if(empty($d['id_orden_compra'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];	
			$d['id_sucursal'] = $this->id_sucursal;						
            $this->db->insert('t_ordenes_compra', $d);			
			$id_orden_compra = $this->db->insert_id();				
			$this->db->query("update t_ordenes_compra set folio = '".$this->app->folio('OC',$id_orden_compra)."' where id_orden_compra =".$id_orden_compra);
        }else{
        	$id_orden_compra = $d['id_orden_compra'];
			unset($d['id_orden_compra']);
            $this->db->where('id_orden_compra', $id_orden_compra);			
            $this->db->update('t_ordenes_compra', $d);            
            $this->db->where('id_orden_compra', $id_orden_compra);			
         	$this->db->delete('r_orden_compra_productos');
        }         
        
        if(!empty($p)){        				
        	foreach ($p as $k => $v) {						
				$this->db->insert('r_orden_compra_productos', array('id_orden_compra' =>$id_orden_compra,'id_proveedor' =>$d['id_proveedor'],'id_producto'=>$v['id_producto'],'id_almacen'=>$v['id_almacen'],'cantidad_pedido'=>$v['cantidad'],'precio'=>$v['precio'],'subtotal'=>$v['subtotal'],'descuento'=>$v['descuento'],'total'=>$v['total'],'id_usuario' =>$d['id_usuario_cambio']));			
			}
        }
        		
		return array('status'=>1,'id_orden_compra'=>$id_orden_compra);
	}	
	function borrarOrden($d){
		 $this->db->where('id_orden_compra', $d['id_orden_compra']);			
         $this->db->delete(array('t_ordenes_compra','r_orden_compra_productos'));	
		 return array('status'=>1);
	}
}
=======
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Ordenes_model extends CI_Model {
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();	
		$this->id_sucursal = $this->s['id_sucursal'];
	}	

	function getOrdenes($d=null){		
		$c = ' and o.id_sucursal = '.$this->id_sucursal;
		
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
									o.*,IF(o.status=2,1,0) as borrar,
									pr.clave clave_proveedor,pr.nombre  nombre_proveedor
								    from t_ordenes_compra o 
								    inner join t_proveedores pr on pr.id_proveedor = o.id_proveedor 								
								    where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function getProductosXOrden($d){
				
		if($d['id_orden_compra'])
			$c .= ' and r.id_orden_compra = '.$d['id_orden_compra'];
		
		$q = $this -> db -> query("
			select 
			r.id_producto,
			r.id_almacen,
			p.clave,
			p.concepto,
			p.id_unidad_medida_entrada as um,
			r.cantidad_pedido as cantidad,
			r.descuento,
			r.precio,
			r.subtotal,
			r.total
			from r_orden_compra_productos r
			inner join t_productos p on p.id_producto = r.id_producto
			where 1=1 ".$c);
		$r = $q->result_array();
		return $r;	
		
	}
	
	function guardarOrden($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');
		
		$p = $d['productos'];
		$d['productos'] = count($p);
			
	  	if(empty($d['id_orden_compra'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];	
			$d['id_sucursal'] = $this->id_sucursal;						
            $this->db->insert('t_ordenes_compra', $d);			
			$id_orden_compra = $this->db->insert_id();				
			$this->db->query("update t_ordenes_compra set folio = '".$this->app->folio('OC',$id_orden_compra)."' where id_orden_compra =".$id_orden_compra);
        }else{
        	$id_orden_compra = $d['id_orden_compra'];
			unset($d['id_orden_compra']);
            $this->db->where('id_orden_compra', $id_orden_compra);			
            $this->db->update('t_ordenes_compra', $d);            
            $this->db->where('id_orden_compra', $id_orden_compra);			
         	$this->db->delete('r_orden_compra_productos');
        }         
        
        if(!empty($p)){        				
        	foreach ($p as $k => $v) {						
				$this->db->insert('r_orden_compra_productos', array('id_orden_compra' =>$id_orden_compra,'id_proveedor' =>$d['id_proveedor'],'id_producto'=>$v['id_producto'],'id_almacen'=>$v['id_almacen'],'cantidad_pedido'=>$v['cantidad'],'precio'=>$v['precio'],'subtotal'=>$v['subtotal'],'descuento'=>$v['descuento'],'total'=>$v['total'],'id_usuario' =>$d['id_usuario_cambio']));			
			}
        }
        		
		return array('status'=>1,'id_orden_compra'=>$id_orden_compra);
	}	
	function borrarOrden($d){
		 $this->db->where('id_orden_compra', $d['id_orden_compra']);			
         $this->db->delete(array('t_ordenes_compra','r_orden_compra_productos'));	
		 return array('status'=>1);
	}
}
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
