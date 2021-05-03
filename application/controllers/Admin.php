<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Admin extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this->session->userdata();
		 if(!isset($this->s['usuario']))			
			 redirect(base_url());	
	}	  
	 
	public function index() {		
		$this->load->model('sucursales_model','scr');		
		$this->load->view('admin/dashboard',array('sucursales'=>$this->scr->getSucursalesSelect()));
	}
	
	public function setSucursal() {		
		$d = $this->input->post();
		$this->session->set_userdata('id_sucursal',$d['id_sucursal']);
		echo json_encode(array('status'=>1));
	}
}
