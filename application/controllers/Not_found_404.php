<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Not_found_404 extends CI_Controller 
{
	public $s = null;
    public function __construct() {
    	
        parent::__construct(); 		
		$this -> db = $this -> load -> database('elecnet', TRUE);
		$this->load->library('app');	
		$this->load->model('clasificaciones_model','c');
    } 
    public function index() 
    { 
        $this->output->set_status_header('404');       
        $this->load->view('sitio/404.php',array('departamentos'=>$this->c->getClasificaciones()));				
    } 
} 
?> 