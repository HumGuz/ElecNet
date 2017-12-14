<?php
defined('BASEPATH') OR exit('No direct cmpipt access allowed');
class Compras extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('compras_model','cmp');
	}		
	function index(){
		$this->load->view('compras/compras');		
	}
	function comprasTable(){
		$cmp = $this->cmp->getCompras($this->input->post());
		echo $this->load->view('compras/comprasTable',array('cmp'=>$cmp),TRUE);
	}	
	function nuevaCompra(){
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_compra']){
			$cmp = $this->cmp->getCompras($d);			
			foreach ($cmp[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}		
		echo $this->load->view('compras/nuevaCompra',array('cmp'=>$attr),TRUE);
	}	
	function guardarCompra(){
		echo json_encode($this->cmp->guardarCompra($this->input->post()));		
	}		
	function borrarCompra(){
		echo json_encode($this->cmp->borrarCompra($this->input->post()));		
	}
}
