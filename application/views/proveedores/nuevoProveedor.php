<div class="modal fade" id="nuevoProveedor">
	<div class="modal-dialog">
		<div class="modal-content" <?php echo $prv ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nuevo Proveedor</h4>
			</div>
			<form id="nvoPrvFrm" class="nvo">
				<div class="modal-body modal-info">					
					<div class="row">						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="clave">Clave</label>
			                  <input type="text" class="form-control required" id="clave" name="clave">
			                </div>
						</div>
						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="clave ">RFC</label>
			                  <input type="text" class="form-control required" id="rfc" name="rfc">
			                </div>
						</div>
												
						<div class="col-sm-6">
							<div class="form-group">
			                  <label for="nombre">Nombre</label>
			                  <input type="text" class="form-control required" id="nombre" name="nombre">
			                </div>
						</div>
						<div class="clearfix"></div>
						<p class="margin ">Contacto </p>
						
						<div class="col-sm-12">
							<div class="form-group">
			                  <label for="vendedor">Nombre del vendedor</label>
			                  <input type="text" class="form-control required" id="vendedor" name="vendedor">
			                </div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="telefono_fijo">Tel. Fijo</label>
			                  <input type="text" class="form-control telefono" id="telefono_fijo" name="telefono_fijo">
			                </div>
						</div>	
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="clave">Tel. celular</label>
			                  <input type="text" class="form-control telefono" id="telefono_celular" name="telefono_celular">
			                </div>
						</div>	
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="email">Email</label>
			                  <input type="text" class="form-control email" id="email" name="email">
			                </div>
						</div>	
						<div class="clearfix"></div>
						
						<p class="margin ">Domicilio Fiscal </p>	
						<div class="col-sm-8">
							<div class="form-group">
			                  <label for="calle">Calle</label>
			                  <input type="text" class="form-control" id="calle" name="calle">
			                </div>
						</div>							
						<div class="col-sm-2">
							<div class="form-group">
			                  <label for="exterior">No. Ext.</label>
			                  <input type="text" class="form-control" id="exterior" name="exterior">
			                </div>
						</div>							
						<div class="col-sm-2">
							<div class="form-group">
			                  <label for="interior">No. Int.</label>
			                  <input type="text" class="form-control" id="interior" name="interior">
			                </div>
						</div>							
						<div class="col-sm-6">
							<div class="form-group">
			                  <label for="colonia">Colonia</label>
			                  <input type="text" class="form-control" id="colonia" name="colonia">
			                </div>
						</div>							
						<div class="col-sm-6">
							<div class="form-group">
			                  <label for="localidad">Localidad</label>
			                  <input type="text" class="form-control" id="localidad" name="localidad">
			                </div>
						</div>	
						
						<div class="col-sm-6">
							<div class="form-group">
			                  <label for="municipio_delegacion">Municipio o Delegación</label>
			                  <input type="text" class="form-control" id="municipio_delegacion" name="municipio_delegacion">
			                </div>
						</div>							
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="estado">Estado</label>
			                  <input type="text" class="form-control" id="estado" name="estado">
			                </div>
						</div>	
						<div class="col-sm-2">
							<div class="form-group">
			                  <label for="cp">C.P.</label>
			                  <input type="text" class="form-control digits" id="cp" name="cp">
			                </div>
						</div>
						
						<div class="clearfix"></div>
						<p class="margin ">Datos de pago </p>
							
							
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="banco">Banco</label>
			                  <input type="text" class="form-control" id="banco" name="banco">
			                </div>
						</div>		
						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="sucursal">Sucursal</label>
			                  <input type="text" class="form-control" id="sucursal" name="sucursal">
			                </div>
						</div>		
						
						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="no_cuenta">Num. Cuenta</label>
			                  <input type="text" class="form-control digits" id="no_cuenta" name="no_cuenta">
			                </div>
						</div>	
						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="cable">Clabe</label>
			                  <input type="text" class="form-control digits" id="cable" name="cable">
			                </div>
						</div>	
						
						<div class="clearfix"></div>
						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="referencia">Referencia</label>
			                  <input type="text" class="form-control" id="referencia" name="referencia">
			                </div>
						</div>	
						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="no_tarjeta">No. Tarjeta</label>
			                  <input type="text" class="form-control digits" id="no_tarjeta" name="no_tarjeta">
			                </div>
						</div>
						
						
						<div class="col-sm-3  ">
							<div class="form-group">
			                  <label for="dias_credito">Días crédito</label>
			                  <input type="text" class="form-control digits" id="dias_credito" name="dias_credito">
			                </div>
						</div>	
						
						<div class="col-sm-3">
							<div class="form-group">
			                  <label for="monto_credito">Monto crédito</label>
			                  <input type="text" class="form-control number" id="monto_credito" name="monto_credito">
			                </div>
						</div>		
							
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success  btn-sm"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar </button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>