<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct cmpipt access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Compras extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('compras_model','cmp');
	}
			
	function index(){		
		$this->load->model('proveedores_model','prv');
		$prv = $this->prv->getProveedores($this->input->post());				
		echo $this->load->view('compras/compras',array('prv'=>$prv),true);				
	}
	
	function comprasTable(){
		$cmp = $this->cmp->getCompras($this->input->post());
		echo $this->load->view('compras/comprasTable',array('cmp'=>$cmp),TRUE);
	}	
	function getFolioOrden(){
		$d = $this->input->post();
		echo json_encode($this->cmp->getFolioOrden($d));
	}	
	function getProductos(){
		$this->load->model('ordenes_model','ord');
		echo json_encode($this->ord->getProductos($this->input->post()));		
	}
	function facturaUnica(){
		echo $this->cmp->facturaUnica($this->input->post());
	}
	function nuevaCompra(){
		$this->load->model('proveedores_model','prv');
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_compra']){
			$cmp = $this->cmp->getCompras($d);			
			foreach ($cmp[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
			$prd = $this->cmp->getProductosXCompra($d);
		}elseif($d['folio']){			
			$this->load->model('ordenes_model','ord');
			$ord = $this->ord->getOrdenes($d);
			$poc = $this->cmp->getProductosXOrden(array('id_orden_compra'=>$ord[0]['id_orden_compra']));			
		}			
		echo $this->load->view('compras/nuevaCompra',array('cmp'=>$attr,'poc'=>$poc,'prd'=>$prd,'ord'=>$ord[0],'prv'=>$this->prv->getProveedores()),TRUE);
	}	
	function guardarCompra(){
		echo json_encode($this->cmp->guardarCompra($this->input->post()));		
	}		
	function borrarCompra(){
		echo json_encode($this->cmp->borrarCompra($this->input->post()));		
	}
}
=======
<?php
defined('BASEPATH') OR exit('No direct cmpipt access allowed');
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
class Compras extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('compras_model','cmp');
	}
			
	function index(){		
		$this->load->model('proveedores_model','prv');
		$prv = $this->prv->getProveedores($this->input->post());				
		echo $this->load->view('compras/compras',array('prv'=>$prv),true);				
	}
	
	function comprasTable(){
		$cmp = $this->cmp->getCompras($this->input->post());
		echo $this->load->view('compras/comprasTable',array('cmp'=>$cmp),TRUE);
	}	
	function getFolioOrden(){
		$d = $this->input->post();
		echo json_encode($this->cmp->getFolioOrden($d));
	}	
	function getProductos(){
		$this->load->model('ordenes_model','ord');
		echo json_encode($this->ord->getProductos($this->input->post()));		
	}
	function facturaUnica(){
		echo $this->cmp->facturaUnica($this->input->post());
	}
	function nuevaCompra(){
		$this->load->model('proveedores_model','prv');
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_compra']){
			$cmp = $this->cmp->getCompras($d);			
			foreach ($cmp[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
			$prd = $this->cmp->getProductosXCompra($d);
		}elseif($d['folio']){			
			$this->load->model('ordenes_model','ord');
			$ord = $this->ord->getOrdenes($d);
			$poc = $this->cmp->getProductosXOrden(array('id_orden_compra'=>$ord[0]['id_orden_compra']));			
		}			
		echo $this->load->view('compras/nuevaCompra',array('cmp'=>$attr,'poc'=>$poc,'prd'=>$prd,'ord'=>$ord[0],'prv'=>$this->prv->getProveedores()),TRUE);
	}	
	function guardarCompra(){
		echo json_encode($this->cmp->guardarCompra($this->input->post()));		
	}		
	function borrarCompra(){
		echo json_encode($this->cmp->borrarCompra($this->input->post()));		
	}
}
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
