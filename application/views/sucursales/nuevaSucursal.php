<<<<<<< HEAD
<div class="modal fade" id="scr-modal">	
		<div class="modal-content" <?php echo $dt ?>>
			<div class="modal-header">
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
						<p class="col-sm-12 bold">Contacto </p>
						
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
						<p class="col-sm-12 bold">Domicilio social </p>
						
						
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
					<button type="button" class="btn btn-default btn-sm close-modal" >Cancelar</button>
					<button id="sb-scr" name="sb-scr" type="submit" class="btn btn-success  btn-sm ladda-button" data-style="slide-right"><span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>  </button>
				</div>
			</form>
		</div>	
=======
<div class="modal fade" id="scr-modal">	
		<div class="modal-content" <?php echo $dt ?>>
			<div class="modal-header">
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
						<p class="col-sm-12 bold">Contacto </p>
						
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
						<p class="col-sm-12 bold">Domicilio social </p>
						
						
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
					<button type="button" class="btn btn-default btn-sm close-modal" >Cancelar</button>
					<button id="sb-scr" name="sb-scr" type="submit" class="btn btn-success  btn-sm ladda-button" data-style="slide-right"><span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>  </button>
				</div>
			</form>
		</div>	
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
</div>