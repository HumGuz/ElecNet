<?php
defined('BASEPATH') OR exit('No direct vntipt access allowed');
class Ventas extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('ventas_model','vnt');
	}
			
	function index(){		
		$this->load->model('clientes_model','clt');
		$this->load->model('sucursales_model','scr');
		$clt = $this->clt->getProveedores($this->input->post());				
		$this->load->view('ventas/ventas',array('clt'=>$clt,'sucursales_select'=>$this->scr->getSucursalesSelect()));				
	}
	
	function ventasTable(){
		$vnt = $this->vnt->getVentas($this->input->post());
		echo $this->load->view('ventas/ventasTable',array('vnt'=>$vnt),TRUE);
	}	
	function getFolioOrden(){
		$d = $this->input->post();
		echo json_encode($this->vnt->getFolioOrden($d));
	}	
	function getProductos(){
		$this->load->model('ordenes_model','ord');
		echo json_encode($this->ord->getProductos($this->input->post()));		
	}
	function facturaUnica(){
		echo $this->vnt->facturaUnica($this->input->post());
	}
	function nuevaVenta(){
		$this->load->model('clientes_model','clt');
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_venta']){
			$vnt = $this->vnt->getVentas($d);			
			foreach ($vnt[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
			$prd = $this->vnt->getProductosXVenta($d);
		}elseif($d['folio']){			
			$this->load->model('ordenes_model','ord');
			$ord = $this->ord->getOrdenes($d);
			$poc = $this->vnt->getProductosXOrden(array('id_orden_venta'=>$ord[0]['id_orden_venta']));			
		}			
		echo $this->load->view('ventas/nuevaVenta',array('vnt'=>$attr,'poc'=>$poc,'prd'=>$prd,'ord'=>$ord[0],'clt'=>$this->clt->getProveedores()),TRUE);
	}	
	function guardarVenta(){
		echo json_encode($this->vnt->guardarVenta($this->input->post()));		
	}		
	function borrarVenta(){
		echo json_encode($this->vnt->borrarVenta($this->input->post()));		
	}
	
}
