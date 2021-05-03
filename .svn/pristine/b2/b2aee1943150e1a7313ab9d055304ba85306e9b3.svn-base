<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Sucursales extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
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
		if($d['id_sucursal']){
			$scr = $this->scr->getSucursales($d);			
			$attr = $this->app->dataTag($scr[0]);
		}		
		echo $this->load->view('sucursales/nuevaSucursal',array('dt'=>$attr),TRUE);
	}
	
	function guardarSucursal(){
		echo json_encode($this->scr->guardarSucursal($this->input->post()));		
	}
		
	function borrarSucursal(){
		echo json_encode($this->scr->borrarSucursal($this->input->post()));		
	}
}
