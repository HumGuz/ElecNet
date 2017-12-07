<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales extends CI_Controller {
	private $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('sucursales_model','scr');
	}		
	function index(){
		$this->load->view('sucursales/sucursales');		
	}
	function sucursalesTable(){
		$scr = $this->scr->getSucursales($this->input->post());
		echo $this->load->view('sucursales/sucursalesTable',array('scr'=>$scr),TRUE);
	}
	
	function nuevaSucursal(){
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_sucursal']){
			$scr = $this->scr->getSucursales($d);			
			foreach ($scr[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}		
		echo $this->load->view('sucursales/nuevaSucursal',array('scr'=>$attr),TRUE);
	}
	
	function guardarSucursal(){
		echo json_encode($this->scr->guardarSucursal($this->input->post()));		
	}
		
	function borrarSucursal(){
		echo json_encode($this->scr->borrarSucursal($this->input->post()));		
	}
}
