prd = {
	limit:0,filter:{},
	init:function(){		
		$('body').on('click',"[data-fn]",function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn,delete d['bs.tooltip'],delete d['placement'],delete d.toggle,delete d.trigger ,prd[f](d)});
		
		prd.initFilter($("section.content"));
	},	
	initFilter:function(md){
		prd.limit = 0,prd.filter= {},		
		md.find(".selectpicker").selectpicker({});
		var s,i = md.find("#busqueda_out");
		i.keyup(function(){if(s) clearTimeout(s),s = setTimeout(function() {prd.limit = 0,prd.filter= {},val = $.trim(i.val()),prd.productosTable({busqueda:val,id_sucursal:md.find("#id_sucursal").val(),id_almacen:md.find("#id_almacen").val(),limit:0})},500)})	
		prd.initClas(md);		
		$("#fltrAlmFrm").validation({extend:{},success:function(ob){
			$("#prdTbl tbody").empty(),prd.limit = 0,prd.filter= ob,ob.limit = 0,
			prd.productosTable(ob)
		}})
		prd.productosTable({limit:0,id_sucursal:md.find("#id_sucursal").val(),id_almacen:md.find("#id_almacen").val()});		
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
		$(".overlay").show();		
		$.ajax({type : "POST",url : "productosTable",dataType : "html",data : o})
		.done(function(r) {
			($.trim(r)!='' && $("#prdTbl tbody").append(r)),
			($(r).find('tr').length && prd.scr()),$(".overlay").hide();			
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	scr:function(){
		$(".scroller-tbl").scroll(function(){
	    	control = this; 
	        if ($(control).scrollTop() >= $(control)[0].scrollHeight - $(control).outerHeight()-100){ 	               
	        	$(this).unbind('scroll');
	            insumos.limit += 50;
                obj = $.extend({},insumos.filter,{id_clasificacion_insumo:insumos.id_clasificacion_insumo,limit:insumos.limit});
                insumos.getInsumosTable( obj );
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
	//			md.find( "#clave_secundaria" ).attr('disabled','disabled'),
				md.find( "#clave" ).attr('disabled','disabled'),
				prd.initClas(md,s.id_departamento,s.id_categoria_padre,s.id_categoria)
			}else{	
				prd.initClas(md)		
				rules = {
					clave:{remote:{ url: "claveUnica",type: "POST",data: {id_almacen:o.id_almacen,clave: function() {return md.find( "#clave" ).val();}}}},
					clave_secundaria:{remote:{ url: "claveUnica",type: "POST",data: {id_almacen:o.id_almacen,clave_secundaria: function() {return md.find( "#clave_secundaria" ).val();}}}}
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
	
	imagenes:function(o){
		$.ajax({type : "POST",url : "imagenes",dataType : "html",data : o})
		.done(function(r) {
			$('body').append(r),md = $("#prodImg-modal"),		
			md.modal({backdrop:'static',show:true}).on('hidden.bs.modal',function(){$(this).remove();}).on('shown.bs.modal',function(){
				
			});				
		}).fail(function(e, t, i) {console.log(e, t, i)});
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
