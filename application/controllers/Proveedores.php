<?php
defined('BASEPATH') OR exit('No direct prvipt access allowed');

class Proveedores extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('proveedores_model','prv');
	}		
	function index(){
		$this->load->view('proveedores/proveedores');		
	}
	function proveedoresTable(){
		$prv = $this->prv->getProveedores($this->input->post());
		echo $this->load->view('proveedores/proveedoresTable',array('prv'=>$prv),TRUE);
	}
	
	function nuevoProveedor(){
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_proveedor']){
			$prv = $this->prv->getProveedores($d);			
			foreach ($prv[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}		
		echo $this->load->view('proveedores/nuevoProveedor',array('prv'=>$attr),TRUE);
	}
	
	function guardarProveedor(){
		echo json_encode($this->prv->guardarProveedor($this->input->post()));		
	}
		
	function borrarProveedor(){
		echo json_encode($this->prv->borrarProveedor($this->input->post()));		
	}
}
