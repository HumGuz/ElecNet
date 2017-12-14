<?php
defined('BASEPATH') OR exit('No direct almipt access allowed');
class Almacenes extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();
		if(!isset($this->s['usuario']))			
			redirect(base_url());		
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('almacenes_model','alm');
	}		
	function index(){
		$this->load->view('almacenes/almacenes');		
	}
	function almacenesTable(){
		$alm = $this->alm->getAlmacenes($this->input->post());
		echo $this->load->view('almacenes/almacenesTable',array('alm'=>$alm),TRUE);
	}
	
	function nuevoAlmacen(){
		$d = $this->input->post();
		$this->load->model('sucursales_model','scr');
		$attr = '';		  	
		if($d['id_almacen']){
			$alm = $this->alm->getAlmacenes($d);			
			foreach ($alm[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}	
		echo $this->load->view('almacenes/nuevoAlmacen',array('alm'=>$attr,'scrs'=>$this->scr->getSucursales()),TRUE);
	}
	
	function guardarAlmacen(){
		echo json_encode($this->alm->guardarAlmacen($this->input->post()));		
	}
		
	function borrarAlmacen(){
		echo json_encode($this->alm->borrarAlmacen($this->input->post()));		
	}
}
