<?php
defined('BASEPATH') OR exit('No direct stipt access allowed');
class Sitio extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();
		if(!isset($this->s['usuario']))			
			redirect(base_url());		
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('sitio_model','st');
	}		
	
	function catalogo(){
		$this->load->model('clasificaciones_model','cls');	
		$this->load->view('sitio/catalogo',array('dep'=>$this->cls->getDepartamentos(),'cat'=>$this->cls->getCategorias()));		
	}
	
	function getProductosCatalogo(){
		$st = $this->st->getProductosCatalogo($this->input->post());
		echo $this->load->view('productos/productosTable',array('st'=>$st),TRUE);
	}
}
