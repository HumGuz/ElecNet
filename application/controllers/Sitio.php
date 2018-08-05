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
		$this -> db = $this -> load -> database('elecnet', TRUE);
		
		$this->load->library('app');
		$this->load->model('sitio_model','st');
		$this->load->model('productos_model','p');
		$this->load->model('clasificaciones_model','c');
	}		
	
	
	function index(){
		$this->load->view('sitio/index',
			array(
				'departamentos'=>$this->c->getClasificaciones(),
				'best_selling'=>$this->st->getBestSelling()
			)
		);
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
	
	
	function getWrapPopup($categorias){
				
				$h = '<div class="wrap-popup"><div class="popup"><div class="row">';
				$c = ceil(count($categorias) / 2);
				$x = 0;				
				$h .= '<div class="col-md-4 col-sm-6">';
				foreach ($categorias as $k => $cat) {
					if($x < $c){
						$h .= ($x > 0 && $x<($c - 1 ))?'<br>':'';							
						$h .= $this->getCategoriaNavList($cat);						
						unset($categorias[$k]);
						$x++;
					}					
				}
				$h .= '</div>';
		
				if(!empty($categorias)){
					$x = 0;				
					$h .= '<div class="col-md-4 col-sm-6">';
					foreach ($categorias as $k => $cat) {
						if($x < $c){
							$h .= ($x > 0 && $x<($c - 1 ))?'<br>':'';							
							$h .= $this->getCategoriaNavList($cat);						
							unset($categorias[$k]);
							$x++;
						}					
					}
					$h .= '</div>';
				}
			
				$h .= '
				<div class="col-md-4 has-sep hidden-sm">
                          <div class="custom-menu-right">
                            <div class="box-banner media">
                              <div class="add-desc">
                                <h3>Computer <br>
                                  Services </h3>
                                <div class="price-sale">2016</div>
                                <a href="#">Shop Now</a> </div>
                              <div class="add-right"><a href="#"><img src="'.base_url().'application/views/img/menu-banner-img2.jpg" alt="fashion"></a></div>
                            </div>
                            <div class="box-banner media">
                              <div class="add-desc">
                                <h3>Save up to</h3>
                                <div class="price-sale">75 <sup>%</sup><sub>off</sub></div>
                                <a href="#">Shopping Now</a> </div>
                              <div class="add-right"><a href="#"><img src="'.base_url().'application/views/img/menu-banner-img3.jpg" alt=" html store"></a></div>
                            </div>
                          </div>
                        </div>
                         </div>
                    </div>
                  </div>
                        ';
			
			
		
	}
	
	
	function getCategoriaNavList($c){							
		$h = '<h3>'.$c['categoria'].'</h3>';
		if(!empty($c['subcategorias'])){
			$h .= '<ul class="nav">';	
			foreach ($c['subcategorias'] as $ke => $sc) {
				$h .= '<li><a href="shop_grid.html">'.$sc['subcategoria'].'</a></li>';	
			}
			$h .= '</ul>';		
		}
		return $h;
	}
	
	
	
}
