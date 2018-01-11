vnt = {
	id_sucursal:0,
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){vnt.nuevaVentaDialog({id_sucursal:vnt.id_sucursal})});
		$("#vntTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,vnt[f](d)});
		$("#srchFrm").validation({success:function(o){$("#vntTbl tbody").empty(),vnt.ventasTable(o)}});		
		strt = moment().subtract(6, 'days');
		end =  moment();
		cb =  function (start, end, lbl) {	      
	       	$("#srchFrm").find('#daterange-btn span').html('<b>'+lbl+'</b> del '+start.format('D MMMM YYYY') + ' al ' + end.format('D MMMM YYYY'));	        
	        $("#srchFrm").find("#fecha_inicial").val(start.format('YYYY-MM-DD'))
	        $("#srchFrm").find("#fecha_final").val(start.format('YYYY-MM-DD'))
	    };		
		$("#srchFrm").find('#daterange-btn').daterangepicker({locale:{format: 'YYYY-MM-DD'},startDate: strt,endDate: end,opens: "left",drops: "up",autoApply:true, ranges: { 'Hoy'       : [moment(), moment()],'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],'Este Mes'  : [moment().startOf('month'), moment().endOf('month')], 'Mes Anterior'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]}},cb);		 
		cb(strt,end,'Últimos 7 Días');		 
		$("#id_sucursal").change(function(){ vnt.id_sucursal =$(this).val(), vnt.clear()})
		 vnt.id_sucursal =$("#id_sucursal").val(),vnt.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();		
		$("#vntTbl tbody").empty();
		vnt.ventasTable({});
	},
	ventasTable:function(o){
		o.id_sucursal = vnt.id_sucursal;
		$.ajax({type : "POST",url : "ventasTable",dataType : "html",data : o})
		.done(function(r) {
			$("#vntTbl tbody").append(r);
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},	
	nuevaVentaDialog:function(o){	
		if(Object.keys(o).length){
			vnt.nuevaVenta(o);
		}else{
			$.confirm({title : 'Nueva venta',icon : 'fa fa-question',content : '¿Registrara una venta basado en una orden de venta previamente registrada?',type : 'blue',theme : "dark",
				buttons : {
					a : {
						text : 'Registrar con orden de venta',btnClass : 'btn-blue',
						action :function(r){
							$.confirm({ title: 'Orden de venta',icon : 'fa fa-file-text',type : 'blue',theme : "dark",
							    content: '<form action="" class="formName"><div class="form-group"><label>Folio de orden de venta:</label><input type="text" placeholder="OCXXXXXX" class="form-control" required id="folioNC" /></div></form>',
							    buttons: {
							        formSubmit: {
							            text: 'Buscar Orden de venta', btnClass: 'btn-blue',
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
													vnt.nuevaVenta({folio:folio,id_sucursal:vnt.id_sucursal})
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
					b:{text : 'Venta directa',btnClass : 'btn-default',action :function(r){vnt.nuevaVenta(o)}},
					c:{text : 'Cancelar',btnClass : 'btn-default',}
				}
			});
		}
	},	
	
	nuevaVenta:function(o){
		vnt.producto = {},vnt.productos = {},vnt.productosDS = {},vnt.productosOC = {},vnt.orden={};
		$.ajax({type:"POST",url :  "nuevaVenta",dataType : "html",data:o}).done(function(r) {
			$('body').append(r),md = $('#nuevaVenta');			 
			md.modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});				
			md.find("#id_proveedor").change(function(){
				v = $(this).val();
				if(v!=''){
					$.ajax({type : "POST",url : "../productos/getProductosXProveedor",dataType : "json",data : {id_proveedor:v,id_sucursal:o.id_sucursal}})
					.done(function(r) {
						Object.keys(r).length ? vnt.autocomplete(r) : ( $('#clve_vnt').typeahead('destroy'), $('#conc_vnt').typeahead('destroy'), $.alert({title: 'Sin productos',icon: 'fa fa-warning',content: 'No hay productos para generar la venta',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}}) )  ;
					}).fail(function(e, t, i) {console.log(e, t, i)})
				}else{
					$("#prdVntTbl").css('opacity',0).eq(0).find('body').empty(),vnt.productos = {},vnt.prdDtSt = [],vnt.keys = [],vnt.names = []
				}
			});				
			md.find(".selectpicker").selectpicker({});					
			md.find('#fecha_recepcion').daterangepicker({locale:{format: 'YYYY-MM-DD'},singleDatePicker: true, showDropdowns: true });			
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
			md.find("#preciop,#cantidadp,#descuentop,#descuento_general").keypress(function() {v = $(this).val();return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46;});		
			md.find("#descuento_general").keyup(function() { 			
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
			md.find("#add-btn").click(function(){vnt.addProducto()});
			md.find("#subtotal").html('$ 0.00'),$("#descuento").html('$ 0.00'),$("#iva").html('$ 0.00'),$("#total").html('$ 0.00');	
			md.find('#conc_vnt,#clve_vnt').off('blur');			
			md.find("#clsNO").click(function(){				
				if(Object.keys(vnt.productos).length)
					$.confirm({ title: 'Cerrar Nueva Venta',content: 'Hay productos cargados a la venta, al cerrar perdera los cambios ¿Decea Cerrar?', type: 'orange',theme:"dark",buttons: {a: {text: 'Cancelar'},b: {text: 'Cerrar',btnClass: 'btn-orange', action: function(r){md.modal('hide'); }} }});
				else
					md.modal('hide');
			});
			md.find("#gNO").click(function(){$("#nvaVnt").submit()});	
			o.id_orden_venta = 0;	
			
			rls = {factura:{remote:{ url: "facturaUnica",type: "POST",data: {factura: function() {return $.trim(md.find( "#factura" ).val())}}}}};
					
			if(o && o.id_venta){				
				s = $('#nuevaVenta .modal-content').data();
				for(i in s)
					(md.find("#"+i).length && md.find("#"+i).val(s[i]));					
				for(p in vnt.productosDS)
					pr = vnt.productosDS[p], pr.cantidad = parseFloat(pr.cantidad), pr.descuento = parseFloat(pr.descuento), pr.precio = parseFloat(pr.precio), pr.subtotal = parseFloat(pr.subtotal), pr.total = parseFloat(pr.total),vnt.addFilaProducto(vnt.productosDS[p]);					
				vnt.totalGeneral(),md.find( "#factura" ).attr('disabled','disabled'),
				md.find("#id_proveedor").change(),rls={};				
			}else if(!o.id_venta && o.folio){
				o.id_orden_venta = vnt.orden.id_orden_venta;
				delete o.folio;
				md.find("#id_proveedor").val(vnt.orden.id_proveedor);
				md.find("#id_proveedor").attr('disabled','disabled');				
				md.find("#id_proveedor").change();
				md.find("#descuento_general").val(vnt.orden.descuento_general);
				for(p in vnt.productosOC)
					pr = vnt.productosOC[p], pr.cantidad = parseFloat(pr.cantidad), pr.descuento = parseFloat(pr.descuento), pr.precio = parseFloat(pr.precio), pr.subtotal = parseFloat(pr.subtotal), pr.total = parseFloat(pr.total),vnt.addFilaProducto(vnt.productosOC[p]);					
				vnt.totalGeneral()
			}			
			md.find("#nvaVnt").validation({rules:rls,messages:{factura:{remote:"Esta factura ya fue capturada"}},extend:o,success:function(ob){
				if(!Object.keys(vnt.productos).length){
						$.confirm({ title: 'Sin productos',content: 'No hay productos cargados a la venta', type: 'orange',theme:"dark",buttons: {a: {text: 'Aceptar',btnClass: 'btn-orange'} }});
				}else				
					vnt.guardarVenta(ob)
			}});
			md.find(".selectpicker").selectpicker('refresh');				
		});
	},	
	 
	autocomplete:function(prdDtSt) {
		vnt.prdDtSt = [];
		vnt.keys = [];
		vnt.names = [];
		if (prdDtSt.length) 
			for ( i = 0; i < prdDtSt.length; i++) 
				c = prdDtSt[i],vnt.keys.push($.trim(c.clave.toLowerCase())),vnt.names.push($.trim(c.concepto.toLowerCase()));		
		var keys = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.clave);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		keys.initialize();
		$('#clve_vnt').typeahead(null, {displayKey : 'clave',hint : true,source : keys.ttAdapter()});
		var names = new Bloodhound({datumTokenizer : function(d) {return Bloodhound.tokenizers.whitespace(d.concepto);},queryTokenizer : Bloodhound.tokenizers.whitespace,local : prdDtSt});
		names.initialize();
		$('#conc_vnt').typeahead(null, {displayKey : 'concepto',hint : true,source : names.ttAdapter()});
		vnt.prdDtSt = prdDtSt;
		$("#prdVntTbl").css('opacity',1)
	},
	
	clearForm:function(){
    	vnt.producto = {};
    	$('#conc_vnt').typeahead('val', '');  
    	$('#clve_vnt').typeahead('val', '');      			
    	$("#preciop").val(''); 
    	$("#umc").text('---');    	
    	$("#cantidadp").val(''); 
    	$("#totalp").html('--');    	
    	$("#descuentop").val(0);	     
    	$('#clve_vnt').focus(); 
    	$("input.form-control.tt-hint.ignore").val('');
    	$("input.form-control.ignore.tt-hint").val('');
    },	
	getCoincidence:function(val,dataSet){
    	$("span.tt-dropdown-menu").hide(); 	
    	val = $.trim(val).toLowerCase();
		if(val!=''){
			index = dataSet.indexOf(val);
			coin = $.extend({},vnt.prdDtSt[ index ]);				
			vnt.setPrdData(coin);
            vnt.totalProducto();
		}
    },
    
	setPrdData:function(dat){
    	if(dat){    		
    		$('#clve_vnt').val(dat.clave);    		
    		$('#conc_vnt').val(dat.concepto);     		
    		$("#umc").text(dat.um);		
    		if(vnt.productos[dat.id_producto] )	           	
	           	dat.precio = vnt.productos[dat.id_producto].precio;
	    	$("#preciop").val(dat.precio);    		 		   		
    		$("#cantidadp").focus();
    		$("#descuentop").val(dat.descuento);   
    		dat.descuento =  !dat.descuento ? 0 : dat.descuento;    		
            vnt.producto = $.extend({},dat);
    		delete dat;	
    	}else{
    		vnt.producto = {};
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
    		v = vnt.producto.cantidad;
			if (Object.keys(vnt.producto).length && !isNaN(v) && v > 0) {						
				vnt.producto.subtotal = (vnt.producto.cantidad * vnt.producto.precio);
				vnt.producto.total = (vnt.producto.subtotal - ((vnt.producto.descuento * vnt.producto.subtotal) / 100));
				$("#totalp").html('$ ' + app.number_format(vnt.producto.total,2));
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
    	vnt.subtotal = 0; 
    	dsc = parseFloat(dsc);       
        vnt.total = 0;      
        for( producto in vnt.productos )        	
        	vnt.subtotal += vnt.productos[ producto ].total;        
        vnt.total_descuento_general = dsc *  vnt.subtotal / 100; 			
		vnt.total_descuento = vnt.subtotal - vnt.total_descuento_general;
		vnt.iva = vnt.total_descuento*0.16;
		vnt.total = vnt.iva + vnt.total_descuento;	
        $("#subtotal").html('$ ' + app.number_format(vnt.subtotal,2));	
		$("#descuento").html('$ ' + app.number_format(vnt.total_descuento_general,2));	    
    	$("#iva").html('$ ' + app.number_format(vnt.iva,2)); 
    	$("#total").html('$ ' + app.number_format(vnt.total,2)); 	    	
    },
	addProducto:function(){		
		if(Object.keys(vnt.producto).length){
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
			if(vnt.productos[vnt.producto.id_producto]){				
				vnt.productos[vnt.producto.id_producto].cantidad += vnt.producto.cantidad;	
				tot = (vnt.productos[vnt.producto.id_producto].cantidad * vnt.productos[vnt.producto.id_producto].precio);
				desc = (vnt.productos[vnt.producto.id_producto].descuento * tot) / 100 ;
				vnt.productos[vnt.producto.id_producto].total = tot ;
				vnt.replaceFilaProducto(vnt.productos[vnt.producto.id_producto]);
			}else{
				vnt.addFilaProducto(vnt.producto);
			}
			vnt.totalGeneral();	
			vnt.clearForm();
		}else{
			toastr["warning"]("Seleccione antes un producto")
		}
	},
	
	addFilaProducto:function(producto){				
		$("#prdVntTbl tbody").append(vnt.getFilaProducto(producto));
		vnt.productos[producto.id_producto] = producto;
		vnt.setEditablesProducto(producto);
	},
	
	replaceFilaProducto:function(producto){	
		$("#prtr"+producto.id_producto).remove();	
		$("#prdVntTbl tbody").append(vnt.getFilaProducto(producto));
		vnt.setEditablesProducto(producto);
	},
	
	getFilaProducto:function(producto){
		return '<tr id="prtr'+producto.id_producto+'"><td class="bold">'+producto.clave+'</td><td class="ellipsis-td" title="'+producto.concepto+'">'+producto.concepto+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'"> '+app.number_format(producto.cantidad,2)+'</a> '+(producto.um)+'</td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">$ '+app.number_format(producto.precio,2)+'</a></td><td class="bold right"><a href="javascript:;" data-id="'+producto.id_producto+'">'+(producto.descuento)+' %</a></td><td class="bold right">$ '+app.number_format(producto.total,2)+'</td><td class="rmb-btn" ><button type="button" class="btn btn-danger" onclick="vnt.quitar('+producto.id_producto+')"><i class="fa fa-times"></i></button></td>';
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
                vnt.productos[id].cantidad = parseFloat(newValue);  
                vnt.totalProducto(vnt.productos[id]);
                vnt.totalGeneral();
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
                vnt.productos[id].precio = parseFloat(newValue);  
                vnt.totalProducto(vnt.productos[id]);
                vnt.totalGeneral();
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
                vnt.productos[id].descuento = parseFloat(newValue);  
                vnt.totalProducto(vnt.productos[id]);
                vnt.totalGeneral();
            }
        });     
	},
	
	quitar:function(id_producto){		
		delete vnt.productos[id_producto];
		$("#prtr"+id_producto).remove();	
		vnt.totalGeneral();		
		vnt.clearForm();
	},
	
	guardarVenta:function(o){		
		o.observaciones = $("#observaciones").val();
		o.productos = vnt.productos;
		o.subtotal = vnt.total_descuento;
		o.total_descuento = vnt.total_descuento_general; 
		o.iva = vnt.iva;
		o.total = vnt.total;		
		console.log(o);			
		$.ajax({type : "POST",url : "guardarVenta",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),$('#nuevaVenta').modal('hide'),vnt.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	
	borrarVenta:function(o){
		$.confirm({ title: 'Borrar Venta',content: '¿Esta seguro de querer borrar esta venta?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la venta, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarVenta",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),vnt.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},
	
	export : function(t,type) {
		$.ajax({type : "POST",url : type,dataType : "json",data :{id_venta: t}})
		.done(function(a) {
			1 == a.status ? window.open("application/files/" + a.folio + '.'+type, "_blank") :$.confirm({title: 'Sin resultados',icon: 'fa fa-warning',content: 'El reporte solicitado no generó ningún contenido',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-default',keys: ['enter']}}});
		}).fail(function(t, a, e) {
			 $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}}), console.log(t, a, e);
		});
	},

};