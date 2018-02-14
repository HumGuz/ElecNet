<div class="modal fade" id="nuevaSucursal">
	<div class="modal-dialog">
		<div class="modal-content" <?php echo $scr ?>>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Nueva Sucursal</h4>
			</div>
			<form id="nvaScrFrm" class="nvo">
				<div class="modal-body modal-info">					
					<div class="row">						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="clave">Clave</label>
			                  <input type="text" class="form-control required" id="clave" name="clave">
			                </div>
						</div>						
						<div class="col-sm-8">
							<div class="form-group">
			                  <label for="nombre">Nombre de la sucursal</label>
			                  <input type="text" class="form-control required" id="nombre" name="nombre">
			                </div>
						</div>
						<div class="clearfix"></div>
						<p class="margin separator">Contacto </p>
						
						<div class="col-sm-12">
							<div class="form-group">
			                  <label for="encargado">Nombre del encargado</label>
			                  <input type="text" class="form-control required" id="encargado" name="encargado">
			                </div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="telefono_fijo">Tel. Fijo</label>
			                  <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo">
			                </div>
						</div>	
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="clave">Tel. celular</label>
			                  <input type="text" class="form-control" id="telefono_celular" name="telefono_celular">
			                </div>
						</div>	
						
						<div class="col-sm-4">
							<div class="form-group">
			                  <label for="email">Email</label>
			                  <input type="text" class="form-control" id="email" name="email">
			                </div>
						</div>	
						<div class="clearfix"></div>
						<p class="margin separator">Domicilio social </p>
						
						
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
			                  <input type="text" class="form-control" id="cp" name="cp">
			                </div>
						</div>	
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
					<button id="gNO"type="submit" class="btn btn-success  btn-sm ladda-button" data-style="slide-right"><span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>  </button>
				
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>