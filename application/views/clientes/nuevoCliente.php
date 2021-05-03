<div class="modal fade" id="clt-modal" data-width="700px">
	<div class="modal-content" <?php echo $clt ?>>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title">Nuevo Cliente</h4>
		</div>
		<form id="nvoCltFrm" class="nvo">
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
							<label for="rfc">RFC</label>
							<input type="text" class="form-control" id="rfc" name="rfc">
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control required" id="nombre" name="nombre">
						</div>
					</div>
					<div class="clearfix"></div>
					<p class="margin ">
						Contacto
					</p>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="contacto">Nombre del contacto</label>
							<input type="text" class="form-control required" id="contacto" name="contacto">
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

					<p class="margin ">
						Domicilio Fiscal
					</p>
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
					<p class="margin ">
						Datos de venta
					</p>

					<div class="clearfix"></div>

					<div class="col-sm-4 col-sm-offset-2">
						<div class="form-group">
							<label for="descuento_general">Descuento Gral.</label>
							<input type="text" class="form-control number" id="descuento_general" name="descuento_general">
						</div>
					</div>

					<div class="form-group col-sm-4">
						<label for="id_lista_precios">Lista de precios</label>
						<select  class="form-control selectpicker  " id="id_lista_precios" name="id_lista_precios" data-container="body" data-live-search="true" data-hide-disabled="true">
							<?php
							if (!empty($lp)) {
								echo '<option value="">-- seleccione --</option>';
								foreach ($lp as $key => $s) {
									echo '<option value="' . $s['id_lista_precios'] . '" > [ ' . $s['clave'] . ' ] ' . number_format($s['descuento'], 2) . '</option> ';
								}
							}
							?>
						</select>
					</div>

					<div class="clearfix"></div>

					<div class="col-sm-4  col-sm-offset-2">
						<div class="form-group">
							<label for="dias_credito">Días crédito</label>
							<input type="text" class="form-control digits" id="dias_credito" name="dias_credito">
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label for="monto_credito">Monto crédito</label>
							<input type="text" class="form-control number" id="monto_credito" name="monto_credito">
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
					Cancelar
				</button>
				<button id="gNO"type="submit" class="btn btn-success  btn-sm ladda-button" data-style="slide-right">
					<span class="ladda-label"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</span>
				</button>

			</div>
		</form>
	</div>
</div>