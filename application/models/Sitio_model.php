<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Sitio_model extends CI_Model {
	private $db = null;	
	private $id_sucursal = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database($this->s["db"], TRUE);		
		$this->id_sucursal = $this->s['usuario']['id_sucursal'];
	}
			
	function getSitioXProveedor($d){			
			
		
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
	
}
