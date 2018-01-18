<?php
defined('BASEPATH') OR exit('No direct cltipt access allowed');
class Clientes extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('clientes_model','clt');
	}	
		
	function index(){
		$this->load->view('clientes/clientes');		
	}
	
	function clientesTable(){
		$clt = $this->clt->getClientes($this->input->post());
		echo $this->load->view('clientes/clientesTable',array('clt'=>$clt),TRUE);
	}
	
	function nuevoCliente(){
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_cliente']){
			$clt = $this->clt->getClientes($d);			
			foreach ($clt[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}		
		echo $this->load->view('clientes/nuevoCliente',array('clt'=>$attr),TRUE);
	}
	
	function guardarCliente(){
		echo json_encode($this->clt->guardarCliente($this->input->post()));		
	}
		
	function borrarCliente(){
		echo json_encode($this->clt->borrarCliente($this->input->post()));		
	}
}
