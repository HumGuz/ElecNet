<?php
defined('BASEPATH') OR exit('No direct objipt access allowed');
class Clasificaciones extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('clasificaciones_model','obj');
	}
	
	function index(){
		$this->load->view('clasificaciones/clasificaciones');		
	}	
	
	function elementsList(){
		$d = $this->input->post();
		if($d['dump']=='depList'){
			$obj = $this->obj->getDepartamentos($d);			
		}elseif($d['id_departamento']){
			$obj = $this->obj->getCategorias($d);			
		}
		echo $this->load->view('clasificaciones/clasificacionesList',array('obj'=>$obj,'d'=>$d),TRUE);
	}
	
	function nuevaClasificacion(){
		$d = $this->input->post();
		$attr = '';			
		$t = array('','Nuevo Departamento','Nueva Categoría',"Nueva Subcategoría");		
		$title = $t[$d['op']];
		if($d['id_departamento'] && $d['op']==1){			
			$obj = $this->obj->getDepartamentos($d);			
			foreach ($obj[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}
		if($d['id_categoria'] && ($d['op']==2 || $d['op']==3)){
			$obj = $this->obj->getCategorias($d);
			foreach ($obj[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}			
		if($d['op']==2 || $d['op']==3)
			$dep = $this->obj->getDepartamentos();		
		if($d['op']==3)
			$cat = $this->obj->getCategorias();
		echo $this->load->view('clasificaciones/nuevaClasificacion',array('d'=>$d,'obj'=>$attr,'title'=>$title,'dep'=>$dep,'cat'=>$cat),TRUE);
	}
	
	function guardarClasificacion(){
		echo json_encode($this->obj->guardarClasificacion($this->input->post()));		
	}
		
	function borrarClasificacion(){
		echo json_encode($this->obj->borrarClasificacion($this->input->post()));		
	}	
}
