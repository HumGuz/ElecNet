<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();
		if(!isset($this->s['__ci_last_regenerate']))
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
	}	 
	 
	public function index()
	{
		$this->load->view('admin/dashboard');
	}
}
