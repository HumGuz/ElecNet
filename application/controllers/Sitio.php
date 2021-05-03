<?php
defined('BASEPATH') OR exit('No direct stipt access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Sitio extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
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
				'best_selling'=>$this->st->getBestSelling(),
				'special_offers'=>$this->st->getProductList(array('special_offers'=>1)),
				'best_rated'=>$this->st->getProductList(array('best_rated'=>1)),
				'new_products'=>$this->st->getProductList(array('new_products'=>1)),
				'star_products'=>$this->st->getProductList(array('best_selling'=>1,'limit'=>3))
			)
		);
	}
	
	function producto($id_producto){
		$d = $this->input->post();
		$prd = $this->st->getProducto(array('id_producto'=>$id_producto));
		$prd['valuation'] =$this->st->getValuation($prd);
		$this->load->view('sitio/producto',
			array(
				'prd'=>$prd,
				'departamentos'=>$this->c->getClasificaciones(),				
				'related_products'=>$this->st->getProductList(array('related'=>1,'id_categoria_padre'=>$prd['id_categoria_padre'])),
				'upsell_products'=>$this->st->getProductList(array('upsell'=>1,'id_categoria'=>$prd['id_categoria'])),
				'star_products'=>$this->st->getProductList(array('best_selling'=>1,'limit'=>3))
			)
		);
	}
		
}
