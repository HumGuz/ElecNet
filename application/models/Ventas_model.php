<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Ventas_model extends CI_Model {
	private $db = null;	
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
		$this->load->library('app');
	}
	
	function getVentas($d=null){		
		$c = '';
		
		if($d['id_sucursal'])
			$c .= ' and c.id_sucursal = '.$d['id_sucursal'];
		else
			$c = ' and c.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';
		
		if($d['id_venta'])
			$c .= ' and c.id_venta = '.$d['id_venta'];
		if($d['id_cliente']){
			if(is_array($d['id_cliente']))
			$c .= ' and c.id_cliente in ('.implode(',', $d['id_cliente']).') ' ;
			else
				$c .= ' and c.id_cliente = '.$d['id_cliente'];
		}
			
		if($d['fecha_inicial'] && $d['fecha_final'])
			$c .= " and  date(c.fecha_registro)  >= '".$d['fecha_inicial']."' and date(c.fecha_registro) <= '".$d['fecha_final']."' ";	
			
		if($d['busqueda'])
			$c .= " and (  c.folio like '%".$d['busqueda']."%' or c.observaciones like '%".$d['busqueda']."%' or p.clave like '%".$d['busqueda']."%' or p.nombre like '%".$d['busqueda']."%'  )  ";
		
		$c .= " order by c.fecha_registro desc";		
		
		$q = $this -> db -> query("select 
									c.*,IF(c.status=2,1,0) as borrar,									
									pr.clave clave_cliente,pr.nombre  nombre_cliente,ct.folio as cotizacion
								    from t_ventas c 
								    inner join t_clientes pr on pr.id_cliente = c.id_cliente 
								    left join t_cotizaciones ct on ct.id_cotizacion = c.id_cotizacion											
								    where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}
	
	function getFolioCotizacion($d){
		$q = $this -> db -> query("select  id_cotizacion from t_cotizaciones where folio = '".$d['folio']."' ");
		$r = $q->result_array();
		return   empty($r)? array('status'=>2) : array('status'=>1);
	}
	
	function getProductosXVenta($d){
				
		if($d['id_venta'])
			$c .= ' and r.id_venta = '.$d['id_venta'];
		
		$q = $this -> db -> query("
			select 
			r.id_producto,
			p.clave,
			p.concepto,
			r.um,
			r.cantidad,			
			IF(
				r.um = p.id_unidad_medida_entrada,
				p.existencia,
				getExistenciaUS(p.existencia,p.factor_unidades)
			) as existencia,			
			IF(
				r.um = p.id_unidad_medida_entrada,
				p.costo_promedio,
				getPrecioUS(p.costo_promedio,p.factor_unidades)
			) as costo_promedio,
			p.costo_promedio  costo_promedio_ue,
			r.descuento,
			r.precio,
			r.subtotal,
			r.total
			from r_venta_productos r
			inner join t_productos p on p.id_producto = r.id_producto
			where 1=1 ".$c);
		$r = $q->result_array();
		return $r;	
		
	}
	
	function getFolioVenta($d){
		$q = $this -> db -> query("select  id_venta_venta from t_ventaes_venta where folio = '".$d['folio']."' ");
		$r = $q->result_array();
		return   empty($r)? array('status'=>2) : array('status'=>1);
	}
	
	function guardarVenta($d){
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');
		
		$p = $d['productos'];
		$d['productos'] = count($p);		
		$d['id_cotizacion'] = empty($d['id_cotizacion']) ?0:$d['id_cotizacion'];			
	  	if(empty($d['id_venta'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_ventas', $d);			
			$id_venta = $this->db->insert_id();	
			$this->db->query("update t_ventas set folio = '".App::folio('V',$id_venta)."' where id_venta =".$id_venta);		
        }else{
        	$id_venta = $d['id_venta'];
			unset($d['id_venta']);
            $this->db->where('id_venta', $id_venta);			
            $this->db->update('t_ventas', $d);            
            $this->db->where('id_venta', $id_venta);			
         	$this->db->delete('r_venta_productos');
        }        
        
        if(!empty($p)){        				
        	foreach ($p as $k => $v) {				
				$v['costo_envio'] = ($d['costos_envio'] * $v['subtotal'])  /   ( $d['subtotal']  + $d['total_descuento'] );
				$v['iva'] = ($v['subtotal'] + $v['costo_envio']) * 0.16;
				$v['total'] = ($v['subtotal'] + $v['costo_envio']) * 1.16;
				$v['costo_unitario'] = ($v['total'] / $v['cantidad']);
				$this->db->insert('r_venta_productos', array('id_venta' =>$id_venta,'id_cliente' =>$d['id_cliente'],'id_cotizacion' =>$d['id_cotizacion'],'id_producto'=>$v['id_producto'],
				'cantidad'=>$v['cantidad'],
				'um'=>$v['um'],
				'precio'=>$v['precio'],
				'descuento'=>$v['descuento'],
				'total_descuento'=>$v['total_descuento'],
				'subtotal'=>$v['subtotal'],
				'costo_envio'=>$v['costo_envio'],
				'iva'=>$v['iva'],
				'total'=>$v['total'],
				'costo_unitario'=>$v['costo_unitario'],
				'costo_promedio'=>$v['costo_promedio_ue'],
				'truput'=>$v['truput'],
				'id_usuario' =>$d['id_usuario_cambio']));			
			}
        }
        		
		return array('status'=>1,'id_venta'=>$id_venta);
	}	

	function borrarVenta($d){
		 $this->db->where('id_venta', $d['id_venta']);			
         $this->db->delete(array('t_ventas','r_venta_productos'));	
		 return array('status'=>1);
	}
}
