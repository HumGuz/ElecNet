<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Sitio_model extends CI_Model {
	private $db = null;	
	private $id_sucursal = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database('elecnet', TRUE);		
		$this->id_sucursal = $this->s['usuario']['id_sucursal'];
	}
	
	function getSpecialOffers($d=null){
		$q = $this -> db -> query("
			select p.id_producto,p.id_departamento,p.salidas,p.concepto,p.valuacion,
										   p.precio_venta,p.precio_oferta,p.nuevo , 
										   ( select imagen from r_producto_imagen i where i.id_producto = p.id_producto order by portada desc limit 1 ) as imagen
										   from t_productos p
										   where p.precio_oferta <> 0
										   
										   limit 6
		");	
		return $q->result_array();
	}
	
	function getBestSelling($d=null){
					
		$q = $this -> db -> query("
			select * from (
				select p.id_departamento,d.nombre as departamento,sum(p.salidas) as salidas from t_productos p	
				inner join t_departamentos d on d.id_departamento = p.id_departamento
				where p.visible = 1
				group by p.id_departamento
			) a 			
			 order by salidas desc
			limit 4
		");	
		$deps = $q->result_array();
		if(!empty($deps)){
			foreach ($deps as $k => $d) {							
				$q = $this -> db -> query("select p.id_producto,p.id_departamento,p.salidas,p.concepto,p.valuacion,
										   p.precio_venta,p.precio_oferta,p.nuevo , 
										   ( select imagen from r_producto_imagen i where i.id_producto = p.id_producto order by portada desc limit 1 ) as imagen
										   from t_productos p 
										   where p.visible = 1 and p.id_departamento = ".$d['id_departamento']."
										   order by p.salidas desc
										   limit 6");	
				$deps[$k]['top_six'] =	$q->result_array();
			}
		}
		return $deps;		
		
	}

	function getValuation($p){		
		$v = '<div class="rating">';
		$m = 5;										
		for ($i=0; $i < $p['valuacion']; $i++) { 
			$v.= '<i class="fa fa-star"></i> ';
			$m--;
		}
		for ($j=0; $j < $m; $j++) { 
			$v.= '<i class="fa fa-star-o"></i> ';
		}	
		$v .= '</div>';
	}
	
}
