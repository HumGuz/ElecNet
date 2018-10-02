<?php
defined('BASEPATH') OR exit('No direct prdipt access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Productos extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();
		if(!isset($this->s['usuario']))			
			redirect(base_url());		
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('productos_model','prd');
		$this->load->library('app');
	}
	function test(){
		
		$char = "INSTALACIÓN, CONFIGURACIÓN Y CAPACITACIÓN DE CONTROL DE ACCESO ";
		
		echo "<pre>";
		print_r($char);
		echo "<br>";
		$char2 = $this->prd->replace($char);
		print_r($char2);
		echo "<br>";
		print_r(strtolower($char2));
		echo "</pre>";
	}
	
			
	function index(){
		$this->load->model('sucursales_model','scr');
		$this->load->model('clasificaciones_model','cls');		
		$this->load->view('productos/productosAlmacen',array('sucursales_select'=>$this->scr->getSucursalesSelect(),'almacenes_select'=>$this->scr->getAlmacenesPorSucursalSelect(),'um'=>$this->prd->getUnidadesDeMedida(),'dep'=>$this->cls->getDepartamentos(),'cat'=>$this->cls->getCategorias()));		
	}
		
	function claveUnica(){
		echo $this->prd->claveUnica($this->input->post());
	}
	
	function productosTable(){
		$prd = $this->prd->getProductos($this->input->post());
		echo $this->load->view('productos/productosTable',array('prd'=>$prd),TRUE);
	}
	
	function getProductosXProveedor(){
		echo json_encode($this->prd->getProductosXProveedor($this->input->post()));		
	}
	
	function getPrecioXProducto(){
		echo json_encode($this->prd->getPrecioXProducto($this->input->post()));		
	}
	
	function getPrecioXProductoServicio(){
		echo json_encode($this->prd->getPrecioXProductoServicio($this->input->post()));		
	}
	
	function nuevoProducto(){
		$d = $this->input->post();
		$this->load->model('clasificaciones_model','cls');
		$attr = '';		  	
		if($d['id_producto']){
			$prd = $this->prd->getProductos($d);			
			foreach ($prd[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
		}			
		echo $this->load->view('productos/nuevoProducto',array('prd'=>$attr,'um'=>$this->prd->getUnidadesDeMedida(),'dep'=>$this->cls->getDepartamentos(),'cat'=>$this->cls->getCategorias()),TRUE);
	}
	
	function guardarProducto(){
		echo json_encode($this->prd->guardarProducto($this->input->post()));		
	}
	function setOpciones(){
		echo json_encode($this->prd->setOpciones($this->input->post()));		
	}		
	function borrarProducto(){
		echo json_encode($this->prd->borrarProducto($this->input->post()));		
	}
	function borrarImagen(){
		echo json_encode($this->prd->borrarImagen($this->input->post()));		
	}
	function hacerPortada(){
		echo json_encode($this->prd->hacerPortada($this->input->post()));		
	}
	
	function detalles(){
		$d = $this->input->post();
		$prd = $this->prd->getProductos($d);
		$img = $this->prd->getImagenesProducto($d);
		echo $this->load->view('productos/detalles',array('img'=>$img,'prd'=>$prd[0]),TRUE);
	}
	
	function guardarImagen(){
		$d = $this->input->post();
		$d = App::saveUriImg($d);
		if($d['status']==1){
			$d =  $this->prd->guardarImagen($d);
		}
		echo json_encode($d);
	}	
}