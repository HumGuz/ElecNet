<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Login extends CI_Controller {		
	public function index()
	{
		$this->load->view('app/login');
	}	
	public function signin(){
		$d = $this->input->post();
		$this->load->model('login_model','l');		
		$r = $this->l->login($d['email'],$d['pass']);	
		echo json_encode($r);		
	}
}
