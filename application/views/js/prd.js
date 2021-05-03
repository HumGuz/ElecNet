prd = {
	path:'../application/views/productos/',
	request:'../productos/',		
	init:function(i){		
		$("body").catalogo({
			title : 'Productos',id_c:"prd_c",view : prd.request,post : i,
			callback : function(i) {			
				$("#tbl-prd").scrollTable({
					parent : $("#catalogo-prd"),
					source : prd.request+ "productosTable",
					extend : i,
					singleFilter : $("#busqueda-prd"),
					advancedFilter: $("#srch-prd")					
				});				
				c = $("#seccion-prd");
				c.find(".selectpicker").selectpicker({});	
				prd.initClas(c);	
			}
		});
	},
	clean:function(i){
		($("#tbl-prd").length && $("#tbl-prd").scrollTable('clean')),($("#tbl-prd-alm").length && $("#tbl-prd-alm").scrollTable('clean'));
	},
	initClas:function(c){
		dep = c.find("#id_departamento"),
		catp = c.find("#id_categoria_padre"),
		cath = c.find("#id_categoria");
		dep.change(function(){
			vl =$(this).val(),c.find(".categorias").val(''),c.find(".categorias option").prop('disabled',true),					
			(vl!='' &&  c.find(".categorias option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
			c.find(".categorias").selectpicker('refresh');					
		}),		
		catp.change(function(){
			vl =$(this).val(),cath.val(''),cath.find("option").prop('disabled',true),					
			(vl!='' &&  cath.find("option[data-id_categoria_padre='"+vl+"']").prop('disabled',false) ),
			cath.selectpicker('refresh');					
		});
	},
	
	initAlm:function(i){		
		$("body").catalogo({
			title : 'Productos por almacén',id_c:"prd_alm_c",view : prd.request+'productosAlmacen',post : i,
			callback : function(i) {			
				$("#tbl-prd-alm").scrollTable({
					parent : $("#catalogo-prd-alm"),
					source : prd.request+ "productosAlmacenTable",
					extend : i,
					singleFilter : $("#busqueda-prd-alm"),
					advancedFilter: $("#srch-prd-alm")					
				});				
				c = $("#seccion-prd-alm");
				c.find(".selectpicker").selectpicker({});		
				alms = c.find("#id_almacen");
				alms.change(function(){			
					$("#tbl-prd-alm").scrollTable('option','extend',$.extend({},{id_almacen:$(this).val()},i));
					$("#tbl-prd-alm").scrollTable('clean');
				}),		
				prd.initClas(c);
			}
		});
	},	
	// nuevoProducto:function(i){		
		// $("body").formModal({title : "Nuevo Producto",id : "prd",modal :prd.request+"nuevoProducto",post : i,
			// callback : function(i) {				
				// var s,rules = {},msj = {};						
				// md = $('#prd-modal');
				// prd.initClas(md);								
				// if(i && i.id_producto){				
					// s = $('#prd-modal .modal-content').data();
					// s.colores = s.colores.split(',');					
					// md.find( "#id_departamento" ).val(s.id_departamento).change();
					// md.find( "#id_categoria_padre" ).val(s.id_categoria_padre).change();
					// md.find( "#id_categoria" ).val(s.id_categoria);
					// for(k in s)
						// (md.find("#"+k).length && md.find("#"+k).val(s[k]));
					// md.find( "#clave" ).attr('disabled','disabled');		
// 											
				// }else{	
					// rules = {clave:{remote:{ url: prd.request+"claveUnica",type: "POST",data: {clave: function() {return md.find( "#clave" ).val()}}}}};
					// msj = {clave:{remote:"Esta clave ya esta en uso"}};
					// md.find("#id_unidad_medida_entrada").val('pz');
					// md.find("#id_unidad_medida_salida").val('pz');					
					// md.find("#factor_unidades").val(1);
				// }			
				// md.find("#id_unidad_medida_salida,#id_unidad_medida_entrada").each(function(k,inp){					
					// $(inp).change(function(){
						// ue = md.find("#id_unidad_medida_entrada").val();
						// es = md.find("#id_unidad_medida_salida").val();
						// if( es!='' && ue == es && ue !='')
							// md.find("#factor_unidades").val(1);
					// })					
				// });
				// $("#nvoPrdFrm .selectpicker").selectpicker('refresh');	
				// console.log(i)
				// $("#nvoPrdFrm").validation({extend:i,rules:rules,messages:msj,success:function(ob){prd.guardarProducto(ob)}});	
			// }
		// });
	// },
	 borrarProducto:function(o){
		$.confirm({ title: 'Borrar producto',content: '¿Esta seguro de querer borrar este producto?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con el producto incluyendo imagenes, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : prd.request+"borrarProducto",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),app.close('prd'),app.updateByTag('prd')) : app.error();
								}).fail(function(e, t, i) {app.error();console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},	
	nuevoProductoAlmacen:function(i){		
		i.id_almacen = $("#seccion-prd-alm #id_almacen").val();
		$("body").formModal({title : "Nuevo Producto",id : "prd-alm",modal :prd.request+"nuevoProductoAlmacen",post : i,
			callback : function(i) {				
				var s,rules = {},msj = {};
				$("#nvoPrdAlmFrm .selectpicker").selectpicker({});		
				md = $('#prd-alm-modal');
				dep =  md.find("#id_departamento"),				
				catp = md.find("#id_categoria_padre"),
				cath = md.find("#id_categoria");
				dep.change(function(){
					vl =$(this).val(),md.find(".categorias").val(''),md.find(".categorias option").prop('disabled',true),					
					(vl!='' &&  md.find(".categorias option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
					md.find(".categorias").selectpicker('refresh');					
				}).change(),		
				catp.change(function(){
					vl =$(this).val(),cath.val(''),cath.find("option").prop('disabled',true),					
					(vl!='' &&  cath.find("option[data-id_categoria_padre='"+vl+"']").prop('disabled',false) ),
					cath.selectpicker('refresh');					
				}).change();
				if(i && i.id_producto){				
					s = $('#prd-alm-modal .modal-content').data();
					s.colores = s.colores.split(',');					
					dep.val(s.id_departamento).change();
					catp.val(s.id_categoria_padre).change();
					for(i in s)
						(md.find("#"+i).length && md.find("#"+i).val(s[i]));
					md.find( "#clave" ).attr('disabled','disabled');	
					$("#nvoPrdAlmFrm .selectpicker").selectpicker('refresh');					
				}else{	
					rules = {clave:{remote:{ url: prd.request+"claveUnica",type: "POST",data: {id_almacen:i.id_almacen,clave: function() {return md.find( "#clave" ).val()}}}}};
					msj = {clave:{remote:"Esta clave ya esta en uso"},clave_secundaria:{remote:"Esta clave ya esta en uso"}};
				}			
				md.find("#id_unidad_medida_salida,#id_unidad_medida_entrada").each(function(k,inp){					
					$(inp).change(function(){
						ue = $("#id_unidad_medida_entrada").val();
						es = $("#id_unidad_medida_salida").val()
						if( es!='' && ue == es && ue !='')
							$("#factor_unidades").val(1);
					})					
				});		
				$("#nvoPrdAlmFrm").validation({extend:i,rules:rules,messages:msj,success:function(ob){prd.guardarProducto(ob)}});	
			}
		});
	},
	guardarProducto:function(o){
		console.log(o)		
		app.spin('#nvoPrdAlmFrm button.ladda-button');		
		$.ajax({type : "POST",url : prd.request+"guardarProductoAlmacen",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('prd-alm'),app.updateByTag('prd')) : app.error();})
		.fail(function(e, a, r) {app.error();console.log(e, a, r)})
	},
	updateDetalles:function(o){app.close('prd_det'),prd.detalles({id_producto:o.id_producto,op:4})},
	detalles:function(i){
		i = $.extend({},{id_producto:i.id_producto,op:i.op})
		$("body").formModal({title : "Detalles Producto",alertOnClose:false,id : "prd_det",modal :prd.request+"detalles",post : i,
			callback : function(i) {
				md = $("#prd_det-modal");					
				md.find('a[href="#tab_'+i.op+'"]').tab('show');
				md.find("#image-cropper").cropit({
					allowDragNDrop: false,
					onFileChange : function(a) {
						param = "png|jpe?g|gif", value = md.find("#imagen_producto").val(), value.match(new RegExp("\\.(" + param + ")$", "i")) , md.find("#subImg").show(),md.find("#seimgO").text('Cambiar Imagen') ||
						($.confirm({title : 'Archivo inválido',content : 'Seleccione un archivo formato PNG, JPEG, JPG o GIF',type : 'orange',theme : "dark",buttons : {a : {text : 'Aceptar'}}}),md.find("#image-cropper .cropit-preview-image").attr("src", ""), md.find("#imagen_producto").val(""))
					},
					onImageError : function(e) {console.log(e),toastr["error"](e.message)}
				}),	
				md.find("#seimgO").click(function(){md.find("#imagen_producto").click()});	
				md.find("#subImg").click(function(){					
					imgURI = md.find("#image-cropper").cropit("export")
					if(imgURI){											
						$.ajax({type : "POST",url : prd.request+"guardarImagen",dataType : "json",data : {imagen:imgURI,id_producto:i.id_producto}})
						.done(function(r) {1 == r.status ? (
							app.ok(),
							md.find('a[href="#tab_1"]').tab('show'),							
							(n = md.find("#tab_1 .carousel-indicators li").length),							
							md.find("#tab_1 .carousel-indicators").append('<li class="'+(n==0?'active':'')+'" data-target="#img-prod" data-slide-to="'+n+'"></li>'),
							md.find("#tab_1 .carousel-inner").append('<div class="item '+(n==0?'active':'')+'"><img src="'+(md.data('base_url'))+'application/views/img/uploads/'+r.imagen+'" style="margin:0px auto"><div class="carousel-caption">'+r.imagen+' <button onclick="prd.borrarImagen({id_producto:'+i.id_producto+',imagen:\''+r.imagen+'\'})" type="button" class="btn btn-link "><span class=" text-danger glyphicon glyphicon-trash"></span></button> <button onclick="prd.hacerPortada({id_producto:'+i.id_producto+',imagen:\''+r.imagen+'\'})" type="button" class="btn btn-link "><span class=" text-primary glyphicon glyphicon-picture"></span></button>   </div></div>'),
							md.find("#img-prod").carousel(n),md.find("#subImg").hide(),md.find("#seimgO").text('Subir Imagen'),md.find("#image-cropper .cropit-preview-image").attr("src", ""), md.find("#imagen_producto").val("")
							) : app.error();})
						.fail(function(e, a, r) {app.error();console.log(e, a, r)})
					}
				});					
				md.find("input:checkbox[data-op]").click(function(k,e){		
					d = $(this).data() 
					o={id_producto:d.id_producto};
					o[d.op] = $(this).is(':checked')?1:0;
					$.ajax({type : "POST",url : prd.request+"setOpciones",dataType : "json",data : o})
					.done(function(r) {app.ok()}).fail(function(e, a, r) {app.error();console.log(e, a, r)})
				});								
				md.find("#precio_especial_i").click(function(){
					if(!$(this).is(':checked')){						
						md.find("#precio_especial").attr('readonly','readonly').val('');
						$.ajax({type : "POST",url : prd.request+"setOpciones",dataType : "json",data : {precio_oferta:0,id_producto:$(this).data('id_producto')}})
						.done(function(r) {app.ok()}).fail(function(e, a, r) {app.error();console.log(e, a, r)});
					}else{
						md.find("#precio_especial").removeAttr('readonly');
					}
				});
				md.find("#precio_especial_g").click(function(){
					d = $.extend({},$(this).data());
					d.precio_oferta = parseFloat($.trim(md.find("#precio_especial").val()));	
					if(isNaN(d.precio_oferta)){						
						toastr["error"]("Capture el precio")
						md.find("#precio_especial").focus()
						return 0;
					}					
					if(d.precio_oferta < d.costo_promedio){
						toastr["error"]("El nuevo precio no puede ser menor al Costo Promedio")
						md.find("#precio_especial").focus()
						return 0;						
					}
					delete d.costo_promedio;
					$.ajax({type : "POST",url : prd.request+"setOpciones",dataType : "json",data : d})
					.done(function(r) {app.ok()}).fail(function(e, a, r) {app.error();console.log(e, a, r)});
				});
			}
		});
	},
	
	borrarImagen:function(o){
		$.confirm({ title: 'Borrar imagen',content: '¿Esta seguro de querer borrar esta imagen?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la imagen, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : prd.request+"borrarImagen",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (  app.ok(), app.updateByTag('prd') ) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},
	
	hacerPortada:function(o){
		$.confirm({ title: 'Hacer Portada',content: '¿Esta seguro de querer hacer esta imagen la portada?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Hacer Portada',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Hacer Portada',content: 'Al hacer portada esta imagen, se mostrara primero en la pagina E-commerce, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Hacer Portada',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : prd.request+"hacerPortada",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? app.ok() : app.error();
								}).fail(function(e, t, i) {app.error();console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},
};
