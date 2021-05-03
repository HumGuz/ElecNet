<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Compras_model extends CI_Model {	
	private $id_sucursal = null;
	private $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();					
		$this->id_sucursal = $this->s['id_sucursal'];
	}
	
	function getCompras($d=null){		
		$c = ' and c.id_sucursal = '.$this->id_sucursal;		
		if($d['id_compra'])
			$c .= ' and c.id_compra = '.$d['id_compra'];
		if($d['id_proveedor']){
			if(is_array($d['id_proveedor']))
			$c .= ' and c.id_proveedor in ('.implode(',', $d['id_proveedor']).') ' ;
			else
				$c .= ' and c.id_proveedor = '.$d['id_proveedor'];
		}
			
		if($d['fecha_inicial'] && $d['fecha_final'])
			$c .= " and  date(c.fecha_registro)  >= '".$d['fecha_inicial']."' and date(c.fecha_registro) <= '".$d['fecha_final']."' ";	
			
		if($d['busqueda'])
			$c .= " and (  c.folio like '%".$d['busqueda']."%' or c.observaciones like '%".$d['busqueda']."%' or pr.clave like '%".$d['busqueda']."%' or pr.nombre like '%".$d['busqueda']."%'  )  ";
		
		$c .= " order by c.fecha_registro desc";		
		
		$q = $this -> db -> query("select 
									c.*,IF(c.status=2,1,0) as borrar,
									o.folio as folio_orden,
									o.fecha_registro as fecha_orden,
									pr.clave clave_proveedor,pr.nombre  nombre_proveedor
								    from t_compras c 
								    inner join t_proveedores pr on pr.id_proveedor = c.id_proveedor 	
									 left join t_ordenes_compra o on c.id_orden_compra = o.id_orden_compra											
								    where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}	
	
	function facturaUnica($d){			
		if($d['factura'])
			$c .= " and c.factura = '".trim($d['factura'])."'";			
		$q = $this -> db -> query("select id_compra from t_compras c  where 1=1  ".$c);		
		$r = $q->result_array();
		return empty($r)?'true':'false';		
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
	
	
	function getProductosXCompra($d){
				
		if($d['id_compra'])
			$c .= ' and r.id_compra = '.$d['id_compra'];
		
		$q = $this -> db -> query("
			select 
			r.id_producto,
			r.id_almacen,
			p.clave,
			p.concepto,
			p.id_unidad_medida_entrada as um,
			r.cantidad,
			r.descuento,
			r.precio,
			r.subtotal,
			r.total
			from r_compra_productos r
			inner join t_productos p on p.id_producto = r.id_producto
			where 1=1 ".$c);
		$r = $q->result_array();
		return $r;	
		
	}
	
	function getFolioOrden($d){
		$q = $this -> db -> query("select  id_orden_compra from t_ordenes_compra where folio = '".$d['folio']."' ");
		$r = $q->result_array();
		return   empty($r)? array('status'=>2) : array('status'=>1);
	}
	
	
	
	function guardarCompra($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');
		
		$p = $d['productos'];
		$d['productos'] = count($p);
			
	  	if(empty($d['id_compra'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];		
			$d['id_sucursal'] = $this->id_sucursal;							
            $this->db->insert('t_compras', $d);			
			$id_compra = $this->db->insert_id();	
			$this->db->query("update t_compras set folio = '".$this->app->folio('CM',$id_compra)."' where id_compra =".$id_compra);		
        }else{
        	$id_compra = $d['id_compra'];
			unset($d['id_compra']);
            $this->db->where('id_compra', $id_compra);			
            $this->db->update('t_compras', $d);            
            $this->db->where('id_compra', $id_compra);			
         	$this->db->delete('r_compra_productos');
        }        
        
        if(!empty($p)){        				
        	foreach ($p as $k => $v) {				
				$v['costo_envio'] = ($d['costos_envio'] * $v['subtotal'])  / ( $d['subtotal']  + $d['total_descuento'] );				
				$v['iva'] = ($v['subtotal'] + $v['costo_envio']) * 0.16;
				$v['total'] = ($v['subtotal'] + $v['costo_envio']) * 1.16;
				$v['costo_unitario'] = ($v['total'] / $v['cantidad']);
				$this->db->insert('r_compra_productos', array('id_compra' =>$id_compra,'id_proveedor' =>$d['id_proveedor'],'id_orden_compra' =>$d['id_orden_compra'],'id_producto'=>$v['id_producto'],'id_almacen'=>$v['id_almacen'],
				'cantidad'=>$v['cantidad'],
				'precio'=>$v['precio'],
				'descuento'=>$v['descuento'],
				'total_descuento'=>$v['total_descuento'],
				'subtotal'=>$v['subtotal'],
				'costo_envio'=>$v['costo_envio'],
				'iva'=>$v['iva'],
				'total'=>$v['total'],
				'costo_unitario'=>$v['costo_unitario'],
				'id_usuario' =>$d['id_usuario_cambio']));			
			}
        }
        		
		return array('status'=>1,'id_compra'=>$id_compra);
	}	
	function borrarCompra($d){
		 $this->db->where('id_compra', $d['id_compra']);			
         $this->db->delete(array('t_compras','r_compra_productos'));	
		 return array('status'=>1);
	}
}
