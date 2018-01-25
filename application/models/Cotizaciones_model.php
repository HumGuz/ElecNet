<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Cotizaciones_model extends CI_Model {
	private $db = null;	
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
		$this->load->library('app');
	}
	
	function getCotizaciones($d=null){		
		$c = '';		
		if($d['id_sucursal'])
			$c .= ' and c.id_sucursal = '.$d['id_sucursal'];
		else
			$c = ' and c.id_sucursal in ('.$this->s['usuario']['sucursales'].') ';		
		if($d['id_cotizacion'])
			$c .= ' and c.id_cotizacion = '.$d['id_cotizacion'];
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
									pr.clave clave_cliente,pr.nombre  nombre_cliente
								    from t_cotizaciones c 
								    inner join t_clientes pr on pr.id_cliente = c.id_cliente 										 										
								    where 1=1 ".$c);		
		$r = $q->result_array();
		return $r;		
	}
			
	function getProductosXCotizacion($d){
				
		if($d['id_cotizacion'])
			$c .= ' and r.id_cotizacion = '.$d['id_cotizacion'];
		
		$q = $this -> db -> query("
			select 
			r.id_producto,
			p.clave,
			p.concepto,
			IF(
				r.um = p.id_unidad_medida_entrada,
				p.existencia,
				getExistenciaUS(p.existencia,p.factor_unidades)
			) as existencia,			
			r.um,
			r.cantidad,
			r.descuento,
			r.precio,
			r.subtotal,
			r.total
			from r_cotizacion_productos r
			inner join t_productos p on p.id_producto = r.id_producto
			where 1=1 ".$c);
		$r = $q->result_array();
		return $r;	
		
	}	
	
	function guardarCotizacion($d){		
		$d['id_usuario_cambio'] = $this->s['usuario']['id_usuario'];
		$d['fecha_cambio'] = date('Y-m-d H:i:s');		
		$p = $d['productos'];
		$d['productos'] = count($p);			
	  	if(empty($d['id_cotizacion'])){	
			$d['id_usuario_registro'] = $d['id_usuario_cambio'];
			$d['fecha_registro'] = $d['fecha_cambio'];						
            $this->db->insert('t_cotizaciones', $d);			
			$id_cotizacion = $this->db->insert_id();	
			$this->db->query("update t_cotizaciones set folio = '".App::folio('CT',$id_cotizacion)."' where id_cotizacion =".$id_cotizacion);		
        }else{
        	$id_cotizacion = $d['id_cotizacion'];
			unset($d['id_cotizacion']);
            $this->db->where('id_cotizacion', $id_cotizacion);			
            $this->db->update('t_cotizaciones', $d);            
            $this->db->where('id_cotizacion', $id_cotizacion);			
         	$this->db->delete('r_cotizacion_productos');
        }  
        if(!empty($p)){        				
        	foreach ($p as $k => $v) {						
				$this->db->insert('r_cotizacion_productos', array('id_cotizacion' =>$id_cotizacion,'id_producto'=>$v['id_producto'],'cantidad'=>$v['cantidad'],'um'=>$v['um'],'precio'=>$v['precio'],'subtotal'=>$v['subtotal'],'descuento'=>$v['descuento'],'total'=>$v['total'],'id_usuario' =>$d['id_usuario_cambio']));			
			}
        }	
		return array('status'=>1,'id_cotizacion'=>$id_cotizacion);
	}	

	function borrarCotizacion($d){
		 $this->db->where('id_cotizacion', $d['id_cotizacion']);			
         $this->db->delete(array('t_cotizaciones','r_cotizacion_productos'));	
		 return array('status'=>1);
	}
}
