<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	public function index()
	{
		$this->load->view('usuarios/usuarios');
	}
}
