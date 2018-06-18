<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $_SESSION;
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		// echo "<pre>";
		// print_r($this->s);
		// echo "</pre>";
		// die();
	}	 
	 
	public function index()
	{
		$this->load->view('admin/dashboard');
	}
}
