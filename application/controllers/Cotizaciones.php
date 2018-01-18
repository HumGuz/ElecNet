<?php
defined('BASEPATH') OR exit('No direct cotipt access allowed');
class Cotizaciones extends CI_Controller {
	public $s = null;
	function __construct() {
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
		setlocale(LC_TIME, "es_MX.utf8");
		$this->s = $this -> session -> userdata();		
		if(!isset($this->s['usuario']))			
			redirect(base_url());	
		$this -> db = $this -> load -> database($this->s["db"], TRUE);
		$this->load->model('cotizaciones_model','cot');
		$this->load->library('letras');
	}
			
	function index(){		
		$this->load->model('clientes_model','clt');
		$this->load->model('sucursales_model','scr');
		$clt = $this->clt->getClientes($this->input->post());				
		$this->load->view('cotizaciones/cotizaciones',array('clt'=>$clt,'sucursales_select'=>$this->scr->getSucursalesSelect()));				
	}
	
	function cotizacionesTable(){
		$cot = $this->cot->getCotizaciones($this->input->post());
		echo $this->load->view('cotizaciones/cotizacionesTable',array('cot'=>$cot),TRUE);
	}
	
	function nuevaCotizacion(){
		$this->load->model('clientes_model','clt');
		$d = $this->input->post();
		$attr = '';		  	
		if($d['id_cotizacion']){
			$cot = $this->cot->getCotizaciones($d);			
			foreach ($cot[0] as $key => $v) {
				$attr .= 'data-'.$key.'="'.htmlspecialchars($v).'" ';
			}
			$prd = $this->cot->getProductosXCotizacion($d);
		}		
		echo $this->load->view('cotizaciones/nuevaCotizacion',array('cot'=>$attr,'prd'=>$prd,'clt'=>$this->clt->getClientes()),TRUE);
	}	
	function guardarCotizacion(){
		echo json_encode($this->cot->guardarCotizacion($this->input->post()));		
	}		
	function borrarCotizacion(){
		echo json_encode($this->cot->borrarCotizacion($this->input->post()));		
	}
	
	function pdf(){
		ini_set("memory_limit", "1024M");
		ini_set('max_execution_time', 12000);
		ini_set('max_input_time ', 0);
		set_time_limit(0);
		$d = $this->input->post();
		$cot = $this->cot->getCotizaciones($d);	
		$prd = $this->cot->getProductosXCotizacion($d);
		
		$l = new Letras();
		
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
								background: #ffffff url("./application/views/img/'.$d['membrete'].'.png") no-repeat left top;
							}
						</style>
					</head>
					<body>
						<htmlpageheader name="myHeader" style="display:none;">						
								<h2 align="center" style="margin-top:15;"><b>Cotización</b></h2>
								<div align="right">
									Fecha Vencimiento: '.App::dateFormat($cot[0]['fecha_vencimiento']).'<br>
									Numero de cotización: <b>'.$cot[0]['folio'].'</b> 																
								</div>
								<div align="left">									
									<b>Cliente:</b> '.$cot[0]['nombre_cliente'].'	
									'.( trim($cot[0]['observaciones']) != '' ? '<br><b>Observaciones:</b> '.trim($cot[0]['observaciones']) : '' ).'
								</div>							
						</htmlpageheader>

						<htmlpagefooter name="myFooter" style="display:none;">				
							<div align="right" style="color:white;">
								<span style="font-size:12px;">Fecha de creación: '.App::dateFormat(date('Y-m-d')).'</span><br>
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
							<td align="center" style="font-weight:bold;border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;border-left:1px solid #d3d3d3;">
								'.$x.'
							</td>
							<td style="font-weight:bold;border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								'.$u['clave'].'
							</td>	
							<td style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								'.$u['concepto'].'
							</td>
							<td align="right" style="font-weight:bold;border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								'.$u['cantidad'].'
							</td>
							<td align="center" style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								'.$u['um'].'
							</td>	
							<td align="right" style="font-weight:bold;border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								$ '.number_format($u['precio'],2).'
							</td>	
							<td align="right" style="border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								'.number_format($u['descuento'],2).' %
							</td>								
							<td align="right" style="font-weight:bold;border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								$ '.number_format( $u['precio']   - ( $u['precio'] * $u['descuento'] / 100  ),2).'
							</td>								
							<td align="right" style="font-weight:bold;border-bottom:1px solid #d3d3d3;border-right:1px solid #d3d3d3;">
								$ '.number_format( $u['total'],2).'
							</td>												
						</tr>
				';
				$x++;
			}
			$html .= '
			<tr>
			<td colspan="8" align="right" style="">Subtotal:</td>
			<td align="right" style="font-weight:bold;">$ '.number_format($cot[0]['subtotal'],2).' </td>
			</tr><tr>
			<td colspan="8" align="right" style="">Descuento <b>'.round($cot[0]['descuento_general']).'%</b>:</td>
			<td align="right" style="font-weight:bold;">$ '.number_format($cot[0]['total_descuento'],2).' </td>
			</tr><tr>
			<td colspan="8" align="right" style="">Gastos de envío:</td>
			<td align="right" style="font-weight:bold;">$ '.number_format($cot[0]['gastos_envio'],2).'</td>
			</tr><tr>
			<td colspan="8" align="right" style="">I.V.A:</td>
			<td align="right" style="font-weight:bold;">$ '.number_format($cot[0]['iva'],2).'</td>
			</tr><tr>
			<td colspan="8" align="right" style="">Total:</td>
			<td align="right" style="font-weight:bold">$ '.number_format($cot[0]['total'],2).'</td>
			</tr>
			<tr><td colspan="9" align="right" >'.($l->ValorEnLetras(round($cot[0]['total'],2),'Pesos')).'</td></tr>				
			</tbody></table>			
			<div style="margin:10px"><b>CONDICIONES DE VENTA</b>: '.$cot[0]['condiciones'].'</div>
			</body></html>';			
			$pdf->WriteHTML($html); 			
			$pdf->Output('./application/files/'.$cot[0]['folio'].'.pdf', 'F');
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
