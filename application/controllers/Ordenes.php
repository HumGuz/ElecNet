<?php
defined('BASEPATH') OR exit('No direct cmpipt access allowed');
class Ordenes extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('ordenes_model','cmp');
	}		
	function index(){
		$this->load->model('proveedores_model','prv');
		$prv = $this->prv->getProveedores($this->input->post());		
		$this->load->view('ordenes/ordenes',array('prv'=>$prv));		
	}
	function ordenesTable(){
		$cmp = $this->cmp->getOrdenes($this->input->post());
		echo $this->load->view('ordenes/ordenesTable',array('cmp'=>$cmp),TRUE);
	}	
	function nuevaOrden(){
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_orden_compra']){
			$cmp = $this->cmp->getOrdenes($d);			
			foreach ($cmp[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}		
		echo $this->load->view('ordenes/nuevaOrden',array('cmp'=>$attr),TRUE);
	}	
	function guardarOrden(){
		echo json_encode($this->cmp->guardarOrden($this->input->post()));		
	}		
	function borrarOrden(){
		echo json_encode($this->cmp->borrarOrden($this->input->post()));		
	}
}
