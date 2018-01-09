<div class="modal fade" id="nuevaOrden">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" <?php echo $obj ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nueva orden de compra</h4>
			</div>
			<script src="<?php echo base_url();?>application/third_party/bootstrap-editable/js/bootstrap-editable.min.js"></script>
			<link rel="stylesheet" href="<?php echo base_url();?>application/third_party/bootstrap-editable/css/bootstrap-editable.css">  
			<script>ord.productosDS = <?php echo json_encode($prd); ?></script>
				<div class="modal-body">					
					<div class="row">				
					<form id="nvaOrd">								
							<div class="form-group col-sm-6">
				                  <label for="id_proveedor">Proveedor</label>
				                  <select  class="form-control selectpicker " id="id_proveedor" name="id_proveedor" data-container="body">
				                  	
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
							
							<div class="form-group col-sm-2">
				                  <label for="descuento_general">Descuento General</label>
				                  <input type="text" class="form-control  number required" value="0" id="descuento_general" name="descuento_general">
							</div>
							
							<div class="form-group col-sm-2">
				                  <label for="descuento_general">Gastos de envio</label>
				                  <input type="text" class="form-control  number required" value="0" id="gastos_envio" name="gastos_envio">
							</div>
																			
							<div class="form-group col-sm-2">
				                  <label for="clave">Fecha vencimiento</label>
				                  <input type="text" class="form-control " id="fecha_vencimiento" name="fecha_vencimiento">
							</div>	
						
					</form>			
						<div class="col-xs-12">
							<table class="table table-condensed table-bordered table-stripped fixed prd-form" id="prdOrdTbl" style="opacity: 0">
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
							                <input type="text" class="form-control typeahead" id="clve_ord">
							              </div>
										</td>
										<td><input type="text" class="form-control typeahead" id="conc_ord" /></td>
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
					<button type="button" class="btn btn-success btn-sm" id="gNO"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar </button>
				</div>
			
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>