<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Admin extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();		
		$this->s = $this->session->userdata();
		 // if(!isset($this->s['usuario']))			
			// redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
	}	 
	 
	function index() {
		$this->load->view('admin/dashboard');
	}
}
