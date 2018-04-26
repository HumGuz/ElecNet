cot = {
	id_sucursal:0,
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){cot.nuevaCotizacion({id_sucursal:cot.id_sucursal})});
		$("#cotTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,cot[f](d)});
		$("#srchFrm").validation({success:function(o){$("#cotTbl tbody").empty(),cot.cotizacionesTable(o)}});		
		strt = moment().subtract(6, 'days');
		end =  moment();
		cb =  function (start, end, lbl) {	      
	       	$("#srchFrm").find('#daterange-btn span').html('<b>'+lbl+'</b> del '+start.format('D MMMM YYYY') + ' al ' + end.format('D MMMM YYYY'));	        
	        $("#srchFrm").find("#fecha_inicial").val(start.format('YYYY-MM-DD'))
	        $("#srchFrm").find("#fecha_final").val(end.format('YYYY-MM-DD'))
	    };		
		$("#srchFrm").find('#daterange-btn').daterangepicker({locale:{format: 'YYYY-MM-DD'},startDate: strt,endDate: end,opens: "left",drops: "up",autoApply:true, ranges: { 'Hoy'       : [moment(), moment()],'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],'Este Mes'  : [moment().startOf('month'), moment().endOf('month')], 'Mes Anterior'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]}},cb);		 
		cb(strt,end,'Últimos 7 Días');		 
		$("#id_sucursal").change(function(){ cot.id_sucursal =$(this).val(), cot.clear()})
		 cot.id_sucursal =$("#id_sucursal").val(),cot.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();		
		$("#cotTbl tbody").empty();
		cot.cotizacionesTable({});
	},
	cotizacionesTable:function(o){
			$(".overlay").show();
		o.id_sucursal = cot.id_sucursal;
		$.ajax({type : "POST",url : "cotizacionesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#cotTbl tbody").append(r),$(".overlay").hide();
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},		
	nuevaCotizacion:function(o){
		cot.producto = {},cot.productos = {},cot.productosDS = {};
		$.ajax({type:"POST",url :  "nuevaCotizacion",dataType : "html",data:o}).done(function(r) {					
			$('body').append(r),md = $('#nuevaCotizacion');			 
			md.modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});
			s = $('#nuevaCotizacion .modal-content').data();	
			md.find("#id_cliente").change(function(){
				v = $(this).val();
				if(v!=''){
					$.ajax({type : "POST",url : "../productos/getPrecioXProductoServicio",dataType : "json",data : {id_cliente:v,id_sucursal:o.id_sucursal}})
					.done(function(r) {
						Object.keys(r).length ? cot.autocomplete(r) : ( $('#clve_cot').typeahead('destroy'), $('#conc_cot').typeahead('destroy'), $.alert({title: 'Sin productos',icon: 'fa fa-warning',content: 'No hay productos para generar la cotizacion',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}}) )  ;
					}).fail(function(e, t, i) {console.log(e, t, i)});					
					$("#descuento_general").val( o.id_cotizacion && Object.keys(s).length ? s.descuento_general:$(this).find('option:selected').data('descuento'));					
				}else{
					$("#prdCotTbl").css('opacity',0).eq(0).find('body').empty(),cot.productos = {},cot.prdDtSt = [],cot.keys = [],cot.names = []
				}
			});							
			md.find(".selectpicker").selectpicker({});					
			md.find('#fecha_vencimiento').daterangepicker({locale:{format: 'YYYY-MM-DD'},singleDatePicker: true, showDropdowns: true });			
			md.find('#clve_cot').on('focusout',function(){event.preventDefault(),cot.getCoincidence($(this).val(),cot.keys)});		
			md.find('#conc_cot').on('focusout',function(){event.preventDefault(),cot.getCoincidence($(this).val(),cot.names)});		
			md.find('#clve_cot').keyup(function(){
				event.preventDefault(),
				(event.keyCode==13 && cot.getCoincidence($(this).val(),cot.keys)),
				(event.keyCode==27 && cot.clearForm())														
			});		
			md.find('#conc_cot').keyup(function(){
				event.preventDefault(),
				(event.keyCode==13 && cot.getCoincidence($(this).val(),cot.names)),
				(event.keyCode==27 && cot.clearForm())				
			});
			md.find("#preciop,#cantidadp,#descuentop,#descuento_general,#gastos_envio").keypress(function() {v = $(this).val();return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46;});		
			md.find("#descuento_general,#gastos_envio").keyup(function() { 			
				vl = $(this).val();
				if(vl!='' && Object.keys(cot.productos).length)
			    	cot.totalGeneral();  				
			}); 			        
			md.find("#preciop").keyup(function() { 			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && cot.clearForm())
				vl = $(this).val();
				if(vl!=''){cot.producto.precio = parseFloat(vl),cot.totalProducto()}
			});
			md.find("#cantidadp").keyup(function() {			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && cot.clearForm())
				vl = $(this).val();
				if(vl!=''){cot.producto.cantidad = parseFloat(vl),cot.totalProducto()}
			});	
			md.find("#descuentop").keyup(function() {			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && cot.clearForm())
				vl = $(this).val();
				if(vl!=''){cot.producto.descuento = parseFloat(vl),cot.totalProducto()}
			});			
			md.find("#umc").change(function() {
				if(Object.keys(cot.producto).length){				
					cot.producto.precio = parseFloat($(this).find('option:selected').data('precio'));
					cot.producto.costo_promedio = parseFloat($(this).find('option:selected').data('costo_promedio'));
					$("#preciop").val(cot.producto.precio);
		    		cot.producto.um = $(this).val(),
		    		cot.totalProducto()	
				}
			});	
			md.find("#add-btn").click(function(){cot.addProducto()});
			md.find("#subtotal").html('$ 0.00'),$("#descuento").html('$ 0.00'),$("#iva").html('$ 0.00'),$("#total").html('$ 0.00');	
			md.find('#conc_cot,#clve_cot').off('blur');			
			md.find("#clsNO").click(function(){				
				if(Object.keys(cot.productos).length)
					$.confirm({ title: 'Cerrar Nueva Cotizacion',content: 'Hay productos cargados a la cotizacion, al cerrar perdera los cambios ¿Decea Cerrar?', type: 'orange',theme:"dark",buttons: {a: {text: 'Cancelar'},b: {text: 'Cerrar',btnClass: 'btn-orange', action: function(r){md.modal('hide'); }} }});
				else
					md.modal('hide');
			});
			md.find("#gNO").click(function(){$("#nvaCot").submit()});
			if(o && o.id_cotizacion){	
				for(i in s)
					(md.find("#"+i).length && md.find("#"+i).val(s[i]));					
				for(p in cot.productosDS)
					pr = cot.productosDS[p], pr.cantidad = parseFloat(pr.cantidad), pr.descuento = parseFloat(pr.descuento), pr.precio = parseFloat(pr.precio), pr.subtotal = parseFloat(pr.subtotal), pr.total = parseFloat(pr.total),cot.addFilaProducto(pr);					
				cot.totalGeneral(),md.find( "#factura" ).attr('disabled','disabled'),
				md.find("#id_cliente").change(),rls={};				
			}		
			md.find("#nvaCot").validation({extend:o,success:function(ob){
				if(!Object.keys(cot.productos).length){
						$.confirm({ title: 'Sin productos',content: 'No hay productos cargados a la cotizacion', type: 'orange',theme:"dark",buttons: {a: {text: 'Aceptar',btnClass: 'btn-orange'} }});
				}else				
					cot.guardarCotizacion(ob)
			}});
			md.find(".selectpicker").selectpicker('refresh');				
		});
	},	
	 
	autocomplete:function(prdDtSt) {
		cot.prdDtSt = [];
		cot.keys = [];
		cot.names = [];
		if (prdDtSt.length) 
			for ( i = 0; i < prdDtSt.length; i++) 
				c = prdDtSt[i],cot.keys.push($.trim(c.clave.toLowerCase())),cot.names.push($.trim(c.concepto.toLowerCase()));		
		var keys = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.clave);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		keys.initialize();
		$('#clve_cot').typeahead(null, {displayKey : 'clave',hint : true,source : keys.ttAdapter()});
		var names = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.concepto);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		names.initialize();
		$('#conc_cot').typeahead(null, {displayKey : 'concepto',hint : true,source : names.ttAdapter()});
		cot.prdDtSt = prdDtSt;
		$("#prdCotTbl").css('opacity',1)
	},
	
    clearForm:function(){
    	cot.producto = {};
    	$('#conc_cot').typeahead('val', '');  
    	$('#clve_cot').typeahead('val', '');      			
    	$("#preciop").val(''); 
    	$("#umc").empty();
    	$("#umc").selectpicker('refresh');        	
    	$("#cantidadp").val('');
    	
    	$("#subtotalp").html('--');  
    	$("#costo_promediop").html('--');  
    	$("#truputp").html('--');  
    	 
    	$("#totalp").html('--');  
    	$("#existenciap").html('--');    	
    	$("#descuentop").val(0);	     
    	$('#clve_cot').focus(); 
    	$("input.form-control.tt-hint.ignore").val('');
    	$("input.form-control.ignore.tt-hint").val('');
    },	
    	
	getCoincidence:function(val,dataSet){
    	$("span.tt-dropdown-menu").hide(); 	
    	val = $.trim(val).toLowerCase();
		if(val!=''){
			index = dataSet.indexOf(val);
			coin = $.extend({},cot.prdDtSt[ index ]);				
			cot.setPrdData(coin);
            cot.totalProducto();
		}
    },    
	setPrdData:function(dat){
    	if(dat){    		
    		$('#clve_cot').val(dat.clave);    		
    		$('#conc_cot').val(dat.concepto);     		
    		$("#umc").empty();
    		if(dat.ue != dat.us){    			
    			$("#umc").html('<option value="'+dat.ue+'" data-precio="'+dat.precio_ue+'"  '+(dat.ue!='SERV' ? 'data-existencia="'+dat.existencia_ue+'"' : '')+' data-costo_promedio="'+dat.costo_promedio_ue+'" >'+dat.ue+'</option><option value="'+dat.us+'"  data-precio="'+dat.precio_us+'"  '+(dat.ue!='SERV' ? 'data-existencia="'+dat.existencia_ue+'"' : '')+' data-costo_promedio="'+dat.costo_promedio_us+'" >'+dat.us+'</option>');    			
    		}else{
    			$("#umc").html('<option value="'+dat.ue+'" data-precio="'+dat.precio_ue+'"  '+(dat.ue!='SERV' ? 'data-existencia="'+dat.existencia_ue+'"' : '')+' data-costo_promedio="'+dat.costo_promedio_ue+'" >'+dat.ue+'</option>');  
    		} 
	    	if(cot.productos[dat.id_producto] ){
    			dat.precio = cot.productos[dat.id_producto].precio;
    			dat.costo_promedio = cot.productos[dat.id_producto].costo_promedio;
    			dat.descuento = cot.productos[dat.id_producto].descuento;
    			dat.um = cot.productos[dat.id_producto].um;
    			dat.existencia = cot.productos[dat.id_producto].existencia;
    		}else{
    			dat.precio = parseFloat(dat.precio_ue);
    			dat.um = dat.ue;
    			dat.descuento =  !dat.descuento ? 0 : dat.descuento;   
    			dat.existencia = parseFloat(dat.existencia_ue); 
    			dat.costo_promedio = parseFloat(dat.costo_promedio_ue); 		
    		}	
    		
    		$("#existenciap").text((dat.ue!='SERV'? dat.existencia+' ':'') +dat.um);   
    		$("#cantidadp").focus(); 
    		$("#umc").selectpicker('refresh');  	
	    	$("#preciop").val(dat.precio);     		  
    		$("#descuentop").val(dat.descuento);       		
    		$("#costo_promediop").html('$ '+dat.costo_promedio);     		
            cot.producto = $.extend({},dat);
    		delete dat;	
    	}else{
    		cot.producto = {};
    		toastr["warning"]("Producto no encontrado");
    	}
    },
    
    totalProducto:function(p) {    	
    	if(p){
    		v = p.cantidad;
			if (Object.keys(p).length && !isNaN(v) && v > 0) {	
				p.subtotal = p.cantidad * p.precio;				
				p.total_descuento =  (p.descuento * p.subtotal) / 100;
				p.subtotal -= p.total_descuento;				
				p.truput = p.subtotal - ( p.costo_promedio * p.cantidad  );				
				p.iva = p.subtotal * 0.16;
				p.total =  p.subtotal * 1.16;				
				$("#prtr"+p.id_producto).find('td').eq(6).html('$ ' + app.number_format(p.subtotal,2));
				$("#prtr"+p.id_producto).find('td').eq(7).html('$ ' + app.number_format( p.costo_promedio ,2));
				$("#prtr"+p.id_producto).find('td').eq(8).html('$ ' + app.number_format(p.truput,2));		
				$("#prtr"+p.id_producto).find('td').eq(9).html('$ ' + app.number_format(p.subtotal,2));				
			} else {
				$("#totalp").html('$ 0.00');
			}
    	}else{
    		v = cot.producto.cantidad;
			if (Object.keys(cot.producto).length && !isNaN(v) && v > 0) {						
				cot.producto.subtotal =  cot.producto.cantidad * cot.producto.precio;
				cot.producto.total_descuento = (cot.producto.descuento * cot.producto.subtotal) / 100;
				cot.producto.subtotal -=cot.producto.total_descuento;				
				cot.producto.truput = cot.producto.subtotal - ( cot.producto.costo_promedio * cot.producto.cantidad  );
				cot.producto.iva = cot.producto.subtotal * 0.16;
				cot.producto.total =  cot.producto.subtotal * 1.16;				
				$("#subtotalp").html('$ ' + app.number_format(cot.producto.subtotal,2));
				$("#costo_promediop").html('$ ' + app.number_format(cot.producto.costo_promedio,2));
				$("#truputp").html('$ ' + app.number_format(cot.producto.truput,2));
				$("#totalp").html('$ ' + app.number_format(cot.producto.subtotal,2));
			} else {
				$("#totalp").html('$ 0.00');
			}
    	} 
	},    
	
	totalGeneral:function(){
    	dsc = $.trim($("#descuento_general").val());    	
    	if(dsc ==''){
    		$("#descuento_general").val(0);
    		dsc = 0;
    	}    	
    	cot.subtotal = 0; 
    	cot.truput = 0; 
    	cot.total_descuento = 0;
    	cot.subtotal_descuento = 0; 
    	cot.iva = 0;
    	cot.total = 0; 
    	dsc = parseFloat(dsc);  
        for( producto in cot.productos ) {        	
        	cot.totalProducto(cot.productos[ producto ]);
        	cot.subtotal += cot.productos[ producto ].subtotal; 
        	cot.truput += cot.productos[ producto ].truput; 
        }  
        cot.total_descuento = dsc *  cot.subtotal / 100; 
		cot.subtotal_descuento = cot.subtotal - cot.total_descuento;
		env = $.trim($("#gastos_envio").val()), env = ( env !=''? parseFloat(env) :0 ),
        (env == 0 && $("#gastos_envio").val(0)),		
		cot.iva = (cot.subtotal_descuento + env) * 0.16;
		cot.total = (cot.subtotal_descuento + env) * 1.16;
        $("#subtotal").html('$ ' + app.number_format(cot.subtotal,2));	
		$("#descuento").html('$ ' + app.number_format(cot.total_descuento,2));
		$("#subtotal_descuento").html('$ ' + app.number_format(cot.subtotal_descuento,2));
		$("#envio").html('$ ' + app.number_format(env,2));	    
    	$("#iva").html('$ ' + app.number_format(cot.iva,2)); 
    	$("#total").html('$ ' + app.number_format(cot.total,2));	    	
    },
	addProducto:function(){		
		if(Object.keys(cot.producto).length){
			c = parseFloat($.trim($("#cantidadp").val())),
			p = parseFloat($.trim($("#preciop").val())),
			d = parseFloat($.trim($("#descuentop").val()));						
			cp = parseFloat(cot.producto.costo_promedio);	
			if(isNaN(c.toString()) || c <=0 || c==''){
				$("#cantidadp").val(''),$("#cantidadp").focus(),toastr["warning"]("Capture la cantidad")
				return 0;	
			}
			if(isNaN(p.toString()) || p <=0 || p==''){
				$("#preciop").val(''),$("#preciop").focus(),toastr["warning"]("Capture el precio")
				return 0;	
			}
			if(isNaN(d.toString()) || d < 0 || (d!= 0 && d=='')){
				$("#descuentop").val(''),$("#descuentop").focus(),toastr["warning"]("Capture el descuento")
				return 0;	
			}			
			if(p<cp && cp>0){				
				$.confirm({ title: 'Precio',content: 'El precio establecido es menor a el costo promedio del producto por lo que se generarán perdidas.<br>Costo Promedio:<b>$ '+app.number_format(cp,2)+'</b><br> Favor de revisar.', type: 'orange',theme:"dark",buttons: { b: {text: 'Aceptar',btnClass: 'btn-orange', action: function(r){ $("#preciop").focus()}}}});
				return 0;
			}				
			if(cp==0)
				$.confirm({ title: 'Sin costo promedio registrado',content: 'No se han realziado compras de este producto, revise las existencias antes de realizar la venta.', type: 'orange',theme:"dark",buttons: { b: {text: 'Aceptar',btnClass: 'btn-orange', action: function(r){}}}});
							
			if(cot.productos[cot.producto.id_producto]){				
				cot.productos[cot.producto.id_producto].cantidad += cot.producto.cantidad;	
				tot = (cot.productos[cot.producto.id_producto].cantidad * cot.productos[cot.producto.id_producto].precio);
				desc = (cot.productos[cot.producto.id_producto].descuento * tot) / 100 ;
				cot.productos[cot.producto.id_producto].total = tot ;
				cot.replaceFilaProducto(cot.productos[cot.producto.id_producto]);
			}else{
				cot.addFilaProducto(cot.producto);
			}
			cot.totalGeneral();	
			cot.clearForm();
		}else{
			toastr["warning"]("Seleccione antes un producto")
		}
	},	
	addFilaProducto:function(producto){				
		$("#prdCotTbl tbody").append(cot.getFilaProducto(producto));
		cot.productos[producto.id_producto] = producto;
		cot.setEditablesProducto(producto);
	},	
	replaceFilaProducto:function(producto){	
		$("#prtr"+producto.id_producto).remove();	
		$("#prdCotTbl tbody").append(cot.getFilaProducto(producto));
		cot.setEditablesProducto(producto);
	},
	
	getFilaProducto:function(producto){
		return '<tr id="prtr'+producto.id_producto+'" class="'+( producto.existencia < producto.cantidad && producto.um!='SERV' ? 'text-danger':'')+'"><td class="bold">'+producto.clave+'</td><td class="ellipsis-td" title="'+producto.concepto+'">'+producto.concepto+'</td><td class="bold right">'+(producto.um!='SERV' ? producto.existencia+' ':'')+producto.um+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'"> '+app.number_format(producto.cantidad,2)+'</a> '+(producto.um)+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">$ '+app.number_format(producto.precio,2)+'</a></td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">'+(producto.descuento)+' %</a></td><td class="bold right">$ '+app.number_format(producto.subtotal,2)+'</td><td class="bold right">$ '+app.number_format(producto.costo_promedio,2)+'</td><td class="bold right">$ '+app.number_format(producto.truput,2)+'</td><td class="bold right">$ '+app.number_format(producto.total,2)+'</td><td class="rmb-btn" ><button type="button" class="btn btn-danger" onclick="cot.quitar('+producto.id_producto+')"><i class="fa fa-times"></i></button></td>';
	},
	
	setEditablesProducto:function(cn){		
		$("#prtr"+cn.id_producto).find('td').eq(2).find('a').editable({type: 'text',title: 'Cantidad:',
            validate: function(value) {				    	
                if($.trim(value) == '') 
                    return 'Capture la cantidad.';						    
                vl = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
                if(!vl)
                      return 'Capture un valor numérico.';
                if(value<=0)
                      return 'La cantidad tiene que ser mayor a cero';	
            },
            value:parseFloat(parseFloat(cn.cantidad).toFixed(2)),
            display: function(value) { $(this).html(app.number_format(value,2));}, 
            success: function(response, newValue) {
                id = $(this).data('id');	    	
                cot.productos[id].cantidad = parseFloat(newValue);  
                cot.totalProducto(cot.productos[id]);
                cot.totalGeneral();
            }
        });
		$("#prtr"+cn.id_producto).find('td').eq(3).find('a').editable({type: 'text',title: 'Precio unitario:',
            validate: function(value) {						    	
                    if($.trim(value) == '') 
                        return 'Capture el valor del precio.';						    
                    vl = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
                    if(!vl)
                          return 'Capture un valor numérico.';
                    if(value<=0)
                          return 'El precio tiene que ser mayor a cero';		
            },
            value:parseFloat(parseFloat(cn.precio).toFixed(2)),
            display: function(value) { $(this).html('$ '+app.number_format(value,2));}, 
            success: function(response, newValue) {
                id = $(this).data('id');	    	
                cot.productos[id].precio = parseFloat(newValue);  
                cot.totalProducto(cot.productos[id]);
                cot.totalGeneral();
            }
        });        
        $("#prtr"+cn.id_producto).find('td').eq(4).find('a').editable({type: 'text', title: 'Descuento:',
            validate: function(value) {						    	
                    if($.trim(value) == '') 
                        return 'Capture el valor del descuento.';						    
                    vl = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
                    if(!vl)
                          return 'Capture un valor numerico.';
                    if(value<0)
                          return 'El descuento tiene que ser mayor o igual a cero';	
                     if(value>=100)
                          return 'El descuento tiene que menor a 100';		
                },
             value:parseFloat(parseFloat(cn.descuento).toFixed(2)),
            display: function(value) { $(this).html(app.number_format(value,2)+' %');},     
            success: function(response, newValue) {
                id = $(this).data('id');	    	
                cot.productos[id].descuento = parseFloat(newValue);  
                cot.totalProducto(cot.productos[id]);
                cot.totalGeneral();
            }
        });     
	},	
	quitar:function(id_producto){		
		delete cot.productos[id_producto];
		$("#prtr"+id_producto).remove();	
		cot.totalGeneral();		
		cot.clearForm();
	},	
	guardarCotizacion:function(o){	
		(Ladda.create(document.querySelector( '#nuevaCotizacion button.ladda-button' ))).start();			
		o.observaciones = $("#observaciones").val();
		o.condiciones = $("#condiciones").val();
		o.productos = cot.productos;
		o.subtotal = cot.total_descuento;
		o.total_descuento = cot.total_descuento_general; 
		o.iva = cot.iva;
		o.total = cot.total;		
		$.ajax({type : "POST",url : "guardarCotizacion",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),$('#nuevaCotizacion').modal('hide'),cot.clear()) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},	
	borrarCotizacion:function(o){
		$.confirm({ title: 'Borrar Cotizacion',content: '¿Esta seguro de querer borrar esta cotizacion?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la cotizacion, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarCotizacion",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),cot.clear()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},	
	exportDialog : function(t,f,type) {		
		$.confirm({ title: 'Membrete',content: 'Selecciona el membrete a utilizar en el documento', type: 'blue',theme:"dark",
		    buttons: {
		    	a: {text: 'Syscam',btnClass: 'btn-blue', action: function(r){ 
		        	cot.export(t,f,type,'mem_sys');
		        }},
		        b: {text: 'Elecnet',btnClass: 'btn-red', action: function(r){ 
		        	cot.export(t,f,type,'mem_ele');
		        }},c: {text: 'Cancelar',btnClass: 'btn-default'}		        
		    }
		});
	},
	export:function(t,f,type,m){
		$.ajax({type : "POST",url : type,dataType : "json",data :{id_cotizacion: t,membrete:m}})
		.done(function(a) {
			1 == a.status ? location.href = ('download?folio='+f+'&type='+type) :$.confirm({title: 'Sin resultados',icon: 'fa fa-warning',content: 'El reporte solicitado no generó ningún contenido',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-default',keys: ['enter']}}});
		}).fail(function(t, a, e) {
			 app.error(), console.log(t, a, e);
		});
	}
};