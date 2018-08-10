<?php
defined('BASEPATH') OR exit('No direct stipt access allowed');
class Sitio extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
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
				'new_products'=>$this->st->getProductList(array('new_products'=>1))
			)
		);
	}
		
}
