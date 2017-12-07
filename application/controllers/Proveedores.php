<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {
	public function index()
	{
		$this->load->view('proveedores/proveedores');
	}
}
