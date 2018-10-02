<div class="modal fade" id="nuevaCompra">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" <?php echo $cmp ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nueva compra</h4>
			</div>
			
			<script src="<?php echo base_url();?>application/third_party/bootstrap-editable/js/bootstrap-editable.min.js"></script>
			<link rel="stylesheet" href="<?php echo base_url();?>application/third_party/bootstrap-editable/css/bootstrap-editable.css">  
			<script>
				cmp.productosDS = <?php echo !empty($prd)?json_encode($prd):'{}'; ?>;
				cmp.productosOC = <?php echo !empty($poc)?json_encode($poc):'{}'; ?>;
				cmp.orden = <?php echo !empty($ord)?json_encode($ord):'{}'; ?>;
			</script>
				<div class="modal-body">					
					<div class="row">				
					<form id="nvaCmp">								
							<div class="form-group col-sm-5 col-sm-offset-1">
				                  <label for="id_proveedor">Proveedor</label>
				                  <select  class="form-control selectpicker " id="id_proveedor" name="id_proveedor" data-container="body" data-live-search="true">
				                  	
				                  	<?php
										if(!empty($prv)) {
											echo '<option>-- seleccione --</option>';							
											foreach($prv as $key=>$s) {
												echo '  <option value="'.$s['id_proveedor'].'" > [ '.$s['clave'].' ] '.$s['nombre'].'</option> ';
											}
										}
									?>
				                  </select>			            
							</div>	
							<div class="form-group col-sm-5">
				                  <label for="condiciones_pago">Condiciones de pago</label>
				                   <input type="text" class="form-control  "  id="condiciones_pago" name="condiciones_pago">		            
							</div>
							<div class="clearfix"></div>	
								
							<div class="form-group col-sm-2  col-sm-offset-1">
				                  <label for="factura">No. Factura</label>
				                  <input type="text" class="form-control  required" id="factura" name="factura">
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
				                  <label for="clave">Fecha recepción</label>
				                  <input type="text" class="form-control " id="fecha_recepcion" name="fecha_recepcion">
							</div>
							
							<div class="form-group col-sm-2">
				                  <label for="descuento_general">Descuento Gral.</label>
				                  <input type="text" class="form-control number" id="descuento_general" name="descuento_general">
							</div>
							
							<div class="form-group col-sm-2">
				                  <label for="costos_envio">Costos de envío</label>
				                  <input type="text" class="form-control number required" id="costos_envio" name="costos_envio" value="0">
							</div>
								
						
					</form>			
						<div class="col-xs-12">
							<table class="table table-condensed table-bcmpered table-stripped fixed prd-form" id="prdCmpTbl" style="opacity: 0">
								<thead>
									<tr>
										<th width="170px">Clave</th>
										<th>Descripción</th>
										<th width="90px">Cantidad</th>
										<th width="100px">Precio U.</th>
										<th width="70px">Desc.</th>
										<th width="90px">Total</th>
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
							                <input type="text" class="form-control typeahead" id="clve_cmp">
							              </div>
										</td>
										<td><input type="text" class="form-control typeahead" id="conc_cmp" /></td>
										<td >											
											<div class="input-group">
								                <input type="text" class="form-control number" id="cantidadp">
								                <span class="input-group-addon" id="umc">---</span>
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
										<td class="bold right" style="padding:6px!important;" id="totalp">$ 0.00</td>
										<td align="center">
											<button type="button" class="btn btn-success" id="add-btn"><i class="fa fa-plus-circle"></i></button>
										</td>
									</tr>
									<tr>
										<td colspan="5" class="right">
											Subtotal:
										</td>
										<td  class="right bold"  id="subtotal">
											$ 0.00
										</td>
									</tr>
									<tr>
										<td colspan="5" class="right">
											Descuento:
										</td>
										<td  class="right bold" id="descuento">
											$ 0.00
										</td>
									</tr>
									
									<tr>
										<td colspan="5" class="right">
											Subtotal:
										</td>
										<td  class="right bold" id="subtotal_descuento">
											$ 0.00
										</td>
									</tr>
									
									<tr>
										<td colspan="5" class="right" >
											Costo de envío:
										</td>
										<td  class="right bold" id="envio"> 
											$ 0.00
										</td>
									</tr>
									<tr>
										<td colspan="5" class="right" >
											I.V.A.:
										</td>
										<td  class="right bold" id="iva"> 
											$ 0.00
										</td>
									</tr>
									<tr>
										<td colspan="5" class="right"  >
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
			                <textarea type="text" rows="3" style="resize: none" class="form-control" id="observaciones" name="observaciones"></textarea>
			            </div>							
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="clsNO">Cancelar</button>
					<button id="gNO" type="button" class="btn btn-success  btn-sm ladda-button" data-style="slide-right"><span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>  </button>
				</div>
			
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>