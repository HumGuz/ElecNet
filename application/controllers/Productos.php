<?php
defined('BASEPATH') OR exit('No direct prdipt access allowed');
class Productos extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();
		if(!isset($this->s['usuario']))			
			redirect(base_url());		
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('productos_model','prd');
	}		
	function index(){
		$this->load->model('sucursales_model','scr');
		$this->load->view('productos/productosAlmacen',array('sucursales_select'=>$this->scr->getSucursalesSelect(),'almacenes_select'=>$this->scr->getAlmacenesPorSucursalSelect()));		
	}
	
	function productosAlmacen(){
		$this->load->model('almacenes_model','alm');
		$this->load->model('clasificaciones_model','cls');
		$alm = $this->alm->getAlmacenes($this->input->post());
		echo $this->load->view('productos/productosAlmacen',array('alm'=>$alm[0],'um'=>$this->prd->getUnidadesDeMedida(),'dep'=>$this->cls->getDepartamentos(),'cat'=>$this->cls->getCategorias()),TRUE);
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
		
	function borrarProducto(){
		echo json_encode($this->prd->borrarProducto($this->input->post()));		
	}
	
	function imagenes(){
		$d = $this->input->post();
		$prd = $this->prd->getProductos($d);
		$img = $this->alm->getImagenesProducto($d);
		echo $this->load->view('productos/imagenes',array('img'=>$img,'prd'=>$prd[0]),TRUE);
	}
}
