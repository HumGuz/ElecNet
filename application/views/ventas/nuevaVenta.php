<div class="modal fade" id="nuevaVenta">
	<div class="modal-dialog modal-lg" style="width: 90%">
		<div class="modal-content" <?php echo $vnt ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nueva Venta</h4>
			</div>			
			<script src="<?php echo base_url();?>application/third_party/bootstrap-editable/js/bootstrap-editable.min.js"></script>
			<link rel="stylesheet" href="<?php echo base_url();?>application/third_party/bootstrap-editable/css/bootstrap-editable.css">  
			<script>
				vnt.productosDS = <?php echo !empty($prd)?json_encode($prd):'{}'; ?>;
				vnt.productosCT = <?php echo !empty($pcot)?json_encode($pcot):'{}'; ?>;
				vnt.cotizacion = <?php echo !empty($cot)?json_encode($cot):'{}'; ?>;
			</script>
			<style>
				#nuevaVenta button[data-id='umc']{padding-left: 2px!important;}
				#nuevaVenta .bootstrap-select.btn-group .dropdown-toggle .caret {right: 2px!important;}
			</style>
				<div class="modal-body">					
					<div class="row">				
					<form id="nvaVnt">								
							<div class="form-group col-sm-4 ">
				                  <label for="id_cliente">Cliente</label>
				                  <select  class="form-control selectpicker required" id="id_cliente" name="id_cliente" data-container="body">				                  	
				                  	<?php
										if(!empty($clt)) {
											echo '<option>-- seleccione --</option>';							
											foreach($clt as $key=>$s) {
												echo '  <option value="'.$s['id_cliente'].'" data-descuento="'.$s['descuento_general'].'"> [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
											}
										}
									?>
				                  </select>			            
							</div>	
																			
							<div class="form-group col-sm-2">
				                  <label for="metodo_pago">Metodo de pago</label>
				               	  <select  class="form-control selectpicker required" id="metodo_pago" name="metodo_pago" data-container="body">
									<option value=""> -- seleccione --</option>
									<option value="1">Efectivo   </option>
									<option value="2">Transferencia  </option>
									<option value="3">Cheque   </option>
								</select>	
							</div>
							
							<div class="form-group col-sm-2">
				                  <label for="fecha_entrega">Fecha entrega</label>
				                  <input type="text" class="form-control required" id="fecha_entrega" name="fecha_entrega">
							</div>
							
							<div class="form-group col-sm-2">
				                  <label for="descuento_general">Descuento Gral.</label>
				                  <input type="text" class="form-control number required" id="descuento_general" name="descuento_general" value="0">
							</div>
							
							<div class="form-group col-sm-2">
				                  <label for="descuento_general">Gastos de envío</label>
				                  <input type="text" class="form-control number required" id="costos_envio" name="costos_envio" value="0">
							</div>
						
					</form>			
						<div class="col-xs-12">
							<table class="table table-condensed table-bvntered table-stripped fixed prd-form" id="prdVntTbl" style="opacity: 0">
								<thead>
									<tr>
										<th width="170px">Clave</th>
										<th>Descripción</th>
										<th class="right" width="90px">Exist.</th>
										<th class="right" width="100px">Cantidad</th>
										<th class="right" width="100px">Precio U.</th>										
										<th class="right" width="70px">Desc.</th>
										<th class="right" width="100px">Subtot.</th>
										<th class="right" width="100px">Costo Prom.</th>
										<th class="right" width="100px">Truput</th>
										<th class="right" width="90px">Total</th>
										<th width="30px" align="center"><span class="glyphicon glyphicon-cog"></span></th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<td>
											<div class="input-group">
							                <div class="input-group-btn">
							                	<button type="button" class="btn btn-default" title="Nuevo Producto" ><i class="fa fa-plus"></i></button>
							                	<button type="button" class="btn btn-default"   title="Lista de Productos"><span class="fa fa-bars"></span></button>
							                </div>							               
							                <input type="text" class="form-control typeahead" id="clve_vnt">
							              </div>
										</td>
										<td><input type="text" class="form-control typeahead" id="conc_vnt" /></td>
										<td class="bold right" style="padding:6px!important;" id="existenciap"></td>
										<td >							            
								            <div class="input-group">										 
											   <input type="text" class="form-control number" id="cantidadp">										  
											  <span class="input-group-btn">
										        <select class="form-control selectpicker" id="umc" name="umc" data-container="body" data-width="40px">
			                                    	
			                                    </select>
										      </span>
											</div>	
										</td>
										<td >
											<div class="input-group">
								                <span class="input-group-addon">$</span>
								                <input type="text" class="form-control number" id="preciop">
								            </div>											
										</td>							
										<td >
											<div class="input-group">
								                <input type="text" class="form-control number" id="descuentop">
								                <span class="input-group-addon">%</span>
								            </div>
								        </td>
								        <td class="bold right" style="padding:6px!important;" id="subtotalp">$ 0.00</td>		
								        <td class="bold right" style="padding:6px!important;" id="costo_promediop">$ 0.00</td>		
										<td class="bold right" style="padding:6px!important;" id="truputp">$ 0.00</td>	
										<td class="bold right" style="padding:6px!important;" id="totalp">$ 0.00</td>
										<td align="center">
											<button type="button" class="btn btn-success" id="add-btn"><i class="fa fa-plus-circle"></i></button>
										</td>
									</tr>
									<tr>
										<td colspan="9" class="right">
											Subtotal:
										</td>
										<td  class="right bold"  id="subtotal">
											$ 0.00
										</td>
									</tr>
									<tr>
										<td colspan="9" class="right">
											Descuento Gral:
										</td>
										<td  class="right bold" id="descuento">
											$ 0.00
										</td>
									</tr>
									<tr>
										<td colspan="9" class="right" >
											Gastos de envio:
										</td>
										<td  class="right bold" id="envio"> 
											$ 0.00
										</td>
									</tr>
									<tr>
										<td colspan="9" class="right" >
											I.V.A.:
										</td>
										<td  class="right bold" id="iva"> 
											$ 0.00
										</td>
									</tr>									
									<tr>
										<td colspan="9" class="right"  >
											Total:
										</td>
										<td  class="right bold" id="total">
											$ 0.00
										</td>
									</tr>
								</tfoot>
							</table>
						</div>						
						<div class="form-group col-sm-12">
			                <label for="observaciones">Observaciones</label>
			                <textarea type="text" rows="2" style="resize: none" class="form-control" id="observaciones" name="observaciones"></textarea>
			            </div>	
			            <div class="form-group col-sm-12">
			                <label for="observaciones">Condiciones de venta</label>
			                <textarea type="text" rows="3" style="resize: none" class="form-control" id="condiciones" name="condiciones"></textarea>
			            </div>							
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="clsNO">Cancelar</button>
					<button type="button" class="btn btn-success btn-sm" id="gNO"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar </button>
				</div>
			
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>