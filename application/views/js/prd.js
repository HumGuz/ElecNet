prd = {
	md:null,
	filter:{},
	init:function(){		
		$('body').on('click',"[data-fn]",function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn,delete d['bs.tooltip'],delete d['placement'],delete d.toggle,delete d.trigger ,prd[f](d)});
		prd.initFilter($("section.content"));
	},	
	initFilter:function(md){
		prd.md = md,prd.limit = 0,prd.filter= {},		
		md.find(".selectpicker").selectpicker({});
		var s;i = md.find("#busqueda_out").eq(0);
		i.keyup(function(){if(s) clearTimeout(s); s = setTimeout(function() {$('.box-body-catalogo').slimScroll({ scrollTo: '0' }),$("#prdTbl tbody").empty(),val = $.trim(i.val()),prd.productosTable({busqueda:val,id_sucursal:md.find("#id_sucursal").val(),id_almacen:md.find("#id_almacen").val(),limit:0})},1000)})	
		prd.initClas(md);		
		$("#fltrAlmFrm").validation({extend:{},success:function(ob){
			$('.box-body-catalogo').slimScroll({ scrollTo: '0' }),
			$("#prdTbl tbody").empty(),ob.limit = 0,prd.productosTable(ob)
		}})
		prd.productosTable({limit:0});
				
	},	
	initClas:function(c,d,cp,ch){		
		suc = c.find("#id_sucursal"),
		alm = c.find("#id_almacen"),			
		dep = c.find("#id_departamento"),
		catp = c.find("#id_categoria_padre"),
		cath = c.find("#id_categoria")	
		suc.change(function(){
			vl = $(this).val(),alm.find("option").prop('disabled',true),					
			(vl!='' &&  alm.find("option[data-id_sucursal='"+vl+"']").prop('disabled',false) ),
			alm.selectpicker('refresh');					
		}),
		dep.change(function(){
			vl =$(this).val(),c.find(".categorias").val(''),c.find(".categorias option").prop('disabled',true),					
			(vl!='' &&  c.find(".categorias option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
			c.find(".categorias").selectpicker('refresh');					
		}),
		(d && dep.val(d)),dep.change(),			
		catp.change(function(){
			vl =$(this).val(),cath.val(''),cath.find("option").prop('disabled',true),					
			(vl!='' &&  cath.find("option[data-id_categoria_padre='"+vl+"']").prop('disabled',false) ),
			cath.selectpicker('refresh');					
		}),
		(cp && catp.val(cp)),catp.change(),(ch && cath.val(ch) && cath.selectpicker('refresh'))
	},	
	clearAlm:function(){		
		$("#fltrAlmFrm").resetForm(),$("#fltrAlmFrm select").selectpicker('refresh'),$("#fltrAlmFrm").submit()		
	},		
	productosTable:function(o){
		prd.filter = $.extend({},o,{id_sucursal:prd.md.find("#id_sucursal").val(),id_almacen:prd.md.find("#id_almacen").val()});
		$(".overlay").show();		
		$.ajax({type : "POST",url : "productosTable",dataType : "html",data :prd.filter})
		.done(function(r) {
			($.trim(r)!='' && $("#prdTbl tbody").append(r)),
			(r.indexOf('tr')>=0 && prd.scr()),$(".overlay").hide();			
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	scr:function(){	
		$(".box-body-catalogo").scroll(function(){
	    	control = this; 
	        if ($(control).scrollTop() >= $(control)[0].scrollHeight - $(control).outerHeight()-30){ 	               
	        	$(this).unbind('scroll');
	            prd.filter.limit += 50;
                obj = $.extend({},prd.filter);
                prd.productosTable( obj );
	        }                  
	  	}); 
	},
	nuevoProducto:function(o){	
		o.id_sucursal = $("#id_sucursal").val(),o.id_almacen = $("#id_almacen").val();
		$.ajax({type:"POST",url :  "nuevoProducto",dataType : "html",data:o}).done(function(r) {
			$('body').append(r),md = $('#nuevoProducto'); 
			md.modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});			
			var s,rules = {},msj = {}
			if(o && o.id_producto){				
				s = $('#nuevoProducto .modal-content').data();
				s.colores = s.colores.split(',');
				for(i in s)
					(md.find("#"+i).length && md.find("#"+i).val(s[i]));
				md.find( "#clave" ).attr('disabled','disabled'),
				prd.initClas(md,s.id_departamento,s.id_categoria_padre,s.id_categoria)
			}else{	
				prd.initClas(md)		
				rules = {
					clave:{remote:{ url: "claveUnica",type: "POST",data: {id_almacen:o.id_almacen,clave: function() {return md.find( "#clave" ).val();}}}},
				},
				msj = {clave:{remote:"Esta clave ya esta en uso"},clave_secundaria:{remote:"Esta clave ya esta en uso"}}
			}			
			$("#id_unidad_medida_salida,#id_unidad_medida_entrada").change(function(){
				ue = $("#id_unidad_medida_entrada").val();
				es = $("#id_unidad_medida_salida").val()
				if( es!='' && ue == es && ue !='')
					$("#factor_unidades").val(1)
			});			
			$("#nvoPrdFrm .selectpicker").selectpicker({}),				
			$("#nvoPrdFrm").validation({extend:o,rules:rules,messages:msj,success:function(ob){prd.guardarProducto(ob)}})
		});
	},
	guardarProducto:function(o){		
		(Ladda.create(document.querySelector( '#nvoPrdFrm button.ladda-button' ))).start();		
		$.ajax({type : "POST",url : "guardarProducto",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),$('#nuevoProducto').modal('hide'),prd.clearAlm()) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
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
					        	$.ajax({type : "POST",url : "borrarProducto",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),prd.clearAlm()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},
	
	detalles:function(o){
		$.ajax({type : "POST",url : "detalles",dataType : "html",data : o})
		.done(function(r) {
			$('body').append(r),md = $("#prodDet-modal"),			
			$('a[href="#tab_'+o.op+'"]').tab('show'),
			md.modal({backdrop:'static',show:true}).on('hidden.bs.modal',function(){$(this).remove();}).on('shown.bs.modal',function(){
				$("#image-cropper").cropit({
					allowDragNDrop: false,
					onFileChange : function(a) {
						param = "png|jpe?g|gif", value = $("#imagen_producto").val(), value.match(new RegExp("\\.(" + param + ")$", "i")) , $("#subImg").show(),$("#seimgO").text('Cambiar Imagen') ||
						($.confirm({title : 'Archivo inválido',content : 'Seleccione un archivo formato PNG, JPEG, JPG o GIF',type : 'orange',theme : "dark",buttons : {a : {text : 'Aceptar'}}}),$("#image-cropper .cropit-preview-image").attr("src", ""), $("#imagen_producto").val(""))
					},
					onImageError : function(e) {console.log(e),toastr["error"](e.message)}
				}),	
				$("#seimgO").click(function(){$("#imagen_producto").click()});	
				$("#subImg").click(function(){					
					imgURI = $("#image-cropper").cropit("export")
					if(imgURI){											
						$.ajax({type : "POST",url : "guardarImagen",dataType : "json",data : {imagen:imgURI,id_producto:o.id_producto}})
						.done(function(r) {1 == r.status ? (
							app.ok(),
							$('a[href="#tab_1"]').tab('show'),							
							(n = $("#tab_1 .carousel-indicators li").length),							
							$("#tab_1 .carousel-indicators").append('<li class="'+(n==0?'active':'')+'" data-target="#img-prod" data-slide-to="'+n+'"></li>'),
							$("#tab_1 .carousel-inner").append('<div class="item '+(n==0?'active':'')+'"><img src="'+($("#prodDet-modal").data('base_url'))+'application/views/img/uploads/'+r.imagen+'" style="margin:0px auto"><div class="carousel-caption">'+r.imagen+' <button onclick="prd.borrarImagen({id_producto:'+o.id_producto+',imagen:\''+r.imagen+'\'})" type="button" class="btn btn-link "><span class=" text-danger glyphicon glyphicon-trash"></span></button>   </div></div>'),
							$("#img-prod").carousel(n),$("#subImg").hide(),$("#seimgO").text('Subir Imagen'),$("#image-cropper .cropit-preview-image").attr("src", ""), $("#imagen_producto").val("")
							) : app.error();})
						.fail(function(e, a, r) {console.log(e, a, r)})
					}
				});					
				$("input:checkbox[data-op]").click(function(k,e){		
					d = $(this).data() 
					o={id_producto:d.id_producto};
					o[d.op] = $(this).is(':checked')?1:0;
					$.ajax({type : "POST",url : "setOpciones",dataType : "json",data : o})
					.done(function(r) {app.ok()}).fail(function(e, a, r) {console.log(e, a, r)})
				});								
				$("#precio_especial_i").click(function(){
					if(!$(this).is(':checked')){						
						$("#precio_especial").attr('readonly','readonly').val('');
						$.ajax({type : "POST",url : "setOpciones",dataType : "json",data : {precio_oferta:0,id_producto:$(this).data('id_producto')}})
						.done(function(r) {app.ok()}).fail(function(e, a, r) {console.log(e, a, r)});
					}else{
						$("#precio_especial").removeAttr('readonly');
					}
				});
				$("#precio_especial_g").click(function(){
					d = $.extend({},$(this).data());
					d.precio_oferta = parseFloat($.trim($("#precio_especial").val()));	
					if(isNaN(d.precio_oferta)){						
						toastr["error"]("Capture el precio")
						$("#precio_especial").focus()
						return 0;
					}					
					if(d.precio_oferta < d.costo_promedio){
						toastr["error"]("El nuevo precio no puede ser menor al Costo Promedio")
						$("#precio_especial").focus()
						return 0;						
					}
					delete d.costo_promedio;
					$.ajax({type : "POST",url : "setOpciones",dataType : "json",data : d})
					.done(function(r) {app.ok()}).fail(function(e, a, r) {console.log(e, a, r)});
				});				
			});				
		}).fail(function(e, t, i) {console.log(e, t, i)});
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
					        	$.ajax({type : "POST",url : "borrarImagen",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),
									 $("#prodDet-modal").one('hidden.bs.modal',function(){ prd.detalles({id_producto:o.id_producto,op:1}) }).modal('hide')
									) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	},
	
	
	/*almacenes light*/
	nuevoAlmacen:function(o){
		$.ajax({type:"POST",url :  "nuevoAlmacen",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#nuevoAlmacen').modal({show:true,backdrop:'static'});
			$('#nuevoAlmacen').on('hidden.bs.modal',function(){$(this).remove();});		
			if(o && o.id_almacen){				
				s = $('#nuevoAlmacen .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}
			$("#nvoAlmFrm .selectpicker").selectpicker({}),
			$("#nvoAlmFrm").validation({extend:o,success:function(ob){prd.guardarAlmacen(ob)}})
		});
	},
	guardarAlmacen:function(o){		
		console.log(o)
		$.ajax({type : "POST",url : "guardarAlmacen",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),$('#nuevoAlmacen').modal('hide'),location.reload()) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarAlmacen:function(o){
		$.confirm({ title: 'Borrar Almacén',content: '¿Esta seguro de querer borrar este almacén?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con el almacén, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarAlmacen",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),location.reload()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}		
};
