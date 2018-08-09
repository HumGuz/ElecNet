cmp = {
	id_sucursal:0,
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){cmp.nuevaCompraDialog({id_sucursal:cmp.id_sucursal})});
		$("#cmpTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,cmp[f](d)});
		$("#srchFrm").validation({success:function(o){$("#cmpTbl tbody").empty(),cmp.comprasTable(o)}});		
		strt = moment().subtract(6, 'days');
		end =  moment();
		cb =  function (start, end, lbl) {	      
	       	$("#srchFrm").find('#daterange-btn span').html('<b>'+lbl+'</b> del '+start.format('D MMMM YYYY') + ' al ' + end.format('D MMMM YYYY'));	        
	        $("#srchFrm").find("#fecha_inicial").val(start.format('YYYY-MM-DD'))
	        $("#srchFrm").find("#fecha_final").val(end.format('YYYY-MM-DD'))
	    };		
		$("#srchFrm").find('#daterange-btn').daterangepicker({locale:{format: 'YYYY-MM-DD'},startDate: strt,endDate: end,opens: "left",drops: "up",autoApply:true, ranges: { 'Hoy'       : [moment(), moment()],'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],'Este Mes'  : [moment().startOf('month'), moment().endOf('month')], 'Mes Anterior'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]}},cb);		 
		cb(strt,end,'Últimos 7 Días');		 
		$("#id_sucursal").change(function(){ cmp.id_sucursal =$(this).val(), cmp.clear()}).change()
	},
	clear:function(){
		$("#srchFrm").resetForm();		
		$("#cmpTbl tbody").empty();
		cmp.comprasTable({});
	},
	comprasTable:function(o){
		$(".overlay").show();
		o.id_sucursal = cmp.id_sucursal;
		$.ajax({type : "POST",url : "comprasTable",dataType : "html",data : o})
		.done(function(r) {
			$("#cmpTbl tbody").append(r),$(".overlay").hide();
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},	
	nuevaCompraDialog:function(o){	
		if(Object.keys(o).length && o.id_compra){
			cmp.nuevaCompra(o);
		}else{
			$.confirm({title : 'Nueva compra',icon : 'fa fa-question',content : '¿Registrara una compra basado en una orden de compra previamente registrada?',type : 'blue',theme : "dark",
				buttons : {
					a : {
						text : 'Registrar con orden de compra',btnClass : 'btn-blue',
						action :function(r){
							$.confirm({ title: 'Orden de compra',icon : 'fa fa-file-text',type : 'blue',theme : "dark",
							    content: '<form action="" class="formName"><div class="form-group"><label>Folio de orden de compra:</label><input type="text" placeholder="OCXXXXXX" class="form-control" required id="folioNC" /></div></form>',
							    buttons: {
							        formSubmit: {
							            text: 'Buscar Orden de compra', btnClass: 'btn-blue',
							            action: function () {							            	
							                var folio = $.trim(this.$content.find('#folioNC').val());
							                if(!folio){
							                    $.alert('Capture el folio');
							                    return false;
							                }else{								                								                	
							                	var rs;							                							                	
								               	$.ajax({type : "POST",url : "getFolioOrden",async:false,dataType : "json",data : {folio:folio}})
												.done(function(r) {rs = r;}).fail(function(e, t, i) {console.log(e, t, i); return false;});													
												if(rs.status==1){
													cmp.nuevaCompra({folio:folio,id_sucursal:cmp.id_sucursal})
												}else{
													$.alert({title: 'Folio',icon: 'fa fa-warning',content: 'El folio capturado no existe, favor de validarlo',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter'],action:function(){$("#folioNC").focus()}}}});
													return false
												}							                ;
							                }
							            }
							        },
							        cancelar: function () {},
							    },
							    onContentReady: function () {							     
							        var jc = this;
							        this.$content.find('form').on('submit', function (e) {e.preventDefault(); jc.$$formSubmit.trigger('click');});
							    }
							});
						},
					},
					b:{text : 'Compra directa',btnClass : 'btn-default',action :function(r){cmp.nuevaCompra(o)}},
					c:{text : 'Cancelar',btnClass : 'btn-default',}
				}
			});
		}
	},	
	
	nuevaCompra:function(o){
		cmp.producto = {},cmp.productos = {},cmp.productosDS = {},cmp.productosOC = {},cmp.orden={};
		$.ajax({type:"POST",url :  "nuevaCompra",dataType : "html",data:o}).done(function(r) {
			$('body').append(r),md = $('#nuevaCompra');			 
			md.modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});				
			md.find("#id_proveedor").change(function(){
				v = $(this).val();
				if(v!=''){
					$.ajax({type : "POST",url : "../productos/getProductosXProveedor",dataType : "json",data : {id_proveedor:v,id_sucursal:o.id_sucursal}})
					.done(function(r) {
						Object.keys(r).length ? cmp.autocomplete(r) : ( $('#clve_cmp').typeahead('destroy'), $('#conc_cmp').typeahead('destroy'), $.alert({title: 'Sin productos',icon: 'fa fa-warning',content: 'No hay productos para generar la compra',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}}) )  ;
					}).fail(function(e, t, i) {console.log(e, t, i)})
				}else{
					$("#prdCmpTbl").css('opacity',0).eq(0).find('body').empty(),cmp.productos = {},cmp.prdDtSt = [],cmp.keys = [],cmp.names = []
				}
			});				
			md.find(".selectpicker").selectpicker({});					
			md.find('#fecha_recepcion').daterangepicker({locale:{format: 'YYYY-MM-DD'},singleDatePicker: true, showDropdowns: true });			
			md.find('#clve_cmp').on('focusout',function(){event.preventDefault(),cmp.getCoincidence($(this).val(),cmp.keys)});		
			md.find('#conc_cmp').on('focusout',function(){event.preventDefault(),cmp.getCoincidence($(this).val(),cmp.names)});		
			md.find('#clve_cmp').keyup(function(){
				event.preventDefault(),
				(event.keyCode==13 && cmp.getCoincidence($(this).val(),cmp.keys)),
				(event.keyCode==27 && cmp.clearForm())														
			});		
			md.find('#conc_cmp').keyup(function(){
				event.preventDefault(),
				(event.keyCode==13 && cmp.getCoincidence($(this).val(),cmp.names)),
				(event.keyCode==27 && cmp.clearForm())				
			});
			md.find("#preciop,#cantidadp,#descuentop,#descuento_general,#costos_envio").keypress(function() {v = $(this).val();return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46;});		
			md.find("#descuento_general,#costos_envio").keyup(function() { 			
				vl = $(this).val();
				if(vl!='' && Object.keys(cmp.productos).length)
			    	cmp.totalGeneral();  				
			}); 			        
			md.find("#preciop").keyup(function() { 			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && cmp.clearForm())
				vl = $(this).val();
				if(vl!=''){cmp.producto.precio = parseFloat(vl),cmp.totalProducto()}
			});
			md.find("#cantidadp").keyup(function() {			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && cmp.clearForm())
				vl = $(this).val();
				if(vl!=''){cmp.producto.cantidad = parseFloat(vl),cmp.totalProducto()}
			});	
			md.find("#descuentop").keyup(function() {			
				(event.keyCode==13 && $("#add-btn").click()),
				(event.keyCode==27 && cmp.clearForm())
				vl = $(this).val();
				if(vl!=''){cmp.producto.descuento = parseFloat(vl),cmp.totalProducto()}
			});
			md.find("#add-btn").click(function(){cmp.addProducto()});
			md.find("#subtotal").html('$ 0.00'),$("#descuento").html('$ 0.00'),$("#iva").html('$ 0.00'),$("#total").html('$ 0.00');	
			md.find('#conc_cmp,#clve_cmp').off('blur');			
			md.find("#clsNO").click(function(){				
				if(Object.keys(cmp.productos).length)
					$.confirm({ title: 'Cerrar Nueva Compra',content: 'Hay productos cargados a la compra, al cerrar perdera los cambios ¿Decea Cerrar?', type: 'orange',theme:"dark",buttons: {a: {text: 'Cancelar'},b: {text: 'Cerrar',btnClass: 'btn-orange', action: function(r){md.modal('hide'); }} }});
				else
					md.modal('hide');
			});
			md.find("#gNO").click(function(){$("#nvaCmp").submit()});	
			o.id_orden_compra = 0;	
			
			rls = {factura:{remote:{ url: "facturaUnica",type: "POST",data: {factura: function() {return $.trim(md.find( "#factura" ).val())}}}}};
					
			if(o && o.id_compra){				
				s = $('#nuevaCompra .modal-content').data();
				for(i in s)
					(md.find("#"+i).length && md.find("#"+i).val(s[i]));					
				for(p in cmp.productosDS)
					pr = cmp.productosDS[p], pr.cantidad = parseFloat(pr.cantidad), pr.descuento = parseFloat(pr.descuento), pr.precio = parseFloat(pr.precio), pr.subtotal = parseFloat(pr.subtotal), pr.total = parseFloat(pr.total),cmp.addFilaProducto(pr);					
				cmp.totalGeneral(),md.find( "#factura" ).attr('disabled','disabled'),
				md.find("#id_proveedor").change(),rls={};				
			}else if(!o.id_compra && o.folio){
				o.id_orden_compra = cmp.orden.id_orden_compra;
				delete o.folio;
				md.find("#id_proveedor").val(cmp.orden.id_proveedor);
				md.find("#id_proveedor").attr('disabled','disabled');				
				md.find("#id_proveedor").change();
				md.find("#descuento_general").val(cmp.orden.descuento_general);
				for(p in cmp.productosOC)
					pr = cmp.productosOC[p], pr.cantidad = parseFloat(pr.cantidad), pr.descuento = parseFloat(pr.descuento), pr.precio = parseFloat(pr.precio), pr.subtotal = parseFloat(pr.subtotal), pr.total = parseFloat(pr.total),cmp.addFilaProducto(cmp.productosOC[p]);					
				cmp.totalGeneral()
			}			
			md.find("#nvaCmp").validation({rules:rls,messages:{factura:{remote:"Esta factura ya fue capturada"}},extend:o,success:function(ob){
				if(!Object.keys(cmp.productos).length){
						$.confirm({ title: 'Sin productos',content: 'No hay productos cargados a la compra', type: 'orange',theme:"dark",buttons: {a: {text: 'Aceptar',btnClass: 'btn-orange'} }});
				}else				
					cmp.guardarCompra(ob)
			}});
			md.find(".selectpicker").selectpicker('refresh');				
		});
	},	
	 
	autocomplete:function(prdDtSt) {
		cmp.prdDtSt = [];
		cmp.keys = [];
		cmp.names = [];
		if (prdDtSt.length) 
			for ( i = 0; i < prdDtSt.length; i++) 
				c = prdDtSt[i],cmp.keys.push($.trim(c.clave.toLowerCase())),cmp.names.push($.trim(c.concepto.toLowerCase()));		
		var keys = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.clave);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		keys.initialize();
		$('#clve_cmp').typeahead(null, {displayKey : 'clave',hint : true,source : keys.ttAdapter()});
		var names = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.concepto);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		names.initialize();
		$('#conc_cmp').typeahead(null, {displayKey : 'concepto',hint : true,source : names.ttAdapter()});
		cmp.prdDtSt = prdDtSt;
		$("#prdCmpTbl").css('opacity',1)
	},
	
	clearForm:function(){
    	cmp.producto = {};
    	$('#conc_cmp').typeahead('val', '');  
    	$('#clve_cmp').typeahead('val', '');      			
    	$("#preciop").val(''); 
    	$("#umc").text('---');    	
    	$("#cantidadp").val(''); 
    	$("#totalp").html('--');    	
    	$("#descuentop").val(0);	     
    	$('#clve_cmp').focus(); 
    	$("input.form-control.tt-hint.ignore").val('');
    	$("input.form-control.ignore.tt-hint").val('');
    },	
	getCoincidence:function(val,dataSet){
    	$("span.tt-dropdown-menu").hide(); 	
    	val = $.trim(val).toLowerCase();
		if(val!=''){
			index = dataSet.indexOf(val);
			coin = $.extend({},cmp.prdDtSt[ index ]);				
			cmp.setPrdData(coin);
            cmp.totalProducto();
		}
    },
    
	setPrdData:function(dat){
    	if(dat){    		
    		$('#clve_cmp').val(dat.clave);    		
    		$('#conc_cmp').val(dat.concepto);     		
    		$("#umc").text(dat.um);		
    		if(cmp.productos[dat.id_producto] )	           	
	           	dat.precio = cmp.productos[dat.id_producto].precio;
	    	$("#preciop").val(dat.precio);    		 		   		
    		$("#cantidadp").focus();
    		$("#descuentop").val(dat.descuento);   
    		dat.descuento =  !dat.descuento ? 0 : dat.descuento;    		
            cmp.producto = $.extend({},dat);
    		delete dat;	
    	}else{
    		cmp.producto = {};
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
				p.iva = p.subtotal * 0.16;
				p.total =  p.subtotal * 1.16;				
				$("#prtr"+p.id_producto).find('td').eq(5).html('$ ' + app.number_format(p.subtotal,2));				
			} else {
				$("#totalp").html('$ 0.00');
			}
    	}else{
    		v = cmp.producto.cantidad;
			if (Object.keys(cmp.producto).length && !isNaN(v) && v > 0) {						
				cmp.producto.subtotal =  cmp.producto.cantidad * cmp.producto.precio;
				cmp.producto.total_descuento = (cmp.producto.descuento * cmp.producto.subtotal) / 100;
				cmp.producto.subtotal -=cmp.producto.total_descuento
				cmp.producto.iva = cmp.producto.subtotal * 0.16;
				cmp.producto.total =  cmp.producto.subtotal * 1.16;
				$("#totalp").html('$ ' + app.number_format(cmp.producto.subtotal,2));
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
    	cmp.subtotal = 0; 
    	cmp.total_descuento = 0;
    	cmp.subtotal_descuento = 0; 
    	cmp.iva = 0;
    	cmp.total = 0; 
    	dsc = parseFloat(dsc);  
        for( producto in cmp.productos ) {        	
        	cmp.totalProducto(cmp.productos[ producto ]);
        	cmp.subtotal += cmp.productos[ producto ].subtotal; 
        }  
        cmp.total_descuento = dsc *  cmp.subtotal / 100; 
		cmp.subtotal_descuento = cmp.subtotal - cmp.total_descuento;
		env = $.trim($("#costos_envio").val()), env = ( env !=''? parseFloat(env) :0 ),
        (env == 0 && $("#costos_envio").val(0)),		
		cmp.iva = (cmp.subtotal_descuento + env) * 0.16;
		cmp.total = (cmp.subtotal_descuento + env) * 1.16;
        $("#subtotal").html('$ ' + app.number_format(cmp.subtotal,2));	
		$("#descuento").html('$ ' + app.number_format(cmp.total_descuento,2));
		$("#subtotal_descuento").html('$ ' + app.number_format(cmp.subtotal_descuento,2));
		$("#envio").html('$ ' + app.number_format(env,2));	    
    	$("#iva").html('$ ' + app.number_format(cmp.iva,2)); 
    	$("#total").html('$ ' + app.number_format(cmp.total,2)); 	    	
    },
	addProducto:function(){		
		if(Object.keys(cmp.producto).length){
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
			if(cmp.productos[cmp.producto.id_producto]){				
				cmp.productos[cmp.producto.id_producto].cantidad += cmp.producto.cantidad;	
				tot = (cmp.productos[cmp.producto.id_producto].cantidad * cmp.productos[cmp.producto.id_producto].precio);
				desc = (cmp.productos[cmp.producto.id_producto].descuento * tot) / 100 ;
				cmp.productos[cmp.producto.id_producto].total = tot ;
				cmp.replaceFilaProducto(cmp.productos[cmp.producto.id_producto]);
			}else{
				cmp.addFilaProducto(cmp.producto);
			}
			cmp.totalGeneral();	
			cmp.clearForm();
		}else{
			toastr["warning"]("Seleccione antes un producto")
		}
	},
	
	addFilaProducto:function(producto){				
		$("#prdCmpTbl tbody").append(cmp.getFilaProducto(producto));
		cmp.productos[producto.id_producto] = producto;
		cmp.setEditablesProducto(producto);
	},
	
	replaceFilaProducto:function(producto){	
		$("#prtr"+producto.id_producto).remove();	
		$("#prdCmpTbl tbody").append(cmp.getFilaProducto(producto));
		cmp.setEditablesProducto(producto);
	},
	
	getFilaProducto:function(producto){
		return '<tr id="prtr'+producto.id_producto+'"><td class="bold">'+producto.clave+'</td><td class="ellipsis-td" title="'+producto.concepto+'">'+producto.concepto+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'"> '+app.number_format(producto.cantidad,2)+'</a> '+(producto.um)+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">$ '+app.number_format(producto.precio,2)+'</a></td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">'+(producto.descuento)+' %</a></td><td class="bold right">$ '+app.number_format(producto.total,2)+'</td><td class="rmb-btn" ><button type="button" class="btn btn-danger" onclick="cmp.quitar('+producto.id_producto+')"><i class="fa fa-times"></i></button></td>';
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
                cmp.productos[id].cantidad = parseFloat(newValue);  
                cmp.totalProducto(cmp.productos[id]);
                cmp.totalGeneral();
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
                cmp.productos[id].precio = parseFloat(newValue);  
                cmp.totalProducto(cmp.productos[id]);
                cmp.totalGeneral();
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
                cmp.productos[id].descuento = parseFloat(newValue);  
                cmp.totalProducto(cmp.productos[id]);
                cmp.totalGeneral();
            }
        });     
	},
	
	quitar:function(id_producto){		
		delete cmp.productos[id_producto];
		$("#prtr"+id_producto).remove();	
		cmp.totalGeneral();		
		cmp.clearForm();
	},
	
	guardarCompra:function(o){		
		(Ladda.create(document.querySelector( '#nuevaCompra button.ladda-button' ))).start();		
		o.observaciones = $("#observaciones").val();
		o.productos = cmp.productos;
		o.subtotal = cmp.subtotal_descuento;
		o.total_descuento = cmp.total_descuento; 
		o.iva = cmp.iva;
		o.total = cmp.total;		
		console.log(o);				
		$.ajax({type : "POST",url : "guardarCompra",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),$('#nuevaCompra').modal('hide'),cmp.clear()) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	
	borrarCompra:function(o){
		$.confirm({ title: 'Borrar Compra',content: '¿Esta seguro de querer borrar esta compra?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la compra, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarCompra",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),cmp.clear()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},
	
	export : function(t,type) {
		$.ajax({type : "POST",url : type,dataType : "json",data :{id_compra: t}})
		.done(function(a) {
			1 == a.status ? window.open("application/files/" + a.folio + '.'+type, "_blank") :$.confirm({title: 'Sin resultados',icon: 'fa fa-warning',content: 'El reporte solicitado no generó ningún contenido',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-default',keys: ['enter']}}});
		}).fail(function(t, a, e) {
			 app.error(), console.log(t, a, e);
		});
	},

};