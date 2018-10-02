aut = {
	
	init:function(md){
		md.find("#id_cliente").change(function(){
			v = $(this).val();
			if(v!=''){
				$.ajax({type : "POST",url : "../productos/getPrecioXProductoServicio",dataType : "json",data : {id_cliente:v,id_sucursal:o.id_sucursal}})
				.done(function(r) {
					Object.keys(r).length ? vnt.autocomplete(r) : ( $('#clve_vnt').typeahead('destroy'), $('#conc_vnt').typeahead('destroy'), $.alert({title: 'Sin productos',icon: 'fa fa-warning',content: 'No hay productos para generar la venta',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}}) )  ;
				}).fail(function(e, t, i) {console.log(e, t, i)});					
				$("#descuento_general").val( o.id_venta && Object.keys(s).length ? s.descuento_general:$(this).find('option:selected').data('descuento'));					
			}else{
				$("#prdVntTbl").css('opacity',0).eq(0).find('body').empty(),vnt.productos = {},vnt.prdDtSt = [],vnt.keys = [],vnt.names = []
			}
		});
			
		md.find('#clve_vnt').on('focusout',function(){event.preventDefault(),vnt.getCoincidence($(this).val(),vnt.keys)});		
		md.find('#conc_vnt').on('focusout',function(){event.preventDefault(),vnt.getCoincidence($(this).val(),vnt.names)});		
		md.find('#clve_vnt').keyup(function(){
			event.preventDefault(),
			(event.keyCode==13 && vnt.getCoincidence($(this).val(),vnt.keys)),
			(event.keyCode==27 && vnt.clearForm())														
		});		
		md.find('#conc_vnt').keyup(function(){
			event.preventDefault(),
			(event.keyCode==13 && vnt.getCoincidence($(this).val(),vnt.names)),
			(event.keyCode==27 && vnt.clearForm())				
		});	
		md.find("#preciop,#cantidadp,#descuentop,#descuento_general,#costos_envio").keypress(function() {v = $(this).val();return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46;});		
		md.find("#descuento_general,#costos_envio").keyup(function() { 			
			vl = $(this).val();
			if(vl!='' && Object.keys(vnt.productos).length)
		    	vnt.totalGeneral();  				
		}); 			        
		md.find("#preciop").keyup(function() { 			
			(event.keyCode==13 && $("#add-btn").click()),
			(event.keyCode==27 && vnt.clearForm())
			vl = $(this).val();
			if(vl!=''){vnt.producto.precio = parseFloat(vl),vnt.totalProducto()}
		});
		md.find("#cantidadp").keyup(function() {			
			(event.keyCode==13 && $("#add-btn").click()),
			(event.keyCode==27 && vnt.clearForm())
			vl = $(this).val();
			if(vl!=''){vnt.producto.cantidad = parseFloat(vl),vnt.totalProducto()}
		});	
		md.find("#descuentop").keyup(function() {			
			(event.keyCode==13 && $("#add-btn").click()),
			(event.keyCode==27 && vnt.clearForm())
			vl = $(this).val();
			if(vl!=''){vnt.producto.descuento = parseFloat(vl),vnt.totalProducto()}
		});
		md.find("#umc").change(function() {
			if(Object.keys(vnt.producto).length){				
				vnt.producto.precio = parseFloat($(this).find('option:selected').data('precio')),
				vnt.producto.existencia = parseFloat($(this).find('option:selected').data('existencia')),
				vnt.producto.costo_promedio = parseFloat($(this).find('option:selected').data('costo_promedio')),
				vnt.producto.um = $(this).val(),					
				$("#preciop").val(vnt.producto.precio);
		   		$("#existenciap").html( (vnt.producto.um !='SERV' ? vnt.producto.existencia+' ' :'')  +vnt.producto.um);
		   		$("#costo_promediop").html('$ '+app.number_format(vnt.producto.costo_promedio,2));
		   		vnt.totalProducto()	
			}
		});	
		md.find("#add-btn").click(function(){vnt.addProducto()});
		md.find("#subtotal").html('$ 0.00'),$("#descuento").html('$ 0.00'),$("#iva").html('$ 0.00'),$("#total").html('$ 0.00');	
		md.find('#conc_vnt,#clve_vnt').off('blur');			
	}	
	}
