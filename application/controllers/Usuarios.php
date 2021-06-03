<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Usuarios extends CI_Controller {
	public function index()
	{
		$this->load->view('usuarios/usuarios');
	}
}
