<?php
defined('BASEPATH') OR exit('No direct stipt access allowed');
class Sitio extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		
		// $this->s = $this -> session -> userdata();
		// if(!isset($this->s['usuario']))					
			// redirect(base_url());
		// $this -> db = $this -> load -> database($this->s["db"], TRUE);
		
		
		$this->load->model('sitio_model','st');
		$this->load->model('productos_model','p');
		$this->load->model('clasificaciones_model','c');
	}		
	
	
	function index(){
		$this->load->view('sitio/index',array('departamentos'=>$this->c->getClasificaciones()));
	}
	
	// function catalogo(){
		// $this->load->model('clasificaciones_model','cls');	
		// $this->load->view('sitio/catalogo',array('dep'=>$this->cls->getDepartamentos(),'cat'=>$this->cls->getCategorias()));		
	// }
// 	
	// function getProductosCatalogo(){
		// $st = $this->st->getProductosCatalogo($this->input->post());
		// echo $this->load->view('productos/productosTable',array('st'=>$st),TRUE);
	// }
	
	function sectionBestSelling(){
		
		
		
		
	}
	
	
	function getProductItem($d,$p=null){		
		if($p==null)
			$p = $this->p->getProductos($d);					
		return '<div class="product-item">
                    <div class="item-inner">
                      '.($p['precio_oferta']>0 ? '<div class="icon-sale-label sale-left">Oferta!!</div>':'').'
                      '.($p['precio_oferta']>0 ? '<div class="icon-new-label new-right">Nuevo</div>':'').'
                      <div class="product-thumbnail">
                        <div class="pr-img-area"><a title="'.$p['concepto'].'" href="'.base_url().app::poner_guion($p['concepto']).'/'.$p['id_producto'].'">
                          <figure> <img class="first-img" src="'.base_url().'/application/views/img/uploads/'.$p['imagen'].'" alt="'.$p['concepto'].'"> <img class="hover-img" src="'.base_url().'/application/views/img/uploads/'.$p['imagen'].'" alt="'.$p['concepto'].'"></figure>
                          </a> </div>
                        <div class="pr-info-area">
                          <div class="pr-button">
                            <div class="mt-button add_to_wishlist"> <a href="javascript:;"> <i class="fa fa-heart-o"></i> </a> </div>
                            <div class="mt-button add_to_compare"> <a href="javascript:;"> <i class="fa fa-link"></i> </a> </div>
                            <div class="mt-button quick-view"> <a href="javascript:;"> <i class="fa fa-search"></i> </a> </div>
                          </div>
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="'.$p['concepto'].'" href="'.base_url().app::poner_guion($p['concepto']).'/'.$p['id_producto'].'">'.$p['concepto'].'</a> </div>
                          <div class="item-content">
                            '.$this->getValuation($p).'
                            <div class="item-price">
                              <div class="price-box">                              
                              	'.($p['precio_oferta']>0? '
                              	 	<p class="special-price"> <span class="price-label">Precio Especial:</span> <span class="price"> $'.number_format($p['precio_oferta'],2).' </span> </p>
                                	<p class="old-price"> <span class="price-label">Precio Regular:</span> <span class="price"> $'.number_format($p['precio_venta'],2).' </span> </p>                              	
                              	':'
                              		<span class="regular-price"> <span class="price">$'.number_format($p['precio_venta'],2).'</span> </span>                              	
                              	').'
                              </div>							  
                            </div>
                            <div class="pro-action">
                              <button type="button" class="add-to-cart"><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
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
