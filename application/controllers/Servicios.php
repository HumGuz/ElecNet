<?php
defined('BASEPATH') OR exit('No direct srvipt access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Servicios extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();
		if(!isset($this->s['usuario']))			
			redirect(base_url());		
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('servicios_model','srv');
		$this->load->library('app');
	}
			
	function index(){
		$this->load->model('sucursales_model','scr');
		$this->load->model('clasificaciones_model','cls');
		$this->load->view('servicios/servicios',array('sucursales_select'=>$this->scr->getSucursalesSelect(),'dep'=>$this->cls->getDepartamentos(),'cat'=>$this->cls->getCategorias()));		
	}
	
	function claveUnica(){
		echo $this->srv->claveUnica($this->input->post());
	}
	
	function serviciosTable(){
		$srv = $this->srv->getServicios($this->input->post());
		echo $this->load->view('servicios/serviciosTable',array('srv'=>$srv),TRUE);
	}
	
	function getPrecioXServicio(){
		echo json_encode($this->srv->getPrecioXServicio($this->input->post()));		
	}
	
	function nuevoServicio(){
		$d = $this->input->post();
		$this->load->model('clasificaciones_model','cls');
		$attr = '';		  	
		if($d['id_servicio']){
			$srv = $this->srv->getServicios($d);			
			foreach ($srv[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}			
		echo $this->load->view('servicios/nuevoServicio',array('srv'=>$attr,'dep'=>$this->cls->getDepartamentos(),'cat'=>$this->cls->getCategorias()),TRUE);
	}
	
	function guardarServicio(){
		echo json_encode($this->srv->guardarServicio($this->input->post()));		
	}
	
	function borrarServicio(){
		echo json_encode($this->srv->borrarServicio($this->input->post()));		
	}
	
	
	
}
