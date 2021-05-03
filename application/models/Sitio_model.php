<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Sitio_model extends CI_Model {
	private $db = null;	
	private $id_sucursal = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();			
		$this -> db = $this -> load -> database('elecnet', TRUE);		
		$this->id_sucursal = $this->s['id_sucursal'];
	}
	
	
	function getProducto($d= null){		
		
		if($d['id_producto'])		
			$c .= ' and p.id_producto = '.$d['id_producto'];
		if($d['id_departamento'])		
			$c .= ' and p.id_departamento = '.$d['id_departamento'];	
		if($d['id_categoria_padre'])		
			$c .= ' and p.id_categoria_padre = '.$d['id_categoria_padre'];	
		if($d['id_categoria'])		
			$c .= ' and p.id_categoria = '.$d['id_categoria'];
		
		
		
			
		$s = "select 
									p.id_producto,p.clave,p.concepto,p.marca,p.modelo,p.descripcion,p.colores,p.dimensiones,p.peso,
									round(p.valuacion) as valuacion,p.visible,p.stock,p.nuevo,p.precio_oferta,p.precio_venta,
									p.id_departamento, d.clave as dep,d.nombre as departamento,
									p.id_categoria_padre, cp. clave as cat,cp.nombre as categoria,
									p.id_categoria, c.clave as subcat,c.nombre as subcategoria															 	
									from 
									t_productos p									
									left join t_departamentos d on d.id_departamento = p.id_departamento
									left join t_categorias cp on cp.id_categoria = p.id_categoria_padre
									left join t_categorias c on c.id_categoria = p.id_categoria
									where 1=1 ".$c;
		
		$q = $this -> db -> query($s);		
	$p = $q->row_array();	
			$q = $this -> db -> query("select imagen from r_producto_imagen i where i.id_producto = ".$p['id_producto']." order by portada desc"); 
	$p['imagenes'] = $q->result_array();
	
		return 	$p;
		
		
	}
	
	function getProductList($d=null){
		$c = '';
		if($d['special_offers'])
			$c .= " and p.precio_oferta <> 0 ";
		
		if($d['best_rated'])
			$c .= " and p.valuacion <> 0  order by valuacion desc	";
		
		if($d['new_products'])
			$c .= " and p.nuevo = 1  ";
			
		if($d['id_departamento'])
			$c .= " and p.id_departamento = ".$d['id_departamento'];		
		
		if($d['id_categoria_padre'])
			$c .= " and p.id_categoria_padre = ".$d['id_categoria_padre'];
		
		if($d['id_categoria'])
			$c .= " and p.id_categoria = ".$d['id_categoria'];
		
		if($d['best_selling'])
			$c .= " order by p.salidas desc  ";
		
		if($d['related'])					
			$c .= " limit 8";	
		elseif($d['limit'])
			$c .= " limit ".$d['limit'];		
		else
			$c .= " limit 6";		
		
		
		$q = $this -> db -> query("
			select p.id_producto,p.id_departamento,p.salidas,p.concepto,p.valuacion,
										   p.precio_venta,p.precio_oferta,p.nuevo , 
										   ( select imagen from r_producto_imagen i where i.id_producto = p.id_producto order by portada desc limit 1 ) as imagen
										   from t_productos p
										   where  p.visible = 1  ".$c);	
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
				$deps[$k]['top_six'] =	$this->getProductList(array('best_selling'=>1,'id_departamento'=>$d['id_departamento']));
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
		return $v;
	}
	
	
	function paginar($page,$cat,$base_url,$perPage=18){								
				$condition = '';				
				//paginacion con categorias
				//$route['categoria/(:any)/(:num)/p/(:num)'] = 'sitio/categoria/$2/$3';
				//$route['categoria/lista/(:any)/(:num)/p/(:num)'] = 'sitio/categoria/$2/$3';								
				// $base_url =  base_url().'categoria/'.app::uri($cat['categoria']).'/'.$cat['id_categoria'].'/p/'; 
				if($cat)
					$c .= ' and id_categoria = '.$cat;					
				$sql = "select count(a.id_producto) as todos from t_productos a where 1=1 ".$c;
				$res = $this->db->query($sql);		
				$result =  $res->row_array();				
				$todos = $result['todos'];		
				$paginator = '';									
				if( $todos > 5 ){
										
					$paginas = ceil($todos / $perPage);	
					$paginasFaltantes = $paginas - $page;						
					$paginator = '';
					if($paginas>=2){						
						$paginator .= '<div class="pagination-area"><ul>';
						
						if($page>2 && $paginas>=6)
							$paginator .= '<li><a href="'.$base_url_clean.'" >« 1 ...</a></li>';
											
						if($page>1 && $paginas>=6)
							$paginator .= '  <li><a href="'.$base_url.($page-1).'"><i class="fa fa-angle-left"></i></a></li>';
						
						
						$page =  $page==0 ? 1 : $page ;	
						$pageNow = $page;
						if($paginasFaltantes>=6){
							$paginator .= '<li><a href="javascript:;" class="active" >'.$page.'</a></li>';	
							$page ++;
							for ($i=0; ($i < 4 && $i < $paginasFaltantes ); $i++) { 									
								$paginator .= '<li><a href="'.$base_url.($page).'" >'.$page.'</a></li>';									
								$page ++;
							}								
							if(($page - $paginasFaltantes)>1)
								$paginator .= '<li><a href="'.$base_url.($paginas).'">... '.$paginas.' »</a></li>';
						
						}else{																		
							$page = ( $paginas - 5 > 0 ? $paginas - 5 : 1 );					
							for($i= $paginas; $i>($paginas - 5 ) && $page <= $paginas;$i--){
								$paginator .= '<li><a href="'.$base_url.($page).'" class="'.($pageNow == $page?'active':'').'">'.$page.'</a></li>';									
								$page ++;
							}
							if(($i==($paginas - 5 )))
								$paginator .= '<li><a href="'.$base_url.($paginas).'" class="'.($pageNow == $page?'active':'').' ">... '.$paginas.' »</a></li>';
						}						
						
						if($page!=$paginas && $paginas>=6)	
							$paginator .= '  <li><a href="'.$base_url.($page+1).'"><i class="fa fa-angle-right"></i></a></li>';
							
						$paginator .="</ul></div>";
					}
				}				
				return $paginator;
		}
}
