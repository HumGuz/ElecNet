ord = {
	id_sucursal:0,
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){ord.nuevaOrden({id_sucursal:ord.id_sucursal})});
		$("#ordTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,ord[f](d)});
		$("#srchFrm").validation({success:function(o){$("#ordTbl tbody").empty(),ord.ordenesTable(o)}});	
		app.dateRangeFilter();	
		$("#id_sucursal").change(function(){ ord.id_sucursal =$(this).val(), ord.clear()}).change()
	},
	clear:function(){
		$("#srchFrm").resetForm();		
		$("#ordTbl tbody").empty();
		ord.ordenesTable({});
	},
	ordenesTable:function(o){
		$(".overlay").show();
		o.id_sucursal = ord.id_sucursal;
		$.ajax({type : "POST",url : "ordenesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#ordTbl tbody").append(r),$(".overlay").hide();
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevaOrden:function(o){
		ord.producto = {},ord.productos = {},ord.productosDS = {};
		$.ajax({type:"POST",url :  "nuevaOrden",dataType : "html",data:o}).done(function(r) {
			$('body').append(r),ord.producto = {},ord.productos = {},md = $('#nuevaOrden');			 
			md.modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});					
			md.find("#id_proveedor").change(function(){
				v = $(this).val();
				if(v!=''){
					$.ajax({type : "POST",url : "../productos/getProductosXProveedor",dataType : "json",data : {id_proveedor:v,id_sucursal:o.id_sucursal}})
					.done(function(r) {
						Object.keys(r).length ? ord.autocomplete(r) : ( $('#clve_ord').typeahead('destroy'), $('#conc_ord').typeahead('destroy'), $.alert({title: 'Sin productos',icon: 'fa fa-warning',content: 'No hay productos para generar la orden',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}}) )  ;
					}).fail(function(e, t, i) {console.log(e, t, i)})
				}else{
					$("#prdOrdTbl").css('opacity',0).eq(0).find('body').empty(),ord.productos = {},ord.prdDtSt = [],ord.keys = [],ord.names = []
				}
			});
			md.find(".selectpicker").selectpicker({});					
			md.find('#fecha_vencimiento').daterangepicker({locale:{format: 'YYYY-MM-DD'},singleDatePicker: true, showDropdowns: true });			
			md.find('#clve_ord').on('focusout',function(){event.preventDefault(),ord.getCoincidence($(this).val(),ord.keys)});		
			md.find('#conc_ord').on('focusout',function(){event.preventDefault(),ord.getCoincidence($(this).val(),ord.names)});		
			md.find('#clve_ord').keyup(function(){
				event.preventDefault(),
				(event.keyCode==13 && ord.getCoincidence($(this).val(),ord.keys)),
				(event.keyCode==27 && ord.clearForm())														
			});		
			md.find('#conc_ord').keyup(function(){
				event.preventDefault(),
				(event.keyCode==13 && ord.getCoincidence($(this).val(),ord.names)),
				(event.keyCode==27 && ord.clearForm())				
			});
			md.find("#preciop,#cantidadp,#descuentop,#descuento_general,#gastos_envio").keypress(function() {v = $(this).val();return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46;});		
			md.find("#descuento_general").keyup(function() { 			
				vl = $(this).val();
				if(vl!='' && Object.keys(ord.productos).length)
			    	ord.totalGeneral();  				
			}); 
			md.find("#gastos_envio").keyup(function() { 			
				vl = $(this).val();
				if(vl!='' && Object.keys(ord.productos).length)
			    	ord.totalGeneral();  				
			});           
			md.find("#preciop").keyup(function() { 			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && ord.clearForm())
				vl = $(this).val();
				if(vl!=''){ord.producto.precio = parseFloat(vl),ord.totalProducto()}
			});
			md.find("#cantidadp").keyup(function() {			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && ord.clearForm())
				vl = $(this).val();
				if(vl!=''){ord.producto.cantidad = parseFloat(vl),ord.totalProducto()}
			});	
			md.find("#descuentop").keyup(function() {			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && ord.clearForm())
				vl = $(this).val();
				if(vl!=''){ord.producto.descuento = parseFloat(vl),ord.totalProducto()}
			});
			md.find("#add-btn").click(function(){ord.addProducto()});
			md.find("#subtotal").html('$ 0.00'),$("#descuento").html('$ 0.00'),$("#iva").html('$ 0.00'),$("#total").html('$ 0.00');	
			md.find('#conc_ord,#clve_ord').off('blur');
			md.find("#nvaOrd").validation({extend:o,success:function(ob){
				if(!Object.keys(ord.productos).length){
						$.confirm({ title: 'Sin productos',content: 'No hay productos cargados a la orden', type: 'orange',theme:"dark",buttons: {a: {text: 'Aceptar',btnClass: 'btn-orange'} }});
				}else				
					ord.guardarOrden(ob)
			}});
			md.find("#clsNO").click(function(){				
				if(Object.keys(ord.productos).length)
					$.confirm({ title: 'Cerrar Nueva Orden de compra',content: 'Hay productos cargados a la orden, al cerrar perdera los cambios ¿Decea Cerrar?', type: 'orange',theme:"dark",buttons: {a: {text: 'Cancelar'},b: {text: 'Cerrar',btnClass: 'btn-orange', action: function(r){md.modal('hide'); }} }});
				else
					md.modal('hide');
			});
			md.find("#gNO").click(function(){$("#nvaOrd").submit()});			
			if(o && o.id_orden_compra){				
				s = $('#nuevaOrden .modal-content').data();
				for(i in s)
					(md.find("#"+i).length && md.find("#"+i).val(s[i]));					
				for(p in ord.productosDS)
					pr = ord.productosDS[p], pr.cantidad = parseFloat(pr.cantidad), pr.descuento = parseFloat(pr.descuento), pr.precio = parseFloat(pr.precio), pr.subtotal = parseFloat(pr.subtotal), pr.total = parseFloat(pr.total),ord.addFilaProducto(pr);					
				ord.totalGeneral(),md.find("#id_proveedor").change(),md.find("#id_proveedor").selectpicker('refresh');
			}	
			
		});
	},	
	 
	autocomplete:function(prdDtSt) {
		ord.prdDtSt = [];
		ord.keys = [];
		ord.names = [];
		if (prdDtSt.length) 
			for ( i = 0; i < prdDtSt.length; i++) 
				c = prdDtSt[i],ord.keys.push($.trim(c.clave.toLowerCase())),ord.names.push($.trim(c.concepto.toLowerCase()));		
		var keys = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.clave);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		keys.initialize();
		$('#clve_ord').typeahead(null, {displayKey : 'clave',hint : true,source : keys.ttAdapter()});
		var names = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.concepto);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		names.initialize();
		$('#conc_ord').typeahead(null, {displayKey : 'concepto',hint : true,source : names.ttAdapter()});
		ord.prdDtSt = prdDtSt;
		$("#prdOrdTbl").css('opacity',1)
	},
	
	clearForm:function(){
    	ord.producto = {};
    	$('#conc_ord').typeahead('val', '');  
    	$('#clve_ord').typeahead('val', '');      			
    	$("#preciop").val(''); 
    	$("#umc").text('---');    	
    	$("#cantidadp").val(''); 
    	$("#totalp").html('--');    	
    	$("#descuentop").val(0);	     
    	$('#clve_ord').focus(); 
    	$("input.form-control.tt-hint.ignore").val('');
    	$("input.form-control.ignore.tt-hint").val('');
    },
	
	getCoincidence:function(val,dataSet){
    	$("span.tt-dropdown-menu").hide(); 	
    	val = $.trim(val).toLowerCase();
		if(val!=''){
			index = dataSet.indexOf(val);
			coin = $.extend({},ord.prdDtSt[ index ]);				
			ord.setPrdData(coin);
            ord.totalProducto();
		}
    },
    
	setPrdData:function(dat){
    	if(dat){    		
    		$('#clve_ord').val(dat.clave);    		
    		$('#conc_ord').val(dat.concepto);     		
    		$("#umc").text(dat.um);		
    		if(ord.productos[dat.id_producto] )	           	
	           	dat.precio = ord.productos[dat.id_producto].precio;
	    	$("#preciop").val(dat.precio);    		 		   		
    		$("#cantidadp").focus();
    		$("#descuentop").val(dat.descuento);   
    		dat.descuento =  !dat.descuento ? 0 : dat.descuento;        		
            ord.producto = $.extend({},dat);
    		delete dat;	
    	}else{
    		ord.producto = {};
    		toastr["warning"]("Producto no encontrado");
    	}
    },
    
    totalProducto:function(p) {    	
    	if(p){
    		v = p.cantidad;
			if (Object.keys(p).length && !isNaN(v) && v > 0) {						
				p.subtotal = (p.cantidad * p.precio);
				p.total = (p.subtotal - ((p.descuento * p.subtotal) / 100));				
				$("#prtr"+p.id_producto).find('td').eq(5).html('$ ' + app.number_format(p.total,2));				
			} else {
				$("#totalp").html('$ 0.00');
			}
    	}else{
    		v = ord.producto.cantidad;
			if (Object.keys(ord.producto).length && !isNaN(v) && v > 0) {						
				ord.producto.subtotal = (ord.producto.cantidad * ord.producto.precio);
				ord.producto.total = (ord.producto.subtotal - ((ord.producto.descuento * ord.producto.subtotal) / 100));
				$("#totalp").html('$ ' + app.number_format(ord.producto.total,2));
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
    	ord.subtotal = 0; 
    	dsc = parseFloat(dsc);       
        ord.total = 0;      
        for( producto in ord.productos )        	
        	ord.subtotal += parseFloat(ord.productos[ producto ].total); 
        ord.subtotal += parseFloat($("#gastos_envio").val());
        ord.total_descuento_general = dsc *  ord.subtotal / 100; 			
		ord.total_descuento = ord.subtotal - ord.total_descuento_general;
		ord.iva = ord.total_descuento*0.16;
		ord.total = ord.iva + ord.total_descuento;	       
        $("#subtotal").html('$ ' + app.number_format(ord.subtotal,2));	
		$("#descuento").html('$ ' + app.number_format(ord.descuento_general,2));	    
    	$("#iva").html('$ ' + app.number_format(ord.iva,2)); 
    	$("#total").html('$ ' + app.number_format(ord.total,2)); 	    	
    },	  
	
	addProducto:function(){		
		if(Object.keys(ord.producto).length){
			c = parseFloat($.trim($("#cantidadp").val())),
			p = parseFloat($.trim($("#preciop").val())),
			d = parseFloat($.trim($("#descuentop").val()));						
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
			if(ord.productos[ord.producto.id_producto]){				
				ord.productos[ord.producto.id_producto].cantidad += ord.producto.cantidad;	
				tot = (ord.productos[ord.producto.id_producto].cantidad * ord.productos[ord.producto.id_producto].precio);
				desc = (ord.productos[ord.producto.id_producto].descuento * tot) / 100 ;
				ord.productos[ord.producto.id_producto].total = tot ;
				ord.replaceFilaProducto(ord.productos[ord.producto.id_producto]);
			}else{
				ord.addFilaProducto(ord.producto);
			}
			ord.totalGeneral();	
			ord.clearForm();
		}else{
			toastr["warning"]("Seleccione antes un producto")
		}
	},
	
	addFilaProducto:function(producto){				
		$("#prdOrdTbl tbody").append(ord.getFilaProducto(producto));
		ord.setEditablesProducto(producto);
		ord.productos[producto.id_producto] = producto;
	},
	
	replaceFilaProducto:function(producto){	
		$("#prtr"+producto.id_producto).remove();	
		$("#prdOrdTbl tbody").append(ord.getFilaProducto(producto));
		ord.setEditablesProducto(producto);
	},
	
	getFilaProducto:function(producto){
		return '<tr id="prtr'+producto.id_producto+'"><td class="bold">'+producto.clave+'</td><td class="ellipsis-td" title="'+producto.concepto+'">'+producto.concepto+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'"> '+app.number_format(producto.cantidad,2)+'</a> '+(producto.um)+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">$ '+app.number_format(producto.precio,2)+'</a></td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">'+(producto.descuento)+' %</a></td><td class="bold right">$ '+app.number_format(producto.total,2)+'</td><td class="rmb-btn" ><button type="button" class="btn btn-danger" onclick="ord.quitar('+producto.id_producto+')"><i class="fa fa-times"></i></button></td>';
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
                ord.productos[id].cantidad = parseFloat(newValue);  
                ord.totalProducto(ord.productos[id]);
                ord.totalGeneral();
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
                ord.productos[id].precio = parseFloat(newValue);  
                ord.totalProducto(ord.productos[id]);
                ord.totalGeneral();
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
                ord.productos[id].descuento = parseFloat(newValue);  
                ord.totalProducto(ord.productos[id]);
                ord.totalGeneral();
            }
        });     
	},
	
	quitar:function(id_producto){		
		delete ord.productos[id_producto];
		$("#prtr"+id_producto).remove();	
		ord.totalGeneral();		
		ord.clearForm();
	},
	
	guardarOrden:function(o){	
		(Ladda.create(document.querySelector( '#nuevaOrden button.ladda-button' ))).start();			
		o.observaciones = $("#observaciones").val();
		o.productos = ord.productos;
		o.subtotal = ord.total_descuento;
		o.total_descuento = ord.total_descuento_general; 
		o.iva = ord.iva;
		o.total = ord.total;
		$.ajax({type : "POST",url : "guardarOrden",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),$('#nuevaOrden').modal('hide'),ord.clear()) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarOrden:function(o){
		$.confirm({ title: 'Borrar Orden de compra',content: '¿Esta seguro de querer borrar esta orden de compra?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la orden, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarOrden",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),ord.clear()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},
	
	export : function(t,f,type) {
		$.ajax({type : "POST",url : type,dataType : "json",data :{id_orden_compra: t}})
		.done(function(a) {
			1 == a.status ? location.href = ('download?folio='+f+'&type='+type) :$.confirm({title: 'Sin resultados',icon: 'fa fa-warning',content: 'El reporte solicitado no generó ningún contenido',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-default',keys: ['enter']}}});
			 // window.open('download?id_orden_compra='+t+'&type='+type, "_blank")
		}).fail(function(t, a, e) {
			 app.error(), console.log(t, a, e);
		});
	},

};
