<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
	public function index()
	{
		$this->load->view('ventas/ventas');
	}
}
