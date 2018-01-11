<?php
defined('BASEPATH') OR exit('No direct cmpipt access allowed');
class Ordenes extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('ordenes_model','cmp');
		$this->load->library('app');
	}		
	function index(){
		$this->load->model('proveedores_model','prv');
		$this->load->model('sucursales_model','scr');
		$prv = $this->prv->getProveedores($this->input->post());		
		$this->load->view('ordenes/ordenes',array('prv'=>$prv,'sucursales_select'=>$this->scr->getSucursalesSelect()));		
	}
	function ordenesTable(){
		$cmp = $this->cmp->getOrdenes($this->input->post());
		echo $this->load->view('ordenes/ordenesTable',array('cmp'=>$cmp),TRUE);
	}	
	function nuevaOrden(){		
		$this->load->model('proveedores_model','prv');
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_orden_compra']){
			$cmp = $this->cmp->getOrdenes($d);			
			foreach ($cmp[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
			$prd = $this->cmp->getProductosXOrden($d);
		}		
		echo $this->load->view('ordenes/nuevaOrden',array('obj'=>$attr,'prd'=>$prd,'prv'=>$this->prv->getProveedores()),TRUE);
	}	
	
	function guardarOrden(){
		echo json_encode($this->cmp->guardarOrden($this->input->post()));		
	}		
	function borrarOrden(){
		echo json_encode($this->cmp->borrarOrden($this->input->post()));		
	}
	
	function pdf(){
		ini_set("memory_limit", "1024M");
		ini_set('max_execution_time', 12000);
		ini_set('max_input_time ', 0);
		set_time_limit(0);
		$d = $this->input->post();
		$cmp = $this->cmp->getOrdenes($d);	
		$prd = $this->cmp->getProductosXOrden($d);
		if(!empty($prd)){
			$this->load->library('pdf');
			$pdf = $this->pdf->load('utf-8',array(216,279.4),0,'"Helvetica Neue",Helvetica,Arial,sans-serif',10,10,7,10,10,4,"P");
							
				$html = '
				<html>
					<head>
						<style>
							@page {
								size: auto;
								header: html_myHeader;
								footer: html_myFooter;				
								/*background: #ffffff url("./application/views/img/pdfP.jpg") no-repeat left top;*/
							}
						</style>
					</head>
					<body>
						<htmlpageheader name="myHeader" style="display:none;">						
								<h2 align="left" style="margin:0;"><b>Orden de compra</b></h2>
								<div align="left">
									Folio: <b>'.$cmp[0]['folio'].'</b> <br>
									Proveedor: <b>'.$cmp[0]['nombre_proveedor'].'</b>									
								</div>							
						</htmlpageheader>

						<htmlpagefooter name="myFooter" style="display:none;">				
							<div align="right" style="color:white;">
								<span style="font-size:12px;">'.App::dateFormat(date('Y-m-d')).'</span><br>
								<span style="font-size:16px;">Página <b>{PAGENO}</b> / {nbpg}</span>
							</div>	
						</htmlpagefooter>										
				
				<table  cellpadding="5" cellspacing="0" style="font-size:12px;width:100%">
					<thead>					
						<tr style="background-color:#333333;">						
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;border-left:1px solid #333333;color:#FFFFFF"><b>#</b></td>
							<td style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF"><b>Clave</b></td>
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF" ><b>Descripción</b></td>	
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF" ><b>Cantidad</b></td>
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF" ><b>Unidad</b></td>	
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF" ><b>Precio de Lista</b></td>
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF" ><b>Descuento</b></td>						
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF" ><b>Precio Unitario</b></td>								
							<td  style="border-top:1px solid #333333;border-right:1px solid #333333;color:#FFFFFF" ><b>Importe</b></td>								
						</tr>
					</thead>						
				    <tbody>
			';			
			$x = 1;			
			foreach ($prd as $k => $u) {								
				$html .= '				
						<tr>						
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;border-left:1px solid #d3d3d3;'.$border.'">
								'.$x.'
							</td>
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								'.$u['clave'].'
							</td>	
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								'.$u['concepto'].'
							</td>
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								'.$u['cantidad'].'
							</td>
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								'.$u['um'].'
							</td>	
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								$ '.number_format($u['precio'],2).'
							</td>	
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								'.number_format($u['descuento'],2).' %
							</td>								
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								$ '.number_format( $u['precio']   - ( $u['precio'] * $u['descuento'] / 100  ),2).'
							</td>								
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;'.$border.'">
								$ '.number_format( $u['total'],2).'
							</td>	
																				
						</tr>
				';
				$x++;
			}
			$html .= '</tbody></table></body></html>';			
			$pdf->WriteHTML($html); 			
			$pdf->Output('./application/files/'.$folio.'.pdf', 'F');
			echo json_encode(array('status'=>1));
		}else{
			echo json_encode(array('status'=>2));
		}		
	}

	function download(){			
		$d = $this->input->get();
		$f =$d['folio'];			
		App::downloadFile('./application/files/'.$f.'.'.$d['type'],$f.'.'.$d['type']);
	}	
}
